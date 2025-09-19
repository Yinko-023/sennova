<?php
require_once 'models/PubliModel.php';
$solicitudModel = new SolicitudModel();
$desde = $_GET['desde'] ?? null;
$hasta = $_GET['hasta'] ?? null;
$buscar = $_GET['buscar'] ?? null;
$notificaciones = $solicitudModel->obtenerHistorialNotificaciones($area, $desde, $hasta, $buscar); ?>

<div class="container-fluid px-4 py-4" id="notificacionesContainer">
    <div class="notifications-wrap">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 gap-3" id="notificacionesHeader">
            <div id="headerTitulo">
                <h1 class="h3 mb-2 fw-semibold text-white">
                    <i class="fas fa-bell me-2 text-warning"></i>Historial de Notificaciones
                </h1>
                <p class="text-light small mb-0 opacity-75">Registro completo de todas las notificaciones del sistema</p>
            </div>
            <div class="d-flex gap-2" id="headerAcciones">
                <button type="button" class="btn btn-danger btn-sm" id="btnLimpiarNotificaciones">
                    <i class="fas fa-trash-alt me-1"></i> Limpiar historial
                </button>

                <a href="inAdmin.php?vista=inicio" class="btn btn-outline-light btn-sm">
                    <i class="fas fa-arrow-left me-1"></i> Volver
                </a>
            </div>
        </div>

        <div class="card border-0 shadow-lg mb-4" id="filtrosCard">
            <div class="card-body p-3" style="background: linear-gradient(90deg, #2c3e50 0%, #1a1a2e 100%);">
                <form method="GET" class="row g-2 g-md-3 align-items-center" id="formFiltros">
                    <input type="hidden" name="vista" value="Notificaciones">

                    <div class="col-md-5" id="filtroBusqueda">
                        <div class="input-group">
                            <span class="input-group-text text-white" style="background: rgba(255,255,255,0.1); border-color: rgba(255,255,255,0.2);">
                                <i class="fas fa-search"></i>
                            </span>
                            <input type="text" name="buscar" value="<?= htmlspecialchars($_GET['buscar'] ?? '') ?>"
                                class="form-control text-white" placeholder="Buscar en notificaciones..."
                                style="background: rgba(255,255,255,0.1); border-color: rgba(255,255,255,0.2);">
                        </div>
                    </div>

                    <div class="col-md-3" id="filtroDesde">
                        <input type="date" name="desde" value="<?= htmlspecialchars($_GET['desde'] ?? '') ?>"
                            class="form-control text-white" placeholder="Desde"
                            style="background: rgba(255,255,255,0.1); border-color: rgba(255,255,255,0.2);">
                    </div>

                    <div class="col-md-3" id="filtroHasta">
                        <input type="date" name="hasta" value="<?= htmlspecialchars($_GET['hasta'] ?? '') ?>"
                            class="form-control text-white" placeholder="Hasta"
                            style="background: rgba(255,255,255,0.1); border-color: rgba(255,255,255,0.2);">
                    </div>

                    <div class="col-md-1" id="filtroBoton">
                        <button type="submit" class="btn btn-warning w-100">
                            <i class="fas fa-filter"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Listado de notificaciones -->
        <div class="card border-0 shadow-lg" id="listaNotificaciones">
            <?php if (empty($notificaciones)): ?>
                <div class="card-body text-center py-5" style="background: linear-gradient(90deg, #2c3e50 0%, #1a1a2e 100%);">
                    <div class="py-4">
                        <i class="fas fa-bell-slash fa-3x text-light mb-3 opacity-50"></i>
                        <h5 class="fw-semibold text-light mb-2">No hay notificaciones</h5>
                        <p class="text-light small opacity-75">No se encontraron notificaciones en el historial</p>
                    </div>
                </div>
            <?php else: ?>
                <div class="list-group list-group-flush" id="contenedorNotificaciones">
                    <?php foreach ($notificaciones as $i => $notif): ?>
                        <div class="list-group-item border-0 border-bottom <?= !$notif['leida'] ? 'unread' : '' ?>">
                            <div class="d-flex justify-content-between align-items-start">
                                <!-- Contenido principal -->
                                <div class="flex-grow-1 me-3">
                                    <div class="d-flex align-items-center mb-1">
                                        <h6 class="mb-0 fw-semibold <?= $notif['leida'] ? 'text-muted' : '' ?>">
                                            <?= htmlspecialchars($notif['mensaje']) ?>
                                        </h6>
                                        <?php if (!$notif['leida']): ?>
                                            <span class="badge badge-new ms-2">Nueva</span>
                                        <?php endif; ?>
                                    </div>

                                    <div class="list-meta">
                                        <span><i class="far fa-user me-1"></i><?= htmlspecialchars($notif['nombre'] ?? '—') ?></span>
                                        <span><i class="far fa-building me-1"></i><?= htmlspecialchars($notif['empresa'] ?? '—') ?></span>
                                        <span><i class="far fa-calendar-alt me-1"></i><?= date('d M Y H:i', strtotime($notif['fecha'])) ?></span>
                                    </div>

                                    <!-- Detalles expandibles -->
                                    <div class="collapse mt-2" id="detalleNotif<?= $i ?>">
                                        <div class="p-3 rounded small details-box">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <p class="mb-2"><strong>Email:</strong> <?= htmlspecialchars($notif['email'] ?? '—') ?></p>
                                                    <p class="mb-2"><strong>Teléfono:</strong> <?= htmlspecialchars($notif['telefono'] ?? '—') ?></p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p class="mb-2"><strong>Servicio:</strong>
                                                        <span class="badge bg-warning-subtle text-warning-emphasis">
                                                            <?= htmlspecialchars($notif['servicio'] ?? '—') ?>
                                                        </span>
                                                    </p>
                                                    <?php if ($esAdmin && isset($notif['area'])): ?>
                                                        <p class="mb-0"><strong>Área:</strong>
                                                            <span class="badge <?= $notif['area'] === 'cafe' ? 'bg-success-subtle text-success-emphasis' : 'bg-info-subtle text-info-emphasis' ?>">
                                                                <?= ucfirst($notif['area']) ?>
                                                            </span>
                                                        </p>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Acciones -->
                                <div class="d-flex flex-column align-items-end">
                                    <button class="btn btn-sm btn-link btn-toggle" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#detalleNotif<?= $i ?>" aria-expanded="false">
                                        <i class="fas fa-chevron-down"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                    <?php endforeach; ?>
                </div>

                <!-- Paginación simple -->
                <div class="card-footer border-top py-3" style="background: linear-gradient(90deg, #2c3e50 0%, #1a1a2e 100%); border-top-color: rgba(255,255,255,0.1) !important;">
                    <nav aria-label="Paginación">
                        <ul class="pagination justify-content-center mb-0">
                            <li class="page-item disabled">
                                <a class="page-link bg-transparent text-light border-light" href="#" tabindex="-1">Anterior</a>
                            </li>
                            <li class="page-item active"><a class="page-link bg-warning border-warning text-dark" href="#">1</a></li>
                            <li class="page-item"><a class="page-link bg-transparent text-light border-light" href="#">2</a></li>
                            <li class="page-item"><a class="page-link bg-transparent text-light border-light" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link bg-transparent text-light border-light" href="#">Siguiente</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<style>
    :root {
        --bg-page: #eef2f7;
        --surface: #ffffff;
        --surface-2: #f7f8fb;
        --ink: #0f172a;
        --muted: #64748b;
        --line: #e5e7eb;
        --brand: #0ea5e9;
        --accent: #f59e0b;
    }

    #notificacionesContainer {
        background: var(--bg-page);
        min-height: 100vh;
        padding-bottom: 32px;
    }

    .notifications-wrap {
        max-width: 1100px;
        margin: 0 auto;
        margin-top: 30px;

    }

    /* HEADER */
    #notificacionesHeader {
        background: linear-gradient(135deg, #2c3e50, #1a1a2e);
        color: #fff;
        padding: 20px 24px;
        border-radius: 16px;
        border: 0;
        backdrop-filter: none;
    }

    /* FILTROS */
    #filtrosCard {
        border-radius: 12px;
        overflow: visible;
    }

    #filtrosCard .card-body {
        background: var(--surface);
        border: 1px solid var(--line);
        border-radius: 12px;
    }

    #formFiltros .input-group-text {
        background: var(--surface-2);
        color: var(--muted);
        border-color: var(--line);
    }

    #formFiltros .form-control {
        background: var(--surface);
        color: var(--ink);
        border-color: var(--line);
    }

    #formFiltros input::placeholder {
        color: #9aa3af !important;
    }

    /* LISTA */
    #listaNotificaciones {
        background: var(--surface);
        border: 1px solid var(--line);
        border-radius: 12px;
        overflow: hidden;
    }

    #contenedorNotificaciones .list-group-item {
        background: #fff !important;
        border-bottom: 1px solid var(--line) !important;
        padding: 14px 18px;
        transition: background .2s ease;
    }

    #contenedorNotificaciones .list-group-item:hover {
        background: var(--surface-2) !important;
    }

    /* no leídas: barra a la izquierda */
    #contenedorNotificaciones .list-group-item.unread {
        position: relative;
    }

    #contenedorNotificaciones .list-group-item.unread::before {
        content: "";
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        width: 4px;
        background: var(--accent);
    }

    /* títulos y meta */
    #contenedorNotificaciones h6 {
        color: var(--ink);
        opacity: 1 !important;
    }

    .list-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        font-size: .875rem;
        color: var(--muted);
    }

    /* badge “Nueva” más legible */
    .badge-new {
        background: var(--accent);
        color: #111;
    }

    /* botón colapsar */
    .btn-toggle {
        color: var(--brand);
    }

    .btn-toggle[aria-expanded="true"] i {
        transform: rotate(180deg);
        transition: transform .2s;
    }

    /* paginación */
    .card-footer {
        background: var(--surface);
        border-top: 1px solid var(--line) !important;
    }

    /* responsive */
    @media (max-width:768px) {
        #notificacionesHeader {
            padding: 16px;
        }

        #formFiltros .col-md-5,
        #formFiltros .col-md-3,
        #formFiltros .col-md-1 {
            flex: 0 0 100%;
            max-width: 100%;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const btn = document.getElementById('btnLimpiarNotificaciones');
        btn?.addEventListener('click', async (e) => {
            e.preventDefault();

            const {
                isConfirmed
            } = await Swal.fire({
                title: '¿Eliminar todo el historial?',
                text: 'Esta acción no se puede deshacer.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar',
                reverseButtons: true,
                customClass: {
                    confirmButton: 'btn btn-danger',
                    cancelButton: 'btn btn-secondary'
                },
                buttonsStyling: false
            });
            if (!isConfirmed) return;

            Swal.showLoading();
            try {
                const res = await fetch('routes/limpiar_notificaciones.php', { // <-- ajusta la ruta
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });
                if (!res.ok) throw 0;

                await Swal.fire({
                    icon: 'success',
                    title: 'Historial eliminado',
                    timer: 1600,
                    showConfirmButton: false
                });
                location.reload();
            } catch {
                Swal.fire({
                    icon: 'error',
                    title: 'No se pudo eliminar',
                    confirmButtonText: 'Entendido',
                    customClass: {
                        confirmButton: 'btn btn-danger'
                    },
                    buttonsStyling: false
                });
            }
        });
    });

    // Script para manejar el botón de limpiar notificaciones
    document.getElementById('btnLimpiarNotificaciones').addEventListener('click', function() {
        var modal = new bootstrap.Modal(document.getElementById('confirmarLimpiarModal'));
        modal.show();
    });

    document.getElementById('confirmarLimpiar').addEventListener('click', function() {
        alert('Historial de notificaciones eliminado'); 
        location.reload(); 
    });
</script>