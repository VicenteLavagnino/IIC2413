<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require("../config/conexion.php");
?>

<body>

<?php
if(isset($_POST["genero"])){
    $genero = $_POST["genero"];
    $query = $db_0 -> prepare("SELECT peliculas.titulo, peliculas.puntuacion
    FROM peliculas
    JOIN genero_en_pelicula ON peliculas.pid = genero_en_pelicula.pid
    WHERE LOWER(genero_en_pelicula.genero) = LOWER(:genero);");

    $query->execute(['genero' => $genero]);
    $peliculas = $query->fetchAll();

    if($peliculas){
        foreach($peliculas as $pelicula){
            echo "<p>" .$pelicula['titulo']. "</p>";
            echo "<p>" .$pelicula['puntuacion']. "</p>";
        }
    }else{
        echo "<p>No hay peliculas de ese genero</p>";
    }
}else{
    $query = $bd_0->query("SELECT * FROM Peliculas ORDER BY puntuacion DESC");
    $peliculas = $query->fetchAll();

    if($peliculas){
        foreach($peliculas as $pelicula){
            echo "<p>".$pelicula['titulo1']."</p>";
        }
    }else{
        echo "<p>No hay peliculas</p>";
    }
}
?>

</body>
</html>