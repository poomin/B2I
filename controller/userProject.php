<?php
/**
 * Created by PhpStorm.
 * User: EPOP
 * Date: 5/30/2018
 * Time: 2:16 PM
 */
require_once __DIR__.'/../model/ModelProject.php';
$MP = new ModelProject();


$fn = $MP->input('fn');
if($fn=='deleteProject'){
    $id = $MP->input('project_id');
    $result = $MP->deleteThis(['id'=>$id]);
}


$PROJECT = [];
$result = $MP->selectForUserProject($user_id,$SETID);
if(count($result)>0){
    $PROJECT = $result;
    foreach ($PROJECT as $key=>$item){
        $result = $MP->getProjectLastStatus($PROJECT[$key]['id']);
        $PROJECT[$key]['type']=$result['type'];
        $PROJECT[$key]['status']=$result['status'];
        $PROJECT[$key]['message']=$result['message'];
    }
}




