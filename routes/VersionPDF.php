<?php
require_once '../controllers/PubliController.php';
require_once '../models/PubliModel.php';
$controller = new VersionController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['crear_proceso'])) {
        $controller->guardarProceso();
    } elseif (isset($_POST['agregar_version'])) {
        $controller->guardarVersion();
    } elseif (isset($_POST['accion'])) {
        switch ($_POST['accion']) {
            case 'eliminar':
                if (isset($_POST['id'])) {
                    $controller->eliminarVersion();
                }
                break;
            case 'eliminar_proceso':
                if (isset($_POST['id'])) {
                    $controller->eliminarProceso();
                }
                break;
            case 'archivar':
                if (isset($_POST['id'])) {
                    $controller->archivarVersion();
                }
                break;
            case 'restaurar':
                if (isset($_POST['id'])) {
                    $controller->restaurarVersion();
                }
                break;
        }
    }
} else {
    $controller->index();
}