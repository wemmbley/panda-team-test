<?php

declare(strict_types=1);

namespace App\Controller;

use App\Model\UserModel;

class HomeController
{
    public function index()
    {
        if (UserModel::getAuthorisedUser()) {
            require_once '../App/View/cabinet.php';
            die;
        }

        require_once '../App/View/home.php';
    }
}