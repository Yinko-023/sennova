<?php
if (session_status() === PHP_SESSION_NONE) session_start();

require_once '../controllers/PubliController.php';

$controller = new PortadaController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST['subir_portada'])) {
    $controller->subirPortada();
    exit;
  } elseif (isset($_POST['eliminar_portada'])) {
    $controller->eliminarPortada();
    exit;
  } elseif (isset($_POST['editar_portada'])) {            
    $controller->editarPortada();
    exit;
  }
}

header('Location: ../inAdmin.php?vista=usuario');
exit;
