<?php
    use TECWEB\MYAPI\Products as Products;
    require_once __DIR__ . '/myapi/Products.php';
    
    $json = file_get_contents('php://input');
    $data = json_decode($json);
    
    $prodObj = new Products('marketzone');
    $prodObj->edit($data);
    
    echo $prodObj->getData();
?>