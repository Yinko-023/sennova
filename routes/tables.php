<?php
require_once __DIR__ . '/../models/PubliModel.php';

if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

$modelo = new PublicacionModel();
$busqueda = $_GET['buscar'] ?? '';

if (!empty($busqueda)) {
  $archivos = $modelo->buscarArchivos($busqueda);
} else {
  $archivos = $modelo->obtenerArchivo();
}

// Paginación
$registros_por_pagina = 9;
$pagina_actual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$indice_inicio = ($pagina_actual - 1) * $registros_por_pagina;
$total = count($archivos);

// Cortamos los resultados para la página actual
$archivos_pagina = array_slice($archivos, $indice_inicio, $registros_por_pagina);

// Mostrar registros
foreach ($archivos_pagina as $archivo): ?>
  <tr>
    <td><?= htmlspecialchars($archivo['Tittle_ar']) ?></td>
    <td style="max-width: 250px; word-wrap: break-word; white-space: normal;">
      <?= htmlspecialchars($archivo['description_ar']) ?>
    </td>
    <td><?= htmlspecialchars($archivo['type_ar']) ?></td>
    <td><?= htmlspecialchars($archivo['date_publi_ar']) ?></td>
    <td><?= htmlspecialchars($archivo['usuario']) ?></td>
    <td>
      <a href="/sennova/<?= htmlspecialchars($archivo['ruta_ar']) ?>" class="btn btn-success btn-sm" download>
        <i class="fas fa-download"></i> Descargar
      </a>
    </td>
    <?php if ($_SESSION['rol'] == 1): ?>
    <td>
      <a href="/sennova/routes/eliminarArchivo.php?id=<?= $archivo['id_archives'] ?>" class="btn btn-danger btn-sm"
         onclick="return confirm('¿Seguro que deseas eliminar este archivo?');">
        <i class="fas fa-trash-alt"></i> Eliminar
      </a>
    </td>
    <?php endif; ?>
  </tr>
<?php endforeach; ?>
