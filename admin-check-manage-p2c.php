
<div role="tabpanel" class="tab-pane <?=($PHASEACTIVE=='c2')?'active':'';?>" id="confirm2">

    <?php
    $statusFail = false;
    $status = false;
    $createConfirm2 = true;
    $edit = false;

    if(isset($projectSetup['phase2confirm']) && $projectSetup['phase2confirm']=='close' ){
        $status = true;
    }

    if(isset($projectSetup['phase2confirm']) && $projectSetup['phase2confirm']=='process' ){
        $edit = true;
    }

    if(count($CP2)>0){
        $createConfirm2 = false;
    }

    if(isset($PHASE1['result']) && $PHASE1['result']=='fail'){
        $statusFail = true;
    }elseif (isset($PHASE2['result']) && $PHASE2['result']=='fail'){
        $statusFail = true;
    }

    if(!isset($projectSetup['id'])){$status=true;}
    ?>

    <?php if($statusFail): ?>
        <div class="text-center" style="padding-top: 50px; color: red">
            <h3> ไม่ผ่านการคัดเลือก </h3>
        </div>
    <?php elseif ($status): ?>
        <div class="text-center" style="padding-top: 50px;">
            <h3> ยังไม่เปิดยืนยันการเข้าอบรม </h3>
        </div>
    <?php else: ?>
        <?php if(!isset($PHASE2['id'])): ?>
            <div class="text-center" style="padding-top: 50px; color: red">
                <h3> ไม่สามารถดำเนินการได้ </h3>
            </div>
        <?php elseif($PHASE2['result']=='process'): ?>
            <div class="text-center" style="padding-top: 50px; color: orangered">
                <h3> รอการตรวจสอบจากคณะกรรมการ </h3>
            </div>
        <?php elseif ($createConfirm2): ?>
            <form class="text-center" style="padding-top: 50px;" method="post">
                <input name="id" value="<?= isset($_REQUEST['id'])?$_REQUEST['id']:0;?>" hidden>
                <input name="fn" value="confirm2" hidden>
                <button class="btn btn-primary btn-lg" type="submit"><i class="fa fa-pencil-square-o"></i> ยืนยันเข้าร่วมอบรม</button>
            </form>
        <?php else: ?>
            <div style="padding-top: 20px; padding-bottom: 10px;">

                <?php
                $bs_callout = 'bs-callout-danger';
                $phase1_result = $CP2['result'];
                if($phase1_result=='process'){
                    $bs_callout = 'bs-callout-warning';
                }elseif ($phase1_result== 'pass'){
                    $bs_callout = 'bs-callout-success';
                }
                ?>
                <form id="radioChangeConfirm2Result" class="bs-callout <?=$bs_callout;?>" method="post" autocomplete="off">
                    <h4>ตรวจโครงการ</h4>
                    <div class="radio">
                        <label>
                            <input type="radio" name="confirm2result" value="process" <?= $phase1_result=='process'?'checked':''?>>
                            <strong>รอ</strong> รอการตรวจสอบจากคณะกรรมการ
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="confirm2result" value="fail" <?= $phase1_result=='fail'?'checked':''?> >
                            <strong>ไม่ผ่าน</strong> โครงการไม่ผ่านการคัดเลือก
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="confirm2result" value="pass" <?= $phase1_result=='pass'?'checked':''?>>
                            <strong>ผ่าน</strong> โครงการผ่านการคัดเลือก
                        </label>
                    </div>
                    <div class="text-center" style="padding-top: 20px;">
                        <input class="hidden" name="fn" value="editConfirm2Result">
                        <input class="hidden" name="phase_id" value="<?=$CP2['id'];?>" >
                        <button type="submit" class="btn btn-success">SAVE</button>
                    </div>
                </form>
                <hr>

                <div class="text-center">
                    <h4>check in</h4>
                    <hr>
                </div>
                <form class="form-horizontal" method="post">
                    <div class="form-group">
                        <label for="inputCheckIn2" class="col-sm-2 control-label">Check in</label>
                        <div class="col-sm-8">
                            <?php
                            $date = $CP2['check_in'];
                            $cut = explode('-',$date);
                            $checkIn = '';
                            if(count($cut)>=3){
                                $checkIn = $cut[2].'/'.$cut[1].'/'.$cut[0];
                            }
                            ?>
                            <input type="text" name="check_in" class="datepicker form-control" value="<?=$checkIn;?>" id="inputCheckIn2" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputDriver2" class="col-sm-2 control-label">ชื่อ พขร.</label>
                        <div class="col-sm-8">
                            <textarea class="form-control" name="driver" id="inputDriver2" rows="3" required><?=$CP2['driver'];?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <input type="text" name="cid" value="<?=$CP2['id'];?>" hidden>
                            <input type="text" name="fn" value="addConfirm2" hidden>
                            <button type="submit" class="btn btn-info">บันทึกข้อมูล</button>
                        </div>
                    </div>
                </form>

                <div class="text-center">
                    <h4>อาจารย์ที่ปรึกษา</h4>
                    <hr>
                </div>
                <?php foreach ($CP2M as $item):
                    if ($item['membertype']=='header'):
                        $cId = $item['confirm_id'];
                        $uId = $item['user_id'];
                        $mId = $cId.''.$uId;
                        $name = $item['name'].' '.$item['surname'];
                        $shirts_size = $item['shirts_size'];
                        $phone = $item['phone'];
                        $food = $item['vegetarian_food'];
                        ?>
                        <form class="form-horizontal" method="post">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">ชื่อ-สกุล</label>
                                <div class="col-sm-8">
                                    <p class="form-control-static"><?=$name?></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPhone<?=$mId;?>" class="col-sm-2 control-label">เบอร์โทร</label>
                                <div class="col-sm-8">
                                    <input type="text" name="phone" class="form-control" id="inputPhone<?=$mId;?>" placeholder="เบอร์โทร" value="<?=$phone;?>" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputSize<?=$mId;?>" class="col-sm-2 control-label">เบอร์เสื้อ</label>
                                <div class="col-sm-8">
                                    <select class="form-control" name="shirts_size" id="inputSize<?=$mId;?>" required>
                                        <option value="">กรุณาเลือก</option>
                                        <option value="S" <?=($shirts_size=='S'?'selected':'');?> >S</option>
                                        <option value="M" <?=($shirts_size=='M'?'selected':'');?> >M</option>
                                        <option value="L" <?=($shirts_size=='L'?'selected':'');?> >L</option>
                                        <option value="XL" <?=($shirts_size=='XL'?'selected':'');?> >XL</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputFood<?=$mId;?>" class="col-sm-2 control-label">ทานอาหารมังสวิรัติ</label>
                                <div class="col-sm-8">
                                    <select class="form-control" name="vegetarian_food" id="inputFood<?=$mId;?>" required>
                                        <option value="">กรุณาเลือก</option>
                                        <option value="Y" <?=($food=='Y'?'selected':'');?> >ไม่ทาน</option>
                                        <option value="N" <?=($food=='N'?'selected':'');?> >ทาน</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <input type="text" name="fn" value="confirm2Teacher" hidden>
                                    <input type="text" name="cid" value="<?=$cId;?>" hidden>
                                    <input type="text" name="uid" value="<?=$uId;?>" hidden>
                                    <button type="submit" class="btn btn-info">บันทึกข้อมูล</button>
                                </div>
                            </div>
                        </form>
                    <?php endif; endforeach; ?>



                <div class="text-center">
                    <h4>นักเรียน/นักศึกษา</h4>
                    <hr>
                </div>
                <?php foreach ($CP2M as $item):
                    if ($item['membertype']!='header'):
                        $cId = $item['confirm_id'];
                        $uId = $item['user_id'];
                        $mId = $cId.''.$uId;
                        $name = $item['name'].' '.$item['surname'];
                        $shirts_size = $item['shirts_size'];
                        $phone = $item['phone'];
                        $food = $item['vegetarian_food'];
                        $room = $item['classroom'];
                        ?>
                        <form class="form-horizontal" method="post">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">ชื่อ-สกุล</label>
                                <div class="col-sm-8">
                                    <p class="form-control-static"><?=$name?></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputRoom<?=$mId;?>" class="col-sm-2 control-label">ชั้น</label>
                                <div class="col-sm-8">
                                    <input type="text" name="classroom" class="form-control" id="inputRoom<?=$mId;?>" placeholder="ชั้น" value="<?=$room;?>" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPhone<?=$mId;?>" class="col-sm-2 control-label">เบอร์โทร</label>
                                <div class="col-sm-8">
                                    <input type="text" name="phone" class="form-control" id="inputPhone<?=$mId;?>" placeholder="เบอร์โทร" value="<?=$phone;?>" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputSize<?=$mId;?>" class="col-sm-2 control-label">เบอร์เสื้อ</label>
                                <div class="col-sm-8">
                                    <select class="form-control" name="shirts_size" id="inputSize<?=$mId;?>" required>
                                        <option value="">กรุณาเลือก</option>
                                        <option value="S" <?=($shirts_size=='S'?'selected':'');?> >S</option>
                                        <option value="M" <?=($shirts_size=='M'?'selected':'');?> >M</option>
                                        <option value="L" <?=($shirts_size=='L'?'selected':'');?> >L</option>
                                        <option value="XL" <?=($shirts_size=='XL'?'selected':'');?> >XL</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputFood<?=$mId;?>" class="col-sm-2 control-label">ทานอาหารมังสวิรัติ</label>
                                <div class="col-sm-8">
                                    <select class="form-control" name="vegetarian_food" id="inputFood<?=$mId;?>" required>
                                        <option value="">กรุณาเลือก</option>
                                        <option value="Y" <?=($food=='Y'?'selected':'');?> >ไม่ทาน</option>
                                        <option value="N" <?=($food=='N'?'selected':'');?> >ทาน</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <input type="text" name="fn" value="confirm2Student" hidden>
                                    <input type="text" name="cid" value="<?=$cId;?>" hidden>
                                    <input type="text" name="uid" value="<?=$uId;?>" hidden>
                                    <button type="submit" class="btn btn-info">บันทึกข้อมูล</button>
                                </div>
                            </div>
                        </form>
                        <hr>
                    <?php endif; endforeach; ?>

            </div>
        <?php endif; ?>
    <?php endif; ?>


</div>