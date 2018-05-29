<?php
session_start();
/**
 * Created by PhpStorm.
 * User: Gimo
 * Date: 29/5/2561
 * Time: 11:30
 */
$m_nev = '';
$m_li = 'profile';

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

<!-- Container Box -->
<div id="card">
    <div class="container" style="padding-top: 40px; padding-bottom: 20px;">
        <div class="row">

            <div class="col-xs-12 col-sm-3">
                <div class="box-card">
                   <?php include '_user.php'?>
                </div>
            </div>

            <div class="col-xs-12 col-sm-9">
                <div class="box-card">
                    <div class="text-center">
                        <h3>ข้อมูลสมาชิก</h3>
                    </div>
                    <hr>
                    <form class="form-horizontal">

                        <div class="form-group">
                            <div class="col-xs-12">
                                <label class="label-control">Username</label>
                                <input class="form-control" type="text">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-6">
                                <label class="label-control">Password</label>
                                <input class="form-control" type="password">
                            </div>
                            <div class="col-xs-6">
                                <label class="label-control">Confirm password</label>
                                <input class="form-control" type="password">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-6">
                                <label class="label-control">First Name</label>
                                <input class="form-control" type="text">
                            </div>
                            <div class="col-xs-6">
                                <label class="label-control">Last Name</label>
                                <input class="form-control" type="text">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-12">
                                <label class="label-control">Email</label>
                                <input class="form-control" type="text">
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
                                <input class="form-control" type="text">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-12">
                                <label class="label-control">ภาค</label>
                                <select class="form-control">
                                    <option value="กลาง">กลาง</option>
                                    <option value="เหนือ">เหนือ</option>
                                    <option value="ตะวันออก">ตะวันออก</option>
                                    <option value="ตะวันตก">ตะวันตก</option>
                                    <option value="ตะวันออกเฉียงเหนือ">ตะวันออกเฉียงเหนือ</option>
                                </select>
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-lg sr-button btn-success">SEND</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- End of container Box -->


<footer>
    <?php include '_footer.php'; ?>
</footer>
<?php include '_script.php'; ?>

</body>
</html>
