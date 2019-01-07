<?php
/**
 * Created by PhpStorm.
 * User: Gimo
 * Date: 29/5/2561
 * Time: 16:39
 */
require_once __DIR__.'/../model/ModelSchool.php';
$MS = new  ModelSchool();

$fn = $MS->input('fn');
if($fn=='insertSchool'){
    $name = $MS->input('name');
    $address = $MS->input('address');
    $subdistrict = $MS->input('subdistrict');
    $district = $MS->input('district');
    $province = $MS->input('province');
    $code = $MS->input('code');
    $input = [
      'school_name'=>$name,
      'address'=>$address,
      'subdistrict'=>$subdistrict,
      'district'=>$district,
      'province'=>$province,
      'code'=>$code
    ];
    $lastId = $MS->insertThis($input);
    if($lastId>0){
        $_SESSION['E_STATUS'] = 'success';
        $_SESSION['E_MESSAGE'] = 'Add school success.';
    }else{
        $_SESSION['E_STATUS'] = 'warning';
        $_SESSION['E_MESSAGE'] = 'Add school Fail!! Check name school duplicate.';
    }
}

elseif($fn=='editSchool'){
    $id_name = $MS->input('id_name');
    $name = $MS->input('name');
    $address = $MS->input('address');
    $subdistrict = $MS->input('subdistrict');
    $district = $MS->input('district');
    $province = $MS->input('province');
    $code = $MS->input('code');
    $input = [
        'school_name'=>$name,
        'address'=>$address,
        'subdistrict'=>$subdistrict,
        'district'=>$district,
        'province'=>$province,
        'code'=>$code
    ];
    $result = $MS->editThis($input,['school_name'=>$id_name]);
    if($result>0){
        $_SESSION['E_STATUS'] = 'success';
        $_SESSION['E_MESSAGE'] = 'Edit school success.';
    }else{
        $_SESSION['E_STATUS'] = 'warning';
        $_SESSION['E_MESSAGE'] = 'Edit school Fail!! Check name school duplicate.';
    }
}

elseif($fn=='deleteSchool'){
    $name = $MS->input('delete_id');
    $result = $MS->deleteThis(['school_name'=>$name]);
    if($result>0){
        $_SESSION['E_STATUS'] = 'success';
        $_SESSION['E_MESSAGE'] = 'Delete school success.';
    }else{
        $_SESSION['E_STATUS'] = 'warning';
        $_SESSION['E_MESSAGE'] = 'Delete school Fail!! Check name school duplicate.';
    }
}

$SCHOOL = [];
$result = $MS->selectAllThis();
if(count($result)>0){
    $SCHOOL = $result;
}



