<?php
require_once 'models/User.php';

class AuthController {
    private $userModel;

    public function __construct($db) {
        $this->userModel = new User($db);
    }

    public function register() {
        $error = null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];
            $cedula = $_POST['cedula'];
            $email = $_POST['email'];
            $pass = $_POST['password'];

            // Validación básica de campos vacíos
            if(empty($nombre) || empty($apellido) || empty($cedula) || empty($email) || empty($pass)){
                $error = "Todos los campos son obligatorios.";
            } else if ($this->userModel->cedulaExiste($cedula)) {
                $error = "La cédula ya está registrada.";
            } else {
                $this->userModel->registrar($nombre, $apellido, $cedula, $email, $pass);
                header("Location: index.php?action=login&success=1");
                exit();
            }
        }
        // Pasamos la variable $error a la vista
        require 'views/register.php';
    }

    public function login() {
        session_start();
        if (isset($_SESSION['user_id'])) {
            header("Location: index.php?action=dashboard");
            exit();
        }

        $error = null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $cedula = $_POST['cedula'];
            $password = $_POST['password'];

            if(empty($cedula) || empty($password)){
                $error = "Cédula y contraseña son obligatorias.";
            } else {
                $user = $this->userModel->buscarPorCedula($cedula);
                if ($user && password_verify($password, $user['password'])) {
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['user_name'] = $user['nombre'];
                    header("Location: index.php?action=dashboard");
                    exit();
                } else {
                    $error = "Cédula o contraseña incorrectas.";
                }
            }
        }
        require 'views/login.php';
    }

    public function dashboard() {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?action=login");
            exit();
        }
        require 'views/dashboard.php';
    }
}