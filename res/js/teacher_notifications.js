$(function() {
    $("form").on('submit', function(event) {
        event.preventDefault();
    });
    get_notifications_to_student();
    get_notifications_by_admin();
    $('#submit').on('click', function() {
        send_notification();
    });
});

function get_notifications_to_student() {
    $('#preload').removeClass('hidden');
    var url = "index.php?action=get_notifications_to_student";
    var success = function(result) {
        var json_data = $.parseJSON(result);
        insert_student_notification(json_data);
        $('#preload').addClass('hidden');
    };
    $.get(url, success);
}

function sort_data(data) {
  var array_class_id = [];
  var array_class_name = [];
  var array_notification = [];
  for (var i = 0; i < data.length; i++) {
    if (i == 0) {
      array_class_id.push(data[i].class_id);
      array_class_name.push(data[i].class_name);
    } else {
      if (data[i].notification_id == data[i-1].notification_id) {
        array_class_id.push(data[i].class_id);
        array_class_name.push(data[i].class_name);
        console.log(i,"==",i-1);
        console.log(array_class_id);
        console.log(array_class_name);
      } else {
        var obj = {
          "notification_id" : data[i-1].notification_id,
          "class_id" : array_class_id,
          "class_name" : array_class_name,
          "name" : data[i-1].name,
          "username" : data[i-1].username,
          "notification_title" : data[i-1].notification_title,
          "notification_content" : data[i-1].notification_content,
          "time_sent" : data[i-1].time_sent
        }
        array_class_id = [];
        array_class_name = [];
        array_class_id.push(data[i].class_id);
        array_class_name.push(data[i].class_name);
        array_notification.push(obj);
      }
    }
    if (i == (data.length-1)) {
      console.log('cuối');
      var obj = {
        "notification_id" : data[i].notification_id,
        "class_id" : array_class_id,
        "class_name" : array_class_name,
        "username" : data[i].username,
        "name" : data[i].name,
        "notification_title" : data[i].notification_title,
        "notification_content" : data[i].notification_content,
        "time_sent" : data[i].time_sent
      }
      array_notification.push(obj);
    }
  }
  return array_notification;
}

function insert_student_notification(data) {
    var list = $('#student_content');
    list.empty();
    data = sort_data(data);

    for (var i = 0; i < data.length; i++) {
      var arr_class_name = "";
      for (var j = 0; j < data[i].class_name.length; j++) {
        arr_class_name += '<strong class="label label-warning">' + data[i].class_name[j] + '</strong>';
      }
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
                  '<div class="task-list-table">'+
                      '<p class="task-due"><strong>Người Nhận : </strong>'+ arr_class_name +
                      '</p>'+
                      '<a href="#!"><img style="with:40px" class="img-fluid img-radius mr-1" src="assets/images/user/avatar-2.jpg" alt="1" /></a>'+
                  '</div>'+
              '</div>'+
          '</div>'+
      '</div>');
    }
}




function get_notifications_by_admin() {
    $('#preload').removeClass('hidden');
    var url = "index.php?action=get_notifications_by_admin";
    var success = function(result) {
        var json_data = $.parseJSON(result);
        show_admin_notification(json_data);
        $('#preload').addClass('hidden');
    };
    $.get(url, success);
}


function show_admin_notification(data) {
    var list = $('#admin_content');
    list.empty();
    for (var i = 0; i < data.length; i++) {
      list.append('<div id="student-notifications-' + data[i].notification_id + '" class="col-md-12 col-sm-12">'+
        '<div class="card card-border-c-red">'+
              '<div class="card-header">'+
                  '<a href="#!" class="text-secondary">#' + data[i].notification_id + '. ' + data[i].name + ' ( ' + data[i].username + ' ) </a>'+
                  '<span class="label label-danger float-right"> ' + data[i].time_sent + ' </span>'+
              '</div>'+
              '<div class="card-block card-task">'+
                  '<div class="row">'+
                      '<div class="col-sm-12">'+
                          '<p class="task-due"><strong class="label label-warning">' + data[i].notification_title + '</strong></p>'+
                          '<p class="task-detail">' + data[i].notification_content + '</p>'+
                      '</div>'+
                  '</div>'+
                  '<hr>'+
              '</div>'+
          '</div>'+
      '</div>');
    }
}
function send_notification() {
    $('#preload').removeClass('hidden');
    var url = "index.php?action=send_notification";
    var class_id_value = $('#class_id').val();
    var class_id = JSON.stringify(class_id_value);
    var notification_title = $('#notification_title').val();
    var notification_content = $('#notification_content').val();
    console.log(class_id);
    var data = {
        class_id: class_id,
        notification_title: notification_title,
        notification_content: notification_content
    };
    var success = function(result) {
        var json_data = $.parseJSON(result);
        if (json_data.status) {
          swal("Gửi thông báo thành công!", {
              icon: "success",
          });
          $('#send_notification')[0].reset();
          $('select').multiSelect('refresh');
        } else {
          swal(json_data.status_value, {
              icon: "warning",
          });
        }
        get_notifications_to_student();
        $('#preload').addClass('hidden');
    };
    $.post(url, data, success);
}



// [ Searchable ] start
$('.searchable').multiSelect({
    selectableHeader: "<input type='text' class='form-control' autocomplete='off' placeholder='tìm kiếm...'>",
    selectionHeader: "<input type='text' class='form-control' autocomplete='off' placeholder='tìm kiếm...'>",
    afterInit: function(ms) {
        var that = this,
            $selectableSearch = that.$selectableUl.prev(),
            $selectionSearch = that.$selectionUl.prev(),
            selectableSearchString = '#' + that.$container.attr('id') + ' .ms-elem-selectable:not(.ms-selected)',
            selectionSearchString = '#' + that.$container.attr('id') + ' .ms-elem-selection.ms-selected';

        that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
            .on('keydown', function(e) {
                if (e.which === 40) {
                    that.$selectableUl.focus();
                    return false;
                }
            });

        that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
            .on('keydown', function(e) {
                if (e.which == 40) {
                    that.$selectionUl.focus();
                    return false;
                }
            });
    },
    afterSelect: function() {
        this.qs1.cache();
        this.qs2.cache();
    },
    afterDeselect: function() {
        this.qs1.cache();
        this.qs2.cache();
    }
});
$('#select-all-class').on('click', function() {
    $('#class_id').multiSelect('select_all');
    return false;
});
$('#deselect-all-class').on('click', function() {
    $('#class_id').multiSelect('deselect_all');
    return false;
});
