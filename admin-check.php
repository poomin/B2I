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

                    <div class="">
                        <table id="thisdatatable" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                            <tr>
                                <th>โครงการ</th>
                                <th>โรงเรียน</th>
                                <th>ส่งเอกสารสมัคร</th>
                                <th>ส่งเอกสารนำเสนอ</th>
                                <th>จัดการ</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($PROJECTS as $item): ?>
                                <tr>
                                    <td><?=$item['name']; ?></td>
                                    <td><?=$item['schoolname']; ?></td>
                                    <td class="text-center">
                                        <?php
                                            if($item['phase1result']=='none'){
                                                echo '<p class="bg-info" style="padding-top: 5px; padding-bottom: 5px;">ยังไม่ส่งเอกสาร</p>';
                                            }elseif($item['phase1result']=='process'){
                                                echo '<p class="bg-primary" style="padding-top: 5px; padding-bottom: 5px;">กำลังดำเนินการ</p>';
                                            }elseif($item['phase1result']=='wait'){
                                                echo '<p class="bg-warning" style="padding-top: 5px; padding-bottom: 5px;">รอตรวจสอบ</p>';
                                            }elseif($item['phase1result']=='fail'){
                                                echo '<p class="bg-danger" style="padding-top: 5px; padding-bottom: 5px;">ไม่ผ่าน</p>';
                                            }elseif($item['phase1result']=='pass'){
                                                echo '<p class="bg-success" style="padding-top: 5px; padding-bottom: 5px;">ผ่าน</p>';
                                            }
                                        ?>
                                    </td>
                                    <td class="text-center">
                                        <?php
                                        if($item['phase2result']=='none'){
                                            echo '<p class="bg-info" style="padding-top: 5px; padding-bottom: 5px;">ยังไม่ส่งเอกสาร</p>';
                                        }elseif($item['phase2result']=='process'){
                                            echo '<p class="bg-primary" style="padding-top: 5px; padding-bottom: 5px;">กำลังดำเนินการ</p>';
                                        }elseif($item['phase2result']=='wait'){
                                            echo '<p class="bg-warning" style="padding-top: 5px; padding-bottom: 5px;">รอตรวจสอบ</p>';
                                        }elseif($item['phase2result']=='fail'){
                                            echo '<p class="bg-danger" style="padding-top: 5px; padding-bottom: 5px;">ไม่ผ่าน</p>';
                                        }elseif($item['phase2result']=='pass'){
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
        $('#thisdatatable').DataTable();
    } );
</script>


</body>
</html>
