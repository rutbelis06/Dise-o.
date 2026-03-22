<?php
require_once 'config/Database.php';
require_once 'controllers/AuthController.php';

$database = new Database();
$db = $database->getConnection();
$auth = new AuthController($db);

// Enrutamiento simple
$action = $_GET['action'] ?? 'login';

switch ($action) {
    case 'register':
        $auth->register();
        break;
    case 'login':
        $auth->login();
        break;
    case 'dashboard':
        $auth->dashboard();
        break;
    case 'logout':
        session_start();
        session_destroy();
        header("Location: index.php?action=login");
        break;
    default:
        $auth->login();
        break;
}