<?php
require_once __DIR__ . '/../models/pedidoModel.php';
require_once __DIR__ . '/../models/productModel.php';
require_once __DIR__ . '/../models/detallePedidoModel.php';

class orderController
{
    public function indexOrders()
    {
        include __DIR__ . '/../views/header.php';
        include __DIR__ . '/../views/footer.php';
        include __DIR__ . '/../views/ordersView.php';
        return;
    }

    public function mostrarPedidos()
    {
            $pedidos = pedidoModel::with(['detalles.producto'])->get();
        
            $data = [];
            foreach ($pedidos as $pedido) {
                $productos = '';
                $totalPedido = 0;
        
                // Crear la lista de productos en formato HTML
                foreach ($pedido->detalles as $detalle) {
                    $productos .= '<li>' . ($detalle->producto->nombre ?? 'Sin producto') .
                        ', Cantidad: ' . $detalle->cantidad .
                        ', Precio Unitario: ' . number_format($detalle->producto->precio ?? 0, 2) . '$' .
                        ', Subtotal: ' . number_format($detalle->subtotal, 2) .'$' . '</li>';
        
                    $totalPedido += $detalle->subtotal; // Acumula el total del pedido
                }
        
                $data[] = [
                    'cliente' => $pedido->cliente,
                    'estado' => $pedido->estado,
                    'productos' => '<ul>' . $productos . '</ul>',
                    'total' => number_format($totalPedido, 2) . '$'
                ];
            }
        
            echo json_encode($data); // Retorna los datos agrupados como JSON
        }
        

}