<?php

use TECWEB\MYAPI\DataBase;

    class Create extends DataBase {
        public function __construct(string $db){

        }

        public function add($object): void {
            $productos = new Products('marketzone');
            $productos->add( json_decode( json_encode($_POST) ) );
            echo $productos->getData();
        }
    }
?>