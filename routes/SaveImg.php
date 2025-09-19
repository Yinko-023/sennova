<?php

$ruta = __DIR__ . '/sennova/img/';
$accion = $_POST['accion'] ?? null;

if ($accion === 'subir') {
  $archivo = $_FILES['imagen'] ?? null;
  if ($archivo && $archivo['error'] === UPLOAD_ERR_OK) {
    $nombre = uniqid('mapa_') . '_' . basename($archivo['name']); // evita nombres duplicados
    $destino = $ruta . $nombre;

    if (move_uploaded_file($archivo['tmp_name'], $destino)) {
      // Elimina imagen anterior si existe
      $anterior = file_exists($ruta . 'imagen_actual.txt') ? trim(file_get_contents($ruta . 'imagen_actual.txt')) : null;
      if ($anterior && file_exists($ruta . $anterior)) {
        unlink($ruta . $anterior);
      }

      // Guardar nueva imagen
      file_put_contents($ruta . 'imagen_actual.txt', $nombre);
    }
  }
} elseif ($accion === 'eliminar') {
  $nombre = file_exists($ruta . 'imagen_actual.txt') ? trim(file_get_contents($ruta . 'imagen_actual.txt')) : null;
  if ($nombre && file_exists($ruta . $nombre)) {
    unlink($ruta . $nombre);
    unlink($ruta . 'imagen_actual.txt');
  }
}

header('Location: ../inAdmin.php?vista=gestion');
exit;
