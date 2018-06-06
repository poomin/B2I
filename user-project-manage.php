<?php
session_start();
require_once __DIR__.'/_redirectUser.php';
$SETID = 1;
/**
 * Created by PhpStorm.
 * User: Gimo
 * Date: 29/5/2561
 * Time: 11:30
 */
$m_nev = '';
$m_li = 'project';

require_once __DIR__.'/controller/userProjectManage.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include '_header.php'; ?>

    <?php include '_datatablecss.php';?>

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

                    <div class="form-inline">
                        <h3><?= isset($PROJECT['name'])?$PROJECT['name']:'';?></h3>
                    </div>
                    <hr>
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
                            <div role="tabpanel" class="tab-pane active" id="phase1">
                                <?php
                                    $status = false;
                                    $createPhase1 = true;
                                    $edit = false;

                                    if(isset($projectSetup['phase1status']) && $projectSetup['phase1status']=='close' ){
                                        $status = true;
                                    }

                                    if(isset($projectSetup['phase1status']) && $projectSetup['phase1status']=='process' ){
                                        $edit = true;
                                    }

                                    if(count($PHASE1)>0){
                                        $createPhase1 = false;
                                    }


                                    if(!isset($projectSetup['id'])){$status=true;}
                                ?>

                                <?php if($status): ?>
                                    <div class="text-center" style="padding-top: 50px;">
                                        <h3> ปิดรับสมัครโครงการ </h3>
                                    </div>
                                <?php else: ?>
                                    <?php if($createPhase1): ?>
                                        <form class="text-center" style="padding-top: 50px;">
                                            <input class="hidden" name="id" value="<?= isset($_REQUEST['id'])?$_REQUEST['id']:0;?>">
                                            <input class="hidden" name="fn" value="phase1">
                                            <button class="btn btn-primary btn-lg"><i class="fa fa-pencil-square-o"></i> เริ่มโปรเจค</button>
                                        </form>
                                    <?php else: ?>
                                        <div style="padding-top: 20px; padding-bottom: 10px;">

                                            <div class="form-horizontal">
                                                <div class="form-group">
                                                    <label class="col-sm-4 control-label">โครงการ:</label>
                                                    <div class="col-sm-8">
                                                        <label class="control-label"><?=$PROJECT['name'];?></label>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-4 control-label">หัวหน้าโครงการ:</label>
                                                    <div class="col-sm-8">
                                                        <label class="control-label"><?=$LEADER;?></label>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-4 control-label">สมาชิก:</label>
                                                    <div class="col-sm-8">
                                                        <label class="control-label"><?=$MEMBER;?></label>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-4 control-label">โรงเรียน:</label>
                                                    <div class="col-sm-8">
                                                        <label class="control-label"><?=$PROJECT['schoolname'];?></label>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-4 control-label">ภาค:</label>
                                                    <div class="col-sm-8">
                                                        <label class="control-label"><?=$PROJECT['schoolregion'];?></label>
                                                    </div>
                                                </div>

                                            </div>
                                            <hr>

                                            <div class="file-upload">
                                                <h3 style="text-decoration: underline;">เอกสาร</h3>
                                                <div id="showFileP1" style="padding-top: 20px;">

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
                                                                        <button class="btn btn-danger btn-xs">
                                                                            <i class="fa fa-trash"></i>
                                                                        </button>
                                                                    </td>
                                                                </tr>
                                                            <?php endif; ?>
                                                        <?php endforeach; ?>
                                                        </tbody>
                                                    </table>

                                                </div>

                                                <?PHP if($edit): ?>
                                                <div id="uploadFileP1">

                                                    <div id="loadFilePdf" class="text-center">
                                                        <div class="form-inline hide" id="show_progressBar_pdf">
                                                            <div class="progress" style="float:left; width: 90%; margin-right: 5px;">
                                                                <div id="progressBar_pdf" class="progress-bar" role="progressbar"
                                                                     aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"
                                                                     style="width: 0%;">
                                                                    0%
                                                                </div>
                                                            </div>
                                                            <button type="button" class="btn btn-danger btn-xs"
                                                                    onclick="cancelUploadFile('pdf')">
                                                                <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                                            </button>
                                                        </div>
                                                        <div id="pdf">
                                                            <input id="path_pdf" class="hide" type="text" name="path_pdf" value="">
                                                            <input id="name_pdf" class="hide" type="text" name="name_pdf" value="">
                                                            <div class="box-img-ready">
                                                                <label style="cursor: pointer;" for="file_pdf">
                                                                    <h3 id="upload_pdf"><span class="label label-info"><i class="fa fa-upload"></i> File Upload </span></h3>
                                                                    <input id="file_pdf" topic_id="<?= $PROJECT['id']; ?>" accept="application/pdf" type="file" style="display:none;" onchange="showLoadPdf(this)">
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div id="saveLoadFilePdf" class="hidden">
                                                        <div class="row text-center">
                                                            <i class="fa fa-file-pdf-o fa-5x thumbnail"></i>
                                                        </div>

                                                        <div class="row">
                                                            <form class="form-horizontal" action="user-project-manage.php?id=<?=$PROJECT['id'];?>" method="post">
                                                                <div class="form-group">
                                                                    <label for="namePdf" class="col-sm-4 control-label">รายละเอียดไฟล์</label>
                                                                    <div class="col-sm-6">
                                                                        <input type="text" class="form-control" id="namePdf" name="namefile" placeholder="รายละเอียดภาพ">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="col-sm-offset-4 col-sm-6">
                                                                        <input class="hidden" name="fn" value="savePdf" >
                                                                        <input class="hidden" name="phase_id" value="<?=$PHASE1['id'];?>" >
                                                                        <input class="hidden" name="user_id" value="<?=$_SESSION['id'];?>" >
                                                                        <input class="hidden" name="typefile" value="pdf" >
                                                                        <input id="inputPatePdf" class="hidden" name="path" value="">
                                                                        <button type="submit" class="btn btn-success">SAVE</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>

                                                </div>
                                                <?php endif;?>

                                            </div>
                                            <hr>

                                            <div class="image-upload">
                                                <h3 style="text-decoration: underline;">ภาพ</h3>
                                                <div id="showImageP1" style="padding-top: 20px;">

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
                                                                        <button class="btn btn-primary btn-xs">
                                                                            <i class="fa fa-download"></i>
                                                                        </button>
                                                                        <button class="btn btn-danger btn-xs">
                                                                            <i class="fa fa-trash"></i>
                                                                        </button>
                                                                    </td>
                                                                </tr>
                                                            <?php endif; ?>
                                                        <?php endforeach; ?>
                                                        </tbody>
                                                    </table>

                                                </div>
                                                <?PHP if($edit): ?>
                                                <div id="uploadImageP1">

                                                    <div id="loadFileImage" class="text-center">
                                                        <div class="form-inline hide" id="show_progressBar_image">
                                                            <div class="progress" style="float:left; width: 90%; margin-right: 5px;">
                                                                <div id="progressBar_image" class="progress-bar" role="progressbar"
                                                                     aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"
                                                                     style="width: 0%;">
                                                                    0%
                                                                </div>
                                                            </div>
                                                            <button type="button" class="btn btn-danger btn-xs"
                                                                    onclick="cancelUploadFile('image')">
                                                                <span class="glyphicon glyphicon glyphicon-remove" aria-hidden="true"></span>
                                                            </button>
                                                        </div>
                                                        <div id="image">
                                                            <div class="box-img-ready">
                                                                <label style="cursor: pointer;" for="file_image">
                                                                    <h3 id="upload_image"><span class="label label-info"><i class="fa fa-upload"></i> Image Upload</span></h3>
                                                                    <input id="file_image" accept="image/*" type="file" style="display:none;" onchange="showLoadImage(this)">
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div id="saveLoadFileImage" class="hidden">
                                                        <div class="row">
                                                            <div class="col-xs-6 col-md-4 col-md-offset-4">
                                                                <a href="#" class="thumbnail">
                                                                    <img id="imageShow" src="/froala/upload/img.png" alt="image">
                                                                </a>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <form class="form-horizontal" action="user-project-manage.php?id=<?=$PROJECT['id'];?>" method="post">
                                                                <div class="form-group">
                                                                    <label for="nameImage" class="col-sm-4 control-label">รายละเอียดภาพ</label>
                                                                    <div class="col-sm-6">
                                                                        <input type="text" class="form-control" id="nameImage" name="namefile" placeholder="รายละเอียดภาพ">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="col-sm-offset-4 col-sm-6">
                                                                        <input class="hidden" name="fn" value="saveImage" >
                                                                        <input class="hidden" name="phase_id" value="<?=$PHASE1['id'];?>" >
                                                                        <input class="hidden" name="user_id" value="<?=$_SESSION['id'];?>" >
                                                                        <input class="hidden" name="typefile" value="img" >
                                                                        <input id="inputPate" class="hidden" name="path" value="">
                                                                        <button type="submit" class="btn btn-success">SAVE</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>

                                                    </div>

                                                </div>
                                                <?PHP endif;?>

                                            </div>
                                            <hr>

                                            <div class="video-upload">
                                                <h3 style="text-decoration: underline;">วีดีโอ</h3> (.mp4)
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
                                                                        <button class="btn btn-primary btn-xs">
                                                                            <i class="fa fa-download"></i>
                                                                        </button>
                                                                        <button class="btn btn-danger btn-xs">
                                                                            <i class="fa fa-trash"></i>
                                                                        </button>
                                                                    </td>
                                                                </tr>
                                                            <?php endif; ?>
                                                        <?php endforeach; ?>
                                                        </tbody>
                                                    </table>

                                                </div>
                                                <?PHP if($edit): ?>
                                                <div id="uploadVideoP1">

                                                    <div id="loadFileVideo" class="text-center">
                                                        <div class="form-inline hide" id="show_progressBar_video">
                                                            <div class="progress" style="float:left; width: 90%; margin-right: 5px;">
                                                                <div id="progressBar_video" class="progress-bar" role="progressbar"
                                                                     aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"
                                                                     style="width: 0%;">
                                                                    0%
                                                                </div>
                                                            </div>
                                                            <button type="button" class="btn btn-danger btn-xs"
                                                                    onclick="cancelUploadFile('video')">
                                                                <span class="glyphicon glyphicon glyphicon-remove" aria-hidden="true"></span>
                                                            </button>
                                                        </div>
                                                        <div id="video">
                                                            <div class="box-img-ready">
                                                                <label style="cursor: pointer;" for="file_video">
                                                                    <h3 id="upload_video"><span class="label label-info"><i class="fa fa-upload"></i> Video Upload</span></h3>
                                                                    <input id="file_video" accept="video/mp4" type="file" style="display:none;" onchange="showLoadVideo(this)">
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div id="saveLoadFileVideo" class="hidden">
                                                        <div class="row">
                                                            <div class="col-xs-6 col-md-4 col-md-offset-4">

                                                                <div class="embed-responsive embed-responsive-16by9">
                                                                    <iframe id="videoShow" class="embed-responsive-item" src="" ></iframe>
                                                                </div>

                                                            </div>
                                                        </div>

                                                        <div class="row" style="padding-top: 20px;">
                                                            <form class="form-horizontal" action="user-project-manage.php?id=<?=$PROJECT['id'];?>" method="post">
                                                                <div class="form-group">
                                                                    <label for="nameVideo" class="col-sm-4 control-label">รายละเอียดภาพ</label>
                                                                    <div class="col-sm-6">
                                                                        <input type="text" class="form-control" id="nameVideo" name="namefile" placeholder="รายละเอียดภาพ">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="col-sm-offset-4 col-sm-6">
                                                                        <input class="hidden" name="fn" value="saveVideo" >
                                                                        <input class="hidden" name="phase_id" value="<?=$PHASE1['id'];?>" >
                                                                        <input class="hidden" name="user_id" value="<?=$_SESSION['id'];?>" >
                                                                        <input class="hidden" name="typefile" value="video" >
                                                                        <input id="inputVideo" class="hidden" name="path" value="">
                                                                        <button type="submit" class="btn btn-success">SAVE</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>

                                                    </div>

                                                </div>
                                                <?PHP endif; ?>

                                            </div>


                                        </div>
                                    <?php endif; ?>
                                <?php endif; ?>


                            </div>

                            <div role="tabpanel" class="tab-pane" id="phase2">
                                <?PHP
                                    $statusP2 = false;
                                    $createP2 = true;
                                    $editP2 = false;
                                    $statusFail = false;
                                    $statusWait = false;


                                if(isset($projectSetup['phase2status']) && $projectSetup['phase2status']=='close' ){
                                    $statusP2 = true;
                                }
                                elseif(isset($projectSetup['phase2status']) && $projectSetup['phase2status']=='process' ){
                                    $editP2 = true;
                                }

                                if(isset($PHASE1['result']) && $PHASE1['result']=='wait' ){
                                    $statusWait = true;
                                }
                                elseif(isset($PHASE1['result']) && $PHASE1['result']=='process' ){
                                    $statusWait = true;
                                }
                                elseif(isset($PHASE1['result']) && $PHASE1['result']=='fail' ){
                                    $statusFail = true;
                                }



                                if(count($PHASE2)>0){
                                    $createP2 = false;
                                }

                                if(!isset($projectSetup['id'])){$statusP2=true;}
                                ?>

                                <?php if($statusP2){ ?>
                                    <div class="text-center" style="padding-top: 50px;">
                                        <h3> ยังไม่เปิดให้ส่งเอกสารนำเสนอ </h3>
                                    </div>
                                <?php }elseif($statusFail){ ?>
                                    <div class="text-center" style="padding-top: 50px;">
                                        <h3 class="text-danger"> ไม่ผ่านการรับคัดเลือก </h3>
                                    </div>
                                <?php }elseif($statusWait){ ?>
                                    <div class="text-center" style="padding-top: 50px;">
                                        <h3 class="text-warning"> อยู่ในขั้นตอนการตรวจสอบจากคณะกรรมการ </h3>
                                    </div>
                                <?php }else{ ?>
                                    <?php if($createP2): ?>
                                        <form class="text-center" style="padding-top: 50px;">
                                            <input class="hidden" name="id" value="<?= isset($_REQUEST['id'])?$_REQUEST['id']:0;?>">
                                            <input class="hidden" name="fn" value="phase2">
                                            <button class="btn btn-primary btn-lg"><i class="fa fa-pencil-square-o"></i> เริ่มโปรเจค</button>
                                        </form>
                                    <?php else: ?>
                                        <div style="padding-top: 20px; padding-bottom: 10px;">

                                            <div class="file-upload">
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
                                                                        <button class="btn btn-danger btn-xs">
                                                                            <i class="fa fa-trash"></i>
                                                                        </button>
                                                                    </td>
                                                                </tr>
                                                            <?php endif; ?>
                                                        <?php endforeach; ?>
                                                        </tbody>
                                                    </table>

                                                </div>

                                            </div>

                                        </div>
                                    <?php endif; ?>
                                <?php } ?>

                            </div>
                        </div>

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

<?php include "_datatablescript.php"; ?>
<script>
    $(document).ready(function() {
        $('.thisdatatable').DataTable({
            "info": false,
            "lengthChange": false
        });
    } );


    //phase 1
    var ajax_pdf;
    var ajax_image;
    var ajax_video;
    function showLoadPdf(input) {
        if (input.files && input.files[0]) {
            ajax_pdf = new XMLHttpRequest();
            var type_file = input.files[0].type;
            var file_name = input.files[0].name;
            var cut_type_file = file_name.split('.');
            var file_type = cut_type_file[cut_type_file.length - 1];
            var cut = type_file.split("/");
            var set_type = 'pdf';
            type_file = (cut.length > 0) ? cut[1] : "";
            type_file = type_file.toLowerCase();
            //check type file upload
            if (type_file == set_type) {
                $('#show_progressBar_' + set_type).removeClass('hide');
                var progressBar = "progressBar_" + set_type;
                var topic_id = input.getAttribute("topic_id");

                var form_data = new FormData();
                form_data.append("fileToUpload", input.files[0]);
                ajax_pdf.upload.addEventListener("progress", progressHandler, false);
                ajax_pdf.addEventListener("load", completeHandler, false);
                ajax_pdf.addEventListener("error", errorHandler, false);
                ajax_pdf.addEventListener("abort", abortHandler, false);
                ajax_pdf.open("POST", "../upload/upload_file.php?type=" + set_type);
                ajax_pdf.send(form_data);

                function progressHandler(event) {
                    var percent = (event.loaded / event.total) * 100;
                    $("#" + progressBar).css('width', Math.round(percent) + "%");
                    $("#" + progressBar).html(Math.round(percent) + "%");
                }

                function completeHandler(event) {
                    var data_return = JSON.parse(event.target.responseText);
                    if (data_return['status'] == 'ok') {
                        var path = '/upload/pdf/'+data_return['new_name'];

                        $('#namePdf').val(data_return['file_name']);
                        $('#inputPatePdf').val(path);


                        $('#show_progressBar_' + set_type).addClass('hide');
                        $("#" + progressBar).css('width', "0%");
                        $("#" + progressBar).html("0%");

                        $('#loadFilePdf').addClass('hidden');
                        $('#saveLoadFilePdf').removeClass('hidden');


                    } else {
                        ajax_pdf.abort();
                        alert("Error:" + data_return['message']);
                        $("#" + progressBar).css('width', "0%");
                        $("#" + progressBar).html("0%");
                    }
                }

                function errorHandler(event) {
                    ajax_pdf.abort();
                    alert("Upload Failed");
                    $('#show_progressBar_' + set_type).addClass('hide');
                    $("#" + progressBar).css('width', "0%");
                    $("#" + progressBar).html("0%");

                }

                function abortHandler(event) {
                    ajax_pdf.abort();
                    alert("Upload Aborted");
                    $('#show_progressBar_' + set_type).addClass('hide');
                    $("#" + progressBar).css('width', "0%");
                    $("#" + progressBar).html("0%");
                }

            } else {
                alert("File type cannot upload!!!");
            }
        } else {
            alert("Not found file input!!!");
        }
    }
    function showLoadImage(input) {
        if (input.files && input.files[0]) {
            ajax_image = new XMLHttpRequest();
            var type_file = input.files[0].type;
            var file_name = input.files[0].name;

            var tmppath = URL.createObjectURL(input.files[0]);
            console.log(tmppath);

            var cut_type_file = file_name.split('.');
            var file_type = cut_type_file[cut_type_file.length - 1];
            var cut = type_file.split("/");
            var set_type = 'image';
            type_file = (cut.length > 0) ? cut[0] : "";
            type_file = type_file.toLowerCase();
            //check type file upload
            if (type_file == set_type) {
                $('#show_progressBar_' + set_type).removeClass('hide');
                var progressBar = "progressBar_" + set_type;
                var topic_id = input.getAttribute("topic_id");

                var form_data = new FormData();
                form_data.append("fileToUpload", input.files[0]);
                ajax_image.upload.addEventListener("progress", progressHandler, false);
                ajax_image.addEventListener("load", completeHandler, false);
                ajax_image.addEventListener("error", errorHandler, false);
                ajax_image.addEventListener("abort", abortHandler, false);
                ajax_image.open("POST","/upload/upload_file.php?type=" + set_type);
                ajax_image.send(form_data);

                function progressHandler(event) {
                    var percent = (event.loaded / event.total) * 100;
                    $("#" + progressBar).css('width', Math.round(percent) + "%");
                    $("#" + progressBar).html(Math.round(percent) + "%");
                }

                function completeHandler(event) {
                    var data_return = JSON.parse(event.target.responseText);
                    if (data_return['status'] == 'ok') {
                        var src = '/upload/image/'+data_return['new_name'];

                        $('#nameImage').val(data_return['file_name']);
                        $('#imageShow').attr('src',src);
                        $('#inputPate').attr('value',src);

                        $('#show_progressBar_' + set_type).addClass('hide');
                        $("#" + progressBar).css('width', "0%");
                        $("#" + progressBar).html("0%");

                        $('#loadFileImage').addClass('hidden');
                        $('#saveLoadFileImage').removeClass('hidden');

                    } else {
                        ajax_image.abort();
                        alert("Error:" + data_return['message']);
                        $("#" + progressBar).css('width', "0%");
                        $("#" + progressBar).html("0%");
                    }
                }

                function errorHandler(event) {
                    ajax_image.abort();
                    alert("Upload Failed");
                    $('#show_progressBar_' + set_type).addClass('hide');
                    $("#" + progressBar).css('width', "0%");
                    $("#" + progressBar).html("0%");

                }

                function abortHandler(event) {
                    ajax_image.abort();
                    alert("Upload Aborted");
                    $('#show_progressBar_' + set_type).addClass('hide');
                    $("#" + progressBar).css('width', "0%");
                    $("#" + progressBar).html("0%");
                }

            } else {
                alert("File type cannot upload!!!");
            }
        } else {
            alert("Not found file input!!!");
        }
    }
    function showLoadVideo(input) {
        if (input.files && input.files[0]) {
            ajax_video = new XMLHttpRequest();
            var type_file = input.files[0].type;
            var file_name = input.files[0].name;

            var tmppath = URL.createObjectURL(input.files[0]);
            console.log(tmppath);

            var cut_type_file = file_name.split('.');
            var file_type = cut_type_file[cut_type_file.length - 1];
            var cut = type_file.split("/");
            var set_type = 'video';
            type_file = (cut.length > 0) ? cut[0] : "";
            type_file = type_file.toLowerCase();
            //check type file upload
            if (type_file == set_type) {
                $('#show_progressBar_' + set_type).removeClass('hide');
                var progressBar = "progressBar_" + set_type;
                var topic_id = input.getAttribute("topic_id");

                var form_data = new FormData();
                form_data.append("fileToUpload", input.files[0]);
                ajax_video.upload.addEventListener("progress", progressHandler, false);
                ajax_video.addEventListener("load", completeHandler, false);
                ajax_video.addEventListener("error", errorHandler, false);
                ajax_video.addEventListener("abort", abortHandler, false);
                ajax_video.open("POST","/upload/upload_file.php?type=" + set_type);
                ajax_video.send(form_data);

                function progressHandler(event) {
                    var percent = (event.loaded / event.total) * 100;
                    $("#" + progressBar).css('width', Math.round(percent) + "%");
                    $("#" + progressBar).html(Math.round(percent) + "%");
                }

                function completeHandler(event) {
                    var data_return = JSON.parse(event.target.responseText);
                    if (data_return['status'] == 'ok') {
                        var src = '/upload/video/'+data_return['new_name'];

                        $('#nameVideo').val(data_return['file_name']);
                        $('#videoShow').attr('src',src);
                        $('#inputVideo').attr('value',src);

                        $('#show_progressBar_' + set_type).addClass('hide');
                        $("#" + progressBar).css('width', "0%");
                        $("#" + progressBar).html("0%");

                        $('#loadFileVideo').addClass('hidden');
                        $('#saveLoadFileVideo').removeClass('hidden');

                    } else {
                        ajax_video.abort();
                        alert("Error:" + data_return['message']);
                        $("#" + progressBar).css('width', "0%");
                        $("#" + progressBar).html("0%");
                    }
                }

                function errorHandler(event) {
                    ajax_video.abort();
                    alert("Upload Failed");
                    $('#show_progressBar_' + set_type).addClass('hide');
                    $("#" + progressBar).css('width', "0%");
                    $("#" + progressBar).html("0%");

                }

                function abortHandler(event) {
                    ajax_video.abort();
                    alert("Upload Aborted");
                    $('#show_progressBar_' + set_type).addClass('hide');
                    $("#" + progressBar).css('width', "0%");
                    $("#" + progressBar).html("0%");
                }

            } else {
                alert("File type cannot upload!!!");
            }
        } else {
            alert("Not found file input!!!");
        }
    }
    function cancelUploadFile(addOrEdit) {
        var file = addOrEdit;
        if (file == 'image') {
            ajax_image.abort();
        }
        else if (file == 'pdf') {
            ajax_pdf.abort();
        }
        else if (file == 'video') {
            ajax_video.abort();
        }
        $('#show_progressBar_'+file).addClass('hide');
        $("#file_" + file).val("");

    }





    
</script>


<?php include "_modal.php";?>
</body>
</html>
