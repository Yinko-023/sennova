<?php
require_once __DIR__ . '/../models/PubliModel.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $modelo = new PublicacionModel();

    // Primero desmarcar cualquier otra destacada
    $modelo->quitarDestacadas();

    // Luego destacar la nueva
    $exito = $modelo->destacarPublicacion($id);

    $mensaje = $exito ? 'destacada' : 'error';
    header("Location: ../inAdmin.php?vista=usuario&editado=ok");
    exit;
} else {
    header("Location: ../inAdmin.php?vista=usuario&fallo=errors");
    exit;
}