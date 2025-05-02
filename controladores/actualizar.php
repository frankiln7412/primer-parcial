<?php
/*
    Controlador para editar un contacto existente.
    - POST: aplica los cambios.
    - GET: muestra formulario con los datos actuales.
*/

require_once '../modelos/contacto.php';
require_once '../modelos/categoria.php';
require_once '../modelos/celular.php';

$modeloContacto = new Contacto();
$modeloCategoria = new Categoria();
$modTelefono = new Telefono();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!filter_var($_POST['correo'], FILTER_VALIDATE_EMAIL)) {
        echo "El correo ingresado no es válido.";
        exit;
    }

    $modeloContacto->id = $_POST['persona_id'];
    $modeloContacto->nombre = $_POST['nombre'];
    $modeloContacto->apellido = $_POST['apellido'];
    $modeloContacto->correo = $_POST['email'];
    $modeloContacto->categoria_id = $_POST['categoria_id'];

    $modeloContacto->update($modeloContacto->id);

    if (!empty($_POST['telefono']) && is_array($_POST['telefono'])) {
        $modTelefono->actualizarTelefonos($modeloContacto->id, $_POST['telefono']);
    }

    header('Location: contacto_index.php?mensaje=actualizado');
    exit;

} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $info = $modeloContacto->getFirst($_GET['id']);
    $listaCategorias = $modeloCategoria->getAll();

    if (!$info) {
        echo "No existe un contacto con el ID proporcionado ({$_GET['id']}).";
        exit;
    }

    include '../vistas/actualizar2.php';
    exit;
}
