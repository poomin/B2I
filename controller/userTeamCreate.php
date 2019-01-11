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
require_once __DIR__.'/../model/ModelUser.php';
require_once __DIR__.'/../model/ModelSchool.php';

$MP = new ModelProject();
$MPM = new ModelProjectMember();
$MPS = new ModelProjectSetup();
$MU = new ModelUser();
$MS = new ModelSchool();

$projectSetup=[];
$USER = [];

$fn = $MP->input('fn');
if($fn=='addProject'){
    $user_id = $MP->input('user_id');
    $projectsetup_id = $MP->input('projectsetup_id');
    $name = $MP->input('name');
    $schoolname = $MP->input('schoolname');
    $schoolregion = $MP->input('schoolregion');
    $detail = $MP->input('detail');
    $member = $MP->input('member');

    $input = [
        'projectsetup_id'=> $projectsetup_id,
        'name'=> $name,
        'schoolname'=> $schoolname,
        'schoolregion'=> $schoolregion,
        'detail'=> $detail
    ];
    $project_id = $MP->insertThis($input);
    if($project_id > 0){

        //add header
        $input = [
            'project_id'=>$project_id,
            'user_id'=>$user_id,
            'membertype'=>'header'
        ];
        $result = $MPM->insertThis($input);

        //add member
        if($member!=''){
            $cut = explode("-",$member);
            foreach ($cut as $item){
                $input = [
                    'project_id'=>$project_id,
                    'user_id'=>$item,
                    'membertype'=>'member'
                ];
                $result = $MPM->insertThis($input);
            }
        }

        $_SESSION['success']=" Create Project Success.";
        $l = $MU->link('user-team.php');
        exit;
    }else{
        $_SESSION['error']=" Can't Create Project !!!!";
        $l = $MU->link('user-team-create.php');
        exit;
    }
}

$result = $MPS->getProjectById($SETID);
if(isset($result['id'])){
    $projectSetup=$result;
}
$result = $MU->selectAllThis(['role'=>'student']);
if(count($result)>0){
    $USER = $result;
}

$SCHOOL = [];
$result = $MS->selectAllThis([]);
if(count($result) > 0){
    $SCHOOL = $result;
}



