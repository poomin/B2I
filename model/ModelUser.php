<?php

/**
 * Created by PhpStorm.
 * User: Gimo
 * Date: 29/5/2561
 * Time: 18:45
 */
require_once __DIR__.'/_DBPDO.php';
class ModelUser extends  _DBPDO
{


    public $DB = "b2i_user";

    function insertThis($input){
        $this_db = $this->DB;

        $data_sql = $this->convertArrayToInsert($input);
        if(count($data_sql)<=0){
            return 0;
        }else{

            //connect DB
            $this->connect();
            $sql_value = $data_sql['value'];
            $sql = "INSERT INTO $this_db $sql_value";
            $params = $data_sql['params'];
            $lastId = $this->insert($sql,$params);

            //close DB
            $this->close();
            return $lastId;
        }
    }
    function editThis($input , $condition){
        $this_db = $this->DB;

        $data_sql = $this->convertArrayToUpdate($input,$condition);
        if(count($data_sql['params'])<=0){
            return 0;
        }else {
            //connect DB
            $this->connect();
            $sql_value = $data_sql['value'];
            $sql = "UPDATE $this_db $sql_value";
            $params = $data_sql['params'];
            $lastId = $this->update($sql,$params);

            //close DB
            $this->close();
            return $lastId;
        }
    }
    function deleteThis($condition){
        $this_db = $this->DB;
        //set parameter

        $data_sql = $this->convertArrayToCondition($condition);
        $sql_value = $data_sql['value'];
        $params = $data_sql['params'];

        //connect DB
        $this->connect();
        $sql = "DELETE FROM $this_db ".$sql_value;
        $rowUpdate = $this->update($sql,$params);
        //close DB
        $this->close();


        return $rowUpdate;
    }
    function selectThis($condition){
        //set parameter
        $this_db = $this->DB;

        //condition
        $data_sql = $this->convertArrayToCondition($condition);
        $sql_value = $data_sql['value'];
        $params = $data_sql['params'];

        //connect DB
        $this->connect();
        $sql = "SELECT * FROM $this_db ".$sql_value;
        $result = $this->query($sql,$params);
        //close DB
        $this->close();


        return $result;

    }
    function selectAllThis($condition){
        //set parameter
        $this_db = $this->DB;

        //condition
        $data_sql = $this->convertArrayToCondition($condition);
        $sql_value = $data_sql['value'];
        $params = $data_sql['params'];

        //connect DB
        $this->connect();
        $sql = "SELECT * FROM $this_db ".$sql_value;
        $result = $this->queryAll($sql,$params);
        //close DB
        $this->close();


        return $result;

    }
    function selectAllSql($conditionSql){
        //set parameter
        $this_db = $this->DB;

        //connect DB
        $this->connect();
        $sql = "SELECT * FROM $this_db ".$conditionSql;
        $params= array();
        $result = $this->queryAll($sql,$params);
        //close DB
        $this->close();


        return $result;

    }





    function login($username , $password){
        $password = md5($password);
        $this->connect();
        $sql = "SELECT id,username,name,email,surname,schoolname,schoolregion,role FROM b2i_user WHERE username=:username AND password=:password";
        $params= array(':username'=> $username , ':password'=>$password);
        $result = $this->query($sql,$params);
        $this->close();
        return $result;
    }

    function addUser($input){
        $username = isset($input['username'])?$input['username']:'';
        $password = isset($input['password'])?$input['password']:'';
        $password = md5($password);
        $email = isset($input['email'])?$input['email']:'';
        $name = isset($input['name'])?$input['name']:'';
        $surname = isset($input['surname'])?$input['surname']:'';
        $schoolname = isset($input['schoolname'])?$input['schoolname']:'';
        $schoolregion = isset($input['schoolregion'])?$input['schoolregion']:'';
        $role = isset($input['role'])?$input['role']:'student';

        //connect DB
        $this->connect();
        $sql = "INSERT INTO b2i_user (username,password,email,name,surname,schoolname,schoolregion,role) 
        VALUES (:username,:password,:email,:name,:surname,:schoolname,:schoolregion,:role)";
        $params= array(
            ':username'=> $username,
            ':password'=> $password,
            ':email'=> $email,
            ':name'=> $name,
            ':surname'=> $surname,
            ':schoolname'=> $schoolname,
            ':schoolregion'=> $schoolregion,
            ':role'=> $role
        );
        $lastId = $this->insert($sql,$params);
        //close DB
        $this->close();


        return $lastId;

    }

    function editUser($input){
        $email = isset($input['email'])?$input['email']:'';
        $name = isset($input['name'])?$input['name']:'';
        $surname = isset($input['surname'])?$input['surname']:'';
        $schoolname = isset($input['schoolname'])?$input['schoolname']:'';
        $schoolregion = isset($input['schoolregion'])?$input['schoolregion']:'';
        $id = isset($input['id'])?$input['id']:'';


        //connect DB
        $this->connect();
        $sql = "UPDATE b2i_user SET email=:email,name=:name,surname=:surname,schoolname=:schoolname,schoolregion=:schoolregion WHERE id=:id";
        $params= array(
            ':email'=> $email,
            ':name'=> $name,
            ':surname'=> $surname,
            ':schoolname'=> $schoolname,
            ':schoolregion'=> $schoolregion,
            ':id'=>$id
        );
        $lastId = $this->update($sql,$params);
        //close DB
        $this->close();


        return $lastId;

    }

    function editPassword($input){
        $id = isset($input['id'])?$input['id']:'';
        $username = isset($input['username'])?$input['username']:'';
        $password = isset($input['password'])?$input['password']:'';
        $oldPassword = isset($input['oldPassword'])?$input['oldPassword']:'';
        $password = md5($password);
        $oldPassword = md5($oldPassword);

        //connect DB
        $this->connect();

        $sql = "select * from b2i_user WHERE id=:id and password=:password";
        $params= array(':id'=> $id , ':password'=>$oldPassword);
        $result = $this->query($sql,$params);

        if(isset($result['id'])){

            $sql = "UPDATE b2i_user SET username=:username,password=:password WHERE id=:id";
            $params= array(
                ':username'=> $username,
                ':password'=> $password,
                ':id'=>$id
            );
            $row_update = $this->update($sql,$params);
        }else{
            $row_update =0;
        }

        //close DB
        $this->close();


        return $row_update;

    }

    function editRemove($id){

        //connect DB
        $this->connect();
        $sql = "UPDATE b2i_user SET userremove='y' WHERE id=:id";
        $params= array(
            ':id'=>$id
        );
        $lastId = $this->update($sql,$params);
        //close DB
        $this->close();


        return $lastId;

    }

    function getUserByProjectId($project_id){
        $this->connect();
        $sql = "select b2i_user.* , membertype from (select * from b2i_project_member where project_id=:project_id )as member 
                left join b2i_user on member.user_id = b2i_user.id";
        $params= array(':project_id'=> $project_id);
        $result = $this->queryAll($sql,$params);
        $this->close();
        return $result;
    }

    function getUserRole($role='student'){
        $this->connect();
        $sql = "select * from b2i_user WHERE role=:role";
        $params= array(':role'=> $role);
        $result = $this->queryAll($sql,$params);
        $this->close();
        return $result;
    }

    function getUserAll(){
        $this->connect();
        $sql = "select * from b2i_user WHERE role!='admin' AND userremove ='n'";
        $params= array();
        $result = $this->queryAll($sql,$params);
        $this->close();
        return $result;
    }

    function getUserById($id){
        $this->connect();
        $sql = "select * from b2i_user WHERE id=:id";
        $params= array(':id'=> $id);
        $result = $this->query($sql,$params);
        $this->close();
        return $result;
    }

}