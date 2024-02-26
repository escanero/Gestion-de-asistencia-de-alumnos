<?php include '../includes/logicaPortalAlumno.php'; ?>
<!DOCTYPE html>
<html lang='es'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <link rel='stylesheet' href='../assets/css/portalAlumnoEstilo.css'>
    <link href='https://fonts.googleapis.com/icon?family=Material+Icons' rel='stylesheet'>
    <script src='https://cdn.jsdelivr.net/npm/chart.js'></script>
    <link rel="icon" href="../assets/fotos/nebrija.png" type="image/x-icon">
    <script src="../assets/js/alumno.js"></script>
    <title>Portal del Alumno</title>
</head>
<body>
    <header class='head'>
        <nav class=''>
            <h2>Bienvenid@, <?php echo htmlspecialchars($nombreAlumno . ' ' . $apellidoAlumno); ?></h2>
            <a class='cerrarSesion' href='../logout.php' title='Cerrar Sesion'>
                <span class='material-icons'>logout</span>
            </a>
        </nav>
    </header>
    <div class='container'>
        <label for='opcionesDesplegable'>Listar asistencia:</label>
        <select id='opcionesDesplegable' name='opcionesDesplegable'>
            <option value='opcion1'>Todas</option>
            <option value='opcion2'>Asistencia</option>
            <option value='opcion3'>Retraso</option>
            <option value='opcion4'>Ausente</option>
            <option value='opcion5'>Justificado</option>
        </select>

        <?php if (!empty($asistencias)): ?>
            <table border='1' id='tablaAsistencias'>
                <tr>
                    <th>Asignatura</th>
                    <th>Fecha Asistencia</th>
                    <th>Asistencia</th>
                    <th>Hora</th>
                    <th>Observaciones</th>
                </tr>
                <?php foreach ($asistencias as $asistencia): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($asistencia['Nombre_Asignatura']); ?></td>
                        <td><?php echo htmlspecialchars($asistencia['Fecha_Asistencia']); ?></td>
                        <td style="display:none"><?php echo htmlspecialchars($asistencia['ID_Alumno']); ?></td>
                        <td style="display:none"><?php echo htmlspecialchars($asistencia['Nombre_Profesor']); ?></td>
                        <td><?php echo htmlspecialchars($asistencia['Asistencia']); ?></td>
                        <td><?php echo htmlspecialchars($asistencia['Hora']); ?></td>
                        <td><?php echo htmlspecialchars($asistencia['observaciones']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>

            <div style='margin-top: 5%;'></div>
            <canvas id='graficaAsistencia' style='width: 60%; height: 10%;'></canvas>
            <h4>Estadísticas de Asistencia</h4>
            <?php
                if ($totalAsistencias > 0) {
                    echo "<p>Asistencia: $porcentajeAsistencia%</p>";
                    echo "<p>Retraso: $porcentajeRetraso%</p>";
                    
                   
                    if ($porcentajeAusente > 15) {
                        echo "<p style='color: red;'>Ausente: $porcentajeAusente%</p>";
                    } else {
                        echo "<p>Ausente: $porcentajeAusente%</p>";
                    }
                } else {
                    echo "<p>No hay registros de asistencia.</p>";
                }
            ?>
        <?php else: ?>
            <p>No hay registros de asistencia.</p>
        <?php endif; ?>
    </div>

    <script>
        var contadorAsistencia = <?php echo $contadorAsistencia; ?>;
        var contadorRetraso = <?php echo $contadorRetraso; ?>;
        var contadorAusente = <?php echo $contadorAusente; ?>;
    </script>
</body>
</html>