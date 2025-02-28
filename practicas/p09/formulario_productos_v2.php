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
    <h1>Actualiza los datos de tu Producto</h1>
    <p>Ingresa las caracteríkisticas que desees actualizar</p>
    <form id="formularioProductos" onsubmit="" method="POST">
        <h3>Datos del producto:</h3>
             <fieldset>
                <ul>
                  <li class="lista"><label for="form-name" class="contenedor_lista">Nombre:</label> <input type="text" name="name" id="form-name" 
                  value="<?= isset($_POST['name'])?$_POST['name']: (isset($_GET['name']) ? $_GET['name'] : '') ?>" placeholder="No mas de 100 caracteres"></li>

                  <li class="lista">
                    <label for="form-marca">Marca:</label> 
                    <select name="marca" id="form-marca">
                      <option value="">Selecciona una marca</option>
                      <option value="Korea-Sports" value="Korea-Sports" <?= (!empty($_POST['marca']) && $_POST['marca'] == 'Korea-Sports') 
                      || (!empty($_GET['marca']) && $_GET['marca'] == 'Korea-Sports') ? 'selected' : '' ?>>Korea Sports</option>
                      <option value="Adidas" <?= (!empty($_POST['marca']) && $_POST['marca'] == 'Adidas') 
                      || (!empty($_GET['marca']) && $_GET['marca'] == 'Adidas') ? 'selected' : '' ?>>Adidas</option>
                      <option value="Asiana" <?= (!empty($_POST['marca']) && $_POST['marca'] == 'Asiana') 
                      || (!empty($_GET['marca']) && $_GET['marca'] == 'Asiana') ? 'selected' : '' ?>>Asiana</option>
                      <option value="Nexus" <?= (!empty($_POST['marca']) && $_POST['marca'] == 'Nexus') 
                      || (!empty($_GET['marca']) && $_GET['marca'] == 'Nexus') ? 'selected' : '' ?>>Nexus</option>
                      <option value="Mooto" <?= (!empty($_POST['marca']) && $_POST['marca'] == 'Mooto') 
                      || (!empty($_GET['marca']) && $_GET['marca'] == 'Mooto') ? 'selected' : '' ?>>Mooto</option>
                      <option value="Daedo" <?= (!empty($_POST['marca']) && $_POST['marca'] == 'Daedo') 
                      || (!empty($_GET['marca']) && $_GET['marca'] == 'Daedo') ? 'selected' : '' ?>>Daedo</option>
                    </select></li>

                  <li class="lista"><label for="form-modelo">Modelo:</label> <input type="text" name="modelo" id="form-modelo" 
                  value="<?= !empty($_POST['modelo'])?$_POST['modelo']:$_GET['modelo'] ?>" placeholder="No mas de 25 caracteres"></li>

                  <li class="lista"><label for="form-precio">Precio:</label> <input type="number" name="precio" id="form-precio"></li>

                  <li class="lista"><label for="form-detalles">Detalles:</label><br> <textarea name="detalles" id="form-detalles" rows="4" cols="60" 
                   placeholder="No mas de 250 caracteres"><?= !empty($_POST['detalles'])?$_POST['detalles']:$_GET['detalles'] ?></textarea></li>

                  <li class="lista"><label for="form-unidades">Unidades:</label> <input type="number" name="unidades" id="form-unidades"
                  value="<?= !empty($_POST['unidades'])?$_POST['unidades']:$_GET['unidades'] ?>"></li>

                  <li class="lista"><label for="form-img">Imagen:</label> <input type="text" name="img" id="form-img"
                  value = "<?= !empty($_POST['img'])?$_POST['img']:$_GET['img'] ?>"></li>
                </ul>
             </fieldset>

              <div class="contenedor_boton">
                <button type="submit" class="boton">Actualizar Producto</button>
              </div>
             <input type="reset" value="Restablecer">
    </form>
    <script src="js/validaciones.js"></script>
</body>
</html>