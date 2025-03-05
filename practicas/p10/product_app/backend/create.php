<?php
    include_once __DIR__.'/database.php';

    // SE OBTIENE LA INFORMACIÓN DEL PRODUCTO ENVIADA POR EL CLIENTE
    $producto = file_get_contents('php://input');

    if(!empty($producto)) {
        // SE TRANSFORMA EL STRING DEL JASON A OBJETO
        $jsonOBJ = json_decode($producto);
        //Extraemos los datos del JSON 
        $nombre = trim($jsonOBJ->nombre);
        $marca = trim($jsonOBJ->marca);
        $modelo = trim($jsonOBJ->modelo);
        $precio = trim($jsonOBJ->precio);
        $detalle = trim($jsonOBJ->detalles);
        $unidades = trim($jsonOBJ->unidades);
        $imagen = $jsonOBJ->imagen ? $jsonOBJ->imagen : "imagen.png";

        if ($nombre === '' || strlen($nombre) > 100 ||
        $marca === '' ||
        $modelo === '' || strlen($modelo) > 25 || !preg_match('/^[a-zA-Z0-9]*$/', $modelo) ||
        $precio <= 99.99 ||
        strlen($detalle) > 250 ||
        $unidades < 0) {
            echo json_encode(["status" => "error", "message" => "Datos inválidos"]);
            exit;
        }
        
        //Realizamos la conexión a la BD
        @$link = new mysqli('localhost', 'root', '290105.', 'marketzone');
        if ($link->connect_errno) {
            die('Falló la conexión: ' . $link->connect_error . '<br/>');
        }

        $sql_check = "SELECT COUNT(*) FROM productos 
        WHERE (nombre = '$nombre' 
        AND marca = '$marca' 
        OR marca = '$marca' 
        AND modelo = '$modelo') 
        AND eliminado = 0";
        $result = $link->query($sql_check);
        $row = $result->fetch_array();

        if ($row[0] > 0) {
            // Si el producto ya existe, devolver error
            echo json_encode(["status" => "error", "message" => "El producto ya existe en la base de datos."]);
        } else {
            // Si el producto no existe, proceder con la inserción
            $sql_insert = "INSERT INTO productos (nombre, marca, modelo, precio, detalles, unidades, imagen) 
                           VALUES ('{$nombre}', '{$marca}', '{$modelo}', {$precio}, '{$detalle}', {$unidades}, '{$imagen}')";

            if ($link->query($sql_insert)) {
                // Si la inserción fue exitosa, devolver éxito
                echo json_encode(["status" => "success", "message" => "Producto insertado correctamente."]);
            } else {
                // Si ocurrió un error durante la inserción
                echo json_encode(["status" => "error", "message" => "El Producto no pudo ser insertado."]);
            }
        }

        // Cerrar la conexión
        $link->close();
    } else {
        // Si no se recibe ningún producto en el cuerpo de la solicitud
        echo json_encode(["status" => "error", "message" => "No se recibieron datos para insertar el producto."]);
    }
?>