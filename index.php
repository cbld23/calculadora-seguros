<?php
session_start();
$progreso = 0;
$stepAnterior = null;
$stepSiguiente = 'steps/step2.php'; // Definimos paso siguiente

$fecha_actual = date('Y-m-d');

// Guardar fecha si viene por POST
if (!empty($_POST['fecha_inicio'])) {
    $_SESSION['fecha_inicio'] = $_POST['fecha_inicio'];
    header('Location: ' . $stepSiguiente);
    exit;
}

require_once __DIR__ . '/includes/header.php';
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <link rel="stylesheet" href="assets/css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>

    <div class="progress-container-custom">
        <?php if ($stepAnterior): ?>
        <a href="<?= $stepAnterior ?>" class="flecha">&#8592;</a>
        <?php else: ?>
        <span class="flecha desactivada">&#8592;</span>
        <?php endif; ?>

        <div class="progress-bar-custom">
            <div class="progress-custom" style="width: <?= $progreso ?>%;"></div>
        </div>

        <?php if (isset($_SESSION['fecha_inicio'])): ?>
        <a href="<?= $stepSiguiente ?>" class="flecha">&#8594;</a>
        <?php else: ?>
        <span class="flecha desactivada">&#8594;</span>
        <?php endif; ?>
    </div>

    <div class="container">
        <h1>¿Cuándo te gustaría empezar a disfrutar del seguro?</h1>
        <form action="" method="POST" class="form_container">
            <input type="date" name="fecha_inicio" class="input_generic" min="<?= $fecha_actual ?>" required
                value="<?= isset($_SESSION['fecha_inicio']) ? htmlspecialchars($_SESSION['fecha_inicio']) : '' ?>">
            <button type="submit">Siguiente</button>
        </form>
    </div>

    <?php require_once __DIR__ . '/includes/footer.php'; ?>
</body>

</html>