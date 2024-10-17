<?php
require_once '../db_config.php';

$sql = "SELECT tb_users.*,
persons.id,
persons.fname,
persons.lname,
persons.dob,
clubs.title AS club_title,
refs.title AS gender
FROM
persons
LEFT JOIN tb_users ON persons.id = tb_users.person_id
LEFT JOIN clubs ON persons.club_id = clubs.id
LEFT JOIN refs ON persons.gender_id = refs.id 
WHERE tb_users.role = '0'
";

$stmt = $conn->prepare($sql);
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

$index = 1;

?>

<link rel="stylesheet" href="https://cdn.datatables.net/2.1.2/css/dataTables.dataTables.min.css">
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>จัดการข้อมูล Admin
                        <a href="" class="btn btn-primary">+ข้อมูล</a>
                    </h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <div class="card">
        <!-- /.card-header -->
        <div class="card-body">
            <table class=" table" id="something">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Birth Data</th>
                        <th>Gender</th>
                        <th>Club</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $us):
                        if ($us['role'] == 1) {
                            $role = 'Admin';
                        } else {
                            $role = 'User';
                        }
                        ?>
                        <tr>
                            <!-- <td><?php  $us['id']; ?></td> -->
                            <td><?php echo $index++ ; ?></td>
                            <td><?php echo $us['fname']; ?></td>
                            <td><?php echo $us['lname']; ?></td>
                            <td><?php echo $us['email']; ?></td>
                            <td><?php echo $us['dob'] ? $us['dob'] : "ผู้ใช้ยังไม่ได้ตั้ง"; ?></td>
                            <td><?php echo $us['gender'] ? $us['gender'] : "ผู้ใช้ยังไม่ได้ตั้ง"; ?></td>
                            <td><?php echo $us['club_title'] ? $us['club_title'] : "ผู้ใช้ยังไม่ได้ตั้ง"; ?></td>
                            
                            


                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
<!-- /.col -->
</div>
<!-- /.row -->
</div>
<!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->



<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/2.1.2/js/dataTables.min.js"></script>
<script>
    let table = new DataTable('#something');
</script>
