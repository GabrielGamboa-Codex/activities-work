<?php
require_once __DIR__ . '/../models/productModel.php';

class productController
{
    public function indexProduct()
    {
        $productModel = new productModel(); 
        $products = $productModel->dataProduct();
        include __DIR__ . '/../views/header.php';
        include __DIR__ . '/../views/footer.php';
        include __DIR__ . '/../views/productView.php';
        return;
    }


}

