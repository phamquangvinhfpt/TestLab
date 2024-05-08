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
									<h5 class="m-b-10">Thống kê</h5>
								</div>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="/"><i class="feather icon-home"></i></a></li>
									<li class="breadcrumb-item"><a href="#!">Tỉ lệ chọn sai của học sinh</a></li>
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
							<div class="col-xl-4 col-sm-12 datta-example">
								<div class="card">
								    <div class="card-header">
								        <h5>Thống kê tháng này</h5>
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
								        <div id="device-chart" class="device-chart" style="width:250px;height:250px;"></div>
								        <div class="row">
								            <div class="col-sm-12 pt-3 pb-3 border-top">
								                <span class="mr-3"><i class="feather icon-circle text-c-green  mr-2"></i>Trả lời đúng</span>
								                <span class="float-right"><?=$analysis[0]->correct?> %</span>
								            </div>

								            <div class="col-sm-12 pt-3 pb-3 border-top">
								                <span class="mr-3"><i class="feather icon-circle text-c-blue  mr-2"></i>Trả lời sai</span>
								                <span class="float-right"><?=$analysis[0]->incorrect?> %</span>
								            </div>

								            <div class="col-sm-12 pt-3 border-top">
								                <span class="mr-3"><i class="feather icon-circle text-c-purple  mr-2"></i>Không có câu trả lời</span>
								                <span class="float-right"><?=$analysis[0]->blank?> %</span>
								            </div>
								        </div>
								    </div>
								</div>
							</div>
							<div class="col-xl-8 col-md-12 datta-example">
								<div class="card">
							    <div class="card-header">
							        <h5>Biểu đồ thống kê sự thay đổi qua các tháng</h5>
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
							        <div id="line-chart1" class="ChartShadow" style="height:350px;"></div>
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
</script>
<script type="text/javascript">
		$(document).ready(function() {
		    $('#question').DataTable();
		} );
		$(document).ready(function() {
				var chart = AmCharts.makeChart("device-chart", {
						"type": "pie",
						"theme": "light",
						"labelRadius": -35,
						"labelText": "[[percents]]%",
						"dataProvider": [{
								"device": "Bỏ trống",
								"percentage": <?=$analysis[0]->blank?>,
								"color": "#a389d4"
						}, {
								"device": "Trả lời sai",
								"percentage": <?=$analysis[0]->incorrect?>,
								"color": "#04a9f5"
						}, {
								"device": "Trả lời đúng",
								"percentage": <?=$analysis[0]->correct?>,
								"color": "#1de9b6"
						}],
						"valueField": "percentage",
						"titleField": "device",
						"colorField": "color",
						"balloon": {
								"fixedPosition": true
						},
				});
		});
</script>
<script type="text/javascript">
    $(document).ready(function() {
        var chart = AmCharts.makeChart("line-chart1", {
            "type": "serial",
            "theme": "light",
            "marginTop": 10,
            "marginRight": 0,
            "dataProvider": [{
                "year": "<?=date_format(date_create($analysis[5]->time),"m-Y")?>",
								"value": <?=$analysis[5]->correct?>,
                "value2": <?=$analysis[5]->incorrect?>,
                "value3": <?=$analysis[5]->blank?>,
            }, {
                "year": "<?=date_format(date_create($analysis[4]->time),"m-Y")?>",
								"value": <?=$analysis[4]->correct?>,
                "value2": <?=$analysis[4]->incorrect?>,
                "value3": <?=$analysis[4]->blank?>,
            }, {
                "year": "<?=date_format(date_create($analysis[3]->time),"m-Y")?>",
								"value": <?=$analysis[3]->correct?>,
                "value2": <?=$analysis[3]->incorrect?>,
                "value3": <?=$analysis[3]->blank?>,
            }, {
                "year": "<?=date_format(date_create($analysis[2]->time),"m-Y")?>",
								"value": <?=$analysis[2]->correct?>,
                "value2": <?=$analysis[2]->incorrect?>,
                "value3": <?=$analysis[2]->blank?>,
            }, {
                "year": "<?=date_format(date_create($analysis[1]->time),"m-Y")?>",
								"value": <?=$analysis[1]->correct?>,
                "value2": <?=$analysis[1]->incorrect?>,
                "value3": <?=$analysis[1]->blank?>,
            }, {
                "year": "<?=date_format(date_create($analysis[0]->time),"m-Y")?>",
                "value": <?=$analysis[0]->correct?>,
                "value2": <?=$analysis[0]->incorrect?>,
                "value3": <?=$analysis[0]->blank?>,
            }],
            "valueAxes": [{
                "axisAlpha": 0,
                "position": "left"
            }],
            "graphs": [{
                "id": "g1",
                "balloonText": "[[category]]<br><b><span style='font-size:14px;'>[[value]]</span></b>",
                "bullet": "false",
                "lineColor": "#2cd929",
                "lineThickness": 3,
                "negativeLineColor": "#2cd929",
                "type": "smoothedLine",
                "valueField": "value"
            }, {
                "id": "g2",
                "balloonText": "[[category]]<br><b><span style='font-size:14px;'>[[value]]</span></b>",
                "bullet": "false",
                "lineColor": "#29bdf5",
                "lineThickness": 3,
                "negativeLineColor": "#29bdf5",
                "type": "smoothedLine",
                "valueField": "value2"
            }, {
                "id": "g3",
                "balloonText": "[[category]]<br><b><span style='font-size:14px;'>[[value]]</span></b>",
                "bullet": "false",
                "lineColor": "#a389d4",
                "lineThickness": 3,
                "negativeLineColor": "#a389d4",
                "type": "smoothedLine",
                "valueField": "value3"
            }],
            "chartCursor": {
                "cursorAlpha": 0,
                "valueLineEnabled": true,
                "valueLineBalloonEnabled": true,
                "valueLineAlpha": 0.5,
                "fullWidth": true
            },
            "categoryField": "year",
            "categoryAxis": {
                "minorGridAlpha": 0.1,
                "minorGridEnabled": true,
                "gridAlpha": 0,
                "axisAlpha": 0,
                "lineAlpha": 0
            },
            "legend": {
                "useGraphSettings": true,
                "position": "top"
            },
        });
    });
</script>
<script type="text/javascript">
	$(document).ready(function(){
  	$("[data-name=tai-lieu]").addClass("pcoded-trigger");
	});
</script>
