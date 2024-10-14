<?php
// Conexión a la base de datos
error_reporting(E_ALL);
ini_set('display_errors', 1);
require("../config/conexion.php");

// Obtener el pid o sid de la URL
$pid = isset($_GET['pid']) ? $_GET['pid'] : null;


// Verifica si es una película o serie y prepara la consulta SQL correspondiente
if ($pid != null) {
    // Es una película
    $query_proveedores = "SELECT proveedores_pelis.pro_id, proveedores_pelis.nombre FROM proveedores_pelis 
                          WHERE proveedores_pelis.pid = :pid;";
    $parametro = $pid;
} else {
    die("No se especificó un id válido.");
}

// Ejecutar la consulta para obtener los proveedores
$result_proveedores = $db_0->prepare($query_proveedores);
$result_proveedores->bindParam(':pid', $parametro, PDO::PARAM_INT);
//$result_proveedores->bindParam(':sid', $parametro, PDO::PARAM_INT);
$result_proveedores->execute();
$proveedores = $result_proveedores->fetchAll();

// Mostrar los proveedores y precios
echo "<h2>Proveedores Disponibles</h2>";
echo "<form action='procesar_compra.php' method='post'>";
foreach ($proveedores as $proveedor) {
    echo "<div>";
    echo "<input type='radio' name='proveedor_id' value='" . $proveedor['pro_id'] . "'>";
    echo $proveedor['nombre'] . " - $" . $proveedor['costo'];
    echo "</div>";
}
echo "<input type='hidden' name='pid' value='" . $pid . "'>";

echo "<button type='submit'>Comprar</button>";
echo "</form>";
?>
