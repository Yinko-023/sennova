<?php
function registrarAuditoria($usuario_id, $descripcion) {
    $conn = new mysqli("localhost", "root", "", "sennova2");
    $conn->set_charset("utf8");

    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }
    
    $fecha = date('Y-m-d H:i:s');
    $sql = "INSERT INTO auditoria_cambios (usuario, descripcion, fecha) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $usuario_id, $descripcion, $fecha);
    $stmt->execute();
    $stmt->close();
    $conn->close();
}
?>
