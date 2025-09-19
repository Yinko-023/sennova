<?php

require_once '../controllers/PubliController.php';

// Instancia del controlador
$controller = new GestionController();

// Validación del método
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Crear proceso principal
    if (isset($_POST['crear'])) {
        $controller->crear();
    }

    // Eliminar proceso principal
    if (isset($_POST['eliminar'])) {
        $controller->eliminar();
    }

    // Crear subproceso
    if (isset($_POST['crear_sub'])) {
        $controller->crearsub();
    }

    // Eliminar subproceso
    if (isset($_POST['eliminar_sub'])) {
        $controller->eliminarsub();
    }
}
