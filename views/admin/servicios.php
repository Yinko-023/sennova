<?php
if (session_status() === PHP_SESSION_NONE) session_start();

$rol  = (int)($_SESSION['rol'] ?? 0);
$area = strtolower(trim((string)($_SESSION['area'] ?? '')));

// Admin o área general/visualizador/indefinida => ver ambas
$isAdmin   = ($rol === 1) || strcasecmp($_SESSION['rol_nombre'] ?? '', 'admin') === 0;
$showBoth  = $isAdmin || $area === '' || $area === 'general' || $area === 'visualizador';

// Normaliza posibles acentos
$esElect = ($area === 'electronica' || $area === 'electrónica');
$esCafe  = ($area === 'cafe' || $area === 'café');
?>

<?php if ($showBoth): ?>

  <div class="container-fluid">
    <div class="row g-4 align-items-start">

      <!-- Electrónica - lado izquierdo -->
      <div class="col-12 col-lg-6 area-electronica">
        <div id="card-electronica" class="card shadow-sm h-100">
          <div class="card-body">
            <h4 class="text-white fw-bold mb-3">
              <i class="fas fa-microchip me-2"></i> Solicitudes de Electrónica
            </h4>
            <?php include 'servi_elect.php'; ?>
          </div>
        </div>
      </div>

      <!-- Café - lado derecho -->
      <div class="col-12 col-lg-6 area-cafe">
        <div id="card-cafe" class="card shadow-sm h-100">
          <div class="card-body">
            <h4 class="text-white fw-bold mb-3">
              <i class="fas fa-coffee me-2"></i> Solicitudes de Café
            </h4>
            <?php include 'servi_cafe.php'; ?>
          </div>
        </div>
      </div>

    </div>
  </div>

<?php elseif ($esElect): ?>

  <?php include 'servi_elect.php'; ?>

<?php elseif ($esCafe): ?>

  <?php include 'servi_cafe.php'; ?>

<?php else: ?>

  <div class="alert alert-warning text-center mt-4">
    <i class="fas fa-exclamation-circle me-2"></i>
    Área no válida. Contacta con el administrador.
  </div>

<?php endif; ?>
