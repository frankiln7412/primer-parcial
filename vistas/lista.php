<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Contactos</title>
    <link rel="stylesheet" href="../ka/bonito.css">
</head>
<body>
<div class="contenedor">
    <?php 
    require_once '../modelos/celular.php';
    $tel_modelo = new Telefono();


    ?>

    <h1>Directorio de Contactos</h1>

    <?php if (isset($_GET['mensaje'])): ?>
        <div class="alerta">
            <?= match ($_GET['mensaje']) {
                'agregado' => '✅ Contacto guardado con éxito.',
                'actualizado' => '✏️ Contacto modificado correctamente.',
                'eliminado' => '🗑️ Contacto eliminado.',
                default => '✔️ Operación realizada.'
            }; ?>
        </div>
    <?php endif; ?>

    <form action="buscar.php" method="GET" class="busqueda">
        <input type="text" name="q" placeholder="Buscar contacto..." value="<?= htmlspecialchars($_GET['q'] ?? '') ?>">
        <button type="submit">Buscar</button>
    </form>

    <a href="almacenar.php" class="boton-agregar">+ Nuevo</a>

   <table>
    <thead>
        <tr>
            <th>ID</th><th>Nombre</th><th>Apellido</th><th>Teléfono</th><th>Correo</th><th>Tipo</th><th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($listaContactos)): ?>
            <?php foreach ($listaContactos as $c): ?>
                <tr>
                    <td><?= htmlspecialchars($c['persona_id']) ?></td>
                    <td><?= htmlspecialchars($c['nombre']) ?></td>
                    <td><?= htmlspecialchars($c['apellido']) ?></td>
                    <td>
                        <?php
                        // Asegúrate de que los teléfonos estén presentes
                        $telefonos = $c['telefonos'] ?? [];
                        echo htmlspecialchars(implode(", ", $telefonos));
                        ?>
                    </td>
                    <td><?= htmlspecialchars($c['email']) ?></td>
                    <td><?= htmlspecialchars($c['tipo_nombre']) ?></td>
                    <td>
                        <a href="actualizar.php?id=<?= $c['persona_id'] ?>" class="boton-actualizar">Editar</a>
                        <a href="eliminar.php?id=<?= $c['persona_id'] ?>" class="boton-eliminar">Borrar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="7">No hay resultados para la búsqueda.</td></tr>
        <?php endif; ?>
    </tbody>
</table>


</body>
</html>
