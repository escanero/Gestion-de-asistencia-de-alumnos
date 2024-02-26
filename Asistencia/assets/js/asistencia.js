document.addEventListener('DOMContentLoaded', function () {

    document.querySelectorAll('.grid-item').forEach(item => {
        item.querySelectorAll('input[type="radio"]').forEach(radio => {
            radio.addEventListener('change', function () {
                const img = item.querySelector('img');
                img.classList.remove('img-asistencia', 'img-retraso', 'img-ausente');

                if (this.value === 'asistencia') {
                    img.classList.add('img-asistencia');
                } else if (this.value === 'retraso') {
                    img.classList.add('img-retraso');
                } else if (this.value === 'ausente') {
                    img.classList.add('img-ausente');
                }
            });
        });
    });

    document.querySelectorAll('.radio-group input[type=radio]').forEach(function(radio) {
        radio.addEventListener('change', function() {
            // Identificar el alumno específico
            var alumnoId = this.id.split('_')[1];

            // Mostrar/Ocultar campo de observaciones
            var divObservaciones = document.getElementById('observaciones_' + alumnoId);
            if (this.value === 'retraso') {
                divObservaciones.style.display = 'block';
            } else {
                divObservaciones.style.display = 'disable';
            }
        });
    });

    document.getElementById('attendance_date').addEventListener('change', function (e) {
        var selectedDate = new Date(this.value);
        var dayOfWeek = selectedDate.getDay();

        if (dayOfWeek === 0 || dayOfWeek === 6) {
            alert('Por favor, elige un día entre semana.');
            this.value = '';
        }
    });

});
