<?php
/**
 * Created by PhpStorm.
 * User: Gimo
 * Date: 29/5/2561
 * Time: 15:16
 */
require_once __DIR__.'/ModelProjectSetup.php';


$fn = isset($_REQUEST['fn'])?$_REQUEST['fn']:'';

//add detail project
if($fn=='addDetailProject'){
    $id = isset($_REQUEST['id'])?$_REQUEST['id']:'';
    $detail = isset($_REQUEST['detail'])?$_REQUEST['detail']:'';
    $text = isset($_REQUEST['text'])?$_REQUEST['text']:'';

    $MPS = new ModelProjectSetup();
    $result = $MPS->addDetailProject($id,$detail,$text);

    if($result>0){
        echo json_encode([
            'status'=> true,
            'message'=>'success',
            'data'=>$result
        ]);
        exit;
    }else{
        echo json_encode([
            'status'=> false,
            'message'=>'Not Function Service',
            'data'=>[]
        ]);
        exit;
    }

}
elseif($fn=='getProjectById'){
    $id = isset($_REQUEST['id'])?$_REQUEST['id']:'';
    $MPS = new ModelProjectSetup();
    $result = $MPS->getProjectById($id);
    if(count($result)>0){
        echo json_encode([
            'status'=> true,
            'message'=>'success',
            'data'=>$result
        ]);
        exit;
    }else{
        echo json_encode([
            'status'=> false,
            'message'=>'Error',
            'data'=>[]
        ]);
        exit;
    }
}
elseif($fn=='mail'){


}

else{
    echo json_encode([
       'status'=> false,
        'message'=>'Not Function Service',
        'data'=>[]
    ]);
}
exit;