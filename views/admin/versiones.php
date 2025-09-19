<!-- Header con gradiente -->
<div class="header fade-in-up mt-5">
  <h1 class="header-title">
    <i class="fas fa-file-pdf me-2"></i>Gestión de Versiones PDF
  </h1>
</div>
<?php if ((isset($_SESSION['rol']) && $_SESSION['rol'] == 1) || (isset($_SESSION['rol'], $_SESSION['area']) && $_SESSION['rol'] == 3 && $_SESSION['area'] === 'electronica')): ?>
  <!-- Crear nuevo proceso -->
  <div class="card-custom fade-in-up delay-1">
    <div class="card-body-custom">
      <form action="routes/VersionPDF.php" method="POST" class="row g-3 align-items-center">
        <div class="col-md-10">
          <input type="text" name="nombre_proceso" class="form-control-custom"
            placeholder="Nombre del nuevo proceso" required>
        </div>
        <div class="col-md-2">
          <button type="submit" name="crear_proceso" class="btn btn-primary-custom w-100">
            <i class="fas fa-plus me-2"></i>Crear
          </button>
        </div>
      </form>
    </div>
  </div>
<?php endif; ?>

<!-- Mostrar procesos y versiones -->
<div class="accordion accordion-custom" id="accordionProcesos">
  <?php if (!empty($procesos)): ?>
    <?php foreach ($procesos as $index => $proceso): ?>
      <div class="accordion-item fade-in-up delay-<?= ($index % 3) + 2 ?>">
        <h2 class="accordion-header d-flex justify-content-between align-items-center">
          <button class="accordion-button collapsed flex-grow-1" type="button"
            data-bs-toggle="collapse"
            data-bs-target="#collapse<?= $index ?>"
            aria-expanded="false" aria-controls="collapse<?= $index ?>">
            <i class="fas fa-folder me-2"></i>
            <?= htmlspecialchars($proceso['name_ta']) ?>
          </button>

          <?php if ((isset($_SESSION['rol']) && $_SESSION['rol'] == 1) ||
            (isset($_SESSION['rol'], $_SESSION['area']) && $_SESSION['rol'] == 3 && $_SESSION['area'] === 'electronica')
          ): ?>
            <form action="routes/VersionPDF.php" method="POST" class="delete-form ms-2">
              <input type="hidden" name="accion" value="eliminar_proceso">
              <input type="hidden" name="id" value="<?= $proceso['id_ta'] ?>">
              <button type="button" class="btn btn-danger-custom btn-sm delete-btn">
                <i class="fas fa-trash me-1"></i>Eliminar
              </button>
            </form>

          <?php endif; ?>
        </h2>

        <div id="collapse<?= $index ?>" class="accordion-collapse collapse" aria-labelledby="heading<?= $index ?>"
          data-bs-parent="#accordionProcesos">
          <div class="accordion-body">
            <?php if (!empty($proceso['versiones'])): ?>
              <div class="table-responsive">
                <table class="table table-custom">
                  <thead>
                    <tr>
                      <th><i class="fas fa-hashtag me-1"></i>Código</th>
                      <th><i class="fas fa-file me-1"></i>Archivo</th>
                      <th><i class="fas fa-code-branch me-1"></i>Versión</th>
                      <th><i class="fas fa-calendar me-1"></i>Año</th>
                      <th><i class="fas fa-eye me-1"></i>Ver PDF</th>
                      <?php if ((isset($_SESSION['rol']) && $_SESSION['rol'] == 1) || (isset($_SESSION['rol'], $_SESSION['area']) && $_SESSION['rol'] == 3 && $_SESSION['area'] === 'electronica')): ?>
                        <th><i class="fas fa-trash me-1"></i>Eliminar</th>
                        <th><i class="fas fa-archive me-1"></i>Deshabilitar</th>
                      <?php endif; ?>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($proceso['versiones'] as $version): ?>
                      <tr>
                        <td><?= htmlspecialchars($version['codigo_vr']) ?></td>
                        <td><?= basename($version['ruta_archivo_vr']) ?></td>
                        <td><?= htmlspecialchars($version['version_vr']) ?></td>
                        <td><?= htmlspecialchars($version['year_vr']) ?></td>
                        <td>
                          <button type="button" class="btn btn-primary-custom btn-sm" data-bs-toggle="modal"
                            data-bs-target="#modalPDF<?= $version['id_vers'] ?>">
                            <i class="fas fa-eye me-1"></i>Ver
                          </button>
                        </td>
                        <?php if ((isset($_SESSION['rol']) && $_SESSION['rol'] == 1) || (isset($_SESSION['rol'], $_SESSION['area']) && $_SESSION['rol'] == 3 && $_SESSION['area'] === 'electronica')): ?>
                          <td>
                            <form action="routes/VersionPDF.php" method="POST"
                              onsubmit="return confirm('¿Estás seguro de eliminar esta versión?');">
                              <input type="hidden" name="accion" value="eliminar">
                              <input type="hidden" name="id" value="<?= $version['id_vers'] ?>">
                              <button type="submit" class="btn btn-danger-custom btn-sm">
                                <i class="fas fa-trash"></i>
                              </button>
                            </form>

                          </td>
                          <td>
                            <form action="routes/VersionPDF.php" method="POST">
                              <input type="hidden" name="accion" value="archivar">
                              <input type="hidden" name="id" value="<?= $version['id_vers'] ?>">
                              <button type="submit" class="btn btn-warning btn-sm">
                                <i class="fas fa-archive"></i>
                              </button>
                            </form>


                          </td>
                        <?php endif; ?>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            <?php else: ?>
              <div class="empty-state">
                <i class="fas fa-file-pdf"></i>
                <h4>No hay versiones registradas</h4>
                <p>Agrega la primera versión utilizando el formulario inferior</p>
              </div>
            <?php endif; ?>

            <?php if ((isset($_SESSION['rol']) && $_SESSION['rol'] == 1) || (isset($_SESSION['rol'], $_SESSION['area']) && $_SESSION['rol'] == 3 && $_SESSION['area'] === 'electronica')): ?>
              <!-- Formulario para agregar nueva versión -->
              <form action="routes/VersionPDF.php" method="POST" enctype="multipart/form-data" class="row g-3 mt-4">
                <input type="hidden" name="id_proceso" value="<?= $proceso['id_ta'] ?>">
                <div class="col-md-2">
                  <input type="text" name="codigo" class="form-control-custom" placeholder="Código" required>
                </div>
                <div class="col-md-2">
                  <input type="text" name="version" class="form-control-custom" placeholder="Versión" required>
                </div>
                <div class="col-md-2">
                  <select name="anio" class="form-control-custom" required>
                    <?php
                    $anioActual = date('Y');
                    for ($i = $anioActual; $i >= 2000; $i--) {
                      echo "<option value='$i'>$i</option>";
                    }
                    ?>
                  </select>
                </div>
                <div class="col-md-2" style="margin-right: 10px;">
                  <input type="file" name="archivo_pdf" accept=".pdf" class="form-control-custom" required>
                </div>
                <div class="col-md-2">
                  <button type="submit" name="agregar_version" class="btn btn-primary-custom w-100">
                    <i class="fas fa-plus me-1"></i>Agregar
                  </button>
                </div>
              </form>
            <?php endif; ?>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  <?php else: ?>
    <div class="empty-state fade-in-up">
      <i class="fas fa-folder-open"></i>
      <h4>No hay procesos registrados</h4>
      <p>Crea tu primer proceso utilizando el formulario superior</p>
    </div>
  <?php endif; ?>
</div>
<?php
$versionModel = new VersionModel();
$versionesArchivadas = $versionModel->getVersionesArchivadas();
?>
<!-- NUEVA SECCIÓN PARA VERSIONES ANTIGUAS -->
<?php if ((isset($_SESSION['rol']) && $_SESSION['rol'] == 1) || (isset($_SESSION['rol'], $_SESSION['area']) && $_SESSION['rol'] == 3 && $_SESSION['area'] === 'electronica')): ?>
  <div class="archive-section fade-in-up delay-4 mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h2 class="archive-title text-dark">
        <i class="fas fa-archive me-2"></i>Archivo de Versiones Antiguas
      </h2>
      <button class="btn btn-outline-secondary btn-sm" type="button" data-bs-toggle="collapse"
        data-bs-target="#archiveCollapse" aria-expanded="false" aria-controls="archiveCollapse">
        <i class="fas fa-chevron-down me-1"></i>Mostrar/Ocultar
      </button>
    </div>

    <div class="collapse" id="archiveCollapse">
      <div class="card-custom">
        <div class="card-body-custom">
          <?php if (!empty($versionesArchivadas)): ?>
            <div class="table-responsive">
              <table class="table table-custom" id="archiveTable">
                <thead>
                  <tr>
                    <th><i class="fas fa-hashtag me-1"></i>Código</th>
                    <th><i class="fas fa-file me-1"></i>Archivo</th>
                    <th><i class="fas fa-folder me-1"></i>Proceso</th>
                    <th><i class="fas fa-code-branch me-1"></i>Versión</th>
                    <th><i class="fas fa-calendar me-1"></i>Año</th>
                    <th><i class="fas fa-eye me-1"></i>Ver PDF</th>
                    <th><i class="fas fa-undo me-1"></i>Restaurar</th>
                    <th><i class="fas fa-trash me-1"></i>Eliminar</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($versionesArchivadas as $version): ?>
                    <tr>
                      <td><?= htmlspecialchars($version['codigo_vr']) ?></td>
                      <td><?= basename($version['ruta_archivo_vr']) ?></td>
                      <td><?= htmlspecialchars($version['name_ta']) ?></td>
                      <td><?= htmlspecialchars($version['version_vr']) ?></td>
                      <td><?= htmlspecialchars($version['year_vr']) ?></td>
                      <td>
                        <button type="button" class="btn btn-primary-custom btn-sm" data-bs-toggle="modal"
                          data-bs-target="#modalPDF<?= $version['id_vers'] ?>">
                          <i class="fas fa-eye me-1"></i>Ver
                        </button>
                      </td>
                      <td>
                        <form action="routes/VersionPDF.php" method="POST">
                          <input type="hidden" name="accion" value="restaurar">
                          <input type="hidden" name="id" value="<?= $version['id_vers'] ?>">
                          <button type="submit" class="btn btn-success btn-sm">
                            <i class="fas fa-undo"></i>
                          </button>
                        </form>
                      </td>
                      <td>
                        <form action="routes/VersionPDF.php" method="POST"
                          onsubmit="return confirm('¿Estás seguro de eliminar permanentemente esta versión?');">
                          <input type="hidden" name="accion" value="eliminar">
                          <input type="hidden" name="id" value="<?= $version['id_vers'] ?>">
                          <button type="submit" class="btn btn-danger-custom btn-sm">
                            <i class="fas fa-trash"></i>
                          </button>
                        </form>
                      </td>
                    </tr>
                    
                    <!-- Modal para ver PDF (debes implementarlo según tu necesidad) -->
                    <div class="modal fade" id="modalPDF<?= $version['id_vers'] ?>" tabindex="-1" aria-hidden="true">
                      <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title"><?= htmlspecialchars($version['name_archive']) ?></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                            <embed src="../<?= $version['ruta_archivo_vr'] ?>" type="application/pdf" width="100%" height="600px" />
                          </div>
                        </div>
                      </div>
                    </div>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          <?php else: ?>
            <div class="empty-state-sm text-center py-4">
              <i class="fas fa-inbox"></i>
              <h5>No hay versiones archivadas</h5>
              <p>Las versiones marcadas como antiguas aparecerán aquí</p>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
<?php endif; ?>

<!-- MODAL PARA CADA PDF -->
<?php if (!empty($procesos)): ?>
  <?php foreach ($procesos as $proceso): ?>
    <?php if (!empty($proceso['versiones']) && is_array($proceso['versiones'])): ?>
      <?php foreach ($proceso['versiones'] as $version): ?>
        <div class="modal fade" id="modalPDF<?= $version['id_vers'] ?>" tabindex="-1"
          aria-labelledby="modalPDFLabel<?= $version['id_vers'] ?>" aria-hidden="true">
          <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content modal-content-custom">
              <div class="modal-header modal-header-custom">
                <h5 class="modal-title">
                  <i class="fas fa-file-pdf me-2"></i>
                  <?= basename($version['ruta_archivo_vr']) ?>
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
              </div>
              <div class="modal-body modal-body-custom">
                <iframe src="<?= $version['ruta_archivo_vr'] ?>" allowfullscreen></iframe>
              </div>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    <?php endif; ?>
  <?php endforeach; ?>
<?php endif; ?>




<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  document.querySelectorAll('.delete-btn').forEach(btn => {
    btn.addEventListener('click', function() {
      let form = this.closest('.delete-form');
      Swal.fire({
        title: '¿Estás seguro?',
        text: "¡Esto eliminará el proceso y todas sus versiones!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
      }).then((result) => {
        if (result.isConfirmed) {
          form.submit();
        }
      });
    });
  });

  document.addEventListener("DOMContentLoaded", function() {
    // Animación de elementos
    const animElements = document.querySelectorAll('.fade-in-up');

    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          setTimeout(() => {
            entry.target.style.opacity = '1';
            entry.target.style.transform = 'translateY(0)';
          }, parseInt(entry.target.classList.contains('delay-1') ? 100 :
            entry.target.classList.contains('delay-2') ? 200 :
            entry.target.classList.contains('delay-3') ? 300 : 0));
          observer.unobserve(entry.target);
        }
      });
    }, {
      threshold: 0.1
    });

    animElements.forEach(el => {
      observer.observe(el);
    });

    // Tooltips
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));
  });
</script>
<style>
  :root {
    --primary-gradient: linear-gradient(90deg, #2c3e50 0%, #1a1a2e 100%);
    --secondary-gradient: linear-gradient(135deg, #3498db, #2980b9);
    --danger-gradient: linear-gradient(135deg, #e74c3c, #c0392b);
    --dark-bg: #0f172a;
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
    min-height: 100vh;
    margin: 0;
    padding: 20px;
  }

  .container-custom {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
  }

  /* Header con gradiente */
  .header {
    background: var(--primary-gradient);
    border-radius: var(--border-radius);
    padding: 25px;
    margin-bottom: 30px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
    border: 1px solid rgba(255, 255, 255, 0.1);
  }

  .header-title {
    font-size: 2.2rem;
    font-weight: 700;
    text-align: center;
    margin: 0;
    color: white;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
  }

  /* Cards con gradiente */
  .card-custom {
    background: var(--primary-gradient);
    border-radius: var(--border-radius);
    border: 1px solid rgba(255, 255, 255, 0.1);
    margin-bottom: 25px;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
    transition: var(--transition);
  }

  .card-custom:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.4);
  }

  .card-body-custom {
    padding: 25px;
    color: white;
  }

  /* Form Styles */
  select.form-control-custom {
    color: var(--text-light);
    /* Texto negro del select */
  }

  select.form-control-custom option {
    color: #000;
    /* Texto negro para las opciones */
  }

  .form-control-custom[type="file"] {
    display: block;
    width: 100%;
    padding: 0.375rem 0.75rem;
    font-size: 1rem;
    line-height: 1.5;
    color: #495057;
    background: rgba(255, 255, 255, 0.1);
    background-clip: padding-box;
    border: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: 0.375rem;
  }

  .form-control-custom {
    background: rgba(255, 255, 255, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.2);
    color: var(--text-light);
    padding: 12px 16px;
    border-radius: 8px;
    transition: var(--transition);
  }

  .form-control-custom:focus {
    background: rgba(255, 255, 255, 0.15);
    border-color: #3498db;
    box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.2);
    color: var(--text-light);
  }

  .form-control-custom::placeholder {
    color: rgba(255, 255, 255, 0.6);
  }

  /* Button Styles */
  .btn-primary-custom {
    background: var(--secondary-gradient);
    border: none;
    color: white;
    padding: 12px 25px;
    border-radius: 8px;
    font-weight: 500;
    transition: var(--transition);
    box-shadow: 0 4px 15px rgba(52, 152, 219, 0.3);
  }

  .btn-primary-custom:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(52, 152, 219, 0.4);
    color: white;
  }

  .btn-danger-custom {
    background: var(--danger-gradient);
    border: none;
    color: white;
    padding: 8px 16px;
    border-radius: 6px;
    font-weight: 500;
    transition: var(--transition);
    box-shadow: 0 4px 15px rgba(231, 76, 60, 0.3);
  }

  .btn-danger-custom:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(231, 76, 60, 0.4);
    color: white;
  }

  /* Accordion Styles */
  .accordion-custom .accordion-item {
    background: var(--primary-gradient);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: var(--border-radius);
    margin-bottom: 15px;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.2);
    overflow: hidden;
  }

  .accordion-custom .accordion-button {
    background: var(--primary-gradient);
    color: white;
    border: none;
    padding: 20px;
    font-weight: 600;
    box-shadow: none;
    display: flex;
    justify-content: space-between;
    align-items: center;
  }

  .accordion-custom .accordion-button:not(.collapsed) {
    background: linear-gradient(90deg, #34495e 0%, #2c3e50 100%);
    color: white;
  }

  .accordion-custom .accordion-button::after {
    filter: invert(1);
  }

  .accordion-custom .accordion-body {
    background: rgba(255, 255, 255, 0.05);
    border-radius: 0 0 var(--border-radius) var(--border-radius);
    padding: 25px;
    color: white;
  }

  .accordion-button {
    display: flex;
    align-items: center;
  }

  /* Table Styles */
  .table-custom {
    background: rgba(255, 255, 255, 0.05);
    border-radius: var(--border-radius);
    overflow: hidden;
    margin-bottom: 20px;
    backdrop-filter: blur(10px);
  }

  .table-custom thead th {
    background: var(--card-bg);
    color: white;
    border: none;
    padding: 15px;
    font-weight: 600;
    text-align: center;
  }

  .table-custom tbody td {
    background: rgba(255, 255, 255, 0.03);
    color: var(--text-light);
    border: none;
    padding: 15px;
    vertical-align: middle;
    text-align: center;
  }

  .table-custom tbody tr:hover td {
    background: rgba(255, 255, 255, 0.08);
  }

  /* Modal Styles */
  .modal-content-custom {
    background: var(--primary-gradient);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: var(--border-radius);
    color: white;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
  }

  .modal-header-custom {
    background: linear-gradient(90deg, #34495e 0%, #2c3e50 100%);
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    padding: 20px;
  }

  .modal-body-custom {
    padding: 0;
  }

  .modal-body-custom iframe {
    width: 100%;
    height: 80vh;
    border: none;
    border-radius: 0 0 var(--border-radius) var(--border-radius);
  }

  /* Empty State */
  .empty-state {
    text-align: center;
    padding: 60px 20px;
    background: var(--primary-gradient);
    border-radius: var(--border-radius);
    border: 2px dashed rgba(255, 255, 255, 0.2);
    color: white;
  }

  .empty-state i {
    font-size: 4rem;
    color: rgba(255, 255, 255, 0.7);
    margin-bottom: 20px;
  }

  .empty-state h4 {
    color: white;
    margin-bottom: 10px;
  }

  .empty-state p {
    color: rgba(255, 255, 255, 0.8);
  }

  /* Responsive Design */
  @media (max-width: 768px) {
    .container-custom {
      padding: 15px;
    }

    .header {
      padding: 20px;
    }

    .header-title {
      font-size: 1.8rem;
    }

    .card-body-custom {
      padding: 20px;
    }

    .accordion-custom .accordion-button {
      padding: 15px;
      font-size: 1rem;
    }

    .table-custom thead th,
    .table-custom tbody td {
      padding: 12px;
      font-size: 0.9rem;
    }

    .btn-primary-custom,
    .btn-danger-custom {
      padding: 10px 20px;
      font-size: 0.9rem;
    }
  }

  @media (max-width: 576px) {
    body {
      padding: 15px;
    }

    .header-title {
      font-size: 1.5rem;
    }

    .card-body-custom {
      padding: 15px;
    }

    .accordion-custom .accordion-body {
      padding: 20px;
    }

    .empty-state {
      padding: 40px 15px;
    }

    .empty-state i {
      font-size: 3rem;
    }

    /* Stack form inputs on mobile */
    .row.g-3 [class*="col-"] {
      margin-bottom: 10px;
    }

    .row.g-3 [class*="col-"]:last-child {
      margin-bottom: 0;
    }
  }

  /* Animation */
  @keyframes fadeInUp {
    from {
      opacity: 0;
      transform: translateY(30px);
    }

    to {
      opacity: 1;
      transform: translateY(0);
    }
  }

  .fade-in-up {
    opacity: 0;
    transform: translateY(30px);
    animation: fadeInUp 0.6s ease-out forwards;
  }

  .delay-1 {
    animation-delay: 0.1s;
  }

  .delay-2 {
    animation-delay: 0.2s;
  }

  .delay-3 {
    animation-delay: 0.3s;
  }

  /* Custom utilities */
  .text-gradient {
    background: var(--secondary-gradient);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
  }

  .border-gradient {
    border: 2px solid;
    border-image: var(--primary-gradient) 1;
  }

  .shadow-custom {
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
  }

  /* Nuevos estilos para la sección de archivo */
  .archive-section {
    margin-bottom: 30px;
  }

  .archive-title {
    font-size: 1.8rem;
    font-weight: 600;
    color: white;
    margin: 0;
  }

  .empty-state-sm {
    text-align: center;
    padding: 30px 20px;
    color: var(--text-muted);
  }

  .empty-state-sm i {
    font-size: 2.5rem;
    margin-bottom: 15px;
    opacity: 0.7;
  }

  .empty-state-sm h5 {
    color: var(--text-light);
    margin-bottom: 10px;
  }

  .empty-state-sm p {
    margin: 0;
    font-size: 0.9rem;
  }

  .btn-warning {
    background: var(--warning-gradient);
    border: none;
    color: white;
    padding: 8px 16px;
    border-radius: 6px;
    font-weight: 500;
    transition: var(--transition);
    box-shadow: 0 4px 15px rgba(243, 156, 18, 0.3);
  }

  .btn-warning:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(243, 156, 18, 0.4);
    color: white;
  }

  /* Ajustes responsivos */
  @media (max-width: 768px) {
    .archive-title {
      font-size: 1.5rem;
    }
  }
</style>