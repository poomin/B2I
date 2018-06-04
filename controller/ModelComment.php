<?php

/**
 * Created by PhpStorm.
 * User: EPOP
 * Date: 6/1/2018
 * Time: 5:55 PM
 */
require_once __DIR__.'/_PDO.php';

class ModelComment extends _PDO
{

    function addComment($input){
        $user_id = isset($input['user_id'])?$input['user_id']:'';
        $post_id = isset($input['post_id'])?$input['post_id']:'';
        $details = isset($input['details'])?$input['details']:'';

        //connect DB
        $this->connect();
        $sql = "INSERT INTO b2i_post_comment (user_id,post_id,details) 
        VALUES (:user_id,:post_id,:details)";
        $params= array(
            ':user_id'=> $user_id,
            ':post_id'=> $post_id,
            ':details'=> $details
        );
        $lastId = $this->insert($sql,$params);

        //close DB
        $this->close();


        return $lastId;
    }

    function getCommentByPostId($id){

        $this->connect();
        $sql = 'select b2i_post_comment.* , b2i_user.name , b2i_user.surname from b2i_post_comment
        left join b2i_user on b2i_post_comment.user_id = b2i_user.id
        where b2i_post_comment.post_id=:id ORDER BY b2i_post_comment.id DESC ';
        $params= array(':id'=> $id);
        $result = $this->queryAll($sql,$params);
        $this->close();
        return $result;


    }

}