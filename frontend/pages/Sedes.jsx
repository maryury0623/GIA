import React, { useState, useEffect } from "react";

function Sedes() {
  const [sedes, setSedes] = useState([]);
  const [nombre, setNombre] = useState("");
  const [direccion, setDireccion] = useState("");
  const [barrio, setBarrio] = useState("");
  const [mensaje, setMensaje] = useState("");

  // Cargar sedes al iniciar
  useEffect(() => {
    fetch("http://localhost:3310/sedes")
      .then(res => res.json())
      .then(data => setSedes(data))
      .catch(err => console.error("Error cargando sedes:", err));
  }, []);

  // Crear nueva sede
  const crearSede = (e) => {
    e.preventDefault();

    fetch("http://localhost:3001/sedes", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({ nombre, direccion, barrio })
    })
      .then(res => res.json())
      .then(data => {
        setMensaje(data.mensaje);
        setNombre("");
        setDireccion("");
        setBarrio("");
        // Volver a cargar sedes
        return fetch("http://localhost:3001/sedes");
      })
      .then(res => res.json())
      .then(data => setSedes(data))
      .catch(err => console.error("Error creando sede:", err));
  };

  return (
    <div style={{ padding: "20px" }}>
      <h1>Gestión de Sedes</h1>

      {/* Botón para regresar */}
      <button
        onClick={() => (window.location.href = "/modulo-asignacion")}
        style={{
          backgroundColor: "#555",
          color: "white",
          padding: "8px 16px",
          border: "none",
          borderRadius: "5px",
          marginBottom: "15px",
          cursor: "pointer"
        }}
      >
        ← Regresar al módulo de asignación
      </button>

      {/* Formulario */}
      <form onSubmit={crearSede} style={{ marginBottom: "20px" }}>
        <input
          type="text"
          placeholder="Nombre"
          value={nombre}
          onChange={(e) => setNombre(e.target.value)}
          required
        />
        <input
          type="text"
          placeholder="Dirección"
          value={direccion}
          onChange={(e) => setDireccion(e.target.value)}
          required
        />
        <input
          type="text"
          placeholder="Barrio"
          value={barrio}
          onChange={(e) => setBarrio(e.target.value)}
          required
        />
        <button type="submit">Crear Sede</button>
      </form>

      {mensaje && <p style={{ color: "green" }}>{mensaje}</p>}

      {/* Tabla de sedes */}
      <table border="1" cellPadding="8">
        <thead>
          <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Dirección</th>
            <th>Barrio</th>
          </tr>
        </thead>
        <tbody>
          {sedes.length > 0 ? (
            sedes.map((sede) => (
              <tr key={sede.id}>
                <td>{sede.id}</td>
                <td>{sede.nombre}</td>
                <td>{sede.direccion}</td>
                <td>{sede.barrio}</td>
              </tr>
            ))
          ) : (
            <tr>
              <td colSpan="4">No hay sedes registradas</td>
            </tr>
          )}
        </tbody>
      </table>
    </div>
  );
}

export default Sedes;
