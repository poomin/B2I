<?php
session_start();
require_once __DIR__.'/_redirectAdmin.php';
$SETID = 1;
/**
 * Created by PhpStorm.
 * User: Gimo
 * Date: 29/5/2561
 * Time: 11:30
 */
$m_nev = '';
$m_li = 'manage';

require_once __DIR__.'/controller/adminProjectManage.php';
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
                <div class="box-card" style="min-height: 300px;">

                    <?php if(isset($_SESSION['error'])): ?>
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong>Warning!</strong> <?php echo $_SESSION['error']; ?>
                    </div>
                    <?php unset($_SESSION['error']); endif; ?>

                    <?php if(isset($_SESSION['success'])): ?>
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <strong>Success!</strong> <?php echo $_SESSION['success']; ?>
                        </div>
                        <?php unset($_SESSION['success']); endif; ?>

                    <div class="form-inline text-center">
                        <h3> <?= isset($PROJECTSETUP['name'])?$PROJECTSETUP['name']:'ไม่พบข้อมูล';?> </h3>
                    </div>

                    <hr>

                    <?php if(isset($PROJECTSETUP['id'])): ?>
                    <div>
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs nav-justified" role="tablist">
                            <li role="presentation" class="active">
                                <a href="#phase1" aria-controls="home" role="tab" data-toggle="tab">ส่งเอกสารสมัครโครงการ</a>
                            </li>
                            <li role="presentation">
                                <a href="#phase2" aria-controls="profile" role="tab" data-toggle="tab">ส่งเอกสารนำเสนอ</a>
                            </li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="phase1" style="padding-top: 20px;">
                                <?php
                                $bs_callout = 'bs-callout-danger';
                                if($PROJECTSETUP['phase1status']=='wait'){
                                    $bs_callout = 'bs-callout-warning';
                                }elseif ($PROJECTSETUP['phase1status']=='process'){
                                    $bs_callout = 'bs-callout-success';
                                }
                                ?>
                                <form id="radioChangeStatus" class="bs-callout <?=$bs_callout;?>" method="post" autocomplete="off">
                                    <h4>สถานะ</h4>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="phase1status" id="phase1status1" value="close" <?= $PROJECTSETUP['phase1status']=='close'?'checked':''?> >
                                            <strong>ปิด</strong> ยังไม่เปิดให้รับสมัครโครงการ
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="phase1status" id="phase1status2" value="process" <?= $PROJECTSETUP['phase1status']=='process'?'checked':''?>>
                                            <strong>เปิด</strong> เปิดรับสมัครโครงการ
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="phase1status" id="phase1status3" value="wait" <?= $PROJECTSETUP['phase1status']=='wait'?'checked':''?>>
                                            <strong>รอ</strong> ปิดส่งเอกสารการสมัคร รอผลการตรวจจากคณะกรรมการ
                                        </label>
                                    </div>
                                    <div>
                                        <h5>รายละเอียด</h5>
                                        <textarea class="form-control" name="phase1detail" rows="3"> <?=$PROJECTSETUP['phase1detail'];?></textarea>
                                    </div>
                                    <div class="text-center" style="padding-top: 20px;">
                                        <input class="hidden" name="fn" value="editPhase1Status">
                                        <input class="hidden" name="id" value="<?=$PROJECTSETUP['id'];?>" >
                                        <button type="submit" class="btn btn-lg sr-button btn-success">SAVE</button>
                                    </div>
                                </form>

                            </div>

                            <div role="tabpanel" class="tab-pane" id="phase2">

                            </div>

                        </div>
                    </div>
                    <?php endif;?>
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
        $('input[type=radio][name=phase1status]').change(function() {
            if (this.value == 'process') {
                $('#radioChangeStatus').attr('class','bs-callout bs-callout-success');
            }
            else if (this.value == 'wait') {
                $('#radioChangeStatus').attr('class','bs-callout bs-callout-warning');
            }
            else {
                $('#radioChangeStatus').attr('class','bs-callout bs-callout-danger');
            }
        });
    });
</script>

</body>
</html>
