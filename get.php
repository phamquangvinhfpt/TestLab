<?php
require_once('models/model_admin.php');

include 'simple_html_dom.php';
include 'function.php';
set_time_limit(30000);
// error_reporting(0);




$unit = $_POST['unit'];
$subject_id_sys = $_POST['subject_id'];
$url = $_POST['url'];


$data = get_quest_id($url);
$subject = $data->subject_id;
$grade = $data->grade_id;
$chapter_id = $data->chapter_id;
$stt = 1;


for ($j=1; $j <= 4; $j++) { 
	$page = get_page($grade,$subject,$chapter_id,$j);
	for ($i=1; $i <= $page; $i++) { 
			$count = main($grade,$subject,$chapter_id,$j,$i,$unit,$stt,$subject_id_sys);
			$stt = $stt+$count;
	}
	echo "</br></br></br>========================================</br></br></br>";
}




function main($grade,$subject,$chapter_id,$level,$page,$unit,$stt,$subject_id_sys){
$url = 'http://tracnghiem.itrithuc.vn/tra-cuu-cau-hoi?grade='.$grade.'&subject='.$subject.'&chapter_id='.$chapter_id.'&level='.$level.'&page='.$page;
$quest_data = get_quest_data($url);
$quest_id = get_quest_id($url);
$quest_id->unit = $unit;
for ($i=0; $i < count($quest_data) ; $i++) { 
		$quest_data_p = $quest_data[$i]->find('p');
		for ($k=0; $k < count($quest_data_p) ; $k++) { 
			if (!isset($array_quest[$i])) $array_quest[$i] = new stdClass();
			switch ($k) {
				case 0:
					$array_quest[$i]->get_quest_content = trim(get_quest_content($quest_data_p[$k]->outertext));
					break;
				case 1:
					$array_quest[$i]->answer_a = trim(get_quest_answer_a($quest_data_p[$k]->outertext));
					break;
				case 2:
					$array_quest[$i]->answer_b = trim(get_quest_answer_b($quest_data_p[$k]->outertext));
					break;
				case 3:
					$array_quest[$i]->answer_c = trim(get_quest_answer_c($quest_data_p[$k]->outertext));
					break;
				case 4:
					$array_quest[$i]->answer_d = trim(get_quest_answer_d($quest_data_p[$k]->outertext));
					break;
				case 5:
					$array_quest[$i]->answer = get_quest_answer($quest_data_p[$k]->innertext,$array_quest[$i]->answer_a,$array_quest[$i]->answer_b,$array_quest[$i]->answer_c,$array_quest[$i]->answer_d);
					break;
				case 7:
					$array_quest[$i]->huong_dan = $quest_data_p[$k]->innertext;
					break;
			}
	}
}

for ($i=0; $i < @count($array_quest); $i++) { 

	switch ($array_quest[$i]->answer) {
		case $array_quest[$i]->answer_b:
			$temp = $array_quest[$i]->answer_a;
			$array_quest[$i]->answer_a = $array_quest[$i]->answer_b;
			$array_quest[$i]->answer_b = $temp;
			break;
		case $array_quest[$i]->answer_c:
			$temp = $array_quest[$i]->answer_a;
			$array_quest[$i]->answer_a = $array_quest[$i]->answer_c;
			$array_quest[$i]->answer_c = $temp;
			break;
		case $array_quest[$i]->answer_d:
			$temp = $array_quest[$i]->answer_a;
			$array_quest[$i]->answer_a = $array_quest[$i]->answer_d;
			$array_quest[$i]->answer_d = $temp;
			break;
	}

	$cau = $i+$stt;
	echo 'Câu '.$cau.'. '. $array_quest[$i]->get_quest_content.'</br>';
	echo '<b>A</b>. '.$array_quest[$i]->answer_a.'</br>';
	echo 'B. '.$array_quest[$i]->answer_b.'</br>';
	echo 'C. '.$array_quest[$i]->answer_c.'</br>';
	echo 'D. '.$array_quest[$i]->answer_d.'</br>';
	echo 'HD: '.$array_quest[$i]->huong_dan.'</br>';
	$question_detail = $array_quest[$i]->get_quest_content;
	$answer_a = $array_quest[$i]->answer_a;
	$answer_b = $array_quest[$i]->answer_b;
	$answer_c = $array_quest[$i]->answer_c;
	$answer_d = $array_quest[$i]->answer_d;
	$correct_answer = $answer_a;
	$level_id = $level;
	$huong_dan = $array_quest[$i]->huong_dan;
	$model = new Model_Admin();
	$model->add_question($subject_id_sys,$question_detail, $grade, $unit, $answer_a, $answer_b, $answer_c, $answer_d, $correct_answer,$level_id,'admin',$huong_dan);
}

return @$cau;
}








?>
