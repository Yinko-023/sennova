<?php

require_once __DIR__ . '/../models/PubliModel.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $username = $_POST['username'];
    $full_name = $_POST['full_name'];
    $email = $_POST['email_acc'] ?? null;
    $password = $_POST['password'] ?? null;
    $rol = $_POST['rol'] ?? null;
    $area = $_POST['area'] ?? null;

    // Lógica condicional del área según el rol
    if ($rol == '1') {
        $area = null; // Admin sin restricciones
    } elseif ($rol != '3') {
        $area = 'visualizador'; // Editor o usuario limitado
    }

    $modelo = new UserModel();
    $resultado = $modelo->actualizarUsuario($id, $username, $full_name, $email, $password, $rol, $area);

    if ($resultado === 'correo_duplicado') {
        header("Location: /sennova/inAdmin.php?vista=inicio&id=$id&error=correo");
        exit;
    }

    // ✅ Redirigir si se actualizó correctamente
    header("Location: /sennova/inAdmin.php?vista=inicio&mensaje=actualizado");
    exit;
}
