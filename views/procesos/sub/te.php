<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
require_once __DIR__ . '/../../../models/PubliModel.php';

$id_proceso = $_GET['id_proceso'] ?? $_GET['id_ges'] ?? null;

if (!$id_proceso) {
    echo "<div class='alert alert-danger'>❌ No se proporcionó el ID del proceso.</div>";
    exit;
}

$archivoActual = basename(__FILE__, '.php');

$gestion = new ArchivoModel();
$subprocesoBD = $gestion->buscarSubprocesoPorRuta($archivoActual, $id_proceso);

if (!$subprocesoBD) {
    echo "<div class='alert alert-danger'>⚠️ No se ha definido el subproceso (origen).</div>";
    exit;
}

$origen = $subprocesoBD['ruta_sub'];
$archivoPadre = $subprocesoBD['Pro_padre'];

$volverURL = "/sennova/views/procesos/{$archivoPadre}?id_ges={$id_proceso}";

$modelo = new ArchivoModel();
$archivos = $modelo->obtenerPorOrigen($origen);

function obtenerIcono($ext)
{
    $ext = strtolower($ext);
    switch ($ext) {
        case 'pdf':
            return '<i class="fas fa-file-pdf fa-3x text-danger mb-3"></i>';
        case 'doc':
        case 'docx':
            return '<i class="fas fa-file-word fa-3x text-primary mb-3"></i>';
        case 'xls':
        case 'xlsx':
            return '<i class="fas fa-file-excel fa-3x text-success mb-3"></i>';
        case 'jpg':
        case 'jpeg':
        case 'png':
        case 'gif':
            return '<i class="fas fa-file-image fa-3x text-warning mb-3"></i>';
        default:
            return '<i class="fas fa-file fa-3x text-secondary mb-3"></i>';
    }
}
?>
<!-- Estilos y recursos -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">


<!-- Navbar mejorado -->
<nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="background-color: var(--card-bg); box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);">
    <div class="container-fluid px-3 px-md-4 px-lg-5">
        <span class="navbar-brand fw-bold">
            <i class="fas fa-folder-open me-2" style="color: var(--accent-color);"></i>
            <a class="text-white" style="text-decoration: none;" href="/sennova/inAdmin.php?vista=gestion">
                <?= htmlspecialchars(ucfirst($origen)) ?>
            </a>
        </span>
        <a href="<?= $volverURL ?>" class="btn btn-outline-light rounded-pill d-flex align-items-center">
            <i class="fas fa-arrow-left me-1 me-md-2"></i>
            <span class="d-none d-md-inline">Regresar</span>
        </a>
    </div>
</nav>

<!-- Contenido principal -->
<div class="container-fluid py-4 py-md-5">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-11">
            <!-- Encabezado -->
            <div class=" px-3 text-center">
                <h1 class="fw-bold mb-2">Archivos de <?= htmlspecialchars(ucfirst($origen)) ?></h1>
            </div>

            <!-- Sección de carga de archivos -->
            <?php if (
                isset($_SESSION['rol']) &&
                (
                    $_SESSION['rol'] == 1 ||
                    ($_SESSION['rol'] == 3 && isset($_SESSION['area']) && $_SESSION['area'] === 'electronica')
                )
            ): ?>
                <p style="color: white;" class="mb-0 px-3 mt-5 text-center">
                    Gestiona los documentos relacionados con
                    <span style="color: var(--accent-color);">
                        <?= htmlspecialchars($origen) ?>
                    </span>
                </p>

                <div class="upload-section fade-in mt-4 mx-2 mx-md-3 text-center" data-aos="fade-up">
                    <div class="text-center">
                        <h5 class="mb-3 mb-md-4 d-flex align-items-center justify-content-center">
                            <i class="fas fa-cloud-upload-alt me-2" style="color: var(--accent-color);"></i>
                            Agregar nuevo archivo
                        </h5>
                    </div>
                    <form action="/sennova/routes/archiveSubproces.php?action=subir" method="POST" enctype="multipart/form-data" class="row g-2 g-md-3 align-items-end">
                        <div class="col-12 col-md-6">
                            <label for="archivoInput" class="form-label text-white small">Seleccionar archivo</label>
                            <input type="file" class="form-control custom-file-input" id="archivoInput" name="archivo" accept=".pdf,.doc,.docx,.xls,.xlsx,.jpg,.png" required>
                        </div>
                        <div class="col-md-4 d-none d-md-block">
                            <input type="hidden" name="origen" value="<?= htmlspecialchars($origen) ?>">
                            <input type="hidden" name="id_proceso" value="<?= htmlspecialchars($id_proceso) ?>">
                            <input type="hidden" name="subproceso" value="<?= htmlspecialchars($subproceso) ?>">
                        </div>
                        <div class="col-12 col-md-6 col-lg-2 mt-2 mt-md-0">
                            <button type="submit" class="btn btn-download w-100 d-flex align-items-center justify-content-center">
                                <i class="fas fa-upload me-1 me-md-2"></i>
                                <span>Subir</span>
                            </button>
                        </div>
                    </form>
                </div>
            <?php endif; ?>

            <!-- Lista de archivos -->
            <div class="mb-5 mt-4 mt-md-5 px-2 px-md-3">
                <h5 class="mb-3 mb-md-4 d-flex align-items-center px-1">
                    <i class="fas fa-files me-2" style="color: var(--accent-color);"></i>
                    Archivos disponibles
                    <span class="badge bg-primary ms-2"><?= count($archivos) ?></span>
                </h5>

                <?php if (!empty($archivos)): ?>
                    <div class="row g-3 g-md-4">
                        <?php foreach ($archivos as $index => $archivo): ?>
                            <div class="col-12 col-sm-6 col-lg-4 fade-in delay-<?= ($index % 3) + 1 ?>" data-aos="fade-up" data-aos-delay="<?= ($index % 3) * 100 ?>">
                                <div class="file-card h-100 d-flex flex-column">
                                    <div class="text-center mb-2 mb-md-3">
                                        <?= obtenerIcono($archivo['extension_ar']) ?>
                                    </div>

                                    <h6 class="file-name text-center"><?= htmlspecialchars($archivo['name_ar']) ?></h6>

                                    <div class="mt-auto">
                                        <div class="d-flex justify-content-center gap-1 gap-md-2 flex-wrap">
                                            <a href="/sennova/routes/archiveSubproces.php?action=descargar&id=<?= $archivo['id_ar'] ?>"
                                                class="btn btn-download">
                                                <i class="fas fa-download me-1"></i>Descargar
                                            </a>

                                            <button class="btn btn-view"
                                                onclick="mostrarVistaPrevia('<?= htmlspecialchars($archivo['ruta_ar']) ?>', '<?= strtolower($archivo['extension_ar']) ?>')">
                                                <i class="fas fa-eye me-1"></i>Ver
                                            </button>
                                            <?php if (
                                                isset($_SESSION['rol']) &&
                                                (
                                                    $_SESSION['rol'] == 1 ||
                                                    ($_SESSION['rol'] == 3 && isset($_SESSION['area']) && $_SESSION['area'] === 'electronica')
                                                )
                                            ): ?>
                                                <a href="/sennova/routes/archiveSubproces.php?action=eliminar&id=<?= $archivo['id_ar'] ?>&origen=<?= urlencode($origen) ?>"
                                                    class="btn btn-delete"
                                                    onclick="return confirm('¿Estás seguro de que deseas eliminar este archivo?')">
                                                    <i class="fas fa-trash me-1"></i>Eliminar
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="empty-state fade-in mx-2" data-aos="fade-up">
                        <i class="fas fa-folder-open"></i>
                        <h4 class="mb-2 mb-md-3">No hay archivos disponibles</h4>
                        <p class="text-white mb-0">Sube el primer archivo utilizando el formulario superior</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- Modal para vista previa -->
<div class="modal fade" id="modalVistaPrevia" tabindex="-1" aria-labelledby="vistaLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Vista Previa del Archivo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body p-0" id="vistaPreviaContenido" style="min-height: 400px;"></div>
        </div>
    </div>
</div>

<style>
    :root {
        --primary-color: #4361ee;
        --secondary-color: #3f37c9;
        --accent-color: #4895ef;
        --dark-bg: #121826;
        --card-bg: #1e293b;
        --text-light: #f8fafc;
        --text-muted: #94a3b8;
        --border-radius: 12px;
        --transition: all 0.3s ease;
    }

    body {
        font-family: 'Inter', sans-serif;
        background-color: var(--dark-bg);
        color: var(--text-light);
        padding-top: 80px;
        min-height: 100vh;
        margin: 0;
        display: flex;
        flex-direction: column;
    }

    main {
        flex: 1;
        padding-bottom: 20px;
    }

    .navbar-brand {
        font-weight: 700;
        letter-spacing: -0.5px;
    }

    .page-title {
        position: relative;
        padding: 20px 0;
        margin-bottom: 30px;
    }

    .page-title::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 60px;
        height: 4px;
        background: linear-gradient(90deg, var(--primary-color), var(--accent-color));
        border-radius: 2px;
    }

    .upload-section {
        background: linear-gradient(135deg, var(--card-bg), #233044);
        border-radius: var(--border-radius);
        padding: 20px;
        margin-bottom: 30px;
        border: 1px solid rgba(255, 255, 255, 0.05);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
    }

    .file-card {
        background-color: var(--card-bg);
        border-radius: var(--border-radius);
        padding: 20px;
        height: 100%;
        transition: var(--transition);
        border: 1px solid rgba(255, 255, 255, 0.05);
        position: relative;
        overflow: hidden;
    }

    .file-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 4px;
        background: linear-gradient(90deg, var(--primary-color), var(--accent-color));
        opacity: 0;
        transition: var(--transition);
    }

    .file-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.3);
    }

    .file-card:hover::before {
        opacity: 1;
    }

    .file-icon {
        font-size: 2.5rem;
        margin-bottom: 15px;
        transition: var(--transition);
    }

    .file-card:hover .file-icon {
        transform: scale(1.1);
    }

    .file-name {
        font-weight: 600;
        font-size: 0.9rem;
        margin-bottom: 15px;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        height: 42px;
    }

    .btn-action {
        padding: 6px 12px;
        border-radius: 6px;
        font-weight: 500;
        font-size: 0.8rem;
        transition: var(--transition);
    }

    .btn-download {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        color: white;
        border: none;
    }

    .btn-download:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(67, 97, 238, 0.3);
        color: white;
    }

    .btn-view {
        background: rgba(255, 255, 255, 0.1);
        color: var(--text-light);
        border: 1px solid rgba(255, 255, 255, 0.1);
    }

    .btn-view:hover {
        background: rgba(255, 255, 255, 0.15);
        transform: translateY(-2px);
        color: var(--text-light);
    }

    .btn-delete {
        background: rgba(239, 68, 68, 0.1);
        color: #ef4444;
        border: 1px solid rgba(239, 68, 68, 0.2);
    }

    .btn-delete:hover {
        background: rgba(239, 68, 68, 0.2);
        transform: translateY(-2px);
        color: #ef4444;
    }

    .empty-state {
        text-align: center;
        padding: 40px 20px;
        background-color: var(--card-bg);
        border-radius: var(--border-radius);
        border: 2px dashed rgba(255, 255, 255, 0.1);
    }

    .empty-state i {
        font-size: 3rem;
        color: var(--text-muted);
        margin-bottom: 15px;
    }

    .custom-file-input {
        background-color: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
        color: var(--text-light);
        padding: 10px 12px;
        border-radius: 8px;
        font-size: 0.9rem;
    }

    .custom-file-input:focus {
        background-color: rgba(255, 255, 255, 0.08);
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.2);
        color: var(--text-light);
    }

    .modal-content {
        background-color: var(--card-bg);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: var(--border-radius);
    }

    .modal-header {
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    .btn-close {
        filter: invert(1);
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .fade-in {
        animation: fadeIn 0.5s ease forwards;
    }

    .delay-1 {
        animation-delay: 0.1s;
    }

    .delay-2 {
        animation-delay: 0.2s;
    }

    .delay-3 {
        animation-delay: 0.3s;
    }

    /* ======== RESPONSIVE DESIGN MEJORADO ======== */
    /* Pantallas grandes (PC) */
    @media (min-width: 1200px) {
        .container-fluid {
            max-width: 1200px;
            margin: 0 auto;
        }
    }

    /* Tabletas y pantallas medianas */
    @media (max-width: 992px) {
        body {
            padding-top: 70px;
        }

        .navbar .container-fluid {
            padding: 0 15px;
        }

        .page-title h1 {
            font-size: 1.8rem;
        }

        .upload-section {
            padding: 18px;
        }

        .file-card {
            padding: 18px;
        }

        .file-icon {
            font-size: 2.2rem;
        }

        .file-name {
            font-size: 0.85rem;
            height: 38px;
        }

        .btn-action {
            padding: 5px 10px;
            font-size: 0.75rem;
        }
    }

    /* Tabletas pequeñas y móviles grandes */
    @media (max-width: 768px) {
        body {
            padding-top: 60px;
        }

        .navbar-brand {
            font-size: 1rem;
        }

        .navbar-brand i {
            font-size: 1.1rem;
        }

        .btn-outline-light {
            padding: 6px 12px;
            font-size: 0.85rem;
        }

        .page-title h1 {
            font-size: 1.6rem;
            margin-bottom: 10px;
        }

        .page-title::after {
            width: 50px;
            height: 3px;
        }

        .upload-section {
            padding: 15px;
            margin-bottom: 25px;
        }

        .upload-section h5 {
            font-size: 1.1rem;
        }

        .file-card {
            padding: 15px;
            margin-bottom: 15px;
        }

        .file-icon {
            font-size: 2rem;
            margin-bottom: 12px;
        }

        .file-name {
            font-size: 0.82rem;
            height: 36px;
            margin-bottom: 12px;
        }

        .btn-action {
            padding: 5px 9px;
            font-size: 0.72rem;
        }

        .empty-state {
            padding: 30px 15px;
        }

        .empty-state i {
            font-size: 2.5rem;
        }

        .empty-state h4 {
            font-size: 1.2rem;
        }

        .modal-dialog {
            margin: 10px;
        }

        .modal-content iframe {
            height: 400px !important;
        }
    }

    /* Móviles medianos */
    @media (max-width: 576px) {
        body {
            padding-top: 60px;
        }

        .navbar .container-fluid {
            padding: 0 10px;
        }

        .navbar-brand {
            font-size: 0.9rem;
        }

        .btn-outline-light {
            padding: 5px 10px;
            font-size: 0.8rem;
        }

        .page-title h1 {
            font-size: 1.4rem;
        }

        .upload-section .row {
            flex-direction: column;
        }

        .upload-section .col-md-6,
        .upload-section .col-md-2 {
            width: 100%;
            margin-bottom: 10px;
        }

        .file-card {
            padding: 12px;
        }

        .file-icon {
            font-size: 1.8rem;
        }

        .file-name {
            font-size: 0.8rem;
            height: 34px;
        }

        .btn-action {
            padding: 4px 8px;
            font-size: 0.7rem;
        }

        .d-flex.gap-2 {
            flex-direction: column;
            gap: 8px !important;
        }

        .archivo-card .btn {
            width: 100%;
            justify-content: center;
        }

        .empty-state {
            padding: 25px 10px;
        }

        .empty-state i {
            font-size: 2rem;
        }

        .empty-state h4 {
            font-size: 1.1rem;
        }

        .empty-state p {
            font-size: 0.9rem;
        }

        .modal-content iframe {
            height: 350px !important;
        }
    }

    /* Móviles pequeños */
    @media (max-width: 400px) {
        .navbar-brand {
            font-size: 0.8rem;
        }

        .btn-outline-light {
            font-size: 0.75rem;
            padding: 4px 8px;
        }

        .page-title h1 {
            font-size: 1.3rem;
        }

        .upload-section {
            padding: 12px;
        }

        .upload-section h5 {
            font-size: 1rem;
        }

        .file-card {
            padding: 10px;
        }

        .file-icon {
            font-size: 1.6rem;
            margin-bottom: 10px;
        }

        .file-name {
            font-size: 0.75rem;
            height: 32px;
            margin-bottom: 10px;
        }

        .btn-action {
            padding: 4px 6px;
            font-size: 0.65rem;
        }

        .empty-state {
            padding: 20px 10px;
        }

        .empty-state i {
            font-size: 1.8rem;
        }

        .empty-state h4 {
            font-size: 1rem;
        }

        .empty-state p {
            font-size: 0.85rem;
        }

        .modal-content iframe {
            height: 300px !important;
        }
    }

    /* Ajustes específicos para el formulario de subida */
    @media (max-width: 768px) {
        .upload-section form {
            flex-direction: column;
        }

        .upload-section .col-md-6,
        .upload-section .col-md-2 {
            width: 100%;
            margin-bottom: 10px;
        }

        .upload-section .col-md-4 {
            display: none;
        }

        .upload-section button {
            margin-top: 10px;
        }
    }

    /* Ajustes para la cuadrícula de archivos */
    @media (max-width: 768px) {
        .row.g-4 {
            margin-left: -8px;
            margin-right: -8px;
        }

        .col-md-4 {
            padding-left: 8px;
            padding-right: 8px;
            margin-bottom: 16px;
        }
    }
</style>
<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    // Inicializar animaciones
    AOS.init({
        duration: 800,
        easing: 'ease-out-quad',
        once: true
    });

    // Función para mostrar vista previa
    function mostrarVistaPrevia(ruta, extension) {
        const contenido = document.getElementById("vistaPreviaContenido");
        contenido.innerHTML = '';
        const rutaCompleta = `/sennova/${ruta}`;

        if (extension === 'pdf') {
            contenido.innerHTML = `<iframe src="${rutaCompleta}" width="100%" height="400px" style="border: none; border-radius: 0 0 var(--border-radius) var(--border-radius);"></iframe>`;
        } else if (['jpg', 'jpeg', 'png', 'gif'].includes(extension)) {
            contenido.innerHTML = `
                <div style="display: flex; justify-content: center; align-items: center; height: 400px; background-color: #2d3748;">
                    <img src="${rutaCompleta}" style="max-width: 100%; max-height: 100%;" alt="Vista previa">
                </div>`;
        } else {
            contenido.innerHTML = `
                <div class="text-center py-4" style="height: 400px; display: flex; flex-direction: column; justify-content: center; align-items: center;">
                    <i class="fas fa-file fa-4x mb-3" style="color: var(--text-muted);"></i>
                    <h4 class="mb-2">Vista previa no disponible</h4>
                    <p class="text-muted mb-3">Este tipo de archivo no puede visualizarse directamente.</p>
                    <a href="${rutaCompleta}" class="btn btn-download" download>
                        <i class="fas fa-download me-2"></i>Descargar archivo
                    </a>
                </div>`;
        }

        const modal = new bootstrap.Modal(document.getElementById('modalVistaPrevia'));
        modal.show();
    }

    // Subida asíncrona de archivos
    document.addEventListener('DOMContentLoaded', () => {
        const form = document.querySelector('form[action="/sennova/routes/archiveSubproces.php?action=subir"]');
        if (form) {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                const formData = new FormData(this);

                fetch(this.action, {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Recargar la página para mostrar el nuevo archivo
                            location.reload();
                        } else {
                            alert('Error al subir el archivo: ' + (data.message || 'Error desconocido'));
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Error al subir el archivo');
                    });
            });
        }
    });
</script>