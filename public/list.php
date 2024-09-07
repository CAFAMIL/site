<?php
include '../config/config.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Registros</title>
    <!-- Enlace a Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Enlace a DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="normalize.css" rel="stylesheet">
    <!-- Estilo personalizado -->
    <style>
        body {
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }
        h2 {
            font-family: 'Arial', sans-serif;
            text-align: center;
            margin-bottom: 30px;
            font-weight: bold;
            color: #343a40;
        }
        .table-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow-x: auto;
            width: 100vw; /* 100% del ancho de la ventana */
            height: calc(100vh - 120px); /* Altura completa menos márgenes */
        }
        table {
            width: 100%; /* Tabla ocupa el 100% del contenedor */
            margin-bottom: 20px;
            table-layout: auto;
        }
        thead {
            background-color: #343a40;
            color: white;
        }
        th, td {
            text-align: center;
            vertical-align: middle;
            min-width: 50px;
        }
        .btn {
            border-radius: 30px;
        }
        .btn-primary, .btn-success {
            width: 150px;
            margin-top: 20px;
        }
        .dataTables_length, .dataTables_filter {
            margin-bottom: 20px;
        }
        .container {
            max-width: 100vw; /* Contenedor ocupa 100% del ancho */
            padding: 0;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2>Lista de Registros</h2>

        <div class="table-container">
            <?php
            $sql = "SELECT * FROM personas";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo "<table id='registroTable' class='table table-striped table-bordered'>
                        <thead class='thead-dark'>
                            <tr>
                                <th>Id</th>
                                <th>Nombres</th>
                                <th>Apellidos</th>
                                <th>Edad</th>
                                <th>Teléfono</th>
                                <th>Dirección</th>
                                <th>Estado Civil</th>
                                <th>Profesión de Fe</th>
                                <th>Fecha Profesión de Fe</th>
                                <th>Bautizado</th>
                                <th>Red</th>
                                <th>Líder</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>";
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['nombres']}</td>
                            <td>{$row['apellidos']}</td>
                            <td>{$row['edad']}</td>
                            <td>{$row['telefono']}</td>
                            <td>{$row['direccion']}</td>
                            <td>{$row['estado_civil']}</td>
                            <td>{$row['profesion_de_fe']}</td>
                            <td>{$row['fecha_profesion_de_fe']}</td>
                            <td>{$row['bautizado']}</td>
                            <td>{$row['red']}</td>
                            <td>{$row['lider']}</td>
                            <td>{$row['estado']}</td>
                            <td>
                                <a href='edit.php?id={$row['id']}' class='btn btn-warning btn-sm'>Editar</a>
                                <a href='delete.php?id={$row['id']}' class='btn btn-danger btn-sm' onclick=\"return confirm('¿Estás seguro de que quieres eliminar este registro?');\">Eliminar</a>
                            </td>
                        </tr>";
                }
                echo "</tbody></table>";
            } else {
                echo "<div class='alert alert-warning' role='alert'>No se encontraron resultados.</div>";
            }

            $conn->close();
            ?>
        </div>

        <!-- Botones de acción -->
        <div class="d-flex justify-content-center">
            <button onclick="window.location.href='index.html'" class="btn btn-primary">Regresar a Inicio</button>
            <button onclick="window.location.href='export.php'" class="btn btn-success">Descargar en Excel</button>
        </div>
    </div>

    <!-- Enlace a jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- Enlace a DataTables JS -->
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <!-- Enlace a Bootstrap JS y dependencias -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Inicializar DataTables para permitir filtrado por columnas -->
    <script>
        $(document).ready(function() {
            $('#registroTable').DataTable({
                "paging": true, // Permite paginación
                "searching": true, // Activa la búsqueda global
                "ordering": true, // Activa la capacidad de ordenar por columna
                "lengthMenu": [5, 10, 25, 50], // Opciones de paginación
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json" // Traducción al español
                }
            });
        });
    </script>
</body>
</html>

