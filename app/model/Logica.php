<?php
    include_once "config/Connection.php";

    class Logica{
        private $connection;

        public function __construct(){
			$this->connection = getConnection();
		}

        public function uploadImage(){
            $target_dir = "uploads/usuarios/";

            if (!is_dir($target_dir)) {
                mkdir($target_dir, 0777, true);
            }
            $nombreArchivo = uniqid() . "_" . basename($_FILES["imagen"]["name"]);
            $target_file = $target_dir . $nombreArchivo;
            if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $target_file)) {
                $url = "http://else.mx/" . $target_file;


                if ($this->setImage($url)) {
                    $_SESSION['foto_url'] = $url;
                    echo json_encode([
                        "status" => "ok",
                        "url" => $url
                    ]);
                } else {
                    echo json_encode([
                        "status" => "error",
                        "error" => "No se pudo guardar la URL en la base de datos."
                    ]);
                }

            } else {
                http_response_code(500);
                echo json_encode(["error" => "Error al subir la imagen."]);
            }
        }   

        public function setImage($url){
            session_start();
            $setencia = "UPDATE usuarios SET foto_url = ? WHERE id_usuario = ?";
            $statement = $this->connection->prepare($setencia);
            if (!$statement) {
                return false;
            }
            $statement->bind_param("si", $url, $_SESSION['id_usuario']);
            return $statement->execute();
        }

        public function validarInicio($correo, $pass){
			$sentencia = "select u.id_usuario, u.contrasena, u.foto_url, u.rol, SUBSTRING_INDEX(p.nombre, ' ', 1) 
				AS nombre FROM usuarios u INNER JOIN personas p ON u.id_usuario = p.id_usuario WHERE u.correo = ? LIMIT 1";
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
						'rol' => $user['rol'],
						'foto_url' => $user['foto_url']
					];
				} else {
					return null;
				}
			} else {
				return null;
			}
		}

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
			$sentencia_persona = "insert INTO personas (id_usuario, nombre, telefono, fecha_nacimiento, 
			sexo, direccion) VALUES (?, ?, ?, NULL, NULL, NULL)";
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

    }