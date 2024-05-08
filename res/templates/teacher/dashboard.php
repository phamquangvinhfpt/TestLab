
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
									<li class="breadcrumb-item"><a href="#!">Danh sách lớp học đang quản lý</a></li>
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
								<!-- [ task-board ] start -->
												<div class="col-lg-12 col-md-12 col-sm-12">
													<div class="card">
															<div class="card-header">
																	<h5>Lớp</h5>
															</div>
															<div class="card-block">
																	<div class="grid">
																			<div class="row">
																				<?php
																				for ($i=0; $i < count($class); $i++) {
																				?>
																				<div class="col-lg-4 col-md-6 col-sm-6 col-12">
																					<figure class="effect-steve">
																							<img src="assets/images/gallery-grid/lop.jpg" alt="advance-1" />
																							<figcaption>
																									<h2><span><?=$class[$i]->class_name?></span></h2>
																									<p><?=$class[$i]->count?> Học sinh</p>
																									<a href="thong-tin-lop-<?=$class[$i]->class_id?>">Xem thêm</a>
																							</figcaption>
																					</figure>
																				</div>
																				<?php
																				}
																				?>
																			</div>
																	</div>
															</div>
													</div>
										</div>
								</div>
								<!-- [ task-board ] end -->
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
<script src="res/js/doc_panel.js"></script>
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
	$(document).ready(function(){
  	$("[data-name=tai-lieu]").addClass("pcoded-trigger");
	});
</script>
