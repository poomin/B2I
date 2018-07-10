<?php

/**
 * Created by PhpStorm.
 * User: Gimo
 * Date: 29/5/2561
 * Time: 18:45
 */
require_once __DIR__.'/_PDO.php';
class ModelSchool extends  _PDO
{


    function addSchool($input){
        $name = isset($input['name'])?$input['name']:'';

        //connect DB
        $this->connect();
        $sql = "INSERT INTO b2i_school (school_name) VALUES (:name)";
        $params= array(
            ':name'=> $name
        );
        $lastId = $this->insert($sql,$params);
        //close DB
        $this->close();


        return $lastId;

    }

    function editSchool($input){
        $old = isset($input['name_old'])?$input['name_old']:'';
        $new = isset($input['name_new'])?$input['name_new']:'';


        //connect DB
        $this->connect();
        $sql = "UPDATE b2i_school SET school_name=:new WHERE school_name=:old";
        $params= array(
            ':new'=> $new,
            ':old'=> $old
        );
        $lastId = $this->update($sql,$params);
        //close DB
        $this->close();


        return $lastId;

    }

    function deleteSchool($id){

        //connect DB
        $this->connect();
        $sql = "DELETE FROM b2i_school WHERE school_name=:id";
        $params= array(
            ':id'=> $id
        );
        $lastId = $this->update($sql,$params);
        //close DB
        $this->close();


        return $lastId;

    }

    function getSchoolAll(){
        $this->connect();
        $sql = "select * from b2i_school";
        $params= array();
        $result = $this->queryAll($sql,$params);
        $this->close();
        return $result;
    }


}