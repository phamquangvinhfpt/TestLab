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
                  <h5 class="m-b-10">Đề thi</h5>
                </div>
                <ul class="breadcrumb">
                  <li class="breadcrumb-item"><a href="/"><i class="feather icon-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="#!">Tạo đề thi</a></li>
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
              <!-- [ Student list ] start -->
              <!-- [ Student list ] end -->
              <div id="hd_modal">
              </div>

              <div id="add" class="col-xl-12 col-md-12">
                <form id="add_test_form">
                <div class="card">
                  <div class="card-header">
                    <h5>Tạo đề từ ngân hàng câu hỏi</h5>
                  </div>
                  <div class="card-block">
                    <div class="row">
                      <div class="col-12 col-md-6">
                      </div>
                    </div>
                    <!-- [ SmartWizard html ] start -->
                    <div id="smartwizard">
                      <ul>
                        <li><a href="#step-1">
                            <h6>Bước 1</h6>
                            <p class="m-0">Nhập thông tin đề</p>
                          </a></li>
                        <li><a href="#step-2">
                            <h6>Bước 2</h6>
                            <p class="m-0">Nhập thông tin câu hỏi</p>
                          </a></li>
                        <li><a href="#step-3">
                            <h6>Bước 3</h6>
                            <p class="m-0">Hoàn tất</p>
                          </a></li>
                      </ul>

                      <div>
                        <div id="step-1">
                          <form>
                            <div class="form-row">
                              <div class="form-group col-md-6">
                                <label for="test_name">Tên đề thi</label>
                                <input type="text" class="form-control" id="test_name" placeholder="Tên đề thi" name="test_name">
                              </div>
                              <div class="form-group col-md-6">
                                <label for="test_password">Mật khẩu</label>
                                <input type="password" class="form-control" id="test_password" placeholder="Mật khẩu" name="password">
                              </div>
                              <div class="form-group col-md-6">
                                <label for="grade_id">Khối</label>
        												<select class="form-control column_filter" id="test_grade" name="grade_id"></select>
                              </div>
                              <div class="form-group col-md-6">
                                <label for="subject_id">Môn Học</label>
        												<select class="form-control column_filter" id="test_subject" name="subject_id"></select>
                              </div>
                              <div class="form-group col-md-6">
                                <label for="test_type">Phân loại</label>
                                <select class="form-control" name="test_type" id="test_type">
                                  <option value="1">Đề thi thử</option>
                                  <option value="2">Đề ôn luyện</option>
                                  <option value="3">Đề khảo sát</option>
                                </select>
                              </div>
                            </div>
                          </form>
                        </div>
                        <div id="step-2">
                          <div id="list_unit">

                          </div>
                        </div>
                        <div id="step-3">
                          <form>
                            <div class="form-row">
                              <div class="form-group col-md-6">
                                <label for="test_name">Số câu đã chọn</label>
                                <input type="number" class="form-control" id="total_questions" placeholder="Tổng số câu" readonly name="total_questions">
                              </div>
                              <div class="form-group col-md-6">
                                <label for="test_password">Thời gian làm bài (phút)</label>
                                <input type="number" class="form-control" id="test_name" placeholder="Thời gian làm bài" name="time_to_do">
                              </div>
                              <div class="form-group col-md-12">
                                <label for="grade_id">Ghi chú</label>
                                <input type="text" class="form-control" id="test_name" placeholder="Ghi chú" name="note">
                              </div>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
</form>
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
<script src="res/js/tests_panel.js"></script>
<!-- sweet alert Js -->
<script src="assets/plugins/sweetalert/js/sweetalert.min.js"></script>
<!-- Smart Wizard css -->
<link href="assets/plugins/smart-wizard/css/smart_wizard.min.css" rel="stylesheet">
<link href="assets/plugins/smart-wizard/css/smart_wizard_theme_arrows.min.css" rel="stylesheet">
<link href="assets/plugins/smart-wizard/css/smart_wizard_theme_circles.min" rel="stylesheet">
<link href="assets/plugins/smart-wizard/css/smart_wizard_theme_dots.min.css" rel="stylesheet">
<!-- Smart Wizard Js -->
<script src="assets/plugins/wizard/js/jquery.bootstrap.js"></script>
<script src="assets/plugins/smart-wizard/js/jquery.smartWizard.min.js"></script>

<script type="text/javascript">
  $(document).ready(function() {
    $("[data-name=tao-de]").addClass("pcoded-trigger");
  });
</script>
<script type="text/javascript">
  $(document).ready(function() {
    var data_test = {};
    var btnFinish = $('<button id="finish" style="display: none;"></button>').text('Finish')
                                 .addClass('btn btn-info')
                                 .on('click', function(){
                                   submit_add_test($('form').serializeArray());
                                 });
    setTimeout(function() {
      $('#smartwizard').smartWizard({
        theme: 'dots',
        transitionEffect: 'fade',
        autoAdjustHeight: false,
        useURLhash: false,
        showStepURLhash: false,
        lang: {
          next: 'Tiếp',
          previous: 'Trước'
        },
        toolbarSettings: {toolbarPosition: 'bottom',
                  toolbarButtonPosition: 'end',
                  toolbarExtraButtons: [btnFinish]
                }
      });
    }, 700);
    $("#smartwizard").on("leaveStep", function(e, anchorObject, stepNumber, stepDirection) {
       if (stepNumber == 0) {
         data_test.name = $("#test_name").val();
         data_test.password = $("#test_password").val();
         data_test.grade = $("#test_grade").val();
         data_test.subject = $("#test_subject").val();
         if (data_test.name == '' || data_test.password == '' || data_test.grade == '' || data_test.subject == '') {
           alert('Bạn chưa nhập đầy đủ thông tin, vui lòng kiểm tra lại !');
           return false;
         } else {
           return true;
         }
       }
    });
    $("#smartwizard").on("showStep", function(e, anchorObject, stepNumber, stepDirection) {
      if (stepNumber == 2) {
        $('#finish').show();
      } else {
        $('#finish').hide();
      }
    });
    $("#test_grade").change(function(){
     list_unit();
    });
    $("#test_subject").change(function(){
     list_unit();
    });

  });
</script>
