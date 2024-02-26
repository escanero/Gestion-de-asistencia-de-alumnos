<?php
require "../modelo/Bd.php";
require "../modelo/Alumno.php";

session_start();

$mensaje = "";
$mensajeSucces = "";
$redireccionar = false;

if (!isset($_SESSION['alumno'])) {
    header("Location: ../index.php"); 
    exit();
}

if (isset($_POST) && !empty($_POST)) {
    $passwordActual = $_POST['passwordActual'];
    $nuevaPassword = $_POST['nuevaPassword'];

    $alumno = new Alumno();
    $correo = $_SESSION['alumno']['Correo'];

    // Verificar si la contraseña actual es específicamente "contrasena"
    if ($passwordActual === 'contrasena') {
 
        if ($alumno->validar($correo, $passwordActual)) {
            $alumno->actualizarPass($correo, $nuevaPassword);
            $mensajeSucces = "Contraseña actualizada correctamente.(Redirigiendo...)";
            $redireccionar = true;
        } else {
            $mensaje = "No se pudo actualizar la contraseña";
        }
    } else {
        $mensaje = "La contraseña actual no es correcta.";
    }
}



?>