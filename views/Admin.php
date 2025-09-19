<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
} ?>

<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?php
        if (isset($_SESSION['rol'])) {
            if ($_SESSION['rol'] == 3 && isset($_SESSION['area'])) {
                echo 'Laboratorio de ' . ucfirst($_SESSION['area']);
            } elseif ($_SESSION['rol'] == 2 || $_SESSION['rol'] == 4) {
                echo 'Usuario';
            } else {
                echo 'Panel Admin';
            }
        } else {
            echo 'Panel ';
        }
        ?>
    </title>

    <link rel="icon" type="image/x-icon" href="/sennova/img/Admin2.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="css/admin.css">
</head>

<body class="admin-body">
    <?php if (isset($_SESSION['mostrar_bienvenida'])): ?>


        <div id="alertaBienvenida" class="welcome-alert" role="alert" data-aos="fade-down" data-aos-delay="300" data-aos-duration="800">
            <div class="welcome-alert-content">
                <div class="welcome-icon">
                    <i class="fas fa-user-shield"></i>
                </div>
                <div class="welcome-text">
                    <h6>Bienvenido, <?= htmlspecialchars($_SESSION['nombre_usuario']) ?> <span class="welcome-hand">👋</span></h6>
                    <p>Acceso concedido al panel de administración de <strong>SENNOVA</strong></p>
                </div>
            </div>
            <button type="button" class="welcome-close" aria-label="Cerrar">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <?php unset($_SESSION['mostrar_bienvenida']); ?>
        <style>
            .welcome-alert {
                position: fixed;
                top: 80px;
                left: 50%;
                transform: translateX(-50%);
                z-index: 1055;
                max-width: 520px;
                width: 90%;
                padding: 1.25rem;
                border-radius: 12px;
                background: white;
                box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
                border-left: 4px solid #4361ee;
                display: flex;
                align-items: center;
                justify-content: space-between;
                opacity: 0;
                animation: fadeIn 0.8s ease-out forwards;
            }

            .welcome-alert-content {
                display: flex;
                align-items: center;
                gap: 1rem;
            }

            .welcome-icon {
                width: 42px;
                height: 42px;
                border-radius: 50%;
                background: linear-gradient(135deg, #4361ee 0%, #3a0ca3 100%);
                display: flex;
                align-items: center;
                justify-content: center;
                color: white;
                font-size: 1.2rem;
            }

            .welcome-text h6 {
                font-weight: 600;
                color: #2b2d42;
                margin-bottom: 0.25rem;
            }

            .welcome-text p {
                color: #6c757d;
                font-size: 0.875rem;
                margin-bottom: 0;
            }

            .welcome-close {
                background: none;
                border: none;
                color: #adb5bd;
                font-size: 1.25rem;
                cursor: pointer;
                transition: color 0.2s;
                padding: 0.5rem;
                margin-left: 1rem;
            }

            .welcome-close:hover {
                color: #6c757d;
            }

            @keyframes fadeIn {
                from {
                    opacity: 0;
                    transform: translateX(-50%) translateY(-20px);
                }

                to {
                    opacity: 1;
                    transform: translateX(-50%) translateY(0);
                }
            }

            .fade-out {
                animation: fadeOut 0.5s ease-out forwards;
            }

            @keyframes fadeOut {
                from {
                    opacity: 1;
                }

                to {
                    opacity: 0;
                }
            }
        </style>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const alerta = document.getElementById('alertaBienvenida');
                const closeBtn = alerta?.querySelector('.welcome-close');

                if (alerta) {
                    // Cierre manual
                    closeBtn?.addEventListener('click', function() {
                        alerta.classList.add('fade-out');
                        setTimeout(() => alerta.remove(), 500);
                    });

                    // Cierre automático
                    setTimeout(() => {
                        alerta.classList.add('fade-out');
                        setTimeout(() => alerta.remove(), 500);
                    }, 3500);
                }
            });
        </script>
    <?php endif; ?>

    <?php
    require_once __DIR__ . '/../controllers/PubliController.php';

    $solicitudController = new SolicitudController();

    if (isset($_SESSION['area']) && in_array($_SESSION['area'], ['cafe', 'electronica'])) {
        $area = $_SESSION['area'];
        $totalNotif = $solicitudController->contarNoLeidas($area);
        $notificaciones = $solicitudController->verNotificaciones($area);
    } else {
        $area = null;
        $totalNotif = 0;
        $notificaciones = [];
    }
    ?>


    <!-- 🔝 NAVBAR SUPERIOR (Visible solo en PC/tablet) -->
    <nav class="admin-navbar navbar navbar-expand-lg navbar-dark fixed-top d-none d-lg-flex" style="background: linear-gradient(90deg,  #2c3e50 0%, #1a1a2e 100%); left: 280px; right: 0; height: 70px;">
        <div class="container-fluid px-4">
            <div class="collapse navbar-collapse justify-content-end">
                <ul class="navbar-nav gap-3">
                    <?php if (isset($_SESSION['rol']) && ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2 || $_SESSION['rol'] == 3)): ?>
                        <!-- Notificaciones -->
                        <li class="nav-item d-flex align-items-center">
                            <a class="nav-link position-relative p-2 rounded" href="#" data-bs-toggle="modal"
                                data-bs-target="#modalNotificaciones" style="transition: all 0.3s ease;">
                                <i class="fas fa-bell" style="font-size: 1.2rem;"></i>
                                <?php if ($totalNotif > 0): ?>
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-circle bg-danger"
                                        style="width: 20px; height: 20px; display: flex; align-items: center; justify-content: center; font-size: 0.65rem;">
                                        <?= $totalNotif ?>
                                    </span>
                                <?php endif; ?>
                                <span class="ms-2 d-none d-xl-inline">Notificaciones</span>
                            </a>
                        </li>
                    <?php endif; ?>

                    <!-- Menú usuario -->
                    <li class="nav-item dropdown">
                        <?php
                        $icono = 'fas fa-user';
                        $texto = 'Usuario';

                        if (isset($_SESSION['rol'])) {
                            if ($_SESSION['rol'] == 1) {
                                $icono = 'fas fa-user-shield';
                                $texto = 'Admin';
                            } elseif ($_SESSION['rol'] == 3) {
                                if ($_SESSION['area'] === 'electronica') {
                                    $icono = 'fas fa-microchip';
                                    $texto = 'Electrónica';
                                } elseif ($_SESSION['area'] === 'cafe') {
                                    $icono = 'fas fa-mug-hot';
                                    $texto = 'Café';
                                } else {
                                    $icono = 'fas fa-pen-nib';
                                    $texto = 'Publicador';
                                }
                            } elseif ($_SESSION['rol'] == 2 || $_SESSION['rol'] == 4) {
                                $icono = 'fas fa-user-tie';
                                $texto = 'Usuario';
                            } else {
                                $icono = 'fas fa-question-circle';
                                $texto = 'Rol desconocido';
                            }
                        }
                        ?>

                        <a class="nav-link dropdown-toggle d-flex align-items-center p-2 rounded" href="#" id="userDropdown"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false" style="transition: all 0.3s ease;">
                            <div class="bg-primary bg-opacity-10 p-2 rounded-circle me-2">
                                <i class="<?= $icono ?>"></i>
                            </div>
                            <span class="d-none d-lg-inline"><?= $texto ?></span>
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg"
                            style="background: #2c3e50; min-width: 220px;">
                            <li>
                                <a class="dropdown-item d-flex align-items-center py-2" href="inAdmin.php?vista=perfil">
                                    <i class="fas fa-user-cog me-3"></i>
                                    <span>Mi Perfil</span>
                                </a>
                            </li>
                            <?php if (isset($_SESSION['rol']) && $_SESSION['rol'] == 1): ?>
                                <li>
                                    <a class="dropdown-item d-flex align-items-center py-2" href="inAdmin.php?vista=create">
                                        <i class="fas fa-user-plus me-3"></i>
                                        <span>Crear Usuario</span>
                                    </a>
                                </li>
                            <?php endif; ?>
                            <li>
                                <hr class="dropdown-divider my-2" style="border-color: rgba(255,255,255,0.1);">
                            </li>
                            <li>
                                <a class="dropdown-item d-flex align-items-center py-2 text-danger"
                                    href="/sennova/routes/logout.php">
                                    <i class="fas fa-sign-out-alt me-3"></i>
                                    <span>Cerrar Sesión</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- 📱 OFFCANVAS MENU (Sidebar + Opciones usuario solo en móviles) -->
    <div class="offcanvas offcanvas-start d-lg-none " tabindex="-1" id="mobileMenu" aria-labelledby="mobileMenuLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="mobileMenuLabel">Menú</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Cerrar"></button>
        </div>
        <div class="offcanvas-body">
            <!-- Opciones del sidebar -->
            <ul class="nav flex-column mb-4 ">


                <!-- Opciones normales -->
                <li class="nav-item"><a class="nav-link text-dark" href="inAdmin.php?vista=perfil"><i
                            class="fas fa-user me-2"></i>Perfil</a></li>
                <li class="nav-item"><a class="nav-link text-dark" href="inAdmin.php?vista=archivo"><i
                            class="fas fa-folder me-2"></i> Subir Archivo</a></li>
                <li class="nav-item"><a class="nav-link text-dark" href="inAdmin.php?vista=report"><i
                            class="fas fa-file-alt me-2"></i> Reportes</a></li>
                <li class="nav-item"><a class="nav-link text-dark" href="inAdmin.php?vista=gestion"><i
                            class="fas fa-map me-2"></i> Mapa de Gestión</a></li>
                <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-dark">
                    <span>Soporte y servicios</span>
                </h6>
                <li class="nav-item"><a class="nav-link text-dark" href="inAdmin.php?vista=supubli"><i
                            class="fas fa-laptop me-2"></i> Publicaciones</a></li>
                <li class="nav-item"><a class="nav-link text-dark" href="inAdmin.php?vista=servicio"><i
                            class="fas fa-tools me-2"></i> Servicios</a></li>
                <li class="nav-item"><a class="nav-link text-dark" href="inAdmin.php?vista=atencion"><i
                            class="fas fa-headset me-2"></i> Atención Cliente</a></li>
                <?php if (isset($_SESSION['rol']) && $_SESSION['rol'] == 1): ?>
                    <li class="nav-item"><a class="nav-link text-dark" href="inAdmin.php?vista=usuario"><i
                                class="fas fa-street-view me-2"></i> Gestion Pagina</a></li>
                <?php endif; ?>
                <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-dark">
                    <span></span>
                </h6>
                <?php if (isset($_SESSION['rol']) && $_SESSION['rol'] == 1): ?>
                    <li class="nav-item"><a class="nav-link text-dark" href="inAdmin.php?vista=backups"><i
                                class="fas fa-database me-2"></i>
                            Copias de Seguridad</a></li>
                    <li class="nav-item"> <a class="nav-link text-dark" href="inAdmin.php?vista=registreishon"><i
                                class="fas fa-chart-bar me-2"></i>Registros del
                            Sistema</a></li>


                <?php endif; ?>



            </ul>

            <!-- Opciones usuario -->
            <div class="border-top pt-3">
                <p class="mb-2 d-flex  justify-content-center align-items-center">
                    <i
                        class="fas fa-user-circle me-2"></i><?= htmlspecialchars($_SESSION['nombre_usuario'] ?? 'Admin') ?>
                </p>
                <a href="inAdmin.php?vista=create" class="btn btn-sm btn-outline-primary w-100 mb-2 mt-2">
                    <i class="fas fa-user-plus me-1"></i> Crear Usuario
                </a>
                <a href="/sennova/routes/logout.php" class="btn btn-sm btn-outline-danger w-100">
                    <i class="fas fa-sign-out-alt me-1"></i> Cerrar Sesión
                </a>
            </div>
        </div>
    </div>

    <!-- 📱 BOTÓN HAMBURGUESA (solo visible en móviles) -->
    <nav class="mobile-navbar d-lg-none">
        <style>
            .mobile-navbar {
                background: linear-gradient(90deg, #1a1a2e 0%, #2c3e50 100%);
                height: 60px;
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                z-index: 1030;
                display: flex;
                align-items: center;
                justify-content: space-between;
                /* 👈 Esto separa izquierda y derecha */
                padding: 0 20px;
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
                border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            }

            .mobile-navbar-brand {
                color: white;
                font-weight: 600;
                font-size: 1rem;
                display: flex;
                align-items: center;
                text-decoration: none;
            }

            .mobile-navbar-brand i {
                margin-right: 10px;
                color: #4cc9f0;
            }

            .mobile-nav-actions {
                display: flex;
                align-items: center;
                gap: 12px;
            }

            .mobile-nav-btn {
                width: 40px;
                height: 40px;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                background: rgba(255, 255, 255, 0.1);
                color: white;
                border: none;
                transition: all 0.3s ease;
                position: relative;
            }

            .mobile-nav-btn:hover {
                background: rgba(255, 255, 255, 0.2);
                transform: translateY(-1px);
            }

            .notification-badge {
                position: absolute;
                top: -5px;
                right: -5px;
                background: #ff4757;
                color: white;
                border-radius: 50%;
                width: 20px;
                height: 20px;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 0.7rem;
                font-weight: bold;
            }

            @media (min-width: 992px) {
                .mobile-navbar {
                    display: none !important;
                }
            }
        </style>

        <a class="mobile-navbar-brand" href="inAdmin.php?vista=inicio">
            <i class="fas fa-home"></i>
            <?= htmlspecialchars($_SESSION['nombre_usuario'] ?? 'Usuario') ?>
        </a>

        <div class="mobile-nav-actions">
            <!-- Botón notificaciones -->
            <button class="mobile-nav-btn" data-bs-toggle="modal" data-bs-target="#modalNotificaciones">
                <i class="fas fa-bell"></i>
                <?php if ($totalNotif > 0): ?>
                    <span class="notification-badge"><?= $totalNotif ?></span>
                <?php endif; ?>
            </button>

            <!-- Botón menú -->
            <button class="mobile-nav-btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileMenu">
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </nav>

    <!-- Contenido principal -->
    <div class="container-fluid">
        <!-- Sidebar -->
        <nav id="sidebar" class="sidebar collapse d-none d-lg-block">
            <style>
                .sidebar {
                    width: 280px;
                    background: linear-gradient(180deg, #2c3e50 0%, #1a1a2e 100%);
                    color: #fff;
                    transition: all 0.3s;
                    min-height: 100vh;
                    box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
                }

                .sidebar .nav-item {
                    margin: 5px 10px;
                    border-radius: 8px;
                    transition: all 0.3s;
                }

                .admin-navbar {
                    top: 0;
                    left: 280px;
                    /* igual al ancho del sidebar */
                    height: 70px;
                    margin: 0;
                    /* eliminar margen extra */
                }

                #sidebar {
                    position: fixed;
                    top: 0;
                    left: 0;
                    height: 100%;
                }



                .sidebar .nav-link {
                    color: #e0e0e0;
                    padding: 12px 15px;
                    border-radius: 8px;
                    display: flex;
                    align-items: center;
                    font-size: 0.95rem;
                    transition: all 0.2s;
                }

                .sidebar .nav-link:hover {
                    background: rgba(255, 255, 255, 0.1);
                    color: #fff;
                    transform: translateX(5px);
                }

                .sidebar .nav-link.active {
                    background: linear-gradient(135deg, #4361ee 0%, #3a0ca3 100%);
                    color: white !important;
                    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                    font-weight: 500;
                }

                .sidebar .nav-link i {
                    width: 24px;
                    text-align: center;
                    margin-right: 12px;
                    font-size: 1.1rem;
                }

                .sidebar-heading {
                    font-size: 0.75rem;
                    text-transform: uppercase;
                    letter-spacing: 1px;
                    font-weight: 600;
                    color: #9e9e9e !important;
                    padding: 10px 15px !important;
                    margin-top: 20px !important;
                    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
                }

                .sidebar .logo-area {
                    padding: 20px 15px;
                    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
                    margin-bottom: 10px;
                }

                .sidebar .logo-area img {
                    max-width: 180px;
                }

                .sidebar-divider {
                    height: 1px;
                    background: rgba(255, 255, 255, 0.1);
                    margin: 15px 0;
                }
            </style>

            <div class="position-sticky pt-0">
                <!-- Logo Area -->
                <div class="logo-area text-center">
                    <span class="user-welcome-badge">
                        <style>
                            .user-welcome-badge {
                                display: inline-flex;
                                align-items: center;
                                background: rgba(255, 255, 255, 0.05);
                                border-radius: 50px;
                                padding: 8px 15px;
                                border: 1px solid rgba(255, 255, 255, 0.1);
                                backdrop-filter: blur(5px);
                                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
                                transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
                            }

                            .user-welcome-badge:hover {
                                background: rgba(255, 255, 255, 0.1);
                                box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
                                transform: translateY(-1px);
                            }

                            .user-avatar1 {
                                width: 20px;
                                /* reducido */
                                height: 20px;
                                /* reducido */
                                margin-right: 12px;
                                /* menos espacio */
                                font-size: 10px;
                                border-radius: 50%;
                                background: linear-gradient(135deg, #4361ee 0%, #3a0ca3 100%);
                                display: flex;
                                align-items: center;
                                justify-content: center;
                                color: white;
                            }

                            .welcome-text {
                                font-size: 0.95rem;
                                font-weight: 500;
                                color: #f8f9fa;
                            }

                            .user-name {
                                font-weight: 600;
                                color: white;
                                position: relative;
                                display: inline-block;
                            }

                            .user-name::after {
                                content: '';
                                position: absolute;
                                bottom: -2px;
                                left: 0;
                                width: 100%;
                                height: 2px;
                                background: linear-gradient(90deg, #4cc9f0 0%, #4361ee 100%);
                                transform: scaleX(0);
                                transform-origin: right;
                                transition: transform 0.3s ease;
                            }

                            .user-welcome-badge:hover .user-name::after {
                                transform: scaleX(1);
                                transform-origin: left;
                            }
                        </style>

                        <div class="user-avatar1">
                            <i class="fas fa-user"></i>
                        </div>
                        <div class="welcome-text">
                            Bienvenido, <span class="user-name"><?= htmlspecialchars($_SESSION['nombre_usuario'] ?? 'Usuario') ?></span>
                        </div>
                    </span>
                </div>

                <ul class="nav flex-column">
                    <?php if (isset($_SESSION['rol']) && ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2 || $_SESSION['rol'] == 3)): ?>
                        <li class="nav-item">
                            <a class="nav-link <?= $vista === 'inicio' ? 'active' : '' ?>" href="inAdmin.php?vista=inicio">
                                <i class="fas fa-tachometer-alt"></i>
                                <span>Dashboard</span>
                                <span class="active-indicator"></span>
                            </a>
                        </li>

                    <?php endif; ?>

                    <li class="nav-item">
                        <a class="nav-link <?= $vista === 'archivo' ? 'active' : '' ?>" href="inAdmin.php?vista=archivo">
                            <i class="fa-solid fa-cloud-upload-alt"></i>
                            <span>Subir Archivo</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link <?= $vista === 'report' ? 'active' : '' ?>" href="inAdmin.php?vista=report">
                            <i class="fa-solid fa-file"></i>
                            <span>Reportes de Archivos</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link <?= $vista === 'gestion' ? 'active' : '' ?>" href="inAdmin.php?vista=gestion">
                            <i class="fa fa-map"></i>
                            <span>Mapa de Gestion</span>
                        </a>
                    </li>

                    <?php if (isset($_SESSION['rol']) && ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2 || $_SESSION['rol'] == 3)): ?>

                        <h6 class="sidebar-heading">
                            <span>Soporte y servicios</span>
                        </h6>

                        <li class="nav-item">
                            <a class="nav-link <?= $vista === 'supubli' ? 'active' : '' ?>" href="inAdmin.php?vista=supubli">
                                <i class="fas fa-newspaper"></i>
                                <span>Subir Publicaciones</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link <?= $vista === 'maps' ? 'active' : '' ?>" href="inAdmin.php?vista=maps">
                                <i class="fa fa-file-signature"></i>
                                <span>Registrar solicitud</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link <?= $vista === 'servicio' ? 'active' : '' ?>" href="inAdmin.php?vista=servicio">
                                <i class="fas fa-cog"></i>
                                <span>Gestión de Servicios</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link <?= $vista === 'atencion' ? 'active' : '' ?>" href="inAdmin.php?vista=atencion">
                                <i class="fas fa-comments"></i>
                                <span>Atención al Cliente</span>
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php if (isset($_SESSION['rol']) && $_SESSION['rol'] == 1): ?>
                        <div class="sidebar-divider"></div>

                        <li class="nav-item">
                            <a class="nav-link <?= $vista === 'usuario' ? 'active' : '' ?>" href="inAdmin.php?vista=usuario">
                                <i class="fas fa-cogs"></i>
                                <span>Gestión de Página</span>
                            </a>
                        </li>


                        <h6 class="sidebar-heading">
                            <span>Administración</span>
                        </h6>

                        <li class="nav-item">
                            <a class="nav-link <?= $vista === 'backups' ? 'active' : '' ?>" href="inAdmin.php?vista=backups">
                                <i class="fas fa-database"></i>
                                <span>Copias de Seguridad</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link <?= $vista === 'registreishon' ? 'active' : '' ?>" href="inAdmin.php?vista=registreishon">
                                <i class="fas fa-clipboard-list"></i>
                                <span>Registros del Sistema</span>
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </nav>

        <!-- Contenido dinámico del administrador -->
        <main class="main-content">
            <?php
            switch ($vista) {

                case 'usuario':
                    include 'views/admin/usuario.php';
                    break;

                case 'create':
                    require_once 'models/PubliModel.php';
                    $rolModel = new UserModel();
                    $roles = $rolModel->obtenerRolesActivos();
                    include 'views/admin/createAdmin.php';
                    break;

                case 'archivo':
                    include 'views/admin/archivos.php';
                    break;
                case 'maps':
                    include 'views/admin/maps.php';
                    break;

                case 'pdfs':
                    include 'views/admin/pdfs.php';
                    break;


                case 'Notificaciones':
                    $notificaciones = $solicitudController->obtenerHistorial($_SESSION['area']);
                    include 'views/admin/Notificaciones.php';
                    break;

                case 'versiones':
                    require_once 'models/PubliModel.php';
                    $versionModel = new VersionModel();
                    $procesos = $versionModel->getProcesosConVersiones();
                    include 'views/admin/versiones.php';
                    break;

                case 'registreishon':
                    include 'views/admin/registreishon.php';
                    break;

                case 'backups':
                    include 'views/admin/backup.php';
                    break;

                case 'atencion':
                    include 'views/admin/Attentions.php';
                    break;

                case 'supubli':
                    include 'views/admin/supubli.php';
                    break;

                case 'perfil':
                    include 'views/admin/perfil.php';
                    break;

                case 'report':
                    include 'views/admin/report.php';
                    break;

                case 'editarUsuario':
                    include 'views/admin/EditUser.php';
                    break;

                case 'gestion':
                    include 'views/admin/gestion.php';
                    break;

                case 'servicio':
                    include 'views/admin/servicios.php';
                    break;

                default:
                    include 'views/admin/inicio.php';
                    break;
            }
            ?>
        </main>

    </div>
    <!-- 🔔 Modal Notificaciones (común) -->
    <div class="modal fade" id="modalNotificaciones" tabindex="-1" aria-labelledby="nlNd" aria-hidden="true" data-aos="fade-down" data-aos-duration="300">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" id="mdNd" style="max-width: 500px;">
            <div class="modal-content" id="mcNc" style="
            background: linear-gradient(135deg, #2c3e50 0%, #1a1a2e 100%);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 14px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.4);
            overflow: hidden;
        ">
                <!-- Header -->
                <div class="modal-header" id="mhNd" style="
                border-bottom: 1px solid rgba(255, 255, 255, 0.1);
                padding: 1.25rem 1.5rem;
                background: rgba(26, 26, 46, 0.7);
            ">
                    <h5 class="modal-title" id="nlNd" style="
                    font-weight: 600;
                    font-size: 1.1rem;
                    color: #ffffff;
                    display: flex;
                    align-items: center;
                    letter-spacing: 0.5px;
                ">
                        <i class="fas fa-bell" id="icNh" style="
                        color: #ffc107;
                        font-size: 1.2rem;
                        margin-right: 12px;
                        background: rgba(255, 193, 7, 0.15);
                        width: 36px;
                        height: 36px;
                        border-radius: 50%;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                    "></i>
                        <span id="txNt">Notificaciones</span>
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close" id="bcNd" style="
                    filter: brightness(0.8);
                "></button>
                </div>

                <!-- Body -->
                <div class="modal-body" id="mbNd" style="padding: 0;">
                    <?php if (count($notificaciones) == 0): ?>
                        <div class="empty-state" id="esNd" style="
                        padding: 3rem 2rem;
                        text-align: center;
                        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
                    ">
                            <div id="icEs" style="
                            width: 80px;
                            height: 80px;
                            margin: 0 auto 1.5rem;
                            background: rgba(255, 255, 255, 0.03);
                            border-radius: 50%;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                        ">
                                <i class="fas fa-bell-slash" id="icEs2" style="
                                font-size: 2rem;
                                color: rgba(255, 255, 255, 0.2);
                            "></i>
                            </div>
                            <h6 id="txEs1" style="
                            color: rgba(255, 255, 255, 0.8);
                            font-weight: 500;
                            margin-bottom: 0.5rem;
                        ">No hay notificaciones</h6>
                            <p id="txEs2" style="
                            color: rgba(255, 255, 255, 0.4);
                            font-size: 0.9rem;
                            margin-bottom: 0;
                        ">No tienes notificaciones pendientes</p>
                        </div>
                    <?php else: ?>
                        <ul class="notification-list" id="ulNl" style="list-style: none; padding: 0; margin: 0;">
                            <?php foreach ($notificaciones as $index => $notif): ?>
                                <li class="notification-item" id="liNi-<?= $index ?>" style="
                                padding: 1.25rem 1.5rem;
                                border-bottom: 1px solid rgba(255, 255, 255, 0.05);
                                transition: all 0.2s ease;
                                position: relative;
                                background: <?= !$notif['leida'] ? 'rgba(255, 193, 7, 0.05)' : 'transparent' ?>;
                                border-left: 3px solid <?= !$notif['leida'] ? '#ffc107' : 'transparent' ?>;
                            ">
                                    <div class="notification-content" id="ncNd-<?= $index ?>" style="position: relative;">
                                        <div class="notification-message" id="nmNd-<?= $index ?>" style="
                                        color: #fff;
                                        font-size: 0.95rem;
                                        line-height: 1.5;
                                        margin-bottom: 6px;
                                        padding-right: <?= !$notif['leida'] ? '40px' : '20px' ?>;
                                    "><?= htmlspecialchars($notif['mensaje']) ?></div>
                                        <div class="notification-meta" id="ntNd-<?= $index ?>" style="
                                        display: flex;
                                        align-items: center;
                                        color: rgba(255, 255, 255, 0.4);
                                        font-size: 0.8rem;
                                    ">
                                            <span id="spDt-<?= $index ?>"><?= date('d/m/Y H:i', strtotime($notif['fecha'])) ?></span>
                                            <span id="spSp-<?= $index ?>" style="
                                            display: inline-block;
                                            width: 4px;
                                            height: 4px;
                                            border-radius: 50%;
                                            background: rgba(255, 255, 255, 0.4);
                                            margin: 0 8px;
                                        "></span>
                                            <span id="spSy-<?= $index ?>">Sistema</span>
                                        </div>
                                        <?php if (!$notif['leida']): ?>
                                            <span class="badge bg-warning" id="bdNw-<?= $index ?>" style="
                                            position: absolute;
                                            top: 0;
                                            right: 0;
                                            font-size: 0.7rem;
                                            padding: 0.25rem 0.5rem;
                                        ">Nueva</span>
                                        <?php endif; ?>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>

                <!-- Footer -->
                <div class="modal-footer" id="mfNd" style="
                border-top: 1px solid rgba(255, 255, 255, 0.08);
                padding: 1rem 1.5rem;
                background: rgba(15, 15, 25, 0.5);
            ">
                    <a href="inAdmin.php?vista=Notificaciones" class="btn btn-sm" id="btHr" style="
                    background: rgba(255, 255, 255, 0.05);
                    color: rgba(255, 255, 255, 0.8);
                    border: 1px solid rgba(255, 255, 255, 0.1);
                    border-radius: 8px;
                    padding: 0.5rem 1rem;
                    font-size: 0.85rem;
                    font-weight: 500;
                    transition: all 0.2s ease;
                ">
                        <i class="fas fa-clock me-2"></i> Ver historial completo
                    </a>
                    <button type="button" class="btn btn-sm" data-bs-dismiss="modal" id="btCl" style="
                    background: linear-gradient(90deg, #ffc107 0%, #ff9800 100%);
                    color: #000;
                    border: none;
                    border-radius: 8px;
                    padding: 0.5rem 1rem;
                    font-size: 0.85rem;
                    font-weight: 500;
                    transition: all 0.2s ease;
                ">
                        Cerrar
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }

        document.addEventListener('DOMContentLoaded', () => {
            const modalNotif = document.getElementById('modalNotificaciones');
            if (modalNotif) {
                modalNotif.addEventListener('shown.bs.modal', () => {
                    fetch('/sennova/routes/marcarLeidas.php?area=<?= $area ?>')
                        .then(res => {
                            if (!res.ok) throw new Error("Error al marcar notificaciones");
                            return res.text();
                        })
                        .catch(err => console.error(err));
                });
            }
        });

        // Ajustar el padding del body cuando se abre el offcanvas en móviles
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenu = document.getElementById('mobileMenu');

            mobileMenu.addEventListener('show.bs.offcanvas', function() {
                document.body.style.paddingRight = '0';
                document.body.classList.add('offcanvas-open');
            });

            mobileMenu.addEventListener('hidden.bs.offcanvas', function() {
                document.body.classList.remove('offcanvas-open');
            });

            // Ajustar altura del sidebar
            function adjustSidebarHeight() {
                const sidebar = document.getElementById('sidebar');
                if (sidebar && window.innerWidth >= 992) {
                    sidebar.style.height = '100vh';
                }
            }

            window.addEventListener('resize', adjustSidebarHeight);
            adjustSidebarHeight();
        });

        document.querySelectorAll('.cerrar-notif').forEach(btn => {
            btn.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const notif = document.getElementById('notif-' + id);
                if (notif) {
                    notif.style.display = 'none'; // Solo se oculta del DOM
                }
            });
        });

        document.getElementById('btnHistorialNotif').addEventListener('click', function() {
            window.location.href = "inAdmin.php?vista=Notificaciones";
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            once: true,
            duration: 400
        });
    </script>
    <script src="public/js/admin/main.js"></script>
</body>

</html>