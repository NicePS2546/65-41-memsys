<?php
include '65_41_conDB.php';

if (isset($_POST['delete']) && isset($_POST['userId'])) {// show data
    $id = $_POST['userId'];
    $server->showUserDetail($connect, $tableName, $id, "ex06_delete_user.php");
}
;

if (isset($_POST['confirm_delete']) && isset($_POST['userId'])) {
    $id = $_POST['userId'];
    $server->deleteById($connect, $tableName, $id);
}
;




?>