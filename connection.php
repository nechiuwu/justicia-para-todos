<?php
class crud
{
    public static function connect()
    {
        try {
            $con = new PDO('mysql:host=localhost;port=3306;dbname=justicia_para_todos', 'root', 'Mycr8760ne14.');
            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $con;
        } catch (PDOException $error) {
            echo 'Something went wrong connecting to the database: ' . $error->getMessage();
        }
        $con = null;
    }

    public static function selectClientes()
    {
        $data = array();
        $p = crud::connect()->prepare('SELECT * FROM clientes');
        $p->execute();
        $data = $p->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public static function deleteClientes($id)
    {
        $data = array();
        $p = crud::connect()->prepare('DELETE FROM clientes WHERE rut=:id');
        $p->bindValue(':id', $id);
        $p->execute();
        $data = $p->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public static function selectClienteById($id)
    {
        $data = array();
        $p = crud::connect()->prepare('SELECT * FROM clientes WHERE rut=:id');
        $p->bindValue(':id', $id);
        $p->execute();
        $data = $p->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public static function editClienteWhenIsCloseById(
        $rut,
        $nombre,
        $apellido,
        $domicilio,
        $email,
        $telefono,
        $num_caso,
        $desc_caso,
        $fecha_inicio,
        $estado_caso,
        $desc_sentencia,
        $fecha_cierre
    ) {
        $p = crud::connect()->prepare('UPDATE clientes SET nombre=:nombre, apellido=:apellido, domicilio=:domicilio, email=:email, 
            telefono=:telefono, numero_caso=:num_caso, descripcion_caso=:desc_caso, fecha_inicio=:fecha_inicio, estado_caso=:estado_caso, 
            descripcion_sentencia=:desc_sentencia, fecha_cierre=:fecha_cierre WHERE rut=:rut');
        $p->bindValue(':rut', $rut);
        $p->bindValue(':nombre', $nombre);
        $p->bindValue(':apellido', $apellido);
        $p->bindValue(':domicilio', $domicilio);
        $p->bindValue(':email', $email);
        $p->bindValue(':telefono', $telefono);
        $p->bindValue(':num_caso', $num_caso);
        $p->bindValue(':desc_caso', $desc_caso);
        $p->bindValue(':fecha_inicio', $fecha_inicio);
        $p->bindValue(':estado_caso', $estado_caso);
        $p->bindValue(':desc_sentencia', $desc_sentencia);
        $p->bindValue(':fecha_cierre', $fecha_cierre);
        $p->execute();
    }

    public static function editClienteById(
        $rut,
        $nombre,
        $apellido,
        $domicilio,
        $email,
        $telefono,
        $num_caso,
        $desc_caso,
        $fecha_inicio,
        $estado_caso
    ) {
        $p = crud::connect()->prepare('UPDATE clientes SET nombre=:nombre, apellido=:apellido, domicilio=:domicilio, email=:email, 
            telefono=:telefono, numero_caso=:num_caso, descripcion_caso=:desc_caso, fecha_inicio=:fecha_inicio, estado_caso=:estado_caso 
            WHERE rut=:rut');
        $p->bindValue(':rut', $rut);
        $p->bindValue(':nombre', $nombre);
        $p->bindValue(':apellido', $apellido);
        $p->bindValue(':domicilio', $domicilio);
        $p->bindValue(':email', $email);
        $p->bindValue(':telefono', $telefono);
        $p->bindValue(':num_caso', $num_caso);
        $p->bindValue(':desc_caso', $desc_caso);
        $p->bindValue(':fecha_inicio', $fecha_inicio);
        $p->bindValue(':estado_caso', $estado_caso);
        $p->execute();
    }
}
