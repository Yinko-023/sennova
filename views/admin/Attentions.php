<?php
$estado = $_GET['estado'] ?? 'todas';
$busqueda = $_GET['busqueda'] ?? '';
$esAdmin = empty($_SESSION['area']); // El admin no tiene área asignada
$area = $esAdmin ? ($_GET['area'] ?? '') : $_SESSION['area'];

// Este será el parámetro que usarás en los botones
$areaParam = $esAdmin && $area !== '' ? '&area=' . urlencode($area) : '';

$controller = new SolicitudController();

if ($esAdmin) {
    if (!empty($area)) {
        // Admin viendo un área específica
        $solicitudes = $controller->obtenerSolicitudesPorArea($estado, $area, $busqueda);
    } else {
        // Admin viendo todas las áreas
        $solicitudes = $controller->obtenerSolicitudesTodas($estado, $busqueda);
    }
} else {
    // Usuario de área específica
    $solicitudes = $controller->obtenerSolicitudesPorArea($estado, $area, $busqueda);
} ?>

<div class="container mt-5">
    <div class="text-center my-4" data-aos="fade-up">
        <h2 class="fw-bold display-6 text-dark">
            <i class="fas fa-headset text-primary me-2"></i>
            Gestión de Solicitudes
            <?php if (empty($_SESSION['area'])): ?>
                <span class="text-primary">Admin</span>
            <?php else: ?>
                de <span class="text-primary"><?= ucfirst($area) ?></span>
            <?php endif; ?>
        </h2>
    </div>


    <?php if (isset($_GET['res']) && $_GET['res'] === 'ok'): ?>
        <div class="success-modal active" id="successModal">
            <div class="modal-content">
                <button class="modal-close" id="closeModal">&times;</button>
                <div class="modal-icon">
                    <i class="fas fa-check"></i>
                </div>
                <h2 class="modal-title">¡Éxito!</h2>
                <p class="modal-message">Solicitud atendida correctamente.</p>
                <button class="modal-button" id="acceptButton">Aceptar</button>
            </div>
        </div>
    <?php endif; ?>

    <!-- Buscador -->
    <form method="GET" action="inAdmin.php?vista=atencion" id="form-busqueda-live" class="mb-4 position-relative">
        <input type="hidden" name="vista" value="atencion">
        <input type="hidden" name="estado" value="<?= htmlspecialchars($estado) ?>">

        <div class="input-group shadow-sm position-relative">
            <!-- Campo de búsqueda con padding derecho -->
            <input type="text" name="busqueda" id="inputBusqueda"
                class="form-control form-control-lg pe-5"
                placeholder="Buscar por nombre, empresa o email"
                value="<?= isset($_GET['busqueda']) ? htmlspecialchars($_GET['busqueda']) : '' ?>"
                autocomplete="off">

            <!-- Botón X con posición absoluta fuera del input -->
            <button type="button" id="limpiarBusqueda"
                class="btn btn-sm btn-light border position-absolute"
                style="top: 50%; right: 80px; transform: translateY(-50%); display: none;"
                title="Limpiar búsqueda">
                <i class="fas fa-times text-muted"></i>
            </button>

            <!-- Botón Buscar -->
            <button type="submit" class="btn btn-primary btn-lg">
                <i class="fas fa-search me-1"></i> Buscar
            </button>
        </div>
    </form>

    <!-- Botones tipo tarjetas -->
    <?php if ($esAdmin): ?>
        <div class="row text-center g-3 mb-4">
            <!-- Ambas Áreas -->
            <div class="col-4">
                <a href="inAdmin.php?vista=atencion" class="text-decoration-none">
                    <div class="card shadow-sm border-0 <?= empty($area) ? 'bg-dark text-white' : '' ?>">
                        <div class="card-body py-3">
                            <i class="fas fa-layer-group fa-lg mb-1"></i>
                            <div>Ambas Áreas</div>
                        </div>
                    </div>
                </a>
            </div>
            <!-- Área Café -->
            <div class="col-4">
                <a href="inAdmin.php?vista=atencion&area=cafe" class="text-decoration-none">
                    <div class="card shadow-sm border-0 <?= $area == 'cafe' ? 'bg-purple text-white' : '' ?>">
                        <div class="card-body py-3">
                            <i class="fas fa-mug-hot fa-lg mb-1"></i>
                            <div>Área Café</div>
                        </div>
                    </div>
                </a>
            </div>
            <style>
                .bg-purple {
                    background-color: #6f42c1 !important;
                    /* Bootstrap's "purple" */
                    color: white;
                }
            </style>
            <!-- Área Electrónica -->
            <div class="col-4">
                <a href="inAdmin.php?vista=atencion&area=electronica" class="text-decoration-none">
                    <div class="card shadow-sm border-0 <?= $area == 'electronica' ? 'bg-info text-white' : '' ?>">
                        <div class="card-body py-3">
                            <i class="fas fa-microchip fa-lg mb-1"></i>
                            <div>Área Electrónica</div>
                        </div>
                    </div>
                </a>
            </div>


        </div>
    <?php endif; ?>


    <div class="row text-center g-3 mb-4">
        <div class="col-6 col-md-3">
            <a href="inAdmin.php?vista=atencion&estado=todas<?= $areaParam ?>"
                class="text-decoration-none">
                <div class="card border-0 shadow-sm <?= $estado == 'todas' ? 'bg-dark text-white' : '' ?>">
                    <div class="card-body py-3">
                        <i class="fas fa-list fa-lg mb-1"></i>
                        <div>Todos</div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-6 col-md-3">
            <a href="inAdmin.php?vista=atencion&estado=pendiente<?= $areaParam ?>"
                class="text-decoration-none">


                <div class="card border-warning shadow-sm <?= $estado == 'pendiente' ? 'bg-warning text-dark' : '' ?>">
                    <div class="card-body py-3">
                        <i class="fas fa-hourglass-half fa-lg mb-1"></i>
                        <div>Pendientes</div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-6 col-md-3">
            <a href="inAdmin.php?vista=atencion&estado=aceptada<?= $areaParam ?>"
                class="text-decoration-none">


                <div class="card border-success shadow-sm <?= $estado == 'aceptada' ? 'bg-success text-white' : '' ?>">
                    <div class="card-body py-3">
                        <i class="fas fa-check-circle fa-lg mb-1"></i>
                        <div>Aceptadas</div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-6 col-md-3">
            <a href="inAdmin.php?vista=atencion&estado=rechazada<?= $areaParam ?>"
                class="text-decoration-none">

                <div class="card border-danger shadow-sm <?= $estado == 'rechazada' ? 'bg-danger text-white' : '' ?>">
                    <div class="card-body py-3">
                        <i class="fas fa-times-circle fa-lg mb-1"></i>
                        <div>Rechazadas</div>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <?php if (isset($_GET['eliminado'])): ?>
        <div class="alert alert-success text-center">Solicitud eliminada correctamente.</div>
    <?php endif; ?>

    <?php if (empty($solicitudes)): ?>
        <div class="alert alert-info text-center">No hay solicitudes pendientes por ahora.</div>
    <?php else: ?>

        <div class="row g-4 mt-3">
            <?php foreach ($solicitudes as $soli): ?>
                <div class="col-12 col-md-6">
                    <div class="card shadow-sm border-0 h-100 position-relative">
                        <div class="card-body">
                            <!-- Botones arriba a la derecha -->
                            <div class="position-absolute top-0 end-0 m-2 d-flex gap-1">
                                <!-- Botón destacar -->
                                <form method="post" action="routes/destacarServi.php" class="d-inline">
                                    <input type="hidden" name="id_re" value="<?= $soli['id_re'] ?>">
                                    <button type="submit"
                                        class="btn btn-<?= $soli['destacado_re'] ? 'secondary' : 'warning' ?> btn-sm"
                                        title="<?= $soli['destacado_re'] ? 'Quitar destacado' : 'Destacar solicitud' ?>">
                                        <i class="fas fa-star<?= $soli['destacado_re'] ? '' : '-half-alt' ?>"></i>
                                    </button>
                                </form>

                                <!-- Botón eliminar -->
                                <form method="post" action="routes/DeleteServi.php"
                                    onsubmit="return confirm('¿Estás seguro de eliminar esta solicitud?')" class="d-inline">
                                    <input type="hidden" name="id_re" value="<?= $soli['id_re'] ?>">
                                    <button type="submit" class="btn btn-outline-danger btn-sm" title="Eliminar solicitud">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>

                            <!-- Contenido de la solicitud -->
                            <h5 class="card-title fw-bold text-primary-emphasis mt-4"><?= htmlspecialchars($soli['nombre']) ?></h5>
                            <p class="mb-1"><strong>Cédula:</strong> <?= htmlspecialchars($soli['cc_cliente']) ?></p>
                            <p class="mb-1"><strong>Servicio:</strong> <?= htmlspecialchars($soli['servicio']) ?></p>
                            <p class="mb-1"><strong>Empresa:</strong> <?= htmlspecialchars($soli['empresa']) ?></p>
                            <p class="mb-1"><strong>Teléfono:</strong> <?= htmlspecialchars($soli['telefono']) ?></p>
                            <p class="mb-1"><strong>Email:</strong> <?= htmlspecialchars($soli['email']) ?></p>
                            <p><strong>Descripción:</strong><br><?= nl2br(htmlspecialchars($soli['descripcion'])) ?></p>

                            <!-- Mostrar área solo si es admin -->
                            <?php if (empty($_SESSION['area'])): ?>
                                <p class="mb-1">
                                    <strong>Área:</strong>
                                    <span class="badge text-white ms-1"
                                        style="background-color: <?= $soli['area'] === 'cafe' ? '#6f42c1' : '#0dcaf0' ?>;">
                                        <?= ucfirst($soli['area']) ?>
                                    </span>
                                </p>


                            <?php endif; ?>

                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <span class="badge bg-<?= $soli['estado'] === 'pendiente' ? 'warning text-dark' : ($soli['estado'] === 'aceptada' ? 'success' : 'danger') ?>">
                                    <?= ucfirst($soli['estado']) ?>
                                </span>

                                <?php if ($soli['estado'] === 'pendiente'): ?>
                                    <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#respuestaModal<?= $soli['id_re'] ?>">
                                        <i class="fas fa-reply me-1"></i> Responder
                                    </button>
                                <?php else: ?>
                                    <small class="text-muted">
                                        <?= ucfirst($soli['medio_notificacion']) ?><br>
                                        <em><?= htmlspecialchars($soli['comentario']) ?></em>
                                    </small>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="respuestaModal<?= $soli['id_re'] ?>" tabindex="-1"
                    aria-labelledby="modalLabel<?= $soli['id_re'] ?>" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-narrow"><!-- modal-lg para PC -->
                        <div class="modal-content">
                            <form action="routes/Atendido.php" method="POST"
                                class="respuesta-form" id="formResp<?= $soli['id_re'] ?>">
                                <input type="hidden" name="id_soli" value="<?= $soli['id_re'] ?>">
                                <!-- bandera si NO comenta: '1' = sin comentario, '0' = con comentario -->
                                <input type="hidden" name="sin_opinion" id="sinOpinion<?= $soli['id_re'] ?>" value="0">

                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalLabel<?= $soli['id_re'] ?>">Responder Solicitud</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>

                                <div class="modal-body">
                                    <!-- Toggle: Comentar (ACTIVADO por defecto) -->
                                    <div class="form-check form-switch mb-3">
                                        <input class="form-check-input" type="checkbox" role="switch"
                                            id="toggleComent<?= $soli['id_re'] ?>" checked>
                                        <label class="form-check-label" for="toggleComent<?= $soli['id_re'] ?>">
                                            Quiero agregar un comentario y notificar al cliente
                                        </label>
                                    </div>

                                    <!-- Aviso cuando no comenta -->
                                    <div id="avisoSinComent<?= $soli['id_re'] ?>"
                                        class="alert alert-info py-2 px-3 mb-3" style="display:none;">
                                        No se enviará ninguna notificación (medio: <strong>Ninguno</strong>).
                                    </div>

                                    <!-- Comentario -->
                                    <div class="mb-3 comentario-container" id="comentarioContainer<?= $soli['id_re'] ?>">
                                        <div class="form-floating">
                                            <textarea class="form-control" placeholder="Escriba un mensaje para el usuario..."
                                                id="comentario<?= $soli['id_re'] ?>" name="comentario" style="height: 120px;"></textarea>
                                            <label for="comentario<?= $soli['id_re'] ?>">Motivo de la decisión</label>
                                        </div>
                                    </div>

                                    <!-- Acción -->
                                    <div class="mb-3">
                                        <label class="form-label">Acción</label>
                                        <div class="btn-group w-100" role="group">
                                            <input type="radio" class="btn-check" name="estado" value="aceptada"
                                                id="acepta<?= $soli['id_re'] ?>" required>
                                            <label class="btn btn-outline-success" for="acepta<?= $soli['id_re'] ?>">
                                                <i class="fas fa-check"></i> Aceptar
                                            </label>

                                            <input type="radio" class="btn-check" name="estado" value="rechazada"
                                                id="rechaza<?= $soli['id_re'] ?>">
                                            <label class="btn btn-outline-danger" for="rechaza<?= $soli['id_re'] ?>">
                                                <i class="fas fa-times"></i> Rechazar
                                            </label>
                                        </div>
                                    </div>

                                    <!-- Medio de notificación -->
                                    <div class="mb-3">
                                        <label class="form-label">Notificar al Cliente Mediante</label>
                                        <div class="btn-group w-100" role="group">
                                            <input type="radio" class="btn-check medio-r" name="medio" id="correo<?= $soli['id_re'] ?>"
                                                value="correo" required>
                                            <label class="btn btn-outline-primary" for="correo<?= $soli['id_re'] ?>">
                                                <i class="fas fa-envelope"></i> Correo
                                            </label>

                                            <input type="radio" class="btn-check medio-r" name="medio" id="whatsapp<?= $soli['id_re'] ?>"
                                                value="whatsapp">
                                            <label class="btn btn-outline-success" for="whatsapp<?= $soli['id_re'] ?>">
                                                <i class="fab fa-whatsapp"></i> WhatsApp
                                            </label>

                                            <input type="radio" class="btn-check medio-r" name="medio" id="ninguno<?= $soli['id_re'] ?>"
                                                value="ninguno">
                                            <label class="btn btn-outline-secondary" for="ninguno<?= $soli['id_re'] ?>">
                                                <i class="fas fa-ban"></i> Ninguno
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary w-100">Enviar Respuesta</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<script>
    const input = document.getElementById('inputBusqueda');
    const limpiarBtn = document.getElementById('limpiarBusqueda');
    const form = document.getElementById('form-busqueda-live');
    const contenedor = document.getElementById('contenedorSolicitudes');

    input.addEventListener('input', () => {
        const valor = input.value.trim();
        limpiarBtn.style.display = valor.length > 0 ? 'inline-block' : 'none';

        const params = new URLSearchParams(new FormData(form));
        fetch('routes/busquedaLiveCards.php', {
                method: 'POST',
                body: params
            })
            .then(res => res.text())
            .then(html => {
                contenedor.innerHTML = html;
            });
    });

    limpiarBtn.addEventListener('click', () => {
        input.value = '';
        limpiarBtn.style.display = 'none';
        input.focus();

        const params = new URLSearchParams(new FormData(form));
        fetch('routes/busquedaLiveCards.php', {
                method: 'POST',
                body: params
            })
            .then(res => res.text())
            .then(html => {
                contenedor.innerHTML = html;
            });
    });

    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.toggle-comentario').forEach(function(checkbox) {
            const id = checkbox.dataset.id;
            const container = document.getElementById('comentarioContainer' + id);
            const textarea = document.getElementById('comentario' + id);

            function toggleComentario() {
                if (checkbox.checked) {
                    container.style.display = 'block';
                    textarea.disabled = false;
                } else {
                    container.style.display = 'none';
                    textarea.value = '';
                    textarea.disabled = true;
                }
            }

            checkbox.addEventListener('change', toggleComentario);
            toggleComentario(); // Ejecutar al cargar
        });
    });

    (function() {
        function setMediosDisabled(modalRoot, disabled) {
            const radios = modalRoot.querySelectorAll('.medio-r');
            radios.forEach(r => {
                r.disabled = disabled;
                const label = modalRoot.querySelector('label[for="' + r.id + '"]');
                if (label) {
                    if (disabled) {
                        label.classList.add('disabled', 'opacity-50');
                    } else {
                        label.classList.remove('disabled', 'opacity-50');
                    }
                }
            });
        }

        document.querySelectorAll('.modal').forEach(function(modal) {
            modal.addEventListener('shown.bs.modal', function() {
                const form = modal.querySelector('.respuesta-form');
                if (!form) return;

                const id = form.id.replace('formResp', '');
                const toggle = modal.querySelector('#toggleComent' + id);
                const hiddenFlag = modal.querySelector('#sinOpinion' + id);
                const comentarioWrap = modal.querySelector('#comentarioContainer' + id);
                const comentario = modal.querySelector('#comentario' + id);
                const medioCorreo = modal.querySelector('#correo' + id);
                const medioWhats = modal.querySelector('#whatsapp' + id);
                const medioNinguno = modal.querySelector('#ninguno' + id);
                const aviso = modal.querySelector('#avisoSinComent' + id);

                // ===== Estado inicial: switch ACTIVADO (comentar) =====
                toggle.checked = true;
                hiddenFlag.value = '0'; // 0 = con comentario
                comentario.disabled = false;
                comentarioWrap.style.display = ''; // visible
                setMediosDisabled(modal, false); // medios habilitados
                aviso.style.display = 'none';

                // si ningún medio está seleccionado aún, selecciona correo por defecto
                if (!medioCorreo.checked && !medioWhats.checked && !medioNinguno.checked) {
                    medioCorreo.checked = true;
                }

                // ===== Cambio del switch =====
                toggle.onchange = function() {
                    if (toggle.checked) {
                        // Encendido → comentar y elegir medio
                        hiddenFlag.value = '0';
                        comentario.disabled = false;
                        comentarioWrap.style.display = '';
                        setMediosDisabled(modal, false);
                        // si estaba en ninguno, deja al menos uno válido
                        if (medioNinguno.checked) {
                            medioNinguno.checked = false;
                            medioCorreo.checked = true;
                        }
                        aviso.style.display = 'none';
                    } else {
                        // Apagado → no comentar, medio = ninguno
                        hiddenFlag.value = '1';
                        comentario.value = '';
                        comentario.disabled = true;
                        comentarioWrap.style.display = 'none';
                        setMediosDisabled(modal, true);
                        medioNinguno.disabled = false;
                        medioNinguno.checked = true;
                        aviso.style.display = 'block';
                    }
                };

                // ===== Validación en submit =====
                form.onsubmit = function(e) {
                    if (toggle.checked) {
                        // si comenta, comentario obligatorio
                        if (comentario.value.trim() === '') {
                            e.preventDefault();
                            alert('Si activas la opción de comentar, debes escribir un comentario.');
                            return false;
                        }
                        // y un medio distinto a ninguno
                        if (medioNinguno.checked) {
                            e.preventDefault();
                            alert('Selecciona Correo o WhatsApp para notificar, o apaga la opción de comentar.');
                            return false;
                        }
                    } else {
                        // no comenta → limpia comentario y fuerza ninguno
                        comentario.value = '';
                        medioNinguno.checked = true;
                    }
                };
            });
        });
    })();

    // Modal de notificacion

    document.addEventListener('DOMContentLoaded', function() {
        const closeModal = document.getElementById('closeModal');
        const acceptButton = document.getElementById('acceptButton');
        const successModal = document.getElementById('successModal');

        if (closeModal) {
            closeModal.addEventListener('click', function() {
                successModal.classList.remove('active');
            });
        }

        if (acceptButton) {
            acceptButton.addEventListener('click', function() {
                successModal.classList.remove('active');
            });
        }

        if (successModal) {
            successModal.addEventListener('click', function(e) {
                if (e.target === successModal) {
                    successModal.classList.remove('active');
                }
            });
        }

        // Cerrar automáticamente después de 5 segundos
        setTimeout(function() {
            if (successModal && successModal.classList.contains('active')) {
                successModal.classList.remove('active');
            }
        }, 5000);
    });
</script>

<style>
    .btn-group .btn.disabled,
    .btn-group .btn:disabled {
        pointer-events: none;
        opacity: .55;
    }

    .modal .modal-dialog.modal-narrow {
        width: auto !important;
        max-width: 720px !important;
        margin: 1.75rem auto !important;
    }

    @media (min-width: 1400px) {
        .modal .modal-dialog.modal-narrow {
            max-width: 820px !important;
        }
    }

    .modal .modal-dialog.modal-narrow.modal-dialog-scrollable .modal-content {
        max-height: calc(100vh - 3.5rem);
    }

    .modal.modal-fullscreen,
    .modal .modal-dialog.modal-fullscreen {
        max-width: none !important;
    }

    /* Estilos para el modal de éxito */
    .success-modal {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.7);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 10000;
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s ease;
    }

    .success-modal.active {
        opacity: 1;
        visibility: visible;
    }

    .modal-content {
        background: white;
        border-radius: 12px;
        width: 90%;
        max-width: 450px;
        padding: 30px;
        text-align: center;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        position: relative;
        transform: translateY(50px);
        transition: transform 0.4s ease;
    }

    .success-modal.active .modal-content {
        transform: translateY(0);
    }

    .modal-icon {
        width: 80px;
        height: 80px;
        background-color: #215c23ff;
        border-radius: 50%;
        margin: 0 auto 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        animation: pulse 1.5s infinite;
    }

    .modal-icon i {
        font-size: 40px;
        color: white;
    }

    .modal-title {
        font-size: 24px;
        font-weight: 600;
        margin-bottom: 15px;
        color: #2c3e50;
    }

    .modal-message {
        font-size: 16px;
        color: #7f8c8d;
        margin-bottom: 25px;
    }

    .modal-button {
        background-color: #278828ff;
        color: white;
        border: none;
        padding: 12px 30px;
        border-radius: 6px;
        font-size: 16px;
        font-weight: 500;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .modal-button:hover {
        background-color: #337735ff;
    }

    .modal-close {
        position: absolute;
        top: 15px;
        right: 15px;
        background: none;
        border: none;
        font-size: 22px;
        color: #95a5a6;
        cursor: pointer;
        transition: color 0.3s;
    }

    .modal-close:hover {
        color: #2c3e50;
    }

    @keyframes pulse {
        0% {
            box-shadow: 0 0 0 0 rgba(76, 175, 80, 0.4);
        }

        70% {
            box-shadow: 0 0 0 15px rgba(76, 175, 80, 0);
        }

        100% {
            box-shadow: 0 0 0 0 rgba(76, 175, 80, 0);
        }
    }
</style>