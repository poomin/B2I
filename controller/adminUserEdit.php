<?php
/**
 * Created by PhpStorm.
 * User: EPOP
 * Date: 5/31/2018
 * Time: 2:44 PM
 */
require_once __DIR__.'/ModelUser.php';

$USER = [];

$fn = isset($_REQUEST['fn'])?$_REQUEST['fn']:'';
$id = isset($_REQUEST['id'])?$_REQUEST['id']:'';


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

        $_SESSION['success']="Edit User Success.";
        $l = $MU->link('admin-user-edit.php?id='.$id);
        exit;
    }else{
        $_SESSION['error']="Edit User Fail !!!!!";
        $l = $MU->link('admin-user-edit.php?id='.$id);
        exit;
    }

}

$MU = new ModelUser();
$result = $MU->getUserById($id);
if(isset($result['id'])){
    $USER = $result;
}
