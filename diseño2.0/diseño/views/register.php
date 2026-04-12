<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - Zeus Gym</title>
    <link rel="stylesheet" href="assets/css/login.css">
    <link rel="icon" type="image/x-icon" href="assets/img/logo.jpeg">

</head>
<body>

    <div class="main-wrapper">
        <aside class="info-sidebar">
            <div class="contact-info">
                <div class="contact-item">
                    <span>📞 0412-9938290</span>
                </div>
                <div class="contact-item">
                    <span>✉️ zeusgym@elite.com</span>
                </div>
            </div>
        </aside>

        <section class="login-section">
            <div class="login-header">
                <h1>ÚNETE A<span>LA ÉLITE</span></h1>
            </div>

            <div class="form-container">
                <?php if (isset($_GET['error'])): ?>
                    <div style="background: #ff4444; color: white; padding: 10px; border-radius: 5px; margin-bottom: 15px; text-align: center; font-size: 14px;">
                        <?php 
                            switch($_GET['error']) {
                                case 'invalid_name': echo "EL NOMBRE NO DEBE TENER NÚMEROS O SÍMBOLOS"; break;
                                case 'invalid_cedula': echo "LA CÉDULA DEBE INICIAR CON V O E EN MAYÚSCULA"; break;
                                case 'invalid_email_domain': echo "DOMINIO DE CORREO NO PERMITIDO"; break;
                                case 'weak_password': echo "LA CONTRASEÑA NO CUMPLE CON LOS REQUISITOS SEGURIDAD"; break;
                                case 'cedula_exists': echo "ESTA CÉDULA YA SE ENCUENTRA REGISTRADA"; break;
                                case 'email_exists': echo "ESTE CORREO YA SE ENCUENTRA REGISTRADO"; break;
                                default: echo "OCURRIÓ UN ERROR EN EL REGISTRO";
                            }
                        ?>
                    </div>
                <?php endif; ?>

                <form action="index.php?action=register" method="POST">
                    
                    <div class="input-group">
                        <label>Nombre y Apellido</label>
                        <div style="display: flex; gap: 10px;">
                            <input type="text" name="nombre" class="input-pill" placeholder="Nombre" required>
                            <input type="text" name="apellido" class="input-pill" placeholder="Apellido" required>
                        </div>
                    </div>

                    <div class="input-group">
                        <label>Cédula de Identidad</label>
                        <input type="text" name="cedula" class="input-pill" placeholder="V-00000000" required>
                    </div>

                    <div class="input-group">
                        <label>Correo Electrónico</label>
                        <input type="email" name="email" class="input-pill" placeholder="correo@ejemplo.com" required>
                    </div>

                    <div class="input-group">
                        <label>Contraseña</label>
                        <input type="password" name="password" class="input-pill" placeholder="••••••••" required>
                    </div>

                    <div class="action-buttons">
                        <a href="index.php?action=login" class="btn-pill btn-secondary">Volver</a>
                        <button type="submit" class="btn-pill btn-primary">Registrar</button>
                    </div>
                </form>
            </div>
        </section>
    </div>

</body>
</html>