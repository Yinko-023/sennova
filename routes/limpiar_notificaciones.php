<?php
// routes/limpiar_notificaciones.php  (UNIFICADO)

if (session_status() === PHP_SESSION_NONE) session_start();

header('Content-Type: application/json; charset=utf-8');
ini_set('display_errors', 0);
// Evitar cualquier salida accidental que rompa el JSON
while (ob_get_level()) { ob_end_clean(); }

try {
  require_once __DIR__ . '/../includes/config.php';
  require_once __DIR__ . '/../models/PubliModel.php'; // aquí debe estar SolicitudModel
} catch (Throwable $e) {
  http_response_code(500);
  echo json_encode(['error' => 'Error cargando dependencias']);
  exit;
}

// Solo POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  http_response_code(405);
  echo json_encode(['error' => 'Método no permitido']);
  exit;
}

// AJAX check (case-insensitive)
$xhr = strtolower($_SERVER['HTTP_X_REQUESTED_WITH'] ?? '');
if ($xhr !== 'xmlhttprequest') {
  http_response_code(400);
  echo json_encode(['error' => 'Petición no válida']);
  exit;
}

// Permisos (ajusta a tu lógica si hace falta)
if (empty($_SESSION['rol'])) {
  http_response_code(401);
  echo json_encode(['error' => 'Sesión expirada o sin permisos']);
  exit;
}

$accion = $_POST['accion'] ?? '';
$idRaw  = $_POST['id'] ?? null;

try {
  $solicitudModel = new SolicitudModel();

  // 1) Limpiar todo
  if ($accion === 'limpiar') {
    $ok = $solicitudModel->limpiarNotificaciones();
    if (!$ok) {
      http_response_code(500);
      echo json_encode(['error' => 'Error al eliminar el historial de notificaciones']);
      exit;
    }
    echo json_encode(['success' => true, 'message' => 'Historial de notificaciones eliminado correctamente']);
    exit;
  }

  // 2) Eliminar una sola (si viene id, hacemos delete individual)
  if ($idRaw !== null) {
    $id = filter_var($idRaw, FILTER_VALIDATE_INT);
    if (!$id) {
      http_response_code(400);
      echo json_encode(['error' => 'ID inválido']);
      exit;
    }

    $ok = $solicitudModel->eliminarNotificacionPorId($id);
    if (!$ok) {
      http_response_code(404);
      echo json_encode(['error' => 'No existe o no se pudo eliminar la notificación']);
      exit;
    }

    echo json_encode(['ok' => true, 'id' => $id]);
    exit;
  }

  // Si no vino ni accion=limpiar ni id => petición inválida
  http_response_code(400);
  echo json_encode(['error' => 'Acción no reconocida']);

} catch (Throwable $e) {
  http_response_code(500);
  echo json_encode(['error' => 'Error interno del servidor']);
}
