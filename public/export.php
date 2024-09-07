<?php
require '../vendor/autoload.php'; // Asegúrate de que este archivo apunte a donde esté tu autoload de Composer
include '../config/config.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Encabezados de la tabla
$sheet->setCellValue('A1', 'Id');
$sheet->setCellValue('B1', 'Nombres');
$sheet->setCellValue('C1', 'Apellidos');
$sheet->setCellValue('D1', 'Edad');
$sheet->setCellValue('E1', 'Teléfono');
$sheet->setCellValue('F1', 'Dirección');
$sheet->setCellValue('G1', 'Estado Civil');
$sheet->setCellValue('H1', 'Profesión de Fe');
$sheet->setCellValue('I1', 'Fecha Profesión de Fe');
$sheet->setCellValue('J1', 'Bautizado');
$sheet->setCellValue('K1', 'Red');
$sheet->setCellValue('L1', 'Líder');
$sheet->setCellValue('M1', 'Estado');

// Consulta a la base de datos
$sql = "SELECT * FROM personas";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $rowNumber = 2; // Comenzamos en la fila 2 porque la 1 tiene los encabezados
    while ($row = $result->fetch_assoc()) {
        $sheet->setCellValue('A' . $rowNumber, $row['id']);
        $sheet->setCellValue('B' . $rowNumber, $row['nombres']);
        $sheet->setCellValue('C' . $rowNumber, $row['apellidos']);
        $sheet->setCellValue('D' . $rowNumber, $row['edad']);
        $sheet->setCellValue('E' . $rowNumber, $row['telefono']);
        $sheet->setCellValue('F' . $rowNumber, $row['direccion']);
        $sheet->setCellValue('G' . $rowNumber, $row['estado_civil']);
        $sheet->setCellValue('H' . $rowNumber, $row['profesion_de_fe']);
        $sheet->setCellValue('I' . $rowNumber, $row['fecha_profesion_de_fe']);
        $sheet->setCellValue('J' . $rowNumber, $row['bautizado']);
        $sheet->setCellValue('K' . $rowNumber, $row['red']);
        $sheet->setCellValue('L' . $rowNumber, $row['lider']);
        $sheet->setCellValue('M' . $rowNumber, $row['estado']);
        $rowNumber++;
    }
}

// Cerramos la conexión a la base de datos
$conn->close();

// Establecer las cabeceras para la descarga
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="registros.xlsx"');
header('Cache-Control: max-age=0');

// Guardar el archivo
$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit;
?>
