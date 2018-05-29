<?php

/**
 * Created by PhpStorm.
 * User: Gimo
 * Date: 29/5/2561
 * Time: 14:52
 */
class _PDO
{
    private $servername = "localhost";
    private $username = "root";
    private $password = "1234";
    private $dbname = "db_augur";
    private $conn = null;
    private $stmt = null;

    function connect(){
        try {
            $this->conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password);
            // set the PDO error mode to exception
            //$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
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

}