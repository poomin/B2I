<?php
/**
 * Created by PhpStorm.
 * User: EPOP
 * Date: 5/30/2018
 * Time: 2:16 PM
 */
require_once __DIR__.'/../model/ModelProject.php';
require_once __DIR__.'/../model/ModelProjectSetup.php';
require_once __DIR__.'/../model/ModelUser.php';
$MP = new ModelProject();
$MPS = new ModelProjectSetup();
$MU = new ModelUser();

$id = $MP->input('id');

$projectSetup=[];
$USER = [];
$MEMBERS = [];
$PROJECT = [];

$fn = $MP->input('fn');
if($fn=='editProject'){
    $user_id = $MP->input('user_id');
    $projectsetup_id = $MP->input('projectsetup_id');
    $name = $MP->input('name');
    $schoolname = $MP->input('schoolname');
    $schoolregion = $MP->input('schoolregion');
    $detail = $MP->input('detail');
    $member = $MP->input('member');

    $input=[
        'projectsetup_id'=> $projectsetup_id,
        'name'=> $name,
        'schoolname'=> $schoolname,
        'schoolregion'=> $schoolregion,
        'detail'=> $detail,
        'user_id'=> $user_id,
        'member'=> $member
    ];
    $result = $MP->editThis($input,['id'=>$id]);

    if($result > 0){
        $_SESSION['success']=" Edit Project Success.";
        $l = $MU->link('user-team.php');
        exit;
    }else{
        $_SESSION['error']=" Can't Edit Project !!!!";
        $l = $MU->link('user-team-manage.php?id='.$id);
        exit;
    }
}

$result = $MU->selectAllThis(['role'=>'student']);
if(count($result)>0){
    $USER = $result;
}

$result = $MP->selectThis(['id'=>$id]);
if(isset($result['id'])){
    $PROJECT = $result;

    $result = $MPS->selectThis(['id'=>$result['projectsetup_id']]);
    if(isset($result['id'])){
        $projectSetup=$result;
    }

    $result = $MU->getUserByProjectId($id);
    if(count($result)>0){
        $MEMBERS = $result;
    }

}



