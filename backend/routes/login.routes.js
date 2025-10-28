const express = require("express");
const router = express.Router();
const db = require("../db");

// Ruta de login
router.post("/", (req, res) => {
  const { usuario, contraseña } = req.body;

  // Validar que los datos vengan en el body
  if (!usuario || !contraseña) {
    return res.status(400).json({ error: "Faltan datos de autenticación" });
  }

  // Consultar el usuario en la base de datos
  const query = "SELECT * FROM usuarios WHERE usuario = ? AND contraseña = ?";
  db.query(query, [usuario, contraseña], (err, results) => {
    if (err) {
      console.error("❌ Error en la consulta:", err);
      return res.status(500).json({ error: "Error en el servidor" });
    }

    // Si no hay coincidencias
    if (results.length === 0) {
      return res.status(401).json({ error: "Credenciales incorrectas" });
    }

    // Si el usuario existe
    res.status(200).json({
      mensaje: "Inicio de sesión exitoso ✅",
      usuario: results[0].usuario
    });
  });
});

module.exports = router;
