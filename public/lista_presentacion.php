<?php
include '../config/config.php'; // Conexión a la base de datos
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Presentaciones</title>
    <!-- Enlace a Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Enlace a DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <!-- Estilos personalizados para mejorar la apariencia -->
    <style>
        body {
            background-color: #f8f9fa;
        }
        .card {
            margin-top: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            background-color: #343a40;
            color: white;
            border-radius: 10px 10px 0 0;
            padding: 15px;
        }
        .table-responsive {
            margin: 20px;
        }
        .btn {
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h2 class="mb-0">Lista de Presentaciones</h2>
            </div>
            <div class="card-body">
                <form id="deleteForm" action="delete_presentacion.php" method="POST">
                    <div class="table-responsive">
                        <?php
                        $sql = "SELECT * FROM presentaciones";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            echo "<table id='presentacionesTable' class='table table-striped table-hover table-bordered'>
                                    <thead class='thead-dark'>
                                        <tr>
                                            <th><input type='checkbox' id='select_all'></th> <!-- Checkbox general para seleccionar todo -->
                                            <th>Nombre del Padre</th>
                                            <th>Cédula del Padre</th>
                                            <th>Nombre de la Madre</th>
                                            <th>Cédula de la Madre</th>
                                            <th>Nombre del Niño</th>
                                            <th>Fecha de Nacimiento</th>
                                            <th>Lugar de Nacimiento</th>
                                            <th>Fecha de Presentación</th>
                                        </tr>
                                    </thead>
                                    <tbody>";
                            while($row = $result->fetch_assoc()) {
                                echo "<tr>
                                        <td><input type='checkbox' name='id[]' value='{$row['id']}'></td> <!-- Checkbox individual para cada registro -->
                                        <td>{$row['nombre_padre']}</td>
                                        <td>{$row['cedula_padre']}</td>
                                        <td>{$row['nombre_madre']}</td>
                                        <td>{$row['cedula_madre']}</td>
                                        <td>{$row['nombre_nino']}</td>
                                        <td>{$row['fecha_nacimiento']}</td>
                                        <td>{$row['lugar_nacimiento']}</td>
                                        <td>{$row['fecha_presentacion']}</td>
                                    </tr>";
                            }
                            echo "</tbody></table>";
                        } else {
                            echo "<div class='alert alert-warning'>No hay presentaciones registradas</div>";
                        }

                        $conn->close();
                        ?>
                    </div>
                    <!-- Botón para eliminar registros seleccionados -->
                    <button type="submit" class="btn btn-danger mt-3" id="deleteBtn">Eliminar Seleccionados</button>
                </form>

                <!-- Botón para regresar al menú -->
                <a href="index.html" class="btn btn-secondary">Regresar al Menú</a>

                <!-- Botón para exportar en formato XLSX -->
                <a href="export_presentaciones.php" class="btn btn-success">Exportar a XLSX</a>
            </div>
            <div class="card-footer text-center">
                <p class="text-muted">Misioneros de Luz - Sistema de Presentaciones</p>
            </div>
        </div>
    </div>

    <!-- Enlace a jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- Enlace a DataTables JS -->
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <!-- Enlace a Bootstrap JS y dependencias -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Inicializar DataTables para el filtrado por columnas -->
    <script>
        $(document).ready(function() {
            $('#presentacionesTable').DataTable({
                "paging": true,  // Habilitar paginación
                "searching": true,  // Habilitar búsqueda global
                "ordering": true,  // Habilitar la ordenación por columnas
                "lengthMenu": [5, 10, 25, 50],  // Opciones de paginación
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json" // Traducción al español
                }
            });

            // Funcionalidad para seleccionar todos los checkboxes
            $('#select_all').on('click', function() {
                var rows = $(this).closest('table').find('tbody tr');
                $('input[type="checkbox"]', rows).prop('checked', this.checked);
            });

            // Confirmación antes de enviar el formulario para eliminar
            $('#deleteForm').on('submit', function() {
                return confirm('¿Estás seguro de que deseas eliminar los registros seleccionados?');
            });
        });
    </script>
</body>
</html>
