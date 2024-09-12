<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
;
if (isset($_SESSION['Admin'])) {
    header('Location: ../admin/index.php');
    exit();
} else if (isset($_SESSION['User'])) {
    header('Location: ../ex08_user_showdata.php');
    exit();
}





?>