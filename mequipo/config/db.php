<?php
$host = 'localhost';
$user = 'root'; // Cambia esto si tu usuario es diferente
$password = ''; // Agrega tu contraseña si es necesario
$db = 'mequipo';

$conn = new mysqli($host, $user, $password, $db);

if ($conn->connect_error) {
    die('Error de conexión: ' . $conn->connect_error);
}
