<?php

require_once '../auth/db_config.php';
$users = $server->getJoinTable($connect, 'persons', 'tb_users', 'id', 'person_id')
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
            <table class=" table" id="table">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Password</th>
                        <th>Role</th>
                        <th>Action</th>
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
                            <td><?php echo $us['id']; ?></td>
                            <td><?php echo $us['fname']; ?></td>
                            <td><?php echo $us['lname']; ?></td>
                            <td><?php echo $us['email']; ?></td>
                            <td><?php echo $us['password']; ?></td>
                            <td><?php echo $role ?></td>
                            <td>
                                <form action="update_member.php" method="POST" style="display:inline;">
                                    <input type="hidden" name="id" value="<?php echo $us['id']; ?>">
                                    <input type="submit" name="edit" value="Edit" class="btn btn-warning btn-sm">
                                </form>

                                <form action="del_member.php" method="POST" style="display:inline;">
                                    <input type="hidden" name="user_id" value="<?php echo $us['id']; ?>">
                                    <!-- <input type="submit" name="delete" value="Delete" class="btn btn-danger btn-sm"> -->
                                    <button type="button" class="btn btn-danger btn-sm delete-button"
                                        data-user-id="<?php echo $us['id']; ?>">Delete</button>
                                </form>


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
    let table = new DataTable('#table');
</script>
<script>
    // ฟังก์ชันส าหรับแสดงกล่องยืนยัน SweetAlert2
    function showDeleteConfirmation(userId) {
        Swal.fire({
            title: 'คุณแน่ใจหรือไม่?',
            text: 'คุณจะไม่สามารถเรียกคืนข้อมูลกลับได้!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'ลบ',
            cancelButtonText: 'ยกเลิก',
        }).then((result) => {
            if (result.isConfirmed) {
                // หากผู้ใช้ยืนยัน ให้ส่งค่าฟอร์มไปยัง delete.php เพื่อลบข้อมูล
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = 'del_member.php';
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'user_id';
                input.value = userId;
                form.appendChild(input);
                document.body.appendChild(form);
                form.submit();
            }
        });
    }
    // แนบตวัตรวจจบัเหตุการณ์คลิกกบัองค์ปุ่่มลบทั่้งหมดที่มีคลาส delete-button
    const deleteButtons = document.querySelectorAll('.delete-button');
    deleteButtons.forEach((button) => {
        button.addEventListener('click', () => {
            const userId = button.getAttribute('data-user-id');
            showDeleteConfirmation(userId);
        });
    });
</script>