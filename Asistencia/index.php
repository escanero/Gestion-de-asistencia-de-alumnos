<?php include './includes/login_logic.php'; ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="./assets/css/estiloLogin.css">
    <link rel="icon" href="./assets/fotos/nebrija.png" type="image/x-icon">
</head>

<body>
    <header class="head">

        <nav class="">
            <h2>Control De Asistencia</h2>

        </nav>
    </header>
    <div class="imagen">
        <img src="./assets/fotos/logoNebrija.png" alt="Logo de Nebrija"><br><br>
    </div>



    <form id="loginForm" name="login" action="" method="post" class="slide-in-left">
        <h2 class="error"><?php echo $mensaje; ?></h2>
        <label for="Correo">Email:</label>
        <input type="email" id="Correo" name="Correo" placeholder="Email" required><br><br>

        <label for="pass">Contraseña:</label>
        <input type="password" id="pass" name="pass" placeholder="Contraseña" required><br><br>

        <input type="submit" value="Iniciar Sesión">
    </form>


    <footer>

        <div class="social-links">
            <a href="https://www.facebook.com/InstiNebrijaFP/" target="_blank" class="social-icon"><i class="fab fa-facebook-f"></i></a>
            <a href="https://twitter.com/Nebrija/status/" target="_blank" class="social-icon"><i class="fab fa-twitter"></i></a>
            <a href="https://www.instagram.com/instinebrijafp/" target="_blank" class="social-icon"><i class="fab fa-instagram"></i></a>
            <a href="https://www.youtube.com/@Videonebrija" target="_blank" class="social-icon"><i class="fab fa-youtube"></i></a>
        </div>
        <p>&copy; 2023 Universidad Nebrija</p>
    </footer>

</body>

</html>