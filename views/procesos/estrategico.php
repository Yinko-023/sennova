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

<!-- Navbar -->
<nav class="navbar navbar-expand-lg bg-dark shadow-sm mb-4">
  <div class="container justify-content-center">
    <h2 class="navbar-brand mb-0 h1 fs-3 fw-bold text-light">
      <?= htmlspecialchars($proceso['name_but']) ?>
    </h2>
  </div>
</nav>

<!-- Botón Volver -->
<div class="text-center mb-4">
  <a href="/sennova/inAdmin.php?vista=gestion" class="btn btn-lg rounded-pill boton-volver">
    ← Volver al Panel de Gestión
  </a>
</div>

<!-- Fondo decorativo -->
<div class="bg-pattern p-3">
  <div class="container py-4">

    <!-- FORMULARIO -->
    <?php if ((isset($_SESSION['rol']) && $_SESSION['rol'] == 1) ||
              (isset($_SESSION['rol'], $_SESSION['area']) && $_SESSION['rol'] == 3 && $_SESSION['area'] === 'electronica')): ?>
      <div class="row justify-content-center">
        <div class="col-lg-10 col-md-11">
          <div class="card shadow-lg border-0 rounded-4 mb-5">
            <div class="card-body p-4">
              <h4 class="fw-bold text-white text-center mb-4">🛠️ Crear SubProceso</h4>
              <form method="post" action="/sennova/routes/createProces.php" class="row g-4 align-items-end">
                <input type="hidden" name="id_proceso" value="<?= htmlspecialchars($idProceso) ?>">
                <input type="hidden" name="archivo_padre" value="<?= basename(__FILE__) ?>">

                <div class="col-md-5">
                  <label class="form-label">Nombre del SubProceso</label>
                  <input type="text" name="nombre_sub" class="form-control" required placeholder="Ej: Gestión Técnica">
                </div>

                <div class="col-md-5">
                  <label class="form-label">Ruta del archivo</label>
                  <input type="text" name="ruta_sub" class="form-control" required placeholder="Ej: gestionTecnica">
                </div>

                <div class="col-md-2 text-end">
                  <button type="submit" name="crear_sub" class="btn btn-light w-100">
                    <i class="fas fa-plus me-1"></i> Crear
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    <?php endif; ?>

    <!-- SUBPROCESOS -->
    <div class="text-center mb-5">
      <h2 class="fw-bold text-white">📁 Subprocesos del Módulo</h2>
      <p class="text-light">Haz clic en cada uno para ingresar o administrarlo</p>
      <div class="form-underline mx-auto"></div>
    </div>

    <div class="row justify-content-center g-4">
<?php if (!empty($subprocesos)): ?>
  <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 g-4 justify-content-center">
    <?php foreach ($subprocesos as $sub): ?>
      <?php if ($sub['Pro_padre'] === basename(__FILE__)): ?>
        <div class="col d-flex justify-content-center">
          <div class="card card-hover border-0 rounded-4 shadow-sm w-100" style="max-width: 400px;">
            <div class="card-body px-4 py-3 d-flex flex-column justify-content-between">
              <div class="text-center mb-3">
                <i class="fas fa-folder-open fa-2x text-white mb-2"></i>
                <h5 class="fw-bold text-white mb-1"><?= htmlspecialchars($sub['nombre_sub']) ?></h5>
              </div>

              <div class="text-center mb-3">
                <a href="/sennova/views/procesos/sub/<?= htmlspecialchars($sub['ruta_sub']) ?>.php?id_proceso=<?= $idProceso ?>" class="btn btn-outline-light rounded-pill px-4">
                  Ingresar al subproceso
                </a>
              </div>

              <?php if ((isset($_SESSION['rol']) && $_SESSION['rol'] == 1) ||
                        (isset($_SESSION['rol'], $_SESSION['area']) && $_SESSION['rol'] == 3 && $_SESSION['area'] === 'electronica')): ?>
                <div class="text-center mt-2">
                  <form method="post" action="/sennova/routes/createProces.php">
                    <input type="hidden" name="id_sub" value="<?= $sub['id_sub'] ?>">
                    <button type="submit" name="eliminar_sub" class="btn btn-outline-danger btn-delete rounded-pill">
                      Eliminar
                    </button>
                  </form>
                </div>
              <?php endif; ?>
            </div>
          </div>
        </div>
      <?php endif; ?>
    <?php endforeach; ?>
  </div>
<?php else: ?>
  <div class="col-12 text-center">
    <p class="text-muted fs-5">No hay subprocesos registrados aún.</p>
  </div>
<?php endif; ?>

    </div>

  </div>
</div>

<!-- Dark Professional Styles -->
<style>
  body {
    background-color: #121212;
    color: #ffffff;
    font-family: 'Segoe UI', sans-serif;
  }

  .navbar {
    background-color: #1f1f1f !important;
  }

  .boton-volver {
    font-size: 1.1rem;
    font-weight: 500;
    transition: all 0.3s ease;
    background-color: transparent;
    border: 2px solid #ffffff;
    color: #ffffff;
  }

  .boton-volver:hover {
    background-color: #ffffff;
    color: #121212;
    transform: scale(1.05);
    box-shadow: 0 0.5rem 1rem rgba(255, 255, 255, 0.2);
  }

  .bg-pattern {
    background: linear-gradient(to bottom right, #1c1c1c, #2a2a2a);
    border-radius: 0.5rem;
  }

  .card {
    background-color: #1f1f1f;
    color: #ffffff;
  }

  .form-label {
    color: #cccccc;
  }

  .form-control {
    background-color: #2a2a2a;
    color: #ffffff;
    border: 1px solid #444;
  }

  .form-control::placeholder {
    color: #999;
  }

  .form-underline {
    height: 4px;
    width: 60px;
    background-color: #ffffff;
    border-radius: 10px;
    margin-top: 8px;
  }

  .card-hover {
    transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
    background-color: #1f1f1f;
    border: 1px solid #333;
  }

  .card-hover:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 20px rgba(255, 255, 255, 0.1);
  }

  .btn-outline-light:hover {
    background-color: #ffffff;
    color: #121212;
  }

  .btn-delete:hover {
    background-color: #dc3545;
    color: white;
    transform: scale(1.05);
  }
</style>

<!-- Bootstrap Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
