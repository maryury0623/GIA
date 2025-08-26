const mysql = require('mysql2');

const conexion = mysql.createConnection({
    host: 'localhost',
    user: 'root',
    password: '',
    database: 'GIA', // cambia si tu BD se llama distinto
    port: 3310 // el puerto que uses en XAMPP
});

conexion.connect(err => {
    if (err) {
        console.error('Error al conectar a MySQL:', err);
        return;
    }
    console.log('✅ Conexión a MySQL exitosa');
});

module.exports = conexion;
