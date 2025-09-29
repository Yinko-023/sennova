<?php
require_once __DIR__ . '/../models/LoginModel.php';

class LoginController
{
    private $LoginModel;

    public function __construct()
    {
        $this->LoginModel = new LoginModel();
    }

    public function index()
    {
        $error = '';
        require 'views/login.php';
    }

    public function validar($email_ac, $password_ac)
{
    $loginModel = new LoginModel();
    $usuario_valido = $loginModel->startSession($email_ac, $password_ac);

    if ($usuario_valido) {
        if (session_status() === PHP_SESSION_NONE) session_start();
        session_regenerate_id(true);

        // IDs (deja ambos por compatibilidad con tu código)
        $_SESSION['id']       = (int)$usuario_valido['id'];
        $_SESSION['usuario']  = (int)$usuario_valido['id'];

        // Datos principales
        $_SESSION['username']        = $usuario_valido['username'];
        $_SESSION['nombre_usuario']  = $usuario_valido['username']; // <- lo usa tu vista
        $_SESSION['full_name']       = $usuario_valido['full_name'];
        $_SESSION['email']           = $usuario_valido['email_acc'];
        $_SESSION['rol']             = (int)$usuario_valido['role_id'];
        $_SESSION['rol_nombre']      = $usuario_valido['name_rol'] ?? '';
        $_SESSION['area']            = $usuario_valido['area'] ?? '';

        // NUEVOS
        $_SESSION['telefono']        = $usuario_valido['telefono']  ?? '';
        $_SESSION['direccion']       = $usuario_valido['direccion'] ?? '';

        $_SESSION['mostrar_bienvenida'] = true;

        // ✅ Redirigir solo si tiene un rol permitido
        if (in_array((int)$usuario_valido['role_id'], [1, 2, 3, 4], true)) {
            header('Location: ../inAdmin.php');
        } else {
            header('Location: ../acceso-xz9x1d4.php?error=rol_no_valido');
        }
        exit;
    } else {
        header('Location: ../acceso-xz9x1d4.php?error=1');
        exit;
    }
}

}
