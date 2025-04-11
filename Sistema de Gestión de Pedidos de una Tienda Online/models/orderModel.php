<?php
require_once __DIR__ . '/../config/database.php';

use Illuminate\Database\Eloquent\Model;

class orderModel extends Model
{
    protected $table = 'pedido'; 
    public $timestamps = false;
    protected $fillable = ['cliente', 'total', 'estado', 'fecha_creacion'];

    public function detalles()
    {
      return $this->hasMany(detailsOrderModel::class, 'pedido_id');
    }

    public function orderInsert($client, $total)
    {
        try {
            $date = date('Y-m-d H:i:s');
            $order = self::create([
                'cliente' => $client,
                'total' => $total,
                'estado' => 'pendiente',
                'fecha_creacion' =>$date, 
            ]);

            return $order;
        } 
        catch (PDOException $e) {
            $error = ['status' => 'ERROR', 'message' => "An error has occurred: " . $e->getMessage()];
            echo json_encode($error);
        }
    }

    public function editStatus($id, $status)
    {
        try {
            $pedido = self::find($id);
            if ($pedido) {
            $pedido->estado = $status;
            $pedido->save();
            } 
            else {
                return ['status' => 'ERROR', 'message' => 'Order no Found.'];
            }
        } 
        catch (PDOException $e) {
            return ['status' => 'ERROR', 'message' => 'An error has occurred: ' . $e->getMessage()];
        }
    }

}
?>
