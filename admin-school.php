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
$m_li = 'school';
include __DIR__."/controller/adminSchool.php"
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include '_header.php'; ?>
    <?php include '_datatablecss.php' ;?>
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
                    <div class="text-left">
                        <h3>จัดการโรงเรียน
                        <p class="btn btn-success btn-xs" data-toggle="modal" data-target=".bs-example-modal-lg"><i class="fa fa-plus"></i></p>
                        </h3>
                    </div>
                    <hr>

                    <div>
                        <table id="thisdatatable" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>โรงเรียน</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($SCHOOL as $key=>$item): ?>
                                <tr>
                                    <td><?=($key+1); ?></td>
                                    <td><?=$item['school_name']; ?></td>
                                    <td class="text-center">
                                        <form method="post">
                                            <input name="name" value="<?=$item['school_name'];?>" hidden>
                                            <input name="fn" value="deleteSchool" hidden>
                                            <button class="btn btn-danger btn-sm" type="submit"><i class="fa fa-remove"></i> ลบ </button>
                                        </form>
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
<?php include '_datatablescript.php';?>

<script>
    $(document).ready(function () {
        $('#thisdatatable').DataTable();
    });
</script>


<div id="modalMember" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog " role="document">
        <form class="modal-content" method="post">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="gridSystemModalLabel"> เพิ่มโรงเรียน </h4>
            </div>
            <div class="modal-body">
                <strong> โรงเรียน </strong>
                <input class="form-control" name="name" value="" required>
            </div>
            <div class="modal-footer">
                <input name="fn" value="insertSchool" hidden>
                <button type="submit" class="btn btn-success">บันทึก</button>
            </div>
        </form>
    </div>
</div>



</body>
</html>
