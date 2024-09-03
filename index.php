<?php
$servername = "localhost";
$username = "root";
$password = "Mycr8760ne14.";
$dbname = "justicia_para_todos";
$port = 3306;

$conn = new mysqli($servername, $username, $password, $dbname, $port);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$conn->set_charset("utf8mb4");
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $rut = htmlspecialchars(trim($_POST['rut']), ENT_QUOTES, 'UTF-8');
    $nombre = htmlspecialchars(trim($_POST['nombre']), ENT_QUOTES, 'UTF-8');
    $apellido = htmlspecialchars(trim($_POST['apellido']), ENT_QUOTES, 'UTF-8');
    $domicilio = htmlspecialchars(trim($_POST['domicilio']), ENT_QUOTES, 'UTF-8');
    $email = htmlspecialchars(trim($_POST['email']), ENT_QUOTES, 'UTF-8');
    $telefono = htmlspecialchars(trim($_POST['telefono']), ENT_QUOTES, 'UTF-8');
    $num_caso = htmlspecialchars(trim($_POST['num_caso']), ENT_QUOTES, 'UTF-8');
    $desc_caso = htmlspecialchars(trim($_POST['desc_caso']), ENT_QUOTES, 'UTF-8');
    $fecha_inicio = $_POST['fecha_inicio'];
    $estado_caso = htmlspecialchars(trim($_POST['estado_caso']), ENT_QUOTES, 'UTF-8');
    if ($estado_caso == 'cerrado') {
        $desc_sentencia = $_POST['estado_caso'];
        $fecha_cierre = $_POST['fecha_cierre'];
    }

    if (0 > strlen($rut) || strlen($rut) > 10) {
        $message = "<p class='message error'>RUT inválido. Debe tener formato 12345678-9.</p>";
    } elseif (strlen($domicilio) > 250) {
        $message = "<p class='message error'>Domicilio debe tener menos de 250 caracteres.</p>";
    } elseif (strlen($telefono) > 15) {
        $message = "<p class='message error'>Teléfono debe tener menos de 15 caracteres.</p>";
    } elseif (empty($desc_caso) || strlen($desc_caso) > 480) {
        $message = "<p class='message error'>Debe describir el caso (máximo 480 caracteres).</p>";
    } elseif (empty($fecha_inicio)) {
        $message = "<p class='message error'>Debe seleccionar fecha de inicio.</p>";
    } elseif (empty($estado_caso)) {
        $message = "<p class='message error'>Debe seleccionar estado del caso.</p>";
    } elseif ($estado_caso == 'cerrado' && (empty($desc_sentencia) || strlen($desc_sentencia) > 480)) {
        $message = "<p class='message error'>Debe describir la sentencia (máximo 480 caracteres).</p>";
    } elseif ($estado_caso == 'cerrado' && empty($fecha_cierre)) {
        $message = "<p class='message error'>Debe seleccionar fecha de cierre.</p>";
    } else {
        $sql = "INSERT INTO clientes (rut, nombre, apellido, domicilio, email, telefono, numero_caso, descripcion_caso, fecha_inicio, estado_caso, descripcion_sentencia, fecha_cierre) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);

        if ($stmt === false) {
            die("Error en la preparación de la consulta: " . $conn->error);
        }

        $stmt->bind_param("ssssssssssss", $rut, $nombre, $apellido, $domicilio, $email, $telefono, $num_caso, $desc_caso, $fecha_inicio, $estado_caso, $desc_sentencia, $fecha_cierre);

        try {
            $stmt->execute();
            $message = "<p class='message success'>Registro creado exitosamente.</p>";
        } catch (mysqli_sql_exception $e) {
            $message = "<p class='message error'>Error al crear el registro: " . $e->getMessage() . "</p>";
        }

        $stmt->close();
    }
    $conn->close();
}
?>

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
            <input type="text" id="rut" name="rut" class="input-form" required pattern="^\d{8}-[\dK]$" title="RUT inválido. Debe tener formato 12345678-9">

            <label for="nombre" class="label-form">Nombre</label>
            <input type="text" id="nombre" name="nombre" class="input-form" required pattern="[A-Za-z\s]{2,100}" title="Nombre debe contener entre 2 y 100 caracteres, solo letras y espacios">

            <label for="apellido" class="label-form">Apellido</label>
            <input type="text" id="apellido" name="apellido" class="input-form" required pattern="[A-Za-z\s]{2,100}" title="Apellido debe contener entre 2 y 100 caracteres, solo letras y espacios">

            <label for="domicilio" class="label-form">Domicilio</label>
            <input type="text" id="domicilio" name="domicilio" class="input-form" required pattern="^([\p{L}\s]+),\s*(\d+),\s*([\p{L}\s]+)(?:,\s*([\p{L}\d\s]+))?,\s*(\d{5}(?:-\d{4})?)$" title="Domicilio debe contener País, Número, Calle, Departamento/Casa (opcional), Código Postal">

            <label for="email" class="label-form">Correo electrónico</label>
            <input type="email" id="email" name="email" class="input-form" required pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}" title="Correo electrónico debe contener usuario@dominio">

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
                <input type="date" id="fecha_cierre" name="fecha_cierre" class="date-form">
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