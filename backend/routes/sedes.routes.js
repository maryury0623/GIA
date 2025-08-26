const express = require("express");
const router = express.Router();
const db = require("../db");

// Obtener todas las sedes
router.get("/", (req, res) => {
  db.query("SELECT * FROM sedes", (err, results) => {
    if (err) {
      console.error("❌ Error obteniendo sedes:", err);
      return res.status(500).json({ error: "Error en el servidor" });
    }
    res.json(results);
  });
});

// Crear una sede
router.post("/", (req, res) => {
  const { nombre, direccion, barrio } = req.body;

  if (!nombre || !direccion || !barrio) {
    return res.status(400).json({ error: "Todos los campos son obligatorios" });
  }

  db.query(
    "INSERT INTO sedes (nombre, direccion, barrio) VALUES (?, ?, ?)",
    [nombre, direccion, barrio],
    (err, result) => {
      if (err) {
        console.error("❌ Error creando sede:", err);
        return res.status(500).json({ error: "Error al crear sede" });
      }
      res.json({ mensaje: "Sede creada exitosamente" });
    }
  );
});

module.exports = router;
