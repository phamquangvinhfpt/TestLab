$(function() {
    select_grade();
    select_subject();
    $('#submit_question').on('click', function() {
        submit_add_question($('#add_question_form').serializeArray());
    });
    $('#submit_file_data').on('click', function() {
        submit_add_question_via_file();
    });
});

function upload_file_data(data) {
  $('label[for=file_data]').text(data.files[0].name);
}

function upload_image(data) {
    $('.loader-bg').fadeIn();
    $('label[for=file]').text(data.files[0].name);
    var file_data = $('#file').prop('files')[0];
    var type = file_data.type;
    var size = file_data.size;
    var match = ["image/png", "image/jpg", "image/jpeg"];
    if ((type == match[0] && size < 2048000) || (type == match[1] && size < 2048000) || (type == match[2] && size < 2048000)) {
        var form_data = new FormData();
        form_data.append('file', file_data);
        $.ajax({
            url: 'index.php?action=uploadImage',
            dataType: 'text',
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            success: function(result) {
                var json_data = jQuery.parseJSON(result);
                if(json_data.stt) {
                    $('.loader-bg').fadeOut();
                    $('#file').val('');
                    $('#url').val(json_data.url);
                } else {
                    $('.loader-bg').fadeOut();
                    $('#file').val('');
                    $('#url').val('Tải ảnh lên thất bại.');
                }
            }
        });
    } else {
        $('#url').val('Chỉ được upload file JPG, PNG nhỏ hơn 2mb');
        $('#file').val('');
        $('.loader-bg').fadeOut();
    }
}

function submit_add_question(data) {
  swal({
        title: "Thêm câu hỏi?",
        text: "Bạn có chắc muốn thêm câu hỏi này chứ ?",
        icon: "warning",
        buttons: ["Hủy","Thêm"],
        dangerMode: true,
    })
    .then((okay) => {
        if (okay) {
          console.log(data);
          data[0]['value'] = CKEDITOR.instances.question_detail.getData();
          data[1]['value'] = CKEDITOR.instances.answer_a.getData();
          data[2]['value'] = CKEDITOR.instances.answer_b.getData();
          data[3]['value'] = CKEDITOR.instances.answer_c.getData();
          data[4]['value'] = CKEDITOR.instances.answer_d.getData();
          data[5]['value'] = CKEDITOR.instances.huong_dan.getData();
          console.log(data);
          $('.loader-bg').fadeIn();
          var url = "index.php?action=check_add_question";
          var success = function(result) {
              var json_data = $.parseJSON(result);
              if (json_data.status) {
                swal("Thêm câu hỏi thành công !", {
                    icon: "success",
                });
                show_status(json_data);
                select_grade();
                select_subject();
                $('.loader-bg').fadeOut();
                CKEDITOR.instances.question_detail.setData('', function() {
                    this.updateElement();
                })
                CKEDITOR.instances.answer_a.setData('', function() {
                    this.updateElement();
                })
                CKEDITOR.instances.answer_b.setData('', function() {
                    this.updateElement();
                })
                CKEDITOR.instances.answer_c.setData('', function() {
                    this.updateElement();
                })
                CKEDITOR.instances.answer_d.setData('', function() {
                    this.updateElement();
                })
                CKEDITOR.instances.huong_dan.setData('', function() {
                    this.updateElement();
                })
              } else {
                swal(json_data.status_value, {
                    icon: "error",
                });
                $('.loader-bg').fadeOut();
              }
          };
          $.post(url, data, success);
        }
    });
}
function IsJsonString(str) {
    try {
        JSON.parse(str);
    } catch (e) {
        return false;
    }
    return true;
}
function submit_add_question_via_file() {
    $('.loader-bg').fadeIn();
    var file_data = $('#file_data').prop('files')[0];
    var subject = $('#file_subject').val();
    var grade = $('#file_grade').val();
    var unit = $('#file_unit').val();
    var level = $('#file_level').val();
    var type = file_data.type;
    var size = file_data.size;
    $('label[for=file_data]').text(file_data.name);
    var match_xlsx = ["application/vnd.openxmlformats-officedocument.spreadsheetml.sheet", "application/vnd.ms-excel", "application/wps-office.xlsx"];
    var match_docx = ["application/vnd.openxmlformats-officedocument.wordprocessingml.document"];
    var form_data = new FormData();
    form_data.append('file', file_data);
    form_data.append('subject_id', subject);
    form_data.append('grade_id', grade);
    form_data.append('unit', unit);
    form_data.append('level_id', level);
    if (type == match_xlsx[0] || type == match_xlsx[1] || type == match_xlsx[2] || type == match_xlsx[3]) {
        $.ajax({
            url: 'index.php?action=check_add_question_via_file',
            dataType: 'text',
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            success: function(result) {
                var json_data = $.parseJSON(result);
                if (json_data.status) {
                  swal(json_data.status_value, {
                      icon: "success",
                  });
                }
            }
        });
    } else if (type == match_docx[0]) {
      $.ajax({
          url: 'index.php?action=check_add_question_via_file_docx',
          dataType: 'text',
          cache: false,
          contentType: false,
          processData: false,
          data: form_data,
          type: 'post',
          success: function(result) {
              console.log(result);
            if (IsJsonString(result)) {
              var json_data = $.parseJSON(result);
              if (json_data.status) {
                swal(json_data.status_value, {
                    icon: "success",
                });
              } else {
                swal(json_data.status_value, {
                    icon: "danger",
                });
              }
            } else {
              swal("Không thể đọc file, vui lòng kiểm tra lại!", {
                  icon: "danger",
              });
            }
          }
      });
    } else {
        swal("Sai định dạng file, vui lòng kiểm tra lại.", {
            icon: "danger",
        });
    }
    $('.loader-bg').fadeOut();
}
