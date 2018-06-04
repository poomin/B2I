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
</script>

</body>
</html>
