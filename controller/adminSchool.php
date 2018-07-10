<?php
/**
 * Created by PhpStorm.
 * User: Gimo
 * Date: 29/5/2561
 * Time: 16:39
 */
require_once __DIR__.'/ModelSchool.php';
$MS = new  ModelSchool();

$fn = isset($_REQUEST['fn'])?$_REQUEST['fn']:'';
if($fn=='insertSchool'){
    $name = isset($_REQUEST['name'])?$_REQUEST['name']:'';
    $result = $MS->addSchool(['name'=>$name]);
}
elseif($fn=='deleteSchool'){
    $name = isset($_REQUEST['name'])?$_REQUEST['name']:'';
    $result = $MS->deleteSchool($name);
}

$SCHOOL = [];
$result = $MS->getSchoolAll();
if(count($result)>0){
    $SCHOOL = $result;
}



