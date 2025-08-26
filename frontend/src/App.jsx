import { BrowserRouter as Router, Routes, Route } from "react-router-dom";
import Sedes from "./pages/Sedes";
import ModuloAsignacion from "./pages/ModuloAsignacion";

function App() {
  return (
    <Router>
      <Routes>
        <Route path="/" element={<ModuloAsignacion />} />
        <Route path="/modulo-asignacion" element={<ModuloAsignacion />} />
        <Route path="/sedes" element={<Sedes />} />
      </Routes>
    </Router>
  );
}

export default App;
