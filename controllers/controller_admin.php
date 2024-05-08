<?php

require_once('core/Base.php');
require_once('config/config.php');
require_once('models/model_admin.php');
require_once('views/view_admin.php');
require 'res/libs/Word/vendor/autoload.php';
use PhpOffice\PhpWord\IOFactory as IOFactory_Word;
use PhpOffice\PhpWord\Element\TextRun;
use PhpOffice\PhpWord\Element\Text;
require 'res/libs/SpreadSheet/vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Controller_Admin
{
    private $info  = array();

    public function __construct()
    {
        $user_info = $this->get_admin_info($_SESSION['username']);
        $this->info['admin_id'] = $user_info->admin_id;
        $this->update_last_login($this->info['admin_id']);
        $this->info['username'] = $user_info->username;
        $this->info['name'] = $user_info->name;
        $this->info['avatar'] = $user_info->avatar;
    }

    public function get_list_user_search_api()
    {
      $model = new Model_Admin();
      $string = isset($_POST['string']) ? $_POST['string'] : 'a';
      $data = $model->get_list_user_search($string);
      echo json_encode($data);
    }
    public function get_list_user_search()
    {
      $model = new Model_Admin();
      $string = isset($_POST['string']) ? $_POST['string'] : 'a';
      $data = $model->get_list_user_search($string);
      echo json_encode($data);
    }
    public function get_recent_messenger_user() // Lấy danh sách user nhắn tin gần đây
    {
      $model = new Model_Admin();
      $recent_user = $model->get_recent_messenger_user($this->info['username']);
      for ($i=0; $i < count($recent_user); $i++) {
        $recent_user[$i] = $model->get_info_messenger_user($recent_user[$i]->username);
      }
      echo json_encode($recent_user);
    }
    public function get_user_messenger() // Lấy tin nhắn với một user POST['username']
    {
      $model = new Model_Admin();
      $username_send = isset($_POST['username']) ? $_POST['username'] : 'admin';
      $messenger = $model->get_user_messenger($username_send,$this->info['username']);
      $model->clear_messenger_seen($username_send.":".$this->info['username']); // Reset tin nhắn chưa đọc về 0
      echo json_encode($messenger);
    }
    public function send_messenger() // Gửi tin nhắn cho một username qua phương thức POST
    {
      $model = new Model_Admin();
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
      $model = new Model_Admin();
      $data = $model->get_count_messenger_seen($this->info['username']);
      echo json_encode($data);
    }
    public function get_new_messenger()
    {
      $username = isset($_POST['username']) ? htmlspecialchars($_POST['username']) : '';
      $model = new Model_Admin();
      $count = $model->get_count_messenger_seen_user($username,$this->info['username']);
      $model->clear_messenger_seen($username.":".$this->info['username']);
      $data = $model->get_new_messenger($username,$this->info['username'],$count->count);
      sort($data);
      echo json_encode($data);
    }
    public function get_score_analysis()
    {
      $model = new Model_Admin();
      $score[0] = $model->get_score_analysis(0,0.5);
      $score[1] = $model->get_score_analysis(0.5,1.5);
      $score[2] = $model->get_score_analysis(1.5,2.5);
      $score[3] = $model->get_score_analysis(2.5,3.5);
      $score[4] = $model->get_score_analysis(3.5,4.5);
      $score[5] = $model->get_score_analysis(4.5,5.5);
      $score[6] = $model->get_score_analysis(5.5,6.5);
      $score[7] = $model->get_score_analysis(6.5,7.5);
      $score[8] = $model->get_score_analysis(7.5,8.5);
      $score[9] = $model->get_score_analysis(8.5,9.5);
      $score[10] = $model->get_score_analysis_10();
      return $score;
    }
    public function tcvn2uni($text)
    {
      $vietU = 'á|à|ả|ã|ạ|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ|é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ|ó|ò|ỏ|õ|ọ|ơ|ớ|ờ|ở|ỡ|ợ|ô|ố|ồ|ổ|ỗ|ộ|ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự|í|ì|ỉ|ĩ|ị|ý|ỳ|ỷ|ỹ|ỵ|đ|Á|À|Ả|Ã|Ạ|Ă|Ắ|Ằ|Ẳ|Ẵ|Ặ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ|É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ|Ó|Ò|Ỏ|Õ|Ọ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự|Í|Ì|Ỉ|Ĩ|Ị|Ý|Ỳ|Ỷ|Ỹ|Ỵ|Đ';
      $vietT='¸|µ|¶|·|¹|¨|¾|»|¼|½|Æ|©|Ê|Ç|È|É|Ë|Ð|Ì|Î|Ï|Ñ|ª|Õ|Ò|Ó|Ô|Ö|ã|ß|á|â|ä|¬|í|ê|ë|ì|î|«|è|å|æ|ç|é|ó|ï|ñ|ò|ô|­|ø|õ|ö|÷|ù|Ý|×|Ø|Ü|Þ|ý|ú|û|ü|þ|®|¸|µ|¶|·|¹|¡|¾|»|¼|½|Æ|¢|Ê|Ç|È|É|Ë|Ð|Ì|Î|Ï|Ñ|£|Õ|Ò|Ó|Ô|Ö|ã|ß|á|â|ä|¥|í|ê|ë|ì|î|¤|è|å|æ|ç|é|ó|ï|ñ|ò|ô|¦|ø|õ|ö|÷|ù|Ý|×|Ø|Ü|Þ|ý|ú|û|ü|þ|§';
      $UNI = explode("|", $vietU);
      $TCVN3 = explode("|", $vietT);
      $arr1= @mb_split($text,'UTF-8');
      $arr2=array();
      $len = mb_strlen($text, 'UTF-8');
      for($i=0;$i<$len; $i++){
      $char=mb_substr($text, $i, 1, 'UTF-8');
      $result[] = $char;
      $key=array_search($char,$TCVN3);
      if($key!=''){
      $arr2[$i]=$UNI[$key];
      }else{
      $arr2[$i]=$char;
      }
      }
      $text=implode("",$arr2);
      return $text;
    }
    public function get_document()
    {
        $model = new Model_Admin();
        return $model->get_list_document_all();
    }
    public function get_analysis_login_day()
    {
        $model = new Model_Admin();
        return $model->get_analysis_login_day();
    }
    public function get_analysis_login_month()
    {
        $model = new Model_Admin();
        return $model->get_analysis_login_month();
    }
    public function get_profiles()
    {
        $model = new Model_Admin();
        echo json_encode($model->get_admin_info($this->info['username']));
    }
    public function update_profiles($username, $name, $email, $password, $gender, $birthday)
    {
        $model = new Model_Admin();
        return $model->update_profiles($username, $name, $email, $password, $gender, $birthday);
    }
    public function update_avatar($avatar, $username)
    {
        $model = new Model_Admin();
        return $model->update_avatar($avatar, $username);
    }
    public function get_admin_info($username)
    {
        $model = new Model_Admin();
        return $model->get_admin_info($username);
    }
    public function get_teacher_info($username)
    {
        $model = new Model_Admin();
        return $model->get_teacher_info($username);
    }
    public function get_student_info($username)
    {
        $model = new Model_Admin();
        return $model->get_student_info($username);
    }
    public function get_class_info($class_name)
    {
        $model = new Model_Admin();
        return $model->get_class_info($class_name);
    }
    public function update_last_login()
    {
        $model = new Model_Admin();
        $model->update_last_login($this->info['admin_id']);
    }
    public function get_list_admins()
    {
        $model = new Model_Admin();
        echo json_encode($model->get_list_admins());
    }
    public function get_list_grades()
    {
        $model = new Model_Admin();
        echo json_encode($model->get_list_grades());
    }
    public function get_list_subjects()
    {
        $model = new Model_Admin();
        echo json_encode($model->get_list_subjects());
    }
    public function get_list_statuses()
    {
        $model = new Model_Admin();
        echo json_encode($model->get_list_statuses());
    }
    public function valid_username_or_email()
    {
        $result = array();
        $model = new Model_Admin();
        $usr_or_email = isset($_GET['usr_or_email']) ? htmlspecialchars($_GET['usr_or_email']) : '';
        if (empty($usr_or_email)) {
            $result['status'] = 0;
        } else {
            if ($model->valid_username_or_email($usr_or_email)) {
                $result['status'] = 1;
            } else {
                $result['status'] = 0;
            }
        }
        echo json_encode($result);
    }
    public function valid_email_on_profiles()
    {
        $result = array();
        $model = new Model_Admin();
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
    public function valid_class_name()
    {
        $result = array();
        $model = new Model_Admin();
        $class_name = isset($_GET['class_name']) ? htmlspecialchars($_GET['class_name']) : '';
        if (empty($class_name)) {
            $result['status'] = 0;
        } else {
            if ($model->valid_class_name($class_name)) {
                $result['status'] = 1;
            } else {
                $result['status'] = 0;
            }
        }
        echo json_encode($result);
    }
    public function edit_admin($admin_id, $password, $name, $gender_id, $birthday)
    {
        $model = new Model_Admin();
        return $model->edit_admin($admin_id, $password, $name, $gender_id, $birthday);
    }
    public function del_admin($admin_id)
    {
        $model = new Model_Admin();
        return $model->del_admin($admin_id);
    }
    public function add_admin($name, $username, $password, $email, $birthday, $gender)
    {
        $model = new Model_Admin();
        return $model->add_admin($name, $username, $password, $email, $birthday, $gender);
    }
    public function add_document($name, $grade_id, $subject_id, $mota, $path, $type_id)
    {
        $model = new Model_Admin();
        return $model->add_document($name, $grade_id, $subject_id, $mota, $path, $type_id);
    }
    public function upload_file_data_messenger($uploader,$file_name)
    {
        $model = new Model_Admin();
        return $model->upload_file_data_messenger($uploader,$file_name);
    }
    public function del_document($document_id)
    {
        $model = new Model_Admin();
        return $model->del_document($document_id);
    }
    public function get_list_teachers()
    {
        $model = new Model_Admin();
        echo json_encode($model->get_list_teachers());
    }
    public function edit_teacher($teacher_id, $password, $name, $gender_id, $birthday)
    {
        $model = new Model_Admin();
        return $model->edit_teacher($teacher_id, $password, $name, $gender_id, $birthday);
    }
    public function del_teacher($teacher_id)
    {
        $model = new Model_Admin();
        return $model->del_teacher($teacher_id);
    }
    public function add_teacher($name, $username, $password, $email, $birthday, $gender)
    {
        $model = new Model_Admin();
        return $model->add_teacher($name, $username, $password, $email, $birthday, $gender);
    }
    public function list_students()
    {
        $model = new Model_Admin();
        $res = array();
        $res["draw"] = isset($_POST['draw']) ? intval($_POST['draw']) : 1;

        $totalRecords = $model->get_total_student();
        $totalRecordwithFilter = $totalRecords;

        $start = isset($_POST['start']) ? $_POST['start'] : 0;
        $offset = isset($_POST['length']) ? $_POST['length'] : 10;

        $column_index = isset($_POST['order']) ? $_POST['order'][0]['column'] : 0;
        $column_order = isset($_POST['columns']) ? $_POST['columns'][$column_index]['data'] : 'student_id';
        $sort_order = isset($_POST['order']) ? $_POST['order'][0]['dir'] : 'asc';

        $keyword = isset($_POST['search']['value']) ? $_POST['search']['value'] : '';

        if($keyword != '') {
            $res["aaData"] = $model->get_list_students_search($keyword, $column_order, $sort_order, $start, $offset);
            $totalRecordwithFilter = $model->get_total_students_search($keyword);
        } else {
            $res["aaData"] = $model->get_list_students($column_order, $sort_order, $start, $offset);
        }

        $res["iTotalRecords"] = $totalRecords;
        $res["iTotalDisplayRecords"] = $totalRecordwithFilter;

        echo json_encode($res);
    }
    public function list_questions()
    {
        $model = new Model_Admin();
        $res = array();
        $res["draw"] = isset($_POST['draw']) ? intval($_POST['draw']) : 1;


        $totalRecords = $model->get_total_question();
        $totalRecordwithFilter = $totalRecords;

        $start = isset($_POST['start']) ? $_POST['start'] : 0;
        $offset = isset($_POST['length']) ? $_POST['length'] : 10;

        $column_index = isset($_POST['order']) ? $_POST['order'][0]['column'] : 0;
        $column_order = isset($_POST['columns']) ? $_POST['columns'][$column_index]['data'] : 'question_id';
        $sort_order = isset($_POST['order']) ? $_POST['order'][0]['dir'] : 'asc';

        $keyword = isset($_POST['search']['value']) ? $_POST['search']['value'] : '';

        $subject_id = isset($_POST['subject_id']) ? $_POST['subject_id'] : 0;
        $grade_id = isset($_POST['grade_id']) ? $_POST['grade_id'] : 0;
        $unit = isset($_POST['unit']) ? $_POST['unit'] : 0;
        $level_id = isset($_POST['level_id']) ? $_POST['level_id'] : 0;

        if($keyword != '') {
            if ($subject_id != 0 && $grade_id != 0 && $unit != 0 && $level_id != 0) {
              $res["aaData"] = $model->get_list_questions_selected_search($subject_id, $grade_id, $unit, $level_id, $keyword, $column_order, $sort_order, $start, $offset);
              $totalRecordwithFilter = $model->get_total_questions_selected_search($subject_id, $grade_id, $unit, $level_id, $keyword);
            } else {
              $res["aaData"] = $model->get_list_questions_search($keyword, $column_order, $sort_order, $start, $offset);
              $totalRecordwithFilter = $model->get_total_questions_search($keyword);
            }
        } else {
            if ($subject_id != 0 && $grade_id != 0 && $unit != 0 && $level_id != 0) {
              $res["aaData"] = $model->get_list_questions_selected($subject_id, $grade_id, $unit, $level_id, $column_order, $sort_order, $start, $offset);
              $totalRecordwithFilter = $model->get_total_questions_selected($subject_id, $grade_id, $unit, $level_id);
            } else {
              $res["aaData"] = $model->get_list_questions($column_order, $sort_order, $start, $offset);
            }
        }

        $res["iTotalRecords"] = $totalRecords;
        $res["iTotalDisplayRecords"] = $totalRecordwithFilter;

        echo json_encode($res);
    }
    public function edit_student($student_id, $birthday, $password, $name, $class_id, $gender)
    {
        $model = new Model_Admin();
        $model->edit_student($student_id, $birthday, $password, $name, $class_id, $gender);
    }
    public function del_student($student_id)
    {
        $model = new Model_Admin();
        return $model->del_student($student_id);
    }
    public function add_student($username, $password, $name, $class_id, $email, $birthday, $gender)
    {
        $model = new Model_Admin();
        return $model->add_student($username, $password, $name, $class_id, $email, $birthday, $gender);
    }
    public function get_list_classes()
    {
        $model = new Model_Admin();
        echo json_encode($model->get_list_classes());
    }
    public function edit_class($class_id, $grade_id, $class_name, $teacher_id)
    {
        $model = new Model_Admin();
        $model->edit_class($class_id, $grade_id, $class_name, $teacher_id);
    }
    public function del_class($class_id)
    {
        $model = new Model_Admin();
        return $model->del_class($class_id);
    }
    public function add_class($grade_id, $class_name, $teacher_id)
    {
        $model = new Model_Admin();
        return $model->add_class($grade_id, $class_name, $teacher_id);
    }
    public function get_list_tests()
    {
        $model = new Model_Admin();
        echo json_encode($model->get_list_tests());
    }
    public function get_list_courses()
    {
        $model = new Model_Admin();
        echo json_encode($model->get_list_courses());
    }
    public function get_list_examine()
    {
        $model = new Model_Admin();
        echo json_encode($model->get_list_examine());
    }
    public function edit_question($question_id,$subject_id, $question_content, $grade_id, $unit, $answer_a, $answer_b, $answer_c, $answer_d, $correct_answer,$level_id,$huong_dan)
    {
        $model = new Model_Admin();
        return $model->edit_question($question_id,$subject_id, $question_content, $grade_id, $unit, $answer_a, $answer_b, $answer_c, $answer_d, $correct_answer,$level_id,$huong_dan);
    }
    public function del_question($question_id)
    {
        $model = new Model_Admin();
        return $model->del_question($question_id);
    }
    public function add_question($subject_id,$question_content, $grade_id, $unit, $answer_a, $answer_b, $answer_c, $answer_d, $correct_answer,$level_id,$huong_dan=null)
    {
        if ($this->check_quest_exit($question_content) == null) {
          $model = new Model_Admin();
          return $model->add_question($subject_id,$question_content, $grade_id, $unit, $answer_a, $answer_b, $answer_c, $answer_d, $correct_answer,$level_id,$this->info["username"],$huong_dan);
        } else {
          return 0;
        }
    }
    public function check_quest_exit($question_content)
    {
        $model = new Model_Admin();
        return $model->check_quest_exit($question_content);
    }
    public function get_teacher_notifications()
    {
        $model = new Model_Admin();
        echo json_encode($model->get_teacher_notifications());
    }
    public function get_student_notifications()
    {
        $model = new Model_Admin();
        echo json_encode($model->get_student_notifications());
    }
    public function insert_notification($notification_id,$notification_title, $notification_content)
    {
        $model = new Model_Admin();
        return $model->insert_notification($notification_id,$this->info['username'], $this->info['name'], $notification_title, $notification_content);
    }
    public function edit_subject($subject_id, $subject_detail)
    {
        $model = new Model_Admin();
        return $model->edit_subject($subject_id, $subject_detail);
    }
    public function del_subject($subject_id)
    {
        $model = new Model_Admin();
        return $model->del_subject($subject_id);
    }
    public function add_subject($subject_detail)
    {
        $model = new Model_Admin();
        return $model->add_subject($subject_detail);
    }
    public function add_test($test_code,$test_name,$test_type, $password, $grade_id, $subject_id, $total_questions, $time_to_do, $note)
    {
        $model = new Model_Admin();
        return $model->add_test($this->info['admin_id'], $test_code,$test_name,$test_type, $password, $grade_id, $subject_id, $total_questions, $time_to_do, $note);
    }
    public function toggle_test_status($test_code, $status_id)
    {
        $model = new Model_Admin();
        return $model->toggle_test_status($test_code, $status_id);
    }
    public function get_list_units()
    {
        $grade_id = isset($_POST['grade_id']) ? $_POST['grade_id'] : '';
        $subject_id = isset($_POST['subject_id']) ? $_POST['subject_id'] : '';
        $model = new Model_Admin();
        echo json_encode($model->get_list_units($grade_id,$subject_id));
    }
    public function get_list_levels_of_unit()
    {
        $grade_id = isset($_POST['grade_id']) ? $_POST['grade_id'] : '';
        $subject_id = isset($_POST['subject_id']) ? $_POST['subject_id'] : '';
        $unit = isset($_POST['unit']) ? $_POST['unit'] : '';
        $model = new Model_Admin();
        echo json_encode($model->get_list_levels_of_unit($grade_id,$subject_id,$unit));
    }
    public function get_dashboard_info()
    {
        $model = new Model_Admin();
        $admin = new stdclass();
        $admin->count = $model->get_total_admin();
        $admin->name = "Quản lý chuyên môn";
        $admin->icon = "fas fa-users-cog";
        $admin->actionlink = "quan-ly-admin";
        $teacher = new stdclass();
        $teacher->count = $model->get_total_teacher();
        $teacher->name = "Giáo Viên";
        $teacher->icon = "fas fa-user-tie";
        $teacher->actionlink = "quan-ly-giao-vien";
        $student = new stdclass();
        $student->count = $model->get_total_student();
        $student->name = "Học Sinh";
        $student->icon = "fas fa-user-graduate";
        $student->actionlink = "quan-ly-hoc-sinh";
        $grade = new stdclass();
        $grade->count = $model->get_total_grade();
        $grade->name = "Khối";
        $grade->icon = "fas fa-user-graduate";
        $grade->actionlink = "#";
        $class = new stdclass();
        $class->count = $model->get_total_class();
        $class->name = "Lớp";
        $class->icon = "fas fa-users";
        $class->actionlink = "quan-ly-lop";
        $subject = new stdclass();
        $subject->count = $model->get_total_subject();
        $subject->name = "Môn Học";
        $subject->icon = "fas fa-book";
        $subject->actionlink = "quan-ly-mon-hoc";
        $question = new stdclass();
        $question->count = $model->get_total_question();
        $question->name = "Câu Hỏi";
        $question->icon = "fas fa-question";
        $question->actionlink = "quan-ly-ngan-hang-cau-hoi";
        $test = new stdclass();
        $test->count = $model->get_total_test();
        $test->name = "Đề thi";
        $test->icon = "fas fa-sitemap";
        $test->actionlink = "quan-ly-de-thi";
        $login_count = new stdclass();
        $login_count->count = $model->get_total_login();
        $login_count->name = "Tổng lượt truy cập";
        $login_count->icon = "fas fa-sitemap";
        $login_count->actionlink = "#!";

        $total = array($admin,$teacher,$student,$grade,$class,$subject,$question,$test,$login_count);
        return $total;
    }
    public function notify_teacher($ID, $teacher_id)
    {
        $model = new Model_Admin();
        $model->notify_teacher($ID, $teacher_id);
        $model->count_notify_teacher($teacher_id);
    }
    public function notify_class($ID, $class_id)
    {
        $model = new Model_Admin();
        $model->notify_class($ID, $class_id);
        $model->count_notify_class($class_id);
    }
    public function check_add_admin()
    {
        $result = array();
        $name = isset($_POST['name']) ? Htmlspecialchars(addslashes($_POST['name'])) : '';
        $username = isset($_POST['username']) ? Htmlspecialchars(addslashes($_POST['username'])) : '';
        $password = isset($_POST['password']) ? md5($_POST['password']) : '';
        $email = isset($_POST['email']) ? Htmlspecialchars(addslashes($_POST['email'])) : '';
        $birthday = isset($_POST['birthday']) ? Htmlspecialchars(addslashes($_POST['birthday'])) : '';
        $gender = isset($_POST['gender']) ? Htmlspecialchars(addslashes($_POST['gender'])) : '';
        if (empty($name)||empty($username)||empty($password)||empty($email)||empty($birthday)||empty($gender)) {
            $result['status_value'] = "Không được bỏ trống các trường nhập!";
            $result['status'] = 0;
        } else {
            $add = $this->add_admin($name, $username, $password, $email, $birthday, $gender);
            if ($add) {
                $result = json_decode(json_encode($this->get_admin_info($username)), true);
                $result['status_value'] = "Thêm thành công!";
                $result['status'] = 1;
            } else {
                $result['status_value'] = "Lỗi! Tài khoản đã tồn tại!";
                $result['status'] = 0;
            }
        }
        echo json_encode($result);
    }
    public function check_add_admin_via_file()
    {
        $inputFileType = 'Xlsx';
        $result = array();
        $reader = IOFactory::createReader($inputFileType);
        move_uploaded_file($_FILES['file']['tmp_name'], $_FILES['file']['name']);
        $spreadsheet = $reader->load($_FILES['file']['name']);
        $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
        unlink($_FILES['file']['name']);
        $count = 0;
        $err_list = '';
        for($i = 4; $i < count($sheetData); $i++) {
            if($sheetData[$i]['A'] == '')
                continue;
            $stt = $sheetData[$i]['A'];
            $name = $sheetData[$i]['B'];
            $username = $sheetData[$i]['C'];
            $email = $sheetData[$i]['D'];
            $password = md5($sheetData[$i]['E']);
            $birthday = $sheetData[$i]['F'];
            if($sheetData[$i]['G'] == 'Nam')
                $gender = 2;
            else if($sheetData[$i]['G'] == 'Nữ')
                $gender = 3;
            else
                $gender = 1;
            $add = $this->add_admin($name, $username, $password, $email, $birthday, $gender);
            if($add)
                $count++;
            else
                $err_list += $stt.' ';
        }
        if ($err_list == '') {
            $result['status_value'] = "Thêm thành công ".$count.' tài khoản!';
            $result['status'] = 1;
        } else {
            $result['status_value'] = "Lỗi! Không thể thêm tài khoản có STT: ".$err_list.', vui lòng xem lại.';
            $result['status'] = 0;
        }
        echo json_encode($result);
    }
    public function check_del_admin()
    {
        $result = array();
        $admin_id = isset($_POST['admin_id']) ? Htmlspecialchars($_POST['admin_id']) : '';
        if($admin_id == $this->info["admin_id"]){
            $result['status_value'] = "Không thể tự xóa bản thân!";
            $result['status'] = 0;
            $result['admin_id'] = $admin_id;
        } else {
            $del = $this->del_admin($admin_id);
            if ($del) {
                $result['status_value'] = "Xóa thành công!";
                $result['status'] = 1;
                $result['admin_id'] = $admin_id;
            } else {
                $result['status_value'] = "Không thể xóa!";
                $result['status'] = 0;
                $result['admin_id'] = $admin_id;
            }
        }
        echo json_encode($result);
    }
    public function check_edit_admin()
    {
        $result = array();
        $admin_id = isset($_POST['admin_id']) ? Htmlspecialchars($_POST['admin_id']) : '';
        $name = isset($_POST['name']) ? Htmlspecialchars(addslashes($_POST['name'])) : '';
        $username = isset($_POST['username']) ? Htmlspecialchars(addslashes($_POST['username'])) : '';
        $gender_id = isset($_POST['gender_id']) ? Htmlspecialchars(addslashes($_POST['gender_id'])) : '';
        $birthday = isset($_POST['birthday']) ? Htmlspecialchars(addslashes($_POST['birthday'])) : '';
        $password = isset($_POST['password']) ? md5($_POST['password']) : '';
        if (empty($name)||empty($gender_id)||empty($birthday)||empty($admin_id)||empty($password)) {
            $result['status_value'] = "Không được bỏ trống các trường nhập!";
            $result['status'] = 0;
        } else {
            $update = $this->edit_admin($admin_id, $password, $name, $gender_id, $birthday);
            if (!$update) {
                $result['status_value'] = "Tài khoản không tồn tại!";
                $result['status'] = 0;
            } else {
                $result = json_decode(json_encode($this->get_admin_info($username)), true);
                $result['status_value'] = "Sửa thành công!";
                $result['status'] = 1;
            }
        }
        echo json_encode($result);
    }
    public function check_add_teacher()
    {
        $result = array();
        $name = isset($_POST['name']) ? Htmlspecialchars(addslashes($_POST['name'])) : '';
        $username = isset($_POST['username']) ? Htmlspecialchars(addslashes($_POST['username'])) : '';
        $email = isset($_POST['email']) ? Htmlspecialchars(addslashes($_POST['email'])) : '';
        $birthday = isset($_POST['birthday']) ? Htmlspecialchars(addslashes($_POST['birthday'])) : '';
        $gender = isset($_POST['gender']) ? Htmlspecialchars(addslashes($_POST['gender'])) : '';
        $password = isset($_POST['password']) ? md5($_POST['password']) : '';
        if (empty($name)||empty($username)||empty($password)) {
            $result['status_value'] = "Không được bỏ trống các trường nhập!";
            $result['status'] = 0;
        } else {
            $add = $this->add_teacher($name, $username, $password, $email, $birthday, $gender);
            if ($add) {
                $result = json_decode(json_encode($this->get_teacher_info($username)), true);
                $result['status_value'] = "Thêm thành công!";
                $result['status'] = 1;
            } else {
                $result['status_value'] = "Lỗi! Tài khoản đã tồn tại!";
                $return['status'] = 0;
            }
        }
        echo json_encode($result);
    }
    public function check_add_teacher_via_file()
    {
        $inputFileType = 'Xlsx';
        $result = array();
        $reader = IOFactory::createReader($inputFileType);
        move_uploaded_file($_FILES['file']['tmp_name'], $_FILES['file']['name']);
        $spreadsheet = $reader->load($_FILES['file']['name']);
        $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
        unlink($_FILES['file']['name']);
        $count = 0;
        $err_list = '';
        for($i = 4; $i < count($sheetData); $i++) {
            if($sheetData[$i]['A'] == '')
                continue;
            $stt = $sheetData[$i]['A'];
            $name = $sheetData[$i]['B'];
            $username = $sheetData[$i]['C'];
            $email = $sheetData[$i]['D'];
            $password = md5($sheetData[$i]['E']);
            $birthday = $sheetData[$i]['F'];
            if($sheetData[$i]['G'] == 'Nam')
                $gender = 2;
            else if($sheetData[$i]['G'] == 'Nữ')
                $gender = 3;
            else
                $gender = 1;
            $add = $this->add_teacher($name, $username, $password, $email, $birthday, $gender);
            if($add)
                $count++;
            else
                $err_list += $stt.' ';
        }
        if ($err_list == '') {
            $result['status_value'] = "Thêm thành công ".$count.' tài khoản!';
            $result['status'] = 1;
        } else {
            $result['status_value'] = "Lỗi! Không thể thêm tài khoản có STT: ".$err_list.', vui lòng xem lại.';
            $result['status'] = 0;
        }
        echo json_encode($result);
    }
    public function check_del_teacher()
    {
        $result = array();
        $teacher_id = Htmlspecialchars($_POST['teacher_id']);
        $del = $this->del_teacher($teacher_id);
        if ($del) {
            $result['status_value'] = "Xóa thành công!";
            $result['status'] = 1;
            $result['teacher_id'] = $teacher_id;
        } else {
            $result['status_value'] = "Không thể xóa giáo viên đang chủ nhiệm lớp!";
            $result['status'] = 0;
            $result['teacher_id'] = $teacher_id;
        }
        echo json_encode($result);
    }
    public function check_edit_teacher()
    {
        $result = array();
        $teacher_id = isset($_POST['teacher_id']) ? Htmlspecialchars($_POST['teacher_id']) : '';
        $name = isset($_POST['name']) ? Htmlspecialchars(addslashes($_POST['name'])) : '';
        $username = isset($_POST['username']) ? Htmlspecialchars(addslashes($_POST['username'])) : '';
        $gender_id = isset($_POST['gender_id']) ? Htmlspecialchars(addslashes($_POST['gender_id'])) : '';
        $birthday = isset($_POST['birthday']) ? Htmlspecialchars(addslashes($_POST['birthday'])) : '';
        $password = isset($_POST['password']) ? md5($_POST['password']) : '';
        if (empty($name)||empty($gender_id)||empty($birthday)||empty($teacher_id)||empty($password)) {
            $result['status_value'] = "Không được bỏ trống các trường nhập!";
            $result['status'] = 0;
        } else {
            $update = $this->edit_teacher($teacher_id, $password, $name, $gender_id, $birthday);
            if (!$update) {
                $result['status_value'] = "Tài khoản không tồn tại!";
                $result['status'] = 0;
            } else {
                $result = json_decode(json_encode($this->get_teacher_info($username)), true);
                $result['status_value'] = "Sửa thành công!";
                $result['status'] = 1;
            }
        }
        echo json_encode($result);
    }
    public function check_add_class()
    {
        $result = array();
        $class_name = isset($_POST['class_name']) ? Htmlspecialchars(addslashes($_POST['class_name'])) : '';
        $grade_id = isset($_POST['grade_id']) ? Htmlspecialchars(addslashes($_POST['grade_id'])) : '';
        $teacher_id = isset($_POST['teacher_id']) ? Htmlspecialchars(addslashes($_POST['teacher_id'])) : '';
        if (empty($class_name)||empty($grade_id)||empty($teacher_id)) {
            $result['status_value'] = "Không được bỏ trống các trường nhập!";
            $result['status'] = 0;
        } else {
            $add = $this->add_class($grade_id, $class_name, $teacher_id);
            if ($add) {
                $result = json_decode(json_encode($this->get_class_info($class_name)), true);
                $result['status_value'] = "Thêm thành công!";
                $result['status'] = 1;
            } else {
                $result['status_value'] = "Lỗi! lớp đã tồn tại!";
                $return['status'] = 0;
            }
        }
        echo json_encode($result);
    }
    public function check_del_class()
    {
        $result = array();
        $class_id = Htmlspecialchars($_POST['class_id']);
        $del = $this->del_class($class_id);
        if ($del) {
            $result['status_value'] = "Xóa thành công!";
            $result['status'] = 1;
            $result['class_id'] = $class_id;
        } else {
            $result['status_value'] = "Không thể xóa lớp đang có học sinh!";
            $result['status'] = 0;
            $result['class_id'] = $class_id;

        }
        echo json_encode($result);
    }
    public function check_edit_class()
    {
        $result = array();
        $class_id = isset($_POST['class_id']) ? Htmlspecialchars($_POST['class_id']) : '';
        $class_name = isset($_POST['class_name']) ? Htmlspecialchars($_POST['class_name']) : '';
        $grade_id = isset($_POST['grade_id']) ? Htmlspecialchars($_POST['grade_id']) : '';
        $teacher_id = isset($_POST['teacher_id']) ? Htmlspecialchars($_POST['teacher_id']) : '';
        if (empty($class_name)||empty($grade_id)||empty($teacher_id)) {
            $result['status_value'] = "Không được bỏ trống các trưòng nhập";
            $result['status'] = 0;
        } else {
            $this->edit_class($class_id, $grade_id, $class_name, $teacher_id);
            $result = json_decode(json_encode($this->get_class_info($class_name)), true);
            $result['status_value'] = "Sửa thành công!";
            $result['status'] = 1;
        }
        echo json_encode($result);
    }
    public function check_add_student()
    {
        $result = array();
        $name = isset($_POST['name']) ? Htmlspecialchars(addslashes($_POST['name'])) : '';
        $username = isset($_POST['username']) ? Htmlspecialchars(addslashes($_POST['username'])) : '';
        $class_id = isset($_POST['class_id']) ? Htmlspecialchars(addslashes($_POST['class_id'])) : '';
        $email = isset($_POST['email']) ? Htmlspecialchars(addslashes($_POST['email'])) : '';
        $birthday = isset($_POST['birthday']) ? Htmlspecialchars(addslashes($_POST['birthday'])) : '';
        $gender = isset($_POST['gender']) ? Htmlspecialchars(addslashes($_POST['gender'])) : '';
        $password = isset($_POST['password']) ? md5($_POST['password']) : '';
        if (empty($name)||empty($username)||empty($password)) {
            $result['status_value'] = "Không được bỏ trống các trưòng nhập";
            $result['status'] = 0;
        } else {
            $add = $this->add_student($username, $password, $name, $class_id, $email, $birthday, $gender);
            if ($add) {
                $result = json_decode(json_encode($this->get_student_info($username)), true);
                $result['status_value'] = "Thêm thành công!";
                $result['status'] = 1;
            } else {
                $result['status_value'] = "Lỗi! Tài khoản đã tồn tại!";
                $result['status'] = 0;
            }
        }
        echo json_encode($result);
    }
    public function check_add_student_via_file()
    {
        $inputFileType = 'Xlsx';
        $result = array();
        $class_id = isset($_POST['class_id']) ? Htmlspecialchars(addslashes($_POST['class_id'])) : '';
        $reader = IOFactory::createReader($inputFileType);
        move_uploaded_file($_FILES['file']['tmp_name'], $_FILES['file']['name']);
        $spreadsheet = $reader->load($_FILES['file']['name']);
        $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
        unlink($_FILES['file']['name']);
        $count = 0;
        $err_list = '';
        for($i = 4; $i < count($sheetData); $i++) {
            if($sheetData[$i]['A'] == '')
                continue;
            $stt = $sheetData[$i]['A'];
            $name = $sheetData[$i]['B'];
            $username = $sheetData[$i]['C'];
            $email = $sheetData[$i]['D'];
            $password = md5($sheetData[$i]['E']);
            $birthday = $sheetData[$i]['F'];
            if($sheetData[$i]['G'] == 'Nam')
                $gender = 2;
            else if($sheetData[$i]['G'] == 'Nữ')
                $gender = 3;
            else
                $gender = 1;
            $add = $this->add_student($username, $password, $name, $class_id, $email, $birthday, $gender);
            if($add)
                $count++;
            else
                $err_list += $stt.' ';
        }
        if ($err_list == '') {
            $result['status_value'] = "Thêm thành công ".$count.' tài khoản!';
            $result['status'] = 1;
        } else {
            $result['status_value'] = "Lỗi! Không thể thêm tài khoản có STT: ".$err_list.', vui lòng xem lại.';
            $result['status'] = 0;
        }
        echo json_encode($result);
    }
    public function check_edit_student()
    {
        $result = array();
        $student_id = isset($_POST['student_id']) ? Htmlspecialchars($_POST['student_id']) : '';
        $name = isset($_POST['name']) ? Htmlspecialchars(addslashes($_POST['name'])) : '';
        $username = isset($_POST['username']) ? Htmlspecialchars(addslashes($_POST['username'])) : '';
        $gender = isset($_POST['gender_id']) ? Htmlspecialchars(addslashes($_POST['gender_id'])) : '';
        $birthday = isset($_POST['birthday']) ? Htmlspecialchars(addslashes($_POST['birthday'])) : '';
        $class_id = isset($_POST['class_id']) ? Htmlspecialchars(addslashes($_POST['class_id'])) : '';
        $password = isset($_POST['password']) ? md5($_POST['password']) : '';
        if (empty($name)||empty($gender)||empty($birthday)||empty($student_id)||empty($password)) {
            $result['status_value'] = "Không được bỏ trống các trường nhập!";
            $result['status'] = 0;
        } else {
            $this->edit_student($student_id, $birthday, $password, $name, $class_id, $gender);
            $result = json_decode(json_encode($this->get_student_info($username)), true);
            $result['status_value'] = "Sửa thành công!";
            $result['status'] = 1;
        }
        echo json_encode($result);
    }
    public function check_del_student()
    {
        $result = array();
        $student_id = isset($_POST['student_id']) ? Htmlspecialchars($_POST['student_id']) : '';
        $del = $this->del_student($student_id);
        if($del) {
            $result['status_value'] = "Xóa thành công!";
            $result['status'] = 1;
            $result['student_id'] = $student_id;
        } else {
            $result['status_value'] = "Không thể xóa học sinh đang có điểm trên hệ thống!";
            $result['status'] = 0;
            $result['student_id'] = $student_id;

        }
        echo json_encode($result);
    }
    public function check_del_document()
    {
        $result = array();
        $document_id = isset($_POST['document_id']) ? Htmlspecialchars($_POST['document_id']) : '';
        $del = $this->del_document($document_id);
        if($del) {
            $result['status_value'] = "Xóa thành công!";
            $result['status'] = 1;
            $result['document_id'] = $document_id;
        } else {
            $result['status_value'] = "Xóa không thành công!";
            $result['status'] = 0;
            $result['document_id'] = $document_id;

        }
        echo json_encode($result);
    }
    public function check_add_question()
    {
        $result = array();
        $question_detail = isset($_POST['question_detail']) ? $_POST['question_detail'] : '';
        $grade_id = isset($_POST['grade_id']) ? $_POST['grade_id'] : '';
        $unit = isset($_POST['unit']) ? $_POST['unit'] : '';
        $subject_id = isset($_POST['subject_id']) ? $_POST['subject_id'] : '';
        $answer_a = isset($_POST['answer_a']) ? $_POST['answer_a'] : '';
        $answer_b = isset($_POST['answer_b']) ? $_POST['answer_b'] : '';
        $answer_c = isset($_POST['answer_c']) ? $_POST['answer_c'] : '';
        $answer_d = isset($_POST['answer_d']) ? $_POST['answer_d'] : '';
        $huong_dan = isset($_POST['huong_dan']) ? $_POST['huong_dan'] : '';
        $correct_answer = isset($_POST['correct_answer']) ? $_POST['correct_answer'] : '';
        $level_id = isset($_POST['level_id']) ? $_POST['level_id'] : '';
        $true_correct_answer = "";
        if (empty($question_detail)||empty($grade_id)||empty($unit)||empty($answer_a)||empty($answer_b)||empty($answer_c)||empty($answer_d)||empty($correct_answer)) {
            $result['status_value'] = "Không được bỏ trống các trường nhập";
            $result['status'] = 0;
        } else {
            if($correct_answer == "A"){
                $true_correct_answer = $answer_a;
            }
            if($correct_answer == "B"){
                $true_correct_answer = $answer_b;
            }
            if($correct_answer == "C"){
                $true_correct_answer = $answer_c;
            }
            if($correct_answer == "D"){
                $true_correct_answer = $answer_d;
            }
            $res = $this->add_question($subject_id,$question_detail, $grade_id, $unit, $answer_a, $answer_b, $answer_c, $answer_d, $true_correct_answer,$level_id, $huong_dan);
            if($res) {
                $result['status_value'] = "Thêm thành công!";
                $result['status'] = 1;
            } else {
                $result['status_value'] = "Thêm thất bại!";
                $result['status'] = 0;
            }
        }
        echo json_encode($result);
    }
    public function check_add_question_via_file()
    {
        $inputFileType = 'Xlsx';
        $result = array();
        $shuffle = array();
        $subject_id = isset($_POST['subject_id']) ? $_POST['subject_id'] : '';
        $reader = IOFactory::createReader($inputFileType);
        move_uploaded_file($_FILES['file']['tmp_name'], $_FILES['file']['name']);
        $spreadsheet = $reader->load($_FILES['file']['name']);
        $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
        unlink($_FILES['file']['name']);
        $count = 0;
        $err_list = '';
        for($i = 4; $i <= count($sheetData); $i++) {
            if($sheetData[$i]['A'] == '')
                continue;
            $stt = $sheetData[$i]['A'];
            $question_content = $sheetData[$i]['B'];
            $answer_a = $sheetData[$i]['C'];
            $answer_b = $sheetData[$i]['D'];
            $answer_c = $sheetData[$i]['E'];
            $answer_d = $sheetData[$i]['F'];
            $correct_answer = $sheetData[$i]['G'];
            $true_correct_answer = "";
            if($correct_answer == "A"){
                $true_correct_answer = $answer_a;
            }
            if($correct_answer == "B"){
                $true_correct_answer = $answer_b;
            }
            if($correct_answer == "C"){
                $true_correct_answer = $answer_c;
            }
            if($correct_answer == "D"){
                $true_correct_answer = $answer_d;
            }
            $grade_id = $sheetData[$i]['H'];
            $unit = $sheetData[$i]['I'];
            $level_id = $sheetData[$i]['J'];
            $add = $this->add_question($subject_id,$question_content, $grade_id, $unit, $answer_a, $answer_b, $answer_c, $answer_d, $true_correct_answer,$level_id);
            if($add)
                $count++;
            else
                $err_list += ' '.$stt.',';
        }
        if ($err_list == '') {
            $result['status_value'] = "Thêm thành công ".$count.' câu hỏi!';
            $result['status'] = 1;
        } else {
            $result['status_value'] = "Lỗi! Không thể thêm câu hỏi có STT: ".$err_list.', vui lòng xem lại.';
            $result['status'] = 0;
        }
        echo json_encode($result);
    }
    public function check_add_question_via_file_docx_line()
    {
        $subject_id = isset($_POST['subject_id']) ? $_POST['subject_id'] : '';
        $grade_id = isset($_POST['grade_id']) ? $_POST['grade_id'] : '';
        $unit = isset($_POST['unit']) ? $_POST['unit'] : '';
        $level_id = isset($_POST['level_id']) ? $_POST['level_id'] : '';
        move_uploaded_file($_FILES['file']['tmp_name'], $_FILES['file']['name']);
        $objReader = IOFactory_Word::createReader('Word2007');
        $contents = $objReader->load($_FILES['file']['name']);
        $sections = $contents->getSections();
        $result = array();
        $lineKey = 0;
        $count = 0;
        $err_list = '';
        foreach ($sections as $key => $value) {
            $sectionElement = $value->getElements();
            foreach ($sectionElement as $elementKey => $elementValue) {
                if ($elementValue instanceof TextRun) {
                    $secondSectionElement = $elementValue->getElements();
                    $lineText = '';
                    foreach ($secondSectionElement as $secondSectionElementKey => $secondSectionElementValue) {
                        if ($secondSectionElementValue instanceof Text) {

                            $underLine = $secondSectionElementValue->getFontStyle()->getUnderline();
                            $bold = $secondSectionElementValue->getFontStyle()->isBold();
                            $italic = $secondSectionElementValue->getFontStyle()->isItalic();
                            $strikethrough = $secondSectionElementValue->getFontStyle()->isStrikethrough();
                            $color = $secondSectionElementValue->getFontStyle()->getColor();
                            $text = $secondSectionElementValue->getText();
                            $lineText = $lineText . $text;

                            if (($underLine == 'none') && ($bold == 0) && ($color == null) && ($italic == 0) && ($strikethrough == 0)) {
                            } else {
                                $correct_answer = $lineKey;
                            }
                        }
                    }

                    switch ($lineKey) {
                        case 0:
                            $question_content = (string) preg_replace('/Câu .*?: (.*?)/', '$1', $lineText);
                            break;
                        case 1:
                            $answer_a = (string) preg_replace('/[ABCD]. (.*?)/', '$1', $lineText);
                            break;
                        case 2:
                            $answer_b = (string) preg_replace('/[ABCD]. (.*?)/', '$1', $lineText);
                            break;
                        case 3:
                            $answer_c = (string) preg_replace('/[ABCD]. (.*?)/', '$1', $lineText);
                            break;
                        case 4:
                            $answer_d = (string) preg_replace('/[ABCD]. (.*?)/', '$1', $lineText);
                            break;
                        default:
                            break;
                    }

                    if ($lineKey == 4) {
                        switch ($correct_answer) {
                            case 1:
                                $true_correct_answer = $answer_a;
                                break;
                            case 2:
                                $true_correct_answer = $answer_b;
                                break;
                            case 3:
                                $true_correct_answer = $answer_c;
                                break;
                            case 4:
                                $true_correct_answer = $answer_d;
                                break;
                            default:
                                $true_correct_answer = $answer_a;
                                break;
                        }

                        $question = array(
                            'question_content' => $question_content,
                            'answer_a' => $answer_a,
                            'answer_b' => $answer_b,
                            'answer_c' => $answer_c,
                            'answer_d' => $answer_d,
                            'true_correct_answer' => $true_correct_answer
                        );

                        $add = $this->add_question($subject_id,$question_content, $grade_id, $unit, $answer_a, $answer_b, $answer_c, $answer_d, $true_correct_answer,$level_id);
                        if($add)
                            $count++;
                        else
                            $err_list += ' '.($count+1).',';
                    }
                    $lineKey = ($lineKey < 4) ? $lineKey+1 : 0;
                }
            }
        }
        unlink($_FILES['file']['name']);
        if ($err_list == '') {
            $result['status_value'] = "Thêm thành công ".$count.' câu hỏi!';
            $result['status'] = 1;
        } else {
            $result['status_value'] = "Lỗi! Không thể thêm câu hỏi có STT: ".$err_list.', vui lòng xem lại.';
            $result['status'] = 0;
        }
        echo json_encode($result);
    }
    public function check_add_question_via_file_docx()
    {
        $subject_id = isset($_POST['subject_id']) ? $_POST['subject_id'] : '';
        $grade_id = isset($_POST['grade_id']) ? $_POST['grade_id'] : '';
        $unit = isset($_POST['unit']) ? $_POST['unit'] : '';
        $level_id = isset($_POST['level_id']) ? $_POST['level_id'] : '';
        move_uploaded_file($_FILES['file']['tmp_name'], $_FILES['file']['name']);
        $objReader = IOFactory_Word::createReader('Word2007');
        try {
          $contents = $objReader->load($_FILES['file']['name']);
        } catch (\Exception $e) {
          unlink($_FILES['file']['name']);
          $result['status_value'] = 'Lỗi không thể đọc file, vui lòng kiểm tra lại nội dung file có chứa hình ảnh hay không và thử lại.';
          $result['status'] = 0;
          echo json_encode($result);
          return;
        }
        // print_r($contents);
        $sections = $contents->getSections();
        $result = array();
        $lineKey = 0;
        $dataText = '';
        $convert_font = ['.VnTime'];
        $count = 0;

        foreach ($sections as $key => $value) {
            $sectionElement = $value->getElements();
            foreach ($sectionElement as $elementKey => $elementValue) {
                if ($elementValue instanceof TextRun) {
                    $secondSectionElement = $elementValue->getElements();
                    $lineText = '';
                    $UBIS = 0;
                    foreach ($secondSectionElement as $secondSectionElementKey => $secondSectionElementValue) {
                        if ($secondSectionElementValue instanceof Text) {
                          $UBIS = 0;
                          $underLine = $secondSectionElementValue->getFontStyle()->getUnderline();
                          $bold = $secondSectionElementValue->getFontStyle()->isBold();
                          $italic = $secondSectionElementValue->getFontStyle()->isItalic();
                          $strikeThrough = $secondSectionElementValue->getFontStyle()->isStrikethrough();
                          $font = $secondSectionElementValue->getFontStyle()->getName();
                          $superScript = $secondSectionElementValue->getFontStyle()->isSuperScript();
                          $subScript = $secondSectionElementValue->getFontStyle()->isSubScript();
                          $text = $secondSectionElementValue->getText();
                          if (in_array($font, $convert_font)) {
                              $text = $this->tcvn2uni($text);
                          }
                          if ($superScript) {
                              $text = '${}^{'.$text.'}$';
                          }
                          if ($subScript) {
                              $text = '${{}}_{'.$text.'}$';
                          }

                          if ($underLine != 'none') {
                            $UBIS = 1;
                          }
                          if ($UBIS) {
                              $lineText = $lineText . $text . '[TRUE]';
                          } else {
                              $lineText = $lineText . $text;
                          }

                        }
                    }
                    $dataText = $dataText . $lineText;

                    $lineKey = ($lineKey < 4) ? $lineKey+1 : 0;
                }
            }
        }
        $dataText = str_replace('\\[', '$', $dataText);
        $dataText = str_replace('\\]', '$', $dataText);
        $regex = '/(?<=Câu\s)([0-9]{1,9})[\,,\.,\),\:]([\s\S]*?)A[\.]([\s\S]*?)B[\.]([\s\S]*?)C[\.]([\s\S]*?)D[\.]([\s\S]*?)HD[\:]([\s\S]*?)(?(?=Câu\s)(?=Câu\s)|$)/';
        preg_match_all($regex, $dataText, $matches);

        // GET ANSWER A
        foreach ($matches[3] as $key_ma => $answer_data) {
            $check = preg_match('/(.*?)\[TRUE\]/',$answer_data);
            if ($check) {
                $matches[8][$key_ma] = 1;
            }
        }
        // GET ANSWER B
        foreach ($matches[4] as $key_mb => $answer_data) {
            $check = preg_match('/(.*?)\[TRUE\]/',$answer_data);
            if ($check) {
                $matches[8][$key_mb] = 2;
            }
        }
        // GET ANSWER C
        foreach ($matches[5] as $key_mc => $answer_data) {
            $check = preg_match('/(.*?)\[TRUE\]/',$answer_data);
            if ($check) {
                $matches[8][$key_mc] = 3;
            }
        }
        // GET ANSWER D
        for ($i=0; $i < count($matches[0]); $i++) {
            if (@is_null($matches[8][$i])) {
                $matches[8][$i] = 4;
            }
        }

        // DATA CLEAN
        foreach ($matches as $key_m1 => $value_matches) {
            foreach ($value_matches as $key_m2 => $data_matches) {
                $matches[$key_m1][$key_m2] = trim(preg_replace('/(.*?)\[TRUE\]/m', '$1', $data_matches));
            }
        }

        ksort($matches[8]);

        // print_r($matches);

        $count_question = count($matches[1]);
        $err_list = '';
        for ($i=0; $i < $count_question; $i++) {
          $stt = (string)$matches[1][$i];
          $question_content = $matches[2][$i];
          $answer_a = $matches[3][$i];
          $answer_b = $matches[4][$i];
          $answer_c = $matches[5][$i];
          $answer_d = $matches[6][$i];
          $key_answer = $matches[8][$i] + 2;
          $huong_dan = $matches[7][$i];
          $true_correct_answer = $matches[$key_answer][$i];

          $add = $this->add_question($subject_id,$question_content, $grade_id, $unit, $answer_a, $answer_b, $answer_c, $answer_d, $true_correct_answer,$level_id,$huong_dan);
          if($add)
              $count++;
          else
            $err_list =  $err_list.$stt.',';
          }

        unlink($_FILES['file']['name']);
        if ($err_list == '') {
            if ($count==0) {
              $result['status_value'] = "File câu hỏi bị sai định dạng hoặc đã trùng câu hỏi, vui lòng kiểm tra lại.";
              $result['status'] = 0;
            } else {
              $result['status_value'] = "Thêm thành công ".$count.' câu hỏi!';
              $result['status'] = 1;
            }
        } else {
          if ($count==0) {
            $result['status_value'] = "Tất cả câu đã bị trùng !";
            $result['status'] = 0;
          } else {
            $result['status_value'] = "Lỗi! Không thể thêm câu hỏi có STT: ".$err_list.', vui lòng xem lại.';
            $result['status'] = 0;
          }
        }
        echo json_encode($result);
        return;
    }
    public function check_add_doc()
    {
        $err_list = '';
        $subject_id = isset($_POST['subject_id']) ? $_POST['subject_id'] : '';
        $grade_id = isset($_POST['grade_id']) ? $_POST['grade_id'] : '';
        $name = isset($_POST['name']) ? $_POST['name'] : '';
        $mota = isset($_POST['mota']) ? $_POST['mota'] : '';
        $type_id = isset($_POST['type_id']) ? $_POST['type_id'] : '';
        $path = time() . '_' . $_FILES['file']['name'];
        $upload = move_uploaded_file($_FILES['file']['tmp_name'], 'upload/document/'.$path);
        if ($upload) {
            $add = $this->add_document($name, $grade_id, $subject_id, $mota, $path, $type_id);
            if ($add) {
              $result['status_value'] = "Thêm tài liệu thành công!";
              $result['status'] = 1;
            } else {
              $result['status_value'] = "Lỗi, gặp lỗi khi thêm thông tin vào cơ sở dữ liệu!";
              $result['status'] = 0;
            }
        } else {
          $result['status_value'] = "Lỗi, tải file lên hệ thống!";
          $result['status'] = 0;
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
    public function check_del_question()
    {
        $return = array();
        $question_id = isset($_POST['question_id']) ? Htmlspecialchars($_POST['question_id']) : '';
        $del = $this->del_question($question_id);
        if($del){
            $result['status_value'] = "Xóa thành công!";
            $result['status'] = 1;
            $result['question_id'] = $question_id;
        } else {
            $result['status_value'] = "Không thể xóa câu hỏi đang có trong đề thi!";
            $result['status'] = 0;
            $result['question_id'] = $question_id;
        }
        echo json_encode($result);
    }
    public function check_edit_question()
    {
        $result = array();
        $question_id = isset($_POST['question_id']) ? $_POST['question_id'] : '';
        $question_content = isset($_POST['question_detail']) ? $_POST['question_detail'] : '';
        $grade_id = isset($_POST['grade_id']) ? $_POST['grade_id'] : '';
        $subject_id = isset($_POST['subject_id']) ? $_POST['subject_id'] : '';
        $unit = isset($_POST['unit']) ? $_POST['unit'] : '';
        $answer_a = isset($_POST['answer_a']) ? $_POST['answer_a'] : '';
        $answer_b = isset($_POST['answer_b']) ? $_POST['answer_b'] : '';
        $answer_c = isset($_POST['answer_c']) ? $_POST['answer_c'] : '';
        $answer_d = isset($_POST['answer_d']) ? $_POST['answer_d'] : '';
        $huong_dan = isset($_POST['huong_dan']) ? $_POST['huong_dan'] : '';
        $level_id = isset($_POST['level_id']) ? $_POST['level_id'] : '';
        $correct_answer = isset($_POST['correct_answer']) ? $_POST['correct_answer'] : '';
        if (empty($question_content)||empty($grade_id)||empty($unit)||empty($answer_a)||empty($answer_b)||empty($answer_c)||empty($answer_d)||empty($correct_answer)) {
            $result['status_value'] = "Không được bỏ trống các trường nhập!";
            $result['status'] = 0;
        } else {
            if($correct_answer == "A"){
                $true_correct_answer = $answer_a;
            }
            if($correct_answer == "B"){
                $true_correct_answer = $answer_b;
            }
            if($correct_answer == "C"){
                $true_correct_answer = $answer_c;
            }
            if($correct_answer == "D"){
                $true_correct_answer = $answer_d;
            }
            $res = $this->edit_question($question_id,$subject_id, $question_content, $grade_id, $unit, $answer_a, $answer_b, $answer_c, $answer_d, $true_correct_answer,$level_id,$huong_dan);
            if($res) {
                $result['status_value'] = "Sửa thành công, chuẩn bị chuyển trang!";
                $result['status'] = 1;
            } else {
                $result['status_value'] = "Sửa thất bại, vui lòng kiểm tra lại!";
                $result['status'] = 0;
            }
        }
        echo json_encode($result);
    }
    public function send_notification()
    {
        $result = array();
        $notification_title = isset($_POST['notification_title']) ? htmlspecialchars($_POST['notification_title']) : '';
        $notification_content = isset($_POST['notification_content']) ? htmlspecialchars($_POST['notification_content']) : '';
        $teacher_id = isset($_POST['teacher_id']) ? json_decode(stripslashes($_POST['teacher_id'])) : array();
        $class_id = isset($_POST['class_id']) ? json_decode(stripslashes($_POST['class_id'])) : array();
        if (empty($notification_title)||empty($notification_content)) {
            $result['status_value'] = "Nội dung hoặc tiêu đề trống!";
            $result['status'] = 0;
        } else {
            if (empty($teacher_id)&&empty($class_id)) {
                $result['status_value'] = "Chưa chọn người nhận!";
                $result['status'] = 0;
            } else {
                do {
                    $notification_id = rand(1,999999)+rand(1,111111);
                    $insert = $this->insert_notification($notification_id,$notification_title, $notification_content);
                } while($insert == false);
                foreach ($teacher_id as $teacher_id_) {
                    $this->notify_teacher($notification_id, $teacher_id_);
                }
                foreach ($class_id as $class_id_) {
                    $this->notify_class($notification_id, $class_id_);
                };
                $result['status_value'] = "Gửi thành công!";
                $result['status'] = 1;
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
                $result = json_decode(json_encode($this->get_admin_info($username)), true);
                $result['status_value'] = "Sửa thành công!";
                $result['status'] = 1;
            }
        }
        echo json_encode($result);
    }
    public function submit_update_avatar()
    {
        if (isset($_FILES['file'])) {
            $duoi = explode('.', $_FILES['file']['name']);
            $duoi = $duoi[(count($duoi)-1)];
            if ($duoi === 'jpg' || $duoi === 'png') {
                if (move_uploaded_file($_FILES['file']['tmp_name'], 'upload/avatar/'.$this->info['username'].'_' . $_FILES['file']['name'])) {
                    $avatar = $this->info['username'] .'_' . $_FILES['file']['name'];
                    $update = $this->update_avatar($avatar, $this->info['username']);
                }
            }
        }
    }
    public function uploadImage()
    {
        if (isset($_FILES['file'])) {
            $base = new Base();
            $res = array();
            $path = 'upload/question_images/';
            $upload = $base->uploadImage($_FILES['file'],$path);
            if($upload != false) {
                $res['url'] = Config::APP_URL . $path . $upload;
                $res['stt'] = true;
            }
            else
                $res['stt'] = false;
            echo json_encode($res);
        }
    }
    public function delete_check_students()
    {
        $result = array();
        $list_del = "";
        $data = $_POST['list_check'];
        $list_check = explode(',', $data);
        for ($i = 0; $i < count($list_check) - 1; $i++)
        {
            $del = $this->del_student($list_check[$i]);
            if (!$del) {
                $list_del = $list_del." ".$list_check[$i];
            }
        }
        if ($list_del == '') {
            $result['status'] = 1;
            $result['status_value'] = "Xóa thành công";
        } else {
            $result['status'] = 0;
            $result['status_value'] = "Không thể xóa ID: ".$list_del;
        }
        echo json_encode($result);
    }
    public function delete_feedback_hs()
    {
        $model = new Model_Admin();
        $result = array();
        $id = $_POST['id'];

        $del = $model->delete_feedback_hs($id);

        if ($del) {
            $result['status'] = 1;
            $result['status_value'] = "Xóa thành công";
        } else {
            $result['status'] = 0;
            $result['status_value'] = "Lỗi không thể xóa !";
        }
        echo json_encode($result);
    }
    public function delete_feedback_gv()
    {
        $model = new Model_Admin();
        $result = array();
        $id = $_POST['id'];

        $del = $model->delete_feedback_gv($id);

        if ($del) {
            $result['status'] = 1;
            $result['status_value'] = "Xóa thành công";
        } else {
            $result['status'] = 0;
            $result['status_value'] = "Lỗi không thể xóa !";
        }
        echo json_encode($result);
    }
    public function delete_check_admins()
    {
        $result = array();
        $list_del = "";
        $data = $_POST['list_check'];
        $list_check = explode(',', $data);
        for ($i = 0; $i < count($list_check) - 1; $i++)
        {
            if($list_check[$i] == $this->info["admin_id"]) {
                $list_del = $list_del." ".$list_check[$i];
            } else {
                $del = $this->del_admin($list_check[$i]);
                if (!$del) {
                    $list_del = $list_del." ".$list_check[$i];
                }
            }
        }
        if ($list_del == '') {
            $result['status'] = 1;
            $result['status_value'] = "Xóa thành công";
        } else {
            $result['status'] = 0;
            $result['status_value'] = "Không thể xóa ID: ".$list_del.", vui lòng kiểm tra lại!";
        }
        echo json_encode($result);
    }
    public function delete_check_teachers()
    {
        $result = array();
        $list_del = "";
        $data = $_POST['list_check'];
        $list_check = explode(',', $data);
        for ($i = 0; $i < count($list_check) - 1; $i++)
        {
            $del = $this->del_teacher($list_check[$i]);
            if (!$del) {
                $list_del = $list_del." ".$list_check[$i];
            }
        }
        if ($list_del == '') {
            $result['status'] = 1;
            $result['status_value'] = "Xóa thành công";
        } else {
            $result['status'] = 0;
            $result['status_value'] = "Không thể xóa ID: ".$list_del.", Giáo viên đang chủ nhiệm lớp!";
        }
        echo json_encode($result);
    }
    public function delete_check_classes()
    {
        $result = array();
        $list_del = "";
        $data = $_POST['list_check'];
        $list_check = explode(',', $data);
        for ($i = 0; $i < count($list_check) - 1; $i++)
        {
            $del = $this->del_class($list_check[$i]);
            if (!$del) {
                $list_del = $list_del." ".$list_check[$i];
            }
        }
        if ($list_del == '') {
            $result['status'] = 1;
            $result['status_value'] = "Xóa thành công";
        } else {
            $result['status'] = 0;
            $result['status_value'] = "Không thể xóa ID: ".$list_del.", lớp đang có học sinh!";
        }
        echo json_encode($result);
    }
    public function delete_check_questions()
    {
        $result = array();
        $data = $_POST['list_check'];
        $list_check = explode(',', $data);
        $list_del == '';
        for ($i = 0; $i < count($list_check) - 1; $i++)
        {
            $del = $this->del_question($list_check[$i]);
            if (!$del) {
                $list_del = $list_del." ".$list_check[$i];
            }
        }
        if ($list_del == '') {
            $result['status'] = 1;
            $result['status_value'] = "Xóa thành công";
        } else {
            $result['status'] = 0;
            $result['status_value'] = "Không thể xóa ID: ".$list_del.", câu hỏi đang có trong đề thi!";
        }
        echo json_encode($result);
    }
    public function check_add_subject()
    {
        $result = array();
        $subject_detail = isset($_POST['subject_detail']) ? Htmlspecialchars(addslashes($_POST['subject_detail'])) : '';
        if (empty($subject_detail)) {
            $result['status_value'] = "Không được bỏ trống các trường nhập!";
            $result['status'] = 0;
        } else {
            $add = $this->add_subject($subject_detail);
            if ($add) {
                $result['status_value'] = "Thêm thành công!";
                $result['status'] = 1;
            } else {
                $result['status_value'] = "Lỗi! Môn đã tồn tại!";
                $return['status'] = 0;
            }
        }
        echo json_encode($result);
    }
    public function check_del_subject()
    {
        $result = array();
        $subject_id = Htmlspecialchars($_POST['subject_id']);
        $del = $this->del_subject($subject_id);
        if ($del) {
            $result['status_value'] = "Xóa thành công!";
            $result['status'] = 1;
            $result['subject_id'] = $subject_id;
        } else {
            $result['status_value'] = "Không thể xóa môn học đang có câu hỏi và đề thi trên hệ thống!";
            $result['status'] = 0;
            $result['subject_id'] = $subject_id;
        }
        echo json_encode($result);
    }
    public function check_edit_subject()
    {
        $result = array();
        $subject_id = isset($_POST['subject_id']) ? Htmlspecialchars($_POST['subject_id']) : '';
        $subject_detail = isset($_POST['subject_detail']) ? Htmlspecialchars(addslashes($_POST['subject_detail'])) : '';
        if (empty($subject_detail)) {
            $result['status_value'] = "Không được bỏ trống các trường nhập!";
            $result['status'] = 0;
        } else {
            $update = $this->edit_subject($subject_id, $subject_detail);
            if (!$update) {
                $result['status_value'] = "Môn không tồn tại!";
                $result['status'] = 0;
            } else {
                $result['status_value'] = "Sửa thành công!";
                $result['status'] = 1;
            }
        }
        echo json_encode($result);
    }
    public function check_add_test()
    {
        $result = array();
        $test_name = isset($_POST['test_name']) ? Htmlspecialchars(addslashes($_POST['test_name'])) : '';
        $test_type = isset($_POST['test_type']) ? Htmlspecialchars(addslashes($_POST['test_type'])) : '';
        $password = isset($_POST['password']) ? md5($_POST['password']) : '';
        $grade_id = isset($_POST['grade_id']) ? Htmlspecialchars(addslashes($_POST['grade_id'])) : '';
        $subject_id = isset($_POST['subject_id']) ? Htmlspecialchars(addslashes($_POST['subject_id'])) : '';
        $total_questions = isset($_POST['total_questions']) ? Htmlspecialchars(addslashes($_POST['total_questions'])) : '';
        $time_to_do = isset($_POST['time_to_do']) ? Htmlspecialchars(addslashes($_POST['time_to_do'])) : '';
        $note = isset($_POST['note']) ? Htmlspecialchars(addslashes($_POST['note'])) : '';
        $test_code = "";
        if (empty($test_name)||empty($time_to_do)||empty($password)) {
            $result['status_value'] = "Không được bỏ trống các trường nhập!";
            $result['status'] = 0;
        } else {
            do {
                $test_code = rand(100000,999999);
                $add = $this->add_test($test_code,$test_name,$test_type, $password, $grade_id, $subject_id, $total_questions, $time_to_do, $note);
            } while (!$add);
            $result['status_value'] = "Thêm thành công!";
            $result['status'] = 1;
            //Tạo bộ câu hỏi cho đề thi
            $model = new Model_Admin();
            $list_unit = $model->get_list_units($grade_id,$subject_id);
            foreach ($list_unit as $unit) {
                $list_lvl_of_unit = $model->get_list_levels_of_unit($grade_id, $subject_id,$unit->unit);
                foreach ($list_lvl_of_unit as $level) {
                   $limit = $_POST["unit_".$unit->unit."_level_".$level->level_id];
                   $list_quest = $model->list_quest_of_unit($grade_id,$subject_id,$unit->unit,$level->level_id,$limit);
                   foreach ($list_quest as $quest) {
                       $model->add_quest_to_test($test_code,$quest->question_id);
                   }
               }
           }
       }
       echo json_encode($result);
   }
   public function create_custom_test()
   {    
    $list_question = $_POST['question'];
    $total_questions = count($list_question);
    $result = array();
    $test_name = isset($_POST['detail'][0]['value']) ? Htmlspecialchars(addslashes($_POST['detail'][0]['value'])) : '';
    $test_type = isset($_POST['detail'][6]['value']) ? Htmlspecialchars(addslashes($_POST['detail'][6]['value'])) : '';
    $password = isset($_POST['detail'][1]['value']) ? md5($_POST['detail'][1]['value']) : '';
    $grade_id = isset($_POST['detail'][4]['value']) ? Htmlspecialchars(addslashes($_POST['detail'][4]['value'])) : '';
    $subject_id = isset($_POST['detail'][5]['value']) ? Htmlspecialchars(addslashes($_POST['detail'][5]['value'])) : '';
    $time_to_do = isset($_POST['detail'][2]['value']) ? Htmlspecialchars(addslashes($_POST['detail'][2]['value'])) : '';
    $note = isset($_POST['detail'][3]['value']) ? Htmlspecialchars(addslashes($_POST['detail'][3]['value'])) : '';
    $test_code = "";
    if (empty($test_name)||empty($time_to_do)||empty($password)||empty($list_question)) {
        $result['status_value'] = "Không được bỏ trống các trường nhập!";
        $result['status'] = 0;
    } else {
        do {
            $test_code = rand(100000,999999);
            $add = $this->add_test($test_code,$test_name,$test_type, $password, $grade_id, $subject_id, $total_questions, $time_to_do, $note);
        } while (!$add);
        $result['status_value'] = "Thêm thành công!";
        $result['status'] = 1;
        $model = new Model_Admin();
        foreach ($list_question as $quest_id) {
            $model->add_quest_to_test($test_code, $quest_id);
        }
    }
    echo json_encode($result);

   }
   public function check_toggle_test_status()
   {
    $result = array();
    $status_id = Htmlspecialchars($_POST['status_id']);
    $test_code = Htmlspecialchars($_POST['test_code']);
    $toggle = $this->toggle_test_status($test_code, $status_id);
    if ($toggle) {
        $result['status_value'] = "Đã thay đổi trạng thái!";
        $result['status'] = 1;
    } else {
        $result['status_value'] = "Không thay đổi trạng thái!";
        $result['status'] = 0;
    }
    echo json_encode($result);
    }
    public function update_quest_setting()
    {
      $result = array();
      $quest_setting->level_1_a = (int) Htmlspecialchars($_POST['level_1_a']);
      $quest_setting->level_1_b = (int) Htmlspecialchars($_POST['level_1_b']);
      $quest_setting->level_2_a = (int) Htmlspecialchars($_POST['level_2_a']);
      $quest_setting->level_2_b = (int) Htmlspecialchars($_POST['level_2_b']);
      $quest_setting->level_3_a = (int) Htmlspecialchars($_POST['level_3_a']);
      $quest_setting->level_3_b = (int) Htmlspecialchars($_POST['level_3_b']);
      $quest_setting->level_4_a = (int) Htmlspecialchars($_POST['level_4_a']);
      $quest_setting->level_4_b = (int) Htmlspecialchars($_POST['level_4_b']);
      $quest_setting->quest_total_analysis = (int) Htmlspecialchars($_POST['quest_total_analysis']);
      $model = new Model_Admin();
      $update = $model->update_quest_setting($quest_setting);
      if ($update) {
          $result['status_value'] = "Đã lưu cài đặt!";
          $result['status'] = 1;
      } else {
          $result['status_value'] = "Lỗi, không thể lưu cài đặt!";
          $result['status'] = 0;
      }
      echo json_encode($result);
    }
public function export_score()
{
    $test_code = isset($_GET['test_code']) ? htmlspecialchars($_GET['test_code']) : '';

    $model = new Model_Admin();
    $scores = $model->get_test_score($test_code);

        //Create Excel Data
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    $sheet->setCellValue('A1','Danh Sách Điểm Bài Thi '.$test_code);
    $sheet->setCellValue('A3','STT');
    $sheet->setCellValue('B3','Tên');
    $sheet->setCellValue('C3','Tài Khoản');
    $sheet->setCellValue('D3','Lớp');
    $sheet->setCellValue('E3','Điểm');

    for ($i = 0; $i < count($scores); $i++) {
        $sheet->setCellValue('A'.($i+4),$i+1);
        $sheet->setCellValue('B'.($i+4),$scores[$i]->name);
        $sheet->setCellValue('C'.($i+4),$scores[$i]->username);
        $sheet->setCellValue('D'.($i+4),$scores[$i]->class_name);
        $sheet->setCellValue('E'.($i+4),$scores[$i]->score_number);
    }

        //Output File
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attactment;filename="danh-sach-diem-'.$test_code.'.xlsx"');
    header('Cache-Control: max-age=0');

    $writer = new Xlsx($spreadsheet);
    $writer->save('php://output');
}
public function logout()
{
    $result = array();
    $confirm = isset($_POST['confirm']) ? $_POST['confirm'] : false;
    if ($confirm) {
        $result['status_value'] = "Đăng xuất thành công!";
        $result['status'] = 1;
        session_destroy();
    }
    echo json_encode($result);
}
public function show_analysis_wrong_quest()
{
  $view = new View_Admin();
  $model = new Model_Admin();
  $view->show_head_left($this->info);
  $view->show_analysis_wrong_quest($model->get_analysis_wrong_quest());
  $view->show_foot();
}
public function show_filter_wrong_quest()
{
  $view = new View_Admin();
  $model = new Model_Admin();
  $view->show_head_left($this->info);
  $view->show_filter_wrong_quest($model->get_question_analysis(),$model->get_system_setting());
  $view->show_foot();
}
public function show_cau_hoi_chon_sai()
{
  $view = new View_Admin();
  $model = new Model_Admin();
  $view->show_head_left($this->info);
  $view->show_cau_hoi_chon_sai($model->get_question_analysis(),$model->get_system_setting());
  $view->show_foot();
}
public function show_setting()
{
  $view = new View_Admin();
  $model = new Model_Admin();
  $view->show_head_left($this->info);
  $view->show_setting($model->get_system_setting());
  $view->show_foot();
}
public function show_admins_panel()
{
    $view = new View_Admin();
    $view->show_head_left($this->info);
    $view->show_admins_panel();
    $view->show_foot();
}
public function show_dashboard()
{
    $view = new View_Admin();
    $model = new Model_Admin();
    $view->show_head_left($this->info);
    $view->show_dashboard($this->get_dashboard_info(),$model->get_quest_incorrect_rank(),$this->get_analysis_login_month(),$this->get_score_analysis());
    $view->show_foot();
}
public function show_teachers_panel()
{
    $view = new View_Admin();
    $view->show_head_left($this->info);
    $view->show_teachers_panel();
    $view->show_foot();
}
public function show_classes_panel()
{
    $view = new View_Admin();
    $view->show_head_left($this->info);
    $view->show_classes_panel();
    $view->show_foot();
}
public function show_students_panel()
{
    $view = new View_Admin();
    $view->show_head_left($this->info);
    $view->show_students_panel();
    $view->show_foot();
}
public function show_questions_panel()
{
    $view = new View_Admin();
    $view->show_head_left($this->info);
    $view->show_questions_panel();
    $view->show_foot();
}
public function show_add_question()
{
    $view = new View_Admin();
    $view->show_head_left($this->info);
    $view->show_add_question();
    $view->show_foot();
}
public function show_edit_question()
{
    $id = addslashes($_GET['id']);
    if($id == null) {
        $this->show_404();
    } else {
        $model = new Model_Admin();
        $question = $model->get_question($id);
        $grades = $model->get_list_grades();
        $subjects = $model->get_list_subjects();
        $view = new View_Admin();
        $view->show_head_left($this->info);
        $view->show_edit_question($question,$grades,$subjects);
        $view->show_foot();
    }
}
public function show_tests_panel()
{
    $view = new View_Admin();
    $view->show_head_left($this->info);
    $view->show_tests_panel();
    $view->show_foot();
}
public function show_courses_panel()
{
    $view = new View_Admin();
    $view->show_head_left($this->info);
    $view->show_courses_panel();
    $view->show_foot();
}
public function show_ti_le_tuong_tac()
{
    $view = new View_Admin();
    $view->show_head_left($this->info);
    $view->show_ti_le_tuong_tac();
    $view->show_foot();
}
public function show_examine_panel()
{
    $view = new View_Admin();
    $view->show_head_left($this->info);
    $view->show_examine_panel();
    $view->show_foot();
}
public function get_list_messenger_user()
{
  // code...
}
public function show_messenger()
{
    $view = new View_Admin();
    $view->show_head_left($this->info);
    $view->show_messenger();
    $view->show_foot();
}
public function test_detail()
{
    $view = new View_Admin();
    $model = new Model_Admin();
    $test_code = htmlspecialchars($_GET['test_code']);
    $view->show_head_left($this->info);
    $view->show_tests_detail($model->get_quest_of_test($test_code));
    $view->show_foot();
}
public function test_print()
{
    $view = new View_Admin();
    $model = new Model_Admin();
    $test_code = htmlspecialchars($_GET['test_code']);
    $view->show_tests_print($model->get_quest_of_test($test_code));
}
public function test_score()
{
    $view = new View_Admin();
    $model = new Model_Admin();
    $test_code = htmlspecialchars($_GET['test_code']);
    $view->show_head_left($this->info);
    $view->show_test_score($test_code, $model->get_test_score($test_code));
    $view->show_foot();
}
public function show_subjects_panel()
{
    $view = new View_Admin();
    $view->show_head_left($this->info);
    $view->show_subjects_panel();
    $view->show_foot();
}
public function show_notifications_panel()
{
    $view = new View_Admin();
    $model = new Model_Admin();
    $list_teacher = $model->get_list_teachers();
    $list_class = $model->get_list_classes();
    $view->show_head_left($this->info);
    $view->show_notifications_panel($list_teacher,$list_class);
    $view->show_foot();
}
public function show_about()
{
    $view = new View_Admin();
    $view->show_head_left($this->info);
    $view->show_about();
    $view->show_foot();
}
public function show_profiles()
{
    $view = new View_Admin();
    $view->show_head_left($this->info);
    $view->show_profiles($this->get_admin_info($this->info['username']));
    $view->show_foot();
}
public function show_404()
{
    $view = new View_Admin();
    $view->show_404();
}
public function show_tai_lieu()
{
    $view = new View_Admin();
    $view->show_head_left($this->info);
    $view->show_tai_lieu($this->get_document());
    $view->show_foot();
}
public function show_create_test()
{
    $view = new View_Admin();
    $view->show_head_left($this->info);
    $view->show_create_test();
    $view->show_foot();
}
public function show_custom_create_test()
{
    $view = new View_Admin();
    $view->show_head_left($this->info);
    $view->show_custom_create_test();
    $view->show_foot();
}
public function show_feedback()
{
  $view = new View_Admin();
  $model = new Model_Admin();
  $view->show_head_left($this->info);
  $view->show_feedback($model->get_feedback(),$model->get_feedback_gv());
  $view->show_foot();
}
public function show_tai_lieu_video()
{
  $view = new View_Admin();
  $model = new Model_Admin();
  $subject_id = isset($_GET['subject_id']) ? $_GET['subject_id'] : '2';
  $grade_id = isset($_GET['grade_id']) ? $_GET['grade_id'] : '12';
  $view->show_head_left($this->info);
  $view->show_tai_lieu_video($model->get_list_document($subject_id,$grade_id,4));
  $view->show_foot();
}
public function show_tai_lieu_kien_thuc()
{
  $view = new View_Admin();
  $model = new Model_Admin();
  $subject_id = isset($_GET['subject_id']) ? $_GET['subject_id'] : '2';
  $grade_id = isset($_GET['grade_id']) ? $_GET['grade_id'] : '12';
  $view->show_head_left($this->info);
  $view->show_tai_lieu_kien_thuc($model->get_list_document($subject_id,$grade_id,1));
  $view->show_foot();
}
public function show_tai_lieu_phuong_phap()
{
  $view = new View_Admin();
  $model = new Model_Admin();
  $subject_id = isset($_GET['subject_id']) ? $_GET['subject_id'] : '2';
  $grade_id = isset($_GET['grade_id']) ? $_GET['grade_id'] : '12';
  $view->show_head_left($this->info);
  $view->show_tai_lieu_phuong_phap($model->get_list_document($subject_id,$grade_id,2));
  $view->show_foot();
}
public function show_tai_lieu_de_tham_khao()
{
  $view = new View_Admin();
  $model = new Model_Admin();
  $subject_id = isset($_GET['subject_id']) ? $_GET['subject_id'] : '2';
  $grade_id = isset($_GET['grade_id']) ? $_GET['grade_id'] : '12';
  $view->show_head_left($this->info);
  $view->show_tai_lieu_de_tham_khao($model->get_list_document($subject_id,$grade_id,3));
  $view->show_foot();
}
public function show_tai_lieu_khac()
{
  $view = new View_Admin();
  $model = new Model_Admin();
  $subject_id = isset($_GET['subject_id']) ? $_GET['subject_id'] : '2';
  $grade_id = isset($_GET['grade_id']) ? $_GET['grade_id'] : '12';
  $view->show_head_left($this->info);
  $view->show_tai_lieu_khac($model->get_list_document($subject_id,$grade_id,5));
  $view->show_foot();
}
public function show_diem_so()
{
  $view = new View_Admin();
  $model = new Model_Admin();
  $view->show_head_left($this->info);
  $view->show_diem_so($model->get_diem_so());
  $view->show_foot();
}
}
