<?php
require_once 'controllers/PubliController.php';
require_once 'models/PubliModel.php';
require_once 'conexion/conexion.php';

if (isset($_GET['token'])) {
    $token = $_GET['token'];
    $conn = conectaDb(); 


    $stmt = $conn->prepare("SELECT id FROM users WHERE email_token = ? AND email_verified = 0");
    $stmt->execute([$token]);

    if ($stmt->rowCount() > 0) {
        $update = $conn->prepare("UPDATE users SET email_verified = 1, email_token = NULL WHERE email_token = ?");
        $update->execute([$token]);

        echo "✅ Tu correo ha sido verificado correctamente. Ya puedes iniciar sesión.";
    } else {
        echo "❌ El token es inválido o el correo ya fue verificado.";
    }
} else {
    echo "❌ Token no proporcionado.";
}


<<<PHP
<?php
\$rol = \$_SESSION['rol'] ?? 4;
\$archivoMapa = 'inUsuario.php';

if (\$rol == 1 || \$rol == 3) {
    \$archivoMapa = 'inAdmin.php';
} elseif (\$rol == 2 || \$rol == 4) {
    \$archivoMapa = 'inEditor.php';
}
\$nombreProceso = basename(__FILE__, '.php');
\$mensaje = '';
\$archivoSubido = null;
\$directorio = __DIR__ . '/../../public/archivos/';

if (\$_SERVER['REQUEST_METHOD'] === 'POST' && isset(\$_FILES['archivo'])) {
    \$archivo = \$_FILES['archivo'];
    \$extension = strtolower(pathinfo(\$archivo['name'], PATHINFO_EXTENSION));
    \$nombreOriginal = pathinfo(\$archivo['name'], PATHINFO_FILENAME);
    \$nombreSanitizado = preg_replace('/[^a-zA-Z0-9_-]/', '_', \$nombreOriginal);

    if (!is_dir(\$directorio)) {
        mkdir(\$directorio, 0777, true);
    }

    if (in_array(\$extension, ['docx', 'pdf'])) {
        \$rutaDestino = \$directorio . \$nombreSanitizado . '.' . \$extension;
        if (move_uploaded_file(\$archivo['tmp_name'], \$rutaDestino)) {
            \$mensaje = '<div class="alert alert-success">Archivo subido correctamente.</div>';
        } else {
            \$mensaje = '<div class="alert alert-danger">Error al subir el archivo.</div>';
        }
    } else {
        \$mensaje = '<div class="alert alert-warning">Formato no válido. Solo .docx o .pdf</div>';
    }
}

if (isset(\$_POST['eliminar_archivo'])) {
    \$archivos = glob(\$directorio . '*.{pdf,docx}', GLOB_BRACE);
    \$eliminado = false;

    foreach (\$archivos as \$archivo) {
        if (file_exists(\$archivo)) {
            unlink(\$archivo);
            \$eliminado = true;
        }
    }

    \$mensaje = \$eliminado
        ? '<div class="alert alert-success">Archivo(s) eliminado(s).</div>'
        : '<div class="alert alert-warning">No hay archivos que eliminar.</div>';
}

\$archivos = glob(\$directorio . '*.{pdf,docx}', GLOB_BRACE);
\$archivoSubido = null;
\$tipo = null;

if (!empty(\$archivos)) {
    usort(\$archivos, fn(\$a, \$b) => filemtime(\$b) - filemtime(\$a));
    \$archivoReciente = basename(\$archivos[0]);
    \$archivoSubido = 'public/archivos/' . \$archivoReciente;
    \$extensionArchivo = strtolower(pathinfo(\$archivoReciente, PATHINFO_EXTENSION));
    \$tipo = \$extensionArchivo === 'pdf' ? 'pdf' : 'word';
}
?>

<head>
    <meta charset="UTF-8">
    <title>Gestion Organizacional y de Riesgo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(120deg, #f0f2f5 0%, #d9e4ea 100%);
            background-attachment: fixed;
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .card {
            border-radius: 1rem;
            background-color: #ffffff;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s ease;
        }
        .card:hover {
            box-shadow: 0 12px 28px rgba(0, 0, 0, 0.15);
        }
        .custom-header {
            background: linear-gradient(to right, #00324d, #005580);
            color: white;
            padding: 1.2rem 1rem;
            border-radius: 1rem 1rem 0 0;
            box-shadow: inset 0 -1px 0 rgba(255, 255, 255, 0.1);
            text-align: center;
            font-size: 1.5rem;
            font-weight: bold;
        }
        .btn-resaltado {
            background: linear-gradient(90deg, #007bff, #00aaff);
            color: #fff;
            border: none;
            animation: pulseBtn 2.5s infinite;
            box-shadow: 0 4px 12px rgba(0, 123, 255, 0.3);
            transition: background 0.3s ease, box-shadow 0.3s ease;
        }
        .btn-resaltado:hover {
            background: linear-gradient(90deg, #0056b3, #0099cc);
            box-shadow: 0 6px 16px rgba(0, 123, 255, 0.5);
        }
        @keyframes pulseBtn {
            0% { transform: scale(1); box-shadow: 0 0 0 0 rgba(0, 123, 255, 0.5); }
            70% { transform: scale(1.02); box-shadow: 0 0 0 10px rgba(0, 123, 255, 0); }
            100% { transform: scale(1); box-shadow: 0 0 0 0 rgba(0, 123, 255, 0); }
        }
    </style>
</head>
<body>
    <div class="container mt-5 d-flex justify-content-center">
        <div class="text-end mb-3" data-aos="fade-up">
            <a href="<?= \$archivoMapa ?>?vista=gestion" class="btn btn-resaltado shadow-sm px-4 py-2 fw-semibold rounded-pill">
                <i class="fas fa-map-marked-alt me-2"></i> Volver al Mapa de Procesos
            </a>
        </div>
    </div>
    <div class="container py-4">
        <div class="card p-4" data-aos="fade-up">
            <div class="custom-header text-center">
                Gestion Organizacional y de Riesgo
            </div>
            <div class="card-body p-4">
                <?= \$mensaje ?>
                <form method="post" enctype="multipart/form-data" class="mb-4" data-aos="fade-right">
                    <div class="row align-items-center mb-3" data-aos="fade-up">
                        <div class="col-md-6">
                            <label for="archivo" class="form-label mb-0">Subir archivo (.pdf o .docx)</label>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="file" name="archivo" id="archivo" class="form-control form-control-lg" accept=".pdf,.docx" required>
                        <button type="submit" class="btn btn-success">Subir y procesar</button>
                    </div>
                </form>
                <?php if (\$archivoSubido): ?>
                    <form method="post" onsubmit="return confirm('¿Seguro que deseas eliminar el archivo actual?');" class="mb-4" data-aos="fade-left">
                        <input type="hidden" name="eliminar_archivo" value="1">
                        <button type="submit" class="btn btn-outline-danger shadow-sm">
                            <i class="fas fa-trash-alt me-2"></i>Eliminar archivo actual
                        </button>
                    </form>
                    <div data-aos="zoom-in">
                        <?php if (\$tipo === 'pdf'): ?>
                            <div class="ratio ratio-4x3" style="min-height: 700px;">
                                <iframe src="<?= \$archivoSubido ?>" style="border: 2px solid #007bff;" allowfullscreen></iframe>
                            </div>
                        <?php elseif (\$tipo === 'word'): ?>
                            <div class="alert alert-info">
                                Se subió un archivo Word: <strong><?= basename(\$archivoSubido) ?></strong>.
                                Para visualizar su contenido se recomienda convertirlo a PDF o usar PHPWord.
                            </div>
                        <?php endif; ?>
                    </div>
                <?php else: ?>
                    <div class="alert alert-warning" data-aos="zoom-in">No hay archivo cargado aún.</div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>AOS.init();</script>
</body>
PHP;