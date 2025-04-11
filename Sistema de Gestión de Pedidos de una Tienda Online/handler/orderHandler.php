<?php

require  __DIR__ . '/../controllers/orderController.php';

if ($_POST['action'] == 'print') 
{
    $data = new orderController;
    $data->showOrders();
}

?>