<?php
include('../db_config.php');
require_once "session_manage.php";
?>


        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {


        $id = $_POST['id'];
        $fname = $_POST['fname'];
        $lname = $_POST['iname'];
        $email = $_POST['email'];
        $club_id = $_POST['club'];
        $gender_id = $_POST['gender'];
        $dob = $_POST['dob'];
        $avatar = $_FILES['avatar'];
       



                    // ดึงข้อมูลผู้ใช้จากฐานข้อมูลเพื่อตรวจสอบรูปภาพเดิม
            $sql = "SELECT avatar FROM persons WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(1, $id);
            $stmt->execute();
            $person = $stmt->fetch(PDO::FETCH_ASSOC);
            $oldAvatar = $person['avatar'];
            // ตรวจสอบวา่ ไดม้ีการอปัโหลดรูปภาพใหม่หรือไม่
            if (!empty($_FILES['avatar']['name'])) { // ถา้มีการอปัโหลดรูปภาพใหม่
            $targetDir = "../assets/dist/avatar/"; // ที่อยขู่ องโฟลเดอร์เกบ็ไฟล์
            $fileName = basename($_FILES['avatar']['name']); // เอาเฉพาะชื่อไฟลอ์อกมา (ไม่เอา path)
            $targetFilePath = $targetDir . $fileName; // ที่อยขู่ องไฟลท์ ี่จะอปัโหลด (โฟลเดอร์+ ชื่อไฟล)์
            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); // เอาเฉพาะนามสกุลไฟล์

            if (!is_dir($targetDir)) {
                mkdir($targetDir, 0755, true);
              }
            
           
            // ตรวจสอบประเภทไฟล์(สามารถเพิ่มประเภทที่ตอ้งการได)้
            $allowTypes = array('jpg', 'png', 'jpeg', 'gif'); // ประเภทไฟล์ที่อนุญาต
                if (in_array($fileType, $allowTypes)) { // ตรวจสอบวา่ อยใู่ นประเภทที่อนุญาตหรือไม่
                    // ตรวจสอบวา่ มีขอ้ผดิพลาดในการอปัโหลดไฟลห์ รือไม่
                    if ($_FILES['avatar']['error'] === UPLOAD_ERR_OK) { // ถา้ไม่มีขอ้ผดิพลาด
                     // อัปโหลดไฟล์ไปยังโฟลเดอร์ที่ต้องการ
                        if (move_uploaded_file($_FILES['avatar']['tmp_name'],
                        $targetFilePath)) { // ถ้าอัปโหลดส าเร็จ
                             // ลบรูปภาพเก่า (ถา้มี) เพื่อประหยดัพ้ืนที่
                            if (!empty($oldAvatar) &&
                                file_exists("../assets/dist/avatar/".$oldAvatar)) { // ถา้มีรูปภาพเดิมและมีไฟลอ์ยจู่ ริง
                                unlink("../assets/dist/avatar/".$oldAvatar); // ลบไฟล์เดิม(รูปภาพเก่า)ออก
                                }
                                // เกบ็ ชื่อไฟลร์ูปภาพใหม่
                    $avatar = $fileName;
                            } else {
                            echo "เกิดขอ้ผดิพลาดในการยา้ยไฟลร์ูปภาพไปยงัโฟลเดอร์เป้าหมาย.";
                            exit();
                                 }
                        } else {
                            echo "เกิดขอ้ผดิพลาดในการอปัโหลดไฟล.์รหสัขอ้ผดิพลาด: " . $_FILES['avatar']['error'];
                         exit();
                    }
                    } else {
                    echo "ประเภทไฟลไ์ม่รองรับ.";
                    exit();
                    }
                    } else {
                    // ถา้ไม่มีการอปัโหลดใหม่ใหใ้ชรู้ปภาพเดิม
                    $avatar = $oldAvatar;
                    }

        try {

          

            // คำสั่ง SQL สำหรับบันทึก fname และ lname ลงตาราง persons
            $sql1 = "UPDATE persons SET fname = ?, lname = ?, dob = ?, avatar = ?, gender_id = ? , club_id = ?  WHERE id = ?";
            $stmt1 = $conn->prepare($sql1);
            $stmt1->bindParam(1, $fname);
            $stmt1->bindParam(2, $lname);
            $stmt1->bindParam(3, $dob);
            $stmt1->bindParam(4, $avatar);
            $stmt1->bindParam(5, $gender_id );
            $stmt1->bindParam(6, $club_id);
            $stmt1->bindParam(7, $id);
            $stmt1->execute();
          
            
        // ถ้าอัปเดตสำเร็จ
        echo "อัปเดตข้อมูลสำเร็จ!";
        header("Location: update_profile.php");
        } catch (Exception $e) {
        echo "เกิดขอ้ผิดพลาด: " . $e->getMessage();
        }
        
        
        }


       
    
    ?>