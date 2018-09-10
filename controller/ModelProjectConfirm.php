<?php

/**
 * Created by PhpStorm.
 * User: Gimo
 * Date: 29/5/2561
 * Time: 18:45
 */
require_once __DIR__.'/_PDO.php';
class ModelProjectConfirm extends  _PDO
{


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

}