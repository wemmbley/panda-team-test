<?php

declare(strict_types=1);

namespace App\Controller;

use App\Model\UserModel;

class AuthController
{
    public function webLogin()
    {
        if (UserModel::getAuthorisedUser()) {
            echo 'already authorised.'; die;
        }

        require_once '../App/View/login.php';
    }

    public function webRegister()
    {
        if (UserModel::getAuthorisedUser()) {
            echo 'already authorised.'; die;
        }

        require_once '../App/View/register.php';
    }

    public function login()
    {
        $email = htmlspecialchars($_POST['email']);
        $user = UserModel::getUserByEmail($email);

        if($user !== null && $user->password === $_POST['password']) {
            $token = base64_encode(random_bytes(10));

            $_SESSION['_token'] = $token;

            UserModel::setUserToken($user->id, $token);

            require_once '../App/View/cabinet.php'; die;
        }

        echo 'wrong credentials or user not found.';
    }

    public function register()
    {
        $email = htmlspecialchars($_POST['email']);

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo 'email is invalid';
            die;
        }

        $password = htmlspecialchars($_POST['password']);

        if (strlen($password) < 6) {
            echo 'password is too small, minimum 6 symbols needed.';
            die;
        }

        $user = UserModel::getUserByEmail($email);

        if ($user) {
            echo 'email already taken';
            die;
        }

        UserModel::insertNewUser($email, $password);

        echo 'successfully registered.';
        echo '<br><a href="/">back home</a>';
    }

    public function logout()
    {
        if (isset($_SESSION['_token'])) {
            unset($_SESSION['_token']);
            echo 'logged out.';
            die;
        }

        echo 'already logged out.';
        echo '<br><a href="/">back home</a>';
    }
}