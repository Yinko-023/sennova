<div class="theme-toggle" id="themeToggle">
  <i class="fas fa-moon"></i>
</div>

<div class="container py-5">
  <!-- Modal de notificación -->
  <div class="modal fade notification-modal" id="notificationModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="progress-bar">
          <div class="progress-bar-fill"></div>
        </div>
        <div class="modal-header">
          <h5 class="modal-title">Notificación</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="icon-container">
            <i class="fas fa-check-circle"></i>
          </div>
          <h4 class="modal-title mb-3">Título del mensaje</h4>
          <p class="mb-4">Contenido del mensaje aparecerá aquí</p>
          <button type="button" class="btn btn-primary px-4" data-bs-dismiss="modal">Entendido</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Tarjeta de subida -->
  <div class="card upload-card border-0 mb-4 no-dark">
    <div class="card-header py-3">
      <div class="d-flex align-items-center justify-content-center">
        <h4 class="mb-0">
          <i class="fas fa-cloud-upload-alt me-2"></i>Subir nuevo archivo
        </h4>
      </div>
    </div>
    <div class="card-body p-4 p-md-5">
      <form action="/sennova/routes/SaveArchive.php" method="POST" enctype="multipart/form-data" novalidate>
        <div class="mb-4">
          <label for="title_ar" class="form-label fw-semibold">
            <i class="fas fa-heading me-2"></i>Título del archivo
          </label>
          <div class="input-group">
            <span class="input-group-text"><i class="fas fa-tag"></i></span>
            <input type="text" class="form-control" id="title_ar" name="title_ar" required>
          </div>
        </div>

        <div class="mb-4">
          <label for="description_ar" class="form-label fw-semibold">
            <i class="fas fa-align-left me-2"></i>Descripción
          </label>
          <textarea class="form-control" id="description_ar" name="description_ar" rows="4" required></textarea>
          <small class="text-muted">Máximo 500 caracteres</small>
        </div>

        <div class="row g-3">
          <div class="col-md-6">
            <label for="type_ar" class="form-label fw-semibold">
              <i class="fas fa-file-alt me-2"></i>Tipo de archivo
            </label>
            <div class="input-group">
              <span class="input-group-text"><i class="fas fa-folder"></i></span>
              <select class="form-select" id="type_ar" name="type_ar" required>
                <option value="" disabled selected>Seleccione un tipo...</option>
                <option value="pdf">PDF</option>
                <option value="word">Word</option>
                <option value="excel">Excel</option>
                <option value="ppt">PowerPoint</option>
                <option value="otro">Otro</option>
              </select>
            </div>
          </div>

          <div class="col-md-6">
            <label for="date_publi_ar" class="form-label fw-semibold">
              <i class="fas fa-calendar-alt me-2"></i>Fecha de publicación
            </label>
            <div class="input-group">
              <span class="input-group-text"><i class="fas fa-clock"></i></span>
              <input type="datetime-local" class="form-control" id="date_publi_ar" name="date_publi_ar" required>
            </div>
          </div>
        </div>

        <div class="mb-4 mt-4">
          <label for="archivo" class="form-label fw-semibold">
            <i class="fas fa-paperclip me-2"></i>Seleccionar archivo
          </label>
          <input class="form-control" type="file" id="archivo" name="archivo"
            accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx" required>
          <small class="text-muted">Formatos aceptados: PDF, DOC, DOCX, XLS, XLSX, PPT, PPTX</small>
        </div>

        <div class="d-grid mt-4">
          <button type="submit" class="btn btn-upload">
            <i class="fas fa-upload me-2"></i>Subir archivo
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  // Configuración inicial de fecha
  document.addEventListener('DOMContentLoaded', function () {
    const dateInput = document.getElementById('date_publi_ar');
    const now = new Date();
    const formattedNow = now.toISOString().slice(0, 16);
    dateInput.value = formattedNow;

    // Manejo del selector de tipo de archivo
    const typeSelect = document.getElementById('type_ar');
    const fileInput = document.getElementById('archivo');
    const acceptMap = {
      pdf: '.pdf',
      word: '.doc,.docx',
      excel: '.xls,.xlsx',
      ppt: '.ppt,.pptx',
      otro: '*/*'
    };

    typeSelect.addEventListener('change', function () {
      fileInput.setAttribute('accept', acceptMap[this.value] || '');
    });

    // Toggle de tema oscuro
    const themeToggle = document.getElementById('themeToggle');
    const body = document.body;

    const savedTheme = localStorage.getItem('theme');
    if (savedTheme === 'dark') {
      body.classList.add('dark');
      themeToggle.innerHTML = '<i class="fas fa-sun"></i>';
    }

    themeToggle.addEventListener('click', function () {
      body.classList.toggle('dark');
      if (body.classList.contains('dark')) {
        localStorage.setItem('theme', 'dark');
        themeToggle.innerHTML = '<i class="fas fa-sun"></i>';
      } else {
        localStorage.setItem('theme', 'light');
        themeToggle.innerHTML = '<i class="fas fa-moon"></i>';
      }
    });

    // Validación de tamaño de archivo
    const form = document.querySelector('form');
    form.addEventListener('submit', function (e) {
      const fileInput = document.getElementById('archivo');
      const maxSize = 10 * 1024 * 1024; // 10MB

      if (fileInput.files[0] && fileInput.files[0].size > maxSize) {
        e.preventDefault();
        alert('El archivo no puede exceder los 10MB de tamaño');
      }
    });

    // Manejo de notificaciones
    const mensaje = "<?php echo isset($_GET['mensaje']) ? $_GET['mensaje'] : '' ?>";
    if (mensaje) {
      const modal = new bootstrap.Modal(document.getElementById('notificationModal'));
      const icon = document.querySelector('#notificationModal .icon-container i');
      const title = document.querySelector('#notificationModal .modal-title');
      const message = document.querySelector('#notificationModal .modal-body p');

      switch (mensaje) {
        case 'subido':
          icon.className = 'fas fa-check-circle';
          title.textContent = '¡Éxito!';
          message.textContent = 'Archivo subido correctamente';
          break;
        case 'error_bd':
          icon.className = 'fas fa-database';
          title.textContent = 'Error de Base de Datos';
          message.textContent = 'Ocurrió un error al guardar los datos';
          break;
        case 'error_mover':
          icon.className = 'fas fa-file-export';
          title.textContent = 'Error del Sistema';
          message.textContent = 'No se pudo mover el archivo al servidor';
          break;
        case 'error_archivo':
          icon.className = 'fas fa-file-exclamation';
          title.textContent = 'Archivo Inválido';
          message.textContent = 'No se seleccionó un archivo válido';
          break;
        case 'error_auth':
          icon.className = 'fas fa-user-lock';
          title.textContent = 'Acceso Denegado';
          message.textContent = 'Usuario no autenticado';
          break;
      }

      modal.show();
      setTimeout(() => modal.hide(), 5000);
    }
  });
</script>
<style>
  :root {
    --gradient-primary: linear-gradient(90deg, #2c3e50 0%, #1a1a2e 100%);
    --accent-color: #4cc9f0;
    --success-color: #4ad66d;
    --warning-color: #f8961e;
    --danger-color: #f72585;
    --light-gray: #f8f9fa;
    --medium-gray: #e9ecef;
    --dark-gray: #495057;
  }

  /* Modo oscuro */
  body.dark {
    background-color: #121212;
    color: #e0e0e0;
  }

  /* Modal de notificación */
  .notification-modal .modal-content {
    border: none;
    border-radius: 12px;
    overflow: hidden;
    background-color: #fafafa;
  }

  .notification-modal .modal-header {
    background: var(--gradient-primary);
    border-bottom: none;
    padding: 1.5rem;
    color: white;
  }

  .notification-modal .modal-body {
    padding: 2rem;
    text-align: center;
  }

  .notification-modal .icon-container {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1.5rem;
    font-size: 2.5rem;
    background: var(--gradient-primary);
    color: white;
  }

  .notification-modal .btn-close {
    filter: invert(1);
  }

  .progress-bar {
    height: 4px;
    background-color: rgba(0, 0, 0, 0.1);
    width: 100%;
    overflow: hidden;
  }

  .progress-bar-fill {
    height: 100%;
    animation: progressBar 3s linear forwards;
    background: var(--gradient-primary);
  }

  @keyframes progressBar {
    0% { width: 100%; }
    100% { width: 0%; }
  }

  /* Tarjeta de subida */
  .upload-card {
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
  }

  .upload-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
  }

  .upload-card .card-header {
    background: var(--gradient-primary);
    color: white;
    padding: 1.25rem 1.5rem;
    border-bottom: none;
  }

  .upload-card .card-header h4 {
    margin: 0;
    font-weight: 600;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .upload-card .card-header i {
    margin-right: 0.75rem;
    font-size: 1.5rem;
  }

  /* Formulario */
  .form-control, .form-select {
    border-radius: 8px;
    padding: 0.75rem 1rem;
    border: 1px solid #e0e0e0;
    transition: all 0.3s;
  }

  .form-control:focus, .form-select:focus {
    border-color: var(--accent-color);
    box-shadow: 0 0 0 0.25rem rgba(76, 201, 240, 0.25);
  }

  .input-group-text {
    background-color: #f5f5f5;
    border-color: #e0e0e0;
  }

  .btn-upload {
    background: var(--gradient-primary);
    border: none;
    padding: 0.75rem 1.5rem;
    font-weight: 500;
    letter-spacing: 0.5px;
    transition: all 0.3s;
  }

  .btn-upload:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(28, 62, 94, 0.3);
  }

  /* Toggle de tema */
  .theme-toggle {
    position: fixed;
    bottom: 20px;
    right: 20px;
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background: var(--gradient-primary);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    z-index: 1000;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    transition: all 0.3s;
  }

  .theme-toggle:hover {
    transform: scale(1.1);
  }

  /* Estilos para modo oscuro */
  body.dark .upload-card {
    background-color: #1e1e1e;
    border-color: #333;
  }

  body.dark .form-control,
  body.dark .form-select,
  body.dark .input-group-text {
    background-color: #2d2d2d;
    border-color: #444;
    color: #e0e0e0;
  }

  body.dark .form-control:focus,
  body.dark .form-select:focus {
    background-color: #2d2d2d;
    border-color: var(--accent-color);
    box-shadow: 0 0 0 0.25rem rgba(76, 201, 240, 0.25);
    color: #e0e0e0;
  }

  body.dark .text-muted {
    color: #a0a0a0 !important;
  }

  /* Excepción para el formulario en modo claro */
  .no-dark {
    background-color: #fff !important;
    color: #212529 !important;
    border-color: #dee2e6 !important;
  }

  .no-dark .form-control,
  .no-dark .form-select,
  .no-dark .input-group-text {
    background-color: #fff !important;
    color: #212529 !important;
    border-color: #ced4da !important;
  }

  .no-dark .form-control:focus,
  .no-dark .form-select:focus {
    background-color: #fff !important;
    color: #212529 !important;
    border-color: #86b7fe !important;
    box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
  }
</style>

