<?php
require_once 'config/config.php';
require_once 'vendor/autoload.php';
date_default_timezone_set(Config::TIMEZONE);

ini_set('session.cookie_lifetime', 864000);
ini_set('session.gc_maxlifetime', 864000);

session_start();
error_reporting(1);
ini_set('display_errors', 1);

$is_IM = include 'config/connect.php';

if ($is_IM->INSTALL_MODE) {
    header("Refresh:0; url=install.php");
} else if (isset($_SESSION['login'])) {
    $controller = 'controller_'. $_SESSION['permission'];
    require_once 'controllers/'. $controller .'.php';
    $index = new $controller();
    $action = isset($_GET['action']) ? htmlspecialchars($_GET['action']) : 'show_dashboard';
    if (is_callable([$index, $action])) {
        $index->$action();
    } else {
        $index->show_404();
    }
} else {
    if (!isset($_GET['action'])) {
        $action = 'show_home';
    } else {
        $action = $_GET['action'];
    }
    require_once 'controllers/controller_login.php';
    $login = new Controller_Login();
    if (is_callable([$login, $action])) {
        $login->$action();
    } else {
        header("Refresh:0; url=index.php");
        $login->show_home();
    }
}
