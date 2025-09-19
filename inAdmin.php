<?php
session_start();

// Verificar que el usuario esté autenticado
if (!isset($_SESSION['usuario'])) {
    header('Location: acceso-xz9x1d4.php?controller=login&action=index');
    exit;
}

// Verificar que el rol esté permitido (1=Admin, 2=Editor, 3=Publicador, 4=Usuario limitado)
$rol = $_SESSION['rol'] ?? null;
if (!in_array($rol, [1, 2, 3, 4])) {
    header('Location: acceso-xz9x1d4.php?controller=login&action=index');
    exit;
}

// Definir roles como booleanos si deseas mostrar cosas condicionalmente
$esAdmin = ($rol == 1);
$esEditor = ($rol == 2);
$esPublicador = ($rol == 3);
$esUsuarioLimitado = ($rol == 4);

// Evitar caché
header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

// Mostrar advertencia si el correo no ha sido verificado
if (isset($_SESSION['email_verified']) && $_SESSION['email_verified'] == 0) {
    echo '
    <div class="alert alert-warning text-center">
        <i class="fas fa-exclamation-circle"></i>
        Debes verificar tu correo electrónico para usar todas las funcionalidades del sistema.
        <br><a href="reenviar_verificacion.php" class="btn btn-sm btn-primary mt-2">Reenviar Correo</a>
    </div>';
}

// Capturar vista deseada
$vista = $_GET['vista'] ?? 'inicio';

// ✅ Vista principal (único inicio para TODOS los roles)
if ($vista === 'inicio') {
    require_once 'controllers/AdminController.php';
    $controller = new AdminController();
    $controller->inicio(); // Método único para todos los roles
    exit;
}

// ✅ Publicaciones
if ($vista === 'usuario') {
    require_once 'models/PubliModel.php';
    $publicacionModel = new Publicacion();
    $publicaciones = $publicacionModel->obtenerPublicaciones();
    $destacada = $publicacionModel->obtenerDestacada();
}

// ✅ Editar usuario
if ($vista === 'editarUsuario' && isset($_GET['id'])) {
    require_once 'models/PubliModel.php';

    $userModel = new UserModel();
    $usuario = $userModel->obtenerUsuarioPorId($_GET['id']);

    $rolModel = new RolModel();
    $roles = $rolModel->obtenerRolesActivos();
}

// ✅ Procesos dinámicos (proceso1 hasta proceso13)
if (preg_match('/^proceso[1-9]$|^proceso1[0-3]$/', $vista)) {
    require_once 'views/procesos/' . $vista . '.php';
    exit;
}

// ✅ Cargar layout principal (solo se usa admin.php ahora)
require_once 'views/admin.php';