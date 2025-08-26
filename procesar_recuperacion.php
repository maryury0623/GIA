<?php
// Conexión a la base de datos
$conexion = new mysqli("localhost:3310", "root", "", "GIA");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Obtener datos del formulario
$usuario = $_POST['usuario'];
$nueva_password = $_POST['nueva_password'];

// Buscar al usuario
$sql_buscar = "SELECT * FROM usuarios WHERE usuario = ?";
$stmt = $conexion->prepare($sql_buscar);
$stmt->bind_param("s", $usuario);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows === 1) {
    // Usuario encontrado → actualizar contraseña
    $nueva_clave_hash = password_hash($nueva_password, PASSWORD_DEFAULT);

    $sql_actualizar = "UPDATE usuarios SET contraseña = ? WHERE usuario = ?";
    $stmt = $conexion->prepare($sql_actualizar);
    $stmt->bind_param("ss", $nueva_clave_hash, $usuario);

    if ($stmt->execute()) {
        echo "<script>alert('Contraseña actualizada correctamente.'); window.location.href='index.html';</script>";
    } else {
        echo "<script>alert('Error al actualizar la contraseña'); window.location.href='recuperar.html';</script>";
    }
} else {
    echo "<script>alert('Usuario no encontrado'); window.location.href='recuperar.html';</script>";
}

$stmt->close();
$conexion->close();
?>
