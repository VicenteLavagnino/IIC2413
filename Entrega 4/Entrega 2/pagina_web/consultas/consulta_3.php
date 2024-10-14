<?php include('../templates/header.html'); ?>

<body>
  <?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");

  $juego = $_POST["juego"];

  $query = "SELECT videojuegos.titulo AS Titulo, proveedores.nombre AS Proveedor FROM videojuegos JOIN mercado_videojuegos ON videojuegos.id = mercado_videojuegos.id_videojuego JOIN proveedores ON proveedores.id = mercado_videojuegos.id_proveedor WHERE videojuegos.titulo ILIKE '%' || '$juego' || '%';";

  #Se prepara y ejecuta la consulta. Se obtienen TODOS los resultados
  $result = $db->prepare($query);
  $result->execute();
  $videojuegos = $result->fetchAll();
  ?>

  <table>
    <tr>
      <th>Titulo</th>
      <th>Provedoor</th>
    </tr>

    <?php
    foreach ($videojuegos as $v) {
      echo "<tr><td>$v[0]</td><td>$v[1]</td></tr>";
    }
    ?>

  </table>

  <?php include('../templates/footer.html'); ?>