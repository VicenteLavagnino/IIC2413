<?php include('templates/header.html'); ?>

<body>
  <h1 align="center">Sistema de Gestión de Videojuegos </h1>
  <p style="text-align:center;">Aquí podrás encontrar información sobre videojuegos.</p>

  <br>

  <h3 align="center"> ¿Quieres saber cuales son los videojuegos y sus proveedores?</h3>

  <form align="center" action="consultas/consulta_1.php" method="post">
    <input type="submit" value="Buscar">
  </form>

  <br>
  <br>
  <br>

  <h3 align="center"> ¿Quieres buscar un videojuego según recomendaciones?</h3>

  <form align="center" action="consultas/consulta_2.php" method="post">
    Número mínimo de recomendaciones:
    <input type="text" name="minimo">
    <br /><br />
    <input type="submit" value="Buscar">
  </form>

  <br>
  <br>
  <br>

  <h3 align="center"> ¿Quieres conocer todos los proveedores de un juego?</h3>

  <form align="center" action="consultas/consulta_3.php" method="post">
    Juego:
    <input type="text" name="juego">
    <br /><br />
    <input type="submit" value="Buscar">
  </form>
  <br>
  <br>
  <br>

  <h3 align="center">¿Quieres buscar los juegos que corresponden a un genero?</h3>

  <?php
  require("config/conexion.php");
  $result = $db->prepare("SELECT generos.nombres FROM generos;");
  $result->execute();
  $dataCollected = $result->fetchAll();
  ?>

  <form align="center" action="consultas/consulta_4.php" method="post">
    Selecciona un genero:
    <select name="genero">
      <?php
      foreach ($dataCollected as $d) {
        echo "<option value=$d[0]>$d[0]</option>";
      }
      ?>
    </select>
    <br><br>
    <input type="submit" value="Buscar por genero">
  </form>

  <br>
  <br>
  <br>

  <h3 align="center"> ¿Quieres buscar los videojuegos de un usuario?</h3>

  <form align="center" action="consultas/consulta_5.php" method="post">
    Usuario:
    <input type="text" name="usuario">
    <br /><br />
    <input type="submit" value="Buscar">
  </form>

  <br>
  <br>
  <br>

  <h3 align="center"> ¿Quieres saber cuales son los proveedores para los cuales un usuario ha preordenado mas de un
    juego?</h3>

  <form align="center" action="consultas/consulta_6.php" method="post">
    Usuario:
    <input type="text" name="usuario">
    <br /><br />
    <input type="submit" value="Buscar">
  </form>

  <br>
  <br>
  <br>

  <h3 align="center"> ¿Quieres saber cual es el gasto total por usuario en suscripciones?</h3>

  <form align="center" action="consultas/consulta_7.php" method="post">
    <input type="submit" value="Buscar">
  </form>

  <br>
  <br>
  <br>

</body>

</html>