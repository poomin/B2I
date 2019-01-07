<?php
/**
 * Created by PhpStorm.
 * User: Gimo
 * Date: 29/5/2561
 * Time: 15:16
 */


$fn = isset($_REQUEST['fn'])?$_REQUEST['fn']:'';

//add detail project
if($fn=='addDetailProject'){
    require_once __DIR__.'/../model/ModelProjectSetup.php';
    $MPS = new ModelProjectSetup();

    $id = $MPS->input('id');
    $detail = $MPS->input('detail');
    $text = $MPS->input('text');

    //$result = $MPS->addDetailProject($id,$detail,$text);
    $result = $MPS->editThis(["$detail"=>$text],['id'=>$id]);

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
    require_once __DIR__.'/../model/ModelProjectSetup.php';
    $MPS = new ModelProjectSetup();

    $id = $MPS->input('id');
    $result = $MPS->getProjectById($id);$MPS->selectThis(['id'=>$id]);

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
    include_once __DIR__.'/../model/ModelPost.php';
    $MPS = new ModelPost();

    $user_id = $MPS->input('user_id');
    $title = $MPS->input('title');
    $detail = $MPS->input('detail');
    $type = $MPS->input('type');
    $path = $MPS->input('path');

    $input= [
        'user_id'=> $user_id,
        'title'=> $title,
        'details'=> $detail,
        'type'=> $type,
        'path'=> $path
    ];

    $result = $MPS->insertThis($input);

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

    include_once __DIR__.'/../model/ModelPost.php';
    $MPS = new ModelPost();

    $user_id = $MPS->input('user_id');
    $title = $MPS->input('title');
    $detail = $MPS->input('detail');
    $type = $MPS->input('type');
    $path = $MPS->input('path');
    $id = $MPS->input('id');
    $input= [
        'user_id'=> $user_id,
        'title'=> $title,
        'details'=> $detail,
        'type'=> $type,
        'path'=> $path,
    ];


    $result = $MPS->editThis($input,['id'=>$id]);

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

    include_once __DIR__.'/../model/ModelPost.php';
    $MPS = new ModelPost();

    $id = $MPS->input('id');
    $result = $MPS->selectThis(['id'=>$id]);

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