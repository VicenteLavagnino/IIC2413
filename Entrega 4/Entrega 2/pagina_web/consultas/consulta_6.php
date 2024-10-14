<?php include('../templates/header.html'); ?>

<body>
  <?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");

  $usuario = $_POST["usuario"];

  $query = "SELECT proveedores.nombre AS Proveedor FROM usuarios JOIN compras_videojuegos ON usuarios.id = compras_videojuegos.id_usuario JOIN proveedores ON compras_videojuegos.id_proveedor = proveedores.id WHERE usuarios.username ILIKE '%' || '$usuario' || '%' AND compras_videojuegos.preorden = TRUE GROUP BY proveedores.nombre HAVING COUNT(compras_videojuegos.id_videojuego) > 1;";

  #Se prepara y ejecuta la consulta. Se obtienen TODOS los resultados
  $result = $db->prepare($query);
  $result->execute();
  $proveedores = $result->fetchAll();
  ?>

  <table>
    <tr>
      <th>Proveedor</th>
    </tr>

    <?php
    foreach ($proveedores as $p) {
      echo "<tr><td>$p[0]</td></tr>";
    }
    ?>

  </table>

  <?php include('../templates/footer.html'); ?>