<?php
require_once "../auth/db_config.php";

if (isset($_POST['user_id'])) {
    $u_id = $_POST['user_id'];
    try {
        $callbacks = $server->deleteTwoRows($connect, $table, 'persons', $u_id);
        echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
        if ($callbacks) {
            echo '<script>
                    setTimeout(function() {
                        Swal.fire({
                            position: "center",
                            icon: "success",
                            title: "สมัครสมาชิกสําเร็จ",
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
                window.location = "show_member.php"; // Redirect to.. ปรับแก ้ชอไฟล์ตามที่ต้องการให ้ไป ื่
                    });
                }, 1000);
            </script>';
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
