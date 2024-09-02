<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Justicia Para Todos</title>
    <link rel="stylesheet" href="./styles/index.css">
</head>

<body>
    <header>
        <nav>
            <ul>
                <li><a href="index.php">Registro Cliente</a></li>
                <li><a href="clientes.php">Editar o Eliminar Cliente</a></li>
            </ul>
        </nav>
    </header>
    <div class="container">
        <h1>Registro Cliente</h1>
        <?= $message; ?>
        <form action="index.php" method="POST">
            <label for="rut" class="label-form">RUT</label>
            <input type="text" id="rut" name="rut" class="input-form" required pattern="^\d{8}-[\dK]$" title="Formato RUT válido: 12345678-9">

            <label for="nombre" class="label-form">Nombre</label>
            <input type="text" id="nombre" name="nombre" class="input-form" required pattern="[A-Za-z\s]{2,50}" title="Nombre debe contener entre 2 y 50 caracteres, solo letras y espacios">

            <label for="apellido" class="label-form">Apellido</label>
            <input type="text" id="apellido" name="apellido" class="input-form" required pattern="[A-Za-z\s]{2,50}" title="Apellido debe contener entre 2 y 50 caracteres, solo letras y espacios">

            <label for="domicilio" class="label-form">Domicilio</label>
            <input type="text" id="domicilio" name="domicilio" class="input-form" required pattern="^([\p{L}\s]+),\s*(\d+),\s*([\p{L}\s]+)(?:,\s*([\p{L}\d\s]+))?,\s*(\d{5}(?:-\d{4})?)$" title="Domicilio debe contener País, Número, Calle, Departamento/Casa (opcional), Código Postal">

            <label for="email" class="label-form">Correo electrónico</label>
            <input type="text" id="email" name="email" class="input-form" required pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$" title="Correo electrónico debe contener usuario@dominio">

            <label for="telefono" class="label-form">Teléfono</label>
            <input type="text" id="telefono" name="telefono" class="input-form" required pattern="^\+\d{1,4}\d{1,4}\d{4,14}$" title="Telefono debe contener +CódigoPaísCódigoCiudadNúmeroLocal, ejemplo: +34123456789">

            <label for="num_caso" class="label-form">Número de caso</label>
            <input type="number" id="num_caso" name="num_caso" class="input-form" required min="1" step="1" title="Número de caso NO debe contener caracteres especiales">

            <label for="desc_caso" class="label-form">Descripción del caso</label>
            <textarea id="desc_caso" name="desc_caso" class="descriptions" rows="4" cols="50" maxlength="480" required></textarea>

            <label for="fecha_inicio" class="label-form">Fecha inicio del caso</label>
            <input type="date" id="fecha_inicio" name="fecha_inicio" class="date-form" required>

            <label for="estado_caso" class="label-form">Estado del caso</label>
            <select id="estado_caso" name="estado_caso" class="lists" required>
                <option value="">Seleccione estado</option>
                <option value="activo">Activo</option>
                <option value="en_proceso">En Proceso</option>
                <option value="cerrado">Cerrado</option>
            </select>

            <div class="hidden" id="cierre_caso">
                <label for="desc_sentencia" class="label-form" style="margin-top: 10px;">Descripción de sentencia</label>
                <textarea id="desc_sentencia" name="desc_sentencia" class="descriptions" rows="4" cols="50" maxlength="480"></textarea>

                <label for="fecha_cierre" class="label-form">Fecha cierre del caso</label>
                <input type="date" id="fecha_cierre" name="date-form" class="date-form">
            </div>

            <button type="submit">Registrar</button>
        </form>

        <script>
            function toggleFieldByStatusCase() {
                var estadoCasoItem = document.getElementById('estado_caso');
                var cierreCasoContainer = document.getElementById('cierre_caso');
                var estadoCasoSelected = estadoCasoItem.value;
                if (estadoCasoSelected === 'cerrado') {
                    cierreCasoContainer.classList.remove('hidden');
                    cierreCasoContainer.disabled = false;
                } else {
                    cierreCasoContainer.classList.add('hidden');
                    cierreCasoContainer.disabled = true;
                }
            }
            document.getElementById('estado_caso').addEventListener('change', toggleFieldByStatusCase);
            window.onload = function() {
                toggleFieldByStatusCase();
            }
        </script>
    </div>
</body>

</html>