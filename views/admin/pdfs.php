<?php
require_once __DIR__ . '/../../conexion/conexion.php';
$pdo = conectaDb();

$q = isset($_GET['q']) ? trim($_GET['q']) : '';
$f = isset($_GET['form_type']) ? trim($_GET['form_type']) : '';

$where = [];
$params = [];
if ($q !== '') {
  $isDigits = preg_match('/^\d{5,}$/', $q) === 1;
  if ($isDigits) {
    // Buscar estrictamente por cédula en el patrón nombre-cedula(.|-)...
    $where[] = "(filename LIKE :q_exact OR filename LIKE :q_mid)";
    $params[':q_exact'] = '%-' . $q . '.pdf';
    $params[':q_mid']   = '%-' . $q . '-%.pdf';
  } else {
    $where[] = "(original_name LIKE :q OR filename LIKE :q)";
    $params[':q'] = '%' . $q . '%';
  }
}
if ($f !== '') {
  $where[] = "form_type = :f";
  $params[':f'] = $f;
}
$whereSql = $where ? ('WHERE ' . implode(' AND ', $where)) : '';

$sql = "SELECT id_pdf, filename, original_name, relative_path, size_bytes, created_at, area, form_type, n_cliente
        FROM generated_pdfs
        $whereSql
        ORDER BY created_at DESC, id_pdf DESC";
$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$rows = $stmt ? $stmt->fetchAll(PDO::FETCH_ASSOC) : [];

function formatBytes($bytes)
{
  $units = ['B', 'KB', 'MB', 'GB', 'TB'];
  $power = $bytes > 0 ? floor(log($bytes, 1024)) : 0;
  $power = min($power, count($units) - 1);
  $value = $bytes / (1024 ** $power);
  return number_format($value, $power >= 2 ? 2 : 0) . ' ' . $units[$power];
}
?>

<div class="gradient-header mt-5">
  <div class="container">
    <div class="d-flex justify-content-between align-items-center">
      <div>
        <h1 class="h3 mb-1 fw-bold"><i class="fa-solid fa-file-pdf me-2"></i>Gestión de PDFs Generados</h1>
        <p class="mb-0 opacity-75">Sistema profesional de administración de documentos</p>
      </div>
      <div class="d-flex gap-2">
        <a href="inAdmin.php?vista=maps" class="btn btn-outline-light btn-sm">
          <i class="fa-solid fa-arrow-left me-1"></i> Formularios
        </a>
        <a href="inAdmin.php?vista=report" class="btn btn-light btn-sm">
          <i class="fa-solid fa-chart-line me-1"></i> Reportes
        </a>
      </div>
    </div>
  </div>
</div>
<!-- FAB MAPS -->
<a id="maps-fab" href="inAdmin.php?vista=maps" class="btn-fab fab-hidden" aria-label="Ir a Formularios" title="Ir a Formularios">
  <i class="fa-solid fa-map"></i>
</a>


  <div class="search-card p-4 mb-4">
    <form method="get">
      <input type="hidden" name="vista" value="pdfs">
      <div class="row g-3 align-items-end">
        <div class="col-md-5">
          <label class="form-label">🔍 Buscar por nombre o archivo</label>
          <input type="text" name="q" class="form-control" placeholder="Ej: juan_perez o 1234567890" value="<?= htmlspecialchars($q) ?>">
        </div>
        <div class="col-md-4">
          <label class="form-label">📋 Filtrar por tipo de formulario</label>
          <select name="form_type" class="form-select">
            <option value="">Todos los formularios</option>
            <?php
            $formTypes = [
              'form1_solicitud' => 'Formulario 1 - Solicitud',
              'form2_evaluacion' => 'Formulario 2 - Evaluación técnica',
              'form3_cotizacion' => 'Formulario 3 - Cotización',
              'form4_orden_trabajo' => 'Formulario 4 - Orden de trabajo',
              'form5_verificacion_pcb' => 'Formulario 5 - Verificación PCB',
              'form6_verificacion_3d' => 'Formulario 6 - Verificación 3D',
              'form7_continuidad_pcb' => 'Formulario 7 - Continuidad PCB',
              'form8_informe_servicio' => 'Formulario 8 - Informe de servicio',
              'form9_satisfaccion' => 'Formulario 9 - Satisfacción',
            ];
            foreach ($formTypes as $key => $label):
            ?>
              <option value="<?= $key ?>" <?= $f === $key ? 'selected' : '' ?>><?= $label ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="col-md-3 d-grid">
          <button class="btn btn-gradient" type="submit">
            <i class="fa-solid fa-magnifying-glass me-2"></i> Buscar PDFs
          </button>
        </div>
      </div>
    </form>
  </div>

  <div class="card">
    <?php if (empty($rows)): ?>
      <div class="empty-state">
        <i class="fa-regular fa-file-pdf"></i>
        <h4 class="h5 fw-bold mb-2">No se encontraron PDFs generados</h4>
        <p class="mb-0 text-muted">Intenta ajustar los filtros de búsqueda para obtener resultados</p>
      </div>
    <?php else: ?>
      <div class="results-header">
        <div class="results-count"><?= count($rows) ?> documento(s) encontrado(s)</div>
        <div class="results-sort">Ordenado por: Más recientes primero</div>
      </div>

      <?php
      // Columnas fijas por formulario (orden deseado)
      $columns = [
        'form1_solicitud' => 'Solicitud Servicio',
        'form2_evaluacion' => 'Evaluación Técnica',
        'form3_cotizacion' => 'Cotización',
        'form4_orden_trabajo' => 'Orden Trabajo',
        'form5_verificacion_pcb' => 'Verificación PCB',
        'form6_verificacion_3d' => 'Verificación 3D',
        'form7_continuidad_pcb' => 'Continuidad PCB',
        'form8_informe_servicio' => 'Informe Servicio',
        'form9_satisfaccion' => 'Satisfacción',
      ];

      // Agrupar por form_type siguiendo el orden de columnas
      $byForm = [];
      foreach ($columns as $key => $_) {
        $byForm[$key] = [];
      }
      foreach ($rows as $r) {
        $k = $r['form_type'] ?? '';
        if (!isset($byForm[$k])) {
          $byForm[$k] = [];
        }
        $byForm[$k][] = $r;
      }
      // Calcular alto de la tabla (máximo número de filas entre columnas)
      $maxRows = 0;
      foreach ($byForm as $list) {
        $maxRows = max($maxRows, count($list));
      }
      ?>

      <div class="table-responsive">
  <table class="table table-hover align-middle mb-0">
    <thead>
      <tr>
        <?php foreach ($columns as $key => $label): ?>
          <th class="text-center"><?= htmlspecialchars($label) ?></th>
        <?php endforeach; ?>
      </tr>
    </thead>
    <tbody>
      <?php for ($i = 0; $i < $maxRows; $i++): ?>
        <tr>
          <?php foreach ($columns as $key => $label): ?>
            <td style="height: 100%;">
              <?php if (!empty($byForm[$key][$i])): $row = $byForm[$key][$i]; ?>
                <div class="pdf-card">
                  <div class="pdf-header">
                    <span class="pdf-id">#<?= (int)$row['id_pdf'] ?></span>
                    <?php if (!empty($row['n_cliente'])): ?>
                      <span class="pdf-area">Cliente: <?= htmlspecialchars($row['n_cliente']) ?></span>
                    <?php endif; ?>
                  </div>

                  <div class="pdf-content">
                    <div class="pdf-filename">
                      <i class="fa-solid fa-file-pdf pdf-icon"></i>
                      <div class="pdf-name" title="<?= htmlspecialchars($row['filename']) ?>">
                        <?= htmlspecialchars($row['filename']) ?>
                      </div>
                    </div>

                    <div class="pdf-meta">
                      <div class="pdf-meta-item">
                        <i class="fa-solid fa-database"></i>
                        <span class="pdf-size"><?= formatBytes((int)$row['size_bytes']) ?></span>
                      </div>
                      <div class="pdf-meta-item">
                        <i class="fa-solid fa-calendar"></i>
                        <span class="pdf-date"><?= htmlspecialchars($row['created_at']) ?></span>
                      </div>
                    </div>
                  </div>

                  <div class="pdf-actions">
                    <a class="pdf-action-btn btn-view" href="<?= htmlspecialchars($row['relative_path']) ?>" target="_blank" title="Ver PDF">
                      <i class="fa-solid fa-eye"></i>
                    </a>
                    <a class="pdf-action-btn btn-download" href="<?= htmlspecialchars($row['relative_path']) ?>" download title="Descargar">
                      <i class="fa-solid fa-download"></i>
                    </a>
                    <form method="post" action="/sennova/routes/DeleteGeneratedPdf.php" onsubmit="return confirm('¿Estás seguro de eliminar este PDF?');" class="d-inline">
                      <input type="hidden" name="id" value="<?= (int)$row['id_pdf'] ?>">
                      <button type="submit" class="pdf-action-btn btn-delete" title="Eliminar">
                        <i class="fa-solid fa-trash"></i>
                      </button>
                    </form>
                  </div>
                </div>
              <?php endif; ?>
            </td>
          <?php endforeach; ?>
        </tr>
      <?php endfor; ?>
    </tbody>
  </table>
</div>

<style>
:root {
  --main-gradient: linear-gradient(135deg, #2c3e50 0%, #1a1a2e 100%);
  --card-gradient: linear-gradient(180deg, #ffffff 0%, #fafbfc 100%);
  --hover-gradient: linear-gradient(135deg, #3498db 0%, #2c3e50 100%);
  --primary-color: #2c3e50;
  --secondary-color: #34495e;
  --accent-color: #e74c3c;
  --success-color: #27ae60;
  --info-color: #3498db;
  --light-bg: #f8f9fa;
  --border-color: #e2e8f0;
}

/* ===== Header ===== */
.gradient-header {
  background: var(--main-gradient);
  color: #fff;
  padding: 1.25rem 0;
  margin-bottom: 2rem;
  box-shadow: 0 4px 25px rgba(0, 0, 0, .2);
  position: relative;
  overflow: hidden;
  z-index: 0;
  border-radius: 4px;

}
.gradient-header::before {
  content: '';
  position: absolute;
  inset: 0;
  opacity: .3;
  pointer-events: none;
  z-index: -1;

}
.gradient-header>.container {
  position: relative;
  z-index: 1;
}

/* ===== Tarjetas ===== */
.card {
  border: none;
  border-radius: 16px;
  box-shadow: 0 8px 35px rgba(0, 0, 0, .08);
  background: #fff;
  overflow: hidden;
  transition: .3s transform, .3s box-shadow;
  backdrop-filter: blur(10px);
}
.card:hover { transform: translateY(-2px); box-shadow: 0 12px 45px rgba(0,0,0,.12); }

/* Botón degradado */
.btn-gradient {
  background: var(--main-gradient);
  color: #fff;
  border: none;
  border-radius: 10px;
  padding: 10px 18px;
  transition: .3s;
  font-weight: 500;
  letter-spacing: .3px;
  box-shadow: 0 4px 15px rgba(44,62,80,.2);
}
.btn-gradient:hover {
  background: var(--hover-gradient);
  transform: translateY(-2px);
  box-shadow: 0 6px 20px rgba(44,62,80,.3);
}

/* Buscador */
.search-card {
  background: #fff;
  border-radius: 16px;
  box-shadow: 0 8px 30px rgba(0,0,0,.08);
  border: 1px solid var(--border-color);
  backdrop-filter: blur(10px);
}

/* Inputs */
.form-control, .form-select {
  border-radius: 10px;
  padding: 12px 16px;
  border: 1px solid var(--border-color);
  transition: .3s;
  font-size: .92rem;
  font-weight: 400;
}
.form-control:focus, .form-select:focus {
  border-color: var(--primary-color);
  box-shadow: 0 0 0 .25rem rgba(44,62,80,.15);
  transform: translateY(-1px);
}

/* Estado vacío */
.empty-state { padding: 4rem 2rem; text-align: center; color: #6c757d; }
.empty-state i {
  font-size: 4.5rem;
  margin-bottom: 1rem;
  color: #dee2e6;
  opacity: .7;
  background: linear-gradient(135deg, #e9ecef 0%, #dee2e6 100%);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
}

/* ===== Tabla ===== */
.table-container { overflow: hidden; border-radius: 0 0 16px 16px; }
.table { margin-bottom: 0; border-collapse: separate; border-spacing: 0; width: 100%; }

/* Cabecera como una sola banda */
.table thead tr {
  background: var(--main-gradient);
  position: sticky;
  top: 0;
  z-index: 10;
}
.table thead th {
  background: transparent;
  color: #fff;
  border: 0;
  padding: 14px 12px;
  font-weight: 600;
  text-align: center;
  text-transform: uppercase;
  font-size: .8rem;
}
/* Separadores blancos finos */
.table thead th + th {
  box-shadow: inset 1px 0 0 rgba(255,255,255,0.18);
}
/* Bordes redondeados solo en extremos */
.table thead th:first-child { border-top-left-radius: 16px; }
.table thead th:last-child { border-top-right-radius: 16px; }
/* Línea sutil bajo cabecera */
.table thead { box-shadow: 0 1px 0 rgba(255,255,255,0.12) inset; }

/* Celdas */
.table td {
  padding: 0;
  vertical-align: top;
  border: 1px solid var(--border-color);
  background: #fff;
  transition: background-color .2s ease;
}
.table td:hover { background: #fafbfc; }
.table td:not(:last-child) { border-right: 1px solid var(--border-color); }
.table tr:not(:last-child) td { border-bottom: 1px solid var(--border-color); }

/* ===== Tarjeta PDF (compacta) ===== */
.pdf-card {
  padding: 1rem;
  height: 100%;
  display: flex;
  flex-direction: column;
  transition: .3s;
  border-left: 3px solid var(--accent-color);
  background: var(--card-gradient);
  position: relative;
  overflow: hidden;
}
.pdf-card::before {
  content: '';
  position: absolute;
  inset: 0;
  background: linear-gradient(135deg, rgba(255,255,255,.08) 0%, rgba(255,255,255,0) 100%);
  pointer-events: none;
}
.pdf-card:hover {
  background: linear-gradient(180deg, #ffffff 0%, #f6f8fa 100%);
  border-left-color: var(--primary-color);
  transform: translateY(-2px);
  box-shadow: 0 8px 25px rgba(0,0,0,.1);
}
.pdf-header { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: .6rem; }
.pdf-id, .pdf-area {
  color: #fff;
  padding: 4px 8px;
  font-size: .72rem;
  border-radius: 5px;
  font-weight: 600;
  letter-spacing: .3px;
  box-shadow: 0 2px 8px rgba(44,62,80,.2);
}
.pdf-id { background: var(--main-gradient); }
.pdf-area { background: var(--secondary-color); font-weight: 500; }
.pdf-content { flex-grow: 1; margin-bottom: .8rem; }
.pdf-filename { display: flex; align-items: center; margin-bottom: .6rem; }
.pdf-icon {
  color: var(--accent-color);
  font-size: 1.4rem;
  margin-right: .6rem;
  flex-shrink: 0;
  filter: drop-shadow(0 2px 4px rgba(231,76,60,.2));
}
.pdf-name {
  font-weight: 600;
  color: var(--primary-color);
  line-height: 1.25;
  word-break: break-word;
  font-size: .92rem;
  letter-spacing: -.2px;
}
.pdf-meta {
  color: #6c757d;
  font-size: .8rem;
  margin-bottom: .6rem;
  display: flex;
  flex-wrap: wrap;
  gap: .5rem;
}
.pdf-meta-item {
  display: flex;
  align-items: center;
  gap: .45rem;
  padding: 4px 8px;
  background: #f8f9fa;
  border-radius: 6px;
  font-size: .8rem;
}
.pdf-size { color: var(--success-color); font-weight: 600; }
.pdf-date { color: var(--info-color); font-weight: 600; }
.pdf-actions { display: flex; gap: .4rem; justify-content: space-between; }
.pdf-action-btn {
  width: 36px;
  height: 36px;
  padding: 0;
  display: flex;
  align-items: center;
  justify-content: center;
  border-radius: 6px;
  font-size: 1rem;
}
.pdf-action-btn i { margin: 0; font-size: 1rem; }
.btn-view { background: var(--info-color); color: #fff; }
.btn-view:hover { background: #2980b9; transform: translateY(-2px); box-shadow: 0 4px 12px rgba(52,152,219,.3); color: #fff; }
.btn-download { background: var(--success-color); color: #fff; }
.btn-download:hover { background: #219653; transform: translateY(-2px); box-shadow: 0 4px 12px rgba(39,174,96,.3); color: #fff; }
.btn-delete { background: var(--accent-color); color: #fff; }
.btn-delete:hover { background: #c0392b; transform: translateY(-2px); box-shadow: 0 4px 12px rgba(231,76,60,.3); color: #fff; }

/* ===== Cabecera de resultados ===== */
.table-responsive { border-radius: 0 0 16px 16px; overflow: hidden; }
.results-header {
  padding: 1.1rem 1.5rem;
  background: linear-gradient(135deg, #f8f9fa 0%, #f1f3f5 100%);
  border-bottom: 1px solid var(--border-color);
  display: flex;
  justify-content: space-between;
  align-items: center;
}
.results-count { font-weight: 700; color: var(--primary-color); font-size: 1rem; display: flex; align-items: center; gap: .5rem; }
.results-count::before { content: '📊'; font-size: 1.1rem; }
.results-sort { color: #6c757d; font-size: .9rem; display: flex; align-items: center; gap: .5rem; }
.results-sort::before { content: '⏱️'; font-size: 1.05rem; }
.form-label { font-weight: 600; color: var(--primary-color); margin-bottom: .45rem; font-size: .92rem; }
.container { max-width: 1800px; }

/* ===== Ajuste XS ===== */
.pdf-card { padding: .75rem; border-left-width: 2px; }
.pdf-header { margin-bottom: .4rem; }
.pdf-id, .pdf-area { padding: 3px 6px; font-size: .68rem; border-radius: 4px; }
.pdf-content { margin-bottom: .6rem; }
.pdf-filename { margin-bottom: .45rem; }
.pdf-icon { font-size: 1.2rem; margin-right: .5rem; }
.pdf-name {
  font-size: .88rem;
  line-height: 1.2;
  overflow: hidden;
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
}
.pdf-meta { font-size: .75rem; gap: .4rem; margin-bottom: .5rem; }
.pdf-meta-item { padding: 3px 6px; font-size: .75rem; gap: .4rem; }
.pdf-actions { gap: .3rem; }
.pdf-action-btn { width: 32px; height: 32px; font-size: .95rem; }
.pdf-action-btn i { font-size: .95rem; }
.table th { padding: 12px 10px; font-size: .75rem; }
.results-header { padding: .9rem 1.2rem; }

@media (max-width:1200px) {
  .table-responsive { overflow-x: auto; }
  .table { min-width: 1200px; }
  .pdf-card { padding: .7rem; }
  .pdf-name { font-size: .86rem; }
  .pdf-action-btn { width: 30px; height: 30px; font-size: .9rem; }
}

@media (max-width:768px) {
  .gradient-header { padding: 1rem 0; }
  .results-header { flex-direction: column; gap: .6rem; text-align: center; padding: 1rem; }
  .pdf-header { flex-direction: column; gap: .6rem; }
  .pdf-filename { flex-direction: column; align-items: flex-start; gap: .6rem; }
  .pdf-icon { margin-right: 0; align-self: center; }
  .pdf-meta { flex-direction: column; gap: .45rem; }
  .pdf-meta-item { justify-content: center; }
}

/* ===== FABs ===== */
.btn-fab{
  width: 52px;
  height: 52px;
  border-radius: 50%;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  text-decoration: none;
  background: var(--main-gradient);
  color: #fff;
  box-shadow: 0 10px 25px rgba(0,0,0,.18);
  border: 2px solid rgba(255,255,255,.25);
  transition: transform .2s ease, box-shadow .2s ease, background .2s ease, opacity .2s ease;
}
.btn-fab:hover{
  background: white;
  color: #080808ff;
  transform: translateY(-2px);
  box-shadow: 0 14px 28px rgba(0,0,0,.22);
}
.fab-hidden{ opacity: 0; transform: translateY(10px) scale(.9); pointer-events: none; }
.fab-show{ opacity: 1; transform: translateY(0) scale(1); pointer-events: auto; }
#pdf-fab{
  position: fixed;
  right: 24px;
  bottom: 90px;
  z-index: 1100;
}
#maps-fab{
  position: fixed;
  right: 24px;
  bottom: 90px;
  z-index: 1100;
}
#pdf-fab i, #maps-fab i{ font-size: 1.2rem; }
@media (max-width: 576px){
  .btn-fab{ width: 48px; height: 48px; }
  #pdf-fab{ right: 16px; bottom: 80px; }
  #maps-fab{ right: 16px; bottom: 150px; }
}

</style>

<script>
  (function() {
    const fabPDF = document.getElementById('pdf-fab');
    const fabMaps = document.getElementById('maps-fab');

    if (location.href.includes("vista=pdfs")) {
      // En la vista PDFs -> mostrar MAPS
      fabMaps.classList.remove('fab-hidden');
      fabMaps.classList.add('fab-show');
    } else {
      // En otras vistas -> mostrar PDF
      fabPDF.classList.remove('fab-hidden');
      fabPDF.classList.add('fab-show');
    }
  })();
</script>
    <?php endif; ?>
  </div>