<?php
/**
 * Created by PhpStorm.
 * User: Gimo
 * Date: 31/5/2561
 * Time: 23:57
 */
include_once __DIR__.'/../model/ModelPost.php';
include_once __DIR__.'/../model/ModelProjectSetup.php';
$MPS = new ModelProjectSetup();
$MP = new ModelPost();
$NEWS = [];
$TOPNEWS = [];
$ALLPAGE = 1;
$SHOW_LIST_SET = 10;

$page= $MP->input('page',1);
$type = $MP->input('type');
$search = $MP->input('search');

if($search!=''){
    $sql = " WHERE title LIKE '%$search%' ORDER BY id DESC LIMIT 20 ";
    $result = $MP->selectAllSql($sql);
    if(count($result)>0){
        $NEWS=$result;
        $ALLPAGE = 1;
    }
}else{

    $limit = ($page-1) * $SHOW_LIST_SET;
    $limit = $limit>0?$limit:0;

    $sql = "";
    if($type!=''){
        $sql = " WHERE `type` = '$type' ";
    }
    $sql = $sql." ORDER BY id DESC LIMIT $limit , $SHOW_LIST_SET ";

    $result = $MP->selectAllSql($sql);
    if(count($result)>0){
        $NEWS=$result;

        $sql = "";
        if($type!=''){
            $sql = " WHERE `type` = '$type' ";
        }
        $countPage = $MP->selectAllSql($sql);
        $countPage = count($countPage);
        $ALLPAGE = intval($countPage/$SHOW_LIST_SET);
        $ALLPAGE = $countPage%$SHOW_LIST_SET==0?$ALLPAGE:$ALLPAGE+1;
    }
}

$sql = "  ORDER BY view DESC LIMIT 3 ";
$result = $MP->selectAllSql($sql);
if(count($result) > 0){
    $TOPNEWS = $result;
}

$result = $MPS->selectThis(['active'=>'Y']);
$img = '/../images/header-mini.jpg';
if(isset($result['id'])){
    $img = '/..'.$result['image'];
}