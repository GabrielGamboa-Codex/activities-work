<?php
include __DIR__ . '/../models/ordersModel.php';

class productController
{
    public function indexProduct()
    {
        include __DIR__ . '/../views/header.php';
        include __DIR__ . '/../views/ordersView.php';
        include __DIR__ . '/../views/footer.php';
        return;
    }

}
