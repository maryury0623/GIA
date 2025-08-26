<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Módulo Sedes</title>
  <style>
    body {
      background-color: #a8d0e6;
      font-family: Arial, sans-serif;
      margin: 0; padding: 20px;
    }
    .contenedor {
      background-color: #1d5fa3;
      color: white;
      padding: 2rem;
      border-radius: 1rem;
      max-width: 700px;
      margin: auto;
    }
    h2 {
      margin-bottom: 1.5rem;
      text-align: center;
    }
    form label {
      display: block;
      margin-top: 1rem;
    }
    form input {
      width: 100%;
      padding: 0.5rem;
      border-radius: 5px;
      border: none;
      margin-top: 0.3rem;
    }
    form button {
      margin-top: 1.5rem;
      padding: 0.7rem 1.5rem;
      background-color: #112b46;
      color: white;
      border: none;
      border-radius: 5px;
      font-weight: bold;
      cursor: pointer;
    }
    form button:hover {
      background-color: #0b1e32;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 2rem;
    }
    th, td {
      border: 1px solid white;
      padding: 8px;
      text-align: left;
    }
    th {
      background-color: #112b46;
    }
    button.accion {
      background-color: #1c3f66;
      padding: 5px 10px;
      margin-right: 5px;
    }
    button.accion:hover {
      background-color: #112b46;
    }

    .btn-regresar {
      display: inline-block;
      margin-top: 20px;
      text-decoration: none;
      background-color: #007bff;
      color: white;
      padding: 10px 20px;
      border-radius: 5px;
    }

    
  </style>
</head>
<body>
  <div class="contenedor">
    <h2>GESTIÓN DE SEDES</h2>
    <form id="formSede">
      <input type="hidden" id="idSede" />
      <label for="nombre">Nombre</label>
      <input type="text" id="nombre" required />
      <label for="direccion">Dirección</label>
      <input type="text" id="direccion" required />
      <label for="barrio">Barrio</label>
      <input type="text" id="barrio" required />
      <label for="telefono">Teléfono</label>
      <input type="text" id="telefono" required />
      <button type="submit">Guardar Sede</button>
      <button type="button" id="btnCancelar" style="display:none; margin-left: 10px;">Cancelar</button>
    </form>

    <table>
      <thead>
        <tr><th>ID</th><th>Nombre</th><th>Dirección</th><th>Barrio</th><th>Teléfono</th><th>Acciones</th></tr>
      </thead>
      <tbody id="tbodySedes">
      </tbody>
    </table>

       <!-- Botón de regresar -->
     <a href="modulo_asignacion.html" class="btn-regresar">← Volver al Módulo de Asignación</a>
  </div>

  <script>
    const apiUrl = 'sedes_logica.php';

    const form = document.getElementById('formSede');
    const idSede = document.getElementById('idSede');
    const nombre = document.getElementById('nombre');
    const direccion = document.getElementById('direccion');
    const barrio = document.getElementById('barrio');
    const telefono = document.getElementById('telefono');
    const btnCancelar = document.getElementById('btnCancelar');
    const tbody = document.getElementById('tbodySedes');

    function cargarSedes() {
      fetch(apiUrl)
        .then(res => res.json())
        .then(data => {
          tbody.innerHTML = '';
          data.forEach(sede => {
            const tr = document.createElement('tr');
            tr.innerHTML = `
              <td>${sede.IdSedes}</td>
              <td>${sede.Nombre}</td>
              <td>${sede.Direccion}</td>
              <td>${sede.Barrio}</td>
              <td>${sede.Telefono}</td>
              <td>
                <button class="accion" onclick="editarSede(${sede.IdSedes})">Editar</button>
                <button class="accion" onclick="eliminarSede(${sede.IdSedes})">Eliminar</button>
              </td>
            `;
            tbody.appendChild(tr);
          });
        });
    }

    function limpiarFormulario() {
      idSede.value = '';
      nombre.value = '';
      direccion.value = '';
      barrio.value = '';
      telefono.value = '';
      btnCancelar.style.display = 'none';
    }

    function editarSede(id) {
      fetch(apiUrl + '?id=' + id)
        .then(res => res.json())
        .then(sede => {
          idSede.value = sede.IdSedes;
          nombre.value = sede.Nombre;
          direccion.value = sede.Direccion;
          barrio.value = sede.Barrio;
          telefono.value = sede.Telefono;
          btnCancelar.style.display = 'inline-block';
        });
    }

    function eliminarSede(id) {
      if (confirm('¿Seguro que quieres eliminar esta sede?')) {
        fetch(apiUrl + '?id=' + id, {
          method: 'DELETE',
          headers: {'Content-Type': 'application/json'}
        })
        .then(res => res.json())
        .then(data => {
          alert(data.mensaje || data.error);
          cargarSedes();
          limpiarFormulario();
        });
      }
    }

    form.addEventListener('submit', e => {
      e.preventDefault();
      const metodo = idSede.value ? 'PUT' : 'POST';
      const sedeData = {
        IdSedes: idSede.value,
        Nombre: nombre.value,
        Direccion: direccion.value,
        Barrio: barrio.value,
        Telefono: telefono.value
      };

      if (metodo === 'POST') delete sedeData.IdSedes;

      fetch(apiUrl, {
        method: metodo,
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify(sedeData)
      })
      .then(res => res.json())
      .then(data => {
        alert(data.mensaje || data.error);
        cargarSedes();
        limpiarFormulario();
      });
    });

    btnCancelar.addEventListener('click', limpiarFormulario);

    cargarSedes();

    

  </script>
</body>
</html>
