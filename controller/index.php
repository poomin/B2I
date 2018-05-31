<?php
/**
 * Created by PhpStorm.
 * User: EPOP
 * Date: 5/31/2018
 * Time: 12:52 PM
 */
require_once __DIR__.'/ModelUpload.php';
$MUP = new ModelUpload();

$IMAGE = [];

$result = $MUP->getImageProjectSetup();
if(count($result)>0){
    $IMAGE = $result;
}