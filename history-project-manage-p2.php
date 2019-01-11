
<div role="tabpanel" class="tab-pane <?=($PHASEACTIVE=='p2')?'active':'';?>" id="phase2">
    <?PHP
    $statusP2 = false;
    $createP2 = true;
    $editP2 = false;
    $statusFail = false;

    if(isset($projectSetup['phase2status']) && $projectSetup['phase2status']=='close' ){
        $statusP2 = true;
    }
    elseif(isset($projectSetup['phase2status']) && $projectSetup['phase2status']=='process' && isset($PHASE2['id']) && $PHASE2['result']=='process'  ){
        $editP2 = true;
    }

    elseif(isset($PHASE1['result']) && $PHASE1['result']=='fail' ){
        $statusFail = true;
    }

    if(count($PHASE2)>0){
        $createP2 = false;
    }
    if(!isset($projectSetup['id'])){$statusP2=true;}
    ?>

    <?php if ($statusFail): ?>
        <div class="text-center" style="padding-top: 50px; color: red">
            <h3> ไม่ผ่านการคัดเลือก </h3>
        </div>
    <?php elseif ($statusP2): ?>
        <div class="text-center" style="padding-top: 50px;">
            <h3> ยังไม่เปิดให้ส่งเอกสารนำเสนอ </h3>
        </div>

    <?php else: ?>
        <?php if(!isset($CP1['id'])): ?>
            <div class="text-center" style="padding-top: 50px; color: red">
                <h3> ไม่สามารถดำเนินการได้ </h3>
            </div>
        <?php elseif( (!isset($PHASE2['id'])) && $CASE>3): ?>
            <div class="text-center" style="padding-top: 50px; color: red">
                <h3> ไม่สามารถดำเนินการได้ </h3>
            </div>
        <?php elseif($createP2): ?>
            <form class="text-center" style="padding-top: 50px;">
                <input class="hidden" name="id" value="<?= isset($_REQUEST['id'])?$_REQUEST['id']:0;?>">
                <input class="hidden" name="fn" value="phase2">
                <button class="btn btn-primary btn-lg"><i class="fa fa-pencil-square-o"></i> เริ่มโปรเจค</button>
            </form>
        <?php else: ?>
            <div style="padding-top: 20px; padding-bottom: 10px;">

                <?php if(isset($PHASE2['result'])&&$PHASE2['result']=='fail'): ?>
                    <div class="alert alert-danger" role="alert">
                        <strong>ไม่ผ่าน </strong> <?= $PHASE2['detail']; ?>
                    </div>
                <?php elseif (isset($PHASE2['result'])&& $PHASE2['result']=='pass'): ?>
                    <div class="alert alert-success" role="alert">
                        <strong>ผ่าน </strong> <?= $PHASE2['detail']; ?>
                    </div>
                <?php endif;?>


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
                                            <div class="form-group">
                                                <?php if($editP2): ?>
                                                    <form action="user-project-manage.php?id=<?=$id?>" method="post">
                                                        <input class="hidden" name="fn" value="deleteUpload">
                                                        <input class="hidden" name="typefile" value="file">
                                                        <input class="hidden" name="upload_id" value="<?=$item['id'];?>">
                                                        <input class="hidden" name="phase_id" value="<?=$item['phase_id'];?>">
                                                        <input class="hidden" name="name" value="<?=$item['namefile'];?>">
                                                        <input class="hidden" name="user_id" value="<?=$_SESSION['id'];?>">
                                                        <button class="btn btn-danger btn-xs" type="submit">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </form>
                                                <?php endif; ?>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <?PHP if($editP2): ?>
                        <div id="uploadFileP2">

                            <div id="loadFilePdfP2" class="text-center">
                                <div class="form-inline hide" id="p2_show_progressBar_pdf">
                                    <div class="progress" style="float:left; width: 90%; margin-right: 5px;">
                                        <div id="p2_progressBar_pdf" class="progress-bar" role="progressbar"
                                             aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"
                                             style="width: 0%;">
                                            0%
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-danger btn-xs"
                                            onclick="cancelUploadFileP2('pdf')">
                                        <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                    </button>
                                </div>
                                <div id="pdfP2">
                                    <div class="box-img-ready">
                                        <label style="cursor: pointer;" for="p2_file_pdf">
                                            <h3 id="p2_upload_pdf"><span class="label label-info"><i class="fa fa-upload"></i> File Upload </span></h3>
                                            <input id="p2_file_pdf"
                                                   accept=".pdf,.pot,.potm,.potx,.pps,.ppsm,.ppsx,.ppt,.pptm,.pptx"
                                                   type="file" style="display:none;" onchange="showLoadPdfP2(this)">
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div id="saveLoadFilePdfP2" class="hidden">
                                <div class="row text-center">
                                    <i class="fa fa-file fa-5x thumbnail"></i>
                                </div>

                                <div class="row">
                                    <form class="form-horizontal" action="user-project-manage.php?id=<?=$PROJECT['id'];?>" method="post">
                                        <div class="form-group">
                                            <label for="namePdfP2" class="col-sm-4 control-label">รายละเอียดไฟล์</label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" id="namePdfP2" name="namefile" placeholder="รายละเอียดภาพ">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-offset-4 col-sm-6">
                                                <input class="hidden" name="fn" value="savePdfP2" >
                                                <input class="hidden" name="phase_id" value="<?=$PHASE2['id'];?>" >
                                                <input class="hidden" name="user_id" value="<?=$_SESSION['id'];?>" >
                                                <input class="hidden" name="typefile" value="pdf" >
                                                <input id="inputPatePdfP2" class="hidden" name="path" value="">
                                                <button type="submit" class="btn btn-success">SAVE</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>
                    <?php endif;?>
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
                                            <div class="form-group">
                                                <?php if($editP2): ?>
                                                    <form action="user-project-manage.php?id=<?=$id?>" method="post">
                                                        <input class="hidden" name="fn" value="deleteUpload">
                                                        <input class="hidden" name="typefile" value="image">
                                                        <input class="hidden" name="upload_id" value="<?=$item['id'];?>">
                                                        <input class="hidden" name="phase_id" value="<?=$item['phase_id'];?>">
                                                        <input class="hidden" name="name" value="<?=$item['namefile'];?>">
                                                        <input class="hidden" name="user_id" value="<?=$_SESSION['id'];?>">
                                                        <button class="btn btn-danger btn-xs" type="submit">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </form>
                                                <?php endif; ?>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            <?php endforeach; ?>
                            </tbody>
                        </table>

                    </div>
                    <?PHP if($editP2): ?>
                        <div id="uploadImageP2">

                            <div id="loadFileImageP2" class="text-center">
                                <div class="form-inline hide" id="p2_show_progressBar_image">
                                    <div class="progress" style="float:left; width: 90%; margin-right: 5px;">
                                        <div id="p2_progressBar_image" class="progress-bar" role="progressbar"
                                             aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"
                                             style="width: 0%;">
                                            0%
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-danger btn-xs"
                                            onclick="cancelUploadFileP2('image')">
                                        <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                    </button>
                                </div>
                                <div id="imageP2">
                                    <div class="box-img-ready">
                                        <label style="cursor: pointer;" for="p2_file_image">
                                            <h3 id="p2_upload_image"><span class="label label-info"><i class="fa fa-upload"></i> Image Upload</span></h3>
                                            <input id="p2_file_image" accept="image/*" type="file" style="display:none;" onchange="showLoadImageP2(this)">
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div id="saveLoadFileImageP2" class="hidden">
                                <div class="row">
                                    <div class="col-xs-6 col-md-4 col-md-offset-4">
                                        <a href="#" class="thumbnail">
                                            <img id="imageShowP2" src="/froala/upload/img.png" alt="image">
                                        </a>
                                    </div>
                                </div>

                                <div class="row">
                                    <form class="form-horizontal" action="user-project-manage.php?id=<?=$PROJECT['id'];?>" method="post">
                                        <div class="form-group">
                                            <label for="nameImageP2" class="col-sm-4 control-label">รายละเอียดภาพ</label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" id="nameImageP2" name="namefile" placeholder="รายละเอียดภาพ">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-offset-4 col-sm-6">
                                                <input class="hidden" name="fn" value="saveImageP2" >
                                                <input class="hidden" name="phase_id" value="<?=$PHASE2['id'];?>" >
                                                <input class="hidden" name="user_id" value="<?=$_SESSION['id'];?>" >
                                                <input class="hidden" name="typefile" value="img" >
                                                <input id="inputPateP2" class="hidden" name="path" value="">
                                                <button type="submit" class="btn btn-success">SAVE</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                            </div>

                        </div>
                    <?PHP endif;?>


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
                                            <div class="form-group">
                                                <?php if($editP2): ?>
                                                    <form action="user-project-manage.php?id=<?=$id?>" method="post">
                                                        <input class="hidden" name="fn" value="deleteUpload">
                                                        <input class="hidden" name="typefile" value="video">
                                                        <input class="hidden" name="upload_id" value="<?=$item['id'];?>">
                                                        <input class="hidden" name="phase_id" value="<?=$item['phase_id'];?>">
                                                        <input class="hidden" name="name" value="<?=$item['namefile'];?>">
                                                        <input class="hidden" name="user_id" value="<?=$_SESSION['id'];?>">
                                                        <button class="btn btn-danger btn-xs" type="submit">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </form>
                                                <?php endif; ?>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            <?php endforeach; ?>
                            </tbody>
                        </table>

                    </div>
                    <?PHP if($editP2): ?>
                        <div id="uploadVideoP2">

                            <div id="loadFileVideoP2" class="text-center">
                                <div class="form-inline hide" id="p2_show_progressBar_video">
                                    <div class="progress" style="float:left; width: 90%; margin-right: 5px;">
                                        <div id="p2_progressBar_video" class="progress-bar" role="progressbar"
                                             aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"
                                             style="width: 0%;">
                                            0%
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-danger btn-xs"
                                            onclick="cancelUploadFileP2('video')">
                                        <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                    </button>
                                </div>
                                <div id="video">
                                    <div class="box-img-ready">

                                        <label style="cursor: pointer;" for="upload_youtube" onclick="showLoadYoutubeP2();">
                                            <h3><span class="label label-danger"><i class="fa fa-youtube"></i> Youtube Upload</span></h3>
                                            <input id="upload_youtube" type="text" style="display:none;">
                                        </label>

                                        <label style="cursor: pointer;" for="p2_file_video">
                                            <h3 id="p2_upload_video"><span class="label label-info"><i class="fa fa-upload"></i> Video Upload</span></h3>
                                            <input id="p2_file_video" accept="video/mp4" type="file" style="display:none;" onchange="showLoadVideoP2(this)">
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div id="saveLoadFileVideoP2" class="hidden">
                                <div class="row">
                                    <div class="col-xs-6 col-md-4 col-md-offset-4">

                                        <div class="embed-responsive embed-responsive-16by9">
                                            <iframe id="videoShowP2" class="embed-responsive-item" src="" ></iframe>
                                        </div>

                                    </div>
                                </div>

                                <div class="row" style="padding-top: 20px;">
                                    <form class="form-horizontal" action="user-project-manage.php?id=<?=$PROJECT['id'];?>" method="post">
                                        <div class="form-group">
                                            <label for="nameVideoP2" class="col-sm-4 control-label">รายละเอียดภาพ</label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" id="nameVideoP2" name="namefile" placeholder="รายละเอียดภาพ">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-offset-4 col-sm-6">
                                                <input class="hidden" name="fn" value="saveVideoP2" >
                                                <input class="hidden" name="phase_id" value="<?=$PHASE2['id'];?>" >
                                                <input class="hidden" name="user_id" value="<?=$_SESSION['id'];?>" >
                                                <input class="hidden" name="typefile" value="video" >
                                                <input id="inputVideoP2" class="hidden" name="path" value="">
                                                <button type="submit" class="btn btn-success">SAVE</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                            </div>

                        </div>
                    <?PHP endif; ?>
                </div>


                <div class="text-right" style="padding-top: 20px; padding-bottom: 10px;">
                    <button class="btn btn-primary" data-toggle="modal" data-target=".moddalLogPhase2">
                        ข้อมูลการอัพงาน
                    </button>
                </div>

            </div>
        <?php endif; ?>
    <?php endif; ?>

</div>

<script>
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

    function showLoadYoutubeP2() {
        $('#input_youtube').val('');
        $('.moddalURLYoutubeP2').modal();
    }
    function addUrlYoutubeP2() {
        var src = $('#input_youtube').val();
        var src = cutUrlYoutube(src);
        if(src=='no'){
            alert("กรุณาตรวจสอบ URL");
        }else{
            $('#loadFileVideoP2').addClass('hidden');
            $('#saveLoadFileVideoP2').removeClass('hidden');
            $('#nameVideoP2').val('youtube');
            $('#videoShowP2').attr('src',src);
            $('#inputVideoP2').attr('value',src);
        }
    }
    function cutUrlYoutube(str) {
        var str2 = "embed";
        if(str.indexOf(str2) != -1){
            return str;
        }else{
            var cut = str.split('?v=');
            if(cut.length >1){
                return 'https://www.youtube.com/embed/'+cut['1'];
            }else{
                return 'no';
            }
        }
    }
</script>
<!--    modal youtube phase 2 -->
<div class="modal fade moddalURLYoutubeP2" tabindex="-1" role="dialog" aria-labelledby="myLargeModalURLYoutubeP2">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myLargeModalURLYoutubeP2">URL Youtube</h4>
            </div>
            <div class="modal-body">
                <input class="form-control" id="input_youtube" type="text" value="">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-dismiss="modal" onclick="addUrlYoutubeP2();">บันทึก</button>
            </div>
        </div>
    </div>
</div>
