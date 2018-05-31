<?php
/**
 * Created by PhpStorm.
 * User: EPOP
 * Date: 5/30/2018
 * Time: 2:16 PM
 */
require_once __DIR__.'/ModelPost.php';
$MP = new ModelPost();


$POSTS = [];
$result = $MP->getPostAll();
if(count($result)>0){
    $POSTS = $result;
}



