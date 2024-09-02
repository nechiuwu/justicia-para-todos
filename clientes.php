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
        <h1>Editar o Eliminar Cliente</h1>
        <?= $message; ?>
        <form action="clientes.php" method="POST">
            <div id="buttoncontainer">
                <button type="submit">Editar</button>
                <button type="submit">Eliminar</button>
            </div>
        </form>
    </div>
</body>

</html>