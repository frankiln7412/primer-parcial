<?php
/*
    Este archivo maneja el registro de un nuevo contacto.
    - GET: muestra el formulario de alta.
    - POST: guarda el nuevo contacto en la base de datos.
*/

require_once '../modelos/Contacto.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nuevoContacto = new Contacto();
    $nuevoContacto->nombre = $_POST['nombre'];
    $nuevoContacto->apellido = $_POST['apellido'];
    $nuevoContacto->telefono = $_POST['telefono'];
    $nuevoContacto->correo = $_POST['email'];
    $nuevoContacto->categoria_id = $_POST['categoria_id'];
    $nuevoContacto->create();

    header('Location: index2.php?mensaje=agregado');
    exit;

} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    
    require_once '../modelos/Categoria.php';

    $categoria = new Categoria();
    $categorias = $categoria->getAll(); // ✔ Esto sí existe

    include '../vistas/crear.php';
    exit;
}
