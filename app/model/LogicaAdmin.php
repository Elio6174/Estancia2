<?php

include_once "config/Connection.php";
include_once "Public/libraries/fpdf/fpdf.php";
include_once "Public/libraries/phplot/phplot.php";

class LogicaAdmin {
    
    private $connection;

    public function __construct() {
        $this->connection = getConnection();
    }

    // =============== LOGIN SOLO ADMIN ===================
    public function buscarAdmin($email){
        $query = "SELECT * FROM usuarios WHERE correo = ? AND rol = 'administrador' LIMIT 1";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("s", $email);
        $stmt->execute();

        return $stmt->get_result()->fetch_assoc();
    }

    // =============== PROTEGER RUTAS ======================
    private function protegerAdmin() {
        session_start();
        if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'administrador') {
            header("Location: app/view/formulario/InicioSesion/index.html");
            exit;
        }
    }

    // =============== DASHBOARD ===========================
    public function getDashboardData() {
        $query = "
            SELECT 
                (SELECT COUNT(*) FROM pacientes) AS total_pacientes,
                (SELECT COUNT(*) FROM doctores) AS total_doctores,
                (SELECT COUNT(*) FROM citas) AS total_citas
        ";
        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function mostrarDashboard() {
        $this->protegerAdmin();
        
        $data = $this->getDashboardData();
        include "app/view/administrador/Dashboard/index.html";
    }

    public function deleteUser(){
        $idAEliminar = $_POST['id'];
        if ($idAEliminar == $_SESSION['id_usuario']) {
            echo json_encode([
                "status" => "error",
                "message" => "No puedes eliminar tu propio usuario."
            ]);
            exit;
        }
        $sentencia = "DELETE FROM usuarios WHERE id_usuario = ?";
        $statement = $this->connection->prepare($sentencia);
        $statement->bind_param("i", $idAEliminar);
        $statement->execute();
        return $statement;
    }

    public function getAppointmentsBySpecialty(){
        $sentencia = "SELECT e.nombre AS especialidad, COALESCE(COUNT(c.id_cita), 0) AS total_citas FROM especialidades e LEFT JOIN citas c ON e.id_especialidad = c.id_especialidad
            GROUP BY e.id_especialidad, e.nombre ORDER BY total_citas DESC";
        $statement = $this->connection->prepare($sentencia);
        $statement->execute();
		$result = $statement->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    
    public function getAppointmentsByMonth(){
        $sentencia = "SELECT semanas.semana, COALESCE(c.total, 0) AS total FROM (SELECT 1 AS semana UNION SELECT 2 UNION SELECT 3 UNION SELECT 4) AS semanas LEFT JOIN (
            SELECT CEIL(DAY(fecha_cita) / 7) AS semana,COUNT(*) AS total FROM citas WHERE MONTH(fecha_cita) = MONTH(CURDATE()) AND YEAR(fecha_cita) = YEAR(CURDATE()) GROUP BY semana) AS c
            ON c.semana = semanas.semana ORDER BY semanas.semana";
        $statement = $this->connection->prepare($sentencia);
        $statement->execute();
		$result = $statement->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }


    public function getAppointments($page, $limit, $filters){
        $params = [];
        $where = $this->buildWhereClause($filters, $params);

        $total = $this->getAppointmentsCount($where, $params);
        $offset = ($page - 1) * $limit;

        $data = $this->getAppointmentsData($where, $params, $limit, $offset);

        return [
            "total" => $total,
            "page" => $page,
            "limit" => $limit,
            "total_pages" => ceil($total / $limit),
            "data" => $data
        ];
    }


    private function buildWhereClause($filters, &$params){
        $where = " WHERE 1=1 ";

        if (!empty($filters['estado'])) {
            $where .= " AND c.estado = ? ";
            $params[] = $filters['estado'];
        }

        if (!empty($filters['doctor'])) {
            $where .= " AND d.id_doctor = ? ";
            $params[] = $filters['doctor'];
        }

        if (!empty($filters['fecha'])) {
            $where .= " AND c.fecha_cita = ? ";
            $params[] = $filters['fecha'];
        }

        if (!empty($filters['paciente'])) {
            $where .= " AND pp.nombre LIKE ? ";
            $params[] = "%" . $filters['paciente'] . "%";
        }
        return $where;
    }

    private function getAppointmentsCount($where, $params){
        $sql = "
            SELECT COUNT(*) AS total
            FROM citas c
            INNER JOIN pacientes p ON p.id_paciente = c.id_paciente 
            INNER JOIN personas pp ON pp.id_persona = p.id_persona 
            INNER JOIN doctores d ON d.id_doctor = c.id_doctor 
            INNER JOIN personas pd ON pd.id_persona = d.id_persona
            INNER JOIN especialidades e ON e.id_especialidad = c.id_especialidad
            INNER JOIN disponibilidad disp ON disp.id_disponibilidad = c.id_disponibilidad
            INNER JOIN horas h ON h.id_hora = disp.id_hora
            $where
        ";

        $stmt = $this->connection->prepare($sql);

        if (count($params) > 0) {
            $stmt->bind_param(str_repeat("s", count($params)), ...$params);
        }

        $stmt->execute();
        return $stmt->get_result()->fetch_assoc()['total'];
    }

    private function getAppointmentsData($where, $params, $limit, $offset){
        $sql = "
            SELECT 
                c.id_cita,
                c.fecha_cita AS fecha,
                TIME_FORMAT(h.hora, '%h:%i %p') AS hora,
                pp.nombre AS paciente,
                pd.nombre AS doctor,
                e.nombre AS especialidad,
                c.estado
            FROM citas c
            INNER JOIN pacientes p ON p.id_paciente = c.id_paciente 
            INNER JOIN personas pp ON pp.id_persona = p.id_persona 
            INNER JOIN doctores d ON d.id_doctor = c.id_doctor 
            INNER JOIN personas pd ON pd.id_persona = d.id_persona
            INNER JOIN especialidades e ON e.id_especialidad = c.id_especialidad
            INNER JOIN disponibilidad disp ON disp.id_disponibilidad = c.id_disponibilidad
            INNER JOIN horas h ON h.id_hora = disp.id_hora
            $where
            ORDER BY c.fecha_cita, h.hora
            LIMIT ? OFFSET ?
        ";

        $types = str_repeat("s", count($params)) . "ii";
        $paramsFinal = array_merge($params, [$limit, $offset]);

        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param($types, ...$paramsFinal);
        $stmt->execute();

        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }


    public function getDoctors() {
        $sql = "SELECT d.id_doctor, CASE WHEN pd.sexo = 'Femenino' THEN CONCAT('Dra. ', pd.nombre) ELSE CONCAT('Dr. ', pd.nombre) END AS nombre FROM doctores d INNER JOIN personas pd ON pd.id_persona = d.id_persona ORDER BY pd.nombre";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function deleteAppointment($id){
        $stmt = $this->connection->prepare("DELETE FROM citas WHERE id_cita = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return ["success" => $stmt->affected_rows > 0];
    }


    

    public function getUsers($page, $limit, $filters){
        list($where, $params, $types) = $this->buildUserFilters($filters);
        $total = $this->countUsers($where, $params, $types);
        $data = $this->fetchUsers($where, $params, $types, $page, $limit);
        return [
            "total" => $total,
            "page" => $page,
            "limit" => $limit,
            "total_pages" => ceil($total / $limit),
            "data" => $data
        ];
    }

    private function buildUserFilters($filters){
        $where = " WHERE 1=1 ";
        $params = [];
        $types = "";
        if (!empty($filters['nombre'])) {
            $where .= " AND p.nombre LIKE ? ";
            $params[] = "%".$filters['nombre']."%";
            $types .= "s";
        }
        if (!empty($filters['correo'])) {
            $where .= " AND u.correo LIKE ? ";
            $params[] = "%".$filters['correo']."%";
            $types .= "s";
        }
        if (!empty($filters['rol'])) {
            $where .= " AND u.rol = ? ";
            $params[] = $filters['rol'];
            $types .= "s";
        }
        return [$where, $params, $types];
    }

    private function countUsers($where, $params, $types){
        $sql = "
            SELECT COUNT(*) AS total 
            FROM usuarios u
            INNER JOIN personas p ON p.id_usuario = u.id_usuario
            $where
        ";

        $stmt = $this->connection->prepare($sql);

        if (!empty($params)) {
            $stmt->bind_param($types, ...$params);
        }

        $stmt->execute();
        return $stmt->get_result()->fetch_assoc()['total'];
    }


    private function fetchUsers($where, $params, $types, $page, $limit){
        $offset = ($page - 1) * $limit;
        $sql = "SELECT u.id_usuario, p.nombre, u.correo, u.rol FROM usuarios u INNER JOIN personas p ON p.id_usuario = u.id_usuario $where ORDER BY p.nombre ASC LIMIT ? OFFSET ?";
        $stmt = $this->connection->prepare($sql);
        $typesFinal = $types . "ii";
        $paramsFinal = array_merge($params, [$limit, $offset]);
        $stmt->bind_param($typesFinal, ...$paramsFinal);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function updateUser($data){
        if (empty($data['id_usuario']) || empty($data['nombre']) || empty($data['rol'])) {
            return ["status" => "error", "message" => "Datos incompletos"];
        }

        $id_usuario = $data['id_usuario'];
        $nombre     = $data['nombre'];
        $nuevoRol   = $data['rol'];

        // Obtener id_persona
        $sqlPersona = "SELECT id_persona FROM personas WHERE id_usuario = ?";
        $stmt = $this->connection->prepare($sqlPersona);
        $stmt->bind_param("i", $id_usuario);
        $stmt->execute();
        $id_persona = $stmt->get_result()->fetch_assoc()['id_persona'];

        if (!$id_persona) {
            return ["status" => "error", "message" => "No se encontró persona"];
        }

        // Obtener rol actual
        $sqlRol = "SELECT rol FROM usuarios WHERE id_usuario = ?";
        $stmt = $this->connection->prepare($sqlRol);
        $stmt->bind_param("i", $id_usuario);
        $stmt->execute();
        $rol_actual = $stmt->get_result()->fetch_assoc()['rol'];

        // 1. Actualizar usuario
        $sql1 = "UPDATE usuarios SET rol = ? WHERE id_usuario = ?";
        $stmt1 = $this->connection->prepare($sql1);
        $stmt1->bind_param("si", $nuevoRol, $id_usuario);
        $ok1 = $stmt1->execute();

        // 2. Actualizar nombre
        $sql2 = "UPDATE personas SET nombre = ? WHERE id_usuario = ?";
        $stmt2 = $this->connection->prepare($sql2);
        $stmt2->bind_param("si", $nombre, $id_usuario);
        $ok2 = $stmt2->execute();

        // 3. Cambiar rol correctamente
        if ($rol_actual !== $nuevoRol) {

            // ---- DE PACIENTE A DOCTOR ----
            if ($nuevoRol === "doctor") {

                // Eliminar si existe en pacientes
                $delPac = $this->connection->prepare("DELETE FROM pacientes WHERE id_persona = ?");
                $delPac->bind_param("i", $id_persona);
                $delPac->execute();

                // Insertar en doctores (poner valores por defecto)
                $insDoc = $this->connection->prepare(
                    "INSERT INTO doctores (id_persona, id_especialidad, cedula_profesional, consultorio)
                    VALUES (?, 1, NULL, NULL)"
                );
                $insDoc->bind_param("i", $id_persona);
                $insDoc->execute();
            }

            // ---- DE DOCTOR A PACIENTE ----
            if ($nuevoRol === "paciente") {

                // Eliminar si existe en doctores
                $delDoc = $this->connection->prepare("DELETE FROM doctores WHERE id_persona = ?");
                $delDoc->bind_param("i", $id_persona);
                $delDoc->execute();

                // Insertar en pacientes
                $insPac = $this->connection->prepare(
                    "INSERT INTO pacientes (id_persona, tipo_sangre) VALUES (?, NULL)"
                );
                $insPac->bind_param("i", $id_persona);
                $insPac->execute();
            }
        }

        if ($ok1 && $ok2) {
            return ["status" => "success", "message" => "Usuario actualizado correctamente"];
        }

        return ["status" => "error", "message" => "No se pudo actualizar"];
    }


    public function countPacientes(){
        $sentencia = "select COUNT(*) as total from usuarios where rol='paciente'";
        $statement = $this->connection->prepare($sentencia);
        $statement->execute();
        $result = $statement->get_result();
        return $result->fetch_assoc();
    }

    public function appointmentsByMonth($estado) {

        $query = "
            SELECT 
                m.mes,
                m.mes_num,
                COUNT(c.id_cita) AS total_citas
            FROM (
                SELECT 1 AS mes_num, 'Enero' AS mes UNION ALL
                SELECT 2, 'Febrero' UNION ALL
                SELECT 3, 'Marzo' UNION ALL
                SELECT 4, 'Abril' UNION ALL
                SELECT 5, 'Mayo' UNION ALL
                SELECT 6, 'Junio' UNION ALL
                SELECT 7, 'Julio' UNION ALL
                SELECT 8, 'Agosto' UNION ALL
                SELECT 9, 'Septiembre' UNION ALL
                SELECT 10, 'Octubre' UNION ALL
                SELECT 11, 'Noviembre' UNION ALL
                SELECT 12, 'Diciembre'
            ) AS m

            LEFT JOIN citas c 
                ON MONTH(c.fecha_cita) = m.mes_num
                AND YEAR(c.fecha_cita) = YEAR(CURDATE())
                AND c.estado = ?

            WHERE m.mes_num <= MONTH(CURDATE())
            GROUP BY m.mes_num, m.mes
            ORDER BY m.mes_num
        ";

        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("s", $estado);
        $stmt->execute();

        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function backup_tables($tables){
        $orderedTables = [
            'usuarios',
            'especialidades',
            'horas',
            'dias',
            'personas',
            'pacientes',
            'doctores',
            'disponibilidad',
            'citas'
        ];
        if ($tables == '*') {
            $tables = $orderedTables;
        } else {
            $tables = is_array($tables) ? $tables : explode(',', $tables);
        }
        $return = 
        "DROP DATABASE IF EXISTS clinica_citas_db;
CREATE DATABASE clinica_citas_db;
USE clinica_citas_db;
        
        ";

        foreach ($tables as $table){
            $resCreate = $this->connection->query('SHOW CREATE TABLE '.$table);
            $row2 = mysqli_fetch_row($resCreate);

            $return .= "\n\n" . $row2[1] . ";\n\n";

            // INSERTS
            $result = $this->connection->query('SELECT * FROM '.$table);
            $num_fields = mysqli_num_fields($result);
            while ($row = mysqli_fetch_row($result)){
                $return .= 'INSERT INTO '.$table.' VALUES(';
                for ($j = 0; $j < $num_fields; $j++){
                    $value = isset($row[$j]) ? addslashes($row[$j]) : "";
                    $value = preg_replace("/\n/", "\\n", $value);
                    $return .= '"' . $value . '"';
                    if ($j < ($num_fields - 1)) $return .= ',';
                }
                $return .= ");\n";
            }
            $return .= "\n\n";
        }
        $nombreArchivo = "backup_" . date("Y-m-d_H-i-s") . ".sql";
        header("Content-Type: application/sql");
        header("Content-Disposition: attachment; filename=\"$nombreArchivo\"");
        echo $return;
        exit;
    }




    public function consultarPacientes() {
    $sentencia = "SELECT 
    pa.id_paciente,
    per.nombre,
    per.telefono,
    per.fecha_nacimiento,
    per.sexo,
    per.direccion,
    u.correo,
    pa.tipo_sangre
FROM pacientes pa
INNER JOIN personas per ON pa.id_persona = per.id_persona
INNER JOIN usuarios u ON per.id_usuario = u.id_usuario
ORDER BY per.nombre ASC;
";

    $statement = $this->connection->prepare($sentencia);
    $statement->execute();
    $result = $statement->get_result();

    return $result->fetch_all(MYSQLI_ASSOC);
}

    public function consultarDoctores() {
        $sentencia = "SELECT 
                d.id_doctor,
                per.nombre,
                per.telefono,
                per.fecha_nacimiento,
                per.sexo,
                per.direccion,
                u.correo,
                esp.nombre AS especialidad,
                d.cedula_profesional,
                d.consultorio
            FROM doctores d
            INNER JOIN personas per ON d.id_persona = per.id_persona
            INNER JOIN usuarios u ON per.id_usuario = u.id_usuario
            INNER JOIN especialidades esp ON d.id_especialidad = esp.id_especialidad
            ORDER BY per.nombre ASC";

        $statement = $this->connection->prepare($sentencia);
        $statement->execute();
        $result = $statement->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function conteoPacientesPorGenero() {
        $sql = "SELECT 
                    COALESCE(per.sexo, 'Sin especificar') AS sexo,
                    COUNT(*) AS total
                FROM pacientes pa
                INNER JOIN personas per ON pa.id_persona = per.id_persona
                GROUP BY sexo";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        $res = $stmt->get_result();
        $conteos = [
            "Masculino" => 0,
            "Femenino" => 0,
            "Prefiero no decir" => 0,
            "Sin especificar" => 0
        ];
        while ($row = $res->fetch_assoc()) {
            $sexo = $row["sexo"];
            $conteos[$sexo] = (int)$row["total"];
        }
        return $conteos;
    }

    public function conteoDoctoresPorGenero() {
        $sql = "SELECT 
                    COALESCE(per.sexo, 'Sin especificar') AS sexo,
                    COUNT(*) AS total
                FROM doctores d
                INNER JOIN personas per ON d.id_persona = per.id_persona
                GROUP BY sexo";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        $res = $stmt->get_result();
        $conteos = [
            "Masculino" => 0,
            "Femenino" => 0,
            "Prefiero no decir" => 0,
            "Sin especificar" => 0
        ];
        while ($row = $res->fetch_assoc()) {
            $sexo = $row["sexo"];
            $conteos[$sexo] = (int)$row["total"];
        }
        return $conteos;
    }

    public function generarPDFPacientes($data){
        $img = $this->generarGraficaGeneroPacientes();
        $conteos = $this->conteoPacientesPorGenero();
        $totalPacientes = array_sum($conteos);
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial','B',16);
        $pdf->Cell(0,10,'Reporte de Pacientes',0,1,'C');
        $pdf->Ln(3);

        if (file_exists($img)) {
            $pdf->Image($img, 10, 25, 100, 100);
        }
        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY(120, 30);
        $pdf->Cell(0,6,"ESTADISTICAS",0,1);
        $pdf->SetFont('Arial','',10);
        $pdf->SetXY(120, 40);
        $pdf->Cell(0,6,"Total pacientes: $totalPacientes",0,1);
        $pdf->SetXY(120, 48);
        $pdf->Cell(0,6,"Masculino: " . $conteos["Masculino"],0,1);
        $pdf->SetXY(120, 56);
        $pdf->Cell(0,6,"Femenino: " . $conteos["Femenino"],0,1);
        $pdf->SetXY(120, 64);
        $pdf->Cell(0,6,"Prefiero no decir: " . $conteos["Prefiero no decir"],0,1);
        $pdf->SetXY(120, 72);
        $pdf->Cell(0,6,"Sin especificar: " . $conteos["Sin especificar"],0,1);
        $pdf->Ln(50);
        $pdf->SetFont('Arial','B',8);
        $pdf->SetFillColor(0,0,0);
        $pdf->SetTextColor(255,255,255);
        $pdf->Cell(15,8,'ID',1,0,'C',true);
        $pdf->Cell(50,8,'Nombre',1,0,'C',true);
        $pdf->Cell(20,8,'Telefono',1,0,'C',true);
        $pdf->Cell(20,8,'Nacimiento',1,0,'C',true);
        $pdf->Cell(20,8,'Sexo',1,0,'C',true);
        $pdf->Cell(50,8,'Correo',1,0,'C',true);
        $pdf->Cell(10,8,'Sangre',1,1,'C',true);
        $pdf->SetFont('Arial','',8);
        $pdf->SetTextColor(0,0,0);

        foreach($data as $p){
            $pdf->Cell(15,8,$p['id_paciente'],1);
            $pdf->Cell(50,8,$p['nombre'],1);
            $pdf->Cell(20,8,$p['telefono'],1);
            $pdf->Cell(20,8,$p['fecha_nacimiento'],1);
            $pdf->Cell(20,8,$p['sexo'],1);
            $pdf->Cell(50,8,$p['correo'],1);
            $pdf->Cell(10,8,$p['tipo_sangre'],1);
            $pdf->Ln();
        }
        $fecha = date('Y-m-d');
        $nombreArchivo = "Reporte_Pacientes_{$fecha}.pdf";
        if (ob_get_length()) ob_end_clean();
        $pdf->Output('D', $nombreArchivo);
    }

    public function generarPDFDoctores($data){
        $img = $this->generarGraficaGeneroDoctores();
        $conteos = $this->conteoDoctoresPorGenero();
        $totalDoctores = array_sum($conteos);
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial','B',14);
        $pdf->Cell(0,10,'Reporte de Doctores',0,1,'C');
        $pdf->Ln(5);
        if (file_exists($img)) {
            $pdf->Image($img, 10, 25, 100, 100);
        }
        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY(120, 30);
        $pdf->Cell(0,6,"ESTADISTICAS",0,1);
        $pdf->SetFont('Arial','',10);
        $pdf->SetXY(120, 40);
        $pdf->Cell(0,6,"Total doctores: $totalDoctores",0,1);
        $pdf->SetXY(120, 48);
        $pdf->Cell(0,6,"Masculino: " . $conteos["Masculino"],0,1);
        $pdf->SetXY(120, 56);
        $pdf->Cell(0,6,"Femenino: " . $conteos["Femenino"],0,1);
        $pdf->SetXY(120, 64);
        $pdf->Cell(0,6,"Prefiero no decir: " . $conteos["Prefiero no decir"],0,1);
        $pdf->SetXY(120, 72);
        $pdf->Cell(0,6,"Sin especificar: " . $conteos["Sin especificar"],0,1);
        $pdf->Ln(50);
        $pdf->SetFont('Arial','B',8);
        $pdf->SetFillColor(0,0,0);
        $pdf->SetTextColor(255,255,255);
        $pdf->Cell(15,8,'ID',1,0,'C',true);
        $pdf->Cell(50,8,'Nombre',1,0,'C',true);
        $pdf->Cell(25,8,'Telefono',1,0,'C',true);
        $pdf->Cell(50,8,'Correo',1,0,'C',true);
        $pdf->Cell(30,8,'Especialidad',1,0,'C',true);
        $pdf->Cell(15,8,'Cedula',1,1,'C',true);
        $pdf->SetFont('Arial','',8);
        $pdf->SetTextColor(0,0,0);
        foreach($data as $d){
            $pdf->Cell(15,8,$d['id_doctor'],1);
            $pdf->Cell(50,8,$d['nombre'],1);
            $pdf->Cell(25,8,$d['telefono'],1);
            $pdf->Cell(50,8,$d['correo'],1);
            $pdf->Cell(30,8,$d['especialidad'],1);
            $pdf->Cell(15,8,$d['cedula_profesional'],1);
            $pdf->Ln();
        }
        $fecha = date('Y-m-d');
        $nombreArchivo = "Reporte_Doctores_{$fecha}.pdf";
        if (ob_get_length()) ob_end_clean();
        $pdf->Output('D', $nombreArchivo);
    }

    public function generarReporteCitas($inicio, $fin, $doctor){
        $tipo   = $_POST['tipo'];
         switch ($tipo) {
            case 'citas':
                $data = $this->consultarCitas($inicio, $fin, $doctor);
                $this->generarPDFCitas($data, $inicio, $fin, $doctor);
                break;
            case 'pacientes':
                $data = $this->consultarPacientes();
                $this->generarPDFPacientes($data);
                break;
            case 'doctores':
                $data = $this->consultarDoctores();
                $this->generarPDFDoctores($data);
                break;
            default:
                echo "Tipo de reporte no válido.";
                return;
        }
    }

    public function consultarCitas($inicio, $fin, $doctor){
        $sentencia = "SELECT 
                c.id_cita,
                c.fecha_cita,
                c.estado,
                c.notas,
                c.diagnostico,
                c.receta,
                per.nombre AS nombre_paciente,
                per_d.nombre AS nombre_doctor,
                esp.nombre AS especialidad,
                h.hora AS hora_cita,
                d2.nombre AS dia_cita
            FROM citas c
            INNER JOIN pacientes p ON c.id_paciente = p.id_paciente
            INNER JOIN personas per ON p.id_persona = per.id_persona
            INNER JOIN doctores d ON c.id_doctor = d.id_doctor
            INNER JOIN personas per_d ON d.id_persona = per_d.id_persona   -- ← FIX
            INNER JOIN especialidades esp ON c.id_especialidad = esp.id_especialidad
            INNER JOIN disponibilidad dis ON c.id_disponibilidad = dis.id_disponibilidad
            INNER JOIN horas h ON dis.id_hora = h.id_hora
            INNER JOIN dias d2 ON dis.id_dia = d2.id_dia
            WHERE 1 = 1";
        $bindTypes = "";
        $params = [];
        if (!empty($inicio) && !empty($fin)) {
            $sentencia .= " AND c.fecha_cita BETWEEN ? AND ?";
            $bindTypes .= "ss";
            $params[] = $inicio;
            $params[] = $fin;
        } elseif (!empty($inicio)) {
            $sentencia .= " AND c.fecha_cita >= ?";
            $bindTypes .= "s";
            $params[] = $inicio;
        } elseif (!empty($fin)) {
            $sentencia .= " AND c.fecha_cita <= ?";
            $bindTypes .= "s";
            $params[] = $fin;
        }
        if ($doctor !== "todos") {
            $sentencia .= " AND c.id_doctor = ?";
            $bindTypes .= "i";
            $params[] = intval($doctor);
        }
        $sentencia .= " ORDER BY c.fecha_cita ASC, h.hora ASC";
        $statement = $this->connection->prepare($sentencia);
        if (!empty($params)) {
            $statement->bind_param($bindTypes, ...$params);
        }
        $statement->execute();
        $result = $statement->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }


    public function generarPDFCitas($data, $inicio, $fin, $doctor){
        if (empty($inicio) && empty($fin)) {
            $titulo = "Reporte de Citas (Todos los registros)";
            $nombreArchivo = "Reporte_Citas_Todos.pdf";
        }
        elseif (!empty($inicio) && empty($fin)) {
            $titulo = "Reporte de Citas desde $inicio";
            $nombreArchivo = "Reporte_Citas_desde_$inicio.pdf";
        }
        elseif (empty($inicio) && !empty($fin)) {
            $titulo = "Reporte de Citas hasta $fin";
            $nombreArchivo = "Reporte_Citas_hasta_$fin.pdf";
        }
        else {
            $titulo = "Reporte de Citas del $inicio al $fin";
            $nombreArchivo = "Reporte_Citas_{$inicio}_{$fin}.pdf";
        }
        $nombreArchivo = str_replace(" ", "_", $nombreArchivo);
        $pdf = new FPDF();
        $pdf->AddPage(); 
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(0,10, $titulo, 0, 1, 'C');
        $pdf->Ln(5);
        if ($doctor === "todos") {
            $img = $this->generarGraficaCitasPorDoctor($inicio, $fin);
            if ($img && file_exists($img)) {
                $pdf->Image($img, 10, 25, 120, 120);
                $pdf->SetXY(140, 30);
                $pdf->SetFont('Arial','B',10);
                $pdf->Cell(50,8,'Top Doctores:',0,1);
                $lista = $this->consultarCitasPorDoctor($inicio, $fin);
                usort($lista, fn($a, $b) => $b['total'] - $a['total']);
                $listaTop = array_slice($lista, 0, 5);
                $otros = array_slice($lista, 5);
                $otrosTotal = array_sum(array_column($otros, 'total'));
                $totalGeneral = array_sum(array_column($lista, 'total'));
                if ($otrosTotal > 0) {
                    $listaTop[] = ["doctor" => "Otros doctores", "total" => $otrosTotal];
                }
                foreach ($listaTop as $row) {
                    $pdf->SetX(140);
                    $pdf->SetFont('Arial','',9);
                    $pdf->Cell(50, 6, $row['doctor']." : ".$row['total'], 0, 1);
                }
                $pdf->Ln(5);
                $pdf->SetX(140);
                $pdf->SetFont('Arial','B',10);
                $pdf->Cell(50, 8, "Total de citas: $totalGeneral", 0, 1);
                $pdf->Ln(70);
            }
        }else{
            $totalFiltrado = count($data);
            $pdf->SetFont('Arial','B',11);
            $pdf->Cell(0, 8, "Total de citas: $totalFiltrado", 0, 1, 'L');
        }
        $pdf->SetFont('Arial','B',7);
        $pdf->SetFillColor(0,0,0);
        $pdf->SetTextColor(255,255,255);
        $pdf->Cell(10, 8, 'ID', 1, 0, 'C', true);
        $pdf->Cell(20, 8, 'Fecha', 1, 0, 'C', true);
        $pdf->Cell(40, 8, 'Paciente', 1, 0, 'C', true);
        $pdf->Cell(40, 8, 'Doctor', 1, 0, 'C', true);
        $pdf->Cell(35, 8, 'Especialidad', 1, 0, 'C', true);
        $pdf->Cell(15, 8, 'Hora', 1, 0, 'C', true);
        $pdf->Cell(15, 8, 'Día', 1, 0, 'C', true);
        $pdf->Cell(20, 8, 'Estado', 1, 1, 'C', true);
        $pdf->SetFont('Arial','',7);
        $pdf->SetTextColor(0,0,0);
        foreach($data as $c){
            $pdf->Cell(10, 8, $c['id_cita'],1,0,'C');
            $pdf->Cell(20, 8, $c['fecha_cita'],1,0,'C');
            $pdf->Cell(40, 8, $c['nombre_paciente'],1,0,'C');
            $pdf->Cell(40, 8, $c['nombre_doctor'],1,0,'C');
            $pdf->Cell(35, 8, $c['especialidad'],1,0,'C');
            $pdf->Cell(15, 8, $c['hora_cita'],1,0,'C');
            $pdf->Cell(15, 8, $c['dia_cita'],1,0,'C');
            $pdf->Cell(20, 8, $c['estado'],1,1,'C');
        }
        $pdf->Ln(5);
        if (ob_get_length()) ob_end_clean();
        $pdf->Output('D', $nombreArchivo);
    }

    public function consultarCitasPorDoctor($inicio = null, $fin = null){
        $sentencia = "SELECT 
                per.nombre AS doctor,
                COUNT(*) AS total
            FROM citas c
            INNER JOIN doctores d ON c.id_doctor = d.id_doctor
            INNER JOIN personas per ON d.id_persona = per.id_persona
            WHERE 1 = 1";
        $bindTypes = "";
        $params = [];
        if (!empty($inicio) && !empty($fin)) {
            $sentencia .= " AND c.fecha_cita BETWEEN ? AND ?";
            $bindTypes .= "ss";
            $params[] = $inicio;
            $params[] = $fin;
        } elseif (!empty($inicio)) {
            $sentencia .= " AND c.fecha_cita >= ?";
            $bindTypes .= "s";
            $params[] = $inicio;
        } elseif (!empty($fin)) {
            $sentencia .= " AND c.fecha_cita <= ?";
            $bindTypes .= "s";
            $params[] = $fin;
        }
        $sentencia .= " GROUP BY c.id_doctor ORDER BY total DESC";
        $stmt = $this->connection->prepare($sentencia);
        if (!empty($params)) {
            $stmt->bind_param($bindTypes, ...$params);
        }
        $stmt->execute();
        $res = $stmt->get_result();
        return $res->fetch_all(MYSQLI_ASSOC);
    }



    public function datosGraficaCitasDoctor($inicio = null, $fin = null){
        $rows = $this->consultarCitasPorDoctor($inicio, $fin);

        $data = [];
        foreach ($rows as $r) {
            $data[] = [$r['doctor'], (int)$r['total']];
        }
        return $data;
    }




    public function generarGraficaCitasPorDoctor($inicio = null, $fin = null){
        $data = $this->datosGraficaCitasDoctor($inicio, $fin);
        if (empty($data)) {
            return null;
        }
        usort($data, function($a, $b){
            return $b[1] - $a[1];
        });
        $top = array_slice($data, 0, 5);
        $otrosTotal = array_sum(array_column(array_slice($data, 5), 1));
        if ($otrosTotal > 0) {
            $top[] = ["Otros doctores", $otrosTotal];
        }
        $data = $top;
        $plot = new PHPlot(900,600);
        $plot->SetImageBorderType('plain');
        $plot->SetPlotType('pie');
        $plot->SetDataType('text-data-single');
        $plot->SetDataValues($data);
        $plot->SetTitle('Citas por Doctor');
        $plot->SetDataColors(['#FF5733','#33FF57','#3357FF','#FF33A5','#FFC733','#8D33FF']);
        $plot->SetLegend(array_column($data,0));
        $filename = "Public/Media/graphs/grafica_citas_doctor.png";
        $plot->SetOutputFile($filename);
        $plot->SetIsInline(true);
        $plot->DrawGraph();
        return $filename;
    }

    public function generarGraficaGeneroPacientes() {
        $sql = "SELECT per.sexo, COUNT(*) AS total
                FROM pacientes pa
                INNER JOIN personas per ON pa.id_persona = per.id_persona
                GROUP BY per.sexo";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        $res = $stmt->get_result();
        $data = [];
        while ($row = $res->fetch_assoc()) {
            $data[] = [$row['sexo'], (int)$row['total']];
        }
        $filename = "Public/Media/graphs/grafica_genero_pacientes.png";
        $plot = new PHPlot(700, 700);
        $plot->SetImageBorderType('plain');
        $plot->SetMarginsPixels(10, 10, 10, 10);
        $plot->SetPlotType('pie');
        $plot->SetDataType('text-data-single');
        $plot->SetDataValues($data);
        $plot->SetTitle('Distribucion de Pacientes por Genero');
        $plot->SetLegend(array_column($data, 0));
        $plot->SetDataColors(['#3498db','#e74c3c','#9b59b6']);
        $plot->SetOutputFile($filename);
        $plot->SetIsInline(true);
        $plot->DrawGraph();
        return $filename;
    }

    public function generarGraficaGeneroDoctores() {
        $sql = "SELECT per.sexo, COUNT(*) AS total
                FROM doctores d
                INNER JOIN personas per ON d.id_persona = per.id_persona
                GROUP BY per.sexo";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        $res = $stmt->get_result();
        $data = [];
        while ($row = $res->fetch_assoc()) {
            $data[] = [$row['sexo'], (int)$row['total']];
        }
        $filename = "Public/Media/graphs/grafica_genero_doctores.png";
        $plot = new PHPlot(700, 700);
        $plot->SetImageBorderType('plain');
        $plot->SetMarginsPixels(10, 10, 10, 10);
        $plot->SetPlotType('pie');
        $plot->SetDataType('text-data-single');
        $plot->SetDataValues($data);
        $plot->SetTitle('Distribucion de Doctores por Genero');
        $plot->SetLegend(array_column($data, 0));
        $plot->SetDataColors(['#3498db', '#e74c3c', '#9b59b6']);
        $plot->SetOutputFile($filename);
        $plot->SetIsInline(true);
        $plot->DrawGraph();
        return $filename;
    }

    public function obtenerDatos($id_usuario){
        $sentencia = "SELECT
                pa.id_paciente,
                p.nombre,
                p.fecha_nacimiento,
                p.sexo,
                p.telefono,
                u.correo,
                p.direccion,
                pa.tipo_sangre
            FROM pacientes pa
            INNER JOIN personas p ON pa.id_persona = p.id_persona
            INNER JOIN usuarios u ON p.id_usuario = u.id_usuario
            WHERE u.id_usuario = ?";

        $statement = $this->connection->prepare($sentencia);
        $statement->bind_param("i", $id_usuario);
        $statement->execute();

        $result = $statement->get_result();
        return $result->fetch_assoc();
    }
    
    public function obtenerCitas($id_usuario){
        $sentencia = "
            SELECT 
                e.nombre AS especialidad,

                CONCAT(
                    CASE 
                        WHEN dper.sexo = 'Femenino' THEN 'Dra. '
                        WHEN dper.sexo = 'Masculino' THEN 'Dr. '
                        ELSE ''
                    END,
                    UPPER(LEFT(SUBSTRING_INDEX(dper.nombre, ' ', 1), 1)),
                    LOWER(SUBSTRING(SUBSTRING_INDEX(dper.nombre, ' ', 1), 2)),
                    ' ',
                    UPPER(LEFT(SUBSTRING_INDEX(dper.nombre, ' ', -1), 1)),
                    LOWER(SUBSTRING(SUBSTRING_INDEX(dper.nombre, ' ', -1), 2))
                ) AS doctor,

                c.fecha_cita,
                c.notas,
                c.diagnostico,
                c.receta

            FROM citas c
            INNER JOIN pacientes pa ON c.id_paciente = pa.id_paciente
            INNER JOIN personas p ON pa.id_persona = p.id_persona
            INNER JOIN usuarios u ON p.id_usuario = u.id_usuario

            INNER JOIN doctores d ON c.id_doctor = d.id_doctor
            INNER JOIN personas dper ON d.id_persona = dper.id_persona
            INNER JOIN especialidades e ON c.id_especialidad = e.id_especialidad

            WHERE u.id_usuario = ?
            ORDER BY c.fecha_cita DESC
        ";

        $statement = $this->connection->prepare($sentencia);
        $statement->bind_param("i", $id_usuario);
        $statement->execute();

        return $statement->get_result();
    }



    public function executeSqlFile($filepath){
        $templine = '';
        $lines = file($filepath);
        if (!$lines) {
            return "No se pudo leer el archivo";
        }
        foreach ($lines as $line) {
            if (substr(trim($line), 0, 2) == '--' || trim($line) == '') {
                continue;
            }
            $templine .= $line;
            if (substr(trim($line), -1) == ';') {
                if (strpos($templine, "INSERT INTO personas") !== false) {
                    $templine = preg_replace('/,"",/', ',NULL,', $templine);
                    $templine = preg_replace('/,""\)/', ',NULL)', $templine);
                }
                if (!$this->connection->query($templine)) {
                    return "Error ejecutando: " . $templine .
                        "\nMySQL dice: " . $this->connection->error;
                }
                $templine = '';
            }
        }

        return true;
    }













}

?>
