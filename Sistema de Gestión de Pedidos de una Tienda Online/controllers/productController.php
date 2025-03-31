<?php
include __DIR__ . '/../models/productModel.php';

class productController
{
    public function indexProduct()
    {
        include __DIR__ . '/../views/header.php';
        include __DIR__ . '/../views/productView.php';
        include __DIR__ . '/../views/footer.php';
        $teamModel = new TeamModel();
        return;
    }

}

