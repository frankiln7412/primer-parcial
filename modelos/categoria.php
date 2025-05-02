<?php
require_once "Coneccion.php";
class Categoria extends Conexion {
    public function getAll() {
        $this->conectar();
        $sql = $this->link->prepare("SELECT * FROM tipos");
        $sql->execute();
        $sql->store_result();
        $sql->bind_result($tipo_id, $tipo_nombre, $tipo_descripcion);

        $resultadoFinal = [];
        while ($sql->fetch()) {
            $resultadoFinal[] = [
                'tipo_id' => $tipo_id,
                'tipo_nombre' => $tipo_nombre,
                'tipo_descripcion' => $tipo_descripcion
            ];
        }

        return $resultadoFinal;
    }
}
