<?php
include "header.php";
include "footer.php";
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="container">

        <h1>Insert User</h1>
        <?php
        include "65_41_conDB.php";
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $role = $_POST['role'];

            $server->addUser($connect, $fname, $lname, $email, $password, $role);
        }
        ?>
        <hr>
        <a href="index.php" class='btn btn-primary'>Home</a>
    </div>

</body>

</html>