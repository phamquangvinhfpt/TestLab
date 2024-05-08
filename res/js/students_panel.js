$(function() {
    get_list_students();
    select_class();
    $("form").on('submit', function(event) {
        event.preventDefault();
    });
    $('table').on('click', 'a.btn', function() {
        select_class();
    });
    $('#valid_student').submit(function() {
      submit_add_student($('#valid_student').serialize());
    });
    $('#add_via_file').on('submit', function() {
        $('#preload').removeClass('hidden');
        submit_add_student_via_file();
        $('#add_via_file')[0].reset();
        $('#preload').addClass('hidden');
    });
});

function get_list_students() {
    $('#responsive-table-model').DataTable( {
        "sPaginationType" : "full_numbers",
        "processing": true,
        "serverSide": true,
        "ajax": {
            url :"index.php?action=list_students",
            type: "post",
            error: function(res){
                console.log("Error");
            }
        },
        "columns": [
        {
            "data": "student_id",
            "title": '<div class="checkbox checkbox-danger d-inline"><input type="checkbox" name="select_all" id="select_all"><label for="select_all" class="cr"></label></div>'
        },
        {
            "data": "student_id",
            "title": "ID"
        },
        {
            "data": "avatar",
            "title": "Avatar"
        },
        {
            "data": "name",
            "title": "Tên"
        },
        {
            "data": "username",
            "title": "Mã Học Sinh"
        },
        {
            "data": "class_name",
            "title": "Lớp"
        },
        {
            "data": "email",
            "title": "Email"
        },
        {
            "data": "gender_detail",
            "title": "Giớp Tính"
        },
        {
            "data": "birthday",
            "title": "Ngày Sinh"
        },
        {
            "data": "last_login",
            "title": "Last Active"
        },
        {
            "data": "student_id",
            "title": '<i class="fas fa-edit"></i>'
        }
        ],
        "columnDefs":[
        {
            "targets":0,
            "render": function(data)
            {
                return '<div class="check-group"><div class="checkbox checkbox-danger d-inline"><input type="checkbox" name="check-id-'+ data +'" id="check-id-'+ data +'" value="'+ data +'"><label for="check-id-'+ data +'" class="cr"></label></div></div>'
            }
        },
        {
            "targets":2,
            "render": function(data)
            {
                return '<img class="ani_avatar"  src="upload/avatar/' + data + '" alt="avatar">';
            }
        },
        {
            "targets":8,
            "render": function(data)
            {
                if (data == '' || data == '0000-00-00')
                    return 'Chưa Xác Định';
                else
                    return data;
            }
        },
        {
            "targets":9,
            "render": function(data)
            {
                if (data == '' || data == '0000-00-00 00:00:00')
                    return 'Chưa Đăng Nhập';
                else
                    return data;
            }
        },
        {
            "targets":10,
            "render": function(data, type, meta)
            {
                var button = student_edit_button(meta) + '<br />' + student_del_button(meta) + '' + student_modal(meta);
                $("form").on('submit', function(event) {
                    event.preventDefault();
                });
                return button;
            }
        },
        {
            "bSortable": false,
            "aTargets": [0, 2, 10]
        },
        ],
        'aaSorting': [
        [1, 'asc']
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
        }
    } );
}

function student_modal(data) {
  return modal ='<div style="text-align: left !important;" class="modal fade" id="edit-' + data.student_id + '" tabindex="-1" role="dialog" aria-hidden="true">'+
  '<div class="modal-dialog modal-lg" role="document"><div class="modal-content">'+
  '<div class="modal-header">'+
  '<h5 class="modal-title">Sửa: ' + data.name + '</h5>'+
  '<button type="button" class="close" data-dismiss="modal" aria-label="Close">'+
  '<span aria-hidden="true">&times;</span></button></div><div class="modal-body">'+
  '<form action="" method="POST" role="form" id="form_edit_student_' + data.student_id + '"><div class="row"><div class="col-md-6">'+
  '<div class="form-group"><input type="hidden" value="' + data.student_id + '" name="student_id">'+
  '<input type="hidden" value="' + data.username + '" name="username"><label>Họ tên</label>'+
  '<input type="text" value="' + data.name + '" name="name" required class="form-control" placeholder="Họ tên của bạn">'+
  '</div><div class="form-group"><label>Mật khẩu</label>'+
  '<input type="password" name="password" class="form-control" placeholder="Password">'+
  '</div></div><div class="col-md-6"><div class="form-group"><label>Ngày sinh</label>'+
  '<input type="date" class="form-control"  value="' + data.birthday + '" name="birthday" required>'+
  '</div><div class="form-group"><label>Giới tính</label><select class="form-control" name="gender_id">'+
  '<option value="2">Nam</option><option value="3">Nữ</option></select></div><div class="form-group"><label class="form-label">Lớp</label><select class="form-control" name="class_id"></select></div></div></div></form></div>'+
  '<div class="modal-footer"><button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>'+
  '<button type="submit" class="btn btn-primary" onclick="submit_edit_student(' + data.student_id + ')">Lưu</button></div></div></div></div>';
}

function student_edit_button(data) {
    return btn = '<a onclick="tg_modal()" class="btn" style="padding: 2px 2px 2px 2px;" data-toggle="modal" href="#edit-' + data.student_id + '" id="#edit-' + data.student_id + '"><i class="fas fa-user-edit"></i></a>';
}

function student_del_button(data) {
    return btn = '<a class="btn" onclick="submit_del_student(' + data.student_id + ')" style="padding: 2px 2px 2px 2px;"><i class="fas fa-trash-alt"></i></a>';
}

function submit_add_student(data) {
  swal({
        title: "Tạo tài khoản?",
        text: "Bạn có chắc muốn tạo tài khoản này chứ ?",
        icon: "info",
        buttons: ["Hủy","Đồng ý"],
    })
    .then((willDelete) => {
        if (willDelete) {
          var url = "index.php?action=check_add_student";
          var success = function(result) {
            var json_data = $.parseJSON(result);
            show_status(json_data);
            if (json_data.status) {
              $('#responsive-table-model').DataTable().ajax.reload();
              swal("Tạo tài khoản thành công !", {
                  icon: "success",
              });
              $('#valid_student')[0].reset();
            }  else {
                swal({
                    title: "Lỗi !",
                    text: json_data.status_value,
                    icon: "warning"
                });
            }
          };
          $.post(url, data, success);
        }
    });
}

function submit_add_student_via_file() {
    $('#preload').removeClass('hidden');
    $('#error').text('');
    var file_data = $('#file_data').prop('files')[0];
    var class_id = $('#_student_add_class_id').val();
    var type = file_data.type;
    var size = file_data.size;
    var match = ["application/vnd.openxmlformats-officedocument.spreadsheetml.sheet", "application/vnd.ms-excel"];
    if (type == match[0] || type == match[1]) {
        var form_data = new FormData();
        form_data.append('file', file_data);
        form_data.append('class_id', class_id);
        $.ajax({
            url: 'index.php?action=check_add_student_via_file',
            dataType: 'text',
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            success: function(result) {
                var json_data = $.parseJSON(result);
                show_status(json_data);
                $('#table_students').DataTable().ajax.reload();
                $('.modal').modal();
                $('select').select();
            }
        });
    } else {
        $('#error').text('Sai định dạng mẫu, yêu cầu file excel đuôi .xlsx theo mẫu. Nếu file lỗi vui lòng tải lại mẫu và điền lại.');
    }
    $('#preload').addClass('hidden');
}

function submit_del_student(data) {
  swal({
        title: "Xóa tài khoản?",
        text: "Bạn có chắc muốn xóa tài khoản này chứ ?",
        icon: "warning",
        buttons: ["Hủy","Xóa"],
        dangerMode: true,
    })
    .then((willDelete) => {
        if (willDelete) {
            data = 'student_id='+ data;
            var url = "index.php?action=check_del_student";
            var success = function(result) {
              console.log(result);
              var json_data = $.parseJSON(result);
              show_status(json_data);
              if (json_data.status) {
                $('#responsive-table-model').DataTable().ajax.reload();
                tg_modal();
                swal("Đã xóa tài khoản !", {
                    icon: "success",
                });
              } else {
                  tg_modal();
                  swal("Đã sảy ra lỗi !", {
                      icon: "error",
                  });
              }
            };
            $.post(url, data, success);
        }
    });
}

function tg_modal() {
  $('.dtr-bs-modal').modal('toggle');
}

function submit_edit_student(data) {
  form = $('#form_edit_student_' + data);
  data = $('#form_edit_student_' + data).serializeArray();
  if (!(data[3].value)) {
    swal("Thông báo", "Bạn chưa nhập mật khẩu !", "warning");
    return
  };
  var url = "index.php?action=check_edit_student";
  var success = function(result) {
    var json_data = $.parseJSON(result);
    show_status(json_data);
    if (json_data.status) {
      $('#edit-'+ json_data.student_id).modal('hide');
      $('#responsive-table-model').DataTable().ajax.reload();
      form[0].reset();
      swal("Thành công !", "Đã sửa thông tin.", "success");
    }
  };
  $.post(url, data, success);
}
