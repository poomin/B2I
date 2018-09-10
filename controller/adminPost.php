<?php
/**
 * Created by PhpStorm.
 * User: EPOP
 * Date: 5/30/2018
 * Time: 2:16 PM
 */
require_once __DIR__.'/ModelPost.php';
$MP = new ModelPost();



$fn = isset($_REQUEST['fn'])?$_REQUEST['fn']:'';
if($fn=='deleteNews'){
    $news_id = isset($_REQUEST['news_id'])?$_REQUEST['news_id']:'';
    $result = $MP->deletePost($news_id);

}


$POSTS = [];
$result = $MP->getPostAll();
if(count($result)>0){
    $POSTS = $result;
}



