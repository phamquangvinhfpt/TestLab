$(function() {
  get_list_teachers();
  $('#valid_teacher').submit(function() {
    submit_add_teacher($('#valid_teacher').serialize());
  });
});

function get_list_teachers() {
  $('#sp_ld').removeClass('sp_ld_hide');
  var url = "index.php?action=get_list_teachers";
  var success = function(result) {
    var json_data = $.parseJSON(result);
    show_list_teachers(json_data);
  };
  $.get(url, success);
}

function show_list_teachers(data) {
  var list = $('#list_teachers');
  var modal_h = $('#hd_modal');
  list.empty();
  for (var i = 0; i < data.length; i++) {
    var tr = $('<tr id="teacher-' + data[i].teacher_id + '"></tr>');
    tr.append('<td>' + data[i].teacher_id + '</td>');
    tr.append('<td><img class="ani_avatar"  src="upload/avatar/' + data[i].avatar + '" alt="avatar"></td>');
    tr.append('<td>' + data[i].name + '</td>');
    tr.append('<td>' + data[i].username + '</td>');
    tr.append('<td>' + data[i].email + '</td>');
    tr.append('<td>' + data[i].gender_detail + '</td>');
    if (data[i].birthday == '' || data[i].birthday == '0000-00-00')
      data[i].birthday = 'Chưa Xác Định';
    tr.append('<td>' + data[i].birthday + '</td>');
    if (data[i].last_login == '' || data[i].last_login == '0000-00-00 00:00:00')
      data[i].last_login = 'Chưa Đăng Nhập';
    tr.append('<td>' + data[i].last_login + '</td>');
    tr.append('<td>' + teacher_edit_button(data[i]) + '' + teacher_del_button(data[i]) + '</td>');
    list.append(tr);
    modal_h.append(teacher_modal(data[i]));
  }
  $('#responsive-table-model').DataTable({
      responsive: {
          details: {
              display: $.fn.dataTable.Responsive.display.modal({
                  header: function(row) {
                      var data = row.data();
                      return 'Thông tin ' + data[2];
                  }
              }),
              renderer: $.fn.dataTable.Responsive.renderer.tableAll({
                  tableClass: 'table'
              })
          }
      }
  });
  $('#sp_ld').addClass('sp_ld_hide');
  $("form").on('submit', function(event) {
    event.preventDefault();
  });

}
function teacher_modal(data) {
  return modal ='<div class="modal fade" id="edit-' + data.teacher_id + '" tabindex="-1" role="dialog" aria-hidden="true">'+
  '<div class="modal-dialog modal-lg" role="document"><div class="modal-content">'+
  '<div class="modal-header">'+
  '<h5 class="modal-title">Sửa: ' + data.name + '</h5>'+
  '<button type="button" class="close" data-dismiss="modal" aria-label="Close">'+
  '<span aria-hidden="true">&times;</span></button></div><div class="modal-body">'+
  '<form action="" method="POST" role="form" id="form_edit_teacher_' + data.teacher_id + '"><div class="row"><div class="col-md-6">'+
  '<div class="form-group"><input type="hidden" value="' + data.teacher_id + '" name="teacher_id">'+
  '<input type="hidden" value="' + data.username + '" name="username"><label>Họ tên</label>'+
  '<input type="text" value="' + data.name + '" name="name" required class="form-control" placeholder="Họ tên của bạn">'+
  '</div><div class="form-group"><label>Mật khẩu</label>'+
  '<input type="password" name="password" class="form-control" placeholder="Password">'+
  '</div></div><div class="col-md-6"><div class="form-group"><label>Ngày sinh</label>'+
  '<input type="date" class="form-control"  value="' + data.birthday + '" name="birthday" required>'+
  '</div><div class="form-group"><label>Giới tính</label><select class="form-control" name="gender_id">'+
  '<option value="2">Nam</option><option value="3">Nữ</option></select></div></div></div></form></div>'+
  '<div class="modal-footer"><button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>'+
  '<button type="submit" class="btn btn-primary" onclick="submit_edit_teacher(' + data.teacher_id + ')">Lưu</button></div></div></div></div>';
}

function teacher_edit_button(data) {
  return btn = '<a onclick="tg_modal();" class="btn" style="padding: 2px 2px 2px 2px;" data-toggle="modal" href="#edit-' + data.teacher_id + '" id="#edit-' + data.teacher_id + '"><i class="fas fa-user-edit"></i></a>';
}
function teacher_del_button(data) {
  return btn = '<a class="btn" onclick="submit_del_teacher(' + data.teacher_id + ')" style="padding: 2px 2px 2px 2px;"><i class="fas fa-trash-alt"></i></a>';
}
function tg_modal() {
  $('.dtr-bs-modal').modal('toggle');
}
function submit_del_teacher(data) {
  swal({
        title: "Xóa tài khoản?",
        text: "Bạn có chắc muốn xóa tài khoản này chứ ?",
        icon: "warning",
        buttons: ["Hủy","Xóa"],
        dangerMode: true,
    })
    .then((okay) => {
        if (okay) {
            data = 'teacher_id='+ data;
            var url = "index.php?action=check_del_teacher";
            var success = function(result) {
              var json_data = $.parseJSON(result);
              console.log(json_data);
              show_status(json_data);
              if (json_data.status) {
                $('#responsive-table-model').DataTable().destroy();
                get_list_teachers();
                tg_modal();
                swal("Đã xóa tài khoản !", {
                    icon: "success",
                });
              } else {
                  swal(json_data.status_value, {
                      icon: "error",
                  });
                  tg_modal();
              }
            };
            $.post(url, data, success);
        }
    });
}
function submit_edit_teacher(data) {

  form = $('#form_edit_teacher_' + data);
  data = $('#form_edit_teacher_' + data).serializeArray();
  if (!(data[3].value)) {
    swal("Thông báo", "Bạn chưa nhập mật khẩu !", "warning");
    return
  };
  var url = "index.php?action=check_edit_teacher";
  var success = function(result) {
    var json_data = $.parseJSON(result);
    show_status(json_data);
    if (json_data.status) {
      $('#edit-'+ json_data.teacher_id).modal('hide');
      $('#responsive-table-model').DataTable().destroy();
      get_list_teachers();
      form[0].reset();
      swal("Thành công !", "Đã sửa thông tin.", "success");
    }
  };
  $.post(url, data, success);
}
function submit_add_teacher(data) {
  swal({
        title: "Tạo tài khoản?",
        text: "Bạn có chắc muốn tạo tài khoản này chứ ?",
        icon: "info",
        buttons: ["Hủy","Đồng ý"],
    })
    .then((okay) => {
        if (okay) {
          var url = "index.php?action=check_add_teacher";
          var success = function(result) {
            var json_data = $.parseJSON(result);
            show_status(json_data);
            console.log(json_data);
            if (json_data.status) {
              $('#responsive-table-model').DataTable().destroy();
              get_list_teachers();
              swal("Tạo tài khoản thành công !", {
                  icon: "success",
              });
              $('#valid_teacher')[0].reset();
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
