<?php
include '../config/config.php';

$mensaje = "";
$mensaje_clase = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener datos del formulario
    $nombres = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $edad = $_POST['edad'];
    $telefono = $_POST['telefono'];
    $direccion = $_POST['direccion'];
    $estado_civil = $_POST['estado_civil'];
    $profesion_de_fe = $_POST['profesion_de_fe'];
    $fecha_profesion_de_fe = $_POST['fecha_profesion_de_fe'];
    $bautizado = $_POST['bautizado'];
    $red = $_POST['red'];
    $lider = $_POST['lider'];
    $estado = $_POST['estado'];

    // Insertar datos en la base de datos
    $sql = "INSERT INTO personas (nombres, apellidos, edad, telefono, direccion, estado_civil, profesion_de_fe, fecha_profesion_de_fe, bautizado, red, lider, estado) 
            VALUES ('$nombres', '$apellidos', $edad, '$telefono', '$direccion', '$estado_civil', '$profesion_de_fe', '$fecha_profesion_de_fe', '$bautizado', '$red', '$lider', '$estado')";

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
    <title>Crear Registro</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Estilo general del cuerpo */
        body {
            background-color: #f0f2f5;
            font-family: 'Arial', sans-serif;
        }
        /* Estilo del contenedor del formulario */
        .form-container {
            background: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-top: 30px;
        }
        /* Estilo para los botones */
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }
        /* Estilo para las alertas */
        .alert {
            transition: opacity 0.6s ease;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="form-container">
            <h2 class="mb-4">Crear Registro</h2>
            
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

            <form action="create.php" method="post">
                <div class="form-group">
                    <label for="nombres">Nombres:</label>
                    <input type="text" id="nombres" name="nombres" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="apellidos">Apellidos:</label>
                    <input type="text" id="apellidos" name="apellidos" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="edad">Edad:</label>
                    <input type="number" id="edad" name="edad" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="telefono">Teléfono:</label>
                    <input type="text" id="telefono" name="telefono" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="direccion">Dirección:</label>
                    <input type="text" id="direccion" name="direccion" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="estado_civil">Estado Civil:</label>
                    <select id="estado_civil" name="estado_civil" class="form-control" required>
                        <option value="Casad@">Casad@</option>
                        <option value="Solter@">Solter@</option>
                        <option value="Union libre">Unión libre</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="profesion_de_fe">Profesión de Fe:</label>
                    <select id="profesion_de_fe" name="profesion_de_fe" class="form-control" required>
                        <option value="Acepto">Acepto</option>
                        <option value="Reconcilio">Reconcilio</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="fecha_profesion_de_fe">Fecha de Profesión de Fe:</label>
                    <input type="date" id="fecha_profesion_de_fe" name="fecha_profesion_de_fe" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="bautizado">Bautizado:</label>
                    <select id="bautizado" name="bautizado" class="form-control" required>
                        <option value="Si">Sí</option>
                        <option value="No">No</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="red">Red:</label>
                    <select id="red" name="red" class="form-control" required>
                        <option value="Adonai">Adonai</option>
                        <option value="Shaddai">Shaddai</option>
                        <option value="Emanuel">Emanuel</option>
                        <option value="Elyon">Elyon</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="lider">Líder:</label>
                    <input type="text" id="lider" name="lider" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="estado">Estado:</label>
                    <select id="estado" name="estado" class="form-control" required>
                        <option value="Activo">Activo</option>
                        <option value="Inactivo">Inactivo</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Guardar Registro</button>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies (Popper.js and jQuery) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

