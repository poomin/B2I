<?php
session_start();
/**
 * Created by PhpStorm.
 * User: EPOP
 * Date: 7/9/2018
 * Time: 11:05 AM
 */
if (isset($_SESSION['supper_admin'])) {
    if ($_SESSION['supper_admin']) {

    } else {
        header("Location: /user-profile.php");
    }
} else {
    header("Location: /user-profile.php");
}

$ATTRIBUTES = [];
$TABLELIST = [];
$TABLETHIS = '';
require_once __DIR__ . "/controller/_phpMyAdminController.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>B2I-Information</title>

    <!-- Bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
    <!-- Bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <!--Bootstrap call out css -->
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-callout.css">
    <!-- Font Awesome icons -->
    <link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <?php include '_datatablecss.php' ;?>

</head>
<body>

<div class="col-md-offset-1 col-md-10">
    <div class="text-center">
        <h4 class="page-header"><a href="/user-profile.php"><i class="fa fa-home"></i></a> Cherry My Database </h4>
    </div>

    <div class="row">
        <div class="col-md-3">
            <div class="page-header text-center">
                <strong>Table</strong>
            </div>

            <div class="list-group">
                <?php foreach ($TABLELIST as $key => $item): ?>
                    <a href="/_phpMyAdmin.php?table=<?php echo $item[key($item)]; ?>"
                       class="list-group-item <?php echo ($item[key($item)] == $TABLETHIS) ? 'active' : ''; ?>"><?php echo $item[key($item)]; ?></a>
                <?php endforeach; ?>
            </div>

        </div>
        <div class="col-md-9">
            <div class="page-header">
                <strong><?php echo $TABLETHIS; ?></strong>
            </div>

            <div class="row">
                <ul class="nav nav-tabs" id="myTabs" role="tablist">
                    <li role="presentation" class="">
                        <a href="#attribute" id="attribute-tab" role="tab" data-toggle="tab"
                           aria-controls="attribute" aria-expanded="false">Attribute</a>
                    </li>
                    <li role="presentation" class="active">
                        <a href="#database" role="tab" id="database-tab"
                           data-toggle="tab" aria-controls="database"
                           aria-expanded="true">Database</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">

                    <div class="tab-pane fade" role="tabpanel" id="attribute" aria-labelledby="home-tab" style="margin: 20px;">
                        <table id="attributeTable" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Field</th>
                                <th>Type</th>
                                <th>Null</th>
                                <th>Key</th>
                                <th>Default</th>
                                <th>Extra</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($ATTRIBUTES as $key=>$item): ?>
                                <tr>
                                    <td><?=($key+1);?></td>
                                    <td><?=$item['Field']; ?></td>
                                    <td><?=$item['Type']; ?></td>
                                    <td><?=$item['Null']; ?></td>
                                    <td><?=$item['Key']; ?></td>
                                    <td><?=$item['Default']; ?></td>
                                    <td><?=$item['Extra']; ?></td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="tab-pane fade active in" role="tabpanel" id="database" aria-labelledby="database-tab"  style="margin: 20px;">
                        <table id="dataTable" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <?php foreach ($ATTRIBUTES as $item): ?>
                                    <th><?=$item['Field'];?></th>
                                <?php endforeach; ?>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($DATALIST as $item): ?>
                                <tr>
                                    <?php foreach ($ATTRIBUTES as $i): ?>
                                        <td>
                                            <?php
                                            $detail = $item[$i['Field']];
                                            $detail = strip_tags($detail);
                                            if(strlen($detail)>100){
                                                echo "Text More ...";
                                            }else{
                                                echo $detail;
                                            }
                                            ?>
                                        </td>
                                    <?php endforeach; ?>
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

</body>

<!-- Jquery -->
<script type="text/javascript" src="js/jquery.min.js"></script>
<!-- Bootstrap core Javascript -->
<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>


<?php include '_datatablescript.php';?>
<script>
    $(document).ready(function () {
        $('#attributeTable').DataTable({
            "pageLength": 50,
            "bPaginate": false,
            "bInfo": false,
            "searching": false,
        });

        $('#dataTable').DataTable({
            "scrollX": true
        });
    });
</script>

</html>

