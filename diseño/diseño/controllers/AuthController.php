<?php
require_once 'models/User.php';
require_once 'helpers/Validator.php'; 

class AuthController {
    private $userModel;

    public function __construct($db) {
        $this->userModel = new User($db);
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre   = $_POST['nombre'] ?? '';
            $apellido = $_POST['apellido'] ?? '';
            $cedula   = $_POST['cedula'] ?? '';
            $email    = $_POST['email'] ?? '';
            $pass     = $_POST['password'] ?? '';

            
            if (!preg_match('/^[\p{L} ]+$/u', $nombre) || !preg_match('/^[\p{L} ]+$/u', $apellido)) {
                header("Location: index.php?action=register&error=invalid_name");
                exit();
            }

            if (!preg_match('/^[VE][0-9]+$/', $cedula)) {
                header("Location: index.php?action=register&error=invalid_cedula");
                exit();
            }

            if (!preg_match('/@(gmail\.com|hotmail\.com|outlook\.com|yahoo\.com)$/i', $email)) {
                header("Location: index.php?action=register&error=invalid_email_domain");
                exit();
            }

            if (!preg_match('/^(?=.*[A-Z])(?=.*[0-9]).{8,}$/', $pass)) {
                header("Location: index.php?action=register&error=weak_password");
                exit();
            }

            // VALIDACIÓN DE DUPLICADOS EN BASE DE DATOS 
            if ($this->userModel->cedulaExiste($cedula)) {
                header("Location: index.php?action=register&error=cedula_exists");
                exit();
            }

            if ($this->userModel->emailExiste($email)) {
                header("Location: index.php?action=register&error=email_exists");
                exit();
            }

            $registroExitoso = $this->userModel->registrar($nombre, $apellido, $cedula, $email, $pass);

            if ($registroExitoso) {
                header("Location: index.php?action=login&success=registered");
            } else {
                header("Location: index.php?action=register&error=system_error");
            }
            exit();

        } else {
            require 'views/register.php';
        }
    }

public function login() {
    if (session_status() === PHP_SESSION_NONE) session_start();

    if (isset($_SESSION['user_id'])) {
        header("Location: index.php?action=dashboard");
        exit();
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $cedulaInput = $_POST['cedula'] ?? '';
        $passInput   = $_POST['password'] ?? '';

        $user = $this->userModel->buscarPorCedula($cedulaInput);
        
        if ($user && password_verify($passInput, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['nombre'];
            $_SESSION['user_apellido'] = $user['apellido'];
            
            header("Location: index.php?action=dashboard");
            exit();
        } else {

        header("Location: index.php?action=login&error=invalid_credentials");
            exit();
        }
    } else {
        require 'views/login.php';
    }
}

    public function dashboard() {
        if (session_status() === PHP_SESSION_NONE) session_start();
        
        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?action=login");
            exit();
        }
        require 'views/dashboard.php';
    }

    public function logout() {
        if (session_status() === PHP_SESSION_NONE) session_start();
        
        $_SESSION = array(); 
        session_destroy();
        
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }
        
        header("Location: index.php?action=login");
        exit();
    }
}