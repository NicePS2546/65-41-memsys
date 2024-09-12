<?php
require_once "../auth/db_config.php";
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
$admin_id = $_SESSION['id'];
$row = $server->getSoleJoin($connect, $admin_id);
?>

<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-white">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
      <span class="nav-link">ยินดีต้อนรับ: <?php echo $row['fname'] . ' ' . $row['lname'] ?> </span>
    </li>

  </ul>
</nav>
<!-- /.navbar -->