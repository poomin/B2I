<?php
/**
 * Created by PhpStorm.
 * User: EPOP
 * Date: 5/31/2018
 * Time: 12:52 PM
 */
require_once __DIR__.'/../model/ModelUpload.php';
include_once __DIR__.'/../model/ModelProjectSetup.php';
$MPS = new ModelProjectSetup();
$MUP = new ModelUpload();

$IMAGE = [];

$result = $MUP->selectAllSql(" order by id DESC");
if(count($result)>0){
    $IMAGE = $result;
}

$result = $MPS->selectThis(['active'=>'Y']);
$img = '/../images/header-mini.jpg';
if(isset($result['id'])){
    $img = '/..'.$result['image'];
}