<?php
session_start(); // Inicia la sesión

// Verificar si el profesor ha iniciado sesión
if (!isset($_SESSION['profesor'])) {
    // Si no ha iniciado sesión, redirigir al formulario de inicio de sesión
    header("Location: ../index.php");
    exit();
}


// Obtener el nombre del profesor de la sesión
$nombreProfesor = $_SESSION['profesor']['Nombre'];
$apellidoProfesor = $_SESSION['profesor']['Apellido'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/portalProfesorStyle.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="icon" href="../assets/fotos/nebrija.png" type="image/x-icon">
    <script src="../assets/js/listadoAsignaturas.js"></script>
    <title>Document</title>
</head>

<body>
    <header class="head">
      
        <nav class="">
        <h2>Bienvenid@, <?php echo $nombreProfesor; ?> <?php echo $apellidoProfesor; ?></h2>
        <a class="cerrarSesion" href="../logout.php" title="Cerrar Sesion">
                <span class="material-icons">logout</span>
            </a>
        </nav>
    </header>
    <a class="boton" href="listadoAsistencias.php" title="Asistencia Alumnos">Lista De Asistencias</a>
    <form class="form-container" action="listar.php" method="post">
    <?php
if (isset($_SESSION['mensaje_exito'])) {
    echo "<p style='color: green; font-size: 18px;text-align:center; padding: 10px; '>" . $_SESSION['mensaje_exito'] . "</p>";
    unset($_SESSION['mensaje_exito']);
}
?>
        <label for="especialidad">Elige un ciclo formativo:</label>
        <select id="ciclo-formativo" name="especialidad">
          <option value="DAM">Desarrollo de Aplicaciones Multiplataforma (DAM)</option>
          <option value="DAW">Desarrollo de Aplicaciones Web (DAW)</option>
          <option value="ASIR">Administración de Sistemas Informáticos en Red (ASIR)</option>
        </select>
        <br>
        <label for="Nombre_Asignatura">Elige un módulo:</label>
    <div id="asignatura-container">  
    </div> 
        <br>
        <br>
        <input type="submit" value="Alumnos">
      </form>
</body>
</html>
