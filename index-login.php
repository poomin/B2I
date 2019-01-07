<?php
session_start();
/**
 * Created by PhpStorm.
 * User: Gimo
 * Date: 29/5/2561
 * Time: 11:30
 */
$m_nev = 'login';
include_once __DIR__.'/controller/login.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include '_header.php'; ?>
</head>

<body id="page-top">
<!-- Navigation Bar -->
<?php include '_menunev.php'; ?>
<!-- End of Navigation Bar -->

<!-- Principal Content Start -->
<div class="container" style="padding-bottom: 50px;">

    <div class="col-xs-12 col-sm-8 col-sm-push-2">


        <div class="text-center">
            <h3>เข้าสู่ระบบ</h3>
        </div>
        <hr>

        <?php require_once __DIR__.'/_alert.php';?>

        <form class="form-horizontal" method="post">

            <div class="form-group">
                <div class="col-xs-12">
                    <label class="label-control">Username</label>
                    <input class="form-control" type="text" name="username" required>
                </div>
            </div>

            <div class="form-group">
                <div class="col-xs-12">
                    <label class="label-control">Password</label>
                    <input class="form-control" type="password" name="password" required>
                </div>
            </div>

            <div class="text-center">
                <input class="hidden" name="fn" value="login">
                <button type="submit" class="btn btn-lg sr-button btn-success">SEND</button>
                <hr>
                <a href="index-register.php">สมัครสมาชิก</a>
            </div>

        </form>
    </div>


</div>
<!-- End of Principal Content Start -->


<footer>
    <?php include '_footer.php'; ?>
</footer>
<?php include '_script.php';?>

</body>
</html>
