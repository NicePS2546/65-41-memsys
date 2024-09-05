<?php
$servername = 'localhost';
$DBusername = 'root';
$DBpassword = '';
$dataBaseName = 'db67_6541_memsys';
$table = 'tb_users';

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
  public function getSole($conn, $table, $id)
  {
    $sql = "SELECT * FROM $table WHERE id = :id";
    $smt = $conn->prepare($sql);
    $smt->execute(["id" => $id]);
    $data = $smt->fetch(PDO::FETCH_ASSOC);
    if ($data) {
      echo "<script>console.log('fetched user')</script>";
    } else {
      echo "<script>console.log('error')</script>";
    }
    return $data;
  }
  public function getSoleJoin($conn, $id, $pk_tb = "", $fk_tb = "")
  {
    $sql = "SELECT persons.*, tb_users.* FROM persons
LEFT JOIN tb_users ON persons.id = tb_users.person_id
WHERE persons.id = :id";

    $smt = $conn->prepare($sql);
    $smt->execute(["id" => $id]);
    $data = $smt->fetch(PDO::FETCH_ASSOC);
    if ($data) {
      echo "<script>console.log('fetched user')</script>";
    } else {
      echo "<script>console.log('error')</script>";
    }
    return $data;
  }
  public function login($conn, $table, $email, $password)
  {
    $sql = "SELECT * FROM $table WHERE email = :email";
    $check = $conn->prepare($sql);
    $check->execute(["email" => $email]);
    $row = $check->fetch(PDO::FETCH_ASSOC);

    if ($row && password_verify($password, $row['password'])) {
      session_start();

      if ($row['role'] == 1) {
        $_SESSION['Admin'] = $row['id'];
        $_SESSION['role'] = $row['role'];
        echo "<script>console.log('Login Successfully')</script>";
        header("Location: ../admin/index.php");
        exit(); // Ensure no further output after redirect
      } else {
        $_SESSION['User'] = $row['id'];
        $_SESSION['role'] = $row['role'];
        echo "<script>console.log('Login Successfully')</script>";
        header("Location: ../user/index.php");
        exit(); // Ensure no further output after redirect
      }
    } else {
      echo "<script>console.log('Invalid Password ')</script>";
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
  function register($conn, $table, $fname, $lname, $email, $password, $role)
  {
    $sql = "INSERT INTO $table (fname,lname,email,password,role) VALUES (:fname,:lname,:email,:password,:role)";
    $smt = $conn->prepare($sql);
    $result = $smt->execute(['fname' => $fname, 'lname' => $lname, 'email' => $email, 'password' => $password, 'role' => $role]);
    return $result;

  }

  function new_register($conn, $fname, $lname, $email, $passwordHash)
  {
    try {
      // เริ่มการท าธุรกรรม (Transaction) เพื่อให้แน่ใจว่าข้อมูลถูกบันทึกลงทั้งสองตาราง หรือไม่บันทึกเลย
      $conn->beginTransaction();

      // ค าสั่ง SQL ส าหรับบันทึก fname และ lname ลงตาราง persons
      $sql1 = "INSERT INTO persons (fname, lname) VALUES (:fname, :lname)";
      $stmt1 = $conn->prepare($sql1);
      $person_status = $stmt1->execute(['fname' => $fname, 'lname' => $lname]);
      // รับค่า person_id ของแถวที่เพิ่งถูกเพิ่มใน persons
      $person_id = $conn->lastInsertId();

      // ค าสั่ง SQL ส าหรับบันทึก email, password และ role ลงตาราง tb_users
      $sql2 = "INSERT INTO tb_users (person_id, email, password) VALUES (?, ?, ?)";
      $stmt2 = $conn->prepare($sql2);
      $stmt2->bindParam(1, $person_id);
      $stmt2->bindParam(2, $email);
      $stmt2->bindParam(3, $passwordHash);
      $user_status = $stmt2->execute();
      // ถ้าทุกอย่างท างานเรียบร้อย ท าการ Commit เพื่อยืนยันการบันทึกข้อมูล
      $conn->commit();

      // $result = "success"; // ก าหนดค่า result เป็น success เมื่อส าเร็จ
      return $person_status && $user_status;
    } catch (Exception $e) {
      $conn->rollBack();
      return $e;
      // ก าหนดค่า result เป็น error เมื่อเกิดข้อผิดพลาด
    }

  }
  function getConnection()
  {
    return $this->DBconnect;
  }
}
;
$server = new Server($servername, $DBusername, $DBpassword, $dataBaseName);

$connect = $server->getConnection();


?>