<?php
/**
 * Created by PhpStorm.
 * User: EPOP
 * Date: 10/3/2018
 * Time: 2:33 PM
 */

session_start();
require_once __DIR__.'/_redirectAdmin.php';

$m_nev = '';
$m_li = 'report';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include '_header.php'; ?>

</head>

<body id="page-top">
<!-- Navigation Bar -->
<?php include '_menunev.php'; ?>
<!-- End of Navigation Bar -->

<!-- Container Box -->
<div id="card">
    <div class="container" style="padding-top: 40px; padding-bottom: 20px;">
        <div class="row">

            <div class="col-xs-12 col-sm-3">
                <div class="box-card">
                    <?php include '_user.php'?>
                </div>
            </div>

            <div class="col-xs-12 col-sm-9">
                <div class="box-card">
                    <div class="text-left">
                        <h3> รายงาน </h3>
                    </div>
                    <hr>

                    <div class="class-p1">
                        <p><h4><a id="link_ap1" href="admin-report-print.php?setid=<?=$SETID;?>&id=p1&value=" target="_blank">เสนอแนวคิดสิ่งประดิษฐ์ <i class="fa fa-print"></i> </a> </h4></p>
                        <p>
                            <input type="checkbox" id="p1F" value="::fail" onchange="onCheckP1(this);"> โครงการที่ตกรอบ
                        </p>
                        <p>
                            <input type="checkbox" id="p1Pro" value="::process" onchange="onCheckP1(this);"> โครงการที่กำลังดำเนินการ
                        </p>
                        <p>
                            <input type="checkbox" id="p1W" value="::wait" onchange="onCheckP1(this);"> โครงการที่รอตรวจสอบจากคณะกรรมการ
                        </p>
                        <p>
                            <input type="checkbox" id="p1P" value="::pass" onchange="onCheckP1(this);"> โครงการที่ผ่านการคัดเลือก
                        </p>
                        <hr>
                    </div>
                    <div class="class-c1">
                        <p><a href="admin-report-print.php?setid=<?=$SETID;?>&id=c1" target="_blank"><h4>ยืนยันเข้าร่วมอบรม <i class="fa fa-print"></i></h4></a></p>
                        <hr>
                    </div>
                    <div class="class-p2">
                        <p><h4><a id="ap2" href="admin-report-print.php?setid=<?=$SETID;?>&id=p2&value=" target="_blank">ส่ง video <i class="fa fa-print"></i> </a></h4></p>
                        <p>
                            <input type="checkbox" id="p2F" value="::fail" onchange="onCheckP2(this)"> โครงการที่ตกรอบ
                        </p>
                        <p>
                            <input type="checkbox" id="p2Pro" value="::process" onchange="onCheckP2(this)"> โครงการที่กำลังดำเนินการ
                        </p>
                        <p>
                            <input type="checkbox" id="p2W" value="::wait" onchange="onCheckP2(this)"> โครงการที่รอตรวจสอบจากคณะกรรมการ
                        </p>
                        <p>
                            <input type="checkbox" id="p2P" value="::pass" onchange="onCheckP2(this)"> โครงการที่ผ่านการคัดเลือก
                        </p>
                        <hr>
                    </div>
                    <div class="class-c2">
                        <p><a href="admin-report-print.php?setid=<?=$SETID;?>&id=c2" target="_blank"><h4>ยืนยันเข้าร่วมรอบชิง <i class="fa fa-print"></i></h4></a></p>
                        <hr>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>
<!-- End of container Box -->

<footer>
    <?php include '_footer.php'; ?>
</footer>
<?php include '_script.php'; ?>

<script>

    function onCheckP1(res) {
        var ap1 = $('#link_ap1').attr('href');
        var val = $(res).val();
        if($(res).is(':checked')){
            ap1 = ap1 + val;
        }else {
            ap1 = ap1.replace(val,'');
        }

        $('#link_ap1').attr("href",ap1);
    }

    function onCheckP2(res) {
        var ap1 = $('#ap2').attr('href');
        var val = $(res).val();
        if($(res).is(':checked')){
            ap1 = ap1 + val;
        }else {
            ap1 = ap1.replace(val,'');
        }
        $('#ap2').attr('href',ap1);
    }

</script>

</body>
</html>
