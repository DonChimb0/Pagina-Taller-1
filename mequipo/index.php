<?php
require 'clases/EquipoMantenimiento.php';

// Mostrar errores para depuración
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Crear instancia de la clase EquipoMantenimiento
$equipoMantenimiento = new EquipoMantenimiento('localhost', 'root', '', 'mequipo');

// Procesar la eliminación
if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
    $id = intval($_GET['id']); // Convertir el ID a un entero para mayor seguridad
    if ($equipoMantenimiento->delete($id)) {
        echo "<script>
            Swal.fire({
                title: 'Eliminado',
                text: 'El registro ha sido eliminado correctamente.',
                icon: 'success'
            }).then(() => {
                window.location = 'index.php'; // Redirigir a la página inicial
            });
        </script>";
        exit;  // Aseguramos que el script no siga ejecutándose después de la eliminación
    } else {
        echo "<script>
            Swal.fire({
                title: 'Error',
                text: 'No se pudo eliminar el registro.',
                icon: 'error'
            });
        </script>";
        exit;  // Aseguramos que el script no siga ejecutándose después de un error
    }
}

// Obtener todos los registros
$equipos = $equipoMantenimiento->readAll();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mantenimiento de Equipos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Control de Mantenimiento</h1>
        <a href="create.php" class="btn btn-primary mb-3">Añadir Equipo</a>
        <table class="table table-striped">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Equipo</th>
                    <th>Tipo</th>
                    <th>Responsable</th>
                    <th>Última Fecha</th>
                    <th>Próxima Fecha</th>
                    <th>Observaciones</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($equipos) > 0): ?>
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
                <?php else: ?>
                    <tr>
                        <td colspan="8" class="text-center">No hay registros disponibles</td>
                    </tr>
                <?php endif; ?>
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
                    window.location.href = `index.php?action=delete&id=${id}`;
                }
            });
        }
    </script>
</body>
</html>
