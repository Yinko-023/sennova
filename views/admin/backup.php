<?php
require_once __DIR__ . '/../../conexion/conexion.php';

$backupDir = __DIR__ . '/../../backups/';
if (!is_dir($backupDir)) {
    mkdir($backupDir, 0777, true);
}

$mysqldumpPath = 'C:\\xampp\\mysql\\bin\\mysqldump.exe'; // Ruta absoluta a mysqldump
$mysqlPath = 'C:\\xampp\\mysql\\bin\\mysql.exe';         // Ruta absoluta a mysql
$usuario_db = 'root';
$contrasena_db = '';
$nombre_db = 'sennova2';

// Crear backup
if (isset($_POST['crear_backup'])) {
    $fecha = date('Y-m-d_H-i-s');
    $filename = "backup_sennova2_$fecha.sql";
    $filepath = $backupDir . $filename;

    if ($contrasena_db === '') {
        $cmd = "\"$mysqldumpPath\" -u $usuario_db $nombre_db > \"$filepath\"";
    } else {
        $cmd = "\"$mysqldumpPath\" -u $usuario_db -p$contrasena_db $nombre_db > \"$filepath\"";
    }

    exec($cmd, $output, $status);

    if ($status === 0 && file_exists($filepath)) {
        $usuario = $_SESSION['usuario'] ?? 'Desconocido';
        $descripcion = "Creó una copia de seguridad: $filename";
        $conn = conectaDb();
        $sql = "INSERT INTO auditoria_cambios (usuario, descripcion, fecha) VALUES (?, ?, NOW())";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$usuario, $descripcion]);
    } else {
        echo "<div class='alert alert-danger'>❌ Error al crear el backup. Verifica que 'mysqldump' esté disponible.</div>";
        echo "<pre>Comando ejecutado:\n$cmd\n\nSalida:\n" . implode("\n", $output) . "\nCódigo de estado: $status</pre>";
    }
}

// Eliminar backup
if (isset($_POST['eliminar']) && isset($_POST['file'])) {
    $file = basename($_POST['file']);
    $filepath = $backupDir . $file;
    if (file_exists($filepath)) {
        unlink($filepath);

        $usuario = $_SESSION['usuario'] ?? 'Desconocido';
        $descripcion = "Eliminó la copia de seguridad: $file";
        $conn = conectaDb();
        $sql = "INSERT INTO auditoria_cambios (usuario, descripcion, fecha) VALUES (?, ?, NOW())";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$usuario, $descripcion]);
    }
}

// Restaurar backup
if (isset($_POST['restaurar']) && isset($_POST['file'])) {
    $file = basename($_POST['file']);
    $filepath = $backupDir . $file;
    if (file_exists($filepath)) {
        if ($contrasena_db === '') {
            $cmd = "\"$mysqlPath\" -u $usuario_db $nombre_db < \"$filepath\"";
        } else {
            $cmd = "\"$mysqlPath\" -u $usuario_db -p$contrasena_db $nombre_db < \"$filepath\"";
        }

        exec($cmd, $output, $status);

        if ($status === 0) {
            $usuario = $_SESSION['usuario'] ?? 'Desconocido';
            $descripcion = "Restauró la copia de seguridad: $file";
            $conn = conectaDb();
            $sql = "INSERT INTO auditoria_cambios (usuario, descripcion, fecha) VALUES (?, ?, NOW())";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$usuario, $descripcion]);
        } else {
            echo "<div class='alert alert-danger'>❌ Error al restaurar la copia.</div>";
            echo "<pre>Comando ejecutado:\n$cmd\n\nSalida:\n" . implode("\n", $output) . "\nCódigo de estado: $status</pre>";
        }
    }
}

// Listar backups
$backups = array_diff(scandir($backupDir), ['.', '..']);
?>
<style>
  :root {
    --gradient-primary: linear-gradient(90deg, #2c3e50 0%, #1a1a2e 100%);
    --accent-color: #4cc9f0;
    --success-color: #1e7c34ff;
    --danger-color: #c92828ff;
    --warning-color: #f8961e;
    --light-gray: #f8f9fa;
    --medium-gray: #e9ecef;
    --dark-gray: #495057;
  }

  .backup-container {
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    padding: 2rem;
    margin-top: 2rem;
    border: 1px solid rgba(0, 0, 0, 0.05);
  }

  .backup-header {
    margin-bottom: 1.5rem;
    padding-bottom: 1rem;
    border-bottom: 1px solid var(--medium-gray);
  }

  .backup-header h2 {
    color: #2c3e50;
    font-weight: 600;
    display: flex;
    align-items: center;
  }

  .backup-header h2 i {
    margin-right: 0.75rem;
    color: var(--accent-color);
  }

  .backup-actions .btn-dark {
    background: var(--gradient-primary);
    border: none;
    color: white;
    padding: 0.75rem 1.5rem;
    font-weight: 500;
    letter-spacing: 0.5px;
    transition: all 0.3s;
    box-shadow: 0 4px 10px rgba(28, 62, 94, 0.2);
  }

  .backup-actions .btn-dark:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 15px rgba(28, 62, 94, 0.3);
  }

  .backup-table-container {
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
  }

  .backup-table-header {
    background: var(--gradient-primary);
    color: white;
  }

  .backup-table-header th {
    font-weight: 500;
    padding: 1rem;
    text-align: center;
  }

  .backup-table-header th i {
    margin-right: 0.5rem;
  }

  .table-hover tbody tr {
    transition: all 0.2s;
  }

  .table-hover tbody tr:hover {
    background-color: rgba(76, 201, 240, 0.05);
  }

  .table td {
    padding: 1rem;
    vertical-align: middle;
    text-align: center;
  }

  .btn-success {
    background-color: var(--success-color);
    border-color: var(--success-color);
  }

  .btn-danger {
    background-color: var(--danger-color);
    border-color: var(--danger-color);
  }

  .btn-info {
    background-color: var(--accent-color);
    border-color: var(--accent-color);
  }

  .btn-sm {
    padding: 0.5rem 1rem;
    font-size: 0.8rem;
    font-weight: 500;
    display: inline-flex;
    align-items: center;
  }

  .btn-sm i {
    margin-right: 0.25rem;
    font-size: 0.8rem;
  }

  .badge {
    font-weight: 500;
    padding: 0.5rem 0.75rem;
    background-color: var(--light-gray);
    color: var(--dark-gray);
  }

  .empty-state {
    padding: 3rem 1rem;
    text-align: center;
  }

  .empty-state i {
    font-size: 3rem;
    color: var(--medium-gray);
    margin-bottom: 1rem;
  }

  .empty-state h5 {
    color: var(--dark-gray);
    font-weight: 500;
  }

  .empty-state p {
    color: var(--medium-gray);
  }

  /* Efectos para los botones de acción */
  .btn-success:hover {
    background-color: #0d6324ff;
    border-color: #0d6324ff;
    transform: translateY(-2px);
  }

  .btn-danger:hover {
    background-color: #b41212ff;
    border-color: #b41212ff;
    transform: translateY(-2px);
  }

  .btn-info:hover {
    background-color: #3ab4d9;
    border-color: #3ab4d9;
    transform: translateY(-2px);
  }

  /* Responsive */
  @media (max-width: 768px) {
    .backup-container {
      padding: 1.5rem;
    }
    
    .d-flex.gap-2 {
      flex-direction: column;
      gap: 0.5rem !important;
    }
    
    .btn-sm {
      width: 100%;
      justify-content: center;
    }
  }
</style>

<div class="backup-container mt-5">
    <div class="backup-header">
        <h2><i class="fas fa-database me-2"></i> Copia de Seguridad</h2>
        <p class="text-muted">Gestión de respaldos del sistema</p>
    </div>

    <div class="backup-actions mb-4">
        <form method="post" class="d-inline-block">
            <button type="submit" name="crear_backup" class="btn btn-dark">
                <i class="fas fa-plus-circle me-2"></i> Crear copia de seguridad
            </button>
        </form>
    </div>

    <div class="backup-table-container text-center">
        <table class="table table-hover">
            <thead class="backup-table-header">
                <tr>
                    <th><i class="fas fa-file-alt me-1"></i> Archivo</th>
                    <th><i class="fas fa-calendar-alt me-1"></i> Fecha</th>
                    <th><i class="fas fa-cog me-1"></i> Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($backups)): ?>
                    <?php foreach ($backups as $file): ?>
                        <tr>
                            <td class="align-middle">
                                <i class="fas fa-file-archive text-primary me-2"></i>
                                <?= htmlspecialchars($file) ?>
                            </td>
                            <td class="align-middle">
                                <span class="badge bg-light text-dark">
                                    <?= date("Y-m-d H:i:s", filemtime($backupDir . $file)) ?>
                                </span>
                            </td>
                            <td class="align-middle">
                                <div class="d-flex gap-2 justify-content-center">
                                    <form method="post" class="d-inline restaurar-form">
                                        <input type="hidden" name="file" value="<?= htmlspecialchars($file) ?>">
                                        <input type="hidden" name="restaurar" value="1">
                                        <button type="button" class="btn btn-success btn-sm btn-confirmar-restaurar">
                                            <i class="fas fa-redo me-1"></i> Restaurar
                                        </button>
                                    </form>

                                    <form method="post" class="d-inline eliminar-form">
                                        <input type="hidden" name="file" value="<?= htmlspecialchars($file) ?>">
                                        <input type="hidden" name="eliminar" value="1">
                                        <button type="button" class="btn btn-danger btn-sm btn-confirmar-eliminar">
                                            <i class="fas fa-trash-alt me-1"></i> Eliminar
                                        </button>
                                    </form>

                                    <a href="<?= '/backups/' . urlencode($file) ?>" class="btn btn-info btn-sm" download>
                                        <i class="fas fa-download me-1"></i> Descargar
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3" class="text-center py-5">
                            <div class="empty-state">
                                <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                                <h5 class="text-muted">No hay copias de seguridad</h5>
                                <p class="text-muted">Crea tu primera copia de seguridad para comenzar</p>
                            </div>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Confirmación para restaurar
    document.querySelectorAll('.btn-confirmar-restaurar').forEach(boton => {
        boton.addEventListener('click', function() {
            const form = this.closest('form');
            
            Swal.fire({
                title: '¿Restaurar esta copia?',
                text: "Se reemplazará la base de datos actual con esta copia de seguridad.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#0d6324ff',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Sí, restaurar',
                cancelButtonText: 'Cancelar',
                background: '#ffffff',
                backdrop: `
                    rgba(28, 62, 94, 0.4)
                    url("/img/loading.gif")
                    center left
                    no-repeat
                `
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Restaurando...',
                        text: 'Por favor espera mientras se restaura la copia.',
                        timer: 2000,
                        timerProgressBar: true,
                        didOpen: () => {
                            Swal.showLoading();
                            form.submit();
                        }
                    });
                }
            });
        });
    });

    // Confirmación para eliminar
    document.querySelectorAll('.btn-confirmar-eliminar').forEach(boton => {
        boton.addEventListener('click', function() {
            const form = this.closest('form');
            
            Swal.fire({
                title: '¿Eliminar esta copia?',
                text: "No podrás revertir esta acción!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#f72525ff',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar',
                background: '#ffffff'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
</script>