
<?php
require_once __DIR__ . '/myapi2/Model.php';
use TECWEB\MYAPI\Models\ProductModel;

$name = $_POST['name'];  
$prodObj = new ProductModel('marketzone');  
$response = $prodObj->singleByName($name);  
echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

?>