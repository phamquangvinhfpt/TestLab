<style media="screen">
.table td {
	text-align: center;
	vertical-align: middle !important;
}
</style>
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
									<h5 class="m-b-10">Lớp học</h5>
								</div>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="/"><i class="feather icon-home"></i></a></li>
									<li class="breadcrumb-item"><a href="#!">Danh sách học sinh</a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<!-- [ breadcrumb ] end -->
				<div class="main-body">
					<div class="page-wrapper">
						<!-- [ Main Content ] start -->
						<div class="col-sm-12">
								<div class="card">
										<div class="card-header">
												<h5>Danh sách học sinh lớp <?=$class_name?></h5>
										</div>
										<div class="card-block">
												<div class="table-responsive">
														<table id="scrolling-table" class="display table nowrap centered table-striped table-hover" style="width:100%">
																<thead>
																		<tr>
																				<th>ID</th>
																				<th>Avatar</th>
																				<th>Mã học sinh</th>
																				<th>Tên</th>
																				<th>Ngày sinh</th>
																				<th>Giới tính</th>
																				<th>Online cuối</th>
																				<th>Điểm</th>
																		</tr>
																</thead>
																<tbody>
																	<?php
									                    foreach ($students as $student) {
									                        ?>
									                        <tr id="student-id-<?=$student->student_id?>">
									                            <td><?=$student->student_id?></td>
									                            <td>
									                                <img src="upload/avatar/<?=$student->avatar?>" alt="avatar" class="avatar" />
									                            </td>
									                            <td><?=$student->username?></td>
									                            <td><?=$student->name?></td>
									                            <td><?=$student->birthday?></td>
									                            <td><?=$student->gender_detail?></td>
									                            <?php
									                            if($student->last_login == '' || $student->last_login == '0000-00-00 00:00:00')
									                                $student->last_login = 'Chưa Đăng Nhập';
									                            ?>
									                            <td><?=$student->last_login?></td>
									                            <td>
									                                <a class="waves-effect waves-light btn modal-trigger" href="xem-diem-hs<?=$student->student_id?>"  id="#view_score_<?=$student->student_id?>">Chi Tiết</a>
									                            </td>
									                        </tr>
									                        <?php
									                    }
									                ?>
																</tbody>
														</table>
												</div>
										</div>
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
<!-- sweet alert Js -->
<script src="assets/plugins/sweetalert/js/sweetalert.min.js"></script>
<script src='res/libs/MathJax/MathJax.js?config=TeX-MML-AM_CHTML' async></script>
<script type="text/javascript">

$('#scrolling-table').DataTable({
		scrollY: 500,
		paging: false,
		keys: true
});

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
  	$("[data-name=chi-tiet-lop-hoc]").addClass("pcoded-trigger");
	});
</script>
