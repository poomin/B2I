<?php

/**
 * Created by PhpStorm.
 * User: EPOP
 * Date: 6/1/2018
 * Time: 5:55 PM
 */
require_once __DIR__.'/_DBPDO.php';

class ModelComment extends _DBPDO
{

    public $DB = "b2i_post_comment";
    public $FK_USER = "b2i_user";

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
        $sql = "SELECT * FROM $this_db ".$sql_value;
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

    function getCommentByPostId($id){
        //set parameter
        $this_db = $this->DB;
        $this_fk_user = $this->FK_USER;

        //connect DB
        $this->connect();
        $sql = "select comm.* , us.name , us.surname from $this_db as comm
        left join $this_fk_user as us on comm.user_id = us.id
        where comm.post_id=:id ORDER BY comm.id DESC " ;
        $params= array(':id'=> $id);
        $result = $this->queryAll($sql,$params);
        //close DB
        $this->close();


        return $result;

    }






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



}