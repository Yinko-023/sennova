<?php
require_once __DIR__ . '/../conexion/conexion.php';
$conn = conectaDb();

$q = $_GET['q'] ?? '';

if (strlen($q) < 2) {
    echo json_encode([]);
    exit;
}

$sql = "SELECT nombre, empresa FROM requests 
        WHERE nombre LIKE :b OR empresa LIKE :b OR email LIKE :b 
        ORDER BY destacado_re DESC, fecha_solicitud DESC 
        LIMIT 10";

$stmt = $conn->prepare($sql);
$stmt->execute([':b' => "%$q%"]);
$resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

header('Content-Type: application/json');
echo json_encode($resultados);
