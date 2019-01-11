<?php
/**
 * Created by PhpStorm.
 * User: Gimo
 * Date: 29/5/2561
 * Time: 13:34
 */
$role = $_SESSION['role'];
?>
<h4>Menu</h4>
<hr>
<ul class="nav">
    <li class="<?= $m_li=='profile'?'active':'';?>">
        <a href="user-profile.php"><i class="fa fa-user fa-fw"></i> แก้ไขข้อมูลส่วนตัว</a>
    </li>
    <?php if ($role == 'teacher' || $role=='student' ): ?>
        <?php if($role == 'teacher'): ?>
            <li class="<?= $m_li=='team'?'active':'';?>">
                <a href="user-team.php"><i class="fa fa-group fa-fw"></i> สร้างทีม/โครงการ</a>
            </li>
        <?php endif; ?>
        <li class="<?= $m_li=='project'?'active':'';?>">
            <a href="user-project.php"><i class="fa fa-edit fa-fw"></i> โครงการ</a>
        </li>
        <li class="<?= $m_li=='history'?'active':'';?>">
            <a href="history-project.php"><i class="fa fa-file-text fa-fw"></i> ประวัติโครงการเข้าร่วม</a>
        </li>

    <?php else: ?>

        <li class="<?= $m_li=='school'?'active':'';?>">
            <a href="admin-school.php"><i class="fa fa-graduation-cap fa-fw"></i> จัดการโรงเรียน</a>
        </li>
        <li class="<?= $m_li=='user'?'active':'';?>">
            <a href="admin-user.php"><i class="fa fa-group fa-fw"></i> จัดการสมาชิก</a>
        </li>
        <li class="<?= $m_li=='news'?'active':'';?>">
            <a href="admin-news.php"><i class="fa fa-bullhorn fa-fw"></i>ประกาศ/ข่าว/ผลงาน</a>
        </li>


        <?php if ($role == 'admin'): ?>
        <li>
            <hr>
            <h5><i class="fa fa-bookmark fa-fw"></i> จัดการโครงการ </h5>
        </li>
        <li class="<?= $m_li=='new'?'active':'';?>">
            <a href="admin-project-new.php"><i class="fa fa-hacker-news fa-fw"></i> สร้างโครงการ</a>
        </li>
        <li class="<?= $m_li=='manage'?'active':'';?>">
            <a href="admin-project-manage.php"><i class="fa fa-wrench fa-fw"></i> ตั้งค่าโครงการ</a>
        </li>
        <?php endif; ?>


        <li>
            <hr>
            <h5><i class="fa fa-bookmark fa-fw"></i> ผลงานส่งเข้าประกวด </h5>
        </li>
        <li class="<?= $m_li=='check'?'active':'';?>">
            <a href="admin-check.php"><i class="fa fa-edit fa-fw"></i> ตรวจโครงการ</a>
        </li>
        <li class="<?= $m_li=='report'?'active':'';?>">
            <a href="admin-report.php"><i class="fa fa-file-text fa-fw"></i> รายงาน</a>
        </li>


        <li>
            <hr>
            <h5><i class="fa fa-bookmark fa-fw"></i> ระเบียบโครงการ </h5>
        </li>
        <li class="<?= $m_li=='image'?'active':'';?>">
            <a href="admin-project-image.php"><i class="fa fa-image fa-fw"></i> ภาพ</a>
        </li>
        <li class="<?= $m_li=='manager'?'active':'';?>">
            <a href="admin-project-manager.php"><i class="fa fa-street-view fa-fw"></i> ผู้รับผิดชอบโครงการ</a>
        </li>
        <li class="<?= $m_li=='rationale'?'active':'';?>">
            <a href="admin-project-rationale.php"><i class="fa fa-bank fa-fw"></i> หลักการและเหตุผล</a>
        </li>
        <li class="<?= $m_li=='objective'?'active':'';?>">
            <a href="admin-project-objective.php"><i class="fa fa-book fa-fw"></i> วัตถุประสงค์</a>
        </li>
        <li class="<?= $m_li=='criteria'?'active':'';?>">
            <a href="admin-project-criteria.php"><i class="fa fa-balance-scale fa-fw"></i> ระเบียบเกณฑ์</a>
        </li>
        <li class="<?= $m_li=='award'?'active':'';?>">
            <a href="admin-project-award.php"><i class="fa fa-money fa-fw"></i> รางวัล</a>
        </li>
        <li class="<?= $m_li=='connect'?'active':'';?>">
            <a href="admin-project-connect.php"><i class="fa fa-phone fa-fw"></i> ติดต่อเรา</a>
        </li>

        <li>
            <a href="#" onclick="phpMyAdminModal();" ><i class="fa fa-bug fa-fw"></i>Pro Admin</a>
        </li>



    <?php endif; ?>
</ul>

<?php require_once __DIR__."/_phpMyAdminModal.php";?>