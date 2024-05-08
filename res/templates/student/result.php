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
									<h5 class="m-b-10">Bài thi</h5>
								</div>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="/"><i class="feather icon-home"></i></a></li>
									<li class="breadcrumb-item"><a href="#!">Xem lại bài thi</a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<!-- [ breadcrumb ] end -->
				<div class="main-body">
					<div class="page-wrapper">
						<div class="row">
							<!-- [ Responsive table ] start -->
							<div class="col-sm-12">
								<div class="card">
									<div class="card-header">
										<h5>Kết quả bài thi</h5>
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
									<div class="card-block">

											<div class="title-content">
												<span class="title">Kết Quả Bài Làm <?=$test->test_code?></span>
											</div>
											<div class="block-content overflow scrollbar">
												<div class="content">
													<div id="recent_list" style="padding-bottom: 20px;">
														<span class="title" style="color: #02796e;"><?=$score->score_number?> Điểm</span><br />
														<span class="title" style="color: #02796e;">Đúng <?=$score->score_detail?> Câu</span><br />
														<span class="title">Hoàn Thành Lúc: <?=$score->completion_time?></span><br />
														<span class="title">CHI TIẾT BÀI THI</span><br />
										                <span class="title">Chú thích:<br />
										                    <span style="color: green;">Màu xanh </span>là học sinh chọn đúng đáp án <br />
										                    <span style="color: red;">Màu đỏ </span> là đáp án học sinh chọn sai<br />
										                    <span style="color: blue;">Màu xanh dương </span> là đáp án đúng của câu hỏi
										                </span>
														<br />
														<?php
														if ($test->test_type == 2) {
														?>
														<button onclick="delete_scores(<?=$test->test_code?>)" type="button" class="btn btn-outline-danger mt-3">Làm lại bài</button>
														<?php
														}
														 ?>
										                <hr>
										            </div>
										    </div>
										</div>
										</div>
										</div>
									</div>
									<div class="col-sm-12">
										<div class="card">
											<div class="card-header">
												<h5>Bài làm</h5>
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
											<div class="card-block">

												<div id="recent">
														<?php
														if($result == null) {
																echo '<span class="title">Bài Thi/Kiểm tra chưa được mở xem đáp án. Vui lòng liên hệ Giáo viên hoặc Quản trị viên.</span>';
														} else {

														 for($i = 0; $i < count($result); $i++) {
																?>


																<div id="quest-<?=($i+1)?>" class="col-sm-12">
														        <div class="card">
														            <div class="card-body">
														                <h5 class="card-title">Câu <?=($i+1)?>:</h5>
														                <h5 class="card-title"><?=$result[$i]->question_content?></h5>
																						<div class="quest-answer">
																								<div class='answer'>
																										<?php
																										if (trim($result[$i]->student_answer) == trim($result[$i]->answer_a) && trim($result[$i]->student_answer) == trim($result[$i]->correct_answer))
																										{
																														echo '
																														<div class="custom-control custom-radio">
																																<input class="custom-control-input" type="radio" checked disabled>
																																<label class="custom-control-label correct">' . $result[$i]->answer_a . '</label>
																														</div>
																														';
																										}
																										else
																										{
																												if (trim($result[$i]->student_answer) == trim($result[$i]->answer_a) && trim($result[$i]->student_answer) != trim($result[$i]->correct_answer))
																												{
																														echo '
																														<div class="custom-control custom-radio">
																																<input class="custom-control-input" type="radio" checked disabled>
																																<label class="custom-control-label incorrect">' . $result[$i]->answer_a . '</label>
																														</div>
																														';
																												}
																												else
																												{
																														if (trim($result[$i]->answer_a) == trim($result[$i]->correct_answer))
																														{
																																echo '
																																<div class="custom-control custom-radio">
																																		<input class="custom-control-input" type="radio" checked disabled>
																																		<label class="custom-control-label blcorrect">' . $result[$i]->answer_a . '</label>
																																</div>
																																';
																														}
																														else
																														{
																																echo '
																																<div class="custom-control custom-radio">
																																		<input class="custom-control-input" type="radio" disabled>
																																		<label class="custom-control-label nonecorrect">' . $result[$i]->answer_a . '</label>
																																</div>
																																';
																														}
																												}
																										}
																										?>
																								</div>
																								<div class='answer'>
																										<?php
																										if (trim($result[$i]->student_answer) == trim($result[$i]->answer_b) && trim($result[$i]->student_answer) == trim($result[$i]->correct_answer))
																										{
																														echo '
																														<div class="custom-control custom-radio">
																																<input class="custom-control-input" type="radio" checked disabled>
																																<label class="custom-control-label correct">' . $result[$i]->answer_b . '</label>
																														</div>
																														';
																										}
																										else
																										{
																												if (trim($result[$i]->student_answer) == trim($result[$i]->answer_b) && trim($result[$i]->student_answer) != trim($result[$i]->correct_answer))
																												{
																																echo '
																																<div class="custom-control custom-radio">
																																		<input class="custom-control-input" type="radio" checked disabled>
																																		<label class="custom-control-label incorrect">' . $result[$i]->answer_b . '</label>
																																</div>
																																';
																												}
																												else
																												{
																														if (trim($result[$i]->answer_b) == trim($result[$i]->correct_answer))
																														{
																																echo '
																																<div class="custom-control custom-radio">
																																		<input class="custom-control-input" type="radio" checked disabled>
																																		<label class="custom-control-label blcorrect">' . $result[$i]->answer_b . '</label>
																																</div>
																																';
																														}
																														else
																														{
																																echo '
																																<div class="custom-control custom-radio">
																																		<input class="custom-control-input" type="radio" disabled>
																																		<label class="custom-control-label nonecorrect">' . $result[$i]->answer_b . '</label>
																																</div>
																																';
																														}
																												}
																										}
																										?>
																								</div>
																								<div class='answer'>
																										<?php
																										if (trim($result[$i]->student_answer) == trim($result[$i]->answer_c) && trim($result[$i]->student_answer) == trim($result[$i]->correct_answer))
																										{
																											echo '
																											<div class="custom-control custom-radio">
																													<input class="custom-control-input" type="radio" checked disabled>
																													<label class="custom-control-label correct">' . $result[$i]->answer_c . '</label>
																											</div>
																											';
																										}
																										else
																										{
																												if (trim($result[$i]->student_answer) == trim($result[$i]->answer_c) && trim($result[$i]->student_answer) != trim($result[$i]->correct_answer))
																												{
																													echo '
																													<div class="custom-control custom-radio">
																															<input class="custom-control-input" type="radio" checked disabled>
																															<label class="custom-control-label incorrect">' . $result[$i]->answer_c . '</label>
																													</div>
																													';
																												}
																												else
																												{
																														if (trim($result[$i]->answer_c) == trim($result[$i]->correct_answer))
																														{
																															echo '
																															<div class="custom-control custom-radio">
																																	<input class="custom-control-input" type="radio" checked disabled>
																																	<label class="custom-control-label blcorrect">' . $result[$i]->answer_c . '</label>
																															</div>
																															';
																														}
																														else
																														{
																															echo '
																															<div class="custom-control custom-radio">
																																	<input class="custom-control-input" type="radio" disabled>
																																	<label class="custom-control-label nonecorrect">' . $result[$i]->answer_c . '</label>
																															</div>
																															';
																														}
																												}
																										}
																										?>
																								</div>
																								<div class='answer'>
																										<?php
																										if (trim($result[$i]->student_answer) == trim($result[$i]->answer_d) && trim($result[$i]->student_answer) == trim($result[$i]->correct_answer))
																										{
																											echo '
																											<div class="custom-control custom-radio">
																													<input class="custom-control-input" type="radio" checked disabled>
																													<label class="custom-control-label correct">' . $result[$i]->answer_d . '</label>
																											</div>
																											';
																										}
																										else
																										{
																												if (trim($result[$i]->student_answer) == trim($result[$i]->answer_d) && trim($result[$i]->student_answer) != trim($result[$i]->correct_answer))
																												{
																													echo '
																													<div class="custom-control custom-radio">
																															<input class="custom-control-input" type="radio" checked disabled>
																															<label class="custom-control-label incorrect">' . $result[$i]->answer_d . '</label>
																													</div>
																													';
																												}
																												else
																												{
																														if (trim($result[$i]->answer_d) == trim($result[$i]->correct_answer))
																														{
																															echo '
																															<div class="custom-control custom-radio">
																																	<input class="custom-control-input" type="radio" checked disabled>
																																	<label class="custom-control-label blcorrect">' . $result[$i]->answer_d . '</label>
																															</div>
																															';
																														}
																														else
																														{
																															echo '
																															<div class="custom-control custom-radio">
																																	<input class="custom-control-input" type="radio" disabled>
																																	<label class="custom-control-label nonecorrect">' . $result[$i]->answer_d . '</label>
																															</div>
																															';
																														}
																												}
																										}
																										?>
																								</div>
																						</div>
																						<p class="mt-3">Hướng dẫn: </p>
																						<p class="mt-3"><?=$result[$i]->huong_dan?></p>
														            </div>
														        </div>
														    </div>
																<?php
														}
												}
												?>
										</div>
												</div>
												</div>
											</div>
								</div>
							</div>
						</div>


<script src='res/libs/MathJax/MathJax.js?config=TeX-MML-AM_CHTML' async></script>
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
function delete_scores(test_code) {
	var url = "index.php?action=delete_scores";
	var data = {
		test_code: test_code
	}
	var success = function(result) {
		var json_data = $.parseJSON(result);
		if (json_data.status) {
			swal({
				title: 'Đã xóa kết quả !',
				text: "Giờ bạn có thể thi lại đề này :)",
				icon: "success",
				buttons: true
			}).then((goBack) => {
			        if (goBack) {
								history.go(-1);
			        }
			    })
		} else {
			swal({
				title: "Đã có lỗi xảy ra !",
				text: json_data.status_value,
				icon: "error",
				timer: 2000,
				buttons: false
			});
		}
	};
	$.post(url, data, success);
}
</script>
