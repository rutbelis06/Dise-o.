<?php
class Cita {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    /**
     * Guarda una nueva cita en la base de datos vinculando el usuario y la disciplina.
     */
    public function guardar($id_usuario, $id_disciplina, $fecha, $bloque, $notas) {
        $sql = "INSERT INTO citas (id_usuario, id_disciplina, fecha, bloque_horario, notas, id_estado_cita) 
                VALUES (?, ?, ?, ?, ?, 1)"; // 1 = Pendiente por defecto
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$id_usuario, $id_disciplina, $fecha, $bloque, $notas]);
    }

    /**
     * Obtiene las citas para el panel de gestión, incluyendo nombres de disciplinas y estados.
     */
    public function listarTodas() {
        $sql = "SELECT 
                    c.id, 
                    d.nombre as disciplina, 
                    c.fecha, 
                    c.bloque_horario as hora, 
                    e.nombre as estado,
                    CONCAT(u.nombre, ' ', u.apellido) as cliente
                FROM citas c
                JOIN categoria_disciplinas d ON c.id_disciplina = d.id
                JOIN categoria_estados_cita e ON c.id_estado_cita = e.id
                JOIN usuarios u ON c.id_usuario = u.id
                ORDER BY c.fecha DESC, c.bloque_horario ASC";
        
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Obtiene las citas específicas de un cliente logueado.
     */
    public function listarPorUsuario($id_usuario) {
        $sql = "SELECT 
                    c.id, d.nombre as disciplina, c.fecha, c.bloque_horario as hora, e.nombre as estado 
                FROM citas c
                JOIN categoria_disciplinas d ON c.id_disciplina = d.id
                JOIN categoria_estados_cita e ON c.id_estado_cita = e.id
                WHERE c.id_usuario = ?
                ORDER BY c.fecha DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id_usuario]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}