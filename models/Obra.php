<?php

require_once('../config/database.php');

class Obra
{
    // Propiedades de la entidad Obra
    public $id;
    public $id_cliente;
    public $nombre_obra;
    public $direccion;

    private $conn;
    private $table_name = "obra"; // Nombre de la tabla en la base de datos

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Función para obtener todas las obras
    public function getAll()
    {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Función para obtener una obra por su ID
    public function getById($id)
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt;
    }

    // Función para crear una nueva obra
    public function create()
    {
        $query = "INSERT INTO " . $this->table_name . " (id_cliente, nombre_obra, direccion) VALUES (:id_cliente, :nombre_obra, :direccion)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id_cliente", $this->id_cliente);
        $stmt->bindParam(":nombre_obra", $this->nombre_obra);
        $stmt->bindParam(":direccion", $this->direccion);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // Función para actualizar una obra existente
    public function update()
    {
        $query = "UPDATE " . $this->table_name . " SET id_cliente = :id_cliente, nombre_obra = :nombre_obra, direccion = :direccion WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $this->id);
        $stmt->bindParam(":id_cliente", $this->id_cliente);
        $stmt->bindParam(":nombre_obra", $this->nombre_obra);
        $stmt->bindParam(":direccion", $this->direccion);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // Función para eliminar una obra por su ID
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