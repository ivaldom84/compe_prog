<?php
include_once('../includes/db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_cliente = $_POST['id_cliente'];
    $id_producto = $_POST['id_producto'];
    $cantidad = $_POST['cantidad'];

    // Validar
    if (!$id_cliente || !$id_producto || $cantidad < 1) {
        die("❌ Datos inválidos. Verifica los campos.");
    }

    // Obtener precio del producto
    $stmt = $conn->prepare("SELECT precio FROM productos WHERE id_producto = ?");
    $stmt->bind_param("i", $id_producto);
    $stmt->execute();
    $stmt->bind_result($precio_unitario);
    $stmt->fetch();
    $stmt->close();

    if (!$precio_unitario) {
        die("❌ Producto no encontrado.");
    }

    // Insertar en pedidos
    $stmt = $conn->prepare("INSERT INTO pedidos (id_cliente) VALUES (?)");
    $stmt->bind_param("i", $id_cliente);
    $stmt->execute();
    $id_pedido = $stmt->insert_id;
    $stmt->close();

    // Insertar en detalles_pedido
    $stmt = $conn->prepare("INSERT INTO detalles_pedido (id_pedido, id_producto, cantidad, precio) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("iiid", $id_pedido, $id_producto, $cantidad, $precio_unitario);

    if ($stmt->execute()) {
        echo "✅ Pedido guardado correctamente.";
        echo '<br><a href="listar.php">Ver pedidos</a>';
    } else {
        echo "❌ Error al guardar detalle: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Acceso denegado.";
}
