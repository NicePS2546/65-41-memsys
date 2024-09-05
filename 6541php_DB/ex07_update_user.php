<?php
include "header.php";
include "footer.php";

 include "65_41_conDB.php";

 if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $id = $_POST['id'];
    $user = $server->getSole($connect,$tableName,$id);
    $id = $user['id'];
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
        <h3 class="mt-4">แก้ไขข้อมูลนักศึกษา</h3>
        <hr>
        <form action="ex07_update_script.php" method="post">
            <input type="hidden" name="id" value="<?php echo $id ?>">
            <div class="mb-3">
                <label for="firstname" class="form-label">First name</label>
                <input type="text" class="form-control" name="fname" value="<?php echo $user['fname'] ?>" id="firstname" aria-describedby="firstname">
            </div>
            <div class="mb-3">
                <label for="lastname" class="form-label">Last name</label>
                <input type="text" class="form-control" name="lname" id="lastname" value="<?php echo $user['lname'] ?>" aria-describedby="lastname">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control" name="email" id="email" value="<?php echo $user['email'] ?>" aria-describedby="email">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" id="password" value="<?php echo $user['password'] ?>" aria-describedby="password">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Role : </label>
                <input type="radio" class="form-check-input" name="role" id="admin" <?php echo $user['role'] == 1 ? 'checked' : '' ?> value="1">
                <label for="admin" class="form-label">Admin</label>
                <input type="radio" class="form-check-input" name="role" id="user" <?php echo $user['role'] == 0 ? 'checked' : '' ?> value="0" >
                <label for="user" class="form-label">User</label>
            </div>
            <button type="submit" class="btn btn-primary">บันทึกข้อมูล</button>
        </form>
        <hr>
        <p class="text-end">
            <a href="ex05_show.php" class="btn btn-secondary">กลับหน้าหลัก</a>
        </p>
    </div>
</body>

</html>

<?php

}


?>