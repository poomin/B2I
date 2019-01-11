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

<!-- Header -->
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
                        <li class="lia <?= $type==''?'active':'';?>" onclick="activeMenuNevBar('');">
                            <i class="fa fa-book fa-2x"></i> ทั้งหมด
                        </li>
                        <li class="lia <?= $type=='news'?'active':'';?>" onclick="activeMenuNevBar('news');">
                            <i class="fa fa-newspaper-o sr-icons fa-2x"></i> ข่าว
                        </li>
                        <li class="lia <?= $type=='article'?'active':'';?>" onclick="activeMenuNevBar('article');">
                            <i class="fa fa-pencil-square sr-icons fa-2x"></i> บทความ
                        </li>
                        <li class="lia <?= $type=='announce'?'active':'';?>" id="li3" onclick="activeMenuNevBar('announce');">
                            <i class="fa fa-rss-square sr-icons fa-2x"></i> ประกาศ
                        </li>
                        <li class="lia <?= $type=='project'?'active':'';?>" onclick="activeMenuNevBar('project');">
                            <i class="fa fa-graduation-cap sr-icons fa-2x"></i> ผลงาน
                        </li>
                        <li></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>


    <div class="container">
        <div class="row">

            <!-- Blocks of Posts -->
            <div class="col-xs-12 col-sm-8 row">

                <?php foreach ($NEWS as $item): ?>

                    <div class="box-card post" style="margin-bottom: 20px;">
                        <div class="row">
                            <div class="col-sm-5">
                                <div class="post-heading">
                                    <img src="<?=$item['path'];?>" class="img-fluid" style="height: 100px; width: 180px;"alt="img">
                                </div>
                            </div>
                            <div class="col-sm-7" style="word-break: break-all;">
                                <div class="post-body">
                                    <h4><a href="index-news-detail.php?id=<?=$item['id'];?>"><strong><?=$item['title'];?></strong></a></h4>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="padding-top: 10px;">
                            <div class="post-footer">
                        <span>
                            <i class="fa fa-calendar"></i> <?=date_format(date_create($item['createat']),"d/m/Y");?>
                            <i class="fa fa-eye" style="padding-left: 10px;"></i> <?=$item['view'];?>
                            <i class="fa fa-comments" style="padding-left: 10px;"></i> <?=$item['comment'];?>
                            <i class="fa fa-pencil" style="padding-left: 10px;"></i>
                            <?php
                            $i_type = 'ประกาศ';
                            if($item['type']=='news'){
                                $i_type='ข่าว';
                            }elseif($item['type']=='article'){
                                $i_type='บทความ';
                            }elseif ($item['type']=='project'){
                                $i_type='ผลงานส่งเข้าประกวด';
                            }
                            echo $i_type;
                            ?>
                        </span>
                            </div>
                        </div>
                    </div>

                <?php endforeach;?>

                <nav class="text-left">
                    <ul class="pagination">
                        <?php for($i=1;$i<=$ALLPAGE;$i++): ?>
                            <li class="<?= $i==$page?'active':'' ?>"><a href="index-news.php?page=<?=$i?><?=$type!=''?'&type='.$type:''?>"><?=$i;?></a></li>
                        <?php endfor;?>
                    </ul>
                </nav>

            </div>
            <!-- End of Blog Post -->

            <!-- Side bar -->
            <div class="col-xs-12 col-sm-4">
                <form class="form-horizontal">
                    <div class="input-group">
                        <input name="search" class="form-control" type="text" placeholder="Research">
                        <span class="input-group-btn">
                          <button class="btn" type="submit"><i class="fa fa-search"></i></button>
                       </span>
                    </div>
                </form>

                <h3>Top Posts</h3>

                <?php foreach ($TOPNEWS as $item): ?>
                    <div class="post" style="margin-top: 10px;">
                        <div class="post-heading">
                            <a href="index-news-detail.php?id=<?=$item['id'];?>">
                                <img class="img-responsive" src="<?=$item['path'];?>" alt="post's picture">
                            </a>
                        </div>
                        <div class="post-body">
                             <span>
                                <i class="fa fa-calendar"></i> <?=date_format(date_create($item['createat']),"d/m/Y");?>
                                 <i class="fa fa-eye" style="padding-left: 10px;"></i> <?=$item['view'];?>
                                 <i class="fa fa-comments" style="padding-left: 10px;"></i> <?=$item['comment'];?>
                                 <i class="fa fa-pencil" style="padding-left: 10px;"></i>
                                 <?php
                                 $i_type = 'ประกาศ';
                                 if($item['type']=='news'){
                                     $i_type='ข่าว';
                                 }elseif($item['type']=='article'){
                                     $i_type='บทความ';
                                 }elseif ($item['type']=='project'){
                                     $i_type='ผลงานส่งเข้าประกวด';
                                 }
                                 echo $i_type;
                                 ?>
                             </span>
                        </div>
                    </div>
                <?php endforeach;?>

            </div>
            <!-- End of Side bar -->

        </div>
    </div>

</div>

<!-- End of header -->


<footer>
    <?php include '_footer.php'; ?>
</footer>
<?php include '_script.php';?>

<script>
    function activeMenuNevBar(index) {
        var type = "?type="+index;
        console.log(''+type);
        window.open("index-news.php"+type , "_self");
    }
</script>

</body>
</html>
