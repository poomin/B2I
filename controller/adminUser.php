<?php
/**
 * Created by PhpStorm.
 * User: Gimo
 * Date: 29/5/2561
 * Time: 16:39
 */
require_once __DIR__.'/ModelUser.php';
$MU = new  ModelUser();

$fn = isset($_REQUEST['fn'])?$_REQUEST['fn']:'';
if($fn=='deleteUser'){
    $id = isset($_REQUEST['id'])?$_REQUEST['id']:'';
    $result = $MU->editRemove($id);
}

$USER = [];
$result = $MU->getUserAll();
if(count($result)>0){
    $USER = $result;
}



