<?php
class User {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    /**
     * Verifica si la cédula ya está registrada en la base de datos.
     */
    public function cedulaExiste($cedula) {
        $stmt = $this->db->prepare("SELECT id FROM usuarios WHERE cedula = ?");
        $stmt->execute([$cedula]);
        return $stmt->fetch();
    }

    /**
     * Verifica si el correo electrónico ya está registrado.
     * Este método es necesario para que el AuthController funcione correctamente.
     */
    public function emailExiste($email) {
        $stmt = $this->db->prepare("SELECT id FROM usuarios WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch();
    }

    /**
     * Registra un nuevo usuario con los campos requeridos.
     */
    public function registrar($nombre, $apellido, $cedula, $email, $password) {
        $hash = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $this->db->prepare("INSERT INTO usuarios (nombre, apellido, cedula, email, password) VALUES (?, ?, ?, ?, ?)");
        return $stmt->execute([$nombre, $apellido, $cedula, $email, $hash]);
    }

    /**
     * Busca un usuario por su cédula para el proceso de inicio de sesión.
     */
    public function buscarPorCedula($cedula) {
        $stmt = $this->db->prepare("SELECT * FROM usuarios WHERE cedula = ?");
        $stmt->execute([$cedula]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}