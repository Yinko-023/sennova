<?php
require_once '../controllers/PubliController.php';

$controller = new ServicioElectronicaController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_ele = isset($_POST['id_ele']) ? trim($_POST['id_ele']) : '';

    if ($id_ele !== '') {
        // Editar
        $controller->editarServicio();
    } else {
        // Crear
        $controller->guardarServicio();
    }
} elseif (isset($_GET['eliminar']) && !empty($_GET['id_ele'])) {
    $controller->eliminarServicio();
} else {
    header('Location: ../inAdmin.php?vista=servicio&area=electronica');
    exit;
}
