<?php

/**
 * Created by PhpStorm.
 * User: Gimo
 * Date: 30/5/2561
 * Time: 21:01
 */
require_once __DIR__.'/_DBPDO.php';
class ModelProjectPhase extends _DBPDO
{

    public $DB = "b2i_project_phase";

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



    //--------------------- new ----------------------------

    function getPhase($project_id , $phase){
        $this->connect();
        $sql = "select * from  b2i_project_phase where project_id=:project_id and phase=:phase";
        $params= array(':project_id'=> $project_id , ':phase'=> $phase);
        $result = $this->query($sql,$params);
        $this->close();
        return $result;
    }

    function addPhase($project_id , $phase){

        //connect DB
        $this->connect();
        $sql = "INSERT INTO b2i_project_phase (project_id,phase) VALUES (:project_id,:phase)";
        $params= array(':project_id'=> $project_id , ':phase'=> $phase);
        $lastId = $this->insert($sql,$params);

        //close DB
        $this->close();

        return $lastId;
    }

    function editResult($phase_id , $phase_result , $phase_detail){

        //connect DB
        $this->connect();
        $sql = "UPDATE  b2i_project_phase SET result=:result , detail=:detail WHERE id=:id";
        $params= array(
            ':result'=> $phase_result,
            ':detail'=> $phase_detail,
            ':id'=> $phase_id
        );
        $row_update = $this->update($sql,$params);

        //close DB
        $this->close();


        return $row_update;
    }

}