<?php
header('Content-Type: application/json');

include '../modelo/Bd.php';
include '../modelo/Asistencia.php';

$directorioDestino = "../assets/justificantes/"; // Define la ruta del directorio donde se guardarán los archivos

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["justificante"])) {
    $idAsistencia = $_POST['idAsistencia'];
    $archivo = $_FILES['justificante'];
    $nombreArchivoOriginal = $archivo['name'];
    // Generar un nombre de archivo único para evitar sobreescrituras
    $nombreArchivo = $idAsistencia . '_' . time() . '_' . basename($nombreArchivoOriginal);
    $rutaTemporal = $archivo['tmp_name'];
    $rutaDestino = $directorioDestino . $nombreArchivo;



if (move_uploaded_file($rutaTemporal, $rutaDestino)) {
    $asistencia = new Asistencia();
    $resultadoArchivo = $asistencia->actualizarRutaJustificante($idAsistencia, $rutaDestino);

    if ($resultadoArchivo) {
        // Actualizar el estado de asistencia a 'Justificado'
        $resultadoAsistencia = $asistencia->actualizarEstadoAsistencia($idAsistencia, 'Justificado');

        if ($resultadoAsistencia) {
            echo json_encode(["mensaje" => "Archivo subido y asistencia actualizada a justificado con éxito"]);
        } else {
            echo json_encode(["mensaje" => "Archivo subido, pero hubo un error al actualizar la asistencia"]);
        }
    } else {
        echo json_encode(["mensaje" => "Error al subir el archivo"]);
    }
} else {
    echo json_encode(["mensaje" => "Error al subir el archivo"]);
}
}
?>