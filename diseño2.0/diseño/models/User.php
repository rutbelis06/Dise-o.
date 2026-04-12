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
     */
    public function emailExiste($email) {
        $stmt = $this->db->prepare("SELECT id FROM usuarios WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch();
    }

    /**
     * Registra un nuevo usuario con los campos de auditoría y categorías.
     * Por defecto se asigna Membresía 1 (Ninguna) y Estado 1 (Activo).
     */
    public function registrar($nombre, $apellido, $cedula, $email, $password, $id_membresia = 1, $id_estado = 1) {
        $hash = password_hash($password, PASSWORD_BCRYPT);
        $sql = "INSERT INTO usuarios (nombre, apellido, cedula, email, password, id_membresia, id_estado_usuario) 
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            $nombre, 
            $apellido, 
            $cedula, 
            $email, 
            $hash, 
            $id_membresia, 
            $id_estado
        ]);
    }

    /**
     * Busca un usuario por su cédula e incluye los nombres de su membresía y estado.
     * Utiliza JOINs para cumplir con la normalización de la base de datos.
     */
    public function buscarPorCedula($cedula) {
        $sql = "SELECT 
                    u.*, 
                    m.nombre as membresia_nombre, 
                    e.nombre as estado_nombre 
                FROM usuarios u
                LEFT JOIN categoria_membresias m ON u.id_membresia = m.id
                LEFT JOIN categoria_estados_usuario e ON u.id_estado_usuario = e.id
                WHERE u.cedula = ?";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$cedula]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Obtiene todos los usuarios para el listado de clientes.
     */
    public function listarTodos() {
        $sql = "SELECT 
                    u.cedula, 
                    CONCAT(u.nombre, ' ', u.apellido) as nombre_completo, 
                    u.email, 
                    m.nombre as membresia, 
                    e.nombre as estado 
                FROM usuarios u
                LEFT JOIN categoria_membresias m ON u.id_membresia = m.id
                LEFT JOIN categoria_estados_usuario e ON u.id_estado_usuario = e.id
                ORDER BY u.created_at DESC";
        
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}