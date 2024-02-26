<?php
require "../modelo/Bd.php";
require "../modelo/Asistencia.php";

$datos = json_decode(file_get_contents('php://input'), true);

if (isset($datos['id']) && isset($datos['observaciones'])) {
    $idAsistencia = $datos['id'];
    $nuevaObservacion = $datos['observaciones'];

    // Crear una instancia de la clase Asistencia
    $asistencia = new Asistencia();
    $resultado = $asistencia->actualizarObservaciones($idAsistencia, $nuevaObservacion);

    // Manejar la respuesta
    if ($resultado) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al actualizar']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Datos inválidos']);
}