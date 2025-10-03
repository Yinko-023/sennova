<?php
if (session_status() === PHP_SESSION_NONE) session_start();

require_once __DIR__ . '/../models/PubliModel.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : (int)($_POST['id'] ?? 0);
$rol = (int)($_SESSION['rol'] ?? 0);
$returnTo = $_GET['return_to'] ?? $_POST['return_to'] ?? null;

// A dónde volver
$vista = $returnTo ? trim($returnTo) : ($rol === 1 ? 'usuario' : 'supubli');

// Helper de redirección con los params que lee la vista
function go(string $vista, string $estado, string $mensaje): void {
  $qs = http_build_query([
    'vista'   => $vista,
    'estado'  => $estado,   // success | error
    'mensaje' => $mensaje,  // texto que mostrará el SweetAlert
  ]);
  header("Location: /sennova/inAdmin.php?{$qs}");
  exit;
}

if ($id <= 0) {
  go($vista, 'error', 'Identificador inválido.');
}

$modelo = new PublicacionModel();
$exito  = $modelo->eliminarPublicacion($id);

if ($exito) {
  go($vista, 'success', 'Publicación eliminada correctamente.');
} else {
  go($vista, 'error', 'No se pudo eliminar la publicación.');
}
