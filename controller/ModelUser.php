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
        $sql = "select * from b2i_user WHERE role!='admin'";
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