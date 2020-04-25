<?php
if (!isset($_REQUEST['username']) or $_REQUEST['username']=='undefined')header('location: login');
if (isset($_SESSION['admin_auth']['login']))header('location: login');
$username = $_REQUEST['username'];
$name =$_REQUEST['name'];
$avatar =$_REQUEST['avatar'];
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>پنل مدیریت دوپوندر | صفحه قفل</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    <!-- bootstrap rtl -->
    <link rel="stylesheet" href="dist/css/bootstrap-rtl.min.css">
    <!-- template rtl version -->
    <link rel="stylesheet" href="dist/css/custom-style.css">
</head>
<body class="hold-transition lockscreen">
<!-- Automatic element centering -->
<div class="lockscreen-wrapper">
    <div class="lockscreen-logo">
        <a href="index.php"><b>پنل مدیریت</b></a>
    </div>
    <!-- User name -->
    <div class="lockscreen-name"><?=$name?></div>

    <!-- START LOCK SCREEN ITEM -->
    <div class="lockscreen-item">
        <!-- lockscreen image -->
        <div class="lockscreen-image">
            <img src="dist/img/<?=$avatar?>" alt="">
        </div>
        <!-- /.lockscreen-image -->

        <!-- lockscreen credentials (contains the form) -->
        <form class="lockscreen-credentials" method="post" action="login.php">
            <div class="input-group">
                <input type="password" name="password" class="form-control" placeholder="رمز عبور">
                <input type="hidden" name="uname" value="<?=$username?>">
                <div class="input-group-append">
                    <button type="submit" name="submit" class="btn"><i class="fa fa-arrow-right text-muted"></i></button>
                </div>
            </div>
        </form>
        <!-- /.lockscreen credentials -->

    </div>
    <!-- /.lockscreen-item -->
    <div class="help-block text-center">
        برای ورود مجدد رمز عبور خود را وارد کنید
    </div>
    <div class="text-center">
        <a href="login.php">و یا با یک یوزرنیم دیگر وارد شوید</a>
    </div>
    <div class="lockscreen-footer text-center mt-4">
        <strong>CopyRight &copy; 2019 <a href="https://negarine.com">Negarine</a>.</strong>
    </div>
</div>
<!-- /.center -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>