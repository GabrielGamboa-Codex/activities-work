<?php

class adminController
{
    public function indexAdmin()
    {
        include __DIR__ . '/../views/header.php';
        include __DIR__ . '/../views/footer.php';
        include __DIR__ . '/../views/adminView.php';
        return;
    }
}