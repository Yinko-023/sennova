<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../conexion/conexion.php';
require_once __DIR__ . '/../controllers/PubliController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST['form_action_publication'])) {
    $ctrl = new PublicacionController();
    $ctrl->procesarFormulario();
    exit;
  } else {
    EvaluacionController::handle(); 
    exit;
  }
} else {
  EvaluacionController::create();
}