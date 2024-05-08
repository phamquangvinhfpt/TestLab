<?php

require_once('core/Base.php');
require_once('config/config.php');
date_default_timezone_set(Config::TIMEZONE);
session_start();

error_reporting(1);
ini_set('display_errors', 1);

require_once('controllers/controller_admin.php');
require_once('controllers/controller_student.php');
require_once('controllers/controller_teacher.php');

require_once('models/model_admin.php');
require_once('models/model_student.php');
require_once('models/model_teacher.php');

require_once('views/view_admin.php');
require_once('views/view_student.php');
require_once('views/view_teacher.php');

$model_Student = new Model_Student();
$model_Admin = new Model_Admin();
$model_Teacher = new Model_Teacher();

$get_sub_time = $model_Student->get_sub_time('tranphu_k19_035');
$time_out = $model_Student->get_time_out($get_sub_time);
$time_sec = $model_Student->get_sec_time($get_sub_time);

$time_to_do = (($get_sub_time->time_to_do)*60);
$starting_time = strtotime($get_sub_time->starting_time);
$curren_time = strtotime(date("Y-m-d H:i:s"));
$sub_time = ($curren_time - $starting_time);
$left_time = ($time_to_do - $sub_time);

print_r($get_sub_time);
echo("</br>");
print_r($time_out);
echo("</br>");
print_r($time_sec);
echo("</br>");
print_r($sub_time);

?>
