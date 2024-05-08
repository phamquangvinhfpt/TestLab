$(function() {
    get_list_classes();
    select_teacher();
    select_grade();
    $('#add_class_form').on('submit', function() {
        submit_add_class($('#add_class_form').serializeArray());
        $('#add_class_form')[0].reset();
    });
});

function get_list_classes() {
    $('#sp_ld').removeClass('sp_ld_hide');
    var url = "index.php?action=get_list_classes";
    var success = function(result) {
        var json_data = $.parseJSON(result);
        show_list_classes(json_data);
        $('select').select();
        $('#sp_ld').addClass('sp_ld_hide');
    };
    $.get(url, success);
}

function show_list_classes(data) {
    var list = $('#list_classes');
    var modal_h = $('#hd_modal');
    list.empty();
    for (var i = 0; i < data.length; i++) {
        var tr = $('<tr class="" id="class-' + data[i].class_id + '"></tr>');
        tr.append('<td class="">' + data[i].class_id + '</td>');
        tr.append('<td><img class="ani_avatar"  src="upload/avatar/' + data[i].avatar + '" alt="avatar"></td>');
        tr.append('<td class="">' + data[i].teacher_name + '</td>');
        tr.append('<td class="">' + data[i].class_name + '</td>');
        tr.append('<td class="">' + data[i].grade_detail + '</td>');
        tr.append('<td class="">' + class_edit_button(data[i]) + '' + class_del_button(data[i]) + '</td>');
        list.append(tr);
        modal_h.append(class_modal(data[i]));
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

function class_modal(data) {
  return modal ='<div class="modal fade" id="edit-' + data.class_id + '" tabindex="-1" role="dialog" aria-hidden="true">'+
  '<div class="modal-dialog modal-lg" role="document"><div class="modal-content">'+
  '<div class="modal-header">'+
  '<h5 class="modal-title">Sửa: ' + data.class_name + '</h5>'+
  '<button type="button" class="close" data-dismiss="modal" aria-label="Close">'+
  '<span aria-hidden="true">&times;</span>'+
  '</button>'+
  '</div>'+
  '<div class="modal-body">'+
  '<form action="" method="POST" role="form" id="form-edit-class-' + data.class_id + '">'+
  '<div class="row">'+
  '<div class="col-md-6">'+
  '<div class="form-group">'+
  '<input type="hidden" value="' + data.class_id + '" name="class_id">'+
  '<label>Tên lớp</label>'+
  '<input type="text" value="' + data.class_name + '" name="class_name" readonly class="form-control" placeholder="' + data.class_name + '">'+
  '</div>'+
  '</div>'+
  '<div class="col-md-6">'+
  '<div class="form-group">'+
  '<label>Khối</label>'+
  '<select class="form-control" name="grade_id">'+
  '</select>'+
  '</div>'+
  '<div class="form-group">'+
  '<label>Giáo Viên</label>'+
  '<select class="form-control" name="teacher_id">'+
  '</select>'+
  '</div></div></div>'+
  '</form>'+
  '</div>'+
  '<div class="modal-footer">'+
  '<button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>'+
  '<button type="submit" class="btn btn-primary" onclick="submit_edit_class(' + data.class_id + ')">Lưu</button></div></div></div></div>';
}

function class_edit_button(data) {
    return btn = '<a class="btn" onclick="select_teacher();select_grade();tg_modal();" style="padding: 2px 2px 2px 2px;" data-toggle="modal" href="#edit-' + data.class_id + '" id="#edit-' + data.class_id + '"><i class="fas fa-edit"></i></a>';
}

function class_del_button(data) {
    return btn = '<a class="btn" onclick="submit_del_class(' + data.class_id + ')" style="padding: 2px 2px 2px 2px;"><i class="fas fa-trash-alt"></i></a>';
}
function tg_modal() {
  $('.dtr-bs-modal').modal('toggle');
}
function submit_add_class(data) {
  swal({
        title: "Thêm lớp mới ?",
        text: "Bạn có chắc muốn thêm lớp này chứ ?",
        icon: "info",
        buttons: ["Hủy","Đồng ý"],
    })
    .then((willDelete) => {
        if (willDelete) {
          $('#sp_ld').removeClass('sp_ld_hide');
          var url = "index.php?action=check_add_class";
          var success = function(result) {
              var json_data = $.parseJSON(result);
              if (json_data.status) {
                  $('#responsive-table-model').DataTable().destroy();
                  get_list_classes();
                  select_teacher();
                  select_grade();
                  swal("Thêm lớp thành công !", {
                      icon: "success",
                  });
              } else {
                  swal({
                      title: "Lỗi !",
                      text: json_data.status_value,
                      icon: "warning"
                  });
              }
              $('#sp_ld').addClass('sp_ld_hide');
          };
          $.post(url, data, success);
        }
    });
}

function submit_del_class(data) {
  swal({
        title: "Xóa lớp ?",
        text: "Bạn có chắc muốn xóa lớp này ?",
        icon: "warning",
        buttons: ["Hủy","Xóa"],
        dangerMode: true,
    })
    .then((willDelete) => {
        if (willDelete) {
            $('#sp_ld').removeClass('sp_ld_hide');
            data = 'class_id='+ data;
            var url = "index.php?action=check_del_class";
            var success = function(result) {
              var json_data = $.parseJSON(result);
              if (json_data.status) {
                $('#responsive-table-model').DataTable().destroy();
                get_list_classes();
                tg_modal();
                swal("Đã xóa thành công !", {
                    icon: "success",
                });
              } else {
                  tg_modal();
                  swal("Đã sảy ra lỗi !", {
                      icon: "error",
                  });
              }
              $('#sp_ld').addClass('sp_ld_hide');
            };
            $.post(url, data, success);
        }
    });
}

function submit_edit_class(data) {
  swal({
        title: "Sửa đổi thông tin lớp ?",
        text: "Bạn có chắc muốn sửa thông tin lớp này ?",
        icon: "warning",
        buttons: ["Hủy","Đồng ý"],
        dangerMode: true,
    })
    .then((willDelete) => {
        if (willDelete) {
            $('#sp_ld').removeClass('sp_ld_hide');
            form = $('#form-edit-class-' + data);
            data = $('#form-edit-class-' + data).serializeArray();
            var url = "index.php?action=check_edit_class";
            var success = function(result) {
                var json_data = $.parseJSON(result);
                if (json_data.status) {
                    $('#edit-'+ json_data.admin_id).modal('hide');
                    $('#responsive-table-model').DataTable().destroy();
                    get_list_classes();
                    form[0].reset();
                    swal("Đã sửa thông tin thành công !", {
                        icon: "success",
                    });
                } else {
                  swal("Đã sảy ra lỗi !", {
                      icon: "error",
                  });
                }
                $('#sp_ld').addClass('sp_ld_hide');
            };
            $.post(url, data, success);
        }
    });
}
