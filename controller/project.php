<?php
/**
 * Created by PhpStorm.
 * User: Gimo
 * Date: 29/5/2561
 * Time: 23:35
 */
include_once __DIR__.'/ModelProjectSetup.php';
$MPS = new ModelProjectSetup();

$manager = '';
$rationale = '';
$objective ='';
$criteria ='';
$award ='';
$result = $MPS->getProjectById($SETID);
if(isset($result['id'])){
    $manager = $result['manager'];
    $rationale = $result['rationale'];
    $objective = $result['objective'];
    $criteria = $result['criteria'];
    $award = $result['award'];
}