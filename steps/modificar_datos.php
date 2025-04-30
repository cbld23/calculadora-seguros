<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Modificar datos</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="container py-5">
    <h3 class="text-center mb-4">Modificar tus datos</h3>
    <form action="step7.php" method="POST" class="row g-3">
        <div class="col-md-6">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="<?= $_SESSION['nombre'] ?? '' ?>" required>
        </div>
        <div class="col-md-6">
            <label for="telefono" class="form-label">Teléfono</label>
            <input type="tel" class="form-control" id="telefono" name="telefono" value="<?= $_SESSION['telefono'] ?? '' ?>" required>
        </div>
        <div class="col-md-6">
            <label for="email" class="form-label">Correo electrónico</label>
            <input type="email" class="form-control" id="email" name="email" value="<?= $_SESSION['email'] ?? '' ?>" required>
        </div>
        <div class="col-md-6">
            <label for="codigo_postal" class="form-label">Código Postal</label>
            <input type="text" class="form-control" id="codigo_postal" name="codigo_postal" value="<?= $_SESSION['codigo_postal'] ?? '' ?>" required>
        </div>
        <div class="text-center mt-4">
            <button type="submit" class="btn btn-success">Actualizar y volver</button>
        </div>
    </form>
</body>

</html>