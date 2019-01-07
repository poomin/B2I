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

                    <?php require_once __DIR__.'/_alert.php';?>

                    <div>
                        <table id="thisdatatable" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th style="width: 40%;">โรงเรียน</th>
                                <th>ที่อยู่</th>
                                <th style="width: 18%">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($SCHOOL as $key=>$item): ?>
                                <tr>
                                    <td><?=($key+1); ?></td>
                                    <td><?=$item['school_name']; ?></td>
                                    <td>
                                        <?=$item['address'];?>
                                        ตำบล <?=$item['subdistrict'];?>
                                        อำเภอ <?=$item['district'];?>
                                        จังหวัด <?=$item['province'];?>
                                        <?=$item['code'];?>
                                    </td>
                                    <td class="text-center">
                                        <div class="form-group">
                                            <button class="btn btn-warning btn-sm" type="button"
                                                    attr_name = '<?=$item['school_name'];?>'
                                                    attr_address = '<?=$item['address'];?>'
                                                    attr_subdistrict = '<?=$item['subdistrict'];?>'
                                                    attr_district = '<?=$item['district'];?>'
                                                    attr_province = '<?=$item['province'];?>'
                                                    attr_code = '<?=$item['code'];?>'
                                                    onclick="modalEditSchool(this)"><i class="fa fa-edit"></i> แก้ไข </button>
                                        </div>
                                        <div class="form-group">
                                            <button class="btn btn-danger btn-sm" type="button" <?= $role=='admin'?'':'disabled';?>
                                                    onclick="deleteConfirm('<?=$item['school_name'];?>','<?=$item['school_name'];?>');">
                                                <i class="fa fa-remove"></i> ลบ </button>
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

<script>
    $(document).ready(function () {
        $('#thisdatatable').DataTable();
    });

    function modalEditSchool(_this) {
        var name = $(_this).attr('attr_name');
        var address = $(_this).attr('attr_address');
        var subdistrict = $(_this).attr('attr_subdistrict');
        var district = $(_this).attr('attr_district');
        var province = $(_this).attr('attr_province');
        var code = $(_this).attr('attr_code');

        $('#editName').val(name);
        $('#editAddress').val(address);
        $('#editSubdistrict').val(subdistrict);
        $('#editDistrict').val(district);
        $('#editProvince').val(province);
        $('#editCode').val(code);
        $('#id_name').val(name);

        $('#modalEditSchool').modal();
    }

    function deleteConfirm(id,text) {
        var fn_name = 'deleteSchool';
        var fn_text = 'โรงเรียน '+text;
        var fn_id = id;
        setModalDelete(fn_name,fn_text,fn_id);

    }

</script>


<div id="modalMember" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog " role="document">
        <form class="modal-content" method="post">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="gridSystemModalLabel"> เพิ่มโรงเรียน </h4>
            </div>
            <div class="modal-body form-horizontal">

                <div class="form-group">
                    <label for="addName" class="col-sm-2 control-label">โรงเรียน</label>
                    <div class="col-sm-10">
                        <input class="form-control" id="addName" name="name" value=""  type="text" placeholder="โรงเรียน" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="addAddress" class="col-sm-2 control-label">ที่อยู่</label>
                    <div class="col-sm-10">
                        <input class="form-control" id="addAddress" name="address" value="" type="text"  placeholder="ที่อยู่,ซอย,ถนน" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="addSubdistrict" class="col-sm-2 control-label">ตำบล</label>
                    <div class="col-sm-10">
                        <input class="form-control" id="addSubdistrict" name="subdistrict" value="" type="text" placeholder="ตำบล" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="addDistrict" class="col-sm-2 control-label">อำเภอ</label>
                    <div class="col-sm-10">
                        <input class="form-control" id="addDistrict" name="district" value="" type="text" placeholder="อำเภอ" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="addProvince" class="col-sm-2 control-label">จังหวัด</label>
                    <div class="col-sm-10">
                        <input class="form-control" id="addProvince" name="province" value="" type="text"  placeholder="จังหวัด" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="addCode" class="col-sm-2 control-label">รหัสไปรษณีย์</label>
                    <div class="col-sm-10">
                        <input class="form-control" id="addCode" name="code" value="" type="text"  placeholder="รหัสไปรษณีย์" required>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <input name="fn" value="insertSchool" hidden>
                <button type="submit" class="btn btn-success">บันทึก</button>
            </div>
        </form>
    </div>
</div>

<div id="modalEditSchool" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeEditSchool">
    <div class="modal-dialog " role="document">
        <form class="modal-content" method="post">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myLargeEditSchool"> แก้ไขโรงเรียน </h4>
            </div>
            <div class="modal-body form-horizontal">

                <div class="form-group">
                    <label for="editName" class="col-sm-2 control-label">โรงเรียน</label>
                    <div class="col-sm-10">
                        <input class="form-control" id="editName" name="name" value=""  type="text" placeholder="โรงเรียน" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="editAddress" class="col-sm-2 control-label">ที่อยู่</label>
                    <div class="col-sm-10">
                        <input class="form-control" id="editAddress" name="address" value="" type="text"  placeholder="ที่อยู่,ซอย,ถนน" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="editSubdistrict" class="col-sm-2 control-label">ตำบล</label>
                    <div class="col-sm-10">
                        <input class="form-control" id="editSubdistrict" name="subdistrict" value="" type="text" placeholder="ตำบล" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="editDistrict" class="col-sm-2 control-label">อำเภอ</label>
                    <div class="col-sm-10">
                        <input class="form-control" id="editDistrict" name="district" value="" type="text" placeholder="อำเภอ" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="editProvince" class="col-sm-2 control-label">จังหวัด</label>
                    <div class="col-sm-10">
                        <input class="form-control" id="editProvince" name="province" value="" type="text"  placeholder="จังหวัด" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="editCode" class="col-sm-2 control-label">รหัสไปรษณีย์</label>
                    <div class="col-sm-10">
                        <input class="form-control" id="editCode" name="code" value="" type="text"  placeholder="รหัสไปรษณีย์" required>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <input name="fn" value="editSchool" hidden>
                <input id="id_name" name="id_name" value="" hidden>
                <button type="submit" class="btn btn-warning">แก้ไข</button>
            </div>
        </form>
    </div>
</div>

<?php require_once __DIR__.'/_modalDeleteConfirm.php';?>



</body>
</html>
