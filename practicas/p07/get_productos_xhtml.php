<!DOCTYPE html PUBLIC"-//W3C//DTD XHTML 1.1//EN"
"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">
<?php
    //header("Content-Type: application/json; charset=utf-8"); 

	if(isset($_GET['tope']))
    {
		$tope = $_GET['tope'];
    }
    else
    {
        die('Parámetro "tope" no detectado...');
    }

	if (!empty($tope)){
		@$link = new mysqli('localhost', 'root', '290105.', 'marketzone');

		if ($link->connect_errno) 
		{
			die('Falló la conexión: '.$link->connect_error.'<br/>');
			//exit();
		}

		if ( $result = $link->query("SELECT * FROM productos WHERE unidades <= $tope") ) 
		{
			$row = $result->fetch_all(MYSQLI_ASSOC);
			$result->free();
		}

		$link->close();
        //echo json_encode($data, JSON_PRETTY_PRINT);
	}
	?>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>Producto</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<style>
			body{
				font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
			}
        </style>
    </head>
    <body>
        <h3><strong>PRODUCTO</strong></h3>
        <br/>

        <?php if( isset($row) ) : ?>

            <table class="table">
                <thead class="thead-dark">
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Marca</th>
                    <th scope="col">Modelo</th>
                    <th scope="col">Precio</th>
                    <th scope="col">Unidades</th>
                    <th scope="col">Detalles</th>
                    <th scope="col">Imagen</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($row as $producto) : ?>
                    <tr>
                        <th scope="row"><?= $producto['id'] ?></th>
                        <td><?= $producto['nombre'] ?></td>
                        <td><?= $producto['marca'] ?></td>
                        <td><?= $producto['modelo'] ?></td>
                        <td><?= $producto['precio'] ?></td>
                        <td><?= $producto['unidades'] ?></td>
                        <td><?= $producto['detalles'] ?></td>
                        <td><img src=<?= $producto['imagen']?> ></td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>

        <?php elseif(!empty($tope)) : ?>

            <script>
                alert('El ID del producto no existe');
            </script>

        <?php endif; ?>
    </body>
</html>