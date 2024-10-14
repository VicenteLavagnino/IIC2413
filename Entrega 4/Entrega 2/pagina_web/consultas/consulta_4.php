<?php include('../templates/header.html'); ?>

<body>
  <?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");

  $genero = $_POST["genero"];

  $query = "SELECT videojuegos.titulo AS Titulo FROM videojuegos JOIN genero_asignado ON videojuegos.id = genero_asignado.id_videojuego JOIN generos ON genero_asignado.id_genero = generos.id WHERE generos.nombres = '$genero' OR genero_asignado.id_genero IN (SELECT id_subgenero FROM relacion_subgenero JOIN generos ON relacion_subgenero.id_genero = generos.id WHERE generos.nombres = '$genero');";

  #Se prepara y ejecuta la consulta. Se obtienen TODOS los resultados
  $result = $db->prepare($query);
  $result->execute();
  $videojuegos = $result->fetchAll();
  ?>

  <table>
    <tr>
      <th>Titulo</th>
    </tr>

    <?php
    foreach ($videojuegos as $v) {
      echo "<tr><td>$v[0]</td></tr>";
    }
    ?>

  </table>

  <?php include('../templates/footer.html'); ?>