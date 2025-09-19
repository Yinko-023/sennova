<?php
require_once __DIR__ . '/../models/PubliModel.php';

class AdminController
{
    public function inicio()
    {
        if (!isset($_SESSION['usuario'])) {
            header('Location: acceso-xz9x1d4.php?controller=login&action=index');
            exit;
        }

        $userModel = new UserModel();
        $visitaModel = new Publicacion();
        $solicitudModel = new SolicitudModel();

        $areaSesion = $_SESSION['area'] ?? null;
        $resumen = $solicitudModel->obtenerResumenMensual($areaSesion);
        $usuarioTop = $solicitudModel->obtenerUsuarioMasActivo($areaSesion);

        // Registrar visita
        $ip = $_SERVER['REMOTE_ADDR'];
        $fecha = date('Y-m-d');
        $visitaModel->registrarVisita($ip, $fecha);

        $totalPublicaciones = $userModel->contarTodas();
        $totalArchivos = $userModel->contarArchivos();
        $totalUsuarios = $userModel->contarUsuarios();
        $totalVisitas = $visitaModel->contarVisitas();

        $busqueda = $_GET['buscar'] ?? '';
        $paginaActual = isset($_GET['pagina']) ? (int) $_GET['pagina'] : 1;
        $porPagina = 6;
        $inicio = ($paginaActual - 1) * $porPagina;

        $usuarios = $userModel->obtenerUsuariosConRol($inicio, $porPagina, $busqueda);
        $totalUsuarios = $userModel->contarUsuarios($busqueda);
        $totalPaginas = ceil($totalUsuarios / $porPagina);

        $vista = 'inicio';
        require __DIR__ . '/../views/admin.php';
    }

    public function formularioEditarUsuario($id)
    {
        $modelo = new UserModel();
        $usuario = $modelo->obtenerUsuarioPorId($id);

        if (!$usuario) {
            die("Usuario no encontrado");
        }

        require __DIR__ . '/../views/admin/editUser.php';
    }

    public function actualizarUsuario()
    {
        $id = $_POST['id'];
        $username = $_POST['username'];
        $full_name = $_POST['full_name'];
        $email = $_POST['email_acc'] ?? null;
        $password = !empty($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : null;
        $rol = $_POST['rol'] ?? null;
        $area = $_POST['area'] ?? null;

        // Lógica para forzar el área según el rol
        if ($rol == '1') {
            $area = null;
        } elseif ($rol != '3') {
            $area = 'visualizador';
        }

        $modelo = new UserModel();
        $modelo->actualizarUsuario($id, $username, $full_name, $email, $password, $rol, $area);

        header('Location: ../inAdmin.php?vista=inicio');
        exit;
    }

    public function verGestionProcesos()
    {
        require_once __DIR__ . '/../views/admin/gestion.php';
    }

    public function cargarVistaAjax($vista)
    {
        $ruta = __DIR__ . '/../views/admin/' . $vista . '.php';

        if (file_exists($ruta)) {
            require_once $ruta;
        } else {
            echo "<div class='alert alert-danger'>❌ Vista no encontrada: $vista</div>";
        }
    }
}
