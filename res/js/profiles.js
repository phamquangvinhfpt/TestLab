$(function() {
    $("form").on('submit', function(event) {
        event.preventDefault();
    });
    $('#upload_profiles').on('click', function() {
        var check_pass = $("#Password").val();
        if (check_pass == ""){
          swal("Bạn chưa nhập mật khẩu !!!", {
              icon: "warning",
          });
        } else {
          submit_update_profiles($('form').serializeArray());
        }
    });
});


function submit_update_profiles(data) {
    var url = "index.php?action=submit_update_profiles";
    var success = function(result) {
        var json_data = $.parseJSON(result);
        show_status(json_data);
        if (json_data.status) {
          swal("Lưu thông tin thành công!", {
              icon: "success",
          });
        }
    };
    $.post(url, data, success);
}

function update_avatar() {
    $('.loader-bg').fadeIn();
    var file_data = $('#file').prop('files')[0];
    var type = file_data.type;
    var size = file_data.size;
    var match = ["image/png", "image/jpg", "image/jpeg"];
    if ((type == match[0] && size < 20480000) || (type == match[1] && size < 20480000) || (type == match[2] && size < 20480000)) {
        var form_data = new FormData();
        form_data.append('file', file_data);
        $.ajax({
            url: 'index.php?action=submit_update_avatar',
            dataType: 'text',
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            success: function(result) {
                $('#file').val('');
                $('.loader-bg').fadeOut();
                swal("Đã thay đổi avatar, tải lại trang để hoàn tất !", {
                    icon: "success",
                }).then((okay) => {
                  if (okay){
                    location.reload();
                  }
                }
                );
            }
        });
    } else {
        swal("Chỉ được upload file JPG, PNG nhỏ hơn 2mb", {
            icon: "warning",
        });
        $('#file').val('');
        $('#avatar_uploading').addClass('hidden');
    }
}
