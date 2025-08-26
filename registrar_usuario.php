<?php
// Conexión a la base de datos GIA
$conexion = new mysqli("localhost:3310", "root", "", "GIA");

// Verificar conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Recibir datos del formulario
$usuario = $_POST['usuario'];
$nombre = $_POST['nombre'];
$correo = $_POST['correo'];
$password = $_POST['password'];

// Encriptar la contraseña
$claveEncriptada = password_hash($password, PASSWORD_DEFAULT);

// Verificar si el usuario ya existe
$sql_verificar = "SELECT * FROM usuarios WHERE Usuario = ?";
$stmt = $conexion->prepare($sql_verificar);
$stmt->bind_param("s", $usuario);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows > 0) {
    echo "<script>alert('El usuario ya existe'); window.location.href='registro.html';</script>";
    exit();
}

// Insertar nuevo usuario
$sql_insertar = "INSERT INTO usuarios (usuario, nombre, correo, contraseña) VALUES (?, ?, ?, ?)";
$stmt = $conexion->prepare($sql_insertar);
$stmt->bind_param("ssss", $usuario, $nombre, $correo, $claveEncriptada);

if ($stmt->execute()) {
    echo "<script>alert('Registro exitoso. Ahora puedes iniciar sesión.'); window.location.href='index.html';</script>";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conexion->close();
?>
