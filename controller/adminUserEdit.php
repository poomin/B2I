<?php
/**
 * Created by PhpStorm.
 * User: EPOP
 * Date: 5/31/2018
 * Time: 2:44 PM
 */
require_once __DIR__.'/../model/ModelUser.php';
require_once __DIR__.'/../model/ModelSchool.php';
$MS = new ModelSchool();
$MU = new ModelUser();

$USER = [];

$fn = $MU->input('fn');
$id = $MU->input('id');


if($fn=='editUser'){
    $email = $MU->input('email');
    $name = $MU->input('name');
    $surname = $MU->input('surname');
    $schoolname = $MU->input('schoolname');
    $schoolregion = $MU->input('schoolregion');
    $role = $MU->input('role');

    $input = [
        'email'=> $email,
        'name'=> $name,
        'surname'=> $surname,
        'schoolname'=> $schoolname,
        'schoolregion'=> $schoolregion,
        'role'=>$role
    ];

    $result = $MU->editThis($input,['id'=>$id]);
    if($result > 0 ){
        $_SESSION['E_STATUS'] = 'success';
        $_SESSION['E_MESSAGE'] = 'Edit User Success.';
        $l = $MU->link('admin-user-edit.php?id='.$id);
        exit;
    }else{
        $_SESSION['E_STATUS'] = 'warning';
        $_SESSION['E_MESSAGE'] = 'Edit User Fail !!!!!';
        $l = $MU->link('admin-user-edit.php?id='.$id);
        exit;
    }

}

$result = $MU->selectThis(['id'=>$id]);
if(isset($result['id'])){
    $USER = $result;
}

$SCHOOL = [];
$result = $MS->selectAllThis();
if(count($result) > 0){
    $SCHOOL = $result;
}
