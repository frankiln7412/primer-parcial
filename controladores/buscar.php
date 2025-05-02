<?php
require_once '../modelos/Contacto.php';

$instanciaContacto = new Contacto();

$consulta = isset($_GET['q']) ? trim($_GET['q']) : '';

if (!empty($consulta)) {
    // Llamamos al método buscar() para obtener los resultados
    $listaContactos = $instanciaContacto->buscar($consulta);
} else {
    // Si no se ingresó búsqueda, mostramos todos los contactos
    $listaContactos = $instanciaContacto->getAllConTelefonos();
}

include '../vistas/lista.php'; // Incluimos la vista para mostrar los resultados
exit;
