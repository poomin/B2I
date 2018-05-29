<?php
/**
 * Created by PhpStorm.
 * User: Gimo
 * Date: 29/5/2561
 * Time: 16:39
 */
require_once __DIR__.'/ModelProjectSetup.php';
$MPS = new ModelProjectSetup();

$name = '';
$title = '';
$detail = '';

$fn = isset($_REQUEST['fn'])?$_REQUEST['fn']:'';
if($fn=='cmp'){
    $name = isset($_REQUEST['name'])?$_REQUEST['name']:'';
    $title = isset($_REQUEST['title'])?$_REQUEST['title']:'';
    $detail =  isset($_REQUEST['detail'])?$_REQUEST['detail']:'';
    $id = isset($_REQUEST['id'])?$_REQUEST['id']:'';
    $MPS->updateProject($name,$title,$detail,$id);
    header("Location: /admin-project.php");
    exit;

}

$result = $MPS->getProjectById($id);
if(count($result)>0){
    $name = $result['name'];
    $title = $result['title'];
    $detail = $result['detail'];
}
