<?php
include '../config/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);
    $visita = isset($_POST['visita']) ? (int)$_POST['visita'] : 0;
    $llamada = isset($_POST['llamada']) ? (int)$_POST['llamada'] : 0;

    $sql = "UPDATE seguimiento SET visita = ?, llamada = ? WHERE persona_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('iii', $visita, $llamada, $id);

    if ($stmt->execute()) {
        echo 'Update successful';
    } else {
        echo 'Update failed';
    }

    $stmt->close();
    $conn->close();
}
?>
