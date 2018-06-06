<?php

/**
 * Created by PhpStorm.
 * User: EPOP
 * Date: 6/5/2018
 * Time: 11:53 AM
 */
require_once __DIR__.'/_PDO.php';
class ModelProjectPhaseUpload extends _PDO
{

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