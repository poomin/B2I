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


//delete image projectSetup
elseif($fn=='deleteImageProjectSetup'){
    require_once __DIR__.'/ModelUpload.php';
    $MUP = new ModelUpload();
    $id = isset($_REQUEST['id'])?$_REQUEST['id']:'';
    $result = $MUP->deleteImageProjectSetup($id);
    echo json_encode([
        'status'=> true,
        'message'=>'success',
        'data'=>$result
    ]);
    exit;
}

//post
elseif($fn=='addPost'){
    $user_id = isset($_REQUEST['user_id'])?$_REQUEST['user_id']:'';
    $title = isset($_REQUEST['title'])?$_REQUEST['title']:'';
    $detail = isset($_REQUEST['detail'])?$_REQUEST['detail']:'';
    $type = isset($_REQUEST['type'])?$_REQUEST['type']:'';
    $path = isset($_REQUEST['path'])?$_REQUEST['path']:'';
    $input= [
        'user_id'=> $user_id,
        'title'=> $title,
        'detail'=> $detail,
        'type'=> $type,
        'path'=> $path
    ];

    include_once __DIR__.'/ModelPost.php';
    $MPS = new ModelPost();
    $result = $MPS->addPost($input);

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
elseif($fn=='editPost'){
    $user_id = isset($_REQUEST['user_id'])?$_REQUEST['user_id']:'';
    $title = isset($_REQUEST['title'])?$_REQUEST['title']:'';
    $detail = isset($_REQUEST['detail'])?$_REQUEST['detail']:'';
    $type = isset($_REQUEST['type'])?$_REQUEST['type']:'';
    $path = isset($_REQUEST['path'])?$_REQUEST['path']:'';
    $id = isset($_REQUEST['id'])?$_REQUEST['id']:'';
    $input= [
        'user_id'=> $user_id,
        'title'=> $title,
        'detail'=> $detail,
        'type'=> $type,
        'path'=> $path,
        'id'=> $id
    ];

    include_once __DIR__.'/ModelPost.php';
    $MPS = new ModelPost();
    $result = $MPS->editPost($input);

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
elseif ($fn=='getPostById'){

    $id = isset($_REQUEST['id'])?$_REQUEST['id']:'';
    include_once __DIR__.'/ModelPost.php';
    $MPS = new ModelPost();
    $result = $MPS->getPostById($id);

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

else{
    echo json_encode([
       'status'=> false,
        'message'=>'Not Function Service',
        'data'=>[]
    ]);
}
exit;