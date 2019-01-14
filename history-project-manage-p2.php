
<div role="tabpanel" class="tab-pane" id="phase2">
    <?PHP
    $status = true;
    if(isset($PHASE2['result'])){
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
            $p1_detail = $PHASE2['detail'];
            $p1_strong = "สิ้นสุดโครงการ";
            if($PHASE2['result']=='fail'){
                $p1_alert = "alert-danger";
                $p1_strong = "ไม่ผ่าน";
            }elseif($PHASE2['result']=='pass'){
                $p1_alert = "alert-success";
                $p1_strong = "ผ่าน";
            }
            ?>

            <div class="alert <?=$p1_alert;?>" role="alert">
                <strong><?= $p1_strong; ?> </strong><?= $p1_detail; ?>
            </div>

            <div class="file-upload" hidden>
                <h4 style="text-decoration: underline;">เอกสารนำเสนอ</h4>
                <div id="showFileP2" style="padding-top: 20px;">
                    <table class="thisdatatable table table-striped table-bordered" style="width:100%">
                        <thead>
                        <tr>
                            <th>เอกสาร</th>
                            <th>จัดการ</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($P2UPLOAD as $item) : ?>
                            <?php if ($item['typefile']=="pdf"): ?>
                                <tr>
                                    <td>
                                        <a href="<?= $item['path'];?>" target="_blank">
                                            <i class="fa fa-file"></i>
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

            <div class="image-upload" hidden>
                <h4 style="text-decoration: underline;">ภาพนำเสนอ</h4>
                <div id="showImageP2" style="padding-top: 20px;">

                    <table class="thisdatatable table table-striped table-bordered" style="width:100%">
                        <thead>
                        <tr>
                            <th>ภาพ</th>
                            <th>รายละเอียด</th>
                            <th>จัดการ</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($P2UPLOAD as $item) : ?>
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

            <div class="video-upload">
                <h4 style="text-decoration: underline;">วีดีโอ</h4> (.mp4)
                <div id="showVideoP2" style="padding-top: 20px;">

                    <table class="thisdatatable table table-striped table-bordered" style="width:100%">
                        <thead>
                        <tr>
                            <th>วีดีโอ</th>
                            <th>รายละเอียด</th>
                            <th>จัดการ</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($P2UPLOAD as $item) : ?>
                            <?php if ($item['typefile']=="video"): ?>
                                <tr>
                                    <td class="text-center">

                                        <!--                                            <video controls='1' loop='1' height="150px;">-->
                                        <!--                                                <source src="--><?//=$item['path'];?><!--">-->
                                        <!--                                                Your browser does not support HTML5 video tags.-->
                                        <!--                                            </video>-->
                                        <iframe height="150px;" class="embed-responsive-item" src="<?=$item['path'];?>" ></iframe>


                                    </td>
                                    <td><?=$item['namefile'];?></td>
                                    <td class="text-center form-inline">
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
                <button class="btn btn-primary" data-toggle="modal" data-target=".moddalLogPhase2">
                    ข้อมูลการอัพงาน
                </button>
            </div>

        </div>
    <?php endif; ?>

</div>
