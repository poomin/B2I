<?php
/**
 * Created by PhpStorm.
 * User: Gimo
 * Date: 29/5/2561
 * Time: 22:40
 */

require_once __DIR__.'/../model/ModelUser.php';
require_once __DIR__.'/../model/ModelProjectSetup.php';
$MPS = new ModelProjectSetup();
$MU = new ModelUser();

$fn = $MU->input('fn');
if($fn=='login'){
    $username = $MU->input('username');
    $password = $MU->input('password');

    $input = [
        'username'=> $username,
        'password'=> md5($password)
    ];

    $result = $MU->selectThis($input);
    $res = $MPS->selectThis(['active'=>'Y']);

    if(count($result) > 0 && isset($result['id']) && isset($res['id'])){
        $_SESSION = $result;
        $_SESSION['SETID'] = $res['id'];

        $l = $MU->link('user-profile.php');
        exit;
    }else{
        $_SESSION['E_STATUS'] = 'warning';
        $_SESSION['E_MESSAGE'] = 'กรุณาตรวจสอบ Username , Password !!!!!';
    }
}