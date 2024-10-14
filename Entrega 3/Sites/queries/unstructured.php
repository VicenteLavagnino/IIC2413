<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('../config/conexion.php'); #conexion a db

## La funcion utiliza el nombre de una tabla, los atributos y un criterio que estos deben cumplir

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_tabla = $_POST['nombre_tabla'];
    $atributos = $_POST['atributos'];
    $criterio = $_POST['criterio'];

    ## Validación para evitar inyección SQL
    //$nombre_tabla = mysql_real_escape_string($conn, $nombre_tabla);
    //$atributos = mysql_real_escape_string($conn, $atributos);
    //$criterio = mysql_real_escape_string($conn, $criterio);

    ## consulta
    $query = "SELECT * FROM $nombre_tabla WHERE $atributos $criterio";
    
    ## Ejecutar la consulta
    $result = $db_0 ->query($query);

    ## Verificar si la consulta tuvo resultados
    if ($result->num_rows > 0) {
        // Crear y escribir en el archivo consulta.txt
        $file = fopen("consulta.txt", "w");
        while ($row = $result->fetch_assoc()) {
            foreach ($row as $key => $value) {
                fwrite($file, "$key: $value\n");
            }
            fwrite($file, "--------------------\n");
        }
        fclose($file);
        echo "La consulta se ha realizado y los resultados se han guardado en consulta.txt";
    } else {
        echo "La consulta no arrojó resultados";
    }
} else {
    echo "No se recibieron datos del formulario";
}
?>
