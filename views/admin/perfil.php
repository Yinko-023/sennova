<?php
if (session_status() === PHP_SESSION_NONE) session_start();

$nombre    = $_SESSION['nombre_usuario'] ?? 'Usuario';
$email     = $_SESSION['email']          ?? 'correo@ejemplo.com';
$telefono  = $_SESSION['telefono']       ?? 'Sin número';
$direccion = $_SESSION['direccion']      ?? 'Sin dirección';

$area       = $_SESSION['area']        ?? 'general';
$rolNombre  = $_SESSION['rol_nombre']  ?? 'Sin rol';
$rolId      = (int)($_SESSION['rol']   ?? 0);
$cargoLabel = ($rolId === 1) ? 'Super Administrador' : 'Colaborador';

$_SESSION['csrf_token'] = bin2hex(random_bytes(16));

function avatar_bootdey(string $area, int $rolId): string
{
  $BASE = 'https://bootdey.com/img/Content/avatar/';
  if ($rolId === 1) return $BASE . 'avatar7.png';
  if ($rolId === 2 && strtolower($area) === 'electronica') return $BASE . 'avatar8.png';
  return match (strtolower($area)) {
    'cafe'         => $BASE . 'avatar5.png',
    'electronica'  => $BASE . 'avatar2.png',
    'visualizador' => $BASE . 'avatar6.png',
    default        => $BASE . 'avatar1.png',
  };
}

function area_badge_url(string $area, int $rolId): string
{
  $BI = 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/icons/';
  $a  = strtolower($area);
  if (($rolId === 1 || $rolId === 2) && $a === 'electronica') return $BI . 'cpu.svg';
  return match ($a) {
    'cafe'         => $BI . 'cup-hot.svg',
    'electronica'  => $BI . 'cpu.svg',
    'visualizador' => $BI . 'eye.svg',
    default        => $BI . 'person.svg',
  };
}

function area_badge_bg(string $area): string
{
  return match (strtolower($area)) {
    'cafe'         => '#6F4E37',
    'electronica'  => '#0ea5e9',
    'visualizador' => '#64748b',
    default        => '#334155',
  };
}

$avatarSrc = avatar_bootdey($area, $rolId);
$badgeSrc  = area_badge_url($area, $rolId);
$badgeBg   = area_badge_bg($area);
$areaLegible = ucfirst($area);
?>


<div id="profile-container" class="container-fluid ">
  <div class="row g-4 mt-5">
    <!-- Lateral -->
    <div class="col-lg-4">
      <div id="profile-card" data-aos="fade-right">
        <div id="profile-header">
          <div class="avatar-wrap">
            <img id="profile-avatar"
              src="<?= htmlspecialchars($avatarSrc) ?>"
              alt="Avatar" width="160" height="160" loading="lazy">
            <span class="avatar-badge" style="background-color: <?= htmlspecialchars($badgeBg) ?>;"></span>
          </div>

          <h4 id="profile-name"><?= htmlspecialchars($nombre) ?></h4>
          <span id="profile-role"><?= htmlspecialchars($rolNombre) ?></span>
          <p id="profile-area" class="text-white opacity-75 mb-3">
            <?= htmlspecialchars($cargoLabel) ?> Del Área <?= htmlspecialchars($areaLegible) ?>
          </p>
        </div>

        <div id="contact-info">
          <h5 id="contact-title">Información de Contacto</h5>
          <div class="info-item">
            <i class="fas fa-envelope"></i>
            <span><?= htmlspecialchars($email) ?></span>
          </div>
          <div class="info-item">
            <i class="fas fa-phone-alt"></i>
            <span><?= htmlspecialchars($telefono) ?></span>
          </div>
          <div class="info-item">
            <i class="fas fa-map-marker-alt"></i>
            <span><?= htmlspecialchars($direccion) ?></span>
          </div>
        </div>
      </div>
    </div>

    <!-- Principal -->
    <div class="col-lg-8">
      <div id="details-card" data-aos="fade-left">
        <div id="card-header">
          <h5 class="mb-0 text-white"><i class="fas fa-user-circle me-2"></i>Detalles del Perfil</h5>
        </div>
        <div id="card-body">
          <form action="/sennova/routes/UpdateProfile.php" method="POST" class="px-2">
            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">

            <div class="row mb-4">
              <label class="col-sm-3 col-form-label form-label">Nombre de Usuario</label>
              <div class="col-sm-9">
                <div class="input-group">
                  <span class="input-group-text"><i class="fas fa-user"></i></span>
                  <input type="text" name="nombre" class="form-control"
                    value="<?= htmlspecialchars($nombre) ?>" minlength="3" maxlength="80" required>
                </div>
              </div>
            </div>

            <div class="row mb-4">
              <label class="col-sm-3 col-form-label form-label">Teléfono</label>
              <div class="col-sm-9">
                <div class="input-group">
                  <span class="input-group-text"><i class="fas fa-phone"></i></span>
                  <input type="text" name="telefono" class="form-control"
                    value="<?= htmlspecialchars($telefono) ?>"
                    pattern="[\d\s()+-]{7,20}" title="Solo números, espacios y (+) (-)" required>
                </div>
              </div>
            </div>

            <div class="row mb-4">
              <label class="col-sm-3 col-form-label form-label">Dirección</label>
              <div class="col-sm-9">
                <div class="input-group">
                  <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                  <input type="text" name="direccion" class="form-control"
                    value="<?= htmlspecialchars($direccion) ?>" minlength="5" maxlength="120" required>
                </div>
              </div>
            </div>

            <!-- NO editables -->
            <div class="row mb-4">
              <label class="col-sm-3 col-form-label form-label">Correo Electrónico</label>
              <div class="col-sm-9">
                <div class="input-group">
                  <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                  <input type="email" class="form-control bg-light" value="<?= htmlspecialchars($email) ?>" readonly>
                </div>
              </div>
            </div>

            <div class="row mb-4">
              <label class="col-sm-3 col-form-label form-label">Rol</label>
              <div class="col-sm-9">
                <div class="input-group">
                  <span class="input-group-text"><i class="fas fa-user-shield"></i></span>
                  <input type="text" class="form-control bg-light" value="<?= htmlspecialchars($rolNombre) ?>" readonly>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-sm-9 offset-sm-3">
                <button type="submit" id="save-btn">
                  <i class="fas fa-save me-1"></i> Guardar cambios
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Toast global (una sola vez en tu layout es suficiente) -->
<div id="toast-container" class="position-fixed top-0 end-0 p-3">
  <div id="appToast" class="toast align-items-center text-bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="d-flex">
      <div id="appToastMsg" class="toast-body">...</div>
      <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
  </div>
</div>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  // Inicializar AOS (Animate On Scroll)
  AOS.init({
    duration: 800,
    once: true
  });

  document.addEventListener('DOMContentLoaded', () => {
    const params = new URLSearchParams(location.search);
    const mensaje = params.get('mensaje');
    const error = params.get('error');

    const map = {
      perfil_ok: {
        cls: 'text-bg-success',
        text: 'Perfil actualizado correctamente.'
      },
      error_auth: {
        cls: 'text-bg-danger',
        text: 'Acceso denegado: usuario no autenticado.'
      }
    };

    let cfg = null;
    if (error) cfg = {
      cls: 'text-bg-danger',
      text: decodeURIComponent(error)
    };
    else if (mensaje && map[mensaje]) cfg = map[mensaje];

    if (!cfg) return;

    const toastEl = document.getElementById('appToast');
    const bodyEl = document.getElementById('appToastMsg');
    toastEl.className = `toast align-items-center ${cfg.cls} border-0`;
    bodyEl.textContent = cfg.text;

    new bootstrap.Toast(toastEl, {
      delay: 3500,
      autohide: true
    }).show();

    // Limpia el querystring para no repetir el toast
    params.delete('mensaje');
    params.delete('error');
    const qs = params.toString();
    history.replaceState({}, '', qs ? `${location.pathname}?${qs}${location.hash}` : `${location.pathname}${location.hash}`);
  });
</script>
<style>
  :root {
    --gradient-primary: linear-gradient(90deg, #2c3e50 0%, #1a1a2e 100%);
    --gradient-secondary: linear-gradient(135deg, #3498db 0%, #2c3e50 100%);
    --color-primary: #2c3e50;
    --color-secondary: #1a1a2e;
    --color-accent: #3498db;
    --color-light: #ecf0f1;
    --color-text: #333;
    --shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    --border-radius: 12px;
  }

  body {
    background-color: #f8f9fa;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    color: var(--color-text);
    line-height: 1.6;
  }

  #profile-container {
    max-width: 1200px;
    margin: 2rem auto;
    padding: 0 1rem;
  }

  #profile-card {
    background: white;
    border-radius: var(--border-radius);
    box-shadow: var(--shadow);
    overflow: hidden;
    transition: transform 0.3s ease;
  }

  #profile-card:hover {
    transform: translateY(-5px);
  }

  #profile-header {
    background: var(--gradient-primary);
    color: white;
    padding: 2.5rem 2rem;
    text-align: center;
    position: relative;
  }

  #profile-avatar {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    border: 4px solid rgba(255, 255, 255, 0.3);
    margin-bottom: 1.5rem;
    object-fit: cover;
  }

  #profile-name {
    font-weight: 700;
    margin-bottom: 0.5rem;
    font-size: 1.5rem;
  }

  #profile-role {
    display: inline-block;
    background: rgba(255, 255, 255, 0.2);
    padding: 0.3rem 1rem;
    border-radius: 20px;
    font-size: 0.9rem;
    margin-bottom: 0.5rem;
  }

  #profile-area {
    opacity: 0.9;
    margin-bottom: 1.5rem;
  }

  #upload-btn {
    background: rgba(255, 255, 255, 0.2);
    border: 1px solid rgba(255, 255, 255, 0.3);
    color: white;
    padding: 0.5rem 1.2rem;
    border-radius: 30px;
    transition: all 0.3s ease;
    font-size: 0.9rem;
  }

  #upload-btn:hover {
    background: rgba(255, 255, 255, 0.3);
    transform: translateY(-2px);
  }

  #contact-info {
    padding: 1.5rem 2rem;
  }

  #contact-title {
    font-weight: 600;
    margin-bottom: 1.2rem;
    color: var(--color-primary);
    font-size: 1.1rem;
    border-bottom: 1px solid #eee;
    padding-bottom: 0.5rem;
  }

  .info-item {
    display: flex;
    align-items: center;
    margin-bottom: 1rem;
    padding: 0.5rem 0;
  }

  .info-item i {
    width: 30px;
    height: 30px;
    background: var(--gradient-secondary);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    margin-right: 1rem;
    font-size: 0.9rem;
  }

  #details-card {
    background: white;
    border-radius: var(--border-radius);
    box-shadow: var(--shadow);
    overflow: hidden;
  }

  #card-header {
    background: var(--gradient-primary);
    color: white;
    padding: 1.2rem 1.5rem;
  }

  #card-header h5 {
    margin: 0;
    font-weight: 600;
  }

  #card-body {
    padding: 2rem;
  }

  .form-label {
    font-weight: 600;
    color: var(--color-primary);
  }

  .input-group-text {
    background: var(--gradient-secondary);
    color: white;
    border: none;
  }

  .form-control {
    border: 1px solid #ddd;
    padding: 0.75rem;
    transition: all 0.3s ease;
  }

  .form-control:focus {
    border-color: var(--color-accent);
    box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
  }

  .form-control.bg-light {
    background-color: #f8f9fa !important;
  }

  #save-btn {
    background: var(--gradient-primary);
    border: none;
    color: white;
    padding: 0.7rem 1.8rem;
    border-radius: 30px;
    font-weight: 600;
    transition: all 0.3s ease;
  }

  #save-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
  }

  #toast-container {
    z-index: 1080;
  }

  #appToast {
    border-radius: 8px;
  }

  @media (max-width: 768px) {
    #profile-container {
      margin: 1rem auto;
    }

    #profile-header,
    #contact-info,
    #card-body {
      padding: 1.5rem 1rem;
    }

    .info-item {
      flex-direction: column;
      align-items: flex-start;
    }

    .info-item i {
      margin-bottom: 0.5rem;
    }
  }
</style>