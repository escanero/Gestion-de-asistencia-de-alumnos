<?php
require "../modelo/Bd.php";
require "../modelo/Profesor.php";


session_start();

$mensaje = "";
$mensajeSucces = "";
$redireccionar = false;

if (!isset($_SESSION['profesor'])) {
    header("Location: ../index.php"); 
    exit();
}

if (isset($_POST) && !empty($_POST)) {
    $passwordActual = $_POST['passwordActual'];
    $nuevaPassword = $_POST['nuevaPassword'];

    $profesor = new Profesor();
    $correo = $_SESSION['profesor']['Correo'];

    // Verificar si la contraseña actual es específicamente "contrasena"
    if ($passwordActual === 'contrasena') {
        // Aquí también puedes verificar si la contraseña almacenada es realmente "contrasena"
        // mediante el método validar, aunque esto es redundante si solo "contrasena" es aceptada.
        if ($profesor->validar($correo, $passwordActual)) {
            $profesor->actualizarPass($correo, $nuevaPassword);
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