<?php

/**
 * Created by PhpStorm.
 * User: EPOP
 * Date: 5/31/2018
 * Time: 12:04 PM
 */
require_once __DIR__.'/_DBPDO.php';
class ModelUpload extends _DBPDO
{

    public $DB = "b2i_projectsetup_image";

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








    function addImageProjectSetup($name , $path){

        //connect DB
        $this->connect();
        $sql = "INSERT INTO b2i_projectsetup_image (namefile,path) VALUES (:namefile,:path)";
        $params= array(
            ':namefile'=> $name,
            ':path'=> $path
        );
        $lastId = $this->insert($sql,$params);
        //close DB
        $this->close();


        return $lastId;
    }


    function getImageProjectSetup(){
        $this->connect();
        $sql = "SELECT * FROM b2i_projectsetup_image order by id DESC";
        $params= array();
        $result = $this->queryAll($sql,$params);
        $this->close();
        return $result;
    }


    function deleteImageProjectSetup($id){

        //connect DB
        $this->connect();
        $sql = "DELETE FROM b2i_projectsetup_image WHERE id=:id";
        $params= array(
            ':id'=> $id
        );
        $lastId = $this->update($sql,$params);
        //close DB
        $this->close();


        return $lastId;
    }

}