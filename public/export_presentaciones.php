<?php
require '../vendor/autoload.php';
include '../config/config.php'; // Conexión a la base de datos

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Encabezados de la tabla
$sheet->setCellValue('A1', 'Nombre del Padre');
$sheet->setCellValue('B1', 'Cédula del Padre');
$sheet->setCellValue('C1', 'Nombre de la Madre');
$sheet->setCellValue('D1', 'Cédula de la Madre');
$sheet->setCellValue('E1', 'Nombre del Niño');
$sheet->setCellValue('F1', 'Fecha de Nacimiento');
$sheet->setCellValue('G1', 'Lugar de Nacimiento');
$sheet->setCellValue('H1', 'Fecha de Presentación');

// Obtener los datos de la base de datos
$sql = "SELECT * FROM presentaciones";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $rowNumber = 2; // Empezar en la fila 2 porque la fila 1 son los encabezados
    while($row = $result->fetch_assoc()) {
        $sheet->setCellValue('A' . $rowNumber, $row['nombre_padre']);
        $sheet->setCellValue('B' . $rowNumber, $row['cedula_padre']);
        $sheet->setCellValue('C' . $rowNumber, $row['nombre_madre']);
        $sheet->setCellValue('D' . $rowNumber, $row['cedula_madre']);
        $sheet->setCellValue('E' . $rowNumber, $row['nombre_nino']);
        $sheet->setCellValue('F' . $rowNumber, $row['fecha_nacimiento']);
        $sheet->setCellValue('G' . $rowNumber, $row['lugar_nacimiento']);
        $sheet->setCellValue('H' . $rowNumber, $row['fecha_presentacion']);
        $rowNumber++;
    }
}

// Establecer las cabeceras para la descarga del archivo
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Presentaciones.xlsx"');
header('Cache-Control: max-age=0');

$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
$conn->close();
exit;
