$(document).ready(function() {
    $.ajaxSetup({
       type: 'POST',
       headers: { "cache-control": "no-cache" }
    });
    get_recent_messenger_user();
    get_count_messenger_seen();
    $("#msg-friends").on("keyup", function() {
        var g = $(this).val().toLowerCase();
        $(".msg-user-list .userlist-box .media-body .chat-header").each(function() {
            var s = $(this).text().toLowerCase();
            $(this).closest('.userlist-box')[s.indexOf(g) !== -1 ? 'show' : 'hide']();
        });
    });
    $("#search_new_user").on("keyup", function() {
        var str_n = $(this).val().toLowerCase();
        $("#list_new_users").empty();
        get_list_user_search(str_n);

    });
    $('#OpenImgUpload').click(function() {
        $('#imgupload').trigger('click');
    });
    $('.msg-send-chat').on('keyup', function(e) {
        msg_cfc(e);
    });
    $('.btn-msg-send').on('click', function(e) {
        msg_fc(e);
    });
    setInterval(function(){
        get_count_messenger_seen();
        get_new_messenger($('.media.userlist-box.active').attr('data-username'));
    }, 3000);


    var ps = new PerfectScrollbar('.msg-user-list.scroll-div', {
        wheelSpeed: 1,
        swipeEasing: 0,
        suppressScrollX: !0,
        wheelPropagation: 1,
        minScrollbarLength: 40,
    });
    var ps = new PerfectScrollbar('.msg-user-chat.scroll-div', {
        wheelSpeed: 2,
        swipeEasing: 0,
        suppressScrollX: !0,
        wheelPropagation: 1,
        minScrollbarLength: 40,
    });
    $(".task-right-header-status").on('click', function() {
        $(".taskboard-right-progress").slideToggle();
    });

    $(".message-mobile .media").on('click', function() {
        var vw = $(window)[0].innerWidth;
        if (vw < 992) {
            $(".taskboard-right-progress").slideUp();
            $(".msg-block").addClass('dis-chat');
        }
    });
});
function msg_cfc(e) {
    if (e.which == 13) {
        msg_fc(e);
    }
};
function msg_fc(e) {
    var id = date_now();
    $('.msg-block .main-friend-chat').append('' +
        '<div class="media chat-messages">' +
        '<div class="media-body chat-menu-reply">' +
        '<div class="">' +
        '<p class="chat-cont">' + $('.msg-send-chat').val() + '</p>' +
        '</div>' +
        '<p class="chat-time" id="'+id+'"><span class="spinner-border spinner-border-sm" role="status"><span class="sr-only">Loading...</span></span></p>' +
        '</div>' +
        '</div>' +
        '');
    msg_fsc();
    send_messenger($('.media.userlist-box.active').attr('data-username'),$('.msg-send-chat').val(),id,'text');
    $('.msg-send-chat').val(null);
};
function date_now() {
  var d = new Date();
  var n = d.getTime();
  return n;
}
function msg_fsc() {
  $(".msg-user-chat.scroll-div").scrollTop($(".msg-user-chat.scroll-div")[0].scrollHeight);
}
function scroll_bootom() {
  $(".msg-user-chat.scroll-div").animate({scrollTop:$(".msg-user-chat.scroll-div")[0].scrollHeight}, 500);
}
function clear_scroll() {
  $(".msg-user-chat.scroll-div").scrollTop(0);
  $(".msg-user-chat.scroll-div").animate({scrollTop:$(".msg-user-chat.scroll-div")[0].scrollHeight}, 500);
}
function get_recent_messenger_user() {
  var url = "index.php?action=get_recent_messenger_user";
  var success = function(result) {
      var json_data = $.parseJSON(result);
      show_recent_messenger_user(json_data);
  };
  $.get(url, success);
}
function get_list_user_search(string) {
  var data = {
    string: string
  }
  var url = "index.php?action=get_list_user_search";
  var success = function(result) {
      var json_data = $.parseJSON(result);
      show_list_user_search(json_data);
  };
  $.post(url, data, success);
}
function show_list_user_search(json_data) {
  $.each(json_data, function(index, value) {
    if (value.permission==2) {
      var badge = ' <a href="#!" class="badge badge-danger">GV</a>';
    } else {
      var badge = ' <a href="#!" class="badge badge-info">HS</a>';
    }
    $('#list_new_users').append(''+
    '<div class="col-12">'+
      '<div class="row">'+
        '<div class="col-4">'+
          '<img width="100px" height="100px" src="upload/avatar/'+ value.avatar +'" alt="'+ value.username +' avatar">'+
        '</div>'+
        '<div class="col-8">'+
          '<h5 class="card-title">'+ value.name + badge + '</h5>' +
          '<button data-username="'+ value.username +'" data-avatar="'+ value.avatar +'" data-name="'+ value.name +'" data-permission="'+ value.permission +'" onclick="new_messenger(this)" class="btn btn-sm btn-outline-primary"><i class="feather icon-message-square"></i>Gửi tin nhắn</button>'+
        '</div>'+
      '</div>'+
    '</div>'
    );
  });
}
function new_messenger(data) {
  $('.new_messenger').modal('hide');
  if (data.dataset.permission==2) {
    var badge = ' <a href="#!" class="badge badge-danger">GV</a>';
  } else {
    var badge = ' <a href="#!" class="badge badge-info">HS</a>';
  }
  $('.main-friend-list').prepend('' +
    '<div onclick="get_user_messenger('+ String.fromCharCode(39) + data.dataset.username + String.fromCharCode(39) +');" class="media userlist-box" data-status="online" data-username="'+ data.dataset.username +'">' +
    '<a class="media-left" href="#!">' +
    '<img class="media-object img-radius" src="upload/avatar/'+ data.dataset.avatar +'" alt="'+ data.dataset.username +' avatar">' +
    '<div style="display:none" class="live-status"></div>'+
    '</a>'+
    '<div class="media-body">'+
    '<h6 class="chat-header">'+ data.dataset.name + badge +
    '<small class="d-block text-c-green">online</small></h6>'+
    '</div>'+
    '</div>'
  );
  get_user_messenger(data.dataset.username);
}
function show_recent_messenger_user(json_data) {
  $.each(json_data, function(index, value) {
    if (value.permission==2) {
      var badge = ' <a href="#!" class="badge badge-danger">GV</a>';
    } else {
      var badge = ' <a href="#!" class="badge badge-info">HS</a>';
    }
    $('.main-friend-list').append('' +
      '<div onclick="get_user_messenger('+ String.fromCharCode(39) + value.username + String.fromCharCode(39) +');" class="media userlist-box" data-status="online" data-username="'+ value.username +'">' +
      '<a class="media-left" href="#!">' +
      '<img class="media-object img-radius" src="upload/avatar/'+ value.avatar +'" alt="'+ value.username +' avatar">' +
      '<div style="display:none" class="live-status"></div>'+
      '</a>'+
      '<div class="media-body">'+
      '<h6 class="chat-header">'+ value.name + badge +
      '<small class="d-block text-c-green">online</small></h6>'+
      '</div>'+
      '</div>'
    );
  });
  get_user_messenger(json_data[0].username);
}
function get_user_messenger(username) {
  $('.userlist-box').removeClass("active");
  $('[data-username='+username+']').addClass("active");
  $('.msg-block .main-friend-chat').empty();
  var data = {
    username: username
  }
  var url = "index.php?action=get_user_messenger";
  var success = function(result) {
      var json_data = $.parseJSON(result);
      $("[data-username='"+username+"'] a div").css("display","none");
      show_user_messenger(json_data,username);
  };
  $.post(url, data, success);
}
function show_user_messenger(json_data,username) {
  $.each(json_data, function(index, value) {
    if (value.username_get==username) {
      if (value.type == "link") {
        var node = '' +
            '<div class="media chat-messages">' +
            '<div class="media-body chat-menu-reply">' +
            '<div class="">' +
            '<p class="chat-cont"><a href="upload/messenger/' + value.content + '">' + value.content + '</a></p>' +
            '</div>' +
            '<p class="chat-time">'+ value.time +'</p>' +
            '</div>' +
            '</div>' +
            '';
      } else {
        var node = '' +
            '<div class="media chat-messages">' +
            '<div class="media-body chat-menu-reply">' +
            '<div class="">' +
            '<p class="chat-cont">' + value.content + '</p>' +
            '</div>' +
            '<p class="chat-time">'+ value.time +'</p>' +
            '</div>' +
            '</div>' +
            '';
      }
      $('.msg-block .main-friend-chat').append(node);
    } else {
      var avatar = $('[data-username='+username+'] img').attr('src');
      if (value.type == "link") {
        var node = '' +
            '<div class="media chat-messages">' +
            '<a class="media-left photo-table" href="#!"><img class="media-object img-radius img-radius m-t-5" src="'+avatar+'" alt="'+username+' avatar"></a>' +
            '<div class="media-body chat-menu-content">' +
            '<div class="">' +
            '<p class="chat-cont"><a href="upload/messenger/' + value.content + '">' + value.content + '</a></p>' +
            '</div>' +
            '<p class="chat-time">'+ value.time +'</p>' +
            '</div>' +
            '</div>' +
            '';
      } else {
        var node = '' +
            '<div class="media chat-messages">' +
            '<a class="media-left photo-table" href="#!"><img class="media-object img-radius img-radius m-t-5" src="'+avatar+'" alt="'+username+' avatar"></a>' +
            '<div class="media-body chat-menu-content">' +
            '<div class="">' +
            '<p class="chat-cont">' + value.content + '</p>' +
            '</div>' +
            '<p class="chat-time">'+ value.time +'</p>' +
            '</div>' +
            '</div>' +
            '';
      }
      $('.msg-block .main-friend-chat').append(node);
    }
  });
  clear_scroll();
}
function send_messenger(username,content,id,type) {
  var data = {
    username: username,
    content: content,
    type: type
  }
  var url = "index.php?action=send_messenger";
  var success = function(result) {
      var json_data = $.parseJSON(result);
      if (json_data.status==1) {
        $('#'+id).empty();
        $('#'+id).append('<i class="fas fa-check-circle"></i>');
      }
  };
  $.post(url, data, success);
}
function get_count_messenger_seen() {
  var url = "index.php?action=get_count_messenger_seen";
  var success = function(result) {
      var json_data = $.parseJSON(result);
      $.each(json_data, function(index, value) {
        var username_send = value.send_get.split(":")[0];
        if (value.count>0) {
          $("[data-username='"+username_send+"'] a div").text(value.count);
          $("[data-username='"+username_send+"'] a div").css("display","block");
        }
      });
  };
  $.get(url, success);
}
function get_new_messenger() {
  var data = {
    username: $('.media.userlist-box.active').attr('data-username')
  }
  var url = "index.php?action=get_new_messenger";
  var success = function(result) {
      var json_data = $.parseJSON(result);
      if (json_data.length>0) {
        $.each(json_data, function(index, value) {
            if ($('.media.userlist-box.active').attr('data-username')==value.username_send) {
              var avatar = $('[data-username='+value.username_send+'] img').attr('src');
              if (value.type == "link") {
                var node = '' +
                    '<div class="media chat-messages">' +
                    '<a class="media-left photo-table" href="#!"><img class="media-object img-radius img-radius m-t-5" src="'+avatar+'" alt="'+value.username_send+' avatar"></a>' +
                    '<div class="media-body chat-menu-content">' +
                    '<div class="">' +
                    '<p class="chat-cont"><a href="upload/messenger/' + value.content + '">' + value.content + '</a></p>' +
                    '</div>' +
                    '<p class="chat-time">'+ value.TIME +'</p>' +
                    '</div>' +
                    '</div>' +
                    '';
              } else {
                var node = '' +
                    '<div class="media chat-messages">' +
                    '<a class="media-left photo-table" href="#!"><img class="media-object img-radius img-radius m-t-5" src="'+avatar+'" alt="'+value.username_send+' avatar"></a>' +
                    '<div class="media-body chat-menu-content">' +
                    '<div class="">' +
                    '<p class="chat-cont">' + value.content + '</p>' +
                    '</div>' +
                    '<p class="chat-time">'+ value.TIME +'</p>' +
                    '</div>' +
                    '</div>' +
                    '';
              }

              $('.msg-block .main-friend-chat').append(node);
            }
        });
        scroll_bootom();
      }

  };
  $.post(url, data, success);
}
function upload_file_data(data) {
  var file_data = $('#imgupload').prop('files')[0];
  var form_data = new FormData();
  form_data.append('file', file_data);
  $.ajax({
      url: 'index.php?action=upload_file_data',
      dataType: 'text',
      cache: false,
      contentType: false,
      processData: false,
      data: form_data,
      type: 'post',
      success: function(result) {
          var json_data = $.parseJSON(result);
          if (json_data.status) {
            var id = date_now();
            $('.msg-block .main-friend-chat').append('' +
                '<div class="media chat-messages">' +
                '<div class="media-body chat-menu-reply">' +
                '<div class="">' +
                '<p class="chat-cont"><a href="upload/messenger/' + json_data.status_value + '">' + json_data.status_value + '</a></p>' +
                '</div>' +
                '<p class="chat-time" id="'+id+'"><span class="spinner-border spinner-border-sm" role="status"><span class="sr-only">Loading...</span></span></p>' +
                '</div>' +
                '</div>' +
                '');
            msg_fsc();
            send_messenger($('.media.userlist-box.active').attr('data-username'),json_data.status_value,id,'link');
          } else {
            swal(json_data.status_value, {
                icon: "danger",
            });
          }
      }
  });
};
