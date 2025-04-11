<?php
require_once __DIR__ . '/../models/orderModel.php';
require_once __DIR__ . '/../models/productModel.php';
require_once __DIR__ . '/../models/detailsOrderModel.php';

class orderController
{
    public function indexOrders()
    {
        include __DIR__ . '/../views/header.php';
        include __DIR__ . '/../views/footer.php';
        include __DIR__ . '/../views/ordersView.php';
        return;
    }

    public function showOrders()
    {
            $orders = orderModel::with(['detalles.producto'])->get();
        
            $data = [];
            foreach ($orders as $order) {
                $productos = '';
                $totalorder = 0;
        
                foreach ($order->detalles as $detalle) {
                    $productos .= '<li>' . ($detalle->producto->nombre ?? 'Sin producto') .
                        ', Cantidad: ' . $detalle->cantidad .
                        ', Precio Unitario: ' . number_format($detalle->producto->precio ?? 0, 2) . '$' .
                        ', Subtotal: ' . number_format($detalle->subtotal, 2) .'$' . '</li>';
        
                    $totalorder += $detalle->subtotal; 
                }
        
                $data[] = [
                    'id' => $order->id,
                    'cliente' => $order->cliente,
                    'estado' => $order->estado,
                    'productos' => '<ul>' . $productos . '</ul>',
                    'total' => number_format($totalorder, 2) . '$'
                ];
            }
        
            echo json_encode($data); 
        }
        

}