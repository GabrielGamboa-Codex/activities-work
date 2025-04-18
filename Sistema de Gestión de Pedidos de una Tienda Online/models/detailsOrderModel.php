<?php
require_once __DIR__ . '/../config/database.php';

use Illuminate\Database\Eloquent\Model;

class detailsOrderModel extends Model
{

    protected $table = 'detalle_pedido';
    public $timestamps = false;
    protected $fillable = ['pedido_id', 'producto_id', 'cantidad', 'subtotal'];

        public function pedido()
        {
            return $this->belongsTo(orderModel::class, 'pedido_id');
        }
    
        public function producto()
        {
            return $this->belongsTo(productModel::class, 'producto_id');
        }        

     public function detailsInsert($id, $productId, $amount, $subtotal)
     {
        $pedido = self::create([
            'pedido_id' => $id,
            'producto_id' => $productId,
            'cantidad' => $amount,
            'subtotal' => $subtotal, 
        ]);
         try {
         } 
         catch (PDOException $e) {
             $error = ['status' =>  'ERROR', 'message' => "An error has occurred:" . $e->getMessage()];
             echo json_encode($error);
         }
     }    
 }
 