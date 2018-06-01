<?php
/**
 * Created by PhpStorm.
 * User: EPOP
 * Date: 5/30/2018
 * Time: 2:16 PM
 */
require_once __DIR__.'/ModelProject.php';
require_once __DIR__.'/ModelProjectSetup.php';
require_once __DIR__.'/ModelUser.php';
$MP = new ModelProject();
$MPS = new ModelProjectSetup();
$MU = new ModelUser();

$projectSetup=[];
$USER = [];

$fn = isset($_REQUEST['fn'])?$_REQUEST['fn']:'';
if($fn=='addProject'){
    $user_id = isset($_REQUEST['user_id'])?$_REQUEST['user_id']:'';
    $projectsetup_id = isset($_REQUEST['projectsetup_id'])?$_REQUEST['projectsetup_id']:'';
    $name = isset($_REQUEST['name'])?$_REQUEST['name']:'';
    $schoolname = isset($_REQUEST['schoolname'])?$_REQUEST['schoolname']:'';
    $schoolregion = isset($_REQUEST['schoolregion'])?$_REQUEST['schoolregion']:'';
    $detail = isset($_REQUEST['detail'])?$_REQUEST['detail']:'';
    $member = isset($_REQUEST['member'])?$_REQUEST['member']:'';
    $input=[
        'projectsetup_id'=> $projectsetup_id,
        'name'=> $name,
        'schoolname'=> $schoolname,
        'schoolregion'=> $schoolregion,
        'detail'=> $detail,
        'user_id'=> $user_id,
        'member'=> $member,
    ];
    $result = $MP->addProject($input);
    if($result >0){
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
$result = $MU->getUserRole('student');
if(count($result)>0){
    $USER = $result;
}



