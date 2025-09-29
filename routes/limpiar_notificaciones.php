<?php
require_once '../models/PubliModel.php';
require_once '../includes/config.php';

// Verificar que sea una petición POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Método no permitido']);
    exit;
}

// Verificar que sea una petición AJAX
if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) || $_SERVER['HTTP_X_REQUESTED_WITH'] !== 'XMLHttpRequest') {
    http_response_code(400);
    echo json_encode(['error' => 'Petición no válida']);
    exit;
}

try {
    $solicitudModel = new SolicitudModel();
    
    // Limpiar todas las notificaciones
    $resultado = $solicitudModel->limpiarNotificaciones();
    
    if ($resultado) {
        http_response_code(200);
        echo json_encode(['success' => true, 'message' => 'Historial de notificaciones eliminado correctamente']);
    } else {
        http_response_code(500);
        echo json_encode(['error' => 'Error al eliminar el historial de notificaciones']);
    }
    
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Error interno del servidor: ' . $e->getMessage()]);
}
?>
