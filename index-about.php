<?php
session_start();
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
    <div class="row">
        <div class="col-xs-12 intro">
            <div class="carousel-inner">
                <div class="item active">
                    <img class="img-responsive" src="<?php echo $img; ?>" alt="header picture">
                </div>
                <div class="carousel-menu">
                    <ul class="nav nav-pills nav-justified">
                        <li></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>



    <div class="container" style="padding-top: 10px;">
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
