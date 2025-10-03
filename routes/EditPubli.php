<?php
if (session_status() === PHP_SESSION_NONE) session_start();
require_once __DIR__ . '/../models/PubliModel.php';

$rol = (int)($_SESSION['rol'] ?? 0);

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  $destVista = ($rol === 1 ? 'usuario' : 'supubli');
  header("Location: /sennova/inAdmin.php?vista={$destVista}");
  exit;
}

$id             = (int)($_POST['id'] ?? 0);
$titulo         = trim($_POST['title'] ?? '');
$contenido      = trim($_POST['content'] ?? '');
$nuevaImagen    = $_FILES['image'] ?? null;
$eliminarImagen = isset($_POST['eliminar_imagen']) || isset($_POST['delete_image']);

$returnTo  = $_POST['return_to'] ?? $_GET['return_to'] ?? null;
$destVista = $returnTo ? trim($returnTo) : ($rol === 1 ? 'usuario' : 'supubli');

$okUrl  = "/sennova/inAdmin.php?vista={$destVista}&editado=ok";
$badUrl = "/sennova/inAdmin.php?vista={$destVista}&editado=";

if ($id <= 0 || $titulo === '' || $contenido === '') {
  header("Location: {$badUrl}incompleto");
  exit;
}

$modelo = new PublicacionModel();

// área de la publicación
$area = $modelo->getAreaById($id);
if ($area === null) {
  header("Location: {$badUrl}no_encontrada");
  exit;
}

// duplicado en MISMA área (case-insensitive), excluyendo este id
if ($modelo->existeTituloEnArea($titulo, $area, $id)) {
  // 👇 enviamos el área para mostrarla en el toast
  header("Location: {$badUrl}titulo_duplicado&area=" . urlencode($area));
  exit;
}

// editar
$exito  = $modelo->editarPublicacion($id, $titulo, $contenido, $nuevaImagen, $eliminarImagen);

header('Location: ' . ($exito ? $okUrl : "{$badUrl}error"));
exit;
