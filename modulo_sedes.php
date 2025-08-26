<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MÓDULO DE SEDES</title>
  <style>
    body {
      background-color: #a8d0e6;
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
    }

    .contenedor {
      background-color: #1d5fa3;
      color: white;
      padding: 2rem;
      border-radius: 1rem;
      max-width: 600px;
      width: 100%;
      text-align: center;
    }

    h2 {
      margin-bottom: 1.5rem;
    }

    .botones {
      display: flex;
      flex-direction: column;
      gap: 1rem;
      margin-bottom: 2rem;
    }

    .botones form button {
      background-color: #1c3f66;
      color: white;
      padding: 0.7rem;
      border: none;
      border-radius: 5px;
      font-weight: bold;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    .botones form button:hover {
      background-color: #112b46;
    }

    form label {
      display: block;
      margin-top: 1rem;
      text-align: left;
    }

    form input {
      width: 100%;
      padding: 0.5rem;
      margin-top: 0.3rem;
      border-radius: 5px;
      border: none;
    }

    .volver {
      margin-top: 1.5rem;
      display: inline-block;
      background-color: #007bff;
      padding: 0.5rem 1rem;
      color: white;
      border-radius: 5px;
      text-decoration: none;
    }

    .volver:hover {
      background-color: #0056b3;
    }
  </style>
</head>
<body>

<div class="contenedor">
  <h2>MÓDULO DE SEDES</h2>

  <?php
  $accion = $_POST['accion'] ?? null;

  if (!$accion):
  ?>
    <div class="botones">
      <form method="POST">
        <button type="submit" name="accion" value="crear">Crear Sede</button>
        <button type="submit" name="accion" value="consultar">Consultar Sede</button>
        <button type="submit" name="accion" value="modificar">Modificar Sede</button>
        <button type="submit" name="accion" value="eliminar">Eliminar Sede</button>
      </form>
    </div>
  <?php else: ?>
    <form action="sedes.php" method="POST">
      <?php if ($accion !== 'crear'): ?>
        <label for="id">ID de la Sede:</label>
        <input type="text" name="id" id="id" required>
      <?php endif; ?>

      <?php if ($accion !== 'consultar' && $accion !== 'eliminar'): ?>
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre">

        <label for="direccion">Dirección:</label>
        <input type="text" name="direccion" id="direccion">

        <label for="barrio">Barrio:</label>
        <input type="text" name="barrio" id="barrio">

        <label for="telefono">Teléfono:</label>
        <input type="text" name="telefono" id="telefono">
      <?php endif; ?>

      <br><br>
      <button type="submit" name="accion_final" value="<?= $accion ?>">
        <?= ucfirst($accion) ?>
      </button>
    </form>

    <a href="modulo_sedes.php" class="volver">← Volver</a>
  <?php endif; ?>
</div>

</body>
</html>
