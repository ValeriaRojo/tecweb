<?php
    include_once __DIR__.'/database.php';

    $data = array();

    if( isset($_POST['id']) ) {
        $id = $_POST['id'];
        if ( $result = $conexion->query("SELECT * FROM productos WHERE id = {$id}") ) {
            $row = $result->fetch_assoc();

            if(!is_null($row)) {
                foreach($row as $key => $value) {
                    $data[$key] = ($value);
                }
            }
            $result->free();
        } else {
            die('Query Error: '.mysqli_error($conexion));
        }
        $conexion->close();
    }

    //var_dump($data);
    echo json_encode($data, JSON_PRETTY_PRINT);

?>