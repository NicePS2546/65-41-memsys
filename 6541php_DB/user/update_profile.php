<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
    }
include "session_manage.php";
include 'header.php';
include 'navbar.php';
include 'sidebar.php';
include 'update_profile_dt.php';
include 'footer.php';
?>