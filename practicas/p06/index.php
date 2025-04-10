<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Práctica 6</title>
    <style>
        body{
            background-color: lightsteelblue;
            padding: 20px;
        }
        h1{
            font-size: 40px;
            font-weight: bold;
            color: white;
            padding: 10px;
            border: 5px solid;
            text-align: center;
            text-shadow: 3px 3px 2px grey;
        }
        h2{
            background-color: grey;
            color: whitesmoke;
        }
    </style>
</head>
<body>
    <h1>PRÁCTICA 6</h1>
    <h2>Ejercicio 1</h2>
    <p>Escribir programa para comprobar si un número es un múltiplo de 5 y 7</p>
    <?php
        require_once 'src/funciones.php'; //Incluimos el archivo funciones.php
        if(isset($_GET['numero']))
        {
            es_multiplo5y7($_GET['numero']);
        }
    ?>
    <h2>Ejercicio 2</h2>
    <p>
        Crea un programa para la generación repetitiva de 3 números aleatorios hasta obtener una
        secuencia compuesta por:<br><br>
        <strong><center>Impar, Par, Impar</center></strong>
    </p>
    <?php
        $res = matrizSecuencia();

        echo $res['numerosGenerados'].' números obtenidos en '. $res['iteraciones'].' iteraciones.<br>';
        echo '<br><table border="5">';
        foreach ($res['matriz'] as $fila) {
            echo '<tr>';
            foreach ($fila as $numero) {
                echo '<td>' . $numero . '</td>';
            }
        echo '</tr>';
        }
        echo '</table>';
    ?>

    <h2>Ejercicio 3</h2>
    <p>
        Utiliza un ciclo while para encontrar el primer número entero obtenido aleatoriamente,
        pero que además sea múltiplo de un número dado.
    </p>
    <?php
        if(isset($_GET['multiplo'])){
            $multiploNum= $_GET['multiplo'];

            if(is_numeric($multiploNum) && $multiploNum>0){ #Validación
                $resultado= encontrarMultiplo($multiploNum);
                echo "<p> El 1er múltiplo de $multiploNum encontrado con el ciclo while es: $resultado";
            }
            else{
                echo '<p> ERROR: Ingrese un número válido para el múltiplo, por favor.';
            }
        }
    ?>

    <p><strong>Con do-while:</strong></p>
    <?php
        if(isset($_GET['multiplo'])){
            if(is_numeric($multiploNum) && $multiploNum>0){
                $resultado= encontrarMultiploDoWhile($multiploNum);
                echo "<p> El 1er múltiplo de $multiploNum encontrado con el ciclo while es: $resultado";
            }
        }

    ?>

    <h2>Ejercicio 4</h2>
    <p>
        Crear un arreglo cuyos índices van de 97 a 122 y cuyos valores son las letras de la ‘a’
        a la ‘z’. Usa la función chr(n) que devuelve el caracter cuyo código ASCII es n para poner
        el valor en cada índice.
    </p>
    <?php
        $arregloAscii= arregloAscii();
        echo '<table border="5">';
        echo '  <tr>
                    <th>
                        Índice
                    </th>
                <th>
                    Valor
                </th>
                </tr>';
        foreach($arregloAscii as $indice => $valor) {
            echo "<tr><td>$indice</td><td>$valor</td></tr>";
        }
        echo '</table>';
    ?>

    <h2>Ejercicio 5</h2>
    <p>
        Usar las variables $edad y $sexo en una instrucción if para identificar una persona de
        sexo “femenino”, cuya edad oscile entre los 18 y 35 años y mostrar un mensaje de
        bienvenida apropiado.
    </p>
    <br>
    <form method="post">
        <label for="edad">Edad:</label>
        <input type="number" name="edad" id="edad" required><br>
            
        <label for="sexo">Sexo:</label>
        <select name="sexo" id="sexo" required>
            <option value="femenino">Femenino</option>
            <option value="masculino">Masculino</option>
        </select><br>
        <button type="submit">Enviar</button>
    </form>

    <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $edad = $_POST['edad'];
            $sexo = $_POST['sexo'];
            echo '<h4>' . validarEdSex($edad, $sexo) . '</h4>';
        }
    ?>

    <h2>Ejercicio 6</h2>
    <p>
        Crea en código duro un arreglo asociativo que sirva para registrar el parque vehicular de
        una ciudad.
    </p>
    <h4><center>---Consulta de Vehículos---</center> </h4>
    <form method="post">
        <label for="matricula">Matrícula:</label>
        <input type="text" name="matricula" id="matricula"><br>
        <button type="submit">Buscar vehículo</button>
    </form>

    <?php
        $parqueVehicular = parqueVehicular();

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['matricula'])) {
            $matricula = $_POST['matricula'];
            if (isset($parqueVehicular[$matricula])) {
                echo '<h3>Datos del vehículo:</h3>';
                echo '<pre>' . print_r($parqueVehicular[$matricula], true) . '</pre>';
            } else {
                echo '<p>No se encontraron vehículos con esa matrícula.</p>';
            }
        }
        echo '<p>Todos los vehículos: </p>';
        echo '<pre>'.print_r($parqueVehicular, true).'</pre>';
    ?>
    
</body>
</html>