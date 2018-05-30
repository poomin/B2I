<?php

/**
 * Created by PhpStorm.
 * User: Gimo
 * Date: 29/5/2561
 * Time: 18:45
 */
require_once __DIR__.'/_PDO.php';
class ModelUser extends  _PDO
{

    function login($username , $password){
        $this->connect();
        $sql = "SELECT id,username,name,surname,schoolname,schoolregion,role FROM b2i_user WHERE username=:username AND password=:password";
        $params= array(':username'=> $username , ':password'=>$password);
        $result = $this->query($sql,$params);
        $this->close();
        return $result;
    }

    function addUser($input){
        $username = isset($input['username'])?$input['username']:'';
        $password = isset($input['password'])?$input['password']:'';
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


}