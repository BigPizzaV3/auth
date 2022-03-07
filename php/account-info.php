<?php
include './db_conn.php';
session_start();
if (isset($_SESSION['user_id']) && isset($_POST['password']) && isset($_POST['key'])) {
    $key = $_POST['key'];
    $id = $_SESSION['user_id'];
    $username = $_SESSION['user_username'];
    $password = $_POST['password'];

    if (empty($key)) {
        $ret = ["code" => 1, "msg" => "密钥为空"];
    } else if (empty($password)) {
        $ret = ["code" => 1, "msg" => "密码为空"];
    } else {
        $stmt = $conn->prepare("SELECT * FROM keytab WHERE key_name=? AND user=?");
        $stmt->execute([$key, $username]);
        if ($stmt->rowCount() === 1) {
            $stmt = $conn->prepare("UPDATE `users` SET `password`=? WHERE id=?");
            $stmt->execute([password_hash($password, PASSWORD_DEFAULT), $id]);
            $ret = ["code" => 0, "msg" => "更改成功"];
        } else {
            $ret = ["code" => 1, "msg" => "密钥不存在"];
        }
    }
    echo (json_encode($ret, JSON_UNESCAPED_UNICODE));
}
