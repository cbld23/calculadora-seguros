<?php
session_start();

if (!isset($_SESSION['dental'])) {
  header('Location: step5.php');
  exit;
}

$progreso = 70;
$stepAnterior = "step5.php";
$stepSiguiente = null; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST['cliente_mapfre'])) {
    $_SESSION['cliente_mapfre'] = $_POST['cliente_mapfre'];

    
    if ($_POST['cliente_mapfre'] === 'si') {
      header('Location: step6-1.php'); // Si es cliente, pedir documento
    } else {
      header('Location: step7.php');   // Si no es cliente, pasar al siguiente
    }
    exit;
  }
}

require_once __DIR__ . '/../includes/header.php';
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <link rel="stylesheet" href="../assets/css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body class="noOverflow">

    <div class="progress-container-custom">
        <a href="<?= $stepAnterior ?>" class="flecha">&#8592;</a>

        <div class="progress-bar-custom">
            <div class="progress-custom" style="width: <?= $progreso ?>%;"></div>
        </div>

        <?php if (isset($_SESSION['cliente_mapfre']) && !empty($_SESSION['cliente_mapfre'])): ?>
        <a href="step7.php" class="flecha">&#8594;</a>
        <?php else: ?>
        <span class="flecha desactivada">&#8594;</span>
        <?php endif; ?>

    </div>

    <div class="container">
        <h1>¿Tienes algún seguro contratado en Muvraline?</h1>

        <form action="" method="POST">
            <select class="input_generic" name="cliente_mapfre" required>
                <option value="">Seleccionar...</option>
                <option value="si"
                    <?= (isset($_SESSION['cliente_mapfre']) && $_SESSION['cliente_mapfre'] == 'si') ? 'selected' : '' ?>>
                    Sí</option>
                <option value="no"
                    <?= (isset($_SESSION['cliente_mapfre']) && $_SESSION['cliente_mapfre'] == 'no') ? 'selected' : '' ?>>
                    No</option>
            </select>

            <button type="submit">Siguiente</button>
        </form>
    </div>

    <?php require_once __DIR__ . '/../includes/footer.php'; ?>
</body>

</html>