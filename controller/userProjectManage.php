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
require_once __DIR__.'/ModelProjectPhaseLog.php';
require_once __DIR__.'/ModelUser.php';
require_once __DIR__.'/ModelProjectConfirm.php';
require_once __DIR__.'/ModelProjectConfirmMember.php';
$MP = new ModelProject();
$MPS = new ModelProjectSetup();
$MPP = new ModelProjectPhase();
$MPPU = new ModelProjectPhaseUpload();
$LOG = new ModelProjectPhaseLog();
$MU = new ModelUser();
$MC = new ModelProjectConfirm();
$MCM = new ModelProjectConfirmMember();

$id = isset($_REQUEST['id'])?$_REQUEST['id']:'';
$session_user_id = isset($_SESSION['id'])?$_SESSION['id']:0;


$projectSetup=[];
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
$PHASEACTIVE = 'p1'; // p1=phase1 , c1 = confirm phase 1 , p2=phase2 , c2=confirm phase2 , p3=phase3 ,c3=confirm phase3
$CASE = 1 ; //1=p1 , 2=c1 , 3=p2 , 4=c2 , 5=p3 , 6 =c3
$fn = isset($_REQUEST['fn'])?$_REQUEST['fn']:'';
if($fn=='phase1'){
    $id = isset($_REQUEST['id'])?$_REQUEST['id']:'';
    $result = $MPP->addPhase($id,1);
    if($result > 0){
        $l = $MU->link('user-project-manage.php?id='.$id);
        exit;
    }else{
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

    //add Log
    $result = $LOG->addLog($phase_id,$user_id,'Upload File Name: '.$namefile);

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

    $result = $LOG->addLog($phase_id,$user_id,'Upload Image Name: '.$namefile);

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

    $result = $LOG->addLog($phase_id,$user_id,'Upload Video Name: '.$namefile);

}

elseif ($fn=='confirm1'){
    $id = isset($_REQUEST['id'])?$_REQUEST['id']:'';
    $lastId = $MC->addConfirm(['project_id'=>$id,'phase'=>1]);
    if($lastId>0){
        $userInProject = $MU->getUserByProjectId($id);
        foreach ($userInProject as $item){
            $i_user_id = $item['id'];
            $i_membertype = $item['membertype'];
            $result = $MCM->addCM([
                'confirm_id'=>$lastId,
                'user_id'=>$i_user_id,
                'membertype'=>$i_membertype
            ]);
        }
    }
}
elseif ($fn=='addConfirm1'){
    $confirm_id = isset($_REQUEST['cid'])?$_REQUEST['cid']:'';
    $checkIn = isset($_REQUEST['check_in'])?$_REQUEST['check_in']:'';
    if($checkIn!=''){
        $cut = explode('/',$checkIn);
        $checkIn = $cut[2].'-'.$cut[1].'-'.$cut[0];
    }
    $driver = isset($_REQUEST['driver'])?$_REQUEST['driver']:'';
    $result = $MC->editConfirm(['check_in'=>$checkIn,'driver'=>$driver,'id'=>$confirm_id]);
}
elseif ($fn=='confirm1Teacher'){
    $confirm_id = isset($_REQUEST['cid'])?$_REQUEST['cid']:'';
    $user_id = isset($_REQUEST['uid'])?$_REQUEST['uid']:'';
    $shirts_size = isset($_REQUEST['shirts_size'])?$_REQUEST['shirts_size']:'';
    $phone = isset($_REQUEST['phone'])?$_REQUEST['phone']:'';
    $vegetarian_food = isset($_REQUEST['vegetarian_food'])?$_REQUEST['vegetarian_food']:'';
    $result = $MCM->editCMTeacher([
        'confirm_id'=>$confirm_id,
        'user_id'=>$user_id,
        'shirts_size'=>$shirts_size,
        'phone'=>$phone,
        'vegetarian_food'=>$vegetarian_food,
    ]);
}
elseif ($fn=='confirm1Student'){
    $confirm_id = isset($_REQUEST['cid'])?$_REQUEST['cid']:'';
    $user_id = isset($_REQUEST['uid'])?$_REQUEST['uid']:'';
    $shirts_size = isset($_REQUEST['shirts_size'])?$_REQUEST['shirts_size']:'';
    $phone = isset($_REQUEST['phone'])?$_REQUEST['phone']:'';
    $classroom = isset($_REQUEST['classroom'])?$_REQUEST['classroom']:'';
    $vegetarian_food = isset($_REQUEST['vegetarian_food'])?$_REQUEST['vegetarian_food']:'';
    $result = $MCM->editCMStudent([
        'confirm_id'=>$confirm_id,
        'user_id'=>$user_id,
        'shirts_size'=>$shirts_size,
        'phone'=>$phone,
        'classroom'=>$classroom,
        'vegetarian_food'=>$vegetarian_food
    ]);
}

elseif($fn=='phase2'){
    $id = isset($_REQUEST['id'])?$_REQUEST['id']:'';
    $result = $MPP->addPhase($id,2);
    if($result > 0){
        $l = $MU->link('user-project-manage.php?id='.$id);
        exit;
    }else{
        $l = $MU->link('user-project.php');
        exit;
    }
}
elseif($fn=='savePdfP2'){
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

    $result = $LOG->addLog($phase_id,$user_id,'Upload File Name: '.$namefile);

}
elseif($fn=='saveImageP2'){
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

    $result = $LOG->addLog($phase_id,$user_id,'Upload Image Name: '.$namefile);

}
elseif($fn=='saveVideoP2'){
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

    $result = $LOG->addLog($phase_id,$user_id,'Upload Video Name: '.$namefile);

}

elseif ($fn=='confirm2'){
    $id = isset($_REQUEST['id'])?$_REQUEST['id']:'';
    $lastId = $MC->addConfirm(['project_id'=>$id,'phase'=>2]);
    if($lastId>0){
        $userInProject = $MU->getUserByProjectId($id);
        foreach ($userInProject as $item){
            $i_user_id = $item['id'];
            $i_membertype = $item['membertype'];
            $result = $MCM->addCM([
                'confirm_id'=>$lastId,
                'user_id'=>$i_user_id,
                'membertype'=>$i_membertype
            ]);
        }
    }
}
elseif ($fn=='addConfirm2'){
    $confirm_id = isset($_REQUEST['cid'])?$_REQUEST['cid']:'';
    $checkIn = isset($_REQUEST['check_in'])?$_REQUEST['check_in']:'';
    if($checkIn!=''){
        $cut = explode('/',$checkIn);
        $checkIn = $cut[2].'-'.$cut[1].'-'.$cut[0];
    }
    $driver = isset($_REQUEST['driver'])?$_REQUEST['driver']:'';
    $result = $MC->editConfirm(['check_in'=>$checkIn,'driver'=>$driver,'id'=>$confirm_id]);
}
elseif ($fn=='confirm2Teacher'){
    $confirm_id = isset($_REQUEST['cid'])?$_REQUEST['cid']:'';
    $user_id = isset($_REQUEST['uid'])?$_REQUEST['uid']:'';
    $shirts_size = isset($_REQUEST['shirts_size'])?$_REQUEST['shirts_size']:'';
    $phone = isset($_REQUEST['phone'])?$_REQUEST['phone']:'';
    $vegetarian_food = isset($_REQUEST['vegetarian_food'])?$_REQUEST['vegetarian_food']:'';
    $result = $MCM->editCMTeacher([
        'confirm_id'=>$confirm_id,
        'user_id'=>$user_id,
        'shirts_size'=>$shirts_size,
        'phone'=>$phone,
        'vegetarian_food'=>$vegetarian_food,
    ]);
}
elseif ($fn=='confirm2Student'){
    $confirm_id = isset($_REQUEST['cid'])?$_REQUEST['cid']:'';
    $user_id = isset($_REQUEST['uid'])?$_REQUEST['uid']:'';
    $shirts_size = isset($_REQUEST['shirts_size'])?$_REQUEST['shirts_size']:'';
    $phone = isset($_REQUEST['phone'])?$_REQUEST['phone']:'';
    $classroom = isset($_REQUEST['classroom'])?$_REQUEST['classroom']:'';
    $vegetarian_food = isset($_REQUEST['vegetarian_food'])?$_REQUEST['vegetarian_food']:'';
    $result = $MCM->editCMStudent([
        'confirm_id'=>$confirm_id,
        'user_id'=>$user_id,
        'shirts_size'=>$shirts_size,
        'phone'=>$phone,
        'classroom'=>$classroom,
        'vegetarian_food'=>$vegetarian_food
    ]);
}

elseif($fn=='phase3'){
    $id = isset($_REQUEST['id'])?$_REQUEST['id']:'';
    $result = $MPP->addPhase($id,3);
    if($result > 0){
        $l = $MU->link('user-project-manage.php?id='.$id);
        exit;
    }else{
        $l = $MU->link('user-project.php');
        exit;
    }
}
elseif($fn=='savePdfP3'){
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

    $result = $LOG->addLog($phase_id,$user_id,'Upload File Name: '.$namefile);

}
elseif($fn=='saveImageP3'){
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

    $result = $LOG->addLog($phase_id,$user_id,'Upload Image Name: '.$namefile);

}
elseif($fn=='saveVideoP3'){
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

    $result = $LOG->addLog($phase_id,$user_id,'Upload Video Name: '.$namefile);

}


elseif ($fn=='deleteUpload'){
    $typefile = isset($_REQUEST['typefile'])?$_REQUEST['typefile']:'';
    $upload_id = isset($_REQUEST['upload_id'])?$_REQUEST['upload_id']:'';
    $phase_id = isset($_REQUEST['phase_id'])?$_REQUEST['phase_id']:'';
    $name = isset($_REQUEST['name'])?$_REQUEST['name']:'';
    $user_id = isset($_REQUEST['user_id'])?$_REQUEST['user_id']:'';

    $result = $MPPU->deleteUploadById($upload_id);
    $result = $LOG->addLog($phase_id,$user_id,'Delete '.$typefile.' Name: '.$name);
}


$result = $MP->getProjectById($id);
$check = $MP->checkUserInProject($id,$session_user_id);

if(isset($result['id']) && $check ){
    $PROJECT = $result;

    $result = $MPS->getProjectById($result['projectsetup_id']);
    if(isset($result['id'])){
        $projectSetup= $result;

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

    $result = $MPP->getPhase($id,1);
    if(isset($result['id'])){
        $PHASE1 = $result;

        $result = $MPPU->getByPhaseId($PHASE1['id']);
        if(count($result)>0){
            $PHASEUPLOAD = $result;
        }

        $result = $LOG->getLogByPhase($PHASE1['id']);
        if(count($result)>0){
            $P1LOG = $result;
        }

    }
    $result = $MC->getConfirmId($id,1);
    if(isset($result['id'])){
        $CP1 = $result;

        $result = $MCM->getCM($CP1['id']);
        if(count($result)>0){
            $CP1M = $result;
        }

    }

    $result = $MPP->getPhase($id,2);
    if(isset($result['id'])){
        $PHASE2 = $result;

        $result = $MPPU->getByPhaseId($PHASE2['id']);
        if(count($result)>0){
            $P2UPLOAD = $result;
        }
        $result = $LOG->getLogByPhase($PHASE2['id']);
        if(count($result)>0){
            $P2LOG = $result;
        }

    }
    $result = $MC->getConfirmId($id,2);
    if(isset($result['id'])){
        $CP2 = $result;

        $result = $MCM->getCM($CP2['id']);
        if(count($result)>0){
            $CP2M = $result;
        }

    }

    $result = $MPP->getPhase($id,3);
    if(isset($result['id'])){
        $PHASE3 = $result;

        $result = $MPPU->getByPhaseId($PHASE3['id']);
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





