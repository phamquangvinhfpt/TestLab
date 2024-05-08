<!DOCTYPE html>
<html lang="en">

<head>
    <title>ĐĂNG NHẬP | ANI - TEST LAB</title>
    <!-- HTML5 Shim and Respond.js IE10 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 10]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content=""/>
    <meta name="keywords" content=""/>

    <!-- Favicon icon -->
    <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">
    <!-- fontawesome icon -->
    <link rel="stylesheet" href="assets/fonts/fontawesome/css/fontawesome-all.min.css">
    <!-- animation css -->
    <link rel="stylesheet" href="assets/plugins/animation/css/animate.min.css">
    <!-- vendor css -->
    <link rel="stylesheet" href="assets/css/style.css">

</head>

<body>
    <div class="auth-wrapper">
        <div class="auth-content">
            <div class="auth-bg">
                <span class="r"></span>
                <span class="r s"></span>
                <span class="r s"></span>
                <span class="r"></span>
            </div>
            <div class="card">
                <div class="card-body text-center">
                    <div class="mb-4">
                        <i class="feather icon-unlock auth-icon"></i>
                    </div>
                    <h3 class="mb-4">Đăng nhập</h3>
										<form action="dang-nhap" method="post">
                    <div class="input-group mb-3">
                        <input id="username" name="username" type="text" class="form-control" placeholder="Tài khoản">
                    </div>
                    <div class="input-group mb-4">
                        <input id="password" name="password" type="password" class="form-control" placeholder="mật khẩu">
                    </div>
                    <div class="form-group text-left">
                        <div class="checkbox checkbox-fill d-inline">
                            <input type="checkbox" name="save" id="save" checked="">
                            <label for="save" class="cr">Lưu thông tin</label>
                        </div>
                    </div>
                    <button id="login" class="btn btn-primary shadow-2 mb-4">Đăng nhập</button>
										</form>
                </div>
            </div>
        </div>
    </div>

    <!-- Required Js -->
    <script src="assets/js/vendor-all.min.js"></script><script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/pcoded.min.js"></script>
		<script src="assets/plugins/sweetalert/js/sweetalert.min.js"></script>
		<script src="res/js/login.js"></script>
    <script type="text/javascript">
      $(function() {
        var status = <?=$result['status']?>;
        var status_value = '<?=$result['status_value']?>';
        if (status == 0) {
          swal({
            title: "Đăng nhập thất bại !",
            text: status_value,
            icon: "error",
            buttons: true
          });
        } else if (status == 1) {
        }
      });
  </script>
</body>
</html>
