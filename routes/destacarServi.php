<?php
require_once __DIR__ . '/../conexion/conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_re'])) {
    $conn = conectaDb(); // Tu función PDO

    $id = intval($_POST['id_re']);

    // Obtener el estado actual
    $stmt = $conn->prepare("SELECT destacado_re FROM requests WHERE id_re = ?");
    $stmt->execute([$id]);
    $destacado = $stmt->fetchColumn();

    // Cambiar el valor (alternar)
    $nuevo = $destacado ? 0 : 1;

    $stmt = $conn->prepare("UPDATE requests SET destacado_re = ? WHERE id_re = ?");
    $stmt->execute([$nuevo, $id]);

    // Redirigir de nuevo a la vista
    header("Location: ../inAdmin.php?vista=atencion");
    exit;
} else {
    echo "Acceso no autorizado.";
}
