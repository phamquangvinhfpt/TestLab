
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
									<h5 class="m-b-10">Đóng góp ý kiến</h5>
								</div>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="/"><i class="feather icon-home"></i></a></li>
									<li class="breadcrumb-item"><a href="#!">Đóng góp ý kiến</a></li>
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
								        <h5>Gửi góp ý, nhận xét</h5>
								    </div>
								    <div class="card-body">
								        <div class="row">
								            <div class="col-md-12">
								                <form id="feedback_form">
								                    <div class="form-group">
								                        <label for="gop-y">Viết góp ý, nhận xét</label>
								                        <textarea name="feedback" class="form-control" id="gop-y" rows="3"></textarea>
								                    </div>
								                </form>
								            </div>
								        </div>
								            <button id="submit_feedback" class="btn btn-primary" type="submit">Gửi</button>
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
function submit_feedback(data) {
	console.log(data);
          var url = "index.php?action=submit_feedback";
          var success = function(result) {
              var json_data = $.parseJSON(result);
              if (json_data.status) {
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
          $.post(url, data, success);
}

	$(document).ready(function(){
  	$("[data-name=phan-hoi]").addClass("pcoded-trigger");
	});
</script>
