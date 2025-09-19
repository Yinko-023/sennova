<?php
require_once '../controllers/PubliController.php';
$controller = new VideoController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST['subir_video'])) {
    $controller->subirVideo();
  } elseif (isset($_POST['eliminar_video'])) {
    $controller->eliminar();
  }
}
