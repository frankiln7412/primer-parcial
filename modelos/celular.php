<?php
require_once "Coneccion.php";  // Si usas una clase de conexión, asegúrate de incluirla

class Telefono  extends Conexion {  // Asegúrate de que la clase se llama Celular

    public function getPorPersona($idPersona) {
        $this->conectar();
        $sql = $this->link->prepare("SELECT telefono FROM celulares WHERE persona_id = ?");
        $sql->bind_param("i", $idPersona);
        $sql->execute();
        $res = $sql->get_result();

        $telefonos = [];
        while ($fila = $res->fetch_assoc()) {
            $telefonos[] = $fila['telefono'];
        }

        return $telefonos;
    }

    public function insertar($telefono, $idPersona) {
        $this->conectar();
        $sql = $this->link->prepare("INSERT INTO celulares (telefono, persona_id) VALUES (?, ?)");
        $sql->bind_param("si", $telefono, $idPersona);
        $sql->execute();
        $sql->close();
    }

    public function eliminarPorPersona($idPersona) {
        $this->conectar();
        $sql = $this->link->prepare("DELETE FROM celulares WHERE persona_id = ?");
        $sql->bind_param("i", $idPersona);
        $sql->execute();
        $sql->close();
    }

    public function actualizarTelefonos($idPersona, $telefonosArray) {
        $this->eliminarPorPersona($idPersona);

        foreach ($telefonosArray as $telefono) {
            $telefono = trim($telefono);
            if (!empty($telefono)) {
                $this->insertar($telefono, $idPersona);
            }
        }
    }
}
?>

