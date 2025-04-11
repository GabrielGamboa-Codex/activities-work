<?php
require  __DIR__ . '/../controllers/shopCarController.php';

$data = json_decode(file_get_contents('php://input'), true);

if ($data['action'] == 'insert') 
{
    $product = $data['products'];
    $client = $data['client'];
    $total = array_sum(array_column($product, 'total'));
    $send = new shopCarController;
    $send -> insertOrder($client, $total, $product);

        $jsonFile = __DIR__ . '/../config/products.json';

        if (file_exists($jsonFile)) {
            unlink($jsonFile);
        }
}


?>