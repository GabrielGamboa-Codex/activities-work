<?php
$jsonFile = __DIR__ . '/products.json';

$data = json_decode(file_get_contents('php://input'), true);

if($data['action'] === "generate"){
    $products = [];
    if (file_exists($jsonFile)) {
        $products = json_decode(file_get_contents($jsonFile), true);
    }

    $found = false;
    foreach ($products as &$product) { 
        if ($product['id'] === $data['id'] && $product['name'] === $data['name']) {
            $product['quantity'] += $data['quantity'];
            $product['total'] += $data['total'];
            $found = true;
            break;
        }
    }

    if (!$found) {
        $products[] = $data;
    }

    file_put_contents($jsonFile, json_encode($products, JSON_PRETTY_PRINT));

    header('Content-Type: application/json');
    echo json_encode(['message' => 'Producto guardado correctamente']);
}

if ($data['action'] === 'delete') {

    if (isset($data['id'])) {
        $productId = $data['id']; 
        
        if (file_exists($jsonFile)) {
            $products = json_decode(file_get_contents($jsonFile), true);

            $filteredProducts = array_filter($products, function ($product) use ($productId) {
                return $product['id'] != $productId; 
            });

            file_put_contents($jsonFile, json_encode(array_values($filteredProducts), JSON_PRETTY_PRINT));

            echo json_encode(['success' => true]);
            exit;
        }
    }

    echo json_encode(['success' => false, 'message' => 'ID no proporcionado o error interno']);
}
