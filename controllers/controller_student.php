<?php

require_once('models/model_student.php');
require_once('views/view_student.php');

class Controller_Student
{
	public $info =  array();

	public function __construct()
	{

		if (!$this->check_active_session()) {
			session_destroy();
			header('Location: index.php');
		}
		$user_info = $this->profiles();
		$user_rank = $this->ranking($user_info->ID);
		$this->info['rank'] = $this->get_ranking_index($user_info->ID);
		$this->info['rank_id'] = $user_rank->rank_id;
		$this->info['EXP'] = $user_rank->EXP;
		$this->info['exp_remaining'] = $user_rank->exp_remaining;
		$this->info['rank_name'] = $user_rank->rank_name;
		$this->info['rank_exp'] = $user_rank->rank_exp;
		$this->info['ID'] = $user_info->ID;
		$this->update_last_login($this->info['ID']);
		$this->info['username'] = $user_info->username;
		$this->info['name'] = $user_info->name;
		$this->info['avatar'] = $user_info->avatar;
		$this->info['class_id'] = $user_info->class_id;
		$this->info['grade_id'] = $user_info->grade_id;
		$this->info['doing_exam'] = $user_info->doing_exam;
		$this->info['time_remaining'] = $user_info->time_remaining;
		$this->info['notification'] = $user_info->notification;
	}

	public function check_active_session()
	{
		$model = new Model_Student();
		$result = $model->check_active_session();
		return $result;
	}

	public function check_active_session_json()
	{
		$result = array();
		$model = new Model_Student();
		$result = $model->check_active_session();
		echo $result;
	}

	public function get_list_user_search()
	{
		$model = new Model_Student();
		$string = isset($_POST['string']) ? $_POST['string'] : 'a';
		$data = $model->get_list_user_search($string);
		echo json_encode($data);
	}
	public function get_recent_messenger_user() // Lấy danh sách user nhắn tin gần đây
	{
		$model = new Model_Student();
		$recent_user = $model->get_recent_messenger_user($this->info['username']);
		for ($i=0; $i < count($recent_user); $i++) {
			$recent_user[$i] = $model->get_info_messenger_user($recent_user[$i]->username);
		}
		echo json_encode($recent_user);
	}
	public function upload_file_data_messenger($uploader,$file_name)
	{
			$model = new Model_Student();
			return $model->upload_file_data_messenger($uploader,$file_name);
	}
	public function get_user_messenger() // Lấy tin nhắn với một user POST['username']
	{
		$model = new Model_Student();
		$username_send = isset($_POST['username']) ? $_POST['username'] : 'admin';
		$messenger = $model->get_user_messenger($username_send,$this->info['username']);
		$model->clear_messenger_seen($username_send.":".$this->info['username']); // Reset tin nhắn chưa đọc về 0
		echo json_encode($messenger);
	}
	public function send_messenger() // Gửi tin nhắn cho một username qua phương thức POST
	{
		$model = new Model_Student();
		$content = isset($_POST['content']) ? htmlspecialchars($_POST['content']) : 'Nội dung trống';
		$type = isset($_POST['type']) ? htmlspecialchars($_POST['type']) : 'text';
		$username_get = isset($_POST['username']) ? $_POST['username'] : 'admin';
		$username_send = $this->info['username'];

		$send = $model->send_messenger($username_get,$username_send,$content,$type);
		if ($send && ($content!=null)) {
			$result['status'] = 1;
			$result['status_value'] = "Đã gửi tin nhắn đến ".$username_get;
			$model->update_messenger_seen($username_send.":".$username_get); // Update tin nhắn chưa đọc
		} else {
			$result['status'] = 0;
			$result['status_value'] = "Tin nhắn chưa được gửi!";
		}
		echo json_encode($result);
	}
	public function get_count_messenger_seen()
	{
		$model = new Model_Student();
		$data = $model->get_count_messenger_seen($this->info['username']);
		echo json_encode($data);
	}
	public function get_new_messenger()
	{
		$username = isset($_POST['username']) ? htmlspecialchars($_POST['username']) : '';
		$model = new Model_Student();
		$count = $model->get_count_messenger_seen_user($username,$this->info['username']);
		$model->clear_messenger_seen($username.":".$this->info['username']);
		$data = $model->get_new_messenger($username,$this->info['username'],$count->count);
		sort($data);
		echo json_encode($data);
	}
	public function show_diem_so()
	{
	  $view = new View_Student();
	  $model = new Model_Student();
	  $view->show_head_left($this->info);
	  $view->show_diem_so($model->get_diem_so($this->info['ID']));
	  $view->show_foot();
	}
	public function get_list_subjects()
	{
			$model = new Model_Student();
			echo json_encode($model->get_list_subjects());
	}
	public function show_messenger()
	{
			$view = new View_Student();
			$view->show_head_left($this->info);
			$view->show_messenger();
			$view->show_foot();
	}
	public function test_code()
	{
		$model = new Model_Student();
		$update_rank_point = $model->update_rank_point('66','1','34',$this->info['ID']);
		echo $update_rank_point;
	}
	public function get_ranking_index($student_id)
	{
		$model = new Model_Student();
		$list_rank = $model->get_ranking_index();
		for ($i=0; $i < count($list_rank); $i++) {
			if ($list_rank[$i]->student_id == $student_id) {
				return ($i+1);
			}
		}
		return 0;
	}
	public function ranking($student_id)
	{
		$model = new Model_Student();
		$user_rank = $model->get_ranking($student_id);
		if ($user_rank == '') {
			$model->create_ranking($student_id);
			$user_rank = $model->get_ranking($student_id);
		}
		return $user_rank;
	}
	public function get_document()
	{
			$model = new Model_Student();
			return $model->get_list_document();
	}
	public function get_rankings()
	{
			$model = new Model_Student();
			return $model->get_rankings();
	}
	public function delete_scores()
	{
			$student_id = $this->info['ID'];
			$test_code = $_POST['test_code'];
			$model = new Model_Student();
			$delete_scores = $model->delete_scores($student_id,$test_code);
			$delete_test_detail = $model->delete_test_detail($student_id,$test_code);
			if ($delete_scores && $delete_test_detail) {
				$result['status'] = 1;
				$result['status_value'] = "Xóa thành công";
			} else {
				$result['status'] = 0;
				$result['status_value'] = "Xóa không thành công";
			}
			echo json_encode($result);
	}
	public function profiles()
	{
		$model = new Model_Student();
		return $model->get_profiles($_SESSION['username']);
	}
	public function get_question($ID)
	{
		$model = new Model_Student();
		return $model->get_question($ID);
	}
	public function get_doing_exam()
	{
		return $this->info['doing_exam'];
	}
	public function update_last_login()
	{
		$model = new Model_Student();
		$model->update_last_login($this->info['ID']);
	}
	public function update_doing_exam($exam,$time)
	{
		$model = new Model_Student();
		$model->update_doing_exam($exam,$time,$this->info['ID']);
	}
	public function update_answer()
	{
    $model = new Model_Student();
		$question_id = $_POST['id'];
		$answer = 'answer_'.$_POST['answer'];
    $student_answer = $model->get_student_quest_of_testcode($this->info['ID'],$this->info['doing_exam'],$question_id)->$answer;
		$model->update_answer($this->info['ID'], $this->info['doing_exam'], $question_id,$student_answer);
		$time = $_POST['time'];
		$model->update_timing($this->info['ID'], $time);
	}
	public function update_timing()
	{
		$model = new Model_Student();
		$time = $_POST['time'];
		$model->update_timing($this->info['ID'], $time);
	}
	public function reset_doing_exam()
	{
		$model = new Model_Student();
		$model->reset_doing_exam($this->info['ID']);
	}
	public function get_profiles()
	{
		$model = new Model_Student();
		echo json_encode($model->get_profiles($this->info['username']));
	}
	public function get_notifications()
	{
		$model = new Model_Student();
		echo json_encode($model->get_notifications($this->info['class_id']));
	}
	public function get_chats()
	{
		$model = new Model_Student();
		echo json_encode($model->get_chats($this->info['class_id']));
	}
	public function get_chat_all()
	{
		$model = new Model_Student();
		echo json_encode($model->get_chat_all($this->info['class_id']));
	}
	public function valid_email_on_profiles()
	{
		$result = array();
		$model = new Model_Student();
		$new_email = isset($_POST['new_email']) ? htmlspecialchars($_POST['new_email']) : '';
		$curren_email = isset($_POST['curren_email']) ? htmlspecialchars($_POST['curren_email']) : '';
		if (empty($new_email)) {
			$result['status'] = 0;
		} else {
			if ($model->valid_email_on_profiles($curren_email, $new_email)) {
				$result['status'] = 1;
			} else {
				$result['status'] = 0;
			}
		}
		echo json_encode($result);
	}
	public function update_avatar($avatar, $username)
	{
		$model = new Model_Student();
		return $model->update_avatar($avatar, $username);
	}
	public function submit_update_avatar()
	{
		$result = array();
		if (isset($_FILES['file'])) {
			$duoi = explode('.', $_FILES['file']['name']);
			$duoi = $duoi[(count($duoi)-1)];
			if ($duoi === 'jpg' || $duoi === 'png') {
				if (move_uploaded_file($_FILES['file']['tmp_name'], 'upload/avatar/'.$this->info['username'].'_' . $_FILES['file']['name'])) {
					$avatar = $this->info['username'] .'_' . $_FILES['file']['name'];
					$update = $this->update_avatar($avatar, $this->info['username']);
					$result['status_value'] = "Đã thay đổi avatar, tải lại trang để hoàn tất !";
					$result['status'] = 1;
				}
			} else {
				$result['status_value'] = "Ảnh của bạn không đúng định dạng, vui lòng chọn ảnh có định dạng (jpg, png)";
				$result['status'] = 0;
			}
		} else {
			$result['status_value'] = "Lỗi không nhận được ảnh của bạn !";
			$result['status'] = 0;
		}
		echo json_encode($result);
	}
	public function check_password()
	{
		$result = array();
		$model = new Model_Student();
		$test_code = isset($_POST['test_code']) ? $_POST['test_code'] : '493205';
		$password = isset($_POST['password']) ? md5($_POST['password']) : 'e10adc3949ba59abbe56e057f20f883e';
		if($password != $model->get_test($test_code)->password) {
			$result['status_value'] = "Sai mật khẩu";
			$result['status'] = 0;
		} else {
			$list_quest = $model->get_quest_of_test($test_code);
			foreach ($list_quest as $quest) {
				$array = array();
				$array[0] = $quest->answer_a;
				$array[1] = $quest->answer_b;
				$array[2] = $quest->answer_c;
				$array[3] = $quest->answer_d;
				shuffle($array);
				$ID = rand(1,time())+rand(100000,999999);
				$time = $model->get_test($test_code)->time_to_do;
				$model->add_student_quest($this->info['ID'], $ID, $test_code, $quest->question_id, $array[0], $array[1], $array[2], $array[3]);
				$model->update_doing_exam($test_code,($time*60),$this->info['ID']);
			}
			$result['status_value'] = "Thành công. Chuẩn bị chuyển trang!";
			$result['status'] = 1;
		}
		echo json_encode($result);

	}
	public function upload_file_data()
	{
		$uploader = $this->info['username'];
		$file_name = time() . '_' . $_FILES['file']['name'];
		$upload = move_uploaded_file($_FILES['file']['tmp_name'], 'upload/messenger/'.$file_name);
		if ($upload) {
				$add = $this->upload_file_data_messenger($uploader,$file_name);
				if ($add) {
					$result['status_value'] = $file_name;
					$result['status'] = 1;
				} else {
					$result['status_value'] = "Lỗi cơ sở dữ liệu !!";
					$result['status'] = 0;
				}
		} else {
			$result['status_value'] = "Lỗi, tải file lên hệ thống!";
			$result['status'] = 0;
		}
		echo json_encode($result);
	}
	public function send_chat()
	{
		$result = array();
		$content = isset($_POST['content']) ? htmlspecialchars($_POST['content']) : '';
		if(empty($content)) {
			$result['status_value'] = "Nội dung trống";
			$result['status'] = 0;
		} else {
			$model = new Model_Student();
			$model->chat($this->info['username'], $this->info['name'], $this->info['class_id'], $content);
			$result['status_value'] = "Thành công";
			$result['status'] = 1;
		}
		echo json_encode($result);
	}
	public function update_profiles($username, $name, $email, $password, $gender, $birthday)
	{
		$model = new Model_Student();
		return $model->update_profiles($username, $name, $email, $password, $gender, $birthday);
	}
	public function submit_feedback()
	{
		$result = array();
		$feedback = isset($_POST['feedback']) ? htmlspecialchars($_POST['feedback']) : '';
		if(empty($feedback)) {
			$result['status_value'] = "Nội dung trống";
			$result['status'] = 0;
		} else {
			$model = new Model_Student();
			$submit_feedback = $model->submit_feedback($feedback,$this->info['ID']);
			if ($submit_feedback) {
				$result['status_value'] = "Cảm ơn bạn đã đóng góp ý kiến :)";
				$result['status'] = 1;
			} else {
				$result['status_value'] = "Lỗi cơ sở dữ liệu, vui lòng thử lại sau.";
				$result['status'] = 0;
			}
		}
		echo json_encode($result);
	}
	public function submit_update_profiles()
	{
		$result = array();
		$name = isset($_POST['name']) ? Htmlspecialchars(addslashes($_POST['name'])) : '';
		$email = isset($_POST['email']) ? Htmlspecialchars(addslashes($_POST['email'])) : '';
		$username = isset($_POST['username']) ? Htmlspecialchars(addslashes($_POST['username'])) : '';
		$gender = isset($_POST['gender']) ? Htmlspecialchars(addslashes($_POST['gender'])) : '';
		$birthday = isset($_POST['birthday']) ? Htmlspecialchars(addslashes($_POST['birthday'])) : '';
		$password = isset($_POST['password']) ? md5($_POST['password']) : '';
		if (empty($name)||empty($gender)||empty($birthday)||empty($password)||empty($email)) {
			$result['status_value'] = "Không được bỏ trống các trường nhập!";
			$result['status'] = 0;
		} else {
			$update = $this->update_profiles($username, $name, $email, $password, $gender, $birthday);
			if (!$update) {
				$result['status_value'] = "Tài khoản không tồn tại!";
				$result['status'] = 0;
			} else {
				$result = json_decode(json_encode($this->profiles($username)), true);
				$result['status_value'] = "Sửa thành công!";
				$result['status'] = 1;
			}
		}
		echo json_encode($result);
	}
	public function check_answer_int($t)
	{
		switch ($t->student_answer) {
			case $t->answer_a:
				$answer_int = 'a';
				break;
			case $t->answer_b:
				$answer_int = 'b';
				break;
			case $t->answer_c:
				$answer_int = 'c';
				break;
			case $t->answer_d:
				$answer_int = 'd';
				break;
			default:
				$answer_int = 'blank';
				break;
		}
		return $answer_int;
	}
	public function check_quest_incorrect_rank($t,$e)
	{
		$model = new Model_Student();
		$answer = $this->check_answer_int($t);
		if ($e==1) {
			$model->update_quest_incorrect_rank($t->question_id,$answer);
		} else {
			$model->update_quest_correct_rank($t->question_id,$answer);
		}
	}
	public function accept_test()
	{
		$model = new Model_Student();
		$get_sub_time = $model->get_sub_time($this->info['username']);
		$time_out = $model->get_time_out($get_sub_time);
		$test = $model->get_result_quest($this->info['doing_exam'],$this->info['ID']);
		$test_code = $test[0]->test_code;
		$total_questions = $test[0]->total_questions;
		$correct = 0;
		$c = 10/$total_questions;
		foreach ($test as $t) {
			if(trim($t->student_answer) == trim($t->correct_answer)){
				if ($t->test_type == 3) {
					$this->check_quest_incorrect_rank($t,0);
				}
				$correct++;
			} else {
					if ($t->test_type == 3) {
						$this->check_quest_incorrect_rank($t,1);
					}
			}
		}
		$score = $correct * $c;
		$score_detail = $correct.'/'.$total_questions;
		$score = round($score, 2);

		$model->insert_score($this->info['ID'],$test_code,$score,$score_detail);
		if ($correct != 0) {
			if ($correct >= $this->info['exp_remaining']) {
				$exp = $this->info['EXP'] + $correct;
				$rank_id = $this->info['rank_id'] + 1;
				$exp_remaining = $this->info['rank_exp'] - ($correct - $this->info['exp_remaining']);
			} else {
				$exp = $this->info['EXP'] + $correct;
				$rank_id = $this->info['rank_id'];
				$exp_remaining = $this->info['exp_remaining'] - $correct;
			}
			$model->update_rank_point($exp,$rank_id,$exp_remaining,$this->info['ID']);
		}
		$model->reset_doing_exam($this->info['ID']);
		header("Location: xem-ket-qua-".$test_code);
	}
	public function logout()
	{
		$result = array();
		$confirm = isset($_POST['confirm']) ? $_POST['confirm'] : true;
		if ($confirm) {
			$result['status_value'] = "Đăng xuất thành công!";
			$result['status'] = 1;
			session_destroy();
		}
		echo json_encode($result);
	}

	public function show_dashboard()
	{
		$view = new View_Student();
		if($this->info['doing_exam'] == '') {
			$view->show_head_left($this->info);
			$model = new Model_Student();
			$scores = $model->get_scores($this->info['ID']);
			$tests = $model->get_list_tests($this->info['grade_id']);
			$view->show_dashboard($tests, $scores);
			$view->show_foot();
		}
		else {
			$model = new Model_Student();
			$test = $model->get_doing_quest($this->info['doing_exam'],$this->info['ID']);
			$test_type = $model->get_type_quest($this->info['doing_exam'])->test_type;
			$get_sub_time = $model->get_sub_time($this->info['username']);
			$time_out = $model->get_time_out($get_sub_time);
			$time_sec = $model->get_sec_time($get_sub_time);
			$min = floor((($time_sec)/60));
			$sec = (($time_sec)%60);
			if ($test_type == 2) {
				$min = 999999;
				$sec = 999999;
			}
			$view->show_exam($test,$test_type,$min,$sec,$time_out);
		}
	}
	public function show_courses_panel()
	{
		$view = new View_Student();
		if($this->info['doing_exam'] == '') {
			$view->show_head_left($this->info);
			$model = new Model_Student();
			$scores = $model->get_scores($this->info['ID']);
			$tests = $model->get_list_courses($this->info['grade_id']);
			$view->show_courses_panel($tests, $scores);
			$view->show_foot();
		}
		else {
			$model = new Model_Student();
			$test = $model->get_doing_quest($this->info['doing_exam'],$this->info['ID']);
		  $test_type = $model->get_type_quest($this->info['doing_exam'])->test_type;
			$get_sub_time = $model->get_sub_time($this->info['username']);
			$time_out = $model->get_time_out($get_sub_time);
			$time_sec = $model->get_sec_time($get_sub_time);
			$min = floor((($time_sec)/60));
			$sec = (($time_sec)%60);
			if ($test_type == 2) {
				$min = 999999;
				$sec = 999999;
			}
			$view->show_exam($test,$test_type,$min,$sec,$time_out);
		}
	}
	public function show_feedback()
	{
		$view = new View_Student();
		$view->show_head_left($this->info);
		$view->show_feedback();
		$view->show_foot();
	}
	public function show_chat()
	{
		$view = new View_Student();
		if($this->info['doing_exam'] == '') {
			$view->show_head_left($this->info);
			$view->show_chat();
			$view->show_foot();
		}
		else {
			$model = new Model_Student();
			$test = $model->get_doing_quest($this->info['doing_exam'],$this->info['ID']);
			$test_type = $model->get_type_quest($this->info['doing_exam'])->test_type;
			$get_sub_time = $model->get_sub_time($this->info['username']);
			$time_out = $model->get_time_out($get_sub_time);
			$time_sec = $model->get_sec_time($get_sub_time);
			$min = floor((($time_sec)/60));
			$sec = (($time_sec)%60);
			if ($test_type == 2) {
				$min = 999999;
				$sec = 999999;
			}
			$view->show_exam($test,$test_type,$min,$sec,$time_out);
		}
	}
	public function show_all_chat()
	{
		$view = new View_Student();
		$view->show_head_left($this->info);
		$view->show_all_chat();
		$view->show_foot();
	}
	public function show_notifications()
	{
		$view = new View_Student();
		$model = new Model_Student();
		$this->info['notification'] = 0;
		$model->reset_count_notify_student($this->info['ID']);
		$view->show_head_left($this->info);
		$view->show_notifications();
		$view->show_foot();
	}
	public function show_result()
	{
		$view = new View_Student();
		if($this->info['doing_exam'] == '') {
			$model = new Model_Student();
			$test_code = htmlspecialchars($_GET['test_code']);
			$test = $model->get_test($test_code);
			$score = $model->get_score($this->info['ID'],$test_code);
            $test_status = $test->status_id;
            if($test_status != 5)
                $result = null;
            else
                $result = $model->get_result_quest($test_code,$this->info['ID']);
			if($score)
			{
				$view->show_head_left($this->info);
				$view->show_result($test,$score,$result);
				$view->show_foot();
			} else {
				$this->show_404();
			}
		}
		else {
			$model = new Model_Student();
			$test = $model->get_doing_quest($this->info['doing_exam'],$this->info['ID']);
			$test_type = $model->get_type_quest($this->info['doing_exam'])->test_type;
			$get_sub_time = $model->get_sub_time($this->info['username']);
			$time_out = $model->get_time_out($get_sub_time);
			$time_sec = $model->get_sec_time($get_sub_time);
			$min = floor((($time_sec)/60));
			$sec = (($time_sec)%60);
			if ($test_type == 2) {
				$min = 999999;
				$sec = 999999;
			}
			$view->show_exam($test,$test_type,$min,$sec,$time_out);
		}
	}

	public function show_about()
	{
		$view = new View_Student();
		$view->show_head_left($this->info);
		$view->show_about();
		$view->show_foot();
	}
	public function show_profiles()
	{
		$view = new View_Student();
		$view->show_head_left($this->info);
		$view->show_profiles($this->profiles());
		$view->show_foot();
	}
	public function show_404()
	{
		$view = new View_Student();
		$view->show_404();
	}
	public function show_tai_lieu()
	{
	    $view = new View_Student();
	    $view->show_head_left($this->info);
	    $view->show_tai_lieu($this->get_document());
	    $view->show_foot();
	}
	public function show_ranking()
	{
			$view = new View_Student();
			$view->show_head_left($this->info);
			$view->show_ranking($this->get_rankings());
			$view->show_foot();
	}
	public function show_tai_lieu_video()
	{
	  $view = new View_Student();
	  $model = new Model_Student();
		$subject_id = isset($_GET['subject_id']) ? $_GET['subject_id'] : '2';
		$grade_id = isset($_GET['grade_id']) ? $_GET['grade_id'] : $this->info['grade_id'];
	  $view->show_head_left($this->info);
	  $view->show_tai_lieu_video($model->get_list_document($subject_id,$grade_id,4));
	  $view->show_foot();
	}
	public function show_tai_lieu_kien_thuc()
	{
	  $view = new View_Student();
	  $model = new Model_Student();
		$subject_id = isset($_GET['subject_id']) ? $_GET['subject_id'] : '2';
		$grade_id = isset($_GET['grade_id']) ? $_GET['grade_id'] : $this->info['grade_id'];
	  $view->show_head_left($this->info);
	  $view->show_tai_lieu_kien_thuc($model->get_list_document($subject_id,$grade_id,1));
	  $view->show_foot();
	}
	public function show_tai_lieu_phuong_phap()
	{
	  $view = new View_Student();
	  $model = new Model_Student();
		$subject_id = isset($_GET['subject_id']) ? $_GET['subject_id'] : '2';
		$grade_id = isset($_GET['grade_id']) ? $_GET['grade_id'] : $this->info['grade_id'];
	  $view->show_head_left($this->info);
	  $view->show_tai_lieu_phuong_phap($model->get_list_document($subject_id,$grade_id,2));
	  $view->show_foot();
	}
	public function show_tai_lieu_de_tham_khao()
	{
	  $view = new View_Student();
	  $model = new Model_Student();
		$subject_id = isset($_GET['subject_id']) ? $_GET['subject_id'] : '2';
		$grade_id = isset($_GET['grade_id']) ? $_GET['grade_id'] : $this->info['grade_id'];
	  $view->show_head_left($this->info);
	  $view->show_tai_lieu_de_tham_khao($model->get_list_document($subject_id,$grade_id,3));
	  $view->show_foot();
	}
	public function show_tai_lieu_khac()
	{
	  $view = new View_Student();
	  $model = new Model_Student();
		$subject_id = isset($_GET['subject_id']) ? $_GET['subject_id'] : '2';
		$grade_id = isset($_GET['grade_id']) ? $_GET['grade_id'] : $this->info['grade_id'];
	  $view->show_head_left($this->info);
	  $view->show_tai_lieu_khac($model->get_list_document($subject_id,$grade_id,5));
	  $view->show_foot();
	}
}
