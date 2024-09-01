<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Justicia Para Todos</title>
    <link rel="stylesheet" href="./styles/index.css">
</head>

<body>
    <div class="container">
        <h1>Registro Cliente</h1>
        <?= $message; ?>
        <form action="index.php" method="POST">
            <label for="nombre">Nombre</label>
            <input type="text" id="nombre" name="nombre" required pattern="[A-Za-z\s]{2,50}" title="Nombre debe contener entre 2 y 50 caracteres, solo letras y espacios">

            <label for="apellido">Apellido</label>
            <input type="text" id="apellido" name="apellido" required pattern="[A-Za-z\s]{2,50}" title="Apellido debe contener entre 2 y 50 caracteres, solo letras y espacios">

            <label for="rut">RUT</label>
            <input type="text" id="rut" name="rut" required pattern="\d{1,2}\.\d{3}\.\d{3}-[\dkK]{1}" title="Formato RUT válido: 12.345.678-9">

            <label for="direccion">Dirección</label>
            <input type="text" id="direccion" name="direccion" required pattern=".{5,100}" title="Dirección debe tener entre 5 y 100 caracteres">

            <label for="fecha_periodo">Fecha del Período Académico:</label>
            <input type="date" id="fecha_periodo" name="fecha_periodo" required>

            <button type="submit">Registrar</button>
            <button type="submit">Editar</button>
            <button type="submit">Eliminar</button>
        </form>
    </div>
</body>

</html>