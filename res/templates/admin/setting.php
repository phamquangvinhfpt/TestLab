
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
									<h5 class="m-b-10">Cài đặt</h5>
								</div>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="/"><i class="feather icon-home"></i></a></li>
									<li class="breadcrumb-item"><a href="#!">Cài đặt hệ thống</a></li>
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
							<div class="col-lg-12 col-xl-4">
								<div class="card">
							    <div class="card-header">
							        <h5>Đánh giá câu hỏi</h5>
							        <span class="d-block m-t-5">Tỉ lệ chọn đúng đáp án từng mức độ</span>
							    </div>
							    <div class="card-block">
							        <form>
							            <div class="row form-group">
							                <div class="col-sm-4">
							                    <label class="col-form-label">Nhận biết</label>
							                </div>
							                <div style="width:80px">
							                    <input name="level_1_a" type="text" class="form-control autonumber" data-a-sign="%" data-p-sign="s" data-v-max="100" data-v-min="0" value="<?=$setting->level_1_a?>">
							                </div>
																<label class="col-form-label mt-1 mr-2 ml-2"><i class="feather icon-arrow-right"></i></label>
															<div style="width:80px">
																	<input name="level_1_b" type="text" class="form-control autonumber" data-a-sign="%" data-p-sign="s" data-v-max="100" data-v-min="0" value="<?=$setting->level_1_b?>">
															</div>
							            </div>
							            <div class="row form-group">
							                <div class="col-sm-4">
							                    <label class="col-form-label">Thông hiểu</label>
							                </div>
							                <div style="width:80px">
							                    <input name="level_2_a" type="text" class="form-control autonumber" data-a-sign="%" data-p-sign="s" data-v-max="100" data-v-min="0" value="<?=$setting->level_2_a?>">
							                </div>
																<label class="col-form-label mt-1 mr-2 ml-2"><i class="feather icon-arrow-right"></i></label>
															<div style="width:80px">
																	<input name="level_2_b" type="text" class="form-control autonumber" data-a-sign="%" data-p-sign="s" data-v-max="100" data-v-min="0" value="<?=$setting->level_2_b?>">
															</div>
							            </div>
							            <div class="row form-group">
							                <div class="col-sm-4">
							                    <label class="col-form-label">Vận dụng</label>
							                </div>
							                <div style="width:80px">
							                    <input name="level_3_a" type="text" class="form-control autonumber" data-a-sign="%" data-p-sign="s" data-v-max="100" data-v-min="0" value="<?=$setting->level_3_a?>">
							                </div>
																	<label class="col-form-label mt-1 mr-2 ml-2"><i class="feather icon-arrow-right"></i></label>
															<div style="width:80px">
																	<input name="level_3_b" type="text" class="form-control autonumber" data-a-sign="%" data-p-sign="s" data-v-max="100" data-v-min="0" value="<?=$setting->level_3_b?>">
															</div>
							            </div>
							            <div class="row form-group">
							                <div class="col-sm-4">
							                    <label class="col-form-label">Vận dụng cao</label>
							                </div>
							                <div style="width:80px">
							                    <input name="level_4_a" type="text" class="form-control autonumber" data-a-sign="%" data-p-sign="s" data-v-max="100" data-v-min="0" value="<?=$setting->level_4_a?>">
							                </div>
																<label class="col-form-label mt-1 mr-2 ml-2"><i class="feather icon-arrow-right"></i></label>
															<div style="width:80px">
																	<input name="level_4_b" type="text" class="form-control autonumber" data-a-sign="%" data-p-sign="s" data-v-max="100" data-v-min="0" value="<?=$setting->level_4_b?>">
															</div>
							            </div>
							            <div class="row">
							                <div class="col-sm-4">
							                    <label class="col-form-label">Số lượt dữ liệu tối thiểu</label>
							                </div>
							                <div style="width:190px">
							                    <input name="quest_total_analysis" type="text" class="form-control autonumber" data-a-sep="." data-a-dec="," data-v-min="0" data-v-max="999999" value="<?=$setting->quest_total_analysis?>">
							                </div>
							            </div>
													<button id="update_quest_setting" type="submit" class="btn btn-primary mt-3 center">Lưu cài đặt</button>
							        </form>
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
<!-- Input mask Js -->
<script src="assets/plugins/inputmask/js/inputmask.min.js"></script>
<script src="assets/plugins/inputmask/js/jquery.inputmask.min.js"></script>
<script src="assets/plugins/inputmask/js/autoNumeric.js"></script>
<!-- sweet alert Js -->
<script src="assets/plugins/sweetalert/js/sweetalert.min.js"></script>
<!-- custom js -->
<script src="res/js/setting.js"></script>
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
		$("form").on('submit', function(event) {
				event.preventDefault();
		});
		$('.autonumber').autoNumeric('init');
</script>
<script type="text/javascript">
	$(document).ready(function(){
  	$("[data-name=tai-lieu]").addClass("pcoded-trigger");
	});
</script>
