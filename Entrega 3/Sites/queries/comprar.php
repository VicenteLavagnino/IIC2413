<?php
require("../config/conexion.php");

if ($_POST) {
    $pid = $_POST['pid'];
    $sid = $_POST['sid'];
    $pro_id = $_POST['proveedor_id'];

    $db_0->beginTransaction();

    try {

 
        $query = $db_0->prepare("INSERT INTO purchases (columns) VALUES (:values)");
        $query->execute(['values' => $values]);


        $db_0->commit();
    } catch (Exception $e) {
        $db_0->rollback();
        echo "Error: " . $e->getMessage();
    }
}

$query = $db_0->prepare("SELECT * FROM peliculas_juegos WHERE fuera_suscripcion = 1");
$query->execute();
$peliculas_juegos = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Comprar Peliculas o Juegos</title>
</head>
<body>
    <h1>Comprar Peliculas o Juegos</h1>
    <ul>
        <?php foreach ($peliculas_juegos as $pj): ?>
            <li>
                <a href="detalle.php?pid=<?php echo $pj['pid']; ?>">
                    <?php echo $pj['nombre']; ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>