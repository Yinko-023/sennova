<?php
// ====== Inicio: NADA de HTML antes de estos bloques ======
if (session_status() === PHP_SESSION_NONE) session_start();

// 1) Autenticación
$userId = $_SESSION['id'] ?? $_SESSION['usuario'] ?? null;
if (!$userId) {
    header('Location: acceso-xz9x1d4.php?controller=login&action=index');
    exit;
}

// 2) Normaliza el id en sesión para que todo el código use la misma clave
$_SESSION['id'] = (int)$userId;
$_SESSION['usuario'] = (int)$userId;

// 3) Roles permitidos
$rol = $_SESSION['rol'] ?? null;
if (!in_array((int)$rol, [1, 2, 3, 4], true)) {
    header('Location: acceso-xz9x1d4.php?controller=login&action=index');
    exit;
}

// 4) Evitar caché (antes de cualquier salida)
header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

require_once __DIR__ . '/models/PubliModel.php';
$um = new UserModel();
if (!isset($_SESSION['telefono']) || !isset($_SESSION['direccion'])) {
    $row = $um->obtenerUsuarioPorId((int)$_SESSION['id']); 
    $_SESSION['telefono']  = $row['telefono']  ?? '';
    $_SESSION['direccion'] = $row['direccion'] ?? '';
}

$esAdmin          = ((int)$rol === 1);
$esEditor         = ((int)$rol === 2);
$esPublicador     = ((int)$rol === 3);
$esUsuarioLimitado= ((int)$rol === 4);

$showEmailWarning = (isset($_SESSION['email_verified']) && (int)$_SESSION['email_verified'] === 0);
$emailWarningHtml = '
    <div class="alert alert-warning text-center m-0">
        <i class="fas fa-exclamation-circle"></i>
        Debes verificar tu correo electrónico para usar todas las funcionalidades del sistema.
        <br><a href="reenviar_verificacion.php" class="btn btn-sm btn-primary mt-2">Reenviar Correo</a>
    </div>
';


$vista = $_GET['vista'] ?? 'inicio';

if ($vista === 'inicio') {
    require_once __DIR__ . '/controllers/AdminController.php';
    $controller = new AdminController();
    $controller->inicio(); 
    exit;
}

if ($vista === 'usuario') {
    require_once __DIR__ . '/models/PubliModel.php';

    $publicacionModel = new Publicacion();
    $publicaciones = $publicacionModel->obtenerPublicaciones();
    $destacada     = $publicacionModel->obtenerDestacada();
}

if ($vista === 'editarUsuario' && isset($_GET['id'])) {
    // FIX: requerir los modelos correctos
    require_once __DIR__ . '/models/UserModel.php';
    require_once __DIR__ . '/models/RolModel.php';

    $userModel = new UserModel();
    $usuario   = $userModel->obtenerUsuarioPorId((int)$_GET['id']);

    $rolModel  = new RolModel();
    $roles     = $rolModel->obtenerRolesActivos();
}


require_once __DIR__ . '/views/admin.php';
