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
$fn = $MP->input('fn');
if($fn=='phase1'){
    $id = $MPP->input('id');
    $input = [
        'project_id'=>$id,
        'phase'=> 1
    ];
    $result = $MPP->insertThis($input);
    if($result > 0){
        $l = $MU->link('user-project-manage.php?id='.$id);
        exit;
    }else{
        $l = $MU->link('user-project.php');
        exit;
    }
}
elseif($fn=='savePdf'){
    $phase_id = $MPPU->input('phase_id');
    $user_id = $MPPU->input('user_id');
    $namefile = $MPPU->input('namefile');
    $typefile = $MPPU->input('typefile');
    $path = $MPPU->input('path');
    $input = [
        'phase_id'=> $phase_id,
        'user_id'=> $user_id,
        'namefile'=> $namefile,
        'typefile'=> $typefile,
        'path'=> $path
    ];
    $result = $MPPU->insertThis($input);

    //add Log
    $message = 'Upload File Name: '.$namefile;
    $input=[
        'phase_id'=>$phase_id,
        'user_id'=>$user_id,
        'message'=>$message
    ];
    $result = $LOG->insertThis($input);

}
elseif($fn=='saveImage'){
    $phase_id = $MPPU->input('phase_id');
    $user_id = $MPPU->input('user_id');
    $namefile = $MPPU->input('namefile');
    $typefile = $MPPU->input('typefile');
    $path = $MPPU->input('path');
    $input = [
        'phase_id'=> $phase_id,
        'user_id'=> $user_id,
        'namefile'=> $namefile,
        'typefile'=> $typefile,
        'path'=> $path
    ];
    $result = $MPPU->insertThis($input);

    //add Log
    $message = 'Upload Image Name: '.$namefile;
    $input=[
        'phase_id'=>$phase_id,
        'user_id'=>$user_id,
        'message'=>$message
    ];
    $result = $LOG->insertThis($input);

}
elseif($fn=='saveVideo'){
    $phase_id = $MPPU->input('phase_id');
    $user_id = $MPPU->input('user_id');
    $namefile = $MPPU->input('namefile');
    $typefile = $MPPU->input('typefile');
    $path = $MPPU->input('path');
    $input = [
        'phase_id'=> $phase_id,
        'user_id'=> $user_id,
        'namefile'=> $namefile,
        'typefile'=> $typefile,
        'path'=> $path
    ];
    $result = $MPPU->insertThis($input);

    //add Log
    $message = 'Upload Video Name: '.$namefile;
    $input=[
        'phase_id'=>$phase_id,
        'user_id'=>$user_id,
        'message'=>$message
    ];
    $result = $LOG->insertThis($input);

}

elseif ($fn=='confirm1'){
    $id = $MC->input('id');
    $input= [
        'project_id'=>$id,
        'phase'=>1
    ];
    $lastId = $MC->insertThis($input);
    if($lastId>0){
        $userInProject = $MU->getUserByProjectId($id);
        foreach ($userInProject as $item){
            $i_user_id = $item['id'];
            $i_membertype = $item['membertype'];
            $result = $MCM->insertThis([
                'confirm_id'=>$lastId,
                'user_id'=>$i_user_id,
                'membertype'=>$i_membertype
            ]);
        }
    }
}
elseif ($fn=='addConfirm1'){
    $confirm_id = $MC->input('cid');
    $checkIn = $MC->input('check_in');
    $driver = $MC->input('driver');
    if($checkIn!=''){
        $cut = explode('/',$checkIn);
        $checkIn = $cut[2].'-'.$cut[1].'-'.$cut[0];
    }
    $input=[
        'check_in'=>$checkIn,
        'driver'=>$driver,
    ];
    $condition=[
        'id'=>$confirm_id
    ];
    $result = $MC->editThis($input,$condition);
}
elseif ($fn=='confirm1Teacher'){
    $confirm_id = $MCM->input('cid');
    $user_id = $MCM->input('uid');
    $shirts_size = $MCM->input('shirts_size');
    $phone = $MCM->input('phone');
    $vegetarian_food = $MCM->input('vegetarian_food');

    $input=[
        'shirts_size'=>$shirts_size,
        'phone'=>$phone,
        'vegetarian_food'=>$vegetarian_food,
    ];
    $condition=[
        'confirm_id'=>$confirm_id,
        'user_id'=>$user_id
    ];

    $result = $MCM->editThis($input,$condition);
}
elseif ($fn=='confirm1Student'){
    $confirm_id = $MCM->input('cid');
    $user_id = $MCM->input('uid');
    $shirts_size = $MCM->input('shirts_size');
    $phone = $MCM->input('phone');
    $classroom = $MCM->input('classroom');
    $vegetarian_food = $MCM->input('vegetarian_food');

    $input=[
        'shirts_size'=>$shirts_size,
        'phone'=>$phone,
        'classroom'=>$classroom,
        'vegetarian_food'=>$vegetarian_food,
    ];
    $condition=[
        'confirm_id'=>$confirm_id,
        'user_id'=>$user_id
    ];

    $result = $MCM->editThis($input,$condition);
}

elseif($fn=='phase2'){
    $id = $MPP->input('id');
    $input = [
        'project_id'=>$id,
        'phase'=> 2
    ];
    $result = $MPP->insertThis($input);
    if($result > 0){
        $l = $MU->link('user-project-manage.php?id='.$id);
        exit;
    }else{
        $l = $MU->link('user-project.php');
        exit;
    }
}
elseif($fn=='savePdfP2'){
    $phase_id = $MPPU->input('phase_id');
    $user_id = $MPPU->input('user_id');
    $namefile = $MPPU->input('namefile');
    $typefile = $MPPU->input('typefile');
    $path = $MPPU->input('path');
    $input = [
        'phase_id'=> $phase_id,
        'user_id'=> $user_id,
        'namefile'=> $namefile,
        'typefile'=> $typefile,
        'path'=> $path
    ];
    $result = $MPPU->insertThis($input);

    //add Log
    $message = 'Upload File Name: '.$namefile;
    $input=[
        'phase_id'=>$phase_id,
        'user_id'=>$user_id,
        'message'=>$message
    ];
    $result = $LOG->insertThis($input);


}
elseif($fn=='saveImageP2'){
    $phase_id = $MPPU->input('phase_id');
    $user_id = $MPPU->input('user_id');
    $namefile = $MPPU->input('namefile');
    $typefile = $MPPU->input('typefile');
    $path = $MPPU->input('path');
    $input = [
        'phase_id'=> $phase_id,
        'user_id'=> $user_id,
        'namefile'=> $namefile,
        'typefile'=> $typefile,
        'path'=> $path
    ];
    $result = $MPPU->insertThis($input);

    //add Log
    $message = 'Upload Image Name: '.$namefile;
    $input=[
        'phase_id'=>$phase_id,
        'user_id'=>$user_id,
        'message'=>$message
    ];
    $result = $LOG->insertThis($input);

}
elseif($fn=='saveVideoP2'){
    $phase_id = $MPPU->input('phase_id');
    $user_id = $MPPU->input('user_id');
    $namefile = $MPPU->input('namefile');
    $typefile = $MPPU->input('typefile');
    $path = $MPPU->input('path');
    $input = [
        'phase_id'=> $phase_id,
        'user_id'=> $user_id,
        'namefile'=> $namefile,
        'typefile'=> $typefile,
        'path'=> $path
    ];
    $result = $MPPU->insertThis($input);

    //add Log
    $message = 'Upload Video Name: '.$namefile;
    $input=[
        'phase_id'=>$phase_id,
        'user_id'=>$user_id,
        'message'=>$message
    ];
    $result = $LOG->insertThis($input);

}

elseif ($fn=='confirm2'){
    $id = $MC->input('id');
    $input= [
        'project_id'=>$id,
        'phase'=>2
    ];
    $lastId = $MC->insertThis($input);
    if($lastId>0){
        $userInProject = $MU->getUserByProjectId($id);
        foreach ($userInProject as $item){
            $i_user_id = $item['id'];
            $i_membertype = $item['membertype'];
            $result = $MCM->insertThis([
                'confirm_id'=>$lastId,
                'user_id'=>$i_user_id,
                'membertype'=>$i_membertype
            ]);
        }
    }
}
elseif ($fn=='addConfirm2'){
    $confirm_id = $MC->input('cid');
    $checkIn = $MC->input('check_in');
    $driver = $MC->input('driver');
    if($checkIn!=''){
        $cut = explode('/',$checkIn);
        $checkIn = $cut[2].'-'.$cut[1].'-'.$cut[0];
    }
    $input=[
        'check_in'=>$checkIn,
        'driver'=>$driver,
    ];
    $condition=[
        'id'=>$confirm_id
    ];
    $result = $MC->editThis($input,$condition);

}
elseif ($fn=='confirm2Teacher'){
    $confirm_id = $MCM->input('cid');
    $user_id = $MCM->input('uid');
    $shirts_size = $MCM->input('shirts_size');
    $phone = $MCM->input('phone');
    $vegetarian_food = $MCM->input('vegetarian_food');

    $name_title = $MCM->input('name_title');
    $name_thai = $MCM->input('name_thai');
    $surname_thai = $MCM->input('surname_thai');
    $input=[
        'shirts_size'=>$shirts_size,
        'phone'=>$phone,
        'vegetarian_food'=>$vegetarian_food,
        'name_title'=>$name_title,
        'name_thai'=>$name_thai,
        'surname_thai'=>$surname_thai
    ];
    $condition=[
        'confirm_id'=>$confirm_id,
        'user_id'=>$user_id
    ];

    $result = $MCM->editThis($input,$condition);
}
elseif ($fn=='confirm2Student'){
    $confirm_id = $MCM->input('cid');
    $user_id = $MCM->input('uid');
    $shirts_size = $MCM->input('shirts_size');
    $phone = $MCM->input('phone');
    $classroom = $MCM->input('classroom');
    $vegetarian_food = $MCM->input('vegetarian_food');


    $name_title = $MCM->input('name_title');
    $name_thai = $MCM->input('name_thai');
    $surname_thai = $MCM->input('surname_thai');

    $input=[
        'shirts_size'=>$shirts_size,
        'phone'=>$phone,
        'classroom'=>$classroom,
        'vegetarian_food'=>$vegetarian_food,

        'name_title'=>$name_title,
        'name_thai'=>$name_thai,
        'surname_thai'=>$surname_thai

    ];
    $condition=[
        'confirm_id'=>$confirm_id,
        'user_id'=>$user_id
    ];

    $result = $MCM->editThis($input,$condition);

}

elseif($fn=='phase3'){
    $id = $MPP->input('id');
    $input = [
        'project_id'=>$id,
        'phase'=> 3
    ];
    $result = $MPP->insertThis($input);
    if($result > 0){
        $l = $MU->link('user-project-manage.php?id='.$id);
        exit;
    }else{
        $l = $MU->link('user-project.php');
        exit;
    }

}
elseif($fn=='savePdfP3'){
    $phase_id = $MPPU->input('phase_id');
    $user_id = $MPPU->input('user_id');
    $namefile = $MPPU->input('namefile');
    $typefile = $MPPU->input('typefile');
    $path = $MPPU->input('path');
    $input = [
        'phase_id'=> $phase_id,
        'user_id'=> $user_id,
        'namefile'=> $namefile,
        'typefile'=> $typefile,
        'path'=> $path
    ];
    $result = $MPPU->insertThis($input);

    //add Log
    $message = 'Upload File Name: '.$namefile;
    $input=[
        'phase_id'=>$phase_id,
        'user_id'=>$user_id,
        'message'=>$message
    ];
    $result = $LOG->insertThis($input);

}
elseif($fn=='saveImageP3'){
    $phase_id = $MPPU->input('phase_id');
    $user_id = $MPPU->input('user_id');
    $namefile = $MPPU->input('namefile');
    $typefile = $MPPU->input('typefile');
    $path = $MPPU->input('path');
    $input = [
        'phase_id'=> $phase_id,
        'user_id'=> $user_id,
        'namefile'=> $namefile,
        'typefile'=> $typefile,
        'path'=> $path
    ];
    $result = $MPPU->insertThis($input);

    //add Log
    $message = 'Upload Image Name: '.$namefile;
    $input=[
        'phase_id'=>$phase_id,
        'user_id'=>$user_id,
        'message'=>$message
    ];
    $result = $LOG->insertThis($input);
}
elseif($fn=='saveVideoP3'){
    $phase_id = $MPPU->input('phase_id');
    $user_id = $MPPU->input('user_id');
    $namefile = $MPPU->input('namefile');
    $typefile = $MPPU->input('typefile');
    $path = $MPPU->input('path');
    $input = [
        'phase_id'=> $phase_id,
        'user_id'=> $user_id,
        'namefile'=> $namefile,
        'typefile'=> $typefile,
        'path'=> $path
    ];
    $result = $MPPU->insertThis($input);

    //add Log
    $message = 'Upload Video Name: '.$namefile;
    $input=[
        'phase_id'=>$phase_id,
        'user_id'=>$user_id,
        'message'=>$message
    ];
    $result = $LOG->insertThis($input);

}


elseif ($fn=='deleteUpload'){
    $typefile = $MPPU->input('typefile');
    $upload_id = $MPPU->input('upload_id');
    $phase_id = $MPPU->input('phase_id');
    $name = $MPPU->input('name');
    $user_id = $MPPU->input('user_id');

    $result = $MPPU->deleteThis(['id'=>$id]);

    //add Log
    $message = 'Delete '.$typefile.' Name: '.$name;
    $input=[
        'phase_id'=>$phase_id,
        'user_id'=>$user_id,
        'message'=>$message
    ];
    $result = $LOG->insertThis($input);
}


$result = $MP->selectThis(['id'=>$id]);
$check = $MPM->selectThis(['project_id'=>$id,'user_id'=>$session_user_id]);
$check = isset($check);

if(isset($result['id']) && $check ){
    $PROJECT = $result;

    $result = $MPS->selectThis(['id'=>$result['projectsetup_id']]);
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





