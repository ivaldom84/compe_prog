<?php
include_once('../includes/header.php');
include_once('../includes/db.php');

// Consultar detalles, cliente y productos
$sql = "
SELECT 
    p.id_pedido,
    c.nombre AS cliente,
    p.fecha_pedido,
    p.estado,
    pr.nombre AS producto,
    d.cantidad,
    d.precio,
    (d.cantidad * d.precio) AS total
FROM pedidos p
JOIN clientes c ON p.id_cliente = c.id_cliente
JOIN detalles_pedido d ON p.id_pedido = d.id_pedido
JOIN productos pr ON d.id_producto = pr.id_producto
ORDER BY p.id_pedido DESC, d.id_detalle ASC
";

$resultado = $conn->query($sql);
?>

<h2>Lista de Pedidos</h2>

<table border="1" cellpadding="8">
    <thead>
        <tr>
            <th>ID Pedido</th>
            <th>Cliente</th>
            <th>Fecha</th>
            <th>Estado</th>
            <th>Producto</th>
            <th>Cantidad</th>
            <th>Precio Unitario</th>
            <th>Total</th>
            <th>Acción</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($resultado->num_rows > 0): ?>
            <?php while ($fila = $resultado->fetch_assoc()): ?>
                <tr>
                    <td><?= $fila['id_pedido'] ?></td>
                    <td><?= htmlspecialchars($fila['cliente']) ?></td>
                    <td><?= $fila['fecha_pedido'] ?></td>
                    <td><?= $fila['estado'] ?></td>
                    <td><?= htmlspecialchars($fila['producto']) ?></td>
                    <td><?= $fila['cantidad'] ?></td>
                    <td><?= number_format($fila['precio'], 2) ?></td>
                    <td><?= number_format($fila['total'], 2) ?></td>
                    <td>
                        <?php if ($fila['estado'] === 'pendiente'): ?>
                            <form method="POST" action="marcar_completado.php" style="display:inline;">
                                <input type="hidden" name="id_pedido" value="<?= $fila['id_pedido'] ?>">
                                <button type="submit">Marcar completado</button>
                            </form>
                        <?php else: ?>
                            ✔ Completado
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr><td colspan="9">No hay pedidos registrados.</td></tr>
        <?php endif; ?>
    </tbody>
</table>

<?php
$conn->close();
include_once('../includes/footer.php');
?>
