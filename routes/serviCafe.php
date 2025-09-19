<?php
require_once '../controllers/PubliController.php';

// Instancia del controller de café
$controller = new ServicioCafeController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_ca = isset($_POST['id_ca']) ? trim($_POST['id_ca']) : '';

    if ($id_ca !== '') {
        // Editar
        $controller->editarServi();
    } else {
        // Crear
        $controller->guardarServi();
    }
} elseif (isset($_GET['eliminar']) && !empty($_GET['id_ca'])) {
    $controller->eliminarServi();
} else {
    header('Location: ../inAdmin.php?vista=servicio&area=cafe');
    exit;
}
