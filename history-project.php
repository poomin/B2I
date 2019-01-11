<?php
session_start();
require_once __DIR__.'/_redirectUser.php';

/**
 * Created by PhpStorm.
 * User: Gimo
 * Date: 29/5/2561
 * Time: 11:30
 */
$m_nev = '';
$m_li = 'history';

$user_id = isset($_SESSION['id'])?$_SESSION['id']:'';
$role = isset($_SESSION['role'])?$_SESSION['role']:'';
require_once __DIR__.'/controller/historyProject.php';
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

                    <div class="form-inline">
                        <label><h3>จัดการโปรเจค</h3></label>
                    </div>
                    <hr>
                    <div>


                        <table id="thisdatatable" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>โครงการ</th>
                                <th>หัวข้อส่งเข้าประกวด</th>
                                <th>จัดการ</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($PROJECT as $key=>$item): ?>
                            <tr>
                                <td><?=($key+1) ?></td>
                                <td><?=$item['title']; ?></td>
                                <td><?=$item['name']; ?></td>
                                <td class="text-center">
                                    <a href="history-project-manage.php?id=<?=$item['id'];?>" class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o"></i> จัดการโปรเจค </a>
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
