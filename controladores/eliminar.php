<?php
/*
    Script para gestionar la eliminación de un contacto.
    - Si es POST: elimina el contacto.
    - Si es GET: muestra la vista de confirmación.
*/

require_once '../modelos/Contacto.php';

$controladorContacto = new Contacto();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Proceder con la eliminación
    $controladorContacto->delete($_POST['persona_id']);
    header('Location: index2.php?mensaje=eliminado');
    exit;

} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Obtener datos para confirmar la eliminación
    $infoContacto = $controladorContacto->getFirst($_GET['id']);

    if (!$infoContacto) {
        echo "No se encontró un contacto con el ID {$_GET['id']}.";
        exit;
    }
    $datos = $infoContacto;
    include '../vistas/eliminar2.php';
    
    exit;
}
