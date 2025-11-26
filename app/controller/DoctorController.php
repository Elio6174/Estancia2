<?php  
    include_once "app/model/LogicaDoctor.php";

    class DoctorController{

        private $logicaDoctor;

		public function __construct() {
			$this->logicaDoctor = new LogicaDoctor();
		}

        public function mostrarInicio($id){
            $datas = $this->logicaDoctor->DatosInicio($id);
            $nextDates = $this->logicaDoctor->nextDate($id);
            $estadisticasCitas = $this->logicaDoctor->estadisticasCitas($id);
            include "app/view/doctor/inicio/index.php";
        }

        public function seleccionarHorarios(){
            include "app/view/doctor/horarios/index2.php";
        }

        public function mostrarAgenda(){
            include "app/view/doctor/Agenda/index.php";
        }

        public function mostrarMiPerfil($id){
            $data = $this->logicaDoctor->getData($id);
            include "app/view/doctor/MiPerfil/index.php";
        }

        public function mostrarMisPacientes($id){
            $data = $this->logicaDoctor->obtenerMisPacientes($id);
            include "app/view/doctor/MisPacientes/index.php";
        }

        public function mostrarExpediente($id){
            $data = $this->logicaDoctor->obtenerDatos($id);
            $citas = $this->logicaDoctor->obtenerCitas($id);
            include "app/view/doctor/MisPacientes/expediente/index.php";
        }

        public function updateData($id_usuario, $nombre, $especialidad, $birthdate, $phone, $direccion, $consultorio, $cedulaProfesional, $sexo){
            echo $id_usuario .'<br>';
            echo $nombre .'<br>';
            echo $phone .'<br>';
            echo $birthdate .'<br>';
            echo $sexo .'<br>';
            echo $consultorio .'<br>';
            echo $cedulaProfesional .'<br>';
            echo $especialidad .'<br>';
            echo $direccion .'<br>';
            session_start();
            if($this->logicaDoctor->updateData($id_usuario, $nombre, $especialidad, $birthdate, $phone, $direccion, $consultorio, $cedulaProfesional, $sexo)){
                $_SESSION['code'] = 'success';
            }else{
                $_SESSION['code'] = 'Error';
            }
            header("Location: index.php?view=MiPerfil");
        }

        public function GetDays(){
			$data = $this->logicaDoctor->GetDays();
            header('Content-Type: application/json');
			echo json_encode($data);
			exit;
		}

        public function saveSchedule($id, $horarios){
            $contador = $this->logicaDoctor->saveSchedule($id, $horarios);
            header('Location: index.php?view=horarios');
		}


        public function availableSchedule($id){
            $data = $this->logicaDoctor->availableSchedule($id);
            header('Content-Type: application/json');
			echo json_encode($data);
			exit;
		}

        public function getSpecialties(){
            $data = $this->logicaDoctor->getSpecialties();
            header('Content-Type: application/json');
            echo json_encode($data);   
            exit;
        }

        public function getDisponibilidad($id, $dia){
            $data = $this->logicaDoctor->getDisponibilidad($id, $dia);
            header('Content-Type: application/json');
            echo json_encode($data);   
            exit;
        }

        public function getDoctorAppointmentsDates($id){
            $data = $this->logicaDoctor->getDoctorAppointmentsDates($id);
            header('Content-Type: application/json');
            echo json_encode($data);   
            exit;
        }

        public function completeCita(){
            if ($this->logicaDoctor->completeCita()) {
               echo json_encode(["success" => true]);
            } else {
                echo json_encode(["success" => false, "message" => "No se pudo actualizar la cita"]);
            }
        }

        public function getCitaById() {
            $cita = $this->logicaDoctor->getCitaById($id);
            if ($cita) {
                echo json_encode([
                    "success" => true,
                    "cita"    => $cita
                ]);
            } else {
                echo json_encode([
                    "success" => false,
                    "cita"    => null,
                    "message" => "Cita no encontrada"
                ]);
            }
        }


    }