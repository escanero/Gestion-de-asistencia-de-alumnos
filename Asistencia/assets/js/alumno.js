document.addEventListener('DOMContentLoaded', function () {
    var ctx = document.getElementById('graficaAsistencia').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Asistencia', 'Retraso', 'Ausente'],
            datasets: [{
                label: 'Número de veces',
                data: [contadorAsistencia, contadorRetraso, contadorAusente],
                backgroundColor: [
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(255, 99, 132, 0.2)'
                ],
                borderColor: [
                    'rgba(75, 192, 192, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(255, 99, 132, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    }); 
document.getElementById('opcionesDesplegable').addEventListener('change', function () {
    var opcionSeleccionada = this.value;
    var tablaAsistencias = document.getElementById('tablaAsistencias').getElementsByTagName('tr');

    for (var i = 1; i < tablaAsistencias.length; i++) {
        tablaAsistencias[i].style.display = '';
    }

    if (opcionSeleccionada !== 'opcion1') {
        var tipoAsistencia = opcionSeleccionada === 'opcion2' ? 'Asistencia' :
            opcionSeleccionada === 'opcion3' ? 'Retraso' :
            opcionSeleccionada === 'opcion5' ? 'Justificado' :
            opcionSeleccionada === 'opcion4' ? 'Ausente' : '';

        for (var i = 1; i < tablaAsistencias.length; i++) {
            var celdaAsistencia = tablaAsistencias[i].getElementsByTagName('td')[4];

            if (celdaAsistencia.innerHTML.trim() !== tipoAsistencia) {
                tablaAsistencias[i].style.display = 'none';
            }
        }
    }
});

});