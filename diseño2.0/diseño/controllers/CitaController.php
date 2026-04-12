<?php
// controllers/CitaController.php

require_once 'models/Cita.php';

if (!class_exists('CitaController')) {
    class CitaController {
        private $citaModel;

        public function __construct($db) {
            $this->citaModel = new Cita($db);
        }

        /**
         * Muestra el formulario de agendamiento.
         */
        public function agendar() {
            if (session_status() === PHP_SESSION_NONE) session_start();
            
            if (!isset($_SESSION['user_id'])) {
                header("Location: index.php?action=login");
                exit();
            }
            require 'views/agendar.php';
        }

        /**
         * Procesa el envío del formulario de reserva.
         */
        public function guardar_cita() {
            if (session_status() === PHP_SESSION_NONE) session_start();

            if (!isset($_SESSION['user_id'])) {
                header("Location: index.php?action=login");
                exit();
            }

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $id_usuario    = $_SESSION['user_id'];
                $id_disciplina = filter_input(INPUT_POST, 'entrenamiento', FILTER_SANITIZE_NUMBER_INT);
                $fecha         = $_POST['fecha'] ?? '';
                $bloque        = htmlspecialchars($_POST['hora'] ?? '');
                $notas         = htmlspecialchars($_POST['notas'] ?? '');

                if (empty($id_disciplina) || empty($fecha) || empty($bloque)) {
                    header("Location: index.php?action=agendar&error=empty_fields");
                    exit();
                }

                $exito = $this->citaModel->guardar($id_usuario, $id_disciplina, $fecha, $bloque, $notas);

                if ($exito) {
                    header("Location: index.php?action=gestionCitas&success=booked");
                    exit();
                } else {
                    header("Location: index.php?action=agendar&error=save_failed");
                    exit();
                }
            }
        }

        /**
         * Muestra el panel de gestión de citas.
         */
        public function gestionCitas() {
            if (session_status() === PHP_SESSION_NONE) session_start();
            
            if (!isset($_SESSION['user_id'])) {
                header("Location: index.php?action=login");
                exit();
            }

            // Usamos la sesión corregida en AuthController
            if (isset($_SESSION['user_rol']) && $_SESSION['user_rol'] === 'Administrador') {
                $citas = $this->citaModel->listarTodas();
            } else {
                $citas = $this->citaModel->listarPorUsuario($_SESSION['user_id']);
            }

            require 'views/gestion_citas.php';
        }
    }
}