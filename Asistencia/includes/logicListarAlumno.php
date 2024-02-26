<?php

require "../modelo/Bd.php";
require "../modelo/Alumno.php";
require "../modelo/Asignatura.php";
require "../modelo/Asistencia.php";


session_start(); // Inicia la sesión

// Verificar si el profesor ha iniciado sesión
if (!isset($_SESSION['profesor'])) {
    // Si no ha iniciado sesión, redirigir al formulario de inicio de sesión
    header("Location: index.php");
    exit();
}

$idProfesor = $_SESSION['profesor']['ID_Profesor'];

// Inicializa las variables
$especialidadSeleccionada = "";
$asignaturaSeleccionada = "";


// Verifica si el formulario ha sido enviado
if (isset($_POST) && !empty($_POST)) {
    if (isset($_POST['especialidad'])) {
        $especialidadSeleccionada = $_POST['especialidad'];
    }

    if (isset($_POST['Nombre_Asignatura'])) {
        $asignaturaSeleccionada = $_POST['Nombre_Asignatura'];
    }

    // Instancia de tus clases
    $alumno = new Alumno();
    $asignatura = new Asignatura();

    // Obtén los alumnos y asignaturas según lo seleccionado
    $alumnos = $alumno->obtenerAlumnosPorEspecialidad($especialidadSeleccionada);
    $asignaturaInfo = $asignatura->obtenerAsignatura($asignaturaSeleccionada);

    // Procesar los resultados y mostrarlos
    $datosAlumnos = json_decode($alumnos, true);
    $datosAsignatura = json_decode($asignaturaInfo, true);
}

?>