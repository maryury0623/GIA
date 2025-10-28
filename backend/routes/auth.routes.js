router.post('/login', (req, res) => {
  const { usuario, contraseña } = req.body;

  if (!usuario || !contraseña) {
    return res.status(400).json({ error: 'Faltan datos de autenticación' });
  }

  const query = "SELECT * FROM usuarios WHERE usuario = ?";
  db.query(query, [usuario], async (err, results) => {
    if (err) {
      console.error('❌ Error al ejecutar consulta:', err);
      return res.status(500).json({ error: 'Error en el servidor' });
    }

    if (results.length === 0) {
      return res.status(401).json({ error: 'Credenciales incorrectas' });
    }

    const user = results[0];

    // ✅ comparar contraseñas encriptadas
    if (user.contraseña !== contraseña) {
  return res.status(401).json({ error: 'Credenciales incorrectas' });
}


    res.json({ mensaje: 'Inicio de sesión exitoso', usuario: user.usuario });
  });
});
