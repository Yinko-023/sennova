<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sección de Imágenes con Gradiente</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Estilo base para la sección */
        #image-section-container {
            background: linear-gradient(90deg, #2c3e50 0%, #1a1a2e 100%);
            border-radius: 15px;
            padding: 30px;
            margin: 20px 0;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            color: #fff;
        }
        
        /* Estilo para el modal personalizado */
        #custom-imagen-modal .modal-content {
            background: linear-gradient(135deg, #2c3e50 0%, #1a1a2e 100%);
            border: none;
            border-radius: 15px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.5);
        }
        
        #custom-imagen-modal .modal-header {
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        #custom-imagen-modal .modal-title {
            font-weight: 600;
            letter-spacing: 1px;
        }
        
        /* Estilo para la imagen principal */
        #main-process-image {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: 3px solid rgba(255, 255, 255, 0.1);
        }
        
        #main-process-image:hover {
            transform: scale(1.02);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.4);
        }
        
        /* Estilo para el área sin imagen */
        #no-image-container {
            padding: 40px 20px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 10px;
            border: 2px dashed rgba(255, 255, 255, 0.1);
        }
        
        #no-image-icon {
            opacity: 0.7;
            margin-bottom: 15px;
        }
        
        /* Estilo para el botón de cerrar personalizado */
        #custom-close-button {
            background: rgba(255, 255, 255, 0.1);
            border: none;
            border-radius: 50%;
            width: 35px;
            height: 35px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.3s ease;
        }
        
        #custom-close-button:hover {
            background: rgba(255, 255, 255, 0.2);
        }
        
        /* Estilo para el título de la sección */
        #section-title {
            font-size: 1.8rem;
            font-weight: 600;
            margin-bottom: 25px;
            text-align: center;
            letter-spacing: 1px;
            background: linear-gradient(90deg, #3498db, #9b59b6);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        }
        
        /* Responsividad */
        @media (max-width: 768px) {
            #image-section-container {
                padding: 20px 15px;
                margin: 10px 0;
            }
            
            #section-title {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="container my-5">
        <div id="image-section-container" data-aos="fade-up">
            <h2 id="section-title">Imagen del Proceso</h2>
            
            <?php if ((isset($_SESSION['rol']) && $_SESSION['rol'] == 1) || ((isset($_SESSION['rol']) && $_SESSION['rol'] == 2) || (isset($_SESSION['rol'], $_SESSION['area']) && $_SESSION['rol'] == 3 && $_SESSION['area'] === 'electronica'))): ?>
                <!-- Código de subir/eliminar imagen -->
                <div class="text-center mb-4">
                    <button class="btn btn-primary me-2">
                        <i class="fas fa-upload me-1"></i> Subir Imagen
                    </button>
                    <button class="btn btn-outline-light">
                        <i class="fas fa-trash me-1"></i> Eliminar Imagen
                    </button>
                </div>
            <?php endif; ?>

            <?php if ($imagenURL): ?>
                <div class="text-center">
                    <img id="main-process-image" src="<?= $imagenURL . '?v=' . time() ?>" 
                         class="img-fluid rounded shadow-sm my-3"
                         style="cursor: zoom-in; max-width: 500px; width: 100%; height: auto;" 
                         alt="Imagen del proceso"
                         data-bs-toggle="modal" data-bs-target="#custom-imagen-modal">
                </div>

                <div class="modal fade" id="custom-imagen-modal" tabindex="-1" 
                     aria-labelledby="custom-imagen-modal-label" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-xl">
                        <div class="modal-content">
                            <div class="modal-header border-0">
                                <h5 class="modal-title text-white" id="custom-imagen-modal-label">Vista Ampliada</h5>
                                <button type="button" id="custom-close-button" class="btn-close btn-close-white" 
                                        data-bs-dismiss="modal" aria-label="Cerrar"></button>
                            </div>
                            <div class="modal-body text-center p-4">
                                <img src="<?= $imagenURL . '?v=' . time() ?>" class="img-fluid rounded" 
                                     style="max-height: 70vh; width: auto;" alt="Imagen ampliada del proceso">
                            </div>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <div id="no-image-container" class="text-center text-muted mt-4">
                    <i id="no-image-icon" class="fas fa-image fa-3x mb-2"></i>
                    <p>No hay imagen cargada actualmente</p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>