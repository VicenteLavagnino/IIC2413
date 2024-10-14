<?php include('../templates/header.html'); ?>

<body>
  <?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");

  $usuario = $_POST["usuario"];

  $query = "SELECT videojuegos.titulo AS Titulo, proveedores.nombre AS Proveedor FROM usuarios JOIN compras_videojuegos ON usuarios.id = compras_videojuegos.id_usuario JOIN videojuegos ON compras_videojuegos.id_videojuego = videojuegos.id JOIN proveedores ON compras_videojuegos.id_proveedor = proveedores.id WHERE usuarios.username ILIKE '%' || '$usuario' || '%';";

  #Se prepara y ejecuta la consulta. Se obtienen TODOS los resultados
  $result = $db->prepare($query);
  $result->execute();
  $videojuegos = $result->fetchAll();
  ?>

  <table>
    <tr>
      <th>Titulo</th>
      <th>Proveedor</th>
    </tr>

    <?php
    foreach ($videojuegos as $v) {
      echo "<tr><td>$v[0]</td><td>$v[1]</td></tr>";
    }
    ?>

  </table>

  <?php include('../templates/footer.html'); ?>