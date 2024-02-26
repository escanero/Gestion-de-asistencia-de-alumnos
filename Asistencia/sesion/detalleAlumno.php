<?php

require "../modelo/Bd.php";
require "../modelo/Asistencia.php";

header('Content-Type: application/json');

// Verificar si se proporcionó un ID de alumno
if (!isset($_GET['id_alumno'])) {
    echo json_encode(['error' => 'No se proporcionó ID de alumno']);
    exit();
}

$idAlumno = $_GET['id_alumno'];
$asistencia = new Asistencia();
echo $asistencia->obtenerDetallesAsistencia($idAlumno);
?>
