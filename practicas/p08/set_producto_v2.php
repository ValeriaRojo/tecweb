<?php
/** SE CREA EL OBJETO DE CONEXION */
@$link = new mysqli('localhost', 'root', '290105.', 'marketzone');	

/** comprobar la conexión */
if ($link->connect_errno) 
{
    die('Falló la conexión: '.$link->connect_error.'<br/>');
    /** NOTA: con @ se suprime el Warning para gestionar el error por medio de código */
}

if($_SERVER['REQUEST_METHOD'] == 'POST') /**Comprobamos que el método que se utilice sea un "POST" */
{
	/**Recogemos los valores añadidos en el formulario, eliminamos espacios vacíos al inicio y final con "trim" */
	$nombre=trim($_POST['name']);
	$marca=trim($_POST['marca']);
	$modelo=trim($_POST['modelo']);
	$precio=trim($_POST['precio']);
	$detalles=trim($_POST['detalles']);
	$unidades=trim($_POST['unidades']);
	$imagen=trim($_POST['img']);

	/**Validamos que los campos no estén vacios */
	if(empty($nombre) || empty($marca) || empty($modelo) || $precio<=0 || $unidades<0){
		die("Por favor, llena todos los campos.");
	}

	/**Verificamos que los campos de nombre, marca y modelo no existan ya en la BD */
	$verificar_producto="SELECT id FROM productos WHERE nombre=? AND marca=? AND modelo=?";
	$stmt=$link->prepare($verificar_producto);
	$stmt->bind_param("sss", $nombre, $marca, $modelo);
	$stmt->execute();
	$res=$stmt->get_result();

	/**Si es que el resultado devuelve un número mayor a 0 significa que ya hay un producto existente en la BD con el
	mismo nombre, marca y modelo.*/
	if ($res->num_rows > 0) {
		die("ERROR: El producto ya existe en la base de datos.:(");
	}

	/**Se insertan los datos en la BD*/
	$sql = "INSERT INTO productos VALUES (null, '{$nombre}', '{$marca}', '{$modelo}', {$precio}, '{$detalles}', {$unidades}, '{$imagen}')";
	if ( $link->query($sql) ) 
	{
		echo 'Resumen de productos insertados:<br/>';
		echo 'PRODUCTO:<br/>';
		echo '<strong>Producto insertado con ID:</strong>'.$link->insert_id.'<br/>';
		echo '<strong>Nombre del producto:</strogng>'.$nombre.'<br/>';
		echo '<strong>Marca: </strong>'.$marca.'<br/>';
		echo '<strong>Modelo: </strong>'.$modelo.'<br/>';
		echo '<strong>Precio: </strong>'.$precio.'<br/>';
		echo '<strong>Detalles/Descripción: </strong>'.$detalles.'<br/>';
		echo '<strong>Cantidad de unidades: </strong><br/> '.$unidades.'<br/>';
		if (!empty($imagen)) {
			echo '<p><strong>Imagen:</strong></p>'.'<br/>';
			echo '<img src="' . $imagen . '" alt="Imagen del producto" style="max-width: 100%; border-radius: 5px;">';
		}
	}
	else
	{
		echo 'El Producto no pudo ser insertado =(';
	}

}
else{
	echo 'No hay datos por insertar.';
}

$link->close();
?>