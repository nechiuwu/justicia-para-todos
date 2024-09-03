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
    <table>
        <thead>
            <tr>
                <th>RUT</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Domicilio</th>
                <th>Correo Electrónico</th>
                <th>Teléfono</th>
                <th>Número Caso</th>
                <th>Descripción Caso</th>
                <th>Fecha Inicio</th>
                <th>Estado Caso</th>
                <th>Descripción Sentencia</th>
                <th>Fecha Cierre</th>
                <th>Eliminar</th>
                <th>Editar</th>
            </tr>
        </thead>
        <tbody>
            <?php
            require('./connection.php');
            session_start();

            $u = crud::selectClientes();
            if (isset($_GET['rut'])) {
                $id = $_GET['rut'];
                crud::deleteClientes($id);
                header('location:clientes.php');
            }
            if (count($u) > 0) {
                for ($i = 0; $i < count($u); $i++) {
                    echo '<tr>';
                    foreach ($u[$i] as $key => $value) {
                        echo '<td>' . $value . '</td>';
                    }
            ?>
                    <td><a class="links" href="clientes.php?rut=<?php echo $u[$i]['rut'] ?>">Eliminar</a></td>
                    <td><a class="links" href="editar-clientes.php?rut=<?php echo $u[$i]['rut'] ?>">Editar</a></td>
            <?php
                    echo '</tr>';
                }
            }
            ?>
        </tbody>
    </table>
</body>

</html>