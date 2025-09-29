<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../conexion/conexion.php';
require_once __DIR__ . '/../controllers/PubliController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Comprueba si la petición es del formulario de publicaciones
  if (isset($_POST['form_action_publication'])) {
    PublicacionController::procesarFormulario();
  } else {
    // Si no, asume que es uno de los formularios de Evaluación/PDF
    EvaluacionController::handle();
  }
} else {
  EvaluacionController::create();
}