<?php
$host = 'localhost';
$user = 'root';      // tu usuario de MySQL (por defecto 'root' en XAMPP)
$pass = '';          // contraseña vacía por defecto en XAMPP
$db   = 'competencias_pi';

$conn = new mysqli( hostname: $host, username: $user, password: $pass, database: $db);

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

try {
    
    $pdo = new PDO(dsn: "mysql:host=$host;dbname=$db", username: $user, password: $pass);
    
    $pdo->setAttribute(attribute: PDO::ATTR_ERRMODE, value: PDO::ERRMODE_EXCEPTION);
    echo "Conexión exitosa a la base de datos";
} catch (PDOException $e) {
    error_log(message: "Error de conexión: " . $e->getMessage());
    echo "Error de conexión. Contacte al administrador.";
}

?>
