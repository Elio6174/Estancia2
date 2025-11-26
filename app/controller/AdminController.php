<?php
include_once "app/model/LogicaAdmin.php";

class AdminController {
    private $logicaAdmin;

    public function __construct() {
        $this->logicaAdmin = new LogicaAdmin();
    }

    public function mostrarInicio($id) {
        $totalPacienes = $this->logicaAdmin->countPacientes();
        include "app/view/admin/dashboard/index.php";
    }

    public function mostrarCitas() {
        include "app/view/admin/citas/index.php";
    }

    public function mostrarReportes(){
        include "app/view/admin/reportes/index.php";
    }

    public function mostrarUsuarios(){
        include "app/view/admin/usuarios/index.php";
    }

    public function mostrarExpedientes($id){
        $data = $this->logicaAdmin->obtenerDatos($id);
        $citas = $this->logicaAdmin->obtenerCitas($id);
        include "app/view/admin/expedientes/index.php";
    }

    public function deleteUser(){
        $data = $this->logicaAdmin->deleteUser();
        header('Content-Type: application/json');
        if ($data) {
            if ($data->affected_rows > 0) {
                echo json_encode([
                    "status" => "success",
                    "message" => "Usuario eliminado correctamente."
                ]);
            } else {
                echo json_encode([
                    "status" => "error",
                    "message" => "No existe un usuario con ese ID."
                ]);
            }
        }
        exit;
    }

    public function getAppointmentsBySpecialty(){
        $data = $this->logicaAdmin->getAppointmentsBySpecialty();
        header('Content-Type: application/json');
		echo json_encode($data);
		exit;
    }

    public function getAppointmentsByMonth(){
        $data = $this->logicaAdmin->getAppointmentsByMonth();
        header('Content-Type: application/json');
		echo json_encode($data);
		exit;
    }

    public function getAppointments($page, $limit, $filters){
        $data = $this->logicaAdmin->getAppointments($page, $limit, $filters);
        header('Content-Type: application/json');
		echo json_encode($data);
		exit;
    }

    public function getDoctors() {
        $data = $this->logicaAdmin->getDoctors();
        header('Content-Type: application/json');
		echo json_encode($data);
		exit;
    }

    public function deleteAppointment($id){
        $data = $this->logicaAdmin->deleteAppointment($id);
        header('Content-Type: application/json');
		echo json_encode($data);
		exit;
    }

    public function getUsers($page, $limit, $filters){
        $data = $this->logicaAdmin->getUsers($page, $limit, $filters);
        header('Content-Type: application/json');
		echo json_encode($data);
		exit;
    }


    public function updateUser($datos){
        $data = $this->logicaAdmin->updateUser($datos);
        header('Content-Type: application/json');
		echo json_encode($data);
		exit;
    }

    public function appointmentsByMonth($filtro){
        $data = $this->logicaAdmin->appointmentsByMonth($filtro);
        header('Content-Type: application/json');
		echo json_encode($data);
		exit;
    }

    public function backup_tables($tables){
        $this->logicaAdmin->backup_tables($tables);
    }

    public function uploadSqlScript(){
        if (!isset($_FILES["sql_file"])) {
            echo json_encode(["success" => false, "message" => "No se recibió archivo"]);
            exit;
        }
        $archivo = $_FILES["sql_file"]["tmp_name"];
        $nombre  = $_FILES["sql_file"]["name"];
        if (pathinfo($nombre, PATHINFO_EXTENSION) !== "sql") {
            echo json_encode(["success" => false, "message" => "Debe subir un archivo .sql"]);
            exit;
        }
        $resultado =  $this->logicaAdmin->executeSqlFile($archivo);

        if ($resultado === true) {
            echo json_encode(["success" => true, "message" => "Script ejecutado correctamente"]);
        } else {
            echo json_encode(["success" => false, "message" => $resultado]);
        }
        exit;

    }

    public function generarReporteCitas(){
        $inicio = $_POST['inicio'] ?? null;
        $fin    = $_POST['fin'] ?? null;
        $doctor = $_POST['doctor'] ?? "todos";
        $this->logicaAdmin->generarReporteCitas($inicio, $fin, $doctor);
    }
}
?>
