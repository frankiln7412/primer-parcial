<?php require_once '../modelos/celular.php'; ?>
<?php
$tel_modelo = new Telefono();
$telefonos = $tel_modelo->getPorpersona($datos['persona_id']);
$tel_mostrados = $telefonos ? implode(", ", $telefonos) : "Sin teléfono";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Confirmar eliminación</title>
    <link rel="stylesheet" href="../bonito.css">
</head>
<body>
    <div class="contenedor">
        <h1>Confirmar Eliminación</h1>

        <p>¿Deseas eliminar el siguiente contacto?</p>
        <ul>
            <li>ID: <?= htmlspecialchars($datos['persona_id']) ?></li>
            <li>Nombre: <?= htmlspecialchars($datos['nombre']) ?></li>
            <li>Apellido: <?= htmlspecialchars($datos['apellido']) ?></li>
            <li>Teléfonos: <?= htmlspecialchars($tel_mostrados) ?></li>
            <li>Correo: <?= htmlspecialchars($datos['email']) ?></li>
        </ul>

        <form action="eliminar.php" method="POST">
            <input type="hidden" name="id" value="<?= htmlspecialchars($datos['persona_id']) ?>">
            <button type="submit">Eliminar</button>
            <a href="contacto_index3.php">Cancelar</a>
        </form>
    </div>
</body>
</html>
