<?php
session_start();

// Verificar que los pasos anteriores se hayan completado
if (!isset($_SESSION['fecha_inicio']) || !isset($_SESSION['codigo_postal'])) {
  header('Location: ../index.php');
  exit;
}

$progreso = 30;
$stepAnterior = "step2.php";
$stepSiguiente = "step4.php";

// Si se ha seleccionado el número de asegurados, lo guardamos en la sesión
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['numero_asegurados'])) {
  // Guardar el número de asegurados en la sesión
  $_SESSION['numero_asegurados'] = $_POST['numero_asegurados'];

  // Verificar que la sesión se ha actualizado correctamente
  var_dump($_SESSION['numero_asegurados']);  // Esto nos ayudará a confirmar si el valor se guarda

  // Redirigir a step4.php después de guardar el número de asegurados
  header('Location: step4.php');
  exit;
}

require_once __DIR__ . '/../includes/header.php';
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <link rel="stylesheet" href="../assets/css/style.css">
    <script src="../assets/js/script.js" defer></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body class="step3">
    <div class="progress-container-custom">
        <a href="<?= $stepAnterior ?>" class="flecha">&#8592;</a>

        <div class="progress-bar-custom">
            <div class="progress-custom" style="width: <?= $progreso ?>%;"></div>
        </div>

        <?php if (isset($_SESSION['numero_asegurados'])): ?>
        <a href="<?= $stepSiguiente ?>" class="flecha">&#8594;</a>
        <?php else: ?>
        <span class="flecha desactivada">&#8594;</span>
        <?php endif; ?>

    </div>

    <div class="titulo-centrado">
        <h1>Número de Asegurados</h1>
        <button onclick="openModal()" class="info-icon">
            ℹ️
        </button>
    </div>

    <!-- Cambiar el action del formulario para que apunte al mismo archivo (step3.php) -->
    <form action="step3.php" method="POST">
        <div class="numero-asegurados">
            <?php
      $seleccionado = $_SESSION['numero_asegurados'] ?? null;
      for ($i = 1; $i <= 9; $i++):
        $clase = ($seleccionado == $i) ? 'seleccionado' : '';
      ?>
            <button type="submit" name="numero_asegurados" value="<?= $i ?>"
                class="btn-asegurado <?= $clase ?>"><?= $i ?></button>
            <?php endfor; ?>
        </div>

        <input type="hidden" name="fecha_inicio" value="<?= $_SESSION['fecha_inicio'] ?? '' ?>">
        <input type="hidden" name="codigo_postal" value="<?= $_SESSION['codigo_postal'] ?? '' ?>">
    </form>

    <!-- Modal -->
    <div id="infoModal" class="modal">
        <div class="modal-content">
            <span class="close-modal" onclick="closeModal()">&times;</span>
            <h2>Número de asegurados</h2>
            <p>Todos los asegurados deben convivir en el mismo domicilio que el asegurado titular.</p>
        </div>
    </div>

    <?php require_once __DIR__ . '/../includes/footer.php'; ?>
</body>

</html>