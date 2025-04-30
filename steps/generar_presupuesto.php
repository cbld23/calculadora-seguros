<?php
session_start();
require_once '../assets/fpdf/fpdf.php';

// Comprobar datos mínimos
if (!isset($_SESSION['nombre']) || !isset($_SESSION['fecha_inicio']) || !isset($_SESSION['codigo_postal'])) {
    die("Error: Datos incompletos.");
}

// Función para codificar correctamente el texto
function convertirTexto($texto) {
    return iconv('UTF-8', 'ISO-8859-1//TRANSLIT', $texto);
}

// Datos
$nombre = convertirTexto($_SESSION['nombre']);
$fecha_nacimiento = convertirTexto($_SESSION['asegurado_1']['nacimiento'] ?? 'No disponible');
$codigo_postal = convertirTexto($_SESSION['codigo_postal']);
$fecha_hoy = date('d/m/Y');
$hora_hoy = date('H:i');

// Crear nuevo PDF
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 12);

// Título principal
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(0, 10, convertirTexto('ASISTENCIA SANITARIA Muvraline'), 0, 1, 'C');

$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 10, convertirTexto('PRESUPUESTO DE SEGURO (Documento informativo carente de todo tipo de valor contractual)'), 0, 1, 'C');

$pdf->Ln(10);

// Datos de presupuesto
$pdf->MultiCell(0, 8, convertirTexto("Coste del seguro desde el " . date('d') . " de " . date('F') . " de " . date('Y') . " al 31 de Diciembre de " . date('Y')));
$pdf->MultiCell(0, 8, convertirTexto("Fecha y hora de presupuesto: En MALAGA a " . $fecha_hoy . " " . $hora_hoy));

$pdf->Ln(5);

// Datos del asegurado
$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(0, 10, convertirTexto('Datos de los asegurados'), 0, 1);

$pdf->SetFont('Arial', '', 12);
$pdf->MultiCell(0, 8, convertirTexto("Asegurado Titular: $nombre, nacido/a el $fecha_nacimiento, residente en código postal $codigo_postal."));

$pdf->Ln(5);

// Prima
$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(0, 10, convertirTexto('Prima personalizada'), 0, 1);

$pdf->SetFont('Arial', '', 12);
$pdf->Cell(60, 8, convertirTexto('Nombre'), 1);
$pdf->Cell(40, 8, convertirTexto('Nacimiento'), 1);
$pdf->Cell(40, 8, convertirTexto('1er recibo'), 1);
$pdf->Cell(40, 8, convertirTexto('Sucesivos'), 1);
$pdf->Ln();

$pdf->Cell(60, 8, $nombre, 1);
$pdf->Cell(40, 8, $fecha_nacimiento, 1);
$pdf->Cell(40, 8, convertirTexto('20,00€'), 1);
$pdf->Cell(40, 8, convertirTexto('30,00€'), 1);
$pdf->Ln();

$pdf->Ln(10);

// Observaciones
$pdf->MultiCell(0, 8, convertirTexto("Este presupuesto es informativo y no constituye compromiso de contratación. Sujeto a normas de suscripción de Muvraline Salud."));

$pdf->Ln(10);

// Prestaciones garantizadas
$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(0, 10, convertirTexto('Prestaciones garantizadas'), 0, 1);

$pdf->SetFont('Arial', '', 12);
$pdf->MultiCell(0, 8, convertirTexto("- Asistencia médica general y especializada.\n- Hospitalización completa y de día.\n- Urgencias nacionales e internacionales.\n- Orientación médica telefónica 24h.\n- Servicios de bienestar y prevención."));

$pdf->Ln(20);

// Pie de página
$pdf->SetFont('Arial', 'I', 10);
$pdf->Cell(0, 10, convertirTexto('Muvraline Salud © ' . date('Y')), 0, 0, 'C');

// Salida del PDF
$pdf->Output('D', 'Presupuesto_Muvraline_Salud.pdf');
exit;
?>
