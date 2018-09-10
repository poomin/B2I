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
$m_li = 'check';

include "controller/adminCheckManage.php"
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

                    <?php if(isset($_SESSION['success'])): ?>
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <strong>Success!</strong> <?php echo $_SESSION['success']; ?>
                        </div>
                        <?php unset($_SESSION['success']); endif; ?>

                    <!-- header project -->
                    <div class="header-project">
                        <div class="form-inline">
                            <div class="form-group">
                                <label>โครงการ : </label>
                                <label> <h3><?= isset($PROJECT['name'])?$PROJECT['name']:'';?></h3> </label>
                            </div>
                            <div class="form-group" style="padding-left: 10px; padding-top: 10px;">
                                <button class="btn btn-link btn-xs" type="button" attr_active ='n' onclick="showDetailProject(this);">
                                    <i id="fa_header_project" class="fa fa-arrow-down"></i> รายละเอียด
                                </button>
                            </div>
                        </div>
                        <hr>

                        <div class="form-horizontal" id="show_detail_project" hidden>
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
                            <hr>
                        </div>

                    </div>
                    <!-- end header project -->

                    <div>

                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs nav-justified" role="tablist">
                            <li role="presentation" class="<?=($PHASEACTIVE=='p1')?'active':'';?>">
                                <a href="#phase1" aria-controls="phase1" role="tab" data-toggle="tab">เสนอแนวคิดสิ่งประดิษฐ์</a>
                            </li>
                            <li role="presentation" class="<?=($PHASEACTIVE=='c1')?'active':'';?>">
                                <a href="#confirm1" aria-controls="confirm1" role="tab" data-toggle="tab">ยืนยันเข้าอบรม</a>
                            </li>
                            <li role="presentation" class="<?=($PHASEACTIVE=='p2')?'active':'';?>">
                                <a href="#phase2" aria-controls="phase2" role="tab" data-toggle="tab">ส่ง video</a>
                            </li>
                            <li role="presentation" class="<?=($PHASEACTIVE=='c2')?'active':'';?>">
                                <a href="#confirm2" aria-controls="confirm2" role="tab" data-toggle="tab">ยืนยันเข้าร่วมรอบชิง</a>
                            </li>
                            <li role="presentation" class="<?=($PHASEACTIVE=='p3')?'active':'';?>">
                                <a href="#phase3" aria-controls="phase3" role="tab" data-toggle="tab">ส่งเอกสารรอบชิง</a>
                            </li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">

                            <?php include  'admin-check-manage-p1.php';?>
                            <?php include  'admin-check-manage-p1c.php';?>

                            <?php include  'admin-check-manage-p2.php';?>
                            <?php include  'admin-check-manage-p2C.php';?>

                            <?php include  'admin-check-manage-p3.php';?>


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

        $('input[type=radio][name=phase1result]').change(function() {
            if (this.value == 'pass') {
                $('#radioChangePhase1Result').attr('class','bs-callout bs-callout-success');
            }
            else if (this.value == 'process') {
                $('#radioChangePhase1Result').attr('class','bs-callout bs-callout-warning');
            }
            else {
                $('#radioChangePhase1Result').attr('class','bs-callout bs-callout-danger');
            }
        });
        $('input[type=radio][name=confirm1result]').change(function() {
            if (this.value == 'pass') {
                $('#radioChangeConfirm1Result').attr('class','bs-callout bs-callout-success');
            }
            else if (this.value == 'process') {
                $('#radioChangeConfirm1Result').attr('class','bs-callout bs-callout-warning');
            }
            else {
                $('#radioChangeConfirm1Result').attr('class','bs-callout bs-callout-danger');
            }
        });

        $('input[type=radio][name=phase2result]').change(function() {
            if (this.value == 'pass') {
                $('#radioChangePhase2Result').attr('class','bs-callout bs-callout-success');
            }
            else if (this.value == 'process') {
                $('#radioChangePhase2Result').attr('class','bs-callout bs-callout-warning');
            }
            else {
                $('#radioChangePhase2Result').attr('class','bs-callout bs-callout-danger');
            }
        });
        $('input[type=radio][name=confirm2result]').change(function() {
            if (this.value == 'pass') {
                $('#radioChangeConfirm2Result').attr('class','bs-callout bs-callout-success');
            }
            else if (this.value == 'process') {
                $('#radioChangeConfirm2Result').attr('class','bs-callout bs-callout-warning');
            }
            else {
                $('#radioChangeConfirm2Result').attr('class','bs-callout bs-callout-danger');
            }
        });

        $('input[type=radio][name=phase3result]').change(function() {
            if (this.value == 'pass') {
                $('#radioChangePhase3Result').attr('class','bs-callout bs-callout-success');
            }
            else if (this.value == 'process') {
                $('#radioChangePhase3Result').attr('class','bs-callout bs-callout-warning');
            }
            else {
                $('#radioChangePhase3Result').attr('class','bs-callout bs-callout-danger');
            }
        });

    } );

    function showDetailProject(_this) {
        var active =  $(_this).attr('attr_active');
        if(active=='n'){
            $('#show_detail_project').removeAttr('hidden');
            $('#fa_header_project').removeClass('fa-arrow-down');
            $('#fa_header_project').addClass('fa-arrow-up');
            $(_this).attr('attr_active','y')
        }else{
            $('#show_detail_project').attr('hidden','hidden');
            $('#fa_header_project').removeClass('fa-arrow-up');
            $('#fa_header_project').addClass('fa-arrow-down');
            $(_this).attr('attr_active','n')
        }

    }


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


    var ajax_pdf_p2;
    var ajax_image_p2;
    var ajax_video_p2;
    function showLoadPdfP2(input) {
        if (input.files && input.files[0]) {
            ajax_pdf_p2 = new XMLHttpRequest();
            var type_file = input.files[0].type;
            var file_name = input.files[0].name;
            var set_type = 'pdf';

            var cut_type_file = file_name.split('.');
            var file_type = cut_type_file[cut_type_file.length - 1];
            file_type = file_type.toLowerCase();

            var arr_type_file = ['pot', 'potm', 'potx', 'pps', 'ppsm', 'ppsx', 'ppt', 'pptm', 'pptx' , 'pdf'];
            //check type file upload
            if (arr_type_file.indexOf(file_type) >= 0) {

                $('#p2_show_progressBar_' + set_type).removeClass('hide');
                var progressBar = "p2_progressBar_" + set_type;

                var form_data = new FormData();
                form_data.append("fileToUpload", input.files[0]);
                ajax_pdf_p2.upload.addEventListener("progress", progressHandler, false);
                ajax_pdf_p2.addEventListener("load", completeHandler, false);
                ajax_pdf_p2.addEventListener("error", errorHandler, false);
                ajax_pdf_p2.addEventListener("abort", abortHandler, false);
                ajax_pdf_p2.open("POST", "../upload/upload_file.php?type=" + set_type);
                ajax_pdf_p2.send(form_data);

                function progressHandler(event) {
                    var percent = (event.loaded / event.total) * 100;
                    $("#" + progressBar).css('width', Math.round(percent) + "%");
                    $("#" + progressBar).html(Math.round(percent) + "%");
                }

                function completeHandler(event) {
                    var data_return = JSON.parse(event.target.responseText);
                    if (data_return['status'] == 'ok') {
                        var path = '/upload/pdf/'+data_return['new_name'];

                        $('#namePdfP2').val(data_return['file_name']);
                        $('#inputPatePdfP2').val(path);

                        $('#show_progressBar_' + set_type).addClass('hide');
                        $("#" + progressBar).css('width', "0%");
                        $("#" + progressBar).html("0%");

                        $('#loadFilePdfP2').addClass('hidden');
                        $('#saveLoadFilePdfP2').removeClass('hidden');


                    } else {
                        ajax_pdf_p2.abort();
                        alert("Error:" + data_return['message']);
                        $("#" + progressBar).css('width', "0%");
                        $("#" + progressBar).html("0%");
                    }
                }

                function errorHandler(event) {
                    ajax_pdf_p2.abort();
                    alert("Upload Failed");
                    $('#p2_show_progressBar_' + set_type).addClass('hide');
                    $("#" + progressBar).css('width', "0%");
                    $("#" + progressBar).html("0%");

                }

                function abortHandler(event) {
                    ajax_pdf_p2.abort();
                    alert("Upload Aborted");
                    $('#p2_show_progressBar_' + set_type).addClass('hide');
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
    function showLoadImageP2(input) {
        if (input.files && input.files[0]) {
            ajax_image_p2 = new XMLHttpRequest();
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
                $('#p2_show_progressBar_' + set_type).removeClass('hide');
                var progressBar = "p2_progressBar_" + set_type;

                var form_data = new FormData();
                form_data.append("fileToUpload", input.files[0]);
                ajax_image_p2.upload.addEventListener("progress", progressHandler, false);
                ajax_image_p2.addEventListener("load", completeHandler, false);
                ajax_image_p2.addEventListener("error", errorHandler, false);
                ajax_image_p2.addEventListener("abort", abortHandler, false);
                ajax_image_p2.open("POST","/upload/upload_file.php?type=" + set_type);
                ajax_image_p2.send(form_data);

                function progressHandler(event) {
                    var percent = (event.loaded / event.total) * 100;
                    $("#" + progressBar).css('width', Math.round(percent) + "%");
                    $("#" + progressBar).html(Math.round(percent) + "%");
                }

                function completeHandler(event) {
                    var data_return = JSON.parse(event.target.responseText);
                    if (data_return['status'] == 'ok') {
                        var src = '/upload/image/'+data_return['new_name'];

                        $('#nameImageP2').val(data_return['file_name']);
                        $('#imageShowP2').attr('src',src);
                        $('#inputPateP2').attr('value',src);

                        $('#p2_show_progressBar_' + set_type).addClass('hide');
                        $("#" + progressBar).css('width', "0%");
                        $("#" + progressBar).html("0%");

                        $('#loadFileImageP2').addClass('hidden');
                        $('#saveLoadFileImageP2').removeClass('hidden');

                    } else {
                        ajax_image_p2.abort();
                        alert("Error:" + data_return['message']);
                        $("#" + progressBar).css('width', "0%");
                        $("#" + progressBar).html("0%");
                    }
                }

                function errorHandler(event) {
                    ajax_image_p2.abort();
                    alert("Upload Failed");
                    $('#p2_show_progressBar_' + set_type).addClass('hide');
                    $("#" + progressBar).css('width', "0%");
                    $("#" + progressBar).html("0%");

                }

                function abortHandler(event) {
                    ajax_image_p2.abort();
                    alert("Upload Aborted");
                    $('#p2_show_progressBar_' + set_type).addClass('hide');
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
    function showLoadVideoP2(input) {
        if (input.files && input.files[0]) {
            ajax_video_p2 = new XMLHttpRequest();
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
                $('#p2_show_progressBar_' + set_type).removeClass('hide');
                var progressBar = "p2_progressBar_" + set_type;

                var form_data = new FormData();
                form_data.append("fileToUpload", input.files[0]);
                ajax_video_p2.upload.addEventListener("progress", progressHandler, false);
                ajax_video_p2.addEventListener("load", completeHandler, false);
                ajax_video_p2.addEventListener("error", errorHandler, false);
                ajax_video_p2.addEventListener("abort", abortHandler, false);
                ajax_video_p2.open("POST","/upload/upload_file.php?type=" + set_type);
                ajax_video_p2.send(form_data);

                function progressHandler(event) {
                    var percent = (event.loaded / event.total) * 100;
                    $("#" + progressBar).css('width', Math.round(percent) + "%");
                    $("#" + progressBar).html(Math.round(percent) + "%");
                }

                function completeHandler(event) {
                    var data_return = JSON.parse(event.target.responseText);
                    if (data_return['status'] == 'ok') {
                        var src = '/upload/video/'+data_return['new_name'];

                        $('#nameVideoP2').val(data_return['file_name']);
                        $('#videoShowP2').attr('src',src);
                        $('#inputVideoP2').attr('value',src);

                        $('#p2_show_progressBar_' + set_type).addClass('hide');
                        $("#" + progressBar).css('width', "0%");
                        $("#" + progressBar).html("0%");

                        $('#loadFileVideoP2').addClass('hidden');
                        $('#saveLoadFileVideoP2').removeClass('hidden');

                    } else {
                        ajax_video_p2.abort();
                        alert("Error:" + data_return['message']);
                        $("#" + progressBar).css('width', "0%");
                        $("#" + progressBar).html("0%");
                    }
                }

                function errorHandler(event) {
                    ajax_video_p2.abort();
                    alert("Upload Failed");
                    $('#p2_show_progressBar_' + set_type).addClass('hide');
                    $("#" + progressBar).css('width', "0%");
                    $("#" + progressBar).html("0%");

                }

                function abortHandler(event) {
                    ajax_video_p2.abort();
                    alert("Upload Aborted");
                    $('#p2_show_progressBar_' + set_type).addClass('hide');
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
    function cancelUploadFileP2(addOrEdit) {
        var file = addOrEdit;
        if (file == 'image') {
            ajax_image_p2.abort();
        }
        else if (file == 'pdf') {
            ajax_pdf_p2.abort();
        }
        else if (file == 'video') {
            ajax_video_p2.abort();
        }
        $('#p2_show_progressBar_'+file).addClass('hide');
        $("#p2_file_" + file).val("");

    }


</script>

<?php include "_modal.php";?>
<!--    modal log phase 1 -->
<div class="modal fade moddalLogPhase1" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel1">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myLargeModalLabel1">ประวัติการทำงาน</h4>
            </div>
            <div class="modal-body">
                <table class="thisdatatable table table-striped table-bordered" style="width:100%">
                    <thead>
                    <tr>
                        <th>วันที่</th>
                        <th>สมาชิก</th>
                        <th>รายละเอียด</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($P1LOG as $item) : ?>
                        <tr>
                            <td class="text-center"><?=$item['createat'];?></td>
                            <td><?=$item['name'];?> <?=$item['surname'];?></td>
                            <td><?=$item['message'];?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!--    modal log phase 2 -->
<div class="modal fade moddalLogPhase2" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel2">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myLargeModalLabel2">ประวัติการทำงาน</h4>
            </div>
            <div class="modal-body">
                <table class="thisdatatable table table-striped table-bordered" style="width:100%">
                    <thead>
                    <tr>
                        <th>วันที่</th>
                        <th>สมาชิก</th>
                        <th>รายละเอียด</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($P2LOG as $item) : ?>
                        <tr>
                            <td class="text-center"><?=$item['createat'];?></td>
                            <td><?=$item['name'];?> <?=$item['surname'];?></td>
                            <td><?=$item['message'];?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

</body>
</html>
