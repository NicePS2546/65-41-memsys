<?php
include "Server.php";

$servername = 'localhost';
$DBusername = 'root';
$DBpassword = '';
$dataBaseName = 'db67_6541_memsys';
$table = 'tb_users';


$server = new Server($servername, $DBusername, $DBpassword, $dataBaseName);
$connect = $server->getConnection();
?>