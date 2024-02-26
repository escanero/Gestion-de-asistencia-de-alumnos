<?php
require "./modelo/Bd.php";
require "./modelo/Profesor.php";
require "./modelo/Alumno.php";
require "./modelo/Administrador.php";

session_start();

$mensaje = "";
$bd = new Bd();
$profesor = new Profesor();
$alumno = new Alumno();
$administrador = new Administrador();

if (isset($_POST) && !empty($_POST)) {
    $correo = trim($_POST['Correo']);
    $pass = trim($_POST['pass']);

    // Primero intentamos validar como profesor
    $validacionProfesor = $profesor->validar($correo, $pass);

    if ($validacionProfesor['valido']) {
        $jsonDatosUsuario = $profesor->obtenerDatos($correo);
        $datosUsuario = json_decode($jsonDatosUsuario, true);

        if (!$datosUsuario) {
            $mensaje = "No se pudieron obtener los datos del Profesor.";
        } else {
            // Guardar datos en la sesión para profesor
            $_SESSION['profesor'] = array(
                'ID_Profesor' => $datosUsuario['ID_Profesor'],
                'Nombre' => $datosUsuario['Nombre'],
                'Apellido' => $datosUsuario['Apellido'],
                'Correo' => $datosUsuario['Correo'],
                // Puedes añadir más datos si es necesario
            );

            if ($validacionProfesor['cambiarContrasena']) {
                header("Location: ./sesion/cambiarPass.php");
                exit();
            } else {
                header("Location: ./sesion/portalProfesor.php");
                exit();
            }
        }
    } else {
        // Intentamos validar como alumno
        $validacionAlumno = $alumno->validar($correo, $pass);

        if ($validacionAlumno['valido']) {
            $jsonDatosUsuario = $alumno->obtenerDatos($correo);
            $datosUsuario = json_decode($jsonDatosUsuario, true);

            if (!$datosUsuario) {
                $mensaje = "No se pudieron obtener los datos del Alumno.";
            } else {
                // Guardar datos en la sesión para alumno
                $_SESSION['alumno'] = array(
                    'ID_Alumno' => $datosUsuario['ID_Alumno'],
                    'Nombre' => $datosUsuario['Nombre'],
                    'Apellido' => $datosUsuario['Apellido'],
                    'Correo' => $datosUsuario['Correo'],
                    'Foto' => $datosUsuario['Foto'],
                    // Puedes añadir más datos si es necesario
                );

                if ($validacionAlumno['cambiarContrasena']) {
                    header("Location: ./sesion/cambiarPassAlumno.php");
                    exit();
                } else {
                    header("Location: ./sesion/portalAlumno.php");
                    exit();
                }
            }
        } else {
            // Intentamos validar como alumno
            $validacionadmin = $administrador->validar($correo, $pass);
    
            if ($validacionadmin['valido']) {
                $jsonDatosUsuario = $administrador->obtenerDatos($correo);
                $datosUsuario = json_decode($jsonDatosUsuario, true);
    
                if (!$datosUsuario) {
                    $mensaje = "No se pudieron obtener los datos del Administrador.";
                } else {
                    // Guardar datos en la sesión para alumno
                    $_SESSION['administrador'] = array(
                        'ID_Administrador' => $datosUsuario['ID_Administrador'],
                        'Nombre' => $datosUsuario['Nombre'],
                        'Apellido' => $datosUsuario['Apellido'],
                        'Correo' => $datosUsuario['Correo'],
                        
                    );
    
                    if ($validacionadmin['cambiarContrasena']) {
                        header("Location: ./sesion/cambiarPassAdmin.php");
                        exit();
                    } else {
                        header("Location: ./sesion/portalAdmin.php");
                        exit();
                    }
                }
        } else {
            $mensaje = "Usuario o contraseña incorrectos";
        }
    }
}
}
?>
