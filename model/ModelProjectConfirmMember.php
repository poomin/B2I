<?php

/**
 * Created by PhpStorm.
 * User: Gimo
 * Date: 29/5/2561
 * Time: 18:45
 */
require_once __DIR__.'/_DBPDO.php';
class ModelProjectConfirmMember extends  _DBPDO
{

    public $DB = "b2i_project_confirm_member";
    public $FK_USER = "b2i_user";

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


    function getCM($confirm_id){
        //set parameter
        $this_db = $this->DB;
        $this_user = $this->FK_USER;

        $this->connect();
        $sql = "select m.* , u.name , u.surname
        from $this_db as m 
        left join $this_user as u on u.id = m.user_id 
        WHERE confirm_id =:id";
        $params= array(':id'=> $confirm_id);
        $result = $this->queryAll($sql,$params);
        $this->close();
        return $result;
    }

    //--------------------- new -----------------------



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

        $name_title = isset($input['name_title'])?$input['name_title']:'';
        $name_thai = isset($input['name_thai'])?$input['name_thai']:'';
        $surname_thai = isset($input['surname_thai'])?$input['surname_thai']:'';

        //connect DB
        $this->connect();
        $sql = "UPDATE b2i_project_confirm_member SET shirts_size=:shirts_size,phone=:phone,vegetarian_food=:vegetarian_food
        ,name_title=:name_title ,name_thai=:name_thai ,surname_thai=:surname_thai WHERE confirm_id=:confirm_id AND user_id=:user_id";
        $params= array(
            ':shirts_size'=> $shirts_size,
            ':phone'=> $phone,
            ':vegetarian_food'=> $vegetarian_food,
            ':name_title'=>$name_title,
            ':name_thai'=>$name_thai,
            ':surname_thai'=>$surname_thai,
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

        $name_title = isset($input['name_title'])?$input['name_title']:'';
        $name_thai = isset($input['name_thai'])?$input['name_thai']:'';
        $surname_thai = isset($input['surname_thai'])?$input['surname_thai']:'';

        //connect DB
        $this->connect();
        $sql = "UPDATE b2i_project_confirm_member SET shirts_size=:shirts_size,phone=:phone,vegetarian_food=:vegetarian_food,classroom=:classroom 
         ,name_title=:name_title ,name_thai=:name_thai ,surname_thai=:surname_thai  WHERE confirm_id=:confirm_id AND user_id=:user_id";
        $params= array(
            ':shirts_size'=> $shirts_size,
            ':phone'=> $phone,
            ':vegetarian_food'=> $vegetarian_food,
            ':classroom'=>$classroom,
            ':name_title'=>$name_title,
            ':name_thai'=>$name_thai,
            ':surname_thai'=>$surname_thai,
            ':user_id'=> $user_id,
            ':confirm_id'=>$confirm_id
        );
        $lastId = $this->update($sql,$params);
        //close DB
        $this->close();


        return $lastId;

    }

}