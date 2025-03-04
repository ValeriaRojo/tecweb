<?php
    /* MySQL Conexion*/
    $link = mysqli_connect("localhost", "root", "290105.", "marketzone");
    // Chequea coneccion
    if($link === false){
        die("ERROR: No pudo conectarse con la DB. " . mysqli_connect_error());
    }
    if (isset($_POST['id'])) {

        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        $marca = $_POST['marca'];
        $modelo = $_POST['modelo'];
        $precio = $_POST['precio'];
        $unidades = $_POST['unidades'];
        $detalles = $_POST['detalles'];
        $img = $_POST['img']; 

        //var_dump($_POST);

        $sql = "UPDATE productos SET 
                    nombre = '$nombre', 
                    marca = '$marca', 
                    modelo = '$modelo', 
                    precio = '$precio', 
                    unidades = '$unidades', 
                    detalles = '$detalles', 
                    imagen = '$img' 
                WHERE id = $id";

        if (mysqli_query($link, $sql)) {
            echo "Producto actualizado correctamente.";
        } else {
            echo "ERROR: No se ejecutó la consulta $sql. " . mysqli_error($link);
        }
    } else {
        echo "ERROR: El ID del producto no fue proporcionado.";
    }

    // Cierra la conexión
    mysqli_close($link);
?>

<p>
    <a href="get_producto_xhtml_v2.php">Ver productos (tope)</a>
</p>
<p>
    <a href="get_productos_vigentes_v2.php">Ver productos vigentes</a>
</p>