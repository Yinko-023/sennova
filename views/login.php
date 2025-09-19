<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Login</title>
  <link rel="icon" type="image/x-icon" href="/sennova/img/lo.png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="/sennova/css/login.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
</head>

<body>

  <section class="vh-100 d-flex align-items-center">
    <div class="container py-5">
      <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-11">
          <div class="card shadow-lg">
            <div class="row g-0">
              <!-- Imagen lateral -->
              <div class="col-md-6 d-none d-md-block">
                <img src="/sennova/img/login2.png" alt="login form" class="img-fluid h-100 w-100 object-fit-cover" />
              </div>

              <!-- Formulario -->
              <div class="col-md-6 d-flex align-items-center">
                <div class="card-body px-4 px-lg-5 py-5 text-black">

                  <form action="routes/LoginRoute.php" method="POST">
                    <?php if (isset($_GET['error'])): ?>
                      <div class="alert alert-danger text-center mb-4">❌ Las credenciales ingresadas no son válidas</div>
                    <?php endif; ?>

                    <h2 class="fw-bold mb-3 text-center">Iniciar Sesión</h2>
                    <p class="mb-4 text-muted text-center">Accede con tus credenciales</p>

                    <!-- Email -->
                    <div class="mb-4">
                      <label for="form2Example17" class="form-label">Correo electrónico</label>
                      <input type="email" id="form2Example17" name="email" class="form-control form-control-lg" required />
                    </div>

                    <!-- Contraseña -->
                    <div class="mb-4">
                      <label for="form2Example27" class="form-label">Contraseña</label>
                      <div class="input-group">
                        <input type="password" id="form2Example27" name="password"
                          class="form-control form-control-lg" required />
                        <span class="input-group-text bg-white" onclick="vista_form()" style="cursor: pointer;">
                          <i class="bi bi-eye" id="ver"></i>
                          <i class="bi bi-eye-slash" id="ocultar" style="display: none;"></i>
                        </span>
                      </div>
                    </div>

                    <!-- Botón -->
                    <div class="mb-3">
                      <input type="submit" name="btn" value="Iniciar Sesión" class="btn btn-outline-success" />
                    </div>

                    <div class="text-center">
                      <a href="index.php" class="small text-muted" style="text-decoration: none">← Volver al sitio</a>
                    </div>
                  </form>

                </div>
              </div>
              <!-- Fin formulario -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Scripts -->
  <script>
    function vista_form() {
      const pass = document.getElementById('form2Example27');
      const ver = document.getElementById('ver');
      const ocultar = document.getElementById('ocultar');
      if (pass.type === 'password') {
        pass.type = 'text';
        ver.style.display = 'none';
        ocultar.style.display = 'block';
      } else {
        pass.type = 'password';
        ver.style.display = 'block';
        ocultar.style.display = 'none';
      }
    }
  </script>

  <script src="/sennova/js/funcion.js"></script>
  <script type="text/javascript"
    src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.2.0/mdb.umd.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
    crossorigin="anonymous"></script>
</body>

</html>
