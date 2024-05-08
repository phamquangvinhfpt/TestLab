<!DOCTYPE html>
<html lang="en">

<head>
    <title>Bài thi</title>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="Datta Able Bootstrap admin template made using Bootstrap 4 and it has huge amount of ready made feature, UI components, pages which completely fulfills any dashboard needs." />
    <meta name="keywords" content="admin templates, bootstrap admin templates, bootstrap 4, dashboard, dashboard templets, sass admin templets, html admin templates, responsive, bootstrap admin templates free download,premium bootstrap admin templates, datta able, datta able bootstrap admin template">
    <meta name="author" content="Codedthemes" />

    <!-- Favicon icon -->
    <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">
    <!-- fontawesome icon -->
    <link rel="stylesheet" href="assets/fonts/fontawesome/css/fontawesome-all.min.css">
    <!-- animation css -->
    <link rel="stylesheet" href="assets/plugins/animation/css/animate.min.css">
    <!-- prism css -->
    <link rel="stylesheet" href="assets/plugins/prism/css/prism.min.css">
    <!-- vendor css -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- custom css -->
    <style media="screen">
    .tab-content {
      background: #fff7db !important;
    }
    .nav-pills {
      background-color: #c5fff1 !important;
    }
    .custom-control-label {
      color: black !important;
      font-weight: bold !important;
    }
    </style>
    <!-- MathJax -->
    <script type="text/x-mathjax-config">
        MathJax.Hub.Config({
          tex2jax: {inlineMath: [['$','$'], ['\\(','\\)']]}
        });
    </script>
    <script type="text/javascript" async src="//cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-MML-AM_CHTML">
    </script>
    <!-- sweet alert Js -->
    <script src="assets/plugins/sweetalert/js/sweetalert.min.js"></script>
</head>
<body class="layout-6" style="background-image: url(../assets/images/bg-images/bg3.jpg);background-size: cover;">
    <!-- [ Pre-loader ] start -->
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>
    <!-- [ Pre-loader ] End -->

    <!-- [ navigation menu ] start -->
    <nav class="pcoded-navbar menu-light brand-lightblue active-lightblue menu-item-icon-style4">
        <div class="navbar-wrapper">
            <div class="navbar-brand header-logo">
                <a href="index.html" class="b-brand">
                    <div class="b-bg">
                        <i class="feather icon-clock"></i>
                    </div>
                    <span class="b-title-timer">
                      <span id="min">99</span>
                      :
                      <span id="sec">99</span>
                    </span>
                </a>
                <a class="mobile-menu" id="mobile-collapse" href="#!"><span></span></a>
            </div>
            <div class="navbar-content scroll-div">
                <ul class="nav pcoded-inner-navbar">
                    <li class="nav-item pcoded-hasmenu active pcoded-trigger">
                        <a href="#!" class="nav-link "><span class="pcoded-micon"><i class="feather icon-home"></i></span><span class="pcoded-mtext">Câu hỏi</span></a>
                        <ul class="pcoded-submenu">
                            <?php
                            $checked_index = 0;
                            $checked_stt = array();
                      			for ($i = 0; $i < count($test); $i++) {
                      				if($test[$i]->student_answer != "") {
                      					echo '<li class=""><a href="#quest-'.($i+1).'" class="" id="tick-'.($i+1).'">Câu '.($i+1).' ✓</a></li>';
                                $checked_index = $checked_index + 1;
                                array_push($checked_stt,($i+1));
                      				} else {
                      					echo '<li class=""><a href="#quest-'.($i+1).'" class="" id="tick-'.($i+1).'">Câu '.($i+1).'</a></li>';
                      				}
                      			}
                      			?>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- [ navigation menu ] end -->

    <!-- [ Header ] start -->
    <header class="navbar pcoded-header navbar-expand-lg navbar-light headerpos-fixed">
        <div class="m-header">
            <a class="mobile-menu" id="mobile-collapse1" href="#!"><span></span></a>
            <a href="index.html" class="b-brand">
                   <div class="b-bg">
                       <i class="feather icon-clock"></i>
                   </div>
                   <span class="b-title-timer">
                     <span id="min-m">99</span>
                     :
                     <span id="sec-m">99</span>
                   </span>
               </a>
        </div>
        <a class="mobile-menu" id="mobile-header" href="#!">
            <i class="feather icon-more-horizontal"></i>
        </a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <li><a href="#!" class="full-screen" onclick="javascript:toggleFullScreen()"><i class="feather icon-maximize"></i></a></li>
            </ul>
        </div>
    </header>
    <!-- [ Header ] end -->

    <!-- [ chat user list ] start -->
    <section class="header-user-list">
        <div class="h-list-body">
            <a href="#!" class="h-close-text"></a>
            <div class="main-friend-cont">
                <div class="main-friend-list">
                </div>
            </div>
        </div>
    </section>
    <!-- [ chat user list ] end -->

    <!-- [ chat message ] start -->
    <section class="header-chat">
        <div class="h-list-body">
            <div class="main-chat-cont scroll-div">
                <div class="main-friend-chat">
                </div>
            </div>
        </div>
        <div class="h-list-footer">
            <div class="input-group">
                <input type="file" class="chat-attach" style="display:none">
                <a href="#!" class="input-group-prepend btn btn-success btn-attach">
                </a>
                <input type="text" name="h-chat-text" class="form-control h-send-chat" placeholder="Write hear . . ">
                <button type="submit" class="input-group-append btn-send btn btn-primary">
                </button>
            </div>
        </div>
    </section>
    <!-- [ chat message ] end -->

    <!-- [ Main Content ] start -->
    <div class="pcoded-main-container">
        <div class="pcoded-wrapper">
            <div class="pcoded-content">
                <div class="pcoded-inner-content">
                    <!-- [ breadcrumb ] start -->
                    <div class="page-header">
                        <div class="page-block">
                            <div class="row align-items-center">
                                <div class="col-md-12">
                                    <div class="page-header-title">
                                        <h5 class="m-b-10">Bài thi</h5>
                                    </div>
                                    <ul class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#!"><i class="feather icon-home"></i></a></li>
                                        <li class="breadcrumb-item"><a href="#!">Bài thi <?=$test[0]->test_code?></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- [ breadcrumb ] end -->
                    <div class="main-body">
                        <div class="page-wrapper">
                            <!-- [ Main Content ] start -->
                            <div class="row">
                              <div class="col-xl-12">
                                <div class="col-sm-12">
                                  <?php
                                  for($i = 0; $i < count($test); $i++) {
                                    ?>
                                    <div id="quest-<?=($i+1)?>" class="card">
                                        <div class="card-header">
                                            <h5>Câu <?=($i+1)?></h5>
                                            <div class="card-header-right">
                                                <div class="btn-group card-option">
                                                    <button type="button" class="btn dropdown-toggle btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="feather icon-more-horizontal"></i>
                                                    </button>
                                                    <ul class="list-unstyled card-option dropdown-menu dropdown-menu-right">
                                                        <li class="dropdown-item full-card"><a href="#!"><span><i class="feather icon-maximize"></i> maximize</span><span style="display:none"><i class="feather icon-minimize"></i> Restore</span></a></li>
                                                        <li class="dropdown-item minimize-card"><a href="#!"><span><i class="feather icon-minus"></i> collapse</span><span style="display:none"><i class="feather icon-plus"></i> expand</span></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-block" style="background-color: #fff7db !important;">
                                          <?php
                                          if ($test_type == 2) {
                                           ?>
                                          <ul class="nav nav-pills mb-0" id="pills-tab-<?=($i+1)?>" role="tablist">
                                              <li class="nav-item">
                                                  <a class="nav-link active" id="tab-quest-<?=($i+1)?>" data-toggle="pill" href="#pills-quest-<?=($i+1)?>" role="tab" aria-controls="pills-quest-<?=($i+1)?>" aria-selected="true">Câu hỏi</a>
                                              </li>
                                              <li class="nav-item">
                                                  <a class="nav-link" id="tab-answer-<?=($i+1)?>" data-toggle="pill" href="#pills-answer-<?=($i+1)?>" role="tab" aria-controls="pills-answer-<?=($i+1)?>" aria-selected="false">Hướng dẫn giải</a>
                                              </li>
                                          </ul>
                                          <div class="tab-content" id="pills-tab-<?=($i+1)?>Content">
                                              <div class="tab-pane fade show active" id="pills-quest-<?=($i+1)?>" role="tabpanel" aria-labelledby="pills-quest-<?=($i+1)?>">
                                                <div class="col-sm-12">
                                                        <h6><?=$test[$i]->question_content?></h6>
                                                </div>
                                                <br>
                                                  <?php




                                                  $random_answer = ['a','b','c','d'];
                                                  $random_answer_title = ['A','B','C','D'];
                                                  $random_answer_count = 0;
                                                  shuffle($random_answer);
                                                  while($random_answer_value = array_pop($random_answer)){
                                                    if ($random_answer_value == 'a') {
                                                      if (trim($test[$i]->student_answer) == trim($test[$i]->answer_a))
                                                      {
                                                        echo '
                                                        <div class="custom-control custom-radio">
                                                            <input class="custom-control-input" id="A_'.$test[$i]->question_id.'" name="'.$test[$i]->question_id.'" data-idquest="'.$test[$i]->question_id.'" type="radio" data-stt="'.($i+1).'" value="a" checked>
                                                            <label class="custom-control-label" for="A_'.$test[$i]->question_id.'">' . $test[$i]->answer_a . '</label>
                                                        </div>
                                                        ';
                                                      }
                                                      else
                                                      {
                                                        echo '
                                                        <div class="custom-control custom-radio">
                                                            <input class="custom-control-input" id="A_'.$test[$i]->question_id.'" name="'.$test[$i]->question_id.'" data-idquest="'.$test[$i]->question_id.'" type="radio" data-stt="'.($i+1).'" value="a">
                                                            <label class="custom-control-label" for="A_'.$test[$i]->question_id.'">' . $test[$i]->answer_a . '</label>
                                                        </div>
                                                        ';
                                                      }
                                                    } elseif ($random_answer_value == 'b') {
                                                      if (trim($test[$i]->student_answer) == trim($test[$i]->answer_b))
                                                      {
                                                        echo '
                                                        <div class="custom-control custom-radio">
                                                            <input class="custom-control-input" id="B_'.$test[$i]->question_id.'" name="'.$test[$i]->question_id.'" data-idquest="'.$test[$i]->question_id.'" type="radio" data-stt="'.($i+1).'" value="b" checked>
                                                            <label class="custom-control-label" for="B_'.$test[$i]->question_id.'">' . $test[$i]->answer_b . '</label>
                                                        </div>
                                                        ';
                                                      }
                                                      else
                                                      {
                                                        echo '
                                                        <div class="custom-control custom-radio">
                                                            <input class="custom-control-input" id="B_'.$test[$i]->question_id.'" name="'.$test[$i]->question_id.'" data-idquest="'.$test[$i]->question_id.'" type="radio" data-stt="'.($i+1).'" value="b">
                                                            <label class="custom-control-label" for="B_'.$test[$i]->question_id.'">' . $test[$i]->answer_b . '</label>
                                                        </div>
                                                        ';
                                                      }
                                                    } elseif ($random_answer_value == 'c') {
                                                      if (trim($test[$i]->student_answer) == trim($test[$i]->answer_c))
                                                      {
                                                        echo '
                                                        <div class="custom-control custom-radio">
                                                            <input class="custom-control-input" id="C_'.$test[$i]->question_id.'" name="'.$test[$i]->question_id.'" data-idquest="'.$test[$i]->question_id.'" type="radio" data-stt="'.($i+1).'" value="c" checked>
                                                            <label class="custom-control-label" for="C_'.$test[$i]->question_id.'">' . $test[$i]->answer_c . '</label>
                                                        </div>
                                                        ';
                                                      }
                                                      else
                                                      {
                                                        echo '
                                                        <div class="custom-control custom-radio">
                                                            <input class="custom-control-input" id="C_'.$test[$i]->question_id.'" name="'.$test[$i]->question_id.'" data-idquest="'.$test[$i]->question_id.'" type="radio" data-stt="'.($i+1).'" value="c">
                                                            <label class="custom-control-label" for="C_'.$test[$i]->question_id.'">' . $test[$i]->answer_c . '</label>
                                                        </div>
                                                        ';
                                                      }
                                                    } elseif ($random_answer_value == 'd') {
                                                      if (trim($test[$i]->student_answer) == trim($test[$i]->answer_d))
                                                      {
                                                        echo '
                                                        <div class="custom-control custom-radio">
                                                            <input class="custom-control-input" id="D_'.$test[$i]->question_id.'" name="'.$test[$i]->question_id.'" data-idquest="'.$test[$i]->question_id.'" type="radio" data-stt="'.($i+1).'" value="d" checked>
                                                            <label class="custom-control-label" for="D_'.$test[$i]->question_id.'">' . $test[$i]->answer_d . '</label>
                                                        </div>
                                                        ';
                                                      }
                                                      else
                                                      {
                                                        echo '
                                                        <div class="custom-control custom-radio">
                                                            <input class="custom-control-input" id="D_'.$test[$i]->question_id.'" name="'.$test[$i]->question_id.'" data-idquest="'.$test[$i]->question_id.'" type="radio" data-stt="'.($i+1).'" value="d">
                                                            <label class="custom-control-label" for="D_'.$test[$i]->question_id.'">' . $test[$i]->answer_d . '</label>
                                                        </div>
                                                        ';
                                                      }
                                                    }
                                                    $random_answer_count = ($random_answer_count+1);
                                                  }
                                                  ?>
                                              </div>
                                              <div class="tab-pane fade" id="pills-answer-<?=($i+1)?>" role="tabpanel" aria-labelledby="pills-answer-<?=($i+1)?>">
                                                <div class="col-sm-12">
                                                        <h6><?=$test[$i]->huong_dan?></h6>
                                                </div>
                                              </div>
                                          </div>
                                        <?php
                                        } else {
                                        ?>
                                        <div class="col-sm-12">
                                                <h6><?=$test[$i]->question_content?></h6>
                                        </div>
                                        <br>
                                          <?php




                                          $random_answer = ['a','b','c','d'];
                                          $random_answer_title = ['A','B','C','D'];
                                          $random_answer_count = 0;
                                          shuffle($random_answer);
                                          while($random_answer_value = array_pop($random_answer)){
                                            if ($random_answer_value == 'a') {
                                              if (trim($test[$i]->student_answer) == trim($test[$i]->answer_a))
                                              {
                                                echo '
                                                <div class="custom-control custom-radio">
                                                    <input class="custom-control-input" id="A_'.$test[$i]->question_id.'" name="'.$test[$i]->question_id.'" data-idquest="'.$test[$i]->question_id.'" type="radio" data-stt="'.($i+1).'" value="a" checked>
                                                    <label class="custom-control-label" for="A_'.$test[$i]->question_id.'">' . $test[$i]->answer_a . '</label>
                                                </div>
                                                ';
                                              }
                                              else
                                              {
                                                echo '
                                                <div class="custom-control custom-radio">
                                                    <input class="custom-control-input" id="A_'.$test[$i]->question_id.'" name="'.$test[$i]->question_id.'" data-idquest="'.$test[$i]->question_id.'" type="radio" data-stt="'.($i+1).'" value="a">
                                                    <label class="custom-control-label" for="A_'.$test[$i]->question_id.'">' . $test[$i]->answer_a . '</label>
                                                </div>
                                                ';
                                              }
                                            } elseif ($random_answer_value == 'b') {
                                              if (trim($test[$i]->student_answer) == trim($test[$i]->answer_b))
                                              {
                                                echo '
                                                <div class="custom-control custom-radio">
                                                    <input class="custom-control-input" id="B_'.$test[$i]->question_id.'" name="'.$test[$i]->question_id.'" data-idquest="'.$test[$i]->question_id.'" type="radio" data-stt="'.($i+1).'" value="b" checked>
                                                    <label class="custom-control-label" for="B_'.$test[$i]->question_id.'">' . $test[$i]->answer_b . '</label>
                                                </div>
                                                ';
                                              }
                                              else
                                              {
                                                echo '
                                                <div class="custom-control custom-radio">
                                                    <input class="custom-control-input" id="B_'.$test[$i]->question_id.'" name="'.$test[$i]->question_id.'" data-idquest="'.$test[$i]->question_id.'" type="radio" data-stt="'.($i+1).'" value="b">
                                                    <label class="custom-control-label" for="B_'.$test[$i]->question_id.'">' . $test[$i]->answer_b . '</label>
                                                </div>
                                                ';
                                              }
                                            } elseif ($random_answer_value == 'c') {
                                              if (trim($test[$i]->student_answer) == trim($test[$i]->answer_c))
                                              {
                                                echo '
                                                <div class="custom-control custom-radio">
                                                    <input class="custom-control-input" id="C_'.$test[$i]->question_id.'" name="'.$test[$i]->question_id.'" data-idquest="'.$test[$i]->question_id.'" type="radio" data-stt="'.($i+1).'" value="c" checked>
                                                    <label class="custom-control-label" for="C_'.$test[$i]->question_id.'">' . $test[$i]->answer_c . '</label>
                                                </div>
                                                ';
                                              }
                                              else
                                              {
                                                echo '
                                                <div class="custom-control custom-radio">
                                                    <input class="custom-control-input" id="C_'.$test[$i]->question_id.'" name="'.$test[$i]->question_id.'" data-idquest="'.$test[$i]->question_id.'" type="radio" data-stt="'.($i+1).'" value="c">
                                                    <label class="custom-control-label" for="C_'.$test[$i]->question_id.'">' . $test[$i]->answer_c . '</label>
                                                </div>
                                                ';
                                              }
                                            } elseif ($random_answer_value == 'd') {
                                              if (trim($test[$i]->student_answer) == trim($test[$i]->answer_d))
                                              {
                                                echo '
                                                <div class="custom-control custom-radio">
                                                    <input class="custom-control-input" id="D_'.$test[$i]->question_id.'" name="'.$test[$i]->question_id.'" data-idquest="'.$test[$i]->question_id.'" type="radio" data-stt="'.($i+1).'" value="d" checked>
                                                    <label class="custom-control-label" for="D_'.$test[$i]->question_id.'">' . $test[$i]->answer_d . '</label>
                                                </div>
                                                ';
                                              }
                                              else
                                              {
                                                echo '
                                                <div class="custom-control custom-radio">
                                                    <input class="custom-control-input" id="D_'.$test[$i]->question_id.'" name="'.$test[$i]->question_id.'" data-idquest="'.$test[$i]->question_id.'" type="radio" data-stt="'.($i+1).'" value="d">
                                                    <label class="custom-control-label" for="D_'.$test[$i]->question_id.'">' . $test[$i]->answer_d . '</label>
                                                </div>
                                                ';
                                              }
                                            }
                                            $random_answer_count = ($random_answer_count+1);
                                          }}
                                          ?>


                                        </div>
                                    </div>
                                    <?php
                                    }
                                    ?>
                                    <div class="card project-task">
                                      <div class="card-block">
                                        <div class="row align-items-center justify-content-center">
                                            <div class="col">
                                                <h5 class="m-0"><i class="far fa-edit m-r-10"></i>Bài làm</h5>
                                            </div>
                                            <div class="col-auto">
                                                <label class="label theme-bg text-white f-14 f-w-400 float-right"><span id="percen"></span>% Done</label>
                                            </div>
                                        </div>
                                        <h6 class="text-muted mt-4 mb-3">Số câu đã chọn : <span id="index">0</span>/<span id="total"><?=count($test)?></span></h6>
                                        <div class="progress">
                                            <div id="process" class="progress-bar progress-c-theme" role="progressbar" style="width:0%;height:6px;"></div>
                                        </div>
                                        <div class="container" style="padding-top: 40px;">
                                            <a href="#" onclick="nopbai()" class="btn btn-primary shadow-2 text-uppercase btn-block" style="max-width:150px;margin:0 auto;">Nộp bài</a>
                                        </div>
                                      </div>
                                    </div>
                                </div>
                            <!-- [ Main Content ] end -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- [ Main Content ] end -->
    <!-- Required Js -->
    <script src="assets/js/vendor-all.min.js"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/pcoded.min.js"></script>
		<script src="res/js/student_functions.js"></script>
    <!-- prism Js -->
    <!-- sweet alert Js -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="//cdn.jsdelivr.net/npm/mobile-detect@1.4.5/mobile-detect.min.js"></script>
    <script src="assets/plugins/prism/js/prism.min.js"></script>
    <script>
        function check_inv(){
          document.addEventListener("visibilitychange", function() {
                      if (document.visibilityState === 'visible') {
                        console.log("oke");
                      } else {
                        Swal.fire({
                              icon: 'error',
                              title: 'Phát hiện!',
                              text: 'Bạn đã cố gắng gian lận, hệ thống tự nộp bài!',
                              showConfirmButton: false,
                              timer: 1500
                              });
                        window.location.replace("nop-bai");
                      }
                    });
        }
        function nopbai() {
          Swal.fire({
            title: 'Xác nhận nộp bài?',
            showDenyButton: true,
            confirmButtonText: 'Đồng ý',
            denyButtonText: `Huỷ`,
          }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
              window.location.replace("nop-bai");
            } else if (result.isDenied) {
              
            }
          });
        }
        <?php 
          $detect = new Mobile_Detect;
        ?>
        var is_phone = <?php echo($detect->isMobile() ? 'true' : 'false'); ?>;
        var sp_device = 1;
        var md = new MobileDetect(window.navigator.userAgent);
        if (md.mobile()) {
          var device = md.mobile();
        } else if (md.match('Windows NT')) {
          var device = "Windows " + md.version("Windows NT");
        } else {
          var device = "Unknown";
        }
        var comfirm_a = 0;
        // Timer
        var min = <?=$min?>;
        var sec = <?=$sec?>;
        var index = <?=$checked_index?>;
        var checked_stt = [<?=implode(",",$checked_stt)?>];
        $('input[type=radio]').on("change", function () {
          var stt = $(this).data("stt");
          var idquest = $(this).data("idquest");
          var value = $(this).val();
          var total_questions = <?=count($test)?>;

          if (checked_stt.includes(stt)) {
          } else {
            checked_stt.push(stt);
            index = index + 1;
            $('#index').text(index);
            $('#process').css("width",(index/total_questions)*100 + "%");
            $('#percen').text(Math.round((index/total_questions)*100));
          }

          var data = {
            id: idquest,
            answer: value,
            min: min,
            sec: sec
          }
          var url = "index.php?action=update_answer";
          var success = function (result) {
            $('#tick-' + stt).text("Câu " + stt + " ✓");
          };
          $.post(url, data, success);
        });
        countdown();
        function countdown() {
          if (min>9999) {
            $('#min').text('∞');
            $('#sec').text('∞');
            $('#min-m').text('∞');
            $('#sec-m').text('∞');
          } else {
            cdID = setInterval(function () {
              if (sec == 0) {
                min--;
                sec = 60;
              }
              sec--;
              if (min < 10) {
                $('.b-title-timer').css('color', '#ff6200');
                min_text = '0' + min;
              } else {
                min_text = min;
              }
              if (sec < 10)
                sec_text = '0' + sec;
              else
                sec_text = sec;
              $('#min').text(min_text);
              $('#sec').text(sec_text);
              $('#min-m').text(min_text);
              $('#sec-m').text(sec_text);
              if (min < 0) {
                clearInterval(cdID);
                Swal.fire({
                  icon: 'error',
                  title: 'Hế giờ làm bài!',
                  text: 'Hệ thống sẽ tự động nộp bài!',
                });
                setTimeout(function() {
                  window.location.replace("nop-bai");
                }, 2000);
              }
              $.get("index.php?action=check_active_session_json", function(data, status){
                if (data != "1") {
                clearInterval(cdID);
                Swal.fire({
                  icon: 'error',
                  title: 'Vi phạm!!!',
                  text: 'Bạn đã có gắng đăng nhập và làm bài trên 2 thiết bị cùng lúc! hành động này sẽ được ghi lại và báo với giáo viên.',
                });
                  setTimeout(function() {
                    window.location.replace("nop-bai");
                  }, 3000);
                }
              });
              if (min<9999) {
                if (comfirm_a == 1) {
                }
              }
            }, 1000);
          }
        }
        // Scroll
        $(window).scroll(function () {
        });
        $('a[href*="#"]:not([href="#"]):not(.nav-link)').click(function () {
          if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
            var target = $(this.hash);
            target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
            if (target.length) {
              $('html, body').animate({
                scrollTop: target.offset().top - 65
              }, 500);
              return false;
            }
          }
        });
        // Box layouts
        if (window.screen.width > 1200) {
          $('body').addClass('container');
          $('body').addClass('box-layout');
        }
        $(document).ready(function(){
          if (min<9999) {
            Swal.fire({
                title: '<strong>Quy chế thi</strong>',
                icon: 'warning',
                html:
                  '<span><b>Thiết bị đang sử dụng: '+ device +'</b></span></br>' +
                  '<span>1. Không được nộp bài muộn quá 2 phút</span></br>' +
                  '<span>2. <strong>Tuyệt đối không</strong> được thoát khỏi chế độ toàn màn hình khi đang làm bài thi.</span></br></br>' +
                  '<b>Nếu vi phạm 2 điều trên thí sinh sẽ bị trừ điểm và hệ thống sẽ tự động nộp bài!.<b>',
                showCloseButton: true,
                focusConfirm: true,
                allowOutsideClick: false,
                confirmButtonText:
                  'Bắt đầu làm bài',
                confirmButtonAriaLabel: 'Start',
                backdrop: `
                  rgba(0,0,123,0.9) 
                  url("https://sweetalert2.github.io/images/nyan-cat.gif")
                  left top
                  no-repeat
                `
              }).then((result) => {
                  if (result.isConfirmed) {
                    comfirm_a = 1;
                    check_inv();
                    toggleFullscreen();
                  } else if (result.isDenied) {
                    location.reload();
                  }
                });
          } else {
            Swal.fire({
                title: '<strong>Quy chế thi</strong>',
                icon: 'warning',
                html:
                  '<b>Đây là bài luyện tập nên các bạn có thể sử dụng các tài liệu ngoài và bài làm sẽ không tính thời gian.<b>',
                showCloseButton: true,
                focusConfirm: true,
                allowOutsideClick: false,
                confirmButtonText:
                  'Bắt đầu làm bài',
                confirmButtonAriaLabel: 'Start',
                backdrop: `
                  rgba(0,0,123,0.9) 
                  url("https://sweetalert2.github.io/images/nyan-cat.gif")
                  left top
                  no-repeat
                `
              })
          }
          
      });

        function getFullscreenElement() {
            return document.fullscreenElement   //standard property
            || document.webkitFullscreenElement //safari/opera support
            || document.mozFullscreenElement    //firefox support
            || document.msFullscreenElement;    //ie/edge support
        }
      
        function toggleFullscreen() {
            if(getFullscreenElement()) {
              document.exitFullscreen();
            }else {
          document.documentElement.requestFullscreen().catch(console.log);
            }
        }
    </script>
</body>
</html>
