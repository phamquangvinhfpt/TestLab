<?php

require_once('config/database.php');

class Model_Admin extends Database
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
  public function get_list_document($subject_id,$grade_id,$type)
	{
			$sql = "SELECT DISTINCT * FROM document WHERE subject_id = :subject_id AND grade_id = :grade_id AND type_id = :type";

			$param = [ ':subject_id' => $subject_id, ':grade_id' => $grade_id, ':type' => $type ];

			$this->set_query($sql, $param);
			return $this->load_rows();
	}
  public function get_list_document_all()
  {
      $sql = "SELECT DISTINCT * FROM document";

      $this->set_query($sql);
      return $this->load_rows();
  }
    public function get_diem_so()
    {
      // code...
    }

    public function check_quest_exit($question_content)
    {
        $sql = "
        SELECT question_id FROM questions WHERE question_content = '$question_content'
        ";
        $this->set_query($sql);
        return $this->load_row();
    }
    public function get_analysis_login_day()
    {
        $sql = "
        SELECT * FROM `analysis_login_day` ORDER BY `analysis_login_day`.`time` DESC LIMIT 9
        ";
        $this->set_query($sql);
        return $this->load_rows();
    }
    public function get_analysis_login_month()
    {
        $sql = "
        SELECT * FROM `analysis_login_month` ORDER BY `analysis_login_month`.`time` DESC LIMIT 9
        ";
        $this->set_query($sql);
        return $this->load_rows();
    }
    public function get_feedback()
    {
        $sql = "
        SELECT DISTINCT feedback.id ,feedback.student_id, feedback.time, feedback.content, students.avatar, students.name FROM feedback INNER JOIN students ON feedback.student_id = students.student_id ORDER BY feedback.time DESC
        ";
        $this->set_query($sql);
        return $this->load_rows();
    }
    public function get_feedback_gv()
    {
        $sql = "
        SELECT DISTINCT feedback_gv.id, feedback_gv.teacher_id, feedback_gv.time, feedback_gv.content, teachers.avatar, teachers.name FROM feedback_gv INNER JOIN teachers ON feedback_gv.teacher_id = teachers.teacher_id ORDER BY feedback_gv.time DESC
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
    public function update_quest_setting($quest_setting)
    {
      $sql="UPDATE system_setting SET level_1_a = :level_1_a, level_1_b = :level_1_b, level_2_a = :level_2_a, level_2_b = :level_2_b, level_3_a = :level_3_a, level_3_b = :level_3_b, level_4_a = :level_4_a, level_4_b = :level_4_b, quest_total_analysis = :quest_total_analysis WHERE system_setting.setting_id = 1";

      $param = [ ':level_1_a' => $quest_setting->level_1_a, ':level_1_b' => $quest_setting->level_1_b, ':level_2_a' => $quest_setting->level_2_a, ':level_2_b' => $quest_setting->level_2_b, ':level_3_a' => $quest_setting->level_3_a, ':level_3_b' => $quest_setting->level_3_b, ':level_4_a' => $quest_setting->level_4_a, ':level_4_b' => $quest_setting->level_4_b, ':quest_total_analysis' => $quest_setting->quest_total_analysis ];

      $this->set_query($sql, $param);
      return $this->execute_return_status();
    }
    public function get_admin_info($username)
    {
        $sql = "
        SELECT DISTINCT admin_id,username,avatar,email,name,last_login,birthday,permission_detail,gender_detail,genders.gender_id FROM admins
        INNER JOIN permissions ON admins.permission = permissions.permission
        INNER JOIN genders ON admins.gender_id = genders.gender_id
        WHERE username = :username";

        $param = [ ':username' => $username ];

        $this->set_query($sql, $param);
        return $this->load_row();
    }
    public function get_quest_incorrect_rank()
    {
      $sql = "SELECT DISTINCT questions.question_id, questions.question_content, subjects.subject_detail, questions.grade_id, questions.unit, quest_incorrect_rank.count, quest_incorrect_rank.total, levels.level_detail FROM `quest_incorrect_rank`
      INNER JOIN questions ON quest_incorrect_rank.question_id = questions.question_id
      INNER JOIN subjects ON questions.subject_id = subjects.subject_id
      INNER JOIN levels ON questions.level_id = levels.level_id
      ORDER BY `quest_incorrect_rank`.`count` DESC
      LIMIT 6 ";

      $this->set_query($sql);
      return $this->load_rows();
    }
    public function get_score_analysis($start,$end)
    {
      $sql = "
      SELECT COUNT(scores.score_number) AS COUNT FROM scores INNER JOIN tests ON scores.test_code = tests.test_code WHERE (score_number >= :start) AND(score_number < :end) AND (tests.test_type = 1)
      ";

      $param = [ ':start' => $start, ':end' => $end ];

      $this->set_query($sql, $param);
      return $this->load_row()->COUNT;
    }
    public function get_score_analysis_10()
    {
      $sql = "
      SELECT COUNT(scores.score_number) AS COUNT FROM scores INNER JOIN tests ON scores.test_code = tests.test_code WHERE (score_number >= 9.5) AND(score_number < 11) AND (tests.test_type = 1)
      ";
      $this->set_query($sql);
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
    public function get_analysis_wrong_quest()
    {
      $sql = "SELECT * FROM `analysis_wrong_quest` ORDER BY `analysis_wrong_quest`.`time` DESC LIMIT 6 ";

      $this->set_query($sql);
      return $this->load_rows();
    }
    public function get_teacher_info($username)
    {
        $sql = "
        SELECT DISTINCT teacher_id,username,avatar,email,name,last_login,birthday,permission_detail,gender_detail FROM teachers
        INNER JOIN permissions ON teachers.permission = permissions.permission
        INNER JOIN genders ON teachers.gender_id = genders.gender_id WHERE username = :username";

        $param = [ ':username' => $username ];

        $this->set_query($sql, $param);
        return $this->load_row();
    }
    public function get_student_info($username)
    {
        $sql = "
        SELECT DISTINCT student_id,username,name,email,avatar,birthday,last_login,gender_detail,class_name FROM `students`
        INNER JOIN classes ON students.class_id = classes.class_id
        INNER JOIN genders ON students.gender_id = genders.gender_id WHERE username = :username";

        $param = [ ':username' => $username ];

        $this->set_query($sql, $param);
        return $this->load_row();
    }
    public function get_class_info($class_name)
    {
        $sql = "
        SELECT DISTINCT class_id,class_name,name as teacher_name, detail as grade_detail FROM classes
        INNER JOIN grades ON classes.grade_id = grades.grade_id
        INNER JOIN teachers ON classes.teacher_id = teachers.teacher_id
        WHERE class_name = :class_name";

        $param = [ ':class_name' => $class_name ];

        $this->set_query($sql, $param);
        return $this->load_row();
    }
    public function get_list_admins()
    {
        $sql = "SELECT DISTINCT admin_id,username,avatar,email,name,last_login,birthday,permission_detail,gender_detail FROM admins
        INNER JOIN permissions ON admins.permission = permissions.permission
        INNER JOIN genders ON admins.gender_id = genders.gender_id";

        $this->set_query($sql);
        return $this->load_rows();
    }
    public function get_list_grades()
    {
        $sql = "SELECT DISTINCT * FROM grades";

        $this->set_query($sql);
        return $this->load_rows();
    }
    public function get_list_subjects()
    {
        $sql = "SELECT DISTINCT * FROM subjects";

        $this->set_query($sql);
        return $this->load_rows();
    }
    public function update_last_login($admin_id)
    {
        $sql="UPDATE admins set last_login = NOW() where admin_id = :admin_id";

        $param = [ ':admin_id' => $admin_id ];

        $this->set_query($sql, $param);
        $this->execute_return_status();
    }
    public function update_avatar_ao($student_id,$path)
    {
        $sql="UPDATE students SET avatar = :path WHERE student_id = :student_id";

        $param = [ ':student_id' => $student_id, ':path' => $path ];

        $this->set_query($sql, $param);
        $this->execute_return_status();
    }
    public function valid_username_or_email($data)
    {
        $sql = "SELECT DISTINCT name FROM students WHERE username = :data OR email = :data
        UNION
        SELECT DISTINCT name FROM teachers WHERE username = :data OR email = :data
        UNION
        SELECT DISTINCT name FROM admins WHERE username = :data OR email = :data";

        $param = [ ':data' => $data ];

        $this->set_query($sql, $param);
        if ($this->load_row() != '') {
            return false;
        } else {
            return true;
        }
    }
    public function valid_class_name($class_name)
    {
        $sql = "SELECT DISTINCT class_id FROM classes WHERE class_name = :class_name";

        $param = [ ':class_name' => $class_name ];

        $this->set_query($sql, $param);

        if ($this->load_row() != '') {
            return false;
        } else {
            return true;
        }
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
    public function edit_admin($admin_id, $password, $name, $gender_id, $birthday)
    {
        $sql = "SELECT DISTINCT username FROM admins WHERE admin_id = :admin_id";

        $param = [ ':admin_id' => $admin_id ];

        $this->set_query($sql, $param);
        if ($this->load_row()=='') {
            return false;
        }

        $sql="UPDATE admins set password = :password, name = :name, gender_id = :gender_id, birthday = :birthday where admin_id = :admin_id";

        $param = [ ':password' => $password, ':name' => $name, ':gender_id' => $gender_id, ':birthday' => $birthday, ':admin_id' => $admin_id ];

        $this->set_query($sql, $param);
        $this->execute_return_status();
        return true;
    }
    public function del_admin($admin_id)
    {
        $sql="DELETE FROM admins where admin_id = :admin_id";
        $param = [ ':admin_id' => $admin_id ];

        $this->set_query($sql, $param);
        $this->execute_return_status();

        $sql = "SELECT DISTINCT username FROM admins WHERE admin_id = :admin_id";
        $param = [ ':admin_id' => $admin_id ];

        $this->set_query($sql, $param);
        if ($this->load_row()!='') {
            return false;
        }
        return true;
    }
    public function del_document($document_id)
    {
        $sql="DELETE FROM document where id = :document_id";
        $param = [ ':document_id' => $document_id ];

        $this->set_query($sql, $param);
        $this->execute_return_status();

        $sql = "SELECT DISTINCT doc_name FROM document WHERE id = :document_id";
        $param = [ ':document_id' => $document_id ];

        $this->set_query($sql, $param);
        if ($this->load_row()!='') {
            return false;
        }
        return true;
    }
    public function delete_feedback_hs($id)
    {
        $sql="DELETE FROM feedback where id = :id";
        $param = [ ':id' => $id ];

        $this->set_query($sql, $param);
        $this->execute_return_status();

        $sql = "SELECT DISTINCT content FROM feedback WHERE id = :id";
        $param = [ ':id' => $id ];

        $this->set_query($sql, $param);
        if ($this->load_row()!='') {
            return false;
        }
        return true;
    }
    public function delete_feedback_gv($id)
    {
        $sql="DELETE FROM feedback_gv where id = :id";
        $param = [ ':id' => $id ];

        $this->set_query($sql, $param);
        $this->execute_return_status();

        $sql = "SELECT DISTINCT content FROM feedback_gv WHERE id = :id";
        $param = [ ':id' => $id ];

        $this->set_query($sql, $param);
        if ($this->load_row()!='') {
            return false;
        }
        return true;
    }
    public function add_admin($name, $username, $password, $email, $birthday, $gender)
    {
        $sql = "SELECT DISTINCT admin_id FROM admins WHERE username = :username OR email = :email";

        $param = [ ':username' => $username, ':email' => $email ];

        $this->set_query($sql, $param);
        if ($this->load_row()!='') {
            return false;
        }

        //reset AUTO_INCREMENT
        $sql = "ALTER TABLE `admins` AUTO_INCREMENT=1";

        $this->set_query($sql);
        $this->execute_return_status();

        $sql="INSERT INTO admins (name, username, password, email, birthday, gender_id) VALUES (:name, :username, :password, :email, :birthday, :gender)";

        $param = [ ':username' => $username, ':password' => $password, ':name' => $name, ':email' => $email, ':birthday' => $birthday, ':gender' => $gender ];

        $this->set_query($sql, $param);
        return $this->execute_return_status();
        // return true;
    }
    public function get_list_teachers()
    {
        $sql = "SELECT DISTINCT teacher_id,username,avatar,email,name,last_login,birthday,permission_detail,gender_detail FROM teachers
        INNER JOIN permissions ON teachers.permission = permissions.permission
        INNER JOIN genders ON teachers.gender_id = genders.gender_id";

        $this->set_query($sql);
        return $this->load_rows();
    }
    public function edit_teacher($teacher_id, $password, $name, $gender_id, $birthday)
    {
        $sql = "SELECT DISTINCT username FROM teachers WHERE teacher_id = :teacher_id";

        $param = [ ':teacher_id' => $teacher_id ];

        $this->set_query($sql, $param);
        if ($this->load_row()=='') {
            return false;
        }

        $sql="UPDATE teachers set password = :password, name = :name, gender_id = :gender_id, birthday = :birthday where teacher_id = :teacher_id";

        $param = [ ':password' => $password, ':name' => $name, ':gender_id' => $gender_id, ':birthday' => $birthday, ':teacher_id' => $teacher_id ];

        $this->set_query($sql, $param);
        $this->execute_return_status();
        return true;
    }
    public function del_teacher($teacher_id)
    {
        $sql="DELETE FROM teacher_notifications where teacher_id = :teacher_id";
        $param = [ ':teacher_id' => $teacher_id ];

        $this->set_query($sql, $param);
        $this->execute_return_status();

        $sql="DELETE FROM teachers where teacher_id = :teacher_id";
        $param = [ ':teacher_id' => $teacher_id ];

        $this->set_query($sql, $param);
        $this->execute_return_status();

        $sql = "SELECT DISTINCT username FROM teachers WHERE teacher_id = :teacher_id";
        $param = [ ':teacher_id' => $teacher_id ];

        $this->set_query($sql, $param);
        if ($this->load_row()!='') {
            return false;
        }
        return true;
    }
    public function add_teacher($name, $username, $password, $email, $birthday, $gender)
    {
        $sql = "SELECT DISTINCT teacher_id FROM teachers WHERE username = :username or email = :email";

        $param = [ ':username' => $username, ':email' => $email ];

        $this->set_query($sql, $param);
        if ($this->load_row()!='') {
            return false;
        }

        //reset AUTO_INCREMENT
        $sql = "ALTER TABLE `teachers` AUTO_INCREMENT=1";

        $this->set_query($sql);
        $this->execute_return_status();

        $sql="INSERT INTO teachers (username,password,name,email,birthday,gender_id) VALUES (:username,:password,:name,:email,:birthday,:gender)";

        $param = [ ':username' => $username, ':password' => $password, ':name' => $name, ':email' => $email, ':birthday' => $birthday, ':gender' => $gender ];

        $this->set_query($sql, $param);
        return $this->execute_return_status();
    }
    public function get_list_students($column_order, $sort_order, $start, $offset)
    {
        $sql = "
        SELECT DISTINCT student_id,username,name,email,avatar,birthday,last_login,gender_detail,class_name FROM `students`
        INNER JOIN classes ON students.class_id = classes.class_id
        INNER JOIN genders ON students.gender_id = genders.gender_id
        ORDER BY $column_order $sort_order LIMIT $start, $offset";

        $this->set_query($sql);
        return $this->load_rows();
    }
    public function get_list_students_all()
    {
        $sql = "
        SELECT DISTINCT student_id,username,name,email,avatar,birthday,last_login,gender_detail,class_name FROM `students`
        INNER JOIN classes ON students.class_id = classes.class_id
        INNER JOIN genders ON students.gender_id = genders.gender_id
        ";

        $this->set_query($sql);
        return $this->load_rows();
    }
    public function get_list_students_search($keyword, $column_order, $sort_order, $start, $offset)
    {
        $sql = "
        SELECT DISTINCT student_id,username,name,email,avatar,birthday,last_login,gender_detail,class_name FROM `students`
        INNER JOIN classes ON students.class_id = classes.class_id
        INNER JOIN genders ON students.gender_id = genders.gender_id
        WHERE students.student_id LIKE '%$keyword%' OR students.username LIKE '%$keyword%' OR students.name LIKE '%$keyword%' OR students.email LIKE '%$keyword%' OR students.birthday LIKE '%$keyword%' OR genders.gender_detail LIKE '%$keyword%' OR classes.class_name LIKE '%$keyword%'
        ORDER BY students.$column_order $sort_order LIMIT $start, $offset";

        $this->set_query($sql);
        return $this->load_rows();
    }
    public function get_total_students_search($keyword)
    {
        $sql = "SELECT DISTINCT count(students.student_id) as total FROM `students`
        INNER JOIN classes ON students.class_id = classes.class_id
        INNER JOIN genders ON students.gender_id = genders.gender_id
        WHERE students.student_id LIKE '%$keyword%' OR students.username LIKE '%$keyword%' OR students.name LIKE '%$keyword%' OR students.email LIKE '%$keyword%' OR students.birthday LIKE '%$keyword%' OR genders.gender_detail LIKE '%$keyword%' OR classes.class_name LIKE '%$keyword%'";

        $this->set_query($sql);
        return $this->load_row()->total;
    }
    public function edit_student($student_id, $birthday, $password, $name, $class_id, $gender)
    {
        $sql="UPDATE students set birthday = :birthday, password = :password, name = :name, class_id = :class_id, gender_id = :gender where student_id = :student_id";

        $param = [ ':student_id' => $student_id, ':birthday' => $birthday, ':password' => $password, ':name' => $name, ':class_id' => $class_id, ':gender' => $gender ];

        $this->set_query($sql, $param);
        $this->execute_return_status();

        $sql="UPDATE scores set class_id = :class_id where student_id = :student_id";

        $param = [ ':class_id' => $class_id, ':student_id' => $student_id ];

        $this->set_query($sql, $param);
        $this->execute_return_status();
    }
    public function del_student($student_id)
    {
        $sql="DELETE FROM scores where student_id = :student_id";
        $param = [ ':student_id' => $student_id ];

        $this->set_query($sql, $param);
        $this->execute_return_status();

        $sql="DELETE FROM students where student_id = :student_id";
        $param = [ ':student_id' => $student_id ];

        $this->set_query($sql, $param);
        $this->execute_return_status();

        $sql = "SELECT DISTINCT username FROM students WHERE student_id = :student_id";
        $param = [ ':student_id' => $student_id ];

        $this->set_query($sql, $param);
        if ($this->load_row()!='') {
            return false;
        }
        return true;
    }
    public function add_student($username, $password, $name, $class_id, $email, $birthday, $gender)
    {
        $sql = "SELECT DISTINCT student_id FROM students WHERE username = :username OR email = :email";

        $param = [ ':username' => $username, ':email' => $email ];

        $this->set_query($sql, $param);
        if ($this->load_row()!='') {
            return false;
        }

        //reset AUTO_INCREMENT
        $sql = "ALTER TABLE `students` AUTO_INCREMENT=1";

        $this->set_query($sql);
        $this->execute_return_status();

        $sql="INSERT INTO students (username,password,name,class_id,email,birthday,gender_id) VALUES (:username,:password,:name,:class_id,:email,:birthday,:gender)";

        $param = [ ':username' => $username, ':password' => $password, ':name' => $name, ':class_id' => $class_id, ':email' => $email, ':birthday' => $birthday, ':gender' => $gender ];

        $this->set_query($sql, $param);
        return $this->execute_return_status();
        // return true;
    }
    public function get_list_classes()
    {
        $sql = "
        SELECT DISTINCT class_id,class_name,avatar,name as teacher_name, detail as grade_detail FROM classes
        INNER JOIN grades ON classes.grade_id = grades.grade_id
        INNER JOIN teachers ON classes.teacher_id = teachers.teacher_id";

        $this->set_query($sql);
        return $this->load_rows();
    }
    public function get_list_units($grade_id,$subject_id)
    {
        $sql = "SELECT DISTINCT unit, COUNT(unit) as total FROM questions WHERE subject_id = :subject_id and grade_id = :grade_id GROUP BY unit";

        $param = [ ':grade_id' => $grade_id, ':subject_id' => $subject_id ];

        $this->set_query($sql, $param);
        return $this->load_rows();
    }
    public function get_list_levels_of_unit($grade_id, $subject_id,$unit)
    {
        $sql = "SELECT DISTINCT level_detail,questions.level_id, COUNT(questions.level_id) as total FROM questions
        INNER JOIN levels ON levels.level_id = questions.level_id
        WHERE subject_id = :subject_id and grade_id = :grade_id and unit = :unit GROUP BY questions.level_id";

        $param = [ ':grade_id' => $grade_id, ':subject_id' => $subject_id, ':unit' => $unit ];

        $this->set_query($sql, $param);
        return $this->load_rows();
    }
    public function list_quest_of_unit($grade_id,$subject_id,$unit,$level_id,$limit)
    {
        $sql = "SELECT DISTINCT * FROM questions WHERE grade_id = :grade_id and subject_id = :subject_id and unit = :unit and level_id = :level_id ORDER BY RAND() LIMIT $limit";

        $param = [ ':grade_id' => $grade_id, ':subject_id' => $subject_id, ':unit' => $unit, ':level_id' => $level_id ];

        $this->set_query($sql, $param);
        return $this->load_rows();
    }
    public function edit_class($class_id, $grade_id, $class_name, $teacher_id)
    {
        $sql="UPDATE classes set grade_id = :grade_id, class_name = :class_name, teacher_id = :teacher_id where class_id = :class_id";

        $param = [ ':class_id' => $class_id, ':grade_id' => $grade_id, ':class_name' => $class_name, ':teacher_id' => $teacher_id ];

        $this->set_query($sql, $param);
        $this->execute_return_status();
    }
    public function toggle_test_status($test_code, $status_id)
    {
        $sql="UPDATE tests set status_id = :status_id where test_code = :test_code";

        $param = [ ':test_code' => $test_code, ':status_id' => $status_id ];

        $this->set_query($sql, $param);
        return $this->execute_return_status();
    }
    public function del_class($class_id)
    {
        $sql="DELETE FROM chats where class_id = :class_id";

        $param = [ ':class_id' => $class_id ];

        $this->set_query($sql, $param);
        $this->execute_return_status();

        $sql="DELETE FROM student_notifications where class_id = :class_id";

        $param = [ ':class_id' => $class_id ];

        $this->set_query($sql, $param);
        $this->execute_return_status();

        $sql="DELETE FROM classes where class_id = :class_id";

        $param = [ ':class_id' => $class_id ];

        $this->set_query($sql, $param);
        $this->execute_return_status();

        $sql = "SELECT DISTINCT class_name FROM classes WHERE class_id = :class_id";

        $param = [ ':class_id' => $class_id ];

        $this->set_query($sql, $param);
        if ($this->load_row()!='') {
            return false;
        }
        return true;
    }
    public function add_class($grade_id, $class_name, $teacher_id)
    {
        $sql = "SELECT DISTINCT class_id FROM classes WHERE class_name = :class_name";

        $param = [ ':class_name' => $class_name ];

        $this->set_query($sql, $param);
        if ($this->load_row()!='') {
            return false;
        }

        //reset AUTO_INCREMENT
        $sql = "ALTER TABLE `classes` AUTO_INCREMENT=1";

        $this->set_query($sql);
        $this->execute_return_status();

        $sql="INSERT INTO classes (grade_id,class_name,teacher_id) VALUES (:grade_id,:class_name,:teacher_id)";

        $param = [ ':grade_id' => $grade_id, ':class_name' => $class_name, ':teacher_id' => $teacher_id ];

        $this->set_query($sql, $param);
        return $this->execute_return_status();
        // return true;
    }
    public function add_quest_to_test($test_code, $question_id)
    {
        $sql="INSERT INTO quest_of_test (test_code, question_id) VALUES (:test_code, :question_id)";

        $param = [ ':test_code' => $test_code, ':question_id' => $question_id ];

        $this->set_query($sql, $param);
        return $this->execute_return_status();
    }
    public function get_list_questions($column_order, $sort_order, $start, $offset)
    {
        $sql = "
        SELECT DISTINCT questions.question_id,questions.question_content,questions.unit,grades.detail as grade_detail, questions.answer_a,questions.answer_b,questions.answer_c,questions.answer_d,questions.correct_answer,subjects.subject_detail,levels.level_detail FROM `questions`
        INNER JOIN grades ON grades.grade_id = questions.grade_id
        INNER JOIN levels ON levels.level_id = questions.level_id
        INNER JOIN subjects ON subjects.subject_id = questions.subject_id
        ORDER BY $column_order $sort_order LIMIT $start, $offset";

        $this->set_query($sql);
        return $this->load_rows();
    }
    public function get_list_questions_selected($subject_id, $grade_id, $unit, $level_id, $column_order, $sort_order, $start, $offset)
    {
      $sql = "
      SELECT DISTINCT DISTINCT questions.question_id, questions.question_content, questions.unit, grades.detail AS grade_detail, grades.grade_id, questions.answer_a, questions.answer_b, questions.answer_c, questions.answer_d, questions.correct_answer, subjects.subject_detail, subjects.subject_id, levels.level_detail, levels.level_id FROM `questions`
      INNER JOIN grades ON grades.grade_id = questions.grade_id
      INNER JOIN levels ON levels.level_id = questions.level_id
      INNER JOIN subjects ON subjects.subject_id = questions.subject_id
      WHERE
      subjects.subject_id = '$subject_id'
      AND grades.grade_id = '$grade_id'
      AND questions.unit = '$unit'
      AND levels.level_id = '$level_id'
      ORDER BY $column_order $sort_order LIMIT $start, $offset";

      $this->set_query($sql);
      return $this->load_rows();
    }
    public function get_total_questions_selected($subject_id, $grade_id, $unit, $level_id)
    {
        $sql = "
        SELECT DISTINCT count(questions.question_id) as total FROM `questions`
        INNER JOIN grades ON grades.grade_id = questions.grade_id
        INNER JOIN levels ON levels.level_id = questions.level_id
        INNER JOIN subjects ON subjects.subject_id = questions.subject_id
        WHERE
        subjects.subject_id = '$subject_id'
        AND grades.grade_id = '$grade_id'
        AND questions.unit = '$unit'
        AND levels.level_id = '$level_id'
        ";

        $this->set_query($sql);
        return $this->load_row()->total;
    }
    public function get_list_questions_selected_search($subject_id, $grade_id, $unit, $level_id, $keyword, $column_order, $sort_order, $start, $offset)
    {
      $sql = "
      SELECT DISTINCT questions.question_id,questions.question_content,questions.unit,grades.detail as grade_detail, questions.answer_a,questions.answer_b,questions.answer_c,questions.answer_d,questions.correct_answer,subjects.subject_detail,levels.level_detail FROM `questions`
      INNER JOIN grades ON grades.grade_id = questions.grade_id
      INNER JOIN levels ON levels.level_id = questions.level_id
      INNER JOIN subjects ON subjects.subject_id = questions.subject_id
      WHERE
      subjects.subject_id = '$subject_id'
      AND grades.grade_id = '$grade_id'
      AND questions.unit = '$unit'
      AND levels.level_id = '$level_id'
      AND (questions.question_id LIKE '%$keyword%'
      OR questions.question_content LIKE '%$keyword%'
      OR questions.answer_a LIKE '%$keyword%'
      OR questions.answer_b LIKE '%$keyword%'
      OR questions.answer_c LIKE '%$keyword%'
      OR questions.answer_d LIKE '%$keyword%'
      OR questions.correct_answer LIKE '%$keyword%'
      )
      ORDER BY $column_order $sort_order LIMIT $start, $offset";

      $this->set_query($sql);
      return $this->load_rows();
    }
    public function get_total_questions_selected_search($subject_id, $grade_id, $unit, $level_id, $keyword)
    {
        $sql = "
        SELECT DISTINCT count(questions.question_id) as total FROM `questions`
        INNER JOIN grades ON grades.grade_id = questions.grade_id
        INNER JOIN levels ON levels.level_id = questions.level_id
        INNER JOIN subjects ON subjects.subject_id = questions.subject_id
        WHERE
        subjects.subject_id = '$subject_id'
        AND grades.grade_id = '$grade_id'
        AND questions.unit = '$unit'
        AND levels.level_id = '$level_id'
        AND (questions.question_id LIKE '%$keyword%'
        OR questions.question_content LIKE '%$keyword%'
        OR questions.answer_a LIKE '%$keyword%'
        OR questions.answer_b LIKE '%$keyword%'
        OR questions.answer_c LIKE '%$keyword%'
        OR questions.answer_d LIKE '%$keyword%'
        OR questions.correct_answer LIKE '%$keyword%'
        )
        ";

        $this->set_query($sql);
        return $this->load_row()->total;
    }
    public function get_list_questions_search($keyword, $column_order, $sort_order, $start, $offset)
    {
        $sql = "
        SELECT DISTINCT questions.question_id,questions.question_content,questions.unit,grades.detail as grade_detail, questions.answer_a,questions.answer_b,questions.answer_c,questions.answer_d,questions.correct_answer,subjects.subject_detail,levels.level_detail FROM `questions`
        INNER JOIN grades ON grades.grade_id = questions.grade_id
        INNER JOIN levels ON levels.level_id = questions.level_id
        INNER JOIN subjects ON subjects.subject_id = questions.subject_id
        WHERE
        questions.question_id LIKE '%$keyword%'
        OR questions.question_content LIKE '%$keyword%'
        OR questions.unit LIKE '%$keyword%'
        OR grades.detail LIKE '%$keyword%'
        OR questions.answer_a LIKE '%$keyword%'
        OR questions.answer_b LIKE '%$keyword%'
        OR questions.answer_c LIKE '%$keyword%'
        OR questions.answer_d LIKE '%$keyword%'
        OR questions.correct_answer LIKE '%$keyword%'
        OR subjects.subject_detail LIKE '%$keyword%'
        OR levels.level_detail LIKE '%$keyword%'
        ORDER BY $column_order $sort_order LIMIT $start, $offset";

        $this->set_query($sql);
        return $this->load_rows();
    }
    public function get_total_questions_search($keyword)
    {
        $sql = "
        SELECT DISTINCT count(questions.question_id) as total FROM `questions`
        INNER JOIN grades ON grades.grade_id = questions.grade_id
        INNER JOIN levels ON levels.level_id = questions.level_id
        INNER JOIN subjects ON subjects.subject_id = questions.subject_id
        WHERE questions.question_id LIKE '%$keyword%' OR questions.question_content LIKE '%$keyword%' OR questions.unit LIKE '%$keyword%' OR grades.detail LIKE '%$keyword%' OR questions.answer_a LIKE '%$keyword%' OR questions.answer_b LIKE '%$keyword%' OR questions.answer_c LIKE '%$keyword%' OR questions.answer_d LIKE '%$keyword%' OR questions.correct_answer LIKE '%$keyword%' OR subjects.subject_detail LIKE '%$keyword%' OR levels.level_detail LIKE '%$keyword%'";

        $this->set_query($sql);
        return $this->load_row()->total;
    }
    public function get_list_tests()
    {
        $sql = "
        SELECT DISTINCT tests.test_code,tests.test_name,tests.test_type,tests.password,teachers.name AS created_by,tests.total_questions,tests.time_to_do,tests.note,tests.timest,grades.detail as grade,subjects.subject_detail,statuses.status_id,statuses.detail as status FROM `tests`
        INNER JOIN grades ON grades.grade_id = tests.grade_id
        INNER JOIN subjects ON subjects.subject_id = tests.subject_id
        INNER JOIN statuses ON statuses.status_id = tests.status_id
        INNER JOIN teachers ON teachers.teacher_id = tests.created_by
        WHERE test_type=1";

        $this->set_query($sql);
        return $this->load_rows();
    }
    public function get_list_courses()
    {
        $sql = "
        SELECT DISTINCT tests.test_code,tests.timest,tests.test_name,teachers.name AS created_by,tests.test_type,tests.password,tests.total_questions,tests.time_to_do,tests.note,grades.detail as grade,subjects.subject_detail,statuses.status_id,statuses.detail as status FROM `tests`
        INNER JOIN grades ON grades.grade_id = tests.grade_id
        INNER JOIN subjects ON subjects.subject_id = tests.subject_id
        INNER JOIN statuses ON statuses.status_id = tests.status_id
        INNER JOIN teachers ON teachers.teacher_id = tests.created_by
        WHERE test_type=2";

        $this->set_query($sql);
        return $this->load_rows();
    }
    public function get_list_examine()
    {
        $sql = "
        SELECT DISTINCT tests.test_code,tests.test_name,tests.test_type,tests.password,tests.total_questions,tests.time_to_do,tests.note,grades.detail as grade,subjects.subject_detail,statuses.status_id,statuses.detail as status FROM `tests`
        INNER JOIN grades ON grades.grade_id = tests.grade_id
        INNER JOIN subjects ON subjects.subject_id = tests.subject_id
        INNER JOIN statuses ON statuses.status_id = tests.status_id
        WHERE test_type=3";

        $this->set_query($sql);
        return $this->load_rows();
    }
    public function get_question($question_id)
    {
        $sql = "
        SELECT * FROM `questions` WHERE question_id = :question_id";

        $param = [ ':question_id' => $question_id ];

        $this->set_query($sql, $param);
        return $this->load_row();
    }
    public function get_list_statuses()
    {
        $sql = "
        SELECT DISTINCT * FROM `statuses`";

        $this->set_query($sql);
        return $this->load_rows();
    }
    public function edit_question($question_id,$subject_id, $question_content, $grade_id, $unit, $answer_a, $answer_b, $answer_c, $answer_d, $correct_answer,$level_id,$huong_dan)
    {
        $sql="UPDATE questions set question_content = :question_content, grade_id = :grade_id, unit = :unit, answer_a = :answer_a, answer_b = :answer_b, answer_c = :answer_c, answer_d = :answer_d, correct_answer = :correct_answer, subject_id = :subject_id, level_id = :level_id, huong_dan = :huong_dan where question_id = :question_id";

        $param = [ ':question_id' => $question_id, ':subject_id' => $subject_id, ':question_content' => $question_content, ':grade_id' => $grade_id, ':unit' => $unit, ':answer_a' => $answer_a, ':answer_b' => $answer_b, ':answer_c' => $answer_c, ':answer_d' => $answer_d, ':correct_answer' => $correct_answer, ':level_id' => $level_id, ':huong_dan' => $huong_dan ];

        $this->set_query($sql, $param);
        return $this->execute_return_status();
    }
    public function del_question($question_id)
    {
        $sql="DELETE FROM questions where question_id = :question_id";

        $param = [ ':question_id' => $question_id ];

        $this->set_query($sql, $param);
        return $this->execute_return_status();
    }
    public function add_question($subject_id,$question_detail, $grade_id, $unit, $answer_a, $answer_b, $answer_c, $answer_d, $correct_answer,$level_id,$sent_by,$huong_dan)
    {
        $sql="INSERT INTO questions (huong_dan,subject_id,grade_id,unit,question_content,answer_a,answer_b,answer_c,answer_d,correct_answer,level_id,sent_by,status_id) VALUES (:huong_dan,:subject_id,:grade_id,:unit,:question_detail,:answer_a,:answer_b,:answer_c,:answer_d,:correct_answer,:level_id,:sent_by,4)";

        $param = [ ':huong_dan' => $huong_dan, ':subject_id' => $subject_id, ':question_detail' => $question_detail, ':grade_id' => $grade_id, ':unit' => $unit, ':answer_a' => $answer_a, ':answer_b' => $answer_b, ':answer_c' => $answer_c, ':answer_d' => $answer_d, ':correct_answer' => $correct_answer, ':level_id' => $level_id, ':sent_by' => $sent_by ];

        $this->set_query($sql, $param);
        return $this->execute_return_status();
    }
    public function add_document($doc_name, $grade_id, $subject_id, $note, $doc_path, $type_id)
    {
        $sql="INSERT INTO document (doc_name,doc_path,grade_id,subject_id,note,type_id) VALUES (:doc_name,:doc_path,:grade_id,:subject_id,:note,:type_id)";

        $param = [ ':doc_name' => $doc_name, ':doc_path' => $doc_path, ':grade_id' => $grade_id, ':subject_id' => $subject_id, ':note' => $note, ':type_id' => $type_id ];

        $this->set_query($sql, $param);
        return $this->execute_return_status();
    }
    public function upload_file_data_messenger($uploader,$file_name)
    {
        $sql="INSERT INTO file_upload (uploader,file_name) VALUES (:uploader,:file_name)";

        $param = [ ':uploader' => $uploader, ':file_name' => $file_name ];

        $this->set_query($sql, $param);
        return $this->execute_return_status();
    }
    public function add_test($teacher_id, $test_code, $test_name, $test_type, $password, $grade_id, $subject_id, $total_questions, $time_to_do, $note)
    {
        $sql="INSERT INTO tests (created_by,test_code,test_name,test_type,password,grade_id,subject_id,total_questions,time_to_do,note,status_id) VALUES (:created_by,:test_code,:test_name,:test_type,:password,:grade_id,:subject_id,:total_questions,:time_to_do,:note, 2)";

        $param = [ ':created_by' => $teacher_id, ':test_code' => $test_code, ':test_name' => $test_name, ':test_type' => $test_type, ':password' => $password, ':grade_id' => $grade_id, ':subject_id' => $subject_id, ':total_questions' => $total_questions, ':time_to_do' => $time_to_do, ':note' => $note ];

        $this->set_query($sql, $param);
        return $this->execute_return_status();
    }
    public function insert_notification($notification_id,$username, $name, $notification_title, $notification_content)
    {
        $sql="INSERT INTO notifications (notification_id,username,name,notification_title,notification_content,time_sent) VALUES ($notification_id,'$username','$name','$notification_title','$notification_content',NOW())";

        $param = [ ':notification_id' => $notification_id, ':username' => $username, ':name' => $name, ':notification_title' => $notification_title, ':notification_content' => $notification_content ];

        $this->set_query($sql, $param);
        return $this->execute_return_status();
    }
    public function notify_teacher($ID, $teacher_id)
    {
        $sql="INSERT INTO teacher_notifications (notification_id,teacher_id) VALUES (:ID,:teacher_id)";

        $param = [ ':ID' => $ID, ':teacher_id' => $teacher_id ];

        $this->set_query($sql, $param);
        $this->execute_return_status();
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
    public function count_notify_teacher($teacher_id)
    {
        $sql="UPDATE teachers SET notification = notification + 1 WHERE teacher_id = :teacher_id";

        $param = [ ':teacher_id' => $teacher_id ];

        $this->set_query($sql, $param);
        $this->execute_return_status();
    }
    public function get_teacher_notifications()
    {
        $sql = "
        SELECT DISTINCT notifications.notification_id, notifications.notification_title, notifications.notification_content, notifications.username,notifications.name,teachers.name as receive_name,teachers.username as receive_username,notifications.time_sent FROM teacher_notifications
        INNER JOIN notifications ON notifications.notification_id = teacher_notifications.notification_id
        INNER JOIN teachers ON teachers.teacher_id = teacher_notifications.teacher_id
        ORDER BY `ID` DESC";

        $this->set_query($sql);
        return $this->load_rows();
    }
    public function get_student_notifications()
    {
        $sql = "
        SELECT DISTINCT notifications.notification_id, notifications.notification_title, notifications.notification_content, notifications.username,notifications.name,classes.class_name,notifications.time_sent FROM student_notifications
        INNER JOIN notifications ON notifications.notification_id = student_notifications.notification_id
        INNER JOIN classes ON classes.class_id = student_notifications.class_id
        ORDER BY `ID` DESC";

        $this->set_query($sql);
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
    public function update_profiles($username, $name, $email, $password, $gender, $birthday)
    {
        $sql="UPDATE admins set email = :email, password = :password, name = :name, gender_id = :gender, birthday = :birthday where username = :username";

        $param = [ ':username' => $username, ':name' => $name, ':email' => $email, ':password' => $password, ':gender' => $gender, ':birthday' => $birthday ];

        $this->set_query($sql, $param);
        $this->execute_return_status();
        return true;
    }
    public function update_avatar($avatar, $username)
    {
        $sql="UPDATE admins set avatar = :avatar where username = :username";

        $param = [ ':avatar' => $avatar, ':username' => $username ];

        $this->set_query($sql, $param);
        $this->execute_return_status();
    }
    public function get_total_login()
    {
        $sql = "SELECT SUM(count) AS total FROM analysis_login_month";

        $this->set_query($sql);
        return $this->load_row()->total;
    }
    public function get_total_student()
    {
        $sql = "SELECT DISTINCT COUNT(student_id) as total FROM students";

        $this->set_query($sql);
        return $this->load_row()->total;
    }
    public function get_total_admin()
    {
        $sql = "SELECT DISTINCT  COUNT(admin_id) as total FROM admins";

        $this->set_query($sql);
        return $this->load_row()->total;
    }
    public function get_total_teacher()
    {
        $sql = "SELECT DISTINCT  COUNT(teacher_id) as total FROM teachers";

        $this->set_query($sql);
        return $this->load_row()->total;
    }
    public function get_total_class()
    {
        $sql = "SELECT DISTINCT COUNT(class_id) as total FROM classes";

        $this->set_query($sql);
        return $this->load_row()->total;
    }
    public function get_total_subject()
    {
        $sql = "SELECT DISTINCT COUNT(subject_id) as total FROM subjects";

        $this->set_query($sql);
        return $this->load_row()->total;
    }
    public function get_total_question()
    {
        $sql = "SELECT DISTINCT COUNT(question_id) as total FROM questions";

        $this->set_query($sql);
        return $this->load_row()->total;
    }
    public function get_total_grade()
    {
        $sql = "SELECT DISTINCT COUNT(grade_id) as total FROM grades";

        $this->set_query($sql);
        return $this->load_row()->total;
    }
    public function get_total_test()
    {
        $sql = "SELECT DISTINCT COUNT(test_code) as total FROM tests";

        $this->set_query($sql);
        return $this->load_row()->total;
    }
    public function edit_subject($subject_id, $subject_detail)
    {
        $sql = "SELECT DISTINCT subject_detail FROM subjects WHERE subject_id = :subject_id";

        $param = [ ':subject_id' => $subject_id ];

        $this->set_query($sql, $param);
        if ($this->load_row()=='') {
            return false;
        }

        $sql="UPDATE subjects set subject_detail = :subject_detail where subject_id = :subject_id";

        $param = [ ':subject_detail' => $subject_detail, ':subject_id' => $subject_id ];

        $this->set_query($sql, $param);
        return $this->execute_return_status();
    }
    public function del_subject($subject_id)
    {
        $sql="DELETE FROM subjects where subject_id = :subject_id";

        $param = [ ':subject_id' => $subject_id ];

        $this->set_query($sql, $param);
        return $this->execute_return_status();
    }
    public function add_subject($subject_detail)
    {
        $sql="INSERT INTO subjects (subject_detail) VALUES (:subject_detail)";

        $param = [ ':subject_detail' => $subject_detail ];

        $this->set_query($sql, $param);
        return $this->execute_return_status();
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
