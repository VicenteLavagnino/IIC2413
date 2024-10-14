
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include('../templates/header.html');
require("../config/conexion.php");


// queremos en primer lugar revisar si el proveedor existe, si es que está en los de películas o en los de videojuegos
// si no está en ninguno, entonces no existe
// si está en uno, entonces es de ese tipo


$nombre_proveedor = $_POST['proveedor'];
try {
    $query = "SELECT count(*) as count FROM proveedores WHERE proveedores.nombre = :nombre_proveedor;";
    $result = $db_0->prepare($query);
    $result->execute([':nombre_proveedor' => $nombre_proveedor]);
    $cantidad = $result->fetch();
} if $cantidad['count'] == 0:
    echo "<p>El proveedor no existe</p>";
    // en este caso revisamos si está en los de videojuegos
    $query = "SELECT count(*) as count FROM proveedores_videojuegos WHERE proveedores_videojuegos.nombre = :nombre_proveedor;";
    $result = $db_0->prepare($query);
    $result->execute([':nombre_proveedor' => $nombre_proveedor]);
    $cantidad = $result->fetch();
    
    if $cantidad['count'] == 0:
        echo "<p>El proveedor no existe</p>";
    else:
        $query_videojuegos = "SELECT videojuegos.titulo, videojuegos.puntuacion, SUM(usuarios_actividades.cantidad) AS horas_jugadas
        FROM videojuegos
        JOIN usuarios_actividades ON videojuegos.id_videojuego = usuarios_actividades.id_videojuego
        JOIN proveedores_videojuegos ON videojuegos.proveedor_id = proveedores_videojuegos.id
        WHERE proveedores_videojuegos.nombre = :nombre_proveedor
        GROUP BY videojuegos.id_videojuego, videojuegos.titulo, videojuegos.puntuacion
        ORDER BY horas_jugadas DESC
        LIMIT 3;";
        $result_videojuegos = $db_0->prepare($query_videojuegos);
        $result_videojuegos->execute([':nombre_proveedor' => $nombre_proveedor]);
        $videojuegos = $result_videojuegos->fetchAll();
    
    else:
        $query_peliculas = "SELECT peliculas.titulo, peliculas.puntuacion, COUNT(*) AS visualizaciones
        FROM peliculas
        JOIN visualizaciones_peliculas ON peliculas.pid = visualizaciones_peliculas.pid
        JOIN proveedores_pelis ON peliculas.pid = proveedores_pelis.pid
        WHERE proveedores_pelis.nombre = :nombre_proveedor AND peliculas.pid IS NOT NULL
        GROUP BY peliculas.pid, peliculas.titulo, peliculas.puntuacion
        ORDER BY visualizaciones DESC
        LIMIT 3;" ;

        $result_peliculas = $db_0->prepare($query_peliculas);
        $result_peliculas->execute([':nombre_proveedor' => $nombre_proveedor]);
        $peliculas = $result_peliculas->fetchAll();

        $query_series = "SELECT series.serie, COUNT(*) AS visualizaciones_totales
        FROM series
        JOIN capitulos ON series.sid = capitulos.sid
        JOIN visualizaciones_series ON capitulos.cid = visualizaciones_series.cid
        JOIN proveedores_series ON series.sid = proveedores_series.sid
        WHERE proveedores_series.nombre = :nombre_proveedor AND series.sid IS NOT NULL
        GROUP BY series.sid, series.serie
        ORDER BY visualizaciones_totales DESC
        LIMIT 3;";

        $result_series = $db_0->prepare($query_series);
        $result_series->execute([':nombre_proveedor' => $nombre_proveedor]);
        $series = $result_series->fetchAll();
    
}


$query_valor_suscripcion = "SELECT proveedores.costo FROM proveedores WHERE proveedores.nombre = :nombre_proveedor;";
$result_valor_suscripcion = $db_0->prepare($query_valor_suscripcion);
$result_valor_suscripcion->execute([':nombre_proveedor' => $nombre_proveedor]);
$valor_suscripcion = $result_valor_suscripcion->fetch();

$query_cantidad_peliculas = "SELECT COUNT(*) AS cantidad_peliculas FROM proveedores_pelis WHERE proveedores_pelis.nombre = :nombre_proveedor;";
$result_cantidad_peliculas = $db_0->prepare($query_cantidad_peliculas);
$result_cantidad_peliculas->execute([':nombre_proveedor' => $nombre_proveedor]);
$cantidad_peliculas = $result_cantidad_peliculas->fetch();

$query_cantidad_series = "SELECT COUNT(*) AS cantidad_series FROM proveedores_series WHERE proveedores_series.nombre = :nombre_proveedor;";
$result_cantidad_series = $db_0->prepare($query_cantidad_series);
$result_cantidad_series->execute([':nombre_proveedor' => $nombre_proveedor]);
$cantidad_series = $result_cantidad_series->fetch();



?>

<body>
    <h2>Detalles del Proveedor: <?php echo htmlspecialchars($nombre_proveedor); ?></h2>
   <p>

    Costo de la Suscripción: <?php echo htmlspecialchars($valor_suscripcion['costo']); ?>
    </p>
    <p>
    Cantidad de Películas: <?php echo htmlspecialchars($cantidad_peliculas['cantidad_peliculas']); ?>
    </p>
    <p>
    Cantidad de Series: <?php echo htmlspecialchars($cantidad_series['cantidad_series']); ?>
    </p>
    

    <h1>Películas Más Vistas</h1>
    <!-- Mostrar las películas aquí -->
    <?php foreach ($peliculas as $pelicula): ?>
        <p>
            <?php echo htmlspecialchars($pelicula['titulo']); ?> - Visualizaciones:
            <?php echo htmlspecialchars($pelicula['visualizaciones']); ?>
        </p>
    <?php endforeach; ?>

    <h1>Series Más Vistas</h1>
    <!-- Mostrar las series aquí -->
    <?php foreach ($series as $serie): ?>
        <p>
            <?php echo htmlspecialchars($serie['serie']); ?> - Visualizaciones:
            <?php echo htmlspecialchars($serie['visualizaciones_totales']); ?>
        </p>
    <?php endforeach; ?>

    <h3>Videojuegos Más Jugados</h3>
    <!-- Mostrar los videojuegos aquí -->
    <?php foreach ($videojuegos as $videojuego): ?>
        <p>
            <?php echo htmlspecialchars($videojuego['titulo']); ?> - Horas Jugadas:
            <?php echo htmlspecialchars($videojuego['horas_jugadas']); ?>
        </p>
    <?php endforeach; ?>

    <a href="../index.php">Volver</a>
</body>

</html>