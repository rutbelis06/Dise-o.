<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clientes - Zeus Gym</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/dashboard.css">
    <link rel="stylesheet" href="assets/css/clientes.css">
    <link rel="icon" type="image/x-icon" href="assets/img/logo.jpeg">
</head>
<body>

    <div class="sidebar">
        <div class="logo-container">
            <img src="assets/img/logo.jpeg" alt="Zeus Gym Logo">
        </div>
        
        <nav class="menu-navigation">
            <a href="index.php?action=dashboard" class="menu-item">
                <i class="fas fa-chart-line"></i> <span>Inicio</span>
            </a>

            <a href="index.php?action=gestionCitas" class="menu-item">
                <i class="fas fa-tasks"></i> <span>Gestión de citas</span>
            </a>
            <a href="index.php?action=clientes" class="menu-item active">
                <i class="fas fa-users"></i> <span>Clientes</span>
            </a>
            <a href="#" class="menu-item">
                <i class="fas fa-dumbbell"></i> <span>Entrenamientos</span>
            </a>
            <a href="#" class="menu-item">
                <i class="fas fa-calendar-alt"></i> <span>Horarios</span>
            </a>
            <a href="#" class="menu-item">
                <i class="fas fa-user-circle"></i> <span>Mi perfil</span>
            </a>
        </nav>

        <a href="index.php?action=logout" class="logout-btn">Cerrar Sesión</a>

    </div>

    <div class="main-content">
        <div class="header-dash">
            <div>
                <h1>Directorio de Clientes</h1>
            </div>
            <div class="search-bar">
                <input type="text" placeholder="Buscar por nombre o cédula...">
                <i class="fas fa-search"></i>
            </div>
        </div>

        <div class="management-container">
            <div class="management-header">
                <div class="header-title">
                    <h2><i class="fas fa-user-friends"></i> Listado General</h2>
                </div>
                <div class="header-actions">
                    <button class="btn-primary-small">
                        <i class="fas fa-user-plus"></i> Nuevo Cliente
                    </button>
                </div>
            </div>

            <div class="table-container">
                <table class="zeus-table">
                    <thead>
                        <tr>
                            <th>Cédula</th>
                            <th>Nombre Completo</th>
                            <th>Correo Electrónico</th>
                            <th>Membresía</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>V2987643</td>
                            <td><strong>Juan Antonio</strong></td>
                            <td>juan@gemail.com</td>
                            <td>Premium</td>
                            <td><span class="status-pill active-bg">Activo</span></td>
                            <td class="action-cell">
                                <button class="btn-table edit" title="Editar"><i class="fas fa-user-edit"></i></button>
                                <button class="btn-table info" title="Historial"><i class="fas fa-history"></i></button>
                            </td>
                        </tr>
                        <tr>
                
                                <button class="btn-table edit" title="Editar"><i class="fas fa-user-edit"></i></button>
                                <button class="btn-table info" title="Historial"><i class="fas fa-history"></i></button>
                            </td>
                        </tr>
                        <tr>
                  
                            </td>
                        </tr>
                        </tbody>
                </table>
            </div>
        </div>
    </div>

</body>
</html>