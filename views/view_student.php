<?php

class View_Student
{
	public function show_head_left($info)
	{
		require_once 'config/config.php';
		include 'res/templates/student/head_left.php';
	}
	public function show_dashboard($tests,$scores)
	{
		include 'res/templates/student/dashboard.php';
	}
	public function show_courses_panel($tests,$scores)
	{
		include 'res/templates/student/courses_panel.php';
	}
	public function show_chat()
	{
		include 'res/templates/student/chat.html';
	}
	public function show_diem_so($data)
	{
			include 'res/templates/student/diem_so.php';
	}
	public function show_all_chat()
	{
		include 'res/templates/student/all_chat.html';
	}
	public function show_messenger()
	{
			include 'res/templates/shared/messenger.php';
	}
	public function show_notifications()
	{
		include 'res/templates/student/notifications.html';
	}
	public function show_exam($test,$test_type,$min,$sec,$time_out=0)
	{
		include 'res/templates/student/exam.php';
	}
	public function show_result($test,$score,$result)
	{
		include 'res/templates/student/result.php';
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
		public function show_tai_lieu($document)
		{
				include 'res/templates/student/tai_lieu.php';
		}
		public function show_ranking($ranking)
		{
				include 'res/templates/student/bang-xep-hang.php';
		}
		public function show_feedback()
		{
				include 'res/templates/student/feedback.php';
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
