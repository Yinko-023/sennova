<?php if (isset($_GET['error']) && $_GET['error'] === 'correo'): ?>
  <div class="custom-alert" role="alert" data-aos="fade-down">
    <div class="alert-content">
      <div class="alert-icon-wrapper">
        <i class="fas fa-exclamation-triangle"></i>
      </div>
      <div class="alert-text">
        <div class="alert-header">
          <h5>Error de validación</h5>
          <button type="button" class="alert-close" data-bs-dismiss="alert" aria-label="Close">
            <i class="fas fa-times"></i>
          </button>
        </div>
        <p>El correo electrónico ingresado ya está registrado en nuestro sistema. Por favor, utiliza una dirección diferente o <a href="#">recupera tu cuenta</a> si ya eres usuario.</p>
      </div>
    </div>
  </div>
<?php endif; ?>

<div class="edit-user-wrapper mt-5" data-aos="fade-up">
  <div class="edit-user-card">
    <div class="card-header">
      <h4><i class="fas fa-user-edit"></i> Editar Usuario</h4>
    </div>
    
    <div class="card-body">
      <form action="/sennova/routes/ActualizarUser.php" method="POST" class="needs-validation" novalidate>
        <input type="hidden" name="id" value="<?= $usuario['id'] ?>">
        
        <div class="form-grid">
          <!-- Username -->
          <div class="form-group">
            <label for="username">
              <i class="fas fa-user"></i> Nombre de usuario
            </label>
            <input type="text" name="username" value="<?= htmlspecialchars($usuario['username']) ?>" required>
            <div class="invalid-feedback">Por favor ingresa un nombre de usuario.</div>
          </div>
          
          <!-- Full Name -->
          <div class="form-group">
            <label for="full_name">
              <i class="fas fa-id-card"></i> Nombre completo
            </label>
            <input type="text" name="full_name" value="<?= htmlspecialchars($usuario['full_name']) ?>" required>
            <div class="invalid-feedback">Por favor ingresa el nombre completo.</div>
          </div>
          
          <!-- Email -->
          <div class="form-group">
            <label for="email_acc">
              <i class="fas fa-envelope"></i> Correo electrónico
              <span class="optional-badge">Opcional</span>
            </label>
            <input type="email" name="email_acc" value="<?= htmlspecialchars($usuario['email_acc']) ?>">
            <div class="invalid-feedback">Por favor ingresa un correo electrónico válido.</div>
          </div>
          
          <!-- Password -->
          <div class="form-group">
            <label for="password">
              <i class="fas fa-lock"></i> Contraseña
              <span class="optional-badge">Opcional</span>
            </label>
            <div class="password-input">
              <input type="password" name="password" id="password" placeholder="••••••••">
              <button type="button" id="togglePassword">
                <i class="fas fa-eye"></i>
              </button>
            </div>
            <small>Dejar en blanco para no cambiar</small>
          </div>
          
          <!-- Rol y Área (solo para admin) -->
          <?php if (isset($_SESSION['rol']) && $_SESSION['rol'] == 1): ?>
            <div class="form-group">
              <label for="rol">
                <i class="fas fa-user-tag"></i> Rol de usuario
              </label>
              <select name="rol" id="rol" required>
                <?php foreach ($roles as $rol): ?>
                  <option value="<?= $rol['id'] ?>" <?= $rol['id'] == $usuario['role_id'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($rol['name_rol']) ?>
                  </option>
                <?php endforeach; ?>
              </select>
            </div>
            
            <div class="form-group" id="grupo-area">
              <label for="area">
                <i class="fas fa-map-marker-alt"></i> Área asignada
              </label>
              <select name="area" id="area">
                <option value="">Seleccione un área</option>
                <option value="cafe" <?= $usuario['area'] === 'cafe' ? 'selected' : '' ?>>Café</option>
                <option value="electronica" <?= $usuario['area'] === 'electronica' ? 'selected' : '' ?>>Electrónica</option>
              </select>
            </div>
          <?php endif; ?>
        </div>
        
        <!-- Botones -->
        <div class="form-actions">
          <a href="/sennova/inAdmin.php?vista=inicio" class="cancel-btn">
            <i class="fas fa-times"></i> Cancelar
          </a>
          <button type="submit" class="submit-btn">
            <i class="fas fa-save"></i> Guardar cambios
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  // Mostrar/ocultar contraseña
  document.getElementById('togglePassword').addEventListener('click', function() {
    const passwordInput = document.getElementById('password');
    const icon = this.querySelector('i');
    
    if (passwordInput.type === 'password') {
      passwordInput.type = 'text';
      icon.classList.replace('fa-eye', 'fa-eye-slash');
    } else {
      passwordInput.type = 'password';
      icon.classList.replace('fa-eye-slash', 'fa-eye');
    }
  });
  
  // Validación de formulario
  (function() {
    'use strict';
    
    const forms = document.querySelectorAll('.needs-validation');
    
    Array.from(forms).forEach(function(form) {
      form.addEventListener('submit', function(event) {
        if (!form.checkValidity()) {
          event.preventDefault();
          event.stopPropagation();
        }
        
        form.classList.add('was-validated');
      }, false);
    });
  })();
  
  // Control de visibilidad del área según rol
  document.addEventListener("DOMContentLoaded", function() {
    const rolSelect = document.querySelector('select[name="rol"]');
    const areaGroup = document.getElementById("grupo-area");
    const areaSelect = document.getElementById("area");
    
    if (rolSelect && areaGroup && areaSelect) {
      function actualizarAreaSegunRol() {
        const rol = rolSelect.value;
        
        if (rol === "1") { // Admin
          areaGroup.style.display = "none";
          areaSelect.value = "";
        } else if (rol === "3") { // Publicador
          areaGroup.style.display = "block";
        } else { // Otros roles
          areaGroup.style.display = "none";
          areaSelect.value = "visualizador";
        }
      }
      
      rolSelect.addEventListener("change", actualizarAreaSegunRol);
      actualizarAreaSegunRol();
      
      // Validación adicional para publicadores
      document.querySelector('form').addEventListener('submit', function(e) {
        const rol = rolSelect.value;
        const area = areaSelect.value;
        
        if (rol === '3' && area === '') {
          e.preventDefault();
          
          // Mostrar feedback visual
          areaGroup.style.animation = 'shake 0.5s';
          areaSelect.focus();
          areaSelect.classList.add('is-invalid');
          
          // Crear elemento de feedback si no existe
          if (!document.getElementById('area-feedback')) {
            const feedback = document.createElement('div');
            feedback.id = 'area-feedback';
            feedback.className = 'invalid-feedback';
            feedback.textContent = 'Debes seleccionar un área para el rol de Publicador.';
            areaGroup.appendChild(feedback);
          }
          
          // Eliminar animación después de que termine
          setTimeout(() => {
            areaGroup.style.animation = '';
          }, 500);
        }
      });
    }
  });
</script>

<style>
  :root {
    --dark-blue: #1a1a2e;
    --medium-blue: #2c3e50;
    --accent-color: #4cc9f0;
    --error-color: #f72585;
    --light-gray: #f8f9fa;
    --medium-gray: #e9ecef;
    --dark-gray: #495057;
  }

  /* Diseño de la alerta */
  .custom-alert {
    background: white;
    border-left: 4px solid var(--error-color);
    box-shadow: 0 5px 20px rgba(247, 37, 133, 0.15);
    margin: 0 0 2rem 0;
    padding: 1.25rem;
    border-radius: 0;
    position: relative;
    overflow: hidden;
  }

  .alert-content {
    display: flex;
    align-items: flex-start;
    gap: 1rem;
  }

  .alert-icon-wrapper {
    background: rgba(247, 37, 133, 0.1);
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
  }

  .alert-icon-wrapper i {
    color: var(--error-color);
    font-size: 1.2rem;
  }

  .alert-text {
    flex-grow: 1;
  }

  .alert-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 0.5rem;
  }

  .alert-header h5 {
    color: var(--error-color);
    margin: 0;
    font-size: 1.1rem;
    font-weight: 600;
  }

  .alert-close {
    background: none;
    border: none;
    color: var(--dark-gray);
    opacity: 0.7;
    transition: opacity 0.2s;
    cursor: pointer;
    padding: 0.25rem;
  }

  .alert-close:hover {
    opacity: 1;
  }

  .custom-alert p {
    margin: 0;
    color: var(--dark-gray);
  }

  .custom-alert a {
    color: var(--error-color);
    font-weight: 500;
    text-decoration: underline;
  }

  /* Diseño del formulario */
  .edit-user-wrapper {
    max-width: 900px;
    margin: 0 auto;
    padding: 0 1rem;
  }

  .edit-user-card {
    background: white;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
  }

  .card-header {
    background: linear-gradient(180deg, #2c3e50 0%, #1a1a2e 100%);
    color: white;
    padding: 1.5rem 2rem;
    position: relative;
  }

  .card-header::after {
    content: "";
    position: absolute;
    top: 0;
    right: 0;
    width: 100px;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1));
  }

  .card-header h4 {
    margin: 0;
    font-weight: 600;
    letter-spacing: 0.5px;
    display: flex;
    align-items: center;
    gap: 0.75rem;
  }

  .card-header i {
    font-size: 1.2rem;
  }

  .card-body {
    padding: 2rem;
  }

  .form-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 1.5rem;
    margin-bottom: 2rem;
  }

  .form-group {
    margin-bottom: 0;
  }

  .form-group label {
    display: block;
    margin-bottom: 0.5rem;
    font-weight: 500;
    color: var(--dark-gray);
    display: flex;
    align-items: center;
    gap: 0.5rem;
  }

  .form-group i {
    color: var(--medium-blue);
    font-size: 0.9rem;
  }

  .form-group input,
  .form-group select {
    width: 100%;
    padding: 0.75rem 1rem;
    border: 1px solid var(--medium-gray);
    border-radius: 6px;
    transition: all 0.3s;
    background-color: white;
  }

  .form-group input:focus,
  .form-group select:focus {
    outline: none;
    border-color: var(--accent-color);
    box-shadow: 0 0 0 3px rgba(76, 201, 240, 0.2);
  }

  .password-input {
    position: relative;
  }

  .password-input input {
    padding-right: 40px;
  }

  .password-input button {
    position: absolute;
    right: 10px;
    top: 50%;
    transform: translateY(-50%);
    background: none;
    border: none;
    color: var(--dark-gray);
    cursor: pointer;
    opacity: 0.7;
    transition: opacity 0.2s;
  }

  .password-input button:hover {
    opacity: 1;
  }

  .optional-badge {
    background: var(--medium-gray);
    color: var(--dark-gray);
    font-size: 0.75rem;
    padding: 0.25rem 0.5rem;
    border-radius: 4px;
    margin-left: 0.5rem;
  }

  .invalid-feedback {
    color: var(--error-color);
    font-size: 0.85rem;
    margin-top: 0.25rem;
    display: none;
  }

  .was-validated .form-control:invalid ~ .invalid-feedback,
  .was-validated .form-select:invalid ~ .invalid-feedback {
    display: block;
  }

  .form-actions {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-top: 1.5rem;
    margin-top: 1.5rem;
    border-top: 1px solid var(--medium-gray);
  }

  .cancel-btn {
    background: none;
    border: 1px solid var(--medium-gray);
    color: var(--dark-gray);
    padding: 0.75rem 1.5rem;
    border-radius: 6px;
    font-weight: 500;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    transition: all 0.3s;
  }

  .cancel-btn:hover {
    background: var(--light-gray);
    color: var(--dark-gray);
  }

  .submit-btn {
    background: linear-gradient(135deg, #4361ee, #3f37c9);
    border: none;
    color: white;
    padding: 0.75rem 1.5rem;
    border-radius: 6px;
    font-weight: 500;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    transition: all 0.3s;
    box-shadow: 0 4px 10px rgba(67, 97, 238, 0.3);
  }

  .submit-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 15px rgba(67, 97, 238, 0.4);
  }

  @media (max-width: 768px) {
    .form-actions {
      flex-direction: column;
      gap: 1rem;
    }
    
    .cancel-btn,
    .submit-btn {
      width: 100%;
      justify-content: center;
    }
  }
</style>
