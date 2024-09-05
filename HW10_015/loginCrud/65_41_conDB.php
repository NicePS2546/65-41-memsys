<?php
$servername = 'localhost';
$DBusername = 'root';
$DBpassword = '';
$dataBaseName = 'LoginDB';
$tableName = 'users';

class Server
{
  private $servername;
  private $username;
  private $password;
  private $dataBaseName;
  private $tableName;

  public $DBconnect;

  function __construct($servername, $DBusername, $DBpassword, $dataBaseName, $tableName)
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
};
$server = new Server($servername, $DBusername, $DBpassword, $dataBaseName, $tableName);

$connect = $server->getConnection();

class Login {
  
  function __construct($conn, $username,$password) {
      $sql = "SELECT * FROM users WHERE username = :username";
      $smt = $conn->prepare($sql);
      $smt->execute(["username"=>$username]);
      $user = $smt->fetch(PDO::FETCH_ASSOC);
      if($user && password_verify($password,$user['password'])){
        $_SESSION['userID'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['email'] = $user['email'];
        echo "<script>console.log('Login Successfully')</script>";
          header("Location: ../index.php");
          exit(); // Ensure no further output after redirect
    }else{
        echo "<script>console.log('Invalid Password ')</script>";
      }
  }

  
};

?>