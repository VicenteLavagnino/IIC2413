<?php

    // Nos conectamos a las bdds
    require("../config/conexion.php");
    include('../templates/header.html');

    // Primero obtenemos todos los usuarios que queremos agregar
    $query = "SELECT id_usuario, nombre,	mail, password, username, fecha_nacimiento FROM usuarios_actividades ORDER BY id_usuario;";
    $result = $db_1 -> prepare($query);
    $result -> execute();
    $usuarios = $result -> fetchAll();



    foreach ($usuarios as $usuario){

        // usando el procedimiento almacenado mover_usuario, agregamos los usuarios a la bdd objetivo
        $query = "SELECT mover_usuario($usuario[0], '$usuario[1]'::varchar,'$usuario[2]'::varchar,'$usuario[3]'::varchar,'$usuario[4]'::varchar,'$usuario[5]'::varchar);";




        // Ejecutamos las querys para efectivamente insertar los datos
        $result = $db_0 -> prepare($query);
        $result -> execute();
        $result -> fetchAll();
    }

    // mostramos los cambios en una nueva tabla
    $query = "SELECT * FROM usuarios ORDER BY id_usuario DESC;";
    $result = $db_0 -> prepare($query);
    $result -> execute();
    $usuarios = $result -> fetchAll();
    

?>

    <body>
        <table class='table'>
            <thead>
                <tr>
                <th>Id</th>
                <th>nombre</th>
                <th>mail</th>
                <th>password</th>
                <th>username</th>
                <th>fecha_nacimiento</th>
                </tr>
            </thead>
        
                ?>
            </tbody>
        </table>
        <footer>
            <p>
                IIC2413 - Entrega 3 grupo 3+4
            </p>
        </footer>
    </body>
</html>

