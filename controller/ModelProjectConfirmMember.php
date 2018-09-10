<?php

/**
 * Created by PhpStorm.
 * User: Gimo
 * Date: 29/5/2561
 * Time: 18:45
 */
require_once __DIR__.'/_PDO.php';
class ModelProjectConfirmMember extends  _PDO
{


    function addCM($input){
        $confirm_id = isset($input['confirm_id'])?$input['confirm_id']:'';
        $user_id= isset($input['user_id'])?$input['user_id']:'';
        $membertype= isset($input['membertype'])?$input['membertype']:'';

        //connect DB
        $this->connect();
        $sql = "INSERT INTO b2i_project_confirm_member (confirm_id,user_id,membertype) 
        VALUES (:confirm_id,:user_id,:membertype)";
        $params= array(
            ':confirm_id'=> $confirm_id,
            ':user_id'=> $user_id,
            ':membertype'=>$membertype
        );
        $lastId = $this->insert($sql,$params);
        //close DB
        $this->close();


        return $lastId;

    }

    function editCMTeacher($input){
        $confirm_id = isset($input['confirm_id'])?$input['confirm_id']:'';
        $user_id = isset($input['user_id'])?$input['user_id']:'';
        $shirts_size = isset($input['shirts_size'])?$input['shirts_size']:'';
        $phone = isset($input['phone'])?$input['phone']:'';
        $vegetarian_food = isset($input['vegetarian_food'])?$input['vegetarian_food']:'';


        //connect DB
        $this->connect();
        $sql = "UPDATE b2i_project_confirm_member SET shirts_size=:shirts_size,phone=:phone,vegetarian_food=:vegetarian_food
        WHERE confirm_id=:confirm_id AND user_id=:user_id";
        $params= array(
            ':shirts_size'=> $shirts_size,
            ':phone'=> $phone,
            ':vegetarian_food'=> $vegetarian_food,
            ':user_id'=> $user_id,
            ':confirm_id'=>$confirm_id
        );
        $lastId = $this->update($sql,$params);
        //close DB
        $this->close();


        return $lastId;

    }
    function editCMStudent($input){
        $confirm_id = isset($input['confirm_id'])?$input['confirm_id']:'';
        $user_id = isset($input['user_id'])?$input['user_id']:'';
        $shirts_size = isset($input['shirts_size'])?$input['shirts_size']:'';
        $phone = isset($input['phone'])?$input['phone']:'';
        $classroom = isset($input['classroom'])?$input['classroom']:'';
        $vegetarian_food = isset($input['vegetarian_food'])?$input['vegetarian_food']:'';


        //connect DB
        $this->connect();
        $sql = "UPDATE b2i_project_confirm_member SET shirts_size=:shirts_size,phone=:phone,vegetarian_food=:vegetarian_food,classroom=:classroom 
        WHERE confirm_id=:confirm_id AND user_id=:user_id";
        $params= array(
            ':shirts_size'=> $shirts_size,
            ':phone'=> $phone,
            ':vegetarian_food'=> $vegetarian_food,
            ':classroom'=>$classroom,
            ':user_id'=> $user_id,
            ':confirm_id'=>$confirm_id
        );
        $lastId = $this->update($sql,$params);
        //close DB
        $this->close();


        return $lastId;

    }

    function getCM($confirm_id){
        $this->connect();
        $sql = "select b2i_project_confirm_member.* , b2i_user.name , b2i_user.surname
        from b2i_project_confirm_member 
        left join b2i_user on b2i_user.id = b2i_project_confirm_member.user_id 
        WHERE confirm_id =:id";
        $params= array(':id'=> $confirm_id);
        $result = $this->queryAll($sql,$params);
        $this->close();
        return $result;
    }

}