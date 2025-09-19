<?php
require_once __DIR__ . '/../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once 'config.php';

function enviarCorreo($destinatario, $asunto, $cuerpo, $adjunto = null) {
    $mail = new PHPMailer(true);
    
    try {
        // Configuración SMTP
        $mail->isSMTP();
        $mail->Host = MAIL_HOST;
        $mail->SMTPAuth = true;
        $mail->Username = MAIL_FROM;
        $mail->Password = MAIL_PASS;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = MAIL_PORT;
        
        // Remitente y destinatario
        $mail->setFrom(MAIL_FROM, 'Laboratorio SENA');
        $mail->addAddress($destinatario);
        
        // Contenido HTML
        $mail->isHTML(true);
        $mail->Subject = $asunto;
        $mail->Body = $cuerpo;
        $mail->AltBody = strip_tags($cuerpo); // Versión texto plano
        
        // Adjuntar archivo si existe
        if ($adjunto && file_exists($adjunto['ruta'])) {
            $mail->addAttachment($adjunto['ruta'], $adjunto['nombre']);
        }
        
        return $mail->send();
    } catch (Exception $e) {
        error_log("Error al enviar correo: {$mail->ErrorInfo}");
        return false;
    }
}

// Simulación de datos para pruebas desde CLI
if (php_sapi_name() === 'cli') {
    $email = 'correo@ejemplo.com'; // Cambia esto por un correo válido para pruebas
    $asunto = "Correo de prueba desde CLI";
    $cuerpo = "
        <h1>¡Hola!</h1>
        <p>Este es un correo de prueba enviado desde la línea de comandos.</p>
    ";

    if (enviarCorreo($email, $asunto, $cuerpo)) {
        echo "Correo enviado correctamente desde CLI.\n";
    } else {
        echo "Hubo un error al enviar el correo desde CLI.\n";
    }
} else {
    // Código para solicitudes HTTP
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'])) {
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $asunto = "Gracias por suscribirte a nuestras noticias";
            $cuerpo = "
                <h1>¡Gracias por suscribirte!</h1>
                <p>Hola,</p>
                <p>Gracias por suscribirte a nuestras noticias. Pronto recibirás actualizaciones importantes.</p>
                <p>Saludos,<br>El equipo de Laboratorios SENNOVA</p>
            ";

            if (enviarCorreo($email, $asunto, $cuerpo)) {
                echo "Correo enviado correctamente.";
            } else {
                echo "Hubo un error al enviar el correo.";
            }
        } else {
            echo "Correo electrónico no válido.";
        }
    } else {
        echo "Método no permitido.";
    }
}