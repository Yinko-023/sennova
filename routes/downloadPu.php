<?php
require_once __DIR__ . '/../conexion/conexion.php'; // tu conexión
require_once __DIR__ . '/../librerias/TCPDF/tcpdf.php'; // ajusta si está en otra ruta

$id = $_GET['id'] ?? null;

if (!$id) {
    die("ID no especificado");
}

try {
    $conn = conectaDb();
    $stmt = $conn->prepare("SELECT title, content FROM publications WHERE id = ?");
    $stmt->execute([$id]);
    $publicacion = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$publicacion) {
        die("Publicación no encontrada");
    }

    // Crear PDF con TCPDF
    $pdf = new TCPDF();
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Sistema SENNOVA');
    $pdf->SetTitle($publicacion['title']);
    $pdf->SetMargins(20, 20, 20);
    $pdf->AddPage();

    $html = '
        <h1>' . htmlspecialchars($publicacion['title']) . '</h1>
        <p>' . nl2br(htmlspecialchars($publicacion['content'])) . '</p>
    ';

    $pdf->writeHTML($html, true, false, true, false, '');

    $nombreArchivo = 'publicacion_' . $id . '.pdf';
    $pdf->Output($nombreArchivo, 'D'); // Descargar directamente
    exit;
} catch (Exception $e) {
    echo "Error al generar el PDF: " . $e->getMessage();
}
