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

    /* ----- user-project.php --*/
    function getProjectLastStatus($project_id){
        $this->connect();

        $sql = 'select b2i_projectsetup.* from b2i_project 
        left join b2i_projectsetup on b2i_project.projectsetup_id = b2i_projectsetup.id
        where b2i_project.id=:project_id';
        $params= array(':project_id'=> $project_id);
        $projectSetup = $this->query($sql,$params);

        $sql = 'select * from b2i_project_phase where project_id=:project_id';
        $params= array(':project_id'=> $project_id);
        $projectPhase = $this->queryAll($sql,$params);
        $keyPhase = [];
        $checkPhase = ['status'=>false,'phase'=>1];
        foreach ($projectPhase as $item){
            $keyPhase[$item['phase']] = $item['result'];
            if($item['result']=='fail'){
                $checkPhase = ['status'=>true,'phase'=>$item['phase']];
            }
        }

        $sql = 'select * from b2i_project_confirm where project_id=:project_id';
        $params= array(':project_id'=> $project_id);
        $projectConfirm = $this->queryAll($sql,$params);
        $keyConfirm = [];
        $checkConfirm = ['status'=>false,'phase'=>1];
        foreach ($projectConfirm as $item){
            $keyConfirm[$item['confirm_phase']] = $item['result'];
            if($item['result']=='fail'){
                $checkConfirm = ['status'=>true,'phase'=>$item['confirm_phase']];
            }
        }


        $this->close();


        //check phase fail
        if($checkPhase['status']){
            $sStatus = 'เสนอแนวคิดสิ่งประดิษฐ์';
            if($checkPhase['phase']==3){
                $sStatus='ส่งเอกสารรอบชิง';
            }
            elseif ($checkPhase['phase']==2){
                $sStatus='ส่งวีดีโอ';
            }
            return ['type'=>'fail' , 'status'=>$sStatus , 'message'=>'ไม่ผ่านการคัดเลือก'];
        }

        //check confirm fail
        if($checkConfirm['status']){
            $sStatus = 'ยืนยันเข้าร่วมอบรม';
            if($checkConfirm['phase']==3){
                $sStatus='ยืนยันเข้ารับรางวัล';
            }
            elseif ($checkConfirm['phase']==2){
                $sStatus='ยืนยันเข้าร่วมรอบชิง';
            }
            return ['type'=>'fail' , 'status'=>$sStatus , 'message'=>'ไม่ผ่านการคัดเลือก'];
        }

        //phase , confirm check status
        if(isset($projectSetup['id'])){
            $pc = $this->fnActiveLast($keyPhase,$keyConfirm);
            //confirm 3
            if($projectSetup['phase3confirm']!='close'){
                $sType = 'wait';
                $sStatus = 'เข้าร่วมรับรางวัล';
                $sMessage = 'รอการตรวจสอบจากคณะกรรมการ';
                if(isset($keyConfirm[3])){
                    $sType = $keyConfirm[3];
                    if($sType=='process'){
                        $sMessage='ยืนยัน/กรอกข้อมูล';
                    }
                    elseif ($sType=='fail'){
                        $sMessage='ไม่ผ่านการคัดเลือก';
                    }
                    elseif ($sType=='pass'){
                        $sMessage='ยืนยันเข้าร่วม';
                    }
                }
                elseif (isset($keyPhase[3]) && $keyPhase[3]=='pass'){
                    $sType='check';
                    $sMessage='ดำเนินการ';
                }
                elseif ($pc=='p3'){
                    $sStatus='ส่งเอกสารรอบชิง';
                }
                elseif ($pc=='c2'){
                    $sStatus='ยืนยันเข้าร่วมรอบชิง';
                }
                elseif ($pc=='p2'){
                    $sStatus='ส่งวีดีโอ';
                }
                elseif ($pc=='c1'){
                    $sStatus='ยืนยันเข้าร่วมอบรม';
                }
                elseif ($pc=='p1'){
                    $sStatus='เสนอแนวคิดสิ่งประดิษฐ์';
                }
                else{
                    $sType='non';
                    $sMessage='ไม่มีข้อมูล';
                }
                return ['type'=>$sType , 'status'=>$sStatus , 'message'=>$sMessage];
            }

            //phase 3
            elseif($projectSetup['phase3status']!='close'){
                $sType = 'wait';
                $sStatus = 'ส่งเอกสารรอบชิง';
                $sMessage = 'รอการตรวจสอบจากคณะกรรมการ';
                if(isset($keyPhase[3])){
                    $sType = $keyPhase[3];
                    if($sType=='process'){
                        $sMessage='ดำเนินการ';
                    }
                    elseif ($sType=='fail'){
                        $sMessage='ไม่ผ่านการคัดเลือก';
                    }
                    elseif ($sType=='pass'){
                        $sMessage='ผ่านการคัดเลือก';
                    }
                }
                elseif (isset($keyConfirm[2]) && $keyConfirm[2]=='pass'){
                    $sType='check';
                    $sMessage='ดำเนินการ';
                }
                elseif ($pc=='c2'){
                    $sStatus='ยืนยันเข้าร่วมรอบชิง';
                }
                elseif ($pc=='p2'){
                    $sStatus='ส่งวีดีโอ';
                }
                elseif ($pc=='c1'){
                    $sStatus='ยืนยันเข้าร่วมอบรม';
                }
                elseif ($pc=='p1'){
                    $sStatus='เสนอแนวคิดสิ่งประดิษฐ์';
                }
                else{
                    $sType='non';
                    $sMessage='ไม่มีข้อมูล';
                }
                return ['type'=>$sType , 'status'=>$sStatus , 'message'=>$sMessage];
            }

            //confirm 2
            elseif($projectSetup['phase2confirm']!='close'){
                    $sType = 'wait';
                    $sStatus = 'ยืนยันเข้าร่วมรอบชิง';
                    $sMessage = 'รอการตรวจสอบจากคณะกรรมการ';
                    if(isset($keyConfirm[2])){
                        $sType = $keyConfirm[2];
                        if($sType=='process'){
                            $sMessage='ยืนยัน/กรอกข้อมูล';
                        }
                        elseif ($sType=='fail'){
                            $sMessage='ไม่ผ่านการคัดเลือก';
                        }
                        elseif ($sType=='pass'){
                            $sMessage='ยืนยันเข้าร่วม';
                        }
                    }
                    elseif (isset($keyPhase[2]) && $keyPhase[2]=='pass'){
                        $sType='check';
                        $sMessage='ดำเนินการ';
                    }
                    elseif ($pc=='p2'){
                        $sStatus='ส่งวีดีโอ';
                    }
                    elseif ($pc=='c1'){
                        $sStatus='ยืนยันเข้าร่วมอบรม';
                    }
                    elseif ($pc=='p1'){
                        $sStatus='เสนอแนวคิดสิ่งประดิษฐ์';
                    }
                    else{
                        $sType='non';
                        $sMessage='ไม่มีข้อมูล';
                    }
                    return ['type'=>$sType , 'status'=>$sStatus , 'message'=>$sMessage];
                }

            //phase 2
            elseif($projectSetup['phase2status']!='close'){
                $sType = 'wait';
                $sStatus = 'ส่งวีดีโอ';
                $sMessage = 'รอการตรวจสอบจากคณะกรรมการ';
                if(isset($keyPhase[2])){
                    $sType = $keyPhase[2];
                    if($sType=='process'){
                        $sMessage='ดำเนินการ';
                    }
                    elseif ($sType=='fail'){
                        $sMessage='ไม่ผ่านการคัดเลือก';
                    }
                    elseif ($sType=='pass'){
                        $sMessage='ผ่านการคัดเลือก';
                    }
                }
                elseif (isset($keyConfirm[1]) && $keyConfirm[1]=='pass'){
                    $sType='check';
                    $sMessage='ดำเนินการ';
                }
                elseif ($pc=='c1'){
                    $sStatus='ยืนยันเข้าร่วมอบรม';
                }
                elseif ($pc=='p1'){
                    $sStatus='เสนอแนวคิดสิ่งประดิษฐ์';
                }
                else{
                    $sType='non';
                    $sMessage='ไม่มีข้อมูล';
                }
                return ['type'=>$sType , 'status'=>$sStatus , 'message'=>$sMessage];
            }

            //confirm 1
            elseif($projectSetup['phase1confirm']!='close'){
                $sType = 'wait';
                $sStatus = 'ยืนยันเข้าร่วมอบรม';
                $sMessage = 'รอการตรวจสอบจากคณะกรรมการ';
                if(isset($keyConfirm[1])){
                    $sType = $keyConfirm[1];
                    if($sType=='process'){
                        $sMessage='ยืนยัน/กรอกข้อมูล';
                    }
                    elseif ($sType=='fail'){
                        $sMessage='ไม่ผ่านการคัดเลือก';
                    }
                    elseif ($sType=='pass'){
                        $sMessage='ยืนยันเข้าร่วม';
                    }
                }
                elseif (isset($keyPhase[1]) && $keyPhase[1]=='pass'){
                    $sType='check';
                    $sMessage='ดำเนินการ';
                }
                elseif ($pc=='p1'){
                    $sStatus='เสนอแนวคิดสิ่งประดิษฐ์';
                }
                else{
                    $sType='non';
                    $sMessage='ไม่มีข้อมูล';
                }
                return ['type'=>$sType , 'status'=>$sStatus , 'message'=>$sMessage];
            }

            //phase 1
            elseif($projectSetup['phase1status']!='close'){
                $sType = 'wait';
                $sStatus = 'เสนอแนวคิดสิ่งประดิษฐ์';
                $sMessage = 'รอการตรวจสอบจากคณะกรรมการ';
                if(isset($keyPhase[1])){
                    $sType = $keyPhase[1];
                    if($sType=='process'){
                        $sMessage='ดำเนินการ';
                    }
                    elseif ($sType=='fail'){
                        $sMessage='ไม่ผ่านการคัดเลือก';
                    }
                    elseif ($sType=='pass'){
                        $sMessage='ผ่านการคัดเลือก';
                    }
                }
                elseif ($projectSetup['phase1status']=='process') {
                    $sType = 'check';
                    $sMessage = 'ดำเนินการ';
                }
                else{
                    $sType='non';
                    $sMessage='ไม่มีข้อมูล';
                }
                return ['type'=>$sType , 'status'=>$sStatus , 'message'=>$sMessage];
            }
        }
        return ['type'=>'non' , 'status'=>'ไม่มีข้อมูล' , 'message'=>'-'];
    }
    //return c3,p3,c2,p2,c1,p1,p
    function fnActiveLast($keyPhase,$keyConfirm){
        $str = 'p';

        if(isset($keyConfirm[3])){
            $str='c3';
        }
        elseif (isset($keyPhase[3])){
            $str='p3';
        }
        elseif(isset($keyConfirm[2])){
            $str='c2';
        }
        elseif (isset($keyPhase[2])){
            $str='p2';
        }
        elseif(isset($keyConfirm[1])){
            $str='c1';
        }
        elseif (isset($keyPhase[1])){
            $str='p1';
        }
        return $str;
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