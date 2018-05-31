<?php
session_start();
/**
 * Created by PhpStorm.
 * User: Gimo
 * Date: 29/5/2561
 * Time: 11:30
 */
$m_nev = 'login';



include_once __DIR__.'/controller/register.php';

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
            <h3>สมัครสมาชิก</h3>
        </div>
        <hr>
        <form class="form-horizontal">

            <div class="form-group">
                <div class="col-xs-12">
                    <label class="label-control">Username</label>
                    <input class="form-control" type="text" name="username" required>
                </div>
            </div>

            <div class="form-group">
                <div class="col-xs-6">
                    <label class="label-control">Password</label>
                    <input id="inputPassword" class="form-control" type="password" name="password" required>
                </div>
                <div class="col-xs-6">
                    <label class="label-control">Confirm password</label>
                    <input id="inputConfirm" class="form-control" type="password" name="confirm" onchange="confirmPassword();" required>
                </div>
            </div>

            <div class="form-group">
                <div class="col-xs-6">
                    <label class="label-control">First Name</label>
                    <input class="form-control" type="text" name="name" required>
                </div>
                <div class="col-xs-6">
                    <label class="label-control">Last Name</label>
                    <input class="form-control" type="text" name="surname" required>
                </div>
            </div>

            <div class="form-group">
                <div class="col-xs-12">
                    <label class="label-control">Email</label>
                    <input class="form-control" type="email" name="email" required>
                </div>
            </div>

            <div class="form-group">
                <div class="col-xs-12">
                    <label class="label-control">สถานะ</label> <br>
                    <input name="role" type="radio" value="student" checked> นักเรียน / นักศึกษา <br>
                    <input name="role" type="radio" value="teacher"> ครู / อาจารย์
                </div>
            </div>

            <div class="form-group">
                <div class="col-xs-12">
                    <label class="label-control">โรงเรียน / สถานศึกษา</label>
                    <input class="form-control" type="text" name="schoolname">
                </div>
            </div>

            <div class="form-group">
                <div class="col-xs-12">
                    <label class="label-control">ภาค</label>
                    <select class="form-control" name="schoolregion">
                        <option value="กลาง">กลาง</option>
                        <option value="เหนือ">เหนือ</option>
                        <option value="ตะวันออก">ตะวันออก</option>
                        <option value="ตะวันตก">ตะวันตก</option>
                        <option value="ตะวันออกเฉียงเหนือ">ตะวันออกเฉียงเหนือ</option>
                    </select>
                </div>
            </div>
            <div class="text-center">
                <input class="hidden" value="addUser" name="fn">
                <button type="submit" class="btn btn-lg sr-button btn-success">SEND</button>
            </div>

        </form>
    </div>


</div>
<!-- End of Principal Content Start -->

<footer>
    <?php include '_footer.php'; ?>
</footer>
<?php include '_script.php';?>

<script>
    function confirmPassword() {
        var password = $('#inputPassword').val();
        var confirm  = $('#inputConfirm').val();
        if(password != confirm){
            alert("ตรวจสอบ Password และ Confirm password !!!!!");
            $('#inputPassword').val('');
            $('#inputConfirm').val('');
        }
    }
</script>

</body>
</html>
