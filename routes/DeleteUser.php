<?php
require_once '../models/PubliModel.php';

session_start();

// Validar que sea admin
if (!isset($_SESSION['usuario']) || $_SESSION['rol'] != 1) {
    header('Location: ../acceso-xz9x1d4.php');
    exit;
}

$id = $_GET['id'] ?? null;

if ($id) {
    $modelo = new UserModel();
    $exito = $modelo->eliminarUsuarioPorId($id);
    
    if ($exito) {
        header('Location: ../inAdmin.php?vista=inicio&eliminado=1');
    } else {
        header('Location: ../inAdmin.php?vista=inicio&error=1');
    }
} else {
    header('Location: ../inAdmin.php?vista=inicio');
}
