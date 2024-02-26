<?php
require "../modelo/Bd.php";
require "../modelo/Administrador.php";

session_start();

$mensaje = "";
$mensajeSucces = "";
$redireccionar = false;

if (!isset($_SESSION['administrador'])) {
    header("Location: ../index.php"); 
    exit();
}

if (isset($_POST) && !empty($_POST)) {
    $passwordActual = $_POST['passwordActual'];
    $nuevaPassword = $_POST['nuevaPassword'];

    $administrador = new Administrador();
    $correo = $_SESSION['administrador']['Correo'];

    // Verificar si la contraseña actual es específicamente "contrasena"
    if ($passwordActual === 'contrasena') {
 
        if ($administrador->validar($correo, $passwordActual)) {
            $administrador->actualizarPass($correo, $nuevaPassword);
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