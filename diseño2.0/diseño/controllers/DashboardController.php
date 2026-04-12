<?php

class DashboardController {
    private $db;

    public function __construct($db) {
        $this->db = $db;
        
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function index() {

        
        require 'views/dashboard.php';
    }

    
    public function agendar() {
        require 'views/agendar.php';
    }


    public function gestioncitas() {
        require 'views/gestion_citas.php';
    }

    public function clientes() {
        require 'views/clientes.php';
    }
}