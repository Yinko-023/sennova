<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

require_once '../../models/PubliModel.php';

$model = new GestionModel();
$idProceso = $_GET['id_ges'] ?? null;

if (!$idProceso) {
  echo "<div class='alert alert-danger'>❌ Proceso no especificado.</div>";
  exit;
}

$proceso = $model->obtenerPorId($idProceso);
if (!$proceso) {
  echo "<div class='alert alert-danger'>❌ Proceso no encontrado.</div>";
  exit;
}

$subprocesos = $model->obtenerPorProceso($idProceso);
?>

<!-- Bootstrap & FontAwesome -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark fixed-top">
  <div class="container">
    <h2 class="navbar-brand mb-0">
      <i class="fas fa-project-diagram me-2" style="color: var(--accent-color);"></i>
      <?= htmlspecialchars($proceso['name_but']) ?>
    </h2>
    <a href="/sennova/inAdmin.php?vista=gestion" class="btn btn-outline-light">
      <i class="fas fa-arrow-left me-2"></i>Volver al Panel de Gestión
    </a>
  </div>
</nav>

<!-- Main Content -->
<div class="container py-section">
  <!-- FORMULARIO -->
  <?php if ((isset($_SESSION['rol']) && $_SESSION['rol'] == 1) ||
    (isset($_SESSION['rol'], $_SESSION['area']) && $_SESSION['rol'] == 3 && $_SESSION['area'] === 'electronica')
  ): ?>
    <div class="row justify-content-center mb-5">
      <div class="col-lg-10">
        <div class="card-form">
          <h4 class="fw-bold text-center mb-4">
            <i class="fas fa-plus-circle me-2" style="color: var(--accent-color);"></i>Crear Subproceso
          </h4>
          <form method="post" action="/sennova/routes/createProces.php" class="row g-3 align-items-end">
            <input type="hidden" name="id_proceso" value="<?= htmlspecialchars($idProceso) ?>">
            <input type="hidden" name="archivo_padre" value="<?= basename(__FILE__) ?>">

            <div class="col-md-5">
              <label class="form-label" style="color: #ffffff94;">Nombre del Subproceso</label>
              <input type="text" name="nombre_sub"
                class="form-control form-control-custom"
                required
                placeholder="Ej: Gestión Técnica">
            </div>

            <div class="col-md-5">
              <label class="form-label" style="color: #ffffff94;">Ruta del archivo</label>
              <input type="text" name="ruta_sub"
                class="form-control form-control-custom"
                required
                placeholder="Ej: gestionTecnica">
            </div>


            <div class="col-md-2">
              <button type="submit" name="crear_sub" class="btn btn-primary-custom w-100">
                <i class="fas fa-plus me-1"></i> Crear
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  <?php endif; ?>

  <!-- SUBPROCESOS -->
  <div class="text-center mb-5 px-content">
    <h2 class="fw-bold ">
      <i class="fas fa-folder me-2" style="color: var(--accent-color);"></i>Subprocesos del Módulo
    </h2>
    <p class="mt-5" style="color: #ffffff94;">Selecciona un subproceso para gestionar sus archivos</p>
  </div>

  <div class="row-cols-subprocess">
    <?php if (!empty($subprocesos)): ?>
      <?php foreach ($subprocesos as $sub): ?>
        <?php if ($sub['Pro_padre'] === basename(__FILE__)): ?>
          <div class="card-subprocess text-center">
            <div class="mb-4">
              <i class="fas fa-folder-open fa-3x mb-3" style="color: var(--accent-color);"></i>
              <h5 class="fw-bold mb-2"><?= htmlspecialchars($sub['nombre_sub']) ?></h5>
              <p class="text-muted small mb-3"><?= htmlspecialchars($sub['ruta_sub']) ?></p>
            </div>

            <div class="mb-3">
              <a href="/sennova/views/procesos/sub/<?= htmlspecialchars($sub['ruta_sub']) ?>.php?id_proceso=<?= $idProceso ?>"
                class="btn btn-primary-custom w-100">
                <i class="fas fa-sign-in-alt me-2"></i>Ingresar
              </a>
            </div>

            <?php if ((isset($_SESSION['rol']) && $_SESSION['rol'] == 1) ||
              (isset($_SESSION['rol'], $_SESSION['area']) && $_SESSION['rol'] == 3 && $_SESSION['area'] === 'electronica')
            ): ?>
              <div class="mt-2">
                <form method="post" action="/sennova/routes/createProces.php" class="d-inline">
                  <input type="hidden" name="id_sub" value="<?= $sub['id_sub'] ?>">
                  <button type="submit" name="eliminar_sub"
                    class="btn btn-outline-danger btn-sm"
                    onclick="return confirm('¿Estás seguro de eliminar este subproceso?')">
                    <i class="fas fa-trash me-1"></i>Eliminar
                  </button>
                </form>
              </div>
            <?php endif; ?>
          </div>
        <?php endif; ?>
      <?php endforeach; ?>
    <?php else: ?>
      <div class="empty-state">
        <i class="fas fa-folder-open"></i>
        <h4 class="mb-3">No hay subprocesos registrados</h4>
        <p class="text-muted">Crea tu primer subproceso utilizando el formulario superior</p>
      </div>
    <?php endif; ?>
  </div>
</div>

<!-- Bootstrap Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

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
  }

  /* Navbar mejorado */
  .navbar {
    background-color: var(--card-bg) !important;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
    padding: 9px 0;
  }

  .navbar-brand {
    font-weight: 700;
    font-size: 1.4rem;
    letter-spacing: -0.5px;
  }

  /* Contenedor principal */
  .container {
    max-width: 1200px;
    margin: 0 auto;
  }

  /* Tarjetas de subprocesos */
  .card-subprocess {
    background: var(--card-bg);
    border-radius: var(--border-radius);
    border: 1px solid rgba(255, 255, 255, 0.05);
    padding: 25px;
    transition: var(--transition);
    height: 100%;
    position: relative;
    overflow: hidden;
  }

  .card-subprocess::before {
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

  .card-subprocess:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.3);
  }

  .card-subprocess:hover::before {
    opacity: 1;
  }

  /* Botones */
  .btn-primary-custom {
    background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
    border: none;
    color: white;
    padding: 12px 25px;
    border-radius: 8px;
    font-weight: 500;
    transition: var(--transition);
  }

  .btn-primary-custom:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(67, 97, 238, 0.3);
    color: white;
  }

  .btn-outline-light {
    border: 2px solid var(--text-light);
    color: var(--text-light);
    padding: 5px 10px;
    border-radius: 30px;
    font-weight: 500;
    transition: var(--transition);
  }

  .btn-outline-light:hover {
    background: var(--text-light);
    color: var(--dark-bg);
    transform: translateY(-2px);
  }

  /* Formularios */
  .form-control-custom {
    background-color: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(255, 255, 255, 0.1);
    color: var(--text-light);
    padding: 12px 16px;
    border-radius: 8px;
    transition: var(--transition);
    color: white !important;
    background-color: transparent;
  }

  .form-control-custom::placeholder {
    color: rgba(255, 255, 255, 0.6) !important;
    /* Placeholder más suave */
  }

  .form-control-custom:focus {
    background-color: rgba(255, 255, 255, 0.08);
    border-color: var(--primary-color);
    box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.2);
    color: var(--text-light);

  }

  /* Títulos */
  .section-title {
    position: relative;
    padding-bottom: 15px;
    margin-bottom: 30px;
  }

  .section-title::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 60px;
    height: 4px;
    background: linear-gradient(90deg, var(--primary-color), var(--accent-color));
    border-radius: 2px;
  }

  /* Estado vacío */
  .empty-state {
    text-align: center;
    padding: 60px 20px;
    background-color: var(--card-bg);
    border-radius: var(--border-radius);
    border: 2px dashed rgba(255, 255, 255, 0.1);
  }

  .empty-state i {
    font-size: 4rem;
    color: var(--text-muted);
    margin-bottom: 20px;
  }

  /* Tarjeta de formulario */
  .card-form {
    background: linear-gradient(135deg, var(--card-bg), #233044);
    border-radius: var(--border-radius);
    border: 1px solid rgba(255, 255, 255, 0.05);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
    padding: 25px;
    margin-bottom: 30px;
  }

  /* Responsive Design */
  @media (max-width: 768px) {
    body {
      padding-top: 70px;
    }

    .navbar-brand {
      font-size: 1.2rem;
    }

    .section-title {
      font-size: 1.5rem;
    }

    .card-subprocess {
      padding: 20px;
    }

    .btn-primary-custom,
    .btn-outline-light {
      padding: 10px 20px;
      font-size: 0.9rem;
    }

    .card-form {
      padding: 20px;
    }
  }

  @media (max-width: 576px) {
    .navbar-brand {
      font-size: 1.1rem;
    }

    .section-title {
      font-size: 1.3rem;
    }

    .card-subprocess {
      padding: 15px;
    }

    .empty-state {
      padding: 40px 15px;
    }

    .empty-state i {
      font-size: 3rem;
    }

    .card-form {
      padding: 15px;
    }

    .form-control-custom {
      padding: 10px 12px;
    }
  }

  /* Ajustes específicos para espaciado */
  .py-section {
    padding: 3rem 0;
  }

  .px-content {
    padding: 0 15px;
  }

  @media (max-width: 768px) {
    .py-section {
      padding: 2rem 0;
    }

    .px-content {
      padding: 0 10px;
    }
  }

  /* Grid mejorado */
  .row-cols-subprocess {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 1.5rem;
    margin: 0 auto;
  }

  @media (max-width: 768px) {
    .row-cols-subprocess {
      grid-template-columns: 1fr;
      gap: 1rem;
    }
  }
</style>