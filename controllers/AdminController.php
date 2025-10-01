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

    $userModel      = new UserModel();
    $visitaModel    = new Publicacion();
    $solicitudModel = new SolicitudModel();

    // 🔹 Determinar área efectiva según rol
    $rol        = $_SESSION['rol']  ?? null;
    $areaSesion = $_SESSION['area'] ?? null;

    if ($rol == 1) {                 // Admin
        $areaFiltro = null;          // ve ambas áreas
    } elseif ($rol == 2) {           // Visualizador
        $areaFiltro = 'electronica'; // forzado a electrónica
    } else {                         // Publicador / Usuario limitado
        $areaFiltro = $areaSesion ?: null; // 'cafe' o 'electronica'
    }

    // 🔹 Resumen y usuario top filtrados por área
    $resumen    = $solicitudModel->obtenerResumenMensual($areaFiltro);
    $usuarioTop = $solicitudModel->obtenerUsuarioMasActivo($areaFiltro);

    // 🔸 Normaliza claves para la vista (mapea aceptadas/pendientes/rechazadas)
    $resumen = is_array($resumen) ? $resumen : [];
    $resumen['atendidas_num']  = (int)($resumen['aceptadas']  ?? 0);
    $resumen['rechazadas_num'] = (int)($resumen['rechazadas'] ?? 0);
    $resumen['pendientes_num'] = (int)($resumen['pendientes'] ?? 0);

    // Porcentajes para las barras
    $totalTmp = max(1, (int)($resumen['total'] ?? 0));
    $resumen['atendidas_pct']  = (int)round($resumen['atendidas_num']  * 100 / $totalTmp);
    $resumen['rechazadas_pct'] = (int)round($resumen['rechazadas_num'] * 100 / $totalTmp);
    // (Si necesitas porcentaje de pendientes en otro lado)
    $resumen['pendientes_pct'] = (int)round($resumen['pendientes_num'] * 100 / $totalTmp);

    // === Actividad reciente (solo desde requests) ===
    $pdo = conectaDb();              // obtiene PDO
    $limiteActividad = 8;
    $actividades = [];

    $params = [];
    $sql = "SELECT area, nombre, servicio, fecha_solicitud AS ts
            FROM requests";
    if (!is_null($areaFiltro)) {
        // rol 2 “visualizador” queda en electrónica
        $areaParam = ($areaFiltro === 'visualizador') ? 'electronica' : $areaFiltro;
        $sql .= " WHERE area = :area";
        $params[':area'] = $areaParam;
    }
    $sql .= " ORDER BY ts DESC LIMIT :lim";

    $st = $pdo->prepare($sql);
    foreach ($params as $k => $v) {
        $st->bindValue($k, $v);
    }
    $st->bindValue(':lim', $limiteActividad, PDO::PARAM_INT);
    $st->execute();

    foreach ($st->fetchAll(PDO::FETCH_ASSOC) as $r) {
        $actividades[] = [
            'ts'    => $r['ts'] ?? date('Y-m-d H:i:s'),
            'title' => 'Solicitud ' . ucfirst($r['area'] ?? 'general'),
            'text'  => 'Usuario: ' . ($r['nombre'] ?? 'N/A') . ' — ' . ($r['servicio'] ?? 'Servicio'),
            'type'  => 'request',
        ];
    }
    // === FIN actividad reciente ===

    // Registrar visita
    $ip = $_SERVER['REMOTE_ADDR'];
    $fecha = date('Y-m-d');
    $visitaModel->registrarVisita($ip, $fecha);

    $totalPublicaciones = $userModel->contarTodas();
    $totalArchivos      = $userModel->contarArchivos();
    $totalUsuarios      = $userModel->contarUsuarios();
    $totalVisitas       = $visitaModel->contarVisitas();

    $busqueda      = $_GET['buscar'] ?? '';
    $paginaActual  = isset($_GET['pagina']) ? (int) $_GET['pagina'] : 1;
    $porPagina     = 6;
    $inicio        = ($paginaActual - 1) * $porPagina;

    $usuarios      = $userModel->obtenerUsuariosConRol($inicio, $porPagina, $busqueda);
    $totalUsuarios = $userModel->contarUsuarios($busqueda);
    $totalPaginas  = ceil($totalUsuarios / $porPagina);

    // 🔹 Pasa $areaFiltro y $actividades a la vista
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
