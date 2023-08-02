<?php

// Datos de conexión a la base de datos
$host = 'localhost'; // Por ejemplo, 'localhost' si estás en local
$nombre_usuario = 'root'; // Nombre de usuario de la base de datos
$contraseña = ''; // Contraseña del usuario de la base de datos
$nombre_base_datos = 'mantenedor'; // Nombre de la base de datos

try {
    // Intentar conectar a la base de datos usando PDO
    $conexion = new PDO("mysql:host=$host;dbname=$nombre_base_datos", $nombre_usuario, $contraseña);

    // Configurar el modo de error para PDO para mostrar los errores en el navegador
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Mostrar mensaje de conexión exitosa
    echo "Conexión a la base de datos exitosa!";
} catch (PDOException $e) {
    // Mostrar mensaje de error en caso de que no se pueda conectar a la base de datos
    echo "Error al conectar a la base de datos: " . $e->getMessage();
}
