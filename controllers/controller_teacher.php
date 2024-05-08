<?php
require_once('core/Base.php');
require_once('models/model_admin.php');
require_once('views/view_admin.php');
require_once('models/model_teacher.php');
require_once 'views/view_teacher.php';
require 'res/libs/Word/vendor/autoload.php';
use PhpOffice\PhpWord\IOFactory as IOFactory_Word;
use PhpOffice\PhpWord\Element\TextRun;
use PhpOffice\PhpWord\Element\Text;
require 'res/libs/SpreadSheet/vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Controller_Teacher
{
    public $info =  array();
    public function __construct()
    {
        $user_info = $this->profiles();
        $this->info['ID'] = $user_info->ID;
        $this->update_last_login($this->info['ID']);
        $this->info['username'] = $user_info->username;
        $this->info['name'] = $user_info->name;
        $this->info['avatar'] = $user_info->avatar;
        $this->info['notification'] = $user_info->notification;
    }
    public function get_list_user_search()
    {
      $model = new Model_Teacher();
      $string = isset($_POST['string']) ? $_POST['string'] : 'a';
      $data = $model->get_list_user_search($string);
      echo json_encode($data);
    }
    public function get_recent_messenger_user() // Lấy danh sách user nhắn tin gần đây
    {
      $model = new Model_Teacher();
      $recent_user = $model->get_recent_messenger_user($this->info['username']);
      for ($i=0; $i < count($recent_user); $i++) {
        $recent_user[$i] = $model->get_info_messenger_user($recent_user[$i]->username);
      }
      echo json_encode($recent_user);
    }
    public function get_user_messenger() // Lấy tin nhắn với một user POST['username']
    {
      $model = new Model_Teacher();
      $username_send = isset($_POST['username']) ? $_POST['username'] : 'admin';
      $messenger = $model->get_user_messenger($username_send,$this->info['username']);
      $model->clear_messenger_seen($username_send.":".$this->info['username']); // Reset tin nhắn chưa đọc về 0
      echo json_encode($messenger);
    }
    public function send_messenger() // Gửi tin nhắn cho một username qua phương thức POST
    {
      $model = new Model_Teacher();
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
      $model = new Model_Teacher();
      $data = $model->get_count_messenger_seen($this->info['username']);
      echo json_encode($data);
    }
    public function get_new_messenger()
    {
      $username = isset($_POST['username']) ? htmlspecialchars($_POST['username']) : '';
      $model = new Model_Teacher();
      $count = $model->get_count_messenger_seen_user($username,$this->info['username']);
      $model->clear_messenger_seen($username.":".$this->info['username']);
      $data = $model->get_new_messenger($username,$this->info['username'],$count->count);
      sort($data);
      echo json_encode($data);
    }
    public function test_detail()
    {
        $view = new View_Teacher();
        $model = new Model_Teacher();
        $test_code = htmlspecialchars($_GET['test_code']);
        $view->show_head_left($this->info);
        $view->show_tests_detail($model->get_quest_of_test($test_code));
        $view->show_foot();
    }
    public function profiles()
    {
        $model = new Model_Teacher();
        return $model->get_profiles($_SESSION['username']);
    }
    public function update_last_login()
    {
        $model = new Model_Teacher();
        $model->update_last_login($this->info['ID']);
    }
    public function del_question($question_id)
    {
        $model = new Model_Admin();
        return $model->del_question($question_id);
    }
    public function get_profiles()
    {
        $model = new Model_Teacher();
        echo json_encode($model->get_profiles($this->info['username']));
    }
    public function show_cau_hoi_chon_sai()
    {
      $view = new View_Teacher();
      $model = new Model_Admin();
      $view->show_head_left($this->info);
      $view->show_cau_hoi_chon_sai($model->get_question_analysis(),$model->get_system_setting());
      $view->show_foot();
    }
    public function show_create_test()
    {
        $view = new View_Admin();
        $view->show_head_left($this->info);
        $view->show_create_test();
        $view->show_foot();
    }
    public function add_document($name, $grade_id, $subject_id, $mota, $path, $type_id)
    {
        $model = new Model_Admin();
        return $model->add_document($name, $grade_id, $subject_id, $mota, $path, $type_id);
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
    public function del_document($document_id)
    {
        $model = new Model_Admin();
        return $model->del_document($document_id);
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
    public function edit_question($question_id,$subject_id, $question_content, $grade_id, $unit, $answer_a, $answer_b, $answer_c, $answer_d, $correct_answer,$level_id,$huong_dan)
    {
        $model = new Model_Admin();
        return $model->edit_question($question_id,$subject_id, $question_content, $grade_id, $unit, $answer_a, $answer_b, $answer_c, $answer_d, $correct_answer,$level_id,$huong_dan);
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
    public function valid_email_on_profiles()
    {
        $result = array();
        $model = new Model_Teacher();
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
    public function add_question($subject_id,$question_content, $grade_id, $unit, $answer_a, $answer_b, $answer_c, $answer_d, $correct_answer,$level_id,$huong_dan=null)
    {
        $model = new Model_Admin();
        return $model->add_question($subject_id,$question_content, $grade_id, $unit, $answer_a, $answer_b, $answer_c, $answer_d, $correct_answer,$level_id,$this->info["username"],$huong_dan);
    }
    public function update_avatar($avatar, $username)
    {
        $model = new Model_Teacher();
        return $model->update_avatar($avatar, $username);
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
    public function upload_file_data_messenger($uploader,$file_name)
    {
        $model = new Model_Teacher();
        return $model->upload_file_data_messenger($uploader,$file_name);
    }
    public function update_profiles($username, $name, $email, $password, $gender, $birthday)
    {
        $model = new Model_Teacher();
        return $model->update_profiles($username, $name, $email, $password, $gender, $birthday);
    }
    public function show_tai_lieu()
    {
        $view = new View_Teacher();
        $view->show_head_left($this->info);
        $view->show_tai_lieu($this->get_document());
        $view->show_foot();
    }
    public function get_document()
    {
        $model = new Model_Admin();
        return $model->get_list_document_all();
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
    public function insert_notification($notification_id,$notification_title, $notification_content)
    {
        $model = new Model_Teacher();
        return $model->insert_notification($notification_id,$this->info['username'], $this->info['name'], $notification_title, $notification_content);
    }
    public function notify_class($ID, $class_id)
    {
        $model = new Model_Teacher();
        $model->notify_class($ID, $class_id);
        $model->count_notify_class($class_id);
    }
    public function send_notification()
    {
        $result = array();
        $notification_title = isset($_POST['notification_title']) ? htmlspecialchars($_POST['notification_title']) : '';
        $notification_content = isset($_POST['notification_content']) ? htmlspecialchars($_POST['notification_content']) : '';
        $class_id = isset($_POST['class_id']) ? json_decode(stripslashes($_POST['class_id'])) : array();
        if (empty($notification_title)||empty($notification_content)) {
            $result['status_value'] = "Nội dung hoặc tiêu đề trống!";
            $result['status'] = 0;
        } else {
            if (empty($class_id)) {
                $result['status_value'] = "Chưa lớp người nhận!";
                $result['status'] = 0;
            } else {
                do {
                    $notification_id = rand(1,999999)+rand(1,111111);
                    $insert = $this->insert_notification($notification_id,$notification_title, $notification_content);
                } while($insert == false);
                foreach ($class_id as $class_id_) {
                    $this->notify_class($notification_id, $class_id_);
                }
                $result['status_value'] = "Gửi thành công!";
                $result['status'] = 1;
            }
        }
        echo json_encode($result);
    }
    public function get_list_classes_by_teacher()
    {
        $model = new Model_Teacher();
        echo json_encode($model->get_list_classes_by_teacher($this->info['ID']));
    }
    public function get_notifications_to_student()
    {
        $model = new Model_Teacher();
        echo json_encode($model->get_notifications_to_student($this->info['username']));
    }
    public function get_notifications_by_admin()
    {
        $model = new Model_Teacher();
        echo json_encode($model->get_notifications_by_admin($this->info['ID']));
    }
    public function get_score()
    {
        $student_id = isset($_POST['student_id']) ? $_POST['student_id'] : '1';
        $model = new Model_Teacher();
        echo json_encode($model->get_score($student_id));
    }
    public function get_class_detail($ID)
    {
        $model = new Model_Teacher();
        return $model->get_class_detail($ID);
    }
    public function get_class_name($ID)
    {
        $model = new Model_Teacher();
        return $model->get_class_name($ID);
    }
    public function get_list_classes_by_teacher_count()
    {
        $model = new Model_Teacher();
        $class = $model->get_list_classes_by_teacher($this->info['ID']);
        for ($i=0; $i < count($class); $i++) {
          $class[$i]->count = $model->count_students($class[$i]->class_id);
        }
        return $class;
    }
    public function export_score()
    {
        $test_code = isset($_GET['test_code']) ? htmlspecialchars($_GET['test_code']) : '';

        $model = new Model_Teacher();
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
    public function show_dashboard()
    {
        $model = new Model_Teacher();
        $view = new View_Teacher();
        $view->show_head_left($this->info);
        $view->show_dashboard($this->get_list_classes_by_teacher_count());
        $view->show_foot();
    }
    public function show_class_detail()
    {
        $view = new View_Teacher();
        $view->show_head_left($this->info);
        $class_id = isset($_GET['class_id']) ? $_GET['class_id'] : '';
        if($class_id == '')
            $view->show_404();
        else
            $view->show_class_detail($this->get_class_name($class_id), $this->get_class_detail($class_id));
        $view->show_foot();
    }
    public function show_analysis_wrong_quest()
    {
      $view = new View_Teacher();
      $model = new Model_Teacher();
      $view->show_head_left($this->info);
      $view->show_analysis_wrong_quest($model->get_analysis_wrong_quest());
      $view->show_foot();
    }
    public function show_filter_wrong_quest()
    {
      $view = new View_Teacher();
      $model = new Model_Teacher();
      $view->show_head_left($this->info);
      $view->show_filter_wrong_quest($model->get_question_analysis(),$model->get_system_setting());
      $view->show_foot();
    }
    public function get_list_tests()
    {
        $model = new Model_Admin();
        echo json_encode($model->get_list_tests());
    }
    public function add_test($test_code,$test_name,$test_type, $password, $grade_id, $subject_id, $total_questions, $time_to_do, $note)
    {
        $model = new Model_Admin();
        return $model->add_test($this->info['ID'] ,$test_code,$test_name,$test_type, $password, $grade_id, $subject_id, $total_questions, $time_to_do, $note);
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
   public function toggle_test_status($test_code, $status_id)
   {
       $model = new Model_Admin();
       return $model->toggle_test_status($test_code, $status_id);
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
    // public function check_del_question()
    // {
    //     $return = array();
    //     $question_id = isset($_POST['question_id']) ? Htmlspecialchars($_POST['question_id']) : '';
    //     $del = $this->del_question($question_id);
    //     if($del){
    //         $result['status_value'] = "Xóa thành công!";
    //         $result['status'] = 1;
    //         $result['question_id'] = $question_id;
    //     } else {
    //         $result['status_value'] = "Không thể xóa câu hỏi đang có trong đề thi!";
    //         $result['status'] = 0;
    //         $result['question_id'] = $question_id;
    //     }
    //     echo json_encode($result);
    // }
    public function show_tests_panel()
    {
        $view = new View_Teacher();
        $view->show_head_left($this->info);
        $view->show_tests_panel();
        $view->show_foot();
    }
    public function show_notifications()
    {
        $view = new View_Teacher();
        $model = new Model_Teacher();
        $this->info['notification'] = 0;
        $model->reset_count_notify_teacher($this->info['ID']);
        $view->show_head_left($this->info);
        $list_class = $model->get_list_classes_by_teacher($this->info['ID']);
        $view->show_notifications($list_class);
        $view->show_foot();
    }
    public function show_profiles()
    {
        $view = new View_Teacher();
        $view->show_head_left($this->info);
        $view->show_profiles($this->profiles());
        $view->show_foot();
    }
    public function show_about()
    {
        $view = new View_Teacher();
        $view->show_head_left($this->info);
        $view->show_about();
        $view->show_foot();
    }
    public function list_test()
    {
        $model = new Model_Teacher();
        $tests = $model->get_list_test($this->info['ID']);

        $view = new View_Teacher();
        $view->show_head_left($this->info);
        $view->show_list_test($tests);
        $view->show_foot();
    }
    public function test_print()
    {
        $view = new View_Admin();
        $model = new Model_Admin();
        $test_code = htmlspecialchars($_GET['test_code']);
        $view->show_tests_print($model->get_quest_of_test($test_code));
    }
    public function get_list_courses()
    {
        $model = new Model_Admin();
        echo json_encode($model->get_list_courses());
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
    public function show_courses_panel()
    {
        $view = new View_Teacher();
        $view->show_head_left($this->info);
        $view->show_courses_panel();
        $view->show_foot();
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
            $view = new View_Teacher();
            $view->show_head_left($this->info);
            $view->show_edit_question($question,$grades,$subjects);
            $view->show_foot();
        }
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
    public function show_examine_panel()
    {
        $view = new View_Teacher();
        $view->show_head_left($this->info);
        $view->show_examine_panel();
        $view->show_foot();
    }
    public function show_custom_create_test()
{
    $view = new View_Teacher();
    $view->show_head_left($this->info);
    $view->show_custom_create_test();
    $view->show_foot();
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
    public function get_list_examine()
    {
        $model = new Model_Admin();
        echo json_encode($model->get_list_examine());
    }
    public function show_questions_panel()
    {
        $view = new View_Teacher();
        $view->show_head_left($this->info);
        $view->show_questions_panel();
        $view->show_foot();
    }
    public function show_add_question()
    {
        $view = new View_Teacher();
        $view->show_head_left($this->info);
        $view->show_add_question();
        $view->show_foot();
    }
    public function test_score()
    {
        $test_code = isset($_GET['test_code']) ? htmlspecialchars($_GET['test_code']) : '';
        $model = new Model_Teacher();
        $scores = $model->get_test_score($test_code);

        $view = new View_Teacher();
        $view->show_head_left($this->info);
        $view->show_test_score($scores);
        $view->show_foot();
    }
    public function submit_feedback()
    {
      $result = array();
      $feedback = isset($_POST['feedback']) ? htmlspecialchars($_POST['feedback']) : '';
      if(empty($feedback)) {
        $result['status_value'] = "Nội dung trống";
        $result['status'] = 0;
      } else {
        $model = new Model_Teacher();
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
    public function show_feedback()
    {
      $view = new View_Teacher();
      $view->show_head_left($this->info);
      $view->show_feedback();
      $view->show_foot();
    }
    public function show_404()
    {
        $view = new View_Teacher();
        $view->show_404();
    }
    public function show_messenger()
    {
        $view = new View_Teacher();
        $view->show_head_left($this->info);
        $view->show_messenger();
        $view->show_foot();
    }
    public function show_tai_lieu_video()
    {
      $view = new View_Teacher();
      $model = new Model_Teacher();
      $subject_id = isset($_GET['subject_id']) ? $_GET['subject_id'] : '2';
      $grade_id = isset($_GET['grade_id']) ? $_GET['grade_id'] : '12';
      $view->show_head_left($this->info);
      $view->show_tai_lieu_video($model->get_list_document($subject_id,$grade_id,4));
      $view->show_foot();
    }
    public function show_tai_lieu_kien_thuc()
    {
      $view = new View_Teacher();
      $model = new Model_Teacher();
      $subject_id = isset($_GET['subject_id']) ? $_GET['subject_id'] : '2';
      $grade_id = isset($_GET['grade_id']) ? $_GET['grade_id'] : '12';
      $view->show_head_left($this->info);
      $view->show_tai_lieu_kien_thuc($model->get_list_document($subject_id,$grade_id,1));
      $view->show_foot();
    }
    public function show_tai_lieu_phuong_phap()
    {
      $view = new View_Teacher();
      $model = new Model_Teacher();
      $subject_id = isset($_GET['subject_id']) ? $_GET['subject_id'] : '2';
      $grade_id = isset($_GET['grade_id']) ? $_GET['grade_id'] : '12';
      $view->show_head_left($this->info);
      $view->show_tai_lieu_phuong_phap($model->get_list_document($subject_id,$grade_id,2));
      $view->show_foot();
    }
    public function show_tai_lieu_de_tham_khao()
    {
      $view = new View_Teacher();
      $model = new Model_Teacher();
      $subject_id = isset($_GET['subject_id']) ? $_GET['subject_id'] : '2';
      $grade_id = isset($_GET['grade_id']) ? $_GET['grade_id'] : '12';
      $view->show_head_left($this->info);
      $view->show_tai_lieu_de_tham_khao($model->get_list_document($subject_id,$grade_id,3));
      $view->show_foot();
    }
    public function show_tai_lieu_khac()
    {
      $view = new View_Teacher();
      $model = new Model_Teacher();
      $subject_id = isset($_GET['subject_id']) ? $_GET['subject_id'] : '2';
      $grade_id = isset($_GET['grade_id']) ? $_GET['grade_id'] : '12';
      $view->show_head_left($this->info);
      $view->show_tai_lieu_khac($model->get_list_document($subject_id,$grade_id,5));
      $view->show_foot();
    }
    public function show_diem_so()
    {
      $view = new View_Teacher();
      $model = new Model_Admin();
      $view->show_head_left($this->info);
      $view->show_diem_so($model->get_diem_so());
      $view->show_foot();
    }
    public function show_diem_hs()
    {
      $student_id = isset($_GET['student_id']) ? htmlspecialchars($_GET['student_id']) : '';
      $view = new View_Teacher();
      $model = new Model_Teacher();
      $view->show_head_left($this->info);
      $view->show_diem_hs($model->get_diem_hs($student_id),$model->get_student($student_id));
      $view->show_foot();
    }
}
