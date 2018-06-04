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
$m_li = 'news';

$POSTID = isset($_REQUEST['id'])?$_REQUEST['id']:'';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include '_header.php'; ?>
    <?php include '_froalacss.php'; ?>
</head>

<body id="page-top">
<!-- Navigation Bar -->
<?php include '_menunev.php'; ?>
<!-- End of Navigation Bar -->

<!-- Container Box -->
<div id="card" attr="<?=$POSTID;?>">
    <div class="container" style="padding-top: 40px; padding-bottom: 20px;">
        <div class="row">

            <div class="col-xs-12 col-sm-3">
                <div class="box-card">
                    <?php include '_user.php'?>
                </div>
            </div>

            <div class="col-xs-12 col-sm-9">
                <div class="box-card">
                    <div class="text-left">
                        <h3>ข่าว / ประกาศ </h3>
                    </div>
                    <hr>


                    <dev class="form-horizontal" style="padding: 20px;">

                        <div class="form-group">
                            <div class="col-xs-12">
                                <label class="label-control">หัวข้อข่าว/ประกาศ</label>
                                <input id="inputTitle" class="form-control" name="name" type="text" value="">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-12">
                                <label class="label-control">ประเภท</label>
                                <select class="form-control" id="selectType">
                                    <option value="news"> ข่าว </option>
                                    <option value="article"> บทความ </option>
                                    <option value="announce"> ประกาศ </option>
                                </select>
                            </div>
                        </div>

                    </dev>

                    <div class="row">
                        <div class="col-xs-6 col-md-4 col-md-offset-4 text-center">
                            ภาพหัวข้อข่าว
                            <a href="#" class="thumbnail">
                                <img id="imageShow" src="/froala/upload/img.png" alt="image">
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
                                    <input id="file_image" topic_id="<?= $topic_id ?>" accept="image/*" type="file" style="display:none;" onchange="showLoadImage(this)">
                                </label>
                            </div>
                        </div>
                    </div>




                    <div id="editor">
                        <div id='edit' style="margin-top: 30px;">

                        </div>
                    </div>

                    <div class="text-center" style="padding-top: 20px;">
                        <input class="hidden" id="inputUserId" value="<?=$_SESSION['id'];?>">
                        <button type="submit" class="btn btn-lg sr-button btn-success" onclick="saveText()">SAVE</button>
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
<?php include '_froalascript.php'; ?>
<script>
    $(function() {
        $('#edit').froalaEditor({
            heightMin: 250,
        });
        getText();
    });
    function saveText() {
        var id = $('#card').attr('attr');
        var user_id = $('#inputUserId').val();
        var title = $('#inputTitle').val();
        var type = $('#selectType').val();
        var path = $('#imageShow').attr('src');
        if(title==''){
            alert('กรุณากรอกข้อมูลให้ครบด่วน');
        }else{
            var text = $('#edit').froalaEditor('html.get');
            var req = $.ajax({
                type: 'POST',
                url: './controller/Service.php',
                data: {
                    fn: 'editPost',
                    user_id: user_id,
                    title: title,
                    type: type,
                    detail: text,
                    path: path,
                    id: id
                },
                dataType: 'JSON'
            });
            req.done(function (res) {
                if(res.status){
                    alert('save data complete...');
                    window.location.href = '/B2I/admin-news.php';
                }else{
                    alert('save data false!!!!');
                }
            });
        }
    }
    function getText() {
        var id = $('#card').attr('attr');
        var req = $.ajax({
            type: 'POST',
            url: './controller/Service.php',
            data: {
                fn: 'getPostById',
                id: id,
            },
            dataType: 'JSON'
        });
        req.done(function (res) {
            if(res.status){
                var text = res.data.details;
                var path = res.data.path;
                var title = res.data.title;
                var type = res.data.type;
                $('#inputTitle').val(title);
                $('#imageShow').attr('src',path);
                $('#selectType').val(type);
                $('#edit').froalaEditor('html.set',text);
            }else{
                alert('get data false!!!!');
            }
        });

    }


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
                ajax_image.open("POST", "/B2I/upload/upload_file.php?type=" + set_type);
                ajax_image.send(form_data);

                function progressHandler(event) {
                    var percent = (event.loaded / event.total) * 100;
                    $("#" + progressBar).css('width', Math.round(percent) + "%");
                    $("#" + progressBar).html(Math.round(percent) + "%");
                }

                function completeHandler(event) {
                    var data_return = JSON.parse(event.target.responseText);
                    if (data_return['status'] == 'ok') {
                        var src = '/B2I/upload/image/'+data_return['new_name'];

                        $('#imageShow').attr('src',src);

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