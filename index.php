<?php
require_once 'conexion/conexion.php';

// Conectar a la base de datos
$conn = conectaDb(); // <- Agrega esta línea

// Establecer controlador y acción por defecto
$controller = $_GET['controller'] ?? 'home';
$action = $_GET['action'] ?? 'index';

$controllerFile = "controllers/" . ucfirst($controller) . "Controller.php";
$controllerClass = ucfirst($controller) . "Controller";

if (file_exists($controllerFile)) {
    require_once $controllerFile;

    if (class_exists($controllerClass)) {
        $obj = new $controllerClass();

        if (method_exists($obj, $action)) {
            $obj->$action();
        } else {
            die("Error: La acción '$action' no existe en el controlador '$controllerClass'.");
        }
    } else {
        die("Error: La clase '$controllerClass' no está definida.");
    }
} else {
    die("Error: El archivo '$controllerFile' no existe.");
}

// Registrar visita
$ip = $_SERVER['REMOTE_ADDR'];
$fechaHoy = date('Y-m-d');
$userAgent = $_SERVER['HTTP_USER_AGENT'];

$sql = "INSERT IGNORE INTO visitas (ip, fecha, user_agent) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->execute([$ip, $fechaHoy, $userAgent]);
?>
