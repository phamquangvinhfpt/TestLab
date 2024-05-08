$(function() {
    $('select').select();
    $('#submit_question').on('click', function() {
        submit_edit_question($('#edit_question_form').serializeArray());
    });
});

function submit_edit_question(data) {
  swal({
        title: "Sửa đổi câu hỏi?",
        text: "Bạn có chắc muốn chỉnh sửa câu hỏi này chứ ?",
        icon: "warning",
        buttons: ["Hủy","Sửa"],
        dangerMode: true,
    })
    .then((okay) => {
        if (okay) {
          data[0]['value'] = CKEDITOR.instances.question_detail.getData();
          data[1]['value'] = CKEDITOR.instances.answer_a.getData();
          data[2]['value'] = CKEDITOR.instances.answer_b.getData();
          data[3]['value'] = CKEDITOR.instances.answer_c.getData();
          data[4]['value'] = CKEDITOR.instances.answer_d.getData();
          data[5]['value'] = CKEDITOR.instances.huong_dan.getData();
          console.log(data);
          $('.loader-bg').fadeIn();
          var url = "index.php?action=check_edit_question";
          var success = function(result) {
              var json_data = $.parseJSON(result);
              if (json_data.status) {
                swal("Đã sửa câu hỏi!", {
                    icon: "success",
                });
                $('.loader-bg').fadeOut();
                window.setTimeout(function() {
                    window.location.href = "quan-ly-ngan-hang-cau-hoi";
                }, 2000);
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
