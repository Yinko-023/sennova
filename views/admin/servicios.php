<?php
if (session_status() === PHP_SESSION_NONE) session_start();

$rol  = (int)($_SESSION['rol'] ?? 0);
$area = strtolower(trim((string)($_SESSION['area'] ?? '')));

// Solo el rol 1 puede ver ambas áreas
$showBoth = ($rol === 1);

// flags por área (para roles distintos a 1 y 2)
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

<?php elseif ($rol === 2): ?>

  <!-- Rol 2: solo Electrónica -->
  <?php include 'servi_elect.php'; ?>

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
