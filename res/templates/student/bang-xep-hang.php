
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
									<h5 class="m-b-10">Xếp hạng</h5>
								</div>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="/"><i class="feather icon-home"></i></a></li>
									<li class="breadcrumb-item"><a href="#!">Bảng xếp hạng thi đua</a></li>
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
												<h5>Xếp hạng</h5>
										</div>
										<div class="card-block">
												<div class="table-responsive">
													<style media="screen">
													th, td {
														text-align: center;
														padding: 16px;
													}
													</style>
														<table id="scrolling-table" class="display table nowrap centered table-striped table-hover" style="width:100%">
															<colgroup>
													       <col span="1" style="width: 5%;">
													       <col span="1" style="width: 15%;">
													       <col span="1" style="width: 30%;">
																 <col span="1" style="width: 30%;">
																 <col span="1" style="width: 15%;">
													    </colgroup>
																<thead>
																		<tr>
																				<th>Xếp hạng</th>
																				<th>Avatar</th>
																				<th>Tên</th>
																				<th>Danh hiệu</th>
																				<th>EXP</th>
																		</tr>
																</thead>
																<tbody>
																	<?php
																	for ($i=0; $i < count($ranking) ; $i++) {
																	?>

																	<tr class="unread">
																		<td><h6 class="mb-1"><?=($i+1)?></h6></td>
																			<td><img class="rounded-circle" style="width:40px;" src="upload/avatar/<?=$ranking[$i]->avatar?>" alt="rank-user"></td>
																			<td>
																					<h6 class="mb-1"><?=$ranking[$i]->name?></h6>
																					<p class="m-0">Lớp: <?=$ranking[$i]->class_name?></p>
																			</td>
																			<td>
																					<h6 class="text-muted"><i class="fas fa-circle text-c-green f-10 m-r-15"></i><?=$ranking[$i]->rank_name?></h6>
																			</td>
																			<td><a href="#!" class="label theme-bg text-white f-12">EXP: <?=$ranking[$i]->EXP?></a></td>
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
<!-- custom js -->
<script src="res/js/questions_panel.js"></script>
<!-- sweet alert Js -->
<script src="assets/plugins/sweetalert/js/sweetalert.min.js"></script>
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
  	$("[data-name=bang-xep-hang]").addClass("pcoded-trigger");
	});
</script>
