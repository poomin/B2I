<?php
/**
 * Created by PhpStorm.
 * User: Gimo
 * Date: 31/5/2561
 * Time: 23:57
 */
include_once __DIR__.'/ModelPost.php';
include_once __DIR__.'/ModelComment.php';

$MP = new ModelPost();
$MC = new ModelComment();

$NEWS = [];
$COMMENTS = [];


$fn = isset($_REQUEST['fn'])?$_REQUEST['fn']:'';
if($fn=='addComment'){
    $user_id = isset($_REQUEST['user_id'])?$_REQUEST['user_id']:'';
    $post_id = isset($_REQUEST['post_id'])?$_REQUEST['post_id']:'';
    $details = isset($_REQUEST['details'])?$_REQUEST['details']:'';
    $input = [
        'user_id'=> $user_id,
        'post_id'=> $post_id,
        'details'=> $details
    ];
    $result = $MC->addComment($input);
    $result = $MP->countAddCommentPost($post_id);

}

$id = isset($_REQUEST['id'])?$_REQUEST['id']:'';
$result = $MP->getPostById($id);
if(isset($result['id'])){
    $NEWS=$result;

    //add view
    $MP->countAddViewPost($id);

    $result = $MC->getCommentByPostId($id);
    if(count($result)>0){
        $COMMENTS = $result;
    }
}




$result = $MP->getTopPost(2);
if(count($result) > 0){
    $TOPNEWS = $result;
}