<?php
/**
 * Created by PhpStorm.
 * User: Gimo
 * Date: 29/5/2561
 * Time: 16:39
 */
require_once __DIR__.'/ModelProjectSetup.php';
require_once __DIR__.'/ModelProject.php';
$MPS = new ModelProjectSetup();
$MP = new ModelProject();


$fn = isset($_REQUEST['fn'])?$_REQUEST['fn']:'';
if($fn=='deleteProject'){
    $id = isset($_REQUEST['project_id'])?$_REQUEST['project_id']:'';
    $result = $MP->deleteProject($id);
}


$PROJECTSETUP = [];
$PHASE1 = [];
$PHASE2 = [];
$PHASE3 = [];
$CONFIRM1 = [];
$CONFIRM2 = [];

$result = $MPS->getProjectById($SETID);
if(isset($result['id'])){
    $PROJECTSETUP = $result;

    $result = $MP->getProjectByProjectSetUp($PROJECTSETUP['id']);
    if(count($result) > 0 ){
        $PHASE1 = $result;
    }

    $result = $MP->getProjectByPhase($PROJECTSETUP['id'],2);
    if(count($result) > 0 ){
        $PHASE2 = $result;
    }

    $result = $MP->getProjectByPhase($PROJECTSETUP['id'],3);
    if(count($result) > 0 ){
        $PHASE3 = $result;
    }

    $result = $MP->getProjectByConfirm($PROJECTSETUP['id'],1);
    if(count($result) > 0 ){
        $CONFIRM1 = $result;
    }
    $result = $MP->getProjectByConfirm($PROJECTSETUP['id'],2);
    if(count($result) > 0 ){
        $CONFIRM2 = $result;
    }

}




