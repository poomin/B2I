<?php
/**
 * Created by PhpStorm.
 * User: Gimo
 * Date: 29/5/2561
 * Time: 23:54
 */
include_once __DIR__.'/../model/ModelProjectSetup.php';
$MPS = new ModelProjectSetup();

$connect = '';
$result = $MPS->selectThis(['active'=>'Y']);
$img = '/../images/header-mini.jpg';
if(isset($result['id'])){
    $connect = $result['connect'];
    if($result['image']!=''){
        $img = '/..'.$result['image'];
    }
}