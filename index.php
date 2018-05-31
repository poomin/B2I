<?php
session_start();
/**
 * Created by PhpStorm.
 * User: Gimo
 * Date: 29/5/2561
 * Time: 11:30
 */
$m_nev = 'home';
require_once __DIR__.'/controller/index.php'
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include '_header.php'; ?>
</head>

<body id="page-top">
<!-- Navigation Bar -->
<?php include '_menunev.php'; ?>
<!-- End of Navigation Bar -->

<!-- Principal Content Start-->
<div id="about">

    <!-- Header -->
    <div class="row">
        <div class="col-xs-12 intro">
            <div class="carousel-inner">
                <div class="item active">
                    <img class="img-responsive" src="images/header.jpg" alt="header picture">
                </div>
            </div>
        </div>
    </div>
    <!-- End of header -->

    <!-- Container Box -->
    <div class="container">

        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <?php for ($i=0;$i<count($IMAGE);$i++):?>
                <li data-target="#carousel-example-generic" data-slide-to="<?=$i;?>" class="<?= $i==0?'active':'';?>"></li>
                <?php endfor; ?>
            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">

                <?php foreach ($IMAGE as $key=>$item): ?>
                <div class="item <?= $key==0?'active':'';?>">
                    <img src="<?=$item['path'];?>" alt="<?=$item['namefile'];?>">
                </div>
                <?php endforeach; ?>

            </div>

            <!-- Controls -->
            <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>


    </div>
    <!-- End of container Box -->
</div>
<!-- End of principal content -->


<footer>
    <?php include '_footer.php'; ?>
</footer>
<?php include '_script.php';?>

</body>
</html>
