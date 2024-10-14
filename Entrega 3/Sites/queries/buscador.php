<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
include('../templates/header.html');
require("../config/conexion.php");

$proveedor = strtolower($_POST['proveedor']);
$nombre = strtolower($_POST['nombre']);

$query1 = "SELECT 'Película' AS tipo, titulo 
           FROM multimedia 
           WHERE LOWER(titulo) LIKE :nombre AND proveedor_id IN 
           (SELECT id FROM proveedores WHERE LOWER(nombre) = :proveedor) AND pid IS NOT NULL
           UNION
           SELECT 'Serie' AS tipo, titulo 
           FROM multimedia 
           WHERE LOWER(titulo) LIKE :nombre AND proveedor_id IN 
           (SELECT id FROM proveedores WHERE LOWER(nombre) = :proveedor) AND sid IS NOT NULL
           LIMIT 3;";

$result1 = $db_0->prepare($query1);
$result1->execute([':nombre' => "%$nombre%", ':proveedor' => $proveedor]);
$peliculas_series = $result1->fetchAll();

$query2 = "SELECT 'Videojuego' AS tipo, titulo 
           FROM videojuegos 
           WHERE LOWER(titulo) LIKE :nombre AND proveedor_id IN 
           (SELECT id FROM proveedores WHERE LOWER(nombre) = :proveedor)
           LIMIT 3;";

$result2 = $db_1->prepare($query2);
$result2->execute([':nombre' => "%$nombre%", ':proveedor' => $proveedor]);
$videojuegos = $result2->fetchAll();
?>

<body>
    <h2>Resultados de Búsqueda</h2>
    <?php if (empty($peliculas_series) && empty($videojuegos)): ?>
        <p>No se encontraron resultados para '
            <?php echo htmlspecialchars($nombre); ?>' en el proveedor '
            <?php echo htmlspecialchars($proveedor); ?>'.
        </p>
    <?php else: ?>
        <?php foreach ($peliculas_series as $item): ?>
            <p>
                <?php echo htmlspecialchars($item['tipo']); ?>:
                <?php echo htmlspecialchars($item['titulo']); ?>
            </p>
        <?php endforeach; ?>

        <?php foreach ($videojuegos as $item): ?>
            <p>
                <?php echo htmlspecialchars($item['tipo']); ?>:
                <?php echo htmlspecialchars($item['titulo']); ?>
            </p>
        <?php endforeach; ?>
    <?php endif; ?>

    <a href="../index.php">Volver</a>
</body>

</html>