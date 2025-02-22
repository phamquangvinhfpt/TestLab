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
                            <!-- [ Select2 ] start -->
                            <div class="col-sm-12">
                                <div class="card select-card">
                                    <div class="card-header">
                                        <h5>Tạo đề tuỳ chỉnh</h5>
                                    </div>
                                    <div class="card-block">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <form>
                                                    <div class="form-group">
                                                        <label for="name-test">Tên đề</label>
                                                        <input type="text" class="form-control" id="test_name"
                                                            name="test_name">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="pass-test">Mật khẩu</label>
                                                        <input type="password" class="form-control" id="test_password"
                                                            placeholder="Password" name="password">
                                                    </div>

                                            </div>
                                            <div class="col-md-6">

                                                <div class="form-group">
                                                    <label>Thời gian</label>
                                                    <input type="number" class="form-control" id="test_name"
                                                        name="time_to_do">
                                                </div>
                                                <div class="form-group">
                                                    <label for="note-test">Ghi chú</label>
                                                    <textarea class="form-control" id="test_name" placeholder="Ghi chú"
                                                        name="note" rows="3"></textarea>
                                                </div>

                                            </div>
                                            <div class="col-xl-4 col-md-6 mb-5">
                                                <h5>Chọn khối lớp</h5>
                                                <hr>
                                                <select class="js-example-basic-single form-control" id="test_grade"
                                                    name="grade_id">
                                                </select>
                                            </div>
                                            <div class="col-xl-4 col-md-6 mb-5">
                                                <h5>Chọn môn học</h5>
                                                <hr>
                                                <select class="js-example-basic-single form-control" id="test_subject"
                                                    name="subject_id">
                                                </select>
                                            </div>
                                            <div class="col-xl-4 col-md-6 mb-5">
                                                <h5>Phân loại đề</h5>
                                                <hr>
                                                <select class="js-example-basic-single form-control" name="test_type"
                                                    id="test_type">
                                                    <option value="1">Đề thi</option>
                                                    <option value="2">Đề ôn luyện</option>
                                                    <option value="3">Đề Khảo sát</option>
                                                </select>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h5>Chọn câu hỏi</h5>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="card-block">
                                            <div class="row" style="margin-bottom: 35px;">
                                                <div class="col-sm-6 col-md-3 col-xl-3" data-column="4">
                                                    <label for="">Môn Học</label>
                                                    <select class="form-control column_filter" id="col4_filter"
                                                        name="subject_id"></select>
                                                </div>
                                                <div class="col-sm-6 col-md-3 col-xl-3" data-column="5">
                                                    <label for="">Khối</label>
                                                    <select class="form-control column_filter" id="col5_filter"
                                                        name="grade_id"></select>
                                                </div>
                                                <div class="col-sm-6 col-md-3 col-xl-3" data-column="6">
                                                    <label for="">Chương</label>
                                                    <select class="form-control column_filter" id="col6_filter"
                                                        name="unit">
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        <option value="6">6</option>
                                                        <option value="7">7</option>
                                                        <option value="8">8</option>
                                                        <option value="9">9</option>
                                                    </select>
                                                </div>
                                                <div class="col-sm-6 col-md-3 col-xl-3" data-column="7">
                                                    <label for="subject_id">Độ Khó</label>
                                                    <select class="form-control column_filter" id="col7_filter"
                                                        name="level_id">
                                                        <option value="1">Nhận biết</option>
                                                        <option value="2">Thông hiểu</option>
                                                        <option value="3">Vận dụng</option>
                                                        <option value="4">Vận dụng cao</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <style media="screen">
                                            th,
                                            td {
                                                text-align: center;
                                                padding: 16px;
                                            }

                                            th:nth-child(3),
                                            td:nth-child(3) {
                                                text-align: left;
                                            }
                                            </style>
                                            <table id="responsive-table-model" style="width: 100%">
                                                <colgroup>
                                                    <col span="1" style="width: 3%;">
                                                    <col span="1" style="width: 3%;">
                                                    <col span="1" style="width: 40%;">
                                                    <col span="1" style="width: 24%;">
                                                    <col span="1" style="width: 5%;">
                                                    <col span="1" style="width: 5%;">
                                                    <col span="1" style="width: 3%;">
                                                    <col span="1" style="width: 10%;">
                                                    <col span="1" style="width: 7%;">
                                                </colgroup>
                                                <thead>
                                                    <th>
                                                        <div class="checkbox checkbox-danger d-inline"><input
                                                                type="checkbox" name="select_all" id="select_all"><label
                                                                for="select_all" class="cr"></label></div>
                                                    </th>
                                                    <th>ID</th>
                                                    <th>Câu Hỏi</th>
                                                    <th>Đáp án</th>
                                                    <th>Môn Học</th>
                                                    <th>Khối</th>
                                                    <th>Chương</th>
                                                    <th>Độ Khó</th>
                                                    <th><i class="fas fa-edit"></i></th>
                                                </thead>
                                                <tbody id="list_questions">
                                                </tbody>
                                            </table>
                                            <div id="sp_ld" class="d-flex justify-content-center"
                                                style="padding-bottom: 30px;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h5>Câu hỏi đã chọn <span id="count">( 0 câu )</span></h5>
                                    </div>
                                    <div class="card-block">
                                        <table>
                                            <colgroup>
                                                <col span="1" style="width: 3%;">
                                                <col span="1" style="width: 3%;">
                                                <col span="1" style="width: 40%;">
                                                <col span="1" style="width: 24%;">
                                                <col span="1" style="width: 5%;">
                                                <col span="1" style="width: 5%;">
                                                <col span="1" style="width: 3%;">
                                            </colgroup>
                                            <thead>
                                                <th></th>
                                                <th>ID</th>
                                                <th>Câu hỏi</th>
                                                <th>Đáp án</th>
                                                <th>Môn</th>
                                                <th>Khối</th>
                                                <th>Chương</th>
                                                <th>Độ khó</th>
                                            </thead>
                                            <tbody id="question_checked">

                                            </tbody>
                                        </table>
                                        <button id="submit_test" type="submit" class="btn btn-primary float-right mt-5">Tạo đề</button>
                                    </div>
                                </div>
                            </div>
                            <!-- [ Select2 ] end -->
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
<!-- select2 Js -->
<script src="assets/plugins/select2/js/select2.full.min.js"></script>
<!-- Multi select Js -->
<script src="assets/plugins/multi-select/js/jquery.quicksearch.js"></script>
<script src="assets/plugins/multi-select/js/jquery.multi-select.js"></script>
<!-- custom js -->
<script src="res/js/questions_panel_custom.js"></script>
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
    $("[data-name=tao-de-tuy-chinh]").addClass("pcoded-trigger");
    $(".js-example-basic-single").select2();




});
</script>