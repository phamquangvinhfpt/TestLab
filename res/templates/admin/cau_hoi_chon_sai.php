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
									<h5 class="m-b-10">Danh sách</h5>
								</div>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="/"><i class="feather icon-home"></i></a></li>
									<li class="breadcrumb-item"><a href="#!">Thống kê</a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<!-- [ breadcrumb ] end -->
				<div class="main-body">
					<div class="page-wrapper">
						<!-- [ Main Content ] start -->
						<style media="screen">
						th, td {
							text-align: center;
							padding: 16px;
						}
						th:first-child, td:first-child {
						  text-align: left;
						}
						</style>
						<div class="row">
							<div class="col-xl-12 col-md-12 datta-example">
								<div class="card Application-list">
							    <div class="card-header">
							        <h5>Danh sách phân tích câu trả lời của học sinh</h5>
							        <div class="card-header-right">
							            <div class="btn-group card-option">
							                <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							                    <i class="feather icon-more-horizontal"></i>
							                </button>
							                <ul class="list-unstyled card-option dropdown-menu dropdown-menu-right">
							                    <li class="dropdown-item full-card"><a href="#!"><span><i class="feather icon-maximize"></i> maximize</span><span style="display:none"><i class="feather icon-minimize"></i> Restore</span></a></li>
							                    <li class="dropdown-item minimize-card"><a href="#!"><span><i class="feather icon-minus"></i> collapse</span><span style="display:none"><i class="feather icon-plus"></i> expand</span></a></li>
							                    <li class="dropdown-item reload-card"><a href="#!"><i class="feather icon-refresh-cw"></i> reload</a></li>
							                    <li class="dropdown-item close-card"><a href="#!"><i class="feather icon-trash"></i> remove</a></li>
							                </ul>
							            </div>
							        </div>
							    </div>
							    <div class="card-block">
										<table id="question" style="width: 100%">
									    <colgroup>
									       <col span="1" style="width: 25%;">
									       <col span="1" style="width: 15%;">
									       <col span="1" style="width: 15%;">
												 <col span="1" style="width: 15%;">
												 <col span="1" style="width: 15%;">
												 <col span="1" style="width: 15%;">
									    </colgroup>
									    <thead>
													<th>Câu hỏi</th>
													<th>A</th>
													<th>B</th>
													<th>C</th>
													<th>D</th>
													<th>Tùy chỉnh</th>
											</thead>
									    <tbody>
												<?php
												for ($i=0; $i < count($analysis) ; $i++) {
													$quest_warning = true;
													if ($quest_warning) {
												?>
												<tr>
														<td><h6 class="mt-3"><?=$analysis[$i]->question_content?>
															<p class="mt-3">
															<a href="#!" class="card-link badge badge-warning">Tỉ lệ chọn đúng: <?=($analysis[$i]->total-$analysis[$i]->count)?>/<?=$analysis[$i]->total?> (<?=round((($analysis[$i]->total-$analysis[$i]->count)/$analysis[$i]->total)*100)?>)%</a>
                              <a href="#!" class="card-link badge badge-info"><?=$analysis[$i]->subject_detail?></a>
                              <a href="#!" class="card-link badge badge-success">Khối <?=$analysis[$i]->grade_id?></a>
                              <a href="#!" class="card-link badge badge-secondary">Chương <?=$analysis[$i]->unit?></a>
                              <a href="#!" class="card-link badge badge badge-dark"><?=$analysis[$i]->level_detail?></a>
															</p>
														</h6></td>
														<td><?=$analysis[$i]->answer_a?>
															<p>
																<a href="#!" class="card-link badge badge-info"><?=$analysis[$i]->ratio_a?>%</a>
															</p>
														</td>
														<td><?=$analysis[$i]->answer_b?>
															<p>
																<a href="#!" class="card-link badge badge-info"><?=$analysis[$i]->ratio_b?>%</a>
															</p>
														</td>
														<td><?=$analysis[$i]->answer_c?>
															<p>
																<a href="#!" class="card-link badge badge-info"><?=$analysis[$i]->ratio_c?>%</a>
															</p>
														</td>
														<td><?=$analysis[$i]->answer_d?>
															<p>
																<a href="#!" class="card-link badge badge-info"><?=$analysis[$i]->ratio_d?>%</a>
															</p>
														</td>
														<td>
															<div class="btn-group mb-2 mr-2 ">
											            <button class="btn drp-icon btn-rounded btn-outline-info dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="feather icon-info"></i></button>
											            <div class="dropdown-menu">
											                <a class="dropdown-item" href="sua-cau-hoi-<?=$analysis[$i]->question_id?>">Sửa</a>
											                <a class="dropdown-item" onclick="submit_del_question(<?=$analysis[$i]->question_id?>)" href="#!">Xóa</a>
											            </div>
											        </div>
														</td>
												</tr>
												<?php
													}
												}
												?>
									    </tbody>
									</table>
							    </div>
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
<!-- Am chart4 Js -->
<script src="assets/plugins/amchart/js/amcharts.js"></script>
<script src="assets/plugins/amchart/js/gauge.js"></script>
<script src="assets/plugins/amchart/js/serial.js"></script>
<script src="assets/plugins/amchart/js/light.js"></script>
<script src="assets/plugins/amchart/js/pie.min.js"></script>
<script src="assets/plugins/amchart/js/ammap.min.js"></script>
<script src="assets/plugins/amchart/js/usaLow.js"></script>
<script src="assets/plugins/amchart/js/radar.js"></script>
<script src="assets/plugins/amchart/js/worldLow.js"></script>
<!-- WaterBall Js -->
<script src="assets/plugins/waterball/js/createWaterBall-jquery.js"></script>
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
		$(document).ready(function() {
				$('#question').DataTable({
					"drawCallback": function(settings) {
							MathJax.Hub.Queue(["Typeset", MathJax.Hub]);
					}
				});
		} );
</script>
<script type="text/javascript">
function submit_del_question(data) {
  swal({
        title: "Xóa câu hỏi?",
        text: "Bạn có chắc muốn xóa câu hỏi này chứ ?",
        icon: "warning",
        buttons: ["Hủy","Xóa"],
        dangerMode: true,
    })
    .then((okay) => {
        if (okay) {
            data = 'question_id='+ data;
            var url = "index.php?action=check_del_question";
            var success = function(result) {
              var json_data = $.parseJSON(result);
              show_status(json_data);
              if (json_data.status) {
                $('#responsive-table-model').DataTable().ajax.reload();
                swal("Đã xóa câu hỏi !", {
                    icon: "success",
                });
              } else {
                  swal(json_data.status_value, {
                      icon: "error",
                  });
              }
            };
            $.post(url, data, success);
        }
    });
}
	$(document).ready(function(){
  	$("[data-name=tai-lieu]").addClass("pcoded-trigger");
	});
</script>
