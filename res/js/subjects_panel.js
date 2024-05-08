$(function() {
  get_list_subjects();
  $('#valid_subjects').submit(function() {
    submit_add_subject($('#valid_subjects').serialize());
  });
});

function get_list_subjects() {
  $('#sp_ld').removeClass('sp_ld_hide');
  var url = "index.php?action=get_list_subjects";
  var success = function(result) {
    var json_data = $.parseJSON(result);
    show_list_subjects(json_data);
  };
  $.get(url, success);
}

function show_list_subjects(data) {
  var list = $('#list_subjects');
  var modal_h = $('#hd_modal');
  list.empty();
  for (var i = 0; i < data.length; i++) {
    var tr = $('<tr class="" id="subject-' + data[i].subject_id + '"></tr>');
    tr.append('<td class="">' + data[i].subject_id + '</td>');
    tr.append('<td class="">' + data[i].subject_detail + '</td>');
    tr.append('<td class="">' + subject_edit_button(data[i]) + '' + subject_del_button(data[i]) + '</td>');
    list.append(tr);
    modal_h.append(subjects_modal(data[i]));
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
function subjects_modal(data) {
  return modal ='<div class="modal fade" id="edit-' + data.subject_id + '" tabindex="-1" role="dialog" aria-hidden="true">'+
  '<div class="modal-dialog modal-lg" role="document"><div class="modal-content">'+
  '<div class="modal-header">'+
  '<h5 class="modal-title">Sửa: ID ' + data.subject_id + '</h5>'+
  '<button type="button" class="close" data-dismiss="modal" aria-label="Close">'+
  '<span aria-hidden="true">&times;</span></button></div><div class="modal-body">'+
  '<form action="" method="POST" role="form" id="form_edit_subject_' + data.subject_id + '"><div class="row"><div class="col-md-12">'+
  '<div class="form-group"><input type="hidden" value="' + data.subject_id + '" name="subject_id">'+
  '<input type="text" value="' + data.subject_detail + '" name="subject_detail" required class="form-control" placeholder="Tên môn học">'+
  '</div></div></div></form></div>'+
  '<div class="modal-footer"><button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>'+
  '<button type="submit" class="btn btn-primary" onclick="submit_edit_subject(' + data.subject_id + ')">Lưu</button></div></div></div></div>';
}
function tg_modal() {
  $('.dtr-bs-modal').modal('toggle');
}
function subject_edit_button(data) {
  return btn = '<a onclick="tg_modal()" class="btn" style="padding: 2px 2px 2px 2px;" data-toggle="modal" href="#edit-' + data.subject_id + '" id="#edit-' + data.subject_id + '"><i class="fas fa-user-edit"></i></a>';
}
function subject_del_button(data) {
  return btn = '<a class="btn" onclick="submit_del_subject(' + data.subject_id + ')" style="padding: 2px 2px 2px 2px;"><i class="fas fa-trash-alt"></i></a>';
}
function submit_del_subject(data) {
  swal({
        title: "Xóa môn học này?",
        text: "Bạn có chắc muốn xóa chứ ?",
        icon: "warning",
        buttons: ["Hủy","Xóa"],
        dangerMode: true,
    })
    .then((okay) => {
        if (okay) {
            data = 'subject_id='+ data;
            var url = "index.php?action=check_del_subject";
            var success = function(result) {
              var json_data = $.parseJSON(result);
              show_status(json_data);
              if (json_data.status) {
                $('#responsive-table-model').DataTable().destroy();
                get_list_subjects();
                tg_modal();
                swal("Đã xóa!", {
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
function submit_edit_subject(data) {
  var subject_id = data;
  form = $('#form_edit_subject_' + data);
  data = $('#form_edit_subject_' + data).serializeArray();
  console.log(data);
  if (!(data[1].value)) {
    swal("Thông báo", "Bạn chưa nhập gì cả !", "warning");
    return
  };
  var url = "index.php?action=check_edit_subject";
  var success = function(result) {
    var json_data = $.parseJSON(result);
    show_status(json_data);
    if (json_data.status) {
      $('#edit-'+ subject_id).modal('hide');
      $('#responsive-table-model').DataTable().destroy();
      get_list_subjects();
      form[0].reset();
      swal("Thành công !", "Đã sửa thông tin.", "success");
    }
  };
  $.post(url, data, success);
}
function submit_add_subject(data) {
  swal({
        title: "Thêm môn học?",
        text: "Bạn có chắc muốn thêm môn học này chứ ?",
        icon: "info",
        buttons: ["Hủy","Đồng ý"],
    })
    .then((okay) => {
        if (okay) {
          var url = "index.php?action=check_add_subject";
          var success = function(result) {
            var json_data = $.parseJSON(result);
            show_status(json_data);
            if (json_data.status) {
              $('#responsive-table-model').DataTable().destroy();
              get_list_subjects();
              swal("Thêm thành công !", {
                  icon: "success",
              });
              $('#valid_subjects')[0].reset();
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
