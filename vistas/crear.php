<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nuevo Contacto</title>
    <link rel="stylesheet" href="../public/bonito.css">
</head>
<body>
    <div class="contenedor">
        <h1>Agregar Contacto</h1>

        <form action="contacto_store.php" method="POST" class="formulario">
            <label>Nombre:</label>
            <input type="text" name="nombre" required>

            <label>Apellido:</label>
            <input type="text" name="apellido" required>

            <label>Teléfono:</label>
            <input type="text" name="telefono" required>

            <label>Email:</label>
            <input type="email" name="correo">

            <label>Categoría:</label>
            <select name="tipo_id" required>
                 <option value="">-- Seleccione --</option>
                     <?php foreach ($categorias as $cat): ?>
                 <option value="<?= $cat['tipo_id'] ?>"><?= htmlspecialchars($cat['tipo_nombre']) ?></option>
                      <?php endforeach; ?>
            </select>
            <button type="submit">Guardar</button>
        </form>

        <div class="acciones">
            <a href="lista.php" class="btn-volver">← Regresar</a>
        </div>
    </div>
</body>
</html>
