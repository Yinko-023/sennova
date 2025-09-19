<?php

require_once '../controllers/PubliController.php';
$controller = new CarruselController();

$action = $_POST['action'] ?? $_GET['action'] ?? 'index';

switch ($action) {
    case 'agregar':
        $controller->agregarCarrusel();
        break;
    case 'eliminar':
        $controller->eliminarCarrusel();
        break;
    default:
        $controller->index();
        break;
}
