<?php

class Ajde_User_Autologon extends Ajde_Object_Singleton
{
    public static function getInstance()
    {
        static $instance;

        return $instance === null ? $instance = new self() : $instance;
    }

    public static function __bootstrap()
    {
        if (Ajde_User::getLoggedIn()) {
            return true;
        }
        $user = new UserModel();
        $user->verifyCookie(false);

        return true;
    }
}
