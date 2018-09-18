<?php
/**
 * Created by PhpStorm.
 * User: EPOP
 * Date: 5/30/2018
 * Time: 2:16 PM
 */
require_once __DIR__.'/ModelProject.php';
$MP = new ModelProject();


$fn = isset($_REQUEST['fn'])?$_REQUEST['fn']:'';
if($fn=='deleteProject'){
    $id = isset($_REQUEST['project_id'])?$_REQUEST['project_id']:'';
    $result = $MP->deleteProject($id);
}


$PROJECT = [];
$result = $MP->getProjectByUserId($user_id);
if(count($result)>0){
    $PROJECT = $result;
    foreach ($PROJECT as $key=>$item){
        $result = $MP->getProjectLastStatus($PROJECT[$key]['id']);
        $PROJECT[$key]['type']=$result['type'];
        $PROJECT[$key]['status']=$result['status'];
        $PROJECT[$key]['message']=$result['message'];
    }
}




