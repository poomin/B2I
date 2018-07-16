<?php
session_start();
require_once __DIR__.'/_redirectUser.php';
/**
 * Created by PhpStorm.
 * User: Gimo
 * Date: 29/5/2561
 * Time: 11:30
 */
$m_nev = '';
$m_li = 'profile';

require_once __DIR__.'/controller/userProfile.php'

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
                        <h3>ข้อมูลสมาชิก</h3>
                    </div>
                    <hr>
                    <form class="form-horizontal">

                        <div class="form-group">
                            <div class="col-xs-12">
                                <label class="label-control">Username</label>
                                <input class="form-control" type="text" value="<?=$_SESSION['username'];?>" disabled>
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

                        <div class="text-center">
                            <a class="btn btn-sm sr-button btn-warning" data-toggle="modal" data-target=".modalEditPassword">Edit</a>
                        </div>
                        <hr>

                        <div class="form-group">
                            <div class="col-xs-6">
                                <label class="label-control">First Name</label>
                                <input class="form-control" type="text" name="name" value="<?=$_SESSION['name'];?>" required>
                            </div>
                            <div class="col-xs-6">
                                <label class="label-control">Last Name</label>
                                <input class="form-control" type="text" name="surname" value="<?=$_SESSION['surname'];?>" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-12">
                                <label class="label-control">Email</label>
                                <input class="form-control" type="email" name="email" value="<?=$_SESSION['email'];?>" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-12">
                                <label class="label-control">สถานะ</label> <br>
                                <input name="role" type="radio" value="student" <?=$_SESSION['role']=='student'?'checked':''?> disabled> นักเรียน / นักศึกษา <br>
                                <input name="role" type="radio" value="teacher" <?=$_SESSION['role']=='teacher'?'checked':''?> disabled> ครู / อาจารย์
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-12">
                                <label class="label-control">โรงเรียน / สถานศึกษา</label>
                                <div class="row-fluid">
                                    <select  name="schoolname" class="selectpicker form-control" data-live-search="true">
                                        <option value=""></option>
                                        <?php foreach ($SCHOOL as $item): ?>
                                            <option value="<?=$item['school_name'];?>"
                                                    <?php echo $_SESSION['schoolname']== $item['school_name']?'selected':'';?>>
                                                <?=$item['school_name'];?>
                                            </option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-12">
                                <label class="label-control">ภาค</label>
                                <select class="form-control" name="schoolregion">
                                    <option value="กลาง" <?=$_SESSION['schoolregion']=='กลาง'?'selected':'';?> >กลาง</option>
                                    <option value="เหนือ" <?=$_SESSION['schoolregion']=='เหนือ'?'selected':'';?> >เหนือ</option>
                                    <option value="ตะวันออก" <?=$_SESSION['schoolregion']=='ตะวันออก'?'selected':'';?> >ตะวันออก</option>
                                    <option value="ตะวันตก" <?=$_SESSION['schoolregion']=='ตะวันตก'?'selected':'';?> >ตะวันตก</option>
                                    <option value="ตะวันออกเฉียงเหนือ" <?=$_SESSION['schoolregion']=='ตะวันออกเฉียงเหนือ'?'selected':'';?> >ตะวันออกเฉียงเหนือ</option>
                                    <option value="ใต้" <?=$_SESSION['schoolregion']=='ใต้'?'selected':'';?> >ใต้</option>
                                </select>
                            </div>
                        </div>
                        <div class="text-center">
                            <input class="hidden" name="id" value="<?=$_SESSION['id'];?>">
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

<script>
    $(document).ready(function() {
        $('#confirmPassword').on('change',function () {
            var password = $('#password').val();
            var confirm = $('#confirmPassword').val();
            if(password==confirm){
                $('#btnSaveEditPassword').removeAttr('disabled');
                $('#confirmError').removeClass('has-error');

            }else{
                $('#btnSaveEditPassword').attr('disabled','disabled');
                $('#confirmError').addClass('has-error');
                $('#confirmPassword').val('');
            }
        });
    } );
</script>

</body>

<!--    modal log phase 1 -->
<div class="modal fade modalEditPassword" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel1">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myLargeModalLabel1">แก้ไข</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="post">

                    <div class="form-group">
                        <div class="col-xs-12">
                            <label class="label-control">Username</label>
                            <input class="form-control" type="text" name="username" value="<?=$_SESSION['username'];?>" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-12">
                            <label class="label-control">Old Password</label>
                            <input class="form-control" type="password" name="oldPassword" value="" required>
                        </div>
                    </div>


                    <div id="confirmError" class="form-group">
                        <div class="col-xs-6">
                            <label class="control-label">New Password</label>
                            <input id="password" class="form-control" type="password" name="password" value="" required>
                        </div>
                        <div class="col-xs-6">
                            <label class="control-label">Confirm password</label>
                            <input id="confirmPassword" class="form-control" type="password" name="confirmPassword" value="" required>
                        </div>
                    </div>

                    <div class="text-center">
                        <input class="hidden" type="text" name="fn" value="editPassword">
                        <input class="hidden" name="id" value="<?=$_SESSION['id'];?>">
                        <button id="btnSaveEditPassword" class="btn sr-button btn-success" type="submit" disabled> Save </button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>



</html>
