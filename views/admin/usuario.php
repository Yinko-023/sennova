
<?php
require_once 'models/PubliModel.php';
$model = new CarruselModel();
$slides = $model->obtenerImagenes();
$videoModel = new VideoModel();
$videoElectronica = $videoModel->obtenerVideoPorArea('electronica');
$videoCafe = $videoModel->obtenerVideoPorArea('cafe');
$portadaModel = new PortadaModel();
$portadas = $portadaModel->obtenerTodasLasPortadas();
?>

<div class="d-flex justify-content-center mt-5 mb-5" data-aos="zoom-in" data-aos-duration="1000">
  <h2 class="fw-bold text-light px-5 py-3 rounded-4 shadow-lg border border-3 border-info bg-gradient bg-dark">
    <i class="fas fa-tools me-2 text-info"></i> Gestión <span class="text-info">y Mantenimientos</span> de Contenidos
  </h2>
</div>

<div class="bg-light-gray py-4 px-3">
  <div class="row ">

    <!-- Publicaciones Section -->
    <section class="publicaciones-section container-fluid px-3 py-5" data-aos="fade-up">
      <!-- Publicación destacada -->
      <?php if (!empty($destacada)): ?>
        <h4 class="text-center fw-bold mb-4" data-aos="fade-down" data-aos-duration="800">
          <i class="fa-solid fa-star"></i> Destacada
        </h4>
        <div class="card shadow-lg border-0 rounded-4 bg-light mb-5">
          <div class="card shadow-lg border-0 rounded-4 bg-light">
            <div class="row g-0">
              <div class="col-md-4 d-flex align-items-center justify-content-center p-3">
                <?php if (!empty($destacada['image_path'])): ?>
                  <div class="ratio ratio-1x1 w-100">
                    <img src="/sennova/img/<?= htmlspecialchars($destacada['image_path']) ?>"
                      class="img-fluid object-fit-cover rounded" alt="Imagen destacada" style="object-fit: cover;">
                  </div>
                <?php else: ?>
                  <p class="text-muted">Sin imagen</p>
                <?php endif; ?>
              </div>
              <div class="col-md-8">
                <div class="card-body">
                  <h5 class="card-title text-primary"><?= htmlspecialchars($destacada['title']) ?></h5>
                  <p class="card-text"><?= htmlspecialchars($destacada['content']) ?></p>
                  <p class="card-text"><small class="text-muted">🗓
                      <?= htmlspecialchars($destacada['published_at']) ?></small>
                  </p>

                  <?php if ($_SESSION['rol'] == 1): ?>
                    <div class="text-end d-flex gap-2 justify-content-end">
                      <!-- Botón quitar destacado -->
                      <a href="/sennova/routes/DestacarPuliDelete.php?id=<?= $destacada['id'] ?>"
                        class="btn btn-outline-secondary btn-sm"
                        onclick="return confirm('¿Quitar esta publicación como destacada?');">
                        <i class="fas fa-minus-circle"></i> Quitar destacado
                      </a>

                      <!-- Botón eliminar -->
                      <a href="/sennova/routes/eliminarPublicacion.php?id=<?= $destacada['id'] ?>"
                        class="btn btn-outline-danger btn-sm" onclick="return confirm('¿Eliminar esta publicación?');">
                        <i class="fas fa-trash-alt"></i> Eliminar
                      </a>
                    </div>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      <?php endif; ?>

      <!-- Todas las publicaciones -->
      <div class="row g-4">
        <?php foreach ($publicaciones as $index => $pub): ?>
          <div class="col-12 col-sm-6 col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="<?= ($index + 1) * 100 ?>">
            <div class="card h-100 shadow border-0 rounded-3">
              <div class="card-img-top bg-light d-flex align-items-center justify-content-center p-2"
                style="height: 200px; overflow: hidden;">
                <?php if (!empty($pub['image_path'])): ?>
                  <img src="/sennova/img/<?= htmlspecialchars($pub['image_path']) ?>"
                    class="img-fluid rounded object-fit-cover" alt="Imagen" style="max-height: 100%; object-fit: cover;">
                <?php else: ?>
                  <p class="text-muted">Sin imagen</p>
                <?php endif; ?>
              </div>
              <div class="card-body d-flex flex-column">
                <h5 class="card-title"><?= htmlspecialchars($pub['title']) ?></h5>
                <p class="card-text"><?= htmlspecialchars($pub['content']) ?></p>
                <p class="card-text mt-auto"><small class="text-muted">🕒
                    <?= htmlspecialchars($pub['published_at']) ?></small></p>
              </div>

              <?php if ($_SESSION['rol'] == 1): ?>
                <div class="card-footer d-flex justify-content-end gap-2 bg-white border-0">
                  <button type="button" class="btn btn-outline-warning btn-sm" data-bs-toggle="modal"
                    data-bs-target="#editarModal<?= $pub['id'] ?>">
                    <i class="fas fa-edit"></i>
                  </button>
                  <a href="/sennova/routes/destacarPubli.php?id=<?= $pub['id'] ?>" class="btn btn-outline-primary btn-sm"
                    onclick="return confirm('¿Destacar esta publicación?');">
                    <i class="fas fa-star"></i>
                  </a>
                  <a href="/sennova/routes/eliminarPublicacion.php?id=<?= $pub['id'] ?>"
                    class="btn btn-outline-danger btn-sm" onclick="return confirm('¿Eliminar esta publicación?');">
                    <i class="fas fa-trash"></i>
                  </a>
                </div>
              <?php endif; ?>
            </div>
          </div>


        <?php endforeach; ?>
      </div>

    </section>

    <!-- Carrusel Section -->
    <section class="mb-5 px-4 mt-5" data-aos="fade-up">
      <div class="card shadow-sm border-0">
        <div class="card-header bg-dark text-light py-3 align-items-center d-flex justify-content-center text-center">
          <h5 class="mb-0 text-light transition-hover" style="cursor: pointer;">
            <i class="fas fa-images me-2"></i> Gestión del Carrusel
          </h5>
        </div>
        <style>
          .transition-hover {
            transition: all 0.3s ease;
            transform-origin: center;
          }

          .transition-hover:hover {
            transform: translateY(-10px) scale(1.05);
          }
        </style>

        <div class="card-body">
          <!-- Formulario para subir -->
          <form action="routes/carrusel.php?action=agregar" method="post" enctype="multipart/form-data" class="container-fluid mb-4">
            <div class="row g-3">
              <div class="col-md-6">
                <label for="titulo" class="form-label">Título de la imagen</label>
                <input type="text" name="titulo" class="form-control bg-light border-gray" required
                  placeholder="Ej. Transformando el Futuro">
              </div>
              <div class="col-md-6">
                <label for="imagen" class="form-label">Seleccionar imagen</label>
                <input type="file" name="imagen" class="form-control bg-light border-gray" required>
              </div>
              <div class="col-12">
                <button type="submit" class="btn btn-dark w-100 py-2">
                  <i class="fas fa-upload me-2"></i>Subir Imagen
                </button>
              </div>
            </div>
          </form>

          <!-- Imágenes actuales -->
          <h6 class="mt-5 mb-3 text-dark-gray text-center">Imágenes actuales del carrusel</h6>
          <?php if (!empty($slides)): ?>
            <div class="row g-3 justify-content-center">
              <?php foreach ($slides as $slide): ?>
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 d-flex justify-content-center">
                  <div class="card border-gray h-100" style="max-width: 100%;">
                    <img src="<?= htmlspecialchars($slide['title_carr']) ?>" class="card-img-top img-thumbnail"
                      alt="Imagen del carrusel">
                    <div class="card-body text-center">
                      <h6 class="card-title text-dark-gray"><?= htmlspecialchars($slide['name_img_c']) ?></h6>
                    </div>
                    <div class="card-footer bg-transparent border-top-0">
                      <form action="routes/carrusel.php" method="post" class="d-grid">
                        <input type="hidden" name="action" value="eliminar">
                        <input type="hidden" name="id" value="<?= $slide['id_car'] ?>">
                        <button type="submit" class="btn btn-outline-danger btn-sm">
                          <i class="fas fa-trash me-1"></i> Eliminar
                        </button>
                      </form>
                    </div>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>

          <?php else: ?>
            <div class="alert alert-light-gray text-medium-gray">
              No hay imágenes en el carrusel actualmente.
            </div>
          <?php endif; ?>
        </div>
      </div>
    </section>

    <!-- Videos Section -->
    <section class="mb-5 px-4 mt-5" data-aos="fade-up">
      <div class="card shadow-sm border-0">
        <div class="card-header bg-dark text-light py-3 align-items-center d-flex justify-content-center text-center">
          <h5 class="mb-0 text-light transition-hover" style="cursor: pointer;">
            <i class="fas fa-video me-2"></i> Gestión de Videos
          </h5>
        </div>
        <style>
          .transition-hover {
            transition: all 0.3s ease;
            transform-origin: center;
          }

          .transition-hover:hover {
            transform: translateY(-10px) scale(1.05);
          }
        </style>

        <div class="card-body">
          <!-- Formulario para subir videos -->
          <form action="routes/Videos.php" method="POST" enctype="multipart/form-data" class="mb-5">
            <div class="row g-3">
              <div class="col-md-6">
                <label for="area" class="form-label">Área del laboratorio</label>
                <select name="area" id="area" class="form-select bg-light border-gray" required>
                  <option value="" disabled selected>Selecciona un área</option>
                  <option value="electronica">Electrónica</option>
                  <option value="cafe">Café y Cacao</option>
                </select>
              </div>
              <div class="col-md-6">
                <label for="titulo" class="form-label">Título principal</label>
                <input type="text" name="titulo" id="titulo" class="form-control bg-light border-gray" required
                  placeholder="Ej: Innovación con Tecnología">
              </div>
              <div class="col-md-6">
                <label for="texto_principal" class="form-label">Texto descriptivo</label>
                <textarea name="texto_principal" id="texto_principal" class="form-control bg-light border-gray" rows="3"
                  required></textarea>
              </div>
              <div class="col-md-6">
                <label for="texto_secundario" class="form-label">Texto complementario</label>
                <textarea name="texto_secundario" id="texto_secundario" class="form-control bg-light border-gray"
                  rows="3" required></textarea>
              </div>
              <div class="col-12">
                <label for="video" class="form-label">Seleccionar video (MP4)</label>
                <input type="file" name="video" id="video" class="form-control bg-light border-gray" accept="video/mp4"
                  required>
              </div>
              <div class="col-12">
                <button type="submit" name="subir_video" class="btn btn-dark w-100 py-2">
                  <i class="fas fa-upload me-2"></i>Subir Video
                </button>
              </div>
            </div>
          </form>

          <!-- Videos existentes -->
          <h6 class="text-dark mb-3 text-center">Videos actuales</h6>
          <div class="row g-4">
            <?php if ($videoElectronica): ?>
              <div class="col-md-6">
                <div class="card border-gray h-100">
                  <div class="card-header bg-medium-gray text-light py-2">
                    <h6 class="mb-0">Electrónica</h6>
                  </div>
                  <div class="card-body">
                    <h6 class="text-dark-gray"><?= htmlspecialchars($videoElectronica['title_vid']) ?></h6>
                    <div class="ratio ratio-16x9 mb-3">
                      <video controls class="rounded">
                        <source src="<?= htmlspecialchars($videoElectronica['ruta_video']) ?>" type="video/mp4">
                        Tu navegador no soporta el video.
                      </video>
                    </div>
                    <form action="routes/Videos.php" method="POST"
                      onsubmit="return confirm('¿Seguro que deseas eliminar este video?');" class="d-grid">
                      <input type="hidden" name="area" value="electronica">
                      <button type="submit" name="eliminar_video" class="btn btn-outline-danger btn-sm">
                        <i class="fas fa-trash me-1"></i> Eliminar Video
                      </button>
                    </form>
                  </div>
                </div>
              </div>
            <?php endif; ?>

            <?php if ($videoCafe): ?>
              <div class="col-md-6">
                <div class="card border-gray h-100">
                  <div class="card-header bg-medium-gray text-light py-2">
                    <h6 class="mb-0">Café y Cacao</h6>
                  </div>
                  <div class="card-body">
                    <h6 class="text-dark-gray"><?= htmlspecialchars($videoCafe['title_vid']) ?></h6>
                    <div class="ratio ratio-16x9 mb-3">
                      <video controls class="rounded">
                        <source src="<?= htmlspecialchars($videoCafe['ruta_video']) ?>" type="video/mp4">
                        Tu navegador no soporta el video.
                      </video>
                    </div>
                    <form action="routes/Videos.php" method="POST"
                      onsubmit="return confirm('¿Seguro que deseas eliminar este video?');" class="d-grid">
                      <input type="hidden" name="area" value="cafe">
                      <button type="submit" name="eliminar_video" class="btn btn-outline-danger btn-sm">
                        <i class="fas fa-trash me-1"></i> Eliminar Video
                      </button>
                    </form>
                  </div>
                </div>
              </div>
            <?php endif; ?>

            <?php if (!$videoElectronica && !$videoCafe): ?>
              <div class="col-12">
                <div class="alert alert-light-gray text-medium-gray">
                  No hay videos cargados actualmente.
                </div>
              </div>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </section>

    <!-- Portadas Section -->
    <section class="mb-5 px-4 mt-5" data-aos="fade-up">
      <div class="card shadow-sm border-0">
        <div class="card-header bg-dark text-light py-3 align-items-center d-flex justify-content-center text-center">
          <h5 class="mb-0 text-light transition-hover" style="cursor: pointer;">
            <i class="fas fa-photo-video me-2"></i> Gestión de Portadas
          </h5>
        </div>
        <style>
          .transition-hover {
            transition: all 0.3s ease;
            transform-origin: center;
          }

          .transition-hover:hover {
            transform: translateY(-10px) scale(1.05);
          }
        </style>

        <div class="card-body">
          <!-- Formulario para subir portadas -->
          <form action="routes/portada.php" method="POST" enctype="multipart/form-data" class="mb-5">
            <div class="row g-3">
              <div class="col-md-6">
                <label for="area" class="form-label">Área</label>
                <select name="area" class="form-select bg-light border-gray" required>
                  <option value="" disabled selected>Seleccione un área</option>
                  <option value="electronica">Electrónica</option>
                  <option value="cafe">Café y Cacao</option>
                </select>
              </div>
              <div class="col-md-6">
                <label for="titulo" class="form-label">Título</label>
                <input type="text" name="titulo" class="form-control bg-light border-gray" required>
              </div>
              <div class="col-md-6">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea name="descripcion" class="form-control bg-light border-gray" rows="3" required></textarea>
              </div>
              <div class="col-md-6">
                <label for="imagen" class="form-label">Imagen de Fondo</label>
                <input type="file" name="imagen" class="form-control bg-light border-gray" accept="image/*" required>
              </div>
              <div class="col-12">
                <button type="submit" name="subir_portada" class="btn btn-dark w-100 py-2">
                  <i class="fas fa-upload me-2"></i>Subir Portada
                </button>
              </div>
            </div>
          </form>

          <!-- Portadas existentes -->
          <h6 class="text-dark-gray mb-3 text-center">Portadas registradas</h6>
          <?php if (!empty($portadas)): ?>
            <div class="row g-4 justify-content-center">
              <?php foreach ($portadas as $portada): ?>
                <div class="col-12 col-sm-6 col-md-6 col-lg-4 d-flex justify-content-center">
                  <div class="card border-gray h-100" style="max-width: 100%;">
                    <img src="<?= htmlspecialchars($portada['ruta_img_port']) ?>" class="card-img-top img-thumbnail"
                      alt="Portada">
                    <div class="card-body">
                      <h6 class="text-dark-gray"><?= htmlspecialchars($portada['title_port']) ?></h6>
                      <p class="text-medium-gray small mb-0">
                        <i class="fas fa-tag me-1"></i><?= ucfirst($portada['area_port']) ?>
                      </p>
                    </div>
                    <div class="card-footer bg-transparent">
                      <form action="routes/Portada.php" method="post" onsubmit="return confirm('¿Eliminar esta portada?');"
                        class="d-grid">
                        <input type="hidden" name="area" value="<?= $portada['area_port'] ?>">
                        <button type="submit" name="eliminar_portada" class="btn btn-outline-danger btn-sm">
                          <i class="fas fa-trash me-1"></i> Eliminar
                        </button>
                      </form>
                    </div>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>
          <?php else: ?>
            <div class="alert alert-light-gray text-medium-gray">
              No hay portadas registradas actualmente.
            </div>
          <?php endif; ?>
        </div>
      </div>
    </section>

  </div>
</div>

<!-- Modal correcto para mostrar mensajes de éxito -->
<?php
$mostrarModal = false;
$tipo = 'success';
$descripcion = 'Proceso Completado Correctamente Sin Errores';

if (isset($_GET['mensaje'])) {
  $mostrarModal = true;
  $descripcion = $_GET['descripcion'] ?? $descripcion;
} elseif (isset($_GET['editado']) && $_GET['editado'] === 'ok') {
  $mostrarModal = true;
  $descripcion = 'Proceso Completado Correctamente Sin Errores.';
}
?>
<!-- Modal personalizado -->
<?php if ($mostrarModal): ?>
  <div class="modal fade" id="modalExito" tabindex="-1" aria-hidden="true" data-bs-backdrop="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content border-0 overflow-hidden" style="border-radius: 12px;">
        <div class="modal-body text-center p-0 animate__animated animate__bounceIn">
          <div class="dark-checkmark animate__animated animate__bounceIn">
            <div class="check-icon">
              <span class="icon-line line-tip"></span>
              <span class="icon-line line-long"></span>
              <div class="icon-circle"></div>
              <div class="icon-fix"></div>
            </div>
          </div>
          <div class="px-4 pb-4 pt-2">
            <h5 class="text-dark fw-bold mb-2">Acción Completada</h5>
            <p class="text-muted mb-0"><?= htmlspecialchars($descripcion) ?></p>
          </div>
          <div class="progress" style="height: 4px;">
            <div class="progress-bar bg-dark progress-bar-animated" role="progressbar" style="width: 100%"></div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    document.addEventListener("DOMContentLoaded", function() {
      const modal = new bootstrap.Modal(document.getElementById('modalExito'));
      modal.show();

      setTimeout(() => {
        const modalElement = document.getElementById('modalExito');
        const modalContent = modalElement.querySelector('.modal-body');
        modalContent.classList.remove('animate__bounceIn');
        modalContent.classList.add('animate__fadeOut');

        setTimeout(() => {
          modal.hide();
          modalContent.classList.remove('animate__fadeOut');
          modalContent.classList.add('animate__bounceIn');
        }, 400);
      }, 1500);

      const url = new URL(window.location.href);
      url.searchParams.delete('mensaje');
      url.searchParams.delete('descripcion');
      url.searchParams.delete('editado');
      window.history.replaceState({}, document.title, url.toString());
    });
  </script>
<?php endif; ?>

<style>
  /* Animaciones */
  .animate__animated {
    animation-duration: 0.6s;
  }

  .animate__bounceIn {
    animation-name: bounceIn;
  }

  .animate__fadeOut {
    animation-name: fadeOut;
  }

  @keyframes bounceIn {

    from,
    20%,
    40%,
    60%,
    80%,
    to {
      animation-timing-function: cubic-bezier(0.215, 0.610, 0.355, 1.000);
    }

    0% {
      opacity: 0;
      transform: scale3d(0.3, 0.3, 0.3);
    }

    20% {
      transform: scale3d(1.1, 1.1, 1.1);
    }

    40% {
      transform: scale3d(0.9, 0.9, 0.9);
    }

    60% {
      opacity: 1;
      transform: scale3d(1.03, 1.03, 1.03);
    }

    80% {
      transform: scale3d(0.97, 0.97, 0.97);
    }

    to {
      opacity: 1;
      transform: scale3d(1, 1, 1);
    }
  }

  @keyframes fadeOut {
    from {
      opacity: 1;
    }

    to {
      opacity: 0;
    }
  }

  /* Checkmark animado */
  .success-checkmark {
    width: 80px;
    height: 115px;
    margin: 0 auto;
    padding-top: 25px;
  }

  .check-icon {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    border: 4px solid #343a40;
    position: relative;
    margin: 0 auto;
  }


  .check-icon::before,
  .check-icon::after {
    content: '';
    height: 100px;
    position: absolute;
    background: transparent;
    transform: rotate(-45deg);
  }

  .check-icon::before {
    top: 3px;
    left: -2px;
    width: 30px;
    transform-origin: 100% 50%;
    border-radius: 100px 0 0 100px;
  }

  .check-icon::after {
    top: 0;
    left: 30px;
    width: 60px;
    transform-origin: 0 50%;
    border-radius: 0 100px 100px 0;
    animation: rotate-circle 4.25s ease-in;
  }

  .icon-line {
    height: 5px;
    background-color: #343a40;
    display: block;
    border-radius: 2px;
    position: absolute;
    z-index: 10;
  }

  .line-tip {
    top: 46px;
    left: 14px;
    width: 25px;
    transform: rotate(45deg);
    animation: icon-line-tip 0.75s;
  }

  .line-long {
    top: 38px;
    right: 8px;
    width: 47px;
    transform: rotate(-45deg);
    animation: icon-line-long 0.75s;
  }

  .icon-circle {
    top: -4px;
    left: -4px;
    z-index: 10;
    width: 80px;
    height: 80px;
    border-radius: 50%;
    position: absolute;
    box-sizing: content-box;
    border: 4px solid rgba(52, 58, 64, 0.2);
  }

  .icon-fix {
    top: 8px;
    width: 5px;
    left: 26px;
    height: 85px;
    position: absolute;
    transform: rotate(-45deg);
    background-color: transparent;
    z-index: 1;
  }

  @keyframes icon-line-tip {
    0% {
      width: 0;
      left: 1px;
      top: 19px;
    }

    54% {
      width: 0;
      left: 1px;
      top: 19px;
    }

    70% {
      width: 50px;
      left: -8px;
      top: 37px;
    }

    84% {
      width: 17px;
      left: 21px;
      top: 48px;
    }

    100% {
      width: 25px;
      left: 14px;
      top: 45px;
    }
  }

  @keyframes icon-line-long {
    0% {
      width: 0;
      right: 46px;
      top: 54px;
    }

    65% {
      width: 0;
      right: 46px;
      top: 54px;
    }

    84% {
      width: 55px;
      right: 0px;
      top: 35px;
    }

    100% {
      width: 47px;
      right: 8px;
      top: 38px;
    }
  }

  .progress-bar-animated {
    animation: progress-bar-stripes 0.5s linear infinite;
  }

  @keyframes progress-bar-stripes {
    0% {
      background-position: 1rem 0;
    }

    100% {
      background-position: 0 0;
    }
  }
</style>

<!-- modal incorrecto para mostrar mensajes de error -->
<?php
$mostrarModal = false;
$estadoModal = 'Error';
$mensajeModal = 'El Proceso No Se Completó Correctamente';

if (isset($_GET['estado'])) {
  $mostrarModal = true;
  $estadoModal = $_GET['estado'] ?? $estadoModal;
  $mensajeModal = $_GET['mensaje'] ?? $mensajeModal;
} elseif (isset($_GET['fallo']) && $_GET['fallo'] === 'errors') {
  $mostrarModal = true;
  $estadoModal = 'error';
  $mensajeModal = 'Ha ocurrido un error inesperado.';
}
?>

<?php if ($mostrarModal): ?>
  <div class="modal fade" id="modalEstadoRojo" tabindex="-1" aria-hidden="true" data-bs-backdrop="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content border-0 overflow-hidden" style="border-radius: 12px;">
        <div class="modal-body text-center p-0 animate__animated animate__bounceIn">
          <?php if ($estadoModal === 'success'): ?>
            <!-- Ícono de éxito -->
            <div class="dark-checkmark animate__animated animate__bounceIn">
              <div class="check-icon">
                <span class="icon-line line-tip"></span>
                <span class="icon-line line-long"></span>
                <div class="icon-circle"></div>
                <div class="icon-fix"></div>
              </div>
            </div>
          <?php else: ?>
            <!-- Ícono de error -->
            <div class="dark-error-icon animate__animated animate__bounceIn">
              <div class="error-icon">
                <span class="error-line line-left"></span>
                <span class="error-line line-right"></span>
                <div class="error-circle"></div>
                <div class="icon-fix"></div>
              </div>
            </div>
          <?php endif; ?>
          <div class="px-4 pb-4 pt-2">
            <h5 class="text-danger fw-bold mb-2">
              <?= $estadoModal === 'success' ? 'Acción Completada' : '¡Operación Fallida!' ?>
            </h5>
            <p class="text-muted mb-0"><?= htmlspecialchars($mensajeModal) ?></p>
          </div>
          <div class="progress" style="height: 4px;">
            <div class="progress-bar bg-danger progress-bar-animated" role="progressbar" style="width: 100%"></div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    document.addEventListener("DOMContentLoaded", function() {
      const modal = new bootstrap.Modal(document.getElementById('modalEstadoRojo'));
      modal.show();

      setTimeout(() => {
        const modalElement = document.getElementById('modalEstadoRojo');
        const modalContent = modalElement.querySelector('.modal-body');
        modalContent.classList.remove('animate__bounceIn');
        modalContent.classList.add('animate__fadeOut');

        setTimeout(() => {
          modal.hide();
          modalContent.classList.remove('animate__fadeOut');
          modalContent.classList.add('animate__bounceIn');
        }, 400);
      }, 1500);

      const url = new URL(window.location.href);
      url.searchParams.delete('estado');
      url.searchParams.delete('mensaje');
      url.searchParams.delete('fallo');
      window.history.replaceState({}, document.title, url.toString());
    });


    // Detectar y corregir overflow horizontal
    function checkOverflow() {
      if (document.documentElement.scrollWidth > window.innerWidth) {
        console.warn('Se detectó overflow horizontal!');
        // Aplicar correcciones emergentes
        document.body.style.overflowX = 'hidden';
      }
    }

    // Ejecutar al cargar y al redimensionar
    window.addEventListener('load', checkOverflow);
    window.addEventListener('resize', checkOverflow);

    // Ajustar el main content cuando hay sidebar
    function adjustMainContent() {
      const sidebar = document.getElementById('sidebar');
      const mainContent = document.querySelector('.main-content');

      if (sidebar && mainContent) {
        if (window.innerWidth >= 992) {
          mainContent.style.marginLeft = `${sidebar.offsetWidth}px`;
        } else {
          mainContent.style.marginLeft = '0';
        }
      }
    }

    window.addEventListener('resize', adjustMainContent);
    adjustMainContent();
  </script>
  <style>
    /* ICONO DE ERROR (X) */
    .error-icon {
      width: 80px;
      height: 80px;
      border-radius: 50%;
      border: 4px solid #dc3545;
      /* rojo */
      position: relative;
      margin: 0 auto;
    }

    .error-line {
      position: absolute;
      width: 40px;
      height: 5px;
      background-color: #dc3545;
      border-radius: 2px;
      top: 38px;
      left: 20px;
      z-index: 10;
    }

    .line-left {
      transform: rotate(45deg);
      animation: error-line-left 0.75s;
    }

    .line-right {
      transform: rotate(-45deg);
      animation: error-line-right 0.75s;
    }

    .error-circle {
      top: -4px;
      left: -4px;
      z-index: 10;
      width: 80px;
      height: 80px;
      border-radius: 50%;
      position: absolute;
      box-sizing: content-box;
      border: 4px solid rgba(220, 53, 69, 0.2);
    }

    /* Animaciones */
    @keyframes error-line-left {
      0% {
        width: 0;
        left: 40px;
        top: 40px;
      }

      50% {
        width: 40px;
        left: 20px;
        top: 38px;
      }

      100% {
        width: 40px;
      }
    }

    @keyframes error-line-right {
      0% {
        width: 0;
        left: 0px;
        top: 40px;
      }

      50% {
        width: 40px;
        left: 20px;
        top: 38px;
      }

      100% {
        width: 40px;
      }
    }
  </style>

<?php endif; ?>



<!-- Modal de edición -->
<?php foreach ($publicaciones as $pub): ?>
  <div class="modal fade" id="editarModal<?= $pub['id'] ?>" tabindex="-1"
    aria-labelledby="editarModalLabel<?= $pub['id'] ?>" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 60%;">
      <div class="modal-content shadow-lg rounded-4 border-0"
        style="backdrop-filter: blur(15px); background: rgba(255, 255, 255, 0.8);">

        <form action="/sennova/routes/EditPubli.php" method="post" enctype="multipart/form-data">
          <input type="hidden" name="id" value="<?= $pub['id'] ?>">

          <!-- Header (Oscuro) -->
          <div class="modal-header text-white border-0" style="background: linear-gradient(135deg, #121212, #474646ff);">
            <h5 class="modal-title" id="editarModalLabel<?= $pub['id'] ?>">
              <i class="fas fa-pen me-2"></i>Editar Publicación
            </h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
          </div>

          <!-- Body (Claro) -->
          <div class="modal-body p-4">
            <div class="form-floating mb-3">
              <input type="text" name="title" id="title<?= $pub['id'] ?>"
                class="form-control rounded-3 border-0 shadow-sm" value="<?= htmlspecialchars($pub['title']) ?>"
                placeholder="Título" required>
              <label for="title<?= $pub['id'] ?>">Título</label>
            </div>

            <div class="form-floating mb-3">
              <textarea name="content" id="content<?= $pub['id'] ?>" class="form-control rounded-3 border-0 shadow-sm"
                style="height: 120px;" placeholder="Contenido"
                required><?= htmlspecialchars($pub['content']) ?></textarea>
              <label for="content<?= $pub['id'] ?>">Contenido</label>
            </div>

            <div class="mb-4">
              <label class="form-label text-muted fw-semibold">Imagen (opcional)</label>
              <input type="file" name="image" class="form-control shadow-sm" accept="image/*">

              <?php if (!empty($pub['image_path'])): ?>
                <div class="mt-4 text-center">
                  <p class="fw-semibold mb-2 text-dark">Imagen actual</p>
                  <div class="d-flex flex-column align-items-center">
                    <img src="/sennova/img/<?= htmlspecialchars($pub['image_path']) ?>"
                      class="img-thumbnail rounded-3 mb-2 shadow-sm"
                      style="width: 140px; height: 140px; object-fit: cover;">

                    <div class="form-check form-switch">
                      <input class="form-check-input" type="checkbox" role="switch" id="eliminarImg<?= $pub['id'] ?>"
                        name="eliminar_imagen">
                      <label class="form-check-label small text-muted" for="eliminarImg<?= $pub['id'] ?>">
                        Eliminar imagen actual
                      </label>
                    </div>
                  </div>
                </div>
              <?php endif; ?>
            </div>
          </div>

          <!-- Footer (Oscuro) -->
          <div class="modal-footer border-0" style="background-color: #f1efefff;">
            <button type="button" class="btn btn-outline-dark rounded-pill px-4" data-bs-dismiss="modal">
              <i class="fas fa-times me-1"></i>Cancelar
            </button>
            <button type="submit" class="btn btn-dark rounded-pill px-4">
              <i class="fas fa-save me-1"></i>Guardar
            </button>
          </div>
        </form>

      </div>
    </div>
  </div>
<?php endforeach; ?>

<style>
  :root {
    --dark-gray: #343a40;
    --medium-gray: #6c757d;
    --light-gray: #e9ecef;
    --lighter-gray: #f8f9fa;
  }



  .bg-dark-gray {
    background-color: var(--dark-gray) !important;
  }

  .bg-medium-gray {
    background-color: var(--medium-gray) !important;
  }

  .bg-light-gray {
    background-color: var(--light-gray) !important;
  }

  .bg-lighter-gray {
    background-color: var(--lighter-gray) !important;
  }

  .text-dark-gray {
    color: var(--dark-gray) !important;
  }

  .text-medium-gray {
    color: var(--medium-gray) !important;
  }

  .border-gray {
    border: 1px solid #dee2e6 !important;
  }

  .alert-light-gray {
    background-color: var(--light-gray);
    color: var(--medium-gray);
    border: 1px solid #000000ff;
  }

  .nav-link {
    color: #adb5bd;
    transition: all 0.3s;
    border-radius: 4px;
    padding: 8px 12px;
    margin-bottom: 4px;
  }

  .nav-link:hover,
  .nav-link.active {
    color: white;
    background-color: rgba(255, 255, 255, 0.1);
  }

  .nav-link.active {
    font-weight: 500;
  }

  .card {
    transition: transform 0.2s, box-shadow 0.2s;
  }

  .card:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1) !important;
  }

  .form-control,
  .form-select {
    transition: border-color 0.3s;
  }

  .form-control:focus,
  .form-select:focus {
    border-color: var(--medium-gray);
    box-shadow: 0 0 0 0.25rem rgba(108, 117, 125, 0.25);
  }

  .btn-outline-danger {
    transition: all 0.3s;
  }
</style>