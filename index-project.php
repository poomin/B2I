<?php
session_start();
$SETID=1;
/**
 * Created by PhpStorm.
 * User: Gimo
 * Date: 29/5/2561
 * Time: 11:30
 */
$m_nev = 'project';
include_once __DIR__.'/controller/project.php'
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

<!-- Principal Content Start-->
<div id="about">

    <!-- Header -->
    <div class="row">
        <div class="col-xs-12 intro">
            <div class="carousel-inner">
                <div class="item active">
                    <img class="img-responsive" src="<?php echo $img; ?>" alt="header picture">
                </div>
                <div class="carousel-menu">
                    <ul class="nav nav-pills nav-justified">
                        <li></li>
                        <li class="active lia" id="li1" onclick="activeMenuNevBar(1);"><i
                                    class="fa fa-street-view sr-icons fa-2x"></i> ผู้รับผิดชอบโครงการ
                        </li>
                        <li class="lia" id="li2" onclick="activeMenuNevBar(2);"><i
                                    class="fa fa-bank sr-icons fa-2x"></i> หลักการและเหตุผล
                        </li>
                        <li class="lia" id="li3" onclick="activeMenuNevBar(3);"><i
                                    class="fa fa-book sr-icons fa-2x"></i> วัตถุประสงค์
                        </li>
                        <li class="lia" id="li4" onclick="activeMenuNevBar(4);"><i
                                    class="fa fa-balance-scale sr-icons fa-2x"></i> ระเบียบเกณฑ์
                        </li>
                        <li class="lia" id="li5" onclick="activeMenuNevBar(5);"><i
                                    class="fa fa-money sr-icons fa-2x"></i> รางวัล
                        </li>
                        <li></li>
                    </ul>
                </div>
            </div>
        </div>

    </div>
    <!-- End of header -->

    <!-- Container Box -->
    <div class="container">
        <div class="row rowText" id="bodyText1">
            <div>
                <h4><i class="fa fa-street-view sr-icons fa-3x"></i> ผู้รับผิดชอบโครงการ</h4>
            </div>
            <div class="box-about">
                <div class="fr-view" style="padding-top: 10px;">
                    <?=$manager;?>
                </div>
            </div>
        </div>
        <div class="row rowText hidden" id="bodyText2">
            <div>
                <h4><i class="fa fa-bank sr-icons fa-3x"></i> หลักการและเหตุผล</h4>
            </div>
            <div class="box-about">
                <div class="fr-view" style="padding-top: 20px;">
                    <?=$rationale;?>
                </div>
            </div>
        </div>
        <div class="row rowText hidden" id="bodyText3">
            <div>
                <h4><i class="fa fa-book sr-icons fa-3x"></i> วัตถุประสงค์</h4>
            </div>
            <div class="box-about">
                <div class="fr-view" style="padding-top: 20px;">
                    <?=$objective;?>
                </div>
            </div>
        </div>
        <div class="row rowText hidden" id="bodyText4">
            <div>
                <h4><i class="fa fa-balance-scale sr-icons fa-3x"></i> ระเบียบเกณฑ์</h4>
            </div>
            <div class="box-about">
                <div class="fr-view" style="padding-top: 20px;">
                    <?=$criteria;?>
                </div>
            </div>
        </div>
        <div class="row rowText hidden" id="bodyText5">
            <div>
                <h4><i class="fa fa-money sr-icons fa-3x"></i> รางวัล</h4>
            </div>
            <div class="box-about">
                <div class="fr-view" style="padding-top: 20px;">
                    <?=$award;?>
                </div>
            </div>
        </div>

    </div>
    <!-- End of container Box -->
</div>
<!-- End of principal content -->

<footer>
    <?php include '_footer.php'; ?>
</footer>
<?php include '_script.php'; ?>
<script>
    function activeMenuNevBar(index) {
        $('.lia').removeClass('active');
        $('#li' + index).addClass('active');
        $('.rowText').addClass('hidden');
        $('#bodyText' + index).removeClass('hidden');
    }
</script>

</body>
</html>
