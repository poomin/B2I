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
$result = $MP->getPostPage($page);
if(count($result)>0){
    $NEWS=$result;
}
