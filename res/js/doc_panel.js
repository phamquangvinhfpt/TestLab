$(function() {
    select_grade();
    select_subject();
    $("form").on('submit', function(event) {
        event.preventDefault();
    });
    $('#submit_doc').on('click', function() {
        console.log('ádasd');
        submit_add_doc();
    });
});
function del_document(document_id) {
  $('.loader-bg').fadeIn();
  var form_data = new FormData();
      form_data.append('document_id', document_id);
  $.ajax({
      url: 'index.php?action=check_del_document',
      dataType: 'text',
      cache: false,
      contentType: false,
      processData: false,
      data: form_data,
      type: 'post',
      success: function(result) {
          var json_data = $.parseJSON(result);
          if (json_data.status) {
            $("#"+document_id).remove();
            swal(json_data.status_value, {
                icon: "success",
            });
          } else {
            swal(json_data.status_value, {
                icon: "danger",
            });
          }
      }
  });
  $('.loader-bg').fadeOut();
}
function upload_file_data(data) {
  $('label[for=doc_file]').text(data.files[0].name);
}
function submit_add_doc() {
    $('.loader-bg').fadeIn();
    $("#loading-modal").modal("show");
    var file_data = $('#doc_file').prop('files')[0];
    var name = $('#doc_name').val();
    var mota = $('#doc_mota').val();
    var grade = $('#doc_grade').val();
    var subject = $('#doc_subject').val();
    var type_id = $('#type_id').val();
    var type = file_data.type;
    var size = file_data.size;
    $('label[for=doc_file]').text(file_data.name);
    var form_data = new FormData();
    form_data.append('file', file_data);
    form_data.append('subject_id', subject);
    form_data.append('grade_id', grade);
    form_data.append('name', name);
    form_data.append('mota', mota);
    form_data.append('type_id', type_id);
    console.log(form_data);
    $.ajax({
        url: 'index.php?action=check_add_doc',
        dataType: 'text',
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: 'post',
        success: function(result) {
            var json_data = $.parseJSON(result);
            if (json_data.status) {
              $("#loading-modal").modal("hide");
              swal({
                text: json_data.status_value,
                icon: "success",
                buttons: true,
              })
              .then((okay) => {
                if (okay) {
                  location.reload();
                }
              });
            } else {
              $("#loading-modal").modal("hide");
              swal(json_data.status_value, {
                  icon: "danger",
              });
            }
        }
    });
    $('.loader-bg').fadeOut();
}
