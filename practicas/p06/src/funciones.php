<?php
    function es_multiplo5y7($num){ #Ejercicio 1
        if ($num%5==0 && $num%7==0)
            {
                echo '<h3>R= El número '.$num.' SÍ es múltiplo de 5 y 7.</h3>';
            }
            else
            {
                echo '<h3>R= El número '.$num.' NO es múltiplo de 5 y 7.</h3>';
            }
    }

    function esPar($numero){ #Función para verificar si es par (matriz) Ejercicio 2
        return $numero%2===0;
    }

    function esImpar($numero){ #Función para verificar si es impar (matriz) Ejercicio 2
        return $numero%2!==0;
    }

    function matrizSecuencia(){ #Ejercicio 2
        $matriz = []; #Creamos nuestra matriz
        $iteraciones = 0; #Número de iteraciones
        $numgen = 0;
    
        do {
            $fila = [
                rand(100, 999), #Generamos un número de 3 dígitos, por lo que abarca del 100 al 999.
                rand(100, 999),
                rand(100, 999)
            ];
    
            $numgen += 3;
            $iteraciones++;
    
            if(esImpar($fila[0]) && esPar($fila[1]) && esImpar($fila[2])) {
                $matriz[] = $fila;
                break;
            }
        } while (true);
    
        return [ #Retornamos los valores
            'matriz' => $matriz,
            'iteraciones' => $iteraciones,
            'numerosGenerados' => $numgen
        ];
    }
    
    function encontrarMultiplo($multiploNum){ #Ejercicio 3
        $num = rand(1, 1000);
        while ($num%$multiploNum!== 0) {
            $num = rand(1, 1000);
        }
        return $num;
    }
    
    function encontrarMultiploDoWhile($multiploNum){ #Ejercicio 3
        do {
            $num = rand(1, 1000);
        } while ($num % $multiploNum !== 0);
        return $num;
    }
    
    function arregloAscii(){ #Ejercicio 4 
        $arreglo=[];
        for($i = 97; $i<=122; $i++){ #Usamos un for para realizar las iteraciones
            $arreglo[$i] = chr($i); #Utilizamos la funiín chr(n) 
        }
        return $arreglo; #Retornamos el arreglo
    }

    function validarEdSex($edad, $sexo){ #Ejercicio 5
        if($sexo==='femenino' && $edad>=18 && $edad<=35){
            return "Bienvenida, usted está en el rango de edad permitido.=D";
        }
        else{
            return "Lo lamentamos, no cumple con el rango de edad establecido.=c";
        }
    }
    
    function parqueVehicular(){ #Ejercicio 6
        return [
            "ABC1234" => [
                "Auto" => ["marca" => "Toyota", "modelo" => 2020, "tipo" => "sedan"],
                "Propietario" => ["nombre" => "Juan Carlos", "ciudad" => "Puebla", "direccion" => "Av. Reforma 123"]
            ],
            "DEF5678" => [
                "Auto" => ["marca" => "Honda", "modelo" => 2019, "tipo" => "hatchback"],
                "Propietario" => ["nombre" => "Alejandro Mariscal", "ciudad" => "Puebla", "direccion" => "Calle Juarez 45"]
            ],
            "XYZ9876" => [
                "Auto" => ["marca" => "Mazda", "modelo" => 2021, "tipo" => "camioneta"],
                "Propietario" => ["nombre" => "Paola Rojas", "ciudad" => "Puebla", "direccion" => "Boulevard Hidalgo 99"]
            ],
            "LMN6543" => [
                "Auto" => ["marca" => "Ford", "modelo" => 2018, "tipo" => "sedan"],
                "Propietario" => ["nombre" => "Jahir Flores", "ciudad" => "Puebla", "direccion" => "Insurgentes Sur 501"]
            ],
            "PQR1122" => [
                "Auto" => ["marca" => "Nissan", "modelo" => 2020, "tipo" => "camioneta"],
                "Propietario" => ["nombre" => "Marco Valencia", "ciudad" => "Puebla", "direccion" => "Centro Historico"]
            ],
            "GHJ7789" => [
                "Auto" => ["marca" => "Chevrolet", "modelo" => 2017, "tipo" => "hatchback"],
                "Propietario" => ["nombre" => "Valeria Rojo", "ciudad" => "Puebla", "direccion" => "Calle Hidalgo 67"]
            ],
            "ZXC4455" => [
                "Auto" => ["marca" => "Kia", "modelo" => 2022, "tipo" => "sedan"],
                "Propietario" => ["nombre" => "Marlon Herrera", "ciudad" => "Puebla", "direccion" => "Av. Las Torres"]
            ],
            "BNM3210" => [
                "Auto" => ["marca" => "Volkswagen", "modelo" => 2020, "tipo" => "camioneta"],
                "Propietario" => ["nombre" => "Jesus Carro", "ciudad" => "Puebla", "direccion" => "Centro Sur"]
            ],
            "RTY9988" => [
                "Auto" => ["marca" => "Tesla", "modelo" => 2021, "tipo" => "sedan"],
                "Propietario" => ["nombre" => "Ana Garcia", "ciudad" => "Puebla", "direccion" => "Zona Hotelera"]
            ],
            "ASD2233" => [
                "Auto" => ["marca" => "Hyundai", "modelo" => 2019, "tipo" => "hatchback"],
                "Propietario" => ["nombre" => "Ana Vazquez", "ciudad" => "Puebla", "direccion" => "Malecon"]
            ],
            "JKL3344" => [
                "Auto" => ["marca" => "BMW", "modelo" => 2022, "tipo" => "camioneta"],
                "Propietario" => ["nombre" => "Ernesto Flores", "ciudad" => "Puebla", "direccion" => "Blvd. Campestre"]
            ],
            "QWE5566" => [
                "Auto" => ["marca" => "Audi", "modelo" => 2021, "tipo" => "sedan"],
                "Propietario" => ["nombre" => "Silvia Vazquez", "ciudad" => "Puebla", "direccion" => "Zona Centro"]
            ],
            "UIO7788" => [
                "Auto" => ["marca" => "Mercedes", "modelo" => 2020, "tipo" => "hatchback"],
                "Propietario" => ["nombre" => "Rafael Bazalda", "ciudad" => "Puebla", "direccion" => "Colonia Centro"]
            ],
            "VBN8899" => [
                "Auto" => ["marca" => "Jeep", "modelo" => 2018, "tipo" => "camioneta"],
                "Propietario" => ["nombre" => "Candido Flores", "ciudad" => "Puebla", "direccion" => "Av. Camelinas"]
            ],
            "MNO9900" => [
                "Auto" => ["marca" => "Subaru", "modelo" => 2021, "tipo" => "sedan"],
                "Propietario" => ["nombre" => "Jose Carro", "ciudad" => "Puebla", "direccion" => "Centro Historico"]
            ]
        ];
    }
    ?>