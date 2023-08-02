<?php

require_once('../config/database.php');

class Cliente
{
    // Propiedades de la entidad Cliente
    public $id;
    public $rut;
    public $nombre;
    public $fono;
    public $correo;

    private $conn;
    private $table_name = "cliente"; // Nombre de la tabla en la base de datos

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Función para obtener todos los clientes
    public function getAll()
    {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Función para obtener un cliente por su ID
    public function getById($id)
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt;
    }

    // Función para crear un nuevo cliente
    public function create()
    {
        $query = "INSERT INTO " . $this->table_name . " (rut, nombre, fono, correo) VALUES (:rut, :nombre, :fono, :correo)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":rut", $this->rut);
        $stmt->bindParam(":nombre", $this->nombre);
        $stmt->bindParam(":fono", $this->fono);
        $stmt->bindParam(":correo", $this->correo);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // Función para actualizar un cliente existente
    public function update()
    {
        $query = "UPDATE " . $this->table_name . " SET rut = :rut, nombre = :nombre, fono = :fono, correo = :correo WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $this->id);
        $stmt->bindParam(":rut", $this->rut);
        $stmt->bindParam(":nombre", $this->nombre);
        $stmt->bindParam(":fono", $this->fono);
        $stmt->bindParam(":correo", $this->correo);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // Función para eliminar un cliente por su ID
    public function delete($id)
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}