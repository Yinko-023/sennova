<?php
if (session_status() === PHP_SESSION_NONE) session_start();
$nombre    = $_SESSION['nombre_usuario'] ?? 'Usuario';
$email     = $_SESSION['email']          ?? 'correo@ejemplo.com';
$telefono  = $_SESSION['telefono']       ?? 'Sin número';
$direccion = $_SESSION['direccion']      ?? 'Sin dirección';
$rol       = $_SESSION['rol_nombre']     ?? 'Sin rol';
$area      = $_SESSION['area']           ?? 'general';

$_SESSION['csrf_token'] = bin2hex(random_bytes(16));
?>


<div class="row g-4">
  <!-- Lateral -->
  <div class="col-lg-4">
    <div class="profile-card shadow-sm" data-aos="fade-right">
      <div class="profile-header">
        <img src="https://bootdey.com/img/Content/avatar/avatar7.png" class="profile-avatar" alt="Avatar">
        <h4 class="fw-bold mb-2"><?= htmlspecialchars($nombre) ?></h4>
        <span class="profile-role"><?= htmlspecialchars($rol) ?></span>
        <p class="text-white opacity-75 mb-3">Colaborador del área <?= htmlspecialchars($area) ?></p>
        <button class="btn btn-upload btn-sm" type="button">
          <i class="fas fa-upload me-1"></i> Cambiar Foto
        </button>
      </div>

      <div class="p-4">
        <h5 class="section-title">Información de Contacto</h5>
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
    <div class="profile-card shadow-sm" data-aos="fade-left">
      <div class="card-header-custom">
        <h5 class="mb-0 text-white"><i class="fas fa-user-circle me-2"></i>Detalles del Perfil</h5>
      </div>
      <div class="card-body p-4">
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
                <input type="text" class="form-control bg-light" value="<?= htmlspecialchars($rol) ?>" readonly>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-sm-9 offset-sm-3">
              <button type="submit" class="btn btn-edit">
                <i class="fas fa-save me-1"></i> Guardar cambios
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Toast global (una sola vez en tu layout es suficiente) -->
<div class="position-fixed top-0 end-0 p-3" style="z-index:1080">
  <div id="appToast" class="toast align-items-center text-bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="d-flex">
      <div class="toast-body" id="appToastMsg">...</div>
      <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
  const params  = new URLSearchParams(location.search);
  const mensaje = params.get('mensaje');
  const error   = params.get('error');

  const map = {
    perfil_ok: { cls: 'text-bg-success', text: 'Perfil actualizado correctamente.' },
    error_auth: { cls: 'text-bg-danger', text: 'Acceso denegado: usuario no autenticado.' }
  };

  let cfg = null;
  if (error) cfg = { cls: 'text-bg-danger', text: decodeURIComponent(error) };
  else if (mensaje && map[mensaje]) cfg = map[mensaje];

  if (!cfg) return;

  const toastEl = document.getElementById('appToast');
  const bodyEl  = document.getElementById('appToastMsg');
  toastEl.className = `toast align-items-center ${cfg.cls} border-0`;
  bodyEl.textContent = cfg.text;

  new bootstrap.Toast(toastEl, { delay: 3500, autohide: true }).show();

  // Limpia el querystring para no repetir el toast
  params.delete('mensaje'); params.delete('error');
  const qs = params.toString();
  history.replaceState({}, '', qs ? `${location.pathname}?${qs}${location.hash}` : `${location.pathname}${location.hash}`);
});
</script>

<style>
:root{
  --primary-color:#302e2e;
  --secondary-color:#28272b;
  --accent-color:#4cc9f0;
  --light-bg:#f8f9fa;
  --gray-text:#6c757d;
}
.profile-card{border:none;border-radius:15px;overflow:hidden;transition:.3s;background:#fff;box-shadow:0 10px 30px rgba(0,0,0,.05)}
.profile-card:hover{transform:translateY(-5px)}
.profile-header{background:linear-gradient(135deg,var(--primary-color),var(--secondary-color));padding:2rem 0;color:#fff;text-align:center}
.profile-avatar{width:120px;height:120px;border-radius:50%;border:4px solid #fff;object-fit:cover;margin-bottom:1rem;box-shadow:0 5px 15px rgba(0,0,0,.1)}
.profile-role{background-color:var(--accent-color);color:#fff;padding:.25rem 1rem;border-radius:20px;font-size:.8rem;display:inline-block;margin-bottom:1rem}
.info-item{padding:1rem;border-bottom:1px solid rgba(0,0,0,.05);transition:background-color .3s}
.info-item:hover{background-color:var(--light-bg)}
.info-item i{width:24px;text-align:center;margin-right:.5rem;color:var(--primary-color)}
.card-header-custom{background:linear-gradient(135deg,var(--primary-color),var(--secondary-color));border-radius:15px 15px 0 0!important;padding:1.25rem}
.form-label{font-weight:600;color:var(--gray-text)}
.btn-edit{background-color:var(--primary-color);color:#fff;border:none;padding:.5rem 1.5rem;border-radius:8px;transition:.3s}
.btn-edit:hover{background-color:var(--secondary-color);transform:translateY(-2px);box-shadow:0 5px 15px rgba(67,97,238,.3)}
.btn-upload{border:1px solid var(--primary-color);color:var(--primary-color);transition:.3s}
.btn-upload:hover{background-color:var(--primary-color);color:#fff}
.section-title{position:relative;padding-bottom:.5rem;margin-bottom:1.5rem}
.section-title:after{content:'';position:absolute;bottom:0;left:0;width:50px;height:3px;background:var(--accent-color);border-radius:3px}
</style>
