<?php
declare(strict_types=1);
header('Content-Type: application/json; charset=utf-8');
header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
header('Pragma: no-cache');

session_start();

/* Solo admin o rol 2, igual que reset_counters */
$rol = (int)($_SESSION['rol'] ?? 0);
if (!in_array($rol, [1, 2], true)) {
  http_response_code(403);
  echo json_encode(['ok' => false, 'message' => 'Acceso denegado (solo admin).']);
  exit;
}

$base = __DIR__ . '/../storage/counters';
if (!is_dir($base)) @mkdir($base, 0775, true);

$map = [
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

$counters = [];

foreach ($map as $key => $file) {
  $current = 0;
  if (is_file($file)) {
    $txt = @file_get_contents($file);
    if (is_string($txt) && preg_match('/\d+/', $txt, $m)) {
      $current = (int)$m[0];
    }
  }
  $next = $current + 1;
  $counters[] = [
    'key'            => $key,
    'current_value'  => $current,              // entero guardado
    'next_code'      => sprintf('%03d', $next) // cómo se verá el próximo
  ];
}

echo json_encode([
  'ok'       => true,
  'counters' => $counters
], JSON_UNESCAPED_UNICODE);
