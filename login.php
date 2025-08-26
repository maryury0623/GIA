<?php
session_start();

// Conectar con la base de datos
$conexion = new mysqli("localhost:3310", "root", "", "GIA");

$usuario = $_POST['usuario'];
$clave = $_POST['password'];

$sql = "SELECT * FROM usuarios WHERE usuario = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("s", $usuario);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows === 1) {
    $fila = $resultado->fetch_assoc();
    
    // Verificar contraseña
    if (password_verify($clave, $fila['contraseña'])) {
        $_SESSION['usuario'] = $usuario;
        header("Location: panel.php");
        exit();
    } else {
        echo "<script>alert('Contraseña incorrecta'); window.location.href='index.html';</script>";
    }
} else {
    echo "<script>alert('Usuario no encontrado'); window.location.href='index.html';</script>";
}
?>
