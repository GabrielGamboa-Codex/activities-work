<?php
include "./controllers/productController.php";
include "./controllers/shopCarController.php";
include "./controllers/orderController.php";
include "./controllers/adminController.php";

spl_autoload_register(function ($class) {
    $path = str_replace('\\', '/', $class);
    $file = __DIR__ . '/../' . $path . '.php';
    if (file_exists($file)) {
        require $file;
    }
});

$product = new productController;
$carShop = new shopCarController;
$order = new orderController;
$admin = new adminController;

$action = isset($_GET['action']) ? $_GET['action'] : 'productView';

switch ($action) {
    case 'productView':
        $product->indexProduct();
        break;
    case 'shooppingCarView':
        $carShop->indexShopCar();
        break;
    case 'ordersView':
        $order->indexOrders();
        break;
    case 'adminView':
        $admin->indexAdmin();
        break;
}

