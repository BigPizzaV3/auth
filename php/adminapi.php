<?php
include './db_conn.php';
session_start();
switch ($_POST['type']) {
    case 'rmuser':
        $id = $_POST['id'];
        $myid =  $_SESSION['user_id'];
        $stmt = $conn->prepare("DELETE FROM users WHERE id=? AND superior=?");
        $stmt->execute([$id, $myid]);
        $ret = ["code" => 0, "msg" => "完成"];
        echo (json_encode($ret, JSON_UNESCAPED_UNICODE));
        break;
    case 'reset_password':
        $id = $_POST['id'];
        $myid =  $_SESSION['user_id'];
        $stmt = $conn->prepare("UPDATE users SET password=? WHERE id=? AND superior=?");
        $stmt->execute([password_hash("123456", PASSWORD_DEFAULT),$id, $myid]);
        $ret = ["code" => 0, "msg" => "修改完成,新密码为:123456"];
        echo (json_encode($ret, JSON_UNESCAPED_UNICODE));
        break;
}
