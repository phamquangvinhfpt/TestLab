$(document).ready(function() {
    $('select').select();
    $('.modal').modal();
    get_list_classes();
    $('.collapsible').collapsible();
    $('#trigger-sidebar').on('click', function() {
        $('#sidebar-left').toggleClass('sidebar-show');
        $('#menu-icon').toggleClass('rot');
        $('#logout').toggleClass('sidebar-show');
        $('#box-content').toggleClass('box-content-mini');
        $('#footer').toggleClass('footer-mini');
    });
    $('#menu').on('click', function() {
        $('#menu-arrow-up').toggleClass('hide');
        $('#menu-arrow-down').toggleClass('hide');
    });
    $('#btn-logout').on('click', function() {
        logout();
    });
    $("form").on('submit', function(event) {
        event.preventDefault();
    });
});
function select_grade() {
    var url = "index.php?action=get_list_grades";
    var success = function(result) {
        var json_data = $.parseJSON(result);
        var sl = $('select[name=grade_id]');
        sl.empty();
        $.each(json_data, function(key, value) {
          if (value.grade_id > 9) {  // Giới hạn từ lớp 10 - 12
            sl.append('<option value="' + value.grade_id + '">' + value.detail + '</option>');
          }
        });
        $('select').select();
    };
    $.get(url, success);
}

function select_subject() {
    var url = "index.php?action=get_list_subjects";
    var success = function(result) {
        var json_data = $.parseJSON(result);
        var sl = $('select[name=subject_id]');
        sl.empty();
        if (json_data.length != 0) {
            $('#subject_error').addClass('hidden');
            $.each(json_data, function(key, value) {
                sl.append('<option value="' + value.subject_id + '">' + value.subject_detail + '</option>');
            });
        } else {
            $('#class_error').removeClass('hidden');
        }
        $('select').select();
    };
    $.get(url, success);
}

function select_class() {
    var url = "index.php?action=get_list_classes";
    var success = function(result) {
        var json_data = $.parseJSON(result);
        var sl = $('select[name=class_id]');
        sl.empty();
        if (json_data.length != 0) {
            $('#class_error').addClass('hidden');
            $.each(json_data, function(key, value) {
                sl.append('<option value="' + value.class_id + '">' + value.class_name + '</option>');
            });
        } else {
            $('#class_error').removeClass('hidden');
        }
        $('select').select();
    };
    $.get(url, success);
}

function show_status(json_data) {
    if (json_data.status) {
        $('#status').addClass('success');
        $('#status').removeClass('failed');
    } else {
        $('#status').addClass('failed');
        $('#status').removeClass('success');
    }
    $('#status').html(json_data.status_value);
    $('#status').animate({
        'height': '65',
        'line-height': '65px',
        'opacity': '1'
    }, 500);
    $('#status').delay(1000).animate({
        'opacity': '0',
        'height': '0',
        'line-height': '0px'
    }, 500);
}

function logout() {
    var url = "index.php?action=logout";
    var data = {
        confirm: true
    };
    var success = function(result) {
        var json_data = $.parseJSON(result);
        show_status(json_data);
        if (json_data.status) {
            setTimeout(function() {
                window.location.replace("index.php");
            }, 1500);
        }
    };
    $.post(url, data, success);
}

function valid_email_on_profiles(data) {
    var new_email = $('#profiles-new-email').val();
    var current_email = $('#profiles-current-email').val();
    var url = "index.php?action=valid_email_on_profiles";
    var data1 = {
        new_email: new_email,
        current_email: current_email
    };
    var success = function(result) {
        var json_data = $.parseJSON(result);
        if (json_data.status) {
            $('#valid-email-true').removeClass('hidden');
            $('#valid-email-false').addClass('hidden');
        } else {
            $('#valid-email-false').removeClass('hidden');
            $('#valid-email-true').addClass('hidden');
        }
    };
    $.post(url, data1, success);
}

function get_list_classes() {
    $('#preload').removeClass('hidden');
    var url = "index.php?action=get_list_classes_by_teacher";
    var success = function(result) {
        var json_data = $.parseJSON(result);
        show_list_classes(json_data);
        $('#preload').addClass('hidden');
    };
    $.get(url, success);
}

function show_list_classes(data) {
    var list = $('#list_classes');
    list.empty();
    var sidebar = $('#list_classes_sidebar');
    sidebar.empty();
    $.each(data, function(key, value) {
        var tr = $('<tr question="fadeIn" id="class-id-' + value.class_id + '"></tr>');
        tr.append('<td>' + value.class_id + '</td>');
        tr.append('<td>' + value.class_name + '</td>');
        tr.append('<td>' + value.grade + '</td>');
        tr.append('<td>' + view_btn(value.class_id) + '</td>');
        sidebar.append('<a href="thong-tin-lop-' + value.class_id + '" class="menu-list cursor">' + value.class_name + '</a>');
        list.append(tr);
    });
}

function view_btn(data) {
    return '<a href="thong-tin-lop-' + data + '" class="btn">Xem</a>';
}


function get_score(id) {
    $('#preload').removeClass('hidden');
    var url = "index.php?action=get_score";
    var data = {
        student_id : id
    }
    var success = function(result) {
        var json_data = $.parseJSON(result);
        var tbody = $('#_score-'+id);
        tbody.empty();
        if(json_data == '')
            var p = $('<p style="font-size: 1.3em; font-weight: bold;">Chưa có bài làm nào</p>');
            tbody.append(p);
        $.each(json_data, function(key, value) {
            var p = $('<p style="font-size: 1.3em; font-weight: bold;">Đề thi: ' + value.test_code + ' - ' + value.score_number + ' điểm.<br />Hoàn thành lúc ' + value.completion_time + '</p>');
            tbody.append(p);
        });
        $('#preload').addClass('hidden');
    };
    $.post(url, data, success);
}
function select_subject_2() {
    var url = "index.php?action=get_list_subjects";
    var success = function(result) {
        var json_data = $.parseJSON(result);
        var sl = $('select[name=subject_id]');
        sl.empty();
        if (json_data.length != 0) {
            $.each(json_data, function(key, value) {
                sl.append('<option value="' + value.subject_id + '">' + value.subject_detail + '</option>');
            });
        }
        $("#subject_id").val(getUrlVars()["subject_id"]);
        $("#grade_id").val(getUrlVars()["grade_id"]);
    };
    $.get(url, success);
}
function getUrlVars() {
  var vars = {};
  var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
      vars[key] = value;
  });
  return vars;
}
