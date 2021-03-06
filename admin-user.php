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
$m_li = 'user';
$id=1;
include __DIR__."/controller/adminUser.php"
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
                        <h3>จัดการสมาชิก</h3>
                    </div>
                    <hr>

                    <?php require_once __DIR__.'/_alert.php'; ?>

                    <div>
                        <table id="thisdatatable" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                            <tr>
                                <th>username</th>
                                <th>ชื่อ</th>
                                <th>สกุล</th>
                                <th>โรงเรียน</th>
                                <th>ภาค</th>
                                <th>สถานะ</th>
                                <th style="width: 18%;">เพิ่ม</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($USER as $item): ?>
                                <tr>
                                    <td><?=$item['username']; ?></td>
                                    <td><?=$item['name']; ?></td>
                                    <td><?=$item['surname']; ?></td>
                                    <td><?=$item['schoolname']; ?></td>
                                    <td><?=$item['schoolregion']; ?></td>
                                    <td><?=$item['role']; ?></td>
                                    <td class="text-center">

                                        <a href="admin-user-edit.php?id=<?=$item['id'];?>" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i> แก้ไข </a>

                                        <div class="form-group">
                                              <button class="btn btn-danger btn-sm" type="button" onclick="deleteConfirm('<?php echo $item['id'];?>','<?php echo $item['username'];?>');" <?= $role=='admin'?'':'disabled';?>><i class="fa fa-remove"></i> ลบ </button>
                                        </div>

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

<?php require_once __DIR__.'/_modalDeleteConfirm.php';?>

<script>
    $(document).ready(function () {
        $('#thisdatatable').DataTable();
    });

    function deleteConfirm(id,text) {
        var fn_name = 'deleteUser';
        var fn_text = text;
        var fn_id = id;
        setModalDelete(fn_name,fn_text,fn_id);
    }

</script>



</body>
</html>
