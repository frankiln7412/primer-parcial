<?php
class Conexion {
    protected $link;
    private $host = 'localhost';
    private $user = 'root';
    private $pass = '';
    private $dbname = 'agenda_contactos';
    private $puerto = 3306;

    public function conectar() {
        try {
            $this->link = new mysqli(
                $this->host,
                $this->user,
                $this->pass,
                $this->dbname,
                $this->puerto
            );
        } catch (Exception $e) {
            echo "No se pudo establecer conexión: " . $e->getMessage();
            exit;
        }
    }
}
