<?php

$rol        = $_SESSION['rol']  ?? null;
$areaSesion = $_SESSION['area'] ?? null;
if (!isset($areaFiltro)) {
  if ($rol == 1) {
    $areaFiltro = null;
  } elseif ($rol == 2) {
    $areaFiltro = 'electronica';
  } else {
    $areaFiltro = $areaSesion ?: null;
  }
}

$areaNombre = $areaFiltro ? ucfirst($areaFiltro) : 'General';
$areaClase  = $areaFiltro === 'cafe'
  ? 'area-cafe'
  : ($areaFiltro === 'electronica' ? 'area-electronica' : 'area-general');
$atendidasNum   = $resumen['atendidas_num']   ?? $resumen['aceptadas']   ?? 0;
$pendientesNum  = $resumen['pendientes_num']  ?? $resumen['pendientes']  ?? 0;
$rechazadasNum  = $resumen['rechazadas_num']  ?? $resumen['rechazadas']  ?? 0;
$totalResumen   = $resumen['total'] ?? ($atendidasNum + $pendientesNum + $rechazadasNum);
$den            = max(1, (int)$totalResumen);
$atendidasPct   = $resumen['atendidas_pct']   ?? (int)round($atendidasNum  * 100 / $den);
$rechazadasPct  = $resumen['rechazadas_pct']  ?? (int)round($rechazadasNum * 100 / $den);
$growthPct      = $resumen['growth_pct'] ?? 0;
$displayTotal = $totalResumen;
if ($areaFiltro === 'cafe') {
  $displayTotal = (int)($resumen['cafe'] ?? 0);
}
if ($areaFiltro === 'electronica') {
  $displayTotal = (int)($resumen['electronica'] ?? 0);
}

$resumen['atendidas_num']   = $atendidasNum;
$resumen['pendientes_num']  = $pendientesNum;
$resumen['rechazadas_num']  = $rechazadasNum;
$resumen['atendidas_pct']   = $atendidasPct;
$resumen['rechazadas_pct']  = $rechazadasPct;
$resumen['growth_pct']      = $growthPct;
?>

<div class="container-fluid dashboard-container ">
  <!-- Encabezado -->
  <div id="dashboardHeader" class="dashboard-header">
    <div class="d-flex justify-content-between align-items-center">
      <div>
        <h2 id="headerTitle">
          <i class="fas fa-tachometer-alt"></i> Panel de Control
        </h2>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Inicio</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
          </ol>
        </nav>
      </div>
      <div>
        <span class="date-badge">
          <?php date_default_timezone_set('America/Bogota'); ?>
          <i class="fas fa-calendar-alt"></i> <?= date('d M Y') ?>
        </span>
      </div>
    </div>
  </div>

  <!-- Tarjetas de Métricas -->
  <div class="row mb-4">
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="metric-card primary h-100">
        <div class="card-body">
          <h6 class="metric-title">Publicaciones</h6>
          <h2 class="metric-value"><?= $totalPublicaciones ?? '0' ?></h2>
          <div class="metric-change positive">
            <i class="fas fa-arrow-up me-1"></i> 5.2% vs mes anterior
          </div>
          <i class="fas fa-newspaper metric-icon"></i>
        </div>
      </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
      <div class="metric-card info h-100">
        <div class="card-body">
          <h6 class="metric-title">Archivos</h6>
          <h2 class="metric-value"><?= $totalArchivos ?? '0' ?></h2>
          <div class="metric-change positive">
            <i class="fas fa-arrow-up me-1"></i> 12.7% vs mes anterior
          </div>
          <i class="fas fa-file-alt metric-icon"></i>
        </div>
      </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
      <div class="metric-card warning h-100">
        <div class="card-body">
          <h6 class="metric-title">Usuarios</h6>
          <h2 class="metric-value"><?= $totalUsuarios ?? '0' ?></h2>
          <div class="metric-change positive">
            <i class="fas fa-arrow-up me-1"></i> 3.1% vs mes anterior
          </div>
          <i class="fas fa-users metric-icon"></i>
        </div>
      </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
      <div class="metric-card success h-100">
        <div class="card-body">
          <h6 class="metric-title">Visitas</h6>
          <h2 class="metric-value"><?= $totalVisitas ?? '0' ?></h2>
          <div class="metric-change negative">
            <i class="fas fa-arrow-down me-1"></i> 2.4% vs mes anterior
          </div>
          <i class="fas fa-eye metric-icon"></i>
        </div>
      </div>
    </div>
  </div>

  <!-- Contenido Principal -->
  <div class="row">
    <!-- Tabla de Usuarios -->
    <div class="col-lg-8 mb-4">
      <div class="main-panel h-100">
        <div class="panel-header">
          <h5><i class="fas fa-users"></i> Usuarios Registrados</h5>
        </div>

        <?php if (isset($_GET['mensaje']) && $_GET['mensaje'] === 'actualizado'): ?>
          <div class="alert alert-success custom-alert alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i> ¡Usuario actualizado correctamente!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        <?php endif; ?>

        <?php if (isset($_GET['error']) && $_GET['error'] === 'correo'): ?>
          <div class="alert alert-danger custom-alert alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i> El correo electrónico ya está en uso. Por favor, usa uno diferente.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        <?php endif; ?>

        <?php if (isset($_GET['eliminado']) && $_GET['eliminado'] == 1): ?>
          <div class="alert alert-success custom-alert alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i> Usuario eliminado correctamente.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        <?php elseif (isset($_GET['error']) && $_GET['error'] == 1): ?>
          <div class="alert alert-danger custom-alert alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i> Hubo un error al eliminar el usuario.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        <?php endif; ?>

        <div class="p-4">
          <div class="d-flex justify-content-between align-items-center mb-4">
            <div class="search-box">
              <i class="fas fa-search search-icon"></i>
              <form method="GET">
                <input type="text" name="buscar" class="form-control" placeholder="Buscar usuario..." value="<?= isset($_GET['buscar']) ? htmlspecialchars($_GET['buscar']) : '' ?>">
              </form>
            </div>
          </div>

          <div class="table-responsive">
            <table class="data-table">
              <thead>
                <tr>
                  <th>Usuario</th>
                  <th>Correo</th>
                  <th>Rol</th>
                  <th>Estado</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                <?php if (!empty($usuarios)):
                  foreach ($usuarios as $usuario): ?>
                    <tr>
                      <td>
                        <div class="d-flex align-items-center">
                          <div class="user-avatar2">
                            <?= substr(htmlspecialchars($usuario['full_name']), 0, 1) ?>
                          </div>
                          <div class="user-info">
                            <h6><?= htmlspecialchars($usuario['full_name']) ?></h6>
                            <small>@<?= htmlspecialchars($usuario['username']) ?></small>
                          </div>
                        </div>
                      </td>
                      <td><?= htmlspecialchars($usuario['email_acc']) ?></td>
                      <td>
                        <span class="status-badge info"><?= htmlspecialchars($usuario['name_rol']) ?></span>
                      </td>
                      <td>
                        <span class="status-badge active">Activo</span>
                      </td>
                      <td>
                        <div class="d-flex">
                          <?php if ($_SESSION['rol'] == 1): ?>
                            <a href="inAdmin.php?vista=editarUsuario&id=<?= $usuario['id'] ?>" class="action-btn edit" data-bs-toggle="tooltip" title="Editar">
                              <i class="fas fa-edit"></i>
                            </a>
                            <a href="routes/DeleteUser.php?id=<?= $usuario['id'] ?>" class="action-btn delete" data-bs-toggle="tooltip" title="Eliminar" onclick="return confirm('¿Estás seguro de eliminar este usuario?');">
                              <i class="fas fa-trash-alt"></i>
                            </a>
                          <?php else: ?>
                            <span class="text-muted">Sin permisos</span>
                          <?php endif; ?>
                        </div>
                      </td>
                    </tr>
                  <?php endforeach;
                else: ?>
                  <tr>
                    <td colspan="5" class="text-center py-4">No se encontraron usuarios.</td>
                  </tr>
                <?php endif; ?>
              </tbody>
            </table>
          </div>

          <div class="d-flex justify-content-between align-items-center mt-4 pt-3 border-top">
            <div class="text-muted">
              Mostrando <?= count($usuarios) ?> de <?= $totalUsuarios ?? 0 ?> registros
            </div>
            <nav aria-label="Page navigation">
              <ul class="pagination pagination-custom mb-0">
                <?php
                $paginaActual = $paginaActual ?? 1;
                $totalPaginas = $totalPaginas ?? 1;
                if ($paginaActual > 1):
                ?>
                  <li class="page-item">
                    <a class="page-link" href="?pagina=<?= $paginaActual - 1 ?>" aria-label="Previous">
                      <span aria-hidden="true">&laquo;</span>
                    </a>
                  </li>
                <?php endif;
                for ($i = 1; $i <= $totalPaginas; $i++): ?>
                  <li class="page-item <?= $paginaActual == $i ? 'active' : '' ?>">
                    <a class="page-link" href="?pagina=<?= $i ?>"><?= $i ?></a>
                  </li>
                <?php endfor;
                if ($paginaActual < $totalPaginas): ?>
                  <li class="page-item">
                    <a class="page-link" href="?pagina=<?= $paginaActual + 1 ?>" aria-label="Next">
                      <span aria-hidden="true">&raquo;</span>
                    </a>
                  </li>
                <?php endif; ?>
              </ul>
            </nav>
          </div>
        </div>
      </div>
    </div>

    <!-- Sidebar con Estadísticas -->
    <div class="col-lg-4 mb-4">

      <?php if (is_null($areaFiltro)): ?>
        <div class="sidebar-panel mb-4">
          <div class="panel-header">
            <h5><i class="fas fa-chart-pie"></i> Resumen Mensual</h5>
          </div>

          <div class="stats-item">
            <h6 class="stats-title">Solicitudes</h6>

            <div class="d-flex justify-content-between align-items-center mb-3">
              <h3 class="stats-value"><?= $resumen['total'] ?? 0 ?></h3>
              <span class="status-badge info">
                <?= (($resumen['growth_pct'] ?? 0) >= 0 ? '+' : '') . ($resumen['growth_pct'] ?? 0) ?>%
              </span>
            </div>

            <div class="row">
              <div class="col-6">
                <div class="mb-3">
                  <small class="text-muted">Café</small>
                  <h5 class="stats-value"><?= $resumen['cafe'] ?? 0 ?></h5>
                </div>
              </div>
              <div class="col-6">
                <div class="mb-3">
                  <small class="text-muted">Electrónica</small>
                  <h5 class="stats-value"><?= $resumen['electronica'] ?? 0 ?></h5>
                </div>
              </div>
            </div>

            <!-- Progreso Atendidas / Rechazadas -->
            <div class="progress progress-thin mb-2" role="progressbar" aria-label="Atendidas/rechazadas">
              <div class="progress-bar bg-success" style="width: <?= $resumen['atendidas_pct'] ?? 0 ?>%"></div>
              <div class="progress-bar bg-danger" style="width: <?= $resumen['rechazadas_pct'] ?? 0 ?>%"></div>
            </div>

            <div class="d-flex justify-content-between">
              <small class="text-muted">
                <i class="fas fa-circle text-success me-1"></i>
                Atendidas: <?= $resumen['atendidas_num'] ?? 0 ?>
              </small>
              <small class="text-muted">
                <i class="fas fa-circle text-danger me-1"></i>
                Rechazadas: <?= $resumen['rechazadas_num'] ?? 0 ?>
              </small>
            </div>
          </div>

          <div class="stats-item">
            <h6 class="stats-title">Usuario más activo</h6>
            <div class="d-flex align-items-center">
              <div class="user-avatar">
                <?= isset($usuarioTop['nombre']) ? substr($usuarioTop['nombre'], 0, 1) : 'N' ?>
              </div>
              <div>
                <h6 class="mb-0"><?= $usuarioTop['nombre'] ?? 'N/A' ?></h6>
                <small class="text-muted"><?= $usuarioTop['total'] ?? 0 ?> solicitudes</small>
              </div>
            </div>
          </div>
        </div>

      <?php else: ?>
        <div class="sidebar-panel mb-4 border-0 shadow-sm overflow-hidden <?= $areaClase ?>">
          <div class="panel-header d-flex align-items-center justify-content-between px-3 py-2">
            <h5 class="mb-0 d-flex align-items-center gap-2">
              <span class="badge rounded-pill badge-area"><?= $areaNombre ?></span>
              <span><i class="fas fa-chart-line"></i> Resumen del Mes</span>
            </h5>
            <span class="badge growth-badge">
              <?= (($resumen['growth_pct'] ?? 0) >= 0 ? '+' : '') . ($resumen['growth_pct'] ?? 0) ?>%
            </span>
          </div>

          <div class="p-3">
            <!-- Total del área -->
            <div class="d-flex align-items-baseline justify-content-between mb-3">
              <div>
                <small class="text-muted">Total <?= $areaNombre ?></small>
                <div class="display-6 fw-bold mb-0"><?= $displayTotal ?></div>
              </div>
            </div>

            <!-- Mini métricas -->
            <div class="row g-2 mb-3">
              <div class="col-4">
                <div class="card metric-card text-center p-2">
                  <small class="text-muted d-block">Atendidas</small>
                  <div class="fw-bold text-success"><?= $resumen['atendidas_num'] ?? 0 ?></div>
                </div>
              </div>
              <div class="col-4">
                <div class="card metric-card text-center p-2">
                  <small class="text-muted d-block">Pendientes</small>
                  <div class="fw-bold text-warning"><?= $resumen['pendientes_num'] ?? 0 ?></div>
                </div>
              </div>
              <div class="col-4">
                <div class="card metric-card text-center p-2">
                  <small class="text-muted d-block">Rechazadas</small>
                  <div class="fw-bold text-danger"><?= $resumen['rechazadas_num'] ?? 0 ?></div>
                </div>
              </div>
            </div>

            <!-- Progreso Atendidas / Rechazadas -->
            <div class="progress progress-thin mb-2" role="progressbar" aria-label="Atendidas/rechazadas">
              <div class="progress-bar bg-success" style="width: <?= $resumen['atendidas_pct'] ?? 0 ?>%"></div>
              <div class="progress-bar bg-danger" style="width: <?= $resumen['rechazadas_pct'] ?? 0 ?>%"></div>
            </div>
            <div class="d-flex justify-content-between">
              <small class="text-muted"><i class="fas fa-circle text-success me-1"></i> <?= $resumen['atendidas_pct'] ?? 0 ?>%</small>
              <small class="text-muted"><i class="fas fa-circle text-danger me-1"></i> <?= $resumen['rechazadas_pct'] ?? 0 ?>%</small>
            </div>
          </div>
        </div>
      <?php endif; ?>

      <!-- Actividad Reciente -->
      <?php
      if (!function_exists('time_ago_es')) {
        function time_ago_es(string $ts): string
        {
          $t = is_numeric($ts) ? (int)$ts : strtotime($ts);
          $diff = time() - $t;
          if ($diff < 60) return 'Hace ' . $diff . ' seg';
          $mins = floor($diff / 60);
          if ($mins < 60) return 'Hace ' . $mins . ' min';
          $hrs = floor($mins / 60);
          if ($hrs < 24) return 'Hace ' . $hrs . ' hora' . ($hrs > 1 ? 's' : '');
          $days = floor($hrs / 24);
          if ($days < 7) return 'Hace ' . $days . ' día' . ($days > 1 ? 's' : '');
          return date('Y-m-d H:i', $t);
        }
      }
      ?>

      <div class="sidebar-panel" id="panel-actividad">
        <div class="panel-header">
          <h5><i class="fas fa-list-ul"></i> Actividad Reciente</h5>
        </div>

        <?php
        $maxMostrar = 5;
        $totalActs  = is_array($actividades ?? null) ? count($actividades) : 0;
        $primeros   = $totalActs > 0 ? array_slice($actividades, 0, $maxMostrar) : [];
        $resto      = $totalActs > $maxMostrar ? array_slice($actividades, $maxMostrar) : [];
        ?>

        <div class="panel-body" id="actividad-scroll">
          <?php if (!empty($primeros)): ?>
            <?php foreach ($primeros as $item): ?>
              <div class="activity-item">
                <div class="d-flex justify-content-between">
                  <h6><?= htmlspecialchars($item['title']) ?></h6>
                  <span class="activity-time"><?= htmlspecialchars(time_ago_es($item['ts'])) ?></span>
                </div>
                <p><?= htmlspecialchars($item['text']) ?></p>
              </div>
            <?php endforeach; ?>

            <?php if (!empty($resto)): ?>
              <div id="actividad-resto" class="d-none">
                <?php foreach ($resto as $item): ?>
                  <div class="activity-item">
                    <div class="d-flex justify-content-between">
                      <h6><?= htmlspecialchars($item['title']) ?></h6>
                      <span class="activity-time"><?= htmlspecialchars(time_ago_es($item['ts'])) ?></span>
                    </div>
                    <p><?= htmlspecialchars($item['text']) ?></p>
                  </div>
                <?php endforeach; ?>
              </div>
            <?php endif; ?>

          <?php else: ?>
            <div class="p-3 text-center text-muted">
              <i class="far fa-bell-slash"></i> Sin actividad reciente
            </div>
          <?php endif; ?>
        </div>

        <?php if (!empty($resto)): ?>
          <div class="text-center p-3">
            <button class="btn btn-sm btn-outline-secondary"
              data-bs-toggle="modal"
              data-bs-target="#modalActividadReciente">
              Ver más
            </button>
          </div>
        <?php endif; ?>

      </div>
    </div>
  </div>
</div>
<!-- Modal: Actividad Reciente -->
<!-- Modal: Actividad Reciente -->
<div class="modal fade" id="modalActividadReciente" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content border-0 shadow-lg" id="modal-actividad">
      <div class="modal-header text-white" id="modal-actividad-header">
        <h5 class="modal-title d-flex align-items-center gap-2" id="modal-actividad-title">
          <i class="fas fa-history"></i>
          Todas las actividad reciente 
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar" id="modal-actividad-close"></button>
      </div>

      <div class="modal-body p-0" id="modal-actividad-body">
        <div id="modal-actividad-scroll" class="p-3">
          <?php if (!empty($actividades)): ?>
            <ul class="list-group list-group-flush" id="modal-actividad-lista">
              <?php foreach ($actividades as $item): ?>
                <li class="list-group-item px-3 py-3" id="modal-actividad-item">
                  <div class="d-flex justify-content-between align-items-start" id="modal-actividad-item-row">
                    <div class="me-3" id="modal-actividad-item-left">
                      <div class="fw-semibold" id="modal-actividad-item-title"><?= htmlspecialchars($item['title']) ?></div>
                      <div class="text-muted small" id="modal-actividad-item-text"><?= htmlspecialchars($item['text']) ?></div>
                    </div>
                    <span class="text-nowrap text-muted small" id="modal-actividad-item-time"><?= htmlspecialchars(time_ago_es($item['ts'])) ?></span>
                  </div>
                </li>
              <?php endforeach; ?>
            </ul>
          <?php else: ?>
            <div class="p-4 text-center text-muted" id="modal-actividad-empty">
              <i class="far fa-bell-slash"></i> Sin actividad reciente
            </div>
          <?php endif; ?>
        </div>
      </div>

      <div class="modal-footer" id="modal-actividad-footer">
        <button type="button" class="btn btn-outline-light" data-bs-dismiss="modal" id="btn-actividad-cerrar">Cerrar</button>
        <a href="inAdmin.php?vista=actividad" class="btn" id="btn-actividad-historial">Ver historial completo</a>
      </div>
    </div>
  </div>
</div>


<style>
/* Contenedor principal del modal */
#modal-actividad{
  border-radius: 14px;
  overflow: hidden;
}

/* Encabezado con gradient */
#modal-actividad-header{
  background: linear-gradient(90deg, #2c3e50 0%, #1a1a2e 100%);
  border-bottom: none;
  padding-top: 14px;
  padding-bottom: 14px;
}

/* Body scrollable */
#modal-actividad-scroll{
  max-height: 60vh;   /* ajusta si quieres más/menos alto */
  overflow-y: auto;
}

/* Footer con gradient y botones contrastados */
#modal-actividad-footer{
  background: linear-gradient(90deg, #2c3e50 0%, #1a1a2e 100%);
  border-top: none;
}

/* Botón primario del historial con gradient propio (si prefieres) */
#btn-actividad-historial{
  background: linear-gradient(90deg, #2c3e50 0%, #1a1a2e 100%);
  color: #fff;
  border: none;
}
#btn-actividad-historial:hover{
  filter: brightness(1.08);
  color: #fff;
}

/* Botón cerrar con borde claro para contraste */
#btn-actividad-cerrar{
  border-color: rgba(255,255,255,.55);
  color: #fff;
}
#btn-actividad-cerrar:hover{
  background: rgba(255,255,255,.12);
  color: #fff;
}

/* Item hover sutil dentro de la lista */
#modal-actividad-item:hover{
  background-color: #f8fafc;
  transition: background-color .15s ease;
}

/* (Opcional) Afinar tipografías de título/texto */
#modal-actividad-title{ font-weight: 700; }
#modal-actividad-item-title{ font-weight: 600; }

</style>



<script>
  document.addEventListener('DOMContentLoaded', function() {
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl);
    });
  });
</script>
<style>
  :root {
    --dark-blue: #1a1a2e;
    --medium-blue: #2c3e50;
    --accent-color: #4cc9f0;
    --light-accent: #4895ef;
    --success-color: #4ad66d;
    --warning-color: #f8961e;
    --danger-color: #f72585;
    --light-gray: #f8f9fa;
    --medium-gray: #e9ecef;
    --dark-gray: #495057;
    --text-light: #ffffff;
    --text-dark: #212529;
  }

  #dashboardHeader {
    background: #fff;
    padding: 1.5rem;
    border-radius: 10px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, .05);
    margin-bottom: 1.5rem;
    margin-top: 30px;
  }

  #headerTitle {
    color: var(--dark-blue);
    font-weight: 600;
    display: flex;
    align-items: center;
  }

  #headerTitle i {
    color: var(--accent-color);
    margin-right: .75rem;
    font-size: 1.5rem;
  }


  .breadcrumb {
    background: transparent;
    padding: 0.5rem 0;
  }

  .breadcrumb-item a {
    color: var(--medium-blue);
    text-decoration: none;
    transition: color 0.2s;
  }

  .breadcrumb-item a:hover {
    color: var(--accent-color);
  }

  .breadcrumb-item.active {
    color: var(--dark-gray);
  }

  .date-badge {
    background: var(--light-gray);
    color: var(--dark-blue);
    padding: 0.5rem 1rem;
    border-radius: 50px;
    font-weight: 500;
    display: flex;
    align-items: center;
  }

  .date-badge i {
    margin-right: 0.5rem;
    color: var(--accent-color);
  }

  /* Tarjetas de métricas */
  .metric-card {
    border: none;
    border-radius: 10px;
    overflow: hidden;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
    height: 100%;
  }

  .metric-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
  }

  .metric-card.primary {
    border-left: 4px solid var(--accent-color);
  }

  .metric-card.info {
    border-left: 4px solid var(--light-accent);
  }

  .metric-card.warning {
    border-left: 4px solid var(--warning-color);
  }

  .metric-card.success {
    border-left: 4px solid var(--success-color);
  }

  .metric-card .card-body {
    padding: 1.5rem;
    position: relative;
  }

  .metric-card .metric-icon {
    position: absolute;
    right: 1.5rem;
    top: 1.5rem;
    font-size: 2.5rem;
    opacity: 0.15;
    color: inherit;
  }

  .metric-card .metric-title {
    font-size: 0.85rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    color: var(--dark-gray);
    margin-bottom: 0.5rem;
    font-weight: 600;
  }

  .metric-card .metric-value {
    font-size: 1.75rem;
    font-weight: 700;
    color: var(--dark-blue);
    margin-bottom: 0.5rem;
  }

  .metric-card .metric-change {
    display: flex;
    align-items: center;
    font-size: 0.85rem;
  }

  .metric-card .metric-change.positive {
    color: var(--success-color);
  }

  .metric-card .metric-change.negative {
    color: var(--danger-color);
  }

  /* Panel principal */
  .main-panel {
    background: white;
    border-radius: 10px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    overflow: hidden;
    margin-bottom: 1.5rem;
  }

  .panel-header {
    background: linear-gradient(180deg, var(--medium-blue) 0%, var(--dark-blue) 100%);
    color: white;
    padding: 1.25rem 1.5rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
  }

  .panel-header h5 {
    margin: 0;
    font-weight: 600;
    display: flex;
    align-items: center;
  }

  .panel-header i {
    margin-right: 0.75rem;
    font-size: 1.25rem;
  }

  /* Alertas */
  .custom-alert {
    border-radius: 8px;
    margin: 1rem;
  }

  /* Tabla */
  .data-table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
  }

  .data-table thead th {
    background-color: var(--light-gray);
    color: var(--dark-blue);
    font-weight: 600;
    text-transform: uppercase;
    font-size: 0.75rem;
    letter-spacing: 0.5px;
    padding: 1rem;
    border-bottom: 2px solid var(--medium-gray);
  }

  .data-table tbody td {
    padding: 1rem;
    border-bottom: 1px solid var(--medium-gray);
    vertical-align: middle;
  }

  .data-table tbody tr:last-child td {
    border-bottom: none;
  }

  .data-table tbody tr:hover {
    background-color: rgba(76, 201, 240, 0.05);
  }

  .user-avatar2 {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--accent-color), var(--light-accent));
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
    margin-right: 0.75rem;
  }

  .user-info h6 {
    margin: 0;
    font-weight: 600;
    color: var(--dark-blue);
  }

  .user-info small {
    color: var(--dark-gray);
    font-size: 0.85rem;
  }

  .status-badge {
    padding: 0.35rem 0.75rem;
    border-radius: 50px;
    font-size: 0.75rem;
    font-weight: 500;
    letter-spacing: 0.5px;
  }

  .status-badge.active {
    background: rgba(74, 214, 109, 0.1);
    color: var(--success-color);
  }

  .status-badge.info {
    background: rgba(72, 149, 239, 0.1);
    color: var(--light-accent);
  }

  .action-btn {
    width: 32px;
    height: 32px;
    border-radius: 8px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    margin-right: 0.5rem;
    transition: all 0.2s;
  }

  .action-btn:hover {
    transform: translateY(-2px);
  }

  .action-btn.edit {
    background: rgba(76, 201, 240, 0.1);
    color: var(--accent-color);
    border: 1px solid rgba(76, 201, 240, 0.2);
  }

  .action-btn.delete {
    background: rgba(247, 37, 133, 0.1);
    color: var(--danger-color);
    border: 1px solid rgba(247, 37, 133, 0.2);
  }

  /* Panel lateral */
  .sidebar-panel {
    background: white;
    border-radius: 10px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    overflow: hidden;
    margin-bottom: 1.5rem;
  }

  .stats-item {
    padding: 1.5rem;
    border-bottom: 1px solid var(--medium-gray);
  }

  .stats-item:last-child {
    border-bottom: none;
  }

  .stats-title {
    font-size: 0.85rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    color: var(--dark-gray);
    margin-bottom: 1rem;
    font-weight: 600;
  }

  .stats-value {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--dark-blue);
    margin-bottom: 0.5rem;
  }

  .stats-change {
    display: flex;
    align-items: center;
    justify-content: space-between;
  }

  .progress-thin {
    height: 6px;
    border-radius: 3px;
    background: var(--medium-gray);
    margin-bottom: 0.5rem;
  }

  .progress-bar-success {
    background: var(--success-color);
  }

  .progress-bar-warning {
    background: var(--warning-color);
  }

  .activity-item {
    padding: 1rem 1.5rem;
    border-bottom: 1px solid var(--medium-gray);
    position: relative;
    padding-left: 2.5rem;
  }

  .activity-item:last-child {
    border-bottom: none;
  }

  .activity-item::before {
    content: "";
    position: absolute;
    left: 1.5rem;
    top: 1.5rem;
    width: 12px;
    height: 12px;
    border-radius: 50%;
    background: var(--accent-color);
  }

  .activity-item h6 {
    font-size: 0.95rem;
    font-weight: 600;
    margin-bottom: 0.25rem;
    color: var(--dark-blue);
  }

  .activity-item p {
    font-size: 0.85rem;
    color: var(--dark-gray);
    margin-bottom: 0;
  }

  .activity-time {
    font-size: 0.75rem;
    color: var(--dark-gray);
    opacity: 0.7;
  }

  /* Paginación */
  .pagination-custom .page-item.active .page-link {
    background: linear-gradient(135deg, var(--accent-color), var(--light-accent));
    border-color: transparent;
  }

  .pagination-custom .page-link {
    color: var(--dark-blue);
    border: 1px solid var(--medium-gray);
    margin: 0 0.25rem;
    border-radius: 8px !important;
    min-width: 36px;
    text-align: center;
  }

  .pagination-custom .page-link:hover {
    background-color: var(--light-gray);
  }

  /* Buscador */
  .search-box {
    position: relative;
    max-width: 300px;
  }

  .search-box .form-control {
    padding-left: 2.5rem;
    border-radius: 50px;
    border: 1px solid var(--medium-gray);
    height: 40px;
  }

  .search-box .search-icon {
    position: absolute;
    left: 1rem;
    top: 50%;
    transform: translateY(-50%);
    color: var(--dark-gray);
    opacity: 0.7;
  }

  /* Responsive */
  @media (max-width: 991.98px) {
    .metric-card {
      margin-bottom: 1rem;
    }

    .search-box {
      max-width: 100%;
      margin-bottom: 1rem;
    }
  }
</style>