<?php include('../templates/header.html'); ?>

<body>
  <?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");

  $query = "SELECT videojuegos.titulo AS Titulo, proveedores.nombre AS Proveedor FROM videojuegos JOIN mercado_videojuegos ON videojuegos.id = mercado_videojuegos.id_videojuego JOIN proveedores ON proveedores.id = mercado_videojuegos.id_proveedor;";

  #Se prepara y ejecuta la consulta. Se obtienen TODOS los resultados
  $result = $db->prepare($query);
  $result->execute();
  $juegos = $result->fetchAll();
  ?>

  <table>
    <tr>
      <th>Titulo</th>
      <th>Proveedor</th>
    </tr>

    <?php
    foreach ($juegos as $j) {
      echo "<tr><td>$j[0]</td><td>$j[1]</td></tr>";
    }
    ?>

  </table>

  <?php include('../templates/footer.html'); ?>