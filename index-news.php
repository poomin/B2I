<?php
session_start();
/**
 * Created by PhpStorm.
 * User: Gimo
 * Date: 29/5/2561
 * Time: 11:30
 */
$m_nev = 'news';

$page= isset($_REQUEST['page'])?$_REQUEST['page']:1;
include_once __DIR__.'/controller/news.php';

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

<!-- Principal Content Start -->
<div id="blog">
    <div class="container">
        <div class="row">

            <!-- Blocks of Posts -->
            <div class="col-xs-12 col-sm-8 row">
                <?php foreach ($NEWS as $item): ?>
                    <div class="col-xs-12 col-sm-12">
                    <div class="post">
                        <div class="post-heading">
                            <span><?=$item['createat'];?></span>
                            <img class="img-responsive" src="<?=$item['path'];?>" alt="image" style="height: 400px;">
                        </div>
                        <div class="post-body">
                            <h3><a href="index-news-detail.php?id=<?=$item['id'];?>"><strong><?=$item['type'];?></strong></a></h3>
                            <hr>
                            <p> <?=$item['title'];?> </p>
                        </div>
                        <div class="post-footer">
                            <a class="btn" href="index-news-detail.php?id=<?=$item['id'];?>">READ MORE...</a>
                            <span>
                                 <i class="fa fa-eye sr-icons"></i> <?=$item['view'];?>
                                 <i class="fa fa-comments sr-icons"></i> <?=$item['comment'];?>
                            </span>
                        </div>
                    </div>
                </div>
                <?php endforeach;?>

                <nav class="text-left">
                    <ul class="pagination">
                        <li class="active"><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#" aria-label="suivant">
                                <span aria-hidden="true">&raquo;</span>
                            </a></li>
                    </ul>
                </nav>

            </div>
            <!-- End of Blog Post -->

            <!-- Side bar -->
            <div class="col-xs-12 col-sm-4">
                <form class="form-horizontal">
                    <div class="input-group">
                        <input class="form-control" type="text" placeholder="Research">
                        <span class="input-group-btn">
                  <a href="" class="btn"><i class="fa fa-search"></i></a>
               </span>
                    </div>
                </form>
                <div class="panel">
                    <div class="panel-heading">
                        <h4>Categories</h4>
                    </div>
                    <div class="panel-body">
                        <ul class="nav">
                            <li><a href="#">Category I</a></li>
                            <li><a href="#">Category II</a></li>
                            <li><a href="#">Category III</a></li>
                            <li><a href="#">Category IV</a></li>
                            <li class="last"><a href="#">Category V</a></li>
                        </ul>
                    </div>
                </div>

                <h3>Recent Posts</h3>
                <hr>
                <div class="post">
                    <div class="post-heading">
                        <span>10 APRIL</span>
                        <img class="img-responsive" src="images/science2.jpg" alt="post's picture">
                    </div>
                    <div class="post-body">
                 <span>
                 <i class="fa fa-heart sr-icons"></i> 10
                 <i class="fa fa-comments sr-icons"></i> 10
                 </span>
                        <h4 class="text-left"><a href="single_post.html"><strong>Aliquam soluta</strong></a></h4>
                    </div>
                </div>
                <div class="post">
                    <div class="post-heading">
                        <span>12 MAY</span>
                        <img class="img-responsive" src="images/science1.jpg" alt="post's picture">
                    </div>
                    <div class="post-body">
                 <span>
                 <i class="fa fa-heart sr-icons"></i> 10
                 <i class="fa fa-comments sr-icons"></i> 10
                 </span>
                        <h4 class="text-left"><a href="single_post.html"><strong>Consequuntur</strong></a></h4>
                    </div>
                </div>
            </div>
            <!-- End of Side bar -->

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
