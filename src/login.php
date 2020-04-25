<?php
session_start();
include 'autoload.php';
use model\Auth\Admins;
if (isset($_POST['submit'])) {
    $username = $_POST['uname'];
    $password = $_POST['password'];
    $Admin = new Admins();
    if ($Admin->Login($username,$password)) {
        $_SESSION['admin_auth']['login'] = true;
        $_SESSION['admin_auth']['aid'] = $Admin->aid;
        $_SESSION['admin_auth']['admin'] = $Admin->admin;
        if ($_POST['rememberME'] == 1) {
            setcookie("admin_auth_aid", true, time() + (86400 * 30), "/");
        }
        header('location: index');
    } else {
        $_SESSION['admin_auth']['login'] = false;
    }
}
?>
<!DOCTYPE html>
<html lang="">
<?php
require_once 'layers/head.php';
?>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <a href="index.php"><b>ورود به پنل مدیریتی <?=$PROJECT__NAME?></b></a>
    </div>
    <div class="card">
        <div class="card-body login-card-body">
            <?php
            if ( isset($_SESSION['admin_auth']['login']) and $_SESSION['admin_auth']['login'] == false) {
                ?>
                <p class="login-box-msg label-danger">نام کاربری یا رمز عبور اشتباه است</p>
                <?php
            } else { ?>
                <p class="login-box-msg">فرم زیر را تکمیل کنید و ورود بزنید</p>
                <?php
            }
            ?>
            <form action="login.php" method="post">
                <div class="input-group mb-3">
                    <input type="text" name="uname" class="form-control" placeholder="نام کاربری">
                    <div class="input-group-append">
                        <span class="fa fa-user input-group-text"></span>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" name="password" class="form-control" placeholder="رمز عبور">
                    <div class="input-group-append">
                        <span class="fa fa-lock input-group-text"></span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-8">
                        <div class="checkbox icheck">
                            <label>
                                <input type="checkbox" name="rememberME" value="1">مرا به خاطر بسپار
                            </label>
                        </div>
                    </div>
                    <div class="col-4">
                        <button type="submit" name="submit" class="btn btn-primary btn-block btn-flat">ورود</button>
                    </div>
                </div>
            </form>
            <p class="mb-1">
                <a href="#">رمز عبورم را فراموش کرده ام.</a>
            </p>
        </div>
    </div>
</div>
</body>
</html>
