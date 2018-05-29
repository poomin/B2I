<?php
/**
 * Created by PhpStorm.
 * User: Gimo
 * Date: 29/5/2561
 * Time: 23:22
 */
session_start();
session_destroy();
header("Location: /index.php");
exit;