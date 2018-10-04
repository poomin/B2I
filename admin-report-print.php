<?php
/**
 * Created by PhpStorm.
 * User: EPOP
 * Date: 10/3/2018
 * Time: 2:33 PM
 */
date_default_timezone_set("Asia/Bangkok");
require_once __DIR__.'/controller/ModelReport.php';
$MR = new ModelReport();
$PROJECT   = [];
$HEADER = "";

$id = isset($_REQUEST['id'])?$_REQUEST['id']:'';
$value = isset($_REQUEST['value'])?$_REQUEST['value']:'';
$activePhase = '';
if($id=='p1' || $id=='p2'){
    if($id=='p1'){
        $phase = 1;
        $HEADER = "นำเสนอหัวข้อสิ่งประดิษฐ์";
    }else{
        $phase = 2;
        $HEADER = "ส่ง video";
    }
    $activePhase = 'phase';
    $sql = "select pro.id, pro.name , pro.schoolname , pro.schoolregion , phase.result , school.* from b2i_project_phase as phase
left join b2i_project as pro on pro.id = phase.project_id
left join b2i_school as school on school.school_name = pro.schoolname
where phase.phase=$phase ";
    $cut = explode('::',$value);
    $conP = "";
    for($i=1;$i<count($cut);$i++){
        if ($i==1){
            $conP .= " and phase.result in ('".$cut[$i]."'";
        }else{
            $conP .= ",'".$cut[$i]."'";
        }
    }
    if($conP!=""){
        $conP.=")";
        $sql.=$conP;
    }
    $mThis = $MR->reportSql($sql);
    foreach ($mThis as $key=>$item){
        $id= $item['id'];
        $name = $item['name'];
        $schoolname = $item['schoolname'];
        $schoolregion = $item['schoolregion'];
        $result = $item['result'];

        $address = "";
        $address.= ($item['address']=='' || $item['address']=='-')?'':$item['address'];
        $address.= ($item['subdistrict']=='' || $item['subdistrict']=='-')?'':' ตำบล'.$item['subdistrict'];
        $address.= ($item['district']=='' || $item['district']=='-')?'':' อำเภอ'.$item['district'];
        $address.= ($item['province']=='' || $item['province']=='-')?'':' จังหวัด'.$item['province'];
        $address.= ($item['code']=='' || $item['code']=='-')?'':' '.$item['code'];

        $sql = "select u.name , u.surname , m.membertype from b2i_project_member m
left join b2i_user u on m.user_id = u.id
where m.project_id = $id";
        $member = $MR->reportSql($sql);

        $PROJECT[] = [
            'name'=> $name,
            'schoolname' => $schoolname,
            'address'=>$address,
            'schoolregion'=> $schoolregion,
            'result'=> $result,
            'member'=>$member
        ];
    }

}
elseif($id=='c1' || $id=='c2'){
    if($id=='c1'){
        $phase = 1;
        $HEADER = "ยืนยันเข้าร่วมโครงการ";
    }else{
        $phase = 2;
        $HEADER = "ยืนยันเข้าร่วมรอบชิง";
    }
    $activePhase = 'confirm';
    $sql = "select pro.id, pro.name , pro.schoolname , pro.schoolregion , phase.result , school.* from b2i_project_phase as phase
left join b2i_project as pro on pro.id = phase.project_id
left join b2i_school as school on school.school_name = pro.schoolname
where phase.phase=$phase ";
    $mThis = $MR->reportSql($sql);
    foreach ($mThis as $key=>$item){
        $id= $item['id'];
        $name = $item['name'];
        $schoolname = $item['schoolname'];
        $schoolregion = $item['schoolregion'];
        $result = $item['result'];

        $address = "";
        $address.= ($item['address']=='' || $item['address']=='-')?'':$item['address'];
        $address.= ($item['subdistrict']=='' || $item['subdistrict']=='-')?'':' ตำบล'.$item['subdistrict'];
        $address.= ($item['district']=='' || $item['district']=='-')?'':' อำเภอ'.$item['district'];
        $address.= ($item['province']=='' || $item['province']=='-')?'':' จังหวัด'.$item['province'];
        $address.= ($item['code']=='' || $item['code']=='-')?'':' '.$item['code'];

        $sql = "select u.name , u.surname , m.membertype , m.shirts_size , m.phone , m.classroom , m.vegetarian_food , c.driver ,c.check_in  from b2i_project_confirm c 
left join b2i_project_confirm_member m on c.id = m.confirm_id
left join b2i_user u on m.user_id = u.id
where c.project_id =$id";
        $member = $MR->reportSql($sql);

        $CONFIRM[] = [
            'name'=> $name,
            'schoolname' => $schoolname,
            'address'=>$address,
            'schoolregion'=> $schoolregion,
            'driver'=> $member[0]['driver'],
            'checkin'=>$member[0]['check_in'],
            'member'=>$member
        ];
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include '_header.php'; ?>
</head>

<body style="padding-top: 10px;">


    <div class="row">
        <div class="col-md-10 text-center">
            <h4><strong><?php echo $HEADER; ?></strong></h4>
        </div>
        <div class="col-md-2 text-right">
            <button class="btn btn-link" onClick="window.print()"><i class="fa fa-print fa-2x"></i></button>
        </div>
    </div>

    <div <?php echo $activePhase=='phase'?'':'hidden';?> >
        <table class="table table-bordered table-sm">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">N</th>
                <th scope="col">Status</th>
                <th scope="col">S & A</th>
                <th scope="col">R</th>
                <th scope="col">F-L</th>
                <th scope="col">S</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($PROJECT as $key=>$item): ?>
                <?php
                $rowspan = count($item['member']);
                $trClass = '';
                if($key%2==0){
                    $trClass = 'active';
                }
                ?>
                <tr class="<?php echo $trClass;?>">
                    <th scope="row" rowspan="<?php echo $rowspan; ?>"><?php echo ($key+1); ?></th>
                    <td scope="row" rowspan="<?php echo $rowspan; ?>"> <?php echo $item['name']; ?></td>
                    <td scope="row" rowspan="<?php echo $rowspan; ?>"> <?php echo $item['result']; ?></td>
                    <td scope="row" rowspan="<?php echo $rowspan; ?>">
                        <p><strong><?php echo $item['schoolname']; ?></strong></p>
                        <p><small><?php echo $item['address']; ?></small></p>
                    </td>
                    <td scope="row" rowspan="<?php echo $rowspan; ?>"> <?php echo $item['schoolregion']; ?></td>


                    <?php foreach ($item['member'] as $k=>$i): ?>
                        <td><?php echo $i['name'].' '.$i['surname']; ?></td>
                        <td><?php echo $i['membertype']=='header'?'ที่ปรึกษาโครงการ':'นักเรียน/นักศึกษา'; ?></td>
                    </tr>
                    <tr class="<?php echo $trClass;?>">
                    <?php endforeach; ?>

                </tr>

            <?php endforeach; ?>

            </tbody>
        </table>
    </div>

    <div <?php echo $activePhase=='confirm'?'':'hidden';?>>
        <table class="table table-bordered table-sm">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">N</th>
                <th scope="col">S & A</th>
                <th scope="col">R</th>
                <th scope="col">F-L</th>
                <th scope="col">S</th>
                <th scope="col">SIZE</th>
                <th scope="col">F</th>
                <th scope="col">C</th>
                <th scope="col">Tel.</th>
                <th scope="col">Check in</th>
                <th scope="col">D.</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($CONFIRM as $key=>$item): ?>
                <?php
                $rowspan = count($item['member']);
                $trClass = '';
                if($key%2==0){
                    $trClass = 'active';
                }
                ?>
                <tr class="<?php echo $trClass;?>">
                <th scope="row" rowspan="<?php echo $rowspan; ?>"><?php echo ($key+1); ?></th>
                <td scope="row" rowspan="<?php echo $rowspan; ?>"> <?php echo $item['name']; ?></td>
                <td scope="row" rowspan="<?php echo $rowspan; ?>">
                    <p><strong><?php echo $item['schoolname']; ?></strong></p>
                    <p><small><?php echo $item['address']; ?></small></p>
                </td>
                <td scope="row" rowspan="<?php echo $rowspan; ?>"> <?php echo $item['schoolregion']; ?></td>


                <?php foreach ($item['member'] as $k=>$i): ?>
                    <td><?php echo $i['name'].' '.$i['surname']; ?></td>
                    <td><?php echo $i['membertype']=='header'?'ที่ปรึกษาโครงการ':'นักเรียน/นักศึกษา'; ?></td>
                    <td><?php echo $i['shirts_size']; ?></td>
                    <td><?php echo $i['vegetarian_food']=='Y'?'ไม่ทาน':'ทาน'; ?></td>
                    <td><?php echo $i['classroom']; ?></td>
                    <td><?php echo $i['phone']; ?></td>
                    <?php if ($k==0): ?>
                        <td scope="row" rowspan="<?php echo $rowspan; ?>"> <?php echo $item['checkin']==''?'':date('d/m/Y',strtotime($item['checkin'])); ?></td>
                        <td scope="row" rowspan="<?php echo $rowspan; ?>"> <?php echo $item['driver']; ?></td>
                    <?php endif; ?>
                    </tr>
                    <tr class="<?php echo $trClass;?>">
                <?php endforeach; ?>

                </tr>

            <?php endforeach; ?>
            </tbody>
        </table>

    </div>



<?php include '_script.php'; ?>
<script>
</script>

</body>
</html>
