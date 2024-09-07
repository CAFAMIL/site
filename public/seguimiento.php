<?php
include '../config/config.php';
require_once '../vendor/autoload.php'; // Asegúrate de haber instalado PHPExcel

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

if (isset($_GET['download']) && $_GET['download'] == 'xlsx') {
    // Crear una nueva instancia de Spreadsheet
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    
    // Establecer los encabezados
    $sheet->setCellValue('A1', 'Id');
    $sheet->setCellValue('B1', 'Nombre');
    $sheet->setCellValue('C1', 'Apellido');
    $sheet->setCellValue('D1', 'Edad');
    $sheet->setCellValue('E1', 'Dirección');
    $sheet->setCellValue('F1', 'Red');
    $sheet->setCellValue('G1', 'Líder');
    $sheet->setCellValue('H1', 'Visita');
    $sheet->setCellValue('I1', 'Llamada');
    
    // Obtener datos de la base de datos
    $sql = "SELECT p.id, p.nombres, p.apellidos, p.edad, p.direccion, p.red, p.lider, s.visita, s.llamada 
            FROM personas p 
            LEFT JOIN seguimiento s ON p.id = s.persona_id
            WHERE p.estado = 'Activo'";
    $result = $conn->query($sql);
    
    $rowNumber = 2; // Fila donde comienzan los datos
    while ($row = $result->fetch_assoc()) {
        $sheet->setCellValue('A' . $rowNumber, $row['id']);
        $sheet->setCellValue('B' . $rowNumber, $row['nombres']);
        $sheet->setCellValue('C' . $rowNumber, $row['apellidos']);
        $sheet->setCellValue('D' . $rowNumber, $row['edad']);
        $sheet->setCellValue('E' . $rowNumber, $row['direccion']);
        $sheet->setCellValue('F' . $rowNumber, $row['red']);
        $sheet->setCellValue('G' . $rowNumber, $row['lider']);
        $sheet->setCellValue('H' . $rowNumber, $row['visita'] ? 'Sí' : 'No');
        $sheet->setCellValue('I' . $rowNumber, $row['llamada'] ? 'Sí' : 'No');
        $rowNumber++;
    }

    // Crear el archivo Excel y enviar al navegador
    $writer = new Xlsx($spreadsheet);
    $filename = 'seguimiento.xlsx';
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="' . $filename . '"');
    header('Cache-Control: max-age=0');
    $writer->save('php://output');
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seguimiento</title>
    <!-- Enlace a la CDN de Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .table th, .table td {
            text-align: center;
            vertical-align: middle;
        }
        .custom-table {
            border: 1px solid #dee2e6;
            border-radius: 0.25rem;
        }
        .custom-table thead th {
            background-color: #343a40;
            color: #ffffff;
        }
        .custom-table tbody tr:nth-child(odd) {
            background-color: #f8f9fa;
        }
        .custom-table tbody tr:hover {
            background-color: #e9ecef;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }
        .navbar {
            margin-bottom: 20px;
        }
        .container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Mi Aplicación</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="index.html">Inicio</a>
                </li>
                <!-- Puedes agregar más enlaces aquí -->
            </ul>
        </div>
    </nav>

    <div class="container">
        <a href="index.html" class="btn btn-primary mb-4">Regresar al Menú</a>
        <a href="?download=xlsx" class="btn btn-success mb-4">Descargar como XLSX</a>
        
        <?php
        $sql = "SELECT p.id, p.nombres, p.apellidos, p.edad, p.direccion, p.red, p.lider, s.visita, s.llamada 
                FROM personas p 
                LEFT JOIN seguimiento s ON p.id = s.persona_id
                WHERE p.estado = 'Activo'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<h2 class='mb-4'>Seguimiento</h2>";
            echo "<table class='table table-striped table-bordered custom-table'>
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Edad</th>
                            <th>Dirección</th>
                            <th>Red</th>
                            <th>Líder</th>
                            <th>Visita</th>
                            <th>Llamada</th>
                        </tr>
                    </thead>
                    <tbody>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['nombres']}</td>
                        <td>{$row['apellidos']}</td>
                        <td>{$row['edad']}</td>
                        <td>{$row['direccion']}</td>
                        <td>{$row['red']}</td>
                        <td>{$row['lider']}</td>
                        <td><input type='checkbox' class='visita-checkbox' data-id='{$row['id']}' " . ($row['visita'] ? "checked" : "") . "></td>
                        <td><input type='checkbox' class='llamada-checkbox' data-id='{$row['id']}' " . ($row['llamada'] ? "checked" : "") . "></td>
                    </tr>";
            }
            echo "</tbody></table>";
        } else {
            echo "<div class='alert alert-info'>0 resultados</div>";
        }

        $conn->close();
        ?>
    </div>

    <!-- Enlace a los scripts de Bootstrap y jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function() {
            // Función para manejar el cambio en el estado de los checkboxes
            $('input[type="checkbox"]').change(function() {
                var checkbox = $(this);
                var id = checkbox.data('id');
                var visita = checkbox.hasClass('visita-checkbox') ? checkbox.is(':checked') : null;
                var llamada = checkbox.hasClass('llamada-checkbox') ? checkbox.is(':checked') : null;

                $.ajax({
                    url: 'update_seguimiento.php',
                    type: 'POST',
                    data: {
                        id: id,
                        visita: visita,
                        llamada: llamada
                    },
                    success: function(response) {
                        console.log('Update successful');
                    },
                    error: function(xhr, status, error) {
                        console.log('Error:', error);
                    }
                });
            });
        });
    </script>
</body>
</html>
