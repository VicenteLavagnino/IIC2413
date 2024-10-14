<?php
include('../templates/header.html');
?>

<body>
    <?php
    require("../config/conexion.php");

    $proveedor = $_POST["proveedor"];

    $query1 = "SELECT p.nombre AS Proveedor, m.titulo AS Titulo, 'Peliculas' AS Tipo
               FROM proveedores p
               JOIN proveedores_pelis pp ON p.id = pp.pro_id
               JOIN peliculas m ON pp.pid = m.pid
               WHERE p.nombre = :proveedor
               UNION ALL
               SELECT p.nombre, s.serie, 'Series' AS Tipo
               FROM proveedores p
               JOIN proveedores_series ps ON p.id = ps.pro_id
               JOIN series s ON ps.sid = s.sid
               WHERE p.nombre = :proveedor";
    
    $resultado1 = $db_0->prepare($query1);
    $resultado1->execute(['proveedor' => $proveedor]);
    $info_peliculas_series = $resultado1->fetchAll();

    require("../config/conexion2.php");

    $query2 = "SELECT pv.nombre AS Proveedor, vj.titulo AS Titulo
               FROM proveedores_videojuegos pvj
               JOIN proveedores pv ON pvj.pro_id = pv.id
               JOIN videojuegos vj ON pvj.vj_id = vj.vjid
               WHERE pv.nombre = :proveedor";
    
    $resultado2 = $db_1->prepare($query2);
    $resultado2->execute(['proveedor' => $proveedor]);
    $info_videojuegos = $resultado2->fetchAll();

    $num_peliculas = 0;
    $num_series = 0;

    foreach ($info_peliculas_series as $row) {
        if ($row['Tipo'] == 'Peliculas') {
            $num_peliculas++;
        } elseif ($row['Tipo'] == 'Series') {
            $num_series++;
        }
    }

    echo "<table>";
    echo "<tr><th>Nombre del Proveedor</th><th>Número de Películas</th><th>Número de Series</th><th>Número de Videojuegos</th></tr>";
    echo "<tr>";
    echo "<td>" . htmlspecialchars($proveedor) . "</td>";
    echo "<td>" . htmlspecialchars($num_peliculas) . "</td>";
    echo "<td>" . htmlspecialchars($num_series) . "</td>";
    echo "<td>" . htmlspecialchars(count($info_videojuegos)) . "</td>";
    echo "</tr>";
    echo "</table>";
    ?>

    <form action="../index.php" method="get">
        <input type="submit" value="Volver">
    </form>

</body>

</html>
