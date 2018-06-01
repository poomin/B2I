<?php
/**
 * Created by PhpStorm.
 * User: EPOP
 * Date: 5/31/2018
 * Time: 12:03 PM
 */

include_once __DIR__.'/ModelUpload.php';
$MUP = new ModelUpload();

$IMAGE = [];

$fn = isset($_REQUEST['fn'])?$_REQUEST['fn']:'';
if($fn=='saveImage'){
    $path = isset($_REQUEST['path'])?$_REQUEST['path']:'';
    $name = isset($_REQUEST['namefile'])?$_REQUEST['namefile']:'';

    $result =$MUP->addImageProjectSetup($name,$path);
    if($result > 0){
        $_SESSION['success']=" Save Image Success.";
        //$l = $MU->link('admin-project-image.php');
        //exit(0);
    }else{
        $_SESSION['error']=" Can't Save Image !!!!";
        //$l = $MU->link('admin-project-image.php');
        //exit(0);
    }
}

$result = $MUP->getImageProjectSetup();
if(count($result)>0){
    $IMAGE = $result;
}

