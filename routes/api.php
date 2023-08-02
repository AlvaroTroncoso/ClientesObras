<?php
// Configuración para mostrar errores en el archivo api.php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('../controllers/ClienteController.php');
require_once('../controllers/ObraController.php');
// Función para obtener el método de la solicitud HTTP
function getRequestMethod()
{
    return $_SERVER['REQUEST_METHOD'];
}

// Función para obtener la ruta solicitada
function getRequestPath()
{
    $path = $_SERVER['REQUEST_URI'];
    $path = explode('?', $path)[0]; // Eliminar la cadena de consulta (si existe)
    $path = rtrim($path, '/'); // Eliminar la barra final (si existe)
    return $path;
}

// Función para obtener el ID de la ruta (si existe)
function getRequestId()
{
    $path = getRequestPath();
    $parts = explode('/', $path);
    $id = end($parts);
    return is_numeric($id) ? intval($id) : null;
}

// Función para obtener los datos enviados en el cuerpo de la solicitud
function getRequestData()
{
    return json_decode(file_get_contents('php://input'), true);
}

// Función para enviar una respuesta en formato JSON
function jsonResponse($data, $status = 200)
{
    http_response_code($status);
    header('Content-Type: application/json');
    echo json_encode($data);
}

// Rutas para el CRUD de Clientes
if (getRequestPath() === '/api/clientes' && getRequestMethod() === 'GET') {
    $clienteController = new ClienteController();
    jsonResponse($clienteController->getAll());
} elseif (preg_match('/^\/api\/clientes\/(\d+)$/', getRequestPath(), $matches) && getRequestMethod() === 'GET') {
    $id = $matches[1];
    $clienteController = new ClienteController();
    jsonResponse($clienteController->getById($id));
} elseif (getRequestPath() === '/api/clientes' && getRequestMethod() === 'POST') {
    $data = getRequestData();
    $clienteController = new ClienteController();
    if ($clienteController->create($data)) {
        jsonResponse(array("message" => "Cliente creado exitosamente."));
    } else {
        jsonResponse(array("message" => "Error al crear el cliente."), 500);
    }
} elseif (preg_match('/^\/api\/clientes\/(\d+)$/', getRequestPath(), $matches) && getRequestMethod() === 'PUT') {
    $id = $matches[1];
    $data = getRequestData();
    $clienteController = new ClienteController();
    if ($clienteController->update($id, $data)) {
        jsonResponse(array("message" => "Cliente actualizado exitosamente."));
    } else {
        jsonResponse(array("message" => "Error al actualizar el cliente."), 500);
    }
} elseif (preg_match('/^\/api\/clientes\/(\d+)$/', getRequestPath(), $matches) && getRequestMethod() === 'DELETE') {
    $id = $matches[1];
    $clienteController = new ClienteController();
    if ($clienteController->delete($id)) {
        jsonResponse(array("message" => "Cliente eliminado exitosamente."));
    } else {
        jsonResponse(array("message" => "Error al eliminar el cliente."), 500);
    }
}

// Rutas para el CRUD de Obras
elseif (getRequestPath() === '/api/obras' && getRequestMethod() === 'GET') {
    $obraController = new ObraController();
    jsonResponse($obraController->getAll());
} elseif (preg_match('/^\/api\/obras\/(\d+)$/', getRequestPath(), $matches) && getRequestMethod() === 'GET') {
    $id = $matches[1];
    $obraController = new ObraController();
    jsonResponse($obraController->getById($id));
} elseif (getRequestPath() === '/api/obras' && getRequestMethod() === 'POST') {
    $data = getRequestData();
    $obraController = new ObraController();
    if ($obraController->create($data)) {
        jsonResponse(array("message" => "Obra creada exitosamente."));
    } else {
        jsonResponse(array("message" => "Error al crear la obra."), 500);
    }
} elseif (preg_match('/^\/api\/obras\/(\d+)$/', getRequestPath(), $matches) && getRequestMethod() === 'PUT') {
    $id = $matches[1];
    $data = getRequestData();
    $obraController = new ObraController();
    if ($obraController->update($id, $data)) {
        jsonResponse(array("message" => "Obra actualizada exitosamente."));
    } else {
        jsonResponse(array("message" => "Error al actualizar la obra."), 500);
    }
} elseif (preg_match('/^\/api\/obras\/(\d+)$/', getRequestPath(), $matches) && getRequestMethod() === 'DELETE') {
    $id = $matches[1];
    $obraController = new ObraController();
    if ($obraController->delete($id)) {
        jsonResponse(array("message" => "Obra eliminada exitosamente."));
    } else {
        jsonResponse(array("message" => "Error al eliminar la obra."), 500);
    }
} else {
    jsonResponse(array("message" => "Ruta no encontrada."), 404);
}