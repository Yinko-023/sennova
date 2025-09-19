<?php
class LoginModel
{
    private $conn;

    public function __construct()
    {
        require_once __DIR__ . '/../conexion/conexion.php';
        $this->conn = conectaDb();
    }

    public function startSession($email_ac, $password_ac)
    {
        $sql = $this->conn->prepare("SELECT * FROM users WHERE email_acc = ?");
        $sql->bindParam(1, $email_ac);
        $sql->execute();
        $user = $sql->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password_ac, $user['password_acc'])) {
            return $user;
        } else {
            return false;
        }
    }
}