<?php
class Database {
    private $host = "localhost";
    private $db_name = "zeus";
    private $username = "root";
    private $password = ""; 
    public $conn;

    public function getConnection() {
        if ($this->conn === null) {
            try {
                $this->conn = new PDO("mysql:host=$this->host;dbname=$this->db_name", $this->username, $this->password);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->conn->exec("set names utf8");
            } catch(PDOException $e) {
                die("Error de conexión: " . $e->getMessage());
            }
        }
        return $this->conn;
    }
}