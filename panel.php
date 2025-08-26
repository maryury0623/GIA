<?php
session_start();

// Verifica si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario'])) {
    header("Location: index.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>MENÚ PRINCIPAL</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
  <style>
    body {
      background-color: #a8d0e6;
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    main {
      width: 100%;
      max-width: 900px;
      background-color: #1d5fa3;
      padding: 2.5rem;
      border-radius: 1rem;
      color: white;
      text-align: center;
    }

    h1 {
      font-size: 2rem;
      margin-bottom: 1rem;
      font-weight: bold;
    }

    img {
      max-width: 150px;
      margin-bottom: 2rem;
    }

    .menu {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
      gap: 1rem;
    }

    .modulo {
      background-color: #1c3f66;
      padding: 1.5rem;
      border-radius: 0.75rem;
      font-weight: bold;
      text-decoration: none;
      color: white;
      transition: background-color 0.3s;
    }

    .modulo:hover {
      background-color: #112b46;;
    }

    
    .salir {
      margin-top: 2rem;
      color: white;
      text-decoration: underline;
    }

    .salir:hover {
      color: #d4d4d4;
    }
  </style>
</head>
<body>

  <main>
    <h1>MENÚ PRINCIPAL</h1>
    <p>Bienvenido, <strong><?php echo $_SESSION['usuario']; ?></strong></p>
    <img src="Imagenes/logo_previser.png" alt="Logo">

    <div class="menu">
      <a href="modulo_asignacion.html" class="modulo">MÓDULO DE ASIGNACIÓN</a>
      <a href="modulo_facturacion.html" class="modulo">MÓDULO DE FACTURACIÓN</a>
      <a href="modulo_creacion.html" class="modulo">MÓDULO DE CREACIÓN</a>
      <a href="modulo_bodegas.html" class="modulo">MÓDULO DE BODEGAS</a>
      <a href="modulo_activos.html" class="modulo">MÓDULO DE ACTIVOS</a>
    </div>
 

    <a class="salir" href="logout.php">Cerrar sesión</a>
  </main>

</body>
</html>
