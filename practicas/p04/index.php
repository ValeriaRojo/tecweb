<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Práctica 3</title>
    <style>
        body{
            background-color:rgb(231, 192, 216);
            padding: 30px;
        }
        h1{
            text-align: center;
            font-size: 30px;
            color: #fff;
            background: linear-gradient(90deg,rgb(99, 28, 99),rgb(72, 0, 105));
            padding: 15px;
            border-radius: 15px;
            box-shadow: 0 7px 15px rgba(0, 0, 0, 0.3);
            display: center;
            text-transform: uppercase;
            letter-spacing: 5px;
            margin: center;
        }
        h2{
            text-align: center;
            font-weight: bold;
        }
        div{
            padding: 20px;
            margin: 10px;
            background-color: white;
            border-radius: 20px;
        }
    </style>
</head>
<body>
    <h1>PRÁCTICA 3</h1>
    <h2>Ejercicio 1</h2>
    <p>Determina cuál de las siguientes variables son válidas y explica por qué:</p>
    <p>$_myvar,  $_7var,  myvar,  $myvar,  $var7,  $_element1, $house*5</p>
    <div>
        <?php
            //AQUI VA MI CÓDIGO PHP
            $_myvar;
            $_7var;
            //myvar;       // Inválida
            $myvar;
            $var7;
            $_element1;
            //$house*5;     // Inválida
            
            echo '<h4>Respuesta:</h4>';   
        
            echo '<ul>';
            echo '<li>$_myvar es válida porque inicia con guión bajo.</li>';
            echo '<li>$_7var es válida porque inicia con guión bajo.</li>';
            echo '<li>myvar es inválida porque no tiene el signo de dolar ($).</li>';
            echo '<li>$myvar es válida porque inicia con una letra.</li>';
            echo '<li>$var7 es válida porque inicia con una letra.</li>';
            echo '<li>$_element1 es válida porque inicia con guión bajo.</li>';
            echo '<li>$house*5 es inválida porque el símbolo * no está permitido.</li>';
            echo '</ul>';
            unset($_myvar, $myvar, $var7, $_element1);
        ?>
    </div>

    <h2>Ejercicio 2</h2>
    <p>Proporcionar los valores de $a, $b, $c como sigue:</p>
    <p>
        <ul>
            <li>$a = “ManejadorSQL”;<br></li>
            <li>$b = 'MySQL’;<br></li>
            <li>$c = &$a;<br><br></li>
        </ul>
            
        a. Ahora muestra el contenido de cada variable<br><br>
        b. Agrega al código actual las siguientes asignaciones:<br><br>
        <ul>
            <li>$a = “PHP server”;<br></li>
            <li>$b = &$a;<br><br></li>
        </ul>
        c. Vuelve a mostrar el contenido de cada uno<br><br>
        d. Describe en y muestra en la página obtenida qué ocurrió en el segundo bloque de
        asignaciones
    </p>
    <div>
        <?php
            //Asignamos valores
            $a = "ManejadorSQL";  
            $b = 'MySQL';        
            $c = &$a;
            //Mostramos valores de las variables
            echo '<h4>Respuesta:</h4>';     
            echo "a = $a, b = $b, c = $c<br />";
            //Asignamos nuevos valores al código actual
            $a = "PHP server";
            $b = &$a;
            echo "a = $a, b = $b, c = $c<br />";
            echo "Al modificar en el segundo bloque de asignaciones lo que ocurrió fué que le dimos un nuevo valor a la variable
            'a', posteriormente a la variable b le dimos la referencia de 'a', así que de igual manera le asignó el contenido de
            'a'. Finalmente, 'c' se modificó debido a que en el primer bloque tiene referenciado a 'a'"
            //Liberamos
            unset($a, $b, $c);
        ?>
    </div>

    <h2>Ejercicio 3</h2>
    <p>
        Muestra el contenido de cada variable inmediatamente después de cada asignación,
        verificar la evolución del tipo de estas variables (imprime todos los componentes de los
        arreglo):
    </p>
    <p>
        $a = “PHP5”;<br>
        $z[] = &$a;<br>
        $b = “5a version de PHP”;<br>
        $c = $b*10;<br>
        $a .= $b;<br>
        $b *= $c;<br>
        $z[0] = “MySQL”;
    </p>
    <div>
        <?php
            echo '<h4>Respuesta:</h4>';
            $a = "PHP5";
            var_dump($a);
            echo "<br />";
            $z[] = &$a;
            $b = "5a version de PHP";
            $c = $b*10;
            $a .= $b;
            $b *= $c;
            $z[0] = "MySQL";
        
        ?>
    </div>
    <h2>Ejercicio 4</h2>
    <p>
        Lee y muestra los valores de las variables del ejercicio anterior, pero ahora con la ayuda de
        la matriz $GLOBALS o del modificador global de PHP.
    </p>
    <div>
        <?php
        
        ?>
    </div>

    <h2>Ejercicio 5</h2>
    <p>Dar el valor de las variables $a, $b, $c al final del siguiente script:</p>
    <p>
        $a = “7 personas”;<br>
        $b = (integer) $a;<br>
        $a = “9E3”;<br>
        $c = (double) $a;<br>
    </p>
    <div>
        <?php
        
        ?>
    </div>

    <h2>Ejercicio 6</h2>
    <p>
        Dar y comprobar el valor booleano de las variables $a, $b, $c, $d, $e y $f y muéstralas
        usando la función var_dump(datos).<br><br>
        Después investiga una función de PHP que permita transformar el valor booleano de $c y $e
        en uno que se pueda mostrar con un echo:<br>
        $a = “0”;<br>
        $b = “TRUE”;<br>
        $c = FALSE;<br>
        $d = ($a OR $b);<br>
        $e = ($a AND $c);<br>
        $f = ($a XOR $b);
    </p>
    <div>
        <?php
        
        ?>
    </div>

    <h2>Ejercicio 7</h2>
    <p>
        Usando la variable predefinida $_SERVER, determina lo siguiente:<br><br>
        a. La versión de Apache y PHP.<br>
        b. El nombre del sistema operativo (servidor).<br>
        c. El idioma del navegador (cliente).
    </p>
    <div>
        <?php
        
        ?>
    </div>
</body>
</html>