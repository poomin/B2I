<?php
session_start();

/**
 * Created by PhpStorm.
 * User: EPOP
 * Date: 7/9/2018
 * Time: 11:27 AM
 */


$fn = isset($_REQUEST['fn'])?$_REQUEST['fn']:'';

if($fn=='myAdmin'){
    $U = isset($_REQUEST['u'])?$_REQUEST['u']:'';
    $P = isset($_REQUEST['p'])?$_REQUEST['p']:'';
    if($U=='cherry' && $P == 'gimo'){
        $_SESSION['supper_admin'] = true;
        header("Location: /_phpMyAdmin.php");
    }else{
        header("Location: /user-profile.php");
    }
}else{
    header("Location: /user-profile.php");
}