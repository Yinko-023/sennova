<?php
require_once __DIR__ . '/../models/PubliModel.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $titulo = trim($_POST['title']);
    $contenido = trim($_POST['content']);
    $eliminarImagen = isset($_POST['eliminar_imagen']) ? true : false;
    $nuevaImagen = $_FILES['image'] ?? null;

    $modelo = new PublicacionModel();
    $exito = $modelo->editarPublicacion($id, $titulo, $contenido, $nuevaImagen, $eliminarImagen);

    if ($exito) {
header("Location: ../inAdmin.php?vista=usuario&editado=ok");
        exit;
    } else {
        echo "Error al editar la publicación.";
    }
}
