<?php
include_once '../model/LogicaSession.php';

class SessionController {
    private $session;
    
    public function __construct() {
        $this->session = new LogicaSession();
    }
    
    public function handleRequest() {
        // Determinar si es login o logout basado en los parámetros GET/POST
        if (isset($_GET['action'])) {
            $action = $_GET['action'];
            
            switch ($action) {
                case 'login':
                    $this->login();
                    break;
                case 'logout':
                    $this->logout();
                    break;
                default:
                    $this->showError("Acción no válida");
                    break;
            }
        } else if (isset($_POST['email']) && isset($_POST['password'])) {
            // Si vienen datos de login por POST, procesar login
            $this->login();
        } else {
            $this->showError("Solicitud no válida");
        }
    }
    
    private function login() {
        $email = $_POST['email'];
        $psw   = $_POST['password'];
        
        $SESSION_DATA = $this->session->login($email, $psw);
        
        if ($SESSION_DATA) {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            
            $_SESSION['id_usuario'] = $SESSION_DATA['id_usuario'];
            $_SESSION['user_name']  = $SESSION_DATA['nombre'];
            $_SESSION['email']      = $SESSION_DATA['correo'];
            $_SESSION['rol']        = $SESSION_DATA['rol'];
            
            // Redirecciones según rol
            $this->redirectByRole($SESSION_DATA['rol']);
            
        } else {
            echo "<script>alert('Correo o contraseña incorrectos');</script>";
            echo "<script>window.location.href = '../../index.php';</script>";
        }
    }
    
    private function logout() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        // Destruir todas las variables de sesión
        $_SESSION = array();
        
        // Destruir la sesión
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }
        
        session_destroy();
        
        // Redirigir al login
        header("Location: ../../index.php");
        exit();
    }
    
    private function redirectByRole($rol) {
        switch ($rol) {
            case "administrador":
                header("Location: ../view/dashboard.php");
                break;
            case "doctor":
                header("Location: ../view/dashboard.php");
                break;
            case "paciente":
                header("Location: ../view/dashboard.php");
                break;
            default:
                header("Location: ../index.php");
                break;
        }
        exit();
    }
    
    private function showError($message) {
        echo "<script>alert('$message');</script>";
        echo "<script>window.location.href = '../../index.php';</script>";
    }
}

// Uso de la clase
$controller = new SessionController();
$controller->handleRequest();
?>