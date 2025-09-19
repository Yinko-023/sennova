<?php
require_once '../controllers/PubliController.php';
$area = $_GET['area'] ?? 'cafe';
$controlador = new SolicitudController();
$controlador->marcarLeidas($area);
