<?php
require_once '../db_config.php';
if (session_status() === PHP_SESSION_NONE) {
    // ถ้ายังไม่มี session ที่ถูกเปิ ด
    session_start();
}
echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // รับค่าจากฟอร์ม
    $user_id = $_SESSION['id']; // รหัสผู้ใช้ที่เข้าสู่ระบบ
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];
    // ตรวจสอบวารหัสผ ่ านใหม ่ ่และการยืนยันรหัสผานตรงก ่ นหรือไม ั ่
    if ($new_password !== $confirm_password) {
        echo '<script>
setTimeout(function() {
Swal.fire({
position: "center",
icon: "error",
title: "รหัสผานใหม ่ ่ไม่ตรงกบการยืนยัน",
showConfirmButton: false,
timer: 2000
}).then(function() {
window.location = "change_password.php";
});
}, 1000);
</script>';
        exit();
    }
    // ดึงข้อมูลรหัสผานเก ่ ่าของผู้ใช้จากฐานข้อมูล
    $sql = "SELECT password FROM tb_users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $user_id);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    // ตรวจสอบวารหัสผ ่ านเก ่ ่าที่ผู้ใช้กรอกตรงกบที่อยู ั ในฐานข้อมูลหรือไม ่ ่
    if (!password_verify($current_password, $user['password'])) {
        echo '<script>
setTimeout(function() {
Swal.fire({
position: "center",
icon: "error",
title: "รหัสผานเก ่ ่
าไม่ถูกต้อง",
showConfirmButton: false,
timer: 2000
}).then(function() {
window.location = "change_password.php";
});
}, 1000);
</script>';
        exit();
    }
    // หากผานการตรวจสอบทั ่ ้งหมด ให้อัปเดตรหัสผานใหม ่ ่
    $new_password_hashed = password_hash($new_password, PASSWORD_DEFAULT);
    $sql = "UPDATE tb_users SET password = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $new_password_hashed);
    $stmt->bindParam(2, $user_id);
    $stmt->execute();
    // แจ้งผลลัพธ์สําเร็จ
    echo '<script>
setTimeout(function() {
Swal.fire({
position: "center",
icon: "success",
title: "เปลี่ยนรหัสผานสําเร็จ",
showConfirmButton: false,
timer: 2000
}).then(function() {
window.location = "index.php";
});
}, 1000);
</script>';
    exit();
}
?>