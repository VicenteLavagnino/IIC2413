<?php
    /* include('structured_queries/sessions.php');*/
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Epic Prime - IIC2413</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.9.3/css/bulma.min.css">
    <link rel="stylesheet" href="styles/style.css">

    <?php
    include('./templates/header.html');
    ?>

</head>

<body>
    <section class="section">
        <div class="container">

            <div class="title-image">
                <img src="styles/imagen.png" alt="Epic Prime">
            </div>
            
            <h2 class="title has-text-centered">Inicia Sesión</h2>
            <div class="buttons is-centered">
                <form action='./queries/login.php' method='GET'>
                    <input class='button is-primary' type='submit' value='Usuario'>
                </form>
            </div>
            <!--
            <h2 class="title has-text-centered">Crear Tablas</h2>
            <div class="buttons is-centered">
                <form action="./queries/creador_central.php" method="post">
                    <input class="button is-link" type="submit" value="Importar">
                </form>
            </div> 
            -->

            <div class='container'>

                <h2 class="title has-text-centered">¿Quieres ver los proveedores y videojuegos?</h2>
                <?php
                require("./config/conexion.php");

                $query1 = "SELECT DISTINCT nombre FROM proveedores;";
                $result1 = $db_0->prepare($query1);
                $result1->execute();
                $proveedores1 = $result1->fetchAll(PDO::FETCH_ASSOC);

                $query2 = "SELECT DISTINCT nombre FROM proveedores_videojuegos;";
                $result2 = $db_0->prepare($query2);
                $result2->execute();
                $proveedores2 = $result2->fetchAll(PDO::FETCH_ASSOC);

                $nombres_proveedores = array_unique(array_merge(array_column($proveedores1, 'nombre'), array_column($proveedores2, 'nombre')));
                ?>


                <form action="./queries/detalles_proveedor.php" method="post">
                    Selecciona un proveedor:
                    <div class="select">
                        <select name="proveedor">
                            <?php
                            foreach ($nombres_proveedores as $nombre_proveedor) {
                                echo "<option value='$nombre_proveedor'>$nombre_proveedor</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <br><br>
                    <input class="button is-info" type="submit" value="Ver detalles del proveedor">
                </form>
            </div>

            <div class='container'>
                <h3 class="is-size-4">Buscador de proveedor</h3>
                <form action='./queries/buscador.php' method='POST'>
                    <div class="field">
                        <label class="label" for="proveedor">Proveedor:</label>
                        <div class="control">
                            <input class="input" type="text" id="proveedor" name="proveedor">
                        </div>
                    </div>

                    <div class="field">
                        <label class="label" for="nombre">Nombre:</label>
                        <div class="control">
                            <input class="input" type="text" id="nombre" name="nombre">
                        </div>
                    </div>

                    <div class="control">
                        <input class="button is-success" type="submit" value="Buscar">
                    </div>
                </form>
            </div>

            <div class='container'>
                <h3 class="is-size-4">Compra</h3>
                <form action='./queries/comprar.php' method='POST'>
                    <div class="field">
                        <label class="label" for="proveedor">Proveedor:</label>
                        <div class="control">
                            <input class="input" type="text" id="proveedor" name="proveedor">
                        </div>
                    </div>

                    <div class="field">
                        <label class="label" for="nombre">Nombre:</label>
                        <div class="control">
                            <input class="input" type="text" id="nombre" name="nombre">
                        </div>
                    </div>

                    <div class="control">
                        <input class="button is-success" type="submit" value="Buscar">
                    </div>
                <?php
                // Conexión a la base de datos
                require("config/conexion.php");
                // no existe la tabla multimedia, esto hay que arreglarlo

                $query_peliculas = "SELECT peliculas.pid, peliculas.titulo FROM peliculas 
                        LEFT JOIN proveedores_pelis ON peliculas.pid = proveedores_pelis.pid
                        LEFT JOIN Proveedores ON proveedores_pelis.pro_id = Proveedores.id
                        WHERE Proveedores.id IS NOT NULL;";
                $result_peliculas = $db_0->prepare($query_peliculas);
                $result_peliculas ->execute();
                $elementos_peliculas = $result_peliculas->fetchAll();


                $query_videojuegos = "SELECT videojuegos.id_videojuego, videojuegos.titulo FROM videojuegos
                        ;";
                        // LEFT JOIN provee_videojuegos ON Videojuegos.id_videojuego = provee_videojuegos.id_videojuego
                        // LEFT JOIN Proveedores_videojuegos ON provee_videojuegos.pid = Proveedores_videojuegos.id
                        // WHERE Proveedores_videojuegos.id IS NOT NULL
                $result_videojuegos = $db_0->prepare($query_videojuegos);
                $result_videojuegos->execute();
                $videojuegos = $result_videojuegos->fetchAll();

                echo "<h2 class='is-size-4'>Películas Disponible</h2>";
                foreach ($elementos_peliculas as $peliculas) {
                    if (isset($peliculas['pid']) && $peliculas['pid'] != null) {
                        echo "<a href='./queries/detalle_peliculas.php?pid=" . $peliculas['pid'] . "'>" . $peliculas['titulo'] . " (Película)</a><br/>";
                    }
                }

                echo "<h2 class='is-size-4'>Videojuegos Disponibles</h2>";
                foreach ($videojuegos as $videojuego) {
                    echo "<a href='./queries/detalle_videojuego.php?id_videojuego=" . $videojuego['id_videojuego'] . "'>" . $videojuego['titulo'] . "</a><br/>";
                }
                ?>
            </div>

            <div class='container'>
                <h3>Mejores puntuaciones</h3>
                <form action='./queries/puntuaciones.php' method='post'>
                    <label for='genero'>Genero</label>
                    <input type='text' name='genero' id='genero'>
                    <input type='submit' value='Buscar'>
                </form>
            </div>
            <h3 class="is-size-4"> Consulta inestructurada </h3>
                <form action='./queries/unstructured.php' method='POST'>
                    <div class="field">
                        <label class="label" for="nombre_tabla">Nombre de la tabla:</label>
                        <div class="control">
                            <input class="input" type="text" id="nombre_tabla" name="nombre_tabla">
                        </div>
                    </div>
                    <div class="field">
                        <label class="label" for="atributos">Atributos:</label>
                        <div class="control">
                            <input class="input" type="text" id="atributos" name="atributos">
                        </div>
                    </div>
                    <div class="field">
                        <label class="label" for="criterio">Criterio:</label>
                        <div class="control">
                            <input class="input" type="text" id="criterio" name="criterio">
                        </div>
                    <div class="control">
                        <input type="submit" value="Click aquí">
                    </div>
                </form>
        </div>
    </section>

  
</body>

<!--footer class="footer">
    <div class="content has-text-centered">
        <p>IIC2413 - Grupo 3 y 4</p>
    </div>
</footer-->

</html>