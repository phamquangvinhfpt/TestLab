
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
									<h5 class="m-b-10">Đề thi</h5>
								</div>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="/"><i class="feather icon-home"></i></a></li>
									<li class="breadcrumb-item"><a href="#!">Danh sách đề thi</a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<!-- [ breadcrumb ] end -->
				<div class="main-body">
					<div class="page-wrapper">
						<!-- [ Main Content ] start -->
<!-- ============================================================= -->
<div class="row">
	<div class="col-sm-12 col-md-6 col-xl-4">
		<div class="form-group">
			<label for="subject_id">Môn Học</label>
			<select class="form-control" name="subject_id" id="subject_id" onchange="javascript:handleSelect(this)">
			</select>
		</div>
	</div>
</div>
<div class="row">
	<?php
		$subject_id = isset($_GET['subject_id']) ? $_GET['subject_id'] : 9999;
		if ($subject_id==9999) {
		for ($i = 0; $i < count($tests); $i++) {
			?>
			<div class="col-sm-12 col-md-6 col-lg-6 col-xl-4">
				<div class="card statistial-visit">
					<div class="card-header">
							<h5><?=$tests[$i]->test_name?></h5>
							<span class="text-muted d-block mt-1">Trạng thái :
							<?php
								if ($tests[$i]->STATUS == 'Mở') {
									echo '<span class="badge badge-success">'.$tests[$i]->STATUS.'</span>';
								} elseif ($tests[$i]->STATUS == 'Cho Phép Xem Đáp Án') {
									echo '<span class="badge badge-primary">'.$tests[$i]->STATUS.'</span>';
								} else {
									echo '<span class="badge badge-danger">'.$tests[$i]->STATUS.'</span>';
								}
							 ?>
							</span>
							<span class="text-muted d-block mt-1">Giáo viên: 
								<span class="badge badge-info"><?=$tests[$i]->created_by?></span>
							</span>
					</div>
					<div class="card-block text-center">
							<h3 class="f-w-300"><?=$tests[$i]->subject_detail?></h3>
							<?php
								if($tests[$i]->status_id != 2)
								{
									$flag = false;
									for($j = 0; $j < count($scores); $j++) {
										if($tests[$i]->test_code == $scores[$j]->test_code) {
											$flag = true;
											break;
										}
									}
									if($flag)
										echo '<a href="xem-ket-qua-'.$tests[$i]->test_code.'" class="btn btn-success shadow-2 text-uppercase btn-block" style="max-width:150px;margin:0 auto;">Xem lại bài</a>';
									else {
										?>
										<a href="#!" class="btn btn-primary shadow-2 text-uppercase btn-block" onclick="check_pass_test(<?=$tests[$i]->test_code?>)" style="max-width:150px;margin:0 auto;">Làm bài</a>
										<?php
									}
								} else {
									$flag_2 = false;
									for($j = 0; $j < count($scores); $j++) {
										if($tests[$i]->test_code == $scores[$j]->test_code) {
											$flag_2 = true;
											break;
										}
									}
									if($flag_2)
										echo '<a href="xem-ket-qua-'.$tests[$i]->test_code.'" class="btn btn-primary shadow-2 text-uppercase btn-block" style="max-width:150px;margin:0 auto;">LÀM BÀI</a>';
									else
										echo '<a href="#!" class="btn btn-danger shadow-2 text-uppercase btn-block disabled" style="max-width:150px;margin:0 auto;">LÀM BÀI</a>';
								}
								?>
							<div class="mt-4 m-b-20">
								<span class="d-block"><i class="fas fa-bullhorn m-r-10"></i><?=$tests[$i]->note?></span>
								<span class="d-block">Ngày tạo đề: <?=date('d-m-Y',strtotime($tests[$i]->timest))?></span>
							</div>
							<div class="row card-active">
								<div class="col-md-4 col-6">
										<h4><?=$tests[$i]->time_to_do?> Phút</h4>
										<span class="text-muted">Thời gian</span>
								</div>
								<div class="col-md-4 col-6">
										<h4><?=$tests[$i]->total_questions?></h4>
										<span class="text-muted">Số câu</span>
								</div>
								<div class="col-md-4 col-12">
										<h4><?=$tests[$i]->grade?></h4>
										<span class="text-muted">Khối</span>
								</div>
						</div>
					</div>
				</div>
			</div>
		<?php
		 }
	 } else {
		 for ($i = 0; $i < count($tests); $i++) {
		if ($tests[$i]->subject_id==$subject_id) {
		?>
		<div class="col-sm-12 col-md-6 col-lg-6 col-xl-4">
			<div class="card statistial-visit">
				<div class="card-header">
						<h5><?=$tests[$i]->test_name?></h5>
						<span class="text-muted d-block mt-1">Trạng thái :
						<?php
							if ($tests[$i]->STATUS == 'Mở') {
								echo '<span class="badge badge-success">'.$tests[$i]->STATUS.'</span>';
							} elseif ($tests[$i]->STATUS == 'Cho Phép Xem Đáp Án') {
								echo '<span class="badge badge-primary">'.$tests[$i]->STATUS.'</span>';
							} else {
								echo '<span class="badge badge-danger">'.$tests[$i]->STATUS.'</span>';
							}
							
						 ?>
						</span>
				</div>
				<div class="card-block text-center">
						<h3 class="f-w-300"><?=$tests[$i]->subject_detail?></h3>
						<?php
							if($tests[$i]->status_id != 2)
							{
								$flag = false;
								for($j = 0; $j < count($scores); $j++) {
									if($tests[$i]->test_code == $scores[$j]->test_code) {
										$flag = true;
										break;
									}
								}
								if($flag)
									echo '<a href="xem-ket-qua-'.$tests[$i]->test_code.'" class="btn btn-success shadow-2 text-uppercase btn-block" style="max-width:150px;margin:0 auto;">Xem lại bài</a>';
								else {
									?>
									<a href="#!" class="btn btn-primary shadow-2 text-uppercase btn-block" onclick="check_pass_test(<?=$tests[$i]->test_code?>)" style="max-width:150px;margin:0 auto;">Làm bài</a>
									<?php
								}
							} else {
								$flag_2 = false;
								for($j = 0; $j < count($scores); $j++) {
									if($tests[$i]->test_code == $scores[$j]->test_code) {
										$flag_2 = true;
										break;
									}
								}
								if($flag_2)
									echo '<a href="xem-ket-qua-'.$tests[$i]->test_code.'" class="btn btn-primary shadow-2 text-uppercase btn-block" style="max-width:150px;margin:0 auto;">LÀM BÀI</a>';
								else
									echo '<a href="#!" class="btn btn-danger shadow-2 text-uppercase btn-block disabled" style="max-width:150px;margin:0 auto;">LÀM BÀI</a>';
							}
							?>
						<div class="mt-4 m-b-20">
							<span class="d-block"><i class="fas fa-bullhorn m-r-10"></i><?=$tests[$i]->note?></span>
						</div>
						<div class="row card-active">
							<div class="col-md-4 col-6">
									<h4><?=$tests[$i]->time_to_do?> Phút</h4>
									<span class="text-muted">Thời gian</span>
							</div>
							<div class="col-md-4 col-6">
									<h4><?=$tests[$i]->total_questions?></h4>
									<span class="text-muted">Số câu</span>
							</div>
							<div class="col-md-4 col-12">
									<h4><?=$tests[$i]->grade?></h4>
									<span class="text-muted">Khối</span>
							</div>
					</div>
				</div>
			</div>
		</div>
	<?php
		}
		}
	 }
	?>

</div>
<!-- ============================================================= -->
						<!-- [ Main Content ] end -->
						<style media="screen">
							thead tr th {
								text-align: left !important;
							}
						</style>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div id="model_check_pass_test" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="ModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
						<div class="modal-header">
								<h5 class="modal-title" id="ModalCenterTitle">Nhập mật khẩu đề</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
						</div>
						<div class="modal-body">
							<form id="check_pass_test_from">
								<div class="form-row">
									<div class="form-group col-md-12">
										<label for="test_pass">Mật khẩu</label>
										<input style="margin-bottom: 10px" type="password" class="form-control" id="test_pass" placeholder="Nhập mật khẩu" required name="password">
										<input id="test_code" type="hidden" value="000000" name="test_code" required>
										<span style="color:red">Mặc định: 123456</span>
									</div>
								</div>
							</form>
						</div>
						<div class="modal-footer">
								<button type="button" onclick="submit_test()" class="btn btn-primary">Xác nhận</button>
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
<!-- sweet alert Js -->
<script src="assets/plugins/sweetalert/js/sweetalert.min.js"></script>
<script type="text/javascript">
	function handleSelect(elm){
		window.location = "?subject_id="+elm.value;
	}
	$(document).ready(function(){
  	$("[data-name=danh-sach-bai-thi]").addClass("pcoded-trigger");
		select_subject(<?=$subject_id?>);
	});
</script>
