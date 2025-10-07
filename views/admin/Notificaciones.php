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
        <?php
        require_once 'models/PubliModel.php';

        $solicitudModel = new SolicitudModel();

        // --- Filtros ---
        $desde   = $_GET['desde']  ?? null;
        $hasta   = $_GET['hasta']  ?? null;
        $buscar  = $_GET['buscar'] ?? null;

        // Si usas área por sesión/rol, ajusta esta línea:
        $area    = $_GET['area']   ?? null;
        $esAdmin = ((int)($_SESSION['rol'] ?? 0) === 1);

        // --- Paginación ---
        $perPage = 30;
        $page    = max(1, (int)($_GET['page'] ?? 1));
        $offset  = ($page - 1) * $perPage;

        // TOTAL y datos paginados (¡únicas consultas!)
        $total = $solicitudModel->contarHistorialNotificaciones($area, $desde, $hasta, $buscar, $esAdmin);
        $notificaciones = $solicitudModel->obtenerHistorialNotificacionesPaginado(
            $area,
            $desde,
            $hasta,
            $buscar,
            $esAdmin,
            $perPage,
            $offset
        );
        $pages = max(1, (int)ceil($total / $perPage));

        // Helper para conservar filtros en los links de paginación
        function qs_keep(array $extra = []): string
        {
            $params = $_GET;
            unset($params['page']);
            return '?' . http_build_query(array_merge($params, $extra));
        }
        ?>

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
                        <div class="list-group-item border-0 border-bottom <?= !$notif['leida'] ? 'unread' : '' ?>" id="notif-<?= (int)$notif['id'] ?>">
                            <div class="d-flex justify-content-between align-items-start">
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

                                <div class="d-flex flex-column align-items-end gap-1">
                                    <button class="btn btn-sm btn-link btn-toggle" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#detalleNotif<?= $i ?>" aria-expanded="false">
                                        <i class="fas fa-chevron-down"></i>
                                    </button>

                                    <button class="btn btn-sm btn-outline-danger btn-eliminar-notif"
                                        data-id="<?= (int)$notif['id'] ?>" title="Eliminar notificación">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- Paginación -->
                <?php if ($pages > 1): ?>
                    <div class="card-footer border-top py-3" style="background: linear-gradient(90deg, #2c3e50 0%, #1a1a2e 100%); border-top-color: rgba(255,255,255,0.1) !important;">
                        <nav aria-label="Paginación">
                            <ul class="pagination justify-content-center mb-0">
                                <!-- Anterior -->
                                <li class="page-item <?= $page <= 1 ? 'disabled' : '' ?>">
                                    <a class="page-link bg-transparent text-light border-light"
                                        href="<?= $page > 1 ? ('inAdmin.php' . qs_keep(['vista' => 'Notificaciones', 'page' => $page - 1])) : '#' ?>"
                                        tabindex="-1">Anterior</a>
                                </li>

                                <!-- Números -->
                                <?php
                                $start = max(1, $page - 2);
                                $end   = min($pages, $page + 2);

                                if ($start > 1) {
                                    echo '<li class="page-item"><a class="page-link bg-transparent text-light border-light" href="inAdmin.php' . qs_keep(['vista' => 'Notificaciones', 'page' => 1]) . '">1</a></li>';
                                    if ($start > 2) echo '<li class="page-item disabled"><span class="page-link bg-transparent text-light border-light">…</span></li>';
                                }

                                for ($i = $start; $i <= $end; $i++):
                                ?>
                                    <li class="page-item <?= $i === $page ? 'active' : '' ?>">
                                        <a class="page-link <?= $i === $page ? 'bg-warning border-warning text-dark' : 'bg-transparent text-light border-light' ?>"
                                            href="inAdmin.php<?= qs_keep(['vista' => 'Notificaciones', 'page' => $i]) ?>"><?= $i ?></a>
                                    </li>
                                <?php endfor;

                                if ($end < $pages) {
                                    if ($end < $pages - 1) echo '<li class="page-item disabled"><span class="page-link bg-transparent text-light border-light">…</span></li>';
                                    echo '<li class="page-item"><a class="page-link bg-transparent text-light border-light" href="inAdmin.php' . qs_keep(['vista' => 'Notificaciones', 'page' => $pages]) . '">' . $pages . '</a></li>';
                                }
                                ?>

                                <!-- Siguiente -->
                                <li class="page-item <?= $page >= $pages ? 'disabled' : '' ?>">
                                    <a class="page-link bg-transparent text-light border-light"
                                        href="<?= $page < $pages ? ('inAdmin.php' . qs_keep(['vista' => 'Notificaciones', 'page' => $page + 1])) : '#' ?>">Siguiente</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                <?php endif; ?>
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
        // Ajusta esta ruta si tu app vive en otro path
        const API_URL = '/sennova/routes/limpiar_notificaciones.php';

        const lista = document.getElementById('contenedorNotificaciones');
        const btnLimpiar = document.getElementById('btnLimpiarNotificaciones');

        // ---------- Limpiar TODO el historial ----------
        btnLimpiar?.addEventListener('click', async (e) => {
            e.preventDefault();

            // Confirmación
            let okConfirm = {
                isConfirmed: true
            };
            if (window.Swal) {
                okConfirm = await Swal.fire({
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
            } else if (!confirm('¿Eliminar todo el historial? Esta acción no se puede deshacer.')) {
                okConfirm = {
                    isConfirmed: false
                };
            }
            if (!okConfirm.isConfirmed) return;

            // Loading
            if (window.Swal) {
                Swal.fire({
                    title: 'Eliminando...',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    didOpen: () => Swal.showLoading()
                });
            }

            try {
                const body = new URLSearchParams({
                    accion: 'limpiar'
                });
                const res = await fetch(API_URL, {
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body
                });

                const data = await parseJsonOrThrow(res);
                if (!res.ok || !data.success) {
                    throw new Error(data.error || 'Error al eliminar el historial');
                }

                if (window.Swal) {
                    await Swal.fire({
                        icon: 'success',
                        title: 'Historial eliminado',
                        text: data.message || 'Operación realizada correctamente',
                        timer: 1600,
                        showConfirmButton: false
                    });
                } else {
                    alert('Historial eliminado correctamente');
                }

                location.reload();
            } catch (err) {
                if (window.Swal) {
                    Swal.fire({
                        icon: 'error',
                        title: 'No se pudo eliminar',
                        text: err.message || 'Ocurrió un error',
                        confirmButtonText: 'Entendido',
                        customClass: {
                            confirmButton: 'btn btn-danger'
                        },
                        buttonsStyling: false
                    });
                } else {
                    alert('Error: ' + (err.message || 'Ocurrió un error'));
                }
            }
        });

        // ---------- Eliminar UNA notificación (botón por ítem) ----------
        lista?.addEventListener('click', async (e) => {
            const btn = e.target.closest('.btn-eliminar-notif');
            if (!btn) return;

            e.preventDefault();
            const id = btn.dataset.id;
            if (!id) return;

            // Confirmación
            let okConfirm = {
                isConfirmed: true
            };
            if (window.Swal) {
                okConfirm = await Swal.fire({
                    title: '¿Eliminar esta notificación?',
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
            } else if (!confirm('¿Eliminar esta notificación? Esta acción no se puede deshacer.')) {
                okConfirm = {
                    isConfirmed: false
                };
            }
            if (!okConfirm.isConfirmed) return;

            // Loading
            if (window.Swal) {
                Swal.fire({
                    title: 'Eliminando...',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    didOpen: () => Swal.showLoading()
                });
            }

            try {
                const fd = new FormData();
                fd.append('id', id);

                const res = await fetch(API_URL, {
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: fd
                });

                const data = await parseJsonOrThrow(res);
                if (!res.ok || !data.ok) {
                    throw new Error(data.error || 'No se pudo eliminar');
                }

                // Quitar del DOM
                document.getElementById('notif-' + id)?.remove();

                if (window.Swal) {
                    await Swal.fire({
                        icon: 'success',
                        title: 'Notificación eliminada',
                        timer: 1300,
                        showConfirmButton: false
                    });
                } else {
                    alert('Notificación eliminada');
                }

                // Si ya no quedan items, recarga para mostrar el estado vacío/paginación coherente
                if (!lista.querySelector('.list-group-item')) location.reload();

            } catch (err) {
                if (window.Swal) {
                    Swal.fire({
                        icon: 'error',
                        title: 'No se pudo eliminar',
                        text: err.message || 'Ocurrió un error',
                        confirmButtonText: 'Entendido',
                        customClass: {
                            confirmButton: 'btn btn-danger'
                        },
                        buttonsStyling: false
                    });
                } else {
                    alert('Error: ' + (err.message || 'Ocurrió un error'));
                }
            }
        });

        // ---------- Helper: validar y parsear JSON ----------
        async function parseJsonOrThrow(res) {
            const ct = (res.headers.get('content-type') || '').toLowerCase();
            if (!ct.includes('application/json')) {
                const text = await res.text();
                throw new Error('Respuesta no-JSON del servidor:\n' + text.slice(0, 300));
            }
            return res.json();
        }
    });
</script>