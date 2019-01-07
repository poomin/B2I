<?php
session_start();
date_default_timezone_set("Asia/Bangkok");
/**
 * Created by PhpStorm.
 * User: Gimo
 * Date: 29/5/2561
 * Time: 11:30
 */
$m_nev = 'news';
require_once __DIR__.'/controller/newsDetail.php'

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
<div id="single">
    <div class="container">

        <!-- Full Article -->
        <div class="row">

            <div class="col-xs-12">
                <div class="text-center">
                    <img src="<?=$NEWS['path']; ?>" alt="image" class="img-thumbnail" style="height: 400px;">
                </div>
            </div>

            <h2><?=$NEWS['title']; ?></h2>
            <hr class="subtitle">
            <div class=" block1">
                <div class="col-xs-12 col-sm-12">
                    <div class="fr-view">
                        <?=$NEWS['details']; ?>
                    </div>
                    <hr>
                    <ul class="list-inline">
                        <li><?=date_format(date_create($NEWS['createat']),"d/m/Y H:m:s");?> |</li>
                        <li><a class="page-scroll" href="#form">COMMENT</a> |</li>
                        <li><i class="fa fa-eye sr-icons"></i> <?=$NEWS['view'];?></li>
                        <li><i class="fa fa-comments sr-icons"></i> <?=$NEWS['comment'];?></li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- End of Full Article -->

        <!-- Comments -->
        <div class="row">
            <div class="col-xs-12 col-sm-12 block2">

                <?php foreach ( $COMMENTS as $item): ?>
                <div class="comment">
                    <h4><?=$item['name'];?> <?=$item['surname'];?></h4>

                    <p class="time"><?=date_format(date_create($item['createat']),"d/m/Y H:m:s");?></p>
                    <hr>
                    <p><?=$item['details'];?></p>
                </div>
                <?php endforeach; ?>


                <hr class="line">

                <div id="form" class="col-xs-12 col-sm-6 col-sm-push-3">

                    <?php if(isset($_SESSION['id'])): ?>
                        <form class="form-horizontal" method="post" action="index-news-detail.php?id=<?=$NEWS['id'];?>">
                            <div class="form-group">
                                <div class="col-xs-12">
                                    <label class="label-control"><h4><?=$_SESSION['name'];?>  <?=$_SESSION['surname'];?></h4></label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-12">
                                    <label class="label-control">Type Your Comment</label>
                                    <textarea class="form-control" name="details"></textarea>
                                    <input class="hidden" name="fn" value="addComment">
                                    <input class="hidden" name="user_id" value="<?=$_SESSION['id'];?>">
                                    <input class="hidden" name="post_id" value="<?=$NEWS['id'];?>">
                                    <button type="submit" class="btn btn-lg btn-info sr-button">SEND</button>
                                </div>
                            </div>
                        </form>
                    <?php else: ?>
                        <div class="text-center">
                            <h3> <a href="index-login.php"> กรุณา Login </a> </h3>
                        </div>
                    <?php endif; ?>

                </div>

            </div>
        </div>
        <!-- End of Comments -->
    </div>
</div>
<!-- End of Principal Content Start -->



<footer>
    <?php include '_footer.php'; ?>
</footer>
<?php include '_script.php';?>

</body>
</html>
