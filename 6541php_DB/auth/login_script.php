<?php

include "db_config.php";
     
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $email = $_POST['email'];
        $password = $_POST['password'];
    
       $server->login($connect,$table,$email,$password);
        
    }

?>