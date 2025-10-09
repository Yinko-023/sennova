<?php
$model = new GestionModel();
$botones = $model->obtenerBotones();
$txtPath   = dirname(__DIR__, 2) . '/img/imagen_actual.txt';
$imgNombre = is_file($txtPath) ? trim((string)file_get_contents($txtPath)) : null;
$imagenURL = $imgNombre ? "/sennova/img/{$imgNombre}" : null; // si tu URL pública incluye /sennova

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
  <?php if ((isset($_SESSION['rol']) && $_SESSION['rol'] == 1)
    || (isset($_SESSION['rol']) && $_SESSION['rol'] == 2)
    || (isset($_SESSION['rol'], $_SESSION['area']) && $_SESSION['rol'] == 3 && $_SESSION['area'] === 'electronica')
  ): ?>
    <div class="admin-form" data-aos="fade-up">
      <h5>Crear Nuevo Proceso</h5>
      <form method="post" action="routes/createProces.php" class="row g-4 align-items-end">
        <div class="col-md-5">
          <label class="form-label">Nombre del Nuevo Proceso</label>
          <input type="text" name="nombre" class="form-control" required placeholder="Ej: Documentos">
        </div>
        <div class="col-md-4">
          <label class="form-label">Ruta del Nuevo Proceso</label>
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





  <!-- Contenedor principal para imagen y botones lado a lado -->
  <div class="row align-items-start">
    <!-- Columna para los botones de procesos -->
    <div class="col-lg-8 col-md-7 mb-4">
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
              <?php if ((isset($_SESSION['rol']) && $_SESSION['rol'] == 1)
                || (isset($_SESSION['rol']) && $_SESSION['rol'] == 2)
                || (isset($_SESSION['rol'], $_SESSION['area']) && $_SESSION['rol'] == 3 && $_SESSION['area'] === 'electronica')
              ): ?>
                <form method="post"
                  action="routes/createProces.php"
                  class="js-confirm-delete"
                  data-name="<?= htmlspecialchars($btn['nombre'] ?? 'el proceso') ?>">
                  <input type="hidden" name="id" value="<?= (int)$btn['id_ges'] ?>">
                  <input type="hidden" name="archivo" value="<?= htmlspecialchars($btn['ruta_but']) ?>">
                  <!-- 👇 OJO: ahora es type="button" -->
                  <button type="button" name="eliminar" class="process-delete-btn">
                    <i class="fas fa-trash me-1"></i> Eliminar proceso
                  </button>
                </form>
              <?php endif; ?>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>

    <!-- Columna para la imagen -->
    <div class="col-lg-4 col-md-5 mb-4">
      <?php if ($imagenURL): ?>
        <div class="text-center">
          <img id="main-process-image" src="<?= $imagenURL . '?v=' . time() ?>"
            class="img-fluid rounded shadow-sm"
            style="cursor: zoom-in; max-width: 100%; width: 100%; height: auto;"
            alt="Imagen del proceso"
            data-bs-toggle="modal" data-bs-target="#custom-imagen-modal">
        </div>

        <!-- Modal zoom -->
        <div class="modal fade" id="custom-imagen-modal" tabindex="-1"
          aria-labelledby="custom-imagen-modal-label" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content" id="modal-actividad">
              <div class="modal-header border-0 text-white" id="modal-actividad-header">
                <h5 class="modal-title" id="custom-imagen-modal-label">Vista Ampliada</h5>
                <button type="button" id="custom-close-button" class="btn-close btn-close-white"
                  data-bs-dismiss="modal" aria-label="Cerrar"></button>
              </div>
              <div class="modal-body text-center p-4">
                <img src="<?= $imagenURL . '?v=' . time() ?>" class="img-fluid rounded"
                  style="max-height: 70vh; width: auto;" alt="Imagen ampliada del proceso">
              </div>
            </div>
          </div>
        </div>
      <?php else: ?>
        <div id="no-image-container" class="text-center text-muted mt-4">
          <i id="no-image-icon" class="fas fa-image fa-3x mb-2"></i>
          <p>No hay imagen cargada actualmente</p>
        </div>
      <?php endif; ?>
      <?php if ((isset($_SESSION['rol']) && $_SESSION['rol'] == 1)
        || (isset($_SESSION['rol']) && $_SESSION['rol'] == 2)
        || (isset($_SESSION['rol'], $_SESSION['area']) && $_SESSION['rol'] == 3 && $_SESSION['area'] === 'electronica')
      ): ?>

        <div class="text-center mb-4">
          <!-- SUBIR -->
          <form id="form-subir-imagen"
            action="/sennova/routes/SaveImg.php"
            method="POST"
            enctype="multipart/form-data"
            class="d-inline">
            <input type="hidden" name="accion" value="subir">
            <input type="file" name="imagen" id="input-file-imagen"
              accept=".jpg,.jpeg,.png,.webp" style="display:none">
            <button type="button" class="btn btn-primary me-2" id="btn-subir-imagen">
              <i class="fas fa-upload me-1"></i> Subir Imagen
            </button>
          </form>

          <!-- ELIMINAR -->
          <?php if (!empty($imagenURL)): ?>
            <form id="form-eliminar-imagen" action="/sennova/routes/SaveImg.php" method="POST" class="d-inline"
              onsubmit="return confirm('¿Eliminar la imagen actual?');">
              <input type="hidden" name="accion" value="eliminar">
              <button type="submit" class="btn btn-outline-danger">
                <i class="fas fa-trash me-1"></i> Eliminar Imagen
              </button>
            </form>
          <?php endif; ?>
        </div>

      <?php endif; ?>
    </div>
  </div>
</div>



<!-- JS: disparar input y auto-enviar -->
<script>
  document.getElementById('btn-subir-imagen')?.addEventListener('click', function() {
    document.getElementById('input-file-imagen').click();
  });
  document.getElementById('input-file-imagen')?.addEventListener('change', function() {
    if (this.files && this.files.length > 0) {
      document.getElementById('form-subir-imagen').submit();
    }
  });
</script>

<script>
  document.addEventListener('DOMContentLoaded', () => {
    const params = new URLSearchParams(window.location.search);
    const ok = params.get('res'); // mensajes de éxito
    const err = params.get('err'); // mensajes de error

    if (!ok && !err) return;

    // Config base
    const base = {
      confirmButtonText: 'Entendido',
      allowEscapeKey: true,
      allowOutsideClick: true,
      width: 480,
      showClass: {
        popup: 'swal2-show'
      },
      hideClass: {
        popup: 'swal2-hide'
      }
    };

    if (ok) {
      Swal.fire({
        ...base,
        icon: 'success',
        title: '¡Éxito!',
        html: ok,
        background: '#ffffff',
      });
    } else if (err) {
      Swal.fire({
        ...base,
        icon: 'warning',
        title: 'Atención',
        html: err,
        background: '#ffffff',
      });
    }

    // Limpia la URL para que el popup no reaparezca en refresh
    const url = new URL(window.location.href);
    url.searchParams.delete('res');
    url.searchParams.delete('err');
    window.history.replaceState({}, '', url);
  });
</script>

<script>
  document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('form.js-confirm-delete').forEach((form) => {
      const btn = form.querySelector('button[name="eliminar"]');
      if (!btn) return;

      btn.addEventListener('click', () => {
        const proceso = form.dataset.name || 'el proceso';

        // 1) Confirmación inicial
        Swal.fire({
          title: '¿Eliminar proceso?',
          html: `Se eliminará <b>${proceso}</b>.<br><small>Puede contener archivos dentro. Esta acción NO se puede deshacer.</small>`,
          icon: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Sí, eliminar',
          cancelButtonText: 'Cancelar',
          confirmButtonColor: '#d33'
        }).then((res) => {
          if (!res.isConfirmed) return;

          // 2) Ventana de deshacer (10s)
          let secs = 10;
          let intervalId = null;
          let submitTimeoutId = null;

          const startCountdown = () => {
            const counterEl = Swal.getHtmlContainer().querySelector('#undo-countdown');
            intervalId = setInterval(() => {
              secs -= 1;
              if (counterEl) counterEl.textContent = secs;
              if (secs <= 0) {
                clearInterval(intervalId);
              }
            }, 1000);
          };

          const clearTimers = () => {
            if (intervalId) clearInterval(intervalId);
            if (submitTimeoutId) clearTimeout(submitTimeoutId);
          };

          Swal.fire({
            title: 'Eliminación programada',
            html: `
            <p>Tienes <b id="undo-countdown">10</b> segundos para <b>anular</b> tu decisión.</p>
            <small>Si no haces nada, se eliminará automáticamente.</small>
          `,
            icon: 'info',
            showCancelButton: true,
            confirmButtonText: 'Eliminar ahora',
            cancelButtonText: 'Anular',
            allowOutsideClick: false,
            allowEscapeKey: false,
            timerProgressBar: true,
            didOpen: () => {
              startCountdown();
              // envía automáticamente cuando acabe el tiempo (10s)
              submitTimeoutId = setTimeout(() => {
                // bloquear doble clic
                btn.disabled = true;
                // asegura el parámetro "eliminar" en el POST
                if (!form.querySelector('input[name="eliminar"]')) {
                  const h = document.createElement('input');
                  h.type = 'hidden';
                  h.name = 'eliminar';
                  h.value = '1';
                  form.appendChild(h);
                }
                form.submit();
              }, 10000);
            }
          }).then((r2) => {
            // Se cerró por botón Confirmar (Eliminar ahora) o Cancelar (Anular)
            clearTimers();

            if (r2.isConfirmed) {
              // Eliminar YA
              btn.disabled = true;
              if (!form.querySelector('input[name="eliminar"]')) {
                const h = document.createElement('input');
                h.type = 'hidden';
                h.name = 'eliminar';
                h.value = '1';
                form.appendChild(h);
              }
              form.submit();
            } else {
              // Anulado por el usuario
              Swal.fire({
                icon: 'info',
                title: 'Eliminación cancelada',
                timer: 1500,
                showConfirmButton: false
              });
            }
          });
        });
      });
    });
  });
</script>

<style>
  /* CSS por IDs (gradient y bordes del modal) */
  #modal-actividad {
    border-radius: 14px;
    overflow: hidden;
  }

  #modal-actividad-header {
    background: linear-gradient(90deg, #2c3e50 0%, #1a1a2e 100%);
    border-bottom: none;
    padding-top: 14px;
    padding-bottom: 14px;
  }

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

  /* <!-- Imagen final --> */

  #image-section-container {
    background: linear-gradient(90deg, #2c3e50 0%, #1a1a2e 100%);
    border-radius: 15px;
    padding: 30px;
    margin: 20px 0;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
    color: #fff;
  }

  /* Estilo para el modal personalizado */
  #custom-imagen-modal .modal-content {
    background: linear-gradient(135deg, #2c3e50 0%, #1a1a2e 100%);
    border: none;
    border-radius: 15px;
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.5);
  }

  #custom-imagen-modal .modal-header {
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
  }

  #custom-imagen-modal .modal-title {
    font-weight: 600;
    letter-spacing: 1px;
  }

  /* Estilo para la imagen principal */
  #main-process-image {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    border: 3px solid rgba(255, 255, 255, 0.1);
  }

  #main-process-image:hover {
    transform: scale(1.02);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.4);
  }

  /* Estilo para el área sin imagen */
  #no-image-container {
    padding: 40px 20px;
    background: rgba(255, 255, 255, 0.05);
    border-radius: 10px;
    border: 2px dashed rgba(255, 255, 255, 0.1);
  }

  #no-image-icon {
    opacity: 0.7;
    margin-bottom: 15px;
  }

  /* Estilo para el botón de cerrar personalizado */
  #custom-close-button {
    background: rgba(255, 255, 255, 0.1);
    border: none;
    border-radius: 50%;
    width: 35px;
    height: 35px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: background 0.3s ease;
  }

  #custom-close-button:hover {
    background: rgba(255, 255, 255, 0.2);
  }

  /* Estilo para el título de la sección */
  #section-title {
    font-size: 1.8rem;
    font-weight: 600;
    margin-bottom: 25px;
    text-align: center;
    letter-spacing: 1px;
    background: linear-gradient(90deg, #3498db, #9b59b6);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
  }

  /* Responsividad */
  @media (max-width: 768px) {
    #image-section-container {
      padding: 20px 15px;
      margin: 10px 0;
    }

    #section-title {
      font-size: 1.5rem;
    }
  }
</style>