<?php

/**
 * Created by PhpStorm.
 * User: Gimo
 * Date: 29/5/2561
 * Time: 18:45
 */
require_once __DIR__.'/_DBPDO.php';
class ModelSchool extends  _DBPDO
{

    public $DB = "b2i_school";

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
    function selectAllThis($condition=[]){
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








    function addSchool($input){
        $name = isset($input['name'])?$input['name']:'';
        $address = isset($input['address'])?$input['address']:'';
        $subdistrict = isset($input['subdistrict'])?$input['subdistrict']:'';
        $district = isset($input['district'])?$input['district']:'';
        $province = isset($input['province'])?$input['province']:'';
        $code = isset($input['code'])?$input['code']:'';

        //connect DB
        $this->connect();
        $sql = "INSERT INTO b2i_school (school_name,address,subdistrict,district,province,code) 
        VALUES (:name,:address,:subdistrict,:district,:province,:code)";
        $params= array(
            ':name'=> $name,
            ':address'=>$address,
            ':subdistrict'=>$subdistrict,
            ':district'=>$district,
            ':province'=>$province,
            ':code'=>$code
        );
        $lastId = $this->insert($sql,$params);
        //close DB
        $this->close();


        return $lastId;

    }

    function editSchool($input){
        $old = isset($input['name_old'])?$input['name_old']:'';
        $new = isset($input['name_new'])?$input['name_new']:'';
        $address = isset($input['address'])?$input['address']:'';
        $subdistrict = isset($input['subdistrict'])?$input['subdistrict']:'';
        $district = isset($input['district'])?$input['district']:'';
        $province = isset($input['province'])?$input['province']:'';
        $code = isset($input['code'])?$input['code']:'';

        //connect DB
        $this->connect();
        $sql = "UPDATE b2i_school SET school_name=:new , address=:address , subdistrict=:subdistrict,
        district=:district, province=:province , code=:code   WHERE school_name=:old";
        $params= array(
            ':new'=> $new,
            ':old'=> $old,
            ':address'=>$address,
            ':subdistrict'=>$subdistrict,
            ':district'=>$district,
            'province'=>$province,
            'code'=>$code
        );
        $lastId = $this->update($sql,$params);
        //close DB
        $this->close();


        return $lastId;

    }

    function deleteSchool($id){

        //connect DB
        $this->connect();
        $sql = "DELETE FROM b2i_school WHERE school_name=:id";
        $params= array(
            ':id'=> $id
        );
        $lastId = $this->update($sql,$params);
        //close DB
        $this->close();


        return $lastId;

    }

    function getSchoolAll(){
        $this->connect();
        $sql = "select * from b2i_school";
        $params= array();
        $result = $this->queryAll($sql,$params);
        $this->close();
        return $result;
    }


}