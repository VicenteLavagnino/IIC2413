<?php include('../templates/header.html'); ?>

<body>
  <?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");

  $query = "SELECT usuarios.nombre AS Nombre, SUM(pago_suscripciones.monto) AS Gasto FROM usuarios JOIN suscripciones ON usuarios.id = suscripciones.id_usuario JOIN pago_suscripciones ON suscripciones.id = pago_suscripciones.id_suscripcion GROUP BY usuarios.nombre;";

  #Se prepara y ejecuta la consulta. Se obtienen TODOS los resultados
  $result = $db->prepare($query);
  $result->execute();
  $usuarios = $result->fetchAll();
  ?>

  <table>
    <tr>
      <th>Usuario</th>
      <th>Gasto</th>
    </tr>

    <?php
    foreach ($usuarios as $u) {
      echo "<tr><td>$u[0]</td><td>$u[1]</td></tr>";
    }
    ?>

  </table>

  <?php include('../templates/footer.html'); ?>