<?php
    function es_multiplo5y7($num){
        if ($num%5==0 && $num%7==0)
            {
                echo '<h3>R= El número '.$num.' SÍ es múltiplo de 5 y 7.</h3>';
            }
            else
            {
                echo '<h3>R= El número '.$num.' NO es múltiplo de 5 y 7.</h3>';
            }
    }

    function matrizAleatorios(){
        $matriz=[];
        $totalnum=0;

        for($i=0; ; $i++){
            $fila=[];
            
            for($j=0; ; $j++){
                $n=rand(100, 999);
                $fila[] = $n;
                $totalnum++;
            }

        if(impar($fila[0]) && par($fila[1]) && impar($fila[2])){
            $matriz[] = $fila;
            break;
        }
    }

    echo "Matriz de números aleatorios (impar, par, impar): ";
    foreach($matriz as $fila){
        for($i=0; $i<count($fila); $i++){
            echo $fila[1];
            if($i<count($fila)-1){
                echo ',';
            }
        }
        echo '</br>';
    }
    echo '</br>Cantidad de números generados: $totalnum </br>';
}

    function impar($n){ //Función para determinar si el número es impar
        return $n % 2 != 0;
    }

    function par($n){ //Función para determinar si el número es par
        return $n % 2 == 0;
    }

?>