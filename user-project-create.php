<?php
session_start();
$SETID = 1;
/**
 * Created by PhpStorm.
 * User: Gimo
 * Date: 29/5/2561
 * Time: 11:30
 */
$m_nev = '';
$m_li = 'project';

require_once __DIR__.'/controller/userProjectCreate.php';
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

                    <?php if(isset($_SESSION['error'])): ?>
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong>Warning!</strong> <?php echo $_SESSION['error']; ?>
                    </div>
                    <?php unset($_SESSION['error']); endif; ?>

                    <div class="form-inline">
                        <h3>สร้างโปรเจค</h3>
                    </div>
                    <hr>
                    <div>

                        <form class="form-horizontal">
                            <div class="form-group">
                                <label for="projectHead" class="col-sm-2 control-label">โครงการ</label>
                                <div class="col-sm-10">
                                    <select class="form-control" id="projectHead" name="projectsetup_id">
                                        <?php if(isset($projectSetup['id'])): ?>
                                        <option value="<?=$projectSetup['id'];?>"><?=$projectSetup['name'];?></option>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="projectName" class="col-sm-2 control-label">หัวข้อโปรเจค</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="projectName" name="name" placeholder="หัวข้อโปรเจค" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="schoolname" class="col-sm-2 control-label">โรงเรียน</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="schoolname" name="schoolname" placeholder="โรงเรียน" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="schoolregion" class="col-sm-2 control-label">ภาค</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="schoolregion">
                                        <option value="กลาง">กลาง</option>
                                        <option value="เหนือ">เหนือ</option>
                                        <option value="ตะวันออก">ตะวันออก</option>
                                        <option value="ตะวันตก">ตะวันตก</option>
                                        <option value="ตะวันออกเฉียงเหนือ">ตะวันออกเฉียงเหนือ</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="projectDetail" class="col-sm-2 control-label">รายละเอียดเพิ่มเติม</label>
                                <div class="col-sm-10">
                                    <textarea rows="8" class="form-control" id="projectDetail" name="detail"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10 text-center">
                                    <input class="hidden" name="fn" value="addProject">
                                    <input class="hidden" name="user_id" value="<?php echo isset($_SESSION['id'])?$_SESSION['id']:0;?>">
                                    <button type="submit" class="btn btn-lg sr-button btn-success">SAVE</button>
                                </div>
                            </div>
                        </form>



                    </div>
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
