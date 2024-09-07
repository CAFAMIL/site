<?php
include '../config/config.php'; // Conexión a la base de datos
$mensaje = "";
$mensaje_clase = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoger los datos del formulario
    $nombre_padre = $_POST['nombre_padre'];
    $cedula_padre = $_POST['cedula_padre'];
    $nombre_madre = $_POST['nombre_madre'];
    $cedula_madre = $_POST['cedula_madre'];
    $nombre_nino = $_POST['nombre_nino'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $lugar_nacimiento = $_POST['lugar_nacimiento'];
    $fecha_presentacion = $_POST['fecha_presentacion'];

    // Insertar los datos en la base de datos
    $sql = "INSERT INTO presentaciones (nombre_padre, cedula_padre, nombre_madre, cedula_madre, nombre_nino, fecha_nacimiento, lugar_nacimiento, fecha_presentacion)
            VALUES ('$nombre_padre', '$cedula_padre', '$nombre_madre', '$cedula_madre', '$nombre_nino', '$fecha_nacimiento', '$lugar_nacimiento', '$fecha_presentacion')";

    if ($conn->query($sql) === TRUE) {
        $mensaje = "Nuevo registro creado con éxito";
        $mensaje_clase = "alert-success";
    } else {
        $mensaje = "Error: " . $sql . "<br>" . $conn->error;
        $mensaje_clase = "alert-danger";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Presentación</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
        }
        .form-container {
            background: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-top: 30px;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }
        .alert {
            transition: opacity 0.6s ease;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="form-container">
            <h2 class="mb-4">Registrar Presentación</h2>
            
            <?php if ($mensaje): ?>
                <div class="alert <?php echo $mensaje_clase; ?>" role="alert">
                    <?php echo $mensaje; ?>
                </div>
                <script>
                    // Redirigir a la página anterior después de 2 segundos
                    setTimeout(function() {
                        window.location.href = 'index.html'; // Reemplaza con la URL del menú anterior
                    }, 2000);
                </script>
            <?php endif; ?>
            
            <form action="crete_presentacion.php" method="POST">
                <div class="form-group">
                    <label for="nombre_padre">Nombre del Padre</label>
                    <input type="text" id="nombre_padre" name="nombre_padre" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="cedula_padre">Número de Cédula del Padre</label>
                    <input type="text" id="cedula_padre" name="cedula_padre" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="nombre_madre">Nombre de la Madre</label>
                    <input type="text" id="nombre_madre" name="nombre_madre" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="cedula_madre">Número de Cédula de la Madre</label>
                    <input type="text" id="cedula_madre" name="cedula_madre" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="nombre_nino">Nombre del Niño</label>
                    <input type="text" id="nombre_nino" name="nombre_nino" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="fecha_nacimiento">Fecha de Nacimiento</label>
                    <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="lugar_nacimiento">Lugar de Nacimiento</label>
                    <input type="text" id="lugar_nacimiento" name="lugar_nacimiento" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="fecha_presentacion">Fecha de Presentación</label>
                    <input type="date" id="fecha_presentacion" name="fecha_presentacion" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Guardar Presentación</button>
            </form>
        </div>
    </div>

    <!-- Enlace a Bootstrap JS y dependencias -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
