<?php

/**
 * Created by PhpStorm.
 * User: Gimo
 * Date: 29/5/2561
 * Time: 18:45
 */
require_once __DIR__.'/_DBPDO.php';
class ModelProjectConfirm extends  _DBPDO
{


    public $DB = "b2i_project_confirm";

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



    //--------------------- new -----------------------



    function addConfirm($input){
        $project_id = isset($input['project_id'])?$input['project_id']:'';
        $phase= isset($input['phase'])?$input['phase']:'';

        //connect DB
        $this->connect();
        $sql = "INSERT INTO b2i_project_confirm (project_id,confirm_phase) 
        VALUES (:project_id,:confirm_phase)";
        $params= array(
            ':project_id'=> $project_id,
            ':confirm_phase'=> $phase
        );
        $lastId = $this->insert($sql,$params);
        //close DB
        $this->close();


        return $lastId;

    }

    function editConfirm($input){
        $check_in = isset($input['check_in'])?$input['check_in']:'';
        $driver = isset($input['driver'])?$input['driver']:'';
        $id = isset($input['id'])?$input['id']:'';


        //connect DB
        $this->connect();
        $sql = "UPDATE b2i_project_confirm SET check_in=:check_in,driver=:driver WHERE id=:id";
        $params= array(
            ':check_in'=> $check_in,
            ':driver'=> $driver,
            ':id'=>$id
        );
        $lastId = $this->update($sql,$params);
        //close DB
        $this->close();


        return $lastId;

    }

    function getConfirmId($project_id,$phase){
        $this->connect();
        $sql = "select *  from b2i_project_confirm WHERE project_id =:project_id AND confirm_phase=:phase";
        $params= array(':project_id'=> $project_id,':phase'=>$phase);
        $result = $this->query($sql,$params);
        $this->close();
        return $result;
    }

    function editResult($phase_id , $phase_result){

        //connect DB
        $this->connect();
        $sql = "UPDATE  b2i_project_confirm SET result=:result WHERE id=:id";
        $params= array(
            ':result'=> $phase_result,
            ':id'=> $phase_id
        );
        $row_update = $this->update($sql,$params);

        //close DB
        $this->close();


        return $row_update;
    }

}