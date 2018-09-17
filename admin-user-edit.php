<?php
session_start();
require_once __DIR__.'/_redirectAdmin.php';
/**
 * Created by PhpStorm.
 * User: Gimo
 * Date: 29/5/2561
 * Time: 11:30
 */
$m_nev = '';
$m_li = 'user';

require_once __DIR__.'/controller/adminUserEdit.php'

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
                <div class="box-card" style="padding-left: 100px; padding-right: 100px">

                    <?php if(isset($_SESSION['success'])): ?>
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <strong>Success. </strong> <?php echo $_SESSION['success']; ?>
                        </div>
                        <?php unset($_SESSION['success']);
                    endif; ?>

                    <?php if (isset($_SESSION['error'])): ?>
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                            <strong>Warning!</strong> <?php echo $_SESSION['error']; ?>
                        </div>
                        <?php unset($_SESSION['error']);
                    endif; ?>


                    <div class="text-center">
                        <h3>แก้ไขข้อมูลสมาชิก</h3>
                    </div>
                    <hr>
                    <form class="form-horizontal">

                        <div class="form-group">
                            <div class="col-xs-12">
                                <label class="label-control">Username</label>
                                <input class="form-control" type="text" value="<?=$USER['username'];?>" disabled>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-6">
                                <label class="label-control">Password</label>
                                <input class="form-control" type="password" value="xxxxxxxx" disabled>
                            </div>
                            <div class="col-xs-6">
                                <label class="label-control">Confirm password</label>
                                <input class="form-control" type="password" value="xxxxxxxx" disabled>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-6">
                                <label class="label-control">First Name</label>
                                <input class="form-control" type="text" name="name" value="<?=$USER['name'];?>" required>
                            </div>
                            <div class="col-xs-6">
                                <label class="label-control">Last Name</label>
                                <input class="form-control" type="text" name="surname" value="<?=$USER['surname'];?>" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-12">
                                <label class="label-control">Email</label>
                                <input class="form-control" type="email" name="email" value="<?=$USER['email'];?>" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-12">
                                <label class="label-control">สถานะ</label> <br>
                                <input name="role" type="radio" value="student" <?=$USER['role']=='student'?'checked':''?> disabled> นักเรียน / นักศึกษา <br>
                                <input name="role" type="radio" value="teacher" <?=$USER['role']=='teacher'?'checked':''?> disabled> ครู / อาจารย์
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-12">
                                <label class="label-control">โรงเรียน / สถานศึกษา</label>
                                <input class="form-control" type="text" name="schoolname" value="<?=$USER['schoolname'];?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-12">
                                <label class="label-control">ภาค</label>
                                <select class="form-control" name="schoolregion">
                                    <option value="กลาง" <?=$USER['schoolregion']=='กลาง'?'selected':'';?> >กลาง</option>
                                    <option value="เหนือ" <?=$USER['schoolregion']=='เหนือ'?'selected':'';?> >เหนือ</option>
                                    <option value="ตะวันออก" <?=$USER['schoolregion']=='ตะวันออก'?'selected':'';?> >ตะวันออก</option>
                                    <option value="ตะวันตก" <?=$USER['schoolregion']=='ตะวันตก'?'selected':'';?> >ตะวันตก</option>
                                    <option value="ตะวันออกเฉียงเหนือ" <?=$USER['schoolregion']=='ตะวันออกเฉียงเหนือ'?'selected':'';?> >ตะวันออกเฉียงเหนือ</option>
                                    <option value="ใต้" <?=$USER['schoolregion']=='ใต้'?'selected':'';?> >ใต้</option>
                                </select>
                            </div>
                        </div>
                        <div class="text-center">
                            <input class="hidden" name="id" value="<?=$USER['id'];?>">
                            <input class="hidden" name="fn" value="editUser">
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
