<?php
include_once __DIR__.'/database.php';

$response = ["existe" => false];

if (isset($_POST['nombre'])) {
    $nombre = $conexion->real_escape_string($_POST['nombre']);
    $sql = "SELECT id FROM productos WHERE nombre = '$nombre' AND eliminado = 0";

    $result = $conexion->query($sql);
    if ($result && $result->num_rows > 0) {
        $response["existe"] = true;
    }

    $result && $result->free();
    $conexion->close();
}

echo json_encode($response, JSON_PRETTY_PRINT);
?>
