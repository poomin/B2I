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
$m_li = 'team';
$user_id = isset($_SESSION['id'])?$_SESSION['id']:'';
require_once __DIR__.'/controller/userTeam.php';
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

                    <?php if(isset($_SESSION['success'])): ?>
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <strong>Success. </strong> <?php echo $_SESSION['success']; ?>
                        </div>
                        <?php unset($_SESSION['success']);
                    endif; ?>

                    <div class="form-inline">
                        <label><h3> ทีม / โครงการ </h3></label>
                        <a href="user-team-create.php" class="btn btn-success"><i class="fa fa-plus"></i> สร้างทีม/โครงการ</a>
                    </div>
                    <hr>
                    <div>


                        <table id="thisdatatable" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                            <tr>
                                <th>โปรเจค</th>
                                <th>โรงเรียน</th>
                                <th>ภาค</th>
                                <th>จัดการ</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($PROJECT as $item): ?>
                            <tr>
                                <td><?=$item['name']; ?></td>
                                <td><?=$item['schoolname']; ?></td>
                                <td><?=$item['schoolregion']; ?></td>
                                <td class="text-center">
                                    <a href="user-team-manage.php?id=<?=$item['id'];?>" class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o"></i> จัดการทีม/โครงการ </a>
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
