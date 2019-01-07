<?php
/**
 * Created by PhpStorm.
 * User: EPOP
 * Date: 5/30/2018
 * Time: 2:16 PM
 */
require_once __DIR__.'/../model/ModelPost.php';
$MP = new ModelPost();



$fn = $MP->input('fn');
if($fn=='deleteNews'){
    $news_id = $MP->input('delete_id');
    $result = $MP->deleteThis(['id'=>$news_id]);

    if($result>0){
        $_SESSION['E_STATUS'] = 'success';
        $_SESSION['E_MESSAGE'] = 'Delete News success.';
    }else{
        $_SESSION['E_STATUS'] = 'warning';
        $_SESSION['E_MESSAGE'] = 'Delete News Fail!!';
    }

}


$POSTS = [];
$result = $MP->selectAllThis([]);
if(count($result)>0){
    $POSTS = $result;
}



