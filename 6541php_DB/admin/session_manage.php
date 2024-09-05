<?php

if (!isset($_SESSION['role'])) {
    header('Location: ../auth/login.php');
    $_SESSION['error'] = 'โปรดเข้าสู่ระบบก่อน';
    exit();
}

if (isset($_SESSION['Admin'])) {
    header('Location: ../admin/index.php');
    exit();
} else if (isset($_SESSION['User'])) {
    header('Location: ../ex08_user_showdata.php');
    exit();
}





?>