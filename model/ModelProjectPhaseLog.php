<?php

/**
 * Created by PhpStorm.
 * User: EPOP
 * Date: 6/6/2018
 * Time: 3:59 PM
 */
require_once __DIR__.'/_DBPDO.php';
class ModelProjectPhaseLog extends _DBPDO
{


    public $DB = "b2i_project_phase_log";
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


    function getLogByPhase($phase_id){
        //set parameter
        $this_db = $this->DB;
        $this_user = $this->FK_USER;

        $this->connect();
        $sql = "select name , surname , username , role , message ,l.createat from $this_db as l 
        left join $this_user as u on l.user_id = u.id
        where phase_id=:phase_id";
        $params= array(':phase_id'=> $phase_id);
        $result = $this->queryAll($sql,$params);
        $this->close();
        return $result;
    }


    //--------------------- new -----------------------


    function addLog($phase_id,$user_id,$message){
        //connect DB
        $this->connect();
        $sql = "INSERT INTO b2i_project_phase_log (phase_id,user_id,message) 
        VALUES (:phase_id,:user_id,:message)";
        $params= array(
            ':phase_id'=> $phase_id,
            ':user_id'=> $user_id,
            ':message'=> $message
        );
        $lastId = $this->insert($sql,$params);

        //close DB
        $this->close();


        return $lastId;
    }


}