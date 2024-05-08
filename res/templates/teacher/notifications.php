<!-- [ Main Content ] start -->
<div class="pcoded-main-container">
	<div class="pcoded-wrapper">
		<div class="pcoded-content">
			<div class="pcoded-inner-content">
				<!-- [ breadcrumb ] start -->
				<div class="page-header">
					<div class="page-block">
						<div class="row align-items-center">
							<div class="col-md-12">
								<div class="page-header-title">
									<h5 class="m-b-10">Quản lý thông báo</h5>
								</div>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="/"><i class="feather icon-home"></i></a></li>
									<li class="breadcrumb-item"><a href="#!">Thông báo</a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<!-- [ breadcrumb ] end -->
				<div class="main-body">
					<div class="page-wrapper">
						<!-- [ Main Content ] start -->
						<div class="row">
							<div class="col-xl-12 col-lg-12 filter-bar">
								<nav class="navbar m-b-30 p-10">
										<ul class="nav">
												<li class="nav-item f-text active">
														<a class="nav-link text-secondary" href="#!">Danh sách thông báo</a>
												</li>
										</ul>
										<div class="nav-item nav-grid f-view">
												<span class="m-r-15">View Mode: </span>
												<button type="button" class="btn btn-primary btn-icon m-0" data-toggle="tooltip" data-placement="top" title="list view">
														<i class="fas fa-list-ul"></i>
												</button>
												<button type="button" class="btn btn-primary btn-icon m-0" data-toggle="tooltip" data-placement="top" title="grid view">
														<i class="fas fa-th-large"></i>
												</button>
										</div>
								</nav>
									<div class="card">
										<div class="row">
											<div class="col-md-6 col-sm-12" style="padding: 30px 50px 30px 50px;height: 680px;overflow: auto;">
												<p>Thông báo đã gửi</p>
												<div id="student_content" class="row">
												</div>
											</div>
											<div class="col-md-6 col-sm-12" style="padding: 30px 50px 30px 50px;height: 680px;overflow: auto;">
												<p>Thông báo đã nhận</p>
												<div id="admin_content" class="row">
												</div>
											</div>
										</div>
									</div>
							</div>
						</div>
						<div class="row">
							<div class="card col-md-12">
								<div class="card-header">
									<h5>Gửi thông báo</h5>
									<div class="card-header-right">
										<div class="btn-group card-option">
											<button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
												<i class="feather icon-more-horizontal"></i>
											</button>
											<ul class="list-unstyled card-option dropdown-menu dropdown-menu-right">
												<li class="dropdown-item full-card"><a href="#!"><span><i class="feather icon-maximize"></i> Phóng to</span><span style="display:none"><i class="feather icon-minimize"></i> Khôi phục</span></a></li>
												<li class="dropdown-item minimize-card"><a href="#!"><span><i class="feather icon-minus"></i> Đóng lại</span><span style="display:none"><i class="feather icon-plus"></i> Mở ra</span></a></li>
												<li class="dropdown-item reload-card"><a href="#!"><i class="feather icon-refresh-cw"></i> Tải lại</a></li>
												<li class="dropdown-item close-card"><a href="#!"><i class="feather icon-trash"></i> Xóa</a></li>
											</ul>
										</div>
									</div>
								</div>
								<form id="send_notification">
										<div class="form-group">
												<label for="topic">Chủ đề</label>
												<input id="notification_title" class="form-control" type="text" id="notification_title" name="notification_title" required>
										</div>
										<div class="form-group">
												<label for="content">Nội dung</label>
												<textarea id="notification_content" class="form-control" name="notification_content" required></textarea>
										</div>
										<div class="row">
											<div class="col-6">
											<label>Lớp</label><br>
											<button type="button" class="btn btn-sm btn-primary   m-b-10" id="select-all-class">Chọn hết</button>
											<button type="button" class="btn btn-sm btn-primary   m-b-10" id="deselect-all-class">Bỏ hết</button>
												<select name="class_id" id="class_id" class="searchable" multiple="multiple">
													<?php
													foreach ($list_class as $key => $value) {
													?>
													<option value="<?=$value->class_id?>"><?=$value->class_name?></option>
													<?php
													}
													?>
												</select>
											</div>
										</div>
										<button id="submit" type="submit" class="btn btn-primary mt-4">Gửi thông báo</button>
								</form>
							</div>
						</div>
						<!-- [ Main Content ] end -->
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Required Js -->
<script src="assets/js/vendor-all.min.js"></script>
<script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="assets/js/pcoded.min.js"></script>
<!-- datatable Js -->
<script src="assets/plugins/data-tables/js/datatables.min.js"></script>
<!-- jquery-validation Js -->
<script src="assets/plugins/jquery-validation/js/jquery.validate.min.js"></script>
<!-- notification Js -->
<script src="assets/plugins/notification/js/bootstrap-growl.min.js"></script>
<!-- WaterBall Js -->
<script src="assets/plugins/waterball/js/createWaterBall-jquery.js"></script>
<!-- sweet alert Js -->
<script src="assets/plugins/sweetalert/js/sweetalert.min.js"></script>
<!-- Multi select css -->
<link href="assets/plugins/multi-select/css/multi-select.css" rel="stylesheet">
<!-- Multi select Js -->
<script src="assets/plugins/multi-select/js/jquery.quicksearch.js"></script>
<script src="assets/plugins/multi-select/js/jquery.multi-select.js"></script>
<script src="res/js/teacher_notifications.js"></script>

<script src='res/libs/MathJax/MathJax.js?config=TeX-MML-AM_CHTML' async></script>
<script type="text/javascript">
    MathJax.Hub.Config({
        extensions: ["tex2jax.js"],
        jax: ["input/TeX", "output/HTML-CSS"],
        tex2jax: {
            inlineMath: [
            ["$", "$"],
            ["\\(", "\\)"]
            ]
        }
    });
</script>
<script type="text/javascript">
	$(document).ready(function(){
  	$("[data-name=gui-thong-bao]").addClass("pcoded-trigger");
	});
</script>
