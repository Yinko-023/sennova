<?php
require_once '../controllers/AdminController.php';

$controller = new AdminController();
$controller->formularioEditarUsuario($_GET['id']);
