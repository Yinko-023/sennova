<?php
require_once 'controllers/PubliController.php';


$publicacionController = new PublicacionController();
$publicacionController->verCalidadCafe();

// Si hay mensaje de éxito tras enviar el formulario
$exito = isset($_GET['exito']) ? true : false;
?>


