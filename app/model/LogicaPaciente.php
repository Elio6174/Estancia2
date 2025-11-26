<?php
	include_once "config/Connection.php";
	include_once "app/model/PasswordMismatchException.php";
	include_once "app/model/DuplicateEmailException.php";

	class LogicaPaciente{
		private $connection;

		public function __construct(){
			$this->connection = getConnection();
		}

		//*
	//hice un cambio le agregue un left join para que me permita el admin 
	public function validarInicio($correo, $pass){
    $sentencia = "select u.id_usuario, u.contrasena, u.rol, 
    SUBSTRING_INDEX(p.nombre, ' ', 1) AS nombre 
    FROM usuarios u 
    LEFT JOIN personas p ON u.id_usuario = p.id_usuario 
    WHERE u.correo = ? 
    LIMIT 1";

    $statement = $this->connection->prepare($sentencia);
    $statement->bind_param("s", $correo);
    $statement->execute();
    $result = $statement->get_result();
    
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($pass, $user['contrasena'])) {
            if (password_needs_rehash($user['contrasena'], PASSWORD_DEFAULT)) {
                $nuevoHash = password_hash($pass, PASSWORD_DEFAULT);
                $update = $this->connection->prepare("UPDATE usuarios SET contrasena = ? WHERE id_usuario = ?");
                $update->bind_param("si", $nuevoHash, $user['id_usuario']);
                $update->execute();
            }
            return [
                'id_usuario' => $user['id_usuario'],
                'nombre' => $user['nombre'],
                'rol' => $user['rol']
            ];
        } else {
            return null;
        }
    } else {
        return null;
    }
}

		//*
		public function obtenerDatosInicioPaciente($id){
			$sentencia = "SELECT IF(per.telefono IS NOT NULL AND per.telefono <> '' AND per.fecha_nacimiento IS NOT NULL AND per.sexo IS NOT NULL AND per.sexo <> '' AND per.direccion IS NOT NULL AND per.direccion <> '' AND pac.tipo_sangre IS NOT NULL 
				AND pac.tipo_sangre <> '',1, 0) AS datos_completos FROM usuarios u INNER JOIN personas per ON u.id_usuario = per.id_usuario INNER JOIN pacientes pac ON per.id_persona = pac.id_persona WHERE u.id_usuario = ? LIMIT 1";
			$statement = $this->connection->prepare($sentencia);
			$statement->bind_param("i", $id);
			$statement->execute();
			$result = $statement->get_result();
			return $result->fetch_assoc();
		}

		//*
		public function obtenerDatosMiPerfilPaciente($id){
			$sentencia = "select pper.nombre,u.correo,pper.telefono,pper.fecha_nacimiento,pper.sexo,pper.direccion,pac.tipo_sangre FROM usuarios u INNER JOIN personas pper ON u.id_usuario = pper.id_usuario
				INNER JOIN pacientes pac ON pper.id_persona = pac.id_persona WHERE u.id_usuario = ? LIMIT 1";
			$statement = $this->connection->prepare($sentencia);
			$statement->bind_param("i", $id);
			$statement->execute();
			$result = $statement->get_result();
			return $result->fetch_assoc();
		}

		//funciones de registro de usuarios
		public function RegistrarUsuario($name , $email, $phone, $password, $confirmPassword){
			if($password !== $confirmPassword){
				throw new PasswordMismatchException();
			}elseif($this->ValidarCorreo($email) > 0){
				throw new DuplicateEmailException();
			}else{
				$sentencia = "insert into usuarios (correo, contrasena, rol) values (?,?,3)";
				$statement = $this->connection->prepare($sentencia);
				$statement->bind_param("ss", $email, password_hash($password, PASSWORD_DEFAULT));
				$statement->execute();
				if ($statement->affected_rows > 0) {
					return $this->InsertarPaciente($this->connection->insert_id, $name, $phone);
				} else {
					return false;
				}
				$statement->close();
			}
		}

		//*
		public function InsertarPaciente($id, $name, $phone){
			$sentencia_persona = "insert INTO personas (id_usuario, nombre, telefono, fecha_nacimiento, sexo, direccion) VALUES (?, ?, ?, NULL, NULL, NULL)";
			$statement = $this->connection->prepare($sentencia_persona);
			$statement->bind_param("iss", $id, $name, $phone);
			$statement->execute();
			if ($statement->affected_rows > 0) {
				$id_persona = $this->connection->insert_id;
				$sentencia_paciente = "insert INTO pacientes (id_persona, tipo_sangre) VALUES (?, NULL)";
				$statement2 = $this->connection->prepare($sentencia_paciente);
				$statement2->bind_param("i", $id_persona);
				$statement2->execute();
				if ($statement2->affected_rows > 0) {
					$statement2->close();
					$statement->close();
					return true;
				} else {
					$statement2->close();
					$statement->close();
					return false;
				}
			} else {
				$statement->close();
				return false;
			}
		}

		public function ValidarCorreo($correo){
			$sentencia = "select count(*) from usuarios where correo=?";
			$statement = $this->connection->prepare($sentencia);
			$statement->bind_param("s", $correo);
			$statement->execute();
			$statement->bind_result($count);
			$statement->fetch();
			$statement->close();
			return $count;
		}
		//*
		public function ActualizarDatosPaciente($id, $nombre, $phone, $birthdate, $sexo, $address, $bloodType){
			$sentencia = "UPDATE personas p INNER JOIN usuarios u ON p.id_usuario = u.id_usuario INNER JOIN pacientes pac ON p.id_persona = pac.id_persona SET p.nombre = ?,
				p.telefono = ?,p.fecha_nacimiento = ?,p.sexo = ?,p.direccion = ?,pac.tipo_sangre = ? WHERE u.id_usuario = ?";
			$statement = $this->connection->prepare($sentencia);
			$nombre = !empty($nombre) ? $nombre : null;
			$phone = !empty($phone) ? $phone : null;
			$birthdate = !empty($birthdate) ? $birthdate : null;
			$sexo = !empty($sexo) ? $sexo : null;
			$address = !empty($address) ? $address : null;
			$bloodType = !empty($bloodType) ? $bloodType : null;
			$statement->bind_param("ssssssi", $nombre, $phone, $birthdate, $sexo, $address, $bloodType, $id);
			if ($statement->execute()) {
				$resultado = true;
			} else {
				$resultado = false;
			}
			$statement->close();
			return $resultado;
		}

		//*
		public function getAvailableSlots($date){
			$sentencia = "select d.id_disponibilidad, TIME_FORMAT(h.hora, '%h:%i %p') AS hora FROM disponibilidad AS d INNER JOIN horas AS h ON d.id_hora = h.id_hora 
				INNER JOIN dias AS di ON d.id_dia = di.id_dia WHERE di.nombre = ? AND d.activo = 1 ORDER BY h.hora";
			$statement = $this->connection->prepare($sentencia);
			$statement->bind_param("s", $date);
			$statement->execute();
			$result = $statement->get_result();
			$slots = $result->fetch_all(MYSQLI_ASSOC);
			return $slots;
		}


		public function getAvailableSpecialties($day, $time) {
			$sentencia = "select DISTINCT d.id_especialidad, e.nombre AS especialidad FROM disponibilidad dis INNER JOIN horas h       
				ON dis.id_hora = h.id_hora INNER JOIN dias di ON dis.id_dia = di.id_dia INNER JOIN doctores d ON dis.id_doctor = d.id_doctor
				INNER JOIN especialidades e ON d.id_especialidad = e.id_especialidad WHERE di.nombre = ? AND h.hora = ?              
  				AND dis.activo = 1 ORDER BY e.nombre ASC";
			$statement = $this->connection->prepare($sentencia);
			$statement->bind_param("ss", $day, $time);
			$statement->execute();
			$result = $statement->get_result();
			return $result->fetch_all(MYSQLI_ASSOC);
		}

		public function getAllHours(){
			$sentencia = "select id_hora, TIME_FORMAT(hora, '%h:%i %p') as time from horas order by hora asc";
			$statement = $this->connection->prepare($sentencia);
			$statement->execute();
			$result = $statement->get_result();
			return $result->fetch_all(MYSQLI_ASSOC);
		}

		public function getAvailableDoctors($dia, $hora, $especialidad){
			$sentencia = "select d.id_doctor, CONCAT(CASE WHEN p.sexo = 'Femenino' THEN 'Dra ' WHEN p.sexo = 'Masculino' THEN 'Dr ' ELSE '' END, UPPER(LEFT(SUBSTRING_INDEX(p.nombre, ' ', 1), 1)), LOWER(SUBSTRING(SUBSTRING_INDEX(p.nombre, ' ', 1), 2)), ' ',
				UPPER(LEFT( CASE WHEN p.nombre LIKE '% % %' THEN TRIM(SUBSTRING_INDEX(SUBSTRING_INDEX(p.nombre, ' ', -2), ' ', 1)) ELSE TRIM(SUBSTRING_INDEX(p.nombre, ' ', -1)) END, 1)), LOWER(SUBSTRING( CASE WHEN p.nombre LIKE '% % %' THEN TRIM(SUBSTRING_INDEX(SUBSTRING_INDEX(p.nombre, ' ', -2), ' ', 1))
				ELSE TRIM(SUBSTRING_INDEX(p.nombre, ' ', -1)) END, 2))) AS nombre FROM disponibilidad AS dis INNER JOIN horas AS h ON dis.id_hora = h.id_hora INNER JOIN dias AS di ON dis.id_dia = di.id_dia INNER JOIN doctores AS d ON dis.id_doctor = d.id_doctor
				INNER JOIN personas AS p ON d.id_persona = p.id_persona INNER JOIN especialidades AS e ON d.id_especialidad = e.id_especialidad
				WHERE di.nombre = ? AND TIME_FORMAT(h.hora, '%h:%i %p') = ? AND e.id_especialidad = ? AND dis.activo = 1 ORDER BY nombre ASC";
			$statement = $this->connection->prepare($sentencia);
			$statement->bind_param("ssi", $dia, $hora, $especialidad);
			$statement->execute();
			$result = $statement->get_result();
			return $result->fetch_all(MYSQLI_ASSOC);
		}


		public function CreateAppointment($id_usuario, $doctor, $especialidad, $fecha, $id_disponibilidad) {
			$sentencia = "insert INTO citas (id_paciente, id_doctor, id_especialidad, fecha_cita, id_disponibilidad, estado)
    			VALUES (?, ?, ?, ?, ?, 'pendiente')";
			$statement = $this->connection->prepare($sentencia);
			$statement->bind_param("iiisi", $this->getIdPaciente($id_usuario), $doctor, $especialidad, $fecha, $id_disponibilidad);
			$statement->execute();
			$resultado = $statement->affected_rows > 0;
			$statement->close();
			return $resultado;
		}

		public function getIdPaciente($id){
			$sentencia = "
				SELECT p.id_paciente 
				FROM pacientes p 
				INNER JOIN personas pe ON p.id_persona = pe.id_persona 
				WHERE pe.id_usuario = ?
			";
			$statement = $this->connection->prepare($sentencia);
			if (!$statement) {
				return null;
			}
			$statement->bind_param("i", $id);
			$statement->execute();
			$resultado = $statement->get_result();
			$row = $resultado->fetch_assoc();
			$statement->close();
			return $row ? $row["id_paciente"] : null;
		}



		//*
		public function GetAppointments($id, $status){
	$sentencia = "
		SELECT 
    c.id_cita,
    DAY(c.fecha_cita) AS dia_cita,
    MONTHNAME(c.fecha_cita) AS mes_cita,
    e.nombre AS especialidad,
    CONCAT(
        CASE WHEN dper.sexo = 'Femenino' THEN 'Dra '
             WHEN dper.sexo = 'Masculino' THEN 'Dr '
             ELSE '' END,
        UPPER(LEFT(SUBSTRING_INDEX(dper.nombre, ' ', 1), 1)),
        LOWER(SUBSTRING(SUBSTRING_INDEX(dper.nombre, ' ', 1), 2)),
        ' ',
        UPPER(LEFT(
            CASE 
                WHEN dper.nombre LIKE '% % %' 
                    THEN TRIM(SUBSTRING_INDEX(SUBSTRING_INDEX(dper.nombre, ' ', -2), ' ', 1)) 
                ELSE TRIM(SUBSTRING_INDEX(dper.nombre, ' ', -1)) 
            END
        ,1)),
        LOWER(SUBSTRING(
            CASE 
                WHEN dper.nombre LIKE '% % %' 
                    THEN TRIM(SUBSTRING_INDEX(SUBSTRING_INDEX(dper.nombre, ' ', -2), ' ', 1)) 
                ELSE TRIM(SUBSTRING_INDEX(dper.nombre, ' ', -1)) 
            END
        ,2))
    ) AS nombre_doctor,
    TIME_FORMAT(h.hora, '%h:%i %p') AS hora_cita,
    SUBSTRING_INDEX(pper.nombre, ' ', 1) AS nombre_paciente

FROM citas c
INNER JOIN pacientes p ON c.id_paciente = p.id_paciente
INNER JOIN personas pper ON p.id_persona = pper.id_persona
INNER JOIN usuarios u ON pper.id_usuario = u.id_usuario
INNER JOIN doctores d ON c.id_doctor = d.id_doctor
INNER JOIN personas dper ON d.id_persona = dper.id_persona
INNER JOIN especialidades e ON c.id_especialidad = e.id_especialidad
INNER JOIN disponibilidad dis ON c.id_disponibilidad = dis.id_disponibilidad
INNER JOIN horas h ON dis.id_hora = h.id_hora
INNER JOIN dias di ON dis.id_dia = di.id_dia

WHERE u.id_usuario = ?
  AND (
        c.fecha_cita >= CURDATE()
        OR (
            c.fecha_cita = CURDATE()
            AND STR_TO_DATE(h.hora, '%h:%i %p') >= CURTIME()
        )
      )
  AND c.estado != 'cancelada'

ORDER BY c.fecha_cita ASC, h.hora ASC
	";

	if ($status) {
		$sentencia .= " LIMIT 1";
	}

	$statement = $this->connection->prepare($sentencia);
	$statement->bind_param("i", $id);
	$statement->execute();
	$result = $statement->get_result();

	if (!$status) {
		$citas = [];
		while ($fila = $result->fetch_assoc()) {
			$citas[] = $fila;
		}
		return $citas;
	} else {
		return $result->fetch_assoc();
	}
}


	public function GetAppointmentsFinished($id){
		$sentencia = "
SELECT 
    DAY(c.fecha_cita) AS dia_cita,
    MONTHNAME(c.fecha_cita) AS mes_cita,
    e.nombre AS especialidad,
    CONCAT(
        CASE WHEN dper.sexo = 'Femenino' THEN 'Dra '
             WHEN dper.sexo = 'Masculino' THEN 'Dr '
             ELSE '' END,
        UPPER(LEFT(SUBSTRING_INDEX(dper.nombre, ' ', 1), 1)),
        LOWER(SUBSTRING(SUBSTRING_INDEX(dper.nombre, ' ', 1), 2)),
        ' ',
        UPPER(LEFT(
            CASE WHEN dper.nombre LIKE '% % %'
                THEN TRIM(SUBSTRING_INDEX(SUBSTRING_INDEX(dper.nombre, ' ', -2), ' ', 1))
                ELSE TRIM(SUBSTRING_INDEX(dper.nombre, ' ', -1))
            END
        ,1)),
        LOWER(SUBSTRING(
            CASE WHEN dper.nombre LIKE '% % %'
                THEN TRIM(SUBSTRING_INDEX(SUBSTRING_INDEX(dper.nombre, ' ', -2), ' ', 1))
                ELSE TRIM(SUBSTRING_INDEX(dper.nombre, ' ', -1))
            END
        ,2))
    ) AS nombre_doctor,
    TIME_FORMAT(h.hora, '%h:%i %p') AS hora_cita

FROM citas c
INNER JOIN pacientes p ON c.id_paciente = p.id_paciente
INNER JOIN personas per ON p.id_persona = per.id_persona
INNER JOIN usuarios u ON per.id_usuario = u.id_usuario
INNER JOIN doctores d ON c.id_doctor = d.id_doctor
INNER JOIN personas dper ON d.id_persona = dper.id_persona
INNER JOIN especialidades e ON c.id_especialidad = e.id_especialidad
INNER JOIN disponibilidad db ON c.id_disponibilidad = db.id_disponibilidad
INNER JOIN horas h ON db.id_hora = h.id_hora

WHERE u.id_usuario = ?
    AND (
        c.fecha_cita < CURDATE()
        OR (
            c.fecha_cita = CURDATE()
            AND STR_TO_DATE(h.hora, '%h:%i %p') < CURTIME()
        )
    )

ORDER BY c.fecha_cita ASC, h.hora ASC;

		";

		$statement = $this->connection->prepare($sentencia);
		$statement->bind_param("i", $id);
		$statement->execute();
		$result = $statement->get_result();

		$citas = [];
		while ($fila = $result->fetch_assoc()) {
			$citas[] = $fila;
		}

		return $citas;
	}

	public function cancelarCita($idCita){
		$sql = "UPDATE citas SET estado = 'cancelada' WHERE id_cita = ?";
		$stmt = $this->connection->prepare($sql);
		$stmt->bind_param("i", $idCita);

		return $stmt->execute();
	}


	}

