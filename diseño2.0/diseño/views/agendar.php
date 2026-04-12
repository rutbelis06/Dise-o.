<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agendar Cita - Zeus Gym</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/dashboard.css">
    <link rel="stylesheet" href="assets/css/agendar.css">
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
                <i class="fas fa-user-circle"></i> <span>Mi perfil</span>
            </a>
        </nav>

        <a href="index.php?action=logout" class="logout-btn">Cerrar Sesión</a>
    </div>

    <div class="main-content">
        <div class="header-dash">
            <div>
                <h1>Agendamiento</h1>
                <p class="user-info">Sesión de: <strong><?php echo htmlspecialchars($_SESSION['user_name'] . ' ' . $_SESSION['user_apellido']); ?></strong></p>
            </div>
            <div class="user-status">
                <span class="badge-membership"><?php echo $_SESSION['user_membresia'] ?? 'Plan Básico'; ?></span>
            </div>
        </div>

        <div class="booking-container">
            <div class="booking-card">
                <div class="booking-header">
                    <i class="fas fa-clock"></i>
                    <h2>Reserva tu espacio</h2>
                </div>
                
                <?php if (isset($_GET['error'])): ?>
                    <div class="alert alert-danger" style="background: #ff4444; color: white; padding: 10px; border-radius: 5px; margin-bottom: 20px; text-align: center;">
                        Error al procesar la reserva. Inténtelo de nuevo.
                    </div>
                <?php endif; ?>

                <form action="index.php?action=guardar_cita" method="POST" class="booking-form">
                    <div class="form-grid">
                        
                        <div class="form-group full-width">
                            <label for="entrenamiento">
                                <i class="fas fa-dumbbell"></i> Disciplina / Área
                            </label>
                            <select name="entrenamiento" id="entrenamiento" required>
                                <option value="" disabled selected>Seleccione una opción...</option>
                                <option value="1">Sala de Máquinas y Pesas</option>
                                <option value="2">Entrenamiento Funcional</option>
                                <option value="3">Área de Cardio</option>
                                <option value="4">Sesión con Entrenador</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="fecha">
                                <i class="fas fa-calendar-day"></i> Fecha Seleccionada
                            </label>
                            <input type="date" id="fecha" name="fecha" required 
                                   min="<?php echo date('Y-m-d'); ?>">
                        </div>

                        <div class="form-group">
                            <label for="hora">
                                <i class="fas fa-hourglass-half"></i> Bloque Horario
                            </label>
                            <select name="hora" id="hora" required>
                                <option value="" disabled selected>Elegir hora...</option>
                                <option value="06:00 AM - 08:00 AM">06:00 AM - 08:00 AM</option>
                                <option value="08:00 AM - 10:00 AM">08:00 AM - 10:00 AM</option>
                                <option value="04:00 PM - 06:00 PM">04:00 PM - 06:00 PM</option>
                                <option value="06:00 PM - 08:00 PM">06:00 PM - 08:00 PM</option>
                                <option value="08:00 PM - 10:00 PM">08:00 PM - 10:00 PM</option>
                            </select>
                        </div>

                        <div class="form-group full-width">
                            <label for="notas">
                                <i class="fas fa-edit"></i> Observaciones o requerimientos
                            </label>
                            <textarea id="notas" name="notas" rows="3" 
                                      placeholder="Ej: Foco en tren superior, primera vez en el área..."></textarea>
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="reset" class="btn-secondary">Limpiar campos</button>
                        <button type="submit" class="btn-primary">Confirmar Cita</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>
</html>