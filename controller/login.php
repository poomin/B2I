<?php
/**
 * Created by PhpStorm.
 * User: Gimo
 * Date: 29/5/2561
 * Time: 22:40
 */

require_once __DIR__.'/ModelUser.php';

$fn = isset($_REQUEST['fn'])?$_REQUEST['fn']:'';
if($fn=='login'){
    $username = isset($_REQUEST['username'])?$_REQUEST['username']:'';
    $password = isset($_REQUEST['password'])?$_REQUEST['password']:'';
    $MU = new ModelUser();
    $result = $MU->login($username,$password);
    if(count($result) > 0 && isset($result['id'])){
        $_SESSION = $result;
        header("Location: /user-profile.php");
        exit;
    }else{
        $_SESSION['error']="กรุณาตรวจสอบ Username , Password !!!!!";
        header("Location: /index-login.php");
        exit;
    }
}