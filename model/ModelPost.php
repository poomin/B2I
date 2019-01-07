<?php

/**
 * Created by PhpStorm.
 * User: Gimo
 * Date: 31/5/2561
 * Time: 22:29
 */
include_once __DIR__.'/_DBPDO.php';

class ModelPost extends _DBPDO
{

    public $DB = "b2i_post";

    function insertThis($input){
        $this_db = $this->DB;

        $data_sql = $this->convertArrayToInsert($input);
        if(count($data_sql)<=0){
            return 0;
        }else{

            //connect DB
            $this->connect();
            $sql_value = $data_sql['value'];
            $sql = "INSERT INTO $this_db $sql_value";
            $params = $data_sql['params'];
            $lastId = $this->insert($sql,$params);

            //close DB
            $this->close();
            return $lastId;
        }
    }
    function editThis($input , $condition){
        $this_db = $this->DB;

        $data_sql = $this->convertArrayToUpdate($input,$condition);
        if(count($data_sql['params'])<=0){
            return 0;
        }else {
            //connect DB
            $this->connect();
            $sql_value = $data_sql['value'];
            $sql = "UPDATE $this_db $sql_value";
            $params = $data_sql['params'];
            $lastId = $this->update($sql,$params);

            //close DB
            $this->close();
            return $lastId;
        }
    }
    function deleteThis($condition){
        $this_db = $this->DB;
        //set parameter

        $data_sql = $this->convertArrayToCondition($condition);
        $sql_value = $data_sql['value'];
        $params = $data_sql['params'];

        //connect DB
        $this->connect();
        $sql = "DELETE FROM $this_db ".$sql_value;
        $rowUpdate = $this->update($sql,$params);
        //close DB
        $this->close();


        return $rowUpdate;
    }
    function selectThis($condition){
        //set parameter
        $this_db = $this->DB;

        //condition
        $data_sql = $this->convertArrayToCondition($condition);
        $sql_value = $data_sql['value'];
        $params = $data_sql['params'];

        //connect DB
        $this->connect();
        $sql = "SELECT * FROM $this_db ".$sql_value;
        $result = $this->query($sql,$params);
        //close DB
        $this->close();


        return $result;

    }
    function selectAllThis($condition){
        //set parameter
        $this_db = $this->DB;

        //condition
        $data_sql = $this->convertArrayToCondition($condition);
        $sql_value = $data_sql['value'];
        $params = $data_sql['params'];

        //connect DB
        $this->connect();
        $sql = "SELECT * FROM $this_db ".$sql_value ." ORDER BY updateat DESC ";
        $result = $this->queryAll($sql,$params);
        //close DB
        $this->close();


        return $result;

    }
    function selectAllSql($conditionSql){
        //set parameter
        $this_db = $this->DB;

        //connect DB
        $this->connect();
        $sql = "SELECT * FROM $this_db ".$conditionSql;
        $params= array();
        $result = $this->queryAll($sql,$params);
        //close DB
        $this->close();


        return $result;

    }


    function countAddViewPost($id){
        //set parameter
        $this_db = $this->DB;

        //connect DB
        $this->connect();
        $sql = "UPDATE $this_db SET `view` = (`view` + 1) WHERE id=:id";
        $params= array(':id'=> $id );
        $lastId = $this->update($sql,$params);

        //close DB
        $this->close();


        return $lastId;
    }
    function countSubViewPost($id){
        //set parameter
        $this_db = $this->DB;

        //connect DB
        $this->connect();
        $sql = "UPDATE $this_db SET `view` = (`view` - 1) WHERE id=:id";
        $params= array(':id'=> $id );
        $lastId = $this->update($sql,$params);

        //close DB
        $this->close();


        return $lastId;
    }
    function countAddCommentPost($id){
        //set parameter
        $this_db = $this->DB;

        //connect DB
        $this->connect();
        $sql = "UPDATE $this_db SET `comment` = (`comment` + 1) WHERE id=:id";
        $params= array(':id'=> $id );
        $lastId = $this->update($sql,$params);

        //close DB
        $this->close();


        return $lastId;
    }
    function countSubCommentPost($id){
        //set parameter
        $this_db = $this->DB;

        //connect DB
        $this->connect();
        $sql = "UPDATE $this_db SET `comment` = (`comment` - 1) WHERE id=:id";
        $params= array(':id'=> $id );
        $lastId = $this->update($sql,$params);

        //close DB
        $this->close();


        return $lastId;
    }




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

    function deletePost($up_id){
        //connect DB
        $this->connect();
        $sql = "DELETE FROM b2i_post WHERE id=:id";
        $params= array(
            ':id'=> $up_id
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



}