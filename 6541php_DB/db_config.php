<?php

$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'db67_6541_memsys';
$tableName = 'tb_users';


try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "เชื่อมต่อฐานข้อมูลสำเร็จ";
  } catch (PDOException $error) {
    echo "เชื่อมต่อฐานข้อมูลไม่สำเร็จ: " . $error->getMessage();
    
  }



?>