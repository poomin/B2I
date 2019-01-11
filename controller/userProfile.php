<?php
/**
 * Created by PhpStorm.
 * User: EPOP
 * Date: 5/31/2018
 * Time: 2:44 PM
 */
require_once __DIR__.'/../model/ModelUser.php';
require_once __DIR__.'/../model/ModelSchool.php';
$MU = new ModelUser();
$MS = new ModelSchool();


$fn = isset($_REQUEST['fn'])?$_REQUEST['fn']:'';
if($fn=='editUser'){
    $id = isset($_REQUEST['id'])?$_REQUEST['id']:'';
    $email = isset($_REQUEST['email'])?$_REQUEST['email']:'';
    $name = isset($_REQUEST['name'])?$_REQUEST['name']:'';
    $surname = isset($_REQUEST['surname'])?$_REQUEST['surname']:'';
    $schoolname = isset($_REQUEST['schoolname'])?$_REQUEST['schoolname']:'';
    $schoolregion = isset($_REQUEST['schoolregion'])?$_REQUEST['schoolregion']:'';

    $input = [
        'email'=> $email,
        'name'=> $name,
        'surname'=> $surname,
        'schoolname'=> $schoolname,
        'schoolregion'=> $schoolregion
    ];
    $result = $MU->editThis($input,['id'=>$id]);
    if($result > 0 ){
        $_SESSION['email']= $email;
        $_SESSION['name']= $name;
        $_SESSION['surname']= $surname;
        $_SESSION['schoolname']= $schoolname;
        $_SESSION['schoolregion']= $schoolregion;

        $_SESSION['success']="Edit User Success.";
    }else{
        $_SESSION['error']="Edit User Fail !!!!!";
    }

}
if($fn=='editPassword'){
    $id = isset($_REQUEST['id'])?$_REQUEST['id']:'';
    $password = isset($_REQUEST['password'])?$_REQUEST['password']:'';
    $oldPassword = isset($_REQUEST['oldPassword'])?$_REQUEST['oldPassword']:'';
    $username = isset($_REQUEST['username'])?$_REQUEST['username']:'';

    $oldPassword = md5($oldPassword);
    $password = md5($password);

    $input = [
        'username'=> $username,
        'password'=> $password,
    ];
    $result = $MU->editThis($input,['id'=>$id,'password'=>$oldPassword]);
    if($result > 0 ){
        $_SESSION['username']= $username;
        $_SESSION['success']="Edit Username Password Success.";
    }else{
        $_SESSION['error']="Edit Username Password Fail !!!!!";
    }

}


$SCHOOL = [];
$result = $MS->getSchoolAll();
if(count($result) > 0){
    $SCHOOL = $result;
}