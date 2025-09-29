<?php

$ruta = dirname(__DIR__) . '/img/';
if (!is_dir($ruta)) {
  @mkdir($ruta, 0775, true);
}

$accion = $_POST['accion'] ?? null;

try {
  if ($accion === 'subir') {
    if (empty($_FILES['imagen']) || $_FILES['imagen']['error'] !== UPLOAD_ERR_OK) {
      throw new Exception('No se recibió archivo válido. Código: ' . ($_FILES['imagen']['error'] ?? 'n/a'));
    }

    $ext = null;
    if (class_exists('finfo')) {
      $finfo = new finfo(FILEINFO_MIME_TYPE);
      $mime  = $finfo->file($_FILES['imagen']['tmp_name']);
      $permitidos = ['image/jpeg' => 'jpg', 'image/png' => 'png', 'image/webp' => 'webp'];
      if (!isset($permitidos[$mime])) {
        throw new Exception('Formato no permitido. Usa JPG, PNG o WEBP.');
      }
      $ext = $permitidos[$mime];
    } else {
      $name = strtolower($_FILES['imagen']['name']);
      if (preg_match('/\.(jpe?g|png|webp)$/', $name, $m)) {
        $ext = ($m[1] === 'jpg' || $m[1] === 'jpeg') ? 'jpg' : (($m[1] === 'png') ? 'png' : 'webp');
      } else {
        throw new Exception('No se pudo verificar el formato del archivo.');
      }
    }

    $nombre  = 'mapa_' . date('Ymd_His') . '_' . bin2hex(random_bytes(4)) . '.' . $ext;
    $destino = $ruta . $nombre;

    if (!move_uploaded_file($_FILES['imagen']['tmp_name'], $destino)) {
      throw new Exception('No se pudo mover el archivo al destino.');
    }

    $txt = $ruta . 'imagen_actual.txt';
    $anterior = is_file($txt) ? trim((string)file_get_contents($txt)) : null;
    if ($anterior && is_file($ruta . $anterior)) {
      @unlink($ruta . $anterior);
    }
    file_put_contents($txt, $nombre);

    header('Location: ../inAdmin.php?vista=gestion&res=imgok');
    exit;
  }

  if ($accion === 'eliminar') {
    $txt = $ruta . 'imagen_actual.txt';
    $nombre = is_file($txt) ? trim((string)file_get_contents($txt)) : null;
    if ($nombre && is_file($ruta . $nombre)) {
      @unlink($ruta . $nombre);
    }
    if (is_file($txt)) {
      @unlink($txt);
    }

    header('Location: ../inAdmin.php?vista=gestion&res=imgdel');
    exit;
  }

  throw new Exception('Acción inválida.');
} catch (Throwable $e) {
  header('Location: ../inAdmin.php?vista=gestion&err=' . urlencode($e->getMessage()));
  exit;
}
