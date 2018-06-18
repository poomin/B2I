<?php

/**
 * Created by PhpStorm.
 * User: Gimo
 * Date: 31/5/2561
 * Time: 22:29
 */
include_once __DIR__.'/_PDO.php';

class ModelPost extends _PDO
{

    function addPost($input){
        $user_id = isset($input['user_id'])?$input['user_id']:'';
        $title = isset($input['title'])?$input['title']:'';
        $detail = isset($input['detail'])?$input['detail']:'';
        $type = isset($input['type'])?$input['type']:'';
        $path = isset($input['path'])?$input['path']:'';

        //connect DB
        $this->connect();
        $sql = "INSERT INTO b2i_post (user_id,title,details,type,path) 
        VALUES (:user_id,:title,:details,:type,:path)";
        $params= array(
            ':user_id'=> $user_id,
            ':title'=> $title,
            ':details'=> $detail,
            ':type'=> $type,
            ':path'=> $path
        );
        $lastId = $this->insert($sql,$params);

        //close DB
        $this->close();


        return $lastId;
    }

    function editPost($input){
        $user_id = isset($input['user_id'])?$input['user_id']:'';
        $title = isset($input['title'])?$input['title']:'';
        $detail = isset($input['detail'])?$input['detail']:'';
        $type = isset($input['type'])?$input['type']:'';
        $path = isset($input['path'])?$input['path']:'';
        $id = isset($input['id'])?$input['id']:'';

        //connect DB
        $this->connect();
        $sql = "UPDATE b2i_post SET user_id=:user_id,title=:title,details=:details,type=:type,path=:path WHERE id=:id";
        $params= array(
            ':user_id'=> $user_id,
            ':title'=> $title,
            ':details'=> $detail,
            ':type'=> $type,
            ':path'=> $path,
            ':id'=> $id
        );
        $lastId = $this->update($sql,$params);

        //close DB
        $this->close();


        return $lastId;
    }

    function getPostAll(){
        $this->connect();
        $sql = "select * from  b2i_post ORDER BY id DESC";
        $params= array();
        $result = $this->queryAll($sql,$params);
        $this->close();
        return $result;
    }

    function getPostById($id){
        $this->connect();
        $sql = "select * from  b2i_post WHERE id=:id";
        $params= array(':id'=> $id);
        $result = $this->query($sql,$params);
        $this->close();
        return $result;
    }

    function getPostPage($page , $type=''){
        $this->connect();
        $page = ($page-1) * 5;
        $page = $page>0?$page:0;

        $sql_type = "";
        if($type!=''){
            $sql_type = " WHERE `type` = '$type' ";
        }
        $sql = "select * from  b2i_post $sql_type ORDER BY id DESC LIMIT ".$page.",5";

        $params= array();
        $result = $this->queryAll($sql,$params);
        $this->close();
        return $result;
    }
    function getPostPageCount($type=''){
        $this->connect();
        $sql_type = "";
        if($type!=''){
            $sql_type = " WHERE `type` = '$type' ";
        }
        $sql = "select id from  b2i_post $sql_type";
        $params= array();
        $result = $this->queryAll($sql,$params);
        $this->close();
        return count($result);
    }
    function getPostSearch($search=''){
        $this->connect();
        $sql = "select * from  b2i_post WHERE title LIKE '%$search%'";
        $params= array();
        $result = $this->queryAll($sql,$params);
        $this->close();
        return $result;
    }

    function getTopPost($limit){
        $this->connect();
        $sql = "select * from  b2i_post ORDER BY view DESC LIMIT ".$limit;
        $params= array();
        $result = $this->queryAll($sql,$params);
        $this->close();
        return $result;
    }

    function countAddViewPost($id){
        //connect DB
        $this->connect();
        $sql = "UPDATE b2i_post SET `view` = (`view` + 1) WHERE id=:id";
        $params= array(':id'=> $id );
        $lastId = $this->update($sql,$params);

        //close DB
        $this->close();


        return $lastId;
    }
    function countSubViewPost($id){
        //connect DB
        $this->connect();
        $sql = "UPDATE b2i_post SET `view` = (`view` - 1) WHERE id=:id";
        $params= array(':id'=> $id );
        $lastId = $this->update($sql,$params);

        //close DB
        $this->close();


        return $lastId;
    }
    function countAddCommentPost($id){
        //connect DB
        $this->connect();
        $sql = "UPDATE b2i_post SET `comment` = (`comment` + 1) WHERE id=:id";
        $params= array(':id'=> $id );
        $lastId = $this->update($sql,$params);

        //close DB
        $this->close();


        return $lastId;
    }
    function countSubCommentPost($id){
        //connect DB
        $this->connect();
        $sql = "UPDATE b2i_post SET `comment` = (`comment` - 1) WHERE id=:id";
        $params= array(':id'=> $id );
        $lastId = $this->update($sql,$params);

        //close DB
        $this->close();


        return $lastId;
    }

}