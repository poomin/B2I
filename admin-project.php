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
$m_li = 'new';
require_once __DIR__."/controller/adminProject.php"
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once __DIR__.'/_header.php'; ?>
</head>

<body id="page-top">
<!-- Navigation Bar -->
<?php require_once __DIR__.'/_menunev.php'; ?>
<!-- End of Navigation Bar -->

<!-- Container Box -->
<div id="card" attr="<?php echo $SETID;?>">
    <div class="container" style="padding-top: 40px; padding-bottom: 20px;">
        <div class="row">

            <div class="col-xs-12 col-sm-3">
                <div class="box-card">
                   <?php require_once __DIR__.'/_user.php'?>
                </div>
            </div>

            <div class="col-xs-12 col-sm-9">
                <div class="box-card">

                    <?php require_once __DIR__.'/_alert.php'; ?>

                    <div class="text-center">
                        <h3>โครงการ</h3>
                    </div>
                    <hr>

                    <div class="row">
                        <div class="col-xs-8 col-md-8 col-md-offset-2 text-center">
                            ภาพที่ใช่ในการแสดงในส่วนบนของแวป
                            <a href="#" class="thumbnail">
                                <img id="imageShow" src="<?php echo $image; ?>" alt="image" style="height: 50px;">
                            </a>
                        </div>
                    </div>
                    <div class="text-center">
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
                                    <h3 id="upload_image"><span class="label label-info"><i class="fa fa-upload"></i> Upload</span></h3>
                                    <input id="file_image" topic_id="<?php echo $SETID;?>" accept="image/*" type="file" style="display:none;" onchange="showLoadImage(this)">
                                </label>
                            </div>
                        </div>
                    </div>


                    <form class="form-horizontal" style="padding: 20px;" method="post">

                        <div class="form-group">
                            <div class="col-xs-12">
                                <label class="label-control">ชื่อโครงการ</label>
                                <input class="form-control" name="name" type="text" value="<?php echo $name;?>" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-12">
                                <label class="label-control">หัวข้อ</label>
                                <input class="form-control" type="text" name="title" value="<?php echo $title;?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <label class="label-control">รายละเอียด</label>
                                <textarea class="form-control" rows="7" type="text" name="detail"><?php echo $detail;?></textarea>

                            </div>
                        </div>

                        <div class="text-center">
                            <input id="uploadImage" class="hidden" name="image" value="<?php echo $image;?>">
                            <input class="hidden" name="id" value="<?php echo $id;?>">
                            <input class="hidden" name="fn" value="cmp">
                            <button type="submit" class="btn btn-lg sr-button btn-success">
                                <?php echo $id==0?'SAVE':'EDIT'?>
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>

</div>
<!-- End of container Box -->


<footer>
    <?php require_once __DIR__.'/_footer.php'; ?>
</footer>
<?php require_once __DIR__.'/_script.php'; ?>

<script>

    var ajax_image;
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
                ajax_image.open("POST", "/upload/upload_file.php?type=" + set_type);
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

                        $('#imageShow').attr('src',src);
                        $('#uploadImage').attr('value',src);


                        $('#show_progressBar_' + set_type).addClass('hide');
                        $("#" + progressBar).css('width', "0%");
                        $("#" + progressBar).html("0%");


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
    function cancelUploadFile(addOrEdit) {
        var file = addOrEdit
        if (file == 'image') {
            ajax_image.abort();
        }
        $('#show_progressBar_image').addClass('hide');
        $("#file_" + file).val("");

    }

</script>

</body>
</html>
