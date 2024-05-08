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
									<h5 class="m-b-10">Tương tác</h5>
								</div>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="/"><i class="feather icon-home"></i></a></li>
									<li class="breadcrumb-item"><a href="#!">Tỉ lệ tương tác</a></li>
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
								        <div id="chart-highchart-line1" style="width: 100%; height: 350px;"></div>
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
								colors: ['#1dc4e9', '#ed4902', '#A389D4', '#1dc4e9', '#f44236', '#f4c22b'],
								title: {
										text: 'Biểu đồ tỉ lệ tương tác'
								},
								subtitle: {
										text: 'của toàn bộ học sinh tháng này'
								},
								plotOptions: {
										pie: {
												innerSize: 80,
												depth: 45
										}
								},
								series: [{
										name: '%',
										data: [
												['Tích cực', 92],
												['Không tích cực', 8]
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
										categories: ['07/2019', '08/2019', '09/2019', '10/2019', '11/2019', '12/2019', '01/2019'],
								},
								colors: ['#1dc4e9', '#ed4902', '#A389D4', '#1dc4e9', '#f44236', '#f4c22b'],
								series: [{
										type: 'column',
										name: 'Tích cực',
										data: [57, 62, 69, 75, 79, 86, 92]
								}, {
										type: 'column',
										name: 'Không tích cực',
										data: [43, 38, 31, 25, 21, 14, 8]
								}]
						});

				}, 700);
		});
</script>
<script type="text/javascript">
    $(document).ready(function() {
        setTimeout(function() {

            Highcharts.chart('chart-highchart-line1', {
                chart: {
                    type: 'spline',
                },
                colors: ['#1dc4e9', '#ed4902'],
                title: {
                    text: 'Tỉ lệ tương tác qua các tháng'
                },
                subtitle: {
                    text: ''
                },
                yAxis: {
                    title: {
                        text: 'Tỉ lệ %'
                    }
                },
								xAxis: {
										categories: ['07/2019', '08/2019', '09/2019', '10/2019', '11/2019', '12/2019', '01/2019'],
								},
                series: [{
                    name: 'Tích cực',
                    data: [57, 62, 63, 75, 74, 86, 92]
                }, {
                    name: 'Không tích cực',
                    data: [43, 38, 37, 25, 26, 14, 8]
                }],
                responsive: {
                    rules: [{
                        condition: {
                            maxWidth: 500
                        },
                        chartOptions: {
                            legend: {
                                layout: 'horizontal',
                                align: 'center',
                                verticalAlign: 'bottom'
                            }
                        }
                    }]
                }
            });

        }, 700);
    });
</script>
<script type="text/javascript">
	$(document).ready(function(){
  	$("[data-name=tai-lieu]").addClass("pcoded-trigger");
	});
</script>
