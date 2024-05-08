<?php
for ($i=1; $i < 10; $i++) {
  $date_now = date_create(date("Y-m-d H:i:s"));
  $date_sub[$i] = date_sub($date_now, date_interval_create_from_date_string($i.' days'));
}
?>
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
                  <h5 class="m-b-10">HOME</h5>
                </div>
                <ul class="breadcrumb">
                  <li class="breadcrumb-item"><a href="/"><i class="feather icon-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="#!">Trang tổng quan</a></li>
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
              <div class="col-md-6 col-xl-3">
                <div class="card card-customer">
                  <a href="<?=$dashboard[0]->actionlink?>">
                    <div class="card-block">
                      <div class="row align-items-center justify-content-center">
                        <div class="col">
                          <h2 class="mb-2 f-w-300"><?=$dashboard[0]->count?></h2>
                          <h5 class="text-muted mb-0"><?=$dashboard[0]->name?></h5>
                        </div>
                        <div class="col-auto">
                          <i class="<?=$dashboard[0]->icon?> f-30 text-white theme-bg"></i>
                        </div>
                      </div>
                    </div>
                  </a>
                </div>
              </div>
              <div class="col-md-6 col-xl-3">
                <div class="card card-customer">
                  <a href="<?=$dashboard[1]->actionlink?>">
                    <div class="card-block">
                      <div class="row align-items-center justify-content-center">
                        <div class="col">
                          <h2 class="mb-2 f-w-300"><?=$dashboard[1]->count?></h2>
                          <h5 class="text-muted mb-0"><?=$dashboard[1]->name?></h5>
                        </div>
                        <div class="col-auto">
                          <i class="<?=$dashboard[1]->icon?> f-30 text-white theme-bg"></i>
                        </div>
                      </div>
                    </div>
                  </a>
                </div>
              </div>
              <div class="col-md-6 col-xl-3">
                <div class="card card-customer">
                  <a href="<?=$dashboard[4]->actionlink?>">
                    <div class="card-block">
                      <div class="row align-items-center justify-content-center">
                        <div class="col">
                          <h2 class="mb-2 f-w-300"><?=$dashboard[4]->count?></h2>
                          <h5 class="text-muted mb-0"><?=$dashboard[4]->name?></h5>
                        </div>
                        <div class="col-auto">
                          <i class="<?=$dashboard[4]->icon?> f-30 text-white theme-bg"></i>
                        </div>
                      </div>
                    </div>
                  </a>
                </div>
              </div>
              <div class="col-md-6 col-xl-3">
                <div class="card card-customer">
                  <a href="<?=$dashboard[2]->actionlink?>">
                    <div class="card-block">
                      <div class="row align-items-center justify-content-center">
                        <div class="col">
                          <h2 class="mb-2 f-w-300"><?=$dashboard[2]->count?></h2>
                          <h5 class="text-muted mb-0"><?=$dashboard[2]->name?></h5>
                        </div>
                        <div class="col-auto">
                          <i class="<?=$dashboard[2]->icon?> f-30 text-white theme-bg2"></i>
                        </div>
                      </div>
                    </div>
                  </a>
                </div>
              </div>
              <div class="col-md-6 col-xl-3">
                <div class="card card-customer">
                  <a href="<?=$dashboard[5]->actionlink?>">
                    <div class="card-block">
                      <div class="row align-items-center justify-content-center">
                        <div class="col">
                          <h2 class="mb-2 f-w-300"><?=$dashboard[5]->count?></h2>
                          <h5 class="text-muted mb-0"><?=$dashboard[5]->name?></h5>
                        </div>
                        <div class="col-auto">
                          <i class="<?=$dashboard[5]->icon?> f-30 text-white theme-bg2"></i>
                        </div>
                      </div>
                    </div>
                  </a>
                </div>
              </div>
              <div class="col-md-6 col-xl-3">
                <div class="card card-customer">
                  <a href="<?=$dashboard[6]->actionlink?>">
                    <div class="card-block">
                      <div class="row align-items-center justify-content-center">
                        <div class="col">
                          <h2 class="mb-2 f-w-300"><?=$dashboard[6]->count?></h2>
                          <h5 class="text-muted mb-0"><?=$dashboard[6]->name?></h5>
                        </div>
                        <div class="col-auto">
                          <i class="<?=$dashboard[6]->icon?> f-30 text-white theme-bg2"></i>
                        </div>
                      </div>
                    </div>
                  </a>
                </div>
              </div>
              <div class="col-md-6 col-xl-3">
                <div class="card card-customer">
                  <a href="<?=$dashboard[7]->actionlink?>">
                    <div class="card-block">
                      <div class="row align-items-center justify-content-center">
                        <div class="col">
                          <h2 class="mb-2 f-w-300"><?=$dashboard[7]->count?></h2>
                          <h5 class="text-muted mb-0"><?=$dashboard[7]->name?></h5>
                        </div>
                        <div class="col-auto">
                          <i class="<?=$dashboard[7]->icon?> f-30 text-white theme-bg2"></i>
                        </div>
                      </div>
                    </div>
                  </a>
                </div>
              </div>
              <div class="col-md-6 col-xl-3">
                <div class="card card-customer">
                  <a href="<?=$dashboard[8]->actionlink?>">
                    <div class="card-block">
                      <div class="row align-items-center justify-content-center">
                        <div class="col">
                          <h2 class="mb-2 f-w-300"><?=$dashboard[8]->count?></h2>
                          <h5 class="text-muted mb-0"><?=$dashboard[8]->name?></h5>
                        </div>
                        <div class="col-auto">
                          <i class="<?=$dashboard[8]->icon?> f-30 text-white theme-bg2"></i>
                        </div>
                      </div>
                    </div>
                  </a>
                </div>
              </div>
              <div class="col-xl-8 col-md-12">
                  <div class="card">
                      <div class="card-header">
                          <h5>Người dùng đang hoạt động</h5>
                      </div>
                      <div class="card-block  text-center">
                          <div id="chart-DynamicLineBar" style="width: 100%; height: 350px;"></div>
                      </div>
                  </div>
              </div>
              <div class="col-xl-4 col-md-12">
                <div class="card">
                  <div class="card-header">
                      <h5>Tỉ lệ tương tác</h5>
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
                      <div class="row">
                          <div class="col-sm-6 text-center m-b-20">
                              <h6 class="pb-4 d-block">Không tích cực</h6>
                              <div class="sadball"></div>
                              <h3 class="font-weight-light mt-2">8%</h3>
                              <span class="b-block pt-2">24 Học sinh</span>
                          </div>
                          <div class="col-sm-6 text-center m-b-20">
                              <h6 class="pb-4 d-block">Tích cực</h6>
                              <div class="happyball"></div>
                              <h3 class="font-weight-light mt-2">92%</h3>
                              <span class="b-block pt-2">276 Học sinh</span>
                          </div>
                          <div class="col-sm-12">
                              <a href="ti-le-tuong-tac"><button class="btn btn-primary shadow-2 text-uppercase btn-block mt-3 mr-0" type="button">Xem chi tiết</button></a>
                          </div>
                      </div>
                  </div>
                </div>
              </div>
            <div class="col-xl-12 col-md-12">
              <div class="card">
                  <div class="card-header">
                      <h5>Thống kê truy cập theo tháng</h5>
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
                      <h5>Tổng lượt truy cập: <?=$dashboard[8]->count?>
                      <div id="line-area2" class="lineAreaDashboard" style="height:330px;"></div>
                  </div>
              </div>
            </div>
            <div class="col-xl-12 col-md-12">
              <div class="card">
                <div class="card-header">
                  <h5>Những câu hỏi nhiều học sinh chọn sai</h5>
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
                <div class="card-block pl-2 pr-2 pb-2">
                <div class="row">
                  <?php
                  for ($i=0; $i < count($quest_incorrect); $i++) {
                  ?>
                  <div class="col-md-6 col-xl-4">
                      <div class="card">
                          <div class="card-body">
                              <h5 class="card-title"></h5>
                              <h6 class="card-subtitle mb-2 text-muted"></h6>
                              <p class="card-text"><?=$quest_incorrect[$i]->question_content?></p>
                              <a href="#!" class="card-link badge badge-warning">Tỉ lệ chọn sai: <?=$quest_incorrect[$i]->count?>/<?=$quest_incorrect[$i]->total?> (<?=round(($quest_incorrect[$i]->count/$quest_incorrect[$i]->total)*100)?>%)</a>
                              <a href="#!" class="card-link badge badge-info"><?=$quest_incorrect[$i]->subject_detail?></a>
                              <a href="#!" class="card-link badge badge-success">Khối <?=$quest_incorrect[$i]->grade_id?></a>
                              <a href="#!" class="card-link badge badge-secondary">Chương <?=$quest_incorrect[$i]->unit?></a>
                              <a href="#!" class="card-link badge badge badge-dark"><?=$quest_incorrect[$i]->level_detail?></a>
                          </div>
                      </div>
                  </div>
                  <?php
                  }
                   ?>
                   <div class="col-sm-12">
                       <a href="cau-hoi-chon-sai"><button class="btn btn-primary shadow-2 text-uppercase btn-block mt-3 mr-0" type="button">Xem đầy đủ danh sách</button></a>
                   </div>
                </div>
                </div>
              </div>
            </div>
              <div class="col-xl-12 col-md-12">
                <div class="card">
                  <div class="card-header">
                    <h5>Thống kê tổng quan điểm số</h5>
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
                  <div class="card-block pl-0 pr-0 pb-2">
                    <div id="bar-chart" class="ChartShadow BarChart" style="height:250px;"></div>
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
<!-- [ Main Content ] end -->

<!-- Required Js -->
<script src="assets/js/vendor-all.min.js"></script>
<script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="assets/js/pcoded.min.js"></script>
<!-- amchart js -->
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
<!-- Float Chart js -->
<script src="assets/plugins/flot/js/jquery.flot.js"></script>
<script src="assets/plugins/flot/js/jquery.flot.categories.js"></script>
<script src="assets/plugins/flot/js/curvedLines.js"></script>
<script src="assets/plugins/flot/js/jquery.flot.tooltip.min.js"></script>
<!-- Echart tags Js -->
<script src="http://echarts.baidu.com/echarts2/doc/example/timelineOption.js"></script>
<script src="assets/plugins/chart-echarts/js/echarts-en.min.js"></script>
<!-- notification Js -->
<script src="assets/plugins/notification/js/bootstrap-growl.min.js"></script>

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
    function getRndInteger(min, max) {
      return Math.floor(Math.random() * (max - min + 1) ) + min;
    }
    $(document).ready(function() {
        setTimeout(function() {
            var domdynamic = document.getElementById("chart-DynamicLineBar");
            var myChartdynamic = echarts.init(domdynamic);
            var app = {};
            var optiondyn = null;
            optiondyn = {
                title: {
                    text: 'Thống kê',
                    subtext: 'Thời gian thực'
                },
                tooltip: {
                    trigger: 'axis',
                    axisPointer: {
                        type: 'cross',
                        label: {
                            backgroundColor: '#283b56'
                        }
                    }
                },
                legend: {
                    data: ['CPU', 'Đang hoạt động']
                },
                color: ['#A389D4', '#1de9b6'],
                toolbox: {
                    show: true,
                    feature: {
                        dataView: {
                            readOnly: false
                        },
                        restore: {},
                        saveAsImage: {}
                    }
                },
                dataZoom: {
                    show: false,
                    start: 0,
                    end: 100
                },
                xAxis: [{
                    type: 'category',
                    boundaryGap: true,
                    data: (function() {
                        var now = new Date();
                        var res = [];
                        var len = 10;
                        while (len--) {
                            res.unshift(now.toLocaleTimeString().replace(/^\D*/, ''));
                            now = new Date(now - 2000);
                        }
                        return res;
                    })()
                }, {
                    type: 'category',
                    boundaryGap: true,
                    data: (function() {
                        var res = [];
                        var len = 10;
                        while (len--) {
                            res.push(10 - len - 1);
                        }
                        return res;
                    })()
                }],
                yAxis: [{
                    type: 'value',
                    scale: true,
                    name: 'Start',
                    max: 100,
                    min: 0,
                    boundaryGap: [0.2, 0.2]
                }, {
                    type: 'value',
                    scale: true,
                    name: 'End',
                    max: 200,
                    min: 0,
                    boundaryGap: [0.2, 0.2]
                }],
                series: [{
                    name: 'Đang hoạt động',
                    type: 'bar',
                    itemStyle: {
                        barBorderRadius: [15, 15, 0, 0],
                    },
                    xAxisIndex: 1,
                    yAxisIndex: 1,
                    data: (function() {
                        var res = [];
                        var len = 10;
                        while (len--) {
                            res.push(getRndInteger(58,63));
                        }
                        return res;
                    })()
                }, {
                    name: 'CPU',
                    type: 'line',
                    smooth: true,
                    data: (function() {
                        var res = [];
                        var len = 0;
                        while (len < 10) {
                            res.push((Math.random() * 10 + 5).toFixed(1) - 0);
                            len++;
                        }
                        return res;
                    })()
                }]
            };
            app.count = 11;
            setInterval(function() {
                axisData = (new Date()).toLocaleTimeString().replace(/^\D*/, '');

                var data0 = optiondyn.series[0].data;
                var data1 = optiondyn.series[1].data;
                data0.shift();
                data0.push(Math.round(getRndInteger(58,63)));
                data1.shift();
                data1.push((Math.random() * 10 + 5).toFixed(1) - 0);

                optiondyn.xAxis[0].data.shift();
                optiondyn.xAxis[0].data.push(axisData);
                optiondyn.xAxis[1].data.shift();
                optiondyn.xAxis[1].data.push(app.count++);

                myChartdynamic.setOption(optiondyn);
            }, 2100);;
            if (optiondyn && typeof optiondyn === "object") {
                myChartdynamic.setOption(optiondyn, true);
            }
        }, 700);
    });
</script>
<script type="text/javascript">
  $(document).ready(function() {
    // [ Bar Chart ] start
    var chart = AmCharts.makeChart("bar-chart", {
      "type": "serial",
      "theme": "light",
      "dataProvider": [{
        "game": "Điểm 10",
        "visits": <?=$score_analysis[10]?>,
        "color": ["#1de9b6", "#1dc4e9"]
      }, {
        "game": "Điểm 9",
        "visits": <?=$score_analysis[9]?>,
        "color": ["#a389d4", "#899ed4"]
      }, {
        "game": "Điểm 8",
        "visits": <?=$score_analysis[8]?>,
        "color": ["#04a9f5", "#049df5"]
      }, {
        "game": "Điểm 7",
        "visits": <?=$score_analysis[7]?>,
        "color": ["#52c234", "#061700"]
      }, {
        "game": "Điểm 6",
        "visits": <?=$score_analysis[6]?>,
        "color": ["#FBD3E9", "#BB377D"]
      }, {
        "game": "Điểm 5",
        "visits": <?=$score_analysis[5]?>,
        "color": ["#ADD100", "#7B920A"]
      }, {
        "game": "Điểm 4",
        "visits": <?=$score_analysis[4]?>,
        "color": ["#FF4E50", "#F9D423"]
      }, {
        "game": "Điểm 3",
        "visits": <?=$score_analysis[3]?>,
        "color": ["#556270", "#FF6B6B"]
      }, {
        "game": "Điểm 2",
        "visits": <?=$score_analysis[2]?>,
        "color": ["#70e1f5", "#ffd194"]
      }, {
        "game": "Điểm 1",
        "visits": <?=$score_analysis[1]?>,
        "color": ["#00c6ff", "#0072ff"]
      }, {
        "game": "Điểm 0",
        "visits": <?=$score_analysis[0]?>,
        "color": ["#fe8c00", "#f83600"]
      }],
      "valueAxes": [{
        "gridAlpha": 0,
        "axisAlpha": 0,
        "lineAlpha": 0,
        "fontSize": 0,
      }],
      "startDuration": 1,
      "graphs": [{
        "balloonText": "<b>[[category]] : [[value]]</b>",
        "fillColorsField": "color",
        "fillAlphas": 0.9,
        "lineAlpha": 0,
        "columnWidth": 0.2,
        "type": "column",
        "valueField": "visits"
      }],
      "chartCursor": {
        "categoryBalloonEnabled": false,
        "cursorAlpha": 0,
        "zoomable": false
      },
      "categoryField": "game",
      "categoryAxis": {
        "gridPosition": "start",
        "gridAlpha": 0,
        "axisAlpha": 0,
        "lineAlpha": 0,
      }
    });
    // [ Bar Chart ] end
    // [ statistic-line ] Start
    var chart = AmCharts.makeChart("line-area2", {
        "type": "serial",
        "theme": "light",
        "marginTop": 10,
        "marginRight": 0,
        "dataProvider": [{
            "year": "<?=date_format(date_create($analysis_login_month[8]->time),"m/Y")?>",
            "value": <?=$analysis_login_month[8]->count?>
          }, {
            "year": "<?=date_format(date_create($analysis_login_month[7]->time),"m/Y")?>",
            "value": <?=$analysis_login_month[7]->count?>
          }, {
            "year": "<?=date_format(date_create($analysis_login_month[6]->time),"m/Y")?>",
            "value": <?=$analysis_login_month[6]->count?>
          }, {
            "year": "<?=date_format(date_create($analysis_login_month[5]->time),"m/Y")?>",
            "value": <?=$analysis_login_month[5]->count?>
          }, {
            "year": "<?=date_format(date_create($analysis_login_month[4]->time),"m/Y")?>",
            "value": <?=$analysis_login_month[4]->count?>
          }, {
            "year": "<?=date_format(date_create($analysis_login_month[3]->time),"m/Y")?>",
            "value": <?=$analysis_login_month[3]->count?>
          }, {
            "year": "<?=date_format(date_create($analysis_login_month[2]->time),"m/Y")?>",
            "value": <?=$analysis_login_month[2]->count?>
        }, {
            "year": "<?=date_format(date_create($analysis_login_month[1]->time),"m/Y")?>",
            "value": <?=$analysis_login_month[1]->count?>
        }, {
            "year": "<?=date_format(date_create($analysis_login_month[0]->time),"m/Y")?>",
            "value": <?=$analysis_login_month[0]->count?>
        }],
        "valueAxes": [{
            "axisAlpha": 0,
            "position": "left"
        }],
        "graphs": [{
            "id": "g1",
            "balloonText": "[[category]]<br><b><span style='font-size:14px;'>[[value]]</span></b>",
            "bullet": "round",
            "lineColor": "#1de9b6",
            "lineThickness": 3,
            "negativeLineColor": "#1de9b6",
            "valueField": "value"
        }],
        "chartCursor": {
            "cursorAlpha": 0,
            "valueLineEnabled": true,
            "valueLineBalloonEnabled": true,
            "valueLineAlpha": 0.3,
            "fullWidth": true
        },
        "categoryField": "year",
        "categoryAxis": {
            "minorGridAlpha": 0,
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
    // [ statistic-line ] end
            var loadingEle = $('.loading');
            $('.sadball').createWaterBall({
                cvs_config: {
                    width: 110,
                    height: 110
                },
                wave_config: {
                    waveWidth: 0.025,
                    waveHeight: 3
                },
                data_range: [30, 70, 100],
                isLoading: true,
                nowRange: 8,
                targetRange: 8
            });
            $('.happyball').createWaterBall({
                cvs_config: {
                    width: 110,
                    height: 110
                },
                wave_config: {
                    waveWidth: 0.025,
                    waveHeight: 3
                },
                data_range: [30, 70, 100],
                isLoading: true,
                nowRange: 92,
                targetRange: 92
            });
            setTimeout(function() {
                $('.sadball').createWaterBall('updateRange', 8);
                $('.happyball').createWaterBall('updateRange', 92);
            }, 1000);
        });
</script>

<script type="text/javascript">
	$(document).ready(function(){
  	$("[data-name=trang-tong-quan]").addClass("pcoded-trigger");
	});
</script>
