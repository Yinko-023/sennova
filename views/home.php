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
            <ul
                class="nav d-flex flex-column flex-md-row align-items-start align-items-md-center gap-1 gap-md-2 mb-0 ps-0">
                <li class="nav-item">
                    <a href="#" class="nav-link sin-subrayado text-white fw-semibold px-2">SENNOVA</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link sin-subrayado text-white fw-semibold px-2" data-bs-toggle="modal"
                        data-bs-target="#programasModal">Programas</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link sin-subrayado text-white dropdown-toggle fw-semibold px-2" href="#" role="button"
                        id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">Laboratorios</a>
                    <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2">
                        <li><a class="dropdown-item" href="inCalidad.php">Calidad de café y cacao</a></li>
                        <li><a class="dropdown-item" href="inElectronica.php">Electrónica</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>

    <style>


        .nav-link {
            color: #ffffff !important;
            font-weight: 500;
            font-size: 0.95rem;
            transition: color 0.3s ease;
        }

        .nav-link:hover {
            color: #f0fdf4 !important;
        }

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
                    <i class="bi bi-search fs-2"></i>
                    <a href="/buscar"
                        class="text-white text-decoration-none d-flex flex-column align-items-center w-100 h-100">
                        <p class="mb-0 fw-bold">Buscar Contenido</p>
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
                    <a href="/eventos"
                        class="text-white text-decoration-none d-flex flex-column align-items-center w-100 h-100">
                        <p class="mb-0 fw-bold">Eventos Destacados</p>
                    </a>
                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-2">
                <div
                    class="bloque-navegacion d-flex flex-column justify-content-center align-items-center text-center p-4">
                    <i class="bi bi-person-lines-fill fs-2"></i>
                    <a href="/nosotros"
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
    <section class="px-4 py-8 md:px-8">
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
                    <!-- Efecto de resaltado -->
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

                            <!-- Sección de contenido -->
                            <div class="md:w-3/5 p-8">
                                <!-- Badge de área -->
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
                                    } elseif ($area === 'calidad') {
                                        $enlace = 'index.php';
                                    }
                                    ?>

                                    <a href="<?= $enlace ?>"
                                        class="inline-flex items-center px-5 py-2.5 bg-gradient-to-r from-green-800 to-green-600 text-white font-medium rounded-lg hover:from-green-900 hover:to-blue-900 transition-all duration-300 shadow-md">
                                        Visitar Laboratorio
                                        <i class="fas fa-arrow-right ml-2"></i>
                                    </a>
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
    <section class="px-4 py-12 md:px-16 bg-gray-50">
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
                <input type="hidden" name="controller" value="home">
                <input type="hidden" name="action" value="index">

                <div class="flex items-center mb-6">
                    <div class="p-3 bg-green-800 rounded-lg mr-4">
                        <i class="fas fa-sliders-h text-light text-xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800">Filtrar contenido</h3>
                </div>

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

                    <!-- Categoría -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-tags mr-2 text-emerald-600"></i>Categoría
                        </label>
                        <div class="relative">
                            <select name="categoria"
                                class="block w-full pl-10 pr-3 py-2 text-base border border-gray-300 focus:outline-none focus:ring-2 focus:ring-emerald-600 focus:border-emerald-600 rounded-lg">
                                <option value="">Todas</option>
                                <option value="noticias">Noticias</option>
                                <option value="eventos">Eventos</option>
                                <option value="articulos">Artículos</option>
                            </select>
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-tags text-gray-400"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Laboratorio -->
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
                </div>

                <!-- Botón de acción -->
                <div class="mt-6 flex justify-end">
                    <button type="submit"
                        class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-gradient-to-r from-emerald-800 to-emerald-600 hover:from-emerald-900 hover:to-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-600 transition-all duration-200">
                        <i class="fas fa-filter mr-2"></i> Aplicar filtros
                    </button>
                </div>
            </form>


        </div>

        <!-- Listado de publicaciones -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" id="contenedorPublicaciones">
            <?php if (empty($publicaciones)): ?>
                <div
                    class="col-span-full flex flex-col items-center justify-center p-8 rounded-xl bg-gradient-to-br from-green-50 to-white border border-emerald-100 shadow-sm">
                    <svg class="w-24 h-24 text-green-500 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">No hay resultados</h3>
                    <p class="text-gray-600 max-w-md text-center mb-4">Prueba ajustando los filtros usando términos
                        diferentes</p>

                </div>
            <?php else: ?>
                <?php foreach ($publicaciones as $pub): ?>
                    <div class="flex" data-aos="fade-up" data-aos-duration="800">
                        <div
                            class="bg-white rounded-xl shadow-md overflow-hidden flex flex-col w-full hover:shadow-lg transition-shadow duration-300">
                            <!-- Imagen -->
                            <?php if (!empty($pub['image_path'])): ?>
                                <div class="h-48 overflow-hidden">
                                    <img src="/sennova/img/<?= htmlspecialchars($pub['image_path']) ?>"
                                        class="w-full h-full object-cover transition-transform duration-500 hover:scale-105"
                                        alt="Imagen de publicación">
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
                                    <h3 class="text-xl font-semibold text-gray-800 mb-2"><?= htmlspecialchars($pub['title']) ?>
                                    </h3>
                                    <p class="text-gray-600 mb-4 line-clamp-3"><?= htmlspecialchars($pub['content']) ?></p>
                                </div>
                                <div class="mt-auto pt-4 border-t border-gray-100">
                                    <div class="flex items-center justify-between">
                                        <span class="text-sm text-gray-500">
                                            <i class="far fa-clock mr-1"></i>
                                            <?= htmlspecialchars($pub['published_at']) ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
<footer class="bg-[#134e4a] text-white text-center py-6">
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
                        <button class="btn" type="button"
                            style="background-color: #22c55e; color: white;">Suscribir</button>
                    </div>
                </form>
            </div>
        </div>

        <hr class="my-4 text-white">

        <!-- Pie final -->
        <div class="row align-items-center" data-aos="fade-up" data-aos-delay="400">
            <div class="col-md-7 col-lg-8">
                <p class="mb-0">&copy;
                    <script>document.write(new Date().getFullYear());</script> TuEmpresa/Sitio. Todos los
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
<style>
    body {
        font-family: 'Segoe UI', sans-serif;
        background-color: #f0f2f5;
        color: #1f2937;
        margin: 0;
        padding: 0;
        line-height: 1.6;
    }

    .header-suave {
        background-color: #14532d;
        border-bottom: 1px solid #d1d5db;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
        padding: 1rem 2rem;
    }

    .nav-link {
        color: #019401;
        font-weight: 600;
        margin: 0 1rem;
        transition: color 0.3s ease;
        text-decoration: none;
    }

    .nav-link:hover {
        color: #01af01;
        text-decoration: underline;
    }

    .carousel-img {
        height: 500px;
        object-fit: cover;
        width: 100%;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        border-radius: 0;
    }

    .bloque-navegacion {
        background: #1a6439ff;
        border: 1px solid #1a6439ff;
        border-radius: 0.75rem;
        padding: 1.5rem;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }

    .card-custom {
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 0.75rem;
        padding: 1.25rem;
        transition: box-shadow 0.3s ease, transform 0.2s ease;
    }

    .card-custom:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
    }

    .metro-button {
        background-color: #01af01;
        color: #ffffff;
        padding: 0.75rem 1.5rem;
        font-weight: 600;
        border: none;
        border-radius: 0.5rem;
        cursor: pointer;
        transition: background 0.3s ease, transform 0.2s ease;
    }

    .metro-button:hover {
        background-color: #019401;
        transform: scale(1.03);
    }

    .footer {
        background: #ffffff;
        border-top: 1px solid #e5e7eb;
        padding: 2rem 1rem;
        text-align: center;
        color: #6b7280;
        font-size: 0.875rem;
    }

    .form-select {
        background-color: #ffffff;
        color: #111827;
        border: 1px solid #01af01;
        border-radius: 0.5rem;
        padding: 0.5rem;
        transition: border 0.3s ease;
    }

    .form-select:focus {
        border-color: #019401;
        outline: none;
    }

    .tile {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border-radius: 0.75rem;
        overflow: hidden;
    }

    .tile:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 14px rgba(0, 0, 0, 0.1);
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('filtroForm');

        form.addEventListener('submit', function (e) {
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
    integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO"
    crossorigin="anonymous"></script>
</body>

</html>