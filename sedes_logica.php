<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Content-Type: application/json');

include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['id'])) {
        $id = intval($_GET['id']);
        $stmt = $conexion->prepare("SELECT * FROM sedes WHERE IdSedes = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $res = $stmt->get_result();
        if ($res->num_rows > 0) {
            echo json_encode($res->fetch_assoc());
        } else {
            http_response_code(404);
            echo json_encode(["error" => "Sede no encontrada"]);
        }
    } else {
        $result = $conexion->query("SELECT * FROM sedes");
        $sedes = [];
        while ($fila = $result->fetch_assoc()) {
            $sedes[] = $fila;
        }
        echo json_encode($sedes);
    }
} else {
    $datos = json_decode(file_get_contents('php://input'), true);
    $accion = $_SERVER['REQUEST_METHOD'];

    switch ($accion) {
        case 'POST':
            if (!isset($datos['Nombre'], $datos['Direccion'], $datos['Barrio'], $datos['Telefono'])) {
                http_response_code(400);
                echo json_encode(["error" => "Faltan datos para crear sede"]);
                exit;
            }
            $stmt = $conexion->prepare("INSERT INTO sedes (Nombre, Direccion, Barrio, Telefono) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $datos['Nombre'], $datos['Direccion'], $datos['Barrio'], $datos['Telefono']);
            if ($stmt->execute()) {
                echo json_encode(["mensaje" => "Sede creada", "id" => $stmt->insert_id]);
            } else {
                http_response_code(500);
                echo json_encode(["error" => "Error al crear sede"]);
            }
            break;

        case 'PUT':
            if (!isset($datos['IdSedes'], $datos['Nombre'], $datos['Direccion'], $datos['Barrio'], $datos['Telefono'])) {
                http_response_code(400);
                echo json_encode(["error" => "Faltan datos para modificar sede"]);
                exit;
            }
            $stmt = $conexion->prepare("UPDATE sedes SET Nombre=?, Direccion=?, Barrio=?, Telefono=? WHERE IdSedes=?");
            $stmt->bind_param("ssssi", $datos['Nombre'], $datos['Direccion'], $datos['Barrio'], $datos['Telefono'], $datos['IdSedes']);
            if ($stmt->execute()) {
                echo json_encode(["mensaje" => "Sede modificada"]);
            } else {
                http_response_code(500);
                echo json_encode(["error" => "Error al modificar sede"]);
            }
            break;

        case 'DELETE':
            parse_str(file_get_contents("php://input"), $params);
            $id = $params['id'] ?? null;
            if (!$id) {
                http_response_code(400);
                echo json_encode(["error" => "Falta ID para eliminar"]);
                exit;
            }
            $stmt = $conexion->prepare("DELETE FROM sedes WHERE IdSedes=?");
            $stmt->bind_param("i", $id);
            if ($stmt->execute()) {
                echo json_encode(["mensaje" => "Sede eliminada"]);
            } else {
                http_response_code(500);
                echo json_encode(["error" => "Error al eliminar sede"]);
            }
            break;

        default:
            http_response_code(405);
            echo json_encode(["error" => "Método no permitido"]);
    }
}

$conexion->close();
?>
