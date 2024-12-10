<?php

class EquipoMantenimiento {
    public $pdo;

    // Constructor: Inicializa la conexión con la base de datos
    public function __construct($host, $user, $password, $dbname) {
        try {
            $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
            $this->pdo = new PDO($dsn, $user, $password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Error al conectar con la base de datos: " . $e->getMessage());
        }
    }

    // Crear un nuevo equipo de mantenimiento
    public function create($nombre_equipo, $tipo_mantenimiento, $responsable, $fecha_ultimo, $fecha_proximo, $observaciones) {
        $sql = "INSERT INTO mantenimiento (nombre_equipo, tipo_mantenimiento, responsable, fecha_ultimo, fecha_proximo, observaciones) 
                VALUES (:nombre_equipo, :tipo_mantenimiento, :responsable, :fecha_ultimo, :fecha_proximo, :observaciones)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute(params: [
            ':nombre_equipo' => htmlspecialchars($nombre_equipo),
            ':tipo_mantenimiento' => htmlspecialchars($tipo_mantenimiento),
            ':responsable' => htmlspecialchars($responsable),
            ':fecha_ultimo' => $fecha_ultimo,
            ':fecha_proximo' => $fecha_proximo,
            ':observaciones' => htmlspecialchars($observaciones),
        ]);
    }

    // Leer todos los equipos de mantenimiento
    public function readAll() {
        $sql = "SELECT * FROM mantenimiento";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Leer un equipo específico por ID
    public function read($id) {
        $sql = "SELECT * FROM mantenimiento WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Actualizar un equipo de mantenimiento
    public function update($id, $nombre_equipo, $tipo_mantenimiento, $responsable, $fecha_ultimo, $fecha_proximo, $observaciones) {
        $sql = "UPDATE mantenimiento 
                SET nombre_equipo = :nombre_equipo, 
                    tipo_mantenimiento = :tipo_mantenimiento, 
                    responsable = :responsable, 
                    fecha_ultimo = :fecha_ultimo, 
                    fecha_proximo = :fecha_proximo, 
                    observaciones = :observaciones 
                WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':id' => $id,
            ':nombre_equipo' => htmlspecialchars($nombre_equipo),
            ':tipo_mantenimiento' => htmlspecialchars($tipo_mantenimiento),
            ':responsable' => htmlspecialchars($responsable),
            ':fecha_ultimo' => $fecha_ultimo,
            ':fecha_proximo' => $fecha_proximo,
            ':observaciones' => htmlspecialchars($observaciones),
        ]);
    }

    public function delete($id) {
        $sql = "DELETE FROM mantenimiento WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    
        // Redirigir a index.php después de la eliminación
        header('Location: index.php');
        exit; // Importante para evitar que se ejecute código adicional
    }
    

    // Verificar si un ID existe en la base de datos
    public function exists($id) {
        $sql = "SELECT COUNT(*) FROM mantenimiento WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetchColumn() > 0;
    }
}
