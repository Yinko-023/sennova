<?php
if (session_status() === PHP_SESSION_NONE) session_start();

require_once __DIR__ . '/../controllers/PubliController.php'; 

$controller = new VideoController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  // Con "action"
  $action = $_POST['action'] ?? '';

  switch ($action) {
    case 'editar_video':
      $controller->editarVideo();
      exit;
    case 'quitar_video':
      $controller->quitarSoloVideo();
      exit;
  }

  // Con name de botón (por compatibilidad con formularios existentes)
  if (isset($_POST['subir_video'])) {
    $controller->subirVideo();
    exit;
  }
  if (isset($_POST['eliminar_video'])) {
    $controller->eliminar();
    exit;
  }
}

header('Location: ../inAdmin.php?vista=usuario');
exit;
