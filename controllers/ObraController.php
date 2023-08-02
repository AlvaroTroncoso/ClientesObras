<?php

require_once('../models/Obra.php');

class ObraController
{
    private $obra;

    public function __construct()
    {
        $this->obra = new Obra();
    }

    // Función para obtener todas las obras
    public function getAll()
    {
        return $this->obra->getAll();
    }

    // Función para obtener una obra por su ID
    public function getById($id)
    {
        return $this->obra->getById($id);
    }

    // Función para crear una nueva obra
    public function create($data)
    {
        $this->obra->id_cliente = $data['id_cliente'];
        $this->obra->nombre_obra = $data['nombre_obra'];
        $this->obra->direccion = $data['direccion'];

        if ($this->obra->create()) {
            return true;
        } else {
            return false;
        }
    }

    // Función para actualizar una obra existente
    public function update($id, $data)
    {
        $this->obra->id = $id;
        $this->obra->id_cliente = $data['id_cliente'];
        $this->obra->nombre_obra = $data['nombre_obra'];
        $this->obra->direccion = $data['direccion'];

        if ($this->obra->update()) {
            return true;
        } else {
            return false;
        }
    }

    // Función para eliminar una obra por su ID
    public function delete($id)
    {
        if ($this->obra->delete($id)) {
            return true;
        } else {
            return false;
        }
    }
}