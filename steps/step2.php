<?php
session_start();

if (!isset($_SESSION['fecha_inicio'])) {
  header('Location: ../index.php');
  exit;
}

$progreso = 20;
$stepAnterior = "../index.php";
$stepSiguiente = null;

if (!empty($_POST['codigo_postal'])) {
  $_SESSION['codigo_postal'] = $_POST['codigo_postal'];
  header('Location: step3.php');
  exit;
}

require_once __DIR__ . '/../includes/header.php';
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <link rel="stylesheet" href="../assets/css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>

    <div class="progress-container-custom">
        <a href="<?= $stepAnterior ?>" class="flecha">&#8592;</a>

        <div class="progress-bar-custom">
            <div class="progress-custom" style="width: <?= $progreso ?>%;"></div>
        </div>

        <?php if (isset($_SESSION['codigo_postal'])): ?>
        <a href="step3.php" class="flecha">&#8594;</a>
        <?php else: ?>
        <span class="flecha desactivada">&#8594;</span>
        <?php endif; ?>

    </div>

    <div class="container">
        <h1>Introduce tu código postal</h1>
        <form action="" method="POST">
            <input type="text" name="codigo_postal" class="input_generic"
                value="<?= $_SESSION['codigo_postal'] ?? '' ?>" required>
            <button type="submit">Siguiente</button>
        </form>
    </div>

    <?php require_once __DIR__ . '/../includes/footer.php'; ?>
</body>

</html>