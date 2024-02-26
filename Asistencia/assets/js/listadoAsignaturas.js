
document.addEventListener('DOMContentLoaded', function () {
    // Función para cargar las opciones de asignaturas según el ciclo formativo seleccionado
    function cargarAsignaturas() {
        // Obtener el valor del ciclo formativo seleccionado
        var cicloFormativo = document.getElementById("ciclo-formativo").value;
        
        // Obtener el contenedor de asignaturas
        var asignaturaContainer = document.getElementById("asignatura-container");
        
        // Aquí puedes realizar una petición AJAX para obtener las asignaturas
        // o simplemente definir las opciones manualmente en JavaScript
        // Por ejemplo:
        var opcionesAsignaturas = "";
        if (cicloFormativo === "DAM") {
            opcionesAsignaturas = `
                <select id="Nombre_Asignatura" name="Nombre_Asignatura">
                    <option value="Empresa e iniciativa emprendedora">Empresa e iniciativa emprendedora</option>
                    <option value="Acceso a datos">Acceso a datos</option>
                    <option value="Desarrollo de interfaces">Desarrollo de interfaces</option>
                    <option value="Programación multimedia y dispositivos móviles">Programación multimedia y dispositivos móviles</option>
                    <option value="Programación de servicios y procesos">Programación de servicios y procesos</option>
                    <option value="Inglés Técnico">Inglés Técnico</option>
                   
                </select>`;
        } else if (cicloFormativo === "DAW") {
            opcionesAsignaturas = `
                <select id="Nombre_Asignatura" name="Nombre_Asignatura">
                    <option value="Desarrollo web en entorno cliente">Desarrollo web en entorno cliente</option>
                    <option value="Desarrollo web en entorno servidor">Desarrollo web en entorno servidor</option>
                    <option value="Despliegue de aplicaciones web">Despliegue de aplicaciones web</option>
                    <option value="Diseño de interfaces web">Diseño de interfaces web</option>
                    <option value="Empresa e iniciativa emprendedora">Empresa e iniciativa emprendedora</option>
                    <option value="Inglés Técnico">Inglés Técnico</option>
                    <!-- Otras asignaturas de DAW -->
                </select>`;
        } else if (cicloFormativo === "ASIR") {
            opcionesAsignaturas = `
                <select id="Nombre_Asignatura" name="Nombre_Asignatura">
                    <option value="Implantación de sistemas operativos">Implantación de sistemas operativos</option>
                    <option value="Seguridad Informática">Seguridad Informática</option>
                    <option value="Planificación y administración de redes">Planificación y administración de redes</option>
                    <option value="Lenguajes de marcas y sistemas de gestión">Lenguajes de marcas y sistemas de gestión</option>
                    <option value="Fundamentos de hardware">Fundamentos de hardware</option>
                    <option value="Empresa e iniciativa emprendedora">Empresa e iniciativa emprendedora</option>
                    <option value="Inglés Técnico">Inglés Técnico</option>
                  
                </select>`;
        }
        
        // Actualizar el contenido del contenedor de asignaturas
        asignaturaContainer.innerHTML = opcionesAsignaturas;
    }

    // Agregar un evento "change" al selector de ciclo formativo
    document.getElementById("ciclo-formativo").addEventListener("change", cargarAsignaturas);

    // Llamar a la función al cargar la página para inicializar las asignaturas
    cargarAsignaturas();
});