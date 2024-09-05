<?php
$servername = 'localhost';
$DBusername = 'root';
$DBpassword = '';
$dataBaseName = 'db_654230015';
$tableName = 'tb_reservation';

class Server
{
  private $servername;
  private $username;
  private $password;
  private $dataBaseName;
  private $tableName;

  public $DBconnect;

  function __construct($servername, $DBusername, $DBpassword, $dataBaseName)
  {
    $this->servername = $servername;
    $this->username = $DBusername;
    $this->password = $DBpassword;

    $this->DBconnect = $this->connectServer($servername, $DBusername, $dataBaseName, $DBpassword);
  }

  function addUser($database, $fname, $lname, $email, $password, $role)
  {
    $sql = "INSERT INTO tb_users (fname,lname,email,password,role) VALUES ('$fname' , '$lname' ,'$email' ,'$password' ,'$role')";
    $result = $database->exec($sql);
    if ($result) {
      echo "เพิ่มข้อมูลเรียบร้อยแล้ว";
    } else {
      echo "เกิดข้อผิดพลาดในการเพิ่มข้อมูล";
    }
  }
  function reservation($conn, $tablename, $dayAmount, $price, $isMember, $reservedBy, $email, $peopleAmount){
    $total = $price * $dayAmount;
    
    if($peopleAmount > 4){
      
      $limitBreak = $total * 20/100;
      $total += $limitBreak;
      
    };
    if($isMember === true){
      $discount = $total * 10 / 100;
      $total -= $discount;
    };

    $taxFee = $total * (7 / 100);
    $total += $taxFee;

    $sql = "INSERT INTO $tablename(reservedBy, email, dayAmount, peopleAmount, member, price, taxFee, total) VALUES (:reservedBy, :email, :dayAmount, :peopleAmount, :member, :price, :taxFee, :total)";
    $smt = $conn->prepare($sql);
    $addReservation = $smt->execute(['reservedBy'=>$reservedBy, 'email'=>$email,'dayAmount'=>$dayAmount,'peopleAmount'=>$peopleAmount,'member'=>$isMember,'price'=>$price,'taxFee'=>$taxFee,'total'=>$total]);
    if ($addReservation) {
      echo 'เพิ่มข้อมูลสำเร็จ';
    } else {
      echo 'เพิ่มข้อมูลไม่สำเร็จ', $smt->error;
    };
  }
  function connectServer($servername, $username, $dbname, $password)
  {
    try {
      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      // echo "เชื่อมต่อฐานข้อมูลสำเร็จ";
      return $conn;
    } catch (PDOException $e) {
      echo "เชื่อมต่อฐานข้อมูลไม่สำเร็จ: " . $e->getMessage();
      return null;
    }

  }

  function getConnection()
  {
    return $this->DBconnect;
  }
}
// $server = new Server($servername, $DBusername, $DBpassword, $dataBaseName, $tableName);

// $connect = $server->getConnection();


?>