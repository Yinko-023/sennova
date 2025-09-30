<?php
require_once 'models/PubliModel.php';
$model = new CarruselModel();
$slides = $model->obtenerImagenes();
$model = new VideoModel();
$videoElectronicaData = $model->obtenerVideoPorArea('electronica');
$videoCafeData = $model->obtenerVideoPorArea('cafe');
$videoElectronica = $videoElectronicaData ? $videoElectronicaData['ruta_video'] : 'videos/default-elec.mp4';
$videoCafe = $videoCafeData ? $videoCafeData['ruta_video'] : 'videos/default-cafe.mp4';
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TecSabor</title>
    <link rel="icon" type="image/x-icon" href="/sennova/img/l2.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet" />
    <link href="/sennova/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="public/css/output.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<header class="header-suave uk-sticky shadow-sm" uk-sticky="sel-target: .header-suave; cls-active: uk-navbar-sticky">
    <div
        class="container d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center py-2 px-3 gap-2">
        <a href="index.php" class="text-decoration-none text-white fw-bold fs-6 lh-sm mb-1 mb-md-0">
            Centro de Desarrollo Agroempresarial<br />
            y Turístico del Huila
        </a>
        <nav>
            <ul class="nav d-flex flex-column flex-md-row align-items-start align-items-md-center gap-1 gap-md-2 mb-0 ps-0">
                <li class="nav-item">
                    <a id="navCalidad" href="inCalidad.php" class="nav-link sin-subrayado text-white fw-semibold px-2">
                        Calidad de Café y Cacao
                    </a>
                </li>
                <li class="nav-item">
                    <a id="navElectronica" href="inElectronica.php" class="nav-link sin-subrayado text-white fw-semibold px-2">
                        Electrónica
                    </a>
                </li>
            </ul>
        </nav>

    </div>

    <style>
        .sin-subrayado {
            text-decoration: none !important;
        }

        .dropdown-menu {
            background-color: #ffffff;
            border-radius: 0.5rem;
        }

        .dropdown-item {
            color: #1f2937;
            font-weight: 500;
            padding: 0.5rem 1rem;
        }

        .dropdown-item:hover {
            background-color: #f0fdf4;
            color: #01af01;
        }

        #userDropdown::after {
            display: none !important;
        }

        @media (max-width: 768px) {
            .nav {
                width: 100%;
            }

            .nav-item {
                width: 100%;
            }

            .nav-link {
                width: 100%;
                padding-left: 0 !important;
            }

            .dropdown-menu {
                width: 100%;
            }
        }

        /* Móvil + Tablet (hasta < 992px) */
        @media (max-width: 991.98px) {

            /* Centrar el título y compactar el header */
            .header-suave .container {
                flex-direction: column;
                /* apila título + nav */
                align-items: center;
                /* centra horizontal */
                gap: .5rem;
            }

            .header-suave .container>a {
                width: 100%;
                text-align: center;
                /* TÍTULO centrado */
            }

            nav {
                width: 100%;
            }

            /* Nav en una FILA (no uno debajo del otro) */
            .header-suave .nav {
                display: flex;
                flex-direction: row !important;
                /* fuerza fila (anula .flex-column) */
                flex-wrap: wrap;
                /* permite salto si no cabe */
                justify-content: center;
                /* centrar items */
                align-items: center;
                gap: .25rem .75rem;
                width: 100%;
            }

            .header-suave .nav-item {
                width: auto;
            }

            .header-suave .nav-link {
                width: auto;
                padding-left: .5rem !important;
                padding-right: .5rem !important;
            }

            /* El dropdown no a pantalla completa en móvil */
            .header-suave .dropdown-menu {
                width: auto;
                min-width: 12rem;
            }
        }
    </style>
</header>

<!-- Carrusel -->
<section class="relative w-full overflow-hidden ">
    <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
        <div class="carousel-inner">
            <?php if (!empty($slides)): ?>
                <?php foreach ($slides as $index => $slide): ?>
                    <div class="carousel-item <?= $index === 0 ? 'active' : '' ?> position-relative">
                        <img src="<?= htmlspecialchars($slide['title_carr']) ?>" class="d-block w-100 carousel-img"
                            alt="Imagen <?= $index + 1 ?>">

                        <div class="carousel-caption d-flex flex-column justify-content-center align-items-center h-100">
                            <h1 class="titulo-principal text-white animate-float fw-bold" data-aos="zoom-in">
                                <?= htmlspecialchars($slide['name_img_c']) ?>
                            </h1>
                        </div>
                    </div>


                <?php endforeach; ?>
            <?php else: ?>
                <div class="carousel-item active text-center">
                    <img src="sennova/img/default.jpg" class="d-block w-100 carousel-img" alt="Sin imágenes">
                    <div class="carousel-caption d-flex flex-column justify-content-center align-items-center h-100">
                        <h1 class="titulo-principal text-white">No hay imágenes cargadas</h1>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <!-- Controles -->
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Anterior</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Siguiente</span>
        </button>
    </div>
    <style>
        @keyframes float {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        .animate-float {
            animation: float 3s ease-in-out infinite;
        }

        .titulo-principal {
            font-weight: 800;
            /* Texto robusto */
            font-size: 4rem;
            /* Texto más grande */
            text-shadow: 0 2px 8px rgba(0, 0, 0, 0.6);
            /* Sombra sutil para contraste */
            line-height: 1.2;
            text-align: center;
        }
    </style>
</section>

<div class="container border border-secundary shadow mt-5">
    <!-- Versión de escritorio: visible desde md en adelante -->
    <section class=" mt-5 mb-5 d-none d-md-block ">
        <div class="row justify-content-center g-4">
            <div class="col-6 col-md-4 col-lg-2">
                <div
                    class="bloque-navegacion d-flex flex-column justify-content-center align-items-center text-center p-4">
                    <i class="bi bi-file-earmark-text-fill fs-2"></i>
                    <a href="#publicaciones"
                        class="text-white text-decoration-none d-flex flex-column align-items-center w-100 h-100">
                        <p class="mb-0 fw-bold">Últimas Publicaciones</p>
                    </a>
                </div>
            </div>

            <div class="col-6 col-md-4 col-lg-2">
                <div
                    class="bloque-navegacion d-flex flex-column justify-content-center align-items-center text-center p-4">
                    <i class="bi bi-telephone-fill fs-2"></i>
                    <a href="#contactos"
                        class="text-white text-decoration-none d-flex flex-column align-items-center w-100 h-100">
                        <p class="mb-0 fw-bold">Contacto</p>
                    </a>
                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-2">
                <div
                    class="bloque-navegacion d-flex flex-column justify-content-center align-items-center text-center p-4">
                    <i class="bi bi-calendar-event-fill fs-2"></i>
                    <a href="#eventos"
                        class="text-white text-decoration-none d-flex flex-column align-items-center w-100 h-100">
                        <p class="mb-0 fw-bold">Destacados</p>
                    </a>
                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-2">
                <div
                    class="bloque-navegacion d-flex flex-column justify-content-center align-items-center text-center p-4">
                    <i class="bi bi-person-lines-fill fs-2"></i>
                    <a href="info.php"
                        class="text-white text-decoration-none d-flex flex-column align-items-center w-100 h-100">
                        <p class="mb-0 fw-bold">Sobre Nosotros</p>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Sección: Servicios / Laboratorios -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up" data-aos-duration="1000">
                <span class="d-block text-dark fw-semibold text-uppercase mb-2">Nuestras instalaciones</span>
                <h2 class="fw-bold display-5">Laboratorios Especializados</h2>
                <div class="mx-auto mt-3"
                    style="width: 100px; height: 4px; background: linear-gradient(to right, #10680dff, #119e6fff); border-radius: 9999px;">
                </div>
            </div>

            <div class="row g-4">
                <!-- Laboratorio de Electrónica -->
                <div class="col-md-6" data-aos="zoom-in-right">
                    <div class="card border-0 shadow-sm rounded-4 h-100">
                        <div class="card-body text-center p-4">
                            <a href="inElectronica.php" class="h5 fw-bold text-decoration-none text-dark mb-3 d-block">
                                <i class="fas fa-microchip me-2 text-dark"></i> Laboratorio de Electrónica
                            </a>
                            <div class="ratio ratio-16x9 mb-3">
                                <video class="rounded-3 shadow-sm" controls
                                    poster="https://images.stockcake.com/public/4/c/7/4c7873b9-158d-453e-a43f-cc79e41003bd_large/advanced-electronics-lab-stockcake.jpg">
                                    <source src="<?= htmlspecialchars($videoElectronica) ?>" type="video/mp4">
                                    Tu navegador no soporta el video.
                                </video>
                            </div>
                            <p class="text-muted">Tecnología de punta para innovación y desarrollo electrónico</p>
                        </div>
                    </div>
                </div>

                <!-- Laboratorio de Café y Cacao -->
                <div class="col-md-6" data-aos="zoom-in-left">
                    <div class="card border-0 shadow-sm rounded-4 h-100">
                        <div class="card-body text-center p-4">
                            <a href="inCalidad.php" class="h5 fw-bold text-decoration-none text-dark mb-3 d-block">
                                <i class="fas fa-coffee me-2 text-dark"></i> Laboratorio de Calidad de Café y Cacao
                            </a>
                            <div class="ratio ratio-16x9 mb-3">
                                <video class="rounded-3 shadow-sm" controls
                                    poster="https://www.coracaoconfections.com/cdn/shop/articles/envato-labs-ai-074bc906-6e65-4d68-8eb1-d1a2a3bf5be8.jpg?crop=center&height=1200&v=1749639573&width=1200">
                                    <source src="<?= htmlspecialchars($videoCafe) ?>" type="video/mp4">
                                    Tu navegador no soporta el video.
                                </video>
                            </div>
                            <p class="text-muted">Análisis y control de calidad para los mejores granos de café y Cacao
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <style>
            /* Efectos de transición */
            .transition-all {
                transition-property: all;
            }

            .duration-200 {
                transition-duration: 200ms;
            }

            .duration-300 {
                transition-duration: 300ms;
            }

            /* Aspect ratio para videos */
            .aspect-w-16 {
                position: relative;
                padding-bottom: 56.25%;
                /* 16:9 Aspect Ratio */
            }

            .aspect-h-9 {
                position: absolute;
                top: 0;
                right: 0;
                bottom: 0;
                left: 0;
                width: 100%;
                height: 100%;
            }

            /* Gradientes */
            .bg-gradient-to-b {
                background-image: linear-gradient(to bottom, var(--tw-gradient-stops));
            }

            .bg-gradient-to-r {
                background-image: linear-gradient(to right, var(--tw-gradient-stops));
            }

            /* Sombras */
            .shadow-lg {
                box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            }

            .hover-shadow:hover {
                box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            }

            /* Bordes redondeados */
            .rounded-xl {
                border-radius: 0.75rem;
            }

            .rounded-t-\[11px\] {
                border-top-left-radius: 11px;
                border-top-right-radius: 11px;
            }

            /* Efecto hover */
            .hover\:-translate-y-2:hover {
                transform: translateY(-0.5rem);
            }
        </style>
    </section>

    <!-- Línea de formación -->
    <section class="py-16 px-4 md:px-16">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-semibold">Líneas de Formación</h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 px-4 md:px-16">
            <div class="p-6 bg-white rounded-lg shadow">
                <i class="fa-solid fa-seedling text-4xl text-[#134e4a] mb-4"></i>
                <h3 class="text-xl font-bold">Agroindustria</h3>
            </div>
            <div class="p-6 bg-white rounded-lg shadow">
                <i class="fa-solid fa-tree text-4xl text-[#134e4a] mb-4"></i>
                <h3 class="text-xl font-bold">Turismo</h3>
            </div>
            <div class="p-6 bg-white rounded-lg shadow">
                <i class="fa-solid fa-wifi text-4xl text-[#134e4a] mb-4"></i>
                <h3 class="text-xl font-bold">Tecnologías Digitales</h3>
            </div>
        </div>
    </section>

    <!-- Publicaciones destacadas -->
    <section class="px-4 py-8 md:px-8" id="eventos">
        <?php if (!empty($destacada)): ?>
            <div class="max-w-7xl mx-auto">
                <!-- Encabezado con efecto de destaque -->
                <div class="text-center mb-8" data-aos="fade-down">
                    <span
                        class="inline-block px-4 py-2 bg-yellow-100 text-yellow-800 rounded-full text-sm font-semibold mb-2">
                        <i class="fas fa-star mr-2 text-yellow-500"></i>DESTACADO
                    </span>
                    <h2 class="text-4xl font-bold text-gray-800">Anuncio Destacado</h2>
                    <div class="w-24 h-1 bg-gradient-to-r from-green-400 to-green-600 mx-auto mt-4 rounded-full"></div>
                </div>

                <!-- Tarjeta destacada -->
                <div class="relative" data-aos="zoom-in">
                    <div
                        class="absolute -inset-1 bg-gradient-to-r from-green-400 to-blue-500 rounded-2xl opacity-20 blur-lg">
                    </div>

                    <div class="relative bg-white rounded-2xl shadow-xl overflow-hidden">
                        <div class="flex flex-col md:flex-row">
                            <!-- Sección de imagen -->
                            <div class="md:w-2/5 bg-gray-100 flex items-center justify-center p-6">
                                <?php if (!empty($destacada['image_path'])): ?>
                                    <img src="/sennova/img/<?= htmlspecialchars($destacada['image_path']) ?>"
                                        class="w-full h-64 md:h-auto object-cover rounded-lg shadow-md transition-transform duration-500 hover:scale-105"
                                        alt="Imagen destacada">
                                <?php else: ?>
                                    <div class="text-center p-8 text-gray-400">
                                        <i class="fas fa-image fa-4x mb-4"></i>
                                        <p class="text-lg">Imagen no disponible</p>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class="md:w-3/5 p-8">
                                <span
                                    class="inline-block px-3 py-1 bg-<?= $destacada['lab_area'] === 'electronica' ? 'blue' : 'amber' ?>-100 text-<?= $destacada['lab_area'] === 'electronica' ? 'blue' : 'amber' ?>-800 rounded-full text-xs font-semibold mb-4">
                                    <?= strtoupper(htmlspecialchars($destacada['lab_area'])) ?>
                                </span>

                                <h3 class="text-2xl font-bold text-gray-800 mb-3">
                                    <?= htmlspecialchars($destacada['title']) ?>
                                </h3>
                                <p class="text-gray-600 mb-6 leading-relaxed"><?= htmlspecialchars($destacada['content']) ?>
                                </p>

                                <div class="flex items-center justify-between mt-auto">
                                    <div class="flex items-center text-gray-500 text-sm">
                                        <i class="far fa-calendar-alt mr-2"></i>
                                        <span><?= htmlspecialchars($destacada['published_at']) ?></span>
                                    </div>

                                    <?php
                                    $area = isset($destacada['lab_area']) ? strtolower(trim($destacada['lab_area'])) : '';
                                    $enlace = 'index.php';

                                    if ($area === 'cafe') {
                                        $enlace = 'inCalidad.php';
                                    } elseif ($area === 'electronica') {
                                        $enlace = 'inElectronica.php';
                                    } elseif ($area === 'general') {
                                        $enlace = 'index.php';
                                    }
                                    ?>

                                    <?php if ($area === 'cafe' || $area === 'electronica'): ?>
                                        <a href="<?= htmlspecialchars($enlace) ?>"
                                            class="inline-flex items-center px-5 py-2.5 bg-gradient-to-r from-green-800 to-green-600 text-white font-medium rounded-lg hover:from-green-900 hover:to-blue-900 transition-all duration-300 shadow-md">
                                            Visitar Laboratorio
                                            <i class="fas fa-arrow-right ml-2"></i>
                                        </a>
                                    <?php else: ?>
                                        <span class="text-sm text-gray-500">Nuestro Anuncio es Totalmente General.</span>
                                    <?php endif; ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <style>
            /* Efectos de transición */
            .transition-transform {
                transition-property: transform;
            }

            .duration-300 {
                transition-duration: 300ms;
            }

            .duration-500 {
                transition-duration: 500ms;
            }

            .hover\:scale-105:hover {
                transform: scale(1.05);
            }

            /* Gradientes */
            .bg-gradient-to-r {
                background-image: linear-gradient(to right, var(--tw-gradient-stops));
            }

            /* Sombras */
            .shadow-xl {
                box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            }

            /* Bordes redondeados */
            .rounded-2xl {
                border-radius: 1rem;
            }

            /* Colores personalizados */
            .bg-blue-100 {
                background-color: #dbeafe;
            }

            .text-blue-800 {
                color: #1e40af;
            }

            .bg-amber-100 {
                background-color: #fef3c7;
            }

            .text-amber-800 {
                color: #92400e;
            }
        </style>
    </section>

    <!-- PUBLICACIONES Y ANUNCIOS -->
    <section class="px-4 py-12 md:px-16 bg-gray-50" id="publicaciones">
        <!-- Encabezado con efecto -->
        <div class="text-center mb-8" data-aos="fade-down">
            <h2 class="text-4xl font-bold text-gray-800">
                <i class="fas fa-newspaper text-dark mr-3"></i>Publicaciones
            </h2>
            <div class="w-24 h-1 bg-gradient-to-r from-green-800 to-green-400 mx-auto mt-4 rounded-full"></div>
        </div>

        <!-- Filtros - Tarjeta moderna -->
<div class="bg-white rounded-xl shadow-md overflow-hidden mb-8" data-aos="fade-up">
  <form id="filtroForm" class="p-6">
    <!-- hidden necesarios para tu backend -->
    <input type="hidden" name="controller" value="home">
    <input type="hidden" name="action" value="index">

    <!-- Encabezado -->
    <div class="flex items-center mb-6">
      <div class="p-3 bg-green-800 rounded-lg mr-4">
        <i class="fas fa-sliders-h text-light text-xl"></i>
      </div>
      <h3 class="text-xl font-bold text-gray-800">Filtrar contenido</h3>
    </div>

    <!-- Grid de filtros -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
      <!-- Ordenar -->
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">
          <i class="fas fa-sort mr-2 text-emerald-600"></i>Ordenar por
        </label>
        <div class="relative">
          <select name="orden"
                  class="block w-full pl-10 pr-3 py-2 text-base border border-gray-300 focus:outline-none focus:ring-2 focus:ring-emerald-600 focus:border-emerald-600 rounded-lg">
            <option value="recientes">Recientes</option>
            <option value="antiguos">Antiguos</option>
          </select>
          <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
            <i class="fas fa-sort text-gray-400"></i>
          </div>
        </div>
      </div>

      <!-- Fecha -->
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">
          <i class="fas fa-calendar-alt mr-2 text-emerald-600"></i>Filtrar por fecha
        </label>
        <div class="relative">
          <select name="filtro_fecha"
                  class="block w-full pl-10 pr-3 py-2 text-base border border-gray-300 focus:outline-none focus:ring-2 focus:ring-emerald-600 focus:border-emerald-600 rounded-lg">
            <option value="todos">Todos</option>
            <option value="hoy">Hoy</option>
            <option value="semana">Esta semana</option>
            <option value="mes">Este mes</option>
            <option value="anio">Este año</option>
          </select>
          <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
            <i class="fas fa-calendar-alt text-gray-400"></i>
          </div>
        </div>
      </div>

      <!-- Laboratorio / Área -->
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">
          <i class="fas fa-network-wired mr-2 text-emerald-600"></i>Laboratorio
        </label>
        <div class="relative">
          <select name="area"
                  class="block w-full pl-10 pr-3 py-2 text-base border border-gray-300 focus:outline-none focus:ring-2 focus:ring-emerald-600 focus:border-emerald-600 rounded-lg">
            <option value="">Todos</option>
            <option value="electronica">Electrónica</option>
            <option value="cafe">Café</option>
          </select>
          <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
            <i class="fas fa-network-wired text-gray-400"></i>
          </div>
        </div>
      </div>

      <!-- Botón (alineado al fondo y derecha del grid) -->
      <div class="col-span-1 md:col-span-2 lg:col-span-1 flex items-end justify-end">
        <button type="submit"
                class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-gradient-to-r from-emerald-800 to-emerald-600 hover:from-emerald-900 hover:to-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-600 transition-all duration-200">
          <i class="fas fa-filter mr-2"></i> Aplicar filtros
        </button>
      </div>
    </div>
  </form>
</div>


        <!-- Listado de publicaciones -->
        <?php
        // Helpers (una sola vez en la página)
        if (!function_exists('e')) {
            function e($s)
            {
                return htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8');
            }
        }
        if (!function_exists('area_route')) {
            function area_route(?string $area): ?string
            {
                $a = strtolower(trim($area ?? ''));
                return match ($a) {
                    'cafe'        => 'inAdmin.php?vista=cafe',
                    'electronica' => 'inAdmin.php?vista=electronica',
                    default       => null, // otras áreas → modal
                };
            }
        }
        ?>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" id="contenedorPublicaciones">
            <?php if (empty($publicaciones)): ?>
                <div class="col-span-full flex flex-col items-center justify-center p-8 rounded-xl bg-gradient-to-br from-green-50 to-white border border-emerald-100 shadow-sm">
                    <svg class="w-24 h-24 text-green-500 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">No hay resultados</h3>
                    <p class="text-gray-600 max-w-md text-center mb-4">Prueba ajustando los filtros usando términos diferentes</p>
                </div>
            <?php else: ?>
                <?php foreach ($publicaciones as $i => $pub):
                    $areaPub = $pub['area'] ?? $pub['categoria'] ?? 'general';
                    $route   = area_route($areaPub);
                    $pid     = $pub['id'] ?? $pub['id_publicacion'] ?? $i;
                    $modalId = 'pubModal-' . $pid;
                ?>
                    <div class="flex" data-aos="fade-up" data-aos-duration="800">
                        <div class="bg-white rounded-xl shadow-md overflow-hidden flex flex-col w-full hover:shadow-lg transition-shadow duration-300">
                            <!-- Imagen -->
                            <?php if (!empty($pub['image_path'])): ?>
                                <div class="h-48 overflow-hidden">
                                    <img src="/sennova/img/<?= e($pub['image_path']) ?>" class="w-full h-full object-cover transition-transform duration-500 hover:scale-105" alt="Imagen de publicación">
                                </div>
                            <?php else: ?>
                                <div class="h-48 bg-gray-100 flex items-center justify-center">
                                    <div class="text-center p-4 text-gray-400">
                                        <i class="fas fa-image fa-3x mb-2"></i>
                                        <p>No hay imagen</p>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <!-- Contenido -->
                            <div class="p-6 flex flex-col flex-grow">
                                <div class="flex-1">
                                    <h3 class="text-xl font-semibold text-gray-800 mb-2"><?= e($pub['title'] ?? '') ?></h3>
                                    <p class="text-gray-600 mb-4 line-clamp-3"><?= e($pub['content'] ?? '') ?></p>
                                </div>

                                <div class="mt-auto pt-4 border-t border-gray-100">
                                    <div class="flex items-center justify-between">
                                        <span class="text-sm text-gray-500">
                                            <i class="far fa-clock mr-1"></i>
                                            <?= e($pub['published_at'] ?? '') ?>
                                        </span>

                                        <!-- Acciones -->
                                        <div class="flex items-center gap-2">
                                            <?php if ($route): ?>
                                                <a href="<?= e($route) ?>"
                                                    class="inline-flex items-center px-3 py-2 rounded-lg bg-emerald-600 text-white text-sm hover:bg-emerald-700 transition"
                                                    title="Ir al área">
                                                    <i class="fas fa-arrow-right mr-2"></i> Visitar
                                                </a>
                                            <?php else: ?>
                                                <button type="button"
                                                    class="inline-flex items-center px-3 py-2 rounded-lg bg-emerald-600 text-white text-sm hover:bg-emerald-700 transition"
                                                    data-bs-toggle="modal" data-bs-target="#<?= e($modalId) ?>">
                                                    <i class="fas fa-eye mr-2"></i> Ver detalles
                                                </button>

                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php if (!$route): ?>
                        <!-- Modal Detalles -->
                        <div class="modal fade" id="<?= e($modalId) ?>" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title"><?= e($pub['title'] ?? 'Detalle de publicación') ?></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                    </div>
                                    <div class="modal-body">
                                        <?php if (!empty($pub['image_path'])): ?>
                                            <img src="/sennova/img/<?= e($pub['image_path']) ?>" class="w-100 rounded mb-3" alt="Imagen">
                                        <?php endif; ?>

                                        <dl class="row mb-3">
                                            <dt class="col-sm-3">Área</dt>
                                            <dd class="col-sm-9"><?= e(ucfirst($areaPub)) ?></dd>

                                            <dt class="col-sm-3">Publicado</dt>
                                            <dd class="col-sm-9"><?= e($pub['published_at'] ?? '') ?></dd>
                                        </dl>

                                        <div class="border-top pt-3">
                                            <p class="mb-0" style="white-space:pre-wrap"><?= e($pub['content'] ?? '') ?></p>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                            <i class="fas fa-times me-1"></i> Cerrar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <style>
            .transition-shadow {
                transition-property: box-shadow;
            }

            .transition-transform {
                transition-property: transform;
            }

            .duration-300 {
                transition-duration: 300ms;
            }

            .duration-500 {
                transition-duration: 500ms;
            }

            .hover\:shadow-lg:hover {
                box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            }

            .hover\:scale-105:hover {
                transform: scale(1.05);
            }
        </style>
    </section>

</div>

<!-- Footer -->
<footer class="mt-5" id="contactos">
    <div class="container footer-content">
        <div class="row g-5">
            <!-- Contacto -->
            <div class="col-md-4 col-lg-4 col-xl-4 mx-auto mt-3">
                <h5 class="footer-title">Laboratorios Sennova</h5>
                <p class="mb-4">Innovación, calidad y excelencia en cada proyecto que emprendemos. Comprometidos con el desarrollo tecnológico del país.</p>
                <div class="footer-links">
                    <a href="#"><i class="fas fa-home"></i> Calle 123 #45-67, Bogotá D.C.</a>
                    <a href="mailto:info@sennova.com"><i class="fas fa-envelope"></i> info@sennova.com</a>
                    <a href="tel:+571234567890"><i class="fas fa-phone"></i> +57 (1) 234 5678</a>
                </div>
            </div>

            <!-- Enlaces -->
            <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
                <h5 class="footer-title">Enlaces Rápidos</h5>
                <div class="footer-links">
                    <a href="/publicaciones"><i class="fas fa-newspaper"></i> Publicaciones</a>
                    <a href="/eventos"><i class="fas fa-calendar-alt"></i> Eventos</a>
                    <a href="/nosotros"><i class="fas fa-users"></i> Sobre Nosotros</a>
                    <a href="/contacto"><i class="fas fa-envelope"></i> Contacto</a>
                </div>
            </div>

            <!-- Info -->
            <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
                <h5 class="footer-title">Información</h5>
                <div class="footer-links">
                    <a href="/privacidad"><i class="fas fa-shield-alt"></i> Política de Privacidad</a>
                    <a href="/terminos"><i class="fas fa-file-contract"></i> Términos y Condiciones</a>
                    <a href="/preguntas-frecuentes"><i class="fas fa-question-circle"></i> Preguntas Frecuentes</a>
                    <a href="/mapa-sitio"><i class="fas fa-sitemap"></i> Mapa del Sitio</a>
                </div>
            </div>

            <!-- Redes y Newsletter -->
            <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mt-3">
                <h5 class="footer-title">Síguenos</h5>
                <div class="social-icons mb-4">
                    <a href="#" target="_blank"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" target="_blank"><i class="fab fa-twitter"></i></a>
                    <a href="#" target="_blank"><i class="fab fa-instagram"></i></a>
                    <a href="#" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                </div>

            </div>
        </div>

        <hr class="my-5 text-white">

        <!-- Pie final -->
        <div class="row align-items-center">
            <div class="col-md-7 col-lg-8">
                <p class="mb-0">&copy;
                    <script>
                        document.write(new Date().getFullYear());
                    </script> SENA - Servicio Nacional de Aprendizaje. Todos los derechos reservados.
                </p>
            </div>
            <div class="col-md-5 col-lg-4 text-center text-md-end">
                <p class="mb-0">Hecho con <i class="fas fa-heart text-danger"></i> por <strong>SENNOVA</strong></p>
            </div>
        </div>
    </div>
</footer>

<style>
    :root {
        --color-primary: #14532d;
        --color-primary-dark: #0e4221;
        --color-accent: #e67e22;
    }

    footer {
        background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-dark) 100%);
        color: white;
        padding: 5rem 0 2rem;
        position: relative;
        overflow: hidden;
    }

    footer::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="%23000000" fill-opacity="0.1" d="M0,224L48,213.3C96,203,192,181,288,181.3C384,181,480,203,576,192C672,181,768,139,864,138.7C960,139,1056,181,1152,181.3C1248,181,1344,139,1392,117.3L1440,96L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>');
        background-size: cover;
        background-position: center bottom;
    }

    .footer-content {
        position: relative;
        z-index: 1;
    }

    .footer-title {
        font-weight: 700;
        margin-bottom: 1.8rem;
        font-size: 1.4rem;
        background: linear-gradient(45deg, #fff, #e8f5e8);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .footer-links a {
        color: rgba(255, 255, 255, 0.8);
        text-decoration: none;
        display: block;
        margin-bottom: 1rem;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
    }

    .footer-links a i {
        margin-right: 0.8rem;
        width: 20px;
        transition: all 0.3s ease;
    }

    .footer-links a:hover {
        color: white;
        transform: translateX(8px);
    }

    .footer-links a:hover i {
        transform: scale(1.2);
    }

    .social-icons a {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 45px;
        height: 45px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        color: white;
        margin-right: 1rem;
        transition: all 0.3s ease;
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .social-icons a:hover {
        background: white;
        color: var(--color-primary);
        transform: translateY(-8px) scale(1.1);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
    }

    .copyright {
        border-top: 1px solid rgba(255, 255, 255, 0.15);
        padding-top: 2.5rem;
        margin-top: 4rem;
        text-align: center;
        color: rgba(255, 255, 255, 0.7);
    }

    .newsletter-input {
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
        color: white;
        border-radius: 8px;
    }

    .newsletter-input::placeholder {
        color: rgba(255, 255, 255, 0.7);
    }

    .newsletter-btn {
        background: linear-gradient(45deg, var(--color-accent), #f39c12);
        border: none;
        color: white;
        border-radius: 8px;
        transition: all 0.3s ease;
    }

    .newsletter-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(230, 126, 34, 0.4);
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('filtroForm');

        form.addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(form);
            const queryString = new URLSearchParams(formData).toString();

            fetch('index.php?' + queryString)
                .then(response => response.text())
                .then(data => {
                    const parser = new DOMParser();
                    const htmlDoc = parser.parseFromString(data, 'text/html');
                    const newContent = htmlDoc.querySelector('#contenedorPublicaciones'); // <- ID correcto

                    if (newContent) {
                        document.getElementById('contenedorPublicaciones').innerHTML = newContent.innerHTML;
                    } else {
                        console.warn('No se encontró #contenedorPublicaciones en la respuesta');
                    }
                })
                .catch(error => {
                    console.error('Error al aplicar filtros:', error);
                });
        });
    });
</script>
<script src="/sennova/js/funcion.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
<script>
    AOS.init();
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous">
</script>
</body>

</html>