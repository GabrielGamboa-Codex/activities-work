<?php
include __DIR__ . '/../models/productModel.php';

class productController
{
    public function indexProduct()
    {
        $teamModel = new productModel(); 
        $products = $teamModel->dataProduct();
        include __DIR__ . '/../views/header.php';
        include __DIR__ . '/../views/footer.php';
        include __DIR__ . '/../views/productView.php';
        return;
    }

}

