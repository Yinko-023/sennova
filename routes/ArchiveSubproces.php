<?php
require __DIR__ . '/../conexion/conexion.php';
$conn = conectaDb(); // tu función PDO
$accion = $_GET['action'] ?? '';

// ===================== SUBIR ARCHIVO =====================
if ($accion === 'subir' && isset($_FILES['archivo'])) {
    $archivo = $_FILES['archivo'];
    $origen = $_POST['origen'];

    $nombreOriginal = $archivo['name'];
    $extension = pathinfo($nombreOriginal, PATHINFO_EXTENSION);
    $type = $archivo['type'];

    // Crear nombre único para el archivo físico
    $nombreUnico = time() . '_' . bin2hex(random_bytes(4)) . '_' . basename($nombreOriginal);

    // Carpeta absoluta en el servidor
    $rutaCarpeta = __DIR__ . "/../public/archivos/";
    if (!is_dir($rutaCarpeta)) {
        mkdir($rutaCarpeta, 0777, true);
    }

    // Ruta absoluta donde se guardará el archivo
    $rutaDestino = $rutaCarpeta . $nombreUnico;

    // Mover archivo al destino
    move_uploaded_file($archivo['tmp_name'], $rutaDestino);

    // Ruta relativa para el navegador
    $rutaBD = "public/archivos/" . $nombreUnico;

    // Guardar en la base de datos usando PDO
    $stmt = $conn->prepare("
        INSERT INTO archivos (name_ar, ruta_ar, type_ar, extension_ar, origen_ar) 
        VALUES (:name, :ruta, :type, :ext, :origen)
    ");
    $stmt->execute([
        ':name' => $nombreOriginal, // <-- nombre original visible
        ':ruta' => $rutaBD,         // <-- ruta única física
        ':type' => $type,
        ':ext' => $extension,
        ':origen' => $origen
    ]);

    echo json_encode([
        'success' => true,
        'ruta_ar' => $rutaBD
    ]);
    exit;
}

// ===================== ELIMINAR ARCHIVO =====================
if ($accion === 'eliminar' && isset($_GET['id'])) {
    $id = $_GET['id'];

    // Obtener ruta del archivo
    $stmt = $conn->prepare("SELECT ruta_ar FROM archivos WHERE id_ar = :id");
    $stmt->execute([':id' => $id]);
    $archivo = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($archivo) {
        $ruta = __DIR__ . "/../" . $archivo['ruta_ar']; // ruta absoluta
        if (file_exists($ruta)) {
            unlink($ruta); // eliminar archivo físico
        }

        // Eliminar registro de la BD
        $stmt = $conn->prepare("DELETE FROM archivos WHERE id_ar = :id");
        $stmt->execute([':id' => $id]);
    }

    header("Location: " . $_SERVER['HTTP_REFERER']); // volver a la página anterior
    exit;
}

// ===================== DESCARGAR ARCHIVO =====================
if ($accion === 'descargar' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare("SELECT ruta_ar, name_ar FROM archivos WHERE id_ar = :id");
    $stmt->execute([':id' => $id]);
    $archivo = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($archivo) {
        $ruta = __DIR__ . "/../" . $archivo['ruta_ar'];
        if (file_exists($ruta)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . basename($archivo['name_ar']) . '"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($ruta));
            readfile($ruta);
            exit;
        } else {
            echo "Archivo no encontrado.";
        }
    }
}
?>
    