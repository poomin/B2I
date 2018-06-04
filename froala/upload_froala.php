<?php
/**
 * Created by PhpStorm.
 * User: EPOP
 * Date: 6/7/2017
 * Time: 12:22 PM
 */

header("content-type: application/json;charset=utf-8");

$host = $_SERVER['SERVER_NAME'];
if($host=='localhost'){
    $targetFolder = '/froala/upload/';  //for localhost
}else{
    $targetFolder = '/B2I/froala/upload/';    //for server
}

if (!empty($_FILES)) {
    $tempFile = $_FILES['file']['tmp_name'];
    $extension = strtolower(pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION));
    $name_file = $_FILES['file']['name'];

    $t=time();
    $change_name = "froala_".$t.".".$extension;

    $targetFile = dirname(__FILE__).'/upload/'.$change_name; //rtrim($targetPath, '/') . '/libs/froala/img/'.$change_name;
    $dir = dirname(__FILE__) . '/upload/';
    if (!is_dir($dir)) {
        mkdir($dir, 0777, true);
    }
    if(move_uploaded_file($tempFile, $targetFile)){
        echo json_encode(['link'=> $targetFolder.$change_name]);
    }else {
        echo error_get_last();
    }

}else{
    echo 'not file';
}