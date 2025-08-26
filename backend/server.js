const express = require("express");
const cors = require("cors");
const app = express();

// Middleware
app.use(express.json());
app.use(cors());

// Rutas
const sedesRoutes = require("./routes/sedes.routes");
app.use("/api/sedes", sedesRoutes);

// Ruta raíz para prueba
app.get("/", (req, res) => {
  res.send("Servidor backend activo 🚀");
});

// Puerto
const PORT = 3001; // mantenemos este
app.listen(PORT, () => {
  console.log(`✅ Servidor backend corriendo en http://localhost:${PORT}`);
});
