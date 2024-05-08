<?php
require_once('config/config.php');
require_once('models/model_student.php');
require_once('models/model_admin.php');

$model_Student = new Model_Student();
$model_Admin = new Model_Admin();
$students = $model_Student->get_list_students();
$test_code = $model->get_list_tests_code();
$quest = $model->get_list_quest();



// for ($i=1; $i <= 300; $i++) {
// 	$model_Admin->update_avatar_ao($i,'HS-'.$i.'.jpg');
// }





$rand=array(1,2,2,3,3,3,4,4,4,4,4,4,4,4,4,5,5,5,5,5,5,5,5,5,5,5,5,5,5,5,5,5,5,5,5,5,5,5,5,5,5,5,5,5,5,6,6,6,6,6,6,6,6,6,6,6,6,6,6,6,6,6,6,6,6,6,6,6,6,6,6,6,6,6,6,6,6,6,6,6,6,6,7,7,7,7,7,7,7,7,7,7,7,7,7,7,7,7,7,7,7,7,7,7,7,7,7,7,7,7,7,7,7,7,7,7,7,7,7,7,7,7,7,7,7,7,7,7,8,8,8,8,8,8,8,8,8,8,8,8,8,8,8,8,8,8,8,8,8,8,8,8,8,8,8,8,8,8,8,8,9,9,9,9,9,9,9,9,9,9,9,9,9,9,9,9,10,10,10,10,10,10,10,10,10,10,10);

for ($i=0; $i < count($students); $i++) {
	for ($j=0; $j < count($test_code); $j++) {
		$first_date = "2019-11-14 10:21:02";
		$second_date = "2020-01-19 08:21:02";
		$first_time = strtotime($first_date);
		$second_time = strtotime($second_date);
		$rand_time = rand($first_time, $second_time);
		$rand_date = date('Y-m-d g:i:s', $rand_time);
		switch ($rand[array_rand($rand,1)]) {
			case 1:
				$score_count = rand(0,2);
				$score = $score_count*(10/30);
				$score_detail = $score_count.'/30';
				$model->insert_score_ao_2($students[$i]->student_id,$test_code[$j]->test_code,$score,$score_detail,$rand_date);
				break;
			case 2:
				$score_count = rand(3,6);
				$score = $score_count*(10/30);
				$score_detail = $score_count.'/30';
				$model->insert_score_ao_2($students[$i]->student_id,$test_code[$j]->test_code,$score,$score_detail,$rand_date);
				break;
			case 3:
				$score_count = rand(7,10);
				$score = $score_count*(10/30);
				$score_detail = $score_count.'/30';
				$model->insert_score_ao_2($students[$i]->student_id,$test_code[$j]->test_code,$score,$score_detail,$rand_date);
				break;
			case 4:
				$score_count = rand(11,13);
				$score = $score_count*(10/30);
				$score_detail = $score_count.'/30';
				$model->insert_score_ao_2($students[$i]->student_id,$test_code[$j]->test_code,$score,$score_detail,$rand_date);
				break;
			case 5:
				$score_count = rand(14,16);
				$score = $score_count*(10/30);
				$score_detail = $score_count.'/30';
				$model->insert_score_ao_2($students[$i]->student_id,$test_code[$j]->test_code,$score,$score_detail,$rand_date);
				break;
			case 6:
				$score_count = rand(17,18);
				$score = $score_count*(10/30);
				$score_detail = $score_count.'/30';
				$model->insert_score_ao_2($students[$i]->student_id,$test_code[$j]->test_code,$score,$score_detail,$rand_date);
				break;
			case 7:
				$score_count = rand(19,21);
				$score = $score_count*(10/30);
				$score_detail = $score_count.'/30';
				$model->insert_score_ao_2($students[$i]->student_id,$test_code[$j]->test_code,$score,$score_detail,$rand_date);
				break;
			case 8:
				$score_count = rand(22,25);
				$score = $score_count*(10/30);
				$score_detail = $score_count.'/30';
				$model->insert_score_ao_2($students[$i]->student_id,$test_code[$j]->test_code,$score,$score_detail,$rand_date);
				break;
			case 9:
				$score_count = rand(26,28);
				$score = $score_count*(10/30);
				$score_detail = $score_count.'/30';
				$model->insert_score_ao_2($students[$i]->student_id,$test_code[$j]->test_code,$score,$score_detail,$rand_date);
				break;
			case 10:
				$score_count = rand(29,30);
				$score = $score_count*(10/30);
				$score_detail = $score_count.'/30';
				$model->insert_score_ao_2($students[$i]->student_id,$test_code[$j]->test_code,$score,$score_detail,$rand_date);
				break;
		}
	}
}

for ($k=0; $k < count($quest); $k++) {
if ($quest[$k]->subject_id==2 && $quest[$k]->grade_id==12 && ($quest[$k]->unit==1 || $quest[$k]->unit==2 || $quest[$k]->unit==3)) {
		switch ($quest[$k]->level_id) {
			case 1:
				$total = rand(400,600);
				$count = rand(100,140);
				break;
			case 2:
				$total = rand(400,600);
				$count = rand(224,228);
				break;
			case 3:
				$total = rand(400,600);
				$count = rand(224,264);
				break;
			case 4:
				$total = rand(500,600);
				$count = rand(410,420);
				break;
			default:
				$total = rand(400,600);
				$count = rand(108,120);
				break;
		}

		switch ($quest[$k]->correct_answer) {
			case $quest[$k]->answer_a:
			$a = $total-$count;
			$b = round(($count)/3);
			$c = round(($count-$b)/2)-round(($count-$b)/6);
			$d = $total-$a-$b-$c;
				break;
			case $quest[$k]->answer_b:
			$b = $total-$count;
			$a = round(($count)/3);
			$c = round(($count-$b)/2)-round(($count-$b)/6);
			$d = $total-$a-$b-$c;
				break;
			case $quest[$k]->answer_c:
			$c = $total-$count;
			$b = round(($count)/3);
			$a = round(($count-$b)/2)-round(($count-$b)/6);
			$d = $total-$a-$b-$c;
				break;
			case $quest[$k]->answer_d:
			$d = $total-$count;
			$b = round(($count)/3);
			$c = round(($count-$b)/2)-round(($count-$b)/6);
			$a = $total-$d-$b-$c;
				break;
			default:
			$a = $total-$count;
			$b = round(($count)/3);
			$c = round(($count-$b)/2)-round(($count-$b)/6);
			$d = $total-$a-$b-$c;
				break;
		}
		$model->insert_score_ao($quest[$k]->question_id,$count,$total,$a,$b,$c,$d,'0');
}
}

?>
