<?php
/**
 * Created by PhpStorm.
 * User: EPOP
 * Date: 6/4/2018
 * Time: 12:20 PM
 */
date_default_timezone_set("Asia/Bangkok");
$SETID = 1;
if(isset($_SESSION['role']) && isset($_SESSION['SETID'])){
    if($_SESSION['role']=='admin' || $_SESSION['role']=='board' || $_SESSION['role']=='company'){
        $SETID = $_SESSION['SETID'];
    }else{
        header("Location: /index-login.php");
        exit;
    }
}else{
    header("Location: /index-login.php");
    exit;
}
