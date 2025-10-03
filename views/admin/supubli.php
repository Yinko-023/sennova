<?php
$areaSesion = $_SESSION['area'] ?? '';
$esAdmin = empty($areaSesion);
?>

<head>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<div class="container py-5">
  <!-- Toast genérico de la app -->
  <div class="position-fixed top-0 end-0 p-3" style="z-index:1080">
    <div id="appToast" class="toast align-items-center text-bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
      <div class="d-flex">
        <div class="toast-body" id="appToastMsg">...</div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
    </div>
  </div>


  <div class="card publication-card border-0 mb-4">
    <div class="card-header publication-header py-3">
      <div class="d-flex align-items-center justify-content-center">
        <h4 class="mb-0">
          <i class="fas fa-newspaper me-2"></i>Crear Nueva Publicación
        </h4>
      </div>
    </div>
    <div class="card-body p-4 p-md-5">
      <form action="/sennova/routes/publicar.php" method="POST" enctype="multipart/form-data" novalidate>
        <div class="mb-4">
          <label for="title" class="form-label">
            <i class="fas fa-heading text-dark"></i>Título
          </label>
          <input type="text" class="form-control" id="title" name="title" required
            placeholder="Ej. Feria de innovación tecnológica">
        </div>

        <div class="mb-4">
          <label for="content" class="form-label">
            <i class="fas fa-align-left text-dark"></i>Contenido
          </label>
          <textarea class="form-control" id="content" name="content" rows="5" required
            placeholder="Describe aquí los detalles de la publicación..."></textarea>
        </div>

        <div class="mb-4">
          <label for="image" class="form-label">
            <i class="fas fa-image text-dark"></i>Imagen destacada
          </label>
          <input class="form-control" type="file" id="image" name="image" accept="image/*" required>
          <small class="text-muted">Recomendado: 1200x630 px (relación 16:9)</small>
        </div>

        <div class="row g-3">
          <div class="col-md-6">
            <label for="type" class="form-label">
              <i class="fas fa-tag text-dark"></i>Tipo de publicación
            </label>
            <select class="form-select" id="type" name="type" required>
              <option value="" disabled selected>Selecciona un tipo</option>
              <option value="noticia">Noticia</option>
              <option value="evento">Evento</option>
              <option value="articulo">Servicio</option>
            </select>
          </div>

          <div class="col-md-6">
            <label for="lab_area" class="form-label">
              <i class="fas fa-flask text-dark"></i>Área del laboratorio
            </label>
            <select class="form-select" id="lab_area" name="lab_area" required>
              <option value="" disabled <?= $areaSesion === '' ? 'selected' : '' ?>>Selecciona el laboratorio</option>
              <?php if ($esAdmin): ?>
                <option value="general" <?= (isset($_POST['lab_area']) && $_POST['lab_area'] === 'general') ? 'selected' : '' ?>>General / Ambas áreas</option>
              <?php endif; ?>
              <option value="cafe" <?= $areaSesion === 'cafe' ? 'selected' : '' ?>>Café</option>
              <option value="electronica" <?= $areaSesion === 'electronica' ? 'selected' : '' ?>>Electrónica</option>
            </select>
          </div>
        </div>

        <?php if (isset($_SESSION['rol']) && $_SESSION['rol'] == 1): ?>
          <div class="row g-3 mt-3">
            <div class="col-md-6">
              <div class="form-check form-switch ps-0">
                <input class="form-check-input ms-0" type="checkbox" id="is_active" name="is_active" value="1" checked>
                <label class="form-check-label ms-3" for="is_active">
                  <i class="fas fa-check-circle text-dark me-2"></i>Publicación activa
                </label>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-check form-switch ps-0">
                <input class="form-check-input ms-0" type="checkbox" id="destacada" name="destacada" value="1">
                <label class="form-check-label ms-3" for="destacada">
                  <i class="fas fa-star text-dark me-2"></i>Destacar publicación
                </label>
              </div>
            </div>
          </div>
        <?php endif; ?>

        <div class="mb-4 mt-4">
          <label for="published_at" class="form-label">
            <i class="fas fa-calendar-alt text-dark"></i> Fecha de publicación
          </label>
          <input type="datetime-local" class="form-control" id="published_at" name="published_at">
        </div>

        <div class="d-grid mt-4">
          <button type="submit" class="btn btn-dark btn-submit">
            <i class="fas fa-save me-2"></i>Guardar Publicación
          </button>
        </div>
      </form>
    </div>
  </div>

  <?php
  $rol        = (int)($_SESSION['rol'] ?? 0);
  $areaSesion = $_SESSION['area'] ?? null;

  if ($rol === 2) {
    $areaSesion = 'electronica';
  }

  if ($rol !== 1 && $areaSesion) {
    require_once __DIR__ . '/../../conexion/conexion.php';
    $pdo = conectaDb();

    $sql = "
    SELECT id, title, content, image_path, thumbnail_path, lab_area,
           COALESCE(published_at, created_at) AS fecha_pub
    FROM publications
    WHERE is_active = 1
      AND lab_area = :area
    ORDER BY fecha_pub DESC
    LIMIT 12
  ";
    $st = $pdo->prepare($sql);
    $st->execute([':area' => $areaSesion]);
    $posts = $st->fetchAll(PDO::FETCH_ASSOC);

    $dest = ($areaSesion === 'electronica')
      ? 'inElectronica.php'
      : (($areaSesion === 'cafe') ? 'inCalidad.php' : '#');
  ?>

    <div class="card border-0 mt-4">
      <div class="card-header py-3" style="background:linear-gradient(90deg,#2c3e50 0%,#1a1a2e 100%);color:#fff;">
        <h5 class="mb-0">
          <i class="fas fa-bullhorn me-2"></i>
          Publicaciones de tu área (<?= htmlspecialchars(ucfirst($areaSesion)) ?>)
        </h5>
      </div>

      <div class="card-body">
        <?php if (empty($posts)): ?>
          <div class="text-center text-muted py-4">
            <i class="far fa-folder-open me-1"></i> No hay publicaciones en tu área todavía.
          </div>
        <?php else: ?>
          <div class="row g-4">
            <?php foreach ($posts as $p): ?>
              <div class="col-12 col-md-6 col-lg-4">
                <div class="card h-100 shadow-sm border-0">
                  <?php if (!empty($p['image_path'])): ?>
                    <img
                      src="/sennova/img/<?= htmlspecialchars($p['image_path']) ?>"
                      class="card-img-top"
                      alt="<?= htmlspecialchars($p['title']) ?>"
                      style="object-fit:cover;height:180px;">
                  <?php endif; ?>

                  <div class="card-body d-flex flex-column">
                    <h6 class="fw-semibold mb-2"><?= htmlspecialchars($p['title']) ?></h6>
                    <p class="text-muted small mb-3" style="min-height:3.5em;">
                      <?= htmlspecialchars(mb_strimwidth($p['content'] ?? '', 0, 140, '…', 'UTF-8')) ?>
                    </p>

                    <div class="mt-auto d-flex justify-content-between align-items-center">
                      <span class="text-muted small">
                        <i class="far fa-clock me-1"></i>
                        <?= htmlspecialchars(date('d/m/Y H:i', strtotime($p['fecha_pub']))) ?>
                      </span>

                      <div class="btn-group">
                        <!-- Editar -->
                        <button
                          type="button"
                          class="btn btn-sm btn-outline-secondary btn-edit-post"
                          data-bs-toggle="modal"
                          data-bs-target="#modalEditarPubli"
                          data-id="<?= (int)$p['id'] ?>"
                          data-title="<?= htmlspecialchars($p['title'], ENT_QUOTES) ?>"
                          data-content="<?= htmlspecialchars($p['content'], ENT_QUOTES) ?>"
                          data-image="<?= htmlspecialchars($p['image_path'] ?? '', ENT_QUOTES) ?>"
                          data-area="<?= htmlspecialchars($p['lab_area'], ENT_QUOTES) ?>">
                          <i class="fas fa-pen"></i>
                        </button>

                        <!-- Eliminar -->
                        <button
                          type="button"
                          class="btn btn-sm btn-outline-danger btn-delete-post"
                          data-bs-toggle="modal"
                          data-bs-target="#modalEliminarPubli"
                          data-id="<?= (int)$p['id'] ?>"
                          data-title="<?= htmlspecialchars($p['title'], ENT_QUOTES) ?>">
                          <i class="fas fa-trash-alt"></i>
                        </button>
                      </div>
                    </div>
                  </div>

                </div>
              </div>
            <?php endforeach; ?>
          </div>
        <?php endif; ?>
      </div>
    </div>
  <?php } // fin sección 
  ?>



</div>
<!-- Modal EDITAR publicación -->
<div class="modal fade" id="modalEditarPubli" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content border-0 shadow-lg">
      <div class="modal-header" style="background:#1f2937;color:#fff;">
        <h5 class="modal-title"><i class="fas fa-pen me-2"></i>Editar Publicación</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>

      <form id="formEditarPubli" action="/sennova/routes/EditPubli.php" method="POST" enctype="multipart/form-data">
        <div class="modal-body">
          <input type="hidden" name="id" id="edit-id">
          <input type="hidden" name="lab_area" id="edit-area">

          <div class="mb-3">
            <label class="form-label">Título</label>
            <input type="text" class="form-control" name="title" id="edit-title" required>
          </div>

          <div class="mb-3">
            <label class="form-label">Contenido</label>
            <textarea class="form-control" name="content" id="edit-content" rows="5" required></textarea>
          </div>

          <div class="mb-3">
            <label class="form-label">Imagen (opcional)</label>
            <input type="file" class="form-control" name="image" accept="image/*">
          </div>

          <div class="text-center">
            <div class="fw-semibold mb-2">Imagen actual</div>
            <img id="edit-image-preview" src="" alt="Imagen actual" class="rounded" style="width:160px;height:160px;object-fit:cover;box-shadow:0 2px 10px rgba(0,0,0,.15);">
            <div class="form-check form-switch mt-3 d-inline-flex align-items-center gap-2">
              <input class="form-check-input" type="checkbox" id="edit-delimg" name="delete_image" value="1">
              <label class="form-check-label" for="edit-delimg">Eliminar imagen actual</label>
            </div>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">✕ Cancelar</button>
          <button type="submit" class="btn btn-dark"><i class="fas fa-save me-1"></i> Guardar</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal ELIMINAR publicación -->
<div class="modal fade" id="modalEliminarPubli" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 shadow">
      <div class="modal-header" style="background:#7f1d1d;color:#fff;">
        <h6 class="modal-title"><i class="fas fa-trash-alt me-2"></i>Eliminar Publicación</h6>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <form id="formEliminarPubli" action="/sennova/routes/eliminarPublicacion.php" method="POST">
        <div class="modal-body">
          <input type="hidden" name="id" id="del-id">
          <p class="mb-0">¿Seguro que deseas eliminar <strong id="del-title"></strong>? Esta acción no se puede deshacer.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-danger"><i class="fas fa-trash me-1"></i> Eliminar</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', () => {
    // ----- EDITAR -----
    const editModal = document.getElementById('modalEditarPubli');
    editModal.addEventListener('show.bs.modal', ev => {
      const btn = ev.relatedTarget;
      const id = btn.getAttribute('data-id');
      const title = btn.getAttribute('data-title') || '';
      const cont = btn.getAttribute('data-content') || '';
      const img = btn.getAttribute('data-image') || '';
      const area = btn.getAttribute('data-area') || '';

      document.getElementById('edit-id').value = id;
      document.getElementById('edit-title').value = title;
      document.getElementById('edit-content').value = cont;
      document.getElementById('edit-area').value = area;

      const prev = document.getElementById('edit-image-preview');
      if (img) {
        prev.src = '/sennova/img/' + img;
        prev.style.opacity = 1;
      } else {
        prev.src = '';
        prev.style.opacity = 0.2;
      }
      document.getElementById('edit-delimg').checked = false;
    });

    // ----- ELIMINAR -----
    const delModal = document.getElementById('modalEliminarPubli');
    delModal.addEventListener('show.bs.modal', ev => {
      const btn = ev.relatedTarget;
      const id = btn.getAttribute('data-id');
      const title = btn.getAttribute('data-title') || '';
      document.getElementById('del-id').value = id;
      document.getElementById('del-title').textContent = title;
    });
  });
</script>

<script>
  window.addEventListener('DOMContentLoaded', () => {
    const ahora = new Date();
    const year = ahora.getFullYear();
    const month = String(ahora.getMonth() + 1).padStart(2, '0');
    const day = String(ahora.getDate()).padStart(2, '0');
    const hours = String(ahora.getHours()).padStart(2, '0');
    const minutes = String(ahora.getMinutes()).padStart(2, '0');

    const fechaLocal = `${year}-${month}-${day}T${hours}:${minutes}`;
    document.getElementById('published_at').value = fechaLocal;
  });

  document.addEventListener('DOMContentLoaded', function() {
    const themeToggle = document.getElementById('themeToggle');
    const body = document.body;

    const savedTheme = localStorage.getItem('theme');
    if (savedTheme === 'dark') {
      body.classList.add('dark');
      themeToggle.innerHTML = '<i class="fas fa-sun"></i>';
    }

    themeToggle.addEventListener('click', function() {
      body.classList.toggle('dark');

      if (body.classList.contains('dark')) {
        localStorage.setItem('theme', 'dark');
        themeToggle.innerHTML = '<i class="fas fa-sun"></i>';
      } else {
        localStorage.setItem('theme', 'light');
        themeToggle.innerHTML = '<i class="fas fa-moon"></i>';
      }
    });
  });

  document.addEventListener('DOMContentLoaded', function() {
    const mensaje = "<?php echo isset($_GET['mensaje']) ? $_GET['mensaje'] : '' ?>";

    if (mensaje) {
      const modal = new bootstrap.Modal(document.getElementById('notificationModal'));
      const modalContent = document.querySelector('#notificationModal .modal-content');
      const iconContainer = document.querySelector('#notificationModal .icon-container');
      const icon = document.querySelector('#notificationModal .icon-container i');
      const title = document.querySelector('#notificationModal .modal-title');
      const message = document.querySelector('#notificationModal .modal-body p');

      switch (mensaje) {
        case 'publicado':
          modalContent.classList.add('notification-success');
          icon.className = 'fas fa-check-circle';
          title.textContent = '¡Éxito!';
          message.textContent = 'La publicación se subió correctamente';
          break;
        case 'error':
          modalContent.classList.add('notification-danger');
          icon.className = 'fas fa-times-circle';
          title.textContent = 'Error';
          message.textContent = 'Hubo un error al subir la publicación';
          break;
        default:
          return;
      }

      modal.show();
      setTimeout(() => {
        modal.hide();
      }, 5000);
    }
  });
</script>
<script>
  document.addEventListener('DOMContentLoaded', () => {
    const params = new URLSearchParams(location.search);
    const mensaje = params.get('mensaje'); // p.ej. "subido" | "guardado"
    const error = params.get('error'); // texto de error opcional

    // Mapeo de mensajes estándar
    const map = {
      subido: {
        cls: 'text-bg-success',
        text: 'Archivo subido correctamente.'
      },
      guardado: {
        cls: 'text-bg-success',
        text: 'Publicación subida correctamente.'
      },
      error_bd: {
        cls: 'text-bg-danger',
        text: 'Error al guardar en la base de datos.'
      },
      error_mover: {
        cls: 'text-bg-warning',
        text: 'No se pudo mover el archivo al servidor.'
      },
      error_archivo: {
        cls: 'text-bg-warning',
        text: 'No se seleccionó un archivo válido.'
      },
      error_auth: {
        cls: 'text-bg-danger',
        text: 'Acceso denegado: usuario no autenticado.'
      }
    };

    // Prioriza "error" con texto libre si viene desde PHP
    let cfg = null;
    if (error) {
      cfg = {
        cls: 'text-bg-danger',
        text: decodeURIComponent(error)
      };
    } else if (mensaje && map[mensaje]) {
      cfg = map[mensaje];
    }

    if (!cfg) return;

    const toastEl = document.getElementById('appToast');
    const bodyEl = document.getElementById('appToastMsg');

    toastEl.className = `toast align-items-center ${cfg.cls} border-0`;
    bodyEl.textContent = cfg.text;

    new bootstrap.Toast(toastEl, {
      delay: 3500,
      autohide: true
    }).show();

    // Limpia el querystring para que no se repita al refrescar
    params.delete('mensaje');
    params.delete('error');
    const qs = params.toString();
    const newUrl = qs ? `${location.pathname}?${qs}${location.hash}` : `${location.pathname}${location.hash}`;
    history.replaceState({}, '', newUrl);
  });
</script>

<style>
  .notification-modal .modal-content {
    border: none;
    border-radius: 12px;
    overflow: hidden;
    background-color: #fafafa;
    color: #fff;
  }

  .publication-header {
    background: linear-gradient(90deg, #2c3e50 0%, #1a1a2e 100%);
    color: #ffffff;
    position: relative;
    overflow: hidden;
  }

  .publication-header::before {
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, rgba(255, 255, 255, 0) 70%);
    transform: rotate(30deg);
  }

  .btn-submit {
    background: linear-gradient(90deg, #2c3e50 0%, #1a1a2e 100%);
    border: none;
    padding: 12px 24px;
    font-weight: 500;
    letter-spacing: 0.5px;
    transition: all 0.3s;
    color: white;
  }

  .btn-submit:hover {
    background: linear-gradient(90deg, #1a1a2e 0%, #2c3e50 100%);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
  }

  :root {
    --dark-bg: #121212;
    --dark-surface: #1e1e1e;
    --dark-text: #e0e0e0;
    --dark-border: #333;
  }

  body.dark {
    background-color: var(--dark-bg);
    color: var(--dark-text);
  }

  /* Modo oscuro para el header */
  body.dark .publication-header {
    background: linear-gradient(90deg, #1a1a2e 0%, #2c3e50 100%) !important;
    color: #ffffff !important;
  }

  /* Modo oscuro para el botón */
  body.dark .btn-submit {
    background: linear-gradient(90deg, #1a1a2e 0%, #2c3e50 100%);
  }

  body.dark .btn-submit:hover {
    background: linear-gradient(90deg, #2c3e50 0%, #1a1a2e 100%);
  }

  /* Resto de estilos se mantienen igual */
  .publication-card {
    border-radius: 12px;
    overflow: hidden;
    transition: transform 0.3s, box-shadow 0.3s;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
  }

  .publication-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
  }

  .form-control,
  .form-select {
    border-radius: 8px;
    padding: 12px 15px;
    transition: all 0.3s;
    border: 1px solid #ced4da;
  }

  .form-control:focus,
  .form-select:focus {
    border-color: #2c3e50;
    box-shadow: 0 0 0 0.25rem rgba(44, 62, 80, 0.15);
  }

  .theme-toggle {
    position: fixed;
    bottom: 20px;
    right: 20px;
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background: linear-gradient(135deg, #2c3e50, #1a1a2e);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    z-index: 1000;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    transition: all 0.3s;
  }

  .theme-toggle:hover {
    transform: scale(1.1);
  }

  .form-label {
    font-weight: 600;
    margin-bottom: 0.5rem;
    display: flex;
    align-items: center;
  }

  .form-label i {
    margin-right: 8px;
    font-size: 1.1em;
    color: #2c3e50;
  }

  body.dark .form-label i {
    color: #ffffff;
  }

  /* Ajustes para el modo oscuro */
  body.dark .form-control,
  body.dark .form-select {
    background-color: var(--dark-surface);
    border-color: var(--dark-border);
    color: var(--dark-text);
  }

  body.dark .form-control:focus,
  body.dark .form-select:focus {
    background-color: var(--dark-surface);
    border-color: #4a5a6e;
    box-shadow: 0 0 0 0.25rem rgba(67, 97, 238, 0.15);
  }

  body.dark .card {
    background-color: var(--dark-surface);
    border-color: var(--dark-border);
  }

  body.dark .text-dark {
    color: var(--dark-text) !important;
  }

  /* Normaliza checkboxes/radios y switches */
  .form-check-input[type="checkbox"],
  .form-check-input[type="radio"] {
    width: 1.05rem !important;
    height: 1.05rem !important;
    min-width: 1.05rem !important;
    min-height: 1.05rem !important;
    padding: 0 !important;
  }

  /* Tamaño/forma del switch Bootstrap */
  .form-check.form-switch .form-check-input {
    width: 2.25rem !important;
    height: 1.15rem !important;
    min-height: 1.15rem !important;
    border-radius: 2rem !important;
    border: 1px solid #ced4da;
    background-color: #e9ecef;
    background-position: left center;
    transition: background-position .2s ease, background-color .2s ease, border-color .2s ease;
  }

  .form-check.form-switch .form-check-input:focus {
    box-shadow: 0 0 0 .25rem rgba(44, 62, 80, .15);
    border-color: #9db0c3;
  }

  .form-check.form-switch .form-check-input:checked {
    background-color: #2c3e50;
    border-color: #2c3e50;
    background-position: right center;
  }

  /* Alineación compacta del label */
  .form-check.form-switch {
    display: flex;
    align-items: center;
  }

  .form-check.form-switch .form-check-input {
    margin-right: .5rem;
  }

  .form-check-label {
    margin: 0;
    font-weight: 600;
  }
</style>
<script>
  document.addEventListener('DOMContentLoaded', () => {
    const params = new URLSearchParams(location.search);
    const toastEl = document.getElementById('appToast');
    const bodyEl = document.getElementById('appToastMsg');

    function showToast(cls, text) {
      if (!toastEl || !bodyEl) return;
      toastEl.className = `toast align-items-center ${cls} border-0`;
      bodyEl.textContent = text;
      new bootstrap.Toast(toastEl, {
        delay: 3500,
        autohide: true
      }).show();
    }

    // ==== EDITAR (usa ?editado=...) ====
    const editado = params.get('editado'); // ok | titulo_duplicado | error | incompleto | no_encontrada
    const area = params.get('area') || '';

    if (editado) {
      let cfg;
      switch (editado) {
        case 'ok':
          cfg = {
            cls: 'text-bg-success',
            text: 'Publicación actualizada correctamente.'
          };
          break;
        case 'titulo_duplicado':
          cfg = {
            cls: 'text-bg-danger',
            text: `Ya existe una publicación con ese título en ${area || 'esta área'}.`
          };
          break;
        case 'incompleto':
          cfg = {
            cls: 'text-bg-warning',
            text: 'Completa título y contenido.'
          };
          break;
        case 'no_encontrada':
          cfg = {
            cls: 'text-bg-danger',
            text: 'No se encontró la publicación.'
          };
          break;
        default:
          cfg = {
            cls: 'text-bg-danger',
            text: 'No se pudo actualizar la publicación.'
          };
      }
      showToast(cfg.cls, cfg.text);
      params.delete('editado');
      params.delete('area');
    }

    // ==== MENSAJES GENERALES (usa ?mensaje=...) ====
    const mensaje = params.get('mensaje'); // p.ej.: eliminado | error_eliminar | guardado | subido ...
    if (mensaje) {
      const map = {
        eliminado: {
          cls: 'text-bg-success',
          text: 'Publicación eliminada correctamente.'
        },
        error_eliminar: {
          cls: 'text-bg-danger',
          text: 'No se pudo eliminar la publicación.'
        },
        guardado: {
          cls: 'text-bg-success',
          text: 'Publicación subida correctamente.'
        },
        subido: {
          cls: 'text-bg-success',
          text: 'Archivo subido correctamente.'
        },
        error: {
          cls: 'text-bg-danger',
          text: 'Ocurrió un error en la operación.'
        }
      };
      const cfg = map[mensaje] || {
        cls: 'text-bg-info',
        text: mensaje.replace(/_/g, ' ')
      };
      showToast(cfg.cls, cfg.text);
      params.delete('mensaje');
    }

    // Limpia el querystring para que no se repita al refrescar
    const qs = params.toString();
    const newUrl = qs ? `${location.pathname}?${qs}${location.hash}` : `${location.pathname}${location.hash}`;
    history.replaceState({}, '', newUrl);
  });
</script>