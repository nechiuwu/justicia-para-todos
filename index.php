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
            <label for="rut">RUT</label>
            <input type="text" id="rut" name="rut" required pattern="^\d{8}-[\dK]$" title="Formato RUT válido: 12345678-9">

            <label for="nombre">Nombre</label>
            <input type="text" id="nombre" name="nombre" required pattern="[A-Za-z\s]{2,50}" title="Nombre debe contener entre 2 y 50 caracteres, solo letras y espacios">

            <label for="apellido">Apellido</label>
            <input type="text" id="apellido" name="apellido" required pattern="[A-Za-z\s]{2,50}" title="Apellido debe contener entre 2 y 50 caracteres, solo letras y espacios">

            <label for="domicilio">Domicilio</label>
            <input type="text" id="domicilio" name="domicilio" required pattern="^([\p{L}\s]+),\s*(\d+),\s*([\p{L}\s]+)(?:,\s*([\p{L}\d\s]+))?,\s*(\d{5}(?:-\d{4})?)$" title="Domicilio debe contener País, Número, Calle, Departamento/Casa (opcional), Código Postal">

            <label for="direccion">Correo electrónico</label>
            <input type="text" id="direccion" name="direccion" required pattern=".{5,100}" title="Dirección debe tener entre 5 y 100 caracteres">

            <label for="direccion">Teléfono</label>
            <input type="text" id="direccion" name="direccion" required pattern=".{5,100}" title="Dirección debe tener entre 5 y 100 caracteres">

            <label for="direccion">Número de caso</label>
            <input type="text" id="direccion" name="direccion" required pattern=".{5,100}" title="Dirección debe tener entre 5 y 100 caracteres">

            <label for="direccion">Descripción del caso</label>
            <input type="text" id="direccion" name="direccion" required pattern=".{5,100}" title="Dirección debe tener entre 5 y 100 caracteres">

            <label for="fecha_inicio">Fecha inicio del caso</label>
            <input type="date" id="fecha_inicio" name="fecha_inicio" required>

            <label for="direccion">Estado del caso</label>
            <select id="estado_caso" name="estado_caso" required>
                <option value="">Seleccione estado</option>
                <option value="activo">Activo</option>
                <option value="en_proceso">En Proceso</option>
                <option value="cerrado">Cerrado</option>
            </select>
            
            <label for="direccion">Descripción de sentencia</label>
            <input type="text" id="direccion" name="direccion" pattern=".{5,100}" title="Dirección debe tener entre 5 y 100 caracteres">

            <label for="fecha_periodo">Fecha cierre del caso</label>
            <input type="date" id="fecha_periodo" name="fecha_periodo">

            <button type="submit">Registrar</button>
            <button type="submit">Editar</button>
            <button type="submit">Eliminar</button>
        </form>
    </div>
</body>

</html>