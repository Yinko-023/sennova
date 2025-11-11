<?php
declare(strict_types=1);
header('Content-Type: application/json; charset=utf-8');
session_start();


function counter_map(): array {
  $base = dirname(__DIR__) . '/storage/counters';
  if (!is_dir($base)) @mkdir($base, 0775, true);
  return [
    'form1_solicitud'        => $base . '/solicitud.counter',
    'form2_evaluacion'       => $base . '/evaluacion.counter',
    'form3_cotizacion'       => $base . '/cotizacion.counter',
    'form4_orden_trabajo'    => $base . '/orden_trabajo.counter',
    'form5_verificacion_pcb' => $base . '/verificacion_pcb.counter',
    'form6_verificacion_3d'  => $base . '/verificacion_3d.counter',
    'form7_continuidad_pcb'  => $base . '/continuidad_pcb.counter',
    'form8_informe_servicio' => $base . '/informe_servicio.counter',
    'form9_satisfaccion'     => $base . '/satisfaccion.counter',
  ];
}

$rol = (int)($_SESSION['rol'] ?? 0);
if (!in_array($rol, [1, 2], true)) {
  http_response_code(403);
  echo json_encode(['ok' => false, 'message' => 'Acceso denegado (solo admin).']);
  exit;
}

$raw = file_get_contents('php://input');
$in = json_decode($raw, true);
if (!is_array($in)) {
  http_response_code(400);
  echo json_encode(['ok' => false, 'message' => 'JSON inválido.']);
  exit;
}

$setTo = isset($in['set_to']) ? (int)$in['set_to'] : 0;
if ($setTo < 0) $setTo = 0;

if (!empty($in['all'])) {
  $selected = array_keys(counter_map());
} else {
  $selected = array_values(array_unique(array_filter((array)($in['selected'] ?? []))));
  if (!$selected) {
    http_response_code(400);
    echo json_encode(['ok' => false, 'message' => 'No se recibieron formularios a reiniciar.']);
    exit;
  }
}

$map = counter_map();
$results = [];
$errors  = [];

foreach ($selected as $key) {
  if (!isset($map[$key])) {
    $errors[]  = "Clave desconocida: {$key}";
    $results[] = ['key' => $key, 'ok' => false, 'error' => 'clave desconocida'];
    continue;
  }

  $file = $map[$key];
  $h = @fopen($file, 'c+');
  if (!$h) {
    $errors[]  = "No se puede abrir: {$file}";
    $results[] = ['key' => $key, 'ok' => false, 'error' => 'no se pudo abrir', 'counterfile' => $file];
    continue;
  }

  if (!flock($h, LOCK_EX)) {
    fclose($h);
    $errors[]  = "No se pudo bloquear: {$file}";
    $results[] = ['key' => $key, 'ok' => false, 'error' => 'no se pudo bloquear', 'counterfile' => $file];
    continue;
  }

  // Guardamos tal cual el entero (valor actual).
  ftruncate($h, 0);
  rewind($h);
  fwrite($h, (string)$setTo);
  fflush($h);
  flock($h, LOCK_UN);
  fclose($h);
  @chmod($file, 0664);

  $next = $setTo + 1;
  $results[] = [
    'key'         => $key,
    'ok'          => true,
    'new_value'   => $setTo,                 // Valor actual (el guardado)
    'next_code'   => sprintf('%03d', $next), // Próximo correlativo mostrado
    'counterfile' => $file,
  ];
}

echo json_encode([
  'ok'       => empty($errors),
  'message'  => 'Proceso de reinicio finalizado.',
  'results'  => $results,
  'errors'   => $errors,
], JSON_UNESCAPED_UNICODE);
