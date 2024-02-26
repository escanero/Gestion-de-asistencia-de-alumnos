<?php
require "../modelo/Bd.php";
require "../modelo/Alumno.php";

session_start();

if (!isset($_SESSION['alumno'])) {
    header("Location: alumno.php");
    exit();
}

$nombreAlumno = $_SESSION['alumno']['Nombre'];
$apellidoAlumno = $_SESSION['alumno']['Apellido'];
$idAlumno = $_SESSION['alumno']['ID_Alumno'];
$alumno = new Alumno('', '', '', '', '', '', $idAlumno);

try {
    $jsonAsistencias = $alumno->obtenerAsistencia();
    $asistencias = json_decode($jsonAsistencias, true);
    $contadorAsistencia = 0;
    $contadorRetraso = 0;
    $contadorAusente = 0;

    foreach ($asistencias as $asistencia) {
        switch ($asistencia['Asistencia']) {
            case 'Asistencia':
            case 'Justificado': // Agregar Justificado como una forma de Asistencia
                $contadorAsistencia++;
                break;
            case 'Retraso':
                $contadorRetraso++;
                break;
            case 'Ausente':
                $contadorAusente++;
                break;
        }
    }

    $totalAsistencias = count($asistencias);
    $porcentajeAsistencia = ($totalAsistencias > 0) ? round(($contadorAsistencia / $totalAsistencias) * 100) : 0;
    $porcentajeRetraso = ($totalAsistencias > 0) ? round(($contadorRetraso / $totalAsistencias) * 100) : 0;
    $porcentajeAusente = ($totalAsistencias > 0) ? round(($contadorAusente / $totalAsistencias) * 100) : 0;
} catch (Exception $e) {
    $error = "Error al obtener la asistencia: " . htmlspecialchars($e->getMessage());
}

?>