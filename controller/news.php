<?php
/**
 * Created by PhpStorm.
 * User: Gimo
 * Date: 31/5/2561
 * Time: 23:57
 */
include_once __DIR__.'/ModelPost.php';
$MP = new ModelPost();
$NEWS = [];
$TOPNEWS = [];
$ALLPAGE = 1;

$page= isset($_REQUEST['page'])?$_REQUEST['page']:1;
$type = isset($_REQUEST['type'])?$_REQUEST['type']:'';
$result = $MP->getPostPage($page,$type);
if(count($result)>0){
    $NEWS=$result;
    $countPage = $MP->getPostPageCount($type);
    $ALLPAGE = intval($countPage/5);
    $ALLPAGE = $countPage%5==0?$ALLPAGE:$ALLPAGE+1;
}

$result = $MP->getTopPost(2);
if(count($result) > 0){
    $TOPNEWS = $result;
}