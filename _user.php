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
    <?php if ($role != 'admin'): ?>
        <li class="<?= $m_li=='project'?'active':'';?>">
            <a href="user-project.php"><i class="fa fa-edit fa-fw"></i> โครงการ</a>
        </li>
    <?php else: ?>
        <li>
            <a href="#"><i class="fa fa-group fa-fw"></i> จัดการสมาชิก</a>
        </li>
        <li>
            <a href="#"><i class="fa fa-edit fa-fw"></i>ประกาศ/ข่าว</a>
        </li>
        <li>
            <a href="#"><i class="fa fa-edit fa-fw"></i> จัดการโครงการ</a>
        </li>
        <li>
            <hr>
            <i class="fa fa-bookmark fa-fw"></i> ระเบียบโครงการ
        </li>
        <li class="<?= $m_li=='project'?'active':'';?>">
            <a href="admin-project.php"><i class="fa fa-newspaper-o fa-fw"></i> โครงการ</a>
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

    <?php endif; ?>
</ul>
