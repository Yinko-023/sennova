<?php
require_once __DIR__ . '/../conexion/conexion.php';
$pdo = conectaDb();

$nCliente = trim($_POST['n_cliente'] ?? '');
$state    = (isset($_POST['state']) && $_POST['state'] === '1') ? 1 : 0;

if ($nCliente === '') {
  header('Location: /sennova/inAdmin.php?vista=pdfs&err=bad_ncliente');
  exit;
}

// Marca o desmarca finalizado para TODO ese cliente
$sql = "UPDATE generated_pdfs SET finalizado = :state WHERE n_cliente = :n";
$stmt = $pdo->prepare($sql);
$stmt->execute([':state' => $state, ':n' => $nCliente]);

// Vuelve a la lista, opcional ancla al panel del cliente
header('Location: /sennova/inAdmin.php?vista=pdfs#client-'.md5($nCliente));
exit;
