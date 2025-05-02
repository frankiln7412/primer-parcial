<?php
require_once "Coneccion.php";
require_once 'celular.php';

class Contacto extends Conexion {
    public $persona_id;
    public $nombre;
    public $apellido;
    public $email;
    public $tipo_id;

    public function create() {
        $this->conectar();
        $sql = $this->link->prepare(
            "INSERT INTO personas (nombre, apellido, email, tipo_id) VALUES (?, ?, ?, ?)"
        );
        $sql->bind_param("sssi", $this->nombre, $this->apellido, $this->email, $this->tipo_id);
        $sql->execute();
        $this->persona_id = $this->link->insert_id; // Guardar el ID recién insertado
        $sql->close();
    }

    public function getAll() {
        $this->conectar();
        $sql = $this->link->prepare(
            "SELECT p.*, t.tipo_nombre, t.tipo_descripcion
             FROM personas p
             LEFT JOIN tipos t ON p.tipo_id = t.tipo_id
             ORDER BY p.persona_id ASC"
        );
        $sql->execute();
        $res = $sql->get_result();

        $datos = [];
        while ($fila = $res->fetch_assoc()) {
            $datos[] = $fila;
        }

        return $datos;
    }

    public function getFirst($persona_id) {
        $this->conectar();
        $sql = $this->link->prepare("SELECT * FROM personas WHERE persona_id = ?");
        $sql->bind_param("i", $persona_id);
        $sql->execute();
        return $sql->get_result()->fetch_assoc();
    }

    public function update($persona_id) {
        $this->conectar();
        $sql = $this->link->prepare(
            "UPDATE personas SET nombre = ?, apellido = ?, email = ?, tipo_id = ? WHERE persona_id = ?"
        );
        $sql->bind_param("sssii", $this->nombre, $this->apellido, $this->email, $this->tipo_id, $persona_id);
        $sql->execute();
        $sql->close();
    }

    public function delete($persona_id) {
        $this->conectar();
        $sql = $this->link->prepare("DELETE FROM personas WHERE persona_id = ?");
        $sql->bind_param("i", $persona_id);
        $sql->execute();
        $sql->close();
    }

    public function buscar($filtro) {
        $this->conectar();
        $busqueda = "%$filtro%";
        $sql = $this->link->prepare(
            "SELECT p.*, t.tipo_nombre
             FROM personas p
             LEFT JOIN tipos t ON p.tipo_id = t.tipo_id
             WHERE p.nombre LIKE ? OR p.apellido LIKE ? OR p.email LIKE ?"
        );
        $sql->bind_param("sss", $busqueda, $busqueda, $busqueda); // Buscar por nombre, apellido o correo
        $sql->execute();
        $res = $sql->get_result();

        $resultados = [];
        while ($item = $res->fetch_assoc()) {
            $resultados[] = $item;
        }

        return $resultados;
    }

    public function getAllConTelefonos() {
        $this->conectar();
    
        $sql = $this->link->prepare(
            "SELECT p.*, t.tipo_nombre
             FROM personas p
             LEFT JOIN tipos t ON p.tipo_id = t.tipo_id"
        );
        $sql->execute();
        $res = $sql->get_result();
    
        $conjunto = [];
        while ($fila = $res->fetch_assoc()) {
            $tel = new Telefono(); // Cambié de Telefono a Celular
            $fila['telefonos'] = $tel->getPorPersona($fila['persona_id']); // Llamar al método de Celular
            $conjunto[] = $fila;
        }
    
        return $conjunto;
    }
}
