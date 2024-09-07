<?php
include '../config/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
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

    $sql = "UPDATE personas SET nombres='$nombres', apellidos='$apellidos', edad=$edad, telefono='$telefono', direccion='$direccion', estado_civil='$estado_civil', profesion_de_fe='$profesion_de_fe', fecha_profesion_de_fe='$fecha_profesion_de_fe', bautizado='$bautizado', red='$red', lider='$lider', estado='$estado' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        // Redirigir a list.php después de una actualización exitosa
        header("Location: list.php");
        exit(); // Asegura que el script se detenga después de redirigir
    } else {
        echo '<div class="alert alert-danger" role="alert">Error: ' . $sql . '<br>' . $conn->error . '</div>';
    }

    $conn->close();
}

$id = $_GET['id'];
$sql = "SELECT * FROM personas WHERE id=$id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Registro</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Editar Registro</h2>
        <form action="edit.php" method="post">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id']); ?>">

            <div class="form-group">
                <label for="nombres">Nombres:</label>
                <input type="text" id="nombres" name="nombres" class="form-control" value="<?php echo htmlspecialchars($row['nombres']); ?>" required>
            </div>

            <div class="form-group">
                <label for="apellidos">Apellidos:</label>
                <input type="text" id="apellidos" name="apellidos" class="form-control" value="<?php echo htmlspecialchars($row['apellidos']); ?>" required>
            </div>

            <div class="form-group">
                <label for="edad">Edad:</label>
                <input type="number" id="edad" name="edad" class="form-control" value="<?php echo htmlspecialchars($row['edad']); ?>" required>
            </div>

            <div class="form-group">
                <label for="telefono">Teléfono:</label>
                <input type="text" id="telefono" name="telefono" class="form-control" value="<?php echo htmlspecialchars($row['telefono']); ?>" required>
            </div>

            <div class="form-group">
                <label for="direccion">Dirección:</label>
                <input type="text" id="direccion" name="direccion" class="form-control" value="<?php echo htmlspecialchars($row['direccion']); ?>" required>
            </div>

            <div class="form-group">
                <label for="estado_civil">Estado Civil:</label>
                <select id="estado_civil" name="estado_civil" class="form-control" required>
                    <option value="Casad@" <?php echo ($row['estado_civil'] == 'Casad@') ? 'selected' : ''; ?>>Casad@</option>
                    <option value="Solter@" <?php echo ($row['estado_civil'] == 'Solter@') ? 'selected' : ''; ?>>Solter@</option>
                    <option value="Union libre" <?php echo ($row['estado_civil'] == 'Union libre') ? 'selected' : ''; ?>>Unión libre</option>
                </select>
            </div>

            <div class="form-group">
                <label for="profesion_de_fe">Profesión de Fe:</label>
                <select id="profesion_de_fe" name="profesion_de_fe" class="form-control" required>
                    <option value="Acepto" <?php echo ($row['profesion_de_fe'] == 'Acepto') ? 'selected' : ''; ?>>Acepto</option>
                    <option value="Reconcilio" <?php echo ($row['profesion_de_fe'] == 'Reconcilio') ? 'selected' : ''; ?>>Reconcilio</option>
                </select>
            </div>

            <div class="form-group">
                <label for="fecha_profesion_de_fe">Fecha de Profesión de Fe:</label>
                <input type="date" id="fecha_profesion_de_fe" name="fecha_profesion_de_fe" class="form-control" value="<?php echo htmlspecialchars($row['fecha_profesion_de_fe']); ?>" required>
            </div>

            <div class="form-group">
                <label for="bautizado">Bautizado:</label>
                <select id="bautizado" name="bautizado" class="form-control" required>
                    <option value="Si" <?php echo ($row['bautizado'] == 'Si') ? 'selected' : ''; ?>>Sí</option>
                    <option value="No" <?php echo ($row['bautizado'] == 'No') ? 'selected' : ''; ?>>No</option>
                </select>
            </div>

            <div class="form-group">
                <label for="red">Red:</label>
                <select id="red" name="red" class="form-control" required>
                    <option value="Adonai" <?php echo ($row['red'] == 'Adonai') ? 'selected' : ''; ?>>Adonai</option>
                    <option value="Shaddai" <?php echo ($row['red'] == 'Shaddai') ? 'selected' : ''; ?>>Shaddai</option>
                    <option value="Emanuel" <?php echo ($row['red'] == 'Emanuel') ? 'selected' : ''; ?>>Emanuel</option>
                    <option value="Elyon" <?php echo ($row['red'] == 'Elyon') ? 'selected' : ''; ?>>Elyon</option>
                </select>
            </div>

            <div class="form-group">
                <label for="lider">Líder:</label>
                <input type="text" id="lider" name="lider" class="form-control" value="<?php echo htmlspecialchars($row['lider']); ?>" required>
            </div>

            <div class="form-group">
                <label for="estado">Estado:</label>
                <select id="estado" name="estado" class="form-control" required>
                    <option value="Activo" <?php echo ($row['estado'] == 'Activo') ? 'selected' : ''; ?>>Activo</option>
                    <option value="Inactivo" <?php echo ($row['estado'] == 'Inactivo') ? 'selected' : ''; ?>>Inactivo</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Actualizar Registro</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
