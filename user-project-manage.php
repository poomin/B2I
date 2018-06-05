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
                            <li class="disabled" role="presentation">
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
                                                <h4>เอกสาร</h4>
                                                <div id="showFileP1">

                                                    <table class="thisdatatable table table-striped table-bordered" style="width:100%">
                                                        <thead>
                                                        <tr>
                                                            <th>เอกสาร</th>
                                                            <th>จัดการ</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php for($i=0;$i<10;$i++): ?>
                                                            <tr>
                                                                <td>
                                                                    <a href="/upload/image/img.png">
                                                                        <i class="fa fa-file"></i>
                                                                        file for download
                                                                    </a>
                                                                </td>
                                                                <td class="text-center">
                                                                    <button class="btn btn-danger btn-xs">
                                                                        <i class="fa fa-trash"></i>
                                                                    </button>
                                                                </td>
                                                            </tr>
                                                        <?php endfor; ?>
                                                        </tbody>
                                                    </table>

                                                </div>
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

                                            </div>
                                            <hr>

                                            <div class="image-upload">
                                                <h4>ภาพ</h4>
                                                <div id="showImageP1">

                                                    <table class="thisdatatable table table-striped table-bordered" style="width:100%">
                                                        <thead>
                                                        <tr>
                                                            <th>ภาพ</th>
                                                            <th>รายละเอียด</th>
                                                            <th>จัดการ</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php for($i=0;$i<10;$i++): ?>
                                                            <tr>
                                                                <td class="text-center">
                                                                    <img src="/images/science1.jpg" alt="image" class="img-thumbnail" style="height: 100px;">
                                                                </td>
                                                                <td>Test</td>
                                                                <td class="text-center">
                                                                    <button class="btn btn-primary btn-xs">
                                                                        <i class="fa fa-download"></i>
                                                                    </button>
                                                                    <button class="btn btn-danger btn-xs">
                                                                        <i class="fa fa-trash"></i>
                                                                    </button>
                                                                </td>
                                                            </tr>
                                                        <?php endfor; ?>
                                                        </tbody>
                                                    </table>

                                                </div>
                                                <div id="uploadImageP1">

                                                </div>

                                            </div>


                                        </div>
                                    <?php endif; ?>
                                <?php endif; ?>


                            </div>
                            <div role="tabpanel" class="tab-pane" id="phase2">

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
        $('.thisdatatable').DataTable();
    } );


    var ajax_pdf;
    var ajax_image;
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
    function cancelUploadFile(addOrEdit) {
        var file = addOrEdit;
        if (file == 'image') {
            ajax_image.abort();
        }
        else if (file == 'pdf') {
            ajax_pdf.abort();
        }
        $('#show_progressBar_'+file).addClass('hide');
        $("#file_" + file).val("");

    }


    
</script>



</body>
</html>
