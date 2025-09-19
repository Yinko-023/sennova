<?php

require_once __DIR__ . '/../controllers/PubliController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $full_name = $_POST['full_name'] ?? '';
    $email = $_POST['email_acc'] ?? '';
    $password = $_POST['password_acc'] ?? '';
    $rol = $_POST['rol'] ?? '';
    $area      = $_POST['area'];

    $controller = new UserController();
    $controller->registrarUsuario($username, $full_name, $email, $password, $rol, $area);
} else {
    header('Location: ../inAdmin.php?vista=inicio');
    exit;
}
