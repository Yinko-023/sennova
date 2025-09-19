<?php
require_once __DIR__ . '/../conexion/conexion.php';

class Publicacion
{
    private $conn;

    public function __construct()
    {
        $this->conn = conectaDb();
    }

    public function obtenerPublicaciones()
    {
        $stmt = $this->conn->prepare("SELECT * FROM publications ORDER BY created_at DESC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerPublicacionesFiltradas($orden, $filtro_fecha, $categoria, $area)
    {
        $query = "SELECT * FROM publications WHERE 1=1";
        $params = [];

        if (!empty($categoria)) {
            $query .= " AND categoria = ?";
            $params[] = $categoria;
        }

        if (!empty($area)) {
            $query .= " AND lab_area = ?";
            $params[] = $area;
        }

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

        $query .= $orden === 'antiguos' ? " ORDER BY published_at ASC" : " ORDER BY published_at DESC";

        $stmt = $this->conn->prepare($query);
        $stmt->execute($params);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function obtenerDestacada()
    {
        $stmt = $this->conn->query("SELECT id, title, content, image_path, published_at, lab_area FROM publications WHERE destacada = 1 AND is_active = 1 ORDER BY published_at DESC LIMIT 1");
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    public function quitarDestacado($id)
    {
        try {
            $sql = "UPDATE publications SET destacada = 0 WHERE id = ?";
            $stmt = $this->conn->prepare($sql);
            return $stmt->execute([$id]);
        } catch (PDOException $e) {
            echo "Error al quitar destacado: " . $e->getMessage();
            return false;
        }
    }


    // ✅ Solo UNA vez este método
    public function registrarVisita($ip, $fecha)
    {
        $stmt = $this->conn->prepare("SELECT id FROM visitas WHERE ip = ? AND fecha = ?");
        $stmt->execute([$ip, $fecha]);

        if ($stmt->rowCount() === 0) {
            $insert = $this->conn->prepare("INSERT INTO visitas (ip, fecha) VALUES (?, ?)");
            $insert->execute([$ip, $fecha]);
        }
    }

    // ✅ Solo UNA vez este método
    public function contarVisitas()
    {
        $result = $this->conn->query("SELECT COUNT(*) AS total FROM visitas");
        return $result->fetch(PDO::FETCH_ASSOC)['total'] ?? 0;
    }
}

class PublicacionModel
{
    private $conn;

    public function __construct()
    {
        $this->conn = conectaDb();
    }

    public function guardarPublicacion($titulo, $contenido, $categoria, $destacada, $nombreImagen, $fecha, $is_active, $lab_area)
    {
        try {
            if ($destacada) {
                $this->conn->query("UPDATE publications SET destacada = 0 WHERE destacada = 1");
            }

            $sql = "INSERT INTO publications (title, content, image_path, type_pu, published_at, destacada, is_active, lab_area)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(1, $titulo);
            $stmt->bindParam(2, $contenido);
            $stmt->bindParam(3, $nombreImagen);
            $stmt->bindParam(4, $categoria);
            $stmt->bindParam(5, $fecha);
            $stmt->bindParam(6, $destacada, PDO::PARAM_INT);
            $stmt->bindParam(7, $is_active, PDO::PARAM_INT);
            $stmt->bindParam(8, $lab_area);

            return $stmt->execute();
        } catch (PDOException $e) {
            // Log del error
            error_log("Error al insertar publicación: " . $e->getMessage());
            return false;
        }
    }

    public function obtenerPublicacionesCafe()
    {
        $sql = "SELECT * FROM publications WHERE lab_area = 'cafe' AND is_active = 1 ORDER BY published_at DESC";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function ObtenerElectronica()
    {
        $sql = "SELECT * FROM publications WHERE lab_area = 'electronica' AND is_active = 1 ORDER BY published_at DESC";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function eliminarPublicacion($id)
    {
        try {
            $sql = "DELETE FROM publications WHERE id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(1, $id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            return false;
        }
    }
    public function quitarDestacadas()
    {
        $sql = "UPDATE publications SET destacada = 0 WHERE destacada = 1";
        return $this->conn->query($sql);
    }

    public function destacarPublicacion($id)
    {
        $sql = "UPDATE publications SET destacada = 1 WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
    public function obtenerPublicacionPorId($id)
    {
        $stmt = $this->conn->prepare("SELECT title, content FROM publications WHERE id = ?");
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function editarPublicacion($id, $titulo, $contenido, $nuevaImagen = null, $eliminarImagen = false)
    {
        // Primero, obtenemos la imagen actual si hay
        $stmt = $this->conn->prepare("SELECT image_path FROM publications WHERE id = ?");
        $stmt->execute([$id]);
        $publicacion = $stmt->fetch(PDO::FETCH_ASSOC);
        $imagenActual = $publicacion['image_path'];

        // Eliminar imagen si se pidió eliminarla
        if ($eliminarImagen && $imagenActual && file_exists(__DIR__ . '/../img/' . $imagenActual)) {
            unlink(__DIR__ . '/../img/' . $imagenActual);
            $imagenActual = null;
        }

        // Si se sube nueva imagen, reemplazarla
        if ($nuevaImagen && $nuevaImagen['error'] === UPLOAD_ERR_OK) {
            $ext = pathinfo($nuevaImagen['name'], PATHINFO_EXTENSION);
            $nuevoNombre = uniqid('img_') . '.' . $ext;
            move_uploaded_file($nuevaImagen['tmp_name'], __DIR__ . '/../img/' . $nuevoNombre);

            // Si había imagen anterior, eliminarla
            if ($imagenActual && file_exists(__DIR__ . '/../img/' . $imagenActual)) {
                unlink(__DIR__ . '/../img/' . $imagenActual);
            }

            $imagenActual = $nuevoNombre;
        }

        // Actualizar en base de datos
        $stmt = $this->conn->prepare("UPDATE publications SET title = ?, content = ?, image_path = ? WHERE id = ?");
        return $stmt->execute([$titulo, $contenido, $imagenActual, $id]);
    }



    public function obtenerArchivo()
    {
        $sql = "SELECT 
            a.id_archives,
            a.Tittle_ar, 
            a.description_ar, 
            a.type_ar, 
            a.date_publi_ar, 
            a.ruta_ar, 
            a.name_ar, 
            u.full_name AS usuario
        FROM archives a
        LEFT JOIN users u ON a.id_user = u.id";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function guardar($titulo, $descripcion, $tipo, $fecha, $ruta, $nombreOriginal, $user_id)
    {
        $sql = "INSERT INTO archives (Tittle_ar, description_ar, type_ar, date_publi_ar, ruta_ar, name_ar, id_user) 
       VALUES (?, ?, ?, ?, ?, ?, ?)";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(1, $titulo);
        $stmt->bindParam(2, $descripcion);
        $stmt->bindParam(3, $tipo);
        $stmt->bindParam(4, $fecha);
        $stmt->bindParam(5, $ruta);
        $stmt->bindParam(6, $nombreOriginal);
        $stmt->bindParam(7, $user_id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Obtener archivo por ID
    public function obtenerArchivoPorId($id)
    {
        $sql = "SELECT * FROM archives WHERE id_archives = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Eliminar archivo de la BD
    public function eliminarArchivo($id)
    {
        $sql = "DELETE FROM archives WHERE id_archives = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
    public function buscarArchivos($busqueda)
    {
        $busqueda = '%' . $busqueda . '%';

        $sql = "SELECT a.*, u.full_name AS usuario
          FROM archives a
          INNER JOIN users u ON a.id_user = u.id
          WHERE 
            a.Tittle_ar LIKE ? OR
            a.description_ar LIKE ? OR
            a.type_ar LIKE ? OR
            a.date_publi_ar LIKE ? OR
            u.full_name LIKE ?
          ORDER BY a.date_publi_ar DESC";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$busqueda, $busqueda, $busqueda, $busqueda, $busqueda]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

class UserModel
{
    private $conn;

    public function __construct()
    {
        $this->conn = conectaDb();
    }

    public function registrar($username, $full_name, $email, $password, $rol, $area, $token)
    {
        try {
            // Validar si el correo ya existe
            $stmt = $this->conn->prepare("SELECT COUNT(*) FROM users WHERE email_acc = ?");
            $stmt->execute([$email]);
            if ($stmt->fetchColumn() > 0) {
                return 'correo_duplicado'; // Indicador personalizado para el controlador
            }

            // Insertar nuevo usuario
            $sql = "INSERT INTO users (username, full_name, email_acc, password_acc, role_id, area, email_verification_token, email_verified, created_at, updated_at)
                VALUES (?, ?, ?, ?, ?, ?, ?, 0, NOW(), NOW())";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(1, $username);
            $stmt->bindParam(2, $full_name);
            $stmt->bindParam(3, $email);
            $stmt->bindParam(4, $password);
            $stmt->bindParam(5, $rol);
            $stmt->bindParam(6, $area);
            $stmt->bindParam(7, $token);

            return $stmt->execute() ? true : false;
        } catch (PDOException $e) {
            echo "Error al registrar: " . $e->getMessage();
            return false;
        }
    }


    public function verificarCorreoConToken($token)
    {
        $sql = "UPDATE users SET email_verified = 1, email_verification_token = NULL 
            WHERE email_verification_token = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(1, $token);
        $stmt->execute();

        return $stmt->rowCount() > 0;
    }



    public function obtenerRolesActivos()
    {
        $sql = "SELECT id, name_rol FROM roles WHERE state_rol = 1";
        return $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
    public function contarTodas()
    {
        $sql = "SELECT COUNT(*) FROM publications";
        return $this->conn->query($sql)->fetchColumn();
    }

    public function contarDestacadas()
    {
        $sql = "SELECT COUNT(*) FROM publications WHERE destacada = 1";
        return $this->conn->query($sql)->fetchColumn();
    }

    public function contarArchivos()
    {
        $sql = "SELECT COUNT(*) FROM archives";
        return $this->conn->query($sql)->fetchColumn();
    }

    public function contarUsuarios($busqueda = '')
    {
        $sql = "SELECT COUNT(*) FROM users
            WHERE username LIKE :buscar
               OR email_acc LIKE :buscar
               OR full_name LIKE :buscar";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':buscar', "%$busqueda%", PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    public function obtenerUsuariosConRol($inicio, $porPagina, $busqueda = '')
    {
        $sql = "SELECT users.id, users.username, users.email_acc, users.full_name, roles.name_rol
            FROM users
            INNER JOIN roles ON users.role_id = roles.id
            WHERE users.username LIKE :buscar
               OR users.email_acc LIKE :buscar
               OR users.full_name LIKE :buscar
            LIMIT :inicio, :porPagina";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':buscar', "%$busqueda%", PDO::PARAM_STR);
        $stmt->bindValue(':inicio', (int) $inicio, PDO::PARAM_INT);
        $stmt->bindValue(':porPagina', (int) $porPagina, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function obtenerUsuarioPorId($id)
    {
        $sql = "SELECT * FROM users WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function actualizarUsuario($id, $username, $full_name, $email, $password, $rol, $area)
    {
        // ✅ Validar solo si el correo ya está en uso por otro usuario
        if (!empty($email)) {
            $sqlCheckEmail = "SELECT COUNT(*) FROM users WHERE email_acc = ? AND id != ?";
            $stmtCheckEmail = $this->conn->prepare($sqlCheckEmail);
            $stmtCheckEmail->execute([$email, $id]);
            if ($stmtCheckEmail->fetchColumn() > 0) {
                return 'correo_duplicado';
            }
        }

        // ✅ Armar los campos dinámicamente
        $campos = "username = ?, full_name = ?";
        $valores = [$username, $full_name];

        if (!empty($email)) {
            $campos .= ", email_acc = ?";
            $valores[] = $email;
        }

        if (!empty($password)) {
            $campos .= ", password_acc = ?";
            $valores[] = password_hash($password, PASSWORD_DEFAULT);
        }

        if (!empty($rol)) {
            $campos .= ", role_id = ?";
            $valores[] = $rol;
        }

        $campos .= ", area = ?";
        $valores[] = $area;

        $valores[] = $id;

        $sql = "UPDATE users SET $campos WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute($valores);
    }


    public function eliminarUsuarioPorId($id)
    {
        try {
            $sql = "DELETE FROM users WHERE id = ?";
            $stmt = $this->conn->prepare($sql);
            return $stmt->execute([$id]);
        } catch (PDOException $e) {
            // Verifica si es por clave foránea
            if ($e->getCode() === '23000') {
                return false; // Ya en la ruta se mostrará mensaje de error
            }
            throw $e; // Otro tipo de error
        }
    }
}

class RolModel
{
    private $conn;

    public function __construct()
    {
        require_once __DIR__ . '/../conexion/conexion.php';
        $this->conn = conectaDb();
    }
    public function obtenerRolesActivos()
    {
        $sql = "SELECT id, name_rol FROM roles WHERE state_rol = 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

class SolicitudModel
{
    private $conn;

    public function __construct()
    {
        require_once __DIR__ . '/../conexion/conexion.php';
        $this->conn = conectaDb();
    }

    public function registrarSolicitud($datos)
    {
        try {
            $sql = "INSERT INTO requests 
                   (nombre, empresa, cc_cliente, email, telefono, servicio, descripcion, area, fecha_solicitud)
                VALUES 
                   (?, ?, ?, ?, ?, ?, ?, ?, NOW())";

            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                $datos['nombre'],
                $datos['empresa'],
                $datos['cc_cliente'],
                $datos['email'],
                $datos['telefono'],
                $datos['servicio'],
                $datos['descripcion'],
                $datos['area']
            ]);

            $lastInsertId = $this->conn->lastInsertId();
            if (!$lastInsertId) {
                throw new Exception("No se pudo obtener el ID de la solicitud.");
            }

            $mensaje = "Solicitud de {$datos['nombre']} para {$datos['servicio']}";
            $sqlNotif = "INSERT INTO notifications (mensaje, area, request_id, leida, fecha)
                     VALUES (?, ?, ?, 0, NOW())";
            $stmtNotif = $this->conn->prepare($sqlNotif);
            $stmtNotif->execute([$mensaje, $datos['area'], $lastInsertId]);

            return $lastInsertId;
        } catch (PDOException $e) {
            echo "Error en registrarSolicitud: " . $e->getMessage();
            return false;
        }
    }


    public function actualizarEstado($id, $estado, $comentario, $medio)
    {
        $sql = "UPDATE requests 
                SET estado = ?, comentario = ?, medio_notificacion = ?
                WHERE id_re = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$estado, $comentario, $medio, $id]);
    }

    public function obtenerTodasPorArea($area, $busqueda = '')
    {
        $sql = "SELECT * FROM requests WHERE area = ?";
        $params = [$area];

        if (!empty($busqueda)) {
            $sql .= " AND (nombre LIKE ? OR empresa LIKE ? OR email LIKE ? OR cc_cliente LIKE ?)";
            $like = "%$busqueda%";
            $params[] = $like;
            $params[] = $like;
            $params[] = $like;
            $params[] = $like; // cc_cliente
        }

        // Destacadas primero y luego por fecha
        $sql .= " ORDER BY destacado_re DESC, fecha_solicitud DESC";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerNotificaciones($area)
    {
        $sql = "SELECT * FROM notifications 
                WHERE area = ? 
                  AND leida = 0 
                  AND fecha >= NOW() - INTERVAL 1 DAY 
                ORDER BY fecha DESC";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$area]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function contarNoLeidas($area)
    {
        $sql = "SELECT COUNT(*) AS total FROM notifications WHERE leida = 0 AND area = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$area]);
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }

    public function marcarLeidas($area)
    {
        $sql = "UPDATE notifications SET leida = 1 WHERE area = ? AND leida = 0";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$area]);
    }

    public function obtenerPorArea($estado, $area, $busqueda = '')
    {
        $sql = "SELECT * FROM requests WHERE estado = ? AND area = ?";
        $params = [$estado, $area];

        if (!empty($busqueda)) {
            $sql .= " AND (nombre LIKE ? OR empresa LIKE ? OR email LIKE ? OR cc_cliente LIKE ?)";
            $like = "%$busqueda%";
            $params[] = $like;
            $params[] = $like;
            $params[] = $like;
            $params[] = $like; // cc_cliente
        }

        $sql .= " ORDER BY destacado_re DESC, fecha_solicitud DESC";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerHistorialNotificaciones($area = null, $desde = null, $hasta = null, $buscar = null, $esAdmin = false)
    {
        $sql = "SELECT n.*, r.nombre, r.email, r.empresa, r.telefono, r.servicio, r.area, r.cc_cliente
                FROM notifications n
                LEFT JOIN requests r ON r.id_re = n.request_id
                WHERE 1";
        $params = [];

        if (!$esAdmin && $area) {
            $sql .= " AND n.area = ?";
            $params[] = $area;
        }
        if ($desde) {
            $sql .= " AND n.fecha >= ?";
            $params[] = $desde;
        }
        if ($hasta) {
            $sql .= " AND n.fecha <= ?";
            $params[] = $hasta;
        }
        if ($buscar) {
            $sql .= " AND (r.nombre LIKE ? OR r.email LIKE ? OR r.servicio LIKE ? OR r.cc_cliente LIKE ?)";
            $like = "%$buscar%";
            $params[] = $like;
            $params[] = $like;
            $params[] = $like;
            $params[] = $like;
        }

        $sql .= " ORDER BY n.fecha DESC";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerTodasLasSolicitudes($estado, $busqueda = '')
    {
        $sql = "SELECT * FROM requests WHERE 1";
        $params = [];

        if ($estado !== 'todas') {
            $sql .= " AND estado = ?";
            $params[] = $estado;
        }

        if (!empty($busqueda)) {
            $sql .= " AND (nombre LIKE ? OR empresa LIKE ? OR email LIKE ? OR cc_cliente LIKE ?)";
            $like = "%$busqueda%";
            $params[] = $like;
            $params[] = $like;
            $params[] = $like;
            $params[] = $like; // cc_cliente
        }

        $sql .= " ORDER BY fecha_solicitud DESC";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerResumenMensual($area = null)
    {
        // Tu tabla maneja estados: pendiente / aceptada / rechazada
        $sql = "SELECT 
                    COUNT(*) AS total,
                    SUM(CASE WHEN area = 'cafe' THEN 1 ELSE 0 END) AS cafe,
                    SUM(CASE WHEN area = 'electronica' THEN 1 ELSE 0 END) AS electronica,
                    SUM(CASE WHEN estado = 'pendiente' THEN 1 ELSE 0 END) AS pendientes,
                    SUM(CASE WHEN estado = 'aceptada'  THEN 1 ELSE 0 END) AS aceptadas,
                    SUM(CASE WHEN estado = 'rechazada' THEN 1 ELSE 0 END) AS rechazadas
                FROM requests
                WHERE MONTH(fecha_solicitud) = MONTH(CURRENT_DATE())
                  AND YEAR(fecha_solicitud) = YEAR(CURRENT_DATE())";

        if ($area) {
            $sql .= " AND area = :area";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':area', $area);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            return $this->conn->query($sql)->fetch(PDO::FETCH_ASSOC);
        }
    }

    public function obtenerUsuarioMasActivo($area = null)
    {
        $sql = "SELECT nombre, COUNT(*) as total 
                FROM requests 
                WHERE MONTH(fecha_solicitud) = MONTH(CURRENT_DATE())
                  AND YEAR(fecha_solicitud) = YEAR(CURRENT_DATE())";

        if ($area) {
            $sql .= " AND area = :area";
        }

        $sql .= " GROUP BY nombre 
                  ORDER BY total DESC 
                  LIMIT 1";

        if ($area) {
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':area', $area);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            return $this->conn->query($sql)->fetch(PDO::FETCH_ASSOC);
        }
    }

    public function obtenerSolicitudesPorCedula($cc_cliente, $area = null)
    {
        $sql = "SELECT * FROM requests WHERE cc_cliente = ?";
        $params = [$cc_cliente];

        if ($area) {
            $sql .= " AND area = ?";
            $params[] = $area;
        }

        $sql .= " ORDER BY fecha_solicitud DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

class ArchivoModel
{
    private $conn;

    public function __construct()
    {
        $this->conn = conectaDb();
    }
    public function guardar($nombre, $ruta, $tipo, $ext, $origen)
    {
        $sql = "INSERT INTO archivos (name_ar, ruta_ar, type_ar, extension_ar, origen_ar) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$nombre, $ruta, $tipo, $ext, $origen]);
    }

    // Obtener archivos según su origen (subproceso)
    public function obtenerPorOrigen($origen)
    {
        $sql = "SELECT * FROM archivos WHERE origen_ar = ? AND deleted_ar = 0 ORDER BY Date_Subi_ar DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$origen]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function buscarSubprocesoPorRuta($ruta, $idProceso)
    {
        $stmt = $this->conn->prepare("SELECT * FROM gestion_subprocesos WHERE ruta_sub = ? AND id_proceso = ?");
        $stmt->execute([$ruta, $idProceso]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    // Eliminar (lógico + físico)
    public function eliminar($id)
    {
        $stmt = $this->conn->prepare("SELECT ruta_ar FROM archivos WHERE id_ar = ?");
        $stmt->execute([$id]);
        $archivo = $stmt->fetch();

        if ($archivo && file_exists(__DIR__ . '/../' . $archivo['ruta_ar'])) {
            unlink(__DIR__ . '/../' . $archivo['ruta_ar']); // Elimina el archivo físico
        }

        $stmt = $this->conn->prepare("UPDATE archivos SET deleted_ar = 1 WHERE id_ar = ?");
        $stmt->execute([$id]);
    }
}

class VersionModel
{
    private $conn;

    public function __construct()
    {
        $this->conn = conectaDb(); // Debe devolver instancia PDO
    }

    public function getProcesosConVersiones()
    {
        $procesos = [];
        $sql = "SELECT * FROM table_vers";
        $stmt = $this->conn->query($sql);

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $row['versiones'] = $this->getVersionesPorProceso($row['id_ta']);
            $procesos[] = $row;
        }
        return $procesos;
    }

    public function getVersionesPorProceso($idProceso)
    {
        $sql = "SELECT * FROM versiones WHERE id_table_vr = ? AND estado_vr = 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$idProceso]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function crearProceso($nombre)
    {
        $sql = "INSERT INTO table_vers (name_ta) VALUES (?)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$nombre]);
    }

    public function insertarVersion($id_proceso, $codigo, $nombreArchivo, $version, $anio, $ruta)
    {
        $sql = "INSERT INTO versiones 
                (id_table_vr, codigo_vr, name_archive, version_vr, year_vr, ruta_archivo_vr) 
                VALUES 
                (:id_table_vr, :codigo, :name_archive, :version_vr, :year_vr, :ruta_archivo_vr)";
        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            ':id_table_vr' => $id_proceso,
            ':codigo' => $codigo,
            ':name_archive' => $nombreArchivo,
            ':version_vr' => $version,
            ':year_vr' => $anio,
            ':ruta_archivo_vr' => $ruta
        ]);
    }

    public function obtenerRutaArchivo($id_version)
    {
        $stmt = $this->conn->prepare("SELECT ruta_archivo_vr FROM versiones WHERE id_vers = ?");
        $stmt->execute([$id_version]);
        return $stmt->fetchColumn();
    }

    public function obtenerArchivosPorProceso($id_proceso)
    {
        $stmt = $this->conn->prepare("SELECT ruta_archivo_vr FROM versiones WHERE id_table_vr = ?");
        $stmt->execute([$id_proceso]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function eliminarVersion($id_vr)
    {
        $stmt = $this->conn->prepare("SELECT ruta_archivo_vr FROM versiones WHERE id_vers = ?");
        $stmt->execute([$id_vr]);
        $archivo = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($archivo) {
            $ruta = '../' . $archivo['ruta_archivo_vr'];
            if (file_exists($ruta)) {
                unlink($ruta);
            }
        }

        $stmt = $this->conn->prepare("DELETE FROM versiones WHERE id_vers = ?");
        return $stmt->execute([$id_vr]);
    }

    public function eliminarProceso($id_proceso)
    {
        $stmt1 = $this->conn->prepare("SELECT ruta_archivo_vr FROM versiones WHERE id_table_vr = :id");
        $stmt1->execute([':id' => $id_proceso]);
        $archivos = $stmt1->fetchAll(PDO::FETCH_ASSOC);

        foreach ($archivos as $archivo) {
            $ruta = '../' . $archivo['ruta_archivo_vr'];
            if (file_exists($ruta)) {
                unlink($ruta);
            }
        }

        $stmt2 = $this->conn->prepare("DELETE FROM versiones WHERE id_table_vr = :id");
        $stmt2->execute([':id' => $id_proceso]);

        $stmt3 = $this->conn->prepare("DELETE FROM table_vers WHERE id_ta = :id");
        return $stmt3->execute([':id' => $id_proceso]);
    }

    public function getVersionesArchivadas()
    {
        $sql = "SELECT v.*, t.name_ta 
                FROM versiones v 
                JOIN table_vers t ON v.id_table_vr = t.id_ta 
                WHERE v.estado_vr = 0 
                ORDER BY v.year_vr DESC, t.name_ta";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function archivarVersion($id)
    {
        $sql = "UPDATE versiones SET estado_vr = 0 WHERE id_vers = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$id]);
    }

    public function restaurarVersion($id)
    {
        $sql = "UPDATE versiones SET estado_vr = 1 WHERE id_vers = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$id]);
    }
}

class GestionModel
{

    private $conn;

    public function __construct()
    {
        $this->conn = conectaDb();
    }

    public function obtenerBotones()
    {
        $sql = "SELECT * FROM gestion_botones ORDER BY id_ges DESC";
        return $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function crearBoton($nombre, $ruta, $color)
    {
        $sql = "INSERT INTO gestion_botones (name_but, ruta_but, color_but) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$nombre, $ruta, $color]);
    }

    public function obtenerPorId($id_ges)
    {
        $stmt = $this->conn->prepare("SELECT * FROM gestion_botones WHERE id_ges = ?");
        $stmt->execute([$id_ges]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function actualizar($id_ges, $data)
    {
        $stmt = $this->conn->prepare("UPDATE gestion_botones SET name_but = ?, ruta_but = ?, color_but = ? WHERE id_ges = ?");
        return $stmt->execute([
            $data['nombre'],
            $data['ruta'],
            $data['color'],
            $id_ges
        ]);
    }

    public function eliminarBoton($id_ges)
    {
        // Eliminar todos los subprocesos del proceso
        $stmt1 = $this->conn->prepare("DELETE FROM gestion_subprocesos WHERE id_proceso = ?");
        $stmt1->execute([$id_ges]);

        // Luego eliminar el proceso
        $stmt2 = $this->conn->prepare("DELETE FROM gestion_botones WHERE id_ges = ?");
        return $stmt2->execute([$id_ges]);
    }


    // subprocesos
    public function insertar($subname, $ruta_sub, $idProceso, $archivo_padre = null)
    {
        $sql = $this->conn->prepare("
            INSERT INTO gestion_subprocesos 
            (nombre_sub, ruta_sub, id_proceso, Pro_padre)
            VALUES ( ?, ?, ?, ?)
        ");
        return $sql->execute([$subname, $ruta_sub, $idProceso, $archivo_padre]);
    }

    public function obtenerPorProceso($idProceso)
    {
        $sql = $this->conn->prepare("SELECT * FROM gestion_subprocesos WHERE id_proceso = ?");
        $sql->execute([$idProceso]);
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerPorArchivoPadre($archivo)
    {
        $sql = $this->conn->prepare("SELECT * FROM gestion_subprocesos WHERE Pro_padre = ?");
        $sql->execute([$archivo]);
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function eliminarsub($id_sub)
    {
        // Primero obtenemos la ruta del archivo
        $stmt = $this->conn->prepare("SELECT ruta_sub FROM gestion_subprocesos WHERE id_sub = ?");
        $stmt->execute([$id_sub]);
        $sub = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($sub) {
            $rutaArchivo = '../views/procesos/sub/' . $sub['ruta_sub'] . '.php';
            if (file_exists($rutaArchivo)) {
                unlink($rutaArchivo); // Elimina el archivo físico
            }

            // Luego eliminamos el registro de la base de datos
            $sql = $this->conn->prepare("DELETE FROM gestion_subprocesos WHERE id_sub = ?");
            return $sql->execute([$id_sub]);
        }

        return false;
    }

    public function obtenerSubprocesoPorId($id_sub)
    {
        $stmt = $this->conn->prepare("SELECT * FROM gestion_subprocesos WHERE id_sub = ?");
        $stmt->execute([$id_sub]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

class ServicioElectronicaModel
{
    private $conn;

    public function __construct()
    {
        require_once __DIR__ . '/../conexion/conexion.php';
        $this->conn = conectaDb();
    }

    public function obtenerServicios($id = null)
    {
        if ($id) {
            $sql = "SELECT * FROM servi_elect WHERE id_ele = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
        // Si no hay ID, retorna todos
        $sql = "SELECT * FROM servi_elect";
        return $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }


    public function crearServicio($data)
    {
        $sql = "INSERT INTO servi_elect (titulo, descripcion_corta, descripcion_larga, precio, icono_ele) 
                VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            $data['titulo'],
            $data['descripcion_corta'],
            $data['descripcion_larga'],
            $data['precio'],
            $data['icono_ele']
        ]);
    }

    public function obtenerPorId($id_ele)
    {
        $stmt = $this->conn->prepare("SELECT * FROM servi_elect WHERE id_ele = ?");
        $stmt->execute([$id_ele]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function actualizarServicio($id_ele, $data)
    {
        $sql = "UPDATE servi_elect SET titulo = ?, descripcion_corta = ?, descripcion_larga = ?, precio = ?, icono_ele = ? WHERE id_ele = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            $data['titulo'],
            $data['descripcion_corta'],
            $data['descripcion_larga'],
            $data['precio'],
            $data['icono_ele'],
            $id_ele
        ]);
    }

    public function eliminarServicio($id_ele)
    {
        $stmt = $this->conn->prepare("DELETE FROM servi_elect WHERE id_ele = ?");
        return $stmt->execute([$id_ele]);
    }
}

class ServicioCafeModel
{
    private $conn;

    public function __construct()
    {
        require_once __DIR__ . '/../conexion/conexion.php';
        $this->conn = conectaDb();
    }

    public function obtenerServi()
    {
        $stmt = $this->conn->query("SELECT * FROM servi_cafe ORDER BY date_creation DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function crearServi($data)
    {
        $sql = "INSERT INTO servi_cafe (titulo_ca, des_corta, des_larga, precio_ca, icono_ca) 
                VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            $data['titulo_ca'],
            $data['des_corta'],
            $data['des_larga'],
            $data['precio_ca'],
            $data['icono_ca']
        ]);
    }

    public function obtenerCafeId($id_ca)
    {
        $stmt = $this->conn->prepare("SELECT * FROM servi_cafe WHERE id_ca = ?");
        $stmt->execute([$id_ca]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function actualizarServi($id_ca, $data)
    {
        // Si no se subió un nuevo icono, no actualizar ese campo
        if (empty($data['icono_ca'])) {
            $sql = "UPDATE servi_cafe 
                    SET titulo_ca = ?, des_corta = ?, des_larga = ?, precio_ca = ? 
                    WHERE id_ca = ?";
            $stmt = $this->conn->prepare($sql);
            return $stmt->execute([
                $data['titulo_ca'],
                $data['des_corta'],
                $data['des_larga'],
                $data['precio_ca'],
                $id_ca
            ]);
        } else {
            $sql = "UPDATE servi_cafe 
                    SET titulo_ca = ?, des_corta = ?, des_larga = ?, precio_ca = ?, icono_ca = ? 
                    WHERE id_ca = ?";
            $stmt = $this->conn->prepare($sql);
            return $stmt->execute([
                $data['titulo_ca'],
                $data['des_corta'],
                $data['des_larga'],
                $data['precio_ca'],
                $data['icono_ca'],
                $id_ca
            ]);
        }
    }

    public function eliminarServi($id_ca)
    {
        $stmt = $this->conn->prepare("DELETE FROM servi_cafe WHERE id_ca = ?");
        return $stmt->execute([$id_ca]);
    }
}

class CarruselModel
{
    private $conn;

    public function __construct()
    {
        $this->conn = conectaDb();
    }
    public function obtenerUltimoId()
    {
        $sql = "SELECT MAX(id_car) AS max_id FROM carrusel";
        $stmt = $this->conn->query($sql);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row && $row['max_id'] ? (int) $row['max_id'] : 0;
    }

    public function obtenerImagenes()
    {
        $sql = "SELECT * FROM carrusel ORDER BY id_car DESC";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function agregarImagen($titulo, $ruta)
    {
        $sql = "INSERT INTO carrusel (name_img_c, title_carr) VALUES (?, ?)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$titulo, $ruta]);
    }



    public function obtenerImagenPorId($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM carrusel WHERE id_car = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function eliminarImagen($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM carrusel WHERE id_car = ?");
        return $stmt->execute([$id]);
    }
}

class VideoModel
{
    private $conn;

    public function __construct()
    {
        $this->conn = conectaDb();
    }

    public function obtenerVideoPorArea($area)
    {
        $stmt = $this->conn->prepare("SELECT * FROM videos_lab WHERE area_vid = ? LIMIT 1");
        $stmt->execute([$area]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function actualizarVideo($area, $nombreArchivo, $titulo, $texto1, $texto2)
    {
        $videoExistente = $this->obtenerVideoPorArea($area);
        if ($videoExistente) {
            $stmt = $this->conn->prepare("UPDATE videos_lab SET ruta_video=?, title_vid=?, text_pri=?, text_sec=? WHERE area_vid=?");
            return $stmt->execute([$nombreArchivo, $titulo, $texto1, $texto2, $area]);
        } else {
            $stmt = $this->conn->prepare("INSERT INTO videos_lab (ruta_video, title_vid, text_pri, text_sec, area_vid) VALUES (?, ?, ?, ?, ?)");
            return $stmt->execute([$nombreArchivo, $titulo, $texto1, $texto2, $area]);
        }
    }

    public function eliminarVideoPorArea($area)
    {
        $stmt = $this->conn->prepare("DELETE FROM videos_lab WHERE area_vid = ?");
        return $stmt->execute([$area]);
    }
}

class PortadaModel
{
    private $conn;

    public function __construct()
    {
        $this->conn = conectaDb(); 
    }

    public function obtenerPortadaPorArea($area)
    {
        $stmt = $this->conn->prepare("SELECT * FROM portadas_lab WHERE area_port = ? LIMIT 1");
        $stmt->execute([$area]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function actualizarPortada($area, $ruta, $titulo, $descripcion)
    {
        $portada = $this->obtenerPortadaPorArea($area);

        if ($portada) {
            $stmt = $this->conn->prepare("UPDATE portadas_lab SET ruta_img_port=?, title_port=?, desc_port=? WHERE area_port=?");
            return $stmt->execute([$ruta, $titulo, $descripcion, $area]);
        } else {
            $stmt = $this->conn->prepare("INSERT INTO portadas_lab (ruta_img_port, title_port, desc_port, area_port) VALUES (?, ?, ?, ?)");
            return $stmt->execute([$ruta, $titulo, $descripcion, $area]);
        }
    }

    public function eliminarPortadaPorArea($area)
    {
        $stmt = $this->conn->prepare("DELETE FROM portadas_lab WHERE area_port = ?");
        return $stmt->execute([$area]);
    }
    public function obtenerTodasLasPortadas()
    {
        $stmt = $this->conn->prepare("SELECT * FROM portadas_lab ORDER BY area_port");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}