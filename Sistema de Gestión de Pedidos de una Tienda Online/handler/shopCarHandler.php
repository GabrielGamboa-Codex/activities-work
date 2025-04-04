<?php
require  __DIR__ . '/../controllers/shopCarController.php';

$data = json_decode(file_get_contents('php://input'), true);

if ($data['action'] == 'insert') 
{
    $productos = $data['productos'];
    $cliente = $data['cliente'];
    $total = array_sum(array_column($productos, 'total'));
    $send = new shopCarController;
    $send -> insertPedido($cliente, $total, $productos);
    
        // Ruta del archivo JSON
        $jsonFile = __DIR__ . '/../config/products.json';

        // Validar si el archivo existe antes de borrarlo
        if (file_exists($jsonFile)) {
            unlink($jsonFile); // Borrar el archivo JSON
        }
}


?>