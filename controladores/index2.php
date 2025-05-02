<?php
// Controlador para mostrar la lista de contactos

require_once '../modelos/Contacto.php'; // Importamos el modelo

$contacto = new Contacto();            // Creamos instancia
$contactos = $contacto->getAllConTelefonos();      // Obtenemos todos los contactos

include '../vistas/lista.php';  // Mostramos la vista
exit;
