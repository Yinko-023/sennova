<?php
require_once 'includes/config.php';
require_once 'includes/mailer.php';

$destinatario = 'perdomogualibrayanandrey@gmail.com'; // Cambia esto por tu correo para pruebas
$asunto = 'Prueba de correo';
$cuerpo = '<h1>Correo de prueba</h1><p>Este es un correo de prueba enviado desde PHPMailer.</p>';

if (enviarCorreo($destinatario, $asunto, $cuerpo)) {
    echo "Correo enviado correctamente.";       
} else {
    echo "Error al enviar el correo.";
}
?>
