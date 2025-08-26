const mysql = require("mysql");

const connection = mysql.createConnection({
  host: "localhost",
  user: "root",
  password: "", // deja vacío si no tienes contraseña en XAMPP
  database: "GIA", // cambia por el nombre real de tu BD
  port: 3310 // puerto MySQL de XAMPP
});

connection.connect((err) => {
  if (err) {
    console.error("❌ Error al conectar a MySQL:", err);
    return;
  }
  console.log("✅ Conexión a MySQL exitosa");
});

module.exports = connection;