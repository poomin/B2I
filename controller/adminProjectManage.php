<?php
/**
 * Created by PhpStorm.
 * User: EPOP
 * Date: 5/30/2018
 * Time: 2:16 PM
 */
require_once __DIR__.'/../model/ModelProjectSetup.php';

$MPS = new ModelProjectSetup();

$PROJECTSETUP=[];

$fn = $MPS->input('fn');
if($fn=='editPhase1Status'){
    $id = $MPS->input('id');
    $status = $MPS->input('phase1status','close');
    $detail = $MPS->input('phase1detail');
    $result = $MPS->editThis(['phase1status'=>$status,'phase1detail'=>$detail],['id'=>$id]);
    $a_active = 'F1';
    if($result>0){
        $_SESSION['E_STATUS'] = 'success';
        $_SESSION['E_MESSAGE'] = 'แก้ไขข้อมูลสำเร็จ';
    }else{
        $_SESSION['E_STATUS'] = 'warning';
        $_SESSION['E_MESSAGE'] = 'ไม่สามารถแก้ไขข้อมูลได้';
    }

}
elseif($fn=='editConfirm1Status'){
    $id = $MPS->input('id');
    $status = $MPS->input('confirm1status','close');
    $detail = $MPS->input('confirm1detail');
    $result = $MPS->editThis(['phase1confirm'=>$status,'phase1confirmdetail'=>$detail],['id'=>$id]);
    $a_active = 'CF1';
    if($result>0){
        $_SESSION['E_STATUS'] = 'success';
        $_SESSION['E_MESSAGE'] = 'แก้ไขข้อมูลสำเร็จ';
    }else{
        $_SESSION['E_STATUS'] = 'warning';
        $_SESSION['E_MESSAGE'] = 'ไม่สามารถแก้ไขข้อมูลได้';
    }
}
elseif($fn=='editPhase2Status'){
    $id = $MPS->input('id');
    $status = $MPS->input('phase2status','close');
    $detail = $MPS->input('phase2detail');
    $result = $MPS->editThis(['phase2status'=>$status,'phase2detail'=>$detail],['id'=>$id]);
    $a_active = 'F2';
    if($result>0){
        $_SESSION['E_STATUS'] = 'success';
        $_SESSION['E_MESSAGE'] = 'แก้ไขข้อมูลสำเร็จ';
    }else{
        $_SESSION['E_STATUS'] = 'warning';
        $_SESSION['E_MESSAGE'] = 'ไม่สามารถแก้ไขข้อมูลได้';
    }
}
elseif($fn=='editConfirm2Status'){
    $id = $MPS->input('id');
    $status = $MPS->input('confirm2status','close');
    $detail = $MPS->input('confirm2detail');
    $result = $MPS->editThis(['phase2confirm'=>$status,'phase2confirmdetail'=>$detail],['id'=>$id]);
    $a_active = 'CF2';
    if($result>0){
        $_SESSION['E_STATUS'] = 'success';
        $_SESSION['E_MESSAGE'] = 'แก้ไขข้อมูลสำเร็จ';
    }else{
        $_SESSION['E_STATUS'] = 'warning';
        $_SESSION['E_MESSAGE'] = 'ไม่สามารถแก้ไขข้อมูลได้';
    }
}
elseif($fn=='editPhase3Status'){
    $id = $MPS->input('id');
    $status = $MPS->input('phase3status','close');
    $detail = $MPS->input('phase3detail');
    $result = $MPS->editThis(['phase3status'=>$status,'phase3detail'=>$detail],['id'=>$id]);
    $a_active = 'F3';
    if($result>0){
        $_SESSION['E_STATUS'] = 'success';
        $_SESSION['E_MESSAGE'] = 'แก้ไขข้อมูลสำเร็จ';
    }else{
        $_SESSION['E_STATUS'] = 'warning';
        $_SESSION['E_MESSAGE'] = 'ไม่สามารถแก้ไขข้อมูลได้';
    }
}

$result = $MPS->selectThis(['id'=>$SETID]);
if(isset($result['id'])){
    $PROJECTSETUP = $result;
}





