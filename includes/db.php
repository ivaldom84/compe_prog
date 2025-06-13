<?php
$host = "localhost";   
$usuario = "root";     
$clave = "";          
$base_de_datos = "competencias_pi"; 

try {
    
    $pdo = new PDO("mysql:host=$host;dbname=$base_de_datos", $usuario, $clave);
    
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Conexión exitosa a la base de datos";
} catch (PDOException $e) {
    error_log("Error de conexión: " . $e->getMessage());
    echo "Error de conexión. Contacte al administrador.";
}

?>
