<!DOCTYPE html>
<html lang="es">
<?php
require_once __DIR__ . '/../models/PubliModel.php';
$modelo = new ServicioCafeModel();
$servi = $modelo->obtenerServi();
?>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Laboratorio de Café</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
  <link rel="icon" type="image/x-icon" href="/sennova/img/l2.png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet" />
  <link href="/sennova/css/cofy.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>

<body class="antialiased text-gray-800">
  <!-- Encabezado institucional Bootstrap -->
  <header class="header-suave py-3 position-relative" style="background-color: #14532d;">
    <div
      class="container d-flex flex-column flex-md-row justify-content-between align-items-center text-center text-md-start">
      <a href="index.php" class="mb-2 mb-md-0 text-decoration-none d-flex align-items-center text-white">
        <span class="fs-6 fw-semibold">
          Centro de Desarrollo Agroempresarial <br>
          y Turístico del Huila
        </span>
      </a>

      <nav>
        <ul class="nav nav-pills">
          <li class="nav-item">
            <a href="index.php" class="nav-link text-white fw-semibold">Inicio</a>
          </li>
          <li class="nav-item">
            <a href="inElectronica.php" class="nav-link text-white fw-semibold">Laboratorio de Electrónica</a>
          </li>
        </ul>
      </nav>
    </div>
  </header>

  <?php if (isset($_GET['exito'])): ?>
    <div id="alertaExito" class="fixed inset-0 z-50 flex items-center justify-center bg-black/40">
      <div class="bg-white rounded-xl p-8 shadow-2xl text-center animate-fade-in-up relative w-80">
        <div id="lottiePlane" class="mx-auto mb-6" style="width:150px; height:150px;"></div>
        <p class="text-gray-800 font-semibold text-lg">
          ¡Tu solicitud fue enviada correctamente
          <?php if (isset($_GET['area'])): ?>
            del área <?= htmlspecialchars($_GET['area']) ?>
            <?php endif; ?>!
        </p>
      </div>
    </div>

    <script src="https://unpkg.com/lottie-web@latest/build/player/lottie.min.js"></script>
    <script>
      // Cargar animación Lottie
      lottie.loadAnimation({
        container: document.getElementById('lottiePlane'),
        path: 'img/Successfully_Plane.json', // Asegúrate de que este archivo exista
        renderer: 'svg',
        loop: false,
        autoplay: true,
        name: 'sendPlane',
      });

      // Ocultar el modal después de 3 segundos
      setTimeout(() => {
        const alerta = document.getElementById('alertaExito');
        if (alerta) {
          alerta.style.transition = 'opacity 0.5s ease';
          alerta.style.opacity = '0';
          setTimeout(() => alerta.remove(), 600);
        }
      }, 3000);

      // Eliminar el parámetro ?exito de la URL
      if (window.history.replaceState) {
        const url = new URL(window.location);
        url.searchParams.delete('exito');
        window.history.replaceState({}, document.title, url.pathname + url.search);
      }
    </script>

    <style>
      @keyframes fade-in-up {
        0% {
          opacity: 0;
          transform: translateY(20px);
        }

        100% {
          opacity: 1;
          transform: translateY(0);
        }
      }

      .animate-fade-in-up {
        animation: fade-in-up 0.5s ease-out;
      }
    </style>
  <?php endif; ?>


  <!-- Hero moderno TailwindCSS -->
  <?php
  require_once 'models/PubliModel.php';
  $model = new PortadaModel();
  $area = basename(__FILE__) === 'calidad.php' ? 'cafe' : 'electronica';
  $portada = $model->obtenerPortadaPorArea($area);

  // Datos con fallback
  $imagen = $portada ? $portada['ruta_img_port'] : 'img/default.jpg';
  $titulo = $portada ? $portada['title_port'] : 'Bienvenido al laboratorio';
  $descripcion = $portada ? $portada['desc_port'] : 'Descripción por defecto para el laboratorio.';
  ?>
  <section id="inicio" class="relative text-white py-20 lg:py-32 overflow-hidden" data-aos="fade-up"
    style="background: url('/sennova/<?= htmlspecialchars($imagen) ?>') center center / cover no-repeat;">
    <div class="absolute inset-0 bg-black bg-opacity-50"></div>

    <div class="relative container mx-auto px-4 text-center">
      <h2 class="text-4xl lg:text-6xl font-bold mb-6 animate-float">
        <?= htmlspecialchars($titulo) ?>
      </h2>
      <p class="text-xl lg:text-2xl mb-8 opacity-90 max-w-3xl mx-auto">
        <?= htmlspecialchars($descripcion) ?>
      </p>
      <button onclick="document.getElementById('contacto').scrollIntoView({behavior:'smooth'})"
        class="bg-white text-coffee-brown-600 px-8 py-4 rounded-full text-lg font-semibold hover:bg-gray-100 transform hover:scale-105 transition-shadow duration-300 shadow-lg">
        Solicitar Servicio
      </button>
    </div>
  </section>



  <!-- Sección de video profesional -->
  <?php
  require_once 'models/PubliModel.php';
  $model = new VideoModel();
  $video = $model->obtenerVideoPorArea('cafe'); // o 'cafe'
  ?>

  <?php if ($video): ?>
    <section class="py-20 text-white" style="background: #273d35ff;" data-aos="fade-up">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-6 mb-4 mb-lg-0">
            <video class="w-100 rounded-4 shadow" controls autoplay muted loop playsinline>
              <source src="/sennova/<?= htmlspecialchars($video['ruta_video']) ?>" type="video/mp4">
              Tu navegador no soporta el video.
            </video>
          </div>
          <div class="col-lg-6 ps-lg-5">
            <h2 class="text-4xl font-bold text-white mb-4"><?= htmlspecialchars($video['title_vid']) ?></h2>
            <p class="text-lg text-gray-300 mb-3"><?= nl2br(htmlspecialchars($video['text_pri'])) ?></p>
            <p class="text-gray-400"><?= nl2br(htmlspecialchars($video['text_sec'])) ?></p>
          </div>
        </div>
      </div>
    </section>
  <?php else: ?>
    <p class="text-center text-white my-5">No se ha cargado aún un video para esta área.</p>
  <?php endif; ?>


  <!-- Publicaciones -->
  <section class="py-20 bg-gray-300">
    <?php if (!empty($publicaciones)): ?>
      <div class="container py-5">
        <h2 class="text-center text-4xl font-bold text-dark mb-5 position-relative aos-init aos-animate"
          data-aos="fade-up" data-aos-delay="100" data-aos-duration="1000"
          style="text-shadow: 1px 1px 2px rgba(255, 255, 255, 1);">
          Nuestras Publicaciones
          <span class="d-block mx-auto mt-2"
            style="width: 80px; height: 4px; background-color: #000000ff; border-radius: 2px;"></span>
        </h2>
        <div class="row mt-5">
          <?php foreach ($publicaciones as $index => $publi): ?>
            <div class="col-md-6 mb-4" data-aos="zoom-in" <?= $index % 2 !== 0 ? 'data-aos-delay="150"' : '' ?>>
              <div class="card flex-md-row shadow-sm h-md-250 border-0" style="background: #f5f2eb;">
                <div class="card-body d-flex flex-column justify-content-center text-center text-md-start">
                  <strong class="text-success mb-2"><?= htmlspecialchars(ucfirst($publi['type_pu'])) ?></strong>
                  <h3 class="mb-0">
                    <a href="#" class="text-dark"><?= htmlspecialchars($publi['title']) ?></a>
                  </h3>
                  <p class="card-text mb-auto">
                    <?= nl2br(htmlspecialchars(substr($publi['content'], 0, 100))) ?>...
                  </p>
                  <div class="text-muted mb-1"><?= date("M d, Y", strtotime($publi['published_at'])) ?></div>
                  <a href="#" class="fw-semibold" style="color:#3d5a40;" data-bs-toggle="modal"
                    data-bs-target="#modal<?= $publi['id'] ?>">
                    Seguir leyendo
                  </a>
                  <div class="mt-3">
                    <a href="#contacto" class="btn text-white rounded-pill px-4 py-2" style="background: #273d35ff;">
                      <i class="bi bi-envelope-fill me-2"></i> Solicitar
                    </a>
                  </div>
                </div>
                <img src="/sennova/img/<?= htmlspecialchars($publi['image_path']) ?>" alt="Imagen publicación"
                  class="mx-auto d-block d-md-inline-block"
                  style="width:200px; height:250px; object-fit:cover; cursor:pointer;" data-bs-toggle="modal"
                  data-bs-target="#modal<?= $publi['id'] ?>" />
              </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="modal<?= $publi['id'] ?>" tabindex="-1" aria-hidden="true">
              <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content" style="background:#f5f2eb;">
                  <div class="modal-header" style="background:#4b3621;">
                    <h5 class="modal-title text-white"><?= htmlspecialchars($publi['title']) ?></h5>
                    <button type="button" class="btn-close bg-light" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                  </div>
                  <div class="modal-body">
                    <img src="/sennova/img/<?= htmlspecialchars($publi['image_path']) ?>" alt="Imagen publicación"
                      class="img-fluid rounded mb-3" style="max-height:300px; object-fit:cover; width:100%;">
                    <p class="text-muted"><?= date("d M Y", strtotime($publi['published_at'])) ?></p>
                    <p><?= nl2br(htmlspecialchars($publi['content'])) ?></p>
                  </div>
                  <div class="modal-footer">
                    <a href="#contacto" class="btn" style="background:#3d5a40; color:white;">Solicitar</a>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                  </div>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    <?php else: ?>
      <div class="alert alert-warning text-center bg-light">No hay publicaciones de Café disponibles.</div>
    <?php endif; ?>
  </section>

  <!-- Servicios -->
  <section id="servicios" class="py-20" style="background: rgba(108, 143, 131, 1);">
    <div class="container py-5">
      <h2 class="text-center text-4xl font-bold text-dark mb-5 position-relative aos-init aos-animate"
        data-aos="fade-up" data-aos-delay="100" data-aos-duration="1000"
        style="text-shadow: 1px 1px 2px rgba(255, 255, 255, 1);">
        Nuestros Servicios
        <span class="d-block mx-auto mt-2"
          style="width: 80px; height: 4px; background-color: #000000ff; border-radius: 2px;"></span>
      </h2>
      <?php if (!empty($servi)): ?>
        <div class="row justify-content-center g-4">
          <?php foreach ($servi as $servicio): ?>
            <div class="col-12 col-md-6 col-lg-4 d-flex" data-aos="fade-up" data-aos-duration="800">
              <div class="card h-100 shadow rounded-4 border-0 w-100" style="background:#f5f2eb;">
                <div class="card-body d-flex flex-column justify-content-between p-4">
                  <div class="text-center">
                    <div class="rounded-circle bg-light d-flex align-items-center justify-content-center mx-auto mb-3"
                      style="width: 90px; height: 90px;">
                      <img src="img/<?= htmlspecialchars($servicio['icono_ca']) ?>" alt="icono"
                        style="max-width: 60%; max-height: 60%;">
                    </div>
                    <h5 class="fw-bold mb-2" style="color: #273d35ff;"><?= htmlspecialchars($servicio['titulo_ca']) ?></h5>
                    <p class="text-muted mb-3"><?= htmlspecialchars($servicio['des_corta']) ?></p>
                    <div class="fw-bold fs-5" style="color:#273d35ff;">
                      Desde <?= number_format($servicio['precio_ca'], 0, ',', '.') . ' COP' ?>
                    </div>
                  </div>
                  <div class="mt-4 text-center">
                    <button class="btn text-white rounded-pill px-4 py-2 " style="background: #273d35ff;"
                      data-bs-toggle="modal" data-bs-target="#modal-cafe<?= $servicio['id_ca'] ?>">
                      <i class="fas fa-circle-info me-2"></i> Más Información
                    </button>
                  </div>
                </div>
              </div>
            </div>



            <!-- Modal de cada servicio -->
            <div class="modal fade" id="modal-cafe<?= $servicio['id_ca'] ?>" tabindex="-1"
              aria-labelledby="modalLabel-cafe<?= $servicio['id_ca'] ?>" aria-hidden="true">
              <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content border-0 shadow rounded-4">

                  <!-- Cabecera del Modal -->
                  <div class="modal-header bg-dark text-white rounded-top-4">
                    <h5 class="modal-title d-flex align-items-center" id="modalLabel-elect<?= $servicio['id_ca'] ?>">
                      <i class="fas fa-wrench me-2 text-warning"></i> <?= htmlspecialchars($servicio['titulo_ca']) ?>
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                      aria-label="Cerrar"></button>
                  </div>

                  <!-- Cuerpo del Modal -->
                  <div class="modal-body py-4 px-4">
                    <div class="row g-4 align-items-start">

                      <!-- Columna: Detalles del servicio -->
                      <div class="col-md-7">
                        <h6 class="text-muted fw-bold mb-2">Sobre el servicio</h6>
                        <p class="text-muted small"><?= nl2br(htmlspecialchars($servicio['des_larga'])) ?></p>

                        <div class="mt-3">
                          <span class="badge bg-warning text-dark fs-6">
                            <i class="fas fa-tag me-1"></i> Desde <?= number_format($servicio['precio_ca'], 0, ',', '.') ?>
                            COP
                          </span>
                        </div>
                      </div>

                      <!-- Columna: Opciones de pago -->
                      <div class="col-md-5 text-center">
                        <div class="bg-light rounded-3 p-4 shadow-sm h-100">
                          <h6 class="fw-semibold text-dark mb-3">
                            <i class="fas fa-cash-register me-2 text-success"></i>Métodos de Pago Aceptados
                          </h6>

                          <ul class="list-unstyled text-muted small">
                            <li><i class="fas fa-check-circle text-success me-2"></i> Transferencia Bancaria</li>
                            <li><i class="fas fa-check-circle text-success me-2"></i> Pago Contra Entrega</li>
                            <li><i class="fas fa-check-circle text-success me-2"></i> Pagos Virtuales Disponibles</li>
                          </ul>

                          <div class="alert alert-info mt-4 small mb-0" style="font-size: 0.85rem;">
                            Para realizar pagos virtuales, te enviaremos el enlace una vez agendes el servicio.
                          </div>
                        </div>
                      </div>


                    </div>
                  </div>

                  <!-- Footer -->
                  <div class="modal-footer border-0 justify-content-between px-4 pb-3">
                    <small class="text-muted">
                      ¿Dudas? Escríbenos a <a href="mailto:soporte@empresa.com"
                        class="text-decoration-none">soporte@empresa.com</a>
                    </small>
                    <button type="button" class="btn btn-outline-secondary rounded-pill" data-bs-dismiss="modal">
                      <i class="fas fa-times me-1"></i> Cerrar
                    </button>
                  </div>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      <?php else: ?>
        <p class="text-center text-light">No hay servicios disponibles por el momento.</p>
      <?php endif; ?>
    </div>
  </section>

  <!-- Nosotros -->
  <section id="nosotros" class="py-20 bg-gray-300" data-aos="fade-up">
    <div class="container mx-auto px-4">
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
        <div>
          <h3 class="text-4xl font-bold text-gray-900 mb-6">Excelencia Técnica SENA</h3>
          <p class="text-lg text-gray-700 mb-6">
            Nuestro Laboratorio de Café forma parte del Sistema Nacional de Aprendizaje (SENA),
            con más de 60 años de experiencia en formación técnica y tecnológica para el sector cafetero.
          </p>
          <ul class="space-y-3">
            <li class="flex items-center text-sena-green-500 font-medium"><i
                class="bi bi-check-circle-fill me-2"></i>Equipos de Análisis Físico
              Especializados</li>
            <li class="flex items-center text-sena-green-500 font-medium"><i
                class="bi bi-check-circle-fill me-2"></i>Catadores Q‑Graders Certificados
            </li>
          </ul>
        </div>
        <div class="flex justify-center">
          <div
            class="bg-gray-200 rounded-xl p-12 text-center shadow-xl transform hover:scale-105 transition duration-300">
            <div class="text-8xl text-white mb-4">☕</div>
            <div class="text-6xl text-white mb-4">🌱</div>
            <div class="text-8xl text-white">🔬</div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Contacto -->
  <section id="contacto" class="py-20" style="background: rgba(108, 143, 131, 1);">
    <div class="container mx-auto px-4">
      <h2 class="text-4xl font-bold text-center text-gray-900 mb-16">Solicitar Servicio</h2>

      <div class="max-w-2xl mx-auto">
        <form id="contactForm" action="/sennova/routes/solicitud.php" method="POST"
          class="bg-white text-gray-900 rounded-2xl p-10 shadow-2xl border border-gray-200 transition-all duration-300">

          <!-- Área oculta -->
          <input type="hidden" name="area" value="cafe">
          <input type="hidden" name="redirect" value="inCalidad.php">

          <!-- Nombre / Empresa -->
          <div class=" mb-6">
            <div>
              <label for="nombre" class="block text-gray-700 font-semibold mb-2">Nombre Completo</label>
              <input type="text" id="nombre" name="nombre" required
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:border-green-600 focus:ring-green-600 focus:outline-none focus:ring-2 transition duration-200">
            </div>

          </div>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
              <label for="empresa" class="block text-gray-700 font-semibold mb-2">Finca / Cooperativa</label>
              <input type="text" id="empresa" name="empresa"
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:border-green-600 focus:ring-green-600 focus:outline-none focus:ring-2 transition duration-200">
            </div>
            <!-- Cédula -->
            <div class="mb-6">
              <label for="cc_cliente" class="block text-gray-700 font-semibold mb-2">Cédula</label>
              <input
                type="text"
                id="cc_cliente"
                name="cc_cliente"
                required
                maxlength="12"
                inputmode="numeric"
                pattern="[0-9]*"
                oninput="this.value = this.value.replace(/[^0-9]/g,'')"
                class="only-numbers w-full px-4 py-3 border border-gray-300 rounded-lg focus:border-green-600 focus:ring-green-600 focus:outline-none focus:ring-2 transition duration-200">
            </div>
          </div>

          <!-- Email -->
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
              <label for="email" class="block text-gray-700 font-semibold mb-2">Correo Electrónico</label>
              <input type="email" id="email" name="email"
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:border-green-600 focus:ring-green-600 focus:outline-none focus:ring-2 transition duration-200">
              <label class="mt-1 flex items-center gap-2 justify-end text-xs text-gray-600 select-none">
                <input type="checkbox" id="no_email" class="h-3 w-3"> No disponible
              </label>
            </div>

            <!-- Teléfono -->
            <div>
              <label for="telefono" class="block text-gray-700 font-semibold mb-2">Teléfono</label>
              <div class="flex">
                <span class="inline-flex items-center px-3 rounded-l-lg border border-r-0 border-gray-300 bg-gray-100 text-gray-600 text-sm">+57</span>
                <input
                  type="text"
                  id="telefono"
                  name="telefono"
                  maxlength="10"
                  inputmode="numeric"
                  pattern="[0-9]*"
                  oninput="this.value = this.value.replace(/[^0-9]/g,'').slice(0,10)"
                  class="only-numbers w-full px-4 py-3 border border-gray-300 rounded-r-lg focus:border-green-600 focus:ring-green-600 focus:outline-none focus:ring-2 transition duration-200">
              </div>
              <label class="mt-1 flex items-center gap-2 justify-end text-xs text-gray-600 select-none">
                <input type="checkbox" id="no_tel" class="h-3 w-3"> No disponible
              </label>
            </div>
          </div>
          <!-- Mensaje de validación -->
          <p id="contactError" class="mt-2 text-sm text-red-600"></p>

          <!-- Tipo de servicio -->
          <div class="mb-6">
            <label for="servicio" class="block text-gray-700 font-semibold mb-2">Tipo de Servicio</label>
            <select id="servicio" name="servicio" required
              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:border-green-600 focus:ring-green-600 focus:outline-none focus:ring-2 transition duration-200">
              <option value="">Seleccione un servicio</option>
              <option value="sensorial">Diseño de tarjetas de circuito impreso (PCB)</option>
              <option value="fisicoquimico">Fabricación de tarjetas PCB</option>
              <option value="calidad">Diseño de piezas 3D</option>
              <option value="tueste">Impresión de piezas 3D</option>
              <option value="asesoria">Integración de soluciones tecnológicas</option>
            </select>
          </div>

          <!-- Descripción -->
          <div class="mb-8">
            <label for="descripcion" class="block text-gray-700 font-semibold mb-2">Descripción del Servicio</label>
            <textarea id="descripcion" name="descripcion" rows="5"
              placeholder="Describa el proyecto, requerimientos técnicos, objetivos, etc."
              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:border-green-600 focus:ring-green-600 focus:outline-none focus:ring-2 transition duration-200"></textarea>
          </div>



          <button type="submit"
            class="w-full bg-green-800 hover:bg-green-600 text-white py-4 rounded-lg text-lg font-semibold shadow-md hover:shadow-lg transform hover:scale-105 transition duration-300">
            Enviar Solicitud
          </button>
        </form>
      </div>
    </div>
  </section>

  <!-- PIE DE PAGINA -->
  <footer class="footer text-white pt-5 pb-4 mt-3" style="background: #273d35ff;">
    <div class="container">
      <div class="row g-4">

        <!-- Contacto -->
        <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3" data-aos="fade-up">
          <h5 class="text-uppercase mb-4 font-weight-bold" style="color: #22c55e;">Tu Empresa/Sitio</h5>
          <p>Una breve descripción sobre tu sitio, misión o lema principal.</p>
          <p><i class="fas fa-home me-3"></i> Dirección de la Calle, Ciudad</p>
          <p><i class="fas fa-envelope me-3"></i> info@tudominio.com</p>
          <p><i class="fas fa-phone me-3"></i> +XX XXX XXX XXX</p>
        </div>

        <!-- Enlaces -->
        <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mt-3" data-aos="fade-up" data-aos-delay="100">
          <h5 class="text-uppercase mb-4 font-weight-bold" style="color: #22c55e;">Enlaces Rápidos</h5>
          <p><a href="/publicaciones" class="text-white text-decoration-none">Publicaciones</a></p>
          <p><a href="/eventos" class="text-white text-decoration-none">Eventos</a></p>
          <p><a href="/nosotros" class="text-white text-decoration-none">Sobre Nosotros</a></p>
          <p><a href="/contacto" class="text-white text-decoration-none">Contacto</a></p>
        </div>

        <!-- Info -->
        <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mt-3" data-aos="fade-up" data-aos-delay="200">
          <h5 class="text-uppercase mb-4 font-weight-bold" style="color: #22c55e;">Información</h5>
          <p><a href="/privacidad" class="text-white text-decoration-none">Política de Privacidad</a></p>
          <p><a href="/terminos" class="text-white text-decoration-none">Términos y Condiciones</a></p>
          <p><a href="/preguntas-frecuentes" class="text-white text-decoration-none">Preguntas
              Frecuentes</a></p>
          <p><a href="/mapa-sitio" class="text-white text-decoration-none">Mapa del Sitio</a></p>
        </div>

        <!-- Redes y Newsletter -->
        <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mt-3" data-aos="fade-up" data-aos-delay="300">
          <h5 class="text-uppercase mb-4 font-weight-bold" style="color: #22c55e;">Síguenos</h5>
          <div class="mb-3">
            <a href="#" target="_blank" class="text-white me-3 fs-5"><i class="bi bi-facebook"></i></a>
            <a href="#" target="_blank" class="text-white me-3 fs-5"><i class="bi bi-twitter"></i></a>
            <a href="#" target="_blank" class="text-white me-3 fs-5"><i class="bi bi-instagram"></i></a>
            <a href="#" target="_blank" class="text-white fs-5"><i class="bi bi-linkedin"></i></a>
          </div>
        </div>
      </div>

      <hr class="my-4 text-white">

      <!-- Pie final -->
      <div class="row align-items-center" data-aos="fade-up" data-aos-delay="400">
        <div class="col-md-7 col-lg-8">
          <p class="mb-0">&copy;
            <script>
              document.write(new Date().getFullYear());
            </script> SENA. Todos los
            derechos reservados.
          </p>
        </div>
        <div class="col-md-5 col-lg-4 text-center text-md-end">
          <p class="mb-0">Hecho <i class="fas fa-heart text-danger"></i> por <strong>SENNOVA</strong></p>
        </div>
      </div>
    </div>
  </footer>

  <!-- SCRIPTS -->
  <style>
    .only-numbers::-webkit-outer-spin-button,
    .only-numbers::-webkit-inner-spin-button {
      -webkit-appearance: none;
      margin: 0;
    }

    .only-numbers {
      -moz-appearance: textfield;
    }
  </style>

  <!-- Script de validación -->
  <script>
    (function() {
      const form = document.getElementById("contactForm");
      const emailIn = document.getElementById("email");
      const telIn = document.getElementById("telefono");
      const noEmail = document.getElementById("no_email");
      const noTel = document.getElementById("no_tel");
      const errEl = document.getElementById("contactError");

      function setError(msg) {
        errEl.textContent = msg || "";
      }

      function clearError() {
        setError("");
      }

      function applyNoEmailState() {
        if (noEmail.checked) {
          emailIn.value = "Sin datos";
          emailIn.readOnly = true;
        } else {
          if (emailIn.value === "Sin datos") emailIn.value = "";
          emailIn.readOnly = false;
        }
      }

      function applyNoTelState() {
        if (noTel.checked) {
          telIn.value = "Sin datos";
          telIn.readOnly = true;
        } else {
          if (telIn.value === "Sin datos") telIn.value = "";
          telIn.readOnly = false;
        }
      }

      function enforceMutualExclusion(changed) {
        if (noEmail.checked && noTel.checked) {
          changed.checked = false;
          setError("Para continuar con la solicitud, debes proporcionar al menos un medio de contacto (correo o teléfono).");
          return false;
        }
        clearError();
        return true;
      }

      noEmail.addEventListener("change", function() {
        if (!enforceMutualExclusion(this)) return;
        applyNoEmailState();
      });
      noTel.addEventListener("change", function() {
        if (!enforceMutualExclusion(this)) return;
        applyNoTelState();
      });

      // Sanitizar teléfono
      telIn.addEventListener("input", function() {
        if (telIn.readOnly) return;
        this.value = this.value.replace(/[^0-9]/g, "").slice(0, 10);
      });

      // Validación al enviar
      form.addEventListener("submit", function(e) {
        const emailVal = (emailIn.value || "").trim();
        const telVal = (telIn.value || "").trim();

        const noContact =
          (emailVal === "" || emailVal === "Sin datos") &&
          (telVal === "" || telVal === "Sin datos");

        if (noEmail.checked && noTel.checked) {
          e.preventDefault();
          setError("Para continuar con la solicitud, debes proporcionar al menos un medio de contacto (correo o teléfono).");
          return;
        }

        if (noContact) {
          e.preventDefault();
          setError("Para continuar con la solicitud, debes llenar correo o teléfono como medio de contacto.");
          return;
        }

        clearError();
      });
    })();
  </script>

  <script src="/sennova/js/funcion.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <!-- TailwindCSS (CDN) -->
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    AOS.init();
  </script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            'sena-green': {
              50: '#f0f8f0',
              100: '#e8f5e8',
              200: '#a8d5ba',
              300: '#6b9b7a',
              400: '#4a7c59',
              500: '#2d5016',
              600: '#1a2f0c',
            }
          }
        }
      }
    }
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO"
    crossorigin="anonymous"></script>

</body>
</html>