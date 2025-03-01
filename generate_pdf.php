<?php
require('fpdf.php');

class PDF extends FPDF {
    function Header() {
        $this->Image('batei.png', 10, 5, 20);
        $this->SetFont('Arial', 'B', 12);
        $this->SetTextColor(0, 51, 153);
        $this->Cell(0, 5, mb_convert_encoding('REPÚBLICA DOMINICANA - MINISTERIO DE EDUCACIÓN', 'ISO-8859-1', 'UTF-8'), 0, 1, 'C');
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(0, 5, mb_convert_encoding('POLITÉCNICO PROFESOR JUAN DE LA CRUZ ABAD', 'ISO-8859-1', 'UTF-8'), 0, 1, 'C');
        $this->SetFont('Arial', '', 9);
        $this->Cell(0, 5, mb_convert_encoding('REGIONAL 10 - DISTRITO EDUCATIVO 10-01', 'ISO-8859-1', 'UTF-8'), 0, 1, 'C');
        $this->Ln(4);
        
        $this->SetFont('Arial', 'B', 10);
        $this->SetFillColor(120, 80, 200);
        $this->SetTextColor(255, 255, 255);
        $this->Cell(0, 8, mb_convert_encoding('REPORTE DE CALIFICACIONES - AÑO ESCOLAR 2023-2024', 'ISO-8859-1', 'UTF-8'), 1, 1, 'C', true);
        $this->Ln(4);
    }

    function Footer() {
        $this->SetY(-25);
        $this->SetFont('Arial', '', 8);
        $this->Cell(0, 8, mb_convert_encoding('Firma del Director: ______________________', 'ISO-8859-1', 'UTF-8'), 0, 1, 'L');
        $this->Cell(0, 8, mb_convert_encoding('Firma del Maestro: ______________________', 'ISO-8859-1', 'UTF-8'), 0, 1, 'L');
    }
}

$pdf = new PDF('P', 'mm', 'A4');
$pdf->AddPage();
$pdf->SetFont('Arial', '', 9);


// Información del estudiante
$pdf->Cell(0, 6, mb_convert_encoding('Estudiante: ESCOBOSA SILVA STIWARD FERNANDO', 'ISO-8859-1', 'UTF-8'), 0, 1);
$pdf->Cell(0, 6, mb_convert_encoding('Grado: 5to - Desarrollo y Administración de Aplicaciones Informáticas', 'ISO-8859-1', 'UTF-8'), 0, 1);
$pdf->Cell(0, 6, mb_convert_encoding('No. ID: 5972883    RNE: SES0812020000', 'ISO-8859-1', 'UTF-8'), 0, 1);
$pdf->Cell(0, 6, mb_convert_encoding('Maestro/a Encargado/a: Benerada Sánchez', 'ISO-8859-1', 'UTF-8'), 0, 1);
$pdf->Ln(5);

// Tabla de calificaciones académicas
$pdf->SetFont('Arial', 'B', 9);
$pdf->SetFillColor(120, 80, 200);
$pdf->SetTextColor(255, 255, 255);
$pdf->Cell(60, 8, 'ASIGNATURA', 1, 0, 'C', true);
$pdf->Cell(20, 8, 'PC1', 1, 0, 'C', true);
$pdf->Cell(20, 8, 'PC2', 1, 0, 'C', true);
$pdf->Cell(20, 8, 'PC3', 1, 0, 'C', true);
$pdf->Cell(20, 8, 'CF', 1, 1, 'C', true);

$pdf->SetFont('Arial', '', 9);
$pdf->SetTextColor(0, 0, 0);
$subjects = [
    ['Lengua Española', 89, 88, 90, 89],
    ['Lengua Extranjera (Inglés)', 86, 87, 88, 87],
    ['Matemática', 80, 82, 85, 82],
    ['Ciencias Sociales', 83, 84, 85, 84],
    ['Ciencias de la Naturaleza', 90, 91, 92, 91],
    ['Educación Artística', 83, 85, 86, 85],
    ['Educación Física', 80, 82, 83, 82],
    ['Formación Integral, Humana y Religiosa', 85, 86, 87, 86]
];

foreach ($subjects as $subject) {
    $pdf->Cell(60, 8, mb_convert_encoding($subject[0], 'ISO-8859-1', 'UTF-8'), 1);
    for ($i = 1; $i < count($subject); $i++) {
        $pdf->Cell(20, 8, $subject[$i], 1, 0, 'C');
    }
    $pdf->Ln();
}

$pdf->Ln(5);
$pdf->SetFont('Arial', 'B', 9);
$pdf->SetFillColor(120, 80, 200);
$pdf->SetTextColor(255, 255, 255);
$pdf->Cell(60, 8, mb_convert_encoding('CALIFICACIONES TÉCNICAS', 'ISO-8859-1', 'UTF-8'), 1, 1, 'C', true);

$pdf->SetFont('Arial', '', 9);
$pdf->SetTextColor(0, 0, 0);
$technical_subjects = [
    ['Administración de Base de Datos', '7/10'],
    ['Desarrollo de Aplicaciones', '10/10'],
    ['Análisis y Diseño de Reportes', '8/10'],
    ['Formación y Orientación Laboral', '8/10']
];

foreach ($technical_subjects as $subject) {
    $pdf->Cell(60, 8, mb_convert_encoding($subject[0], 'ISO-8859-1', 'UTF-8'), 1);
    $pdf->Cell(20, 8, $subject[1], 1, 1, 'C');
}

$pdf->Ln(5);
$pdf->SetFont('Arial', 'B', 9);
$pdf->SetFillColor(100, 50, 150);
$pdf->SetTextColor(255, 255, 255);
$pdf->Cell(0, 10, mb_convert_encoding('CONDICIÓN FINAL: PROMOVIDO', 'ISO-8859-1', 'UTF-8'), 1, 1, 'C', true);

$pdf->Output();
?>
