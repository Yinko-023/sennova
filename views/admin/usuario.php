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
      <!--  destacada -->
      <?php if (!empty($destacada)): ?>
        <?php
        $areaDest  = strtolower(trim($destacada['lab_area'] ?? ''));
        $badgeBgD  = ($areaDest === 'cafe') ? '#6f42c1' : (($areaDest === 'electronica') ? '#0dcaf0' : '#6c757d');
        $badgeTxD  = ($areaDest === 'electronica') ? '#000' : '#fff';
        ?>
        <h4 class="text-center fw-bold mb-4" data-aos="fade-down" data-aos-duration="800">
          <i class="fa-solid fa-star"></i> Destacada
        </h4>

        <div class="card shadow-lg border-0 rounded-4 bg-light mb-5">
          <div class="card shadow-lg border-0 rounded-4 bg-light">
            <div class="row g-0">
              <div class="col-md-4 d-flex align-items-center justify-content-center p-3">
                <?php if (!empty($destacada['image_path'])): ?>
                  <div class="ratio ratio-1x1 w-100">
                    <img
                      src="/sennova/img/<?= htmlspecialchars($destacada['image_path']) ?>"
                      class="img-fluid object-fit-cover rounded"
                      alt="Imagen destacada"
                      style="object-fit: cover;">
                  </div>
                <?php else: ?>
                  <p class="text-muted">Sin imagen</p>
                <?php endif; ?>
              </div>

              <div class="col-md-8">
                <div class="card-body">
                  <h5 class="card-title text-primary"><?= htmlspecialchars($destacada['title']) ?></h5>

                  <!-- Área destacada -->
                  <p class="mb-2">
                    <strong>Área:</strong>
                    <span class="badge ms-1" style="background-color: <?= $badgeBgD ?>; color: <?= $badgeTxD ?>;">
                      <?= htmlspecialchars(ucfirst($areaDest ?: 'Sin área')) ?>
                    </span>
                  </p>

                  <p class="card-text"><?= htmlspecialchars($destacada['content']) ?></p>
                  <p class="card-text">
                    <small class="text-muted">🗓 <?= htmlspecialchars($destacada['published_at']) ?></small>
                  </p>

                  <?php if (!empty($_SESSION['rol']) && (int)$_SESSION['rol'] === 1): ?>
                    <div class="text-end d-flex gap-2 justify-content-end">
                      <!-- Quitar destacado (modal) -->
                      <a href="/sennova/routes/DestacarPuliDelete.php?id=<?= (int)$destacada['id'] ?>"
                        class="btn btn-outline-secondary btn-sm js-confirm-link"
                        data-title="Quitar destacado"
                        data-html="¿Quitar <b>esta publicación</b> como destacada?"
                        data-confirm="Sí, quitar">
                        <i class="fas fa-minus-circle"></i> Quitar destacado
                      </a>

                      <!-- Eliminar publicación destacada (modal) -->
                      <a href="/sennova/routes/eliminarPublicacion.php?id=<?= (int)$destacada['id'] ?>"
                        class="btn btn-outline-danger btn-sm js-confirm-link"
                        data-title="Eliminar publicación"
                        data-html="Esta acción <b>no se puede deshacer</b>."
                        data-confirm="Sí, eliminar">
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

      <!-- publicaciones -->
      <div class="row g-4">
        <?php foreach ($publicaciones as $index => $pub): ?>
          <?php
          $areaPub   = strtolower(trim($pub['lab_area'] ?? ''));
          $badgeBg   = ($areaPub === 'cafe') ? '#6f42c1' : (($areaPub === 'electronica') ? '#0dcaf0' : '#6c757d');
          $badgeText = ($areaPub === 'electronica') ? '#000' : '#fff';
          ?>
          <div class="col-12 col-sm-6 col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="<?= ($index + 1) * 100 ?>">
            <div class="card h-100 shadow border-0 rounded-3">
              <div class="card-img-top bg-light d-flex align-items-center justify-content-center p-2"
                style="height: 200px; overflow: hidden;">
                <?php if (!empty($pub['image_path'])): ?>
                  <img
                    src="/sennova/img/<?= htmlspecialchars($pub['image_path']) ?>"
                    class="img-fluid rounded object-fit-cover"
                    alt="Imagen"
                    style="max-height: 100%; object-fit: cover;">
                <?php else: ?>
                  <p class="text-muted">Sin imagen</p>
                <?php endif; ?>
              </div>

              <div class="card-body d-flex flex-column">
                <h5 class="card-title"><?= htmlspecialchars($pub['title']) ?></h5>

                <!-- Área de la publicación -->
                <p class="mb-2">
                  <strong>Área:</strong>
                  <span class="badge ms-1" style="background-color: <?= $badgeBg ?>; color: <?= $badgeText ?>;">
                    <?= htmlspecialchars(ucfirst($areaPub ?: 'Sin área')) ?>
                  </span>
                </p>

                <p class="card-text"><?= htmlspecialchars($pub['content']) ?></p>

                <p class="card-text mt-auto">
                  <small class="text-muted">🕒 <?= htmlspecialchars($pub['published_at'] ?? '') ?></small>
                </p>
              </div>

              <?php if (!empty($_SESSION['rol']) && (int)$_SESSION['rol'] === 1): ?>
                <div class="card-footer d-flex justify-content-end gap-2 bg-white border-0">
                  <button type="button" class="btn btn-outline-warning btn-sm"
                    data-bs-toggle="modal"
                    data-bs-target="#editarModal<?= (int)$pub['id'] ?>">
                    <i class="fas fa-edit"></i>
                  </button>

                  <!-- Destacar (modal) -->
                  <a href="/sennova/routes/destacarPubli.php?id=<?= (int)$pub['id'] ?>"
                    class="btn btn-outline-primary btn-sm js-confirm-link"
                    data-title="Destacar publicación"
                    data-html="¿Deseas destacar <b>esta publicación</b>?"
                    data-confirm="Sí, destacar">
                    <i class="fas fa-star"></i>
                  </a>

                  <!-- Eliminar publicación (modal) -->
                  <a href="/sennova/routes/eliminarPublicacion.php?id=<?= (int)$pub['id'] ?>"
                    class="btn btn-outline-danger btn-sm js-confirm-link"
                    data-title="Eliminar publicación"
                    data-html="Esta acción <b>no se puede deshacer</b>."
                    data-confirm="Sí, eliminar">
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
            transition: all .3s ease;
            transform-origin: center
          }

          .transition-hover:hover {
            transform: translateY(-10px) scale(1.05)
          }
        </style>

        <div class="card-body">

          <!-- ====== Formulario para subir ====== -->
          <form action="routes/carrusel.php?action=agregar" method="post" enctype="multipart/form-data" class="container-fluid mb-4">
            <div class="row g-3">
              <div class="col-md-6">
                <label class="form-label">Título de la imagen</label>
                <input type="text" name="titulo" class="form-control bg-light border-gray" required placeholder="Ej. Transformando el Futuro">
              </div>
              <div class="col-md-6">
                <label class="form-label">Seleccionar imagen</label>
                <input type="file" name="imagen" class="form-control bg-light border-gray" accept="image/*" required>
              </div>
              <div class="col-12">
                <button type="submit" class="btn btn-dark w-100 py-2">
                  <i class="fas fa-upload me-2"></i> Subir Imagen
                </button>
              </div>
            </div>
          </form>

          <!-- ====== Listado de imágenes ====== -->
          <h6 class="mt-5 mb-3 text-dark-gray text-center">Imágenes actuales del carrusel</h6>

          <?php if (!empty($slides)): ?>
            <div class="row g-3 justify-content-center">

              <?php foreach ($slides as $slide):
                $id            = (int)$slide['id_car'];
                $tituloActual  = htmlspecialchars($slide['name_img_c'] ?? '');
                $imgActual     = htmlspecialchars($slide['title_carr'] ?? '');
                $modalId       = 'modalEditarSlide_' . $id;
              ?>
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 d-flex justify-content-center">
                  <div class="card border-gray h-100" style="max-width:100%;">
                    <?php if ($imgActual): ?>
                      <img src="<?= $imgActual ?>" class="card-img-top img-thumbnail" alt="Imagen del carrusel">
                    <?php else: ?>
                      <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height:180px">
                        <span class="text-muted">Sin imagen</span>
                      </div>
                    <?php endif; ?>

                    <div class="card-body text-center">
                      <h6 class="card-title text-dark-gray"><?= $tituloActual ?></h6>
                    </div>

                    <div class="card-footer bg-transparent border-top-0 d-flex gap-2 justify-content-center">
                      <!-- EDITAR -->
                      <button type="button" class="btn btn-outline-warning btn-sm"
                        data-bs-toggle="modal" data-bs-target="#<?= $modalId ?>">
                        <i class="fas fa-edit"></i> Editar
                      </button>

                      <!-- ELIMINAR -->
                      <form action="routes/carrusel.php" method="post" class="d-inline">
                        <input type="hidden" name="action" value="eliminar">
                        <input type="hidden" name="id" value="<?= $id ?>">
                        <button type="button"
                          class="btn btn-outline-danger btn-sm js-confirm-submit"
                          data-title="Eliminar imagen"
                          data-html="¿Eliminar <b><?= $tituloActual ?></b> del carrusel?<br>Esta acción no se puede deshacer."
                          data-confirm="Sí, eliminar">
                          <i class="fas fa-trash me-1"></i> Eliminar
                        </button>
                      </form>
                    </div>
                  </div>
                </div>

                <!-- ====== MODAL EDITAR (único por slide) ====== -->
                <div class="modal fade" id="<?= $modalId ?>" tabindex="-1" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                      <form action="routes/carrusel.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="action" value="editar">
                        <input type="hidden" name="id" value="<?= $id ?>">

                        <div class="modal-header">
                          <h5 class="modal-title">Editar imagen del carrusel</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                        </div>

                        <div class="modal-body">
                          <div class="mb-3">
                            <label class="form-label">Título</label>
                            <input type="text" name="titulo" class="form-control" required value="<?= $tituloActual ?>">
                            <small class="text-muted">No puede repetirse con otras imágenes (no distingue mayúsculas/minúsculas).</small>
                          </div>

                          <div class="mb-3">
                            <label class="form-label">Reemplazar imagen (opcional)</label>
                            <input type="file" name="imagen" class="form-control" accept="image/*">
                            <small class="text-muted">Déjalo vacío para conservar la actual.</small>
                          </div>

                          <?php if ($imgActual): ?>
                            <div class="text-center">
                              <img src="<?= $imgActual ?>" alt="Actual" class="img-fluid rounded" style="max-height:160px">
                            </div>
                          <?php endif; ?>
                        </div>

                        <div class="modal-footer">
                          <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                          <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i> Guardar cambios
                          </button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
                <!-- /MODAL EDITAR -->
              <?php endforeach; ?>

            </div>
          <?php else: ?>
            <div class="alert alert-light-gray text-medium-gray">No hay imágenes en el carrusel actualmente.</div>
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

          <?php if (!empty($_GET['video_ok'])): ?>
            <div class="alert alert-success"><?= htmlspecialchars($_GET['video_ok']) ?></div>
          <?php endif; ?>
          <?php if (!empty($_GET['video_err'])): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($_GET['video_err']) ?></div>
          <?php endif; ?>

          <?php
          // Ocupación por área para deshabilitar opciones
          $ocupadaElectronica = !empty($videoElectronica);
          $ocupadaCafe        = !empty($videoCafe);
          ?>

          <!-- Formulario para subir videos -->
          <form action="routes/Videos.php" method="POST" enctype="multipart/form-data" class="mb-5">
            <div class="row g-3">
              <input type="hidden" name="subir_video" value="1">

              <div class="col-md-6">
                <label for="area" class="form-label">Área del laboratorio</label>
                <select name="area" id="area" class="form-select bg-light border-gray" required>
                  <option value="" disabled selected>Selecciona un área</option>
                  <option value="electronica" <?= $ocupadaElectronica ? 'disabled' : '' ?>>
                    Electrónica <?= $ocupadaElectronica ? '(ya tiene video)' : '' ?>
                  </option>
                  <option value="cafe" <?= $ocupadaCafe ? 'disabled' : '' ?>>
                    Café y Cacao <?= $ocupadaCafe ? '(ya tiene video)' : '' ?>
                  </option>
                </select>
                <?php if ($ocupadaElectronica || $ocupadaCafe): ?>
                  <small class="text-muted d-block mt-1">
                    Si un área ya tiene video, edítalo o elimínalo antes de subir uno nuevo.
                  </small>
                <?php endif; ?>
              </div>

              <div class="col-md-6">
                <label for="titulo" class="form-label">Título principal</label>
                <input type="text" name="titulo" id="titulo" class="form-control bg-light border-gray" required
                  placeholder="Ej: Innovación con Tecnología">
              </div>

              <div class="col-md-6">
                <label for="texto_principal" class="form-label">Texto descriptivo</label>
                <textarea name="texto_principal" id="texto_principal" class="form-control bg-light border-gray" rows="3" required></textarea>
              </div>

              <div class="col-md-6">
                <label for="texto_secundario" class="form-label">Texto complementario</label>
                <textarea name="texto_secundario" id="texto_secundario" class="form-control bg-light border-gray" rows="3" required></textarea>
              </div>

              <div class="col-12">
                <label for="video" class="form-label">Seleccionar video (MP4)</label>
                <input type="file" name="video" id="video" class="form-control bg-light border-gray" accept="video/mp4" required>
              </div>

              <div class="col-12">
                <button type="submit" class="btn btn-dark w-100 py-2">
                  <i class="fas fa-upload me-2"></i>Subir Video
                </button>
              </div>
            </div>
          </form>

          <!-- Videos existentes -->
          <h6 class="text-dark mb-3 text-center">Videos actuales</h6>
          <div class="row g-4">

            <!-- ======= ELECTRÓNICA ======= -->
            <?php if ($videoElectronica): ?>
              <div class="col-md-6">
                <div class="card border-gray h-100">
                  <div class="card-header bg-medium-gray text-light py-2 d-flex justify-content-between align-items-center">
                    <h6 class="mb-0">Electrónica</h6>
                    <div class="d-flex gap-2">
                      <!-- Editar (abre modal) -->
                      <button type="button" class="btn btn-outline-warning btn-sm"
                        data-bs-toggle="modal" data-bs-target="#modalEditarElectronica">
                        <i class="fas fa-edit me-1"></i> Editar
                      </button>
                    </div>
                  </div>

                  <div class="card-body">
                    <h6 class="text-dark-gray"><?= htmlspecialchars($videoElectronica['title_vid']) ?></h6>

                    <?php if (!empty($videoElectronica['ruta_video'])): ?>
                      <div class="ratio ratio-16x9 mb-3">
                        <video controls class="rounded">
                          <source src="<?= htmlspecialchars($videoElectronica['ruta_video']) ?>" type="video/mp4">
                          Tu navegador no soporta el video.
                        </video>
                      </div>
                    <?php else: ?>
                      <div class="alert alert-info py-2">Sin archivo de video. Solo hay texto.</div>
                    <?php endif; ?>

                    <!-- Eliminar COMPLETAMENTE el registro -->
                    <form action="routes/Videos.php" method="POST" class="d-grid">
                      <input type="hidden" name="area" value="electronica">
                      <input type="hidden" name="eliminar_video" value="1">
                      <button type="button"
                        class="btn btn-outline-danger btn-sm js-confirm-submit"
                        data-title="Eliminar video"
                        data-html="¿Eliminar el <b>registro completo</b> del área Electrónica?<br>Se borrará también el archivo si existe."
                        data-confirm="Sí, eliminar">
                        <i class="fas fa-trash me-1"></i> Eliminar todo
                      </button>
                    </form>
                  </div>
                </div>
              </div>

            <?php endif; ?>

            <!-- ======= CAFÉ Y CACAO ======= -->
            <?php if ($videoCafe): ?>
              <div class="col-md-6">
                <div class="card border-gray h-100">
                  <div class="card-header bg-medium-gray text-light py-2 d-flex justify-content-between align-items-center">
                    <h6 class="mb-0">Café y Cacao</h6>
                    <div class="d-flex gap-2">
                      <!-- Editar (abre modal) -->
                      <button type="button" class="btn btn-outline-warning btn-sm"
                        data-bs-toggle="modal" data-bs-target="#modalEditarCafe">
                        <i class="fas fa-edit me-1"></i> Editar
                      </button>
                    </div>
                  </div>

                  <div class="card-body">
                    <h6 class="text-dark-gray"><?= htmlspecialchars($videoCafe['title_vid']) ?></h6>

                    <?php if (!empty($videoCafe['ruta_video'])): ?>
                      <div class="ratio ratio-16x9 mb-3">
                        <video controls class="rounded">
                          <source src="<?= htmlspecialchars($videoCafe['ruta_video']) ?>" type="video/mp4">
                          Tu navegador no soporta el video.
                        </video>
                      </div>
                    <?php else: ?>
                      <div class="alert alert-info py-2">Sin archivo de video. Solo hay texto.</div>
                    <?php endif; ?>

                    <!-- Eliminar COMPLETAMENTE el registro -->
                    <form action="routes/Videos.php" method="POST" class="d-grid">
                      <input type="hidden" name="area" value="cafe">
                      <input type="hidden" name="eliminar_video" value="1">
                      <button type="button"
                        class="btn btn-outline-danger btn-sm js-confirm-submit"
                        data-title="Eliminar video"
                        data-html="¿Eliminar el <b>registro completo</b> del área Café y Cacao?<br>Se borrará también el archivo si existe."
                        data-confirm="Sí, eliminar">
                        <i class="fas fa-trash me-1"></i> Eliminar todo
                      </button>
                    </form>
                  </div>
                </div>
              </div>

              <!-- MODAL EDITAR CAFÉ -->
              <div class="modal fade" id="modalEditarCafe" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                  <div class="modal-content">
                    <form action="routes/Videos.php" method="POST" enctype="multipart/form-data">
                      <input type="hidden" name="action" value="editar_video">
                      <input type="hidden" name="area" value="cafe">

                      <div class="modal-header">
                        <h5 class="modal-title">Editar video - Café y Cacao</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                      </div>

                      <div class="modal-body">
                        <div class="row g-3">
                          <div class="col-md-6">
                            <label class="form-label">Título principal</label>
                            <input type="text" name="titulo" class="form-control" required
                              value="<?= htmlspecialchars($videoCafe['title_vid']) ?>">
                          </div>
                          <div class="col-md-6">
                            <label class="form-label">Reemplazar video (opcional)</label>
                            <input type="file" name="video" class="form-control" accept="video/mp4">
                            <small class="text-muted">Déjalo vacío para conservar el actual.</small>
                          </div>
                          <div class="col-md-6">
                            <label class="form-label">Texto descriptivo</label>
                            <textarea name="texto_principal" class="form-control" rows="3" required><?= htmlspecialchars($videoCafe['text_pri']) ?></textarea>
                          </div>
                          <div class="col-md-6">
                            <label class="form-label">Texto complementario</label>
                            <textarea name="texto_secundario" class="form-control" rows="3" required><?= htmlspecialchars($videoCafe['text_sec']) ?></textarea>
                          </div>
                        </div>
                      </div>

                      <div class="modal-footer justify-content-between">
                        <!-- Eliminar SOLO el archivo de video -->
                        <button type="button"
                          class="btn btn-outline-secondary js-eliminar-solo-video"
                          data-area="cafe"
                          data-title="Eliminar solo el archivo"
                          data-html="Se eliminará <b>solo el archivo de video</b> del área Café y Cacao. Los textos se conservarán."
                          data-confirm="Sí, eliminar video">
                          <i class="fas fa-scissors me-1"></i> Eliminar solo el video
                        </button>

                        <div>
                          <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                          <button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i> Guardar cambios</button>
                        </div>
                      </div>
                    </form>

                    <!-- Form oculto para quitar SOLO el video -->
                    <form action="routes/Videos.php" method="POST" class="d-none" id="formQuitarVideo-cafe">
                      <input type="hidden" name="action" value="quitar_video">
                      <input type="hidden" name="area" value="cafe">
                    </form>
                  </div>
                </div>
              </div>
              <!-- MODAL EDITAR ELECTRÓNICA -->
              <div class="modal fade" id="modalEditarElectronica" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                  <div class="modal-content">
                    <form action="routes/Videos.php" method="POST" enctype="multipart/form-data">
                      <input type="hidden" name="action" value="editar_video">
                      <input type="hidden" name="area" value="electronica">

                      <div class="modal-header">
                        <h5 class="modal-title">Editar video - Electrónica</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                      </div>

                      <div class="modal-body">
                        <div class="row g-3">
                          <div class="col-md-6">
                            <label class="form-label">Título principal</label>
                            <input type="text" name="titulo" class="form-control" required
                              value="<?= htmlspecialchars($videoElectronica['title_vid']) ?>">
                          </div>
                          <div class="col-md-6">
                            <label class="form-label">Reemplazar video (opcional)</label>
                            <input type="file" name="video" class="form-control" accept="video/mp4">
                            <small class="text-muted">Déjalo vacío para conservar el actual.</small>
                          </div>
                          <div class="col-md-6">
                            <label class="form-label">Texto descriptivo</label>
                            <textarea name="texto_principal" class="form-control" rows="3" required><?= htmlspecialchars($videoElectronica['text_pri']) ?></textarea>
                          </div>
                          <div class="col-md-6">
                            <label class="form-label">Texto complementario</label>
                            <textarea name="texto_secundario" class="form-control" rows="3" required><?= htmlspecialchars($videoElectronica['text_sec']) ?></textarea>
                          </div>
                        </div>
                      </div>

                      <div class="modal-footer justify-content-between">
                        <!-- Eliminar SOLO el archivo de video -->
                        <button type="button"
                          class="btn btn-outline-secondary js-eliminar-solo-video"
                          data-area="electronica"
                          data-title="Eliminar solo el archivo"
                          data-html="Se eliminará <b>solo el archivo de video</b> del área Electrónica. Los textos se conservarán."
                          data-confirm="Sí, eliminar video">
                          <i class="fas fa-scissors me-1"></i> Eliminar solo el video
                        </button>

                        <div>
                          <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                          <button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i> Guardar cambios</button>
                        </div>
                      </div>
                    </form>

                    <!-- Form oculto para quitar SOLO el video -->
                    <form action="routes/Videos.php" method="POST" class="d-none" id="formQuitarVideo-electronica">
                      <input type="hidden" name="action" value="quitar_video">
                      <input type="hidden" name="area" value="electronica">
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
            transition: .3s;
            transform-origin: center
          }

          .transition-hover:hover {
            transform: translateY(-10px) scale(1.05)
          }
        </style>

        <div class="card-body">

          <!-- Formulario para subir portadas -->
          <?php
          // Detectar qué áreas ya tienen portada
          $areasConPortada = ['electronica' => false, 'cafe' => false];
          if (!empty($portadas)) {
            foreach ($portadas as $p) {
              $areaKey = strtolower(trim($p['area_port'] ?? ''));
              if (isset($areasConPortada[$areaKey])) {
                $areasConPortada[$areaKey] = true;
              }
            }
          }
          $ocupE = !empty($areasConPortada['electronica']);
          $ocupC = !empty($areasConPortada['cafe']);
          ?>
          <form action="routes/portada.php" method="POST" enctype="multipart/form-data" class="mb-5">
            <div class="row g-3">
              <div class="col-md-6">
                <label class="form-label">Área</label>
                <select name="area" class="form-select bg-light border-gray" required>
                  <option value="" disabled selected>Seleccione un área</option>
                  <option value="electronica" <?= $ocupE ? 'disabled' : '' ?>>
                    Electrónica<?= $ocupE ? ' (ya tiene portada)' : '' ?>
                  </option>
                  <option value="cafe" <?= $ocupC ? 'disabled' : '' ?>>
                    Café y Cacao<?= $ocupC ? ' (ya tiene portada)' : '' ?>
                  </option>
                </select>
                <?php if ($ocupE || $ocupC): ?>
                  <small class="text-muted d-block mt-1">
                    Las áreas marcadas como <em>(ya tiene portada)</em> están ocupadas.
                    Edita o elimina la portada existente para subir una nueva.
                  </small>
                <?php endif; ?>
              </div>

              <div class="col-md-6">
                <label class="form-label">Título</label>
                <input type="text" name="titulo" class="form-control bg-light border-gray" required>
              </div>
              <div class="col-md-6">
                <label class="form-label">Descripción</label>
                <textarea name="descripcion" class="form-control bg-light border-gray" rows="3" required></textarea>
              </div>
              <div class="col-md-6">
                <label class="form-label">Imagen de Fondo</label>
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
              <?php foreach ($portadas as $portada):
                $area   = htmlspecialchars($portada['area_port']);
                $areaUc = htmlspecialchars(ucfirst($portada['area_port']));
                $img    = htmlspecialchars($portada['ruta_img_port'] ?? '');
                $titulo = htmlspecialchars($portada['title_port'] ?? '');
                $desc   = htmlspecialchars($portada['desc_port'] ?? '');
                $modalId = 'modalEditarPortada_' . $area; // electronica | cafe
              ?>
                <div class="col-12 col-sm-6 col-md-6 col-lg-4 d-flex justify-content-center">
                  <div class="card border-gray h-100" style="max-width:100%;">
                    <?php if ($img): ?>
                      <img src="<?= $img ?>" class="card-img-top img-thumbnail" alt="Portada">
                    <?php else: ?>
                      <div class="card-img-top d-flex align-items-center justify-content-center bg-light" style="height:180px">
                        <span class="text-muted">Sin imagen</span>
                      </div>
                    <?php endif; ?>

                    <div class="card-body">
                      <h6 class="text-dark-gray"><?= $titulo ?></h6>
                      <p class="text-medium-gray small mb-1"><i class="fas fa-tag me-1"></i><?= $areaUc ?></p>
                      <?php if ($desc): ?>
                        <p class="small mb-0"><?= nl2br($desc) ?></p>
                      <?php endif; ?>
                    </div>

                    <div class="card-footer bg-transparent d-flex gap-2">
                      <!-- Editar -->
                      <button type="button" class="btn btn-outline-warning btn-sm"
                        data-bs-toggle="modal" data-bs-target="#<?= $modalId ?>">
                        <i class="fas fa-edit"></i> Editar
                      </button>

                      <!-- Eliminar registro (BD + archivo) -->
                      <form action="routes/Portada.php" method="post" class="d-inline-flex">
                        <input type="hidden" name="area" value="<?= $area ?>">
                        <button type="button"
                          name="eliminar_portada"
                          class="btn btn-outline-danger btn-sm js-confirm-submit"
                          data-title="Eliminar portada"
                          data-html="¿Eliminar la portada del área <b><?= $areaUc ?></b>?<br>Se eliminará el registro y el archivo."
                          data-confirm="Sí, eliminar">
                          <i class="fas fa-trash me-1"></i> Eliminar
                        </button>
                      </form>
                    </div>
                  </div>
                </div>
                <!-- MODAL EDITAR -->
                <div class="modal fade" id="<?= $modalId ?>" tabindex="-1" aria-hidden="true">
                  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                      <form action="routes/portada.php" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="area" value="<?= $area ?>">
                        <div class="modal-header">
                          <h5 class="modal-title">Editar portada - <?= $areaUc ?></h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                        </div>
                        <div class="modal-body">
                          <div class="row g-3">
                            <div class="col-md-6">
                              <label class="form-label">Título</label>
                              <input type="text" name="titulo" class="form-control" value="<?= $titulo ?>" required>
                            </div>
                            <div class="col-md-6">
                              <label class="form-label">Reemplazar imagen (opcional)</label>
                              <input type="file" name="imagen" class="form-control" accept="image/*">
                              <small class="text-muted">Déjalo vacío para conservar la actual.</small>
                            </div>
                            <div class="col-12">
                              <label class="form-label">Descripción</label>
                              <textarea name="descripcion" class="form-control" rows="4" required><?= $desc ?></textarea>
                            </div>
                            <div class="col-12">
                              <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="delImg_<?= $area ?>" name="eliminar_solo_imagen">
                                <label class="form-check-label" for="delImg_<?= $area ?>">
                                  Eliminar <b>solo</b> la imagen y conservar el texto
                                </label>
                              </div>
                              <small class="text-muted d-block">Si marcas esta opción, se borrará el archivo aunque no subas una nueva imagen.</small>
                            </div>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                          <button type="submit" name="editar_portada" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i> Guardar cambios
                          </button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>
          <?php else: ?>
            <div class="alert alert-light-gray text-medium-gray">No hay portadas registradas actualmente.</div>
          <?php endif; ?>
        </div>
      </div>
    </section>

  </div>
</div>

<!-- Modal de edición -->
<?php foreach ($publicaciones as $pub): ?>
  <div class="modal fade" id="editarModal<?= $pub['id'] ?>" tabindex="-1"
    aria-labelledby="editarModalLabel<?= $pub['id'] ?>" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content shadow-lg rounded-4 border-0">

        <form action="/sennova/routes/EditPubli.php" method="post" enctype="multipart/form-data">
          <input type="hidden" name="id" value="<?= $pub['id'] ?>">

          <!-- Header -->
          <div class="modal-header text-white border-0 bg-dark">
            <h5 class="modal-title" id="editarModalLabel<?= $pub['id'] ?>">
              <i class="fas fa-pen me-2"></i>Editar Publicación
            </h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
          </div>

          <!-- Body -->
          <div class="modal-body p-4 bg-light">
            <div class="form-floating mb-3">
              <input type="text" name="title" id="title<?= $pub['id'] ?>"
                class="form-control rounded-3 border-secondary shadow-sm"
                value="<?= htmlspecialchars($pub['title']) ?>"
                placeholder="Título" required>
              <label for="title<?= $pub['id'] ?>">Título</label>
            </div>

            <div class="form-floating mb-3">
              <textarea name="content" id="content<?= $pub['id'] ?>"
                class="form-control rounded-3 border-secondary shadow-sm"
                style="height: 120px;" placeholder="Contenido" required><?=
                                                                        htmlspecialchars($pub['content']) ?></textarea>
              <label for="content<?= $pub['id'] ?>">Contenido</label>
            </div>

            <div class="mb-4">
              <label class="form-label text-dark fw-semibold">Imagen (opcional)</label>
              <input type="file" name="image" class="form-control shadow-sm border-secondary" accept="image/*">

              <?php if (!empty($pub['image_path'])): ?>
                <div class="mt-4 text-center">
                  <p class="fw-semibold mb-2 text-dark">Imagen actual</p>
                  <div class="d-flex flex-column align-items-center">
                    <img src="/sennova/img/<?= htmlspecialchars($pub['image_path']) ?>"
                      class="img-thumbnail rounded-3 mb-2 shadow-sm border-secondary"
                      style="width: 140px; height: 140px; object-fit: cover;">

                    <div class="form-check form-switch">
                      <input class="form-check-input" type="checkbox" role="switch"
                        id="eliminarImg<?= $pub['id'] ?>" name="eliminar_imagen">
                      <label class="form-check-label small text-dark" for="eliminarImg<?= $pub['id'] ?>">
                        Eliminar imagen actual
                      </label>
                    </div>
                  </div>
                </div>
              <?php endif; ?>
            </div>
          </div>

          <!-- Footer -->
          <div class="modal-footer border-0 bg-white">
            <button type="button" class="btn btn-outline-secondary rounded-pill px-4" data-bs-dismiss="modal">
              <i class="fas fa-times me-1"></i>Cancelar
            </button>
            <button type="submit" class="btn btn-primary rounded-pill px-4">
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

  /* Icono de Error (X) */
  .error-icon {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    border: 4px solid #dc3545;
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

  /* Utilidades de Color */
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

  /* Componentes de Navegación */
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

  /* Componentes de Tarjeta */
  .card {
    transition: transform 0.2s, box-shadow 0.2s;
  }

  .card:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1) !important;
  }

  /* Formularios */
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

  /* Animaciones Generales */
  .animate__animated {
    animation-duration: 0.6s;
  }

  .animate__bounceIn {
    animation-name: bounceIn;
  }

  .animate__fadeOut {
    animation-name: fadeOut;
  }

  /* Icono de Éxito (Checkmark) */
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

  /* Keyframes de Animación */
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

  @keyframes bounceIn {
    from, 20%, 40%, 60%, 80%, to {
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

  @keyframes rotate-circle {
    0% {
      transform: rotate(-45deg);
    }
    5% {
      transform: rotate(-45deg);
    }
    12% {
      transform: rotate(-405deg);
    }
    100% {
      transform: rotate(-405deg);
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

<script>
document.addEventListener('DOMContentLoaded', function() {
  // Manejo de enlaces con confirmación
  document.addEventListener('click', function(e) {
    const link = e.target.closest('.js-confirm-link');
    if (link) {
      e.preventDefault();
      const title = link.dataset.title || '¿Confirmar acción?';
      const html = link.dataset.html || 'Esta acción no se puede deshacer.';
      const confirmText = link.dataset.confirm || 'Sí, continuar';

      if (window.Swal) {
        Swal.fire({
          title,
          html,
          icon: 'warning',
          showCancelButton: true,
          confirmButtonText: confirmText,
          cancelButtonText: 'Cancelar',
          confirmButtonColor: '#d33',
          reverseButtons: true
        }).then((res) => {
          if (res.isConfirmed) window.location.href = link.getAttribute('href');
        });
      } else {
        if (confirm(title.replace(/<[^>]*>/g, ''))) {
          window.location.href = link.getAttribute('href');
        }
      }
      return;
    }

    // Manejo de botones de envío de formularios
    const btn = e.target.closest('.js-confirm-submit');
    if (btn) {
      e.preventDefault();
      const form = btn.closest('form');
      if (!form) return;

      const title = btn.dataset.title || '¿Confirmar acción?';
      const html = btn.dataset.html || 'Esta acción no se puede deshacer.';
      const confirmText = btn.dataset.confirm || 'Sí, continuar';

      if (window.Swal) {
        Swal.fire({
          title,
          html,
          icon: 'warning',
          showCancelButton: true,
          confirmButtonText: confirmText,
          cancelButtonText: 'Cancelar',
          confirmButtonColor: '#d33',
          reverseButtons: true
        }).then((res) => {
          if (res.isConfirmed) {
            // Para botones con nombre específico (como "eliminar_portada")
            if (btn.name) {
              const hiddenInput = document.createElement('input');
              hiddenInput.type = 'hidden';
              hiddenInput.name = btn.name;
              hiddenInput.value = '1';
              form.appendChild(hiddenInput);
            }
            form.submit();
          }
        });
      } else {
        if (confirm(title.replace(/<[^>]*>/g, '') + '\n\n' + html.replace(/<[^>]*>/g, ''))) {
          form.submit();
        }
      }
      return;
    }

    // Manejo específico para eliminar solo video
    const videoBtn = e.target.closest('.js-eliminar-solo-video');
    if (videoBtn) {
      e.preventDefault();
      const area = videoBtn.dataset.area;
      const form = document.getElementById('formQuitarVideo-' + area);
      if (!form) return;

      const title = videoBtn.dataset.title || '¿Eliminar solo el video?';
      const html = videoBtn.dataset.html || 'Se conservarán los textos.';
      const confirmText = videoBtn.dataset.confirm || 'Sí, eliminar video';

      if (window.Swal) {
        Swal.fire({
          title,
          html,
          icon: 'warning',
          showCancelButton: true,
          confirmButtonText: confirmText,
          cancelButtonText: 'Cancelar',
          confirmButtonColor: '#d33',
          reverseButtons: true
        }).then(res => {
          if (res.isConfirmed) form.submit();
        });
      } else {
        if (confirm(title.replace(/<[^>]*>/g, '') + '\n\n' + html.replace(/<[^>]*>/g, ''))) {
          form.submit();
        }
      }
    }
  });

  // Manejo de portada duplicada desde query parameters
  const urlParams = new URLSearchParams(location.search);
  if (urlParams.get('portada_duplicada') === '1') {
    const area = urlParams.get('area') || '';
    if (window.Swal) {
      Swal.fire({
        icon: 'error',
        title: 'Acción no válida',
        html: `Ya existe una portada para el área <b>${area}</b>. Elimínala o edítala.`,
        confirmButtonText: 'Entendido'
      });
    } else {
      alert(`Ya existe una portada para el área ${area}. Elimínala o edítala.`);
    }
    
    // Limpiar parámetros de la URL
    urlParams.delete('portada_duplicada');
    urlParams.delete('area');
    const cleanUrl = location.pathname + (urlParams.toString() ? '?' + urlParams.toString() : '');
    history.replaceState(null, '', cleanUrl);
  }
});

(function () {
  // 1) Mover todos los modales al <body> para evitar stacking context por transform/z-index en ancestros
  document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.modal').forEach(function (m) {
      if (m.parentElement !== document.body) document.body.appendChild(m);
    });
  });

  // 2) Gestión de apilado y limpieza de backdrops "huérfanos"
  function tidyBackdrops() {
    const backs = Array.from(document.querySelectorAll('.modal-backdrop'));
    // Si hay más de uno, deja el último
    backs.slice(0, -1).forEach(b => b.remove());
    // Si no hay modales abiertos, limpia todo
    if (!document.querySelector('.modal.show')) {
      backs.forEach(b => b.remove());
      document.body.classList.remove('modal-open');
      document.body.style.removeProperty('padding-right');
    }
  }

  document.addEventListener('shown.bs.modal', function (ev) {
    // Reapilar (útil si tienes dos modales a la vez)
    const openCount = document.querySelectorAll('.modal.show').length;
    ev.target.style.zIndex = 1055 + openCount * 10;
    document.querySelectorAll('.modal-backdrop').forEach((b, i) => {
      b.style.zIndex = 1050 + i * 10;
    });
    tidyBackdrops();
  });

  document.addEventListener('hidden.bs.modal', function () {
    setTimeout(tidyBackdrops, 10);
  });
})();
</script>
<script>
document.addEventListener('DOMContentLoaded', () => {
  const qs = new URLSearchParams(location.search);
  const alerts = [];

  // Helper para encolar un alert
  const push = (icon, title, text) => alerts.push({ icon, title, text });

  // Mapeos que ya usas en tus redirects
  if (qs.get('estado') === 'success') {
    push('success', 'Acción completada', qs.get('mensaje') || 'Proceso realizado correctamente.');
  } else if (qs.get('estado') === 'error' || qs.get('fallo') === 'errors') {
    push('error', 'Operación fallida', qs.get('mensaje') || 'No se pudo completar la acción.');
  }

  if (qs.get('editado') === 'ok')     push('success', 'Editado', 'Se guardaron los cambios correctamente.');
  if (qs.get('destacado') === 'ok')   push('success', '¡Publicación destacada!', 'La publicación se marcó como destacada.');
  if (qs.get('eliminado') === 'ok')   push('success', 'Eliminado', 'Se eliminó correctamente.');
  if (qs.get('video_ok'))             push('success', 'Video', qs.get('video_ok'));
  if (qs.get('video_err'))            push('error', 'Video', qs.get('video_err'));
  if (qs.get('portada_ok') === '1')   push('success', 'Portada', 'Se guardó la portada correctamente.');
  if (qs.get('portada_err'))          push('error', 'Portada', qs.get('portada_err'));

  if (alerts.length && window.Swal) {
    const a = alerts[0]; // muestra uno (o recórrelos si quieres en cadena)
    Swal.fire({
      icon: a.icon,
      title: a.title,
      text: a.text,
      confirmButtonText: 'Entendido'
    }).then(() => {
      // Limpia la URL
      ['estado','mensaje','fallo','editado','destacado','eliminado',
       'video_ok','video_err','portada_ok','portada_err'].forEach(k => qs.delete(k));
      const clean = location.pathname + (qs.toString() ? '?' + qs.toString() : '');
      history.replaceState(null, '', clean);
    });
  }
});
</script>

  

<style id="modal-layer-fix">
  .modal { z-index: 1055; }
  .modal-backdrop { z-index: 1050; }
</style>



