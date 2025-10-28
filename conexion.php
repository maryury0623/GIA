<?php
// Mostrar errores (solo en desarrollo, quitar en producción)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Datos de la conexión
$host = "localhost";
$puerto = "3310"; // el puerto personalizado
$usuario = "root";
$clave = "";
$base_datos = "GIA";

// Crear la conexión
$conexion = new mysqli($host . ":" . $puerto, $usuario, $clave, $base_datos);

// Verificar la conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}
?>
