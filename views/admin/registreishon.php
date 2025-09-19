<?php
// Conexión a la base de datos
$conn = new mysqli("localhost", "root", "", "sennova2");

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Borrar registro de auditoría
if (isset($_POST['borrar']) && isset($_POST['fecha']) && isset($_POST['usuario']) && isset($_POST['descripcion'])) {
    $fecha = $_POST['fecha'];
    $usuario = $_POST['usuario'];
    $descripcion = $_POST['descripcion'];
    $sqlDelete = "DELETE FROM auditoria_cambios WHERE fecha = ? AND usuario = ? AND descripcion = ?";
    $stmt = $conn->prepare($sqlDelete);
    $stmt->bind_param("sss", $fecha, $usuario, $descripcion);
    $stmt->execute();
    $stmt->close();
}

// Consultar los registros de auditoría
$sql = "SELECT u.username AS usuario, a.descripcion, a.fecha
        FROM auditoria_cambios a
        LEFT JOIN users u ON a.usuario = u.id
        ORDER BY a.fecha DESC, a.id DESC";

$result = $conn->query($sql);
?>
</head>

<body>
    <div class="container">
        <div class="header">
            <h2><i class="fas fa-history me-2"></i> Historial de Cambios</h2>
            <p class="mb-0">Registro completo de todas las actividades del sistema</p>
        </div>

        <div class="table-container">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th><i class="fas fa-user me-1"></i> Usuario</th>
                        <th><i class="fas fa-info-circle me-1"></i> Descripción</th>
                        <th><i class="fas fa-clock me-1"></i> Fecha y Hora</th>
                        <th><i class="fas fa-cog me-1"></i> Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result->num_rows > 0): ?>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td>
                                    <span class="badge-user">
                                        <i class="fas fa-user-circle me-1"></i>
                                        <?php echo htmlspecialchars($row['usuario']); ?>
                                    </span>
                                </td>
                                <td><?php echo htmlspecialchars($row['descripcion']); ?></td>
                                <td class="fecha"><?php echo htmlspecialchars($row['fecha']); ?></td>
                                <td>
                                    <form method="post" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este registro? Esta acción no se puede deshacer.');">
                                        <input type="hidden" name="usuario" value="<?php echo htmlspecialchars($row['usuario']); ?>">
                                        <input type="hidden" name="descripcion" value="<?php echo htmlspecialchars($row['descripcion']); ?>">
                                        <input type="hidden" name="fecha" value="<?php echo htmlspecialchars($row['fecha']); ?>">
                                        <button type="submit" name="borrar" class="btn-borrar">
                                            <i class="fas fa-trash-alt me-1"></i> Borrar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4">
                                <div class="empty-state">
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

    <script>
        // Agrega animación al hacer hover en los botones
        document.querySelectorAll('.btn-borrar').forEach(button => {
            button.addEventListener('mouseenter', function() {
                this.querySelector('i').classList.add('fa-shake');
            });
            button.addEventListener('mouseleave', function() {
                this.querySelector('i').classList.remove('fa-shake');
            });
        });
    </script>

    <?php
    $conn->close();
    ?>
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .container {
            max-width: 1200px;
            margin-top: 30px;
            margin-bottom: 50px;
        }

        .header {
            background: linear-gradient(135deg, #1a1c1dff 0%, #071625ff 100%);
            color: white;
            padding: 20px;
            border-radius: 8px 8px 0 0;
            margin-bottom: -1px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .table-container {
            background-color: white;
            border-radius: 0 0 8px 8px;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.08);
            overflow: hidden;
        }

        .table {
            margin-bottom: 0;
        }

        .table thead th {
            background-color: #343638ff;
            color: white;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.8rem;
            letter-spacing: 0.5px;
            border-bottom: none;
            padding: 15px 20px;
        }

        .table tbody td {
            padding: 12px 20px;
            vertical-align: middle;
            border-top: 1px solid #f1f5f9;
        }

        .table tbody tr:hover {
            background-color: #f8fafc;
        }

        .btn-borrar {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 6px 12px;
            border-radius: 4px;
            font-size: 0.8rem;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
        }

        .btn-borrar:hover {
            background-color: #bb2d3b;
            transform: translateY(-1px);
        }

        .badge-user {
            background-color: #e9ecef;
            color: #495057;
            font-weight: 500;
            padding: 4px 8px;
            border-radius: 4px;
        }

        .fecha {
            color: #6c757d;
            font-size: 0.85rem;
            white-space: nowrap;
        }

        .empty-state {
            padding: 40px;
            text-align: center;
            color: #6c757d;
        }

        .empty-state i {
            font-size: 2.5rem;
            margin-bottom: 15px;
            color: #dee2e6;
        }
    </style>