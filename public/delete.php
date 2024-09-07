<?php
include '../config/config.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    
    // Preparar la consulta para evitar inyecciones SQL
    $stmt = $conn->prepare("DELETE FROM personas WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        // Redirigir después de la eliminación
        header("Location: list.php");
    } else {
        echo "Error al eliminar el registro: " . $conn->error;
    }

    $stmt->close();
}

$conn->close();
?>
