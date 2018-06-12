<?php

/**
 * Created by PhpStorm.
 * User: Gimo
 * Date: 30/5/2561
 * Time: 21:01
 */
require_once __DIR__.'/_PDO.php';
class ModelProjectPhase extends _PDO
{
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

    function editResult($phase_id , $phase_result){

        //connect DB
        $this->connect();
        $sql = "UPDATE  b2i_project_phase SET result=:result WHERE id=:id";
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