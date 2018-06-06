<?php

/**
 * Created by PhpStorm.
 * User: EPOP
 * Date: 6/6/2018
 * Time: 3:59 PM
 */
require_once __DIR__.'/_PDO.php';
class ModelProjectPhaseLog extends _PDO
{

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

    function getLogByPhase($phase_id){
        $this->connect();
        $sql = "select name , surname , username , role , message ,b2i_project_phase_log.createat from b2i_project_phase_log 
        left join b2i_user on b2i_project_phase_log.user_id = b2i_user.id
        where phase_id=:phase_id";
        $params= array(':phase_id'=> $phase_id);
        $result = $this->queryAll($sql,$params);
        $this->close();
        return $result;
    }

}