$(function() {
    get_list_tests();
    select_grade();
    select_subject();
    list_unit();
});

function get_list_tests() {
    $('#preload').removeClass('hidden');
    var url = "index.php?action=get_list_examine";
    var success = function(result) {
        var json_data = $.parseJSON(result);
        show_list_tests(json_data);
        $('select').select();
        $('#preload').addClass('hidden');
    };
    $.get(url, success);
}

function show_list_tests(data) {
    var list = $('#list_tests');
    list.empty();
    for (var i = 0; i < data.length; i++) {
      if (data[i].status_id != 7) {
        var tr = $('<tr class="" id="test-' + data[i].test_code + '"></tr>');
        tr.append('<td class="">' + data[i].test_name + '</td>');
        tr.append('<td class="">' + data[i].test_code + '</td>');
        tr.append('<td class="">' + data[i].subject_detail + '</td>');
        tr.append('<td class="">' + data[i].grade + '</td>');
        tr.append('<td class="">' + data[i].total_questions + ' câu hỏi, thời gian ' + data[i].time_to_do + ' phút <br />Ghi chú: ' + data[i].note + '</td>');
        tr.append('<td class=""><a class="text-white label theme-bg f-12" href="#!">' + data[i].status + '</a></td>');



        if(data[i].status_id == 5)
            tr.append('<td class="">' + test_dropdown_button(data[i]) + '</td>');
        else
            tr.append('<td class="">' + test_dropdown_button(data[i]) + '</td>');
        list.append(tr);
    }}
    $('#responsive-table-model').DataTable({
        "language": {
            "lengthMenu": "Hiển thị _MENU_",
            "zeroRecords": "Không tìm thấy",
            "info": "Hiển thị trang _PAGE_/_PAGES_",
            "infoEmpty": "Không có dữ liệu",
            "emptyTable": "Không có dữ liệu",
            "infoFiltered": "(tìm kiếm trong tất cả _MAX_ mục)",
            "sSearch": "Tìm kiếm",
            "paginate": {
                "first": "Đầu",
                "last": "Cuối",
                "next": "Sau",
                "previous": "Trước"
            },
        },
        "aoColumnDefs": [{
                "bSortable": false,
                "aTargets": [5]
            }, //hide sort icon on header of column 0, 5
        ]
    });
    $("form").on('submit', function(event) {
        event.preventDefault();
    });
}

function test_dropdown_button(data) {
    if (data.status_id == 2) {
      var text_status = "Mở";
    } else {
      var text_status = "Đóng";
    }
    if (data.status_id != 5) {
      var text_answer = '<a class="dropdown-item" href="#!" onclick="accept_permission(' + data.test_code + ', ' + data.status_id + ')">Cho Xem Đáp Án</a>';
    } else {
      var text_answer = '';
    }

    return btn = '<div class="btn-group">'+
    '<button class="btn drp-icon btn-rounded btn-outline-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'+
    '<i class="feather icon-info"></i>'+
    '</button>'+
    '<div class="dropdown-menu">'+
    '<a class="dropdown-item" href="#!" onclick="toggle_status(' + data.test_code + ', ' + data.status_id + ')">'+ text_status +'</a>'+
    text_answer +
    '<a class="dropdown-item" href="chi-tiet-de-thi-' + data.test_code + '">Chi Tiết Đề </a>'+
    '<a class="dropdown-item" href="in-de-' + data.test_code + '">In Đề </a>'+
    '<a class="dropdown-item" href="diem-de-thi-' + data.test_code + '">Xem Điểm</a>'+
    '<a class="dropdown-item" onclick="delete_test(' + data.test_code + ')" >Xoá đề</a>'+
    '</div>'+
    '</div>';
}

function toggle_status_button(data) {
    return btn = '<a class="waves-effect waves-light btn" style="margin-bottom: 7px;" onclick="toggle_status(' + data.test_code + ', ' + data.status_id + ')">Đóng/Mở</a>';
}

function accept_permission_button(data) {
    return btn = '<a class="waves-effect waves-light btn" style="margin-bottom: 7px;" onclick="accept_permission(' + data.test_code + ', ' + data.status_id + ')" style="letter-spacing: unset;">Cho Xem Đáp Án</a>';
}

function test_detail_button(data) {
    return btn = '<a class="waves-effect waves-light btn" style="margin-bottom: 7px;" href="chi-tiet-de-thi-' + data.test_code + '">Chi Tiết Đề</a>';
}

function test_score_button(data) {
    return btn = '<a class="waves-effect waves-light btn" href="diem-de-thi-' + data.test_code + '">Xem Điểm</a>';
}

function submit_add_test(data) {
    $('.loader-bg').fadeIn();
    var url = "index.php?action=check_add_test";
    var success = function(result) {
        var json_data = $.parseJSON(result);
        show_status(json_data);
        if (json_data.status) {
            $('#responsive-table-model').DataTable().destroy();
            get_list_tests();
            $('select').select();
            new PNotify({
                title: 'Thành công',
                text: 'Đã thêm đề thi thành công',
                type: 'success'
            });
        } else {
          new PNotify({
              title: 'Lỗi !!!',
              text: json_data.status_value,
              type: 'error'
          });
        }
        $('.loader-bg').fadeOut();
        $('#smartwizard').smartWizard("reset");
        $('form')[0].reset();
    };
    $.post(url, data, success);
}
function delete_test(test_code) {
    $('.loader-bg').fadeIn();
    var data = {
        test_code: test_code,
        status_id: 7
    };
    var url = "index.php?action=check_toggle_test_status";
    var success = function(result) {
        var json_data = $.parseJSON(result);
        show_status(json_data);
        if (json_data.status) {
            $('#responsive-table-model').DataTable().destroy();
            get_list_tests();
            $('select').select();
        }
        $('.loader-bg').fadeOut();
    };
    $.post(url, data, success);
}
function toggle_status(test_code, status_id) {
    $('.loader-bg').fadeIn();
    if (status_id == 1)
        var data = {
            test_code: test_code,
            status_id: 2
        }
    if (status_id == 2)
        var data = {
            test_code: test_code,
            status_id: 1
        }
    if (status_id == 5)
        var data = {
            test_code: test_code,
            status_id: 2
        }
    var url = "index.php?action=check_toggle_test_status";
    var success = function(result) {
        var json_data = $.parseJSON(result);
        show_status(json_data);
        if (json_data.status) {
            $('#responsive-table-model').DataTable().destroy();
            get_list_tests();
            $('select').select();
        }
        $('.loader-bg').fadeOut();
    };
    $.post(url, data, success);
}

function accept_permission(test_code, status_id) {
    $('.loader-bg').fadeIn();
    if (status_id == 2)
        var data = {
            test_code: test_code,
            status_id: 5
        }
    if (status_id == 1) {
        alert('Đề thi đang mở, không thể mở xem đáp án!');
        $('.loader-bg').fadeOut();
        return 0;
    }

    var url = "index.php?action=check_toggle_test_status";
    var success = function(result) {
        var json_data = $.parseJSON(result);
        show_status(json_data);
        if (json_data.status) {
            $('#responsive-table-model').DataTable().destroy();
            get_list_tests();
            $('select').select();
        }
        $('.loader-bg').fadeOut();
    };
    $.post(url, data, success);
}

//sử dụng hàm ajax thay vì post() để gửi dữ liệu vì trong hàm list_unit có gửi 2 ajax lồng nhau, phải set async = false
function list_unit() {
    $('.loader-bg').fadeIn();
    var grade_id = $('#test_grade').val();
    if (grade_id == null)
        grade_id = 1;
    var subject_id = $('#test_subject').val();
    if (subject_id == null)
        subject_id = 1;
    var data = {
        grade_id: grade_id,
        subject_id: subject_id
    }
    var div = $('#list_unit');
    var url = "index.php?action=get_list_units";
    var success = function(result) {
        div.empty();
        var json_data = $.parseJSON(result);
        if (json_data == "")
            div.append('<span class="title" style="color:red">Chưa có câu hỏi cho khối và môn đã chọn, vui lòng thêm câu hỏi trước khi tạo đề thi, thêm câu hỏi <a href="them-cau-hoi">tại đây</a>!</span>');
        else {
            for (var i = 0; i < json_data.length; i++) {
                var unit_div = $('<form class="aaaaa" ><div class="input-level row col s12" id="unit_' + json_data[i].unit + '"><h6>Chương ' + json_data[i].unit + ' ( ' + json_data[i].total + ' Câu hỏi )</h6></div></form>');
                var form_row = $('<div class="form-row"></div>')
                //Lấy danh sách câu hỏi phân loại theo độ khó của từng chương
                var get_levels_url = "index.php?action=get_list_levels_of_unit";
                var unit_data = {
                    grade_id: grade_id,
                    subject_id: subject_id,
                    unit: json_data[i].unit
                }
                var get_success = function(res) {
                    var jsondata = $.parseJSON(res);
                    for (var j = 0; j < jsondata.length; j++) {
                        var inp = '<div class="form-group col-md-3"><label for="unit_' + unit_data.unit + '_level_' + jsondata[j].level_id + '">' + jsondata[j].level_detail + ' (' + jsondata[j].total + ')</label><input type="number" id="unit_' + unit_data.unit + '_level_' + jsondata[j].level_id + '" name="unit_' + unit_data.unit + '_level_' + jsondata[j].level_id + '" required min="0" max="' + jsondata[j].total + '" class="form-control form-control-sm unit" onchange="update_total()"></div>';
                        form_row.append(inp)
                    }
                    unit_div.append(form_row)
                }
                $.ajax({
                    type: 'POST',
                    url: get_levels_url,
                    data: unit_data,
                    success: get_success,
                    async: false
                });
                div.append(unit_div);
            }
        }
        $('.loader-bg').fadeOut();
    };
    $.ajax({
        type: 'POST',
        url: url,
        data: data,
        success: success,
        async: false
    });
}

function update_total() {
    var sum = 0;
    $('.unit').each(function() {
        if (parseInt(this.value) > parseInt(this.getAttribute("max"))) {
            alert("Nhập quá số câu hỏi đang có, vui lòng kiểm tra lại");
            this.value = this.getAttribute("max");
            sum += parseInt(this.value);
        } else if (this.value != "")
            sum += parseInt(this.value);
    });
    $('#total_questions').val(sum);
}
