<?php if (!isset($_SESSION['area'])): ?>

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


<?php elseif ($_SESSION['area'] === 'electronica' || $_SESSION['area'] === 'visualizador'): ?>
    <?php include 'servi_elect.php'; ?>

<?php elseif ($_SESSION['area'] === 'cafe'): ?>
    <?php include 'servi_cafe.php'; ?>

<?php else: ?>
    <div class="alert alert-warning text-center mt-4">
        <i class="fas fa-exclamation-circle me-2"></i> Área no válida. Contacta con el administrador.
    </div>
<?php endif; ?>