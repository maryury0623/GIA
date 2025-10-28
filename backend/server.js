const express = require("express");
const cors = require("cors");
const app = express();

// Middleware
app.use(express.json());
app.use(cors());

// Rutas
const sedesRoutes = require("./routes/sedes.routes");
app.use("/api/sedes", sedesRoutes);

// 🔹 Nueva ruta de login
const loginRoutes = require("./routes/login.routes");
app.use("/api/login", loginRoutes);

// Ruta raíz para prueba
app.get("/", (req, res) => {
  res.send("Servidor backend activo 🚀");
});

// Puerto
const PORT = 3001;
app.listen(PORT, () => {
  console.log(`✅ Servidor backend corriendo en http://localhost:${PORT}`);
});

