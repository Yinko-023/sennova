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
            session_start();
            $_SESSION['usuario'] = $usuario_valido['id'];
            $_SESSION['nombre_usuario'] = $usuario_valido['full_name'];
            $_SESSION['rol'] = $usuario_valido['role_id'];
            $_SESSION['area'] = $usuario_valido['area'];
            $_SESSION['mostrar_bienvenida'] = true;

            // ✅ Redirigir solo si tiene un rol permitido
            if (in_array($usuario_valido['role_id'], [1, 2, 3, 4])) {
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
