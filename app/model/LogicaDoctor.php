<?php
    include_once "config/Connection.php";

    class LogicaDoctor{
        private $connection;

        //Constructor de variable de coneccion con la base de datos
        public function __construct() {
            $this->connection = getConnection();
        }


        //No recibe nada
        //Obtiene los registrados en la base de datos EJEMPLO: LUN, MAR, MIE
        //Devuelve un vector con los datos
        public function GetDays(){
			$sentencia = "select id_dia, nombre from dias";
			$statement = $this->connection->prepare($sentencia);
			$statement->execute();
			$result = $statement->get_result();
			$slots = $result->fetch_all(MYSQLI_ASSOC);
			return $slots;
		}

        
        //Recibe id, y un vector con los horariso a ingresar
        //Obtiene respuesta de la consulta despues de hacer las insersiones en la base de datos
        //Devuelve false o true segun la respuesta de la insersion
        //Inserta en la base de datos las horas de disponibilidad seleccionadas por el doctor
        public function saveSchedule($id, $horarios){
            $id_doctor = $this->getDoctorIdByUserId($id);
            $update = $this->connection->prepare("
                UPDATE disponibilidad
                SET activo = 0
                WHERE id_doctor = ?
            ");
            $update->bind_param("i", $id_doctor);
            $update->execute();
            $update->close();
            $select = $this->connection->prepare("
                SELECT id_disponibilidad 
                FROM disponibilidad 
                WHERE id_doctor = ? AND id_dia = ? AND id_hora = ?
            ");
            $updateActive = $this->connection->prepare("
                UPDATE disponibilidad 
                SET activo = 1
                WHERE id_disponibilidad = ?
            ");
            $insert = $this->connection->prepare("
                INSERT INTO disponibilidad (id_doctor, id_dia, id_hora, activo)
                VALUES (?, ?, ?, 1)
            ");
            $contador = 0;
            foreach ($horarios as $id_dia => $horas) {
                if (!is_array($horas)) continue;

                foreach ($horas as $id_hora) {
                    $select->bind_param("iii", $id_doctor, $id_dia, $id_hora);
                    $select->execute();
                    $result = $select->get_result();
                    if ($row = $result->fetch_assoc()) {
                        $id_disp = $row['id_disponibilidad'];
                        $updateActive->bind_param("i", $id_disp);
                        $updateActive->execute();
                    } else {
                        $insert->bind_param("iii", $id_doctor, $id_dia, $id_hora);
                        $insert->execute();
                    }
                    $contador++;
                }
            }
            return $contador;
        }


        //Obtiene el id del doctor segun el id del usuario
        //Recibe id de usuario
        //Devuelve id de doctor
        //Ya que el sistema guarda al momento de inisiar sesion
        //el id de usuario este metodo consulta el id de doctor 
        //para hacer inserciones y operaciones con el id
        public function getDoctorIdByUserId($id_usuario) {
            $query = "SELECT d.id_doctor FROM doctores d INNER JOIN personas p ON p.id_persona = d.id_persona WHERE p.id_usuario = ?";
            $stmt = $this->connection->prepare($query);
            $stmt->bind_param("i", $id_usuario);
            $stmt->execute();
            $result = $stmt->get_result();
            $id_doctor = null;
            if ($row = $result->fetch_assoc()) {
                $id_doctor = $row['id_doctor'];
            }
            $stmt->close();
            return $id_doctor;
        }


        //Recibe id de la sesion
        //Obtiene la informacion de la disponibilidad del doctor
        //Devuelve informacion de la consulta
        //Este metodo se usa para obtener la informacion de disponibilidad del doctor por dia
        public function availableSchedule($id){
            $id_doctor = $this->getDoctorIdByUserId($id);
            $sentencia = "SELECT id_dia, GROUP_CONCAT(id_hora ORDER BY id_hora ASC) AS 
                horas_ids FROM disponibilidad WHERE activo = 1 AND id_doctor = ? GROUP BY id_dia ";
			$statement = $this->connection->prepare($sentencia);
            $statement->bind_param("i", $id_doctor);
			$statement->execute();
			$result = $statement->get_result();
			$slots = $result->fetch_all(MYSQLI_ASSOC);
			return $slots;
		}


        //No recibe nada
        //Obtiene las especialidades de la tabla especialidad de la base de datos
        //Devuelve la informacion de la consulta
        public function getSpecialties(){
            $sentencia = "SELECT id_especialidad, nombre FROM especialidades";
            $statement = $this->connection->prepare($sentencia);        
            $statement->execute();
            $result = $statement->get_result();
            $specialties = $result->fetch_all(MYSQLI_ASSOC);
            return $specialties;
        }


        //Recibe id de la sesion
        //Obtiene informacion del doctor, correo, nombre, telefono, fecha de
        //nacimiento, especialidad, genero, direccion, cedula profecional
        //Devuelve la informacion obtenida de la consulta
        public function getData($id){
            $sentencia = "SELECT u.correo, p.nombre, p.telefono, p.fecha_nacimiento, 
                p.sexo, p.direccion, d.cedula_profesional, d.consultorio, e.nombre 
                AS especialidad, e.id_especialidad FROM usuarios AS u INNER JOIN 
                personas AS p ON p.id_usuario = u.id_usuario INNER JOIN doctores 
                AS d ON d.id_persona = p.id_persona INNER JOIN especialidades 
                AS e ON e.id_especialidad = d.id_especialidad
                WHERE u.id_usuario = ?";
            $statement = $this->connection->prepare($sentencia);
            $statement->bind_param("i", $id);
            $statement->execute();
            $result = $statement->get_result();
            $data = $result->fetch_assoc();
            return $data;
        }


        //Recibe id de usuario, nombre, especialidad, fecha de nacimiento, telefono, direccion, consultorio, cedula y genero
        //Obtiene estado de la actualizacion
        //Devuelve estado de la consulta
        //Este metodo es el encargado de actualizar en la base de datos los datos del doctor
        public function updateData($id_usuario, $nombre, $especialidad, $birthdate, $phone, $direccion, $consultorio, $cedulaProfesional, $sexo){
			$sentencia = "UPDATE usuarios INNER JOIN personas ON personas.id_usuario = usuarios.id_usuario INNER JOIN doctores ON 
                doctores.id_persona = personas.id_persona SET personas.nombre = ?, personas.telefono = ?, personas.fecha_nacimiento = ?, 
                personas.sexo = ?, personas.direccion = ?, doctores.consultorio = ?, doctores.cedula_profesional = ?, 
                doctores.id_especialidad = ? WHERE usuarios.id_usuario = ?";
			$statement = $this->connection->prepare($sentencia);
            $nombre = !empty($nombre) ? $nombre : null;
            $phone = !empty($phone) ? $phone : null;
            $birthdate = !empty($birthdate) ? $birthdate : null;
            $sexo = !empty($sexo) ? $sexo : null;
            $direccion = !empty($direccion) ? $direccion : null;
            $consultorio = !empty($consultorio) ? $consultorio : null;
            $cedulaProfesional = !empty($cedulaProfesional) ? $cedulaProfesional : null;
            $especialidad = !empty($especialidad) ? $especialidad : null;

            $statement->bind_param("sssssssii", 
                $nombre, 
                $phone, 
                $birthdate, 
                $sexo, 
                $direccion, 
                $consultorio,
                $cedulaProfesional,
                $especialidad,
                $id_usuario
            );

            if ($statement->execute()) {
				$resultado = true;
			} else {
				$resultado = false;
			}
			$statement->close();
			return $resultado;
		}


        //Recibe id de sesion
        //Obtiene datos de citas para el dia actual limitando a 3 registros
        //Devuelve la informacion de los datos obtenidos
        //Este metodo es el responsable de mostrar la informacion de las citas del dia en la interfaz de inicio de doctor
        public function DatosInicio($id){
            $sentencia = "SELECT c.id_cita, c.fecha_cita, c.estado, e.nombre AS especialidad, CONCAT(
                UPPER(LEFT(SUBSTRING_INDEX(p.nombre, ' ', 1), 1)), LOWER(SUBSTRING(SUBSTRING_INDEX(p.nombre, ' ', 1), 2)), ' ', 
                UPPER(LEFT(SUBSTRING_INDEX(p.nombre, ' ', -1), 1)), LOWER(SUBSTRING(SUBSTRING_INDEX(p.nombre, ' ', -1), 2))) 
                AS nombre_paciente, p.telefono AS telefono_paciente, DATE_FORMAT(h.hora, '%h:%i %p') AS hora,
                d.nombre AS dia FROM citas c INNER JOIN pacientes pa ON c.id_paciente = pa.id_paciente
                INNER JOIN personas p ON pa.id_persona = p.id_persona INNER JOIN usuarios u ON p.id_usuario = u.id_usuario
                INNER JOIN especialidades e ON c.id_especialidad = e.id_especialidad INNER JOIN doctores doc ON c.id_doctor = doc.id_doctor
                INNER JOIN disponibilidad dis ON c.id_disponibilidad = dis.id_disponibilidad INNER JOIN horas h ON dis.id_hora = h.id_hora
                INNER JOIN dias d ON dis.id_dia = d.id_dia WHERE c.id_doctor = ? AND c.fecha_cita = CURDATE()
                ORDER BY h.hora ASC LIMIT 3";            
            $statement = $this->connection->prepare($sentencia);
            $statement->bind_param("i", $this->getDoctorIdByUserId($id));
            $statement->execute();
            $result = $statement->get_result();   
            return $result;
        }


        //Recibe id de usuario
        //Obtiene informacion de las citas proximas limitandolas a 5 registros
        //Devuelve la informacion de la consutla
        public function nextDate($id){
            $sentencia = "SELECT c.id_cita, CASE WHEN c.fecha_cita = CURDATE() + INTERVAL 1 DAY THEN 'Mañana'
                ELSE DATE_FORMAT(c.fecha_cita, '%d/%m/%Y') END AS fecha_cita, c.estado, e.nombre AS especialidad,
                CONCAT(UPPER(LEFT(SUBSTRING_INDEX(p.nombre, ' ', 1), 1)), LOWER(SUBSTRING(SUBSTRING_INDEX(p.nombre, ' ', 1), 2)),' ',
                UPPER(LEFT(SUBSTRING_INDEX(p.nombre, ' ', -1), 1)),LOWER(SUBSTRING(SUBSTRING_INDEX(p.nombre, ' ', -1), 2))) 
                AS nombre_paciente,p.telefono AS telefono_paciente,u.foto_url AS foto_url,DATE_FORMAT(h.hora, '%h:%i %p') AS hora,
                d.nombre AS dia FROM citas c INNER JOIN pacientes pa ON c.id_paciente = pa.id_paciente
                INNER JOIN personas p ON pa.id_persona = p.id_persona INNER JOIN usuarios u ON p.id_usuario = u.id_usuario
                INNER JOIN especialidades e ON c.id_especialidad = e.id_especialidad INNER JOIN doctores doc ON c.id_doctor = doc.id_doctor
                INNER JOIN disponibilidad dis ON c.id_disponibilidad = dis.id_disponibilidad INNER JOIN horas h ON dis.id_hora = h.id_hora
                INNER JOIN dias d ON dis.id_dia = d.id_dia WHERE c.id_doctor = ? AND c.fecha_cita > CURDATE()
                ORDER BY c.fecha_cita ASC, h.hora ASC LIMIT 5";
            $statement = $this->connection->prepare($sentencia);
            $statement->bind_param("i", $this->getDoctorIdByUserId($id));
            $statement->execute();
            $result = $statement->get_result();   
                     
            return $result;
        }


        //Recibe id del usuario
        //Obtiene la suma de citas para el dia actual
        //Devuelve la inforamcion de la cantidad de citas
        public function estadisticasCitas($id){
            $sentencia = "SELECT SUM(CASE WHEN c.fecha_cita = CURDATE() + INTERVAL 1 DAY THEN 1 ELSE 0 END) AS citas_manana, COUNT(*) AS total_citas
                FROM citas c INNER JOIN doctores doc ON c.id_doctor = doc.id_doctor WHERE c.id_doctor = ? AND c.fecha_cita > CURDATE()";
            $statement = $this->connection->prepare($sentencia);
            $statement->bind_param("i", $this->getDoctorIdByUserId($id));
            $statement->execute();
            $result = $statement->get_result();   
            $datas = $result->fetch_assoc();
            return $datas;

        }


        //Recibe id del usuario
        //Obtiene informacion de lso pacientes agregando un formato de Nombre Apellido para los nombres
        //Devuelve la informacion de los pacientes
        public function obtenerMisPacientes($id){
            $sentencia = "SELECT p.id_paciente, CONCAT(UPPER(LEFT(SUBSTRING_INDEX(pper.nombre, ' ', 1), 1)),
                LOWER(SUBSTRING(SUBSTRING_INDEX(pper.nombre, ' ', 1), 2)),' ',UPPER(LEFT(CASE 
                WHEN pper.nombre LIKE '% % %' THEN TRIM(SUBSTRING_INDEX(SUBSTRING_INDEX(pper.nombre, ' ', -2), ' ', 1))
                ELSE TRIM(SUBSTRING_INDEX(pper.nombre, ' ', -1)) END, 1)), LOWER(SUBSTRING(CASE 
                WHEN pper.nombre LIKE '% % %' THEN TRIM(SUBSTRING_INDEX(SUBSTRING_INDEX(pper.nombre, ' ', -2), ' ', 1))
                ELSE TRIM(SUBSTRING_INDEX(pper.nombre, ' ', -1))END, 2))) AS nombreApellido, CASE 
                WHEN pper.sexo = 'Masculino' THEN 'Hombre' WHEN pper.sexo = 'Femenino' THEN 'Mujer' ELSE 'No especificado'
                END AS genero, TIMESTAMPDIFF(YEAR, pper.fecha_nacimiento, CURDATE()) AS edad, MAX(c.estado) AS estado_cita,
                u.foto_url FROM citas c INNER JOIN pacientes p ON c.id_paciente = p.id_paciente
                INNER JOIN personas pper ON p.id_persona = pper.id_persona INNER JOIN usuarios u ON pper.id_usuario = u.id_usuario
                WHERE c.id_doctor = ? GROUP BY p.id_paciente, pper.nombre, pper.sexo, pper.fecha_nacimiento, u.foto_url
                ORDER BY pper.nombre ASC";
            $statement = $this->connection->prepare($sentencia);
            $statement->bind_param("i", $this->getDoctorIdByUserId($id));
            $statement->execute();
            $result = $statement->get_result();   
            return $result;
        }

        
        //
        public function getDisponibilidad($id, $dia){
            $sentencia = "SELECT d.id_disponibilidad, DATE_FORMAT(h.hora, '%h:%i %p') AS hora_formateada 
                FROM disponibilidad d INNER JOIN horas h ON d.id_hora = h.id_hora
                INNER JOIN dias di ON d.id_dia = di.id_dia WHERE d.id_doctor = ?
                AND d.id_dia = ? AND d.activo = 1 ORDER BY h.hora ASC";
            $statement = $this->connection->prepare($sentencia); 
            $statement->bind_param("ii", $this->getDoctorIdByUserId($id), $dia);       
            $statement->execute();
            $result = $statement->get_result();
            $specialties = $result->fetch_all(MYSQLI_ASSOC);
            return $specialties;

        }


        //Recibe id de paciente 
        //Obtiene informacion del paciente, nombre, fecha de nacimiento,
        //correo, genero, telefono, direccion y tipo de sangre
        //Devuelve la informacion del paciente
        public function obtenerDatos($id){
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
            WHERE pa.id_paciente = ?";
            $statement = $this->connection->prepare($sentencia);
            $statement->bind_param("i", $id);
            $statement->execute();
            $result = $statement->get_result();   
            $datas = $result->fetch_assoc();
            return $datas;
        }


        //Recibe id del paciente
        //Obtiene todas las cita del paciente
        //Devuelve la informacion de las citas del paciente
        public function obtenerCitas($id){
            $sentencia = "SELECT e.nombre AS especialidad,CONCAT(CASE WHEN dper.sexo = 'Femenino' THEN 'Dra. '
                WHEN dper.sexo = 'Masculino' THEN 'Dr. ' ELSE '' END, UPPER(LEFT(SUBSTRING_INDEX(dper.nombre, ' ', 1), 1)),
                LOWER(SUBSTRING(SUBSTRING_INDEX(dper.nombre, ' ', 1), 2)),' ', UPPER(LEFT(SUBSTRING_INDEX(dper.nombre, ' ', -1), 1)),
                LOWER(SUBSTRING(SUBSTRING_INDEX(dper.nombre, ' ', -1), 2))) AS doctor, c.fecha_cita,c.notas, c.diagnostico,c.receta
                FROM citas c INNER JOIN doctores d ON c.id_doctor = d.id_doctor INNER JOIN personas dper ON d.id_persona = dper.id_persona
                INNER JOIN especialidades e ON c.id_especialidad = e.id_especialidad WHERE c.id_paciente = ? ORDER BY c.fecha_cita DESC ";

            $statement = $this->connection->prepare($sentencia);
            $statement->bind_param("i", $id);
            $statement->execute();
            $result = $statement->get_result(); 
            return $result;
        }


        //Recibe id de doctor
        //Obtiene los dias en los que el doctor tiene citas 
        //Devuelve la informacion de las fechas
        //Este metodo es el encargado de llenar la informacion de la interfaz de agenda del doctor
        public function getDoctorAppointmentsDates($id){
            $sentencia = "SELECT c.id_cita, c.fecha_cita AS fecha, DATE_FORMAT(h.hora, '%h:%i %p') AS hora, p.nombre AS nombre_completo,
                CONCAT(UPPER(LEFT(SUBSTRING_INDEX(p.nombre, ' ', 1), 1)), LOWER(SUBSTRING(SUBSTRING_INDEX(p.nombre, ' ', 1), 2)),' ',
                UPPER(LEFT(SUBSTRING_INDEX(SUBSTRING_INDEX(p.nombre, ' ', 3), ' ', -1), 1)),LOWER(SUBSTRING(
                SUBSTRING_INDEX(SUBSTRING_INDEX(p.nombre, ' ', 3), ' ', -1), 2))) AS paciente, u.foto_url AS foto,c.estado
                FROM citas c INNER JOIN disponibilidad d ON d.id_disponibilidad = c.id_disponibilidad
                INNER JOIN horas h ON h.id_hora = d.id_hora INNER JOIN pacientes pa ON pa.id_paciente = c.id_paciente
                INNER JOIN personas p ON p.id_persona = pa.id_persona INNER JOIN usuarios u ON u.id_usuario = p.id_usuario
                INNER JOIN especialidades e ON e.id_especialidad = c.id_especialidad WHERE c.id_doctor = ?
                ORDER BY c.fecha_cita, h.hora";
            $statement = $this->connection->prepare($sentencia); 
            $statement->bind_param("i", $this->getDoctorIdByUserId($id));       
            $statement->execute();
            $result = $statement->get_result();
            return $result->fetch_all(MYSQLI_ASSOC);
        }


        //Recibe a travez de un json id de la cita, notas, diagnostico y receta
        //Obtiene estado de la actualizacion de la cita 
        //Devuelve false o true dependiendo el estado de al consulta
        public function completeCita(){
            $data = json_decode(file_get_contents("php://input"), true);

            $id     = $data["id_cita"];
            $notas  = $data["notas"];
            $diag   = $data["diagnostico"];
            $receta = $data["receta"];

            $sentencia = "UPDATE citas SET notas = ?, diagnostico = ?, receta = ?, estado = 'realizada' WHERE id_cita = ?";
            $statement = $this->connection->prepare($sentencia);
            $statement->bind_param("sssi", $notas, $diag, $receta, $id);

            return $statement->execute();
        }


        //Recibe id de la cita 
        //Obtiene la informacion de la cita segun su id
        //Devuelve la informacion de la cita 
        public function getCitaById() {
            $id = $_POST['id_cita'];
            $sql = "SELECT c.id_cita,c.fecha_cita AS fecha,DATE_FORMAT(h.hora, '%h:%i %p') AS hora,CONCAT(
                UPPER(LEFT(SUBSTRING_INDEX(p.nombre, ' ', 1), 1)),LOWER(SUBSTRING(SUBSTRING_INDEX(p.nombre, ' ', 1), 2)),' ',
                UPPER(LEFT(SUBSTRING_INDEX(SUBSTRING_INDEX(p.nombre, ' ', 3), ' ', -1), 1)),LOWER(SUBSTRING(
                SUBSTRING_INDEX(SUBSTRING_INDEX(p.nombre, ' ', 3), ' ', -1), 2))) AS paciente,u.foto_url AS foto,c.estado,
                c.notas,c.diagnostico,c.receta FROM citas c INNER JOIN disponibilidad d ON d.id_disponibilidad = c.id_disponibilidad
                INNER JOIN horas h ON h.id_hora = d.id_hora INNER JOIN pacientes pa ON pa.id_paciente = c.id_paciente
                INNER JOIN personas p ON p.id_persona = pa.id_persona INNER JOIN usuarios u ON u.id_usuario = p.id_usuario
                INNER JOIN especialidades e ON e.id_especialidad = c.id_especialidad WHERE c.id_cita = ? LIMIT 1";
            $statement = $this->connection->prepare($sql);
            $statement->bind_param("i", $id);
            $statement->execute();

            $result = $statement->get_result();
            $cita = $result->fetch_assoc();
            return $cita;
        }
    }