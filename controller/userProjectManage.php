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


$projectSetup=[];
$PROJECT = [];
$PHASE1 = [];
$PHASEUPLOAD = [];
$PHASE2 = [];
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
else if($fn=='savePdf'){
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
else if($fn=='saveImage'){
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






$result = $MP->getProjectById($id);
if(isset($result['id'])){
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





