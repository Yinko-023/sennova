<?php
if (session_status() === PHP_SESSION_NONE) session_start();
require_once __DIR__ . '/../conexion/conexion.php';
$pdo = conectaDb();

$destVista = 'pdfs';
$okUrl  = "/sennova/inAdmin.php?vista={$destVista}&msg=reemplazado";
$errUrl = "/sennova/inAdmin.php?vista={$destVista}&msg=error_reemplazo";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  header("Location: {$errUrl}"); exit;
}

$id = (int)($_POST['id'] ?? 0);
if ($id <= 0 || empty($_FILES['pdf_file']) || $_FILES['pdf_file']['error'] !== UPLOAD_ERR_OK) {
  header("Location: {$errUrl}"); exit;
}

// 1) Traer registro
$st = $pdo->prepare("SELECT filename, relative_path, n_cliente FROM generated_pdfs WHERE id_pdf = ?");
$st->execute([$id]);
$row = $st->fetch(PDO::FETCH_ASSOC);
if (!$row) { header("Location: {$errUrl}"); exit; }

// (opcional) validar n_cliente
if (!empty($_POST['n_cliente'])) {
  $postedCli = trim($_POST['n_cliente']);
  if (strcasecmp($postedCli, (string)$row['n_cliente']) !== 0) {
    header("Location: {$errUrl}"); exit;
  }
}

// 2) Ruta absoluta del archivo
$rel = ltrim($row['relative_path'], '/');
$abs = rtrim($_SERVER['DOCUMENT_ROOT'], DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . $rel;

// 3) Mover nuevo PDF SOBRE el existente
if (!is_dir(dirname($abs))) @mkdir(dirname($abs), 0777, true);
if (!move_uploaded_file($_FILES['pdf_file']['tmp_name'], $abs)) {
  header("Location: {$errUrl}"); exit;
}

// 4) Actualizar tamaño (y contar descarga si quieres)
$size = @filesize($abs) ?: 0;
$st2 = $pdo->prepare("UPDATE generated_pdfs SET size_bytes = ? WHERE id_pdf = ?");
$st2->execute([$size, $id]);

header("Location: {$okUrl}");
exit;
