<?php

declare(strict_types=1);
if (session_status() === PHP_SESSION_NONE) session_start();

require_once __DIR__ . '/../models/PubliModel.php';

$userId = $_SESSION['id'] ?? null;
if (!$userId) {
    header('Location: /sennova/inAdmin.php?vista=perfil&mensaje=error_auth');
    exit;
}

// CSRF
if (
    empty($_POST['csrf_token']) || empty($_SESSION['csrf_token']) ||
    !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])
) {
    unset($_SESSION['csrf_token']);
    header('Location: /sennova/inAdmin.php?vista=perfil&error=' . urlencode('Solicitud inválida.'));
    exit;
}
unset($_SESSION['csrf_token']);

// Inputs
$username  = trim((string)($_POST['nombre'] ?? ''));
$telefono  = trim((string)($_POST['telefono'] ?? ''));
$direccion = trim((string)($_POST['direccion'] ?? ''));

// Validaciones
$errs = [];
if (mb_strlen($username) < 3 || mb_strlen($username) > 80) $errs[] = 'El nombre de usuario debe tener entre 3 y 80 caracteres.';
if (!preg_match('/^[\d\s()+-]{7,20}$/', $telefono))      $errs[] = 'El teléfono no es válido.';
if (mb_strlen($direccion) < 5 || mb_strlen($direccion) > 120) $errs[] = 'La dirección debe tener entre 5 y 120 caracteres.';
if ($errs) {
    header('Location: /sennova/inAdmin.php?vista=perfil&error=' . urlencode(implode(' ', $errs)));
    exit;
}

// Guardar
$model = new UserModel();
$res = $model->actualizarContacto((int)$userId, $username, $telefono, $direccion);

if ($res === 'username_duplicado') {
    header('Location: /sennova/inAdmin.php?vista=perfil&error=' . urlencode('El nombre de usuario ya está en uso.'));
    exit;
}

if ($res) {
    // refrescar sesión
    $_SESSION['nombre_usuario'] = $username;
    $_SESSION['telefono']       = $telefono;
    $_SESSION['direccion']      = $direccion;

    header('Location: /sennova/inAdmin.php?vista=perfil&mensaje=perfil_ok');
} else {
    header('Location: /sennova/inAdmin.php?vista=perfil&error=' . urlencode('No se pudieron guardar los cambios.'));
}
exit;
