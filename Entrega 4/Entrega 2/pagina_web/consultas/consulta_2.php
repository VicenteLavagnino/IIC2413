<?php include('../templates/header.html'); ?>

<body>
  <?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");

  $minimo = $_POST["minimo"];
  $minimo = intval($minimo);

  $query = "SELECT videojuegos.titulo AS Titulo FROM videojuegos JOIN resenas ON videojuegos.id = resenas.id_videojuego WHERE resenas.veredicto = TRUE GROUP BY videojuegos.titulo HAVING COUNT(resenas.veredicto) >= $minimo;";

  #Se prepara y ejecuta la consulta. Se obtienen TODOS los resultados
  $result = $db->prepare($query);
  $result->execute();
  $recomendaciones = $result->fetchAll();
  ?>

  <table>
    <tr>
      <th>Titulo</th>
    </tr>

    <?php
    foreach ($recomendaciones as $r) {
      echo "<tr><td>$r[0]</td></tr>";
    }
    ?>

  </table>

  <?php include('../templates/footer.html'); ?>