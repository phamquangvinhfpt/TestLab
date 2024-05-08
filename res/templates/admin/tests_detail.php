











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
									<h5 class="m-b-10">Thi thử</h5>
								</div>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="/"><i class="feather icon-home"></i></a></li>
									<li class="breadcrumb-item"><a href="#!">Kho đề thi thử</a></li>
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
                    <h5>Chi tiết đề thi</h5>
                </div>
                <div class="card-body">
									<table class="striped centered responsive-table" id="questions">
										<thead>
											<tr>
												<th class="">ID</th>
												<th class="">Nội Dung Câu Hỏi</th>
												<th class="">Đáp Án</th>
											</tr>
										</thead>
										<tbody>
											<?php
											for($i = 0; $i < count($questions); $i++) {
												?>
												<tr>
													<td><?=$questions[$i]->question_id?></td>
													<td><?=$questions[$i]->question_content?></td>
													<td><?=$questions[$i]->correct_answer?></td>
												</tr>
												<?php
											}
											?>
										</tbody>
									</table>
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
  	$("[data-name=to-chuc-thi]").addClass("pcoded-trigger");
	});
</script>

<script>
	$('#questions').DataTable( {

		"language": {
			"lengthMenu": "Hiển thị _MENU_",
			"zeroRecords": "Không tìm thấy",
			"info": "Hiển thị trang _PAGE_/_PAGES_",
			"infoEmpty": "Không có dữ liệu",
			"emptyTable": "Không có dữ liệu",
			"infoFiltered": "(tìm kiếm trong tất cả _MAX_ mục)",
			"sSearch": "Tìm kiếm",
			"paginate": {
				"first":      "Đầu",
				"last":       "Cuối",
				"next":       "Sau",
				"previous":   "Trước"
			},
		},
		"drawCallback": function(settings) {
				MathJax.Hub.Queue(["Typeset", MathJax.Hub]);
		}
    } );
</script>
