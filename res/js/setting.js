$(function() {
  $('#update_quest_setting').on('click', function() {
      submit_quest_setting();
  });
});

function submit_quest_setting() {
    $('.loader-bg').fadeIn();
    var data = $('form').serializeArray();
    var url = "index.php?action=update_quest_setting";
    var success = function(result) {
      var json_data = $.parseJSON(result);
      if (json_data.status) {
        swal(json_data.status_value, {
            icon: "success",
        });
      }  else {
          swal({
              title: "Lỗi !",
              text: json_data.status_value,
              icon: "warning"
          });
      }
    };
    $.post(url, data, success)
    $('.loader-bg').fadeOut();
}
