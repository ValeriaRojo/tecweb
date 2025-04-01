<?php
    include_once __DIR__ . '/database.php';

    include_once __DIR__ . '/database.php';

$data = array(
    'status'  => 'error',
    'message' => 'La consulta falló'
);

if (isset($_POST['id']) && !empty($_POST['id'])) {
    // Verifica qué datos están llegando
    error_log("Datos recibidos: " . print_r($_POST, true));

    $id = intval($_POST['id']); 
    $nombre = $conexion->real_escape_string($_POST['nombre'] ?? '');
    $marca = $conexion->real_escape_string($_POST['marca'] ?? '');
    $modelo = $conexion->real_escape_string($_POST['modelo'] ?? '');
    $precio = floatval($_POST['precio'] ?? 0);
    $detalles = $conexion->real_escape_string($_POST['detalles'] ?? '');
    $unidades = intval($_POST['unidades'] ?? 0);
    $imagen = $conexion->real_escape_string($_POST['imagen'] ?? 'img/default.png');

    $sql = "UPDATE productos SET 
            nombre='$nombre', 
            marca='$marca', 
            modelo='$modelo', 
            precio=$precio, 
            detalles='$detalles', 
            unidades=$unidades, 
            imagen='$imagen' 
            WHERE id=$id;";

    $conexion->set_charset("utf8");

    if ($conexion->query($sql)) {
        $data['status'] = "success";
        $data['message'] = "Producto actualizado correctamente";
    } else {
        $data['message'] = "ERROR SQL: " . $conexion->error;
    }

    $conexion->close();
} else {
    $data['message'] = "ID faltante";
}

echo json_encode($data, JSON_PRETTY_PRINT);
?>