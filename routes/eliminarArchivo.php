<?php
session_start();

// Asegurarse de que el usuario esté autenticado y sea admin
if (!isset($_SESSION['usuario']) || $_SESSION['rol'] != 1) {
    header('Location: ../acceso-xz9x1d4.php?error=acceso_denegado');
    exit;
}

require_once __DIR__ . '/../models/PubliModel.php';
$modelo = new PublicacionModel();

// Validar el ID recibido por GET
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id > 0) {
    // Buscar la publicación para saber si tiene archivo
    $archivo = $modelo->obtenerArchivoPorId($id);

    if ($archivo) {
        // Eliminar archivo físico si existe
        $ruta = __DIR__ . '/../' . $archivo['ruta_ar'];
        if (file_exists($ruta)) {
            unlink($ruta); // elimina el archivo físico
        }

        // Eliminar de la base de datos
        if ($modelo->eliminarArchivo($id)) {
            header('Location: ../inAdmin.php?vista=report&mensaje=eliminado');
            exit;
        }
    }
}

header('Location: ../inAdmin.php?vista=report&mensaje=error');
exit;
