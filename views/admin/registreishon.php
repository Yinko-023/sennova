<?php
$conn = new mysqli("localhost", "root", "", "sennova2");
$conn->set_charset('utf8mb4');
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

/* ---- Eliminar registro por id_cam (nuevo esquema) ---- */
if (isset($_POST['borrar']) && isset($_POST['id_cam'])) {
    $id_cam = (int)$_POST['id_cam'];
    $stmt = $conn->prepare("DELETE FROM auditoria_cambios WHERE id_cam = ?");
    $stmt->bind_param("i", $id_cam);
    $stmt->execute();
    $stmt->close();
}

/* ---- Listado: usa usuario_nombre o username de users si viene null ---- */
$sql = "SELECT 
            a.id_cam,
            COALESCE(a.usuario_nombre, u.username) AS usuario,
            a.descripcion,
            a.fecha
        FROM auditoria_cambios a
        LEFT JOIN users u ON a.usuario_id = u.id
        ORDER BY a.fecha DESC, a.id_cam DESC";
$result = $conn->query($sql);
?>

<div class="container" id="historial-container">
    <div class="header" id="historial-header">
        <h2><i class="fas fa-history me-2"></i> Historial de Cambios</h2>
        <p class="mb-0">Registro completo de todas las actividades del sistema</p>
    </div>

    <div class="table-container" id="historial-table-container">
        <table class="table table-hover" id="historial-table">
            <thead>
                <tr>
                    <th><i class="fas fa-user me-1"></i> Usuario</th>
                    <th><i class="fas fa-info-circle me-1"></i> Descripción</th>
                    <th><i class="fas fa-clock me-1"></i> Fecha y Hora</th>
                    <th><i class="fas fa-cog me-1"></i> Acción</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result && $result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td>
                                <span class="badge-user" id="user-badge">
                                    <i class="fas fa-user-circle me-1"></i>
                                    <?= htmlspecialchars($row['usuario'] ?? '—') ?>
                                </span>
                            </td>
                            <td id="description-cell"><?= htmlspecialchars($row['descripcion'] ?? '') ?></td>
                            <td class="fecha" id="date-cell"><?= htmlspecialchars($row['fecha'] ?? '') ?></td>
                            <td>
                                <form method="post" onsubmit="return confirm('¿Estás seguro de eliminar este registro? Esta acción no se puede deshacer.');">
                                    <input type="hidden" name="id_cam" value="<?= (int)$row['id_cam'] ?>">
                                    <button type="submit" name="borrar" class="btn-borrar" id="delete-button">
                                        <i class="fas fa-trash-alt me-1"></i> Borrar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4">
                            <div class="empty-state" id="empty-state">
                                <i class="fas fa-inbox"></i>
                                <h4>No hay registros disponibles</h4>
                                <p>No se han encontrado cambios registrados en el sistema</p>
                            </div>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<style>
    #historial-container {
        max-width: 1200px;
        margin-top: 30px;
        margin-bottom: 50px;
    }

    #historial-header {
        background: linear-gradient(90deg, #2c3e50 0%, #1a1a2e 100%);
        color: #fff;
        padding: 20px;
        border-radius: 8px 8px 0 0;
        margin-bottom: -1px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, .1);
    }

    #historial-table-container {
        background: #fff;
        border-radius: 0 0 8px 8px;
        box-shadow: 0 2px 15px rgba(0, 0, 0, .08);
        overflow: hidden;
    }

    #historial-table {
        margin-bottom: 0;
    }

    #historial-table thead th {
        background:  #384a5cff;
        color: #fff;
        font-weight: 600;
        text-transform: uppercase;
        font-size: .8rem;
        letter-spacing: .5px;
        border-bottom: none;
        padding: 15px 20px;
    }

    #historial-table tbody td {
        padding: 12px 20px;
        vertical-align: middle;
        border-top: 1px solid #f1f5f9;
    }

    #historial-table tbody tr:hover {
        background: #f8fafc;
    }

    #delete-button {
        background: #dc3545;
        color: #fff;
        border: none;
        padding: 6px 12px;
        border-radius: 4px;
        font-size: .8rem;
        transition: .2s;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    #delete-button:hover {
        background: #bb2d3b;
        transform: translateY(-1px);
    }

    #user-badge {
        background: #e9ecef;
        color: #495057;
        font-weight: 500;
        padding: 4px 8px;
        border-radius: 4px;
    }

    #date-cell {
        color: #6c757d;
        font-size: .85rem;
        white-space: nowrap;
    }

    #empty-state {
        padding: 40px;
        text-align: center;
        color: #6c757d;
    }

    #empty-state i {
        font-size: 2.5rem;
        margin-bottom: 15px;
        color: #dee2e6;
    }
</style>

<script>
    // Animación ligera en el ícono del botón borrar
    document.querySelectorAll('.btn-borrar').forEach(btn => {
        btn.addEventListener('mouseenter', () => btn.querySelector('i')?.classList.add('fa-shake'));
        btn.addEventListener('mouseleave', () => btn.querySelector('i')?.classList.remove('fa-shake'));
    });
</script>
<?php $conn->close(); ?>