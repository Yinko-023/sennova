<?php
require_once __DIR__ . '/../conexion/conexion.php';
$pdo = conectaDb();

$id = (int)($_POST['id_re'] ?? 0);
$ajax = isset($_GET['ajax']);

if ($id <= 0) {
  if ($ajax) { header('Content-Type: application/json'); http_response_code(400); echo json_encode(['ok'=>false,'message'=>'ID inválido']); exit; }
  header('Location: ../inAdmin.php?vista=atencion'); exit;
}

$stmt = $pdo->prepare("SELECT destacado_re FROM requests WHERE id_re = ?");
$stmt->execute([$id]);
$cur = $stmt->fetchColumn();

$nuevo = $cur ? 0 : 1;
$up = $pdo->prepare("UPDATE requests SET destacado_re = ? WHERE id_re = ?");
$up->execute([$nuevo, $id]);

if ($ajax) {
  header('Content-Type: application/json; charset=utf-8');
  echo json_encode(['ok' => true, 'nuevo' => $nuevo], JSON_UNESCAPED_UNICODE);
  exit;
}

header('Location: ../inAdmin.php?vista=atencion#soli-' . $id);
