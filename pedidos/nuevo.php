<?php
include_once('../includes/header.php');
include_once('../includes/db.php');

// Obtener clientes y productos
$clientes = $conn->query("SELECT id_cliente, nombre FROM clientes");
$productos = $conn->query("SELECT id_producto, nombre FROM productos");
?>

<h2>Nuevo Pedido</h2>

<form action="guardar.php" method="POST">
    <label for="cliente">Cliente:</label><br>
    <select name="id_cliente" required>
        <option value="">-- Selecciona un cliente --</option>
        <?php while ($c = $clientes->fetch_assoc()): ?>
            <option value="<?= $c['id_cliente'] ?>"><?= htmlspecialchars($c['nombre']) ?></option>
        <?php endwhile; ?>
    </select><br><br>

    <label for="producto">Producto:</label><br>
    <select name="id_producto" required>
        <option value="">-- Selecciona un producto --</option>
        <?php while ($p = $productos->fetch_assoc()): ?>
            <option value="<?= $p['id_producto'] ?>"><?= htmlspecialchars($p['nombre']) ?></option>
        <?php endwhile; ?>
    </select><br><br>

    <label for="cantidad">Cantidad:</label><br>
    <input type="number" name="cantidad" min="1" required><br><br>

    <button type="submit">Guardar Pedido</button>
</form>

<?php include_once('../includes/footer.php'); ?>
