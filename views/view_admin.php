<?php

class View_Admin
{
    public function show_head_left($info)
    {
        require_once 'config/config.php';
        include 'res/templates/admin/head_left.php';
    }
    public function show_foot()
    {
        require_once 'config/config.php';
        include 'res/templates/shared/foot.php';
    }
    public function show_admins_panel()
    {
        include 'res/templates/admin/admins_panel.html';
    }
    public function show_dashboard($dashboard,$quest_incorrect=NULL,$analysis_login_month=NULL,$score_analysis)
    {
        include 'res/templates/admin/dashboard.php';
    }
    public function show_teachers_panel()
    {
        include 'res/templates/admin/teachers_panel.html';
    }
    public function show_classes_panel()
    {
        include 'res/templates/admin/classes_panel.html';
    }
    public function show_students_panel()
    {
        include 'res/templates/admin/students_panel.html';
    }
    public function show_questions_panel()
    {
        include 'res/templates/admin/questions_panel.html';
    }
    public function show_add_question()
    {
        include 'res/templates/admin/add_question.html';
    }
    public function show_edit_question($question,$grades,$subjects)
    {
        include 'res/templates/admin/edit_question.php';
    }
    public function show_subjects_panel()
    {
        include 'res/templates/admin/subjects_panel.html';
    }
    public function show_tests_panel()
    {
        include 'res/templates/admin/tests_panel.html';
    }
    public function show_courses_panel()
    {
        include 'res/templates/admin/courses_panel.html';
    }
    public function show_examine_panel()
    {
        include 'res/templates/admin/examine_panel.html';
    }
    public function show_messenger()
    {
        include 'res/templates/shared/messenger.php';
    }
    public function show_tests_detail($questions)
    {
        include 'res/templates/admin/tests_detail.php';
    }
    public function show_ti_le_tuong_tac()
    {
        include 'res/templates/admin/ti_le_tuong_tac.php';
    }
    public function show_tests_print($questions)
    {
        include 'res/templates/admin/tests_print.php';
    }
    public function show_test_score($test_code, $scores)
    {
        include 'res/templates/admin/test_score.php';
    }
    public function show_notifications_panel($list_teacher,$list_class)
    {
        include 'res/templates/admin/notifications_panel.php';
    }
    public function show_about()
    {
        require_once 'config/config.php';
        include 'res/templates/shared/about.php';
    }
    public function show_profiles($profile)
    {
        include 'res/templates/shared/profiles.php';
    }
    public function show_404()
    {
        include 'res/templates/shared/404.html';
    }
    public function show_tai_lieu($document)
    {
        include 'res/templates/admin/tai_lieu.php';
    }
    public function show_create_test()
    {
        include 'res/templates/admin/create_test.php';
    }
    public function show_custom_create_test()
    {
        include 'res/templates/admin/custom_create_test.php';
    }
    public function show_analysis_wrong_quest($analysis)
    {
        include 'res/templates/admin/analysis_wrong_quest.php';
    }
    public function show_diem_so($data)
    {
        include 'res/templates/admin/diem_so.php';
    }
    public function show_filter_wrong_quest($analysis,$setting)
    {
        include 'res/templates/admin/filter_wrong_quest.php';
    }
    public function show_cau_hoi_chon_sai($analysis,$setting)
    {
        include 'res/templates/admin/cau_hoi_chon_sai.php';
    }
    public function show_setting($setting)
    {
        include 'res/templates/admin/setting.php';
    }
    public function show_feedback($feedback,$feedback_gv)
    {
        include 'res/templates/admin/feedback.php';
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
