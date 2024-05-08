<?php

class View_Teacher
{
    public function show_head_left($info)
    {
        require_once 'config/config.php';
        include 'res/templates/teacher/head_left.php';
    }
    public function show_dashboard($class)
    {
        include 'res/templates/teacher/dashboard.php';
    }
    public function show_tests_detail($questions)
    {
        include 'res/templates/admin/tests_detail.php';
    }
    public function show_custom_create_test()
    {
        include 'res/templates/teacher/custom_create_test.php';
    }
    public function show_class_detail($class_name, $students)
    {
        include 'res/templates/teacher/class_detail.php';
    }
    public function show_cau_hoi_chon_sai($analysis,$setting)
    {
        include 'res/templates/admin/cau_hoi_chon_sai.php';
    }
    public function show_create_test()
    {
        include 'res/templates/teacher/create_test.php';
    }
    public function show_diem_so($data)
    {
        include 'res/templates/teacher/diem_so.php';
    }
    public function show_diem_hs($data,$student)
    {
        include 'res/templates/teacher/diem_hs.php';
    }
    public function show_messenger()
    {
        include 'res/templates/shared/messenger.php';
    }
    public function show_notifications($list_class)
    {
        include 'res/templates/teacher/notifications.php';
    }
    public function show_analysis_wrong_quest($analysis)
    {
        include 'res/templates/teacher/analysis_wrong_quest.php';
    }
    public function show_filter_wrong_quest($analysis,$setting)
    {
        include 'res/templates/teacher/filter_wrong_quest.php';
    }
    public function show_feedback()
    {
        include 'res/templates/student/feedback.php';
    }
    public function show_tests_panel()
    {
        include 'res/templates/teacher/tests_panel.html';
    }
    public function show_list_test($tests)
    {
        include 'res/templates/teacher/list_test.php';
    }
    public function show_courses_panel()
    {
        include 'res/templates/teacher/courses_panel.html';
    }
    public function show_questions_panel()
    {
        include 'res/templates/teacher/questions_panel.html';
    }
    public function show_tai_lieu($document)
    {
        include 'res/templates/teacher/tai_lieu.php';
    }
    public function show_add_question()
    {
        include 'res/templates/teacher/add_question.html';
    }
    public function show_edit_question($question,$grades,$subjects)
    {
        include 'res/templates/teacher/edit_question.php';
    }
    public function show_examine_panel()
    {
        include 'res/templates/teacher/examine_panel.html';
    }
    public function show_test_score($scores)
    {
        include 'res/templates/teacher/test_score.php';
    }
    public function show_about()
    {
        require_once 'config/config.php';
        include 'res/templates/shared/about.php';
    }
    public function show_foot()
    {
        require_once 'config/config.php';
        include 'res/templates/shared/foot.php';
    }
    public function show_profiles($profile)
    {
        include 'res/templates/shared/profiles.php';
    }
    public function show_404()
    {
        include 'res/templates/shared/404.html';
    }
    public function show_tai_lieu_kien_thuc($document)
    {
        include 'res/templates/shared/tai_lieu_kien_thuc.php';
    }
    public function show_tai_lieu_phuong_phap($document)
    {
        include 'res/templates/shared/tai_lieu_phuong_phap.php';
    }
    public function show_tai_lieu_de_tham_khao($document)
    {
        include 'res/templates/shared/tai_lieu_de_tham_khao.php';
    }
    public function show_tai_lieu_khac($document)
    {
        include 'res/templates/shared/tai_lieu_khac.php';
    }
    public function show_tai_lieu_video($document)
    {
        include 'res/templates/shared/tai_lieu_video.php';
    }
}
