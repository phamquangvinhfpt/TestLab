<?php
require_once('config/config.php');
require_once('models/model_student.php');
require_once('models/model_admin.php');

$model_Student = new Model_Student();
$model_Admin = new Model_Admin();
$i = 0;
$j = 0;
$list = $model_Admin->get_list_students_all();
foreach ($list as $key => $value) {
	if ($value->gender_detail=="Nam") {
		$i = $i + 1;
		$model_Admin->update_avatar_ao($value->student_id,'HS-NAM-'.$i.'.jpg');
	} else {
		$j = $j + 1;
		$model_Admin->update_avatar_ao($value->student_id,'HS-NU-'.$j.'.jpg');
	}
}

?>
