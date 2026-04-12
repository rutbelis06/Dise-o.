<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión Citas - Zeus Gym</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/gestion.css">
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

            <a href="index.php?action=gestionCitas" class="menu-item active">
                <i class="fas fa-tasks"></i> <span>Gestión de citas</span>
            </a>
            <a href="index.php?action=clientes" class="menu-item">
                <i class="fas fa-users"></i> <span>Clientes</span>
            </a>
            <a href="#" class="menu-item">
                <i class="fas fa-dumbbell"></i> <span>Entrenamientos</span>
            </a>
            <a href="#" class="menu-item">
                <i class="fas fa-user-circle"></i> <span>Mi perfil</span>
            </a>
        </nav>

        <a href="index.php?action=logout" class="logout-btn">Cerrar Sesión</a>
    </div>

    <div class="main-content">
        
        <div class="header-dash">
            <div style="margin-top: 15px;">
                <span class="badge-membership" style="background: #eee; padding: 5px 15px; border-radius: 20px; font-size: 0.8rem; font-weight: bold; color: var(--accent-red);">
                    MEMBRESÍA: <i class="fas fa-crown"></i> <?php echo $_SESSION['user_membresia'] ?? 'Plan Estándar'; ?>
                </span>
            </div>
        </div>

        <div class="management-container">
            
            <?php if (isset($_GET['success']) && $_GET['success'] == 'booked'): ?>
                <div class="alert-success">
                    <i class="fas fa-check-circle"></i> ¡LA CITA SE HA REGISTRADO CORRECTAMENTE!
                </div>
            <?php endif; ?>

            <div class="management-header">
                <div class="header-title">
                    <h1>Gestión de Citas</h1>
                    <h2><i class="fas fa-calendar-check"></i> Próximas Citas</h2>
                </div>
                <div class="header-actions">
                    <input type="text" placeholder="Buscar por disciplina o fecha..." class="search-input">
                    <a href="index.php?action=agendar" class="btn-primary-small">
                        <i class="fas fa-plus"></i> Nueva Cita
                    </a>
                </div>
            </div>

            <div class="table-container">
                <table class="zeus-table">
                    <thead>
                        <tr>
                            <?php if(isset($_SESSION['user_rol']) && $_SESSION['user_rol'] === 'Administrador'): ?>
                                <th>Cliente</th>
                            <?php endif; ?>
                            <th>Disciplina</th>
                            <th>Fecha</th>
                            <th>Hora</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($citas)): ?>
                            <?php foreach ($citas as $cita): ?>
                                <tr>
                                    <?php if(isset($_SESSION['user_rol']) && $_SESSION['user_rol'] === 'Administrador'): ?>
                                        <td><strong><?php echo htmlspecialchars($cita['cliente']); ?></strong></td>
                                    <?php endif; ?>
                                    
                                    <td><?php echo htmlspecialchars($cita['disciplina']); ?></td>
                                    <td><i class="far fa-calendar-alt"></i> <?php echo date('d/m/Y', strtotime($cita['fecha'])); ?></td>
                                    <td><i class="far fa-clock"></i> <?php echo htmlspecialchars($cita['hora']); ?></td>
                                    
                                    <td>
                                        <?php 
                                            $claseEstado = '';
                                            $estado = strtolower($cita['estado']);
                                            switch($estado) {
                                                case 'pendiente': $claseEstado = 'pending'; break;
                                                case 'completada': $claseEstado = 'completed'; break;
                                                case 'cancelada': $claseEstado = 'cancelled'; break;
                                                default: $claseEstado = 'default';
                                            }
                                        ?>
                                        <span class="status-pill <?php echo $claseEstado; ?>">
                                            <?php echo strtoupper($cita['estado']); ?>
                                        </span>
                                    </td>
                                    
                                    <td class="action-cell">
                                        <?php if($estado === 'pendiente'): ?>
                                            <button class="btn-table edit" title="Editar"><i class="fas fa-edit"></i></button>
                                            <button class="btn-table delete" title="Cancelar"><i class="fas fa-times"></i></button>
                                        <?php else: ?>
                                            <button class="btn-table view" title="Ver Detalles"><i class="fas fa-eye"></i></button>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" style="padding: 40px; color: var(--text-gray);">
                                    <i class="fas fa-info-circle" style="font-size: 2rem; display: block; margin-bottom: 10px; opacity: 0.5;"></i>
                                    No tienes citas programadas para esta semana.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>
</html>