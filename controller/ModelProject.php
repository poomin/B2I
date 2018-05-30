<?php

/**
 * Created by PhpStorm.
 * User: EPOP
 * Date: 5/30/2018
 * Time: 2:17 PM
 */
require_once __DIR__.'/_PDO.php';
class ModelProject extends  _PDO
{

    function addProject($input){
        $projectsetup_id = isset($input['projectsetup_id'])?$input['projectsetup_id']:'';
        $name = isset($input['name'])?$input['name']:'';
        $schoolname = isset($input['schoolname'])?$input['schoolname']:'';
        $schoolregion = isset($input['schoolregion'])?$input['schoolregion']:'';
        $detail = isset($input['detail'])?$input['detail']:'';
        $user_id = isset($input['user_id'])?$input['user_id']:'';

        //connect DB
        $this->connect();
        $sql = "INSERT INTO b2i_project (projectsetup_id,name,schoolname,schoolregion,detail) 
        VALUES (:projectsetup_id,:name,:schoolname,:schoolregion,:detail)";
        $params= array(
            ':projectsetup_id'=> $projectsetup_id,
            ':name'=> $name,
            ':schoolname'=> $schoolname,
            ':schoolregion'=> $schoolregion,
            ':detail'=> $detail
        );
        $lastId = $this->insert($sql,$params);


        //insert to member
        $sql = "INSERT INTO b2i_project_member (project_id,user_id,membertype) 
        VALUES (:project_id,:user_id,:membertype)";
        $membertype = 'header';
        $params= array(
            ':project_id'=> $lastId,
            ':user_id'=> $user_id,
            ':membertype'=> $membertype
        );
        $lastId2 = $this->insert($sql,$params);

        //close DB
        $this->close();


        return $lastId;
    }

    function getProjectByUserId($user_id){
        $this->connect();
        $sql = "select b2i_project.* from ( select project_id from b2i_project_member where user_id=:user_id ) as member 
                left join b2i_project on b2i_project.id = member.project_id";
        $params= array(':user_id'=> $user_id);
        $result = $this->queryAll($sql,$params);
        $this->close();
        return $result;
    }

}