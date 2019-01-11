<?php

/**
 * Created by PhpStorm.
 * User: EPOP
 * Date: 6/5/2018
 * Time: 11:53 AM
 */
require_once __DIR__.'/_DBPDO.php';
class ModelProjectPhaseUpload extends _DBPDO
{


    public $DB = "b2i_project_phase_upload";

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
    function selectSql($conditionSql){
        //set parameter
        $this_db = $this->DB;

        //connect DB
        $this->connect();
        $sql = "SELECT * FROM $this_db ".$conditionSql;
        $params= array();
        $result = $this->query($sql,$params);
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






    //----------------- new -----------------------


    function addUpload($input){

        $phase_id = isset($input['phase_id'])?$input['phase_id']:'';
        $user_id = isset($input['user_id'])?$input['user_id']:'';
        $namefile = isset($input['namefile'])?$input['namefile']:'';
        $typefile = isset($input['typefile'])?$input['typefile']:'';
        $path = isset($input['path'])?$input['path']:'';


        //connect DB
        $this->connect();
        $sql = "INSERT INTO b2i_project_phase_upload (phase_id,user_id,namefile,typefile,path) 
        VALUES (:phase_id , :user_id , :namefile , :typefile , :path )";
        $params= array(
            ':phase_id'=> $phase_id,
            ':user_id'=> $user_id,
            ':namefile'=> $namefile,
            ':typefile'=> $typefile,
            ':path'=> $path
        );
        $lastId = $this->insert($sql,$params);
        //close DB
        $this->close();


        return $lastId;
    }

    function getByPhaseId($phase_id){
        $this->connect();
        $sql = "select * from  b2i_project_phase_upload where phase_id=:phase_id ORDER BY id";
        $params= array(':phase_id'=> $phase_id);
        $result = $this->queryAll($sql,$params);
        $this->close();
        return $result;
    }

    function deleteUploadById($up_id){
        //connect DB
        $this->connect();
        $sql = "DELETE FROM b2i_project_phase_upload WHERE id=:id";
        $params= array(
            ':id'=> $up_id
        );
        $lastId = $this->update($sql,$params);
        //close DB
        $this->close();


        return $lastId;
    }

}