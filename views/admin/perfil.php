<?php
$nombre = $_SESSION['nombre_usuario'] ?? 'Usuario';
$email = $_SESSION['email'] ?? 'correo@ejemplo.com';
$telefono = $_SESSION['telefono'] ?? 'Sin número';
$direccion = $_SESSION['direccion'] ?? 'Sin dirección';
$rol = $_SESSION['rol_nombre'] ?? 'Sin rol';
?>

    <div class="row g-4">
        <!-- Información lateral -->
        <div class="col-lg-4">
            <div class="profile-card shadow-sm" data-aos="fade-right">
                <div class="profile-header">
                    <img src="https://bootdey.com/img/Content/avatar/avatar7.png" class="profile-avatar" alt="Avatar">
                    <h4 class="fw-bold mb-2"><?= htmlspecialchars($nombre) ?></h4>
                    <span class="profile-role"><?= htmlspecialchars($rol) ?></span>
                    <p class="text-white opacity-75 mb-3">Colaborador del área <?= $_SESSION['area'] ?? 'general' ?></p>
                    <button class="btn btn-upload btn-sm"><i class="fas fa-upload me-1"></i> Cambiar Foto</button>
                </div>
                
                <div class="p-4">
                    <h5 class="section-title">Información de Contacto</h5>
                    <div class="info-item">
                        <i class="fas fa-envelope"></i>
                        <span><?= htmlspecialchars($email) ?></span>
                    </div>
                    <div class="info-item">
                        <i class="fas fa-phone-alt"></i>
                        <span><?= htmlspecialchars($telefono) ?></span>
                    </div>
                    <div class="info-item">
                        <i class="fas fa-map-marker-alt"></i>
                        <span><?= htmlspecialchars($direccion) ?></span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Detalles principales -->
        <div class="col-lg-8">
            <div class="profile-card shadow-sm" data-aos="fade-left">
                <div class="card-header-custom">
                    <h5 class="mb-0 text-white"><i class="fas fa-user-circle me-2"></i>Detalles del Perfil</h5>
                </div>
                <div class="card-body p-4">
                    <form>
                        <div class="row mb-4">
                            <label class="col-sm-3 col-form-label form-label">Nombre Completo</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    <input type="text" readonly class="form-control bg-light" value="<?= htmlspecialchars($nombre) ?>">
                                </div>
                            </div>
                        </div>
                        
                        <div class="row mb-4">
                            <label class="col-sm-3 col-form-label form-label">Correo Electrónico</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                    <input type="email" readonly class="form-control bg-light" value="<?= htmlspecialchars($email) ?>">
                                </div>
                            </div>
                        </div>
                        
                        <div class="row mb-4">
                            <label class="col-sm-3 col-form-label form-label">Teléfono</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                    <input type="text" readonly class="form-control bg-light" value="<?= htmlspecialchars($telefono) ?>">
                                </div>
                            </div>
                        </div>
                        
                        <div class="row mb-4">
                            <label class="col-sm-3 col-form-label form-label">Dirección</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                                    <input type="text" readonly class="form-control bg-light" value="<?= htmlspecialchars($direccion) ?>">
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-sm-9 offset-sm-3">
                                <a href="inAdmin.php?vista=editarUsuario&id=<?= $_SESSION['id'] ?? 0 ?>" class="btn btn-edit">
                                    <i class="fas fa-edit me-1"></i> Editar Perfil
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <style>
        :root {
            --primary-color: #302e2eff;
            --secondary-color: #28272bff;
            --accent-color: #4cc9f0;
            --light-bg: #f8f9fa;
            --dark-text: #212529;
            --gray-text: #6c757d;
        }
        
        
        .profile-card {
            border: none;
            border-radius: 15px;
            overflow: hidden;
            transition: transform 0.3s ease;
            background: white;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        }
        
        .profile-card:hover {
            transform: translateY(-5px);
        }
        
        .profile-header {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            padding: 2rem 0;
            color: white;
            text-align: center;
            position: relative;
        }
        
        .profile-avatar {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            border: 4px solid white;
            object-fit: cover;
            margin-bottom: 1rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        
        .profile-role {
            background-color: var(--accent-color);
            color: white;
            padding: 0.25rem 1rem;
            border-radius: 20px;
            font-size: 0.8rem;
            display: inline-block;
            margin-bottom: 1rem;
        }
        
        .info-item {
            padding: 1rem;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            transition: background-color 0.3s ease;
        }
        
        .info-item:hover {
            background-color: var(--light-bg);
        }
        
        .info-item i {
            width: 24px;
            text-align: center;
            margin-right: 0.5rem;
            color: var(--primary-color);
        }
        
        .card-header-custom {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border-radius: 15px 15px 0 0 !important;
            padding: 1.25rem;
        }
        
        .form-label {
            font-weight: 600;
            color: var(--gray-text);
        }
        
        .btn-edit {
            background-color: var(--primary-color);
            color: white;
            border: none;
            padding: 0.5rem 1.5rem;
            border-radius: 8px;
            transition: all 0.3s ease;
        }
        
        .btn-edit:hover {
            background-color: var(--secondary-color);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(67, 97, 238, 0.3);
        }
        
        .btn-upload {
            border: 1px solid var(--primary-color);
            color: var(--primary-color);
            transition: all 0.3s ease;
        }
        
        .btn-upload:hover {
            background-color: var(--primary-color);
            color: white;
        }
        
        .section-title {
            position: relative;
            padding-bottom: 0.5rem;
            margin-bottom: 1.5rem;
        }
        
        .section-title:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 50px;
            height: 3px;
            background: var(--accent-color);
            border-radius: 3px;
        }
    </style>

