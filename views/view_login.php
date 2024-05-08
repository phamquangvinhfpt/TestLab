<?php

class View_Login
{
    public function show_login($result)
    {
        require_once 'config/config.php';
        include 'res/templates/login.php';
    }
    public function show_home()
    {
        require_once 'config/config.php';
        include 'res/templates/home.php';
    }
}
