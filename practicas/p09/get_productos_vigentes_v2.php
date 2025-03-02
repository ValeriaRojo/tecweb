<!DOCTYPE html PUBLIC"-//W3C//DTD XHTML 1.1//EN"
"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">
<?php
    //header("Content-Type: application/json; charset=utf-8");
    
    $data=array();

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

		if ( $result = $link->query("SELECT * FROM productos WHERE unidades <= $tope AND eliminado = 0") ) 
		{
			$row = $result->fetch_all(MYSQLI_ASSOC);
            foreach($row as $num => $registro){
                foreach($registro as $key => $value){
                    $data[$num][$key] = ($value);
                }
            }
			$result->free();
		}

		$link->close();
        //echo json_encode($data, JSON_PRETTY_PRINT);
	}
	?>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>Producto</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<style>
			body{
				font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
			}
            img{
                width: 30%;
                height: auto;
            }
            h3{
                padding-top: 20px;
                font-weight: bold;
            }
        </style>
         <script>
            function show(event) {
                // se obtiene el id de la fila donde está el botón presionado
                var rowId = event.target.parentNode.parentNode.id;

                // se obtienen los datos de la fila en forma de arreglo
                var data = document.getElementById(rowId).querySelectorAll(".row-data");

                var id = data[0].innerHTML;
                var nombre = data[1].innerHTML;
                var marca = data[2].innerHTML;
                var modelo = data[3].innerHTML;
                var precio = data[4].innerHTML;
                var unidades = data[5].innerHTML;
                var detalles = data[6].innerHTML;

                alert("ID: " + id + "\nNombre: " + nombre + "\nMarca: " + marca + "\nModelo: " + modelo + 
                "\nPrecio: " + precio + "\nUnidades: " + unidades + "\nDetalles: " + detalles);

                send2form(id, nombre, marca, modelo, precio, unidades, detalles);
            }
        </script>
        <script>
            function send2form(id, nombre, marca, modelo, precio, unidades, detalles){
                var urlForm = "formulario_productos_v2.php";
                var propId = "ID="+id;
                var propNombre = "nombre="+nombre;
                var propMarca = "marca="+marca;
                var propModelo = "modelo="+modelo;
                var propPrecio = "precio="+precio;
                var propUnidades = "unidades="+unidades;
                var propDetalles = "detalles="+detalles;
                window.open( urlForm + "?" + "&" + propId +"&" + propNombre + "&" + propMarca + "&" + propModelo + 
                "&" + propPrecio + "&" + propUnidades + "&" + propDetalles);

                //window.location.href = urlForm + "?" + propId + "&" + propName + "&" + propMarca + "&" + propModelo + 
                //"&" + propPrecio + "&" + propUnidades + "&" + propDetalles;
            }
        </script>
    </head>
    <body>
        <h3>PRODUCTOS</h3>
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
                    <?php foreach($row as $value) : ?>
                    <tr id="<?= $producto['id'] ?>" class="product-row">
                        <th scope="row" class="row-data"><?= $value['id'] ?></th>
                        <td class="row-data"><?= $value['nombre'] ?></td>
                        <td class="row-data"><?= $value['marca'] ?></td>
                        <td class="row-data"><?= $value['modelo'] ?></td>
                        <td class="row-data"><?= $value['precio'] ?></td>
                        <td class="row-data"><?= $value['unidades'] ?></td>
                        <td class="row-data"><?= $value['detalles'] ?></td>
                        <td class="row-data"><img src=<?= $value['imagen']?> ></td>
                        <td class="row-data"><input type="button" value="Editar producto" onclick="show(event)" /></td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>

        <?php elseif(!empty($id)) : ?>

            <script>
                alert('El ID del producto no existe');
            </script>

        <?php endif; ?>
    </body>
</html>