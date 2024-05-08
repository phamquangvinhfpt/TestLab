
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
                <div class="card-header">
                    <h5>Thêm tài liệu</h5>
                </div>
                <div class="card-body">
									<div class="row">
									            <div class="col-md-6">
									                <form>
									                    <div class="form-group">
									                        <label for="doc_name">Tên tài liệu</label>
									                        <input name="doc_name" type="text" class="form-control" id="doc_name" aria-describedby="emailHelp" placeholder="Tên tài liệu">
									                    </div>
																			<div class="input-group mb-3">
											                    <div class="custom-file">
											                        <input onchange="upload_file_data(this)" name="doc_file" type="file" class="custom-file-input" id="doc_file">
											                        <label class="custom-file-label" for="doc_file">Chọn file</label>
											                    </div>
											                </div>
																			<div class="form-group">
																					<label for="doc_mota">Mô tả tài liệu</label>
																					<textarea name="doc_mota" class="form-control" id="doc_mota" rows="3"></textarea>
																			</div>
									                    <button id="submit_doc" class="btn btn-primary">Tải lên</button>
									                </form>
									            </div>
									            <div class="col-md-6">
									                <form>
																			<div class="form-group">
					                                <label for="doc_grade">Khối</label>
					                                <select class="form-control" id="doc_grade" name="grade_id"></select>
					                            </div>
																			<div class="form-group">
																				<label for="doc_subject">Môn Học</label>
																				<select class="form-control column_filter" id="doc_subject" name="subject_id"></select>
																			</div>
																			<div class="form-group">
																				<label for="type_id">Phân loại</label>
																				<select class="form-control column_filter" id="type_id" name="type_id">
																					<option value="1">Kiến thức</option>
																					<option value="2">Phương pháp</option>
																					<option value="3">Đề tham khảo</option>
																					<option value="4">Video</option>
																					<option value="5">Khác</option>
																				</select>
																			</div>
									                </form>
									            </div>
									        </div>
                </div>
            </div>



            <div class="card">
                <div class="card-header">
                    <h5>Danh sách tất cả tài liệu</h5>
                </div>
                <div class="card-body">
                    <ul>
											<?php
											for ($i=0; $i < count($document); $i++) {
													echo '<li id="'.$document[$i]->id.'" class="doc_hover" ><a href="upload/document/'.$document[$i]->doc_path.'" >'.$document[$i]->doc_name.'</a></li>';
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
