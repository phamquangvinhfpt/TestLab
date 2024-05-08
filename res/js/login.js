$(function() {
});
function submit_login(login_from) {
  $('.loader-bg').fadeIn();
  var url = "index.php?action=submit_login";
  var data = {
    username: $('#username').val(),
    password: $('#password').val()
  }
  var success = function(result) {
    var json_data = $.parseJSON(result);
    if (json_data.status) {
      swal({
        title: json_data.status_value,
        text: "Xin chào " + json_data.name,
        icon: "success",
        timer: 2000,
        buttons: false
      });
      setTimeout(function() {
        window.location.href = "/";
      }, 1500);
      $('.loader-bg').fadeOut();
    } else {
      swal({
        title: "Đăng nhập thất bại !",
        text: json_data.status_value,
        icon: "error",
        timer: 2000,
        buttons: false
      });
      $('.loader-bg').fadeOut();
    }
  };
  $.post(url, data, success);
}


function submit_forgot_password() {
  $('#loading').removeClass('hidden');
  var url = "index.php?action=submit_forgot_password";
  var data = {
    username: $("#username").val()
  };
  var success = function(result) {
    var json_data = $.parseJSON(result);
    show_status(json_data);
    $('#loading').addClass('hidden');
  };
  $.post(url, data, success);
}
