<?php

/**
 * Created by PhpStorm.
 * User: EPOP
 * Date: 7/9/2018
 * Time: 12:21 PM
 */

require_once __DIR__.'/_PDO.php';

class _phpMyAdminModel extends _PDO
{

    function getTables(){
        $this->connect();
        $sql = "SHOW TABLES";
        $params= array();
        $result = $this->queryAll($sql,$params);
        $this->close();
        return $result;
    }

    function getAttribute($table){
        $this->connect();
        $sql = "SHOW COLUMNS FROM $table";
        $params= array();
        $result = $this->queryAll($sql,$params);
        $this->close();
        return $result;
    }

    function getDataAll($table){
        $this->connect();
        $sql = "SELECT * FROM $table";
        $params= array();
        $result = $this->queryAll($sql,$params);
        $this->close();
        return $result;
    }

}