<?php
require_once __DIR__ . '/../conexion/conexion.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  http_response_code(405);
  exit('Método no permitido');
}

$id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
if ($id <= 0) {
  header('Location: /sennova/inAdmin.php?vista=pdfs&msg=invalid');
  exit;
}

try {
  $pdo = conectaDb();
  $pdo->beginTransaction();

  $stmt = $pdo->prepare('SELECT relative_path FROM generated_pdfs WHERE id = :id FOR UPDATE');
  $stmt->execute([':id' => $id]);
  $row = $stmt->fetch(PDO::FETCH_ASSOC);

  if (!$row) {
    $pdo->rollBack();
    header('Location: /sennova/inAdmin.php?vista=pdfs&msg=notfound');
    exit;
  }

  $rel = (string)$row['relative_path'];
  $docRoot = rtrim($_SERVER['DOCUMENT_ROOT'] ?? '', '/\\');
  $abs = $docRoot . $rel; // rel comienza con /sennova/...

  // Intentar borrar el archivo si existe
  if (is_file($abs)) {
    @unlink($abs);
  }

  // Borrar registro en BD
  $del = $pdo->prepare('DELETE FROM generated_pdfs WHERE id = :id');
  $del->execute([':id' => $id]);
  $pdo->commit();

  header('Location: /sennova/inAdmin.php?vista=pdfs&msg=deleted');
  exit;
} catch (Throwable $e) {
  if (isset($pdo) && $pdo->inTransaction()) {
    $pdo->rollBack();
  }
  header('Location: /sennova/inAdmin.php?vista=pdfs&msg=error');
  exit;
}


