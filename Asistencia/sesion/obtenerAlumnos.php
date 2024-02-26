<?php
require "../modelo/Bd.php";
require "../modelo/Alumno.php";

$alumno = new Alumno();

// Obtener la especialidad de una solicitud GET
$especialidad = $_GET['especialidad'] ?? null;

if ($especialidad) {
    echo $alumno->obtenerAlumnosPorEspecialidad($especialidad);
} else {
    echo json_encode(['error' => 'Especialidad no especificada.']);
}
