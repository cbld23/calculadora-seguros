<?php
session_start();

if (!isset($_SESSION['cliente_mapfre'])) {
    header('Location: step6.php');
    exit;
}

$progreso = 90;
$stepAnterior = "step6-1.php";
$stepSiguiente = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['nombre']) && !empty($_POST['telefono']) && !empty($_POST['email']) && isset($_POST['acepto_politica'])) {
        $_SESSION['nombre'] = $_POST['nombre'];
        $_SESSION['telefono'] = $_POST['telefono'];
        $_SESSION['email'] = $_POST['email'];
        $_SESSION['informacion_productos'] = isset($_POST['informacion_productos']) ? 1 : 0;
        $_SESSION['acepto_politica'] = 1;

        header('Location: resultados.php');
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="progress-container-custom">
        <a href="<?= $stepAnterior ?>" class="flecha">&#8592;</a>
        <div class="progress-bar-custom">
            <div class="progress-custom" style="width: <?= $progreso ?>%;"></div>
        </div>
        <span class="flecha desactivada">&#8594;</span>
    </div>

    <div class="container mt-5">
        <h1 class="text-center">¡Ya casi hemos terminado!</h1> <!-- Centrar título -->
        <p class="text-center">Si lo deseas, indícanos los siguientes datos, por si fuera necesario contactar contigo:</p> <!-- Centrar texto -->

        <div class="d-flex justify-content-center"> <!-- Centramos el form -->
            <form method="POST" class="row g-3 col-md-6"> <!-- Form más pequeño -->

                <div class="col-12">
                    <input
                        type="text"
                        name="nombre"
                        class="form-control"
                        placeholder="Nombre y Apellidos"
                        required
                        value="<?= isset($_SESSION['nombre']) ? htmlspecialchars($_SESSION['nombre']) : '' ?>">
                </div>

                <div class="col-12">
                    <input
                        type="tel"
                        name="telefono"
                        class="form-control"
                        placeholder="Teléfono móvil"
                        required
                        value="<?= isset($_SESSION['telefono']) ? htmlspecialchars($_SESSION['telefono']) : '' ?>">
                </div>

                <div class="col-12">
                    <input
                        type="email"
                        name="email"
                        class="form-control"
                        placeholder="Correo electrónico"
                        required
                        value="<?= isset($_SESSION['email']) ? htmlspecialchars($_SESSION['email']) : '' ?>">
                </div>

                <div class="col-12">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="informacion_productos" id="informacion_productos">
                        <label class="form-check-label" for="informacion_productos">
                            Quiero recibir información sobre productos y ofertas que me puedan beneficiar.
                        </label>
                    </div>
                </div>

                <div class="col-12">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="acepto_politica" id="acepto_politica" required>
                        <label class="form-check-label" for="acepto_politica">
                            He leído y acepto la <a href="#">Política de Privacidad</a>, <a href="#">Cookies</a> y las <a href="#">Condiciones de uso</a> del tarificador.
                        </label>
                    </div>
                </div>

                <div class="col-12">
                    <button type="submit">Calcular tu precio</button> 
                </div>

            </form>
        </div>
    </div>


    <?php require_once __DIR__ . '/../includes/footer.php'; ?>
</body>

</html>