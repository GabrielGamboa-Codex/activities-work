<?php
include "./controllers/productController.php";

spl_autoload_register(function ($class) {
    $path = str_replace('\\', '/', $class);
    $file = __DIR__ . '/../' . $path . '.php';
    if (file_exists($file)) {
        require $file;
    }
});

$product = new productController;


$action = isset($_GET['action']) ? $_GET['action'] : 'productVIew';

switch ($action) {
    case 'productVIew':
        $product->indexProduct();
        break;
}
