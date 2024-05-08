$(document).ready(function() {
    $("form").on('submit', function(event) {
        event.preventDefault();
    });
});

function check_pass_test(test_code) {
  $('#test_code').attr("value",test_code);
  $('#model_check_pass_test').modal("show");
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

function submit_test(id) {
    var data = $('#check_pass_test_from').serialize();
    var url = "index.php?action=check_password";
    var success = function(result) {
        var json_data = $.parseJSON(result);
        if (json_data.status) {
            swal({
              title: "Chuẩn bị làm bài thi...",
              icon: "success",
              timer: 3000,
              buttons: false
            });
            setTimeout(function() {
                location.reload();
            }, 1500);
        } else {
            swal({
              title: "Sai mật khẩu!",
              icon: "error",
              timer: 3000,
              buttons: false
            });
        }
    };
    $.post(url, data, success);
}
function select_subject(subject_id) {
    var url = "index.php?action=get_list_subjects";
    var success = function(result) {
        var json_data = $.parseJSON(result);
        var sl = $('select[name=subject_id]');
        sl.empty();
        if (json_data.length != 0) {
            $('#subject_error').addClass('hidden');
            sl.append('<option value="9999">Tất cả các môn</option>');
            $.each(json_data, function(key, value) {
                sl.append('<option value="' + value.subject_id + '">' + value.subject_detail + '</option>');
            });
        } else {
            $('#class_error').removeClass('hidden');
        }
        $('select').select();
        $("#subject_id").val(subject_id);
    };
    $.get(url, success);
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
