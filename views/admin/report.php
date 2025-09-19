<?php
$registros_por_pagina = 10;
$pagina_actual = isset($_GET['pagina']) ? (int) $_GET['pagina'] : 1;
$indice_inicio = ($pagina_actual - 1) * $registros_por_pagina;
?>
<?php if (isset($_GET['mensaje'])): ?>
  <div class="notification-modal-wrapper">
    <?php if ($_GET['mensaje'] === 'eliminado'): ?>
      <div class="notification-modal success" data-aos="zoom-in" data-aos-duration="300">
        <div class="notification-icon">
          <svg viewBox="0 0 24 24">
            <path fill="currentColor"
              d="M12 2C6.5 2 2 6.5 2 12S6.5 22 12 22 22 17.5 22 12 17.5 2 12 2M10 17L5 12L6.41 10.59L10 14.17L17.59 6.58L19 8L10 17Z" />
          </svg>
        </div>
        <div class="notification-content">
          <h4>¡Operación Exitosa!</h4>
          <p>El archivo ha sido eliminado correctamente del sistema.</p>
        </div>
        <div class="notification-progress success"></div>
      </div>
    <?php elseif ($_GET['mensaje'] === 'error'): ?>
      <div class="notification-modal error" data-aos="zoom-in" data-aos-duration="300">
        <div class="notification-icon">
          <svg viewBox="0 0 24 24">
            <path fill="currentColor"
              d="M13 13H11V7H13M13 17H11V15H13M12 2C6.48 2 2 6.48 2 12S6.48 22 12 22 22 17.52 22 12 17.52 2 12 2Z" />
          </svg>
        </div>
        <div class="notification-content">
          <h4>¡Error en la Operación!</h4>
          <p>Ocurrió un problema al intentar eliminar el archivo.</p>
        </div>
        <div class="notification-progress error"></div>
      </div>
    <?php endif; ?>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Cierra automáticamente después de 3 segundos
      const notifications = document.querySelectorAll('.notification-modal');

      notifications.forEach(notification => {
        setTimeout(() => {
          notification.style.transform = 'translateX(150%)';
          notification.style.opacity = '0';
          notification.style.transition = 'all 0.4s ease';

          // Elimina el elemento después de la animación
          setTimeout(() => {
            notification.remove();
          }, 400);
        }, 3000);
      });

      // También permite cerrar haciendo click
      notifications.forEach(notification => {
        notification.addEventListener('click', function() {
          this.style.transform = 'translateX(150%)';
          this.style.opacity = '0';
          this.style.transition = 'all 0.4s ease';

          setTimeout(() => {
            this.remove();
          }, 400);
        });
      });
    });
  </script>
<?php endif; ?>


<div class="container text-center">
  <div class="card notebook-theme shadow-lg rounded-4 mt-5 " data-aos="zoom-in" data-aos-delay="100">
    <div class="card-header notebook-header bg-dark text-white rounded-top-4 px-4 py-3" data-aos="fade-right"
      data-aos-delay="200">
      <div class="d-flex justify-content-between align-items-center flex-wrap">
        <!-- TÍTULO -->
        <h5 class="mb-0 fw-semibold d-flex align-items-center">
          <i class="fas fa-book-open me-2"></i>Listado de Archivos
        </h5>

        <!-- BUSCADOR -->
        <form method="GET" class="d-flex align-items-center">
          <input type="hidden" name="vista" value="report">
          <input type="text" id="busqueda" class="form-control form-control-sm me-2" name="buscar"
            placeholder="Buscar..." value="<?= htmlspecialchars($_GET['buscar'] ?? '') ?>">

          <button type="submit" class="btn btn-light btn-sm">
            <i class="fas fa-search"></i>
          </button>
        </form>
      </div>
      <div class="notebook-page-corner"></div>
    </div>

    <div class="card-body p-0 notebook-paper bg-white" data-aos="fade-up" data-aos-delay="300">
      <div class="table-responsive">
        <table class="table table-hover table-borderless align-middle mb-0 notebook-table">
          <thead class="notebook-table-header bg-light text-secondary small text-uppercase border-bottom">
            <tr>
              <th class="ps-4">Título</th>
              <th>Descripción</th>
              <th>Tipo</th>
              <th>Fecha</th>
              <th>Usuario</th>
              <th>Descarga</th>
              <?php if ($_SESSION['rol'] == 1): ?>
                <th class="pe-4">Eliminar</th>
              <?php endif; ?>
            </tr>
          </thead>
          <tbody class="notebook-table-body text-dark" id="tabla-archivos">
            <?php include 'routes/tables.php'; ?>
          </tbody>

        </table>
        <div id="mensaje-no-resultados" class="text-muted py-3 text-center" style="display: none;">
          No se encontraron archivos con esos caracteres
        </div>
      </div>
      <div class="notebook-lines"></div>
    </div>

    <div
      class="card-footer notebook-footer bg-white rounded-bottom-4 py-3 px-4 d-flex justify-content-between align-items-center"
      data-aos="fade-up" data-aos-delay="600">
      <span class="text-muted small">
        Mostrando
        <strong><?= $indice_inicio + 1 ?></strong>‑<strong><?= min($indice_inicio + $registros_por_pagina, $total) ?></strong>
        de <strong><?= $total ?></strong>
      </span>

      <nav>
        <ul class="pagination pagination-sm mb-0 notebook-pagination">
          <?php for ($i = 1; $i <= ceil($total / $registros_por_pagina); $i++): ?>
            <li class="page-item <?= $i == $pagina_actual ? 'active' : '' ?>">
              <a class="page-link" href="?vista=report&pagina=<?= $i ?>">
                <?= $i ?>
              </a>
            </li>
          <?php endfor; ?>
        </ul>
      </nav>
    </div>
  </div>
</div>

<style>
  /* Estilos para las notificaciones (se mantienen igual) */
  .notification-modal-wrapper {
    position: fixed;
    top: 20px;
    right: 20px;
    z-index: 9999;
    max-width: 350px;
    width: 100%;
  }

  .notification-modal {
    position: relative;
    background: white;
    border-radius: 8px;
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
    overflow: hidden;
    display: flex;
    padding: 16px;
    margin-bottom: 10px;
    transform-origin: top right;
  }

  .notification-modal.success {
    border-left: 4px solid #22c55e;
  }

  .notification-modal.error {
    border-left: 4px solid #ef4444;
  }

  .notification-icon {
    flex-shrink: 0;
    width: 24px;
    height: 24px;
    margin-right: 16px;
    margin-top: 4px;
  }

  .notification-icon svg {
    width: 100%;
    height: 100%;
  }

  .notification-modal.success .notification-icon {
    color: #22c55e;
  }

  .notification-modal.error .notification-icon {
    color: #ef4444;
  }

  .notification-content h4 {
    margin: 0 0 6px 0;
    font-size: 16px;
    font-weight: 600;
    color: #1f2937;
  }

  .notification-content p {
    margin: 0;
    font-size: 14px;
    color: #6b7280;
    line-height: 1.4;
  }

  .notification-progress {
    position: absolute;
    bottom: 0;
    left: 0;
    height: 3px;
    width: 100%;
    animation: progressBar 3s linear forwards;
  }

  .notification-progress.success {
    background: linear-gradient(to right, #22c55e, #86efac);
  }

  .notification-progress.error {
    background: linear-gradient(to right, #ef4444, #fca5a5);
  }

  @keyframes progressBar {
    0% {
      width: 100%;
    }

    100% {
      width: 0%;
    }
  }

  /* Estilos para el notebook (actualizados con el nuevo gradiente) */
  .notebook-theme {
    margin-bottom: 2rem;
    font-size: 0.9rem;
    border: none;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
  }

  .notebook-header {
    background: linear-gradient(90deg, #2c3e50 0%, #1a1a2e 100%);
    padding: 0.75rem 1rem;
    color: white;
    position: relative;
    overflow: hidden;
  }

  .notebook-header::before {
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, rgba(255, 255, 255, 0) 70%);
    transform: rotate(30deg);
  }

  .notebook-page-corner {
    position: absolute;
    bottom: 0;
    right: 0;
    width: 0;
    height: 0;
    border-style: solid;
    border-width: 0 0 20px 20px;
    border-color: transparent transparent #f3f4f6 transparent;
  }

  .notebook-paper {
    min-height: 300px;
    background-color: white;
    position: relative;
  }

  .notebook-lines {
    position: absolute;
    top: 0;
    left: 40px;
    width: calc(100% - 40px);
    height: 100%;
    background-image: linear-gradient(to bottom, #f0f0f0 1px, transparent 1px);
    background-size: 100% 20px;
    pointer-events: none;
    z-index: 0;
  }

  .notebook-table {
    position: relative;
    z-index: 1;
  }

  .notebook-table th,
  .notebook-table td {
    padding: 0.75rem 1rem;
    border-bottom: 1px solid #e5e7eb;
  }

  .notebook-table-header th {
    font-size: 0.8rem;
    font-weight: 600;
    letter-spacing: 0.5px;
    background-color: #f9fafb;
  }

  .notebook-table-body tr:hover {
    background-color: #f9fafb;
  }

  .notebook-footer {
    background-color: white;
    border-top: 1px solid #e5e7eb;
    font-size: 0.85rem;
  }

  .notebook-pagination .page-item.active .page-link {
    background: linear-gradient(90deg, #2c3e50 0%, #1a1a2e 100%);
    border-color: #2c3e50;
    color: white;
  }

  .notebook-pagination .page-link {
    color: #2c3e50;
    border: 1px solid #d1d5db;
    margin: 0 2px;
  }

  .notebook-pagination .page-link:hover {
    background-color: #f3f4f6;
  }

  /* Animación de cambio de página */
  .page-turn {
    animation: pageTurn 0.5s ease;
  }

  @keyframes pageTurn {
    0% {
      opacity: 1;
    }

    50% {
      opacity: 0;
      transform: rotateY(90deg);
    }

    100% {
      opacity: 1;
    }
  }

  /* Estilos para el buscador */
  .form-control {
    border-radius: 6px;
    border: 1px solid #d1d5db;
    padding: 0.375rem 0.75rem;
  }

  .btn-light {
    background-color: #f3f4f6;
    border-color: #d1d5db;
    color: #2c3e50;
  }

  .btn-light:hover {
    background-color: #e5e7eb;
  }

  /* Mensaje de no resultados */
  #mensaje-no-resultados {
    font-size: 0.9rem;
    color: #6b7280;
    font-style: italic;
  }
</style>

<script>
  document.addEventListener("DOMContentLoaded", function() {
    const inputBusqueda = document.getElementById("busqueda");
    const cuerpoTabla = document.querySelector("#tabla-archivos");
    const filas = cuerpoTabla.querySelectorAll("tr");
    const mensaje = document.getElementById("mensaje-no-resultados");

    inputBusqueda.addEventListener("input", function() {
      const texto = this.value.toLowerCase().trim();
      let coincidencias = 0;

      filas.forEach(fila => {
        const textoFila = fila.textContent.toLowerCase();
        const visible = textoFila.includes(texto);
        fila.style.display = visible ? "" : "none";
        if (visible) coincidencias++;
      });

      mensaje.style.display = coincidencias === 0 ? "block" : "none";
    });
  });


  document.querySelectorAll('.notebook-pagination .page-link').forEach(link => {
    link.addEventListener('click', e => {
      if (!link.parentElement.classList.contains('active')) {
        e.preventDefault();
        const paper = document.querySelector('.notebook-paper');
        paper.classList.add('page-turn');
        setTimeout(() => {
          window.location.href = link.href;
        }, 300);
      }
    });
  });
  document.querySelector('.notebook-paper').addEventListener('animationend', () => {
    document.querySelector('.notebook-paper').classList.remove('page-turn');
  });
</script>