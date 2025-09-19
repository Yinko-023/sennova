<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../models/PubliModel.php';
require_once __DIR__ . '/../conexion/conexion.php';

class PublicacionController
{

  public function mostrarFormulario()
  {
    $mensaje = '';
    require __DIR__ . '/../views/admin/supubli.php';
  }

  public function procesarFormulario()
  {
    $mensaje = '';

    // Obtener datos del formulario
    $titulo = $_POST['title'] ?? '';
    $contenido = $_POST['content'] ?? '';
    $categoria = $_POST['type'] ?? '';
    $lab_area = $_POST['lab_area'] ?? null;
    $fecha = $_POST['published_at'] ?? null;
    $destacada = isset($_POST['destacada']) ? 1 : 0;
    $is_active = isset($_POST['is_active']) ? 1 : 0;

    // Procesar imagen
    $nombreImagen = null;
    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
      $db = basename($_FILES['image']['name']);
      $nombreImagen = time() . '_' . $db;

      // Ruta del directorio donde se guardará la imagen
      $directorioDestino = realpath(__DIR__ . '/../img/');

      // Verificar si existe la carpeta, si no, intentar crearla
      if ($directorioDestino === false) {
        $directorioDestino = __DIR__ . '/../img/';
        if (!is_dir($directorioDestino)) {
          mkdir($directorioDestino, 0777, true);
        }
      }

      $rutaCompleta = $directorioDestino . DIRECTORY_SEPARATOR . $nombreImagen;

      if (!move_uploaded_file($_FILES['image']['tmp_name'], $rutaCompleta)) {
        $mensaje = "Error al subir la imagen.";
        header('Location: /sennova/inAdmin.php?vista=supubli&mensaje=guardado');
        exit;
      }
    }

    // Guardar en la base de datos
    $modelo = new PublicacionModel();
    $exito = $modelo->guardarPublicacion(
      $titulo,
      $contenido,
      $categoria,
      $destacada,
      $nombreImagen,
      $fecha,
      $is_active,
      $lab_area
    );

    if ($exito) {
      header('Location: /sennova/inAdmin.php?vista=supubli&mensaje=publicado');
    } else {
      header('Location: /sennova/inAdmin.php?vista=supubli&mensaje=error');
    }
    exit;
  }

  public function verCalidadCafe()
  {
    $modelo = new PublicacionModel();
    $publicaciones = $modelo->obtenerPublicacionesCafe();
    require 'views/calidad.php';
  }

  public function verElectronica()
  {
    $modelo = new PublicacionModel();
    $publications = $modelo->ObtenerElectronica();
    require 'views/electronica.php';
  }

  public function subir()
  {
    if (session_status() === PHP_SESSION_NONE) {
    }

    $titulo = $_POST['title_ar'];
    $descripcion = $_POST['description_ar'];
    $tipo = $_POST['type_ar'];
    $fecha = date('Y-m-d H:i:s');
    $user_id = $_SESSION['usuario'] ?? null;

    if (!$user_id) {
      header('Location: /sennova/inAdmin.php?vista=archivo&mensaje=error_auth');
      exit;
    }

    if (isset($_FILES['archivo']) && $_FILES['archivo']['error'] === 0) {
      $nombreOriginal = $_FILES['archivo']['name'];
      $tmp = $_FILES['archivo']['tmp_name'];
      $nombreNuevo = time() . '_' . basename($nombreOriginal);
      $ruta = 'public/archivos/' . $nombreNuevo;
      $rutaCompleta = __DIR__ . '/../' . $ruta;

      if (move_uploaded_file($tmp, $rutaCompleta)) {
        $modelo = new PublicacionModel();
        if ($modelo->guardar($titulo, $descripcion, $tipo, $fecha, $ruta, $nombreOriginal, $user_id)) {
          // ✅ Subido y guardado
          header('Location: /sennova/inAdmin.php?vista=archivo&mensaje=subido');
          exit;
        } else {
          // ❌ Error al guardar en la BD
          header('Location: /sennova/inAdmin.php?vista=archivo&mensaje=error_bd');
          exit;
        }
      } else {
        // ❌ No se movió el archivo
        header('Location: /sennova/inAdmin.php?vista=archivo&mensaje=error_mover');
        exit;
      }
    } else {
      // ❌ Archivo no válido
      header('Location: /sennova/inAdmin.php?vista=archivo&mensaje=error_archivo');
      exit;
    }
  }
}

class UserController
{
  private $model;

  public function __construct()
  {
    $this->model = new UserModel();
  }

  public function mostrarFormulario2()
  {
    $roles = $this->model->obtenerRolesActivos();
    header('Location: /sennova/inAdmin.php?vista=create&mensaje=guardado');
    exit;
  }

  public function registrarUsuario($username, $full_name, $email, $password, $rol, $area)
  {
    $modelo = new UserModel();

    // Forzar área según el rol
    if ($rol == '1') {
      $area = null; // Admin sin área
    } elseif ($rol != '3') {
      $area = 'visualizador'; // Para editor y usuario limitado
    }

    $hash = password_hash($password, PASSWORD_BCRYPT);
    $token = bin2hex(random_bytes(32));

    // Intentar registrar el usuario
    $resultado = $modelo->registrar($username, $full_name, $email, $hash, $rol, $area, $token);

    if ($resultado === 'correo_duplicado') {
      // Redirigir con mensaje de correo duplicado
      header('Location: /sennova/inAdmin.php?vista=create&mensaje=correo_en_uso');
      exit;
    }

    if ($resultado === true) {
      // Enviar correo de verificación
      $this->enviarCorreoVerificacion($email, $token);

      header('Location: /sennova/inAdmin.php?vista=create&mensaje=guardado');
      exit;
    }

    // Si llega aquí, ocurrió un error inesperado
    header('Location: /sennova/inAdmin.php?vista=create&mensaje=error');
    exit;
  }

  public function enviarCorreoVerificacion($email, $token)
  {
    $asunto = "Verifica tu correo en SENNOVA";
    $enlace = "http://localhost/sennova/verify.php?token=" . urlencode($token);

    $mensaje = "
        <h2>¡Gracias por registrarte!</h2>
        <p>Haz clic en el siguiente enlace para verificar tu correo:</p>
        <a href='$enlace'>$enlace</a>
        <p>Si tú no creaste esta cuenta, ignora este correo.</p>
    ";

    $cabeceras = "MIME-Version: 1.0\r\n";
    $cabeceras .= "Content-type: text/html; charset=UTF-8\r\n";
    $cabeceras .= "From: no-reply@sennova.com\r\n";

    return mail($email, $asunto, $mensaje, $cabeceras);
  }
}

class GestionController
{
  private $model;
  public function __construct()
  {
    $this->model = new GestionModel();
  }

  public function crear()
  {
    $nombre = trim($_POST['nombre'] ?? '');
    $rutaOriginal = trim($_POST['ruta'] ?? '');
    $color = $_POST['color'] ?? '#007bff';

    if ($nombre !== '' && $rutaOriginal !== '') {
      $ruta = strtolower(str_replace(' ', '_', $rutaOriginal));
      if (!str_ends_with($ruta, '.php')) {
        $ruta .= '.php';
      }

      $rutaConCarpeta = 'views/procesos/' . $ruta;

      $this->model->crearBoton($nombre, $rutaConCarpeta, $color);
      $this->crearArchivoSiNoExiste($ruta, $nombre);
    }

    header("Location: ../inAdmin.php?vista=gestion");
    exit();
  }

  public function eliminar()
  {
    $id = $_POST['id'] ?? null;
    $archivoRelativo = $_POST['archivo'] ?? null;

    if ($id !== null) {
      $this->model->eliminarBoton($id);
    }

    if ($archivoRelativo) {
      $rutaBase = dirname(__DIR__);
      $rutaArchivo = $rutaBase . '/' . $archivoRelativo;

      if (file_exists($rutaArchivo)) {
        unlink($rutaArchivo);
      }
    }

    header("Location: ../inAdmin.php?vista=gestion");
    exit();
  }
  private function crearArchivoSiNoExiste($ruta, $nombre)
  {
    $archivoSeguro = strtolower(str_replace(' ', '_', basename($ruta)));
    $archivo = __DIR__ . '/../views/procesos/' . $archivoSeguro;

    if (!file_exists($archivo)) {
      $contenido = <<<PHP
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

require_once '../../models/PubliModel.php';

\$model = new GestionModel();
\$idProceso = \$_GET['id_ges'] ?? null;

if (!\$idProceso) {
  echo "<div class='alert alert-danger'>❌ Proceso no especificado.</div>";
  exit;
}

\$proceso = \$model->obtenerPorId(\$idProceso);
if (!\$proceso) {
  echo "<div class='alert alert-danger'>❌ Proceso no encontrado.</div>";
  exit;
}

\$subprocesos = \$model->obtenerPorProceso(\$idProceso);
?>

<!-- Bootstrap & FontAwesome -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark fixed-top">
  <div class="container">
    <h2 class="navbar-brand mb-0">
      <i class="fas fa-project-diagram me-2" style="color: var(--accent-color);"></i>
      <?= htmlspecialchars(\$proceso['name_but']) ?>
    </h2>
    <a href="/sennova/inAdmin.php?vista=gestion" class="btn btn-outline-light">
      <i class="fas fa-arrow-left me-2"></i>Volver al Panel de Gestión
    </a>
  </div>
</nav>

<!-- Main Content -->
<div class="container py-section">
  <!-- FORMULARIO -->
  <?php if ((isset(\$_SESSION['rol']) && \$_SESSION['rol'] == 1) ||
    (isset(\$_SESSION['rol'], \$_SESSION['area']) && \$_SESSION['rol'] == 3 && \$_SESSION['area'] === 'electronica')
  ): ?>
    <div class="row justify-content-center mb-5">
      <div class="col-lg-10">
        <div class="card-form">
          <h4 class="fw-bold text-center mb-4">
            <i class="fas fa-plus-circle me-2" style="color: var(--accent-color);"></i>Crear Subproceso
          </h4>
          <form method="post" action="/sennova/routes/createProces.php" class="row g-3 align-items-end">
            <input type="hidden" name="id_proceso" value="<?= htmlspecialchars(\$idProceso) ?>">
            <input type="hidden" name="archivo_padre" value="<?= basename(__FILE__) ?>">

            <div class="col-md-5">
              <label class="form-label" style="color: #ffffff94;">Nombre del Subproceso</label>
              <input type="text" name="nombre_sub"
                class="form-control form-control-custom"
                required
                placeholder="Ej: Gestión Técnica">
            </div>

            <div class="col-md-5">
              <label class="form-label" style="color: #ffffff94;">Ruta del archivo</label>
              <input type="text" name="ruta_sub"
                class="form-control form-control-custom"
                required
                placeholder="Ej: gestionTecnica">
            </div>


            <div class="col-md-2">
              <button type="submit" name="crear_sub" class="btn btn-primary-custom w-100">
                <i class="fas fa-plus me-1"></i> Crear
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  <?php endif; ?>

  <!-- SUBPROCESOS -->
  <div class="text-center mb-5 px-content">
    <h2 class="fw-bold ">
      <i class="fas fa-folder me-2" style="color: var(--accent-color);"></i>Subprocesos del Módulo
    </h2>
    <p class="mt-5" style="color: #ffffff94;">Selecciona un subproceso para gestionar sus archivos</p>
  </div>

  <div class="row-cols-subprocess">
    <?php if (!empty(\$subprocesos)): ?>
      <?php foreach (\$subprocesos as \$sub): ?>
        <?php if (\$sub['Pro_padre'] === basename(__FILE__)): ?>
          <div class="card-subprocess text-center">
            <div class="mb-4">
              <i class="fas fa-folder-open fa-3x mb-3" style="color: var(--accent-color);"></i>
              <h5 class="fw-bold mb-2"><?= htmlspecialchars(\$sub['nombre_sub']) ?></h5>
              <p class="text-muted small mb-3"><?= htmlspecialchars(\$sub['ruta_sub']) ?></p>
            </div>

            <div class="mb-3">
              <a href="/sennova/views/procesos/sub/<?= htmlspecialchars(\$sub['ruta_sub']) ?>.php?id_proceso=<?= \$idProceso ?>"
                class="btn btn-primary-custom w-100">
                <i class="fas fa-sign-in-alt me-2"></i>Ingresar
              </a>
            </div>

            <?php if ((isset(\$_SESSION['rol']) && \$_SESSION['rol'] == 1) ||
              (isset(\$_SESSION['rol'], \$_SESSION['area']) && \$_SESSION['rol'] == 3 && \$_SESSION['area'] === 'electronica')
            ): ?>
              <div class="mt-2">
                <form method="post" action="/sennova/routes/createProces.php" class="d-inline">
                  <input type="hidden" name="id_sub" value="<?= \$sub['id_sub'] ?>">
                  <button type="submit" name="eliminar_sub"
                    class="btn btn-outline-danger btn-sm"
                    onclick="return confirm('¿Estás seguro de eliminar este subproceso?')">
                    <i class="fas fa-trash me-1"></i>Eliminar
                  </button>
                </form>
              </div>
            <?php endif; ?>
          </div>
        <?php endif; ?>
      <?php endforeach; ?>
    <?php else: ?>
      <div class="empty-state">
        <i class="fas fa-folder-open"></i>
        <h4 class="mb-3">No hay subprocesos registrados</h4>
        <p class="text-muted">Crea tu primer subproceso utilizando el formulario superior</p>
      </div>
    <?php endif; ?>
  </div>
</div>

<!-- Bootstrap Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<style>
  :root {
    --primary-color: #4361ee;
    --secondary-color: #3f37c9;
    --accent-color: #4895ef;
    --dark-bg: #121826;
    --card-bg: #1e293b;
    --text-light: #f8fafc;
    --text-muted: #94a3b8;
    --border-radius: 12px;
    --transition: all 0.3s ease;
  }

  body {
    font-family: 'Inter', sans-serif;
    background-color: var(--dark-bg);
    color: var(--text-light);
    padding-top: 80px;
    min-height: 100vh;
  }

  /* Navbar mejorado */
  .navbar {
    background-color: var(--card-bg) !important;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
    padding: 9px 0;
  }

  .navbar-brand {
    font-weight: 700;
    font-size: 1.4rem;
    letter-spacing: -0.5px;
  }

  /* Contenedor principal */
  .container {
    max-width: 1200px;
    margin: 0 auto;
  }

  /* Tarjetas de subprocesos */
  .card-subprocess {
    background: var(--card-bg);
    border-radius: var(--border-radius);
    border: 1px solid rgba(255, 255, 255, 0.05);
    padding: 25px;
    transition: var(--transition);
    height: 100%;
    position: relative;
    overflow: hidden;
  }

  .card-subprocess::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 4px;
    background: linear-gradient(90deg, var(--primary-color), var(--accent-color));
    opacity: 0;
    transition: var(--transition);
  }

  .card-subprocess:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.3);
  }

  .card-subprocess:hover::before {
    opacity: 1;
  }

  /* Botones */
  .btn-primary-custom {
    background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
    border: none;
    color: white;
    padding: 12px 25px;
    border-radius: 8px;
    font-weight: 500;
    transition: var(--transition);
  }

  .btn-primary-custom:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(67, 97, 238, 0.3);
    color: white;
  }

  .btn-outline-light {
    border: 2px solid var(--text-light);
    color: var(--text-light);
    padding: 5px 10px;
    border-radius: 30px;
    font-weight: 500;
    transition: var(--transition);
  }

  .btn-outline-light:hover {
    background: var(--text-light);
    color: var(--dark-bg);
    transform: translateY(-2px);
  }

  /* Formularios */
  .form-control-custom {
    background-color: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(255, 255, 255, 0.1);
    color: var(--text-light);
    padding: 12px 16px;
    border-radius: 8px;
    transition: var(--transition);
    color: white !important;
    background-color: transparent;
  }

  .form-control-custom::placeholder {
    color: rgba(255, 255, 255, 0.6) !important;
    /* Placeholder más suave */
  }

  .form-control-custom:focus {
    background-color: rgba(255, 255, 255, 0.08);
    border-color: var(--primary-color);
    box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.2);
    color: var(--text-light);

  }

  /* Títulos */
  .section-title {
    position: relative;
    padding-bottom: 15px;
    margin-bottom: 30px;
  }

  .section-title::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 60px;
    height: 4px;
    background: linear-gradient(90deg, var(--primary-color), var(--accent-color));
    border-radius: 2px;
  }

  /* Estado vacío */
  .empty-state {
    text-align: center;
    padding: 60px 20px;
    background-color: var(--card-bg);
    border-radius: var(--border-radius);
    border: 2px dashed rgba(255, 255, 255, 0.1);
  }

  .empty-state i {
    font-size: 4rem;
    color: var(--text-muted);
    margin-bottom: 20px;
  }

  /* Tarjeta de formulario */
  .card-form {
    background: linear-gradient(135deg, var(--card-bg), #233044);
    border-radius: var(--border-radius);
    border: 1px solid rgba(255, 255, 255, 0.05);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
    padding: 25px;
    margin-bottom: 30px;
  }

  /* Responsive Design */
  @media (max-width: 768px) {
    body {
      padding-top: 70px;
    }

    .navbar-brand {
      font-size: 1.2rem;
    }

    .section-title {
      font-size: 1.5rem;
    }

    .card-subprocess {
      padding: 20px;
    }

    .btn-primary-custom,
    .btn-outline-light {
      padding: 10px 20px;
      font-size: 0.9rem;
    }

    .card-form {
      padding: 20px;
    }
  }

  @media (max-width: 576px) {
    .navbar-brand {
      font-size: 1.1rem;
    }

    .section-title {
      font-size: 1.3rem;
    }

    .card-subprocess {
      padding: 15px;
    }

    .empty-state {
      padding: 40px 15px;
    }

    .empty-state i {
      font-size: 3rem;
    }

    .card-form {
      padding: 15px;
    }

    .form-control-custom {
      padding: 10px 12px;
    }
  }

  /* Ajustes específicos para espaciado */
  .py-section {
    padding: 3rem 0;
  }

  .px-content {
    padding: 0 15px;
  }

  @media (max-width: 768px) {
    .py-section {
      padding: 2rem 0;
    }

    .px-content {
      padding: 0 10px;
    }
  }

  /* Grid mejorado */
  .row-cols-subprocess {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 1.5rem;
    margin: 0 auto;
  }

  @media (max-width: 768px) {
    .row-cols-subprocess {
      grid-template-columns: 1fr;
      gap: 1rem;
    }
  }
</style>
PHP;

      file_put_contents($archivo, $contenido);
    }
  }

  // subprocesos
  public function crearsub()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['crear_sub'])) {
      $nombre = trim($_POST['nombre_sub'] ?? '');
      $ruta = trim($_POST['ruta_sub'] ?? '');
      $idProceso = intval($_POST['id_proceso'] ?? 0);
      $archivoPadre = trim($_POST['archivo_padre'] ?? null); // puede ser null

      if ($nombre && $ruta && $idProceso > 0) {
        $nombreArchivo = preg_replace('/[^a-zA-Z0-9_-]/', '', basename($ruta));
        $archivoGenerado = __DIR__ . '/../views/procesos/sub/' . $nombreArchivo . '.php';

        if (!file_exists($archivoGenerado)) {
          $codigoGenerado = <<<PHP

<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
require_once __DIR__ . '/../../../models/PubliModel.php';

\$id_proceso = \$_GET['id_proceso'] ?? \$_GET['id_ges'] ?? null;

if (!\$id_proceso) {
    echo "<div class='alert alert-danger'>❌ No se proporcionó el ID del proceso.</div>";
    exit;
}

\$archivoActual = basename(__FILE__, '.php');

\$gestion = new ArchivoModel();
\$subprocesoBD = \$gestion->buscarSubprocesoPorRuta(\$archivoActual, \$id_proceso);

if (!\$subprocesoBD) {
    echo "<div class='alert alert-danger'>⚠️ No se ha definido el subproceso (origen).</div>";
    exit;
}

\$origen = \$subprocesoBD['ruta_sub'];
\$archivoPadre = \$subprocesoBD['Pro_padre'];

\$volverURL = "/sennova/views/procesos/{\$archivoPadre}?id_ges={\$id_proceso}";

\$modelo = new ArchivoModel();
\$archivos = \$modelo->obtenerPorOrigen(\$origen);

function obtenerIcono(\$ext)
{
    \$ext = strtolower(\$ext);
    switch (\$ext) {
        case 'pdf':
            return '<i class="fas fa-file-pdf fa-3x text-danger mb-3"></i>';
        case 'doc':
        case 'docx':
            return '<i class="fas fa-file-word fa-3x text-primary mb-3"></i>';
        case 'xls':
        case 'xlsx':
            return '<i class="fas fa-file-excel fa-3x text-success mb-3"></i>';
        case 'jpg':
        case 'jpeg':
        case 'png':
        case 'gif':
            return '<i class="fas fa-file-image fa-3x text-warning mb-3"></i>';
        default:
            return '<i class="fas fa-file fa-3x text-secondary mb-3"></i>';
    }
}
?>
<!-- Estilos y recursos -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">


<!-- Navbar mejorado -->
<nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="background-color: var(--card-bg); box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);">
    <div class="container-fluid px-3 px-md-4 px-lg-5">
        <span class="navbar-brand fw-bold">
            <i class="fas fa-folder-open me-2" style="color: var(--accent-color);"></i>
            <a class="text-white" style="text-decoration: none;" href="/sennova/inAdmin.php?vista=gestion">
                <?= htmlspecialchars(ucfirst(\$origen)) ?>
            </a>
        </span>
        <a href="<?= \$volverURL ?>" class="btn btn-outline-light rounded-pill d-flex align-items-center">
            <i class="fas fa-arrow-left me-1 me-md-2"></i>
            <span class="d-none d-md-inline">Regresar</span>
        </a>
    </div>
</nav>

<!-- Contenido principal -->
<div class="container-fluid py-4 py-md-5">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-11">
            <!-- Encabezado -->
            <div class=" px-3 text-center">
                <h1 class="fw-bold mb-2">Archivos de <?= htmlspecialchars(ucfirst(\$origen)) ?></h1>
            </div>

            <!-- Sección de carga de archivos -->
            <?php if (
                isset(\$_SESSION['rol']) &&
                (
                    \$_SESSION['rol'] == 1 ||
                    (\$_SESSION['rol'] == 3 && isset(\$_SESSION['area']) && \$_SESSION['area'] === 'electronica')
                )
            ): ?>
                <p style="color: white;" class="mb-0 px-3 mt-5 text-center">
                    Gestiona los documentos relacionados con
                    <span style="color: var(--accent-color);">
                        <?= htmlspecialchars(\$origen) ?>
                    </span>
                </p>

                <div class="upload-section fade-in mt-4 mx-2 mx-md-3 text-center" data-aos="fade-up">
                    <div class="text-center">
                        <h5 class="mb-3 mb-md-4 d-flex align-items-center justify-content-center">
                            <i class="fas fa-cloud-upload-alt me-2" style="color: var(--accent-color);"></i>
                            Agregar nuevo archivo
                        </h5>
                    </div>
                    <form action="/sennova/routes/archiveSubproces.php?action=subir" method="POST" enctype="multipart/form-data" class="row g-2 g-md-3 align-items-end">
                        <div class="col-12 col-md-6">
                            <label for="archivoInput" class="form-label text-white small">Seleccionar archivo</label>
                            <input type="file" class="form-control custom-file-input" id="archivoInput" name="archivo" accept=".pdf,.doc,.docx,.xls,.xlsx,.jpg,.png" required>
                        </div>
                        <div class="col-md-4 d-none d-md-block">
                            <input type="hidden" name="origen" value="<?= htmlspecialchars(\$origen) ?>">
                            <input type="hidden" name="id_proceso" value="<?= htmlspecialchars(\$id_proceso) ?>">
                            <input type="hidden" name="subproceso" value="<?= htmlspecialchars(\$subproceso) ?>">
                        </div>
                        <div class="col-12 col-md-6 col-lg-2 mt-2 mt-md-0">
                            <button type="submit" class="btn btn-download w-100 d-flex align-items-center justify-content-center">
                                <i class="fas fa-upload me-1 me-md-2"></i>
                                <span>Subir</span>
                            </button>
                        </div>
                    </form>
                </div>
            <?php endif; ?>

            <!-- Lista de archivos -->
            <div class="mb-5 mt-4 mt-md-5 px-2 px-md-3">
                <h5 class="mb-3 mb-md-4 d-flex align-items-center px-1">
                    <i class="fas fa-files me-2" style="color: var(--accent-color);"></i>
                    Archivos disponibles
                    <span class="badge bg-primary ms-2"><?= count(\$archivos) ?></span>
                </h5>

                <?php if (!empty(\$archivos)): ?>
                    <div class="row g-3 g-md-4">
                        <?php foreach (\$archivos as \$index => \$archivo): ?>
                            <div class="col-12 col-sm-6 col-lg-4 fade-in delay-<?= (\$index % 3) + 1 ?>" data-aos="fade-up" data-aos-delay="<?= (\$index % 3) * 100 ?>">
                                <div class="file-card h-100 d-flex flex-column">
                                    <div class="text-center mb-2 mb-md-3">
                                        <?= obtenerIcono(\$archivo['extension_ar']) ?>
                                    </div>

                                    <h6 class="file-name text-center"><?= htmlspecialchars(\$archivo['name_ar']) ?></h6>

                                    <div class="mt-auto">
                                        <div class="d-flex justify-content-center gap-1 gap-md-2 flex-wrap">
                                            <a href="/sennova/routes/archiveSubproces.php?action=descargar&id=<?= \$archivo['id_ar'] ?>"
                                                class="btn btn-download">
                                                <i class="fas fa-download me-1"></i>Descargar
                                            </a>

                                            <button class="btn btn-view"
                                                onclick="mostrarVistaPrevia('<?= htmlspecialchars(\$archivo['ruta_ar']) ?>', '<?= strtolower(\$archivo['extension_ar']) ?>')">
                                                <i class="fas fa-eye me-1"></i>Ver
                                            </button>
                                            <?php if (
                                                isset(\$_SESSION['rol']) &&
                                                (
                                                    \$_SESSION['rol'] == 1 ||
                                                    (\$_SESSION['rol'] == 3 && isset(\$_SESSION['area']) && \$_SESSION['area'] === 'electronica')
                                                )
                                            ): ?>
                                                <a href="/sennova/routes/archiveSubproces.php?action=eliminar&id=<?= \$archivo['id_ar'] ?>&origen=<?= urlencode(\$origen) ?>"
                                                    class="btn btn-delete"
                                                    onclick="return confirm('¿Estás seguro de que deseas eliminar este archivo?')">
                                                    <i class="fas fa-trash me-1"></i>Eliminar
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="empty-state fade-in mx-2" data-aos="fade-up">
                        <i class="fas fa-folder-open"></i>
                        <h4 class="mb-2 mb-md-3">No hay archivos disponibles</h4>
                        <p class="text-white mb-0">Sube el primer archivo utilizando el formulario superior</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- Modal para vista previa -->
<div class="modal fade" id="modalVistaPrevia" tabindex="-1" aria-labelledby="vistaLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Vista Previa del Archivo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body p-0" id="vistaPreviaContenido" style="min-height: 400px;"></div>
        </div>
    </div>
</div>

<style>
    :root {
        --primary-color: #4361ee;
        --secondary-color: #3f37c9;
        --accent-color: #4895ef;
        --dark-bg: #121826;
        --card-bg: #1e293b;
        --text-light: #f8fafc;
        --text-muted: #94a3b8;
        --border-radius: 12px;
        --transition: all 0.3s ease;
    }

    body {
        font-family: 'Inter', sans-serif;
        background-color: var(--dark-bg);
        color: var(--text-light);
        padding-top: 80px;
        min-height: 100vh;
        margin: 0;
        display: flex;
        flex-direction: column;
    }

    main {
        flex: 1;
        padding-bottom: 20px;
    }

    .navbar-brand {
        font-weight: 700;
        letter-spacing: -0.5px;
    }

    .page-title {
        position: relative;
        padding: 20px 0;
        margin-bottom: 30px;
    }

    .page-title::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 60px;
        height: 4px;
        background: linear-gradient(90deg, var(--primary-color), var(--accent-color));
        border-radius: 2px;
    }

    .upload-section {
        background: linear-gradient(135deg, var(--card-bg), #233044);
        border-radius: var(--border-radius);
        padding: 20px;
        margin-bottom: 30px;
        border: 1px solid rgba(255, 255, 255, 0.05);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
    }

    .file-card {
        background-color: var(--card-bg);
        border-radius: var(--border-radius);
        padding: 20px;
        height: 100%;
        transition: var(--transition);
        border: 1px solid rgba(255, 255, 255, 0.05);
        position: relative;
        overflow: hidden;
    }

    .file-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 4px;
        background: linear-gradient(90deg, var(--primary-color), var(--accent-color));
        opacity: 0;
        transition: var(--transition);
    }

    .file-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.3);
    }

    .file-card:hover::before {
        opacity: 1;
    }

    .file-icon {
        font-size: 2.5rem;
        margin-bottom: 15px;
        transition: var(--transition);
    }

    .file-card:hover .file-icon {
        transform: scale(1.1);
    }

    .file-name {
        font-weight: 600;
        font-size: 0.9rem;
        margin-bottom: 15px;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        height: 42px;
    }

    .btn-action {
        padding: 6px 12px;
        border-radius: 6px;
        font-weight: 500;
        font-size: 0.8rem;
        transition: var(--transition);
    }

    .btn-download {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        color: white;
        border: none;
    }

    .btn-download:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(67, 97, 238, 0.3);
        color: white;
    }

    .btn-view {
        background: rgba(255, 255, 255, 0.1);
        color: var(--text-light);
        border: 1px solid rgba(255, 255, 255, 0.1);
    }

    .btn-view:hover {
        background: rgba(255, 255, 255, 0.15);
        transform: translateY(-2px);
        color: var(--text-light);
    }

    .btn-delete {
        background: rgba(239, 68, 68, 0.1);
        color: #ef4444;
        border: 1px solid rgba(239, 68, 68, 0.2);
    }

    .btn-delete:hover {
        background: rgba(239, 68, 68, 0.2);
        transform: translateY(-2px);
        color: #ef4444;
    }

    .empty-state {
        text-align: center;
        padding: 40px 20px;
        background-color: var(--card-bg);
        border-radius: var(--border-radius);
        border: 2px dashed rgba(255, 255, 255, 0.1);
    }

    .empty-state i {
        font-size: 3rem;
        color: var(--text-muted);
        margin-bottom: 15px;
    }

    .custom-file-input {
        background-color: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
        color: var(--text-light);
        padding: 10px 12px;
        border-radius: 8px;
        font-size: 0.9rem;
    }

    .custom-file-input:focus {
        background-color: rgba(255, 255, 255, 0.08);
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.2);
        color: var(--text-light);
    }

    .modal-content {
        background-color: var(--card-bg);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: var(--border-radius);
    }

    .modal-header {
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    .btn-close {
        filter: invert(1);
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .fade-in {
        animation: fadeIn 0.5s ease forwards;
    }

    .delay-1 {
        animation-delay: 0.1s;
    }

    .delay-2 {
        animation-delay: 0.2s;
    }

    .delay-3 {
        animation-delay: 0.3s;
    }

    /* ======== RESPONSIVE DESIGN MEJORADO ======== */
    /* Pantallas grandes (PC) */
    @media (min-width: 1200px) {
        .container-fluid {
            max-width: 1200px;
            margin: 0 auto;
        }
    }

    /* Tabletas y pantallas medianas */
    @media (max-width: 992px) {
        body {
            padding-top: 70px;
        }

        .navbar .container-fluid {
            padding: 0 15px;
        }

        .page-title h1 {
            font-size: 1.8rem;
        }

        .upload-section {
            padding: 18px;
        }

        .file-card {
            padding: 18px;
        }

        .file-icon {
            font-size: 2.2rem;
        }

        .file-name {
            font-size: 0.85rem;
            height: 38px;
        }

        .btn-action {
            padding: 5px 10px;
            font-size: 0.75rem;
        }
    }

    /* Tabletas pequeñas y móviles grandes */
    @media (max-width: 768px) {
        body {
            padding-top: 60px;
        }

        .navbar-brand {
            font-size: 1rem;
        }

        .navbar-brand i {
            font-size: 1.1rem;
        }

        .btn-outline-light {
            padding: 6px 12px;
            font-size: 0.85rem;
        }

        .page-title h1 {
            font-size: 1.6rem;
            margin-bottom: 10px;
        }

        .page-title::after {
            width: 50px;
            height: 3px;
        }

        .upload-section {
            padding: 15px;
            margin-bottom: 25px;
        }

        .upload-section h5 {
            font-size: 1.1rem;
        }

        .file-card {
            padding: 15px;
            margin-bottom: 15px;
        }

        .file-icon {
            font-size: 2rem;
            margin-bottom: 12px;
        }

        .file-name {
            font-size: 0.82rem;
            height: 36px;
            margin-bottom: 12px;
        }

        .btn-action {
            padding: 5px 9px;
            font-size: 0.72rem;
        }

        .empty-state {
            padding: 30px 15px;
        }

        .empty-state i {
            font-size: 2.5rem;
        }

        .empty-state h4 {
            font-size: 1.2rem;
        }

        .modal-dialog {
            margin: 10px;
        }

        .modal-content iframe {
            height: 400px !important;
        }
    }

    /* Móviles medianos */
    @media (max-width: 576px) {
        body {
            padding-top: 60px;
        }

        .navbar .container-fluid {
            padding: 0 10px;
        }

        .navbar-brand {
            font-size: 0.9rem;
        }

        .btn-outline-light {
            padding: 5px 10px;
            font-size: 0.8rem;
        }

        .page-title h1 {
            font-size: 1.4rem;
        }

        .upload-section .row {
            flex-direction: column;
        }

        .upload-section .col-md-6,
        .upload-section .col-md-2 {
            width: 100%;
            margin-bottom: 10px;
        }

        .file-card {
            padding: 12px;
        }

        .file-icon {
            font-size: 1.8rem;
        }

        .file-name {
            font-size: 0.8rem;
            height: 34px;
        }

        .btn-action {
            padding: 4px 8px;
            font-size: 0.7rem;
        }

        .d-flex.gap-2 {
            flex-direction: column;
            gap: 8px !important;
        }

        .archivo-card .btn {
            width: 100%;
            justify-content: center;
        }

        .empty-state {
            padding: 25px 10px;
        }

        .empty-state i {
            font-size: 2rem;
        }

        .empty-state h4 {
            font-size: 1.1rem;
        }

        .empty-state p {
            font-size: 0.9rem;
        }

        .modal-content iframe {
            height: 350px !important;
        }
    }

    /* Móviles pequeños */
    @media (max-width: 400px) {
        .navbar-brand {
            font-size: 0.8rem;
        }

        .btn-outline-light {
            font-size: 0.75rem;
            padding: 4px 8px;
        }

        .page-title h1 {
            font-size: 1.3rem;
        }

        .upload-section {
            padding: 12px;
        }

        .upload-section h5 {
            font-size: 1rem;
        }

        .file-card {
            padding: 10px;
        }

        .file-icon {
            font-size: 1.6rem;
            margin-bottom: 10px;
        }

        .file-name {
            font-size: 0.75rem;
            height: 32px;
            margin-bottom: 10px;
        }

        .btn-action {
            padding: 4px 6px;
            font-size: 0.65rem;
        }

        .empty-state {
            padding: 20px 10px;
        }

        .empty-state i {
            font-size: 1.8rem;
        }

        .empty-state h4 {
            font-size: 1rem;
        }

        .empty-state p {
            font-size: 0.85rem;
        }

        .modal-content iframe {
            height: 300px !important;
        }
    }

    /* Ajustes específicos para el formulario de subida */
    @media (max-width: 768px) {
        .upload-section form {
            flex-direction: column;
        }

        .upload-section .col-md-6,
        .upload-section .col-md-2 {
            width: 100%;
            margin-bottom: 10px;
        }

        .upload-section .col-md-4 {
            display: none;
        }

        .upload-section button {
            margin-top: 10px;
        }
    }

    /* Ajustes para la cuadrícula de archivos */
    @media (max-width: 768px) {
        .row.g-4 {
            margin-left: -8px;
            margin-right: -8px;
        }

        .col-md-4 {
            padding-left: 8px;
            padding-right: 8px;
            margin-bottom: 16px;
        }
    }
</style>
<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    // Inicializar animaciones
    AOS.init({
        duration: 800,
        easing: 'ease-out-quad',
        once: true
    });

    // Función para mostrar vista previa
    function mostrarVistaPrevia(ruta, extension) {
        const contenido = document.getElementById("vistaPreviaContenido");
        contenido.innerHTML = '';
        const rutaCompleta = `/sennova/\${ruta}`;

        if (extension === 'pdf') {
            contenido.innerHTML = `<iframe src="\${rutaCompleta}" width="100%" height="400px" style="border: none; border-radius: 0 0 var(--border-radius) var(--border-radius);"></iframe>`;
        } else if (['jpg', 'jpeg', 'png', 'gif'].includes(extension)) {
            contenido.innerHTML = `
                <div style="display: flex; justify-content: center; align-items: center; height: 400px; background-color: #2d3748;">
                    <img src="\${rutaCompleta}" style="max-width: 100%; max-height: 100%;" alt="Vista previa">
                </div>`;
        } else {
            contenido.innerHTML = `
                <div class="text-center py-4" style="height: 400px; display: flex; flex-direction: column; justify-content: center; align-items: center;">
                    <i class="fas fa-file fa-4x mb-3" style="color: var(--text-muted);"></i>
                    <h4 class="mb-2">Vista previa no disponible</h4>
                    <p class="text-muted mb-3">Este tipo de archivo no puede visualizarse directamente.</p>
                    <a href="\${rutaCompleta}" class="btn btn-download" download>
                        <i class="fas fa-download me-2"></i>Descargar archivo
                    </a>
                </div>`;
        }

        const modal = new bootstrap.Modal(document.getElementById('modalVistaPrevia'));
        modal.show();
    }

    // Subida asíncrona de archivos
    document.addEventListener('DOMContentLoaded', () => {
        const form = document.querySelector('form[action="/sennova/routes/archiveSubproces.php?action=subir"]');
        if (form) {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                const formData = new FormData(this);

                fetch(this.action, {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Recargar la página para mostrar el nuevo archivo
                            location.reload();
                        } else {
                            alert('Error al subir el archivo: ' + (data.message || 'Error desconocido'));
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Error al subir el archivo');
                    });
            });
        }
    });
</script>
PHP;

          file_put_contents($archivoGenerado, $codigoGenerado);
        }

        // Guarda en BD
        $this->model->insertar($nombre, $ruta, $idProceso, $archivoPadre);

        // Redirige de nuevo a la página anterior
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
      }
    }
  }

  public function eliminarsub()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['eliminar_sub'])) {
      $id_sub = $_POST['id_sub'] ?? null;
      if ($id_sub) {
        $this->model->eliminarsub($id_sub);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
      }
    }
  }
}

class VersionController
{
  private $model;

  public function __construct()
  {
    $this->model = new VersionModel();
  }

  public function index()
  {
    $procesos = $this->model->getProcesosConVersiones();
    $versionesArchivadas = $this->model->getVersionesArchivadas();
    include 'views/admin/versiones.php';
  }

  public function guardarProceso()
  {
    if (!empty($_POST['nombre_proceso'])) {
      $this->model->crearProceso($_POST['nombre_proceso']);
    }
    header("Location: ../inAdmin.php?vista=versiones");
    exit;
  }

  public function guardarVersion()
  {
    if (!empty($_POST['id_proceso']) && !empty($_FILES['archivo_pdf'])) {
      $id_proceso = $_POST['id_proceso'];
      $codigo = trim($_POST['codigo']);
      $version = trim($_POST['version']);
      $anio = $_POST['anio'];
      $archivo = $_FILES['archivo_pdf'];

      $nombreArchivo = basename($archivo['name']);
      $rutaDestino = '../public/archivos/' . $nombreArchivo;

      if (!file_exists('../public/archivos')) {
        mkdir('../public/archivos', 0777, true);
      }

      if (move_uploaded_file($archivo['tmp_name'], $rutaDestino)) {
        $rutaBD = 'public/archivos/' . $nombreArchivo;
        $this->model->insertarVersion($id_proceso, $codigo, $nombreArchivo, $version, $anio, $rutaBD);
      } else {
        echo "No se pudo mover el archivo subido.";
        exit;
      }
    }

    header("Location: ../inAdmin.php?vista=versiones");
    exit;
  }

  public function eliminarVersion()
  {
    $id_version = $_POST['id'] ?? $_GET['id'] ?? null;

    if ($id_version) {
      $archivo = $this->model->obtenerRutaArchivo($id_version);

      if ($archivo && file_exists('../' . $archivo)) {
        unlink('../' . $archivo);
      }

      $this->model->eliminarVersion($id_version);
    }

    header("Location: ../inAdmin.php?vista=versiones");
    exit;
  }

  public function eliminarProceso()
  {
    if (isset($_POST['id'])) {
      $this->model->eliminarProceso($_POST['id']);
    } elseif (isset($_GET['id'])) {
      $this->model->eliminarProceso($_GET['id']); // compatibilidad con GET
    }

    header("Location: ../inAdmin.php?vista=versiones");
    exit;
  }

  // Nueva función para archivar (cambiar estado)


  public function archivarVersion()
  {
    if (!empty($_POST['id'])) {
      $id_version = $_POST['id'];
      $this->model->archivarVersion($id_version);
    }
    header("Location: ../inAdmin.php?vista=versiones");
    exit;
  }

  public function restaurarVersion()
  {
    if (!empty($_POST['id'])) {
      $id_version = $_POST['id'];
      $this->model->restaurarVersion($id_version);
    }
    header("Location: ../inAdmin.php?vista=versiones");
    exit;
  }
}

class SolicitudController
{
  public function guardarSolicitud()
  {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
      http_response_code(405);
      exit('Método no permitido');
    }

    // Sanitizar entradas
    $nombre   = trim($_POST['nombre'] ?? '');
    $empresa  = trim($_POST['empresa'] ?? '');
    $email    = trim($_POST['email'] ?? '');
    $telefono = trim($_POST['telefono'] ?? '');
    $servicio = trim($_POST['servicio'] ?? '');
    $desc     = trim($_POST['descripcion'] ?? '');
    $area     = $_POST['area'] ?? 'cafe';
    $redirect = $_POST['redirect'] ?? 'inElectronica.php';

    // Cedula: solo dígitos
    $cc_cliente = preg_replace('/\D+/', '', $_POST['cc_cliente'] ?? '');
    if ($cc_cliente === '') {
      // Cédula es obligatoria
      header("Location: /sennova/{$redirect}?error=CedulaRequerida");
      exit;
    }

    // Teléfono: solo dígitos (máx 10)
    $telefono = preg_replace('/\D+/', '', $telefono);
    if ($telefono !== '') {
      $telefono = substr($telefono, 0, 10);
    }

    // Reglas de contacto:
    // - Si ambos vienen vacíos -> error (debe haber al menos un medio de contacto)
    // - Si uno viene vacío -> lo guardamos como "Sin datos"
    $emailVacio = ($email === '');
    $telVacio   = ($telefono === '');

    if ($emailVacio && $telVacio) {
      header("Location: /sennova/{$redirect}?error=SinContacto");
      exit;
    }
    if ($emailVacio) {
      $email = 'Sin datos';
    }
    if ($telVacio) {
      $telefono = 'Sin datos';
    }

    // Armar datos para el modelo
    $datos = [
      'nombre'      => $nombre,
      'empresa'     => $empresa,
      'cc_cliente'  => $cc_cliente,   // <-- nuevo
      'email'       => $email,
      'telefono'    => $telefono,
      'servicio'    => $servicio,
      'descripcion' => $desc,
      'area'        => $area
    ];

    // Guardar
    $modelo = new SolicitudModel();
    try {
      $modelo->registrarSolicitud($datos);
      header("Location: /sennova/{$redirect}?exito=1");
      exit;
    } catch (Exception $e) {
      // Log si quieres: error_log($e->getMessage());
      header("Location: /sennova/{$redirect}?error=DB");
      exit;
    }
  }

  public function obtenerSolicitudesTodas($estado, $busqueda = '')
  {
    $model = new SolicitudModel();
    return $model->obtenerTodasLasSolicitudes($estado, $busqueda);
  }

  public function verNotificaciones($area)
  {
    $modelo = new SolicitudModel();
    return $modelo->obtenerNotificaciones($area);
  }

  public function contarNoLeidas($area)
  {
    $modelo = new SolicitudModel();
    return $modelo->contarNoLeidas($area);
  }

  public function marcarLeidas($area)
  {
    $modelo = new SolicitudModel();
    $modelo->marcarLeidas($area);
  }
  public function obtenerSolicitudesPorArea($estado, $area, $busqueda = '')
  {
    $modelo = new SolicitudModel();

    if ($estado === 'todas') {
      return $modelo->obtenerTodasPorArea($area, $busqueda);
    } else {
      return $modelo->obtenerPorArea($estado, $area, $busqueda);
    }
  }
  public function obtenerHistorial($area)
  {
    $desde = $_GET['desde'] ?? null;
    $hasta = $_GET['hasta'] ?? null;

    $model = new SolicitudModel();
    return $model->obtenerHistorialNotificaciones($area, $desde, $hasta);
  }
}

class ServicioElectronicaController
{
  private $modelo;

  public function __construct()
  {
    $this->modelo = new ServicioElectronicaModel();
  }

  // Mostrar todos los servicios en el panel admin
  public function listarServicios()
  {
    $servicios = $this->modelo->obtenerServicios();
    include __DIR__ . '/../views/admin/servi_elect.php';
  }

  // Guardar nuevo servicio
  // Guardar nuevo servicio
  public function guardarServicio()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      // Limpiar precio
      $precioRaw = $_POST['precio'];
      $precioLimpio = str_replace(['.', ','], ['', '.'], $precioRaw);

      $icono = null;
      // Revisar si se subió un archivo
      if (isset($_FILES['icono_ele']) && $_FILES['icono_ele']['error'] === UPLOAD_ERR_OK) {
        $nombreArchivo = time() . '_' . basename($_FILES['icono_ele']['name']);
        $rutaDestino = __DIR__ . '/../img/' . $nombreArchivo;

        if (move_uploaded_file($_FILES['icono_ele']['tmp_name'], $rutaDestino)) {
          $icono = $nombreArchivo;
        }
      }

      $datos = [
        'titulo' => $_POST['titulo'],
        'descripcion_corta' => $_POST['descripcion_corta'],
        'descripcion_larga' => $_POST['descripcion_larga'],
        'precio' => floatval($precioLimpio),
        'icono_ele' => $icono
      ];

      $this->modelo->crearServicio($datos);
      header('Location: ../inAdmin.php?vista=servicio&area=electronica');
      exit;
    }
  }

  // Editar servicio
  public function editarServicio()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_ele'])) {
      $id_ele = $_POST['id_ele'];

      // Obtener servicio actual para mantener icono si no se sube uno nuevo
      $servicioActual = $this->modelo->obtenerServicios($id_ele);
      $icono = $servicioActual['icono_ele'];

      // Limpiar precio
      $precioRaw = $_POST['precio'];
      $precioLimpio = str_replace(['.', ','], ['', '.'], $precioRaw);

      // Revisar si se subió un nuevo icono
      if (isset($_FILES['icono_ele']) && $_FILES['icono_ele']['error'] === UPLOAD_ERR_OK) {
        $nombreArchivo = time() . '_' . basename($_FILES['icono_ele']['name']);
        $rutaDestino = __DIR__ . '/../img/' . $nombreArchivo;

        if (move_uploaded_file($_FILES['icono_ele']['tmp_name'], $rutaDestino)) {
          $icono = $nombreArchivo; // Actualizar solo si se subió correctamente
        }
      }

      $datos = [
        'titulo' => $_POST['titulo'],
        'descripcion_corta' => $_POST['descripcion_corta'],
        'descripcion_larga' => $_POST['descripcion_larga'],
        'precio' => floatval($precioLimpio),
        'icono_ele' => $icono
      ];

      $this->modelo->actualizarServicio($id_ele, $datos);
      header('Location: ../inAdmin.php?vista=servicio&area=electronica');
      exit;
    }
  }


  // Eliminar un servicio
  public function eliminarServicio()
  {
    if (isset($_GET['id_ele'])) {
      $this->modelo->eliminarServicio($_GET['id_ele']);
      header('Location: ../inAdmin.php?vista=servicio&area=electronica');
      exit;
    }
  }
}

class ServicioCafeController
{
  private $modelo;

  public function __construct()
  {
    $this->modelo = new ServicioCafeModel();
  }

  public function guardarServi()
  {
    $datos = $this->procesarDatosFormulario();
    $this->modelo->crearServi($datos);
    header('Location: ../inAdmin.php?vista=servicio&area=cafe&mensaje=creado');
    exit;
  }

  public function editarServi()
  {
    $id_ca = $_POST['id_ca'];
    $datos = $this->procesarDatosFormulario();
    $this->modelo->actualizarServi($id_ca, $datos);
    header('Location: ../inAdmin.php?vista=servicio&area=cafe&mensaje=editado');
    exit;
  }

  public function eliminarServi()
  {
    if (isset($_GET['id_ca'])) {
      $this->modelo->eliminarServi($_GET['id_ca']);
      header('Location: ../inAdmin.php?vista=servicio&area=cafe&mensaje=eliminado');
      exit;
    }
  }

  private function procesarDatosFormulario()
  {
    $titulo_ca = $_POST['titulo_ca'] ?? '';
    $precioFormateado = $_POST['precio_ca'] ?? '';
    $des_corta = $_POST['des_corta'] ?? '';
    $des_larga = $_POST['des_larga'] ?? '';

    // Convertir precio
    $precioLimpio = str_replace(['$', ' ', '.', ','], ['', '', '', '.'], $precioFormateado);
    $precioDecimal = floatval($precioLimpio);

    // Manejar imagen
    $icono_ca = $_POST['icono_actual'] ?? null;
    if (isset($_FILES['icono_ca']) && $_FILES['icono_ca']['error'] === UPLOAD_ERR_OK) {
      $nombreTmp = $_FILES['icono_ca']['tmp_name'];
      $nombreOriginal = basename($_FILES['icono_ca']['name']);
      $extension = strtolower(pathinfo($nombreOriginal, PATHINFO_EXTENSION));

      $tiposPermitidos = ['png', 'jpg', 'jpeg', 'svg'];
      if (in_array($extension, $tiposPermitidos)) {
        $nombreSeguro = uniqid('icono_', true) . '.' . $extension;
        $rutaDestino = '../img/' . $nombreSeguro;
        if (move_uploaded_file($nombreTmp, $rutaDestino)) {
          $icono_ca = $nombreSeguro;
        }
      }
    }

    return [
      'titulo_ca' => $titulo_ca,
      'precio_ca' => $precioDecimal,
      'des_corta' => $des_corta,
      'des_larga' => $des_larga,
      'icono_ca' => $icono_ca
    ];
  }
}

class CarruselController
{
  public function index()
  {
    $model = new CarruselModel();
    $slides = $model->obtenerImagenes();
    require '../views/admin/usuario.php';
  }

  public function agregarCarrusel()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['imagen'], $_POST['titulo'])) {
      $archivo = $_FILES['imagen'];
      $titulo = trim($_POST['titulo']);

      if ($archivo['error'] === 0 && !empty($titulo)) {
        $nombreOriginal = pathinfo($archivo['name'], PATHINFO_FILENAME); // sin extensión
        $extension = pathinfo($archivo['name'], PATHINFO_EXTENSION);

        // Obtener el ID más alto actual para generar un nuevo nombre numerado
        $model = new CarruselModel();
        $ultimoId = $model->obtenerUltimoId();

        $contador = str_pad($ultimoId + 1, 3, '0', STR_PAD_LEFT); // 001, 002, ...
        $nuevoNombre = $contador . $nombreOriginal . '.' . $extension;

        $carpeta = '../img/';
        $rutaServidor = $carpeta . $nuevoNombre;
        $rutaParaBD = 'img/' . $nuevoNombre;

        if (!file_exists($carpeta)) {
          mkdir($carpeta, 0777, true);
        }

        if (move_uploaded_file($archivo['tmp_name'], $rutaServidor)) {
          // Solo se guarda el título escrito y la ruta en la BD
          $model->agregarImagen($titulo, $rutaParaBD);
        } else {
          echo "❌ No se pudo mover el archivo.";
        }
      } else {
        echo "❌ Error en el archivo o título vacío.";
      }
    }

    header("Location: ../inAdmin.php?vista=usuario&editado=ok");
    exit;
  }



  public function eliminarCarrusel()
  {
    if (isset($_POST['id'])) {
      $model = new CarruselModel();
      $imagen = $model->obtenerImagenPorId($_POST['id']);

      if ($imagen) {
        $ruta = '../' . $imagen['title_carr']; // Ajusta la ruta al archivo (con ../ si estás dentro de /routes)

        // Elimina solo el archivo físico si existe
        if (file_exists($ruta)) {
          unlink($ruta);
        }

        // 🔸 Opcional: Elimina el registro de la base de datos (si no quieres mantener la referencia)
        $model->eliminarImagen($_POST['id']);
      }
    }

    header('Location: ../inAdmin.php?vista=usuario&editado=ok');
    exit;
  }
}

class VideoController
{

  public function subirVideo()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['video'])) {
      $area = $_POST['area'] ?? '';
      $titulo = $_POST['titulo'] ?? '';
      $texto1 = $_POST['texto_principal'] ?? '';
      $texto2 = $_POST['texto_secundario'] ?? '';

      $video = $_FILES['video'];
      $nombreOriginal = basename($video['name']);
      $rutaServidor = '../videos/' . $nombreOriginal; // ubicación real
      $rutaBaseDatos = 'videos/' . $nombreOriginal;    // ruta pública para el navegador

      if ($video['type'] === 'video/mp4' && move_uploaded_file($video['tmp_name'], $rutaServidor)) {
        $model = new VideoModel();
        $model->actualizarVideo($area, $rutaBaseDatos, $titulo, $texto1, $texto2);
      }
    }

    header("Location: ../inAdmin.php?vista=usuario&editado=ok");
    exit;
  }

  public function eliminar()
  {
    if (isset($_POST['area'])) {
      $area = $_POST['area'];
      $model = new VideoModel();
      $video = $model->obtenerVideoPorArea($area);

      if ($video && file_exists($video['ruta_video'])) {
        unlink($video['ruta_video']);
      }

      $model->eliminarVideoPorArea($area);
    }

    header("Location: ../inAdmin.php?vista=usuario&editado=ok");
    exit;
  }
}

class PortadaController
{

  public function subirPortada()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['imagen'])) {
      $area = $_POST['area'] ?? '';
      $titulo = $_POST['titulo'] ?? '';
      $descripcion = $_POST['descripcion'] ?? '';
      $imagen = $_FILES['imagen'];

      $nombre = basename($imagen['name']);
      $rutaDestino = 'img/' . $nombre;

      if ($imagen['error'] === 0 && move_uploaded_file($imagen['tmp_name'], '../' . $rutaDestino)) {
        $model = new PortadaModel();
        $model->actualizarPortada($area, $rutaDestino, $titulo, $descripcion);
      }
    }

    header("Location: ../inAdmin.php?vista=usuario&editado=ok");
    exit;
  }

  public function eliminarPortada()
  {
    if (isset($_POST['area'])) {
      $area = $_POST['area'];
      $model = new PortadaModel();
      $portada = $model->obtenerPortadaPorArea($area);

      if ($portada && file_exists('../' . $portada['ruta_img_port'])) {
        unlink('../' . $portada['ruta_img_port']);
      }

      $model->eliminarPortadaPorArea($area);
    }

    header("Location: ../inAdmin.php?vista=usuario&editado=ok");
    exit;
  }
  public function mostrarPortadasAdmin()
  {
    $model = new PortadaModel();
    $portadas = $model->obtenerTodasLasPortadas();
    require '../views/admin/usuario.php';
  }
}

class EvaluacionController
{
  public static function create(): void
  {
    $title = 'Evaluación capacidad técnica – Electrónica (SENA)';
    require __DIR__ . '/../views/admin/maps.php';
  }
  /* ===================== GESTIÓN DE TCPDF ===================== */
  private static function ensureTcpdfLoaded(): void
  {
    // Busca autoload de Composer subiendo hasta 3 niveles
    $bases = [
      __DIR__,                                 // controllers/
      dirname(__DIR__),                        // raíz esperada (sennova/)
      dirname(__DIR__, 2),                     // un nivel más arriba
      dirname(__DIR__, 3),                     // por si cambió estructura
    ];

    $tried = [];

    foreach ($bases as $b) {
      $autoload = rtrim($b, '/\\') . '/vendor/autoload.php';
      $tried[] = $autoload;
      if (is_file($autoload)) {
        require_once $autoload;
        break;
      }
    }

    // Si aún no existe TCPDF, intenta con librerías locales en varias variantes
    if (!class_exists('TCPDF')) {
      // Raíces candidatas donde podrían estar las librerías
      $roots = array_unique([
        dirname(__DIR__),      // sennova/
        dirname(__DIR__, 2),   // proyecto/
        __DIR__,               // controllers/
      ]);

      $relPaths = [
        'librerias/tcpdf/tcpdf.php',
        'librerias/TCPDF/tcpdf.php',
        'librerias/tcpdf_min/tcpdf.php',
        'libreria/tcpdf/tcpdf.php',     // singular
        'libreria/TCPDF/tcpdf.php',
        'libreria/tcpdf_min/tcpdf.php',
      ];

      foreach ($roots as $root) {
        foreach ($relPaths as $rel) {
          $p = rtrim($root, '/\\') . '/' . $rel;
          $tried[] = $p;
          if (is_file($p)) {
            require_once $p;
            break 2;
          }
        }
      }
    }

    if (!class_exists('TCPDF')) {
      // Log útil para ver exactamente qué rutas probamos
      error_log("[TCPDF] No encontrado. Probé:\n- " . implode("\n- ", array_map('realpath', array_filter($tried, 'is_file'))));
      $msg = "TCPDF no está disponible. Revisé estas rutas:\n- " . implode("\n- ", $tried) .
        "\nSoluciones:\n" .
        "  a) Instala con Composer y asegúrate de subir vendor/:  composer require tecnickcom/tcpdf\n" .
        "  b) O coloca tcpdf.php en alguna de estas rutas locales (librerias/ o libreria/): tcpdf/, TCPDF/ o tcpdf_min/\n" .
        "  c) Si usas Composer, confirma que el vendor/autoload.php accesible coincide con la estructura actual.";
      throw new \RuntimeException($msg);
    }
  }
  /* ===================== ALMACENAMIENTO DE PDF Y REGISTRO ===================== */
  private static function persistGeneratedPdf(\TCPDF $pdf, string $suggestedName, string $formType, array $metadata = [], ?string $documentNumber = null): array
  {
    // 1) Preparar directorio destino: /public/pdfs/YYYY/MM
    $root = dirname(__DIR__); // sennova/
    $year = date('Y');
    $month = date('m');
    $targetDir = rtrim($root, '/\\') . '/public/Formul/' . $year . '/' . $month;
    if (!is_dir($targetDir)) {
      @mkdir($targetDir, 0775, true);
    }

    // 2) Nombre de archivo seguro y único
    // Normalizar nombre base del PDF
    $baseNorm = preg_replace('/[^A-Za-z0-9_\-\.]+/', '_', $suggestedName);
    if ($baseNorm === '' || strtolower(substr($baseNorm, -4)) !== '.pdf') {
      $baseNorm = 'documento.pdf';
    }
    $baseNoExt = preg_replace('/\.pdf$/i', '', $baseNorm);
    // Tomar solo dígitos de la cédula
    $cedula = $documentNumber ? preg_replace('/\D+/', '', (string)$documentNumber) : '';
    // Nombre final: <nombrepdf>-<cedula>.pdf
    $candidate = $baseNoExt . ($cedula !== '' ? ('-' . $cedula) : '') . '.pdf';
    $filename = $candidate;
    $fullPath = $targetDir . '/' . $filename;
    // Evitar colisiones manteniendo el patrón solicitado
    $suffix = 1;
    while (is_file($fullPath)) {
      $filename = $baseNoExt . ($cedula !== '' ? ('-' . $cedula) : '') . '-' . $suffix . '.pdf';
      $fullPath = $targetDir . '/' . $filename;
      $suffix++;
    }

    // 3) Guardar en disco (copia permanente)
    $pdf->Output($fullPath, 'F');

    // 4) Calcular metadatos
    $size = is_file($fullPath) ? filesize($fullPath) : 0;
    $hash = is_file($fullPath) ? hash_file('sha256', $fullPath) : null;
    $relativePath = '/sennova/public/Formul/' . $year . '/' . $month . '/' . rawurlencode($filename);

    // 5) Insertar en BD
    require_once __DIR__ . '/../conexion/conexion.php';
    $pdo = conectaDb();
    $area = isset($_SESSION['area']) ? $_SESSION['area'] : null;
    $userId = isset($_SESSION['id_usuario']) ? (int)$_SESSION['id_usuario'] : null;
    $original = $suggestedName;
    $mime = 'application/pdf';

    $stmt = $pdo->prepare('INSERT INTO generated_pdfs
      (filename, original_name, relative_path, mime_type, size_bytes, area, form_type, created_by_user, sha256_hash, metadata_json)
      VALUES (:filename, :original_name, :relative_path, :mime_type, :size_bytes, :area, :form_type, :created_by_user, :sha256_hash, :metadata_json)');
    $stmt->execute([
      ':filename' => $filename,
      ':original_name' => $original,
      ':relative_path' => $relativePath,
      ':mime_type' => $mime,
      ':size_bytes' => $size,
      ':area' => $area,
      ':form_type' => $formType,
      ':created_by_user' => $userId,
      ':sha256_hash' => $hash,
      ':metadata_json' => !empty($metadata) ? json_encode($metadata, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) : null,
    ]);

    return [
      'filename' => $filename,
      'full_path' => $fullPath,
      'relative_path' => $relativePath,
      'size' => $size,
      'sha256' => $hash,
    ];
  }
  /* ===================== ROUTER ===================== */
  public static function handle(): void
  {
    $action = $_POST['form_action'] ?? $_POST['action'] ?? $_POST['accion'] ?? '';


    switch ($action) {
      case 'solicitud':                  // Formulario 1 (Solicitud – TCPDF)
        self::storeCotizacion();
        break;

      case 'generate':                   // Formulario 2 (Evaluación – TCPDF)
        self::store();
        break;

      case 'cotizacion':                 // Formulario 3 (Cotización  – TCPDF)
        self::storeCotizacionF3();
        break;

      case 'generate_ot':                // Formulario 4 (Orden de Trabajo – TCPDF)
        self::storeOrdenTrabajo2();
        break;

      case 'generate_verificacion_pcb':  // Formulario 5 (Verificación de PCB – TCPDF)
        self::storeVerificacionPcb();
        break;

      case 'generate_verificacion_3d':   // Formulario 6 (Verificación 3D – TCPDF)
        self::storeVerificacion3D();
        return;

      case 'generate_continuidad':       // Formulario 7 (Verificación 3D – TCPDF)
        self::storeContinuidad();
        break;

      case 'generate_informe_servicio':  // Formulario 8 (Informe de Servicio – TCPDF)
        self::storeInformeServicio();
        break;

      case 'generate_satisfaccion':      // Formulario 9 (Encuesta de Satisfacción – TCPDF)
        self::storeEncuestaSatisfaccion();
        return;

      default:
        header('Location: /');
        exit;
    }
  }

  /* ===============  FORMULARIO 1 (SOLICITUD 2p – TCPDF)  ================= */
  private static function storeCotizacion(): void
  {
    self::ensureTcpdfLoaded();

    // ---------- 0) AUTO–INCREMENTO DEL CÓDIGO (PROPIO DE ESTE FORM) ----------
    $root = dirname(__DIR__, 2);
    $counterDir  = $root . '/sennova/storage/counters';
    $counterFile = $counterDir . '/solicitud.counter'; // <-- contador exclusivo del Form 1 (Solicitud)

    if (!is_dir($counterDir)) {
      @mkdir($counterDir, 0775, true);
    }

    $readCounter = function () use ($counterFile): int {
      if (!is_file($counterFile)) return 0;               // empieza en 0 -> siguiente será 001
      $v = @file_get_contents($counterFile);
      $n = is_string($v) ? (int)trim($v) : 0;
      return max(0, $n);
    };
    $saveCounter = function (int $n) use ($counterFile): void {
      @file_put_contents($counterFile, (string)max(0, $n), LOCK_EX);
    };
    $fmt3 = function (int $n): string {
      return sprintf('%03d', max(0, $n));
    };

    // Flags desde el formulario
    $advanceFlag = (($_POST['mode'] ?? '') === 'download') || (($_POST['mode'] ?? '') === 'print') || ((string)($_POST['advance_code'] ?? '') === '1');
    $resetFlag   = (string)($_POST['reset_code'] ?? '')   === '1'; // reinicia el contador

    // ---------- 1) Datos ----------
    $n_cliente = trim($_POST['n_cliente'] ?? '');
    $viaSel  = (array)($_POST['solicitud_via'] ?? []);
    $viaOtro = trim($_POST['solicitud_via_otro'] ?? '');
    $fecha   = $_POST['fecha'] ?? date('Y-m-d');


    // Si llega vacío, lo asignamos aquí (pero NO avanzamos salvo que venga advance_code=1)
    $nro     = trim($_POST['numero_solicitud'] ?? '');

    $tipos   = (array)($_POST['tipo_servicio'] ?? []);

    $razon   = trim($_POST['razon_social'] ?? '');
    $nit     = trim($_POST['nit_cc'] ?? '');
    $dir     = trim($_POST['direccion'] ?? '');
    $tel     = trim($_POST['telefono'] ?? '');
    $email   = trim($_POST['email'] ?? '');
    $dep     = trim($_POST['departamento'] ?? '');

    $descGral = (string)($_POST['descripcion_general'] ?? '');
    $reqFunc  = (string)($_POST['requerimientos_funcionales'] ?? '');
    $reqTec   = (string)($_POST['requerimientos_tecnicos'] ?? '');
    $reqMec   = (string)($_POST['req_mecanicos'] ?? '');
    $reqSoft  = (string)($_POST['req_software'] ?? '');
    $reqCom   = (string)($_POST['req_comunicacion'] ?? '');
    $reqNorm  = (string)($_POST['req_normativos'] ?? '');
    $reqVal   = (string)($_POST['req_validacion'] ?? '');
    $restr    = (string)($_POST['restricciones'] ?? '');

    $solicitante = trim($_POST['solicitante_nombre'] ?? '');
    $responsable = trim($_POST['responsable_nombre'] ?? '');

    // ---------- 1.1) Resolver código (nro) con reglas ----------
    if ($resetFlag) {
      // Reinicia y usa 001
      $saveCounter(0);
      $nro = $fmt3(1);
      if ($advanceFlag) {
        $saveCounter(1);
      }
    } else {
      $curr = $readCounter();
      if ($nro === '') {
        $nro = $fmt3($curr + 1);
        if ($advanceFlag) {
          $saveCounter($curr + 1);
        }
      } else {
        if ($advanceFlag) {
          $n = (int)$nro;
          if ($n > $curr) {
            $saveCounter($n);
          }
        }
      }
    }

    // PÁGINA 1 
    $P1 = [
      'fecha' => [38.0, 72.0, 35.0],
      'nro'   => [172.0, 72.0, 35.0],

      'via' => [
        'Telefónica'         => [17.2, 64.6],
        'Presencial'         => [46.9, 64.9],
        'Correo electrónico' => [76.3, 64.8],
        'Otro'               => [119.8, 64.8],
        'otro_text'          => [135.0, 62.3, 35.0],
      ],

      'tipo' => [
        'Diseño de tarjetas de circuito impreso'               => [16.1, 90.5],
        'Diseño de piezas 3D'                                  => [16.1, 96.0],
        'Impresión de piezas 3D'                               => [16.1, 101.4],
        'Montaje de componentes electrónicos'                  => [16.1, 106.5],
        'Fabricación de tarjetas de circuito impreso'          => [99.5, 90.5],
        'Transferencia de conocimientos y/o tecnologías'       => [99.5, 96.0],
        'Fabricación o integración de soluciones tecnológicas' => [99.5, 101.4],
      ],

      'cliente' => [
        'razon' => [18.0,  122.8, 160.0],
        'nit'   => [120.0, 122.8, 160.0],
        'dir'   => [18.0, 133.5, 160.0],
        'tel'   => [120.0, 133.8, 70.0],
        'email' => [18.0, 144.4, 70.0],
        'dep'   => [120.0, 144.6, 160.0],
      ],

      'areas' => [
        'descripcion' => [18.0, 157.0, 174.0, 20.0],
        'reqFunc'     => [18.0, 199.0, 174.0, 18.0],
        'reqTec'      => [18.0, 233.0, 174.0, 18.0], // último en P1
      ],
    ];

    // PÁGINA 2 (S2): desde REQ. MECÁNICOS → resto
    $P2 = [
      'areas' => [
        'reqMec'  => [18.0,  63.0, 174.0, 18.0],
        'reqSoft' => [18.0, 102.0, 174.0, 18.0],
        'reqCom'  => [18.0,  132.0, 174.0, 18.0],
        'reqNorm' => [18.0, 160.6, 174.0, 18.0],
        'reqVal'  => [18.0, 190.0, 174.0, 18.0],
        'restr'   => [18.0, 219.6, 174.0, 18.0],
      ],
      'firmas' => [
        'solicitante' => [35.9,  248.5, 70.0],
        'responsable' => [125.0, 248.5, 70.0],
      ],
    ];

    // ---------- 3) Fondos PNG (dos páginas) ----------
    $pick = function (array $cands) {
      foreach ($cands as $p) {
        if (is_file($p)) return $p;
      }
      return null;
    };
    $bg1 = $pick([$root . '/sennova/img/Plantillas/S1.png']);
    $bg2 = $pick([$root . '/sennova/img/Plantillas/S2.png']);

    // ---------- 4) PDF ----------
    $pdf = new \TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
    $pdf->setPrintHeader(false);
    $pdf->setPrintFooter(false);
    $pdf->SetMargins(0, 0, 0);
    $pdf->SetAutoPageBreak(false, 0);
    $pdf->SetFont('dejavusans', '', 10);

    // Helpers
    $T = function (array $xyw, string $txt, string $align = 'L') use ($pdf) {
      $x = $xyw[0] ?? 0.0;
      $y = $xyw[1] ?? 0.0;
      $w = $xyw[2] ?? 60.0;
      $pdf->SetXY($x, $y);
      $pdf->Cell($w, 5.0, $txt, 0, 0, $align, false, '', 0, false, 'T', 'M');
    };
    $M = function (array $xywh, string $txt) use ($pdf) {
      $x = $xywh[0] ?? 0.0;
      $y = $xywh[1] ?? 0.0;
      $w = $xywh[2] ?? 60.0;
      $h = $xywh[3] ?? 10.0;
      $pdf->SetXY($x, $y);
      $pdf->MultiCell($w, $h, $txt, 0, 'L', false, 1, '', '', true, 0, false, true, $h, 'T', true);
    };
    $C = function (array $xy, bool $on) use ($pdf) {
      $x = $xy[0] ?? 0.0;
      $y = $xy[1] ?? 0.0;
      $pdf->SetXY($x, $y);
      $pdf->SetFont('dejavusans', '', 12);
      $pdf->Cell(4.5, 4.5, $on ? '☒' : '', 0, 0, 'C', false, '', 0, false, 'M', 'M');
      $pdf->SetFont('dejavusans', '', 10);
    };

    /* ===== PÁGINA 1 (S1) ===== */
    $pdf->AddPage();
    if ($bg1) {
      $pdf->Image($bg1, 0, 0, 210, 297, '', '', '', false, 300);
    }

    // Cabecera
    $T($P1['fecha'], date('d-m-Y', strtotime($fecha)));
    $T($P1['nro'],   $nro);

    // Solicitud vía
    foreach (['Telefónica', 'Presencial', 'Correo electrónico', 'Otro'] as $lab) {
      if (!isset($P1['via'][$lab])) continue;
      $C($P1['via'][$lab], in_array($lab, $viaSel, true) || ($lab === 'Otro' && $viaOtro !== ''));
    }
    if ($viaOtro !== '' && isset($P1['via']['otro_text'])) {
      $T($P1['via']['otro_text'], $viaOtro);
    }

    // Tipo de servicio
    foreach ($P1['tipo'] as $label => $xy) {
      $C($xy, in_array($label, $tipos, true));
    }

    // Datos del cliente
    $T($P1['cliente']['razon'], $razon);
    $T($P1['cliente']['nit'],   $nit);
    $T($P1['cliente']['dir'],   $dir);
    $T($P1['cliente']['tel'],   $tel);
    $T($P1['cliente']['email'], $email);
    $T($P1['cliente']['dep'],   $dep);

    // Áreas multilínea
    $M($P1['areas']['descripcion'], $descGral);
    $M($P1['areas']['reqFunc'],     $reqFunc);
    $M($P1['areas']['reqTec'],      $reqTec);

    /* ===== PÁGINA 2 (S2) ===== */
    $pdf->AddPage();
    if ($bg2) {
      $pdf->Image($bg2, 0, 0, 210, 297, '', '', '', false, 300);
    }

    // Desde REQ. MECÁNICOS → resto
    $M($P2['areas']['reqMec'],  $reqMec);
    $M($P2['areas']['reqSoft'], $reqSoft);
    $M($P2['areas']['reqCom'],  $reqCom);
    $M($P2['areas']['reqNorm'], $reqNorm);
    $M($P2['areas']['reqVal'],  $reqVal);
    $M($P2['areas']['restr'],   $restr);

    // Firmas
    $T($P2['firmas']['solicitante'], $solicitante, 'C');
    $T($P2['firmas']['responsable'], ' ' . $responsable . ' ', 'C');

    // Salida
    $mode = $_POST['mode'] ?? 'download';
    $outMode = ($mode === 'print') ? 'I' : 'D';
    $baseName = preg_replace('/[^A-Za-z0-9_\-]/', '_', $razon);
    $fileName = "Solicitud_{$baseName}.pdf";
    $pdf->Output($fileName, $outMode);
    exit;
  }

  /* ===============  FORMULARIO 2 (EVALUACIÓN 2p – TCPDF)  ================= */
  public static function store(): void
  {
    $v = [
      'nombre' => trim($_POST['nombre'] ?? ''),
      'fecha'  => trim($_POST['fecha'] ?? date('Y-m-d')),
      'cel'    => trim($_POST['celular'] ?? ''),
      'obs'    => trim($_POST['observaciones'] ?? ''),
      'serviciosMarcados' => [],
      'itemsValores'      => [],
      'aprobado'          => null,
    ];

    if (!empty($_POST['servicio']) && is_array($_POST['servicio'])) {
      $v['serviciosMarcados'] = array_keys($_POST['servicio']);
    }

    foreach ($_POST as $k => $val) {
      if (preg_match('/^i_\d+_\d+$/', $k)) {
        $tmp = strtoupper(trim((string)$val));
        if ($tmp === 'N/A') $tmp = 'NA';
        if (!in_array($tmp, ['SI', 'NO', 'NA'], true)) $tmp = 'NA';
        $v['itemsValores'][$k] = $tmp;
      }
    }

    if (isset($_POST['aprobado'])) {
      $tmp = strtoupper((string)$_POST['aprobado']);
      if ($tmp === 'SI' || $tmp === 'NO') $v['aprobado'] = $tmp;
    }

    $root        = dirname(__DIR__, 2);
    $counterDir  = $root . '/sennova/storage/counters';

    $counterFile = $counterDir . '/form2_evaluacion.counter';

    if (!is_dir($counterDir)) {
      @mkdir($counterDir, 0775, true);
    }

    $readCounter = function () use ($counterFile): int {
      if (!is_file($counterFile)) return 0;  // empieza en 0; próximo mostrado será 001
      $v = @file_get_contents($counterFile);
      $n = is_string($v) ? (int)trim($v) : 0;
      return max(0, $n);
    };
    $saveCounter = function (int $n) use ($counterFile): void {
      @file_put_contents($counterFile, (string)max(0, $n), LOCK_EX);
    };
    $fmt3 = function (int $n): string {
      return sprintf('%03d', max(0, $n));
    };

    $advanceFlag = (string)($_POST['advance_code'] ?? '') === '1';
    $resetFlag   = (string)($_POST['reset_code']   ?? '') === '1';

    $postedCode  = trim((string)($_POST['numero_evaluacion'] ?? ''));

    if ($resetFlag) {
      $saveCounter(0);
      $v['codigo'] = $fmt3(1);
      if ($advanceFlag) {
        $saveCounter(1);
      }
    } else {
      $curr = $readCounter();

      if ($postedCode === '') {
        $proximo = $curr + 1;
        $v['codigo'] = $fmt3($proximo);
        if ($advanceFlag) {
          $saveCounter($proximo);
        }
      } else {
        $v['codigo'] = preg_replace('/\D+/', '', $postedCode); // solo dígitos
        if ($v['codigo'] === '') $v['codigo'] = $fmt3($curr + 1);
        if ($advanceFlag) {
          $n = (int)$v['codigo'];
          if ($n > $curr) $saveCounter($n);
        }
      }
    }

    self::renderEvaluacionConPlantilla_AutoCode($v);
  }
  private static function renderEvaluacionConPlantilla_AutoCode(array $v): void
  {
    self::ensureTcpdfLoaded();

    $base = dirname(__DIR__, 2);
    $bg1  = $base . '/sennova/img/Plantillas/P1.png';
    $bg2  = $base . '/sennova/img/Plantillas/P2.png';

    $COORDS = [
      'nombre' => [63.0, 61.5, 95.0],
      'fecha'  => [70.0, 67.5, 32.0],
      'cel'    => [155.0, 67.5, 30.0],
      'servicios' => [
        'servicio_diseno_pcb'      => [18.7,  81.2],
        'servicio_fabricacion_pcb' => [18.7,  86.8],
        'servicio_impresion_3d'    => [18.5,  92.5],
        'servicio_diseno_3d'       => [18.5,  98.0],
        'servicio_transferencia'   => [18.5, 103.6],
        'servicio_montaje'         => [18.5, 109.1],
        'servicio_integracion'     => [18.5, 114.6],
      ],
      'cols' => ['si' => 164.0, 'no' => 174.4, 'na' => 185.6],
      'items_p1' => [
        '1.1' => 143.9,
        '1.2' => 149.4,
        '1.3' => 155.0,
        '1.4' => 160.7,
        '2.1' => 171.5,
        '2.2' => 177.3,
        '2.3' => 182.5,
        '2.4' => 188.2,
        '2.5' => 193.6,
        '2.6' => 199.3,
        '2.7' => 204.8,
        '2.8' => 210.3,
        '2.9' => 215.8,
        '3.1' => 226.8,
        '3.2' => 236.8,
        '4.1' => 247.5,
        '4.2' => 253.1,
      ],
      'items_p2' => [
        '5.1' => 63.6,
        '5.2' => 73.3,
        '6.1' => 84.4,
        '6.2' => 94.2,
        '6.3' => 99.6,
        '6.4' => 105.4,
        '6.5' => 110.7,
        '7.1' => 123.2,
        '7.2' => 129.2,
        '7.3' => 135.0,
      ],
      'aprobado_si' => [46.8, 145.0],
      'aprobado_no' => [61.1, 145.0],
      'obs'         => [25.0, 157.0, 160.0, 30.0],
    ];

    $DEBUG = false;

    $pdf = new \TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
    $pdf->setPrintHeader(false);
    $pdf->setPrintFooter(false);
    $pdf->SetMargins(0, 0, 0);
    $pdf->SetAutoPageBreak(false, 0);
    $pdf->SetTitle('Evaluación de Capacidad Técnica');
    $pdf->SetFont('dejavusans', '', 10);

    $putText = function (float $x, float $y, string $txt, float $w = 60.0, string $align = 'L') use ($pdf) {
      $pdf->SetXY($x, $y);
      $pdf->Cell($w, 5.0, $txt, 0, 0, $align, false, '', 0, false, 'T', 'M');
    };
    $checkMark = function (float $x, float $y, bool $on) use ($pdf) {
      $pdf->SetXY($x, $y);
      $pdf->SetFont('dejavusans', '', 12);
      $pdf->Cell(4.5, 4.5, $on ? '☒' : '', 0, 0, 'C', false, '', 0, false, 'M', 'M');
    };
    $grid = function () use ($pdf) {
      $pdf->SetDrawColor(200, 200, 200);
      for ($x = 10; $x <= 200; $x += 10) $pdf->Line($x, 0, $x, 297);
      for ($y = 10; $y <= 290; $y += 10) $pdf->Line(0, $y, 210, $y);
      $pdf->SetDrawColor(0, 0, 0);
      $pdf->Rect(0, 0, 210, 297);
      $pdf->SetFont('helvetica', '', 6);
      for ($x = 10; $x <= 200; $x += 10) $pdf->Text($x + 0.5, 2, (string)$x);
      for ($y = 10; $y <= 290; $y += 10) $pdf->Text(2, $y - 0.5, (string)$y);
    };
    $getVal = function (string $code) use ($v): string {
      $k = 'i_' . str_replace('.', '_', $code);
      return $v['itemsValores'][$k] ?? '';
    };

    /* PÁGINA 1 */
    $pdf->AddPage();
    if (is_file($bg1)) $pdf->Image($bg1, 0, 0, 210, 297, '', '', '', false, 300);
    if ($DEBUG) $grid();

    [$x, $y, $w] = $COORDS['nombre'];
    $putText($x, $y, $v['nombre'] ?? '', $w);
    [$x, $y, $w] = $COORDS['fecha'];
    $putText($x, $y, (!empty($v['fecha']) ? date('d-m-Y', strtotime($v['fecha'])) : ''), $w);
    [$x, $y, $w] = $COORDS['cel'];
    $putText($x, $y, $v['cel'] ?? '', $w);

    foreach ($COORDS['servicios'] as $key => [$sx, $sy]) {
      $checkMark($sx, $sy, in_array($key, $v['serviciosMarcados'], true));
    }

    $siX = $COORDS['cols']['si'];
    $noX = $COORDS['cols']['no'];
    $naX = $COORDS['cols']['na'];
    foreach ($COORDS['items_p1'] as $code => $yy) {
      $val = $getVal($code);
      $checkMark($siX, $yy, $val === 'SI');
      $checkMark($noX, $yy, $val === 'NO');
      $checkMark($naX, $yy, $val === 'NA');
    }

    /* PÁGINA 2 */
    $pdf->AddPage();
    if (is_file($bg2)) $pdf->Image($bg2, 0, 0, 210, 297, '', '', '', false, 300);
    if ($DEBUG) $grid();

    foreach ($COORDS['items_p2'] as $code => $yy) {
      $val = $getVal($code);
      $checkMark($siX, $yy, $val === 'SI');
      $checkMark($noX, $yy, $val === 'NO');
      $checkMark($naX, $yy, $val === 'NA');
    }

    $checkMark($COORDS['aprobado_si'][0], $COORDS['aprobado_si'][1], ($v['aprobado'] ?? '') === 'SI');
    $checkMark($COORDS['aprobado_no'][0], $COORDS['aprobado_no'][1], ($v['aprobado'] ?? '') === 'NO');

    [$ox, $oy, $ow, $oh] = $COORDS['obs'];
    $pdf->SetFont('dejavusans', '', 10);
    $pdf->SetXY($ox, $oy);
    $pdf->MultiCell($ow, $oh, (string)$v['obs'], 0, 'L', false, 1, '', '', true, 0, false, true, $oh, 'T', true);

    $mode = $_POST['mode'] ?? 'download';
    $outMode = ($mode === 'print') ? 'I' : 'D';

    $rawName = (string)($v['nombre'] ?? '');
    $norm = $rawName;
    if (function_exists('iconv')) {
      $norm = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $norm);
    }
    $norm = preg_replace('/[^A-Za-z0-9_\-]+/', '_', $norm);
    $norm = trim($norm, '_');
    if ($norm === '') {
      $norm = 'sin_nombre';
    }

    $codigo = isset($v['codigo']) ? $v['codigo'] : '000';
    $fileName = "Evaluacion-CT_{$codigo}_{$norm}.pdf";

    $meta = [
      'nombre' => $v['nombre'],
      'fecha'  => $v['fecha'],
      'codigo' => $codigo,
    ];

    self::persistGeneratedPdf($pdf, $fileName, 'form2_evaluacion', $meta, null);
    $pdf->Output($fileName, $outMode);
    exit;
  }

  /* ===============  FORMULARIO 3 (COTIZACIÓN 1p – TCPDF)  ================= */
  private static function storeCotizacionF3(): void
  {
    while (ob_get_level()) {
      ob_end_clean();
    }
    self::ensureTcpdfLoaded();

    /* ========== 1) POST ========== */
    $sol_via       = trim((string)($_POST['solicitud_via'] ?? ''));
    $sol_via_otro  = trim((string)($_POST['solicitud_via_otro'] ?? ''));

    $fecha         = (string)($_POST['fecha'] ?? date('Y-m-d'));
    $cot_no        = trim((string)($_POST['cotizacion_no'] ?? ''));   // ← se usará con autoincremento
    $comp_no       = trim((string)($_POST['comprobante_no'] ?? ''));

    $razon_social  = trim((string)($_POST['razon_social'] ?? ''));
    $nit_cc        = trim((string)($_POST['nit_cc'] ?? ''));
    $direccion     = trim((string)($_POST['direccion'] ?? ''));
    $telefono      = trim((string)($_POST['telefono'] ?? ''));
    $correo        = trim((string)($_POST['correo'] ?? ''));
    $municipio     = trim((string)($_POST['municipio'] ?? ''));

    $tipo_cliente      = trim((string)($_POST['tipo_cliente'] ?? ''));
    $tipo_cliente_otro = trim((string)($_POST['tipo_cliente_otro'] ?? ''));

    $item_num  = $_POST['item_num']  ?? [];
    $item_desc = $_POST['item_desc'] ?? [];
    $item_cant = $_POST['item_cant'] ?? [];
    $item_vu   = $_POST['item_vu']   ?? [];

    $observaciones = (string)($_POST['observaciones'] ?? '');
    $acepta_nombre = trim((string)($_POST['acepta_nombre'] ?? ''));

    // Normalizar ítems (máx 4)
    $items = [];
    for ($i = 0; $i < 4; $i++) {
      $desc = trim((string)($item_desc[$i] ?? ''));
      $cant = (float)($item_cant[$i] ?? 0);
      $vu   = (float)($item_vu[$i]   ?? 0);
      if ($desc === '' && $cant <= 0 && $vu <= 0) continue;
      $items[] = [
        'num'  => trim((string)($item_num[$i] ?? ($i + 1))),
        'desc' => $desc,
        'cant' => $cant,
        'vu'   => $vu,
        'vt'   => $cant * $vu,
      ];
    }
    $total_calc = array_sum(array_column($items, 'vt'));

    /* ========== 1.1) AUTOINCREMENTO (Form 3) ========== */
    $root        = dirname(__DIR__, 2);
    $counterDir  = $root . '/sennova/storage/counters';
    $counterFile = $counterDir . '/form3_cotizacion.counter'; // ← contador exclusivo F3

    if (!is_dir($counterDir)) {
      @mkdir($counterDir, 0775, true);
    }
    $readCounter = function () use ($counterFile): int {
      if (!is_file($counterFile)) return 0; // empieza en 0 → mostrará 001
      $v = @file_get_contents($counterFile);
      $n = is_string($v) ? (int)trim($v) : 0;
      return max(0, $n);
    };
    $saveCounter = function (int $n) use ($counterFile): void {
      @file_put_contents($counterFile, (string)max(0, $n), LOCK_EX);
    };
    $fmt3 = function (int $n): string {
      return sprintf('%03d', max(0, $n));
    };

    $advanceFlag = (string)($_POST['advance_code'] ?? '') === '1'; // avanza/consume
    $resetFlag   = (string)($_POST['reset_code']   ?? '') === '1'; // reinicia

    if ($resetFlag) {
      // Reinicia a 001
      $saveCounter(0);
      $cot_no = $fmt3(1);
      if ($advanceFlag) {
        $saveCounter(1); // consume 001
      }
    } else {
      $curr = $readCounter();
      if ($cot_no === '') {
        // No llega número → proponemos siguiente
        $next = $curr + 1;
        $cot_no = $fmt3($next);
        if ($advanceFlag) {
          $saveCounter($next);
        }
      } else {
        // Llega número → normalizamos a 3 dígitos; si advance y es mayor, actualizamos contador
        $digits = preg_replace('/\D+/', '', $cot_no);
        if ($digits === '') {
          $cot_no = $fmt3($curr + 1);
          if ($advanceFlag) $saveCounter($curr + 1);
        } else {
          $n = (int)$digits;
          $cot_no = $fmt3($n);
          if ($advanceFlag && $n > $curr) {
            $saveCounter($n);
          }
        }
      }
    }

    /* ========== 2) Layout / Coordenadas ========== */
    $MAP = [
      'fecha'    => [38, 77],
      'cot_no'   => [105, 77],
      'comp_no'  => [167, 77],

      'via_telefonica' => [18.3, 67.9],
      'via_presencial' => [53, 68.5],
      'via_correo'     => [95.3, 68.5],
      'via_otro_chk'   => [137.9, 68.5],
      'via_otro_txt'   => [153, 65.5],

      'razon_social' => [20, 100.7],
      'nit_cc'       => [120, 100.7],
      'direccion'    => [20, 111.9],
      'telefono'     => [120, 111.9],
      'correo'       => [20, 122.4],
      'municipio'    => [120, 122.4],

      'tipo_aprendiz'    => [16.9, 138.8],
      'tipo_emprendedor' => [16.9, 144.3],
      'tipo_natural'     => [116.3, 138.8],
      'tipo_juridica'    => [16.9, 149.8],
      'tipo_proyectos'   => [116.3, 144.3],
      'tipo_otro_chk'    => [116.3, 151.2],
      'tipo_otro_txt'    => [131, 148.8],

      'items' => [
        'start_y' => 172,
        'row_h'   => 11,
        'cols'    => [
          'num'  => [19, 10],
          'desc' => [32, 80],
          'cant' => [117, 20],
          'vu'   => [142, 25],
          'vt'   => [165, 25],
        ]
      ],

      'total'         => [155, 229.5],
      'obs'           => [20, 216.5, 170, 26],
      'acepta_nombre' => [46, 250],
      'firma_line'    => [30, 210, 80],
    ];

    $money = static fn($n) => '$' . number_format((float)$n, 0, ',', '.');

    /* ========== 3) TCPDF ========== */
    $pdf = new \TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
    $pdf->setPrintHeader(false);
    $pdf->setPrintFooter(false);
    $pdf->SetMargins(0, 0, 0);
    $pdf->SetAutoPageBreak(false, 0);
    $pdf->SetTitle('Cotización');
    $pdf->SetFont('dejavusans', '', 10);
    $pdf->AddPage();

    // Fondo
    $bgPath = dirname(__DIR__, 2) . '/sennova/img/Plantillas/C1.png';
    if (is_file($bgPath)) {
      $pdf->Image($bgPath, 0, 0, 210, 297, '', '', '', false, 300);
    }

    // Helpers
    $putText = function (float $x, float $y, string $txt, float $w = 60.0, string $align = 'L') use ($pdf) {
      $pdf->SetXY($x, $y);
      $pdf->Cell($w, 5.0, $txt, 0, 0, $align, false, '', 0, false, 'T', 'M');
    };
    $checkMark = function (float $x, float $y, bool $on) use ($pdf) {
      $pdf->SetXY($x, $y);
      $pdf->SetFont('dejavusans', '', 12);
      $pdf->Cell(4.5, 4.5, $on ? '☒' : '', 0, 0, 'C', false, '', 0, false, 'M', 'M');
    };

    /* ========== 4) Pintado ========== */
    // Encabezado
    $putText($MAP['fecha'][0],   $MAP['fecha'][1],   date('d/m/Y', strtotime($fecha)));
    $putText($MAP['cot_no'][0],  $MAP['cot_no'][1],  $cot_no);     // ← aquí va el autoincremento
    $putText($MAP['comp_no'][0], $MAP['comp_no'][1], $comp_no);

    // Vía de solicitud
    $checkMark($MAP['via_telefonica'][0], $MAP['via_telefonica'][1], $sol_via === 'Telefónica');
    $checkMark($MAP['via_presencial'][0], $MAP['via_presencial'][1], $sol_via === 'Presencial');
    $checkMark($MAP['via_correo'][0],     $MAP['via_correo'][1],     $sol_via === 'Correo electrónico');
    $checkMark($MAP['via_otro_chk'][0],   $MAP['via_otro_chk'][1],   $sol_via === 'Otro');
    if ($sol_via === 'Otro' && $sol_via_otro !== '') {
      $putText($MAP['via_otro_txt'][0], $MAP['via_otro_txt'][1], $sol_via_otro);
    }

    // Datos del cliente
    $putText($MAP['razon_social'][0], $MAP['razon_social'][1], $razon_social);
    $putText($MAP['nit_cc'][0],       $MAP['nit_cc'][1],       $nit_cc);
    $putText($MAP['direccion'][0],    $MAP['direccion'][1],    $direccion);
    $putText($MAP['telefono'][0],     $MAP['telefono'][1],     $telefono);
    $putText($MAP['correo'][0],       $MAP['correo'][1],       $correo);
    $putText($MAP['municipio'][0],    $MAP['municipio'][1],    $municipio);

    // Tipo de cliente
    $checkMark($MAP['tipo_aprendiz'][0],    $MAP['tipo_aprendiz'][1],    $tipo_cliente === 'Aprendiz');
    $checkMark($MAP['tipo_emprendedor'][0], $MAP['tipo_emprendedor'][1], $tipo_cliente === 'Emprendedor');
    $checkMark($MAP['tipo_natural'][0],     $MAP['tipo_natural'][1],     $tipo_cliente === 'Persona natural');
    $checkMark($MAP['tipo_juridica'][0],    $MAP['tipo_juridica'][1],    $tipo_cliente === 'Persona jurídica');
    $checkMark($MAP['tipo_proyectos'][0],   $MAP['tipo_proyectos'][1],   $tipo_cliente === 'Proyectos I+D+i');
    $checkMark($MAP['tipo_otro_chk'][0],    $MAP['tipo_otro_chk'][1],    $tipo_cliente === 'Otro');
    if ($tipo_cliente === 'Otro' && $tipo_cliente_otro !== '') {
      $putText($MAP['tipo_otro_txt'][0], $MAP['tipo_otro_txt'][1], $tipo_cliente_otro);
    }

    // Items
    $y = $MAP['items']['start_y'];
    foreach ($items as $r) {
      $pdf->SetFont('dejavusans', '', 10);
      $pdf->SetXY($MAP['items']['cols']['num'][0], $y);
      $pdf->Cell($MAP['items']['cols']['num'][1], 5, (string)$r['num'], 0, 0, 'C', false, '', 0, false, 'T', 'M');

      $pdf->SetFont('dejavusans', '', 8);
      $pdf->SetXY($MAP['items']['cols']['desc'][0], $y);
      $pdf->Cell($MAP['items']['cols']['desc'][1], 5, (string)$r['desc'], 0, 0, 'L', false, '', 0, false, 'T', 'M');

      $pdf->SetFont('dejavusans', '', 10);
      $pdf->SetXY($MAP['items']['cols']['cant'][0], $y);
      $pdf->Cell($MAP['items']['cols']['cant'][1], 5, (string)$r['cant'], 0, 0, 'R', false, '', 0, false, 'T', 'M');

      $pdf->SetFont('dejavusans', '', 8);
      $pdf->SetXY($MAP['items']['cols']['vu'][0], $y);
      $pdf->Cell($MAP['items']['cols']['vu'][1], 5, $money($r['vu']), 0, 0, 'R', false, '', 0, false, 'T', 'M');

      $pdf->SetXY($MAP['items']['cols']['vt'][0], $y);
      $pdf->Cell($MAP['items']['cols']['vt'][1], 5, $money($r['vt']), 0, 0, 'R', false, '', 0, false, 'T', 'M');

      $y += $MAP['items']['row_h'];
    }

    // Total y observaciones
    $pdf->SetFont('dejavusans', 'B', 10);
    $putText($MAP['total'][0], $MAP['total'][1], $money($total_calc), 30, 'L');
    $pdf->SetFont('dejavusans', '', 10);

    $pdf->SetXY($MAP['obs'][0], $MAP['obs'][1]);
    $pdf->MultiCell($MAP['obs'][2], $MAP['obs'][3], $observaciones, 0, 'L', false, 1, '', '', true, 0, false, true, $MAP['obs'][3], 'T', true);

    $putText($MAP['acepta_nombre'][0], $MAP['acepta_nombre'][1], $acepta_nombre);

    /* ========== 5) Salida ========== */
    $mode    = $_POST['mode'] ?? 'download';
    $outMode = ($mode === 'print') ? 'I' : 'D';

    $rawName = (string)($_POST['razon_social'] ?? '');
    $norm = $rawName;
    if (function_exists('iconv')) {
      $norm = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $norm);
    }
    $norm = preg_replace('/[^A-Za-z0-9_\-]+/', '_', $norm);
    $norm = trim($norm, '_');
    if ($norm === '') $norm = 'sin_nombre';

    // Si quieres incluir el código en el nombre del archivo, cambia a: "Cotizacion_{$cot_no}_{$norm}.pdf"
    $fileName = "Cotizacion_{$norm}.pdf";

    // Guarda con metadata (incluye cot_no)
    $meta = [
      'cot_no'       => $cot_no,
      'razon_social' => $razon_social,
      'fecha'        => $fecha,
    ];
    self::persistGeneratedPdf($pdf, $fileName, 'form3_cotizacion', $meta, $nit_cc);

    $pdf->Output($fileName, $outMode);
    exit;
  }

  /* ===============  FORMULARIO 4 (ORDEN DE TRABAJO 1p – TCPDF)  ================= */
  private static function storeOrdenTrabajo2(): void
  {
    while (ob_get_level()) {
      ob_end_clean();
    }

    self::ensureTcpdfLoaded();

    // ===== 0) AUTO–INCREMENTO DEL CÓDIGO (PROPIO DE ESTE FORM – F4) =====
    $root        = dirname(__DIR__, 2);
    $counterDir  = $root . '/sennova/storage/counters';
    $counterFile = $counterDir . '/orden_trabajo.counter'; // contador exclusivo F4

    if (!is_dir($counterDir)) {
      @mkdir($counterDir, 0775, true);
    }

    $readCounter = function () use ($counterFile): int {
      if (!is_file($counterFile)) return 0; // empieza en 0 -> siguiente será 001
      $v = @file_get_contents($counterFile);
      $n = is_string($v) ? (int)trim($v) : 0;
      return max(0, $n);
    };
    $saveCounter = function (int $n) use ($counterFile): void {
      @file_put_contents($counterFile, (string)max(0, $n), LOCK_EX);
    };
    $fmt3 = function (int $n): string {
      return sprintf('%03d', max(0, $n));
    };

    // Flags desde el formulario
    $advanceFlag = (string)($_POST['advance_code'] ?? '') === '1'; // avanza/consume el número
    $resetFlag   = (string)($_POST['reset_code']   ?? '') === '1'; // reinicia a 001

    // ===== 1) POST =====
    $numero   = trim($_POST['ot_numero'] ?? '');
    $fecha    = trim($_POST['ot_fecha'] ?? date('Y-m-d'));
    $noConf   = trim($_POST['ot_no_conformidad'] ?? '');

    $servSel  = array_keys($_POST['ot_servicio'] ?? []);
    $asignado = trim($_POST['ot_asignado'] ?? '');
    $activ    = (string)($_POST['ot_actividades'] ?? '');
    $emitido  = trim($_POST['ot_emitido_por'] ?? '');

    // ===== 1.1) Resolver número con las reglas =====
    if ($resetFlag) {
      // Reinicia y usa 001 en este envío
      $saveCounter(0);
      $numero = $fmt3(1);
      if ($advanceFlag) {
        // Consumimos 001 inmediatamente
        $saveCounter(1);
      }
    } else {
      $curr = $readCounter();
      if ($numero === '') {
        // Asignar siguiente (no se guarda a menos que advance=1)
        $numero = $fmt3($curr + 1);
        if ($advanceFlag) {
          $saveCounter($curr + 1);
        }
      } else {
        // Si viene uno manual y advance=1, aseguramos que el contador no retroceda
        $n = (int)preg_replace('/\D+/', '', $numero);
        if ($advanceFlag && $n > $curr) {
          $saveCounter($n);
        }
        // Normalizamos visualmente a 3 dígitos si es puramente numérico
        if (preg_match('/^\d+$/', $numero)) {
          $numero = $fmt3((int)$numero);
        }
      }
    }

    $materiales = [];
    $rawJson = $_POST['ot_materiales_json'] ?? '';

    $arr = null;
    if (is_string($rawJson) && $rawJson !== '') {
      $arr = json_decode($rawJson, true);
    }
    if (json_last_error() === JSON_ERROR_NONE && is_array($arr) && !empty($arr)) {
      foreach ($arr as $i => $m) {
        $nombre   = trim((string)($m['nombre'] ?? ''));
        $cantidad = trim((string)($m['cantidad'] ?? ''));
        $unidad   = trim((string)($m['unidad'] ?? ''));
        if ($nombre === '' && $cantidad === '' && $unidad === '') continue;

        $materiales[] = [
          'idx'      => count($materiales) + 1,
          'nombre'   => $nombre,
          'cantidad' => $cantidad,
          'unidad'   => $unidad,
        ];
      }
    } else {
      $nombres    = $_POST['ot_mat_nombre']   ?? [];
      $cantidades = $_POST['ot_mat_cantidad'] ?? [];
      $unidades   = $_POST['ot_mat_unidad']   ?? [];

      $max = max(count((array)$nombres), count((array)$cantidades), count((array)$unidades));
      $max = min($max, 6);

      for ($i = 0; $i < $max; $i++) {
        $nombre   = trim((string)($nombres[$i]    ?? ''));
        $cantidad = trim((string)($cantidades[$i] ?? ''));
        $unidad   = trim((string)($unidades[$i]   ?? ''));

        if ($nombre === '' && $cantidad === '' && $unidad === '') continue;

        $materiales[] = [
          'idx'      => count($materiales) + 1,
          'nombre'   => $nombre,
          'cantidad' => $cantidad,
          'unidad'   => $unidad,
        ];
      }
    }

    // ===== 2) Coordenadas =====
    // (A4: 210 x 297 mm)
    $COORDS = [
      'numero'  => [41.5, 64.5, 50.0],
      'nc_text' => [123.5, 64.5, 45.0],
      'fecha'   => [171.2, 64.4, 40.0],

      // Ticks “Tipo de servicio”
      'serv' => [
        'diseno_pcb'       => [11.6, 85.8],
        'fabricacion_pcb'  => [11.3, 91.1],
        'impresion_3d'     => [11.6, 96.0],
        'diseno_3d'        => [11.3, 101.4],
        'montaje'          => [100.5, 86.1],
        'transferencia'    => [100.5, 91.3],
        'integracion'      => [100.6, 96.5],
      ],

      'asignado' => [37.0, 105.0, 160.0],
      'activ'    => [37.0, 112.0, 163.0, 40.0],

      // Tabla de materiales
      'mat_cols' => ['idx' => 13.0, 'nombre' => 25.0, 'cant' => 158.0, 'unidad' => 188],
      'mat_y0'   => 145.0,
      'mat_rowh' => 12,
      'mat_max'  => 12,

      'emitido'  => [60.0, 260.0, 90.0],
    ];

    // ===== 3) Fondo =====
    $bg = null;
    foreach ([$root . '/sennova/img/Plantillas/OT1.png'] as $p) {
      if (is_file($p)) {
        $bg = $p;
        break;
      }
    }

    // ===== 4) TCPDF =====
    $pdf = new \TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
    $pdf->setPrintHeader(false);
    $pdf->setPrintFooter(false);
    $pdf->SetMargins(0, 0, 0);
    $pdf->SetAutoPageBreak(false, 0);
    $pdf->SetFont('dejavusans', '', 10);
    $pdf->SetTitle('Orden de Trabajo');

    // Helpers
    $T = function (array $xyw, string $txt, string $align = 'L') use ($pdf) {
      $x = $xyw[0] ?? 0.0;
      $y = $xyw[1] ?? 0.0;
      $w = $xyw[2] ?? 60.0;
      $pdf->SetXY($x, $y);
      $pdf->Cell($w, 5.0, $txt, 0, 0, $align, false, '', 0, false, 'T', 'M');
    };
    $M = function (array $xywh, string $txt) use ($pdf) {
      $x = $xywh[0] ?? 0.0;
      $y = $xywh[1] ?? 0.0;
      $w = $xywh[2] ?? 60.0;
      $h = $xywh[3] ?? 10.0;
      $pdf->SetXY($x, $y);
      $pdf->MultiCell($w, $h, $txt, 0, 'L', false, 1, '', '', true, 0, false, true, $h, 'T', true);
    };
    $C = function (array $xy, bool $on) use ($pdf) {
      $x = $xy[0] ?? 0.0;
      $y = $xy[1] ?? 0.0;
      $pdf->SetXY($x, $y);
      $pdf->SetFont('dejavusans', '', 12);
      $pdf->Cell(4.5, 4.5, $on ? '☒' : '', 0, 0, 'C', false, '', 0, false, 'M', 'M');
      $pdf->SetFont('dejavusans', '', 10);
    };

    $pdf->AddPage();
    if ($bg) $pdf->Image($bg, 0, 0, 210, 297, '', '', '', false, 300);

    // ===== 5) Pintado =====
    // Encabezado
    $T($COORDS['numero'], $numero);
    $T($COORDS['fecha'],  date('d-m-Y', strtotime($fecha)));
    $T($COORDS['nc_text'], $noConf ?: '');

    // Ticks de servicio
    foreach ($COORDS['serv'] as $k => $xy) {
      $C($xy, in_array($k, $servSel, true));
    }

    // Asignado / Actividades
    $T($COORDS['asignado'], $asignado);
    $M($COORDS['activ'],    $activ);

    // Tabla de materiales
    $y = $COORDS['mat_y0'];
    $r = 0;
    foreach ($materiales as $m) {
      if ($r >= $COORDS['mat_max']) break;

      $pdf->SetXY($COORDS['mat_cols']['idx'], $y);
      $pdf->Cell(10.0, 5.0, (string)$m['idx'], 0, 0, 'C');

      $pdf->SetXY($COORDS['mat_cols']['nombre'], $y);
      $pdf->Cell(112.0, 5.0, (string)$m['nombre'], 0, 0, 'L');

      $pdf->SetXY($COORDS['mat_cols']['cant'], $y);
      $pdf->Cell(16.0, 5.0, (string)$m['cantidad'], 0, 0, 'R');

      $pdf->SetXY($COORDS['mat_cols']['unidad'], $y);
      $pdf->Cell(18.0, 5.0, (string)$m['unidad'], 0, 0, 'L');

      $y += $COORDS['mat_rowh'];
      $r++;
    }

    $T($COORDS['emitido'], $emitido, 'C');

    // ===== 6) Salida =====
    $mode    = $_POST['mode'] ?? 'download';
    $outMode = ($mode === 'print') ? 'I' : 'D';
    $rawName = (string)($_POST['razon_social'] ?? '');
    $norm = $rawName;
    if (function_exists('iconv')) {
      $norm = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $norm);
    }
    $norm = preg_replace('/[^A-Za-z0-9_\-]+/', '_', $norm);
    $norm = trim($norm, '_');
    if ($norm === '') {
      $norm = 'sin_nombre';
    }

    $fileName = "OrdenTrabajo_{$norm}.pdf";
    $cc_para_nombre = preg_replace('/\D+/', '', (string)($_POST['nit_cc'] ?? ''));
    self::persistGeneratedPdf($pdf, $fileName, 'form4_orden_trabajo', [], $cc_para_nombre);
    $pdf->Output($fileName, $outMode);
    exit;
  }

  /* ===============  FORMULARIO 5 (VERIFICACION DISEÑO 1p – TCPDF)  ================= */
  public static function storeVerificacionPcb(): void
  {
    // Asegura TCPDF y limpia buffers
    while (ob_get_level()) {
      ob_end_clean();
    }
    self::ensureTcpdfLoaded();

    // ===== 0) AUTO–INCREMENTO (contador exclusivo F5) =====
    $root        = dirname(__DIR__, 2);
    $counterDir  = $root . '/sennova/storage/counters';
    $counterFile = $counterDir . '/verificacion_pcb.counter';

    if (!is_dir($counterDir)) {
      @mkdir($counterDir, 0775, true);
    }

    $readCounter = function () use ($counterFile): int {
      if (!is_file($counterFile)) return 0; // 0 => siguiente: 001
      $v = @file_get_contents($counterFile);
      $n = is_string($v) ? (int)trim($v) : 0;
      return max(0, $n);
    };
    $saveCounter = function (int $n) use ($counterFile): void {
      @file_put_contents($counterFile, (string)max(0, $n), LOCK_EX);
    };
    $fmt3 = function (int $n): string {
      return sprintf('%03d', max(0, $n));
    };

    // Flags desde el form
    $advanceFlag = (string)($_POST['advance_code'] ?? '') === '1'; // consumir/avanzar
    $resetFlag   = (string)($_POST['reset_code']   ?? '') === '1'; // reiniciar a 001

    // 1) Datos
    $vd = [
      'ot'      => trim($_POST['vd_ot'] ?? ''),
      'fecha'   => trim($_POST['vd_fecha'] ?? date('Y-m-d')),
      'aprob'   => isset($_POST['vd_aprobado']) ? strtoupper((string)$_POST['vd_aprobado']) : '',
      'obs'     => (string)($_POST['vd_observaciones'] ?? ''),
      'elaboro' => trim($_POST['vd_elaboro'] ?? ''),
      'aprobo'  => trim($_POST['vd_aprobo'] ?? ''),
      'items'   => []
    ];

    foreach ($_POST as $k => $val) {
      if (preg_match('/^vd_i_\d+_\d+$/', $k)) {
        $tmp = strtoupper(trim((string)$val));
        if ($tmp === 'N/A') $tmp = 'NA';
        if (!in_array($tmp, ['SI', 'NO', 'NA'], true)) $tmp = '';
        $vd['items'][$k] = $tmp;
      }
    }

    // 1.1) Resolver correlativo vd_ot con reglas
    if ($resetFlag) {
      $saveCounter(0);
      $num = $fmt3(1);
      if ($advanceFlag) $saveCounter(1); // consume 001
      $vd['ot'] = $num;
    } else {
      $curr = $readCounter();
      if ($vd['ot'] === '') {
        $num = $fmt3($curr + 1);
        if ($advanceFlag) $saveCounter($curr + 1);
        $vd['ot'] = $num;
      } else {
        // si viene manual y advance=1, evita retroceso del contador
        $n = (int)preg_replace('/\D+/', '', $vd['ot']);
        if ($advanceFlag && $n > $curr) $saveCounter($n);
        // normaliza si es puramente numérico
        if (preg_match('/^\d+$/', $vd['ot'])) {
          $vd['ot'] = $fmt3((int)$vd['ot']);
        }
      }
    }

    // 2) Recursos
    $base = dirname(__DIR__, 2);
    $bg1  = $base . '/sennova/img/Plantillas/V1.png';
    $bg2  = $base . '/sennova/img/Plantillas/V2.png';

    // 3) Coordenadas (mm)
    $COL = ['si' => 155.0, 'no' => 171.5, 'na' => 183.0, 7];

    // Encabezado (página 1)
    $C1 = [
      'ot'    => [80.0,  71.5, 40.0],
      'fecha' => [150.0, 71.5, 25.0],
    ];

    $P1Y = [
      '1.1' => 107.6,
      '1.2' => 115.5,
      '1.3' => 123.4,
      '1.4' => 131.4,
      '1.5' => 139.1,
      '1.6' => 146.7,
    ];

    $P1Y_MORE = [
      '2.1' => 186.1,
      '2.2' => 193.8,
      '2.3' => 201.6,
      '2.4' => 209.3,
      '2.5' => 217.2,
      '2.6' => 225,
      '2.7' => 232.7,
    ];

    $C2 = [
      'ap_si'  => [46.2, 63.5],
      'ap_no'  => [61.1, 63.5],
      'obs'    => [20.0, 80.3, 170.0, 30.0],
      'firmas' => [
        'elaboro' => [35.0, 127.0, 80.0],
        'aprobo'  => [35.0, 135.5, 80.0],
      ],
    ];

    // 4) TCPDF
    $pdf = new \TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
    $pdf->setPrintHeader(false);
    $pdf->setPrintFooter(false);
    $pdf->SetMargins(0, 0, 0);
    $pdf->SetAutoPageBreak(false, 0);
    $pdf->SetTitle('Verificación de PCB');
    $pdf->SetFont('dejavusans', '', 10);

    // Helpers
    $put = function (float $x, float $y, string $txt, float $w = 60.0, string $align = 'L') use ($pdf) {
      $pdf->SetXY($x, $y);
      $pdf->Cell($w, 5.0, $txt, 0, 0, $align, false, '', 0, false, 'T', 'M');
    };
    $mark = function (float $x, float $y, bool $on) use ($pdf) {
      $pdf->SetXY($x, $y);
      $pdf->SetFont('dejavusans', '', 11);
      $pdf->Cell(3.6, 3.6, $on ? '☒' : '', 0, 0, 'C', false, '', 0, false, 'M', 'M');
    };
    $get = function (string $code) use ($vd): string {
      $k = 'vd_i_' . str_replace('.', '_', $code);
      return $vd['items'][$k] ?? '';
    };

    // 5) Página 1
    $pdf->AddPage();
    if (is_file($bg1)) $pdf->Image($bg1, 0, 0, 210, 297, '', '', '', false, 300);

    // Encabezado
    $put($C1['ot'][0],    $C1['ot'][1],    $vd['ot'],                               $C1['ot'][2]);
    $put($C1['fecha'][0], $C1['fecha'][1], $vd['fecha'] ? date('d/m/Y', strtotime($vd['fecha'])) : '', $C1['fecha'][2]);

    // Ítems 1.1–1.6
    foreach ($P1Y as $code => $yy) {
      $v = $get($code);
      $mark($COL['si'], $yy, $v === 'SI');
      $mark($COL['no'], $yy, $v === 'NO');
      $mark($COL['na'], $yy, $v === 'NA');
    }

    // Ítems 2.1–2.7
    foreach ($P1Y_MORE as $code => $yy) {
      $v = $get($code);
      $mark($COL['si'], $yy, $v === 'SI');
      $mark($COL['no'], $yy, $v === 'NO');
      $mark($COL['na'], $yy, $v === 'NA');
    }

    // 6) Página 2
    $pdf->AddPage();
    if (is_file($bg2)) $pdf->Image($bg2, 0, 0, 210, 297, '', '', '', false, 300);

    // Aprobado
    $mark($C2['ap_si'][0], $C2['ap_si'][1], ($vd['aprob'] === 'SI'));
    $mark($C2['ap_no'][0], $C2['ap_no'][1], ($vd['aprob'] === 'NO'));

    // Observaciones
    $pdf->SetXY($C2['obs'][0], $C2['obs'][1]);
    $pdf->MultiCell($C2['obs'][2], $C2['obs'][3], $vd['obs'], 0, 'L', false, 1, '', '', true, 0, false, true, $C2['obs'][3], 'T', true);

    // Firmas
    $put($C2['firmas']['elaboro'][0], $C2['firmas']['elaboro'][1], $vd['elaboro'], $C2['firmas']['elaboro'][2], 'C');
    $put($C2['firmas']['aprobo'][0],  $C2['firmas']['aprobo'][1],  $vd['aprobo'],  $C2['firmas']['aprobo'][2],  'C');

    // 7) Salida
    $mode    = $_POST['mode'] ?? 'download';
    $outMode = ($mode === 'print') ? 'I' : 'D';
    $rawName = (string)($_POST['razon_social'] ?? '');
    $norm = $rawName;
    if (function_exists('iconv')) {
      $norm = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $norm);
    }
    $norm = preg_replace('/[^A-Za-z0-9_\-]+/', '_', $norm);
    $norm = trim($norm, '_');
    if ($norm === '') {
      $norm = 'sin_nombre';
    }

    $fileName = "VerificacionPCB_{$norm}.pdf";
    $cc_para_nombre = preg_replace('/\D+/', '', (string)($_POST['nit_cc'] ?? ''));
    self::persistGeneratedPdf($pdf, $fileName, 'form5_verificacion_pcb', [], $cc_para_nombre);
    $pdf->Output($fileName, $outMode);
    exit;
  }

  /* ===============  FORMULARIO 6 (VERIFICACION DISEÑO 2p – TCPDF)  ================= */
  private static function storeVerificacion3D(): void
  {
    // Limpia buffers y asegura TCPDF
    while (ob_get_level()) {
      @ob_end_clean();
    }
    self::ensureTcpdfLoaded();

    /* ===== 0) AUTO–INCREMENTO (contador exclusivo F6) ===== */
    $root        = dirname(__DIR__, 2);
    $counterDir  = $root . '/sennova/storage/counters';
    $counterFile = $counterDir . '/verificacion_3d.counter';

    if (!is_dir($counterDir)) {
      @mkdir($counterDir, 0775, true);
    }

    $readCounter = function () use ($counterFile): int {
      if (!is_file($counterFile)) return 0; // 0 => siguiente 001
      $v = @file_get_contents($counterFile);
      $n = is_string($v) ? (int)trim($v) : 0;
      return max(0, $n);
    };
    $saveCounter = function (int $n) use ($counterFile): void {
      @file_put_contents($counterFile, (string)max(0, $n), LOCK_EX);
    };
    $fmt3 = function (int $n): string {
      return sprintf('%03d', max(0, $n));
    };

    // Flags desde el form
    $advanceFlag = (string)($_POST['advance_code'] ?? '') === '1'; // consumir/avanzar
    $resetFlag   = (string)($_POST['reset_code']   ?? '') === '1'; // reiniciar a 001

    // -------- 1) POST ----------
    $ot       = trim((string)($_POST['v3d_ot'] ?? ''));
    $fechaIso = trim((string)($_POST['v3d_fecha'] ?? date('Y-m-d')));
    $obs      = (string)($_POST['v3d_observaciones'] ?? '');
    $elab     = trim((string)($_POST['v3d_elaboro'] ?? ''));
    $aprob    = trim((string)($_POST['v3d_aprobo'] ?? ''));
    $aprobado = (string)($_POST['v3d_aprobado'] ?? '');
    $fecha    = $fechaIso ? date('d/m/Y', strtotime($fechaIso)) : '';

    // 1.1) Resolver correlativo (v3d_ot)
    if ($resetFlag) {
      $saveCounter(0);
      $ot = $fmt3(1);
      if ($advanceFlag) $saveCounter(1); // consume 001
    } else {
      $curr = $readCounter();
      if ($ot === '') {
        $ot = $fmt3($curr + 1);
        if ($advanceFlag) $saveCounter($curr + 1);
      } else {
        // si viene manual y advance=1, evita retroceso del contador
        $n = (int)preg_replace('/\D+/', '', $ot);
        if ($advanceFlag && $n > $curr) $saveCounter($n);
        // normaliza si es puramente numérico
        if (preg_match('/^\d+$/', $ot)) {
          $ot = $fmt3((int)$ot);
        }
      }
    }

    $V = [];
    for ($i = 1; $i <= 13; $i++) {
      $name = 'v3d_i_1_' . $i;
      $raw  = strtoupper(trim((string)($_POST[$name] ?? '')));
      if (!in_array($raw, ['SI', 'NO', 'NA'], true)) $raw = '';
      $V[$i] = $raw;
    }

    // -------- 2) Recursos / Coordenadas ----------
    $base = dirname(__DIR__, 2);
    $bg1  = $base . '/sennova/img/Plantillas/3D1.png';
    $bg2  = $base . '/sennova/img/Plantillas/3D2.png';

    $X = ['si' => 162.9, 'no' => 173.3, 'na' => 184.8];

    $Y1  = [1 => 105.5, 2 => 113.3, 3 => 121.3, 4 => 129.2, 5 => 136.8];
    $Y1b = [6 => 168.3, 7 => 176.0, 8 => 183.8, 9 => 191.7, 10 => 199.5, 11 => 207.8, 12 => 216.0, 13 => 224.0];

    $P1 = [
      'ot'    => [80.0, 69.0, 38.0],
      'fecha' => [154.0, 69.0, 36.0],
      'ap_si' => [46.0, 240.5],
      'ap_no' => [61.1, 240.5],
    ];

    $P2 = [
      'obs'     => [20.0, 70.0, 170.0, 40.0],
      'elaboro' => [28.0, 206.0, 70.0],
      'aprobo'  => [112.0, 206.0, 70.0],
    ];

    // -------- 3) TCPDF ----------
    $pdf = new \TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
    $pdf->setPrintHeader(false);
    $pdf->setPrintFooter(false);
    $pdf->SetMargins(0, 0, 0);
    $pdf->SetAutoPageBreak(false, 0);
    $pdf->SetTitle('Verificación Diseño e Impresión 3D');
    $pdf->SetFont('dejavusans', '', 10);

    // Helpers
    $put = function (float $x, float $y, string $txt, float $w = 0, string $align = 'L') use ($pdf) {
      if ($txt === '') return;
      $pdf->SetXY($x, $y);
      $pdf->Cell($w ?: 0, 5.0, $txt, 0, 0, $align, false, '', 0, false, 'T', 'M');
    };
    $multi = function (float $x, float $y, float $w, float $h, string $txt) use ($pdf) {
      if ($txt === '') return;
      $pdf->SetXY($x, $y);
      $pdf->MultiCell($w, 5.0, $txt, 0, 'L', false, 1, '', '', true, 0, false, true, $h, 'T', true);
    };
    $markX = function (float $x, float $y, bool $on, float $size = 4.5) use ($pdf) {
      if (!$on) return;
      $pdf->SetFont('dejavusans', '', 12);
      $pdf->SetXY($x, $y);
      $pdf->Cell($size, $size, '☒', 0, 0, 'C', false, '', 0, false, 'M', 'M');
      $pdf->SetFont('dejavusans', '', 10);
    };

    // -------- 4) Página 1 --------
    $pdf->AddPage();
    if (is_file($bg1)) $pdf->Image($bg1, 0, 0, 210, 297, '', '', '', false, 300);

    $put($P1['ot'][0],    $P1['ot'][1],    $ot,    $P1['ot'][2]);
    $put($P1['fecha'][0], $P1['fecha'][1], $fecha, $P1['fecha'][2]);

    foreach ($Y1 as $i => $yy) {
      $v = $V[$i] ?? '';
      $markX($X['si'], $yy, $v === 'SI');
      $markX($X['no'], $yy, $v === 'NO');
      $markX($X['na'], $yy, $v === 'NA');
    }
    foreach ($Y1b as $i => $yy) {
      $v = $V[$i] ?? '';
      $markX($X['si'], $yy, $v === 'SI');
      $markX($X['no'], $yy, $v === 'NO');
      $markX($X['na'], $yy, $v === 'NA');
    }

    $markX($P1['ap_si'][0], $P1['ap_si'][1], $aprobado === 'SI');
    $markX($P1['ap_no'][0], $P1['ap_no'][1], $aprobado === 'NO');

    // -------- 5) Página 2 --------
    $pdf->AddPage();
    if (is_file($bg2)) $pdf->Image($bg2, 0, 0, 210, 297, '', '', '', false, 300);

    $multi($P2['obs'][0], $P2['obs'][1], $P2['obs'][2], $P2['obs'][3], $obs);
    $put($P2['elaboro'][0], $P2['elaboro'][1], $elab,  $P2['elaboro'][2], 'C');
    $put($P2['aprobo'][0],  $P2['aprobo'][1],  $aprob, $P2['aprobo'][2],  'C');

    // -------- 6) Salida --------
    $mode    = $_POST['mode'] ?? 'download';
    $outMode = ($mode === 'print') ? 'I' : 'D';

    $rawName = (string)($_POST['razon_social'] ?? '');
    $norm = $rawName;
    if (function_exists('iconv')) {
      $norm = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $norm);
    }
    $norm = preg_replace('/[^A-Za-z0-9_\-]+/', '_', $norm);
    $norm = trim($norm, '_');
    if ($norm === '') {
      $norm = 'sin_nombre';
    }

    $fileName = "Verificacion3D_{$norm}.pdf";
    $cc_para_nombre = preg_replace('/\D+/', '', (string)($_POST['nit_cc'] ?? ''));
    self::persistGeneratedPdf($pdf, $fileName, 'form6_verificacion_3d', [], $cc_para_nombre);
    $pdf->Output($fileName, $outMode);
    exit;
  }

  /* ===============  FORMULARIO 7 (VERIFICACION DISEÑO 2p – TCPDF)  ================= */
  public static function storeContinuidad(): void
  {
    // 0) TCPDF limpio
    while (ob_get_level()) {
      ob_end_clean();
    }
    self::ensureTcpdfLoaded();

    /* ========== AUTO–INCREMENTO (contador exclusivo F7) ========== */
    $root        = dirname(__DIR__, 2);
    $counterDir  = $root . '/sennova/storage/counters';
    $counterFile = $counterDir . '/continuidad_pcb.counter';

    if (!is_dir($counterDir)) {
      @mkdir($counterDir, 0775, true);
    }

    $readCounter = function () use ($counterFile): int {
      if (!is_file($counterFile)) return 0; // 0 => siguiente será 001
      $v = @file_get_contents($counterFile);
      $n = is_string($v) ? (int)trim($v) : 0;
      return max(0, $n);
    };
    $saveCounter = function (int $n) use ($counterFile): void {
      @file_put_contents($counterFile, (string)max(0, $n), LOCK_EX);
    };
    $fmt3 = function (int $n): string {
      return sprintf('%03d', max(0, $n));
    };

    // Flags desde el form (por defecto: avanzar sí, reset no)
    $advanceFlag = (string)($_POST['advance_code'] ?? '') === '1';
    $resetFlag   = (string)($_POST['reset_code']   ?? '') === '1';

    // 1) POST (solo valores del usuario)
    $fecha   = trim((string)($_POST['ct_fecha'] ?? date('Y-m-d')));
    $ot      = trim((string)($_POST['ct_ot'] ?? '')); // <- correlativo
    $ident   = trim((string)($_POST['ct_identificador'] ?? ''));
    $metodo  = trim((string)($_POST['ct_metodo'] ?? ''));
    $resp    = trim((string)($_POST['ct_responsable'] ?? ''));
    $aprob   = strtoupper(trim((string)($_POST['ct_aprobado'] ?? ''))); // SI | NO | ''
    $reco    = (string)($_POST['ct_recomendaciones'] ?? '');
    $respLab = trim((string)($_POST['ct_responsable_gestion'] ?? ''));

    // 1.1) Resolver correlativo para ct_ot
    if ($resetFlag) {
      $saveCounter(0);
      $ot = $fmt3(1);
      if ($advanceFlag) $saveCounter(1); // consume 001
    } else {
      $curr = $readCounter();
      if ($ot === '') {
        // asigna el siguiente
        $ot = $fmt3($curr + 1);
        if ($advanceFlag) $saveCounter($curr + 1);
      } else {
        // vino manual; normaliza si es numérico puro
        if (preg_match('/^\d+$/', $ot)) {
          $ot = $fmt3((int)$ot);
        }
        // y si advance=1, evita retroceso del contador global
        $n = (int)preg_replace('/\D+/', '', $ot);
        if ($advanceFlag && $n > $curr) $saveCounter($n);
      }
    }

    // Filas (continuidad)
    $rows = [];
    if (!empty($_POST['ct_rows']) && is_array($_POST['ct_rows'])) {
      foreach ($_POST['ct_rows'] as $r) {
        $rows[] = [
          'desde_comp' => trim((string)($r['desde_comp'] ?? '')),
          'desde_pin'  => trim((string)($r['desde_pin']  ?? '')),
          'hasta_comp' => trim((string)($r['hasta_comp'] ?? '')),
          'hasta_pin'  => trim((string)($r['hasta_pin']  ?? '')),
          'cont'       => strtoupper(trim((string)($r['cont']      ?? ''))), // SI|NO|''
          'obs'        => trim((string)($r['obs']        ?? '')),
        ];
      }
    }

    // 2) TCPDF
    $pdf = new \TCPDF('L', 'mm', 'A4', true, 'UTF-8', false);
    $pdf->setPrintHeader(false);
    $pdf->setPrintFooter(false);
    $pdf->SetMargins(0, 0, 0);
    $pdf->SetAutoPageBreak(false, 0);
    $pdf->SetFont('dejavusans', '', 10);
    $pdf->SetTitle('Continuidad de PCB');

    // 3) Fondos
    $base = dirname(__DIR__, 2);
    $bg1  = $base . '/sennova/img/Plantillas/PC1.png';
    $bg2  = $base . '/sennova/img/Plantillas/PC2.png';

    // 4) Helpers — SIN textos fijos
    $put = function (\TCPDF $pdf, float $x, float $y, string $txt, int $size = 10, string $style = '', float $w = 0, string $align = 'L') {
      if ($txt === '') return;
      $pdf->SetFont('dejavusans', $style, $size);
      $pdf->SetXY($x, $y);
      $pdf->Cell($w ?: 0, 5, $txt, 0, 0, $align, false, '', 0, false, 'T', 'M');
    };
    $multi = function (\TCPDF $pdf, float $x, float $y, float $w, float $h, string $txt, int $size = 10) {
      if ($txt === '') return;
      $pdf->SetFont('dejavusans', '', $size);
      $pdf->SetXY($x, $y);
      $pdf->MultiCell($w, 5.0, $txt, 0, 'L', false, 1, '', '', true, 0, false, true, $h, 'T', true);
    };
    $mark = function (\TCPDF $pdf, float $x, float $y, bool $on) {
      if (!$on) return;
      $pdf->SetFont('dejavusans', '', 12);
      $pdf->SetXY($x, $y - 1.0);
      $pdf->Cell(4.5, 4.5, '☒', 0, 0, 'C');
    };

    // ================== PÁGINA 1 ==================
    $pdf->AddPage();
    if (is_file($bg1)) $pdf->Image($bg1, 0, 0, 297, 210, '', '', '', false, 300);

    // Encabezado
    $put($pdf,  55.0, 55.8, date('d/m/Y', strtotime($fecha)));
    $put($pdf, 177.0, 55.8, $ot); // <- correlativo mostrado

    // Campos largos
    $put($pdf, 128.0, 67.2, $ident);
    $put($pdf, 128.0, 74.7, $metodo);
    $put($pdf, 128.0, 82.0, $resp);

    // Tabla de continuidad
    $startY = 108.0;
    $rowH   = 6.5;
    $X = [
      'desde_comp' => 48.0,
      'desde_pin'  => 73.0,
      'hasta_comp' => 94.0,
      'hasta_pin'  => 119.0,
      'si'         => 144.0,
      'no'         => 165.0,
      'obs'        => 180.0,
    ];

    foreach ($rows as $i => $r) {
      if ($i >= 12) break;
      $y = $startY + ($i * $rowH);

      $put($pdf, $X['desde_comp'], $y, (string)$r['desde_comp']);
      $put($pdf, $X['desde_pin'],  $y, (string)$r['desde_pin']);
      $put($pdf, $X['hasta_comp'], $y, (string)$r['hasta_comp']);
      $put($pdf, $X['hasta_pin'],  $y, (string)$r['hasta_pin']);

      $mark($pdf, $X['si'], $y, ($r['cont'] === 'SI'));
      $mark($pdf, $X['no'], $y, ($r['cont'] === 'NO'));

      $put($pdf, $X['obs'], $y, (string)$r['obs']);
    }

    // ================== PÁGINA 2 ==================
    $pdf->AddPage();
    if (is_file($bg2)) $pdf->Image($bg2, 0, 0, 297, 210, '', '', '', false, 300);

    // Aprobado
    $mark($pdf, 67.4, 52.9, ($aprob === 'SI'));
    $mark($pdf, 82.5, 52.9, ($aprob === 'NO'));

    // Recomendaciones
    $multi($pdf, 110.0, 64.0, 200.0, 40.0, $reco, 10);

    // Responsable de la gestión (centrado)
    $put($pdf, 110.0, 78.0, $respLab, 10, '', 80.0, 'C');

    // Salida
    $mode    = $_POST['mode'] ?? 'download';
    $outMode = ($mode === 'print') ? 'I' : 'D';
    $rawName = (string)($_POST['razon_social'] ?? '');
    $norm = $rawName;
    if (function_exists('iconv')) {
      $norm = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $norm);
    }
    $norm = preg_replace('/[^A-Za-z0-9_\-]+/', '_', $norm);
    $norm = trim($norm, '_');
    if ($norm === '') {
      $norm = 'sin_nombre';
    }

    $fileName = "ContinuidadPCB_{$norm}.pdf";
    $cc_para_nombre = preg_replace('/\D+/', '', (string)($_POST['nit_cc'] ?? ''));
    self::persistGeneratedPdf($pdf, $fileName, 'form7_continuidad_pcb', [], $cc_para_nombre);
    $pdf->Output($fileName, $outMode);
    exit;
  }

  /* ===============  FORMULARIO 8 (VERIFICACION DISEÑO 2p – TCPDF)  ================= */
  public static function storeInformeServicio(): void
{
  // 0) Limpia buffers y carga TCPDF
  while (ob_get_level()) {
    ob_end_clean();
  }
  self::ensureTcpdfLoaded();

  /* ========== AUTO–INCREMENTO (contador exclusivo F8) ========== */
  $projectRoot = dirname(__DIR__, 2);
  $counterDir  = $projectRoot . '/sennova/storage/counters';
  $counterFile = $counterDir . '/informe_servicio.counter';

  if (!is_dir($counterDir)) {
    @mkdir($counterDir, 0775, true);
  }

  $readCounter = function () use ($counterFile): int {
    if (!is_file($counterFile)) return 0; // 0 => siguiente será 001
    $v = @file_get_contents($counterFile);
    $n = is_string($v) ? (int)trim($v) : 0;
    return max(0, $n);
  };
  $saveCounter = function (int $n) use ($counterFile): void {
    @file_put_contents($counterFile, (string)max(0, $n), LOCK_EX);
  };
  $fmt3 = function (int $n): string {
    return sprintf('%03d', max(0, $n));
  };

  // Flags del form (por defecto: avanzar sí, reset no)
  $advanceFlag = (string)($_POST['advance_code'] ?? '') === '1';
  $resetFlag   = (string)($_POST['reset_code']   ?? '') === '1';

  // 1) POST (texto)
  $ot        = trim((string)($_POST['isv_ot'] ?? '')); // <- correlativo F8
  $fechaIso  = (string)($_POST['isv_fecha'] ?? date('Y-m-d'));
  $serv      = (array)($_POST['isv_servicio'] ?? []); // checkboxes
  $result    = (string)($_POST['isv_resultados'] ?? '');
  $obs       = (string)($_POST['isv_obs'] ?? '');
  $elaboro   = trim((string)($_POST['isv_elaboro'] ?? ''));
  $aprobo    = trim((string)($_POST['isv_aprobo'] ?? ''));
  $fecha     = $fechaIso ? date('d/m/Y', strtotime($fechaIso)) : '';

  // 1.1) Resolver correlativo para isv_ot
  if ($resetFlag) {
    $saveCounter(0);
    $ot = $fmt3(1);
    if ($advanceFlag) $saveCounter(1); // consume 001
  } else {
    $curr = $readCounter();
    if ($ot === '') {
      $ot = $fmt3($curr + 1);
      if ($advanceFlag) $saveCounter($curr + 1);
    } else {
      // normaliza si es numérico
      if (preg_match('/^\d+$/', $ot)) {
        $ot = $fmt3((int)$ot);
      }
      // si advance=1, evita retroceso del contador global
      $n = (int)preg_replace('/\D+/', '', $ot);
      if ($advanceFlag && $n > $curr) $saveCounter($n);
    }
  }

  // 1.2) Preparar carpeta temporal para imágenes
  $tmpDir = $projectRoot . '/sennova/storage/tmp_isv';
  if (!is_dir($tmpDir)) {
    @mkdir($tmpDir, 0775, true);
  }

  // 1.3) Subida de imágenes
  $uploadedImgs = [];
  if (!empty($_FILES['isv_resultados_img']) && is_array($_FILES['isv_resultados_img']['name'])) {
    $names = $_FILES['isv_resultados_img']['name'];
    $tmps  = $_FILES['isv_resultados_img']['tmp_name'];
    $errs  = $_FILES['isv_resultados_img']['error'];

    $finfo = function_exists('finfo_open') ? finfo_open(FILEINFO_MIME_TYPE) : null;

    for ($i = 0; $i < count($names); $i++) {
      if ($errs[$i] !== UPLOAD_ERR_OK) continue;
      $tmp = $tmps[$i];
      if (!$tmp || !is_uploaded_file($tmp)) continue;

      // MIME real
      $mime = $finfo ? strtolower((string)finfo_file($finfo, $tmp)) : '';
      if (!$mime) {
        $gi = @getimagesize($tmp);
        if ($gi && !empty($gi['mime'])) $mime = strtolower($gi['mime']);
      }

      $base = $tmpDir . '/isv_' . uniqid();
      $ok   = false;
      $dest = '';

      if (in_array($mime, ['image/jpeg', 'image/jpg'])) {
        $dest = $base . '.jpg';
        $ok = @move_uploaded_file($tmp, $dest);
      } elseif ($mime === 'image/png') {
        $dest = $base . '.png';
        $ok = @move_uploaded_file($tmp, $dest);
      } elseif ($mime === 'image/gif') {
        $dest = $base . '.gif';
        $ok = @move_uploaded_file($tmp, $dest);
      } elseif ($mime === 'image/webp') {
        if (function_exists('imagecreatefromwebp')) {
          $im = @imagecreatefromwebp($tmp);
          if ($im) {
            $dest = $base . '.jpg';
            $ok = @imagejpeg($im, $dest, 90);
            @imagedestroy($im);
          }
        }
      } else {
        error_log('[ISV] Formato no soportado: ' . $mime);
      }

      if ($ok && is_file($dest)) {
        @chmod($dest, 0644);
        $uploadedImgs[] = $dest;
      }
    }
    if ($finfo) finfo_close($finfo);
  } else {
    error_log('[ISV] No llegaron archivos en isv_resultados_img[]');
  }

  // 2) Coordenadas (mm)
  $C = [
    'ot'    => [66.0, 67.5],
    'fecha' => [160.0, 67.5],

    'svc_diseno_pcb'       => [61.3,  80.7],
    'svc_fabricacion_pcb'  => [61.1,  86.5],
    'svc_diseno_3d'        => [61.1,  91.7],
    'svc_impresion_3d'     => [61.0,  97.5],
    'svc_montaje'          => [61.1, 102.9],
    'svc_transferencia'    => [61.1, 108.3],
    'svc_integracion'      => [61.0, 115.0],

    'result' => [35.0, 47.0, 185.0, 80.0],
    'obs'    => [19.0, 215.0, 172.0, 40.0],

    'elaboro_val' => [35.0, 202.0],
    'aprobo_val'  => [35.0, 216.0],
  ];

  // 3) TCPDF
  $pdf = new \TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
  $pdf->setPrintHeader(false);
  $pdf->setPrintFooter(false);
  $pdf->SetMargins(0, 0, 0);
  $pdf->SetAutoPageBreak(false, 0);
  $pdf->SetTitle('Informe de Servicio');
  $pdf->SetFont('dejavusans', '', 10);
  $pdf->AddPage();

  $bg = $projectRoot . '/sennova/img/Plantillas/IR1.png';
  if (is_file($bg)) {
    $pdf->Image($bg, 0, 0, 210, 297, '', '', '', false, 300);
  }

  // Helpers
  $put = function (float $x, float $y, string $txt, int $size = 10, string $style = '', string $align = 'L') use ($pdf) {
    if ($txt === '') return;
    $pdf->SetFont('dejavusans', $style, $size);
    $pdf->SetXY($x, $y);
    $pdf->Cell(0, 5, $txt, 0, 0, $align);
  };
  $mark = function (float $x, float $y, bool $on) use ($pdf) {
    if (!$on) return;
    $pdf->SetFont('dejavusans', '', 10);
    $pdf->SetXY($x, $y - 1);
    $pdf->Cell(4.2, 4.2, '☒', 0, 0, 'C');
  };
  $multi = function (float $x, float $y, float $w, float $h, string $txt, int $size = 10) use ($pdf) {
    if ($txt === '') return;
    $pdf->SetFont('dejavusans', '', $size);
    $pdf->SetXY($x, $y);
    $pdf->MultiCell($w, 5.0, $txt, 0, 'L', false, 1, '', '', true, 0, false, true, $h, 'T', true);
  };

  // 4) Pintado
  $put($C['ot'][0],    $C['ot'][1],    $ot);     // <- correlativo visible
  $put($C['fecha'][0], $C['fecha'][1], $fecha);

  $mark($C['svc_diseno_pcb'][0],      $C['svc_diseno_pcb'][1],      isset($serv['diseno_pcb']));
  $mark($C['svc_fabricacion_pcb'][0], $C['svc_fabricacion_pcb'][1], isset($serv['fabricacion_pcb']));
  $mark($C['svc_diseno_3d'][0],       $C['svc_diseno_3d'][1],       isset($serv['diseno_3d']));
  $mark($C['svc_impresion_3d'][0],    $C['svc_impresion_3d'][1],    isset($serv['impresion_3d']));
  $mark($C['svc_montaje'][0],         $C['svc_montaje'][1],         isset($serv['montaje']));
  $mark($C['svc_transferencia'][0],   $C['svc_transferencia'][1],   isset($serv['transferencia']));
  $mark($C['svc_integracion'][0],     $C['svc_integracion'][1],     isset($serv['integracion']));

  $multi($C['result'][0], $C['result'][1], $C['result'][2], $C['result'][3], $result);

  // Mini–galería (igual a tu versión)
  $thumbGapX   = 8.0;
  $thumbGapY   = 2.5;
  $thumbH      = 35.0;
  $forceCols   = null;
  $aspectClamp = 1.15;

  $imgCount = count($uploadedImgs);
  $colsAuto = ($imgCount <= 2) ? 2 : (($imgCount <= 6) ? 3 : 4);
  $cols     = $forceCols ?: $colsAuto;

  $gridX   = $C['result'][0];
  $gridW   = $C['result'][2];
  $cellW   = ($gridW - ($thumbGapX * ($cols - 1))) / $cols;
  $cellH   = $thumbH;

  if (!is_null($aspectClamp) && $aspectClamp > 0) {
    $cellW = min($cellW, $cellH * $aspectClamp);
  }

  $cursorY    = $C['result'][1] + $C['result'][3] + 4.0;
  $gridBottom = $cursorY;
  $colIndex   = 0;

  foreach ($uploadedImgs as $path) {
    if (!is_file($path)) continue;

    if ($cursorY + $cellH > 285) {
      $pdf->AddPage();
      if (is_file($bg)) $pdf->Image($bg, 0, 0, 210, 297, '', '', '', false, 300);
      $cursorY  = 20.0;
      $gridBottom = $cursorY;
      $colIndex = 0;
    }

    $gi = @getimagesize($path);
    if (!$gi) continue;
    $iw = (float)$gi[0];
    $ih = (float)$gi[1];
    if ($iw <= 0 || $ih <= 0) continue;

    $ratio = $iw / $ih;
    $drawW = $cellW;
    $drawH = $drawW / $ratio;
    if ($drawH > $cellH) {
      $drawH = $cellH;
      $drawW = $drawH * $ratio;
    }

    $xCell = $gridX + ($colIndex * ($cellW + $thumbGapX));
    $yCell = $cursorY;

    $xImg = $xCell + max(0, ($cellW - $drawW) / 2);
    $yImg = $yCell + max(0, ($cellH - $drawH) / 2);

    $pdf->Image($path, $xImg, $yImg, $drawW, $drawH, '', '', '', false, 300, '', false, false, 0, false, false, false);

    $colIndex++;
    if ($colIndex >= $cols) {
      $colIndex = 0;
      $cursorY += $cellH + $thumbGapY;
      $gridBottom = max($gridBottom, $cursorY);
    } else {
      $gridBottom = max($gridBottom, $yCell + $cellH);
    }
  }

  // Observaciones debajo de la grilla
  $obsTop = max($C['obs'][1], $gridBottom + 6.0);
  if ($obsTop + $C['obs'][3] > 285) {
    $pdf->AddPage();
    if (is_file($bg)) $pdf->Image($bg, 0, 0, 210, 297, '', '', '', false, 300);
    $obsTop = 20.0;
  }
  $multi($C['obs'][0], $obsTop, $C['obs'][2], $C['obs'][3], $obs);

  // Firmas
  $firmasY1 = 202.0;
  $firmasY2 = 216.0;
  if ($obsTop + $C['obs'][3] + 20.0 > 200.0) {
    $firmasY1 = $obsTop + $C['obs'][3] + 8.0;
    $firmasY2 = $firmasY1 + 14.0;
    if ($firmasY2 > 285) {
      $pdf->AddPage();
      if (is_file($bg)) $pdf->Image($bg, 0, 0, 210, 297, '', '', '', false, 300);
      $firmasY1 = 200.0;
      $firmasY2 = 214.0;
    }
  }
  $put($C['elaboro_val'][0], $firmasY1, $elaboro);
  $put($C['aprobo_val'][0],  $firmasY2, $aprobo);

  // 5) Salida
  $mode    = $_POST['isv_mode'] ?? 'download';
  $outMode = ($mode === 'print') ? 'I' : 'D';
  $rawName = (string)($_POST['isv_cliente'] ?? ($_POST['razon_social'] ?? ''));
  $norm = $rawName;
  if (function_exists('iconv')) {
    $norm = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $norm);
  }
  $norm = preg_replace('/[^A-Za-z0-9_\-]+/', '_', $norm);
  $norm = trim($norm, '_');
  if ($norm === '') {
    $norm = 'sin_nombre';
  }

  $fileName = "InfoServicio_{$norm}.pdf";
  $cc_para_nombre = preg_replace('/\D+/', '', (string)($_POST['nit_cc'] ?? ''));
  self::persistGeneratedPdf($pdf, $fileName, 'form8_informe_servicio', [], $cc_para_nombre);
  $pdf->Output($fileName, $outMode);

  foreach ($uploadedImgs as $p) { @unlink($p); }
  exit;
}

  /* ===============  FORMULARIO 9 (VERIFICACION DISEÑO 2p – TCPDF)  ================= */
  private static function storeEncuestaSatisfaccion(): void
  {
    // 0) Preparación
    while (ob_get_level()) {
      ob_end_clean();
    }
    self::ensureTcpdfLoaded();

    // ---------- 1) POST ----------
    $serv         = (array)($_POST['esc_servicio'] ?? []);         // checkboxes
    $instalacion  = trim((string)($_POST['esc_instalacion'] ?? ''));
    $instal_otro  = trim((string)($_POST['esc_instal_otro'] ?? '')); // texto si "Otro"
    $fecha        = (string)($_POST['esc_fecha'] ?? date('Y-m-d'));

    // Tipo de cliente (radios) + “otro” opcional
    $tipoCliente      = trim((string)($_POST['esc_tipo_cliente'] ?? ''));
    $tipoClienteOtro  = trim((string)($_POST['esc_tipo_cliente_otro'] ?? ''));

    $cliente   = trim((string)($_POST['esc_cliente'] ?? ''));
    $telefono  = trim((string)($_POST['esc_telefono'] ?? ''));
    $direccion = trim((string)($_POST['esc_direccion'] ?? ''));

    // radios (1..5) o vacío
    $r = [
      'personal'     => $_POST['esc_eval_personal']     ?? '',
      'equipo'       => $_POST['esc_eval_equipo']       ?? '',
      'diseno'       => $_POST['esc_eval_diseno']       ?? '',
      'producto'     => $_POST['esc_eval_producto']     ?? '',
      'seguridad'    => $_POST['esc_eval_seguridad']    ?? '',
      'medio'        => $_POST['esc_eval_medio']        ?? '',
      'puntualidad'  => $_POST['esc_eval_puntualidad']  ?? '',
      'comunicacion' => $_POST['esc_eval_comunicacion'] ?? '',
    ];

    $mejora = (string)($_POST['esc_mejoramiento'] ?? '');
    $coment = (string)($_POST['esc_comentario'] ?? '');
    $firma  = (string)($_POST['esc_firma_cliente'] ?? '');

    // ---------- 2) COORDENADAS ----------
    // PÁGINA 1
    $P1 = [
      'bg'         => dirname(__DIR__, 2) . '/sennova/img/Plantillas/SC1.png',

      // campos (x,y,w)
      'fecha'      => [155.0, 82.5, 28.0],
      'cliente'    => [20.0,  114.0, 70.0],
      'telefono'   => [110.0, 125.5, 60.0],
      'direccion'  => [20.0,  125.5, 160.0],

      // Instalaciones (cuadros)
      'inst_lab'      => [18.4, 85.4],
      'inst_amb'      => [45.0, 85.4],
      'inst_otro'     => [89.6, 85.4],
      'inst_otro_txt' => [102.0, 82.4, 40.0],

      // ---- Tipo de cliente (cuadros) ----
      'tipo_aprendiz'    => [100.5,  97.9],
      'tipo_emprendedor' => [129.3,  97.9],
      'tipo_natural'     => [100.7, 103.4],
      'tipo_juridica'    => [158.4,  97.8],
      'tipo_proyectos'   => [129.5,  103.5],
      'tipo_otro'        => [158.1,  103.5],
      'tipo_otro_txt'    => [169.0, 100.3, 46.0],

      // Calificaciones 1..5 (página 1) — X grande
      'cal_x'       => [144.9, 155.5, 166.3, 177.1, 187.4],
      'y_personal'  => 233.0,
      'y_equipo'    => 241.5,
      'y_diseno'    => 250.5,
      'y_producto'  => 259.0,
      'y_seguridad' => 268.0,
    ];

    // === COORDENADAS INDIVIDUALES DE SERVICIOS ===
    $SRV_XY = [
      'diseno_pcb'      => [15.6, 63.5],
      'fabricacion_pcb' => [15.4, 67.7],
      'diseno_3d'       => [15.6, 75.5],
      'impresion_3d'    => [15.6, 71.4],

      'montaje'         => [104.4, 63.9],
      'transferencia'   => [104.4, 67.8],
      'integracion'     => [104.4, 71.8],
    ];

    // PÁGINA 2
    $P2 = [
      'bg'              => dirname(__DIR__, 2) . '/sennova/img/Plantillas/SC2.png',
      'cal_x'           => [145.0, 155.2, 166.3, 177.1, 187.4],
      'y_medio'         => 62.0,
      'y_puntualidad'   => 70.3,
      'y_comunicacion'  => 79.1,
      'mejora'          => [49.0, 96.0, 142.0, 20.0],
      'coment'          => [49.0, 118.0, 142.0, 28.0],
      'firma'           => [77.0, 148.0, 70.0],
    ];

    // ---------- 3) TCPDF ----------
    $pdf = new \TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
    $pdf->setPrintHeader(false);
    $pdf->setPrintFooter(false);
    $pdf->SetMargins(0, 0, 0);
    $pdf->SetAutoPageBreak(false, 0);
    $pdf->SetTitle('Encuesta de Satisfacción del Cliente');
    $pdf->SetFont('dejavusans', '', 10);

    // Helpers
    $put = function (float $x, float $y, string $txt, float $w = 0, string $align = 'L') use ($pdf) {
      if ($txt === '') return;
      $pdf->SetXY($x, $y);
      $pdf->Cell($w ?: 0, 5.0, $txt, 0, 0, $align, false, '', 0, false, 'T', 'M');
    };
    $putMulti = function (float $x, float $y, float $w, float $h, string $txt) use ($pdf) {
      if ($txt === '') return;
      $pdf->SetXY($x, $y);
      $pdf->MultiCell($w, 5.0, $txt, 0, 'L', false, 1, '', '', true, 0, false, true, $h, 'T', true);
    };

    // ☒ normal (instalaciones y tipo de cliente)
    $markBox = function (float $x, float $y) use ($pdf) {
      $pdf->SetFont('dejavusans', '', 11);
      $pdf->SetXY($x, $y - 1);
      $pdf->Cell(4.5, 4.5, '☒', 0, 0, 'C', false, '', 0, false, 'M', 'M');
      $pdf->SetFont('dejavusans', '', 10);
    };

    // ☒ más pequeño SOLO para servicios
    $markBoxSvc = function (float $x, float $y) use ($pdf) {
      $pdf->SetFont('dejavusans', '', 9);
      $pdf->SetXY($x, $y - 0.8);
      $pdf->Cell(3.8, 3.8, '☒', 0, 0, 'C', false, '', 0, false, 'M', 'M');
      $pdf->SetFont('dejavusans', '', 10);
    };

    // X grande (calificaciones)
    $CAL_XOFF = 0.0;
    $CAL_YOFF = -1.2;
    $CAL_SIZE = 13.0;
    $markX = function (float $x, float $y) use ($pdf, $CAL_XOFF, $CAL_YOFF, $CAL_SIZE) {
      $pdf->SetFont('dejavusans', 'B', $CAL_SIZE);
      $pdf->SetXY($x + $CAL_XOFF, $y + $CAL_YOFF);
      $pdf->Cell(4.5, 4.5, 'X', 0, 0, 'C', false, '', 0, false, 'M', 'M');
      $pdf->SetFont('dejavusans', '', 10);
    };

    // ---------- 4) PÁGINA 1 ----------
    $pdf->AddPage();
    if (is_file($P1['bg'])) {
      $pdf->Image($P1['bg'], 0, 0, 210, 297, '', '', '', false, 300);
    }

    // Campos simples
    $put($P1['fecha'][0],     $P1['fecha'][1],     date('d/m/Y', strtotime($fecha)), $P1['fecha'][2]);
    $put($P1['cliente'][0],   $P1['cliente'][1],   $cliente,                          $P1['cliente'][2]);
    $put($P1['telefono'][0],  $P1['telefono'][1],  $telefono,                         $P1['telefono'][2]);
    $put($P1['direccion'][0], $P1['direccion'][1], $direccion,                        $P1['direccion'][2]);

    // Instalaciones
    if ($instalacion === 'Laboratorio') {
      $markBox($P1['inst_lab'][0], $P1['inst_lab'][1]);
    } elseif ($instalacion === 'Ambiente de formación') {
      $markBox($P1['inst_amb'][0], $P1['inst_amb'][1]);
    } elseif ($instalacion === 'Otro') {
      $markBox($P1['inst_otro'][0], $P1['inst_otro'][1]);
      if ($instal_otro !== '') {
        $put($P1['inst_otro_txt'][0], $P1['inst_otro_txt'][1], $instal_otro, $P1['inst_otro_txt'][2]);
      }
    }

    // Tipo de Cliente
    switch ($tipoCliente) {
      case 'Aprendiz':
        $markBox($P1['tipo_aprendiz'][0],    $P1['tipo_aprendiz'][1]);
        break;
      case 'Emprendedor':
        $markBox($P1['tipo_emprendedor'][0], $P1['tipo_emprendedor'][1]);
        break;
      case 'Persona natural':
        $markBox($P1['tipo_natural'][0],     $P1['tipo_natural'][1]);
        break;
      case 'Persona jurídica':
        $markBox($P1['tipo_juridica'][0],    $P1['tipo_juridica'][1]);
        break;
      case 'Proyectos I+D+i':
        $markBox($P1['tipo_proyectos'][0],   $P1['tipo_proyectos'][1]);
        break;
      case 'Otro':
        $markBox($P1['tipo_otro'][0], $P1['tipo_otro'][1]);
        if ($tipoClienteOtro !== '') {
          $put($P1['tipo_otro_txt'][0], $P1['tipo_otro_txt'][1], $tipoClienteOtro, $P1['tipo_otro_txt'][2]);
        }
        break;
    }

    // ===== Servicios (cada uno independiente) =====
    foreach ($SRV_XY as $key => [$sx, $sy]) {
      if (isset($serv[$key])) {
        $markBoxSvc($sx, $sy);
      }
    }

    // Calificaciones P1
    $X = $P1['cal_x'];
    if ($r['personal'])   $markX($X[(int)$r['personal']   - 1] ?? $X[0], $P1['y_personal']);
    if ($r['equipo'])     $markX($X[(int)$r['equipo']     - 1] ?? $X[0], $P1['y_equipo']);
    if ($r['diseno'])     $markX($X[(int)$r['diseno']     - 1] ?? $X[0], $P1['y_diseno']);
    if ($r['producto'])   $markX($X[(int)$r['producto']   - 1] ?? $X[0], $P1['y_producto']);
    if ($r['seguridad'])  $markX($X[(int)$r['seguridad']  - 1] ?? $X[0], $P1['y_seguridad']);

    // ---------- 5) PÁGINA 2 ----------
    $pdf->AddPage();
    if (is_file($P2['bg'])) {
      $pdf->Image($P2['bg'], 0, 0, 210, 297, '', '', '', false, 300);
    }

    $X2 = $P2['cal_x'];
    if ($r['medio'])        $markX($X2[(int)$r['medio']        - 1] ?? $X2[0], $P2['y_medio']);
    if ($r['puntualidad'])  $markX($X2[(int)$r['puntualidad']  - 1] ?? $X2[0], $P2['y_puntualidad']);
    if ($r['comunicacion']) $markX($X2[(int)$r['comunicacion'] - 1] ?? $X2[0], $P2['y_comunicacion']);

    $putMulti($P2['mejora'][0], $P2['mejora'][1], $P2['mejora'][2], $P2['mejora'][3], $mejora);
    $putMulti($P2['coment'][0], $P2['coment'][1], $P2['coment'][2], $P2['coment'][3], $coment);
    $put($P2['firma'][0], $P2['firma'][1], $firma, $P2['firma'][2]);

    // ---------- 6) SALIDA ----------
    $mode    = $_POST['mode'] ?? 'download';
    $outMode = ($mode === 'print') ? 'I' : 'D';
    $rawName = (string)($_POST['esc_cliente'] ?? '');
    $norm = $rawName;
    if (function_exists('iconv')) {
      $norm = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $norm);
    }
    $norm = preg_replace('/[^A-Za-z0-9_\-]+/', '_', $norm);
    $norm = trim($norm, '_');
    if ($norm === '') {
      $norm = 'sin_nombre';
    }

    $fileName = "Satisfaccion_{$norm}.pdf";
    $cc_para_nombre = preg_replace('/\D+/', '', (string)($_POST['esc_cc'] ?? ''));
    self::persistGeneratedPdf($pdf, $fileName, 'form9_satisfaccion', [], $cc_para_nombre);
    $pdf->Output($fileName, $outMode);
    exit;
  }
}
