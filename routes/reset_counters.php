<?php

declare(strict_types=1);
header('Content-Type: application/json; charset=utf-8');

session_start();

$rol = (int)($_SESSION['rol'] ?? 0);
if ($rol !== 1) {
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
  $selected = [
    'form1_solicitud',
    'form2_evaluacion',
    'form3_cotizacion',
    'form4_orden_trabajo',
    'form5_verificacion_pcb',
    'form6_verificacion_3d',
    'form7_continuidad_pcb',
    'form8_informe_servicio',
    'form9_satisfaccion'
  ];
} else {
  $selected = array_values(array_unique(array_filter((array)($in['selected'] ?? []))));
  if (!$selected) {
    http_response_code(400);
    echo json_encode(['ok' => false, 'message' => 'No se recibieron formularios a reiniciar.']);
    exit;
  }
}

$counterDir = __DIR__ . '/../storage/counters';
if (!is_dir($counterDir)) @mkdir($counterDir, 0775, true);

$map = [
  'form1_solicitud'        => $counterDir . '/solicitud.counter',
  'form2_evaluacion'       => $counterDir . '/evaluacion.counter',
  'form3_cotizacion'       => $counterDir . '/cotizacion.counter',
  'form4_orden_trabajo'    => $counterDir . '/orden_trabajo.counter',
  'form5_verificacion_pcb' => $counterDir . '/verificacion_pcb.counter',
  'form6_verificacion_3d'  => $counterDir . '/verificacion_3d.counter',
  'form7_continuidad_pcb'  => $counterDir . '/continuidad_pcb.counter',
  'form8_informe_servicio' => $counterDir . '/informe_servicio.counter',
  'form9_satisfaccion'     => $counterDir . '/satisfaccion.counter',
];

$results = [];
$errors  = [];

foreach ($selected as $key) {
  if (!isset($map[$key])) {
    $errors[]  = "Clave desconocida: {$key}";
    $results[] = ['key' => $key, 'ok' => false, 'error' => 'clave desconocida'];
    continue;
  }

  $file = $map[$key];

  $ok = @file_put_contents($file, (string)$setTo, LOCK_EX);
  if ($ok === false) {
    $errors[]  = "No se pudo escribir: {$file}";
    $results[] = ['key' => $key, 'ok' => false, 'error' => 'no se pudo escribir', 'counterfile' => $file];
    continue;
  }
  @chmod($file, 0664);

  $next = max(0, (int)$setTo) + 1;
  $results[] = [
    'key'        => $key,
    'ok'         => true,
    'new_value'  => (int)$setTo,
    'next_code'  => sprintf('%03d', $next),
    'counterfile' => $file,
  ];
}

echo json_encode([
  'ok'       => empty($errors),
  'message'  => 'Proceso de reinicio finalizado.',
  'results'  => $results,
  'errors'   => $errors,
], JSON_UNESCAPED_UNICODE);
