
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
									<h5 class="m-b-10">Hòm thư góp ý</h5>
								</div>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="/"><i class="feather icon-home"></i></a></li>
									<li class="breadcrumb-item"><a href="#!">Hòm thư góp ý</a></li>
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
							<div class="col-md-6 col-sm-12">
								<div class="card">
										<div class="card-header">
												<h5 class="card-header-text"><i class="fas fa-plus m-r-5"></i> Góp ý - Nhận xét (Học sinh)</h5>
										</div>
										<div class="card-block task-comment">
												<ul class="media-list p-0">
													<?php
														for ($i=0; $i < count($feedback) ; $i++) {
													?>
													<li class="media mt-2" id="hs-<?=$feedback[$i]->id?>">
															<div class="media-left mr-3">
																	<a href="#!">
																			<img class="media-object img-radius comment-img" src="upload/avatar/<?=$feedback[$i]->avatar?>" alt="Generic placeholder image">
																	</a>
															</div>
															<div class="media-body">
																	<h6 class="media-heading txt-primary"><?=$feedback[$i]->name?> <span class="f-12 text-muted ml-1"><?=$feedback[$i]->time?></span></h6>
																	<p><?=$feedback[$i]->content?></p>
																	<div class="m-t-10 m-b-25">
																		<span><a href="#!" onclick="delete_feedback_hs(<?=$feedback[$i]->id?>)" class="m-r-10 text-danger">Xóa</a></span>
																	</div>
																	<hr>
															</div>
													</li>
													<?php
														}
													?>


												</ul>
										</div>
								</div>
							</div>
							<div class="col-md-6 col-sm-12">
								<div class="card">
										<div class="card-header">
												<h5 class="card-header-text"><i class="fas fa-plus m-r-5"></i> Góp ý - Nhận xét (Giáo viên)</h5>
										</div>
										<div class="card-block task-comment">
												<ul class="media-list p-0">
													<?php
														for ($i=0; $i < count($feedback_gv) ; $i++) {
													?>
													<li class="media mt-2" id="gv-<?=$feedback_gv[$i]->id?>">
															<div class="media-left mr-3">
																	<a href="#!">
																			<img class="media-object img-radius comment-img" src="upload/avatar/<?=$feedback_gv[$i]->avatar?>" alt="Generic placeholder image">
																	</a>
															</div>
															<div class="media-body">
																	<h6 class="media-heading txt-primary"><?=$feedback_gv[$i]->name?> <span class="f-12 text-muted ml-1"><?=$feedback_gv[$i]->time?></span></h6>
																	<p><?=$feedback_gv[$i]->content?></p>
																	<div class="m-t-10 m-b-25">
																		<span><a href="#!" onclick="delete_feedback_gv(<?=$feedback_gv[$i]->id?>)" class="m-r-10 text-danger">Xóa</a></span>
																	</div>
																	<hr>
															</div>
													</li>
													<?php
														}
													?>
												</ul>
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

$('#submit_feedback').on('click', function() {
		submit_feedback($('#feedback_form').serializeArray());
});
function delete_feedback_hs(id) {
          var url = "index.php?action=delete_feedback_hs";

          var success = function(result) {
              var json_data = $.parseJSON(result);
              if (json_data.status) {
									$("#hs-"+id).remove();
                  swal(json_data.status_value, {
                      icon: "success",
                  });
              } else {
                  swal({
                      title: "Lỗi !",
                      text: json_data.status_value,
                      icon: "warning"
                  });
              }
          };
          $.post(url, {"id":id}, success);
}
function delete_feedback_gv(id) {
          var url = "index.php?action=delete_feedback_gv";

          var success = function(result) {
              var json_data = $.parseJSON(result);
              if (json_data.status) {
									$("#gv-"+id).remove();
                  swal(json_data.status_value, {
                      icon: "success",
                  });
              } else {
                  swal({
                      title: "Lỗi !",
                      text: json_data.status_value,
                      icon: "warning"
                  });
              }
          };
          $.post(url, {"id":id}, success);
}

	$(document).ready(function(){
  	$("[data-name=phan-hoi]").addClass("pcoded-trigger");
	});
</script>
