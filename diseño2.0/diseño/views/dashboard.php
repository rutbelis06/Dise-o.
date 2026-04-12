<?php
// Asegúrate de tener la sesión iniciada en tu index.php o incluirla aquí
// session_start(); 
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Zeus Gym</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/dashboard.css">
    <link rel="icon" type="image/x-icon" href="assets/img/logo.jpeg">
</head>
<body>

    <div class="sidebar">
        <div class="logo-container">
            <img src="assets/img/logo.jpeg" alt="Zeus Gym Logo">
        </div>
        
        <a href="index.php?action=dashboard" class="menu-item active">
            <i class="fas fa-chart-line"></i> <span>Inicio</span>
        </a>

        <a href="index.php?action=gestionCitas" class="menu-item">
            <i class="fas fa-tasks"></i> <span>Gestión de citas</span>
        </a>
        <a href="index.php?action=clientes" class="menu-item">
            <i class="fas fa-users"></i> <span>Clientes</span>
        </a>
        <a href="#" class="menu-item">
            <i class="fas fa-dumbbell"></i> <span>Entrenamientos</span>
        </a>
        <a href="#" class="menu-item">
            <i class="fas fa-calendar-alt"></i> <span>Horarios</span>
        </a>
        <a href="#" class="menu-item">
            <i class="fas fa-user-cog"></i> <span>Mi perfil</span>
        </a>
    </div>

    <div class="main-content">
        <div class="header-dash">
            <div>
                <h1>Panel de Control</h1>
                <p class="user-info">Bienvenido, <strong><?php echo htmlspecialchars($_SESSION['user_name'] ?? 'Usuario'); ?></strong></p>
            </div>
            <a href="index.php?action=logout" class="logout-btn">Cerrar Sesión</a>
        </div>

        <div class="card-grid">
            
            <div class="card">
                <i class="fas fa-id-card" style="font-size: 2.5rem; color: var(--accent-red);"></i>
                <p>Membresías Activas</p>
                <div class="image-placeholder">
                    <img src="assets/img/MEMBRESIA.jpeg" alt="Estadísticas" onerror="this.style.display='none'">
                    <span class="placeholder-text"><i class="fas fa-crown"></i> <?php echo $_SESSION['user_membresia'] ?? 'Plan Estándar'; ?></span>
                </div>
            </div>

            <div class="card">
                <i class="fas fa-clock" style="font-size: 2.5rem; color: var(--accent-red);"></i>
                <p>Próximas Clases</p>
                <div class="image-placeholder">
                    <img src="assets/img/proximaclase.avif" alt="Clases" onerror="this.style.display='none'">
                </div>
            </div>

            <div class="card">
                <i class="fas fa-file-invoice-dollar" style="font-size: 2.5rem; color: var(--accent-red);"></i>
                <p>Reporte Mensual</p>
                <div class="image-placeholder">
                    <img src="assets/img/reporte.png" alt="Reporte" onerror="this.style.display='none'">
                </div>
            </div>

        </div> </div> </body>
</html>