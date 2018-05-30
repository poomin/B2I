<?php
session_start();
$SETID = 1;
/**
 * Created by PhpStorm.
 * User: Gimo
 * Date: 29/5/2561
 * Time: 11:30
 */
$m_nev = '';
$m_li = 'team';

require_once __DIR__ . '/controller/userTeamCreate.php';
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
<div id="card">
    <div class="container" style="padding-top: 40px; padding-bottom: 20px;">
        <div class="row">

            <div class="col-xs-12 col-sm-3">
                <div class="box-card">
                    <?php include '_user.php' ?>
                </div>
            </div>

            <div class="col-xs-12 col-sm-9">
                <div class="box-card">

                    <?php if (isset($_SESSION['error'])): ?>
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                            <strong>Warning!</strong> <?php echo $_SESSION['error']; ?>
                        </div>
                        <?php unset($_SESSION['error']); endif; ?>

                    <div class="form-inline">
                        <h3>สร้างทีม / โครงการ</h3>
                    </div>
                    <hr>
                    <div>

                        <form class="form-horizontal">
                            <div class="form-group">
                                <label for="projectHead" class="col-sm-2 control-label">โครงการ</label>
                                <div class="col-sm-10">
                                    <select class="form-control" id="projectHead" name="projectsetup_id">
                                        <?php if (isset($projectSetup['id'])): ?>
                                            <option value="<?= $projectSetup['id']; ?>"><?= $projectSetup['name']; ?></option>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="projectName" class="col-sm-2 control-label">หัวข้อโปรเจค</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="projectName" name="name"
                                           placeholder="หัวข้อโปรเจค" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">หัวหน้า</label>
                                <div class="col-sm-10">
                                    <label class="control-label"> <?=$_SESSION['name'].' '.$_SESSION['surname'];?></label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">สมาชิก</label>
                                <div class="col-sm-10">
                                    <label class="control-label" id="memberShow">
                                    </label>
                                    <br>
                                    <p class="btn btn-success btn-xs" data-toggle="modal" data-target=".bs-example-modal-lg"><i class="fa fa-plus"></i></p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="schoolname" class="col-sm-2 control-label">โรงเรียน</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="schoolname" name="schoolname"
                                           placeholder="โรงเรียน" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="schoolregion" class="col-sm-2 control-label">ภาค</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="schoolregion">
                                        <option value="กลาง">กลาง</option>
                                        <option value="เหนือ">เหนือ</option>
                                        <option value="ตะวันออก">ตะวันออก</option>
                                        <option value="ตะวันตก">ตะวันตก</option>
                                        <option value="ตะวันออกเฉียงเหนือ">ตะวันออกเฉียงเหนือ</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="projectDetail" class="col-sm-2 control-label">รายละเอียดเพิ่มเติม</label>
                                <div class="col-sm-10">
                                    <textarea rows="4" class="form-control" id="projectDetail" name="detail"></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10 text-center">
                                    <input id="memberall" class="hidden" name="member" value="">
                                    <input class="hidden" name="fn" value="addProject">
                                    <input class="hidden" name="user_id"
                                           value="<?php echo isset($_SESSION['id']) ? $_SESSION['id'] : 0; ?>">
                                    <button type="submit" class="btn btn-lg sr-button btn-success">SAVE</button>
                                </div>
                            </div>
                        </form>


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

<div id="modalMember" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="gridSystemModalLabel"> สมาชิก </h4>
            </div>
            <div class="modal-body">
                <table id="thisdatatable" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                    <tr>
                        <th>id</th>
                        <th>ชื่อ</th>
                        <th>สกุล</th>
                        <th>โรงเรียน</th>
                        <th>เพิ่ม</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($USER as $item): ?>
                        <tr>
                            <td><?=$item['id']; ?></td>
                            <td><?=$item['name']; ?></td>
                            <td><?=$item['surname']; ?></td>
                            <td><?=$item['schoolname']; ?></td>
                            <td class="text-center">
                                <button onclick="addMember('<?=$item['id'];?>','<?=$item['name'].' '.$item['surname'];?>')" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> เพิ่ม </>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<?php include '_script.php'; ?>
<?php include '_datatablescript.php';?>
<script>

    $(document).ready(function () {

        $('#thisdatatable').DataTable();
    });

    function addMember(id,fullname) {
        if(addValueIdMember(id)){
            var str= '';
            str+= '<p id="member'+id+'"> '+fullname ;
            str+=' <i class="fa fa-close i-close" onclick="deleteMember('+id+')" ></i></p>';
            $('#memberShow').append(str);
        }
        $('#modalMember').modal('hide');
    }
    function deleteMember(id) {
        $('#member'+id).remove();
        deleteValueIdMember(id);
    }


    function addValueIdMember(id) {
        var id_all = $('#memberall').val();
        var id_list = '';
        if(id_all==""){
            $('#memberall').attr("value",id);
            return true;
        }else{
            var cut = id_all.split("-");
            if(cut.indexOf(id)<0){
                id_all+='-'+id;
                $('#memberall').attr("value",id_all);
                return true;
            }else{
                return false;
            }
        }
    }
    function deleteValueIdMember(id) {
        var id_all = $('#memberall').val();
        var cut = id_all.split("-");
        var check = true;
        if(cut.length<=1){
            $('#memberall').attr("value","");
        }else{
            var str = '';
            var cut_id = '';
            for(var i=0;i<cut.length;i++){
                cut_id = cut[i];
                if(cut_id!=id){
                    if(check){
                        check=false;
                        str+=''+cut_id;
                    }else{
                        str+='-'+cut_id;
                    }
                }
            }
            $('#memberall').attr("value",str);
        }
    }


</script>

</body>
</html>
