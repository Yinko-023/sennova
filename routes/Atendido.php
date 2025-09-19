<?php
require_once '../includes/config.php';
require_once '../includes/mailer.php'; // Incluye la función enviarCorreo

// Función para crear el diseño de correo para notificación de solicitudes
function crearPlantillaCorreoSolicitud($datosSolicitud, $estado, $comentario = '')
{
    $colorVerde = '#2e7d32'; // Verde oscuro
    $colorVerdeClaro = '#4caf50'; // Verde más claro
    $colorFondo = '#f9f9f9'; // Fondo gris muy claro

    $estadoTexto = ($estado === 'aceptada') ? 'aceptada' : 'rechazada';
    $estadoBadgeColor = ($estado === 'aceptada') ? '#4caf50' : '#f44336';
    $estadoBadgeTexto = ($estado === 'aceptada') ? 'SOLICITUD ACEPTADA' : 'SOLICITUD RECHAZADA';
    $estadoIcono = ($estado === 'aceptada') ? '✓' : '✗';

    return '
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Respuesta a tu solicitud - Laboratorio SENA</title>
        <style>
            @import url(\'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap\');

            body {
                font-family: \'Inter\', \'Segoe UI\', Tahoma, Geneva, Verdana, sans-serif;
                line-height: 1.6;
                color: #333333;
                margin: 0;
                padding: 0;
                background-color: #f8fafc;
                -webkit-font-smoothing: antialiased;
            }

            .email-container {
                max-width: 650px;
                margin: 30px auto;
                background-color: #ffffff;
                border-radius: 16px;
                overflow: hidden;
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
                transition: transform 0.3s ease, box-shadow 0.3s ease;
            }

            .email-container:hover {
                box-shadow: 0 15px 40px rgba(0, 0, 0, 0.12);
            }

            .email-header {
                background: linear-gradient(135deg, ' . $colorVerde . ', #2a9d8f);
                color: white;
                padding: 35px 30px;
                text-align: center;
                border-bottom: 1px solid rgba(255, 255, 255, 0.15);
                position: relative;
                overflow: hidden;
            }

            .email-header::before {
                content: "";
                position: absolute;
                top: -50%;
                left: -50%;
                width: 200%;
                height: 200%;
                background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
                animation: pulse 15s infinite linear;
            }

            .email-body {
                padding: 40px;
                background-color: #ffffff;
                position: relative;
            }

            .email-footer {
                background: linear-gradient(to bottom, #f1f5f9, #e2e8f0);
                padding: 30px;
                text-align: center;
                font-size: 13px;
                color: #64748b;
                border-top: 1px solid #e2e8f0;
            }

            .status-badge {
                display: inline-flex;
                align-items: center;
                padding: 12px 25px;
                border-radius: 100px;
                font-weight: 600;
                margin: 20px 0;
                background-color: ' . $estadoBadgeColor . ';
                color: white;
                font-size: 14px;
                letter-spacing: 0.5px;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
                position: relative;
                overflow: hidden;
                transition: transform 0.3s ease, box-shadow 0.3s ease;
            }

            .status-badge::before {
                content: "' . $estadoIcono . '";
                margin-right: 8px;
                font-weight: bold;
                font-size: 16px;
            }

            .status-badge:hover {
                transform: translateY(-2px);
                box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
            }

            .info-box {
                background: linear-gradient(to right, #f8fafc, #ffffff);
                border-left: 4px solid ' . $colorVerdeClaro . ';
                padding: 25px;
                margin: 30px 0;
                border-radius: 0 12px 12px 0;
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.03);
                transition: transform 0.3s ease, box-shadow 0.3s ease;
            }

            .info-box:hover {
                transform: translateX(5px);
                box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
            }

            .info-box p {
                margin: 12px 0;
                display: flex;
                align-items: center;
            }

            .info-box p::before {
                content: "•";
                color: ' . $colorVerdeClaro . ';
                font-weight: bold;
                margin-right: 10px;
                font-size: 18px;
            }

            .divider {
                height: 1px;
                background: linear-gradient(to right, transparent, #e2e8f0, transparent);
                margin: 35px 0;
                position: relative;
            }

            .divider::after {
                content: "";
                position: absolute;
                top: -3px;
                left: 50%;
                transform: translateX(-50%);
                width: 8px;
                height: 8px;
                background: ' . $colorVerdeClaro . ';
                border-radius: 50%;
            }

            .button {
                display: inline-block;
                padding: 16px 35px;
                background: linear-gradient(135deg, ' . $colorVerde . ', #2a9d8f);
                color: white;
                text-decoration: none;
                border-radius: 8px;
                font-weight: 600;
                margin: 20px 0;
                transition: all 0.3s ease;
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
                position: relative;
                overflow: hidden;
            }

            .button::before {
                content: "";
                position: absolute;
                top: 0;
                left: -100%;
                width: 100%;
                height: 100%;
                background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
                transition: 0.5s;
            }

            .button:hover {
                transform: translateY(-3px);
                box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            }

            .button:hover::before {
                left: 100%;
            }

            .logo {
                font-size: 28px;
                font-weight: 700;
                letter-spacing: 0.5px;
                margin-bottom: 15px;
                position: relative;
                z-index: 2;
            }

            .header-subtitle {
                opacity: 0.9;
                font-weight: 400;
                margin-top: 8px;
                font-size: 16px;
                position: relative;
                z-index: 2;
            }

            .contact-info {
                margin-top: 30px;
                padding-top: 25px;
                border-top: 1px solid #e2e8f0;
            }

            .contact-info a {
                color: ' . $colorVerde . ';
                text-decoration: none;
                transition: color 0.2s;
            }

            .contact-info a:hover {
                color: #2a9d8f;
                text-decoration: underline;
            }

            .comentarios-box {
                background: linear-gradient(to bottom, #f8fafc, #f1f5f9);
                padding: 25px;
                border-radius: 12px;
                margin: 30px 0;
                border: 1px solid #e2e8f0;
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.03);
                transition: transform 0.3s ease;
            }

            .comentarios-box:hover {
                transform: translateY(-2px);
            }

            .comentarios-title {
                color: ' . $colorVerde . ';
                font-weight: 600;
                margin-bottom: 15px;
                font-size: 18px;
                display: flex;
                align-items: center;
            }

            .comentarios-title::before {
                content: "💬";
                margin-right: 10px;
                font-size: 20px;
            }

            .footer-links {
                margin: 20px 0;
                display: flex;
                justify-content: center;
                gap: 20px;
            }

            .footer-links a {
                color: #64748b;
                text-decoration: none;
                transition: color 0.2s;
                position: relative;
            }

            .footer-links a::after {
                content: "";
                position: absolute;
                bottom: -5px;
                left: 0;
                width: 0;
                height: 2px;
                background: ' . $colorVerde . ';
                transition: width 0.3s ease;
            }

            .footer-links a:hover {
                color: ' . $colorVerde . ';
            }

            .footer-links a:hover::after {
                width: 100%;
            }

            .animated-border {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 4px;
                background: linear-gradient(90deg, ' . $colorVerde . ', #2a9d8f, ' . $colorVerde . ');
                background-size: 200% 100%;
                animation: gradientMove 3s infinite linear;
            }

            @keyframes gradientMove {
                0% {
                    background-position: 0% 50%;
                }

                100% {
                    background-position: 200% 50%;
                }
            }

            @keyframes pulse {
                0% {
                    transform: rotate(0deg);
                }

                100% {
                    transform: rotate(360deg);
                }
            }

            @media (max-width: 650px) {
                .email-container {
                    margin: 0;
                    border-radius: 0;
                }

                .email-body {
                    padding: 25px;
                }

                .footer-links {
                    flex-direction: column;
                    gap: 10px;
                }
            }

            .info-box p strong {
                margin-right: 5px;
            }
        </style>

    </head>
    <body>
        <div class="email-container">
            <div class="animated-border"></div>

            <div class="email-header">
                <div class="logo">LABORATORIO SENA</div>
                <h2>Respuesta a tu solicitud</h2>
                <div class="header-subtitle">Sistema de Gestión de Servicios</div>
            </div>

            <div class="email-body">
                <p>Estimado/a <strong>' . htmlspecialchars($datosSolicitud['nombre']) . '</strong>,</p>

                <p>Le informamos que su solicitud de servicio ha sido procesada y actualizada en nuestro sistema.</p>

                <div style="text-align: center;">
                    <div class="status-badge">' . $estadoBadgeTexto . '</div>
                </div>

                ' . (!empty($comentario) ? '
                <div>
                    <div class="comentarios-title">Respuesta a tu solicitud</div>
                    <div class="comentarios-box">
                        ' . nl2br(htmlspecialchars($comentario)) . '
                    </div>
                </div>' : '') . '

                <div class="info-box">
                    <p><strong>Servicio solicitado: </strong> ' . htmlspecialchars($datosSolicitud['servicio']) . '</p>
                    <p><strong>Empresa: </strong> ' . htmlspecialchars($datosSolicitud['empresa']) . '</p>
                    <p><strong>Fecha de respuesta: </strong> ' . date('d/m/Y') . '</p>
                    <p><strong>Estado la solicitud: </strong> ' . htmlspecialchars($estado) . '</p>
                </div>

                <div class="divider"></div>

                <p>Si tiene alguna pregunta o necesita información adicional, no dude en contactarnos a través de nuestros canales de atención.</p>

                <div class="contact-info">
                    <p><strong>Horario de atención:</strong> Lunes a Viernes de 8:00 am a 6:00 pm</p>
                    <p><strong>Teléfono:</strong> (601) 546-1600 | <strong>Email:</strong> <a href="mailto:contacto@laboratoriosena.com">contacto@laboratoriosena.com</a></p>
                </div>

                <p style="text-align: center;">
                    <a href="' . (defined('SITE_URL') ? SITE_URL : '#') . '"
                        class="button"
                        style="color: #ffffff; text-decoration: none;">
                        Acceder al portal de servicios
                    </a>

                </p>
            </div>

            <div class="email-footer">
                <p>© ' . date('Y') . ' Laboratorio SENA. Todos los derechos reservados.</p>

                <div class="footer-links" style="text-align:center;">
                    <a href="#" style="display:inline-block; margin:0 8px; text-decoration:none; color:#64748b;">
                        Política de Privacidad
                    </a>
                    <a href="#" style="display:inline-block; margin:0 8px; text-decoration:none; color:#64748b;">
                        Términos de Servicio
                    </a>
                    <a href="#" style="display:inline-block; margin:0 8px; text-decoration:none; color:#64748b;">
                        Contacto
                    </a>
                </div>


                <p>Este es un mensaje automático, por favor no responda a este correo.</p>
                <p>Si no reconoce esta solicitud, por favor ignore este mensaje.</p>
            </div>
        </div>
    </body>
    </html>';
}
// Función para enviar notificación de solicitud
function enviarNotificacionSolicitud($solicitud, $estado, $comentario = '')
{
    // Personalizar el asunto según el tipo de servicio si está disponible
    $tipoServicio = '';
    if (isset($solicitud['servicio'])) {
        // Extraer palabras clave del servicio para el asunto
        $servicio = strtolower($solicitud['servicio']);
        if (strpos($servicio, 'café') !== false || strpos($servicio, 'cafe') !== false) {
            $tipoServicio = ' de Análisis de Café';
        } elseif (strpos($servicio, 'calidad') !== false) {
            $tipoServicio = ' de Control de Calidad';
        } elseif (strpos($servicio, 'laboratorio') !== false) {
            $tipoServicio = ' de Laboratorio';
        }
    }

    // Crear asunto claro y profesional
    $estadoTexto = ($estado === 'aceptada') ? 'Aceptada' : 'Rechazada';
    $asunto = "[$estadoTexto] Solicitud{$tipoServicio} - Laboratorio SENA";

    $cuerpo = crearPlantillaCorreoSolicitud($solicitud, $estado, $comentario);

    // Enviar el correo
    return enviarCorreo($solicitud['email'], $asunto, $cuerpo);
}

// Verifica si se envió el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idSolicitud = $_POST['id_soli'] ?? null;
    $estado = $_POST['estado'] ?? null;
    $medio = $_POST['medio'] ?? null;
    $comentario = trim($_POST['comentario'] ?? '');

    // Comentario por defecto si está vacío
    if ($comentario === '') {
        $comentario = $estado === 'aceptada'
            ? 'Su solicitud ha sido aceptada. Pronto nos comunicaremos con usted.'
            : 'Su solicitud ha sido rechazada. Gracias por su interés.';
    }

    // Verifica que los datos obligatorios estén presentes
    if (!$idSolicitud || !$estado || !$medio) {
        die("Faltan datos obligatorios.");
    }

    // Obtén los datos completos de la solicitud desde la base de datos
    $stmt = $db->prepare("SELECT * FROM requests WHERE id_re = :id");
    $stmt->bindParam(':id', $idSolicitud, PDO::PARAM_INT);
    $stmt->execute();
    $solicitud = $stmt->fetch();

    if (!$solicitud) {
        die("Solicitud no encontrada.");
    }

    $nombre = htmlspecialchars($solicitud['nombre']);
    $email = htmlspecialchars($solicitud['email']);
    $area = htmlspecialchars($solicitud['area']);

    // Actualiza el estado de la solicitud en la base de datos
    $stmt = $db->prepare("UPDATE requests SET estado = :estado, comentario = :comentario, medio_notificacion = :medio WHERE id_re = :id");
    $stmt->bindParam(':estado', $estado, PDO::PARAM_STR);
    $stmt->bindParam(':comentario', $comentario, PDO::PARAM_STR);
    $stmt->bindParam(':medio', $medio, PDO::PARAM_STR);
    $stmt->bindParam(':id', $idSolicitud, PDO::PARAM_INT);
    $stmt->execute();

    // Inserta una notificación en la tabla `notifications`
    $mensaje = "La solicitud de $nombre ha sido " . ucfirst($estado) . ".";
    $stmt = $db->prepare("INSERT INTO notifications (area, mensaje, leida, fecha, request_id) VALUES (:area, :mensaje, 0, NOW(), :request_id)");
    $stmt->bindParam(':area', $area, PDO::PARAM_STR);
    $stmt->bindParam(':mensaje', $mensaje, PDO::PARAM_STR);
    $stmt->bindParam(':request_id', $idSolicitud, PDO::PARAM_INT);
    $stmt->execute();

    // Si el medio de notificación es correo, envía el correo con el nuevo diseño
    if ($medio === 'correo') {
        if (enviarNotificacionSolicitud($solicitud, $estado, $comentario)) {
            // Redirige al administrador con un mensaje de éxito
            header("Location: ../inAdmin.php?vista=atencion&res=ok");
            exit;
        } else {
            die("Error al enviar el correo.");
        }
    } else {
        // Si no es correo, solo redirige
        header("Location: ../inAdmin.php?vista=atencion&res=ok");
        exit;
    }
} else {
    die("Método no permitido.");
}
