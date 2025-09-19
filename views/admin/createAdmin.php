<div class="theme-toggle" id="themeToggle">
  <i class="fas fa-moon"></i>
</div>
<div class="row justify-content-center mt-4">
  <div class="col-md-10 col-lg-8 col-xl-6">
    <!-- Tarjeta de registro -->
    <div class="auth-card">
      <div class="auth-header">
        <h2 class="auth-title">
          <i class="fas fa-user-shield me-2"></i>Registro de Usuario
        </h2>
      </div>

      <div class="card-body p-4 p-md-5">
        <form action="/sennova/routes/registerAdmin.php" method="POST" class="needs-validation" novalidate>

          <!-- Nombre de usuario -->
          <div class="mb-4">
            <label for="username" class="form-label">
              <i class="fas fa-user text-dark me-1"></i>Nombre de usuario
            </label>
            <input type="text" class="form-control" id="username" name="username" required
              placeholder="Ej: usuario123" />
            <div class="invalid-feedback">Por favor ingrese un nombre de usuario válido.</div>
          </div>

          <!-- Nombre completo -->
          <div class="mb-4">
            <label for="full_name" class="form-label">
              <i class="fas fa-id-card text-dark me-1"></i>Nombre completo
            </label>
            <input type="text" class="form-control" id="full_name" name="full_name" required
              placeholder="Nombre y apellidos" />
            <div class="invalid-feedback">Por favor ingrese su nombre completo.</div>
          </div>

          <!-- Correo -->
          <div class="mb-4">
            <label for="email_acc" class="form-label">
              <i class="fas fa-envelope text-dark me-1"></i>Correo electrónico
            </label>
            <input type="email" class="form-control" id="email_acc" name="email_acc" required
              placeholder="ejemplo@dominio.com" />
            <div class="invalid-feedback">Ingrese un correo válido.</div>
          </div>

          <!-- Contraseña -->
          <div class="mb-4">
            <label for="password_acc" class="form-label">
              <i class="fas fa-lock text-dark me-1"></i>Contraseña
            </label>
            <div class="input-group">
              <input type="password" class="form-control" id="password_acc" name="password_acc" required />
              <span class="input-group-text bg-white rounded-end" onclick="vista_form()" style="cursor: pointer;">
                <i class="bi bi-eye" id="ver"></i>
                <i class="bi bi-eye-slash" id="ocultar" style="display: none;"></i>
              </span>
            </div>
          </div>

          <!-- Rol -->
          <div class="mb-4">
            <label for="rol" class="form-label">
              <i class="fas fa-user-tag text-dark me-1"></i>Rol
            </label>
            <select class="form-select" id="rol" name="rol" required>
              <?php foreach ($roles as $rol): ?>
                <option value="<?= $rol['id'] ?>"><?= ucfirst($rol['name_rol']) ?></option>
              <?php endforeach; ?>
            </select>
          </div>

          <!-- Área -->
          <div class="mb-4" id="grupo-area">
            <label for="area" class="form-label">
              <i class="fas fa-building text-dark me-1"></i>Área asignada
            </label>
            <select class="form-select" id="area" name="area">
              <option value="">Seleccione un área</option>
              <option value="cafe">Café</option>
              <option value="electronica">Electrónica</option>
            </select>
          </div>

          <!-- Botón de enviar -->
          <div class="d-grid mt-5">
            <button type="submit" class="btn btn-auth py-3 text-light">
              <i class="fas fa-user-plus me-2"></i>Registrar Usuario
            </button>
          </div>
        </form>
      </div>
    </div>

  </div>
</div>
<script>
  function vista_form() {
    const p = document.getElementById('password_acc'),
      v = document.getElementById('ver'),
      o = document.getElementById('ocultar');
    const show = p.type === 'password';
    p.type = show ? 'text' : 'password';
    v.style.display = show ? 'none' : 'inline';
    o.style.display = show ? 'inline' : 'none';
  }
</script>
<script>
  const rolSelect = document.getElementById('rol');
  const areaGroup = document.getElementById('grupo-area');
  const areaInput = document.getElementById('area');

  // Crea la opción si no existe y la selecciona
  function ensureAreaOption(value, label) {
    let opt = areaInput.querySelector(`option[value="${value}"]`);
    if (!opt) {
      opt = new Option(label, value);
      opt.hidden = true; // no se muestra en el desplegable
      opt.dataset.auto = "1"; // marca para poder gestionarlas
      areaInput.add(opt);
    }
    areaInput.value = value;
  }

  function limpiarAutoAreas() {
    areaInput.querySelectorAll('option[data-auto="1"]').forEach(o => o.selected = false);
  }

  function mostrarSelectorArea() {
    areaGroup.style.display = "block";
    limpiarAutoAreas();
    if (["visualizador", "limitado"].includes(areaInput.value)) {
      areaInput.value = "";
    }
  }

  function ocultarSelectorAreaYSetear(value, label) {
    areaGroup.style.display = "none";
    ensureAreaOption(value, label);
  }

  function actualizarAreaSegunRol() {
    const rol = rolSelect.value;

    if (rol === "1") {
      areaGroup.style.display = "none";
      areaInput.value = "";
    } else if (rol === "2") {
      ocultarSelectorAreaYSetear("visualizador", "Visualizador");
    } else if (rol === "3") {
      mostrarSelectorArea();
    } else if (rol === "4") {
      ocultarSelectorAreaYSetear("limitado", "Limitado");
    } else {
      areaGroup.style.display = "none";
      areaInput.value = "";
    }
  }

  document.addEventListener("DOMContentLoaded", () => {
    actualizarAreaSegunRol();
    rolSelect.addEventListener("change", actualizarAreaSegunRol);
  });
</script>

<style>
  :root {
    --dark-800: #1e1e2d;
    --dark-700: #2a2a3c;
    --dark-600: #3a3a4c;
    --light-100: #f8f9fa;
    --light-200: #e9ecef;
    --success-500: #10b981;
    --danger-500: #ef4444;
    --warning-500: #f59e0b;
  }

  body {
    background-color: var(--light-200);
    color: #333;
    font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
  }

  body.dark {
    background-color: var(--dark-800);
    color: var(--light-200);
  }

  /* Card styling */
  .auth-card {
    border: none;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
  }

  body.dark .auth-card {
    background-color: var(--dark-700);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
  }

  .auth-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.12);
  }

  body.dark .auth-card:hover {
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.4);
  }

  /* Header - Actualizado con el nuevo gradiente */
  .auth-header {
    background: linear-gradient(90deg, #2c3e50 0%, #1a1a2e 100%);
    padding: 1.75rem;
    text-align: center;
    position: relative;
    overflow: hidden;
  }

  .auth-header::before {
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, rgba(255, 255, 255, 0) 70%);
    transform: rotate(30deg);
  }

  .auth-title {
    font-weight: 700;
    font-size: 1.5rem;
    position: relative;
    color: white;
  }

  /* Botón - Actualizado con el nuevo gradiente */
  .btn-auth {
    background: linear-gradient(90deg, #2c3e50 0%, #1a1a2e 100%);
    border: none;
    border-radius: 8px;
    padding: 0.75rem 1.5rem;
    font-weight: 600;
    letter-spacing: 0.5px;
    transition: all 0.3s ease;
    text-transform: uppercase;
    font-size: 0.875rem;
  }

  .btn-auth:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
    background: linear-gradient(90deg, #1a1a2e 0%, #2c3e50 100%);
  }

  /* Resto del CSS permanece igual */
  .form-control,
  .form-select {
    border-radius: 8px;
    padding: 0.75rem 1rem;
    border: 1px solid #ced4da;
    transition: all 0.3s ease;
  }

  body.dark .form-control,
  body.dark .form-select {
    background-color: var(--dark-600);
    border-color: var(--dark-600);
    color: var(--light-200);
  }

  .form-control:focus,
  .form-select:focus {
    border-color: var(--primary-500);
    box-shadow: 0 0 0 0.25rem rgba(99, 102, 241, 0.25);
  }

  body.dark .form-control:focus,
  body.dark .form-select:focus {
    background-color: var(--dark-600);
  }

  .input-group-text {
    background-color: var(--light-100);
    border-radius: 8px 0 0 8px;
  }

  body.dark .input-group-text {
    background-color: var(--dark-600);
    border-color: var(--dark-600);
    color: var(--light-200);
  }

  /* Labels */
  .form-label {
    font-weight: 600;
    margin-bottom: 0.5rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
  }

  /* Theme toggle */
  .theme-toggle {
    position: fixed;
    bottom: 2rem;
    right: 2rem;
    width: 3rem;
    height: 3rem;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--primary-500), var(--primary-600));
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    z-index: 1000;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    transition: all 0.3s ease;
  }

  .theme-toggle:hover {
    transform: scale(1.1);
  }

  /* Password toggle */
  .password-toggle {
    cursor: pointer;
    transition: color 0.2s;
    background-color: var(--light-100) !important;
    border-radius: 0 8px 8px 0 !important;
  }

  body.dark .password-toggle {
    background-color: var(--dark-600) !important;
  }

  .password-toggle:hover {
    color: var(--primary-500) !important;
  }

  /* Responsive adjustments */
  @media (max-width: 768px) {
    .auth-card {
      margin-top: 1rem;
      margin-bottom: 1rem;
    }
  }
</style>