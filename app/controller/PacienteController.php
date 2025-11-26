<?php
	include_once "app/model/LogicaPaciente.php";

    class PacienteController{
		private $logicaPaciente;

		public function __construct() {
			$this->logicaPaciente = new LogicaPaciente();
		}
		

		public function mostrarInicio($id){
			$data = $this->logicaPaciente->obtenerDatosInicioPaciente($id);
			$cita = $this->logicaPaciente->GetAppointments($id, true);
			include "app/view/paciente/inicio/index.php";
		}

		public function mostrarMiPerfilPaciente($id){
			$data = $this->logicaPaciente->obtenerDatosMiPerfilPaciente($id);
			include "app/view/paciente/MiPerfil/index.php";
		}

		public function mostrarAgendarCita(){
			include "app/view/paciente/AgendarCita/index.php";
		}

		public function mostrarMisCitasPaciente($id){
			$citas = $this->logicaPaciente->GetAppointments($id, false);
			$citasFinalizadas = $this->logicaPaciente->GetAppointmentsFinished($id);
			include "app/view/paciente/MisCitas/index.php";
		}

		public function mostrarNotificacionesPaciente(){
			include "app/view/paciente/Notificaciones/index2.html";
		}

		public function mostrarMensajesPaciente(){
			include "app/view/paciente/Mensajes/index.html";
		}

		public function inicioSesion(){
			include "app/view/formulario/InicioSesion/index.php";
		}

		public function MostrarRegistro(){
			include "app/view/formulario/Registro/index.php";
		}

		public function validarInicio($usuario, $pass){
			$row = $this->logicaPaciente->validarInicio($usuario, $pass);
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
				$_SESSION['id_usuario'] = $row['id_usuario'];
				$_SESSION['user_name'] = $row['nombre'];
				$_SESSION['rol'] = $row['rol'];
				header("Location: index.php?view=Inicio");
    			exit;
			}
		}

		public function RegistrarUsuario($name , $email, $phone, $password, $confirmPassword){
			try{
				session_start();
				if($this->logicaPaciente->RegistrarUsuario($name , $email, $phone, $password, $confirmPassword)){
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

		public function ActualizarDatosPaciente($idUser, $nombre, $phone, $birthdate, $sexo, $address, $bloodType){
			session_start();
			if($this->logicaPaciente->ActualizarDatosPaciente($idUser, $nombre, $phone, $birthdate, $sexo, $address, $bloodType)){
				$_SESSION['code'] = 'success';
			}else{
				$_SESSION['code'] = 'Error';
			}
			header("Location: index.php?view=MiPerfil");
		}

		public function getAvailableSlots($date){
			$horarios = $this->logicaPaciente->getAvailableSlots($date);
			header('Content-Type: application/json');
			echo json_encode($horarios);
			exit;
		}

		public function getAllHours(){
			$horas = $this->logicaPaciente->getAllHours();
			header('Content-Type: application/json');
			echo json_encode($horas);
			exit;
		}

		public function getAvailableSpecialties($day, $time){
			$especialidades = $this->logicaPaciente->getAvailableSpecialties($day, $time);
			header('Content-Type: application/json');
			echo json_encode($especialidades);
			exit;
		}

		public function getAvailableDoctors($dia, $hora, $especialidad){
			$doctores = $this->logicaPaciente->getAvailableDoctors($dia, $hora, $especialidad);
			header('Content-Type: application/json');
			echo json_encode($doctores);
			exit;
		}


		public function CreateAppointment($id_usuario, $doctor, $especialidad, $fecha, $hora){
			if($this->logicaPaciente->CreateAppointment($id_usuario, $doctor, $especialidad, $fecha, $hora)){
				header("Location: index.php?view=MisCitas");
			}
		}

		public function GetAppointment($id){
			$data = $this->logicaPaciente->GetAppointments($id);
			include "app/view/paciente/MisCitas/index.php";
		}

		public function logout(){
			session_start();
			session_unset(); 
			session_destroy(); 

			header("Location: index.php");
			exit;
		}

		public function cancelarCita(){
			if($this->logicaPaciente->cancelarCita($_GET['idCita'])){
				header("Location: index.php?view=MisCitas");
			}
		}
	}

