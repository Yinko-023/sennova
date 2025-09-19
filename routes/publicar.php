<?php

require_once __DIR__ . '/../controllers/PubliController.php';

$controller = new PublicacionController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->procesarFormulario();
} else {
    $controller->mostrarFormulario();
}
