<?php
/**
 * Created by PhpStorm.
 * User: Gimo
 * Date: 31/5/2561
 * Time: 23:57
 */
include_once __DIR__.'/../model/ModelPost.php';
include_once __DIR__.'/../model/ModelComment.php';

$MP = new ModelPost();
$MC = new ModelComment();

$NEWS = [];
$COMMENTS = [];

$id = $MP->input('id');
$fn = $MP->input('fn');

if($fn=='addComment'){
    $user_id = $MC->input('user_id');
    $post_id = $MC->input('post_id');
    $details = $MC->input('details');
    $input = [
        'user_id'=> $user_id,
        'post_id'=> $post_id,
        'details'=> $details
    ];
    $result = $MC->insertThis($input);
    $result = $MP->countAddCommentPost($post_id);

}


$result = $MP->selectThis(['id'=>$id]);
if(isset($result['id'])){
    $NEWS=$result;

    //add view
    $MP->countAddViewPost($id);

    $result = $MC->getCommentByPostId($id);
    if(count($result)>0){
        $COMMENTS = $result;
    }
}
