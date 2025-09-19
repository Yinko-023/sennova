<?php
$model = new GestionModel();
$botones = $model->obtenerBotones();

$rutaImagen = 'img/';
$nombreImagen = file_exists($rutaImagen . 'imagen_actual.txt') ? trim(file_get_contents($rutaImagen . 'imagen_actual.txt')) : null;
$imagenURL = $nombreImagen ? $rutaImagen . $nombreImagen : null;
?>

<div class="process-container">
   <!--Encabezado -->
  <div class="process-header" data-aos="fade-down">
    <div class="process-icon">
      <img src="https://cdn-icons-png.flaticon.com/512/4383/4383290.png" alt="Mapa Icono">
    </div>
    <h1 class="process-title">Mapa De Gestion</h1>
    <p class="text-muted">Gestion de tus archivos</p>
  </div>


  <!-- Formulario SOLO PARA ADMIN/PUBLICADOR ELECTRÓNICA -->
  <?php if (
    isset($_SESSION['rol']) &&
    (
      $_SESSION['rol'] == 1 ||
      ($_SESSION['rol'] == 3 && isset($_SESSION['area']) && $_SESSION['area'] === 'electronica' || $_SESSION['area'] === 'visualizador')
    )
  ): ?>
    <div class="admin-form" data-aos="fade-up">
      <h5>Crear nueva carpeta</h5>
      <form method="post" action="routes/createProces.php" class="row g-4 align-items-end">
        <div class="col-md-5">
          <label class="form-label">Nombre de la carpeta</label>
          <input type="text" name="nombre" class="form-control" required placeholder="Ej: Documentos">
        </div>
        <div class="col-md-4">
          <label class="form-label">Ruta de la carpeta</label>
          <input type="text" name="ruta" class="form-control" required placeholder="Ej: document">
        </div>
        <style>
          input::placeholder {
           color: rgba(255, 255, 255, 0.6) !important;
            opacity: 1;
          }
        </style>
        <div class="col-md-2">
          <label class="form-label">Color del botón</label>
          <input type="color" name="color" class="form-control form-control-color" value="#4e73df">
        </div>
        <div class="col-md-1">
          <button type="submit" name="crear" class="btn btn-success w-100">
            <i class="fas fa-plus"></i> Crear
          </button>
        </div>
      </form>
    </div>
  <?php endif; ?>

  <!-- Botones de procesos visibles para TODOS -->
  <div class="process-grid" data-aos="fade-up" data-aos-delay="100">
    <?php foreach ($botones as $btn): ?>
      <?php
      $color = isset($btn['color_but']) && !empty($btn['color_but']) ? $btn['color_but'] : '#4e73df';
      $gradientColor = "linear-gradient(135deg, $color, #ffffff)";
      ?>
      <div class="process-card" style="background: <?= $gradientColor ?>;">
        <div class="process-card-body">
          <h3 class="process-name"><?= htmlspecialchars($btn['name_but']) ?></h3>
          <a href="<?= htmlspecialchars($btn['ruta_but']) ?>?id_ges=<?= $btn['id_ges'] ?>" class="process-btn"
            style="text-decoration: none;">
            <i class="fas fa-arrow-right me-2"></i> Ingresar
          </a>
          <?php if (
            isset($_SESSION['rol']) &&
            (
              $_SESSION['rol'] == 1 ||
              ($_SESSION['rol'] == 3 && isset($_SESSION['area']) && $_SESSION['area'] === 'electronica' || $_SESSION['area'] === 'visualizador')
            )
          ): ?>
            <form method="post" action="routes/createProces.php">
              <input type="hidden" name="id" value="<?= $btn['id_ges'] ?>">
              <input type="hidden" name="archivo" value="<?= htmlspecialchars($btn['ruta_but']) ?>">
              <button type="submit" name="eliminar" class="process-delete-btn">
                <i class="fas fa-trash me-1"></i> Eliminar proceso
              </button>
            </form>
          <?php endif; ?>
        </div>
      </div>
    <?php endforeach; ?>
  </div>

</div>


<style>
  .process-grid {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 2rem;
    padding: 1rem;
    max-width: 1200px;
    margin: 0 auto;
  }

  .process-card {
    width: 300px;
    min-height: 200px;
    border-radius: 12px;
    padding: 1rem;
    color: #000;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s;
    background: #f9f9f9;
  }

  .process-card:hover {
    transform: translateY(-5px);
  }

  .process-card-body {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    height: 100%;
  }



  .process-delete-btn {
    margin-top: 1rem;

  }

  /* Estilos generales */
  .process-container {
    max-width: 1400px;
    margin: 0 auto;
    padding: 2rem;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  }

  /* Encabezado */
  .process-header {
    text-align: center;
    margin-bottom: 3rem;
    position: relative;
  }

  .process-icon {
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
    border-radius: 50%;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 4px 12px rgba(78, 115, 223, 0.3);
  }

  .process-icon img {
    width: 30px;
    filter: brightness(0) invert(1);
  }

  .process-title {
    font-size: 2.2rem;
    font-weight: 700;
    color: #2d3748;
    margin: 1rem 0 0.5rem;
    position: relative;
  }

  .process-title::after {
    content: '';
    display: block;
    width: 80px;
    height: 4px;
    background: linear-gradient(90deg, #4e73df, #224abe);
    margin: 1rem auto 0;
    border-radius: 2px;
  }

  /* Formulario admin */
  .admin-form {
    background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
    border-radius: 12px;
    padding: 2rem;
    margin-bottom: 3rem;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
    border: 1px solid rgba(255, 255, 255, 0.1);
  }

  .admin-form h5 {
    color: #fff;
    font-weight: 600;
    margin-bottom: 1.5rem;
    position: relative;
    padding-bottom: 0.5rem;
  }

  .admin-form h5::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 50px;
    height: 3px;
    background: linear-gradient(90deg, #4e73df, #38a169);
    border-radius: 3px;
  }

  .admin-form .form-control,
  .admin-form .form-select {
    background-color: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(255, 255, 255, 0.1);
    color: #fff;
    padding: 0.75rem 1rem;
  }

  .admin-form .form-control:focus,
  .admin-form .form-select:focus {
    background-color: rgba(255, 255, 255, 0.08);
    border-color: #4e73df;
    box-shadow: 0 0 0 0.25rem rgba(78, 115, 223, 0.25);
    color: #fff;
  }

  .admin-form label {
    color: #a0aec0;
    font-weight: 500;
    margin-bottom: 0.5rem;
  }

  .admin-form .btn-success {
    background: linear-gradient(135deg, #38a169 0%, #2f855a 100%);
    border: none;
    font-weight: 500;
    letter-spacing: 0.5px;
    padding: 0.75rem 1.5rem;
    transition: all 0.3s ease;
  }

  .admin-form .btn-success:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(56, 161, 105, 0.3);
  }

  /* Botones de procesos */
  .process-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 1.5rem;
    margin-bottom: 3rem;
  }

  .process-card {
    background: white;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    transition: all 0.3s ease;
    border: 1px solid rgba(0, 0, 0, 0.05);
    display: flex;
    flex-direction: column;
  }

  .process-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
  }

  .process-card-body {
    padding: 1.5rem;
    flex-grow: 1;
    display: flex;
    flex-direction: column;
  }

  .process-name {
    font-size: 1.1rem;
    font-weight: 600;
    color: #2d3748;
    margin-bottom: 1.5rem;
    text-align: center;
  }

  .process-btn {
    background: rgba(0, 0, 0, 0.05);
    border: none;
    color: #2d3748;
    font-weight: 600;
    padding: 0.75rem;
    border-radius: 8px;
    transition: all 0.3s ease;
    margin-top: auto;
    text-align: center;
    display: block;
    width: 100%;
  }

  .process-btn:hover {
    background: rgba(0, 0, 0, 0.1);
    color: #2d3748;
  }

  .process-delete-btn {
    background: transparent;
    border: 1px solid #e53e3e;
    color: #e53e3e;
    padding: 0.5rem;
    border-radius: 8px;
    transition: all 0.3s ease;
    width: 100%;
    font-weight: 500;
  }

  .process-delete-btn:hover {
    background: #e53e3e;
    color: white;
  }


  .image-upload {
    margin-bottom: 1.5rem;
  }

  .image-upload .btn {
    padding: 0.5rem 1.25rem;
    font-weight: 500;
    border-radius: 8px;
  }

  .process-image {
    max-width: 100%;
    border-radius: 12px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    border: 1px solid rgba(0, 0, 0, 0.05);
    transition: all 0.3s ease;
  }

  .process-image:hover {
    transform: scale(1.01);
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
  }

  .no-image {
    color: #a0aec0;
    padding: 3rem;
    background: rgba(0, 0, 0, 0.02);
    border-radius: 12px;
    border: 1px dashed #e2e8f0;
  }

  /* Botón de versiones */
  .version-btn {
    background: white;
    border: 1px solid #e2e8f0;
    color: #4a5568;
    font-weight: 500;
    padding: 0.75rem 1.5rem;
    border-radius: 8px;
    margin-bottom: 2rem;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
  }

  .version-btn:hover {
    background: #f7fafc;
    border-color: #cbd5e0;
    color: #2d3748;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
  }
</style>

  <!-- Imagen final -->
<?php /*
<div class="image-section" data-aos="fade-up">
  <?php if (
    (isset($_SESSION['rol']) && $_SESSION['rol'] == 1) ||
    (isset($_SESSION['rol'], $_SESSION['area']) && $_SESSION['rol'] == 3 && $_SESSION['area'] === 'electronica')
  ): ?>
    <!-- Código de subir/eliminar imagen -->
  <?php endif; ?>

  <?php if ($imagenURL): ?>
    <div class="text-center">
      <img src="<?= $imagenURL . '?v=' . time() ?>" class="img-fluid rounded shadow-sm my-3"
        style="cursor: zoom-in; max-width: 500px; width: 100%; height: auto;" alt="Imagen del proceso"
        data-bs-toggle="modal" data-bs-target="#imagenModal">
    </div>

    <div class="modal fade" id="imagenModal" tabindex="-1" aria-labelledby="imagenModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content bg-dark">
          <div class="modal-header border-0">
            <h5 class="modal-title text-white" id="imagenModalLabel">Vista Ampliada</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
              aria-label="Cerrar"></button>
          </div>
          <div class="modal-body text-center">
            <img src="<?= $imagenURL . '?v=' . time() ?>" class="img-fluid" style="max-height: 50vh;"
              alt="Imagen ampliada">
          </div>
        </div>
      </div>
    </div>
  <?php else: ?>
    <div class="no-image text-center text-muted mt-4">
      <i class="fas fa-image fa-3x mb-2"></i>
      <p>No hay imagen cargada actualmente</p>
    </div>
  <?php endif; ?>
</div>
*/ ?>




 <!-- Botón de versiones -->
  <!-- <div class="text-center" data-aos="fade-up">
    <a class="version-btn" href="inAdmin.php?vista=versiones" style="text-decoration: none;">
      <i class="fas fa-history"></i> Ver historial de versiones
    </a>
  </div> -->