<?php
    session_start();
    if (!isset($_SESSION['role'])) {
        header("Location: auth/login.php");
        exit();
      };
require_once '65_41_conDB.php';
$sql = "SELECT * FROM $tableName";
$stmt = $connect->prepare($sql);
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>

<head>
    <title>View Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />

    <!-- DataTable CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css">
    <!-- DataTable CSS -->

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <div class="container">
        <h1>Admin Page</h1>
        <div style="display:flex; justify-content:end;">
            <a href="ex04_form_insertUser.php" class="btn btn-primary">ADD</a>
        </div>
        <table class="table" id="userTable">
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
            <?php
            foreach ($users as $user) {
                if ($user['role'] === 1) {
                    $role = 'Admin';
                } else {
                    $role = 'User';
                }
                echo "<tbody><tr>
                    <td style='text-align:center;'>" . $user['id'] . "</td>
                    <td>" . $user['fname'] . "</td>
                    <td>" . $user['lname'] . "</td>
                    <td>" . $user['email'] . "</td>
                    <td style='text-align:center;'>" . $user['password'] . "</td>
                    <td>" . $role . "</td>";
                ?>

                <td style="display:flex; gap:2px;">
                    <form action="ex07_update_user.php" method="post">
                    <input type='hidden' name='id' value='<?php echo $user['id']?>'>
                    <button type="submit" class="btn btn-primary">Edit</button>
                    </form>
                    <form action="ex06_delete_sweet.php" method="POST" style="display:inline;">
                        <input type="hidden" name="userId" value="<?php echo $user['id']; ?>">
                        <!-- <input type="submit" name="delete" value="Delete" class="btn btn-danger btn-sm"> -->
                        <button type="button" class="btn btn-danger delete-button"
                            data-user-id="<?php echo $user['id']; ?>">Delete</button>
                    </form>


                </td>

                </tr>
                </tbody>
                <?php
            }
            ?>
        </table>
        <div>
            <a class="text-end" href="index.php">ย้อนกลับไปหน้าหลัก</a>
        </div>
    </div>

    <script src='https://code.jquery.com/jquery-3.7.1.min.js'></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
    <script>
        // let table = new DataTable('#productTable');
        function intializingDataTable(table) {
            $(table).DataTable();
        };

        intializingDataTable('#userTable');
    </script>

    <script>
        // ฟังก์ชันสาหรับแสดงกล่องยืนยัน ํ SweetAlert2
        function showDeleteConfirmation(user_id) {
            Swal.fire({
                title: 'คุณแน่ใจหรือไม่?',
                text: 'คุณจะไม่สามารถเรียกคืนข ้อมูลกลับได ้!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'ลบ',
                cancelButtonText: 'ยกเลิก',
            }).then((result) => {
                if (result.isConfirmed) {
                    // หากผู้ใชยืนยัน ให ้ส ้ งค่าฟอร์มไปยัง ่ delete.php เพื่อลบข ้อมูล
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = 'ex06_delete_sweet.php';
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'userId';
                    input.value = user_id;
                    form.appendChild(input);
                    document.body.appendChild(form);
                    form.submit();
                }
            });
        }
        // แนบตัวตรวจจับเหตุการณ์คลิกกับองค์ปุ่ มลบทั้งหมดที่มีคลาส delete-button
        const deleteButtons = document.querySelectorAll('.delete-button');
        deleteButtons.forEach((button) => {
            button.addEventListener('click', () => {
                const user_id = button.getAttribute('data-user-id');
                showDeleteConfirmation(user_id);
            });
        });
    </script>
</body>

</html>