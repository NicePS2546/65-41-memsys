<?php session_start(); ?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>  
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
        <div class="row d-flex justify-content-center align-items-center h-100">
          <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
            <form class="card p-5" action='login_old.php' method='post'>
            <h4 class="mb-4">Welcome Back</h4>
              <!-- Email input -->
              <div data-mdb-input-init class="form-outline form-floating mb-4">
                <input type="text" id="Username" name="username" class="form-control form-control-lg"
                  placeholder="Enter Username" />
                <label class="form-label" for="Email">Username</label>
              </div>
    
              <!-- Password input -->
              <div data-mdb-input-init class="form-outline form-floating mb-3">
               
                <input type="password" id="password" name="password" class="form-control form-control-lg"
                  placeholder="Enter password" />
                 <label class="form-label" for="password">Password</label>
              </div>
    
              <div class="d-flex justify-content-between align-items-center">
                <!-- Checkbox -->
                <div class="form-check mb-0">
                  <input class="form-check-input me-2" type="checkbox" name="isRemember" value="" id="form2Example3" />
                  <label class="form-check-label" for="props">
                    Remember me
                  </label>
                </div>
                <a href="#!" class="text-body">Forgot password?</a>
              </div>
    
              <div class="text-center text-lg-start mt-4 pt-2">
                <button  type="submit"  class="btn btn-primary btn-lg"
                  style="padding-left: 2.5rem; padding-right: 2.5rem;">Login</button>
                <p class="small fw-bold mt-2 pt-1 mb-0">Don't have an account? <a href="/loginCrud/register.php"
                    class="link-danger">Register</a></p>
              </div>
    
            </form>
          </div>
        </div>
      </div>
      
      </div>
    </section>
    
  </body>
  <?php 
   
  //    if (isset($_SESSION['username'])) {
  //     header("Location: landing.php");
  //     exit();
  //   }

  //     $servername = 'localhost';
  //     $DBusername = 'root';
  //     $DBpassword = '';
  //     $dataBaseName ='Register';
  //     $tableName = 'User';

      

  //       class Login {
  //         private $servername;
  //         private $username;
  //         private $password;
  //         private $dataBaseName;
  //         private $tableName;

  //         public $DBconnect;

  //         function __construct($servername, $DBusername, $DBpassword,$dataBaseName,$tableName){
  //           $this->servername = $servername;
  //           $this->username = $DBusername;
  //           $this->password = $DBpassword;

  //           $this->DBconnect = $this->connectServer();
  //         }

  //         function login($connection,$dbname,$username,$password){
  //           $username = $connection->real_escape_string($username);
  //           $connection->select_db($dbname);

  //           $stmt = $connection->prepare("SELECT * FROM User WHERE username = ?");
  //           $stmt->bind_param("s", $username);
  //           $stmt->execute();
  //           $data = $stmt->get_result();
            
  //           if($data->num_rows > 0){
  //             $rows = $data->fetch_assoc();
  //             if(password_verify($password,$rows['password'])){
                
  //               $_SESSION['username'] = $rows['username'];
                
  //               echo "<script>console.log('Login Successfully')</script>";
  //               header("Location: landing.php");
  //               exit(); // Ensure no further output after redirect
  //             }else{
  //               echo "<script>console.log('Incorrect Password Entered : $password password from database : ". $rows['password'] . "')</script>";
  //             }
  //           }
  //         }
       

  //       private function connectServer() {
  //         $connect = new mysqli($this->servername, $this->username, $this->password);
  
  //         if ($connect->connect_error) {
  //             die("<script>console.log('Connection failed: " . $connect->connect_error ."')</script>");
  //         } else {
  //             echo "<script>console.log('Connected to server')</script>";
  //             return $connect;
  //         }
  //     }
  
  //   function getConnection(){
  //     return $this->DBconnect;
  //   } 
  // }
  //   $login = new Login($servername,$DBusername,$DBpassword,$dataBaseName,$tableName);
  //   $connect = $login->getConnection();
    
  //   if($_SERVER['REQUEST_METHOD'] == 'POST'){
  //     $username = $_POST['username'];
  //     $password = $_POST['password'];

  //     $login->login($connect,$dataBaseName,$username,$password);
      


  //   }
      
  
  
  
  ?>
</html>