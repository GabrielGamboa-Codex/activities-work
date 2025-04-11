<?php

require_once __DIR__ . '/../models/orderModel.php';

if ($_POST['action'] == 'edit') 
{

    $id = $_POST['id'];
    $status = $_POST['status'];

    $data = new orderModel;
    $data->editStatus($id, $status);
}