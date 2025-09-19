<?php
require_once __DIR__ . '/sennova/controllers/AminController.php';

$controller = new AdminController();

$vista = $_GET['vista'] ?? null;

if ($vista) {
    $controller->cargarVistaAjax($vista);  // carga los fragmentos tipo proceso1.php
} else {
    echo "⚠️ Vista no especificada.";
}
