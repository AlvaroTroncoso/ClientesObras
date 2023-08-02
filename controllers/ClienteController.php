<?php

require_once('../models/Cliente.php');
//por
class ClienteController
{
    private $cliente;

    public function __construct()
    {
        $this->cliente = new Cliente();
    }

    // Función para obtener todos los clientes
    public function getAll()
    {
        return $this->cliente->getAll();
    }

    // Función para obtener un cliente por su ID
    public function getById($id)
    {
        return $this->cliente->getById($id);
    }

    // Función para crear un nuevo cliente
    public function create($data)
    {
        $this->cliente->rut = $data['rut'];
        $this->cliente->nombre = $data['nombre'];
        $this->cliente->fono = $data['fono'];
        $this->cliente->correo = $data['correo'];

        if ($this->cliente->create()) {
            return true;
        } else {
            return false;
        }
    }

    // Función para actualizar un cliente existente
    public function update($id, $data)
    {
        $this->cliente->id = $id;
        $this->cliente->rut = $data['rut'];
        $this->cliente->nombre = $data['nombre'];
        $this->cliente->fono = $data['fono'];
        $this->cliente->correo = $data['correo'];

        if ($this->cliente->update()) {
            return true;
        } else {
            return false;
        }
    }

    // Función para eliminar un cliente por su ID
    public function delete($id)
    {
        if ($this->cliente->delete($id)) {
            return true;
        } else {
            return false;
        }
    }
}