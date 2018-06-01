<?php

/**
 * Created by PhpStorm.
 * User: EPOP
 * Date: 5/31/2018
 * Time: 12:04 PM
 */
require_once __DIR__.'/_PDO.php';
class ModelUpload extends _PDO
{

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