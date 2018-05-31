<?php
/**
 * Created by PhpStorm.
 * User: Gimo
 * Date: 29/5/2561
 * Time: 16:39
 */
require_once __DIR__.'/ModelUser.php';
$MU = new  ModelUser();


$USER = [];
$result = $MU->getUserAll();
if(count($result)>0){
    $USER = $result;
}



