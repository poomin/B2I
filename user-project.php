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
$m_li = 'project';

$user_id = isset($_SESSION['id'])?$_SESSION['id']:'';
$role = isset($_SESSION['role'])?$_SESSION['role']:'';
require_once __DIR__.'/controller/userProject.php';
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
                        <label><h3>จัดการโปรเจค</h3></label>
                    </div>
                    <hr>
                    <div>


                        <table id="thisdatatable" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                            <tr>
                                <th>โปรเจค</th>
                                <th>โรงเรียน</th>
                                <th>ภาค</th>
                                <th>ขั้นตอน</th>
                                <th>สถานะ</th>
                                <th>จัดการ</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($PROJECT as $item): ?>
                            <tr>
                                <td><?=$item['name']; ?></td>
                                <td><?=$item['schoolname']; ?></td>
                                <td><?=$item['schoolregion']; ?></td>
                                <td><?=$item['status']; ?></td>
                                <td>
                                    <?php
                                        $classAlert = "";
                                        if($item['type']=='fail'){
                                            $classAlert = 'alert-danger';
                                        }
                                        elseif ($item['type']=='pass'){
                                            $classAlert = 'alert-success';
                                        }
                                        elseif ($item['type']=='wait'){
                                            $classAlert = 'alert-warning';
                                        }
                                        elseif ($item['type']=='check'){
                                            $classAlert = 'alert-info';
                                        }
                                        elseif ($item['type']=='process'){
                                            $classAlert = 'alert-info';
                                        }
                                    ?>
                                    <div class="alert <?=$classAlert; ?>" role="alert">
                                        <?=$item['message']; ?>
                                    </div>

                                </td>
                                <td class="text-center">
                                    <a href="user-project-manage.php?id=<?=$item['id'];?>" class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o"></i> จัดการโปรเจค </a>

                                    <?php if($role=='teacher'): ?>
                                    <button class="btn btn-danger btn-sm" onclick="modalDeleteProject(this);"
                                            attr_name = '<?=$item['name'];?>'
                                            attr_id ='<?=$item['id'];?>'>
                                        <i class="fa fa-remove"></i> ลบ
                                    </button>
                                    <?php endif; ?>

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
