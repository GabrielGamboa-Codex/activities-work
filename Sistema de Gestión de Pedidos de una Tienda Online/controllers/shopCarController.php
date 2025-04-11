<?php
include __DIR__ . '/../models/detailsOrderModel.php';
include __DIR__ . '/../models/OrderModel.php';

class shopCarController
{
    public function indexShopCar()
    {
        include __DIR__ . '/../views/header.php';
        include __DIR__ . '/../views/footer.php';
        include __DIR__ . '/../views/shoppingCarView.php';
        return;
    }

    public function indexOrders()
    {
        include __DIR__ . '/../views/header.php';
        include __DIR__ . '/../views/footer.php';
        include __DIR__ . '/../views/ordersView.php';
        return;
    }
    
public function insertOrder($client, $total, $products)
{
    $order = new orderModel();
    $detailsOrder = new detailsOrderModel();

    $orderData = $order->orderInsert($client, $total);
    $data = $orderData->id; 

    foreach ($products as $product) {
        $detailsOrder->detailsInsert(
            $data, 
            $product['id'],
            $product['quantity'],
            $product['total']
        );
    }
}


}

