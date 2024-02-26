<?php include '../includes/logicPassProfesor.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/cambiarPass.css">
    
</head>
<header class="head">
        <nav class="">
            <h2>Cambio de Contraseña</h2>
          


        </nav>
    </header>
    <div class="imagen">
    <img src="../assets/fotos/logoNebrija.png" alt="Logo de Nebrija"><br><br>
    <link rel="icon" href="../assets/fotos/nebrija.png" type="image/x-icon">
</div>
<body>
   
    <h2 class="mensaje"><?php echo $mensaje; ?></h2><h2 class="mensajeG"><?php echo $mensajeSucces; ?></h2>
    <form action="cambiarPass.php" method="post">
        <label for="passwordActual">Contraseña Actual:</label>
        <input type="password" id="passwordActual" name="passwordActual" placeholder="Contraseña Actual*" required>

        <label for="nuevaPassword">Nueva Contraseña:</label>
        <input type="password" id="nuevaPassword" name="nuevaPassword" placeholder="Contraseña Nueva*" required>

        <input type="submit" value="Cambiar Contraseña">
    </form>
    <?php if ($redireccionar): ?>
    <script>
        setTimeout(function() {
            window.location.href = "portalProfesor.php";
        }, 3000);  
    </script>
<?php endif; ?>
</body>
</html>
