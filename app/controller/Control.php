<?php
    include_once "app/model/Logica.php";

	class Control{
        private $logica;

		public function __construct() {
			$this->logica = new Logica();
		}

        public function inicioSesion(){
			include "app/view/formulario/InicioSesion/index.php";
		}

		public function uploadImage(){
            $this->logica->uploadImage();
		}

        public function MostrarRegistro(){
			include "app/view/formulario/Registro/index.php";
		}

        public function validarInicio($usuario, $pass){
			$row = $this->logica->validarInicio($usuario, $pass);
			session_start();
			if($row === null){
				$_SESSION['error'] = [
					'code' => '500',
					'message' => 'Contrasena incorrecta'
				];
				$_SESSION['form_data'] = ['email' => $_POST['email'] ?? ''];
				header("Location: index.php");
				exit;
			}else{
				echo "se inicio sesion";
				$_SESSION['id_usuario'] = $row['id_usuario'];
				$_SESSION['user_name'] = $row['nombre'];
				$_SESSION['rol'] = $row['rol'];
				$_SESSION['foto_url'] = $row['foto_url'];
				header("Location: index.php?view=Inicio");
    			exit;
			}
		}

        public function RegistrarUsuario($name , $email, $phone, $password, $confirmPassword){
			try{
				session_start();
				if($this->logica->RegistrarUsuario($name , $email, $phone, $password, $confirmPassword)){
					$_SESSION['error'] = 'success';
					header("Location: index.php?view=SingIn");
    				exit;
				}else{
					$_SESSION['error'] = 'Error al crear la cuenta';
					header("Location: index.php?view=SingIn");
    				exit;
				}
				
			}catch (PasswordMismatchException | DuplicateEmailException $e) {
				$_SESSION['error'] = $e->getMessage();
				$_SESSION['form_data'] = $_POST;
				header("Location: index.php?view=SingIn");
    			exit;
			}
		}

        public function logout(){
			session_start();
			session_unset(); 
			session_destroy(); 

			header("Location: index.php");
			exit;
		}
	}