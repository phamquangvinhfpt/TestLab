$(function() {
  get_list_admins();
  $('#validAdmin').submit(function() {
    submit_add_admin($('#validAdmin').serialize());
  });
});

function get_list_admins() {
  $('#sp_ld').removeClass('sp_ld_hide');
  var url = "index.php?action=get_list_admins";
  var success = function(result) {
    var json_data = $.parseJSON(result);
    show_list_admins(json_data);
  };
  $.get(url, success);
}

function show_list_admins(data) {
  var list = $('#list_admins');
  var modal_h = $('#hd_modal');
  list.empty();
  for (var i = 0; i < data.length; i++) {
    var tr = $('<tr id="admin-' + data[i].admin_id + '"></tr>');
    tr.append('<td>' + data[i].admin_id + '</td>');
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
    tr.append('<td>' + admin_edit_button(data[i]) + '' + admin_del_button(data[i]) + '</td>');
    list.append(tr);
    modal_h.append(admin_modal(data[i]));
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
function admin_modal(data) {
  return modal ='<div class="modal fade" id="edit-' + data.admin_id + '" tabindex="-1" role="dialog" aria-hidden="true">'+
  '<div class="modal-dialog modal-lg" role="document"><div class="modal-content">'+
  '<div class="modal-header">'+
  '<h5 class="modal-title">Sửa: ' + data.name + '</h5>'+
  '<button type="button" class="close" data-dismiss="modal" aria-label="Close">'+
  '<span aria-hidden="true">&times;</span></button></div><div class="modal-body">'+
  '<form action="" method="POST" role="form" id="form_edit_admin_' + data.admin_id + '"><div class="row"><div class="col-md-6">'+
  '<div class="form-group"><input type="hidden" value="' + data.admin_id + '" name="admin_id">'+
  '<input type="hidden" value="' + data.username + '" name="username"><label>Họ tên</label>'+
  '<input type="text" value="' + data.name + '" name="name" required class="form-control" placeholder="Họ tên của bạn">'+
  '</div><div class="form-group"><label>Mật khẩu</label>'+
  '<input type="password" name="password" class="form-control" placeholder="Password">'+
  '</div></div><div class="col-md-6"><div class="form-group"><label>Ngày sinh</label>'+
  '<input type="date" class="form-control"  value="' + data.birthday + '" name="birthday" required>'+
  '</div><div class="form-group"><label>Giới tính</label><select class="form-control" name="gender_id">'+
  '<option value="2">Nam</option><option value="3">Nữ</option></select></div></div></div></form></div>'+
  '<div class="modal-footer"><button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>'+
  '<button type="submit" class="btn btn-primary" onclick="submit_edit_admin(' + data.admin_id + ')">Lưu</button></div></div></div></div>';
}
function tg_modal() {
  $('.dtr-bs-modal').modal('toggle');
}
function admin_edit_button(data) {
  return btn = '<a onclick="tg_modal()" class="btn" style="padding: 2px 2px 2px 2px;" data-toggle="modal" href="#edit-' + data.admin_id + '" id="#edit-' + data.admin_id + '"><i class="fas fa-user-edit"></i></a>';
}
function admin_del_button(data) {
  return btn = '<a class="btn" onclick="submit_del_admin(' + data.admin_id + ')" style="padding: 2px 2px 2px 2px;"><i class="fas fa-trash-alt"></i></a>';
}
function submit_del_admin(data) {
  swal({
        title: "Xóa tài khoản?",
        text: "Bạn có chắc muốn xóa tài khoản này chứ ?",
        icon: "warning",
        buttons: ["Hủy","Xóa"],
        dangerMode: true,
    })
    .then((okay) => {
        if (okay) {
            data = 'admin_id='+ data;
            var url = "index.php?action=check_del_admin";
            var success = function(result) {
              var json_data = $.parseJSON(result);
              show_status(json_data);
              if (json_data.status) {
                $('#responsive-table-model').DataTable().destroy();
                get_list_admins();
                tg_modal();
                swal("Đã xóa tài khoản !", {
                    icon: "success",
                });
              } else {
                  tg_modal();
                  swal(json_data.status_value, {
                      icon: "error",
                  });
              }
            };
            $.post(url, data, success);
        }
    });
}
function submit_edit_admin(data) {

  form = $('#form_edit_admin_' + data);
  data = $('#form_edit_admin_' + data).serializeArray();
  if (!(data[3].value)) {
    swal("Thông báo", "Bạn chưa nhập mật khẩu !", "warning");
    return
  };
  var url = "index.php?action=check_edit_admin";
  var success = function(result) {
    var json_data = $.parseJSON(result);
    show_status(json_data);
    if (json_data.status) {
      $('#edit-'+ json_data.admin_id).modal('hide');
      $('#responsive-table-model').DataTable().destroy();
      get_list_admins();
      form[0].reset();
      swal("Thành công !", "Đã sửa thông tin.", "success");
    }
  };
  $.post(url, data, success);
}
function submit_add_admin(data) {
  swal({
        title: "Tạo tài khoản?",
        text: "Bạn có chắc muốn tạo tài khoản này chứ ?",
        icon: "info",
        buttons: ["Hủy","Đồng ý"],
    })
    .then((willDelete) => {
        if (willDelete) {
          var url = "index.php?action=check_add_admin";
          var success = function(result) {
            var json_data = $.parseJSON(result);
            show_status(json_data);
            if (json_data.status) {
              $('#responsive-table-model').DataTable().destroy();
              get_list_admins();
              swal("Tạo tài khoản thành công !", {
                  icon: "success",
              });
              $('#validAdmin')[0].reset();
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
