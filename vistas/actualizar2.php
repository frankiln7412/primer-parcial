<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Contactos</title>
    <link rel="stylesheet" href="../public/bonito.css">
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

    <form action="contacto_buscar.php" method="GET" class="busqueda">
        <input type="text" name="q" placeholder="Buscar contacto..." value="<?= htmlspecialchars($_GET['q'] ?? '') ?>">
        <button type="submit">Buscar</button>
    </form>

    <a href="contacto_store.php" class="boton-agregar">+ Nuevo</a>

    <table>
        <thead>
            <tr>
                <th>ID</th><th>Nombre</th><th>Apellido</th><th>Teléfono</th><th>Correo</th><th>Categoría</th><th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($contactos)): ?>
                <?php foreach ($contactos as $c): ?>
                    <tr>
                        <td><?= $c['id'] ?></td>
                        <td><?= htmlspecialchars($c['nombre']) ?></td>
                        <td><?= htmlspecialchars($c['apellido']) ?></td>
                        <?php
                        $telefonos = $tel_modelo->getPorContacto($c['id']);
                        $tel_mostrados = implode(", ", $telefonos);
                        ?>
                        <td><?= htmlspecialchars($tel_mostrados) ?></td>
                        <td><?= htmlspecialchars($c['correo']) ?></td>
                        <td><?= htmlspecialchars($c['categoria_nombre']) ?></td>
                        <td>
                            <a href="contacto_update.php?id=<?= $c['id'] ?>" class="boton-actualizar">Editar</a>
                            <a href="contacto_delete.php?id=<?= $c['id'] ?>" class="boton-eliminar">Borrar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="7">No hay resultados.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>

    <a href="../index.php" class="btn-volver">← Inicio</a>
</div>
</body>
</html>
