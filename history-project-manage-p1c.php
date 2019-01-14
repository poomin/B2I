
<div role="tabpanel" class="tab-pane" id="confirm1">

    <?php

    $status = true;
    if(isset($CP1['result'])){
        $status = false;
    }

    ?>
    <?php if($status): ?>
        <div class="text-center" style="padding-top: 50px;">
            <h3> ไม่สามารถดำเนินการได้ </h3>
        </div>
    <?php else: ?>
        <div style="padding-top: 20px; padding-bottom: 10px;">

            <?php
            $p1_alert = "alert-warning";
            $p1_detail = 'ยืนยันการเข้าร่วมโครงการ';
            $p1_strong = "สิ้นสุดโครงการ";
            if($CP1['result']=='fail'){
                $p1_alert = "alert-danger";
                $p1_strong = "ไม่เข้าร่วม";
            }elseif($CP1['result']=='pass'){
                $p1_alert = "alert-success";
                $p1_strong = "เข้าร่วม";
            }
            ?>

            <div class="alert <?=$p1_alert;?>" role="alert">
                <strong><?= $p1_strong; ?> </strong><?= $p1_detail; ?>
            </div>

            <div class="text-center">
                <h4>check in</h4>
                <hr>
            </div>
            <div class="form-horizontal">
                <div class="form-group">
                    <label for="inputCheckIn" class="col-sm-2 control-label">Check in</label>
                    <div class="col-sm-8">
                        <?php
                        $date = $CP1['check_in'];
                        $cut = explode('-',$date);
                        $checkIn = '';
                        if(count($cut)>=3){
                            $checkIn = $cut[2].'/'.$cut[1].'/'.$cut[0];
                        }
                        ?>
                        <input type="text" name="check_in" class="datepicker form-control" value="<?=$checkIn;?>" disabled>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputDriver" class="col-sm-2 control-label">ชื่อ พขร.</label>
                    <div class="col-sm-8">
                        <textarea class="form-control" name="driver" id="inputDriver" rows="3" disabled><?=$CP1['driver'];?></textarea>
                    </div>
                </div>
            </div>
            <hr>

            <div class="text-center">
                <h4>อาจารย์ที่ปรึกษา</h4>
            </div>
            <?php foreach ($CP1M as $item):
                if ($item['membertype']=='header'):
                    $cId = $item['confirm_id'];
                    $uId = $item['user_id'];
                    $mId = $cId.''.$uId;
                    $name = $item['name'].' '.$item['surname'];
                    $shirts_size = $item['shirts_size'];
                    $phone = $item['phone'];
                    $food = $item['vegetarian_food'];
                    ?>
                    <div class="form-horizontal">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">ชื่อ-สกุล</label>
                            <div class="col-sm-8">
                                <p class="form-control-static"><?=$name?></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPhone<?=$mId;?>" class="col-sm-2 control-label">เบอร์โทร</label>
                            <div class="col-sm-8">
                                <input type="text" name="phone" class="form-control" id="inputPhone<?=$mId;?>" placeholder="เบอร์โทร" value="<?=$phone;?>" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputSize<?=$mId;?>" class="col-sm-2 control-label">เบอร์เสื้อ</label>
                            <div class="col-sm-8">
                                <select class="form-control" name="shirts_size" id="inputSize<?=$mId;?>" disabled>
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
                                <select class="form-control" name="vegetarian_food" id="inputFood<?=$mId;?>" disabled>
                                    <option value="">กรุณาเลือก</option>
                                    <option value="Y" <?=($food=='Y'?'selected':'');?> >ไม่ทาน</option>
                                    <option value="N" <?=($food=='N'?'selected':'');?> >ทาน</option>
                                </select>
                            </div>
                        </div>
                    </div>
                <?php endif; endforeach; ?>


            <hr>
            <div class="text-center">
                <h4>นักเรียน/นักศึกษา</h4>
            </div>
            <?php foreach ($CP1M as $item):
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
                    <div class="form-horizontal">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">ชื่อ-สกุล</label>
                            <div class="col-sm-8">
                                <p class="form-control-static"><?=$name?></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputRoom<?=$mId;?>" class="col-sm-2 control-label">ชั้น</label>
                            <div class="col-sm-8">
                                <input type="text" name="classroom" class="form-control" id="inputRoom<?=$mId;?>" placeholder="ชั้น" value="<?=$room;?>" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPhone<?=$mId;?>" class="col-sm-2 control-label">เบอร์โทร</label>
                            <div class="col-sm-8">
                                <input type="text" name="phone" class="form-control" id="inputPhone<?=$mId;?>" placeholder="เบอร์โทร" value="<?=$phone;?>" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputSize<?=$mId;?>" class="col-sm-2 control-label">เบอร์เสื้อ</label>
                            <div class="col-sm-8">
                                <select class="form-control" name="shirts_size" id="inputSize<?=$mId;?>" disabled>
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
                                <select class="form-control" name="vegetarian_food" id="inputFood<?=$mId;?>" disabled>
                                    <option value="">กรุณาเลือก</option>
                                    <option value="Y" <?=($food=='Y'?'selected':'');?> >ไม่ทาน</option>
                                    <option value="N" <?=($food=='N'?'selected':'');?> >ทาน</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <hr>
                <?php endif; endforeach; ?>

        </div>
    <?php endif; ?>


</div>