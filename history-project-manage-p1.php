
<div role="tabpanel" class="tab-pane active" id="phase1">
    <?php
    $status = true;
    if(isset($PHASE1['result'])){
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
                $p1_detail = $PHASE1['detail'];;
                $p1_strong = "สิ้นสุดโครงการ";
                if($PHASE1['result']=='fail'){
                    $p1_alert = "alert-danger";
                    $p1_strong = "ไม่ผ่าน";
                }elseif($PHASE1['result']=='pass'){
                    $p1_alert = "alert-success";
                    $p1_strong = "ผ่าน";
                }
            ?>

            <div class="alert <?=$p1_alert;?>" role="alert">
                <strong><?= $p1_strong; ?> </strong><?= $p1_detail; ?>
            </div>


            <div class="file-upload">
                <h3 style="text-decoration: underline;">เอกสาร</h3>
                <div style="padding-top: 20px;">

                    <table class="thisdatatable table table-striped table-bordered" style="width:100%">
                        <thead>
                        <tr>
                            <th>เอกสาร</th>
                            <th>จัดการ</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($PHASEUPLOAD as $item) : ?>
                            <?php if ($item['typefile']=="pdf"): ?>
                                <tr>
                                    <td>
                                        <a href="<?= $item['path'];?>" target="_blank">
                                            <i class="fa fa-file-pdf-o"></i>
                                            <?= $item['namefile'];?>
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        <div class="form-group">
                                            <a class="btn btn-primary btn-xs" href="<?= $item['path'];?>" target="_blank">
                                                <i class="fa fa-download"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        <?php endforeach; ?>
                        </tbody>
                    </table>

                </div>
            </div>
            <hr>

            <div class="image-upload">
                <h3 style="text-decoration: underline;">ภาพ</h3>
                <div style="padding-top: 20px;">

                    <table class="thisdatatable table table-striped table-bordered" style="width:100%">
                        <thead>
                        <tr>
                            <th>ภาพ</th>
                            <th>รายละเอียด</th>
                            <th>จัดการ</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($PHASEUPLOAD as $item) : ?>
                            <?php if ($item['typefile']=="img"): ?>
                                <tr>
                                    <td class="text-center">
                                        <img class="img-thumbnail myImgModal" src="<?=$item['path'];?>" alt="image" style="height: 100px;">
                                    </td>
                                    <td><?=$item['namefile'];?></td>
                                    <td class="text-center">
                                        <div class="form-group">
                                            <a class="btn btn-primary btn-xs" href="<?= $item['path'];?>" target="_blank">
                                                <i class="fa fa-download"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        <?php endforeach; ?>
                        </tbody>
                    </table>

                </div>
            </div>
            <hr>

            <div class="video-upload" hidden>
                <h3 style="text-decoration: underline;">วีดีโอ</h3> (.mp4/youtube)
                <div id="showVideoP1" style="padding-top: 20px;">

                    <table class="thisdatatable table table-striped table-bordered" style="width:100%">
                        <thead>
                        <tr>
                            <th>วีดีโอ</th>
                            <th>รายละเอียด</th>
                            <th>จัดการ</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($PHASEUPLOAD as $item) : ?>
                            <?php if ($item['typefile']=="video"): ?>
                                <tr>
                                    <td class="text-center">

                                        <video controls='1' loop='1' height="150px;">
                                            <source src="<?=$item['path'];?>">
                                            Your browser does not support HTML5 video tags.
                                        </video>

                                    </td>
                                    <td><?=$item['namefile'];?></td>
                                    <td class="text-center">
                                        <div class="form-group">
                                            <a class="btn btn-primary btn-xs" href="<?= $item['path'];?>" target="_blank">
                                                <i class="fa fa-download"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        <?php endforeach; ?>
                        </tbody>
                    </table>

                </div>

            </div>


            <div class="text-right" style="padding-top: 20px; padding-bottom: 10px;">
                <button class="btn btn-primary" data-toggle="modal" data-target=".moddalLogPhase1">
                    ข้อมูลการอัพงาน
                </button>
            </div>


        </div>
    <?php endif; ?>


</div>