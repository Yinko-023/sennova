<?php
require_once 'conexion/conexion.php';

class Publicacion {
    private $conn;

    public function __construct() {
        $this->conn = conectaDb();
    }

    public function obtenerPublicaciones() {
        $stmt = $this->conn->prepare("SELECT * FROM publications ORDER BY created_at DESC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    
    public function obtenerPublicacionesFiltradas($orden, $filtro_fecha, $categoria) {
    $query = "SELECT * FROM publications WHERE 1=1";
    $params = [];

    // Categoría
    if (!empty($categoria)) {
        $query .= " AND categoria = ?";
        $params[] = $categoria;
    }

    // Filtro por fecha
    switch ($filtro_fecha) {
        case 'hoy':
            $query .= " AND DATE(published_at) = CURDATE()";
            break;
        case 'semana':
            $query .= " AND YEARWEEK(published_at, 1) = YEARWEEK(CURDATE(), 1)";
            break;
        case 'mes':
            $query .= " AND MONTH(published_at) = MONTH(CURDATE()) AND YEAR(published_at) = YEAR(CURDATE())";
            break;
        case 'anio':
            $query .= " AND YEAR(published_at) = YEAR(CURDATE())";
            break;
    }

    // Orden
    $query .= $orden === 'antiguos' ? " ORDER BY published_at ASC" : " ORDER BY published_at DESC";

    $stmt = $this->conn->prepare($query);
    $stmt->execute($params);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public function obtenerDestacada() {
    $stmt = $this->conn->query("SELECT * FROM publications WHERE destacada = 1 AND is_active = 1 ORDER BY published_at DESC LIMIT 1");
    return $stmt->fetch(PDO::FETCH_ASSOC);
}



}
