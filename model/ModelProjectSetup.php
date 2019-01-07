<?php

/**
 * Created by PhpStorm.
 * User: Gimo
 * Date: 29/5/2561
 * Time: 14:53
 */
include_once __DIR__."/_DBPDO.php";

class ModelProjectSetup extends _DBPDO
{

    public $DB = "b2i_projectsetup";

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





    function getProjectById($id=1){
        $this->connect();
        $sql = "SELECT * FROM b2i_projectsetup WHERE id=:id";
        $params= array(':id'=> $id);
        $result = $this->query($sql,$params);
        $this->close();
        return $result;
    }

    function updateProject($name, $title , $detail , $id){

        $this->connect();

        $sql = "SELECT id FROM b2i_projectsetup WHERE id=:id";
        $params= array(':id'=> $id);
        $result = $this->query($sql,$params);
        if(count($result) > 0){
            $sql = "UPDATE b2i_projectsetup SET name=:name , title=:title , detail=:detail WHERE id=:id";
            $params= array(
                ':title'=> $title,
                ':name'=> $name,
                ':detail'=> $detail,
                ':id'=> $id
            );
            $rowUpdate = $this->update($sql,$params);
        }else{
            $sql = "INSERT INTO b2i_projectsetup (name,title,detail) VALUES (:name,:title,:detail)";
            $params= array(
                ':name'=> $name,
                ':title'=> $title,
                ':detail'=> $detail
            );
            $rowUpdate = $this->insert($sql,$params);
        }
        //close DB
        $this->close();
        return $rowUpdate;

    }

    function addDetailProject($id=1 , $detail='' , $text = ''){

        $rowUpdate = 0;

        //connect DB
        $this->connect();

        $sql = "SELECT id FROM b2i_projectsetup WHERE id=:id";
        $params= array(':id'=> $id);
        $result = $this->query($sql,$params);
        if(count($result) > 0){
            $sql = "UPDATE b2i_projectsetup SET ".$detail."=:text WHERE id=:id";
            $params= array(
                ':text'=> $text,
                ':id'=> $id
            );
            $rowUpdate = $this->update($sql,$params);
        }else{
            $sql = "INSERT INTO b2i_projectsetup (".$detail.") VALUES (:text)";
            $params= array(
                ':text'=> $text,
                ':id'=> $id
            );
            $rowUpdate = $this->insert($sql,$params);
        }
        //close DB
        $this->close();
        return $rowUpdate;

    }

}