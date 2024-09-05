<?php
$servername = 'localhost';
$DBusername = 'root';
$DBpassword = '';
$dataBaseName = 'db67_6541_member';
$tableName = 'tb_users';

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
  function addUserPrePare($conn, $fname, $lname, $email, $password, $role)
  {
    $sql = "INSERT INTO tb_users (fname,lname,email,password,role) VALUES (:fname,:lname,:email,:password,:role)";
    $smt = $conn->prepare($sql);
    $result = $smt->execute(['fname' => $fname, 'lname' => $lname, 'email' => $email, 'password' => $password, 'role' => $role]);
    // $smt->bindParam(':fname', $fname);
    // $smt->bindParam(':lname', $lname);
    // $smt->bindParam(':email', $email);
    // $smt->bindParam(':password', $password);
    // $smt->bindParam(':role', $role);
    // $result = $smt->execute();

    if ($result) {
      echo "สำเร็จ";
      return $result;
    } else {
      echo "ผิดพลาด";
      return false;
    }
  }
  function addUserQ($conn, $fname, $lname, $email, $password, $role)
  {
    $sql = "INSERT INTO tb_users (fname,lname,email,password,role) VALUES (?,?,?,?,?)";
    $smt = $conn->prepare($sql);
    $smt->bindParam(1, $fname);
    $smt->bindParam(2, $lname);
    $smt->bindParam(3, $email);
    $smt->bindParam(4, $password);
    $smt->bindParam(5, $role);
    $result = $smt->execute();

    if ($result) {
      return $result;
    } else {
      return null;
    }
  }
  function showUserDetail($conn, $table, $id, $action)
  {
    try {
      $sql = "SELECT * FROM $table WHERE id = ?";
      $stmt = $conn->prepare($sql);
      $stmt->bindParam(1, $id);
      $stmt->execute();
      $user = $stmt->fetch(PDO::FETCH_ASSOC);
      // แสดงข้อความยืนยันลบข้อมูล
      if ($user['role'] === 1) {
        $role = 'Admin';
      } else {
        $role = 'User';
      }
      ;
      echo "Are you sure you want to delete the following student?<br>";
      echo "ID: " . $user['id'] . "<br>";
      echo "First Name: " . $user['fname'] . "<br>";
      echo "Last Name: " . $user['lname'] . "<br>";
      echo "Email: " . $user['email'] . "<br>";
      echo "Password: " . $user['password'] . "<br>";
      echo "role: " . $role . "<br>";
      // สร้างปุ่มยืนยันลบข้อมูล
      echo "<form action='$action' method='POST'>";
      echo "<input type='hidden' name='userId' value='$id'>";
      echo "<input type='submit' name='confirm_delete' value='Confirm Delete'>";
      echo "</form>";
    } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
    }
  }
  public function getSole($conn, $table, $id){
    $sql = "SELECT * FROM $table WHERE id = :id";
    $smt = $conn->prepare($sql);
    $smt->execute(["id"=>$id]);
    $data = $smt->fetch(PDO::FETCH_ASSOC);
    return $data;
  }
  function connectServer($servername, $username, $dbname, $password)
  {
    try {
      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      // echo "เชื่อมต่อฐานข้อมูลสำเร็จ";
      return $conn;
    } catch (PDOException $error) {
      echo "เชื่อมต่อฐานข้อมูลไม่สำเร็จ: " . $error->getMessage();
      return null;
    }

  }

  function deleteById($conn, $table, $id)
  {
    try {

      $sql = "DELETE FROM $table WHERE id=?";
      $stmt = $conn->prepare($sql);
      $stmt->bindParam(1, $id);
      $result = $stmt->execute();
      echo "<script>console.log('Deleted Users')</script>";
      return $result;

    } catch (PDOException $e) {
      echo $e->getMessage();
    }
  }
  function update($conn, $tablename,$fname,$lname,$email,$password,$role,$id){
    
   
   
    $sql = "UPDATE $tablename SET 
    fname = :fname, 
    lname = :lname, 
    email = :email, 
    password = :password,
    role = :role
WHERE id = :id";
    // Prepare statement
    $stmt = $conn->prepare($sql);
    // execute the query
    $result = $stmt->execute(['fname'=>$fname,
     'lname'=>$lname,
     'email'=>$email,
     'password'=>$password,
     'role'=>$role,
      'id'=>$id]);
    return $result;
  }
  function getConnection()
  {
    return $this->DBconnect;
  }
}
$server = new Server($servername, $DBusername, $DBpassword, $dataBaseName, $tableName);

$connect = $server->getConnection();


?>