<?php

require 'clases/EquipoMantenimiento.php';

// Crear instancia de la clase
$equipoMantenimiento = new EquipoMantenimiento('localhost', 'root', '', 'mequipo');

// Eliminar un equipo
if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
    $id = $_GET['id']; // Obtener el ID del equipo a eliminar
    $equipoMantenimiento->delete($id);

    // Mostrar el mensaje con SweetAlert2 y redirigir a index.php
    echo "<script>
        Swal.fire({
            title: '¡Éxito!',
            text: 'El registro ha sido borrado exitosamente.',
            icon: 'success'
        }).then(() => {
            window.location = 'index.php'; // Redirigir a index.php después del mensaje
        });
    </script>";
    exit; // Salir del script después de la eliminación y redirección
}

// Leer todos los registros
$equipos = $equipoMantenimiento->readAll();

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Control de Mantenimiento de Equipos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <div class="container mt-5">
        <h1>Control de Mantenimiento de Equipos</h1>

        <a href="create.php" class="btn btn-primary mb-3">Añadir Nuevo Equipo</a>

        <table class="table table-striped">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Equipo</th>
                    <th>Tipo de Mantenimiento</th>
                    <th>Responsable</th>
                    <th>Última Fecha</th>
                    <th>Próxima Fecha</th>
                    <th>Observaciones</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($equipos as $equipo): ?>
                    <tr>
                        <td><?= $equipo['id'] ?></td>
                        <td><?= htmlspecialchars($equipo['nombre_equipo']) ?></td>
                        <td><?= htmlspecialchars($equipo['tipo_mantenimiento']) ?></td>
                        <td><?= htmlspecialchars($equipo['responsable']) ?></td>
                        <td><?= htmlspecialchars($equipo['fecha_ultimo']) ?></td>
                        <td><?= htmlspecialchars($equipo['fecha_proximo']) ?></td>
                        <td><?= htmlspecialchars($equipo['observaciones']) ?></td>
                        <td>
                            <a href="edit.php?id=<?= $equipo['id'] ?>" class="btn btn-warning btn-sm">Editar</a>
                            <button class="btn btn-danger btn-sm" onclick="confirmDelete(<?= $equipo['id'] ?>)">Eliminar</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script>
        // Función para confirmar la eliminación con SweetAlert2
        function confirmDelete(id) {
            Swal.fire({
                title: '¿Estás seguro?',
                text: "¡No podrás revertir esta acción!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = `index.php?action=delete&id=${id}`; // Realiza la eliminación
                }
            });
        }
    </script>
</body>
</html>
