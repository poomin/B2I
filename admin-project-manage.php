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
$m_li = 'manage';
$a_active = 'F1';//CF1,F2,CF2,F3,CF3

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

                    <?php require_once __DIR__.'/_alert.php'; ?>


                    <div class="form-inline text-center">
                        <h3> <?= isset($PROJECTSETUP['name'])?$PROJECTSETUP['name']:'ไม่พบข้อมูล';?> </h3>
                    </div>

                    <hr>

                    <?php if(isset($PROJECTSETUP['id'])): ?>
                    <div>
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs nav-justified" role="tablist">
                            <?php
                                function checkStatus($st,$a_h,$a_a){
                                    $a_icon = '';
                                    $a_color = '';
                                    $a_text = '';
                                    $a_show = false;
                                    if($st=='process'){
                                        $a_icon = 'fa-edit';
                                        $a_color = 'bg-warning text-warning';
                                        $a_text ='กำลังดำเนินการ';
                                    }elseif ($st=='wait'){
                                        $a_icon = 'fa-check-square-o';
                                        $a_color = 'bg-info text-info';
                                        $a_text ='ผ่าน';
                                    }elseif ($st=='close'){
                                        $a_icon = 'fa-close';
                                        $a_color = 'bg-danger text-danger';
                                        $a_text ='ยังไม่เปิด';
                                    }

                                    if($a_a == $a_h){
                                        $a_show=true;
                                    }

                                    return ['text'=>$a_text,'color'=>$a_color,'icon'=>$a_icon,'active'=>$a_show];
                                }

                                $a_f1 = checkStatus($PROJECTSETUP['phase1status'],'F1',$a_active);
                                $a_cf1 = checkStatus($PROJECTSETUP['phase1confirm'],'CF1',$a_active);

                                $a_f2 = checkStatus($PROJECTSETUP['phase2status'],'F2',$a_active);
                                $a_cf2 = checkStatus($PROJECTSETUP['phase2confirm'],'CF2',$a_active);

                                $a_f3 = checkStatus($PROJECTSETUP['phase3status'],'F3',$a_active);
                                $a_cf3 = checkStatus($PROJECTSETUP['phase3confirm'],'CF3',$a_active);
                            ?>
                            <li role="presentation" class="<?=$a_f1['active']?'active':'';?>">
                                <div class="text-center <?=$a_f1['color'];?>">
                                    <i class="fa <?=$a_f1['icon'];?>"></i> <?=$a_f1['text'];?>
                                </div>
                                <a href="#phase1" aria-controls="home" role="tab" data-toggle="tab">เสนอแนวคิดสิ่งประดิษฐ์</a>
                            </li>
                            <li role="presentation" class="<?=$a_cf1['active']?'active':'';?>">
                                <div class="text-center <?=$a_cf1['color'];?>">
                                    <i class="fa <?=$a_cf1['icon'];?>"></i> <?=$a_cf1['text'];?>
                                </div>
                                <a href="#confirm1" aria-controls="home" role="tab" data-toggle="tab">ยืนยันเข้าอบรม</a>
                            </li>
                            <li role="presentation" class="<?=$a_f2['active']?'active':'';?>">
                                <div class="text-center <?=$a_f2['color'];?>">
                                    <i class="fa <?=$a_f2['icon'];?>"></i> <?=$a_f2['text'];?>
                                </div>
                                <a href="#phase2" aria-controls="profile" role="tab" data-toggle="tab">ส่ง video</a>
                            </li>
                            <li role="presentation" class="<?=$a_cf2['active']?'active':'';?>">
                                <div class="text-center <?=$a_cf2['color'];?>">
                                    <i class="fa <?=$a_cf2['icon'];?>"></i> <?=$a_cf2['text'];?>
                                </div>
                                <a href="#confirm2" aria-controls="home" role="tab" data-toggle="tab">ยืนยันเข้าร่วมรอบชิง</a>
                            </li>
                            <li role="presentation" class="<?=$a_f3['active']?'active':'';?>">
                                <div class="text-center <?=$a_f3['color'];?>">
                                    <i class="fa <?=$a_f3['icon'];?>"></i> <?=$a_f3['text'];?>
                                </div>
                                <a href="#phase3" aria-controls="profile" role="tab" data-toggle="tab">ส่งเอกสารรอบชิง</a>
                            </li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">

                            <?php
                            function checkBS($OBJ,$b_s,$b_text){

                                $bs_id = $OBJ['id'];
                                $bs_active = $b_text==$b_s?'active':'';
                                $bs_detail = '';

                                if($b_text=='F1'){
                                    $bs_detail = $OBJ['phase1detail'];
                                    $bs_status = $OBJ['phase1status'];
                                }
                                elseif ($b_text=='CF1'){
                                    $bs_detail = $OBJ['phase1confirmdetail'];
                                    $bs_status = $OBJ['phase1confirm'];
                                }

                                elseif($b_text=='F2'){
                                    $bs_detail = $OBJ['phase2detail'];
                                    $bs_status = $OBJ['phase2status'];
                                }
                                elseif ($b_text=='CF2'){
                                    $bs_detail = $OBJ['phase2confirmdetail'];
                                    $bs_status = $OBJ['phase2confirm'];
                                }

                                elseif($b_text=='F3'){
                                    $bs_detail = $OBJ['phase3detail'];
                                    $bs_status = $OBJ['phase3status'];
                                }
                                elseif ($b_text=='CF3'){
                                    $bs_detail = $OBJ['phase3confirmdetail'];
                                    $bs_status = $OBJ['phase3confirm'];
                                }


                                $bs_callout = 'bs-callout-danger';
                                if($bs_status=='wait'){
                                    $bs_callout = 'bs-callout-info';
                                }elseif ($bs_status=='process'){
                                    $bs_callout = 'bs-callout-success';
                                }

                                $bs_close = $bs_status=='close'?'checked':'';
                                $bs_wait = $bs_status=='wait'?'checked':'';
                                $bs_process = $bs_status=='process'?'checked':'';

                                return ['id'=>$bs_id,'callout'=>$bs_callout,'detail'=>$bs_detail,'active'=>$bs_active,'close'=>$bs_close,'wait'=>$bs_wait,'process'=>$bs_process];

                            }
                            $bs_f1 = checkBS($PROJECTSETUP,$a_active,'F1');
                            $bs_cf1 = checkBS($PROJECTSETUP,$a_active,'CF1');

                            $bs_f2 = checkBS($PROJECTSETUP,$a_active,'F2');
                            $bs_cf2 = checkBS($PROJECTSETUP,$a_active,'CF2');

                            $bs_f3 = checkBS($PROJECTSETUP,$a_active,'F3');

                            ?>
                            <div role="tabpanel" class="tab-pane <?=$bs_f1['active'];?>" id="phase1">

                                <form id="radioChangeStatus" class="bs-callout <?=$bs_f1['callout'];?>" method="post" autocomplete="off">
                                    <h4>สถานะ</h4>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="phase1status" id="phase1status1" value="close" <?= $bs_f1['close'];?> >
                                            <strong>ปิด</strong> ยังไม่เปิดให้ส่งการเสนอแนวคิดสิ่งประดิษฐ์
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="phase1status" id="phase1status2" value="process" <?= $bs_f1['process'];?>>
                                            <strong>เปิด</strong> เปิดให้เสนอแนวคิดสิ่งประดิษฐ์
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="phase1status" id="phase1status3" value="wait" <?= $bs_f1['wait'];?>>
                                            <strong>สำเร็จ</strong> ปิดการส่งเสนอแนวคิดสิ่งประดิษฐ์ รอผลการตรวจจากคณะกรรมการ
                                        </label>
                                    </div>
                                    <div>
                                        <h5>รายละเอียด</h5>
                                        <textarea class="form-control" name="phase1detail" rows="5"><?=$bs_f1['detail'];?></textarea>
                                    </div>
                                    <div class="text-center" style="padding-top: 20px;">
                                        <input class="hidden" name="fn" value="editPhase1Status">
                                        <input class="hidden" name="id" value="<?=$bs_f1['id'];?>" >
                                        <button type="submit" class="btn btn-lg sr-button btn-success">SAVE</button>
                                    </div>
                                </form>

                            </div>

                            <div role="tabpanel" class="tab-pane <?=$bs_cf1['active'];?>" id="confirm1">
                                <form id="radioChangeStatusC1" class="bs-callout <?=$bs_cf1['callout'];?>" method="post" autocomplete="off">
                                    <h4>สถานะ</h4>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="confirm1status" id="confirm1status1" value="close" <?= $bs_cf1['close'];?> >
                                            <strong>ปิด</strong> ยังไม่เปิดให้รับยืนยันการเข้าร่วมอบรม
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="confirm1status" id="confirm1status2" value="process" <?= $bs_cf1['process'];?> >
                                            <strong>เปิด</strong> เปิดรับการยืนยันการเข้าร่วมอบรม
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="confirm1status" id="confirm1status3" value="wait" <?= $bs_cf1['wait'];?> >
                                            <strong>สำเร็จ</strong> ปิดรับการยืนยันเข้าร่วมอบรม รอผลการตรวจจากคณะกรรมการ
                                        </label>
                                    </div>
                                    <div>
                                        <h5>รายละเอียด</h5>
                                        <textarea class="form-control" name="confirm1detail" rows="5"><?=$bs_cf1['detail'];?></textarea>
                                    </div>
                                    <div class="text-center" style="padding-top: 20px;">
                                        <input class="hidden" name="fn" value="editConfirm1Status">
                                        <input class="hidden" name="id" value="<?=$bs_cf1['id'];?>" >
                                        <button type="submit" class="btn btn-lg sr-button btn-success">SAVE</button>
                                    </div>
                                </form>
                            </div>

                            <div role="tabpanel" class="tab-pane <?=$bs_f2['active'];?>" id="phase2">
                                <form id="radioChangeStatus2" class="bs-callout <?=$bs_f2['callout'];?>" method="post" autocomplete="off">
                                    <h4>สถานะ</h4>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="phase2status" id="phase2status1" value="close" <?=$bs_f2['close'];?> >
                                            <strong>ปิด</strong> ยังไม่เปิดให้ส่งเอกสารการนำเสนอสำหรับผู้ที่ผ่านเข้ารอบ
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="phase2status" id="phase2status2" value="process" <?=$bs_f2['process'];?> >
                                            <strong>เปิด</strong> เปิดให้ส่งเอกสารการนำเสนอสำหรับผู้ที่ผ่านเข้ารอบ
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="phase2status" id="phase2status3" value="wait" <?=$bs_f2['wait'];?> >
                                            <strong>สำเร็จ</strong> ปิดส่งเอกสารสำหรับการนำเสนอ รอผลการตรวจจากคณะกรรมการ
                                        </label>
                                    </div>
                                    <div>
                                        <h5>รายละเอียด</h5>
                                        <textarea class="form-control" name="phase2detail" rows="5"><?=$bs_f2['detail'];?></textarea>
                                    </div>
                                    <div class="text-center" style="padding-top: 20px;">
                                        <input class="hidden" name="fn" value="editPhase2Status">
                                        <input class="hidden" name="id" value="<?=$bs_f2['id'];?>" >
                                        <button type="submit" class="btn btn-lg sr-button btn-success">SAVE</button>
                                    </div>
                                </form>
                            </div>

                            <div role="tabpanel" class="tab-pane <?=$bs_cf2['active'];?>" id="confirm2">

                                <form id="radioChangeStatusC2" class="bs-callout <?=$bs_cf2['callout'];?>" method="post" autocomplete="off">
                                    <h4>สถานะ</h4>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="confirm2status" id="confirm2status1" value="close" <?= $bs_cf2['close'];?> >
                                            <strong>ปิด</strong> ยังไม่เปิดให้รับยืนยันการเข้าร่วมอบรม
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="confirm2status" id="confirm2status2" value="process" <?= $bs_cf2['process'];?> >
                                            <strong>เปิด</strong> เปิดรับการยืนยันการเข้าร่วมอบรม
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="confirm2status" id="confirm2status3" value="wait" <?= $bs_cf2['wait'];?> >
                                            <strong>สำเร็จ</strong> ปิดรับการยืนยันเข้าร่วมอบรม รอผลการตรวจจากคณะกรรมการ
                                        </label>
                                    </div>
                                    <div>
                                        <h5>รายละเอียด</h5>
                                        <textarea class="form-control" name="confirm2detail" rows="5"><?=$bs_cf2['detail'];?></textarea>
                                    </div>
                                    <div class="text-center" style="padding-top: 20px;">
                                        <input class="hidden" name="fn" value="editConfirm2Status">
                                        <input class="hidden" name="id" value="<?=$bs_cf2['id'];?>" >
                                        <button type="submit" class="btn btn-lg sr-button btn-success">SAVE</button>
                                    </div>
                                </form>

                            </div>

                            <div role="tabpanel" class="tab-pane <?=$bs_f3['active'];?>" id="phase3">

                                <form id="radioChangeStatus3" class="bs-callout <?=$bs_f3['callout'];?>" method="post" autocomplete="off">
                                    <h4>สถานะ</h4>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="phase3status" id="phase3status1" value="close" <?= $bs_f3['close'];?> >
                                            <strong>ปิด</strong> ยังไม่เปิดให้ส่งเอกสารการนำเสนอสำหรับผู้ที่ผ่านเข้ารอบ
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="phase3status" id="phase3status2" value="process" <?= $bs_f3['process'];?> >
                                            <strong>เปิด</strong> เปิดให้ส่งเอกสารการนำเสนอสำหรับผู้ที่ผ่านเข้ารอบ
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="phase3status" id="phase3status3" value="wait" <?= $bs_f3['wait'];?> >
                                            <strong>สำเร็จ</strong> ปิดส่งเอกสารสำหรับการนำเสนอ รอผลการตรวจจากคณะกรรมการ
                                        </label>
                                    </div>
                                    <div>
                                        <h5>รายละเอียด</h5>
                                        <textarea class="form-control" name="phase3detail" rows="5"><?=$bs_f3['detail'];?></textarea>
                                    </div>
                                    <div class="text-center" style="padding-top: 20px;">
                                        <input class="hidden" name="fn" value="editPhase3Status">
                                        <input class="hidden" name="id" value="<?=$bs_f3['id'];?>" >
                                        <button type="submit" class="btn btn-lg sr-button btn-success">SAVE</button>
                                    </div>
                                </form>
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
                $('#radioChangeStatus').attr('class','bs-callout bs-callout-info');
            }
            else {
                $('#radioChangeStatus').attr('class','bs-callout bs-callout-danger');
            }
        });

        $('input[type=radio][name=confirm1status]').change(function() {
            if (this.value == 'process') {
                $('#radioChangeStatusC1').attr('class','bs-callout bs-callout-success');
            }
            else if (this.value == 'wait') {
                $('#radioChangeStatusC1').attr('class','bs-callout bs-callout-info');
            }
            else {
                $('#radioChangeStatusC1').attr('class','bs-callout bs-callout-danger');
            }
        });

        $('input[type=radio][name=phase2status]').change(function() {
            if (this.value == 'process') {
                $('#radioChangeStatus2').attr('class','bs-callout bs-callout-success');
            }
            else if (this.value == 'wait') {
                $('#radioChangeStatus2').attr('class','bs-callout bs-callout-info');
            }
            else {
                $('#radioChangeStatus2').attr('class','bs-callout bs-callout-danger');
            }
        });

        $('input[type=radio][name=confirm2status]').change(function() {
            if (this.value == 'process') {
                $('#radioChangeStatusC2').attr('class','bs-callout bs-callout-success');
            }
            else if (this.value == 'wait') {
                $('#radioChangeStatusC2').attr('class','bs-callout bs-callout-info');
            }
            else {
                $('#radioChangeStatusC2').attr('class','bs-callout bs-callout-danger');
            }
        });

    });
</script>

</body>
</html>
