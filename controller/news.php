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

$page= isset($_REQUEST['page'])?$_REQUEST['page']:1;
$type = isset($_REQUEST['type'])?$_REQUEST['type']:'';
$result = $MP->getPostPage($page);
if(count($result)>0){
    $NEWS=$result;
}

$result = $MP->getTopPost(2);
if(count($result) > 0){
    $TOPNEWS = $result;
}