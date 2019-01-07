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
$id=1;
include "controller/adminCheck.php"
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
                <div class="box-card">
                    <div class="text-left">
                        <h3>โครงการ <?=$PROJECTSETUP['name'];?> </h3>
                    </div>
                    <hr>

                    <div>
                        <ul class="nav nav-tabs nav-justified" role="tablist">
                            <li role="presentation" class="active">
                                <a href="#phase1" aria-controls="phase1" role="tab" data-toggle="tab">เสนอแนวคิด (<?=count($PHASE1);?>)</a>
                            </li>
                            <li role="presentation">
                                <a href="#confirm1" aria-controls="confirm1" role="tab" data-toggle="tab">เข้าอบรม (<?=count($CONFIRM1);?>)</a>
                            </li>
                            <li role="presentation">
                                <a href="#phase2" aria-controls="phase2" role="tab" data-toggle="tab">ส่ง video (<?=count($PHASE2);?>)</a>
                            </li>
                            <li role="presentation">
                                <a href="#confirm2" aria-controls="confirm2" role="tab" data-toggle="tab">เข้าร่วมรอบชิง (<?=count($CONFIRM2);?>)</a>
                            </li>
                            <li role="presentation">
                                <a href="#phase3" aria-controls="phase3" role="tab" data-toggle="tab">เอกสารรอบชิง (<?=count($PHASE3);?>)</a>
                            </li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content" style="padding-top: 20px; padding-bottom: 20px;">
                            <div role="tabpanel" class="tab-pane active" id="phase1" style="min-height: 450px;">

                                <table class="table table-striped table-bordered thisdatatable" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>โครงการ</th>
                                        <th>โรงเรียน</th>
                                        <th>ภาค</th>
                                        <th>status</th>
                                        <th>จัดการ</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($PHASE1 as $item): ?>
                                        <tr>
                                            <td><?=$item['name']; ?></td>
                                            <td><?=$item['schoolname']; ?></td>
                                            <td><?=$item['schoolregion']; ?></td>
                                            <td class="text-center">
                                                <?php
                                                if($item['result']=='none'){
                                                    echo '<p class="bg-info" style="padding-top: 5px; padding-bottom: 5px;">ยังไม่ส่งเอกสาร</p>';
                                                }elseif($item['result']=='process'){
                                                    echo '<p class="bg-primary" style="padding-top: 5px; padding-bottom: 5px;">กำลังดำเนินการ</p>';
                                                }elseif($item['result']=='wait'){
                                                    echo '<p class="bg-warning" style="padding-top: 5px; padding-bottom: 5px;">รอตรวจสอบ</p>';
                                                }elseif($item['result']=='fail'){
                                                    echo '<p class="bg-danger" style="padding-top: 5px; padding-bottom: 5px;">ไม่ผ่าน</p>';
                                                }elseif($item['result']=='pass'){
                                                    echo '<p class="bg-success" style="padding-top: 5px; padding-bottom: 5px;">ผ่าน</p>';
                                                }
                                                ?>
                                            </td>
                                            <td class="text-center">
                                                <a href="admin-check-manage.php?id=<?=$item['id'];?>" class="btn btn-primary btn-sm"><i class="fa fa-check-square"></i> ตรวจ </a>

                                                <button class="btn btn-danger btn-sm" onclick="modalDeleteProject(this);" <?= $role=='admin'?'':'disabled';?>
                                                attr_name = '<?=$item['name'];?>'
                                                attr_id ='<?=$item['id'];?>'>
                                                    <i class="fa fa-remove"></i> ลบ
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                    </tbody>
                                </table>

                            </div>
                            <div role="tabpanel" class="tab-pane" id="confirm1" style="min-height: 450px;">

                                <table class="table table-striped table-bordered thisdatatable" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>โครงการ</th>
                                        <th>โรงเรียน</th>
                                        <th>ภาค</th>
                                        <th>status</th>
                                        <th>จัดการ</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($CONFIRM1 as $item): ?>
                                        <tr>
                                            <td><?=$item['name']; ?></td>
                                            <td><?=$item['schoolname']; ?></td>
                                            <td><?=$item['schoolregion']; ?></td>
                                            <td class="text-center">
                                                <?php
                                                if($item['result']=='none'){
                                                    echo '<p class="bg-info" style="padding-top: 5px; padding-bottom: 5px;">ยังไม่ส่งเอกสาร</p>';
                                                }elseif($item['result']=='process'){
                                                    echo '<p class="bg-primary" style="padding-top: 5px; padding-bottom: 5px;">กำลังดำเนินการ</p>';
                                                }elseif($item['result']=='wait'){
                                                    echo '<p class="bg-warning" style="padding-top: 5px; padding-bottom: 5px;">รอตรวจสอบ</p>';
                                                }elseif($item['result']=='fail'){
                                                    echo '<p class="bg-danger" style="padding-top: 5px; padding-bottom: 5px;">ไม่ผ่าน</p>';
                                                }elseif($item['result']=='pass'){
                                                    echo '<p class="bg-success" style="padding-top: 5px; padding-bottom: 5px;">ผ่าน</p>';
                                                }
                                                ?>
                                            </td>
                                            <td class="text-center">
                                                <a href="admin-check-manage.php?id=<?=$item['id'];?>" class="btn btn-primary btn-sm"><i class="fa fa-check-square"></i> ตรวจ </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                    </tbody>
                                </table>

                            </div>
                            <div role="tabpanel" class="tab-pane" id="phase2" style="min-height: 450px;">
                                <table class="table table-striped table-bordered thisdatatable" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>โครงการ</th>
                                        <th>โรงเรียน</th>
                                        <th>ภาค</th>
                                        <th>status</th>
                                        <th>จัดการ</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($PHASE2 as $item): ?>
                                        <tr>
                                            <td><?=$item['name']; ?></td>
                                            <td><?=$item['schoolname']; ?></td>
                                            <td><?=$item['schoolregion']; ?></td>
                                            <td class="text-center">
                                                <?php
                                                if($item['result']=='none'){
                                                    echo '<p class="bg-info" style="padding-top: 5px; padding-bottom: 5px;">ยังไม่ส่งเอกสาร</p>';
                                                }elseif($item['result']=='process'){
                                                    echo '<p class="bg-primary" style="padding-top: 5px; padding-bottom: 5px;">กำลังดำเนินการ</p>';
                                                }elseif($item['result']=='wait'){
                                                    echo '<p class="bg-warning" style="padding-top: 5px; padding-bottom: 5px;">รอตรวจสอบ</p>';
                                                }elseif($item['result']=='fail'){
                                                    echo '<p class="bg-danger" style="padding-top: 5px; padding-bottom: 5px;">ไม่ผ่าน</p>';
                                                }elseif($item['result']=='pass'){
                                                    echo '<p class="bg-success" style="padding-top: 5px; padding-bottom: 5px;">ผ่าน</p>';
                                                }
                                                ?>
                                            </td>
                                            <td class="text-center">
                                                <a href="admin-check-manage.php?id=<?=$item['id'];?>" class="btn btn-primary btn-sm"><i class="fa fa-check-square"></i> ตรวจ </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="confirm2" style="min-height: 450px;">
                                <table class="table table-striped table-bordered thisdatatable" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>โครงการ</th>
                                        <th>โรงเรียน</th>
                                        <th>ภาค</th>
                                        <th>status</th>
                                        <th>จัดการ</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($CONFIRM2 as $item): ?>
                                        <tr>
                                            <td><?=$item['name']; ?></td>
                                            <td><?=$item['schoolname']; ?></td>
                                            <td><?=$item['schoolregion']; ?></td>
                                            <td class="text-center">
                                                <?php
                                                if($item['result']=='none'){
                                                    echo '<p class="bg-info" style="padding-top: 5px; padding-bottom: 5px;">ยังไม่ส่งเอกสาร</p>';
                                                }elseif($item['result']=='process'){
                                                    echo '<p class="bg-primary" style="padding-top: 5px; padding-bottom: 5px;">กำลังดำเนินการ</p>';
                                                }elseif($item['result']=='wait'){
                                                    echo '<p class="bg-warning" style="padding-top: 5px; padding-bottom: 5px;">รอตรวจสอบ</p>';
                                                }elseif($item['result']=='fail'){
                                                    echo '<p class="bg-danger" style="padding-top: 5px; padding-bottom: 5px;">ไม่ผ่าน</p>';
                                                }elseif($item['result']=='pass'){
                                                    echo '<p class="bg-success" style="padding-top: 5px; padding-bottom: 5px;">ผ่าน</p>';
                                                }
                                                ?>
                                            </td>
                                            <td class="text-center">
                                                <a href="admin-check-manage.php?id=<?=$item['id'];?>" class="btn btn-primary btn-sm"><i class="fa fa-check-square"></i> ตรวจ </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="phase3" style="min-height: 450px;">
                                <p> <table class="table table-striped table-bordered thisdatatable" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>โครงการ</th>
                                        <th>โรงเรียน</th>
                                        <th>ภาค</th>
                                        <th>status</th>
                                        <th>จัดการ</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($PHASE3 as $item): ?>
                                        <tr>
                                            <td><?=$item['name']; ?></td>
                                            <td><?=$item['schoolname']; ?></td>
                                            <td><?=$item['schoolregion']; ?></td>
                                            <td class="text-center">
                                                <?php
                                                if($item['result']=='none'){
                                                    echo '<p class="bg-info" style="padding-top: 5px; padding-bottom: 5px;">ยังไม่ส่งเอกสาร</p>';
                                                }elseif($item['result']=='process'){
                                                    echo '<p class="bg-primary" style="padding-top: 5px; padding-bottom: 5px;">กำลังดำเนินการ</p>';
                                                }elseif($item['result']=='wait'){
                                                    echo '<p class="bg-warning" style="padding-top: 5px; padding-bottom: 5px;">รอตรวจสอบ</p>';
                                                }elseif($item['result']=='fail'){
                                                    echo '<p class="bg-danger" style="padding-top: 5px; padding-bottom: 5px;">ไม่ผ่าน</p>';
                                                }elseif($item['result']=='pass'){
                                                    echo '<p class="bg-success" style="padding-top: 5px; padding-bottom: 5px;">ผ่าน</p>';
                                                }
                                                ?>
                                            </td>
                                            <td class="text-center">
                                                <a href="admin-check-manage.php?id=<?=$item['id'];?>" class="btn btn-primary btn-sm"><i class="fa fa-check-square"></i> ตรวจ </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                    </tbody>
                                </table></p>
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

    function modalDeleteProject(_this) {
        var name = $(_this).attr('attr_name');
        var id = $(_this).attr('attr_id');
        $('#textDeleteProject').html(name);
        $('#modalDeleteProjectId').val(id);

        $('.modalDeleteProject').modal();
    }
</script>



<!--    modal delete Project -->
<div class="modal fade modalDeleteProject" tabindex="-1" role="dialog" aria-labelledby="myLargeModalDeleteProject">
    <div class="modal-dialog modal-lg" role="document">
        <form class="modal-content" method="post">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myLargeModalDeleteProject">ยืนยันการโครงการ</h4>
            </div>
            <div class="modal-body">
                <p>ยืนยันการลบข้อมูล <strong id="textDeleteProject"> </strong></p>

                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="check" required> ยืนยันการลบโปรเจค
                    </label>
                </div>
            </div>
            <div class="modal-footer">
                <input name="fn" value="deleteProject" type="text" hidden>
                <input id="modalDeleteProjectId" name="project_id" value="" type="text" hidden>
                <button type="submit" class="btn btn-danger">ยันยัน</button>
            </div>
        </form>
    </div>
</div>


</body>
</html>
