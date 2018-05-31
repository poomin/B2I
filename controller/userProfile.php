<?php
/**
 * Created by PhpStorm.
 * User: EPOP
 * Date: 5/31/2018
 * Time: 2:44 PM
 */
require_once __DIR__.'/ModelUser.php';
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
        'schoolregion'=> $schoolregion,
        'id'=> $id
    ];
    $MU = new ModelUser();
    $result = $MU->editUser($input);
    if($result > 0 ){
        $_SESSION['email']= $email;
        $_SESSION['name']= $name;
        $_SESSION['surname']= $surname;
        $_SESSION['schoolname']= $schoolname;
        $_SESSION['schoolregion']= $schoolregion;

        $_SESSION['success']="Edit User Success.";
        header("Location: /user-profile.php");
        exit;
    }else{
        $_SESSION['error']="Edit User Fail !!!!!";
        header("Location: /user-profile.php");
        exit;
    }

}