<?php
require_once __DIR__ . '/../../conexion/conexion.php';
$pdo = conectaDb();

$q  = isset($_GET['q']) ? trim($_GET['q']) : '';
$f  = isset($_GET['form_type']) ? trim($_GET['form_type']) : '';
$c  = isset($_GET['cliente']) ? trim($_GET['cliente']) : '';
$id = isset($_GET['id']) ? trim($_GET['id']) : '';

$where  = [];
$params = [];


if ($id !== '') {
  $digits = preg_replace('/\D+/', '', $id);

  if ($digits !== '') {
    $where[] = "(filename_2 LIKE :id_exact OR filename_2 LIKE :id_mid OR n_cliente LIKE :id_cli)";
    $params[':id_exact'] = '%-' . $digits . '.pdf';
    $params[':id_mid']   = '%-' . $digits . '-%.pdf';
    $params[':id_cli']   = '%' . $digits . '%';
  } else {
    $where[] = "n_cliente LIKE :id_cli";
    $params[':id_cli'] = '%' . $id . '%';
  }
}

if ($f !== '') {
  $where[] = "form_type = :f";
  $params[':f'] = $f;
}

if ($c !== '') {
  $where[] = "n_cliente LIKE :c";
  $params[':c'] = '%' . $c . '%';
}

if ($q !== '') {
  $where[] = "(original_name LIKE :q OR filename_2 LIKE :q OR form_type LIKE :q OR n_cliente LIKE :q OR area LIKE :q)";
  $params[':q'] = '%' . $q . '%';
}

$whereSql = $where ? ('WHERE ' . implode(' AND ', $where)) : '';


$sql = "SELECT
          id_pdf,
          filename_2,
          original_name,
          relative_path,
          size_bytes,
          created_at,
          area,
          form_type,
          n_cliente,
          finalizado,
          metadata_json  
        FROM generated_pdfs
        $whereSql
        ORDER BY n_cliente ASC, created_at DESC, id_pdf DESC";


$stmt  = $pdo->prepare($sql);
$stmt->execute($params);
$rows = $stmt ? $stmt->fetchAll(PDO::FETCH_ASSOC) : [];

$sqlClientes = "SELECT DISTINCT n_cliente
                FROM generated_pdfs
                WHERE n_cliente IS NOT NULL AND n_cliente != ''
                ORDER BY n_cliente ASC";
$stmtClientes = $pdo->prepare($sqlClientes);
$stmtClientes->execute();
$clientes = $stmtClientes->fetchAll(PDO::FETCH_COLUMN);

function formatBytes($bytes)
{
  $units = ['B', 'KB', 'MB', 'GB', 'TB'];
  $power = $bytes > 0 ? floor(log($bytes, 1024)) : 0;
  $power = min($power, count($units) - 1);
  $value = $bytes / (1024 ** $power);
  return number_format($value, $power >= 2 ? 2 : 0) . ' ' . $units[$power];
}

$byCliente = [];
foreach ($rows as $row) {
  $cliente = $row['n_cliente'] ?? 'Sin Cliente';
  if (!isset($byCliente[$cliente])) {
    $byCliente[$cliente] = [];
  }
  $byCliente[$cliente][] = $row;
}


$formOrder = [
  'form1_solicitud',
  'form2_evaluacion',
  'form3_cotizacion',
  'form4_orden_trabajo',
  'form5_verificacion_pcb',
  'form6_verificacion_3d',
  'form7_continuidad_pcb',
  'form8_informe_servicio',
  'form9_satisfaccion',
];

$formLabels = [
  'form1_solicitud'        => 'Form 1 - Solicitud',
  'form2_evaluacion'       => 'Form 2 - Evaluación técnica',
  'form3_cotizacion'       => 'Form 3 - Cotización',
  'form4_orden_trabajo'    => 'Form 4 - Orden de trabajo',
  'form5_verificacion_pcb' => 'Form 5 - Verificación PCB',
  'form6_verificacion_3d'  => 'Form 6 - Verificación 3D',
  'form7_continuidad_pcb'  => 'Form 7 - Continuidad PCB',
  'form8_informe_servicio' => 'Form 8 - Informe de servicio',
  'form9_satisfaccion'     => 'Form 9 - Satisfacción',
];


function getLastFormForClient(array $rows, array $order): ?string
{
  $maxIdx = -1;
  $last = null;
  foreach ($rows as $r) {
    $ft = $r['form_type'] ?? '';
    $idx = array_search($ft, $order, true);
    if ($idx !== false && $idx > $maxIdx) {
      $maxIdx = $idx;
      $last = $ft;
    }
  }
  return $last;
}

function getNextForm(?string $last, array $order): ?string
{
  if ($last === null) return $order[0] ?? null;
  $i = array_search($last, $order, true);
  if ($i === false) return $order[0] ?? null;
  return $order[$i + 1] ?? null;
}

function getFormCode(array $row): ?string
{
  $meta = [];
  if (!empty($row['metadata_json'])) {
    $tmp = json_decode($row['metadata_json'], true);
    if (is_array($tmp)) $meta = $tmp;
  }

  $map = [
    'form1_solicitud'        => ['numero_solicitud', 'sol_no', 'codigo', 'code'],
    'form2_evaluacion'       => ['codigo', 'eva_no', 'code'],
    'form3_cotizacion'       => ['cot_no', 'codigo', 'code'],
    'form4_orden_trabajo'    => ['ot_no', 'numero', 'codigo', 'code'],
    'form5_verificacion_pcb' => ['pcb_no', 'ot', 'codigo', 'code'],
    'form6_verificacion_3d'  => ['v3d_no', 'ot', 'codigo', 'code'],
    'form7_continuidad_pcb'  => ['con_no', 'ot', 'codigo', 'code'],
    'form8_informe_servicio' => ['inf_no', 'ot', 'codigo', 'code'],
    'form9_satisfaccion'     => ['sat_no', 'codigo', 'code'],
  ];
  $ft = $row['form_type'] ?? '';
  $candidates = $map[$ft] ?? ['codigo', 'code'];

  foreach ($candidates as $k) {
    if (isset($meta[$k]) && $meta[$k] !== '') {
      $val = (string)$meta[$k];
      if (ctype_digit($val)) return sprintf('%03d', (int)$val);
      return $val;
    }
  }

  if (!empty($row['filename_2'])) {
    if (preg_match('/(?:^|[_\-])(\d{3,})(?:[_\-]|\.)/i', $row['filename_2'], $m)) {
      return sprintf('%03d', (int)$m[1]);
    }
  }

  return null;
}
?>

<div class="gradient-header mt-5">
  <div class="container">
    <div class="d-flex justify-content-between align-items-center">
      <div>
        <h1 class="h3 mb-1 fw-bold"><i class="fa-solid fa-file-pdf me-2"></i>Gestión de PDFs Generados</h1>
        <p class="mb-0 opacity-75">Sistema profesional de administración de documentos por cliente</p>
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

      <div class="col-lg-3 col-md-4">
        <label class="form-label">🔢 Cédula del cliente</label>
        <input
          type="text"
          name="id"
          class="form-control"
          inputmode="numeric"
          value="<?= htmlspecialchars($id ?? '') ?>"
          placeholder="CC">
      </div>

      <div class="col-lg-3 col-md-4">
        <label class="form-label">🔍 Buscar por nombre o archivo</label>
        <input
          type="text"
          name="q"
          class="form-control"
          value="<?= htmlspecialchars($q) ?>"
          placeholder="Informe..">
      </div>

      <div class="col-lg-3 col-md-4">
        <label class="form-label">👤 Filtrar por cliente</label>
        <select name="cliente" class="form-select">
          <option value="">Todos los clientes</option>
          <?php foreach ($clientes as $cliente): ?>
            <option value="<?= htmlspecialchars($cliente) ?>" <?= $c === $cliente ? 'selected' : '' ?>>
              <?= htmlspecialchars($cliente) ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>

      <div class="col-lg-3 col-md-4">
        <label class="form-label">📋 Filtrar por tipo</label>
        <select name="form_type" class="form-select">
          <option value="">Todos los formularios</option>
          <?php foreach ($formLabels as $key => $label): ?>
            <option value="<?= $key ?>" <?= $f === $key ? 'selected' : '' ?>>
              <?= $label ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>


      <!-- Acciones -->
      <div class="col-12 col-md-6 col-lg-3 d-grid">
        <button class="btn btn-gradient" type="submit">
          <i class="fa-solid fa-magnifying-glass me-2"></i> Buscar PDFs
        </button>
      </div>
      <div class="col-12 col-md-6 col-lg-3 d-grid">
        <a href="?vista=pdfs" class="btn btn-outline-secondary">
          <i class="fa-solid fa-eraser me-2"></i> Limpiar filtros
        </a>
      </div>

    </div>
  </form>
</div>



<?php if (empty($rows)): ?>
  <div class="card">
    <div class="empty-state">
      <i class="fa-regular fa-file-pdf"></i>
      <h4 class="h5 fw-bold mb-2">No se encontraron PDFs generados</h4>
      <p class="mb-0 text-muted">Intenta ajustar los filtros de búsqueda para obtener resultados</p>
    </div>
  </div>
<?php else: ?>

  <div class="results-summary mb-4">
    <div class="row g-3">
      <div class="col-md-4">
        <div class="summary-card">
          <div class="summary-icon">📄</div>
          <div class="summary-content">
            <div class="summary-number"><?= count($rows) ?></div>
            <div class="summary-label">Total PDFs</div>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="summary-card">
          <div class="summary-icon">👥</div>
          <div class="summary-content">
            <div class="summary-number"><?= count($byCliente) ?></div>
            <div class="summary-label">Clientes</div>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="summary-card">
          <div class="summary-icon">📊</div>
          <div class="summary-content">
            <div class="summary-number"><?= array_sum(array_map('count', $byCliente)) ?></div>
            <div class="summary-label">Documentos</div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Vista agrupada por cliente -->
  <?php foreach ($byCliente as $clienteNombre => $clientePdfs): ?>
    <?php
    $areaForClient = $clientePdfs[0]['area'] ?? '';
    $lastForm = getLastFormForClient($clientePdfs, $formOrder);
    $nextForm = getNextForm($lastForm, $formOrder);
    // ¿Este cliente está finalizado?
    $isFinalizado = false;
    foreach ($clientePdfs as $r) {
      if ((int)($r['finalizado'] ?? 0) === 1) {
        $isFinalizado = true;
        break;
      }
    }

    $areaForClient = $clientePdfs[0]['area'] ?? '';
    $lastForm = getLastFormForClient($clientePdfs, $formOrder);
    // Si está finalizado, no proponemos siguiente form
    $nextForm = $isFinalizado ? null : getNextForm($lastForm, $formOrder);

    $continueUrl = "/sennova/inAdmin.php?vista=maps"
      . "&n_cliente=" . urlencode($clienteNombre)
      . "&area=" . urlencode($areaForClient)
      . ($nextForm ? "&next=" . urlencode($nextForm) : "")
      . "&resume=1"
      . "&lock_prev=1";

    ?>
    <div class="client-section mb-4">
      <div class="client-header">
        <div class="client-info">
          <h4 class="client-name">
            <i class="fa-solid fa-user-circle me-2"></i>
            <?= htmlspecialchars($clienteNombre) ?>
          </h4>
          <span class="client-count">
            <?= count($clientePdfs) ?> documento(s)
            <?php if ($lastForm): ?>
              · Último: <strong><?= htmlspecialchars($formLabels[$lastForm] ?? $lastForm) ?></strong>
            <?php endif; ?>
          </span>
        </div>
        <div class="client-actions d-flex gap-2">
          <?php if (!$isFinalizado && $nextForm): ?>
            <a href="<?= $continueUrl ?>" class="btn btn-sm btn-success">
              <i class="fa-solid fa-play me-1"></i> Continuar servicio
            </a>
          <?php endif; ?>

          <form method="post" action="/sennova/routes/FinalizeClient.php" class="d-inline">
            <input type="hidden" name="n_cliente" value="<?= htmlspecialchars($clienteNombre) ?>">
            <input type="hidden" name="state" value="<?= $isFinalizado ? '0' : '1' ?>">
            <button type="submit"
              class="btn btn-sm <?= $isFinalizado ? 'btn-warning' : 'btn-danger' ?>"
              onclick="return confirm('¿Seguro de <?= $isFinalizado ? 'reabrir' : 'finalizar' ?> este servicio?');">
              <i class="fa-solid <?= $isFinalizado ? 'fa-rotate-left' : 'fa-flag-checkered' ?>"></i>
              <?= $isFinalizado ? 'Reabrir' : 'Finalizar' ?>
            </button>
          </form>

          <button
            class="btn btn-sm btn-outline-primary toggle-client collapsed"
            data-bs-toggle="collapse"
            data-bs-target="#client-<?= md5($clienteNombre) ?>"
            aria-expanded="false"
            aria-controls="client-<?= md5($clienteNombre) ?>">
            <i class="fa-solid fa-chevron-down"></i> Expandir
          </button>
        </div>
      </div>

      <div class="client-content collapse" id="client-<?= md5($clienteNombre) ?>">
        <div class="table-responsive">
          <table class="table table-hover align-middle mb-0">
            <thead>
              <tr>
                <th style="width: 8%">ID</th>
                <th style="width: 15%">Tipo Formulario</th>
                <th style="width: 35%">Archivo</th>
                <th style="width: 10%">Tamaño</th>
                <th style="width: 15%">Fecha Creación</th>
                <th style="width: 17%">Acciones</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($clientePdfs as $row): ?>
                <tr>
                  <td>
                    <?php $code = getFormCode($row); ?>
                    <span class="pdf-id-badge" title="#<?= (int)$row['id_pdf'] ?>">
                      <?= htmlspecialchars($code ?? '—') ?>
                    </span>
                  </td>


                  <td>
                    <?php
                    $formTypeLabels = [
                      'form1_solicitud' => 'Solicitud',
                      'form2_evaluacion' => 'Evaluación',
                      'form3_cotizacion' => 'Cotización',
                      'form4_orden_trabajo' => 'Orden Trabajo',
                      'form5_verificacion_pcb' => 'Verificación PCB',
                      'form6_verificacion_3d' => 'Verificación 3D',
                      'form7_continuidad_pcb' => 'Continuidad PCB',
                      'form8_informe_servicio' => 'Informe',
                      'form9_satisfaccion' => 'Satisfacción',
                    ];
                    $formLabel = $formTypeLabels[$row['form_type']] ?? $row['form_type'];
                    ?>
                    <span class="form-type-badge form-type-<?= $row['form_type'] ?>">
                      <?= htmlspecialchars($formLabel) ?>
                    </span>
                  </td>
                  <td>
                    <div class="file-info">
                      <div class="file-icon">
                        <i class="fa-solid fa-file-pdf"></i>
                      </div>
                      <div class="file-details">
                        <div class="file-name" title="<?= htmlspecialchars($row['filename_2']) ?>">
                          <?= htmlspecialchars($row['filename_2']) ?>
                        </div>
                        <?php if ($row['original_name'] && $row['original_name'] !== $row['filename_2']): ?>
                          <div class="file-original">
                            Original: <?= htmlspecialchars($row['original_name']) ?>
                          </div>
                        <?php endif; ?>
                      </div>
                    </div>
                  </td>
                  <td>
                    <span class="file-size"><?= formatBytes((int)$row['size_bytes']) ?></span>
                  </td>
                  <td>
                    <div class="date-info">
                      <div class="date-main"><?= date('d/m/Y', strtotime($row['created_at'])) ?></div>
                      <div class="date-time"><?= date('H:i', strtotime($row['created_at'])) ?></div>
                    </div>
                  </td>
                  <td>

                    <div class="action-buttons">
                      <a class="action-btn btn-view" href="<?= htmlspecialchars($row['relative_path']) ?>" target="_blank" title="Ver PDF">
                        <i class="fa-solid fa-eye"></i>
                      </a>
                      <a class="action-btn btn-download" href="<?= htmlspecialchars($row['relative_path']) ?>" download title="Descargar">
                        <i class="fa-solid fa-download"></i>
                      </a>

                      <!-- Reemplazar (misma ruta/nombre) -->
                      <form class="d-inline replace-form" method="post" action="/sennova/routes/ReplaceGeneratedPdf.php" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?= (int)$row['id_pdf'] ?>">
                        <input type="hidden" name="n_cliente" value="<?= htmlspecialchars($row['n_cliente'] ?? '') ?>">
                        <input type="file" name="pdf_file" accept="application/pdf" class="d-none">
                        <button type="button" class="action-btn btn-delete btn-replace" title="Reemplazar PDF">
                          <i class="fa-solid fa-file-import"></i>
                        </button>
                      </form>

                      <!-- Eliminar -->
                      <form method="post" action="/sennova/routes/DeleteGeneratedPdf.php" onsubmit="return confirm('¿Estás seguro de eliminar este PDF?');" class="d-inline">
                        <input type="hidden" name="id" value="<?= (int)$row['id_pdf'] ?>">
                        <button type="submit" class="action-btn btn-delete" title="Eliminar">
                          <i class="fa-solid fa-trash"></i>
                        </button>
                      </form>
                    </div>
                  </td>

                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  <?php endforeach; ?>

<?php endif; ?>
<script>
  document.addEventListener('click', async (e) => {
    const btn = e.target.closest('.btn-finalizar');
    if (!btn) return;

    const n = btn.getAttribute('data-client');
    if (!n) return;

    if (!confirm(`¿Finalizar el servicio del cliente "${n}"?`)) return;

    btn.disabled = true;
    btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin me-1"></i> Finalizando...';

    try {
      const res = await fetch('/sennova/routes/FinalizeClient.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({
          n_cliente: n
        })
      });
      const data = await res.json();
      if (!res.ok || !data.ok) throw new Error(data.error || 'No se pudo finalizar');

      // Oculta "Continuar servicio" SOLO para este cliente
      const actions = btn.closest('.client-actions');
      if (actions) {
        const cont = actions.querySelector('.btn-continuar');
        if (cont) cont.remove();

        const badge = document.createElement('span');
        badge.className = 'badge bg-secondary';
        badge.textContent = 'Finalizado';
        actions.insertBefore(badge, actions.firstChild);
      }
      btn.remove();

    } catch (err) {
      alert('Error: ' + err.message);
      btn.disabled = false;
      btn.innerHTML = '<i class="fa-solid fa-flag-checkered me-1"></i> Finalizar';
    }
  });
</script>


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
    --warning-color: #f39c12;
    --light-bg: #f8f9fa;
    --border-color: #e2e8f0;
    --shadow-light: 0 2px 10px rgba(0, 0, 0, 0.1);
    --shadow-medium: 0 8px 30px rgba(0, 0, 0, 0.12);
    --shadow-strong: 0 12px 40px rgba(0, 0, 0, 0.15);
  }

  /* ===== Header ===== */
  .gradient-header {
    background: var(--main-gradient);
    color: #fff;
    padding: 1.5rem 0;
    margin-bottom: 2rem;
    box-shadow: var(--shadow-strong);
    position: relative;
    overflow: hidden;
    border-radius: 8px;
  }

  .gradient-header::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(45deg, rgba(255, 255, 255, 0.1) 25%, transparent 25%, transparent 75%, rgba(255, 255, 255, 0.1) 75%);
    background-size: 20px 20px;
    opacity: 0.1;
    pointer-events: none;
  }

  /* ===== Cards ===== */
  .card,
  .search-card {
    border: none;
    border-radius: 16px;
    box-shadow: var(--shadow-medium);
    background: #fff;
    overflow: hidden;
    transition: all 0.3s ease;
  }

  .card:hover {
    transform: translateY(-4px);
    box-shadow: var(--shadow-strong);
  }

  /* ===== Buttons ===== */
  .btn-gradient {
    background: var(--main-gradient);
    color: #fff;
    border: none;
    border-radius: 10px;
    padding: 12px 20px;
    font-weight: 600;
    letter-spacing: 0.5px;
    box-shadow: var(--shadow-light);
    transition: all 0.3s ease;
  }

  .btn-gradient:hover {
    background: var(--hover-gradient);
    transform: translateY(-2px);
    box-shadow: var(--shadow-medium);
    color: #fff;
  }

  /* ===== Form Elements ===== */
  .form-control,
  .form-select {
    border-radius: 10px;
    padding: 12px 16px;
    border: 2px solid var(--border-color);
    transition: all 0.3s ease;
    font-size: 0.95rem;
  }

  .form-control:focus,
  .form-select:focus {
    border-color: var(--primary-color);
    box-shadow: 0 0 0 0.25rem rgba(44, 62, 80, 0.15);
    transform: translateY(-1px);
  }

  .form-label {
    font-weight: 600;
    color: var(--primary-color);
    margin-bottom: 0.5rem;
    font-size: 0.95rem;
  }

  /* ===== Results Summary ===== */
  .results-summary {
    margin-bottom: 2rem;
  }

  .summary-card {
    background: linear-gradient(135deg, #fff 0%, #f8f9fa 100%);
    border: 1px solid var(--border-color);
    border-radius: 16px;
    padding: 1.5rem;
    display: flex;
    align-items: center;
    gap: 1rem;
    box-shadow: var(--shadow-light);
    transition: all 0.3s ease;
    height: 100%;
  }

  .summary-card:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-medium);
  }

  .summary-icon {
    font-size: 2.5rem;
    width: 60px;
    height: 60px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: var(--main-gradient);
    border-radius: 50%;
    color: white;
    box-shadow: var(--shadow-light);
  }

  .summary-content {
    flex: 1;
  }

  .summary-number {
    font-size: 2rem;
    font-weight: 800;
    color: var(--primary-color);
    line-height: 1;
  }

  .summary-label {
    font-size: 0.9rem;
    color: #6c757d;
    font-weight: 500;
    margin-top: 0.25rem;
  }

  /* ===== Client Sections ===== */
  .client-section {
    background: #fff;
    border-radius: 16px;
    box-shadow: var(--shadow-medium);
    overflow: hidden;
    margin-bottom: 1.5rem;
  }

  .client-header {
    background: var(--main-gradient);
    color: white;
    padding: 1.25rem 1.5rem;
    display: flex;
    justify-content: between;
    align-items: center;
    position: relative;
  }

  .client-header::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(90deg, transparent 0%, rgba(255, 255, 255, 0.1) 50%, transparent 100%);
    pointer-events: none;
  }

  .client-info {
    flex: 1;
  }

  .client-name {
    margin: 0;
    font-size: 1.25rem;
    font-weight: 700;
    display: flex;
    align-items: center;
  }

  .client-count {
    font-size: 0.9rem;
    opacity: 0.8;
    font-weight: 500;
    margin-top: 0.25rem;
    display: inline-block;
  }

  .client-actions .btn {
    background: rgba(255, 255, 255, 0.15);
    border: 1px solid rgba(255, 255, 255, 0.3);
    color: white;
    transition: all 0.3s ease;
  }

  .client-actions .btn:hover {
    background: rgba(255, 255, 255, 0.25);
    border-color: rgba(255, 255, 255, 0.5);
    color: white;
    transform: translateY(-1px);
  }

  .client-content {
    transition: all 0.3s ease;
    overflow: hidden;
  }

  .client-content.collapsed {
    max-height: 0;
    opacity: 0;
  }

  /* ===== Table Styles ===== */
  .table-responsive {
    border-radius: 0;
  }

  .table {
    margin-bottom: 0;
    font-size: 0.95rem;
  }

  .table thead th {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    border: none;
    padding: 1rem 0.75rem;
    font-weight: 700;
    color: var(--primary-color);
    text-transform: uppercase;
    font-size: 0.8rem;
    letter-spacing: 0.5px;
    border-bottom: 2px solid var(--border-color);
  }

  .table tbody tr {
    transition: all 0.2s ease;
  }

  .table tbody tr:hover {
    background-color: #f8f9fa;
    transform: scale(1.005);
    box-shadow: var(--shadow-light);
  }

  .table td {
    padding: 1rem 0.75rem;
    vertical-align: middle;
    border-color: #f1f3f5;
  }

  /* ===== Badges and Labels ===== */
  .pdf-id-badge {
    background: var(--primary-color);
    color: white;
    padding: 0.4rem 0.8rem;
    border-radius: 8px;
    font-weight: 600;
    font-size: 0.85rem;
    display: inline-block;
  }

  .form-type-badge {
    padding: 0.5rem 0.8rem;
    border-radius: 8px;
    font-weight: 600;
    font-size: 0.8rem;
    text-align: center;
    display: inline-block;
    min-width: 100px;
  }

  .form-type-form1_solicitud {
    background: #e3f2fd;
    color: #1565c0;
  }

  .form-type-form2_evaluacion {
    background: #f3e5f5;
    color: #7b1fa2;
  }

  .form-type-form3_cotizacion {
    background: #e8f5e8;
    color: #2e7d32;
  }

  .form-type-form4_orden_trabajo {
    background: #fff3e0;
    color: #ef6c00;
  }

  .form-type-form5_verificacion_pcb {
    background: #fce4ec;
    color: #c2185b;
  }

  .form-type-form6_verificacion_3d {
    background: #e0f2f1;
    color: #00695c;
  }

  .form-type-form7_continuidad_pcb {
    background: #f1f8e9;
    color: #558b2f;
  }

  .form-type-form8_informe_servicio {
    background: #e8eaf6;
    color: #3f51b5;
  }

  .form-type-form9_satisfaccion {
    background: #fff8e1;
    color: #ff8f00;
  }

  /* ===== File Info ===== */
  .file-info {
    display: flex;
    align-items: center;
    gap: 0.75rem;
  }

  .file-icon {
    color: var(--accent-color);
    font-size: 1.5rem;
    flex-shrink: 0;
  }

  .file-details {
    flex: 1;
    min-width: 0;
  }

  .file-name {
    font-weight: 600;
    color: var(--primary-color);
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
  }

  .file-original {
    font-size: 0.8rem;
    color: #6c757d;
    margin-top: 0.25rem;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
  }

  .file-size {
    background: linear-gradient(135deg, #e8f5e8 0%, #c8e6c9 100%);
    color: var(--success-color);
    padding: 0.4rem 0.8rem;
    border-radius: 8px;
    font-weight: 600;
    font-size: 0.85rem;
  }

  /* ===== Date Info ===== */
  .date-info {
    text-align: center;
  }

  .date-main {
    font-weight: 600;
    color: var(--primary-color);
    font-size: 0.9rem;
  }

  .date-time {
    font-size: 0.8rem;
    color: #6c757d;
    margin-top: 0.25rem;
  }

  /* ===== Action Buttons ===== */
  .action-buttons {
    display: flex;
    gap: 0.5rem;
    justify-content: center;
  }

  .action-btn {
    width: 38px;
    height: 38px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 8px;
    text-decoration: none;
    border: none;
    transition: all 0.3s ease;
    font-size: 1rem;
  }

  .btn-view {
    background: var(--info-color);
    color: white;
  }

  .btn-view:hover {
    background: #2980b9;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(52, 152, 219, 0.3);
    color: white;
  }

  .btn-download {
    background: var(--success-color);
    color: white;
  }

  .btn-download:hover {
    background: #219653;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(39, 174, 96, 0.3);
    color: white;
  }

  .btn-delete {
    background: var(--accent-color);
    color: white;
  }

  .btn-delete:hover {
    background: #c0392b;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(231, 76, 60, 0.3);
    color: white;
  }

  /* ===== Empty State ===== */
  .empty-state {
    padding: 4rem 2rem;
    text-align: center;
    color: #6c757d;
  }

  .empty-state i {
    font-size: 4.5rem;
    margin-bottom: 1rem;
    color: #dee2e6;
    opacity: 0.7;
  }

  /* ===== FAB ===== */
  .btn-fab {
    width: 56px;
    height: 56px;
    border-radius: 50%;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    background: var(--main-gradient);
    color: #fff;
    box-shadow: var(--shadow-strong);
    border: 2px solid rgba(255, 255, 255, 0.25);
    transition: all 0.3s ease;
    position: fixed;
    right: 24px;
    bottom: 90px;
    z-index: 1100;
  }

  .btn-fab:hover {
    background: white;
    color: var(--primary-color);
    transform: translateY(-4px);
    box-shadow: 0 16px 32px rgba(0, 0, 0, 0.25);
  }

  .fab-hidden {
    opacity: 0;
    transform: translateY(20px) scale(0.8);
    pointer-events: none;
  }

  .fab-show {
    opacity: 1;
    transform: translateY(0) scale(1);
    pointer-events: auto;
  }

  /* ===== Responsive ===== */
  @media (max-width: 1200px) {
    .table-responsive {
      overflow-x: auto;
    }

    .file-name,
    .file-original {
      max-width: 200px;
    }
  }

  @media (max-width: 768px) {
    .gradient-header {
      padding: 1rem 0;
    }

    .client-header {
      flex-direction: column;
      gap: 1rem;
      text-align: center;
    }

    .summary-card {
      padding: 1rem;
    }

    .summary-icon {
      font-size: 2rem;
      width: 50px;
      height: 50px;
    }

    .summary-number {
      font-size: 1.5rem;
    }

    .table-responsive {
      font-size: 0.85rem;
    }

    .table td {
      padding: 0.75rem 0.5rem;
    }

    .action-buttons {
      flex-direction: column;
      gap: 0.25rem;
    }

    .action-btn {
      width: 32px;
      height: 32px;
      font-size: 0.9rem;
    }

    .btn-fab {
      width: 48px;
      height: 48px;
      right: 16px;
      bottom: 70px;
    }
  }
</style>
<script>
  document.addEventListener('click', (e) => {
    const btn = e.target.closest('.btn-replace');
    if (!btn) return;
    const form = btn.closest('.replace-form');
    const input = form.querySelector('input[type="file"]');
    input.click();
    input.onchange = () => {
      if (input.files.length) form.submit();
    };
  });

  document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.toggle-client').forEach(btn => {
      const sel = btn.getAttribute('data-bs-target');
      const pane = document.querySelector(sel);
      if (!pane) return;

      pane.addEventListener('show.bs.collapse', () => {
        btn.innerHTML = '<i class="fa-solid fa-chevron-up"></i> Contraer';
        btn.setAttribute('aria-expanded', 'true');
      });
      pane.addEventListener('hide.bs.collapse', () => {
        btn.innerHTML = '<i class="fa-solid fa-chevron-down"></i> Expandir';
        btn.setAttribute('aria-expanded', 'false');
      });
    });
  });
</script>

<script>
  // --- Helper para activar pestañas por id del botón (ej: 'form6-tab') ---
  window.showTab = function(tabButtonId) {
    const btn = document.getElementById(tabButtonId);
    if (!btn) return;

    // 1) Desactivar todo
    document.querySelectorAll('#formTabs .nav-link').forEach(b => b.classList.remove('active'));
    document.querySelectorAll('#formTabsContent .tab-pane').forEach(p => p.classList.remove('active', 'show'));

    // 2) Activar botón destino
    btn.classList.add('active');

    // 3) Activar pane destino
    const paneSel = btn.getAttribute('data-bs-target'); // ej: "#form6"
    const pane = paneSel ? document.querySelector(paneSel) : null;
    if (pane) pane.classList.add('active', 'show');

    // 4) Si Bootstrap.Tab está disponible, dispara show() (no es obligatorio)
    try {
      if (window.bootstrap && bootstrap.Tab) {
        bootstrap.Tab.getOrCreateInstance(btn).show();
      }
    } catch (e) {
      /* noop */
    }
  };
</script>