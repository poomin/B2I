<?php
/**
 * Created by PhpStorm.
 * User: EPOP
 * Date: 7/9/2018
 * Time: 12:23 PM
 */

require_once __DIR__."/_phpMyAdminModel.php";

$AM = new _phpMyAdminModel();

$TABLETHIS = isset($_REQUEST['table'])?$_REQUEST['table']:'';



$TABLELIST = [];
$result = $AM->getTables();
if(count($result) > 0){
    $TABLELIST = $result;
}


$ATTRIBUTES = [];
$result = $AM->getAttribute($TABLETHIS);
if(count($result)>0){
    $ATTRIBUTES = $result;
}


$DATALIST = [];
$result = $AM->getDataAll($TABLETHIS);
if(count($result)>0){
    $DATALIST = $result;
}
