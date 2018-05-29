<?php

/**
 * Created by PhpStorm.
 * User: Gimo
 * Date: 29/5/2561
 * Time: 14:53
 */
include_once __DIR__."/_PDO.php";
class ModelProjectSetup extends _PDO
{
    function getProjectById($id=1){
        $this->connect();
        $sql = "SELECT * FROM b2i_projectsetup WHERE id=:id";
        $params= array(':id'=> $id);
        $result = $this->query($sql,$params);
        $this->close();
        return $result;
    }

    function updateProject($name, $title , $detail , $id){

        $this->connect();

        $sql = "SELECT id FROM b2i_projectsetup WHERE id=:id";
        $params= array(':id'=> $id);
        $result = $this->query($sql,$params);
        if(count($result) > 0){
            $sql = "UPDATE b2i_projectsetup SET name=:name , title=:title , detail=:detail WHERE id=:id";
            $params= array(
                ':title'=> $title,
                ':name'=> $name,
                ':detail'=> $detail,
                ':id'=> $id
            );
            $rowUpdate = $this->update($sql,$params);
        }else{
            $sql = "INSERT INTO b2i_projectsetup (name,title,detail) VALUES (:name,:title,:detail)";
            $params= array(
                ':name'=> $name,
                ':title'=> $title,
                ':detail'=> $detail
            );
            $rowUpdate = $this->insert($sql,$params);
        }
        //close DB
        $this->close();
        return $rowUpdate;

    }

    function addDetailProject($id=1 , $detail='' , $text = ''){

        $rowUpdate = 0;

        //connect DB
        $this->connect();

        $sql = "SELECT id FROM b2i_projectsetup WHERE id=:id";
        $params= array(':id'=> $id);
        $result = $this->query($sql,$params);
        if(count($result) > 0){
            $sql = "UPDATE b2i_projectsetup SET ".$detail."=:text WHERE id=:id";
            $params= array(
                ':text'=> $text,
                ':id'=> $id
            );
            $rowUpdate = $this->update($sql,$params);
        }else{
            $sql = "INSERT INTO b2i_projectsetup (".$detail.") VALUES (:text)";
            $params= array(
                ':text'=> $text,
                ':id'=> $id
            );
            $rowUpdate = $this->insert($sql,$params);
        }
        //close DB
        $this->close();
        return $rowUpdate;

    }

}