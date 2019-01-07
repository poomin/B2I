<?php
/**
 * Created by PhpStorm.
 * User: Gimo
 * Date: 29/5/2561
 * Time: 18:45
 */
require_once __DIR__.'/../model/ModelUser.php';
require_once __DIR__.'/../model/ModelSchool.php';
$MS = new ModelSchool();
$MU = new ModelUser();

$fn = isset($_REQUEST['fn'])?$_REQUEST['fn']:'';
if($fn=='addUser'){
    $username = isset($_REQUEST['username'])?$_REQUEST['username']:'';
    $password = isset($_REQUEST['password'])?$_REQUEST['password']:'';
    $email = isset($_REQUEST['email'])?$_REQUEST['email']:'';
    $name = isset($_REQUEST['name'])?$_REQUEST['name']:'';
    $surname = isset($_REQUEST['surname'])?$_REQUEST['surname']:'';
    $schoolname = isset($_REQUEST['schoolname'])?$_REQUEST['schoolname']:'';
    $schoolregion = isset($_REQUEST['schoolregion'])?$_REQUEST['schoolregion']:'';
    $role = isset($_REQUEST['role'])?$_REQUEST['role']:'';
    $input = [
        'username'=> $username,
        'password'=> md5($password),
        'email'=> $email,
        'name'=> $name,
        'surname'=> $surname,
        'schoolname'=> $schoolname,
        'schoolregion'=> $schoolregion,
        'role'=> $role
    ];
    $result = $MU->insertThis($input);
    if($result>0){
        $l = $MU->link('index-login.php');
        exit;
    }else{
        $_SESSION['E_STATUS'] = 'warning';
        $_SESSION['E_MESSAGE'] = 'Please check Username duplicate !!';
    }
}

elseif($fn=='insertSchool'){
    $name = isset($_REQUEST['name'])?$_REQUEST['name']:'';
    $address = isset($_REQUEST['address'])?$_REQUEST['address']:'';
    $subdistrict = isset($_REQUEST['subdistrict'])?$_REQUEST['subdistrict']:'';
    $district = isset($_REQUEST['district'])?$_REQUEST['district']:'';
    $province = isset($_REQUEST['province'])?$_REQUEST['province']:'';
    $code = isset($_REQUEST['code'])?$_REQUEST['code']:'';
    $input = [
        'school_name'=>$name,
        'address'=>$address,
        'subdistrict'=>$subdistrict,
        'district'=>$district,
        'province'=>$province,
        'code'=>$code
    ];
    $result = $MS->insertThis($input);
}

$SCHOOL = [];
$result = $MS->selectAllThis();
if(count($result) > 0){
    $SCHOOL = $result;
}
