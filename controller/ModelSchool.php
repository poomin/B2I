<?php

/**
 * Created by PhpStorm.
 * User: Gimo
 * Date: 29/5/2561
 * Time: 18:45
 */
require_once __DIR__.'/_PDO.php';
class ModelSchool extends  _PDO
{


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