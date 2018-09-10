<?php
/**
 * Created by PhpStorm.
 * User: Gimo
 * Date: 29/5/2561
 * Time: 18:45
 */
require_once __DIR__.'/ModelUser.php';
require_once __DIR__.'/ModelSchool.php';
$MS = new ModelSchool();

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
        'password'=> $password,
        'email'=> $email,
        'name'=> $name,
        'surname'=> $surname,
        'schoolname'=> $schoolname,
        'schoolregion'=> $schoolregion,
        'role'=> $role
    ];
    $MU = new ModelUser();
    $result = $MU->addUser($input);
    if($result>0){
        $l = $MU->link('index-login.php');
        exit;
    }else{

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
        'name'=>$name,
        'address'=>$address,
        'subdistrict'=>$subdistrict,
        'district'=>$district,
        'province'=>$province,
        'code'=>$code
    ];
    $result = $MS->addSchool($input);
}

$SCHOOL = [];
$result = $MS->getSchoolAll();
if(count($result) > 0){
    $SCHOOL = $result;
}
