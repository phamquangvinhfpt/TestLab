
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
									<h5 class="m-b-10">Tài liệu</h5>
								</div>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="/"><i class="feather icon-home"></i></a></li>
									<li class="breadcrumb-item"><a href="#!">Quản lý tài liệu</a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<!-- [ breadcrumb ] end -->
				<div class="main-body">
					<div class="page-wrapper">
						<!-- [ Main Content ] start -->
						<div class="card">
							<div class="card-body">
								<div class="row">
									<div class="col-sm-12 col-md-4 col-xl-3">
										<div class="form-group">
											<label for="subject_id">Môn Học</label>
											<select class="form-control" name="subject_id" id="subject_id" onchange="javascript:handleSelect()">
											</select>
										</div>
									</div>
									<div class="col-sm-12 col-md-4 col-xl-3">
										<div class="form-group">
											<label for="subject_id">Khối lớp</label>
											<select class="form-control" name="grade_id" id="grade_id" onchange="javascript:handleSelect()">
												<option value="10">Lớp 10</option>
												<option value="11">Lớp 11</option>
												<option value="12">Lớp 12</option>
											</select>
										</div>
									</div>
								</div>
							</div>
					</div>
            <div class="card">
                <div class="card-header">
                    <h5>Danh sách tài liệu</h5>
                </div>
                <div class="card-body">
                    <ul>
											<?php
											for ($i=0; $i < count($document); $i++) {
													echo '<li><a href="upload/document/'.$document[$i]->doc_path.'" >'.$document[$i]->doc_name.'</a><span> ('.$document[$i]->note.')</span></li>';
											}
											 ?>
                    </ul>
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
	$(document).ready(function(){
		select_subject_2();
  	$("[data-name=tai-lieu]").addClass("pcoded-trigger");
	});
	function handleSelect() {
		var subject_id = $("#subject_id").val();
		var grade_id = $("#grade_id").val();
		var url = getUrlVars()["action"];
		window.location = "?action="+url+"&subject_id="+subject_id+"&grade_id="+grade_id;
	}
</script>
