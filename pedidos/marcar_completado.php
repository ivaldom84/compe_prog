<?php
include_once('../includes/db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_pedido'])) {
    $id_pedido = $_POST['id_pedido'];

    $stmt = $conn->prepare("UPDATE pedidos SET estado = 'completado' WHERE id_pedido = ?");
    $stmt->bind_param("i", $id_pedido);

    if ($stmt->execute()) {
        header('Location: listar.php');
        exit;
    } else {
        echo "❌ Error al actualizar el estado: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Solicitud no válida.";
}
