<?php
require 'config\db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $nombre_equipo = $_POST['nombre_equipo'];
    $tipo_mantenimiento = $_POST['tipo_mantenimiento'];
    $responsable = $_POST['responsable'];
    $fecha_ultimo = $_POST['fecha_ultimo'];
    $fecha_proximo = $_POST['fecha_proximo'];
    $observaciones = $_POST['observaciones'];

    $sql = "UPDATE mantenimiento 
            SET nombre_equipo = '$nombre_equipo', 
                tipo_mantenimiento = '$tipo_mantenimiento', 
                responsable = '$responsable', 
                fecha_ultimo = '$fecha_ultimo', 
                fecha_proximo = '$fecha_proximo', 
                observaciones = '$observaciones' 
            WHERE id = $id";
    $conn->query($sql);

    header('Location: index.php');
}
