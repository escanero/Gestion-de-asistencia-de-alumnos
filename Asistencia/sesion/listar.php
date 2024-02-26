<?php include '../includes/logicListarAlumno.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/listadoAlumno.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="icon" href="../assets/fotos/nebrija.png" type="image/x-icon">
    <script src="../assets/js/asistencia.js"></script>
    <title>Listado de Alumnos</title>
</head>

<body>
    <header class="head">
        <nav class="">
            <h2>Listado Alumnos <span><?php echo htmlspecialchars($especialidadSeleccionada); ?></span></h2>
            <h3><span><?php echo htmlspecialchars($asignaturaSeleccionada); ?></span></h3>
            <a class="cerrarSesion" href="../logout.php" title="Cerrar Sesion">
                <span class="material-icons">logout</span>
            </a>
            <a class="portal" href="portalProfesor.php" title="Atras, elegir ciclo formativo.">
                <span class="material-icons">arrow_back</span>
            </a>
        </nav>
    </header>
    <form action="procesarAsistencia.php" method="post">
        <div class="date-time-selection">
            <input type="hidden" name="ID_Asignatura" value="<?php echo htmlspecialchars($datosAsignatura['ID_Asignatura']); ?>">
            <input type="hidden" name="ID_Profesor" value="<?php echo htmlspecialchars($_SESSION['profesor']['ID_Profesor']); ?>">
            <label for="attendance_date">Fecha:</label>
            <input type="date" id="attendance_date" name="attendance_date" required>
            <label for="attendance_time">Hora:</label>
            <select id="attendance_time" name="attendance_time" required>
                <option value="08:30">08:30</option>
                <option value="09:30">09:30</option>
                <option value="10:30">10:30</option>
                <option value="11:30">11:30</option>
                <option value="12:00">12:00</option>
                <option value="13:00">13:00</option>
                <option value="14:00">14:00</option>
            </select>
        </div>
        <?php
if (isset($_SESSION['mensaje_error'])) {
    echo "<p style='color: red; font-size: 16px;text-align:center; padding: 10px; '>" . $_SESSION['mensaje_error'] . "</p>";
    unset($_SESSION['mensaje_error']);
}
?>
        <div class="grid-container">
            <?php foreach ($datosAlumnos as $alumno) : ?>
                <div class="grid-item">
                    <img src="<?php echo htmlspecialchars($alumno['Foto']); ?>" alt="Foto de <?php echo htmlspecialchars($alumno['Nombre']) . ' ' . htmlspecialchars($alumno['Apellido']); ?>">
                    <h3><?php echo htmlspecialchars($alumno['Nombre']) . " " . htmlspecialchars($alumno['Apellido']); ?></h3>
                    <div class="radio-group">
                        <input type="radio" id="asistencia_<?php echo htmlspecialchars($alumno['ID_Alumno']); ?>" name="estado_<?php echo htmlspecialchars($alumno['ID_Alumno']); ?>" value="asistencia" checked>
                        <label for="asistencia_<?php echo htmlspecialchars($alumno['ID_Alumno']); ?>">Asistencia</label>

                        <input type="radio" id="ausente_<?php echo htmlspecialchars($alumno['ID_Alumno']); ?>" name="estado_<?php echo htmlspecialchars($alumno['ID_Alumno']); ?>" value="ausente">
                        <label for="ausente_<?php echo htmlspecialchars($alumno['ID_Alumno']); ?>">Ausente</label>

                        <input type="radio" id="retraso_<?php echo htmlspecialchars($alumno['ID_Alumno']); ?>" name="estado_<?php echo htmlspecialchars($alumno['ID_Alumno']); ?>" value="retraso">
                        <label for="retraso_<?php echo htmlspecialchars($alumno['ID_Alumno']); ?>">Retraso</label>
                    </div>
                    <div class="observaciones" id="observaciones_<?php echo htmlspecialchars($alumno['ID_Alumno']); ?>" style="display: none;">
                            <label for="obs_<?php echo htmlspecialchars($alumno['ID_Alumno']); ?>">Observaciones:</label>
                            <input type="text" id="obs_<?php echo htmlspecialchars($alumno['ID_Alumno']); ?>" name="observaciones_<?php echo htmlspecialchars($alumno['ID_Alumno']); ?>">
                        </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="submit-container">
            <input type="submit" value="Enviar Listado">
        </div>
    </form>
</body>
</html>