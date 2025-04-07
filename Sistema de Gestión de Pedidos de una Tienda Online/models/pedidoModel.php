<?php
require_once __DIR__ . '/../config/database.php';

use Illuminate\Database\Eloquent\Model;

class pedidoModel extends Model
{
    protected $table = 'pedido'; 
    public $timestamps = false;
    protected $fillable = ['cliente', 'total', 'estado', 'fecha_creacion'];

    // Relación: llave primaria pedido_id
    public function detalles()
    {
      return $this->hasMany(detallePedidoModel::class, 'pedido_id');
    }

    public function pedidoInsert($cliente, $total)
    {
        try {
            $date = date('Y-m-d H:i:s');
            $pedido = self::create([
                'cliente' => $cliente,
                'total' => $total,
                'estado' => 'pendiente',
                'fecha_creacion' =>$date, 
            ]);

            return $pedido;
        } catch (PDOException $e) {
            $error = ['status' => 'ERROR', 'message' => "An error has occurred: " . $e->getMessage()];
            echo json_encode($error);
        }
    }

}
?>
