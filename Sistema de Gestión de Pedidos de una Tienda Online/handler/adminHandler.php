<?php

require_once __DIR__ . '/../models/pedidoModel.php';

if ($_POST['action'] == 'edit') 
{

    $id = $_POST['id'];
    $estatus = $_POST['estatus'];

    $data = new pedidoModel;
    $data->editEstado($id, $estatus);
}