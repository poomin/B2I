<?php
/**
 * Created by PhpStorm.
 * User: Gimo
 * Date: 29/5/2561
 * Time: 16:39
 */
require_once __DIR__.'/../model/ModelUser.php';
$MU = new  ModelUser();

$fn = $MU->input('fn');
if($fn=='deleteUser'){
    $id = $MU->input('delete_id');
    $result = $MU->deleteThis(['id'=>$id]);
    if($result>0){
        $_SESSION['E_STATUS'] = 'success';
        $_SESSION['E_MESSAGE'] = 'Delete Member success.';
    }else{
        $_SESSION['E_STATUS'] = 'warning';
        $_SESSION['E_MESSAGE'] = 'Delete Member Fail!!';
    }
}

$USER = [];
$result = $MU->selectAllSql(" WHERE role IN ('student','teacher','board','company') ");
if(count($result)>0){
    $USER = $result;
}



