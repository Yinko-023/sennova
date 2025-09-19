<?php
$controller = $_GET['controller'] ?? 'login';
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
            die("La acción '$action' no existe en el controlador '$controllerClass'.");
        }
    } else {
        die("La clase '$controllerClass' no existe.");
    }
} else {
    die("El archivo '$controllerFile' no fue encontrado.");
}
//  http://localhost/sennova/acceso-xz9x1d4.php