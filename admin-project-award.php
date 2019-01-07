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
$m_li = 'award';

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
                    <div class="text-center">
                        <h3>รางวัล</h3>
                    </div>
                    <hr>

                    <div id="editor">
                        <div id='edit' style="margin-top: 30px;">

                        </div>
                    </div>

                    <div class="text-center" style="padding-top: 20px;">
                        <button type="submit" class="btn btn-lg sr-button btn-success" onclick="saveText()" <?= $role=='admin'?'':'disabled';?> >SAVE</button>
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

    function getText() {
        var id = $('#card').attr('attr');
        var req = $.ajax({
            type: 'POST',
            url: './controller/Service.php',
            data: {
                fn: 'getProjectById',
                id: id,
            },
            dataType: 'JSON'
        });
        req.done(function (res) {
            if(res.status){
                var text = res.data.award;
                $('#edit').froalaEditor('html.set',text);
            }else{
                alert('get data false!!!!');
            }
        });

    }

    function saveText() {
        var text = $('#edit').froalaEditor('html.get');
        var id = $('#card').attr('attr');
        var req = $.ajax({
            type: 'POST',
            url: './controller/Service.php',
            data: {
                fn: 'addDetailProject',
                detail: 'award',
                text: text,
                id: id,
            },
            dataType: 'JSON'
        });
        req.done(function (res) {
            if(res.status){
                alert('save data complete...');
            }else{
                alert('save data false!!!!');
            }
        });
    }
</script>
</body>
</html>
