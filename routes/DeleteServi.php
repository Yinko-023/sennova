<?php
require_once __DIR__ . '/../conexion/conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_re'])) {
    $id = intval($_POST['id_re']);

    try {
        $conn = conectaDb();

        $stmt = $conn->prepare("DELETE FROM requests WHERE id_re = ?");
        $stmt->execute([$id]);

        // Redirige de nuevo a la vista
        header("Location: /sennova/inAdmin.php?vista=atencion&eliminado=1");
        exit;
    } catch (PDOException $e) {
        echo "Error al eliminar la solicitud: " . $e->getMessage();
    }
} else {
    echo "Acceso no autorizado.";
}
