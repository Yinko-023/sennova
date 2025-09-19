<?php
require_once '../models/PubliModel.php'; // Ajusta la ruta según tu estructura
session_start();

if ($_SESSION['rol'] != 1) {
    header('Location: ../inAdmin.php?vista=usuario');
    exit;
}

if (!isset($_GET['id'])) {
    header('Location: ../inAdmin.php?vista=usuario');
    exit;
}

$id = intval($_GET['id']);
$model = new Publicacion();

if ($model->quitarDestacado($id)) {
    header("Location: ../inAdmin.php?vista=usuario&editado=ok");
} else {
    header("Location: ../inAdmin.php?vista=usuario&fallo=errors");
}
