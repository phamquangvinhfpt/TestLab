$(function() {
    select_grade();
    select_subject();
    get_list_questions();
    $('table').on('click', 'a.btn', function() {
        select_class();
    });
    $("form").on('submit', function(event) {
        event.preventDefault();
    });
    $("#submit_test").on('click', function() {
        submit_custom_test();
    });
});


function submit_custom_test() {
    var data = {
        question: window.select_id,
        detail: $("form").serializeArray()
    };
    console.log(data);
    var url = "index.php?action=create_custom_test";
    var success = function(result) {
        console.log(result);
        var json_data = $.parseJSON(result);
        if (json_data.status) {
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
    };
    $.post(url, data, success);
}



function get_list_questions() {
    var table_quest = $('#responsive-table-model').DataTable({
        "sPaginationType": "full_numbers",
        "processing": true,
        "serverSide": true,
        "autoWidth": true,
        "ajax": {
            url: "index.php?action=list_questions",
            type: "post",
            error: function(res) {
                console.log("Error");
            },
            "data": function(d) {
                d.subject_id = $("#col4_filter").val();
                d.grade_id = $("#col5_filter").val();
                d.unit = $("#col6_filter").val();
                d.level_id = $("#col7_filter").val();
            }
        },
        "columns": [{
                "data": "question_id",
                "title": '',
                "width": "45px"
            },
            {
                "data": "question_id",
                "title": "ID",
                "width": "45px"
            },
            {
                "data": "question_content",
                "title": "Câu Hỏi",
                "width": "45%"
            },
            {
                "data": "correct_answer",
                "title": "Đáp án"
            },
            {
                "data": "question_id",
                "title": "Môn Học"
            },
            {
                "data": "question_id",
                "title": "Khối"
            },
            {
                "data": "question_id",
                "title": "Chương"
            },
            {
                "data": "question_id",
                "title": "Độ Khó",
                "search": {
                    "value": "Khó"
                }
            },
            {
                "data": "question_id",
                "title": '<i class="fas fa-edit"></i>'
            }
        ],
        "columnDefs": [{
                "targets": 0,
                "render": function(data) {
                    if (window.select_id.indexOf(data) == -1) {
                        var check_str = "";
                    } else {
                        var check_str = "checked";
                    };
                    return '<div class="check-group"><div class="checkbox checkbox-danger d-inline"><input type="checkbox" name="check-id" ' + check_str + ' onclick="add(this)" id="check-id-' + data + '" value="' + data + '"><label for="check-id-' + data + '" class="cr"></label></div></div>'
                }
            },
            {
                "targets": 2,
                "render": function(data) {
                    return data;
                }
            },
            {
                "targets": 4,
                "render": function(data, type, meta) {
                    return meta.subject_detail;
                }
            },
            {
                "targets": 5,
                "render": function(data, type, meta) {
                    return meta.grade_detail;
                }
            },
            {
                "targets": 6,
                "render": function(data, type, meta) {
                    return meta.unit;
                }
            },
            {
                "targets": 7,
                "render": function(data, type, meta) {
                    return '<a href="#!" class="label theme-bg f-12 text-white">' + meta.level_detail + '</a>';
                }
            },
            {
                "targets": 8,
                "render": function(data, type, meta) {
                    var button = question_dropdown_button(meta);
                    $("form").on('submit', function(event) {
                        event.preventDefault();
                    });
                    return button;
                }
            },
            {
                "bSortable": false,
                "aTargets": [0, 8]
            },
        ],
        'aaSorting': [
            [1, 'desc']
        ],
        "language": {
            "lengthMenu": "Hiển thị _MENU_",
            "zeroRecords": "Không tìm thấy",
            "info": "Hiển thị trang _PAGE_/_PAGES_",
            "infoEmpty": "Không có dữ liệu",
            "emptyTable": "Không có dữ liệu",
            "infoFiltered": "(tìm kiếm trong tất cả _MAX_ mục)",
            "sSearch": "Tìm kiếm",
            "processing": "Đang tải!",
            "paginate": {
                "first": "Đầu",
                "last": "Cuối",
                "next": "Sau",
                "previous": "Trước"
            },
        },
        "drawCallback": function(settings) {
            MathJax.Hub.Queue(["Typeset", MathJax.Hub]);
        }
    });
    $("form").on('submit', function(event) {
        event.preventDefault();
    });
    $('select.column_filter').on('change', function() {
        table_quest.ajax.reload();
    });
}

window.select_id = [];

function add(data) {
    if (window.select_id.indexOf(data.value) == -1) {
        window.select_id.push(data.value);
        add_question(data);
    } else {
        removeA(window.select_id, data.value);
        $("#rm_" + data.value).remove();
    }
    $("#count").text("( " + window.select_id.length + " Câu )");
}

function add_question(data) {
    var tr = $(data).parents()[3];
    var question = $(tr).find("td:nth-child(3)").html();
    var answer = $(tr).find("td:nth-child(4)").html();
    var subject = $(tr).find("td:nth-child(5)").text();
    var grade = $(tr).find("td:nth-child(6)").text();
    var chuong = $(tr).find("td:nth-child(7)").text();
    var do_kho = $(tr).find("td:nth-child(8)").text();

    $("#question_checked").append('<tr id="rm_' + data.value + '"> <td> <div class="check-group"> <div class="checkbox checkbox-danger d-inline"><input type="checkbox" name="check-id" checked onclick="add(' + data.value + ')" id="check-id-' + data.value + '" value="' + data.value + '"><label for="check-id-' + data.value + '" class="cr"></label></div> </div> </td> <td>' + data.value + '</td> <td>' + question + '</td> <td>' + answer + '</td> <td>' + subject + '</td> <td>' + grade + '</td> <td>' + chuong + '</td> <td>' + do_kho + '</td> </tr>')
}

function removeA(arr) {
    var what, a = arguments,
        L = a.length,
        ax;
    while (L > 1 && arr.length) {
        what = a[--L];
        while ((ax = arr.indexOf(what)) !== -1) {
            arr.splice(ax, 1);
        }
    }
    return arr;
}

function trim_string(data) {
    var length = 200;
    var trimmedString = data.length > length ? data.substring(0, length - 3) + "..." : data;
    return trimmedString;
}

function question_dropdown_button(data) {
    return btn = '<div class="btn-group"><button class="btn drp-icon btn-rounded btn-outline-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="feather icon-info"></i></button><div class="dropdown-menu"><a class="dropdown-item" target="_blank" href="sua-cau-hoi-' + data.question_id + '" id="#edit-' + data.question_id + '">Chỉnh sửa</a><a class="dropdown-item" href="#!" onclick="submit_del_question(' + data.question_id + ')">Xóa</a></div></div>';
}

function question_edit_button(data) {
    return btn = '<a class="btn" style="padding: 2px 2px 2px 2px;" href="sua-cau-hoi-' + data.question_id + '" id="#edit-' + data.student_id + '"><i class="fas fa-user-edit"></i></a>';
}

function question_del_button(data) {
    return btn = '<a class="btn" onclick="submit_del_question(' + data.question_id + ')" style="padding: 2px 2px 2px 2px;"><i class="fas fa-trash-alt"></i></a>';
}

function submit_del_question(data) {
    swal({
            title: "Xóa câu hỏi?",
            text: "Bạn có chắc muốn xóa câu hỏi này chứ ?",
            icon: "warning",
            buttons: ["Hủy", "Xóa"],
            dangerMode: true,
        })
        .then((okay) => {
            if (okay) {
                data = 'question_id=' + data;
                var url = "index.php?action=check_del_question";
                var success = function(result) {
                    var json_data = $.parseJSON(result);
                    show_status(json_data);
                    if (json_data.status) {
                        $('#responsive-table-model').DataTable().ajax.reload();
                        swal("Đã xóa câu hỏi !", {
                            icon: "success",
                        });
                    } else {
                        swal(json_data.status_value, {
                            icon: "error",
                        });
                    }
                };
                $.post(url, data, success);
            }
        });
}