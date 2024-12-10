<?php
require 'config\db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre_equipo = $_POST['nombre_equipo'];
    $tipo_mantenimiento = $_POST['tipo_mantenimiento'];
    $responsable = $_POST['responsable'];
    $fecha_ultimo = $_POST['fecha_ultimo'];
    $fecha_proximo = $_POST['fecha_proximo'];
    $observaciones = $_POST['observaciones'];

    $sql = "INSERT INTO mantenimiento (nombre_equipo, tipo_mantenimiento, responsable, fecha_ultimo, fecha_proximo, observaciones) 
            VALUES ('$nombre_equipo', '$tipo_mantenimiento', '$responsable', '$fecha_ultimo', '$fecha_proximo', '$observaciones')";
    $conn->query($sql);

    header('Location: index.php');
}
