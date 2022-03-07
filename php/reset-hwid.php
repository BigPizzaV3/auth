<?php
include './db_conn.php';
session_start();
if (isset($_SESSION['user_id'])) {
    $id = $_SESSION['user_id'];
    $time = time();
    $stmt = $conn->prepare("UPDATE users SET hwid=?,last_change=? WHERE id=? AND last_change<?");
    $stmt->execute(["", $time, $id, $time - 24 * 60 * 60]);
    if ($stmt->rowCount() === 1) {
        $_SESSION['user_hwid'] = "";
        $_SESSION['user_last_change'] = $time;
        $ret = ["code" => 0, "msg" => "重置成功"];
    } else {
        $ret = ["code" => 1, "msg" => "重置失败"];
    }
    echo (json_encode($ret, JSON_UNESCAPED_UNICODE));
}
