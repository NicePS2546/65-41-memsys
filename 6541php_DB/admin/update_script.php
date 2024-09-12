<?php
require_once "../auth/db_config.php";



if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $id = $_POST['id'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $dob = $_POST['dob'];
    $avatar = $_FILES['avatar'];
    $role = $_POST['role'];

    $callbacks = $server->update_user($connect, $fname, $lname, $dob, $avatar['name'], $role, $id);
    echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
    if ($callbacks) {
        echo '<script>
                    setTimeout(function() {
                        Swal.fire({
                            position: "center",
                            icon: "success",
                            title: "แก้ไขข้อมูลสมาชิกสําเร็จ",
                            showConfirmButton: true,
                            // timer: 1500
                        }).then(function() {
                        window.location = "show_member.php"; // Redirect to.. ปรับแก ้ชอไฟล์ตามที่ต้องการให ้ไป ื่
                    });
                        }, 1000);
                        </script>';
    } else {
        echo '<script>
        setTimeout(function() {
                Swal.fire({
                    position: "center",
                    icon: "error",
                    title: "เกิดข้อผิดพลาด",
                    showConfirmButton: true,
                    // timer: 1500
                    }).then(function() {
                window.location = "update_member.php"; // Redirect to.. ปรับแก ้ชอไฟล์ตามที่ต้องการให ้ไป ื่
                    });
                }, 1000);
            </script>';
    }
}
