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

        $member = isset($input['member'])?$input['member']:'';

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

        if($member!=''){
            $cut = explode("-",$member);
            foreach ($cut as $item){
                $sql = "INSERT INTO b2i_project_member (project_id,user_id) VALUES (:project_id,:user_id)";
                $params= array(
                    ':project_id'=> $lastId,
                    ':user_id'=> $item,
                );
                $lastId2 = $this->insert($sql,$params);
            }
        }


        //close DB
        $this->close();


        return $lastId;
    }

    function editProject($input){
        $projectsetup_id = isset($input['projectsetup_id'])?$input['projectsetup_id']:'';
        $name = isset($input['name'])?$input['name']:'';
        $schoolname = isset($input['schoolname'])?$input['schoolname']:'';
        $schoolregion = isset($input['schoolregion'])?$input['schoolregion']:'';
        $detail = isset($input['detail'])?$input['detail']:'';
        $user_id = isset($input['user_id'])?$input['user_id']:'';
        $id = isset($input['id'])?$input['id']:'';

        $member = isset($input['member'])?$input['member']:'';

        //connect DB
        $this->connect();
        $sql = "UPDATE  b2i_project SET projectsetup_id=:projectsetup_id,name=:name,schoolname=:schoolname,
        schoolregion=:schoolregion,detail=:detail WHERE id=:id";
        $params= array(
            ':projectsetup_id'=> $projectsetup_id,
            ':name'=> $name,
            ':schoolname'=> $schoolname,
            ':schoolregion'=> $schoolregion,
            ':detail'=> $detail,
            ':id'=> $id
        );
        $lastId = $this->update($sql,$params);

        //delete all member by project id
        $sql = "DELETE FROM b2i_project_member WHERE project_id=:project_id";
        $params= array(':project_id'=>$id);
        $lastId2 = $this->update($sql,$params);

        //insert to member
        $sql = "INSERT INTO b2i_project_member (project_id,user_id,membertype) 
        VALUES (:project_id,:user_id,:membertype)";
        $membertype = 'header';
        $params= array(
            ':project_id'=> $id,
            ':user_id'=> $user_id,
            ':membertype'=> $membertype
        );
        $lastId2 = $this->insert($sql,$params);


        if($member!=''){
            $cut = explode("-",$member);
            foreach ($cut as $item){
                $sql = "INSERT INTO b2i_project_member (project_id,user_id) VALUES (:project_id,:user_id)";
                $params= array(
                    ':project_id'=> $id,
                    ':user_id'=> $item,
                );
                $lastId2 = $this->insert($sql,$params);
            }
        }



        //close DB
        $this->close();


        return 1;
    }

    function getProjectById($id){
        $this->connect();
        $sql = "select * from  b2i_project where id=:id";
        $params= array(':id'=> $id);
        $result = $this->query($sql,$params);
        $this->close();
        return $result;
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

    function getProjectBySetupId($setup_id){
        $this->connect();
        $sql = "select * from b2i_project where projectsetup_id=:setup_id ";
        $params= array(':setup_id'=> $setup_id);
        $project = $this->queryAll($sql,$params);

        $sql = "select * from b2i_project_phase ";
        $params= array();
        $phase = $this->queryAll($sql,$params);

        $this->close();

        $data_return =[];
        $arr_phase = [];
        foreach ($phase as $item){
            if(isset($arr_phase[$item['project_id']])){
            }else{
                $arr_phase[$item['project_id']]=[
                    'phase1result'=> 'none',
                    'phase2result'=> 'none'
                ];
            }

            if($item['phase']=='1'){
                $arr_phase[$item['project_id']]['phase1result'] = $item['result'];
            }elseif($item['phase']=='2'){
                $arr_phase[$item['project_id']]['phase2result'] = $item['result'];
            }
        }

        foreach ($project as $item){
            if(isset($arr_phase[$item['id']])){
                $item['phase1result'] = $arr_phase[$item['id']]['phase1result'];
                $item['phase2result'] = $arr_phase[$item['id']]['phase2result'];
                $data_return[] = $item;
            }else{
                $item['phase1result'] = 'none';
                $item['phase2result'] = 'none';
                $data_return[] = $item;
            }
        }
        return $data_return;
    }

    function getProjectByProjectSetUp($projectSetUp){
        $this->connect();
        $project = [];
        $sql = "select * from b2i_project
        where b2i_project.projectsetup_id =:projectsetup_id ";
        $params= array(':projectsetup_id'=> $projectSetUp);
        $p = $this->queryAll($sql,$params);
        foreach ($p as $item){
            $sql = "select * from b2i_project_phase where project_id =:project_id and phase = 1";
            $params= array(':project_id'=> $item['id']);
            $result = $this->query($sql,$params);
            if(isset($result["result"])){
                $item['result']=$result['result'];
            }else{
                $item['result']='process';
            }
            $project[]=$item;
        }

        $this->close();

        return $project;
    }
    function getProjectByPhase($projectSetUp , $phase){
        $this->connect();
        $sql = "select b2i_project.* , b2i_project_phase.result from b2i_project_phase
        left join b2i_project on b2i_project.id = b2i_project_phase.project_id
        where b2i_project.projectsetup_id =:projectsetup_id and b2i_project_phase.phase =:phase ";
        $params= array(':projectsetup_id'=> $projectSetUp , ':phase'=>$phase);
        $project = $this->queryAll($sql,$params);

        $this->close();

        return $project;
    }
    function getProjectByConfirm($projectSetUp , $phase){
        $this->connect();
        $sql = "select b2i_project.* , b2i_project_confirm.result from b2i_project_confirm
        left join b2i_project on b2i_project.id = b2i_project_confirm.project_id
        where b2i_project.projectsetup_id =:projectsetup_id and b2i_project_confirm.confirm_phase =:phase ";
        $params= array(':projectsetup_id'=> $projectSetUp , ':phase'=>$phase);
        $project = $this->queryAll($sql,$params);

        $this->close();

        return $project;
    }

    function deleteProject($project_id){
        $this->connect();

        //delete confirm , confirm_member
        $sql = "select * from b2i_project_confirm where project_id=:project_id ";
        $params= array(':project_id'=> $project_id);
        $confirm = $this->queryAll($sql,$params);
        foreach ($confirm as $item){
            $sql = "DELETE FROM b2i_project_confirm_member WHERE confirm_id=:confirm_id";
            $params= array(':confirm_id'=> $item['id']);
            $result = $this->update($sql,$params);
        }
        $sql = "DELETE FROM b2i_project_confirm WHERE project_id=:project_id";
        $params= array(':project_id'=> $project_id);
        $result = $this->update($sql,$params);

        //project member
        $sql = "DELETE FROM b2i_project_member WHERE project_id=:project_id";
        $params= array(':project_id'=> $project_id);
        $result = $this->update($sql,$params);

        //phase
        $sql = "select * from b2i_project_phase where project_id=:project_id ";
        $params= array(':project_id'=> $project_id);
        $phase = $this->queryAll($sql,$params);
        foreach ($phase as $item){
            $sql = "DELETE FROM b2i_project_phase_log WHERE phase_id=:phase_id";
            $params= array(':phase_id'=> $item['id']);
            $result = $this->update($sql,$params);

            $sql = "DELETE FROM b2i_project_phase_upload WHERE phase_id=:phase_id";
            $params= array(':phase_id'=> $item['id']);
            $result = $this->update($sql,$params);

        }
        $sql = "DELETE FROM b2i_project_phase where project_id=:project_id ";
        $params= array(':project_id'=> $project_id);
        $result = $this->update($sql,$params);


        $sql = "DELETE FROM b2i_project where id=:project_id ";
        $params= array(':project_id'=> $project_id);
        $result = $this->update($sql,$params);

        $this->close();

        return $result;

    }


    /* ----- function call ----- */
    function checkUserInProject($project_id , $user_id){
        $this->connect();
        $sql = "select * from  b2i_project_member where project_id=:project_id AND user_id=:user_id";
        $params= array(':project_id'=> $project_id , ':user_id'=> $user_id);
        $result = $this->query($sql,$params);
        $this->close();
        return isset($result);
    }

}