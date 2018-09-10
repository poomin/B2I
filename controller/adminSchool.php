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
    $address = isset($_REQUEST['address'])?$_REQUEST['address']:'';
    $subdistrict = isset($_REQUEST['subdistrict'])?$_REQUEST['subdistrict']:'';
    $district = isset($_REQUEST['district'])?$_REQUEST['district']:'';
    $province = isset($_REQUEST['province'])?$_REQUEST['province']:'';
    $code = isset($_REQUEST['code'])?$_REQUEST['code']:'';
    $input = [
      'name'=>$name,
      'address'=>$address,
      'subdistrict'=>$subdistrict,
      'district'=>$district,
      'province'=>$province,
      'code'=>$code
    ];
    $result = $MS->addSchool($input);
}

elseif($fn=='editSchool'){
    $id_name = isset($_REQUEST['id_name'])?$_REQUEST['id_name']:'';
    $name = isset($_REQUEST['name'])?$_REQUEST['name']:'';
    $address = isset($_REQUEST['address'])?$_REQUEST['address']:'';
    $subdistrict = isset($_REQUEST['subdistrict'])?$_REQUEST['subdistrict']:'';
    $district = isset($_REQUEST['district'])?$_REQUEST['district']:'';
    $province = isset($_REQUEST['province'])?$_REQUEST['province']:'';
    $code = isset($_REQUEST['code'])?$_REQUEST['code']:'';
    $input = [
        'name_old'=>$id_name,
        'name_new'=>$name,
        'address'=>$address,
        'subdistrict'=>$subdistrict,
        'district'=>$district,
        'province'=>$province,
        'code'=>$code
    ];
    $result = $MS->editSchool($input);
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



