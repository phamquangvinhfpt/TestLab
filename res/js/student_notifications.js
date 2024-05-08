$(function() {
    $("form").on('submit', function(event) {
        event.preventDefault();
    });
    get_notifications();
});

function get_notifications() {
    $('#preload').removeClass('hidden');
    var url = "index.php?action=get_notifications";
    var success = function(result) {
        var json_data = $.parseJSON(result);
        insert_notification(json_data);
        $('#preload').addClass('hidden');
    };
    $.get(url, success);
}

function insert_notification(data) {
    var list = $('#content');
    list.empty();
    for (var i = 0; i < data.length; i++) {
      list.append('<div id="student-notifications-' + data[i].notification_id + '" class="col-md-12 col-sm-12">'+
        '<div class="card card-border-c-green">'+
              '<div class="card-header">'+
                  '<a href="#!" class="text-secondary">#' + data[i].notification_id + '. ' + data[i].name + ' ( ' + data[i].username + ' ) </a>'+
                  '<span class="label label-success float-right"> ' + data[i].time_sent + ' </span>'+
              '</div>'+
              '<div class="card-block card-task">'+
                  '<div class="row">'+
                      '<div class="col-sm-12">'+
                          '<p class="task-due"><strong class="label label-success">' + data[i].notification_title + '</strong></p>'+
                          '<p class="task-detail">' + data[i].notification_content + '</p>'+
                      '</div>'+
                  '</div>'+
                  '<hr>'+
              '</div>'+
          '</div>'+
      '</div>');
    }
}
