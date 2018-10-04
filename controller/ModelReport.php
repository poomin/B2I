<?php

/**
 * Created by PhpStorm.
 * User: Gimo
 * Date: 29/5/2561
 * Time: 18:45
 */
require_once __DIR__.'/_PDO.php';
class ModelReport extends  _PDO
{

    function reportSql($sql){
        $this->connect();
        $params= array();
        $result = $this->queryAll($sql,$params);
        $this->close();
        return $result;
    }

}