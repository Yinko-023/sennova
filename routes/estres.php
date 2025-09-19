<?php
require_once __DIR__ . '/../conexion/conexion.php';
require_once __DIR__ . '/../controllers/PubliController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  EvaluacionController::handle();   
} else {
  EvaluacionController::create();
}
