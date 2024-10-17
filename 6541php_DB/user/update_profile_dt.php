<?php

require_once '../db_config.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
    }

    
    if (isset($_SESSION['id'])) {

        $id = $_SESSION['id'];
        $sql = "SELECT persons.*, tb_users.* FROM persons
        LEFT JOIN tb_users ON persons.id = tb_users.person_id WHERE
        tb_users.id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $id);
        $stmt->execute();
        $users = $stmt->fetch(PDO::FETCH_ASSOC);
        extract($users);
        $imageURL = '../assets/dist/avatar/'.$avatar;

        // $id = $users['id'];
        // $fname = $users['fname'];
        // $iname = $users['iname'];
        // $email = $users['email'];
        // $dob = $users['dob'];
        // $avatar = $users['avatar'];
        // $password = $users['password'];
        // $role = $users['role'];
        
        $sqlClubs = "SELECT id, title FROM clubs";
        $stmtClubs = $conn->prepare($sqlClubs);
        $stmtClubs->execute();
        $clubs = $stmtClubs->fetchAll(PDO::FETCH_ASSOC);

        // ดึงข้อมูลเพศจากตาราง refs
        $genderSql = "SELECT id, title FROM refs WHERE ref_group_id = 2"; // 2 คือ ref_group_id ของเพศ
        $genderStmt = $conn->prepare($genderSql);
        $genderStmt->execute();
        $genders = $genderStmt->fetchAll(PDO::FETCH_ASSOC);
    

    }
?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>แก้ไขข้อมูลส่วนตัว</h1>
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
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-info">

                    <!-- /.card-header -->
                    <div class="card-body">



                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="update_profile_dt_script.php" method="post" enctype="multipart/form-data">
                            <div class="mb-3">
                                <!-- <label for="id" class="form-label">ID</label>
                <input type="text" class="form-control" name="id" id="id" aria-describedby="id"
                    value=" "> -->
                                <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" class="form-control" name="email" id="email" aria-describedby="email"
                                    value="<?php echo $email; ?> readonly">
                            </div>

                            <div class="mb-3">
                                <label for="firstname" class="form-label">First name</label>
                                <input type="text" class="form-control" name="fname" id="firstname"
                                    aria-describedby="firstname" value="<?php echo $fname; ?>">
                            </div>
                            <div class="mb-3">
                                <label for="iastname" class="form-label">Last name</label>
                                <input type="text" class="form-control" name="iname" id="iastnam"
                                    aria-describedby="iastname" value="<?php echo $lname; ?>">
                            </div>
                            <div class="mb-3">
                                <label for="dob" class="form-label">Date of Birth</label>
                                <input type="date" class="form-control" name="dob" id="dob" aria-describedby="dob"
                                    value="<?php echo $dob; ?>">
                            </div>
                            <div class="mb-3">
                                <label for="avatar" class="form-label">Photo</label><br>
                                <img src="<?php echo $imageURL ?>" height="100" width="100" class="mb-2">

                                <input type="file" class="form-control" name="avatar" id="avatar"
                                    aria-describedby="avatar" value="<?php echo $avatar; ?>">
                            </div>

                            <div class="mb-3 ">
                                <label for="club" class="form-label">สังกัดชมรม</label>
                                <select class="form-control" name="club" id="club">
                                    <option value="">เลือกชมรม</option>
                                    <?php foreach ($clubs as $club): ?>
                                        <option value="<?php echo $club['id']; ?>" <?php if (
                                               $club['id']
                                               == $users['club_id']
                                           )
                                               echo 'selected'; ?>>
                                            <?php echo $club['title']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="gender" class="form-label">Gender</label>
                                <select class="form-control" name="gender" id="gender">
                                <option value="">เลือกเพศ</option>   
                                <?php foreach ($genders as $gender): ?>
                                        <option value="<?php echo $gender['id']; ?>" <?php if (
                                               $gender['id']
                                               == $users['gender_id']
                                           )
                                               echo 'selected'; ?>>
                                            <?php echo $gender['title']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>





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
<!-- /.content-wrapper -->