<?php session_start(); ?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Register Page</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
  <style>
    .divider:after,
    .divider:before {
      content: "";
      flex: 1;
      height: 1px;
      background: #eee;
    }

    .h-custom {
      height: calc(100% - 73px);
    }

    @media (max-width: 450px) {
      .h-custom {
        height: 100%;
      }
    }
  </style>
</head>

<body>
  <section class="vh-100">
    <div class="container-fluid h-custom">
      <div class="row d-flex justify-content-center  align-items-center h-100">

        <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">


          <form class="d-flex  flex-rows card p-5" action='register.php' method='post'>

            <!-- Email input -->

            <h4 class="mb-4">Register</h4>
            <div data-mdb-input-init class="form-outline form-floating mb-4">

              <input type="text" id="Username" name="username" class="form-control form-control-lg"
                placeholder="Enter Username" />
              <label class="form-label" for="Username">Username</label>
            </div>

            <div data-mdb-input-init class="form-outline form-floating mb-4">

              <input type="email" id="email" name="email" class="form-control form-control-lg"
                placeholder="Enter Email" />
              <label class="form-label" for="email">Email</label>
            </div>

            <!-- Password input -->
            <div data-mdb-input-init class="form-outline form-floating mb-3">

              <input type="password" id="password" name="password" class="form-control form-control-lg"
                placeholder="Enter password" />
              <label class="form-label" for="password">Password</label>
            </div>



            <div class="text-center text-lg-start mt-4 pt-2">
              <button type="submit" class="btn btn-primary btn-lg"
                style="padding-left: 2.5rem; padding-right: 2.5rem;">Register</button>
              <p class="small fw-bold mt-2 pt-1 mb-0">Have an account? <a href="/loginCrud/login.php"
                  class="link-danger">Login</a></p>
            </div>
          </form>
        </div>
      </div>
    </div>

    </div>
  </section>

</body>
<?php


// if (isset($_SESSION['username'])) {
//   header("Location: landing.php");
//   exit();
// }
// $servername = 'localhost';
// $DBusername = 'root';
// $DBpassword = '';
// $dataBaseName = 'Register';
// $tableName = 'User';

// class Register
// {
//   private $servername;
//   private $username;
//   private $password;
//   public $DBconnect;

//   function __construct($servername, $DBusername, $DBpassword)
//   {
//     $this->servername = $servername;
//     $this->username = $DBusername;
//     $this->password = $DBpassword;
//     $this->DBconnect = $this->connectServer();
//   }

//   private function connectServer()
//   {
//     $connect = new mysqli($this->servername, $this->username, $this->password);

//     if ($connect->connect_error) {
//       die("<script>console.log('Connection failed: " . $connect->connect_error . "')</script>");
//     } else {
//       echo "<script>console.log('Connected to server')</script>";
//       return $connect;
//     }
//   }

//   function getConnection()
//   {
//     return $this->DBconnect;
//   }

//   function createDataBase($connection, $dbname)
//   {
//     // Create database
//     $sql = "CREATE DATABASE $dbname";
//     if ($this->checkDatabaseExists($connection, $dbname) === false) {
//       if ($connection->query($sql)) {
//         echo "<script>console.log('Database created successfully')</script>";
//       } else {
//         echo "<script>console.log('Error creating database: " . $connection->error . "')</script>";
//       }
//     }

//   }

//   function createTable($connection, $dbname, $tablename)
//   {
   

//     $sql = "CREATE TABLE $tablename(
//   id INT(9) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
//   username VARCHAR(30) NOT NULL UNIQUE,
//   password TINYTEXT NOT NULL,
//   email VARCHAR(50),
//   reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
//   )";

//     if ($connection->exec($sql)) {
//       echo "<script>console.log('Table created! ')</script>";
//     } else {
//       echo "<script>console.log('Error: $connection->error ')</script>";
//     }


//   }

//   function checkTableExists($connection, $dbname, $tablename)
//   {
//     $connection->select_db($dbname);

//     $sql = "SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_NAME = '$tablename' AND TABLE_SCHEMA = DATABASE()";
//     $result = $connection->query($sql);

//     return $result && $result->num_rows > 0;
//   }


//   //   function registerUser($connection,$dbname,$tableName,$username,$password,$email){
// //     $connection->select_db($dbname);
// //     $sql = "INSERT INTO $tableName (username, password, email)
// //     VALUES ($username, $password, $email)";

//   //     if($connection->query($sql)){
// //       echo "<script>console.log('user has been registered')</script>";
// //     }else{
// //       echo "<script>console.log('error: $connection->error ')</script>";
// //     }
// // }


//   function registerUser($connection, $dbname, $tableName, $username, $password, $email)
//   {
//     $connection->select_db($dbname);
//     $stmt = $connection->prepare("INSERT INTO $tableName (username, password, email) VALUES (?, ?, ?)");
//     $stmt->bind_param('sss', $username, $password, $email);

//     if ($stmt->execute()) {
//       echo "<script>console.log('User has been registered')</script>";
//       header("Location: login.php");
//     } else {
//       echo "<script>console.log('Error: " . $stmt->error . "')</script>";
//     }
//     $stmt->close();
//   }




//   function checkDatabaseExists($connection, $dbname)
//   {
//     $sql = "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '$dbname'";
//     $result = $connection->query($sql);

//     if ($result && $result->num_rows > 0) {
//       return true;
//     } else {
//       return false;
//     }
//   }

//   function closeConnection($connection)
//   {
//     if ($connection->close()) {
//       echo "<script>console.log('Connection closed successfully')</script>";
//     } else {
//       echo "<script>console.log('Error closing connection')</script>";
//     }
//   }
// }

// $register = new Register($servername, $DBusername, $DBpassword);

// $connection = $register->getConnection();

// if ($register->checkDatabaseExists($connection, $dataBaseName) === false) {
//   $register->createDataBase($connection, $dataBaseName);
// } else {
//   echo "<script>console.log('database Exist')</script>";
// }

// if ($register->checkTableExists($connection, $dataBaseName, $tableName) === false) {
//   $register->createTable($connection, $dataBaseName, $tableName);
//   $register->registerUser($connection, $dataBaseName, $tableName, "example", "example_hashed", "example@gmail.com");
// } else {
//   echo "<script>console.log('table Exist')</script>";
// }


// if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//   $username = $_POST['username'];
//   $email = $_POST['email'];
//   $password = $_POST['password'];

//   $hashed_password = password_hash($password, PASSWORD_DEFAULT);
//   $register->registerUser($connection, $dataBaseName, $tableName, $username, $hashed_password, $email);
// }
?>

</html>