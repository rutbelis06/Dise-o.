<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Zeus Gym</title>
    <link rel="stylesheet" href="assets/css/login.css">
    <link rel="icon" type="image/x-icon" href="assets/img/logo.jpeg">
</head>
<body>

    <div class="main-wrapper">
        
        <div class="info-sidebar">
            <div class="contact-info">
                <div class="contact-item">
                    <span>📞</span> 0412-9938290
                </div>
                <div class="contact-item">
                    <span>📧</span> zeusgym@elite.com
                </div>
            </div>
        </div>

        <section class="login-section">
            <div class="login-header">
                <h1>INICIAR SESIÓN</h1>
            </div>

            <div class="form-container">
                <?php if (isset($_GET['error'])): ?>
                    <div style="background: #ff4444; color: white; padding: 10px; border-radius: 5px; margin-bottom: 15px; text-align: center; font-size: 13px; font-weight: bold; line-height: 1.4;">
                        <?php 
                            if ($_GET['error'] == 'invalid_credentials') {
                                echo "DATOS INCORRECTOS. RECUERDA INGRESAR TU CÉDULA CON 'V' O 'E' Y TU CONTRASEÑA.";
                            } else {
                                echo "ERROR AL INTENTAR INICIAR SESIÓN.";
                            }
                        ?>
                    </div>
                <?php endif; ?>

                <form action="index.php?action=login" method="POST" autocomplete="off">
                    <div class="input-group">
                        <label for="cedula">Cédula de Identidad:</label>
                        <input 
                            type="text" 
                            id="cedula"
                            name="cedula" 
                            class="input-pill" 
                            placeholder="Ej: V27123456"
                            pattern="^[VEve][0-9]+$"
                            title="Debe comenzar con V o E seguido de su número de cédula sin puntos ni espacios."
                            oninput="this.value = this.value.toUpperCase()"
                            required 
                            autofocus
                        >
                    </div>

                    <div class="input-group">
                        <label for="password">Contraseña:</label>
                        <input 
                            type="password" 
                            id="password"
                            name="password" 
                            class="input-pill" 
                            placeholder="••••••••"
                            required
                        >
                        <a href="#" class="forgot-link">¿Olvidó Tu Contraseña?</a>
                    </div>

                    <div class="action-buttons">
                        <button type="submit" class="btn-pill btn-primary">INICIAR</button>
                        <a href="index.php?action=register" class="btn-pill btn-secondary">REGISTRAR</a>
                    </div>
                </form>
            </div>
        </section>

    </div>

</body>
</html>