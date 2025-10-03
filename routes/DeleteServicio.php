<?php
require_once __DIR__ . '/../conexion/conexion.php';

$conn = conectaDb();

if (isset($_GET['id']) && isset($_GET['tipo'])) {
    $id = intval($_GET['id']);
    $tipo = $_GET['tipo'];

    switch ($tipo) {
        case 'cafe':
            $tabla = 'servi_cafe';
            $campoId = 'id_ca';
            break;
        case 'electronica':
            $tabla = 'servi_elect';
            $campoId = 'id_ele';
            break;
        default:
            die("Tipo de servicio inválido.");
    }

    $sql = "DELETE FROM $tabla WHERE $campoId = :id";
    $stmt = $conn->prepare($sql);

    if ($stmt->execute(['id' => $id])) {
       header("Location: ../inAdmin.php?vista=servicio&area=$tipo&mensaje=eliminado");
exit;

    } else {
        echo "Error al eliminar el servicio.";
    }
} else {
    echo "Parámetros incompletos.";
}
?>
