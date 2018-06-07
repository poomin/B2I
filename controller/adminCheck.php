<?php
/**
 * Created by PhpStorm.
 * User: Gimo
 * Date: 29/5/2561
 * Time: 16:39
 */
require_once __DIR__.'/ModelProjectSetup.php';
require_once __DIR__.'/ModelProject.php';
$MPS = new ModelProjectSetup();
$MP = new ModelProject();



$PROJECTSETUP = [];
$PROJECTS = [];

$result = $MPS->getProjectById($SETID);
if(isset($result['id'])){
    $PROJECTSETUP = $result;

    $result = $MP->getProjectBySetupId($result['id']);
    if(count($result) > 0 ){
        $PROJECTS = $result;
    }



}




