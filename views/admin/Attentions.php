<?php
$rol        = $_SESSION['rol']  ?? null;
$areaSesion = $_SESSION['area'] ?? null;
$esVisualizadorElectronica = ($rol === 2 && $areaSesion === 'visualizador');
$areaEfectiva = $esVisualizadorElectronica ? 'electronica' : $areaSesion;
$esAdmin = empty($areaEfectiva);
$estado   = $_GET['estado']   ?? 'todas';
$busqueda = $_GET['busqueda'] ?? '';
$area = $esAdmin ? ($_GET['area'] ?? '') : $areaEfectiva;
$areaParam = $esAdmin && $area !== '' ? '&area=' . urlencode($area) : '';
$controller = new SolicitudController();

if ($esAdmin) {
    if (!empty($area)) {
        $solicitudes = $controller->obtenerSolicitudesPorArea($estado, $area, $busqueda);
    } else {
        $solicitudes = $controller->obtenerSolicitudesTodas($estado, $busqueda);
    }
} else {
    $solicitudes = $controller->obtenerSolicitudesPorArea($estado, $area, $busqueda);
}
?>

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

    <form method="GET" action="inAdmin.php?vista=atencion" id="form-busqueda-live" class="mb-4 position-relative">
        <input type="hidden" name="vista" value="atencion">
        <input type="hidden" name="estado" value="<?= htmlspecialchars($estado) ?>">

        <div class="input-group shadow-sm position-relative">
            <input type="text" name="busqueda" id="inputBusqueda"
                class="form-control form-control-lg pe-5"
                placeholder="Buscar por nombre, empresa o email"
                value="<?= isset($_GET['busqueda']) ? htmlspecialchars($_GET['busqueda']) : '' ?>"
                autocomplete="off">

            <button type="button" id="limpiarBusqueda"
                class="btn btn-sm btn-light border position-absolute"
                style="top: 50%; right: 80px; transform: translateY(-50%); display: none;"
                title="Limpiar búsqueda">
                <i class="fas fa-times text-muted"></i>
            </button>

            <button type="submit" class="btn btn-primary btn-lg">
                <i class="fas fa-search me-1"></i> Buscar
            </button>
        </div>
    </form>

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
                    color: white;
                }
            </style>
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
                            <div class="position-absolute top-0 end-0 m-2 d-flex gap-1">
                                <form method="post" action="routes/destacarServi.php" class="d-inline">
                                    <input type="hidden" name="id_re" value="<?= $soli['id_re'] ?>">
                                    <button type="submit"
                                        class="btn btn-<?= $soli['destacado_re'] ? 'secondary' : 'warning' ?> btn-sm"
                                        title="<?= $soli['destacado_re'] ? 'Quitar destacado' : 'Destacar solicitud' ?>">
                                        <i class="fas fa-star<?= $soli['destacado_re'] ? '' : '-half-alt' ?>"></i>
                                    </button>
                                </form>

                                <form method="post" action="routes/DeleteServi.php"
                                    onsubmit="return confirm('¿Estás seguro de eliminar esta solicitud?')" class="d-inline">
                                    <input type="hidden" name="id_re" value="<?= $soli['id_re'] ?>">
                                    <button type="submit" class="btn btn-outline-danger btn-sm" title="Eliminar solicitud">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>

                            <h5 class="card-title fw-bold text-primary-emphasis mt-4"><?= htmlspecialchars($soli['nombre']) ?></h5>
                            <p class="mb-1"><strong>Cédula:</strong> <?= htmlspecialchars($soli['cc_cliente']) ?></p>
                            <p class="mb-1"><strong>Servicio:</strong> <?= htmlspecialchars($soli['servicio']) ?></p>
                            <p class="mb-1"><strong>Empresa:</strong> <?= htmlspecialchars($soli['empresa']) ?></p>
                            <p class="mb-1"><strong>Teléfono:</strong> <?= htmlspecialchars($soli['telefono']) ?></p>
                            <p class="mb-1"><strong>Email:</strong> <?= htmlspecialchars($soli['email']) ?></p>
                            <p><strong>Descripción:</strong><br><?= nl2br(htmlspecialchars($soli['descripcion'])) ?></p>

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

                <div class="modal fade" id="respuestaModal<?= $soli['id_re'] ?>" tabindex="-1"
                    aria-labelledby="modalLabel<?= $soli['id_re'] ?>" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-narrow">
                        <div class="modal-content">
                            <form action="routes/Atendido.php" method="POST"
                                class="respuesta-form" id="formResp<?= $soli['id_re'] ?>">
                                <input type="hidden" name="id_soli" value="<?= $soli['id_re'] ?>">
                                <input type="hidden" name="sin_opinion" id="sinOpinion<?= $soli['id_re'] ?>" value="0">

                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalLabel<?= $soli['id_re'] ?>">Responder Solicitud</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>

                                <div class="modal-body">
                                    <div class="form-check form-switch mb-3">
                                        <input class="form-check-input" type="checkbox" role="switch"
                                            id="toggleComent<?= $soli['id_re'] ?>" checked>
                                        <label class="form-check-label" for="toggleComent<?= $soli['id_re'] ?>">
                                            Quiero agregar un comentario y notificar al cliente
                                        </label>
                                    </div>

                                    <div id="avisoSinComent<?= $soli['id_re'] ?>"
                                        class="alert alert-info py-2 px-3 mb-3" style="display:none;">
                                        No se enviará ninguna notificación (medio: <strong>Ninguno</strong>).
                                    </div>

                                    <div class="mb-3 comentario-container" id="comentarioContainer<?= $soli['id_re'] ?>">
                                        <div class="form-floating">
                                            <textarea class="form-control" placeholder="Escriba un mensaje para el usuario..."
                                                id="comentario<?= $soli['id_re'] ?>" name="comentario" style="height: 120px;"></textarea>
                                            <label for="comentario<?= $soli['id_re'] ?>">Motivo de la decisión</label>
                                        </div>
                                    </div>

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
    #respuestaModal<?= $soli['id_re'] ?>.modal-content {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        border-radius: 15px;
        border: none;
        box-shadow: 0 10px 30px rgba(0, 0, 0, .15);
    }

    #respuestaModal<?= $soli['id_re'] ?>.modal-header {
        background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
        color: #fff;
        border-radius: 15px 15px 0 0;
        padding: 15px 20px;
        border-bottom: none;
    }

    #respuestaModal<?= $soli['id_re'] ?>.modal-title {
        font-weight: 600;
        font-size: 1.3rem;
    }

    #respuestaModal<?= $soli['id_re'] ?>.btn-close {
        filter: invert(1);
        opacity: .85;
    }

    #respuestaModal<?= $soli['id_re'] ?>.btn-close:hover {
        opacity: 1;
    }

    #respuestaModal<?= $soli['id_re'] ?>.modal-body {
        padding: 25px;
    }

    #respuestaModal<?= $soli['id_re'] ?>.form-check.form-switch {
        margin-bottom: 20px;
    }

    #respuestaModal<?= $soli['id_re'] ?>.form-check-input {
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
        width: 44px;
        height: 26px;
        border-radius: 26px;
        background-color: #e9ecef;
        border: 1px solid #ced4da;
        position: relative;
        cursor: pointer;
        outline: none;
        transition: background-color .2s, border-color .2s, box-shadow .2s;
    }

    #respuestaModal<?= $soli['id_re'] ?>.form-check-input::before {
        content: "";
        position: absolute;
        top: 2px;
        left: 2px;
        width: 22px;
        height: 22px;
        border-radius: 50%;
        background: #fff;
        box-shadow: 0 1px 2px rgba(0, 0, 0, .2);
        transition: transform .2s;
    }

    #respuestaModal<?= $soli['id_re'] ?>.form-check-input:focus {
        box-shadow: 0 0 0 .2rem rgba(37, 117, 252, .25);
    }

    #respuestaModal<?= $soli['id_re'] ?>.form-check-input:checked {
        background-color: #2575fc;
        border-color: #2575fc;
    }

    #respuestaModal<?= $soli['id_re'] ?>.form-check-input:checked::before {
        transform: translateX(18px);
    }

    #respuestaModal<?= $soli['id_re'] ?>.alert-info {
        background-color: rgba(37, 117, 252, .10);
        border-color: rgba(37, 117, 252, .20);
        color: #1a56db;
    }

    #respuestaModal<?= $soli['id_re'] ?>.form-floating textarea {
        border-radius: 10px;
        border: 1px solid #dee2e6;
        transition: all .3s;
    }

    #respuestaModal<?= $soli['id_re'] ?>.form-floating textarea:focus {
        border-color: #2575fc;
        box-shadow: 0 0 0 .2rem rgba(37, 117, 252, .25);
    }

    #respuestaModal<?= $soli['id_re'] ?>.form-label {
        font-weight: 600;
        color: #495057;
        margin-bottom: 10px;
    }

    #respuestaModal<?= $soli['id_re'] ?>.btn-group {
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 2px 5px rgba(0, 0, 0, .1);
    }

    #respuestaModal<?= $soli['id_re'] ?>.btn-group .btn {
        border: 1px solid #dee2e6;
        padding: 10px 15px;
        transition: all .3s;
    }

    #respuestaModal<?= $soli['id_re'] ?>.btn-group .btn-check:checked+.btn-outline-success,
    #respuestaModal<?= $soli['id_re'] ?>.btn-group .btn-outline-success:hover {
        background: #198754;
        color: #fff;
        border-color: #198754;
    }

    #respuestaModal<?= $soli['id_re'] ?>.btn-group .btn-check:checked+.btn-outline-danger,
    #respuestaModal<?= $soli['id_re'] ?>.btn-group .btn-outline-danger:hover {
        background: #dc3545;
        color: #fff;
        border-color: #dc3545;
    }

    #respuestaModal<?= $soli['id_re'] ?>.btn-group .btn-check:checked+.btn-outline-primary,
    #respuestaModal<?= $soli['id_re'] ?>.btn-group .btn-outline-primary:hover {
        background: #2575fc;
        color: #fff;
        border-color: #2575fc;
    }

    #respuestaModal<?= $soli['id_re'] ?>.btn-group .btn-check:checked+.btn-outline-secondary,
    #respuestaModal<?= $soli['id_re'] ?>.btn-group .btn-outline-secondary:hover {
        background: #6c757d;
        color: #fff;
        border-color: #6c757d;
    }

    #respuestaModal<?= $soli['id_re'] ?>.modal-footer {
        border-top: 1px solid #e9ecef;
        padding: 20px 25px;
        background: #f8f9fa;
        border-radius: 0 0 15px 15px;
    }

    #respuestaModal<?= $soli['id_re'] ?>.modal-footer .btn-primary {
        background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
        border: none;
        border-radius: 10px;
        padding: 12px;
        font-weight: 600;
        transition: transform .2s, box-shadow .2s;
        box-shadow: 0 4px 15px rgba(37, 117, 252, .3);
    }

    #respuestaModal<?= $soli['id_re'] ?>.modal-footer .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(37, 117, 252, .4);
    }
</style>