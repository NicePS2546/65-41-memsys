<?php
include "db_config.php";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    // $result = $server->register($connect, $table, $fname, $lname, $email, $hashed_password, $role);
    $callbacks = $server->new_register($connect, $fname, $lname, $email, $hashed_password);
    //sweet alert
    echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
    if ($callbacks['status'] && $callbacks['message'] === "successful") {
        echo '<script>
                    setTimeout(function() {
                        Swal.fire({
                            position: "center",
                            icon: "success",
                            title: "สมัครสมาชิกสําเร็จ",
                            showConfirmButton: true,
                            // timer: 1500
                        }).then(function() {
                        window.location = "../index.php"; // Redirect to.. ปรับแก ้ชอไฟล์ตามที่ต้องการให ้ไป ื่
                    });
                        }, 1000);
                        </script>';
    } elseif ($callbacks['message'] === "email_exist") {
        echo '<script>
            setTimeout(function() {
                Swal.fire({
                position: "center",
                icon: "error",
                title: "อีเมลน้ีถูกใช้งานแลว้",
                showConfirmButton: false,
                timer: 1500
            }).then(function() {
                window.location = "register.php"; // Redirect to.. ปรับแก้ชื่อ
                ไฟล์ตามที่ต้องการให้ไป
            });
        }  , 10);
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
                window.location = "login.php"; // Redirect to.. ปรับแก ้ชอไฟล์ตามที่ต้องการให ้ไป ื่
                    });
                }, 1000);
            </script>';
    }
}
