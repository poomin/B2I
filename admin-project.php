<?php
session_start();
/**
 * Created by PhpStorm.
 * User: Gimo
 * Date: 29/5/2561
 * Time: 11:30
 */
$m_nev = '';
$m_li = 'project';
$id=1;
include "controller/adminProject.php"
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
<div id="card" attr="<?=$SETID;?>">
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
                        <h3>โครงการ</h3>
                    </div>
                    <hr>

                    <form class="form-horizontal" style="padding: 20px;">

                        <div class="form-group">
                            <div class="col-xs-12">
                                <label class="label-control">ชื่อโครงการ</label>
                                <input class="form-control" name="name" type="text" value="<?=$name;?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-12">
                                <label class="label-control">หัวข้อ</label>
                                <input class="form-control" type="text" name="title" value="<?=$title;?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <label class="label-control">รายละเอียด</label>
                                <textarea class="form-control" rows="7" type="text" name="detail"><?=$detail;?></textarea>

                            </div>
                        </div>



                        <div class="text-center">
                            <input class="hidden" name="id" value="<?=$id;?>">
                            <input class="hidden" name="fn" value="cmp">
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
