<?php
require_once __DIR__ . '/../conexion/conexion.php';
$conn = conectaDb();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = intval($_POST['id']);
    $stmt = $conn->prepare("DELETE FROM notifications WHERE id = ?");
    $stmt->execute([$id]);
    echo "ok";
}