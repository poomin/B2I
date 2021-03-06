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
$m_li = 'image';


include_once __DIR__.'/controller/adminProjectImage.php';

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
<div id="card" attr="<?=$SETID;?>">
    <div class="container" style="padding-top: 40px; padding-bottom: 20px;">
        <div class="row">

            <div class="col-xs-12 col-sm-3">
                <div class="box-card">
                   <?php include '_user.php'?>
                </div>
            </div>

            <div class="col-xs-12 col-sm-9">
                <div class="box-card">

                    <?php if(isset($_SESSION['success'])): ?>
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <strong>Success. </strong> <?php echo $_SESSION['success']; ?>
                        </div>
                        <?php unset($_SESSION['success']);
                    endif; ?>

                    <?php if (isset($_SESSION['error'])): ?>
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                            <strong>Warning!</strong> <?php echo $_SESSION['error']; ?>
                        </div>
                        <?php unset($_SESSION['error']);
                    endif; ?>




                    <div class="text-center">
                        <h3>ภาพนำเสนอ</h3>
                    </div>

                    <hr>
                    <div class="row">

                        <?php foreach ($IMAGE as $item): ?>
                            <div id="img<?=$item['id'];?>" class="col-sm-6 col-md-4">
                                <div class="thumbnail">
                                    <img src="<?=$item['path'];?>" alt="image">
                                    <div class="caption">
                                        <p><?=$item['namefile'];?></p>
                                        <p class="text-right" <?= $role=='admin'?'':'hidden';?> >
                                            <button class="btn btn-danger btn-xs" onclick="deleteImage('<?=$item['id'];?>')">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>

                    </div>

                    <hr>
                    <div class="show-detail">

                        <div id="loadFile" class="text-center">
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
                                <input id="path_image" class="hide" type="text" name="path_image" value="<?= $path_image; ?>">
                                <input id="name_image" class="hide" type="text" name="name_image" value="<?= $name_image; ?>">
                                <div class="box-img-ready" <?= $role=='admin'?'':'hidden';?>>
                                    <label style="cursor: pointer;" for="file_image">
                                        <h3 id="upload_image"><span class="label label-info"><i class="fa fa-upload"></i> Upload</span></h3>
                                        <input id="file_image" topic_id="<?= $topic_id ?>" accept="image/*" type="file" style="display:none;" onchange="showLoadImage(this)">
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div id="saveLoadFile" class="hidden">
                            <div class="row">
                                <div class="col-xs-6 col-md-4 col-md-offset-4">
                                    <a href="#" class="thumbnail">
                                        <img id="imageShow" src="/froala/upload/img.png" alt="image">
                                    </a>
                                </div>
                            </div>

                            <div class="row">
                                <form class="form-horizontal" action="admin-project-image.php" method="post">
                                    <div class="form-group">
                                        <label for="nameImage" class="col-sm-4 control-label">รายละเอียดภาพ</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" id="nameImage" name="namefile" placeholder="รายละเอียดภาพ">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-offset-4 col-sm-6">
                                            <input class="hidden" name="fn" value="saveImage" >
                                            <input id="inputPate" class="hidden" name="path" value="">
                                            <button type="submit" class="btn btn-success">SAVE</button>
                                        </div>
                                    </div>
                                </form>
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

                        $('#nameImage').val(data_return['file_name']);
                        $('#imageShow').attr('src',src);
                        $('#inputPate').attr('value',src);

                        $('#show_progressBar_' + set_type).addClass('hide');
                        $("#" + progressBar).css('width', "0%");
                        $("#" + progressBar).html("0%");

                        $('#loadFile').addClass('hidden');
                        $('#saveLoadFile').removeClass('hidden');


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



    function deleteImage(id) {
        var req = $.ajax({
            type: 'POST',
            url: './controller/Service.php',
            data: {
                fn: 'deleteImageProjectSetup',
                id: id,
            },
            dataType: 'JSON'
        });
        req.done(function (res) {
            if(res.status){
                alert('Delete Image complete...');
                $('#img'+id).remove();
            }else{
                alert('Delete Image false!!!!');
            }
        });
    }

</script>


</body>
</html>
