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
									<h5 class="m-b-10">Điểm số</h5>
								</div>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="/"><i class="feather icon-home"></i></a></li>
									<li class="breadcrumb-item"><a href="#!">Thống kê điểm số của học sinh</a></li>
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
							<div class="col-xl-4 col-md-12">
								<div class="card">
								    <div class="card-header">
								        <h5>Tổng quan</h5>
								    </div>
								    <div class="card-block">
								        <div id="chart-highchart-pie-3d2" style="width: 100%; height: 350px;"></div>
								    </div>
								</div>
							</div>
							<div class="col-xl-8 col-md-12">
								<div class="card">
								    <div class="card-header">
								        <h5>Theo các tháng</h5>
								    </div>
								    <div class="card-block">
								        <div id="chart-highchart-combo1" style="width: 100%; height: 450px;"></div>
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
<!-- High chart Js -->
<script src="assets/plugins/chart-highchart/js/highcharts.js"></script>
<script src="assets/plugins/chart-highchart/js/highcharts-3d.js"></script>
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
</script>
<script type="text/javascript">
		$(document).ready(function() {
				setTimeout(function() {

						Highcharts.chart('chart-highchart-pie-3d2', {
								chart: {
										type: 'pie',
										options3d: {
												enabled: true,
												alpha: 45
										}
								},
								colors: ['#1de9b6', '#1dc4e9', '#A389D4', '#ed4902', '#f44236', '#f4c22b'],
								title: {
										text: 'Biểu đồ thống kê mức điểm'
								},
								subtitle: {
										text: 'của toàn bộ học sinh'
								},
								plotOptions: {
										pie: {
												innerSize: 80,
												depth: 45
										}
								},
								series: [{
										name: 'Số lượng',
										data: [
												['Giỏi', 512],
												['Khá', 935],
												['Trung bình', 1317],
												['Yếu kém', 350]
										]
								}]
						});

				}, 700);
		});
</script>
<script type="text/javascript">
		$(document).ready(function() {
				setTimeout(function() {

						Highcharts.chart('chart-highchart-combo1', {
								title: {
										text: 'Biểu đồ theo dõi qua các tháng'
								},
								xAxis: {
										categories: ['11/2019', '12/2019'],
								},
								colors: ['#1de9b6', '#1dc4e9', '#A389D4', '#ed4902', '#f44236', '#f4c22b'],
								labels: {
										items: [{
												html: 'Tổng',
												style: {
														left: '50px',
														top: '18px',
														color: (Highcharts.theme && Highcharts.theme.textColor) || 'black'
												}
										}]
								},
								series: [{
										type: 'column',
										name: 'Điểm 8 - 10',
										data: [7, 9]
								}, {
										type: 'column',
										name: 'Điểm 7 - 8',
										data: [29, 36]
								}, {
										type: 'column',
										name: 'Điểm 5 - 7',
										data: [44, 48]
								},	{
										type: 'column',
										name: 'Điểm 0 - 5',
										data: [20, 7]
								},  {
										type: 'pie',
										name: 'Số lượng',
										data: [{
												name: 'Giỏi',
												y: 512,
												color: '#1de9b6'
										}, {
												name: 'Khá',
												y: 935,
												color: '#1dc4e9',
										}, {
												name: 'Trung bình',
												y: 1317,
												color: '#A389D4',
										}, {
												name: 'Yếu kém',
												y: 350,
												color: '#ed4902',
										}],
										center: [100, 80],
										size: 100,
										showInLegend: false,
										dataLabels: {
												enabled: false
										}
								}]
						});

				}, 700);
		});
</script>
<script type="text/javascript">
	$(document).ready(function(){
  	$("[data-name=tai-lieu]").addClass("pcoded-trigger");
	});
</script>
