<?php

require_once '../auth/db_config.php';


$id = $_POST['id'];
$user = $server->getSoleJoinDynamic($connect, 'persons', 'tb_users', 'id', 'person_id', $id);
$role = $user['role'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

</head>

<body>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>แก้ไขข้อมูลสมาชิก</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Text Editors</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- form start -->
            <form action="update_script.php" method="post" enctype="multipart/form-data" style="display:flex; width:90%; flex-direction:column;">
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
                    <label for="dob" class="form-label">Date of Birth</label>
                    <input type="date" class="form-control" name="dob" id="dob" value="" aria-describedby="dob">
                </div>
                <div class="mb-3">
                    <label for="avatar" class="form-label">Avatar</label>
                    <input type="file" class="form-control" name="avatar" id="avatar" aria-describedby="avatar">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" class="form-control" readonly name="email" id="email" value="<?php echo $user['email'] ?>" aria-describedby="email">
                </div>

                <div class="mb-3">
                    <label for="" class="form-label">Role : </label>
                    <span class="form-check">
                        <input type="radio" class="form-check-input" name="role"
                            id="role1" value="1" <?php echo ($role == 1) ? 'checked' : ''; ?>>
                        <label for="role1" class="form-label">Admin</label>
                    </span>
                    <span class="form-check">
                        <input type="radio" class="form-check-input" name="role"
                            id="role2" value="0" <?php echo ($role == 0) ? 'checked' : ''; ?>>
                        <label for="role2" class="form-label">User</label>
                    </span>
                </div>

                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
    </div>

    </div>

    </div>
    </div>
    <!-- /.col-->
    </div>
    <!-- ./row -->

    <!-- ./row -->
    </section>
    <!-- /.content -->
    </div>
</body>

</html>