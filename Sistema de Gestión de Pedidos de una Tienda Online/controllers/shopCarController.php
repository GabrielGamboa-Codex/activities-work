<?php
include __DIR__ . '/../models/detallePedidoModel.php';
include __DIR__ . '/../models/pedidoModel.php';

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
    
public function insertPedido($cliente, $total, $products)
{
    $pedido = new pedidoModel();
    $detallePedido = new detallePedidoModel();

    // Insertar el pedido y capturar la instancia
    $pedidoData = $pedido->pedidoInsert($cliente, $total);
    $data = $pedidoData->id; // Capturar el ID del pedido creado

    // Iterar sobre los productos y registrar los detalles
    foreach ($products as $producto) {
        $detallePedido->detalleInsert(
            $data, // ID del pedido creado
            $producto['id'],
            $producto['quantity'],
            $producto['total']
        );
    }
}


}

