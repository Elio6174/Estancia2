<?php
    include_once "app/controller/PacienteController.php";
	include_once "app/controller/DoctorController.php";
    include_once "app/controller/AdminController.php";
	include_once "app/controller/Control.php";
    
	session_start();
    //contrasena de usuarios masivos admin123
    $pacienteController = new PacienteController();
	$doctorController = new DoctorController();
    $adminController = new AdminController();
	$control = new Control();


	function allow($roles) {
		if (!isset($_SESSION['rol'])) return false;
		if (is_array($roles)) {
			return in_array($_SESSION['rol'], $roles);
		}
		return $_SESSION['rol'] === $roles;
	}

	if(isset($_GET['view']) && $_GET['view'] === 'Login'){
		$control->inicioSesion();
	}

	if(empty($_SESSION['id_usuario'])){
		if(isset($_GET['view'])){
			if($_GET['view'] == 'SingIn'){
				$control->MostrarRegistro();
			}else{
				header("Location: index.php?view=Login");
			}
		}elseif (isset($_GET['action'])){
			switch($_GET['action']){
				case 'loginIn': $control->validarInicio($_POST['email'], $_POST['password']); break;
				case 'SingIn': $control->RegistrarUsuario($_POST['nombre'], $_POST['email'], $_POST['phone'], $_POST['password'], $_POST['confirm-password']); break;
				default: 
					header("Location: index.php?view=Login"); 
					exit;
				break;
			}
		}else{
			header("Location: index.php?view=Login");
    	}
		exit;
	}else{
		if(isset($_GET['view'])){
			switch($_GET['view']){
				case 'Inicio': 
					switch($_SESSION['rol']){
						case 'paciente': $pacienteController->mostrarInicio($_SESSION['id_usuario']); break;
						case 'doctor': $doctorController->mostrarInicio($_SESSION['id_usuario']); break;
                        case 'administrador': $adminController->mostrarInicio($_SESSION['id_usuario']); break;
						default: 
							header("Location: index.php?view=Login"); 
							exit;
						break;
					}
				break;
				case 'MiPerfil': 
					switch($_SESSION['rol']){
						case 'paciente': $pacienteController->mostrarMiPerfilPaciente($_SESSION['id_usuario']); break;
						case 'doctor': $doctorController->mostrarMiPerfil($_SESSION['id_usuario']); break;
						default: 
							header("Location: index.php?view=Login"); 
							exit;
						break;
					}
				break;
				case 'Expediente': 
					switch($_SESSION['rol']){
						case 'doctor': $doctorController->mostrarExpediente($_GET['idPaciente']);  break;
						case 'administrador': $adminController->mostrarExpedientes($_GET['id']);   break;
						default: 
							header("Location: index.php?view=Login"); 
							exit;
						break;
					}
				break;


				//pacientes
				case 'AgendarCita': 
					if (!allow('paciente')) { header("Location: index.php?view=Login"); exit; }
					$pacienteController->mostrarAgendarCita(); 
				break;
				case 'MisCitas': 
					if (!allow('paciente')) { header("Location: index.php?view=Login"); exit; }
					$pacienteController->mostrarMisCitasPaciente($_SESSION['id_usuario']); 
				break;
				case 'Notificaciones': 
					if (!allow('paciente')) { header("Location: index.php?view=Login"); exit; }
					$pacienteController->mostrarNotificacionesPaciente(); 
				break;
				case 'Mensajes': 
					if (!allow('paciente')) { header("Location: index.php?view=Login"); exit; }
					$pacienteController->mostrarMensajesPaciente(); 
				break;


				//doctores
				case 'horarios': 
					if (!allow('doctor')) { header("Location: index.php?view=Login"); exit; }
					$doctorController->seleccionarHorarios(); 
				break;
				case 'Agenda': 
					if (!allow('doctor')) { header("Location: index.php?view=Login"); exit; }
					$doctorController->mostrarAgenda(); 
				break;
				case 'MisPacientes': 
					if (!allow('doctor')) { header("Location: index.php?view=Login"); exit; }
					$doctorController->mostrarMisPacientes($_SESSION['id_usuario']); 
				break;
			


                //adminstradores
                case 'Citas': 
					if (!allow('administrador')) { header("Location: index.php?view=Login"); exit; }
					$adminController->mostrarCitas(); 
				break;
                case 'Reportes': 
					if (!allow('administrador')) { header("Location: index.php?view=Login"); exit; }
					$adminController->mostrarReportes(); 
				break;
                case 'Usuarios': 
					if (!allow('administrador')) { header("Location: index.php?view=Login"); exit; }
					$adminController->mostrarUsuarios(); 
				break;

			}
		}elseif (isset($_GET['action'])){
			switch($_GET['action']){
				case 'UpdateData': 
					switch($_SESSION['rol']) {
						case 'paciente': $pacienteController->ActualizarDatosPaciente($_POST['idUser'], $_POST['nombre'], $_POST['phone'], $_POST['birthdate'], $_POST['sexo'], $_POST['address'], $_POST['bloodType']); break;
						case 'doctor': $doctorController->updateData($_POST['idUser'], $_POST['nombre'], $_POST['especialidad'], $_POST['birthdate'], $_POST['phone'], $_POST['address'], $_POST['consultorio'], $_POST['cedula'], $_POST['sexo']); break;
						default: 
							header("Location: index.php?view=Login"); 
							exit;
						break;
					}
				break;

				//bicondicional
				case 'getAllHours': 
					if (!in_array($_SESSION['rol'], ['paciente', 'doctor'])) {
						header("Location: index.php?view=Login");
						exit;
					}
					$pacienteController->getAllHours(); 
				break;
	

				case 'logout': $control->logout(); break;
				case 'uploadImage': $control->uploadImage(); break;


				//pacientes
				case 'getAvailableSlots': 
					if (!allow('paciente')) { header("Location: index.php?view=Login"); exit; }
					$pacienteController->getAvailableSlots($_GET['date'] ?? null); 
				break;
				case 'getAvailableSpecialties': 
					if (!allow('paciente')) { header("Location: index.php?view=Login"); exit; }
					$pacienteController->getAvailableSpecialties($_GET['date'], $_GET['time']); 
				break;
				case 'getAvailableDoctors': 
					if (!allow('paciente')) { header("Location: index.php?view=Login"); exit; }
					$pacienteController->getAvailableDoctors($_GET['date'], $_GET['time'], $_GET['specialty']); 
				break;
				case 'CreateAppointment': 
					if (!allow('paciente')) { header("Location: index.php?view=Login"); exit; }
					$pacienteController->CreateAppointment($_SESSION['id_usuario'], $_POST['doctor'], $_POST['especialidad'],$_POST['fecha'],$_POST['hora']); 
				break;
				case 'cancelarCita':
					if (!allow('paciente')) { header("Location: index.php?view=Login"); exit; }
					$pacienteController->cancelarCita(); 
				break;


				//doctores
				case 'getSpecialties': 
					if (!allow('doctor')) { header("Location: index.php?view=Login"); exit; }
					$doctorController->getSpecialties(); 
				break;
				case 'getDays': 
					if (!allow('doctor')) { header("Location: index.php?view=Login"); exit; }
					$doctorController->GetDays(); 
				break;
				case 'saveSchedule': 
					if (!allow('doctor')) { header("Location: index.php?view=Login"); exit; }
					$doctorController->saveSchedule($_SESSION['id_usuario'], $_POST['horarios']); 
				break;
				case 'availableSchedule': 
					if (!allow('doctor')) { header("Location: index.php?view=Login"); exit; }
					$doctorController->availableSchedule($_SESSION['id_usuario']); 
				break;
				case 'getDisponibilidad': 
					if (!allow('doctor')) { header("Location: index.php?view=Login"); exit; }
					$doctorController->getDisponibilidad($_SESSION['id_usuario'], $_GET['date']); 
				break;
				case 'getDoctorAppointmentsDates':
					if (!allow(['doctor'])) break;
					$doctorController->getDoctorAppointmentsDates($_SESSION['id_usuario']);
				break;
				case 'getCitaById':
					if (!allow(['doctor'])) break;
					$doctorController->getCitaById();
				break;
				case 'completeCita':
					if (!allow(['doctor'])) break;
					$doctorController->completeCita();
				break;

				

				//adminstradores
                case 'slidebar': 
					if (!allow('administrador')) { header("Location: index.php?view=Login"); exit; }
					$adminController->mostrarSlidebar(); 
				break;
                case 'deleteUser': 
					if (!allow('administrador')) { header("Location: index.php?view=Login"); exit; }
					$adminController->deleteUser(); 
				break;
				case 'getAppointmentsBySpecialty':
					if (!allow('administrador')) { header("Location: index.php?view=Login"); exit; }
					$adminController->getAppointmentsBySpecialty(); 
				break;
				case 'getAppointmentsByMonth':
					if (!allow('administrador')) { header("Location: index.php?view=Login"); exit; }
					$adminController->getAppointmentsByMonth(); 
				break;
				case 'getDoctors':
					if (!allow('administrador')) { header("Location: index.php?view=Login"); exit; }
					$adminController->getDoctors(); 
				break;
				case 'deleteAppointment':
					if (!allow('administrador')) { header("Location: index.php?view=Login"); exit; }
					$adminController->deleteAppointment($_GET['id']); 
				break;
				case 'updateUser':
					if (!allow('administrador')) { header("Location: index.php?view=Login"); exit; }
					$adminController->updateUser($_POST); 
				break;
				case 'appointmentsByMonth':
					if (!allow('administrador')) { header("Location: index.php?view=Login"); exit; }
					$adminController->appointmentsByMonth($_GET['estado']); 
				break;
				case 'backUp':
					if (!allow('administrador')) { header("Location: index.php?view=Login"); exit; }
					$adminController->backup_tables('*');
				break;
				case 'generarReporteCitas':
					if (!allow('administrador')) { header("Location: index.php?view=Login"); exit; }
					$adminController->generarReporteCitas();
				break;
				case 'uploadSqlScript':
					if (!allow('administrador')) { header("Location: index.php?view=Login"); exit; }
					$adminController->uploadSqlScript();
				break;
				case 'getAppointments':
					if (!allow('administrador')) { header("Location: index.php?view=Login"); exit; }

					$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
					$limit = isset($_GET['limit']) ? intval($_GET['limit']) : 5;
					$filters = [
						"paciente" => $_GET["paciente"] ?? "",
						"estado" => $_GET['estado'] ?? null,
						"doctor" => $_GET['doctor'] ?? null,
						"fecha"  => $_GET['fecha'] ?? null,
					];
					$adminController->getAppointments($page, $limit, $filters); 
				break;
				case "getUsers":
					$page = $_GET['page'] ?? 1;
					$limit = $_GET['limit'] ?? 5;
					$filters = [
						"nombre" => $_GET['nombre'] ?? "",
						"correo" => $_GET['correo'] ?? "",
						"rol"    => $_GET['rol'] ?? ""
					];
					$data = $adminController->getUsers($page, $limit, $filters);
				break;
			}
		}
	}