<?php
/**
 * Created by PhpStorm.
 * User: EPOP
 * Date: 5/30/2018
 * Time: 2:16 PM
 */
require_once __DIR__.'/../model/ModelProject.php';
require_once __DIR__.'/../model/ModelProjectMember.php';
require_once __DIR__.'/../model/ModelProjectSetup.php';
require_once __DIR__.'/../model/ModelProjectPhase.php';
require_once __DIR__.'/../model/ModelProjectPhaseUpload.php';
require_once __DIR__.'/../model/ModelProjectPhaseLog.php';
require_once __DIR__.'/../model/ModelUser.php';
require_once __DIR__.'/../model/ModelProjectConfirm.php';
require_once __DIR__.'/../model/ModelProjectConfirmMember.php';

$MP = new ModelProject();
$MPM = new ModelProjectMember();
$MPS = new ModelProjectSetup();
$MPP = new ModelProjectPhase();
$MPPU = new ModelProjectPhaseUpload();
$LOG = new ModelProjectPhaseLog();
$MU = new ModelUser();
$MC = new ModelProjectConfirm();
$MCM = new ModelProjectConfirmMember();

$id = $MP->input('id');
$session_user_id = isset($_SESSION['id'])?$_SESSION['id']:0;


$projectSetup=[];
$PROJECTSETUPNAME = '';
$PROJECT = [];

$PHASE1 = [];
$PHASEUPLOAD = [];
$P1LOG = [];
$CP1 = [];
$CP1M = [];

$PHASE2 = [];
$P2UPLOAD = [];
$P2LOG = [];
$CP2 = [];
$CP2M = [];

$PHASE3 = [];
$P3UPLOAD = [];
$P3LOG = [];


$LEADER = '-';
$MEMBER = '-';


$result = $MP->selectThis(['id'=>$id]);
$check = $MPM->selectThis(['project_id'=>$id,'user_id'=>$session_user_id]);
$check = isset($check);

if(isset($result['id']) && $check ){
    $PROJECT = $result;

    $result = $MPS->selectThis(['id'=>$result['projectsetup_id']]);
    if(isset($result['id'])){
        $projectSetup= $result;
        $PROJECTSETUPNAME = $result['name'];

        if($result['phase1status']=='process'){
            $PHASEACTIVE = 'p1';
            $CASE = 1;
        }
        if($result['phase1confirm']=='process'){
            $PHASEACTIVE = 'c1';
            $CASE = 2;
        }

        if($result['phase2status']=='process'){
            $PHASEACTIVE = 'p2';
            $CASE = 3;
        }
        if($result['phase2confirm']=='process'){
            $PHASEACTIVE = 'c2';
            $CASE = 4;
        }

        if($result['phase3status']=='process'){
            $PHASEACTIVE = 'p3';
            $CASE = 5;
        }
        if($result['phase3confirm']=='process'){
            $PHASEACTIVE = 'c3';
            $CASE = 6;
        }


    }

    $result = $MPP->selectThis(['project_id'=>$id,'phase'=>1]);
    if(isset($result['id'])){
        $PHASE1 = $result;

        $sql = " where phase_id=".$PHASE1['id']." ORDER BY id ";
        $result = $MPPU->selectAllSql($sql);
        if(count($result)>0){
            $PHASEUPLOAD = $result;
        }

        $result = $LOG->getLogByPhase($PHASE1['id']);
        if(count($result)>0){
            $P1LOG = $result;
        }

    }
    $result = $MC->selectThis(['project_id'=>$id,'confirm_phase'=>1]);
    if(isset($result['id'])){
        $CP1 = $result;

        $result = $MCM->getCM($CP1['id']);
        if(count($result)>0){
            $CP1M = $result;
        }

    }


    $result = $MPP->selectThis(['project_id'=>$id,'phase'=>2]);
    if(isset($result['id'])){
        $PHASE2 = $result;

        $sql = " where phase_id=".$PHASE2['id']." ORDER BY id ";
        $result = $MPPU->selectAllSql($sql);
        if(count($result)>0){
            $P2UPLOAD = $result;
        }
        $result = $LOG->getLogByPhase($PHASE2['id']);
        if(count($result)>0){
            $P2LOG = $result;
        }

    }
    $result = $MC->selectThis(['project_id'=>$id,'confirm_phase'=>2]);
    if(isset($result['id'])){
        $CP2 = $result;

        $result = $MCM->getCM($CP2['id']);
        if(count($result)>0){
            $CP2M = $result;
        }

    }

    $result = $MPP->selectThis(['project_id'=>$id,'phase'=>3]);
    if(isset($result['id'])){
        $PHASE3 = $result;

        $sql = " where phase_id=".$PHASE3['id']." ORDER BY id ";
        $result = $MPPU->selectAllSql($sql);
        if(count($result)>0){
            $P3UPLOAD = $result;
        }
        $result = $LOG->getLogByPhase($PHASE3['id']);
        if(count($result)>0){
            $P3LOG = $result;
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
                if($MEMBER==''){
                    $MEMBER.=''.$item['name'].' '.$item['surname'];
                }else{
                    $MEMBER.=','.$item['name'].' '.$item['surname'];
                }

            }
        }
    }



}





