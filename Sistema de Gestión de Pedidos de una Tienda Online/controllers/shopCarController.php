<?php
include __DIR__ . '/../models/shopCarModel.php';

class shopCarController
{
    public function indexShopCar()
    {
        include __DIR__ . '/../views/header.php';
        include __DIR__ . '/../views/shoppingCarView.php';
        include __DIR__ . '/../views/footer.php';
        return;
    }

}

