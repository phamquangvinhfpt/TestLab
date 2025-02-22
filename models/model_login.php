<?php

require_once ('config/database.php');

class Model_Login extends Database
{

    /**
     * @return object [username, name from students or teachers or admins]
     * Call by Controller_Login > get_username()
     * Reference in Controller_Login > submit_login()
     */

    public function get_username($username)
    {
        $sql = "SELECT DISTINCT username, name FROM students WHERE username = :username OR email = :username
        UNION
        SELECT DISTINCT username, name FROM teachers WHERE username = :username OR email = :username
        UNION
        SELECT DISTINCT username, name FROM admins WHERE username = :username OR email = :username";

        $param = [ ':username' => $username];

        $this->set_query($sql, $param);
        return $this->load_row();
    }

    /**
     * @return object [permission, password from students or teachers or admins]
     * Call by Controller_Login > get_password()
     * Reference in Controller_Login > submit_password()
     */

    public function get_password($username)
    {
        $sql = "SELECT DISTINCT permission,password FROM students WHERE username = :username OR email = :username
        UNION
        SELECT DISTINCT permission,password FROM teachers WHERE username = :username OR email = :username
        UNION
        SELECT DISTINCT permission,password FROM admins WHERE username = :username OR email = :username";

        $param = [ ':username' => $username];

        $this->set_query($sql, $param);
        return $this->load_row();
    }

    /**
     * @return object [name, email, permission [, password] from students or teachers or admins]
     * if username or email is exist, else
     * @return boolean false
     * Call by Controller_Login > reset_password()
     * Reference in Controller_Login > submit_forgot_password()
     * $get->password, $get->permission will use on update_new_password()
     */

    public function reset_password($username)
    {
        $sql = "SELECT DISTINCT name,email,permission FROM students WHERE username = :username OR email = :username
        UNION
        SELECT DISTINCT name,email,permission FROM teachers WHERE username = :username OR email = :username
        UNION
        SELECT DISTINCT name,email,permission FROM admins WHERE username = :username OR email = :username";

        $param = [ ':username' => $username];

        $this->set_query($sql, $param);
        $get = $this->load_row();
        if ($get) {
            $password = rand(10000000, 99999999);
            $get->password = $password;
            if ($get->permission==1) {
                $get->permission = 'admins';
            }
            if ($get->permission==2) {
                $get->permission = 'teachers';
            }
            if ($get->permission==3) {
                $get->permission = 'students';
            }
            return $get;
        } else {
            return false;
        }
    }

    /**
     * @return boolean
     * Call by Controller_Login > submit_forgot_password()
     */

    public function update_new_password($password, $permission, $username)
    {
        $sql = "UPDATE :permission SET password = :password WHERE username = :username OR email = :username";

        $param = [ ':username' => $username, ':password' => $password, ':permission' => $permission];

        $this->set_query($sql, $param);
        return $this->execute_return_status();
    }

    public function update_count_login_month($analysis_time)
    {
        $sql = "INSERT INTO analysis_login_month( time, count ) VALUES(:analysis_time, count +1 ) ON DUPLICATE KEY UPDATE count = count +1 ";

        $param = [ ':analysis_time' => $analysis_time ];

        $this->set_query($sql, $param);
        return $this->execute_return_status();
    }
    public function update_count_login_day($analysis_time)
    {
        $sql = "INSERT INTO analysis_login_day( time, count ) VALUES(:analysis_time, count +1 ) ON DUPLICATE KEY UPDATE count = count +1 ";

        $param = [ ':analysis_time' => $analysis_time ];

        $this->set_query($sql, $param);
        return $this->execute_return_status();
    }
    public function set_session_active($username)
    {
        $session_active = session_id();
        $sql = "UPDATE students SET session_active = :session_active WHERE username = :username OR email = :username";

        $param = [ ':username' => $username, ':session_active' => $session_active];

        $this->set_query($sql, $param);
        return $this->execute_return_status();
    }
}
