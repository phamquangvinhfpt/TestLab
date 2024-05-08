
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
									<h5 class="m-b-10">Điểm số</h5>
								</div>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="/"><i class="feather icon-home"></i></a></li>
									<li class="breadcrumb-item"><a href="#!">Điểm số của học sinh</a></li>
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
												<h5>Học sinh: <?=$student->name?></h5>
										</div>
										<div class="card-block">
												<div class="table-responsive">
														<table id="scrolling-table" class="display table nowrap centered table-striped table-hover" style="width:100%">
																<thead>
																		<tr>
																				<th>ID</th>
																				<th>Tên đề thi</th>
																				<th>Môn thi</th>
																				<th>Khối</th>
																				<th>Số câu đúng</th>
																				<th>Điểm</th>
																				<th>Thời gian</th>
																		</tr>
																</thead>
																<tbody>
																	<?php
									                    foreach ($data as $e) {
									                        ?>
									                        <tr id="tests-id-<?=$e->test_code?>">
									                            <td><?=$e->test_code?></td>
									                            <td><?=$e->test_name?></td>
									                            <td><?=$e->subject_detail?></td>
									                            <td><?=$e->grade_id?></td>
									                            <td><?=$e->score_detail?></td>
									                            <td><?=round($e->score_number,2)?></td>
									                            <td><?=$e->completion_time?></td>
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
