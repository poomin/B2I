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
$m_li = 'news';


$user_id = isset($_SESSION['id'])?$_SESSION['id']:'';
require_once __DIR__.'/controller/adminPost.php';
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

                    <?php require_once __DIR__.'/_alert.php'; ?>

                    <div class="form-inline">
                        <label><h3> ข่าว / ประกาศ / ผลงาาน </h3></label>
                        <a href="admin-news-create.php" class="btn btn-success"><i class="fa fa-plus"></i> สร้างข่าว/ประกาศ/ผลงาน</a>
                    </div>
                    <hr>
                    <div class="">
                        <table id="thisdatatable" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                            <tr>
                                <th>ภาพ</th>
                                <th>หัวข้อ</th>
                                <th>ประเภท</th>
                                <th>จัดการ</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($POSTS as $item): ?>
                                <tr>
                                    <td class="text-center">
                                        <img src="<?=$item['path']; ?>" alt="image" class="img-thumbnail" style="height: 100px;">
                                    </td>
                                    <td><?=$item['title']; ?></td>
                                    <td>
                                        <?php
                                        if($item['type']=='news'){
                                            echo 'ข่าว';
                                        }elseif($item['type']=='announce'){
                                            echo 'ประกาศ';
                                        }else{
                                            echo 'บทความ';
                                        }
                                        ?>
                                    </td>
                                    <td class="text-center">
                                        <a href="admin-news-edit.php?id=<?=$item['id'];?>" class="btn btn-warning btn-sm"><i class="fa fa-pencil-square-o"></i> แก้ไข </a>
                                        <button class="btn btn-danger btn-sm" attr_news_id = "<?=$item['id'];?>" onclick="deleteConfirm('<?php echo $item['id'];?>','<?php echo $item['title'];?>');"><i class="fa fa-remove"></i> ลบ</button>
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

<?php require_once __DIR__.'/_modalDeleteConfirm.php';?>

<script>
    $(document).ready(function() {
        $('#thisdatatable').DataTable();
    } );

    function deleteConfirm(id,text) {
        var fn_name = 'deleteNews';
        var fn_text = text;
        var fn_id = id;
        setModalDelete(fn_name,fn_text,fn_id);
    }

</script>

</body>
</html>
