<?php
/**
 * Created by PhpStorm.
 * User: EPOP
 * Date: 5/30/2018
 * Time: 2:16 PM
 */
require_once __DIR__.'/ModelProject.php';
require_once __DIR__.'/ModelProjectSetup.php';
require_once __DIR__.'/ModelProjectPhase.php';
require_once __DIR__.'/ModelProjectPhaseUpload.php';
require_once __DIR__.'/ModelUser.php';
$MP = new ModelProject();
$MPS = new ModelProjectSetup();
$MPP = new ModelProjectPhase();
$MPPU = new ModelProjectPhaseUpload();
$MU = new ModelUser();

$id = isset($_REQUEST['id'])?$_REQUEST['id']:'';
$session_user_id = isset($_SESSION['id'])?$_SESSION['id']:0;


$projectSetup=[];
$PROJECT = [];

$PHASE1 = [];
$PHASEUPLOAD = [];
$P1LOG = [];

$PHASE2 = [];
$P2UPLOAD = [];
$P2LOG = [];

$LEADER = '-';
$MEMBER = '-';

$fn = isset($_REQUEST['fn'])?$_REQUEST['fn']:'';
if($fn=='phase1'){
    $id = isset($_REQUEST['id'])?$_REQUEST['id']:'';
    $result = $MPP->addPhase($id,1);
    if($result > 0){
        $l = $MU->link('user-project-manage.php?id='.$id);
        exit;
    }else{
        header("Location: /user-project.php");
        $l = $MU->link('user-project.php');
        exit;
    }
}
elseif($fn=='savePdf'){
    $phase_id = isset($_REQUEST['phase_id'])?$_REQUEST['phase_id']:'';
    $user_id = isset($_REQUEST['user_id'])?$_REQUEST['user_id']:'';
    $namefile = isset($_REQUEST['namefile'])?$_REQUEST['namefile']:'';
    $typefile = isset($_REQUEST['typefile'])?$_REQUEST['typefile']:'';
    $path = isset($_REQUEST['path'])?$_REQUEST['path']:'';
    $input = [
        'phase_id'=> $phase_id,
        'user_id'=> $user_id,
        'namefile'=> $namefile,
        'typefile'=> $typefile,
        'path'=> $path
    ];
    $result = $MPPU->addUpload($input);

}
elseif($fn=='saveImage'){
    $phase_id = isset($_REQUEST['phase_id'])?$_REQUEST['phase_id']:'';
    $user_id = isset($_REQUEST['user_id'])?$_REQUEST['user_id']:'';
    $namefile = isset($_REQUEST['namefile'])?$_REQUEST['namefile']:'';
    $typefile = isset($_REQUEST['typefile'])?$_REQUEST['typefile']:'';
    $path = isset($_REQUEST['path'])?$_REQUEST['path']:'';
    $input = [
        'phase_id'=> $phase_id,
        'user_id'=> $user_id,
        'namefile'=> $namefile,
        'typefile'=> $typefile,
        'path'=> $path
    ];
    $result = $MPPU->addUpload($input);

}
elseif($fn=='saveVideo'){
    $phase_id = isset($_REQUEST['phase_id'])?$_REQUEST['phase_id']:'';
    $user_id = isset($_REQUEST['user_id'])?$_REQUEST['user_id']:'';
    $namefile = isset($_REQUEST['namefile'])?$_REQUEST['namefile']:'';
    $typefile = isset($_REQUEST['typefile'])?$_REQUEST['typefile']:'';
    $path = isset($_REQUEST['path'])?$_REQUEST['path']:'';
    $input = [
        'phase_id'=> $phase_id,
        'user_id'=> $user_id,
        'namefile'=> $namefile,
        'typefile'=> $typefile,
        'path'=> $path
    ];
    $result = $MPPU->addUpload($input);

}

elseif($fn=='phase2'){
    $id = isset($_REQUEST['id'])?$_REQUEST['id']:'';
    $result = $MPP->addPhase($id,2);
    if($result > 0){
        $l = $MU->link('user-project-manage.php?id='.$id);
        exit;
    }else{
        header("Location: /user-project.php");
        $l = $MU->link('user-project.php');
        exit;
    }
}





$result = $MP->getProjectById($id);
$check = $MP->checkUserInProject($id,$session_user_id);

if(isset($result['id']) && $check ){
    $PROJECT = $result;

    $result = $MPS->getProjectById($result['projectsetup_id']);
    if(isset($result['id'])){
        $projectSetup= $result;
    }

    $result = $MPP->getPhase($id,1);
    if(isset($result['id'])){
        $PHASE1 = $result;

        $result = $MPPU->getByPhaseId($PHASE1['id']);
        if(count($result)>0){
            $PHASEUPLOAD = $result;
        }

    }

    $result = $MPP->getPhase($id,2);
    if(isset($result['id'])){
        $PHASE2 = $result;

        $result = $MPPU->getByPhaseId($PHASE2['id']);
        if(count($result)>0){
            $P2UPLOAD = $result;
        }

    }

    $result = $MU->getUserByProjectId($id);
    if(count($result)){
        $LEADER = '';
        $MEMBER = '';
        foreach ($result as $item){
            if($item['membertype']=='header'){
                $LEADER.=''.$item['name'].' '.$item['surname'];
            }else{
                $MEMBER.=''.$item['name'].' '.$item['surname'].' , ';
            }
        }
    }



}





