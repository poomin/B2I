<?php
/**
 * Created by PhpStorm.
 * User: EPOP
 * Date: 6/4/2018
 * Time: 12:20 PM
 */
$SETID = 1;
if(isset($_SESSION['id'])){
}else{
    header("Location: /index-login.php");
    exit;
}
