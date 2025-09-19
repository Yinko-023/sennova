<?php
$modelo = new ServicioCafeModel();
$servi = $modelo->obtenerServi();
?>
<div class="area-cafe" id="cafe-section">
    <h2 class="text-center text-sena-green-500 fw-bold mb-5" data-aos="fade-down" id="cafe-titulo">Servicios de Café Y Cacao Registrados</h2>

    <div class="card shadow-sm border-0 overflow-hidden mb-5" id="card-servicios-cafe">

        <div class="card-header border-bottom border-secondary text-center" id="card-header-cafe">
            <h3 class="card-title fw-bold text-light mb-0">
                <i class="fas fa-coffee me-2 text-warning"></i>Servicios Registrados
            </h3>
        </div>

        <!-- Tabla -->
        <div class="table-responsive" id="tabla-responsive-cafe">
            <table id="tablaCafe" class="table table-hover align-middle mb-0">
                <thead class="text-light text-center" id="tabla-header-cafe">
                    <tr>
                        <th class="py-3">Ícono</th>
                        <th class="py-3">Título</th>
                        <th class="py-3">Precio</th>
                        <th class="py-3">Descripción corta</th>
                        <th class="py-3">Acciones</th>
                    </tr>
                </thead>
                <tbody id="tabla-body-cafe">
                    <?php if (!empty($servi)): ?>
                        <?php foreach ($servi as $servis): ?>
                            <tr class="hover-shadow text-center" data-aos="fade-up" data-aos-delay="100" id="fila-servicio-cafe-<?= $servis['id_ca'] ?>">
                                <td>
                                    <div class="avatar avatar-md rounded-circle border shadow-sm overflow-hidden mx-auto" id="icono-container-cafe">
                                        <img src="/sennova/img/<?= htmlspecialchars($servis['icono_ca']) ?>" alt="Icono servicio"
                                            class="img-fluid rounded-circle" style="width: 45px; height: 45px; object-fit: cover;">
                                    </div>
                                </td>
                                <td class="fw-semibold" id="titulo-servicio-cafe"><?= htmlspecialchars($servis['titulo_ca']) ?></td>
                                <td class="text-success fw-bold" id="precio-servicio-cafe">
                                    $<?= number_format($servis['precio_ca'], 0, ',', '.') ?> COP
                                </td>
                                <td class="text-muted" id="descripcion-corta-cafe"><?= htmlspecialchars($servis['des_corta']) ?></td>
                                <td>
                                    <div class="d-flex justify-content-center gap-2" id="acciones-container-cafe">
                                        <button class="btn btn-sm btn-outline-warning rounded-circle p-2"
                                            onclick='editarServicioCafe(<?= json_encode($servis) ?>)'
                                            data-bs-toggle="modal"
                                            data-bs-target="#modalEditarServicioCafe"
                                            title="Editar"
                                            id="btn-editar-cafe">
                                            <i class="fas fa-pencil-alt"></i>
                                        </button>

                                        <a href="/sennova/routes/DeleteServicio.php?id=<?= $servis['id_ca'] ?>&tipo=cafe"
                                            class="btn btn-sm btn-outline-danger rounded-circle p-2"
                                            onclick="return confirm('¿Deseas eliminar este servicio?')" title="Eliminar"
                                            id="btn-eliminar-cafe">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr id="fila-vacia-cafe">
                            <td colspan="5" class="text-center py-5">
                                <div class="d-flex flex-column align-items-center text-muted" id="sin-servicios-cafe">
                                    <i class="fas fa-coffee fa-3x mb-3 text-secondary"></i>
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
    <div class="card shadow-sm border-0 overflow-hidden" id="card-registro-cafe">
        <div class="card-header border-bottom border-secondary" id="card-header-registro-cafe">
            <h3 class="card-title text-white fw-bold mb-0">
                <i class="fas fa-plus-circle me-2"></i>Registrar Nuevo Servicio
            </h3>
        </div>
        <div class="card-body bg-light" id="card-body-registro-cafe">
            <form action="/sennova/routes/serviCafe.php" method="POST" enctype="multipart/form-data" id="form-cafe">
                <div class="row g-4">
                    <div class="col-md-6" data-aos="fade-right">
                        <label class="form-label fw-semibold text-dark">Título del servicio</label>
                        <input type="text" name="titulo_ca" class="form-control border-dark-subtle" required id="input-titulo-cafe">
                    </div>

                    <div class="col-md-3">
                        <label class="form-label fw-semibold text-dark">Precio (COP)</label>
                        <div class="input-group" id="input-group-precio-cafe">
                            <span class="input-group-text text-white border-dark-subtle" id="input-group-dollar-cafe">$</span>
                            <input
                                type="text"
                                name="precio_display"
                                class="form-control border-dark-subtle"
                                id="precioInput2"
                                required
                                placeholder="$ 0,00">
                            <input type="hidden" name="precio_ca" id="precioReal">
                        </div>
                    </div>

                    <div class="col-md-3" data-aos="fade-left">
                        <label class="form-label fw-semibold text-dark">Ícono (imagen)</label>
                        <input type="file" name="icono_ca" class="form-control border-dark-subtle"
                            accept=".svg,.png,.jpg,.jpeg" required id="input-icono-cafe">
                    </div>

                    <div class="col-12" data-aos="fade-up" data-aos-delay="100">
                        <label class="form-label fw-semibold text-dark">Descripción corta</label>
                        <input type="text" name="des_corta" class="form-control border-dark-subtle" required id="input-desc-corta-cafe">
                    </div>

                    <div class="col-12" data-aos="fade-up" data-aos-delay="150">
                        <label class="form-label fw-semibold text-dark">Descripción detallada</label>
                        <textarea name="des_larga" class="form-control border-dark-subtle" rows="4" required id="input-desc-larga-cafe"></textarea>
                    </div>

                    <div class="col-12">
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn px-4 py-2 shadow-sm" id="btn-registrar-cafe">
                                <i class="fas fa-save me-2"></i>Registrar Servicio
                            </button>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>

    <!-- Modal de edición -->
    <div class="modal fade" id="modalEditarServicioCafe" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border-0" id="modal-editar-container-cafe">
                <form id="form-editar-cafe" action="/sennova/routes/serviCafe.php" method="POST" enctype="multipart/form-data">

                    <div class="modal-header text-white" id="modal-editar-header-cafe">
                        <h5 class="modal-title">
                            <i class="fas fa-edit me-2"></i>Editar Servicio
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>

                    <div class="modal-body bg-light p-4" id="modal-editar-body-cafe">
                        <!-- Acción e ID ocultos -->
                        <input type="hidden" name="accion" value="editar">
                        <input type="hidden" name="id_ca" id="edit-id-ca">
                        <input type="hidden" name="icono_actual" id="edit-icono-ca">

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold text-dark">Título</label>
                                <input type="text" name="titulo_ca" id="edit-titulo-ca" class="form-control border-dark-subtle" required>
                            </div>

                            <div class="col-md-3">
                                <label class="form-label fw-semibold text-dark">Ícono</label>
                                <input type="file" name="icono_ca" class="form-control border-dark-subtle" accept=".svg,.png,.jpg,.jpeg" id="edit-icono-input-cafe">
                            </div>

                            <div class="col-md-3">
                                <label class="form-label fw-semibold text-dark">Precio</label>
                                <div class="input-group">
                                    <span class="input-group-text text-white border-dark-subtle" id="edit-input-group-dollar-cafe">$</span>
                                    <input type="text" id="edit-precio-ca" name="precio_ca" class="form-control border-dark-subtle" required>
                                </div>
                            </div>

                            <div class="col-12">
                                <label class="form-label fw-semibold text-dark">Descripción corta</label>
                                <input type="text" name="des_corta" id="edit-des-corta-ca" class="form-control border-dark-subtle" required>
                            </div>

                            <div class="col-12">
                                <label class="form-label fw-semibold text-dark">Descripción larga</label>
                                <textarea name="des_larga" id="edit-des-larga-ca" rows="4" class="form-control border-dark-subtle" required></textarea>
                            </div>

                            <div class="col-12">
                                <div class="alert alert-light border-dark-subtle" id="edit-alert-icono-cafe">
                                    <small class="text-muted">Tamaño recomendado para íconos: 100x100 px (PNG, JPG o SVG)</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer bg-light" id="modal-editar-footer-cafe">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" id="btn-cancelar-editar-cafe">Cancelar</button>
                        <button type="submit" class="btn text-white" id="btn-guardar-cambios-cafe">Guardar cambios</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php if (isset($_GET['area']) && $_GET['area'] === 'cafe'): ?>
    <?php if (isset($_GET['mensaje']) && $_GET['mensaje'] === 'eliminado'): ?>
        <div class="modal fade" id="modalCafeExito" tabindex="-1" aria-hidden="true" data-bs-backdrop="true">
            <div class="modal-dialog modal-dialog-centered modal-sm-custom">
                <div class="modal-content border-0 overflow-hidden e-modal-radius" id="modal-exito-container-cafe">
                    <div class="modal-body text-center p-0 e-animate-bounce" id="modal-exito-body-cafe">
                        <div class="e-success-mark" id="success-mark-cafe">
                            <div class="e-check-icon">
                                <span class="e-icon-line e-line-tip"></span>
                                <span class="e-icon-line e-line-long"></span>
                                <div class="e-icon-circle"></div>
                                <div class="e-icon-fix"></div>
                            </div>
                        </div>
                        <div class="px-4 pb-4 pt-2" id="exito-mensaje-cafe">
                            <h5 class="text-dark fw-bold mb-2">Operación Exitosa</h5>
                            <p class="text-muted mb-0">Servicio de Café y Cacao eliminado correctamente</p>
                        </div>
                        <div class="e-progress" style="height: 4px;" id="exito-progress-cafe">
                            <div class="e-progress-bar e-progress-animated" role="progressbar" style="width: 100%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php elseif (isset($_GET['mensaje']) && $_GET['mensaje'] === 'error'): ?>
        <div class="modal fade" id="modalCafeError" tabindex="-1" aria-hidden="true" data-bs-backdrop="true">
            <div class="modal-dialog modal-dialog-centered modal-sm-custom">
                <div class="modal-content border-0 overflow-hidden e-modal-radius" id="modal-error-container-cafe">
                    <div class="modal-body text-center p-0 e-animate-bounce" id="modal-error-body-cafe">
                        <div class="e-error-mark" id="error-mark-cafe">
                            <div class="e-error-icon">
                                <span class="e-icon-line e-line-left"></span>
                                <span class="e-icon-line e-line-right"></span>
                                <div class="e-icon-circle-error"></div>
                            </div>
                        </div>
                        <div class="px-4 pb-4 pt-2" id="error-mensaje-cafe">
                            <h5 class="text-dark fw-bold mb-2">Error en la Operación</h5>
                            <p class="text-muted mb-0">Hubo un error al eliminar el servicio.</p>
                        </div>
                        <div class="e-progress" style="height: 4px;" id="error-progress-cafe">
                            <div class="e-progress-bar-error e-progress-animated" role="progressbar" style="width: 100%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
<?php endif; ?>

<style>
    /* Estilos personalizados para la sección de café y cacao */
    #card-header-cafe, 
    #card-header-registro-cafe, 
    #modal-editar-header-cafe {
        background: linear-gradient(90deg, #2c3e50 0%, #1a1a2e 100%);
        border: none;
    }
    
    #tabla-header-cafe {
        background: linear-gradient(90deg, #2c3e50 0%, #1a1a2e 100%);
    }
    
    #btn-registrar-cafe, 
    #btn-guardar-cambios-cafe {
        background: linear-gradient(90deg, #2c3e50 0%, #1a1a2e 100%);
        border: none;
        transition: all 0.3s ease;
    }
    
    #btn-registrar-cafe:hover, 
    #btn-guardar-cambios-cafe:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.2);
    }
    
    #input-group-dollar-cafe, 
    #edit-input-group-dollar-cafe {
        background: linear-gradient(90deg, #2c3e50 0%, #1a1a2e 100%);
        border: 1px solid #dee2e6;
    }
    
    #fila-servicio-cafe-<?= $servis['id_ca'] ?>:hover {
        background-color: rgba(44, 62, 80, 0.05);
        transition: background-color 0.3s ease;
    }
    
    #icono-container-cafe {
        transition: transform 0.3s ease;
    }
    
    #icono-container-cafe:hover {
        transform: scale(1.1);
    }
    
    #btn-editar-cafe, #btn-eliminar-cafe {
        transition: all 0.3s ease;
    }
    
    #btn-editar-cafe:hover {
        background-color: #ffc107;
        color: #000;
    }
    
    #btn-eliminar-cafe:hover {
        background-color: #dc3545;
        color: #fff;
    }
    
    #card-servicios-cafe, 
    #card-registro-cafe {
        border-radius: 12px;
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    #card-servicios-cafe:hover, 
    #card-registro-cafe:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
    }
    
    #modal-editar-container-cafe {
        box-shadow: 0 5px 25px rgba(0,0,0,0.2);
        border-radius: 12px;
    }
    
    #modal-exito-container-cafe, 
    #modal-error-container-cafe {
        box-shadow: 0 5px 25px rgba(0,0,0,0.2);
        border: none;
    }
    
    #success-mark-cafe, #error-mark-cafe {
        padding: 30px 0;
    }
    
    .e-check-icon, .e-error-icon {
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
        0% { transform: scale(0.8); opacity: 0; }
        60% { transform: scale(1.05); opacity: 1; }
        100% { transform: scale(1); }
    }
    
    /* Estilos específicos para la sección de café */
    #cafe-section .fa-coffee {
        color: #ffffffff !important;
    }
    
    #btn-registrar-cafe:hover, 
    #btn-guardar-cambios-cafe:hover {
        background: linear-gradient(90deg, #3a506b 0%, #24243e 100%);
    }
</style>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const modalId = <?php echo isset($_GET['mensaje']) && $_GET['mensaje'] === 'eliminado' ? "'modalCafeExito'" : "'modalCafeError'"; ?>;
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
            const precioInput = document.getElementById('precioInput2');
            const precioReal = document.getElementById('precioReal');

            // Formatear al escribir
            precioInput.addEventListener('input', function() {
                // Obtener solo dígitos
                let cleanValue = this.value.replace(/\D/g, '');

                // Guardar valor limpio en campo oculto
                precioReal.value = cleanValue;

                if (cleanValue) {
                    // Convertir a formato monetario con separador de miles
                    this.value = parseInt(cleanValue).toLocaleString('es-CO');
                } else {
                    this.value = '';
                }
            });

            // Manejar el envío del formulario
            document.querySelector('form').addEventListener('submit', function() {
                // Asegurar que se envía el valor limpio
                if (!precioReal.value && precioInput.value) {
                    precioReal.value = precioInput.value.replace(/\D/g, '');
                }
            });

            // Para el modal de edición
            const editPrecioInput = document.getElementById('edit-precio-ca');

            if (editPrecioInput) {
                editPrecioInput.addEventListener('input', function() {
                    let valor = this.value.replace(/\D/g, '');
                    if (valor) {
                        this.value = parseInt(valor).toLocaleString('es-CO');
                    } else {
                        this.value = '';
                    }
                });

                document.getElementById('form-editar-cafe').addEventListener('submit', function() {
                    const valor = editPrecioInput.value.replace(/\D/g, '');
                    editPrecioInput.value = valor; // Enviamos solo el valor entero
                });

                window.editarServicioCafe = function(servis) {
                    document.getElementById('edit-id-ca').value = servis.id_ca;
                    document.getElementById('edit-titulo-ca').value = servis.titulo_ca;
                    document.getElementById('edit-des-corta-ca').value = servis.des_corta;
                    document.getElementById('edit-des-larga-ca').value = servis.des_larga;
                    document.getElementById('edit-icono-ca').value = servis.icono_ca;

                    if (servis.precio_ca) {
                        document.getElementById('edit-precio-ca').value = parseInt(servis.precio_ca).toLocaleString('es-CO');
                    } else {
                        document.getElementById('edit-precio-ca').value = '';
                    }

                    const modal = new bootstrap.Modal(document.getElementById('modalEditarServicioCafe'));
                    modal.show();
                };
            }
        });
    </script>

    <script>
        const precioInput = document.getElementById('precioInput2');

        precioInput.addEventListener('input', function() {
            // Elimina cualquier carácter que no sea dígito
            this.value = this.value.replace(/\D/g, '');
        });

        precioInput.addEventListener('keydown', function(e) {
            // Evita pegar letras o símbolos
            if (e.key === 'e' || e.key === '+' || e.key === '-' || e.key === '.' || e.key === ',') {
                e.preventDefault();
            }
        });
    </script>
