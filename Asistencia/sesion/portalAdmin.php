<?php
session_start(); // Inicia la sesión

// Verificar si el profesor ha iniciado sesión
if (!isset($_SESSION['administrador'])) {
    // Si no ha iniciado sesión, redirigir al formulario de inicio de sesión
    header("Location: ../index.php");
    exit();
}

$nombreAdministrador = $_SESSION['administrador']['Nombre'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/listadoAsistencia.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="icon" href="../assets/fotos/nebrija.png" type="image/x-icon">
    <script src="../assets/js/listadoJustificar.js"></script>
    <title>Document</title>
</head>

<body>
    <header class="head">
    
        <nav class="">
        
            <h2>Asistencia</h2>
            <h3>Bienvenid@, <?php echo $nombreAdministrador; ?></h3>
            <a class="cerrarSesion" href="../logout.php" title="Cerrar Sesion">
                <span class="material-icons">logout</span>
            </a>
           


        </nav>
    </header>
  <div class="container">
    
    <div class="contenedor-flex">
        <div id="lista-estudiantes"></div>
        <div id="detalle-alumno" class="slide-in-right"  style="display: none;"></div>
    </div>

    </div>
</body>

</html>