<?php
$jsonFile = __DIR__ . '/products.json';

// Obtengo los datos que se reciben por Post
$data = json_decode(file_get_contents('php://input'), true);

//A#adir producto
if($data['action'] === "generate"){
    $products = [];
    if (file_exists($jsonFile)) {
        $products = json_decode(file_get_contents($jsonFile), true);
    }

    $found = false;
    foreach ($products as &$product) { // aqui se usa para hacer referencia al indice principal
        if ($product['id'] === $data['id'] && $product['name'] === $data['name']) {
            //si exite la data la actualiza
            $product['quantity'] += $data['quantity'];
            $product['total'] += $data['total'];
            $found = true;
            break;
        }
    }

    // Si no se encontró el producto, agregarlo como uno nuevo
    if (!$found) {
        $products[] = $data;
    }

    file_put_contents($jsonFile, json_encode($products, JSON_PRETTY_PRINT));

    // Enviar una respuesta al cliente
    header('Content-Type: application/json');
    echo json_encode(['message' => 'Producto guardado correctamente']);
}

//borrar producto
if ($data['action'] === 'delete') {

    if (isset($data['id'])) {
        $productId = $data['id']; // ID del producto recibido
        
        if (file_exists($jsonFile)) {
            $products = json_decode(file_get_contents($jsonFile), true);

            // Filtrar productos para eliminar el que coincide con el ID
            $filteredProducts = array_filter($products, function ($product) use ($productId) {
                return $product['id'] != $productId; // Mantén productos que no coincidan con el ID
            });

            // Reescribir el archivo JSON actualizado
            file_put_contents($jsonFile, json_encode(array_values($filteredProducts), JSON_PRETTY_PRINT));

            echo json_encode(['success' => true]);
            exit;
        }
    }

    // Responder con error si algo falla
    echo json_encode(['success' => false, 'message' => 'ID no proporcionado o error interno']);
}
