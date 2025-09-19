<?php
require_once 'controllers/PubliController.php';


$publicacionController = new PublicacionController();
$publicacionController->verCalidadCafe();

// Si hay mensaje de éxito tras enviar el formulario
$exito = isset($_GET['exito']) ? true : false;
?>

<?php if ($exito): ?>
  <div class="container mx-auto mt-4">
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
      <strong class="font-bold">¡Solicitud enviada!</strong>
      <span class="block sm:inline">Tu solicitud fue registrada exitosamente.</span>
    </div>
  </div>
<?php endif; ?>
