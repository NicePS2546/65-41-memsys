<?php


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
        $_SESSION['id'] = $row['id'];
        $_SESSION['role'] = $row['role'];
        echo "<script>console.log('Login Successfully')</script>";
        header("Location: ../admin/index.php");
        exit(); // Ensure no further output after redirect
      } else {
        $_SESSION['id'] = $row['id'];
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
  public function checkemail($conn, $table, $email)
  {
    try {

      // ตรวจสอบวา่ อีเมลซ้า หรือไม่
      $sql = "SELECT COUNT(*) FROM $table WHERE email = :email";
      $stmt = $conn->prepare($sql);
      $stmt->execute(['email' => $email]);
      $data = $stmt->fetchColumn(); // ดึงค่า count จากการตรวจสอบอีเมล
      return $data;
    } catch (PDOException $e) {
      return $e;
    }
  }
  function register($conn, $table, $fname, $lname, $email, $password, $role)
  {
    $email_exist = $this->checkemail($conn, $table, $email);
    if ($email_exist > 0) {
      return ['message' => 'email_exist', 'status' => false];
    } else {
      $sql = "INSERT INTO $table (fname,lname,email,password,role) VALUES (:fname,:lname,:email,:password,:role)";
      $smt = $conn->prepare($sql);
      $data = $smt->execute(['fname' => $fname, 'lname' => $lname, 'email' => $email, 'password' => $password, 'role' => $role]);
      return [$data, 'status' => true];
    }
  }

  function new_register($conn, $fname, $lname, $email, $passwordHash)
  {
    $email_exist = $this->checkemail($conn, 'tb_users', $email);
    if ($email_exist > 0) {
      return ['message' => 'email_exist', 'status' => false];
    } else {
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
        // return $person_status && $user_status;
        return ['message' => 'successful', 'status' => $person_status && $user_status];
      } catch (Exception $e) {
        $conn->rollBack();
        return ['message' => "$e", 'status' => false];;
        // ก าหนดค่า result เป็น error เมื่อเกิดข้อผิดพลาด
      }
    }
  }

  public function update_user($conn, $fname, $lname, $dob, $avatar, $role, $id)
  {

    try {
      // เริ่มการท าธุรกรรม (Transaction) เพื่อให้แน่ใจว่าข้อมูลถูกบันทึกลงทั้งสองตาราง หรือไม่บันทึกเลย
      $conn->beginTransaction();

      // ค าสั่ง SQL ส าหรับบันทึก fname และ lname ลงตาราง persons
      $sql1 = "UPDATE persons SET 
    fname = :fname, 
    lname = :lname, 
    dob = :dob, 
    avatar = :avatar
    WHERE id = :id";
      $stmt1 = $conn->prepare($sql1);
      $person_status = $stmt1->execute(['fname' => $fname, 'lname' => $lname, 'dob' => $dob, 'avatar' => $avatar, 'id' => $id]);
      // รับค่า person_id ของแถวที่เพิ่งถูกเพิ่มใน persons


      // ค าสั่ง SQL ส าหรับบันทึก email, password และ role ลงตาราง tb_users
      $sql2 = "UPDATE tb_users SET 
    person_id = :person_id,
    role = :role 
    WHERE person_id = :person_id";
      $stmt2 = $conn->prepare($sql2);

      $user_status = $stmt2->execute(['person_id' => $id, 'role' => $role]);
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





  public function getIDdynamic($conn, $table, $value, $var, $id)
  {
    $sql = "SELECT $value FROM $table WHERE $var = :$var";
    $smt = $conn->prepare($sql);
    $smt->execute([$var => $id]);
    $data = $smt->fetchColumn();
    if ($data) {
      echo "<script>console.log('fetched user')</script>";
    } else {
      echo "<script>console.log('error')</script>";
    }
    return $data;
  }
  public function update($conn, $table, $fname, $lname, $email, $password, $role, $id)
  {
    $sql = "UPDATE $table SET 
    fname = :fname, 
    lname = :lname, 
    email = :email, 
    password = :password,
    role = :role
WHERE id = :id";
    // Prepare statement
    $stmt = $conn->prepare($sql);
    // execute the query
    $result = $stmt->execute([
      'fname' => $fname,
      'lname' => $lname,
      'email' => $email,
      'password' => $password,
      'role' => $role,
      'id' => $id
    ]);
    return $result;
  }
  public function deleteTwoRows($conn, $table, $table2, $id)
  {
    try {
      $conn->beginTransaction();
      $get_id = $this->getIDdynamic($conn,  $table, 'person_id', 'id', $id);

      $delete_row1 = $this->deleteById($conn, $table2, 'id', $id);
      if ($get_id) {
        $delete_row2 = $this->deleteById($conn, $table, 'person_id', $get_id);
      }
      $conn->commit(); // Commit การเปลี่ยนแปลง

      return $delete_row1 && $delete_row2;
    } catch (PDOException $e) {
      $conn->rollBack();
      return $e;
    }
  }

  function deleteById($conn, $table, $var, $id)
  {
    try {

      $sql = "DELETE FROM $table WHERE $var = ?";
      $stmt = $conn->prepare($sql);
      $stmt->bindParam(1, $id);
      $result = $stmt->execute();
      echo "<script>console.log('Deleted Users')</script>";
      return $result;
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
  }
  public function getJoinTable($conn, $pk_tb = 'persons', $fk_tb = 'tb_users', $pk_key, $fk_key)
  {
    $sql = "SELECT $pk_tb.*, $fk_tb.* FROM $pk_tb
  LEFT JOIN $fk_tb ON $pk_tb.$pk_key = $fk_tb.$fk_key";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $data;
  }
  public function getSoleJoinDynamic($conn, $pk_tb = 'persons', $fk_tb = 'tb_users', $pk_key, $fk_key, $id)
  {
    $sql = "SELECT $pk_tb.*, $fk_tb.* FROM $pk_tb
  LEFT JOIN $fk_tb ON $pk_tb.$pk_key = $fk_tb.$fk_key
  WHERE $pk_tb.$pk_key = :$pk_key";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$pk_key => $id]);
    $data = $stmt->fetch(PDO::FETCH_ASSOC);
    return $data;
  }

  function getConnection()
  {
    return $this->DBconnect;
  }
};
