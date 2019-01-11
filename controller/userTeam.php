<?php
/**
 * Created by PhpStorm.
 * User: EPOP
 * Date: 5/30/2018
 * Time: 2:16 PM
 */
require_once __DIR__.'/../model/ModelProject.php';
$MP = new ModelProject();


$PROJECT = [];
$result = $MP->getProjectByUserId($user_id);
if(count($result)>0){
    $PROJECT = $result;
}



