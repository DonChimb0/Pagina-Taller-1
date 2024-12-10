<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Equipo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Editar Equipo</h1>
        <?php
        require 'config\db.php';
        $id = $_GET['id'];
        $result = $conn->query("SELECT * FROM mantenimiento WHERE id = $id");
        $row = $result->fetch_assoc();
        ?>
        <form action="update.php" method="POST">
            <input type="hidden" name="id" value="<?= $row['id'] ?>">
            <div class="mb-3">
                <label for="nombre_equipo" class="form-label">Nombre del Equipo</label>
                <input type="text" class="form-control" name="nombre_equipo" value="<?= $row['nombre_equipo'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="tipo_mantenimiento" class="form-label">Tipo de Mantenimiento</label>
                <input type="text" class="form-control" name="tipo_mantenimiento" value="<?= $row['tipo_mantenimiento'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="responsable" class="form-label">Responsable</label>
                <input type="text" class="form-control" name="responsable" value="<?= $row['responsable'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="fecha_ultimo" class="form-label">Fecha Último Mantenimiento</label>
                <input type="date" class="form-control" name="fecha_ultimo" value="<?= $row['fecha_ultimo'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="fecha_proximo" class="form-label">Fecha Próximo Mantenimiento</label>
                <input type="date" class="form-control" name="fecha_proximo" value="<?= $row['fecha_proximo'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="observaciones" class="form-label">Observaciones</label>
                <textarea class="form-control" name="observaciones" rows="3"><?= $row['observaciones'] ?></textarea>
            </div>
            <button type="submit" class="btn btn-success">Actualizar</button>
            <a href="index.php" class="btn btn-secondary">Volver</a>
        </form>
    </div>
</body>
</html>
