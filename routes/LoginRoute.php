<?php
require_once __DIR__ . '/../controllers/LoginController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email_ac = $_POST['email'] ?? '';
    $password_ac = $_POST['password'] ?? '';

    $controller = new LoginController();
    $controller->validar($email_ac, $password_ac);
} else {
    header('Location:  ../acceso-xz9x1d4.php?error=1');
}