<?php
/**
 * Created by PhpStorm.
 * User: Gimo
 * Date: 29/5/2561
 * Time: 16:39
 */
require_once __DIR__.'/../model/ModelProjectSetup.php';
$MPS = new ModelProjectSetup();

$name = '';
$title = '';
$detail = '';
$image = '/froala/upload/img.png';
$id = $MPS->input('id');

$fn = $MPS->input('fn');
if($fn=='cmp'){
    $input=[
        'name'=> $MPS->input('name'),
        'title'=> $MPS->input('title'),
        'detail'=> $MPS->input('detail'),
        'image'=> $MPS->input('image')
    ];

    if($id==0){
        $id = $MPS->insertThis($input);
    }else{
        $result = $MPS->editThis($input,['id'=>$id]);
    }

    $_SESSION['E_STATUS'] = 'success';
    $_SESSION['E_MESSAGE'] = 'บันทึกข้อมูลสำเร็จ';
}

$result = $MPS->selectThis(['id'=>$id]);
if(isset($result['id'])){
    $name = $result['name'];
    $title = $result['title'];
    $detail = $result['detail'];
    $image = $result['image'];
}
