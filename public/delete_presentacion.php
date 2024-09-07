<?php
include '../config/config.php'; // Conexión a la base de datos

if (isset($_POST['id'])) {
    $ids = $_POST['id'];

    // Convertir los IDs seleccionados en una cadena separada por comas
    $ids_str = implode(",", $ids);

    // SQL para eliminar los registros seleccionados
    $sql = "DELETE FROM presentaciones WHERE id IN ($ids_str)";

    if ($conn->query($sql) === TRUE) {
        echo "<script>
                alert('Registros eliminados correctamente');
                window.location.href = 'lista_presentacion.php';
              </script>";
    } else {
        echo "<script>
                alert('Error al eliminar los registros');
                window.location.href = 'lista_presentacion.php';
              </script>";
    }

    $conn->close();
} else {
    echo "<script>
            alert('No se seleccionó ningún registro');
            window.location.href = 'lista_presentacion.php';
          </script>";
}
?>
