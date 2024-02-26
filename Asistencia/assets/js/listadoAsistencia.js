document.addEventListener('DOMContentLoaded', function () {
    const especialidades = ['DAW', 'DAM', 'ASIR'];
    const contenedor = document.getElementById('lista-estudiantes');

    let html = '<ul class="especialidades-lista">';
    html += '<h3>Listado Alumnos</h3>';

    especialidades.forEach(especialidad => {
        html += `<li class="especialidad-item"><a href="#" onclick="mostrarAlumnos('${especialidad}')">${especialidad}</a><div id="lista-${especialidad}" class="grid-container" style="display: none;"></div></li>`;
    });

    html += '</ul>';
    contenedor.innerHTML = html;
});

function mostrarAlumnos(especialidad) {
    const lista = document.getElementById(`lista-${especialidad}`);

    if (lista.style.display === 'block') {
        lista.style.display = 'none';
    } else {
        fetch(`obtenerAlumnos.php?especialidad=${especialidad}`)
            .then(response => response.json())
            .then(alumnos => {
                let html = '<ul class="alumnos-lista">';

                if (alumnos.error) {
                    html += '<li>No se encontraron alumnos.</li>';
                } else {
                    alumnos.forEach(alumno => {
                        html += `
                        <li class="alumno-item">
                        <label class="switch">
                            <input type="checkbox" name="estudiante[]" value="${alumno.ID_Alumno}" onclick="soloUnEstudiante(this, ${alumno.ID_Alumno})">
                           
                            <span class="slider round"></span>
                            ${alumno.Nombre} ${alumno.Apellido}
                           
                            
                        </label>
                       
                    </li>`;
                    });
                }

                html += '</ul>';
                lista.innerHTML = html;
                lista.style.display = 'block';
            })
            .catch(error => console.error('Error:', error));
    }
}




function soloUnEstudiante(checkbox, idAlumno) {
    const checkboxes = document.querySelectorAll('input[type="checkbox"][name="estudiante[]"]');
    checkboxes.forEach(cb => {
        if (cb !== checkbox) cb.checked = false;
    });

    // Aquí puedes llamar a mostrarDetalleEstudiante si quieres que se muestre el detalle al seleccionar el checkbox
    if (checkbox.checked) {
        mostrarDetalleEstudiante(idAlumno);
    } else {
        // Opcional: Ocultar los detalles si se desmarca el checkbox
        document.getElementById('detalle-alumno').style.display = 'none';
    }
}

function mostrarDetalleEstudiante(idAlumno) {
    fetch('detalleAlumno.php?id_alumno=' + idAlumno)
        .then(response => response.json())
        .then(data => {
            const detalle = document.getElementById('detalle-alumno');
            let html = '';

            if (data.length > 0) {
                const estudiante = data[0];
                html += `
                        <div class="centro-usuario">
                            <h3>${estudiante.Nombre} ${estudiante.Apellido}</h3>
                            <img src="${estudiante.Foto}" alt="Foto de ${estudiante.Nombre}">
                        </div>
                        <div class='container2'>
                        <label for='opcionesDesplegable'>Listar asistencia:</label>
                        <select id='opcionesDesplegable' name='opcionesDesplegable'>
                            <option value='opcion1'>Todas</option>
                            <option value='opcion2'>Asistencia</option>
                            <option value='opcion3'>Retraso</option>
                            <option value='opcion4'>Ausente</option>
                            <option value='opcion5'>Justificado</option>
                        </select>`;
            }

            // Inicializar contadores
            let totalAsistencias = 0;
            let totalAusencias = 0;
            let totalRetrasos = 0;

            html += '<h4>Detalles de Asistencia</h4>';
            if (data.length === 0) {
                html += '<p>No hay registros de asistencia para este estudiante.</p>';
            } else {
                // Comenzar tabla
                html += '<table id="tablaAsistencias"><thead><tr><th>Fecha</th><th>Hora</th><th>Estado</th><th>Observaciones</th></tr></thead><tbody>';
                data.forEach(asistencia => {
                    if (asistencia.Asistencia === 'Asistencia' || asistencia.Asistencia === 'Justificado') {
                        totalAsistencias++;
                    } else if (asistencia.Asistencia === 'Ausente') {
                        totalAusencias++;
                    } else if (asistencia.Asistencia === 'Retraso') {
                        totalRetrasos++;
                    }


                    html += `
                            <tr>
                                <td>${asistencia.Fecha_Asistencia}</td>
                                <td>${asistencia.Hora}</td>
                                <td>${asistencia.Asistencia}</td>
                                <td>${asistencia.observaciones || ''}</td>
                            </tr>`;
                });
                html += '</tbody></table>'; // Cerrar tabla

                let totalRegistros = totalAsistencias + totalAusencias + totalRetrasos;
                if (totalRegistros > 0) {
                    let porcentajeAsistencias = Math.round((totalAsistencias / totalRegistros) * 100);
                    let porcentajeAusencias = Math.round((totalAusencias / totalRegistros) * 100);
                    let porcentajeRetrasos = Math.round((totalRetrasos / totalRegistros) * 100);
                
                    // Cambiar color a rojo si la asistencia es 20% o más
                    let colorAsistencia = porcentajeAusencias >= 20 ? 'style="color: red;"' : '';
                    
                    html += `<p>Porcentaje de Asistencia: ${porcentajeAsistencias}%</p>`;
                    html += `<p ${colorAsistencia}>Porcentaje de Ausencias: ${porcentajeAusencias}%</p>`;
                    html += `<p>Porcentaje de Retrasos: ${porcentajeRetrasos}%</p>`;
                } else {
                    html += '<p>No hay registros de asistencia para calcular porcentajes.</p>';
                }
                
            }

            detalle.innerHTML = html;
            detalle.style.display = 'block';
            const selectElement = document.getElementById('opcionesDesplegable');
            if (selectElement) {
                selectElement.addEventListener('change', function(event) {
                    const seleccionado = event.target.value;
                    console.log("Opción seleccionada: ", seleccionado);
                    filtrarAsistencia(event.target.value, data);
                });
            }
        })
        .catch(error => {
            console.error('Error:', error);
            document.getElementById('detalle-alumno').innerHTML = '<p>Hubo un error al cargar los detalles del estudiante.</p>';
        });

}

function filtrarAsistencia(opcionSeleccionada, datosAsistencia) {
    var tablaAsistencias = document.getElementById('tablaAsistencias').getElementsByTagName('tbody')[0].getElementsByTagName('tr');

    for (var i = 0; i < tablaAsistencias.length; i++) {
        tablaAsistencias[i].style.display = '';
    }

    if (opcionSeleccionada !== 'opcion1') {
        var tipoAsistencia = opcionSeleccionada === 'opcion2' ? 'Asistencia' :
            opcionSeleccionada === 'opcion3' ? 'Retraso' :
            opcionSeleccionada === 'opcion5' ? 'Justificado' :
            opcionSeleccionada === 'opcion4' ? 'Ausente' : '';

        for (var i = 0; i < tablaAsistencias.length; i++) {
            var celdaAsistencia = tablaAsistencias[i].getElementsByTagName('td')[2]; // Asegúrate de que esto apunte a la columna correcta en tu tabla

            if (celdaAsistencia.innerHTML.trim() !== tipoAsistencia) {
                tablaAsistencias[i].style.display = 'none';
            }
        }
    }
}

