<?php
/**
 * Created by PhpStorm.
 * User: EPOP
 * Date: 5/30/2018
 * Time: 2:16 PM
 */
require_once __DIR__.'/ModelProjectSetup.php';

$MPS = new ModelProjectSetup();

$PROJECTSETUP=[];

$fn = isset($_REQUEST['fn'])?$_REQUEST['fn']:'';
if($fn=='editPhase1Status'){
    $id = isset($_REQUEST['id'])?$_REQUEST['id']:'';
    $phase1status = isset($_REQUEST['phase1status'])?$_REQUEST['phase1status']:'close';
    $phase1detail = isset($_REQUEST['phase1detail'])?$_REQUEST['phase1detail']:'';
    $result = $MPS->addDetailProject($id,'phase1status',$phase1status);
    $result = $MPS->addDetailProject($id,'phase1detail',$phase1detail);
    $_SESSION['success'] = 'Update data Success.';
}
elseif($fn=='editConfirm1Status'){
    $id = isset($_REQUEST['id'])?$_REQUEST['id']:'';
    $phase1status = isset($_REQUEST['confirm1status'])?$_REQUEST['confirm1status']:'close';
    $phase1detail = isset($_REQUEST['confirm1detail'])?$_REQUEST['confirm1detail']:'';
    $result = $MPS->addDetailProject($id,'phase1confirm',$phase1status);
    $result = $MPS->addDetailProject($id,'phase1confirmdetail',$phase1detail);
    $_SESSION['success'] = 'Update data Success.';
}
elseif($fn=='editPhase2Status'){
    $id = isset($_REQUEST['id'])?$_REQUEST['id']:'';
    $phase1status = isset($_REQUEST['phase2status'])?$_REQUEST['phase2status']:'close';
    $phase1detail = isset($_REQUEST['phase2detail'])?$_REQUEST['phase2detail']:'';
    $result = $MPS->addDetailProject($id,'phase2status',$phase1status);
    $result = $MPS->addDetailProject($id,'phase2detail',$phase1detail);
    $_SESSION['success'] = 'Update data Success.';
}
elseif($fn=='editConfirm2Status'){
    $id = isset($_REQUEST['id'])?$_REQUEST['id']:'';
    $phase1status = isset($_REQUEST['confirm2status'])?$_REQUEST['confirm2status']:'close';
    $phase1detail = isset($_REQUEST['confirm2detail'])?$_REQUEST['confirm2detail']:'';
    $result = $MPS->addDetailProject($id,'phase2confirm',$phase1status);
    $result = $MPS->addDetailProject($id,'phase2confirmdetail',$phase1detail);
    $_SESSION['success'] = 'Update data Success.';
}
elseif($fn=='editPhase3Status'){
    $id = isset($_REQUEST['id'])?$_REQUEST['id']:'';
    $phase1status = isset($_REQUEST['phase3status'])?$_REQUEST['phase3status']:'close';
    $phase1detail = isset($_REQUEST['phase3detail'])?$_REQUEST['phase3detail']:'';
    $result = $MPS->addDetailProject($id,'phase3status',$phase1status);
    $result = $MPS->addDetailProject($id,'phase3detail',$phase1detail);
    $_SESSION['success'] = 'Update data Success.';
}


$result = $MPS->getProjectById($SETID);
if(isset($result['id'])){
    $PROJECTSETUP = $result;
}





