<?php
/**
 * Created by PhpStorm.
 * User: Gimo
 * Date: 29/5/2561
 * Time: 11:39
 */
?>
<nav class="navbar navbar-fixed-top navbar-default">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#menu">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <div class="navbar-brand page-scroll">
                <?php if(isset($_SESSION['username'])): ?>
                <a style="text-decoration: underline;" href="user-profile.php"><i class="fa fa-gears sr-icons"></i> <?= ucwords($_SESSION['username']);?></a>
                <?php endif; ?>
            </div>
        </div>
        <div class="collapse navbar-collapse navbar-right" id="menu">
            <ul class="nav navbar-nav">
                <li class="<?= $m_nev == 'home' ? 'active' : ''; ?> lien"><a href="index.php"><i class="fa fa-home sr-icons"></i> หน้าหลัก</a></li>
                <li class="<?= $m_nev == 'project' ? 'active' : ''; ?> lien"><a href="index-project.php"><i class="fa fa-bookmark sr-icons"></i> โครงการ</a></li>
                <li class="<?= $m_nev == 'news' ? 'active' : ''; ?> lien"><a href="index-news.php"><i class="fa fa-file-text sr-icons"></i> ข่าว/ประกาศ</a></li>
                <li class="<?= $m_nev == 'about' ? 'active' : ''; ?> lien"><a href="index-about.php"><i class="fa fa-phone-square sr-icons"></i> ติดต่อเรา</a></li>
                <?php if(!isset($_SESSION['id'])): ?>
                    <li class="<?= $m_nev == 'register' ? 'active' : ''; ?> lien"><a href="index-register.php"><i class="fa fa-user-plus sr-icons"></i> สมัครสมาชิก</a></li>
                    <li class="<?= $m_nev == 'login' ? 'active' : ''; ?> lien"><a href="index-login.php"><i class="fa fa-unlock-alt sr-icons"></i> เข้าสู่ระบบ</a></li>
                <?php else: ?>
                    <li class="lien"><a href="index-logout.php"><i class="fa fa-lock sr-icons"></i> ออกจากระบบ</a></li>
                <?php endif;?>

            </ul>
        </div>
    </div>
</nav>
