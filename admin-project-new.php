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
$m_li = 'new';
require_once __DIR__.'/controller/adminProjectNew.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once __DIR__.'/_header.php'; ?>
    <?php require_once __DIR__.'/_datatablecss.php' ;?>
</head>

<body id="page-top">
<!-- Navigation Bar -->
<?php require_once __DIR__.'/_menunev.php'; ?>
<!-- End of Navigation Bar -->

<!-- Container Box -->
<div id="card" attr="<?php echo $SETID;?>">
    <div class="container" style="padding-top: 40px; padding-bottom: 20px;">
        <div class="row">

            <div class="col-xs-12 col-sm-3">
                <div class="box-card">
                    <?php include '_user.php'?>
                </div>
            </div>

            <div class="col-xs-12 col-sm-9">
                <div class="box-card">

                    <?php require_once __DIR__.'/_alert.php'; ?>

                    <div class="text-left">
                        <h3>โครงการทั้งหมด</h3>
                    </div>
                    <div class="text-right">
                        <form class="form-group" method="get" action="admin-project.php">
                            <input name="id" value="0" hidden>
                            <button class="btn btn-success btn-sm"><i class="fa fa-pencil"></i> สร้างโครงการใหม่ </button>
                        </form>
                    </div>
                    <hr>

                    <div>
                        <table id="thisdatatable" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>วันที่</th>
                                <th>โครงการ</th>
                                <th>สถานะ</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($ProjectSetup as $key=>$item): ?>
                                <tr>
                                    <td><?php echo ($key+1); ?></td>
                                    <td><?php echo date_format(date_create($item['createat']),"d/m/Y"); ?></td>
                                    <td><?php echo $item['name']; ?></td>
                                    <td <?php echo $item['active']=='Y'?'style="background-color: lightgreen;"':''; ?> >
                                        <?php echo $item['active']=='Y'?'กำลังดำเนินการ':'ปิดโครงการ'; ?>
                                        <button class="btn btn-info btn-sm" type="button" onclick="setModalActive('<?php echo $item['name']; ?>','<?php echo $item['id'];?>')">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                    </td>
                                    <td class="text-center">

                                        <form class="form-group" method="get" action="admin-project.php">
                                            <input name="id" value="<?php echo $item['id']; ?>" hidden>
                                            <button class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i> แก้ไข </button>
                                        </form>

                                        <form class="form-group">
                                            <button class="btn btn-danger btn-sm" type="button" onclick="deleteConfirm('<?php echo $item['id'];?>','<?php echo $item['name'];?>');"><i class="fa fa-remove"></i> ลบ </button>
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
    <?php require_once __DIR__.'/_footer.php'; ?>
</footer>
<?php require_once __DIR__.'/_script.php'; ?>
<?php require_once __DIR__.'/_datatablescript.php';?>

<?php require_once __DIR__.'/_modalDeleteConfirm.php';?>

<div class="modal fade" id="_modalConfirmActive" tabindex="-1" role="dialog" aria-labelledby="modalConfirmActive" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form class="modal-content" method="post">
            <div class="modal-header">
                <h5 class="modal-title" id="modalConfirmActive">Modal Active</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                คุณต้องการเปิดใช้งานโครงการนี้ โดยโครงการที่เปิดใช้งานจะสามารถเปิดได้ที่ละโครงการ การเปิด/ปิดโครงการจะส่งผลถึงข้อมูลการรับสมัครและการทำงานทั้งหมดของระบบ กรุณาตรวจสอบเพื่อความแน่ใจก่อนเปิดโครงการ
                <p id="modalConfirmActive_message"></p>

                <hr>
                <input id="modalConfirmActive_checkbox" type="checkbox" value="Y" onchange="checkboxConfirmActive();" > ยืนยันการเปิดโครงการ
            </div>
            <div class="modal-footer">
                <input id="modalConfirmActive_id" name="_id" value="" hidden>
                <input name="fn" value="confirm" hidden>
                <button id="modalConfirmActive_btn" type="submit" class="btn btn-primary" disabled>Active Project</button>
            </div>
        </form>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('#thisdatatable').DataTable();
    });

    function deleteConfirm(id,text) {
        var fn_name = 'deleteProject';
        var fn_text = 'โครงการ '+text;
        var fn_id = id;
        setModalDelete(fn_name,fn_text,fn_id);

    }


    function checkboxConfirmActive() {
        var check = $('#modalConfirmActive_checkbox').prop('checked');
        if(check){
            $('#modalConfirmActive_btn').removeAttr('disabled');
        }else {
            $('#modalConfirmActive_btn').attr('disabled',true);
        }
    }
    function setModalActive(text,id) {
        $('#modalConfirmActive_message').html(text);
        $('#modalConfirmActive_id').attr('value',id);

        $("#_modalConfirmActive").modal();

        $('#modalConfirmActive_checkbox').prop('checked',false);
        $('#modalConfirmActive_btn').attr('disabled',true);
    }

</script>

</body>
</html>
