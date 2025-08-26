// backend/controllers/sedes.controller.js
const conexion = require("../conexion");

// Obtener todas las sedes
const getSedes = (req, res) => {
  conexion.query("SELECT * FROM sedes", (err, results) => {
    if (err) {
      res.status(500).json({ error: "Error al obtener sedes" });
      return;
    }
    res.json(results);
  });
};

// Crear nueva sede
const createSede = (req, res) => {
  const { nombre, direccion, barrio } = req.body;
  if (!nombre || !direccion || !barrio) {
    res.status(400).json({ error: "Todos los campos son obligatorios" });
    return;
  }

  conexion.query(
    "INSERT INTO sedes (nombre, direccion, barrio) VALUES (?, ?, ?)",
    [nombre, direccion, barrio],
    (err) => {
      if (err) {
        res.status(500).json({ error: "Error al crear la sede" });
        return;
      }
      res.json({ mensaje: "✅ Sede creada correctamente" });
    }
  );
};

module.exports = { getSedes, createSede };
