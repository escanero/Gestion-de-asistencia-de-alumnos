<?php

require "../modelo/Bd.php";
require "../modelo/Alumno.php";
require "../modelo/Asignatura.php";
require "../modelo/Asistencia.php";

// Inicializa las variables
$especialidadSeleccionada = "";
$asignaturaSeleccionada = "";


session_start(); // Inicia la sesión

// Verificar si el profesor ha iniciado sesión
if (!isset($_SESSION['profesor'])) {
    // Si no ha iniciado sesión, redirigir al formulario de inicio de sesión
    header("Location: index.php");
    exit();
}


// Incluir las clases y la lógica necesaria aquí

if (isset($_POST) && !empty($_POST)) {
    // Recuperar datos del formulario
    $ID_Asignatura = $_POST['ID_Asignatura'];
    $ID_Profesor = $_POST['ID_Profesor'];
    $Fecha_Asistencia = $_POST['attendance_date'];
    $Hora = $_POST['attendance_time'];

    // Crear una instancia de la clase Asistencia
    $asistencia = new Asistencia();

    // Crear un array para almacenar los resultados de asistencia para cada alumno
    $resultadosAsistencia = array();

    // Iterar a través de los alumnos y registrar la asistencia
    foreach ($_POST as $key => $value) {
        if (strpos($key, 'estado') === 0) {
            $ID_Alumno = substr($key, strlen('estado_'));
            $estadoAsistencia = $value;
    
            // Recuperar las observaciones para este alumno, si existen
            $claveObservaciones = 'observaciones_' . $ID_Alumno;
            $observaciones = isset($_POST[$claveObservaciones]) ? $_POST[$claveObservaciones] : '';
    
            // Registrar la asistencia para este alumno
            $resultadoRegistro = $asistencia->registrarAsistencia(
                $ID_Asignatura,
                $Fecha_Asistencia,
                $ID_Alumno,
                $ID_Profesor,
                $estadoAsistencia, // Valor de estado de asistencia
                $Hora,
                $observaciones // Valor de las observaciones
            );
        }
    }    

    $todosExitosos = !in_array(false, $resultadosAsistencia, true);

    // Manejar el mensaje de éxito o error y la redirección
    if ($todosExitosos) {
        $_SESSION['mensaje_exito'] = 'Asistencia registrada con éxito para todos los alumnos.';
        header('Location: portalProfesor.php'); 
        exit(); 
    } else {
        $_SESSION['mensaje_error'] = 'Error al registrar la asistencia para algunos alumnos.';
        
    }
}
?>

