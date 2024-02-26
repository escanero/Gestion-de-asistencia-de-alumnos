<?php
$requestedUrl = $_SERVER['REQUEST_URI'];
$validPages = array('cambiarPass', 'cambiarPassAdmin', 'cambiarPassAlumno', 'listadoAsistencias', 'listar', 'portalAdmin', 'portalAlumno', '/sesion/portalProfesor'); // Ejemplo de páginas válidas

// Normaliza la URL solicitada para permitir 'Index' o 'Index.php' como válidos.
$requestedPage = trim($requestedUrl, '/');
$requestedPage = ($requestedPage === '' || strtolower($requestedPage) === 'index.php') ? 'Index' : $requestedPage;

// Antes de generar cualquier salida HTML, decide si incluir la página válida o la de error.
if ($requestedPage === 'Index' || in_array($requestedPage, $validPages)) {
    // Si la página es la principal o existe en la lista de páginas válidas, incluye el contenido correspondiente.
    // Asegúrate de que 'Index' está en la lista de páginas válidas o maneja este caso separadamente.
    $pageToInclude = $requestedPage === 'Index' ? 'Index.php' : $requestedPage . '.php';
    include($pageToInclude);
} else {
    // Si la página no existe, muestra la página de error y termina la ejecución.
    header("HTTP/1.0 404 Not Found");
    include('error.php');
    exit; // Esto asegura que no se muestre nada más después de la página de error.
}

?>