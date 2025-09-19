<?php
$modelo = new ServicioElectronicaModel();
$servicios = $modelo->obtenerServicios();
?>

<div class="area-elec" id="electronica-section">
    <h2 class="text-center text-sena-green-500 fw-bold mb-5" data-aos="fade-down" id="electronica-titulo">Servicios de Electrónica Registrados</h2>

    <div class="card shadow-sm border-0 overflow-hidden mb-5" id="card-servicios-registrados">

        <div class="card-header text-center" id="card-header-registrados">
            <h3 class="card-title fw-bold text-light mb-0">
                <i class="fas fa-microchip me-2 text-light"></i>Servicios Registrados
            </h3>
        </div>

        <!-- Tabla -->
        <div class="table-responsive" id="tabla-responsive">
            <table id="tablaElec" class="table table-hover align-middle mb-0">
                <thead class="text-light text-center" id="tabla-header">
                    <tr>
                        <th class="py-3">Ícono</th>
                        <th class="py-3">Título</th>
                        <th class="py-3">Precio</th>
                        <th class="py-3">Descripción corta</th>
                        <th class="py-3">Acciones</th>
                    </tr>
                </thead>
                <tbody id="tabla-body">
                    <?php if (!empty($servicios)): ?>
                        <?php foreach ($servicios as $servicio): ?>
                            <tr class="hover-shadow text-center" data-aos="fade-up" data-aos-delay="200" id="fila-servicio-<?= $servicio['id_ele'] ?>">
                                <td>
                                    <div class="avatar avatar-md rounded-circle border shadow-sm overflow-hidden mx-auto" id="icono-container">
                                        <img src="/sennova/img/<?= htmlspecialchars($servicio['icono_ele']) ?>" alt="Icono"
                                            class="img-fluid rounded-circle" style="width: 45px; height: 45px; object-fit: cover;">
                                    </div>
                                </td>
                                <td class="fw-semibold" id="titulo-servicio"><?= htmlspecialchars($servicio['titulo']) ?></td>
                                <td class="text-success fw-bold" id="precio-servicio">
                                    $<?= number_format($servicio['precio'], 0, ',', '.') ?> COP
                                </td>
                                <td class="text-muted" id="descripcion-corta"><?= htmlspecialchars($servicio['descripcion_corta']) ?></td>
                                <td>
                                    <div class="d-flex justify-content-center gap-2" id="acciones-container">
                                        <button class="btn btn-sm btn-outline-warning rounded-circle p-2"
                                            onclick='editarServicioElec(<?= json_encode($servicio) ?>)'
                                            data-bs-toggle="modal"
                                            data-bs-target="#modalEditarServicioElec"
                                            title="Editar"
                                            id="btn-editar">
                                            <i class="fas fa-pencil-alt"></i>
                                        </button>

                                        <a href="/sennova/routes/DeleteServicio.php?id=<?= $servicio['id_ele'] ?>&tipo=electronica"
                                            class="btn btn-sm btn-outline-danger rounded-circle p-2"
                                            onclick="return confirm('¿Deseas eliminar este servicio?')" title="Eliminar"
                                            id="btn-eliminar">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr id="fila-vacia">
                            <td colspan="5" class="text-center py-5">
                                <div class="d-flex flex-column align-items-center text-muted" id="sin-servicios">
                                    <i class="fas fa-microchip fa-3x mb-3 text-secondary"></i>
                                    <h5 class="fw-semibold">No hay servicios registrados</h5>
                                    <p class="mb-0">Comienza agregando tu primer servicio</p>
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Formulario de registro -->
    <div class="card shadow-sm border-0 overflow-hidden" id="card-registro">
        <div class="card-header border-bottom border-secondary" id="card-header-registro">
            <h3 class="card-title text-white fw-bold mb-0">
                <i class="fas fa-plus-circle me-2"></i>Registrar Nuevo Servicio
            </h3>
        </div>

        <div class="card-body bg-light" id="card-body-registro">
            <form action="/sennova/routes/serviEle.php" method="POST" enctype="multipart/form-data" id="form-electronica">
                <div class="row g-4">
                    <div class="col-md-6" data-aos="fade-right">
                        <label class="form-label fw-semibold text-dark">Título del servicio</label>
                        <input type="text" name="titulo" class="form-control border-dark-subtle" required id="input-titulo">
                    </div>

                    <div class="col-md-3" data-aos="fade-left">
                        <label class="form-label fw-semibold text-dark">Precio (COP)</label>
                        <div class="input-group" id="input-group-precio">
                            <span class="input-group-text text-white border-dark-subtle" id="input-group-dollar">$</span>
                            <input
                                type="text"
                                name="precio_display"
                                class="form-control border-dark-subtle"
                                id="precioInputElec"
                                required
                                placeholder="$ 0,00">
                            <input type="hidden" name="precio" id="precioRealElec">
                        </div>
                    </div>

                    <div class="col-md-3" data-aos="fade-up">
                        <label class="form-label fw-semibold text-dark">Ícono (imagen)</label>
                        <input type="file" name="icono_ele" class="form-control border-dark-subtle"
                            accept=".svg,.png,.jpg,.jpeg" required id="input-icono">
                    </div>

                    <div class="col-12" data-aos="fade-up" data-aos-delay="100">
                        <label class="form-label fw-semibold text-dark">Descripción corta</label>
                        <input type="text" name="descripcion_corta" class="form-control border-dark-subtle" required id="input-desc-corta">
                    </div>

                    <div class="col-12" data-aos="fade-up" data-aos-delay="150">
                        <label class="form-label fw-semibold text-dark">Descripción detallada</label>
                        <textarea name="descripcion_larga" class="form-control border-dark-subtle" rows="4"
                            required id="input-desc-larga"></textarea>
                    </div>
                    <div class="col-12">
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn px-4 py-2 shadow-sm" id="btn-registrar">
                                <i class="fas fa-save me-2"></i>Registrar Servicio
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal de edición -->
    <div class="modal fade" id="modalEditarServicioElec" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm-custom">
            <div class="modal-content border-0 overflow-hidden e-modal-radius" id="modal-editar-container">
                <form id="form-editar-electronica" action="/sennova/routes/serviEle.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id_ele" id="edit-id-ele">
                    <input type="hidden" name="icono_actual" id="edit-icono-elec">

                    <div class="modal-header text-white" id="modal-editar-header">
                        <h5 class="modal-title">
                            <i class="fas fa-edit me-2"></i>Editar Servicio
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body bg-light p-4" id="modal-editar-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="edit-titulo-elec" class="form-label fw-semibold text-dark">Título</label>
                                <input type="text" name="titulo" id="edit-titulo-elec" class="form-control border-dark-subtle" required>
                            </div>

                            <div class="col-md-3">
                                <label class="form-label fw-semibold text-dark">Ícono</label>
                                <input type="file" name="icono_ele" class="form-control border-dark-subtle" accept=".svg,.png,.jpg,.jpeg" id="edit-icono-input">
                            </div>

                            <div class="col-md-3">
                                <label for="edit-precio-elec" class="form-label fw-semibold text-dark">Precio</label>
                                <div class="input-group">
                                    <span class="input-group-text text-white border-dark-subtle" id="edit-input-group-dollar">$</span>
                                    <input type="text" id="edit-precio-elec" name="precio" class="form-control border-dark-subtle" required>
                                </div>
                            </div>

                            <div class="col-12">
                                <label for="edit-descripcion-corta-elec" class="form-label fw-semibold text-dark">Descripción corta</label>
                                <input type="text" name="descripcion_corta" id="edit-descripcion-corta-elec" class="form-control border-dark-subtle" required>
                            </div>

                            <div class="col-12">
                                <label for="edit-descripcion-larga-elec" class="form-label fw-semibold text-dark">Descripción larga</label>
                                <textarea name="descripcion_larga" id="edit-descripcion-larga-elec" rows="4" class="form-control border-dark-subtle" required></textarea>
                            </div>

                            <div class="col-12">
                                <div class="alert alert-light border-dark-subtle mb-0" id="edit-alert-icono">
                                    <small class="text-muted">Tamaño recomendado para íconos: 100x100 px (formato PNG, JPG o SVG)</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer bg-light" id="modal-editar-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" id="btn-cancelar-editar">Cancelar</button>
                        <button type="submit" class="btn text-white" id="btn-guardar-cambios">Guardar cambios</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php if (isset($_GET['area']) && $_GET['area'] === 'electronica'): ?>
    <?php if (isset($_GET['mensaje']) && $_GET['mensaje'] === 'eliminado'): ?>
        <div class="modal fade" id="modalElectronicaExito" tabindex="-1" aria-hidden="true" data-bs-backdrop="true">
            <div class="modal-dialog modal-dialog-centered modal-sm-custom">
                <div class="modal-content border-0 overflow-hidden e-modal-radius" id="modal-exito-container">
                    <div class="modal-body text-center p-0 e-animate-bounce" id="modal-exito-body">
                        <div class="e-success-mark" id="success-mark">
                            <div class="e-check-icon">
                                <span class="e-icon-line e-line-tip"></span>
                                <span class="e-icon-line e-line-long"></span>
                                <div class="e-icon-circle"></div>
                                <div class="e-icon-fix"></div>
                            </div>
                        </div>
                        <div class="px-4 pb-4 pt-2" id="exito-mensaje">
                            <h5 class="text-dark fw-bold mb-2">Operación Exitosa</h5>
                            <p class="text-muted mb-0">Servicio de Electrónica eliminado correctamente</p>
                        </div>
                        <div class="e-progress" style="height: 4px;" id="exito-progress">
                            <div class="e-progress-bar e-progress-animated" role="progressbar" style="width: 100%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php elseif (isset($_GET['mensaje']) && $_GET['mensaje'] === 'error'): ?>
        <div class="modal fade" id="modalElectronicaError" tabindex="-1" aria-hidden="true" data-bs-backdrop="true">
            <div class="modal-dialog modal-dialog-centered modal-sm-custom">
                <div class="modal-content border-0 overflow-hidden e-modal-radius" id="modal-error-container">
                    <div class="modal-body text-center p-0 e-animate-bounce" id="modal-error-body">
                        <div class="e-error-mark" id="error-mark">
                            <div class="e-error-icon">
                                <span class="e-icon-line e-line-left"></span>
                                <span class="e-icon-line e-line-right"></span>
                                <div class="e-icon-circle-error"></div>
                            </div>
                        </div>
                        <div class="px-4 pb-4 pt-2" id="error-mensaje">
                            <h5 class="text-dark fw-bold mb-2">Error en la Operación</h5>
                            <p class="text-muted mb-0">Hubo un error al eliminar el servicio.</p>
                        </div>
                        <div class="e-progress" style="height: 4px;" id="error-progress">
                            <div class="e-progress-bar-error e-progress-animated" role="progressbar" style="width: 100%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

<?php endif; ?>

<style>
    /* Estilos personalizados para la sección de electrónica */
    #card-header-registrados,
    #card-header-registro,
    #modal-editar-header {
        background: linear-gradient(90deg, #2c3e50 0%, #1a1a2e 100%);
        border: none;
    }

    #tabla-header {
        background: linear-gradient(90deg, #2c3e50 0%, #1a1a2e 100%);
    }

    #btn-registrar,
    #btn-guardar-cambios {
        background: linear-gradient(90deg, #2c3e50 0%, #1a1a2e 100%);
        border: none;
        transition: all 0.3s ease;
    }

    #btn-registrar:hover,
    #btn-guardar-cambios:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    #input-group-dollar,
    #edit-input-group-dollar {
        background: linear-gradient(90deg, #2c3e50 0%, #1a1a2e 100%);
        border: 1px solid #dee2e6;
    }

    #fila-servicio-<?= $servicio['id_ele'] ?>:hover {
        background-color: rgba(44, 62, 80, 0.05);
        transition: background-color 0.3s ease;
    }

    #icono-container {
        transition: transform 0.3s ease;
    }

    #icono-container:hover {
        transform: scale(1.1);
    }

    #btn-editar,
    #btn-eliminar {
        transition: all 0.3s ease;
    }

    #btn-editar:hover {
        background-color: #ffc107;
        color: #000;
    }

    #btn-eliminar:hover {
        background-color: #dc3545;
        color: #fff;
    }

    #card-servicios-registrados,
    #card-registro {
        border-radius: 12px;
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    #card-servicios-registrados:hover,
    #card-registro:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1) !important;
    }

    #modal-editar-container {
        box-shadow: 0 5px 25px rgba(0, 0, 0, 0.2);
    }

    #modal-exito-container,
    #modal-error-container {
        box-shadow: 0 5px 25px rgba(0, 0, 0, 0.2);
        border: none;
    }

    #success-mark,
    #error-mark {
        padding: 30px 0;
    }

    .e-check-icon,
    .e-error-icon {
        position: relative;
        display: inline-block;
        width: 80px;
        height: 80px;
    }

    .e-icon-line {
        position: absolute;
        background-color: #28a745;
        display: block;
        border-radius: 2px;
    }

    .e-line-tip {
        width: 25px;
        height: 5px;
        top: 46px;
        left: 14px;
        transform: rotate(45deg);
    }

    .e-line-long {
        width: 47px;
        height: 5px;
        top: 38px;
        right: 8px;
        transform: rotate(-45deg);
    }

    .e-icon-circle {
        position: absolute;
        left: 0;
        top: 0;
        width: 80px;
        height: 80px;
        border-radius: 50%;
        border: 4px solid #28a745;
        box-sizing: border-box;
    }

    .e-icon-fix {
        position: absolute;
        top: 0;
        left: 26px;
        width: 5px;
        height: 85px;
        background-color: #fff;
        transform: rotate(-45deg);
    }

    .e-error-icon .e-icon-line {
        background-color: #dc3545;
    }

    .e-line-left {
        width: 50px;
        height: 5px;
        top: 37px;
        left: 16px;
        transform: rotate(45deg);
    }

    .e-line-right {
        width: 50px;
        height: 5px;
        top: 37px;
        right: 16px;
        transform: rotate(-45deg);
    }

    .e-icon-circle-error {
        position: absolute;
        left: 0;
        top: 0;
        width: 80px;
        height: 80px;
        border-radius: 50%;
        border: 4px solid #dc3545;
        box-sizing: border-box;
    }

    .e-progress-bar {
        background: linear-gradient(90deg, #28a745 0%, #20c997 100%);
    }

    .e-progress-bar-error {
        background: linear-gradient(90deg, #dc3545 0%, #fd7e14 100%);
    }

    .e-animate-bounce {
        animation: bounceIn 0.6s ease;
    }

    @keyframes bounceIn {
        0% {
            transform: scale(0.8);
            opacity: 0;
        }

        60% {
            transform: scale(1.05);
            opacity: 1;
        }

        100% {
            transform: scale(1);
        }
    }
</style>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const modalId = <?php echo isset($_GET['mensaje']) && $_GET['mensaje'] === 'eliminado' ? "'modalElectronicaExito'" : "'modalElectronicaError'"; ?>;
        const modal = new bootstrap.Modal(document.getElementById(modalId));
        modal.show();

        setTimeout(() => {
            const modalElement = document.getElementById(modalId);
            const modalContent = modalElement.querySelector('.modal-body');
            modalContent.classList.remove('e-animate-bounce');
            modalContent.classList.add('e-animate-fade');

            setTimeout(() => {
                modal.hide();
                modalContent.classList.remove('e-animate-fade');
                modalContent.classList.add('e-animate-bounce');
            }, 400);
        }, 1500);

        // Limpiar parámetros de URL
        const url = new URL(window.location.href);
        url.searchParams.delete('mensaje');
        window.history.replaceState({}, document.title, url.toString());
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Input principal y campo oculto para enviar solo el número limpio
        const precioInput = document.getElementById('precioInputElec');
        const precioReal = document.getElementById('precioRealElec');

        // Formatear al escribir
        if (precioInput) {
            precioInput.addEventListener('input', function() {
                // Guardar posición del cursor
                const cursorPosition = this.selectionStart;

                // Obtener solo dígitos
                let cleanValue = this.value.replace(/\D/g, '');

                // Guardar valor limpio en campo oculto
                precioReal.value = cleanValue;

                if (cleanValue) {
                    // Convertir a formato de miles (sin decimales)
                    this.value = parseInt(cleanValue).toLocaleString('es-CO');

                    // Ajustar posición del cursor
                    const newCursorPos = cursorPosition + (this.value.length - cleanValue.length);
                    this.setSelectionRange(newCursorPos, newCursorPos);
                } else {
                    this.value = '';
                }
            });

            // Evitar caracteres no numéricos
            precioInput.addEventListener('keydown', function(e) {
                if (e.key === 'e' || e.key === '+' || e.key === '-' || e.key === '.' || e.key === ',') {
                    e.preventDefault();
                }
            });
        }

        // Manejar el envío del formulario principal
        const formPrincipal = document.querySelector('#form-electronica');
        if (formPrincipal) {
            formPrincipal.addEventListener('submit', function() {
                if (!precioReal.value && precioInput.value) {
                    precioReal.value = precioInput.value.replace(/\D/g, '');
                }
            });
        }

        // Para el modal de edición
        const editPrecioInput = document.getElementById('edit-precio-elec');

        if (editPrecioInput) {
            editPrecioInput.addEventListener('input', function() {
                let valor = this.value.replace(/\D/g, '');
                this.value = valor ? parseInt(valor).toLocaleString('es-CO') : '';
            });

            const formEditar = document.getElementById('form-editar-electronica');
            if (formEditar) {
                formEditar.addEventListener('submit', function() {
                    const valor = editPrecioInput.value.replace(/\D/g, '');
                    editPrecioInput.value = valor;
                });
            }

            // Función para abrir el modal con datos
            window.editarServicioElec = function(servis) {
                document.getElementById('edit-id-ele').value = servis.id_ele;
                document.getElementById('edit-titulo-elec').value = servis.titulo;
                document.getElementById('edit-descripcion-corta-elec').value = servis.descripcion_corta;
                document.getElementById('edit-descripcion-larga-elec').value = servis.descripcion_larga;
                document.getElementById('edit-icono-elec').value = servis.icono_ele;

                if (servis.precio) {
                    document.getElementById('edit-precio-elec').value = parseInt(servis.precio).toLocaleString('es-CO');
                } else {
                    document.getElementById('edit-precio-elec').value = '';
                }

                const modal = new bootstrap.Modal(document.getElementById('modalEditarServicioElec'));
                modal.show();
            };
        }

        // Limpieza de backdrops sobrantes al cerrar cualquier modal
        document.addEventListener('hidden.bs.modal', function() {
            document.querySelectorAll('.modal-backdrop').forEach(el => el.remove());
            document.body.classList.remove('modal-open');
            document.body.style = '';
        });
    });
</script>