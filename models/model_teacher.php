<?php

require_once('config/database.php');

class Model_Teacher extends Database
{
  public function get_list_user_search($string)
  {
    $sql = "
    SELECT DISTINCT username, name, permission, avatar FROM `students` WHERE name LIKE '%$string%'
    UNION
    SELECT DISTINCT username, name, permission, avatar FROM `admins` WHERE name LIKE '%$string%'
    UNION
    SELECT DISTINCT username, name, permission, avatar FROM `teachers` WHERE name LIKE '%$string%'
    ";

    $this->set_query($sql);
    return $this->load_rows();
  }
  public function get_list_document_all()
  {
      $sql = "SELECT DISTINCT * FROM document";

      $this->set_query($sql);
      return $this->load_rows();
  }
  public function get_list_document($subject_id,$grade_id,$type)
  {
      $sql = "SELECT DISTINCT * FROM document WHERE subject_id = :subject_id AND grade_id = :grade_id AND type_id = :type";

      $param = [ ':subject_id' => $subject_id, ':grade_id' => $grade_id, ':type' => $type ];

      $this->set_query($sql, $param);
      return $this->load_rows();
  }
  public function get_recent_messenger_user($username)
  {
      $sql = "
      SELECT username_send AS username, COUNT(username_send) AS count FROM messenger WHERE username_get = :username GROUP BY username_send HAVING COUNT(username_send) > 0 ORDER BY time DESC
      ";
      $param = [ ':username' => $username ];

      $this->set_query($sql, $param);
      return $this->load_rows();
  }
  public function get_info_messenger_user($username)
  {
      $sql = "
      SELECT DISTINCT username, name, permission, avatar FROM students WHERE username = :username OR email = :username UNION SELECT DISTINCT username, name, permission, avatar FROM teachers WHERE username = :username OR email = :username UNION SELECT DISTINCT username, name, permission, avatar FROM admins WHERE username = :username OR email = :username
      ";
      $param = [ ':username' => $username ];

      $this->set_query($sql, $param);
      return $this->load_row();
  }
  public function upload_file_data_messenger($uploader,$file_name)
  {
      $sql="INSERT INTO file_upload (uploader,file_name) VALUES (:uploader,:file_name)";

      $param = [ ':uploader' => $uploader, ':file_name' => $file_name ];

      $this->set_query($sql, $param);
      return $this->execute_return_status();
  }
  public function get_user_messenger($username_send,$username_get)
  {
      $sql = "
      SELECT DISTINCT id, content, time, username_get, username_send, type FROM messenger WHERE (username_send = :username_send AND username_get = :username_get) OR (username_send = :username_get AND username_get = :username_send) ORDER BY time ASC
      ";
      $param = [ ':username_send' => $username_send, ':username_get' => $username_get ];

      $this->set_query($sql, $param);
      return $this->load_rows();
  }
  public function get_new_messenger($username_send,$username_get,$count)
  {
      $sql = "
      SELECT DISTINCT id, content, TIME, username_get, username_send FROM messenger WHERE username_send = '$username_send' AND username_get = '$username_get' ORDER BY TIME DESC LIMIT $count
      ";
      $this->set_query($sql);
      return $this->load_rows();
  }
  public function send_messenger($username_get,$username_send,$content,$type)
  {
      $sql = "
      INSERT INTO messenger (id, username_send, username_get, content, time, type) VALUES (NULL, :username_send, :username_get, :content, current_timestamp(), :type);
      ";

      $param = [ ':username_get' => $username_get, ':username_send' => $username_send, ':content' => $content, ':type' => $type ];

      $this->set_query($sql, $param);
      return $this->execute_return_status();
  }
  public function update_messenger_seen($send_get)
  {
      $sql = "
      INSERT INTO messenger_seen( send_get, count ) VALUES( :send_get, count +1 ) ON DUPLICATE KEY UPDATE count = count +1
      ";

      $param = [ ':send_get' => $send_get ];

      $this->set_query($sql, $param);
      return $this->execute_return_status();
  }
  public function clear_messenger_seen($send_get)
  {
      $sql = "
      INSERT INTO messenger_seen( send_get, count ) VALUES( :send_get, 0 ) ON DUPLICATE KEY UPDATE count = 0
      ";

      $param = [ ':send_get' => $send_get ];

      $this->set_query($sql, $param);
      return $this->execute_return_status();
  }
  public function get_count_messenger_seen($username)
  {
    $sql = "
    SELECT * FROM messenger_seen WHERE send_get LIKE '%$username'
    ";
    $this->set_query($sql);
    return $this->load_rows();
  }
  public function get_count_messenger_seen_user($username_send,$username_get)
  {
    $sql = "
    SELECT * FROM messenger_seen WHERE send_get LIKE '%$username_get' AND send_get LIKE '$username_send%'
    ";
    $this->set_query($sql);
    return $this->load_row();
  }
    public function get_profiles($username)
    {
        $sql = "SELECT DISTINCT teachers.teacher_id as ID,teachers.username,teachers.name,teachers.email,teachers.avatar,teachers.birthday,teachers.last_login,genders.gender_id,teachers.notification,genders.gender_detail FROM `teachers`
        INNER JOIN genders ON genders.gender_id = teachers.gender_id
        WHERE username = :username";

        $param = [ ':username' => $username ];

        $this->set_query($sql, $param);
        return $this->load_row();
    }
    public function get_diem_hs($student_id)
  	{
  			$sql = "SELECT DISTINCT scores.test_code, tests.test_name, subjects.subject_detail, tests.grade_id, scores.score_number,scores.score_detail,scores.completion_time FROM scores
  			INNER JOIN tests ON scores.test_code = tests.test_code
  			INNER JOIN subjects ON tests.subject_id = subjects.subject_id
  			WHERE student_id = :student_id";

  			$param = [ ':student_id' => $student_id ];

  			$this->set_query($sql, $param);
  			return $this->load_rows();
  	}
    public function get_student($student_id)
    {
        $sql = "SELECT * FROM `students` WHERE student_id = :student_id";

        $param = [ ':student_id' => $student_id ];

        $this->set_query($sql, $param);
        return $this->load_row();
    }
    public function update_last_login($ID)
    {
        $sql="UPDATE teachers set last_login = NOW() where teacher_id = :ID";

        $param = [ ':ID' => $ID ];

        $this->set_query($sql, $param);
        $this->execute_return_status();
    }

    public function valid_email_on_profiles($curren_email, $new_email)
    {
        $sql = "SELECT DISTINCT name FROM students WHERE email = :new_email AND email NOT IN (:curren_email)
        UNION SELECT DISTINCT name FROM admins WHERE email = :new_email AND email NOT IN (:curren_email)
        UNION SELECT DISTINCT name FROM teachers WHERE email = :new_email AND email NOT IN (:curren_email)";

        $param = [ ':curren_email' => $curren_email, ':new_email' => $new_email ];

        $this->set_query($sql, $param);
        if ($this->load_row() != '') {
            return false;
        } else {
            return true;
        }
    }

    public function get_list_test($teacher_id)
    {
        $sql = "SELECT DISTINCT tests.test_code,tests.test_name,tests.total_questions,tests.time_to_do,tests.note,grades.detail as grade,subjects.subject_detail FROM `tests`
        INNER JOIN grades ON grades.grade_id = tests.grade_id
        INNER JOIN subjects ON subjects.subject_id = tests.subject_id
        WHERE `test_code` IN (SELECT DISTINCT test_code FROM `scores`
        INNER JOIN students ON scores.student_id = students.student_id
        WHERE students.class_id IN (SELECT DISTINCT class_id FROM classes WHERE classes.teacher_id = :teacher_id))";

        $param = [ ':teacher_id' => $teacher_id ];

        $this->set_query($sql, $param);
        return $this->load_rows();
    }

    public function get_test_score($test_code)
    {
        $sql = "SELECT DISTINCT * FROM `scores` INNER JOIN students ON scores.student_id = students.student_id
        INNER JOIN classes ON students.class_id = classes.class_id
        WHERE test_code = :test_code";

        $param = [ ':test_code' => $test_code ];

        $this->set_query($sql, $param);
        return $this->load_rows();
    }

    public function update_avatar($avatar, $username)
    {
        $sql="UPDATE teachers set avatar = :avatar where username = :username";

        $param = [ ':avatar' => $avatar, ':username' => $username ];

        $this->set_query($sql, $param);
        $this->execute_return_status();
    }

    public function update_profiles($username, $name, $email, $password, $gender, $birthday)
    {
        $sql="UPDATE teachers set email = :email, password = :password, name = :name, gender_id = :gender, birthday = :birthday where username = :username";

        $param = [ ':username' => $username, ':name' => $name, ':email' => $email, ':password' => $password, ':gender' => $gender, ':birthday' => $birthday ];

        $this->set_query($sql, $param);
        $this->execute_return_status();
        return true;
    }

    public function get_list_classes_by_teacher($teacher_id)
    {
        $sql = "SELECT DISTINCT classes.class_id,classes.class_name,grades.detail as grade FROM classes
        INNER JOIN grades ON grades.grade_id = classes.grade_id
        WHERE teacher_id = :teacher_id";

        $param = [ ':teacher_id' => $teacher_id ];

        $this->set_query($sql, $param);
        return $this->load_rows();
    }

    public function get_class_detail($class_id)
    {
        $sql = "SELECT DISTINCT students.student_id,students.avatar,students.username,students.name,students.birthday,genders.gender_detail,students.last_login,class_name FROM students
        INNER JOIN genders ON genders.gender_id = students.gender_id
        INNER JOIN classes ON students.class_id =classes.class_id
        WHERE students.class_id = :class_id";

        $param = [ ':class_id' => $class_id ];

        $this->set_query($sql, $param);
        return $this->load_rows();
    }
    public function count_students($class_id)
    {
        $sql = "SELECT DISTINCT COUNT(student_id) AS COUNT FROM students WHERE students.class_id = :class_id";

        $param = [ ':class_id' => $class_id ];

        $this->set_query($sql, $param);
        return $this->load_row()->COUNT;
    }
    public function get_question_analysis()
    {
      $sql = "
      SELECT DISTINCT questions.question_id, questions.question_content, questions.answer_a, questions.answer_b, questions.answer_c, questions.answer_d, subjects.subject_detail, questions.grade_id, questions.unit, quest_incorrect_rank.count, quest_incorrect_rank.total, quest_incorrect_rank.ratio, quest_incorrect_rank.a, quest_incorrect_rank.b, quest_incorrect_rank.c, quest_incorrect_rank.d, quest_incorrect_rank.ratio_a, quest_incorrect_rank.ratio_b, quest_incorrect_rank.ratio_c, quest_incorrect_rank.ratio_d, quest_incorrect_rank.blank, levels.level_detail, levels.level_id FROM `quest_incorrect_rank` INNER JOIN questions ON quest_incorrect_rank.question_id = questions.question_id INNER JOIN subjects ON questions.subject_id = subjects.subject_id INNER JOIN levels ON questions.level_id = levels.level_id ORDER BY `quest_incorrect_rank`.`count` DESC
      ";

      $this->set_query($sql);
      return $this->load_rows();
    }
    public function get_system_setting()
    {
        $sql = "
        SELECT DISTINCT * FROM system_setting
        ";
        $this->set_query($sql);
        return $this->load_row();
    }
    public function submit_feedback($feedback,$teacher_id)
    {
      $sql = "INSERT INTO feedback_gv (teacher_id, content) VALUES (:teacher_id, :feedback)";

          $param = [ ':teacher_id' => $teacher_id, ':feedback' => $feedback ];

      $this->set_query($sql, $param);
      return $this->execute_return_status();
    }
    public function get_list_tests()
    {
        $sql = "
        SELECT DISTINCT tests.test_code,tests.test_name,tests.test_type,tests.password,tests.total_questions,tests.time_to_do,tests.note,grades.detail as grade,subjects.subject_detail,statuses.status_id,statuses.detail as status FROM `tests`
        INNER JOIN grades ON grades.grade_id = tests.grade_id
        INNER JOIN subjects ON subjects.subject_id = tests.subject_id
        INNER JOIN statuses ON statuses.status_id = tests.status_id
        WHERE test_type=1";

        $this->set_query($sql);
        return $this->load_rows();
    }
    public function get_analysis_wrong_quest()
    {
      $sql = "SELECT * FROM `analysis_wrong_quest` ORDER BY `analysis_wrong_quest`.`time` DESC LIMIT 6 ";

      $this->set_query($sql);
      return $this->load_rows();
    }
    public function get_class_name($class_id)
    {
        $sql = "SELECT class_name FROM classes WHERE class_id = :class_id";

        $param = [ ':class_id' => $class_id ];

        $this->set_query($sql, $param);
        return $this->load_row()->class_name;
    }

    public function get_notifications_to_student($username)
    {
        $sql = "SELECT DISTINCT student_notifications.notification_id, student_notifications.class_id, classes.class_name, notifications.username, notifications.name, notifications.notification_title, notifications.notification_content, notifications.time_sent FROM student_notifications INNER JOIN notifications ON notifications.notification_id = student_notifications.notification_id INNER JOIN classes ON classes.class_id = student_notifications.class_id WHERE notifications.username = :username ORDER BY notifications.time_sent DESC";

        $param = [ ':username' => $username ];

        $this->set_query($sql, $param);
        return $this->load_rows();
    }

    public function get_notifications_by_admin($teacher_id)
    {
        $sql = "SELECT DISTINCT * FROM notifications WHERE notification_id IN (SELECT DISTINCT notification_id FROM teacher_notifications WHERE teacher_id = :teacher_id) ORDER BY `time_sent` DESC";

        $param = [ ':teacher_id' => $teacher_id ];

        $this->set_query($sql, $param);
        return $this->load_rows();
    }

    public function insert_notification($notification_id,$username, $name, $notification_title, $notification_content)
    {
        $sql="INSERT INTO notifications (notification_id,username,name,notification_title,notification_content,time_sent) VALUES (:notification_id,:username,:name,:notification_title,:notification_content,NOW())";

        $param = [ ':notification_id' => $notification_id, ':username' => $username, ':name' => $name, ':notification_title' => $notification_title, ':notification_content' => $notification_content ];

        $this->set_query($sql, $param);
        return $this->execute_return_status();
    }

    public function notify_class($ID, $class_id)
    {
        $sql="INSERT INTO student_notifications (notification_id,class_id) VALUES (:ID,:class_id)";

        $param = [ ':ID' => $ID, ':class_id' => $class_id ];

        $this->set_query($sql, $param);
        $this->execute_return_status();
    }
    public function count_notify_class($class_id)
    {
        $sql="UPDATE students SET notification = notification + 1 WHERE class_id = :class_id";

        $param = [ ':class_id' => $class_id ];

        $this->set_query($sql, $param);
        $this->execute_return_status();
    }
    public function reset_count_notify_teacher($teacher_id)
    {
        $sql="UPDATE teachers SET notification = 0 WHERE teacher_id = :teacher_id";

        $param = [ ':teacher_id' => $teacher_id ];

        $this->set_query($sql, $param);
        $this->execute_return_status();
    }
    public function get_score($student_id)
    {
        $sql = "SELECT DISTINCT * FROM `scores`
        WHERE `student_id` = :student_id";

        $param = [ ':student_id' => $student_id ];

        $this->set_query($sql, $param);
        return $this->load_rows();
    }
    public function get_quest_of_test($test_code)
    {
        $sql = "SELECT DISTINCT * FROM `quest_of_test`
        INNER JOIN questions ON quest_of_test.question_id = questions.question_id
        WHERE test_code = :test_code";

        $param = [ ':test_code' => $test_code ];

        $this->set_query($sql, $param);
        return $this->load_rows();
    }
}
