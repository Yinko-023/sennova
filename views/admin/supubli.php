<?php
$areaSesion = $_SESSION['area'] ?? '';
$esAdmin = empty($areaSesion); // Si no hay área, es admin
?>

<head>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<!-- Modal de notificación -->
<div class="modal fade notification-modal" id="notificationModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="progress-bar">
        <div class="progress-bar-fill"></div>
      </div>
      <div class="modal-header">
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="icon-container">
          <i class="fas fa-check-circle"></i>
        </div>
        <h4 class="modal-title mb-3 text-dark">Título del mensaje</h4>
        <p class="mb-4 text-dark">Contenido del mensaje aparecerá aquí</p>
        <button type="button" class="btn btn-dark px-4" data-bs-dismiss="modal">Entendido</button>
      </div>
    </div>
  </div>
</div>

<body class="bg-light">
  <!-- Botón de cambiar tema -->
  <div class="theme-toggle" id="themeToggle">
    <i class="fas fa-moon"></i>
  </div>

  <div class="container py-5">
    <?php if (!empty($mensaje)): ?>
      <div class="alert alert-info alert-dismissible fade show mb-4" role="alert">
        <div class="d-flex align-items-center">
          <i class="fas fa-info-circle me-2"></i>
          <div><?= $mensaje ?></div>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    <?php endif; ?>

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
  </div>
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

  <style>
    /* Estilos del modal de notificación (se mantienen igual) */
    .notification-modal .modal-content {
      border: none;
      border-radius: 12px;
      overflow: hidden;
      background-color: #fafafa;
      color: #fff;
    }

    /* ... (otros estilos del modal se mantienen igual) ... */

    /* Estilos principales con el nuevo gradiente */
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

    /* Estilos del tema oscuro (se mantienen las variables originales) */
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
.form-check-input[type="radio"]{
  width: 1.05rem !important;
  height: 1.05rem !important;
  min-width: 1.05rem !important;
  min-height: 1.05rem !important;
  padding: 0 !important;
}

/* Tamaño/forma del switch Bootstrap */
.form-check.form-switch .form-check-input{
  width: 2.25rem !important;
  height: 1.15rem !important;
  min-height: 1.15rem !important;
  border-radius: 2rem !important;
  border: 1px solid #ced4da;
  background-color: #e9ecef;
  background-position: left center;
  transition: background-position .2s ease, background-color .2s ease, border-color .2s ease;
}
.form-check.form-switch .form-check-input:focus{
  box-shadow: 0 0 0 .25rem rgba(44,62,80,.15);
  border-color: #9db0c3;
}
.form-check.form-switch .form-check-input:checked{
  background-color: #2c3e50;
  border-color: #2c3e50;
  background-position: right center;
}

/* Alineación compacta del label */
.form-check.form-switch{
  display:flex; align-items:center;
}
.form-check.form-switch .form-check-input{ margin-right:.5rem; }
.form-check-label{ margin:0; font-weight:600; }

  </style>

</body>