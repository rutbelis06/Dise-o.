<?php
// index.php
require_once 'config/Database.php';
require_once 'controllers/AuthController.php';
require_once 'controllers/DashboardController.php'; 
require_once 'controllers/CitaController.php'; // <--- NUEVO: Requerir el controlador de citas

$database = new Database();
$db = $database->getConnection();

// Instanciar controladores
$auth = new AuthController($db);
$dash = new DashboardController($db);
$cita = new CitaController($db); // <--- NUEVO: Instanciar controlador de citas

$action = $_GET['action'] ?? 'login';

switch ($action) {
    // --- Autenticación ---
    case 'login':
        $auth->login();
        break;
    case 'register':
        $auth->register();
        break;
    case 'logout':
        $auth->logout();
        break;

    // --- Dashboard Principal ---
    case 'dashboard':
        $dash->index(); 
        break;

    // --- Gestión de Clientes ---
    case 'clientes':
        $dash->clientes(); 
        break;

    // --- Módulo de Citas (Corregido) ---
    case 'agendar':
        // Ahora usamos el CitaController para mostrar el formulario
        $cita->agendar(); 
        break;

    case 'guardar_cita':
        // Esta es la ruta que procesa el formulario POST de agendar.php
        $cita->guardar_cita(); 
        break;

    case 'gestionCitas':
        // Ahora usamos el CitaController para listar las citas
        $cita->gestionCitas(); 
        break;

    // --- Ruta por defecto ---
    default:
        $auth->login();
        break;
}