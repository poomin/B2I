<?php

/**
 * Created by PhpStorm.
 * User: EPOP
 * Date: 5/24/2018
 * Time: 11:09 AM
 */
class _DBPDO
{
    private $servername = "localhost";
    private $username = "root";
    private $password = "1234";
    private $dbname = "db_b2i";
    private $conn = null;
    private $stmt = null;

    function connect(){
        try {
            $this->conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $this->conn->exec("SET NAMES UTF8");
            $this->conn->exec("SET profiling = 1;");
        }
        catch(PDOException $e)
        {
            echo "Connection failed: " . $e->getMessage();
        }
        return $this->conn;

    }

    function close()
    {
        try {
            $this->stmt = null;
            $this->conn = null;
        } catch (Exception $e) {
            echo "Connection failed: " . $e->getMessage();
        } finally {
            //$this->conn = null;
        }
    }

    function insert($sql, $arr)
    {
        //sql pattern is INSERT INTO fruit(name, colour) VALUES (?, ?)
        $success = 0;
        try {
            $this->stmt = $this->conn->prepare($sql);
            $success = $this->stmt->execute($arr);
            $last_id = $this->conn->lastInsertId();
            if($success && $last_id==0){
                $last_id = 1;
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        return $last_id;
    }

    function update($sql, $arr)
    {
        //sql pattern is INSERT INTO fruit(name, colour) VALUES (?, ?)
        $success = 0;
        $affectedrows = 0;
        try {
            $this->stmt = $this->conn->prepare($sql);
            $success = $this->stmt->execute($arr);
            $affectedrows = $this->stmt->rowCount();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        return $affectedrows;
    }

    function query($sql, $params)
    {
        // PDO, prepared statement
        try {
            $this->stmt = $this->conn->prepare($sql);
            $this->stmt->execute($params);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }

    function queryAll($sql, $params)
    {

        // PDO, prepared statement
        try {
            $this->stmt = $this->conn->prepare($sql);
            $this->stmt->execute($params);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function queryNoParams($sql)
    {

        // PDO, prepared statement
        try {
            $this->stmt = $this->conn->prepare($sql);
            $this->stmt->execute();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function convertArrayToInsert($input){
        if(count($input)<=0){
            return [];
        }else{
            $check_first = true;
            $params = [];
            $v = "(";
            $a = "(";
            foreach ($input as $k=>$item){
                if($item!=""){
                    $params[':'.$k]=$item;
                    if($check_first){
                        $check_first = !$check_first;
                        $v.=':'.$k;
                        $a.=''.$k;
                    }else{
                        $v.=', :'.$k;
                        $a.=', '.$k;
                    }
                }
            }

            $v.= ")";
            $a.= ")";
            $value = $a." VALUES ".$v;
            if(count($params) > 0){
                return ["value"=>$value,"params"=>$params];
            }else{
                return [];
            }


        }
    }

    function convertArrayToUpdate($input, $where){
        if(count($input)<=0 && count($where)<=0){
            return ["value"=>"" , "params"=>[]];
        }else{
            $check_first = true;
            $params = [];
            $value = " SET ";
            foreach ($input as $k=>$item){
                if($item!=""){
                    $params[':'.$k]=$item;
                    if($check_first){
                        $check_first = !$check_first;
                        $value.=" ".$k."=:".$k;
                    }else{
                        $value.=", ".$k."=:".$k;
                    }
                }
            }

            if(count($where)>0){
                $check_first = true;
                $value.= " WHERE ";
                foreach ($where as $k=>$item){
                    if($item!=""){
                        $params[':c'.$k]=$item;
                        if($check_first){
                            $check_first = !$check_first;
                            $value.=" ".$k."=:c".$k;
                        }else{
                            $value.=" AND ".$k."=:c".$k;
                        }
                    }
                }
            }
            if(count($params)> 0 ){
                return ["value"=>$value,"params"=>$params];
            }else{
                return ["value"=>"" , "params"=>[]];
            }


        }
    }

    function convertArrayToCondition($where){
        $params = [];
        $check_first = true;
        $value= " WHERE ";
        foreach ($where as $k=>$item){
            if($item!=""){
                $params[':c'.$k]=$item;
                if($check_first){
                    $check_first = !$check_first;
                    $value.=" ".$k."=:c".$k;
                }else{
                    $value.=" AND ".$k."=:c".$k;
                }
            }
        }

        if(count($params) > 0 && !$check_first){
            return ["value"=>$value,"params"=>$params];
        }else{
            return ["value"=>"" , "params"=>[]];
        }
    }

    function input($attr , $default=''){
        return isset($_REQUEST[$attr])?$_REQUEST[$attr]:$default;
    }

    function link($url){
        header("Location: /$url");
    }

}