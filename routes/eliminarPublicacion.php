<?php

require_once __DIR__ . '/../models/PubliModel.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    
    $modelo = new PublicacionModel();
    $exito = $modelo->eliminarPublicacion($id);

    if ($exito) {
        header('Location: /sennova/inAdmin.php?vista=usuario&mensaje=eliminado');
        exit;
    } else {
        header('Location: /sennova/inAdmin.php?vista=usuario&mensaje=error');
        exit;
    }
} else {
    header('Location: /sennova/inAdmin.php?vista=usuario');
    exit;
}
