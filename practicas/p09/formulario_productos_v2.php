<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Actualizar Productos</title>
    <style type="text/css">
      body{
        background-color: lightgray;
        padding: 25px;
        font-family:'Times New Roman', Times, serif
      }
        ol, ul { 
          list-style-type: none;
          align-items: center;
          align-content: center;
        }
        h1{
          text-align: center;
          color: rgb(23, 4, 41);
          font-size: 40px;
        }
        fieldset{
          background-color: aliceblue;
        }
        .contenedor_boton{
          text-align: center;
        }
        .boton{
          text-align: center;
          background-color: white;
          padding: 10px;
          font-size: 15px;
          font-style: italic;
          cursor: pointer;
          transition: background-color 0.5s, transform 0.3s;
        }
        .boton:hover{
          background-color: rgb(75, 221, 75);
          box-shadow: 0 5px 16px rgba(0, 0, 0, 0,5);
          color: white;
          font-weight: bold;
          transform: scale(1.1);

        }
        .lista{
          font-weight: bold;
          padding: 5px;
        }
      </style>
</head>
<body>
  <?php
    if (empty($_POST['id']) && empty($_GET['id'])) {
        echo "<p>Error: No se proporcionó un ID de producto válido.</p>";
        exit;
    }
  ?>
    <h1>Actualiza los datos de tu Producto</h1>
    <p>Ingresa las características que desees actualizar</p>
    <form id="formularioProductos" action="update_producto.php" method="POST" >
        <h3>Datos del producto:</h3>
             <fieldset>
              <ul>
                  <li><label for="form-id">ID:</label>
                      <input type="text" id="form-id" value="<?= !empty($_POST['id']) ? $_POST['id'] : (isset($_GET['id']) ? $_GET['id'] : '') ?>" disabled>
                      <input type="hidden" name="id" value="<?= !empty($_POST['id']) ? $_POST['id'] : (isset($_GET['id']) ? $_GET['id'] : '') ?>">
                  </li>

                  <li class="lista"><label for="form-nombre" class="contenedor_lista">Nombre:</label> <input type="text" name="nombre" id="form-nombre" 
                  value="<?= !empty($_POST['nombre']) ? $_POST['nombre'] : (isset($_GET['nombre']) ? $_GET['nombre'] : '') ?>" placeholder="No mas de 100 caracteres"></li>

                  <li class="lista">
                    <label for="form-marca">Marca:</label> 
                    <select name="marca" id="form-marca">
                      <option value="">Selecciona una marca</option>
                      <option value="Korea Sports" <?= (isset($_POST['marca']) && $_POST['marca'] == 'Korea Sports') 
                      || (isset($_GET['marca']) && $_GET['marca'] == 'Korea Sports') ? 'selected' : '' ?>>Korea Sports</option>
                      <option value="Adidas" <?= (isset($_POST['marca']) && $_POST['marca'] == 'Adidas') 
                      || (isset($_GET['marca']) && $_GET['marca'] == 'Adidas') ? 'selected' : '' ?>>Adidas</option>
                      <option value="Asiana" <?= (isset($_POST['marca']) && $_POST['marca'] == 'Asiana') 
                      || (isset($_GET['marca']) && $_GET['marca'] == 'Asiana') ? 'selected' : '' ?>>Asiana</option>
                      <option value="Nexus" <?= (isset($_POST['marca']) && $_POST['marca'] == 'Nexus') 
                      || (isset($_GET['marca']) && $_GET['marca'] == 'Nexus') ? 'selected' : '' ?>>Nexus</option>
                      <option value="Mooto" <?= (isset($_POST['marca']) && $_POST['marca'] == 'Mooto') 
                      || (isset($_GET['marca']) && $_GET['marca'] == 'Mooto') ? 'selected' : '' ?>>Mooto</option>
                      <option value="Daedo" <?= (isset($_POST['marca']) && $_POST['marca'] == 'Daedo') 
                      || (isset($_GET['marca']) && $_GET['marca'] == 'Daedo') ? 'selected' : '' ?>>Daedo</option>
                    </select></li>

                  <li class="lista"><label for="form-modelo">Modelo:</label> <input type="text" name="modelo" id="form-modelo" 
                  value="<?= !empty($_POST['modelo']) ? $_POST['modelo'] : (isset($_GET['modelo']) ? $_GET['modelo'] : '') ?>" placeholder="No mas de 25 caracteres"></li>

                  <li class="lista"><label for="form-precio">Precio:</label> <input type="number" name="precio" id="form-precio"
                  value="<?= !empty($_POST['precio']) ? $_POST['precio'] : (isset($_GET['precio']) ? $_GET['precio'] : '') ?>"></li>

                  <li class="lista"><label for="form-detalles">Detalles:</label><br> <textarea name="detalles" id="form-detalles" rows="4" cols="60" 
                   placeholder="No mas de 250 caracteres"><?= !empty($_POST['detalles'])?$_POST['detalles']:$_GET['detalles'] ?></textarea></li>

                  <li class="lista"><label for="form-unidades">Unidades:</label> <input type="number" name="unidades" id="form-unidades"
                  value="<?= !empty($_POST['unidades']) ? $_POST['unidades'] : (isset($_GET['unidades']) ? $_GET['unidades'] : '') ?>"></li>

                  <li class="lista"><label for="form-img">Imagen:</label> <input type="text" name="img" id="form-img"
                  value="<?= !empty($_POST['img']) ? $_POST['img'] : (isset($_GET['img']) ? $_GET['img'] : 'imagen.png') ?>"></li>
                </ul>
             </fieldset>

              <div class="contenedor_boton">
                <input type="submit" class="boton" value="Actualizar Producto"></button>
                <input type="reset" value="Restablecer">
             </div>
    </form>
    <script src="js/validaciones.js"></script>
</body>
</html>