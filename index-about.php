<?php
session_start();
$SETID=1;
/**
 * Created by PhpStorm.
 * User: Gimo
 * Date: 29/5/2561
 * Time: 11:30
 */
$m_nev = 'about';
include_once __DIR__.'/controller/about.php'
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include '_header.php'; ?>

    <link rel="stylesheet" href="froala/css/froala_style.css">
</head>

<body id="page-top">
<!-- Navigation Bar -->
<?php include '_menunev.php'; ?>
<!-- End of Navigation Bar -->

<!-- Principal Content Start -->
<div id="about">
    <div class="container" style="padding-top: 110px;">
        <div class="row">
            <div class="box-about col-xs-12 col-sm-8 col-sm-push-2">
                <i class="fa fa-phone-square sr-icons fa-4x"></i>
                <h4>ติดต่อเรา</h4>
                <div class="fr-view" style="padding-top: 20px;">
                    <?=$connect;?>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- End of Principal Content Start -->

<footer>
    <?php include '_footer.php'; ?>
</footer>
<?php include '_script.php';?>

</body>
</html>
