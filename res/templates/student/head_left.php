<!DOCTYPE html>
<html lang="vi">

<head>
  <title><?=Config::TITLE?></title>
  <!-- Meta -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Favicon icon -->
  <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">
  <!-- fontawesome icon -->
  <link rel="stylesheet" href="assets/fonts/fontawesome/css/fontawesome-all.min.css">
  <!-- animation css -->
  <link rel="stylesheet" href="assets/plugins/animation/css/animate.min.css">
  <!-- notification css -->
  <link rel="stylesheet" href="assets/plugins/notification/css/notification.min.css">
  <!-- data tables css -->
  <link rel="stylesheet" href="assets/plugins/data-tables/css/datatables.min.css">
  <!-- vendor css -->
  <link rel="stylesheet" href="assets/css/style.css">
  <!-- MathJax -->
<script type="text/x-mathjax-config">
    MathJax.Hub.Config({
      tex2jax: {inlineMath: [['$','$'], ['\\(','\\)']]}
    });
</script>
<script type="text/javascript" async src="//cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-MML-AM_CHTML">
</script>
  <!-- custom js -->
  <script type="text/javascript">
    var count_notify = <?=$info['notification']?>;
  </script>
  <!-- ckeditor -->
  <script src='assets/plugins/wiris/ckeditor4/ckeditor.js'></script>
  <!-- student_functions -->
	<script src="res/js/student_functions.js"></script>
</head>

<body id="ani-scroll" class="layout-8">
  <!-- [ Pre-loader ] start -->
  <div class="loader-bg">
    <div class="loader-track">
      <div class="loader-fill"></div>
    </div>
  </div>
  <!-- [ Pre-loader ] End -->

  <!-- [ navigation menu ] start -->
  <nav class="pcoded-navbar menu-light brand-lightblue icon-colored navbar-collapsed">
    <div class="navbar-wrapper">
      <div class="navbar-brand header-logo">
        <a href="/" class="b-brand">
          <div class="b-bg">
            <i class="feather icon-trending-up"></i>
          </div>
          <span class="b-title">ANI - TEST LAB</span>
        </a>
        <a class="mobile-menu" id="mobile-collapse" href="#!"><span></span></a>
      </div>
      <div class="navbar-content scroll-div">
        <ul class="nav pcoded-inner-navbar">
          <li class="nav-item pcoded-menu-caption">
            <label>Menu</label>
          </li>
          <li data-name="danh-sach-bai-thi" class="nav-item"><a href="/" class="nav-link"><span class="pcoded-micon"><i class="feather icon-home"></i></span><span class="pcoded-mtext">Kho đề thi</span></a></li>
          <li data-name="kho-de-on-luyen" class="nav-item"><a href="on-luyen" class="nav-link"><span class="pcoded-micon"><i class="feather icon-layers"></i></span><span class="pcoded-mtext">Kho đề ôn luyện</span></a></li>
          <li class="nav-item pcoded-hasmenu">
              <a href="#!" class="nav-link"><span class="pcoded-micon"><i class="feather icon-download-cloud"></i></span><span class="pcoded-mtext">Kho tài liệu</span></a>
              <ul class="pcoded-submenu">
                  <li class="pcoded-hasmenu"><a href="#!" class="">Phân loại</a>
                      <ul class="pcoded-submenu">
                        <li class=""><a href="index.php?action=show_tai_lieu_kien_thuc" class="">Kiến thức</a></li>
                        <li class=""><a href="index.php?action=show_tai_lieu_phuong_phap" class="">Phương pháp</a></li>
                        <li class=""><a href="index.php?action=show_tai_lieu_de_tham_khao" class="">Đề tham khảo</a></li>
                        <li class=""><a href="index.php?action=show_tai_lieu_video" class="">Tài liệu video</a></li>
                        <li class=""><a href="index.php?action=show_tai_lieu_khac" class="">Tài liệu khác</a></li>
                      </ul>
                  </li>
              </ul>
          </li>
          <li class="nav-item pcoded-hasmenu">
              <a href="#!" class="nav-link "><span class="pcoded-micon"><i class="feather icon-trending-up"></i></span><span class="pcoded-mtext">Thống kê</span></a>
              <ul class="pcoded-submenu">
                <li data-name="diem-so" class="nav-item"><a href="diem-so" class="nav-link"><span class="pcoded-micon"><i class="feather icon-percent"></i></span><span class="pcoded-mtext">Điểm số cá nhân</span></a></li>
                <li data-name="cau-sai" class="nav-item"><a href="ti-le-chon-sai" class="nav-link"><span class="pcoded-micon"><i class="feather icon-file-text"></i></span><span class="pcoded-mtext">Câu hỏi chọn sai nhiều</span></a></li>
              </ul>
          </li>
          <li data-name="bang-xep-hang" class="nav-item"><a href="bang-xep-hang" class="nav-link"><span class="pcoded-micon"><i class="feather icon-award"></i></span><span class="pcoded-mtext">Bảng xếp hạng thi đua</span></a></li>
          <li data-name="thong-bao" class="nav-item"><a href="thong-bao" class="nav-link"><span class="pcoded-micon"><i class="fas fa-bell"></i></span><span class="pcoded-mtext">Xem thông báo</span></a></li>
          <li data-name="phan-hoi" class="nav-item"><a href="phan-hoi" class="nav-link"><span class="pcoded-micon"><i class="feather icon-star-on"></i></span><span class="pcoded-mtext">Đóng góp ý kiến</span></a></li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- [ navigation menu ] end -->

  <!-- [ Header ] start -->
  <header class="navbar pcoded-header navbar-expand-lg navbar-light header-lightblue headerpos-fixed">
    <div class="m-header">
      <a class="mobile-menu" id="mobile-collapse1" href="#!"><span></span></a>
      <a href="/" class="b-brand">
        <div class="b-bg">
          <i class="feather icon-trending-up"></i>
        </div>
        <span class="b-title">ANI - TEST LAB</span>
      </a>
    </div>
    <a class="mobile-menu" id="mobile-header" href="#!">
      <i class="feather icon-more-horizontal"></i>
    </a>
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav mr-auto">
        <li><a href="#!" class="full-screen" onclick="javascript:toggleFullScreen()"><i class="feather icon-maximize"></i></a></li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
            <a class="dropdown-toggle" href="#" data-toggle="dropdown">Xếp hạng</a>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#!"><h6>Danh Hiệu: <span class="badge badge-primary"><?=$info['rank_name']?></span></h6></a></li>
                <li><a class="dropdown-item" href="#!"><h6>Xếp Hạng: <span class="badge badge-primary"><?=$info['rank']?></span></h6></a></li>
                <li><a class="dropdown-item" href="#!"><h6>EXP: <span class="badge badge-primary"><?=($info['rank_exp']-$info['exp_remaining'])?>/<?=$info['rank_exp']?></span></h6></a></li>
                <li><a class="dropdown-item" href="#!"><h6>Tổng EXP: <span class="badge badge-primary"><?=$info['EXP']?></span></h6></a></li>
            </ul>
        </li>
        <li>
            <a href="thong-bao" ><i class="icon feather icon-bell"></i></a> <?php if ($info['notification']>0) { echo '<span class="badge badge-pill badge-danger">'.$info['notification'].'</span>';} ?>
        </li>
        <li><a href="tin-nhan"><i class="icon feather icon-mail"></i></a></li>
        <li>
          <div class="dropdown drp-user">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="icon feather icon-settings"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right profile-notification">
              <div class="pro-head">
                <img src="upload/avatar/<?=$info['avatar']?>" class="img-radius" alt="User-Profile-Image">
                <span><?=$info['name']?></span>
                <a href="auth-signin.html" class="dud-logout" title="Logout">
                  <i class="feather icon-log-out"></i>
                </a>
              </div>
              <ul class="pro-body">
                <li><a href="#!" class="dropdown-item"><i class="feather icon-settings"></i>Cài đặt</a></li>
                <li><a href="trang-ca-nhan" class="dropdown-item"><i class="feather icon-user"></i>Thông tin</a></li>
                <li><a href="tin-nhan" class="dropdown-item"><i class="feather icon-mail"></i>Tin nhắn</a></li>
                <li><a onclick="logout();" href="#!" class="dropdown-item"><i class="feather icon-lock"></i>Đăng xuất</a></li>
              </ul>
            </div>
          </div>
        </li>
      </ul>
    </div>
  </header>
  <!-- [ Header ] end -->

  <!-- [ chat user list ] start -->
  <section class="header-user-list">
    <div class="h-list-header">
      <div class="input-group">
        <input type="text" id="search-friends" class="form-control" placeholder="Tìm kiếm . . .">
      </div>
    </div>
    <div class="h-list-body">
      <a href="#!" class="h-close-text"><i class="feather icon-chevrons-right"></i></a>
      <div class="main-friend-cont scroll-div">
        <div class="main-friend-list">
          <div class="media userlist-box" data-id="1" data-status="offline" data-username="Nguyễn Văn Cao Kỳ">
            <a class="media-left" href="#!"><img class="media-object img-radius" src="assets/images/user/avatar-1.jpg">
              <div class="live-status">3</div>
            </a>
            <div class="media-body">
              <h6 class="chat-header">Nguyễn Văn Cao Kỳ<small class="d-block text-c-red">offline</small></h6>
            </div>
          </div>
          <div class="media userlist-box" data-id="2" data-status="offline" data-username="Nguyễn Ngô Thanh Diệu">
            <a class="media-left" href="#!"><img class="media-object img-radius" src="assets/images/user/avatar-2.jpg">
              <div class="live-status">1</div>
            </a>
            <div class="media-body">
              <h6 class="chat-header">Nguyễn Ngô Thanh Diệu<small class="d-block text-c-red">offline</small></h6>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- [ chat user list ] end -->

  <!-- [ chat message ] start -->
  <section class="header-chat">
    <div class="h-list-header">
      <h6>Nguyễn Văn Cao Kỳ</h6>
      <a href="#!" class="h-back-user-list"><i class="feather icon-chevron-left"></i></a>
    </div>
    <div class="h-list-body">
      <div class="main-chat-cont scroll-div">
        <div class="main-friend-chat">
          <div class="media chat-messages">
            <a class="media-left photo-table" href="#!"><img class="media-object img-radius img-radius m-t-5" src="assets/images/user/avatar-2.jpg" alt="Generic placeholder image"></a>
            <div class="media-body chat-menu-content">
              <div class="">
                <p class="chat-cont">Tinh nhắn thử nghiệm</p>
                <p class="chat-cont">123456</p>
              </div>
              <!-- <p class="chat-time">8:20 a.m.</p> -->
            </div>
          </div>
          <div class="media chat-messages">
            <div class="media-body chat-menu-reply">
              <div class="">
                <p class="chat-cont">Thử nghiệm</p>
              </div>
              <!-- <p class="chat-time">8:22 a.m.</p> -->
            </div>
          </div>
          <div class="media chat-messages">
            <a class="media-left photo-table" href="#!"><img class="media-object img-radius img-radius m-t-5" src="assets/images/user/avatar-2.jpg" alt="Generic placeholder image"></a>
            <div class="media-body chat-menu-content">
              <div class="">
                <p class="chat-cont">987654321</p>
              </div>
              <!-- <p class="chat-time">8:20 a.m.</p> -->
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="h-list-footer">
      <div class="input-group">
        <input type="file" class="chat-attach" style="display:none">
        <a href="#!" class="input-group-prepend btn btn-success btn-attach">
          <i class="feather icon-paperclip"></i>
        </a>
        <input type="text" name="h-chat-text" class="form-control h-send-chat" placeholder=" ">
        <button type="submit" class="input-group-append btn-send btn btn-primary">
          <i class="feather icon-message-circle"></i>
        </button>
      </div>
    </div>
  </section>
  <!-- [ chat message ] end -->
