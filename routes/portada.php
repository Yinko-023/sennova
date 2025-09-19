<?php
require_once '../controllers/PubliController.php';
$controller = new PortadaController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST['subir_portada'])) {
    $controller->subirPortada();
  } elseif (isset($_POST['eliminar_portada'])) {
    $controller->eliminarPortada();
  }
}
