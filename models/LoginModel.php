<?php
class LoginModel
{
    private $conn;

    public function __construct()
    {
        require_once __DIR__ . '/../conexion/conexion.php';
        $this->conn = conectaDb();
    }

    public function startSession($email_or_user, $password)
    {
        $sql = "SELECT u.id, u.username, u.full_name, u.email_acc, u.password_acc,
                   u.role_id, u.area, u.telefono, u.direccion,
                   r.name_rol
            FROM users u
            LEFT JOIN roles r ON r.id = u.role_id
            WHERE u.email_acc = :login OR u.username = :login
            LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':login' => $email_or_user]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row) return false;
        if (!password_verify($password, $row['password_acc'])) return false;

        // Puedes quitar password_acc antes de devolver
        unset($row['password_acc']);
        return $row; // <- contiene telefono y direccion
    }
}
