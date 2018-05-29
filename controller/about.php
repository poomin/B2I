<?php
/**
 * Created by PhpStorm.
 * User: Gimo
 * Date: 29/5/2561
 * Time: 23:54
 */
include_once __DIR__.'/ModelProjectSetup.php';
$MPS = new ModelProjectSetup();

$connect = '';
$result = $MPS->getProjectById($SETID);
if(isset($result['id'])){
    $connect = $result['connect'];
}