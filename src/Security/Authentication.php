<?php


namespace App\Security;


class Authentication
{
    public function isLogged($param)
    {
        if (isset($_SESSION[$param])){
            header('location: /Home/index');
            exit;
        }
    }

    public function isAuthorized($param)
    {
        if (!isset($_SESSION[$param])){
            header('location: /login/index');
        }
    }
}