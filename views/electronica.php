<?php
require_once 'models/PubliModel.php';
$model = new PortadaModel();
$area = basename(__FILE__) === 'electronica.php' ? 'electronica' : 'cafe';
$portada = $model->obtenerPortadaPorArea($area);

// Datos con fallback
$imagen = $portada ? $portada['ruta_img_port'] : 'img/default.jpg';
$titulo = $portada ? $portada['title_port'] : 'Bienvenido al laboratorio';
$descripcion = $portada ? $portada['desc_port'] : 'Descripción por defecto para el laboratorio.';

$modelo = new ServicioElectronicaModel();
$servicios = $modelo->obtenerServicios();

$model = new VideoModel();
$video = $model->obtenerVideoPorArea('electronica');
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Laboratorio de Electrónica</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
  <link rel="icon" type="image/x-icon" href="/sennova/img/l2.png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet" />
  <link href="/sennova/css/electrony.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">


<body>

  <header class="header-suave py-3 position-relative " style="background-color: #14532d;">
    <div
      class="container d-flex flex-column flex-md-row justify-content-between align-items-center text-center text-md-start">
      <a href="index.php" class="mb-2 mb-md-0 text-decoration-none d-flex align-items-center text-white">
        <span class="fs-6 fw-semibold">
          Centro de Desarrollo Agroempresarial <br>
          y Turístico del Huila
        </span>
      </a>

<nav>
  <ul class="flex space-x-4">
    <li>
      <a href="index.php" 
         class="text-white font-semibold transition-all duration-200 hover:text-lg">
        Inicio
      </a>
    </li>
    <li>
      <a href="inCalidad.php" 
         class="text-white font-semibold transition-all duration-200 hover:text-lg">
        Laboratorio de Café y Cacao
      </a>
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

  <?php if ($video): ?>
    <section class="py-20 text-white bg-gray-900" data-aos="fade-up">
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

  <!-- Tarjetas informativas Bootstrap -->
  <section id="nosotros" class="publications-section bg-light-gray py-12">
    <?php if (!empty($publications)): ?>
      <div class="container mx-auto px-4 my-8">
        <!-- Encabezado premium consistente -->
        <div class="text-center mb-16" data-aos="fade-up">
          <span class="inline-block text-success uppercase tracking-widest text-sm font-semibold mb-3">Nuestro Contenido</span>
          <h2 class="text-4xl md:text-5xl font-bold text-dark mb-4 relative">
            Nuestras Publicaciones
            <span class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-20 h-1 bg-gradient-to-r from-success to-dark-success rounded-full mt-4"></span>
          </h2>
          <p class="text-lg text-gray-600 max-w-2xl mx-auto">Explora nuestras publicaciones especializadas y descubre contenido de valor</p>

        </div>

        <!-- Grid de publicaciones estilo corporativo -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-5">
          <?php foreach ($publications as $index => $publi): ?>
            <div class="publication-card" data-aos="fade-up" <?= $index % 2 !== 0 ? 'data-aos-delay="100"' : '' ?>>
              <div class="bg-white rounded-xl shadow-lg overflow-hidden h-full flex flex-col md:flex-row transition-all duration-300 hover:shadow-xl">
                <!-- Imagen -->
                <div class="md:w-2/5 h-48 md:h-auto relative overflow-hidden">
                  <img src="/sennova/img/<?= htmlspecialchars($publi['image_path']) ?>"
                    alt="<?= htmlspecialchars($publi['title']) ?>"
                    class="w-full h-full object-cover transition-transform duration-500 hover:scale-105 cursor-pointer"
                    data-bs-toggle="modal"
                    data-bs-target="#modal<?= $publi['id'] ?>">
                  <div class="absolute top-4 left-4">
                    <span class="inline-block bg-success text-white text-xs font-semibold px-3 py-1 rounded-full uppercase tracking-wider">
                      <?= htmlspecialchars(ucfirst($publi['type_pu'])) ?>
                    </span>
                  </div>
                </div>

                <!-- Contenido -->
                <div class="md:w-3/5 p-6 flex flex-col">
                  <h3 class="text-xl font-bold text-gray-900 mb-2">
                    <a href="#" class="hover:text-success transition-colors" data-bs-toggle="modal" data-bs-target="#modal<?= $publi['id'] ?>">
                      <?= htmlspecialchars($publi['title']) ?>
                    </a>
                  </h3>
                  <p class="text-gray-600 mb-4 flex-grow">
                    <?= nl2br(htmlspecialchars(substr($publi['content'], 0, 100))) ?>...
                  </p>
                  <div class="flex items-center justify-between">
                    <span class="text-sm text-gray-500">
                      <i class="far fa-calendar-alt mr-1"></i>
                      <?= date("M d, Y", strtotime($publi['published_at'])) ?>
                    </span>
                    <a href="#" class="text-sm font-semibold text-success hover:text-dark-success transition-colors"
                      data-bs-toggle="modal" data-bs-target="#modal<?= $publi['id'] ?>">
                      Leer más <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                  </div>
                  <div class="mt-4">
                    <a href="#contacto" class="inline-block bg-dark-success hover:bg-success text-white font-medium py-2 px-4 rounded-full transition-colors text-sm">
                      <i class="fas fa-envelope mr-2"></i> Solicitar
                    </a>
                  </div>
                </div>
              </div>
            </div>

            <!-- Modal Premium - Versión combinada para imagen y contenido -->
            <div class="modal fade" id="modal<?= $publi['id'] ?>" tabindex="-1" aria-hidden="true">
              <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content border-0 overflow-hidden">
                  <div class="modal-header bg-dark-success text-white py-4 px-6">
                    <div>
                      <span class="inline-block bg-white text-success text-xs font-semibold px-2 py-1 rounded-full uppercase tracking-wider mb-1">
                        <?= htmlspecialchars(ucfirst($publi['type_pu'])) ?>
                      </span>
                      <h5 class="modal-title text-xl font-bold mb-0"><?= htmlspecialchars($publi['title']) ?></h5>
                    </div>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>

                  <div class="modal-body p-6">
                    <div class="mb-6 rounded-lg overflow-hidden">
                      <img src="/sennova/img/<?= htmlspecialchars($publi['image_path']) ?>"
                        alt="<?= htmlspecialchars($publi['title']) ?>"
                        class="w-full h-64 object-cover cursor-zoom-in"
                        data-bs-toggle="modal"
                        data-bs-target="#imageModal<?= $publi['id'] ?>">
                    </div>

                    <div class="flex items-center text-gray-500 text-sm mb-6">
                      <i class="far fa-calendar-alt mr-2"></i>
                      <?= date("d M Y", strtotime($publi['published_at'])) ?>
                    </div>

                    <div class="prose max-w-none text-gray-700">
                      <?= nl2br(htmlspecialchars($publi['content'])) ?>
                    </div>
                  </div>

                  <div class="modal-footer bg-gray-50 py-4 px-6">
                    <a href="#contacto" class="bg-success hover:bg-dark-success text-white font-medium py-2 px-5 rounded-full transition-colors mr-3">
                      <i class="fas fa-envelope mr-2"></i> Solicitar
                    </a>
                    <button type="button" class="bg-white hover:bg-gray-100 text-gray-700 font-medium py-2 px-5 border border-gray-300 rounded-full transition-colors" data-bs-dismiss="modal">
                      <i class="fas fa-times mr-2"></i> Cerrar
                    </button>
                  </div>
                </div>
              </div>
            </div>

            <!-- Modal solo para imagen ampliada -->
            <div class="modal fade" id="imageModal<?= $publi['id'] ?>" tabindex="-1" aria-hidden="true">
              <div class="modal-dialog modal-xl modal-dialog-centered">
                <div class="modal-content bg-transparent border-0">
                  <button type="button" class="absolute top-4 right-4 text-white bg-black bg-opacity-50 rounded-full p-2 z-10" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times"></i>
                  </button>
                  <img src="/sennova/img/<?= htmlspecialchars($publi['image_path']) ?>"
                    alt="<?= htmlspecialchars($publi['title']) ?>"
                    class="w-full h-auto max-h-[90vh] object-contain">
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    <?php else: ?>
      <!-- Estado vacío premium consistente -->
      <div class="container mx-auto px-4 py-16 text-center">
        <div class="inline-block bg-white rounded-xl shadow-md p-8 max-w-md">
          <div class="text-gray-400 mb-4">
            <i class="fas fa-book-open fa-3x"></i>
          </div>
          <h3 class="text-xl font-bold text-gray-800 mb-2">No hay publicaciones disponibles</h3>
          <p class="text-gray-600">Estamos trabajando en nuevo contenido para ti</p>
        </div>
      </div>
    <?php endif; ?>
  </section>

  <!-- Services Section -->
  <section id="servicios" class="services-section py-5" style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);">
    <div class="container">
      <!-- Encabezado -->
      <div class="section-header text-center mb-5" data-aos="fade-up" data-aos-delay="100">
        <span class="section-subtitle">Lo que ofrecemos</span>
        <h2 class="section-title position-relative">
          Nuestros Servicios
          <span class="title-underline"></span>
        </h2>
      </div>

      <?php if (!empty($servicios)): ?>
        <div class="row justify-content-center g-4">
          <?php foreach ($servicios as $servicio): ?>
            <!-- Columna centrada -->
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 d-flex">
              <div class="service-card w-100" data-aos="fade-up" data-aos-duration="800">
                <div class="card-inner">
                  <!-- Ícono -->
                  <div class="service-icon">
                    <div class="icon-wrapper">
                      <img src="img/<?= htmlspecialchars($servicio['icono_ele']) ?>"
                        alt="<?= htmlspecialchars($servicio['titulo']) ?>"
                        class="icon-img">
                    </div>
                  </div>

                  <!-- Contenido -->
                  <div class="card-content">
                    <h3 class="service-title"><?= htmlspecialchars($servicio['titulo']) ?></h3>
                    <p class="service-description"><?= htmlspecialchars($servicio['descripcion_corta']) ?></p>

                    <div class="service-price">
                      Desde <?= number_format($servicio['precio'], 0, ',', '.') ?> COP
                    </div>

                    <button class="service-button" data-bs-toggle="modal"
                      data-bs-target="#modal-elect<?= $servicio['id_ele'] ?>">
                      <i class="fas fa-circle-info me-2"></i> Más Información
                    </button>
                  </div>
                </div>
              </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="modal-elect<?= $servicio['id_ele'] ?>" tabindex="-1"
              aria-labelledby="modalLabel-elect<?= $servicio['id_ele'] ?>" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                  <!-- Encabezado modal -->
                  <div class="modal-header">
                    <div class="modal-title-wrapper">
                      <i class="fas fa-wrench modal-title-icon"></i>
                      <h5 class="modal-title" id="modalLabel-elect<?= $servicio['id_ele'] ?>">
                        <?= htmlspecialchars($servicio['titulo']) ?>
                      </h5>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                  </div>

                  <!-- Cuerpo modal -->
                  <div class="modal-body">
                    <div class="modal-row">
                      <!-- Descripción -->
                      <div class="service-details">
                        <h6 class="section-label">Descripción del servicio</h6>
                        <div class="service-description-long">
                          <?= nl2br(htmlspecialchars($servicio['descripcion_larga'])) ?>
                        </div>

                        <div class="price-tag">
                          <i class="fas fa-tag"></i>
                          Desde <?= number_format($servicio['precio'], 0, ',', '.') ?> COP
                        </div>
                      </div>

                      <!-- Métodos de pago -->
                      <div class="payment-methods">
                        <h6 class="section-label"><i class="fas fa-credit-card"></i> Métodos de pago</h6>
                        <ul class="payment-list">
                          <li><i class="fas fa-check-circle"></i> Transferencia Bancaria</li>
                          <li><i class="fas fa-check-circle"></i> Pago Contra Entrega</li>
                          <li><i class="fas fa-check-circle"></i> Pagos Virtuales</li>
                        </ul>

                        <div class="payment-note">
                          <i class="fas fa-info-circle"></i> Te enviaremos el enlace de pago virtual al agendar el servicio.
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- Pie modal -->
                  <div class="modal-footer">
                    <div class="contact-info">
                      <i class="fas fa-envelope"></i> soporte@empresa.com
                    </div>
                    <button type="button" class="close-button" data-bs-dismiss="modal">
                      <i class="fas fa-times"></i> Cerrar
                    </button>
                  </div>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      <?php else: ?>
        <!-- Estado vacío -->
        <div class="empty-state text-center py-5">
          <div class="empty-icon mb-3">
            <i class="fas fa-tools fa-3x text-muted"></i>
          </div>
          <p class="text-muted">No hay servicios disponibles actualmente</p>
        </div>
      <?php endif; ?>
    </div>
  </section>

  <!-- Sección Nosotros -->
  <section id="nosotros" class="py-20 bg-gray-100" data-aos="fade-up">
    <div class="container mx-auto px-4">
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
        <div>
          <h3 class="text-4xl font-bold text-gray-900 mb-6">Excelencia Técnica SENA</h3>
          <p class="text-lg text-gray-700 mb-6">
            Nuestro Laboratorio de Electrónica forma parte del Sistema Nacional de Aprendizaje (SENA),
            respaldado por más de 60 años de experiencia en formación técnica y tecnológica.
          </p>
          <p class="text-lg text-gray-700 mb-8">
            Contamos con equipos de última generación y un equipo de instructores altamente calificados
            para brindar servicios de calidad superior.
          </p>
          <ul class="space-y-3">
            <li class="flex items-center text-sena-green-500 font-medium">
              <i class="bi bi-check-circle-fill me-2"></i>Equipos de última tecnología
            </li>
            <li class="flex items-center text-sena-green-500 font-medium">
              <i class="bi bi-check-circle-fill me-2"></i>Personal certificado y especializado
            </li>
            <li class="flex items-center text-sena-green-500 font-medium">
              <i class="bi bi-check-circle-fill me-2"></i>Normas ISO 9001 y 17025
            </li>
            <li class="flex items-center text-sena-green-500 font-medium">
              <i class="bi bi-check-circle-fill me-2"></i>Garantía en todos nuestros servicios
            </li>
            <li class="flex items-center text-sena-green-500 font-medium">
              <i class="bi bi-check-circle-fill me-2"></i>Precios competitivos del sector público
            </li>
          </ul>
        </div>
        <div class="flex justify-center">
          <div
            class="bg-gray-200 rounded-xl p-12 text-center shadow-xl transform hover:scale-105 transition duration-300">
            <div class="text-8xl text-gray-700 mb-4">⚡</div>
            <div class="text-6xl text-gray-700 mb-4">🔬</div>
            <div class="text-8xl text-gray-700">🛠️</div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Sección Contacto -->
  <section id="contacto" class="py-20 bg-gray-300">
    <div class="container mx-auto px-4">
      <h2 class="text-4xl font-bold text-center text-gray-900 mb-16">Solicitar Servicio</h2>

      <div class="max-w-2xl mx-auto">
        <form id="contactForm" action="/sennova/routes/solicitud.php" method="POST"
          class="bg-white text-gray-900 rounded-2xl p-10 shadow-2xl border border-gray-200 transition-all duration-300">

          <!-- Área oculta -->
          <input type="hidden" name="area" value="electronica">
          <input type="hidden" name="redirect" value="inElectronica.php">

          <!-- Nombre / Empresa -->
          <div class=" mb-6">
            <div>
              <label for="nombre" class="block text-gray-700 font-semibold mb-2">Nombre Completo</label>
              <input type="text" id="nombre" name="nombre" required
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:border-sena-green-400 focus:ring-sena-green-400 focus:outline-none focus:ring-2 transition duration-200">
            </div>

          </div>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
              <label for="empresa" class="block text-gray-700 font-semibold mb-2">Empresa/Cliente</label>
              <input type="text" id="empresa" name="empresa"
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:border-sena-green-400 focus:ring-sena-green-400 focus:outline-none focus:ring-2 transition duration-200">
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
                class="only-numbers w-full px-4 py-3 border border-gray-300 rounded-lg focus:border-sena-green-400 focus:ring-sena-green-400 focus:outline-none focus:ring-2 transition duration-200">
            </div>
          </div>


          <!-- Email / Teléfono -->
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <!-- Email -->
            <div>
              <label for="email" class="block text-gray-700 font-semibold mb-2">Correo Electrónico</label>
              <input type="email" id="email" name="email"
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:border-sena-green-400 focus:ring-sena-green-400 focus:outline-none focus:ring-2 transition duration-200">
              <!-- Checkbox pequeño debajo -->
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
                  class="only-numbers w-full px-4 py-3 border border-gray-300 rounded-r-lg focus:border-sena-green-400 focus:ring-sena-green-400 focus:outline-none focus:ring-2 transition duration-200">
              </div>
              <!-- Checkbox pequeño debajo -->
              <label class="mt-1 flex items-center gap-2 justify-end text-xs text-gray-600 select-none">
                <input type="checkbox" id="no_tel" class="h-3 w-3"> No disponible
              </label>
            </div>
          </div>

          <!-- Mensaje de validación (se llena por JS si hace falta) -->
          <p id="contactError" class="mt-2 text-sm text-red-600"></p>
          <!-- Servicio -->
          <div class="mb-6">
            <label for="servicio" class="block text-gray-700 font-semibold mb-2">Tipo de Servicio</label>
            <select id="servicio" name="servicio" required
              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:border-sena-green-400 focus:ring-sena-green-400 focus:outline-none focus:ring-2 transition duration-200">
              <option value="">Seleccione un servicio</option>
              <option value="Diseño de tarjetas de circuito impreso (PCB)">Diseño de tarjetas de circuito impreso (PCB)</option>
              <option value="Fabricación de tarjetas PCB">Fabricación de tarjetas PCB</option>
              <option value="Diseño de piezas 3D">Diseño de piezas 3D</option>
              <option value="Impresión de piezas 3D">Impresión de piezas 3D</option>
              <option value="Integración de soluciones tecnológicas">Integración de soluciones tecnológicas</option>
            </select>
          </div>

          <!-- Descripción -->
          <div class="mb-8">
            <label for="descripcion" class="block text-gray-700 font-semibold mb-2">Descripción del Servicio</label>
            <textarea id="descripcion" name="descripcion" rows="5"
              placeholder="Describa el proyecto, requerimientos técnicos, objetivos, etc."
              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:border-sena-green-400 focus:ring-sena-green-400 focus:outline-none focus:ring-2 transition duration-200"></textarea>
          </div>


          <button type="submit"
            class="w-full bg-gray-900 hover:bg-gray-500 text-white py-4 rounded-lg text-lg font-semibold shadow-md hover:shadow-lg transform hover:scale-105 transition duration-300">
            Enviar Solicitud
          </button>
        </form>
      </div>
    </div>
  </section>

  <!-- PIE DE PAGINA -->
  <footer class="footer text-white pt-5 pb-4 mt-3 bg-gray-900">
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
          <p>Suscríbete para recibir noticias:</p>
          <form>
            <div class="input-group mb-3">
              <input type="email" class="form-control" placeholder="Tu correo electrónico">
              <button class="btn" type="button" style="background-color: #22c55e; color: white;">Suscribir</button>
            </div>
          </form>
        </div>
      </div>

      <hr class="my-4 text-white">

      <!-- Pie final -->
      <div class="row align-items-center" data-aos="fade-up" data-aos-delay="400">
        <div class="col-md-7 col-lg-8">
          <p class="mb-0">&copy;
            <script>
              document.write(new Date().getFullYear());
            </script> TuEmpresa/Sitio. Todos los
            derechos reservados.
          </p>
        </div>
        <div class="col-md-5 col-lg-4 text-center text-md-end">
          <p class="mb-0">Hecho con <i class="fas fa-heart text-danger"></i> por <strong>[Tu Nombre o
              Empresa]</strong></p>
        </div>
      </div>
    </div>
  </footer>


  <!-- ===== CSS mínimo para quitar spinners en inputs numéricos ===== -->
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
  <!-- SCRIPTS -->
  <!-- ===== Script: lógica "No tengo" y validación de contacto ===== -->
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
          changed.checked = false; // revertimos el último
          setError("Para continuar con la solicitud, debes proporcionar al menos un medio de contacto (correo o teléfono)");
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

      // Sanitizar teléfono en tiempo real
      telIn.addEventListener("input", function() {
        if (telIn.readOnly) return;
        this.value = this.value.replace(/[^0-9]/g, "").slice(0, 10);
      });

      // Validación al enviar: al menos correo o teléfono (no ambos vacíos / "Sin datos")
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
  <script>
    AOS.init();
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO"
    crossorigin="anonymous"></script>

</body>

</html>