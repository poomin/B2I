<?php
/**
 * Created by PhpStorm.
 * User: Gimo
 * Date: 29/5/2561
 * Time: 16:39
 */
require_once __DIR__.'/../model/ModelProjectSetup.php';
$MPS = new ModelProjectSetup();

$fn = $MPS->input('fn');
if($fn=='deleteProject'){
    $id = $MPS->input('delete_id');

    $result = $MPS->deleteThis(['id'=>$id]);
    $_SESSION['E_STATUS'] = 'success';
    $_SESSION['E_MESSAGE'] = 'ลบข้อมูลสำเร็จ';
}
elseif ($fn=='confirm'){
    $id  = $MPS->input('_id');
    $result = $MPS->editThis(['active'=>'N'],[]);
    $result = $MPS->editThis(['active'=>'Y'],['id'=>$id]);
    $_SESSION['SETID'] = $id;
    $SETID = $id;
}

$ProjectSetup = [];

$result = $MPS->selectAllThis([]);
if(count($result)>0){
    $ProjectSetup = $result;
}
