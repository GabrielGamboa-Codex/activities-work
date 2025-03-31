<?php
require_once __DIR__ . '/../config/database.php';

use Illuminate\Database\Eloquent\Model;

class TeamModel extends Model
{

    protected $table = 'detalle_pedido';

     public function pedidos()
     {
         try {
         } catch (PDOException $e) {
             $error = ['status' =>  'ERROR', 'message' => "An error has occurred:" . $e->getMessage()];
             echo json_encode($error);
         }
     }
 }